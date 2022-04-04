<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Usuario;
use App\Entity\Rol;
use App\Entity\TipoIdentificacion;
use App\Form\UsuarioType;
use App\Form\UsuarioEditType;

class UsuarioController extends AbstractController
{
	private $passwordEncoder;
    private $session;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder, SessionInterface $session)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->session = $session;
    }

    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $usuarios = $em->getRepository(Usuario::class)->findBy(
            array("activo"=>"true")
        );
        return $this->render("usuario/usuario_list.html.twig", array(
            "usuarios" => $usuarios
        ));
    }

    public function new(Request $request)
    {
    	$usuario = new Usuario();
        $form = $this->createForm(UsuarioType::class, $usuario);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $userLogin=$em->getRepository(Usuario::class)->findOneBy(array("login"=>$form->get("login")->getData()));
            $userIdentificacion=$em->getRepository(Usuario::class)->findOneBy(array("identificacion"=>$form->get("identificacion")->getData()));
            
            if($userLogin==null &&  $userIdentificacion==null){
                $usuario = new Usuario();
                $usuario->setLogin($form->get("login")->getData());
                $usuario->setClave($this->passwordEncoder->encodePassword($usuario, $form->get("password")->getData()));
                $usuario->setIdentificacion($form->get("identificacion")->getData());
                $usuario->setNombre($form->get("nombre")->getData());
                $usuario->setApellido($form->get("apellido")->getData());
                $usuario->setDireccion($form->get("direccion")->getData());
                $usuario->setTelefono($form->get("telefono")->getData());
                $usuario->setCelular($form->get("celular")->getData());
                $usuario->setCorreo($form->get("correo")->getData());
                $usuario->setActivo(true);
                
                $usuario->setTipoIdentificacion($form->get("tipoidentificacion")->getData());
                $usuario->setRol($form->get("rol")->getData());
                $usuario->setFechaRegistro(New \DateTime());
                $usuario->setFechaCambioPass(New \DateTime());

                $em->persist($usuario);
                $flush = $em->flush();
                
                if($flush==null){
                  $mensaje = "Usuario creado correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "La informacion registrada tiene errores.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "Ya existe un registro con el usuario y/o identificación digitados.";
                $tipomensaje = "warning";
                $this->session->getFlashBag()->add("mensaje",$mensaje);
                $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
                return $this->render('usuario/usuario_new.html.twig', [
                    'form' => $form->createView(),
                ]);
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("usuario_list");
        }
        
        return $this->render('usuario/usuario_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id) {
        $em=$this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $passwordOriginal = $usuario->getPassword();
        $form = $this->createForm(UsuarioEditType::class,$usuario);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){
                $usuario->setIdentificacion($form->get("identificacion")->getData());
                $usuario->setNombre($form->get("nombre")->getData());
                $usuario->setApellido($form->get("apellido")->getData());
                $usuario->setDireccion($form->get("direccion")->getData());
                $usuario->setTelefono($form->get("telefono")->getData());
                $usuario->setCelular($form->get("celular")->getData());
                $usuario->setCorreo($form->get("correo")->getData());
                $usuario->setActivo(true);
                
                $usuario->setTipoIdentificacion($form->get("tipoidentificacion")->getData());
                $usuario->setRol($form->get("rol")->getData());
                $usuario->setFechaCambioPass(New \DateTime());

                $em->persist($usuario);
                $flush = $em->flush();

                if($flush==null){
                  $mensaje = "Usuario editado correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "No fue posible editar el usuario.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "El usuario no se ha iditado, porque la informacion registrada contiene errores.";
                $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("usuario_list");
        }
        
        return $this->render("usuario/usuario_edit.html.twig", array(
            "form" => $form->createView()
        ));
    }//end function editAction

    public function delete($id) {
        $em=$this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->find($id);
        $usuario->setFechaCambioPass(New \DateTime());
        $usuario->setActivo(false);

        $em->persist($usuario);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "Usuario eliminado correctamente.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible eliminar el usuario.";
          $tipomensaje = "danger";
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("usuario_list");
    }//end function deleteAction

    public function getUsuario(Request $request){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository(Usuario::class)->findOneBy(array("identificacion"=>$request->get("id")));
        
        if($usuario==null){
            $mensaje = "No existen registros con el número de identificación: ".$request->get("id");
            return $this->render("cita/cita_mensaje.html.twig", array(
            "mensaje" => $mensaje,
            "clase" => 'danger',
            "url" => 'usuario_new',
            "boton" => 'Registrar',
            ));
        }
        
        return $this->render("usuario/usuario_getUsuario.html.twig", array(
            "usuario" => $usuario
        ));
    }
}
