<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Descanso;
use App\Form\DescansoType;

class DescansoController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $descansos = $em->getRepository(Descanso::class)->findBy(
            array("activo"=>"true")
        );
        return $this->render("descanso/descanso_list.html.twig", array(
            "descansos" => $descansos
        ));
    }

    public function new(Request $request)
    {
    	$descanso = new Descanso();
        $form = $this->createForm(DescansoType::class, $descanso);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $descanso->setNombre($form->get("nombre")->getData());
            $descanso->setDuracion($form->get("duracion")->getData());
            $descanso->setActivo(true);
                
            $em->persist($descanso);
            $flush = $em->flush();
                
            if($flush==null){
              $mensaje = "descanso creado correctamente.";
              $tipomensaje = "success";
            }else{
              $mensaje = "La informacion registrada tiene errores.";
              $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("descanso_list");
        }
        
        return $this->render('descanso/descanso_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id) {
        $em=$this->getDoctrine()->getManager();
        $descanso = $em->getRepository(Descanso::class)->find($id);
        $form = $this->createForm(DescansoType::class,$descanso);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){                
                $descanso->setNombre($form->get("nombre")->getData());
                $descanso->setDuracion($form->get("duracion")->getData());
                $descanso->setActivo(true);
                
                $em->persist($descanso);
                $flush = $em->flush();

                if($flush==null){
                  $mensaje = "descanso editado correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "No fue posible editar el descanso.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "El descanso no se ha iditado, porque la informacion registrada contiene errores.";
                $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("descanso_list");
        }
        
        return $this->render("descanso/descanso_edit.html.twig", array(
            "form" => $form->createView()
        ));
    }//end function editAction

    public function delete($id) {
        $em=$this->getDoctrine()->getManager();
        $descanso = $em->getRepository(Descanso::class)->find($id);
        $descanso->setActivo(false);

        $em->persist($descanso);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "Descanso eliminado correctamente.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible eliminar el descanso.";
          $tipomensaje = "danger";
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("descanso_list");
    }//end function deleteAction
}
