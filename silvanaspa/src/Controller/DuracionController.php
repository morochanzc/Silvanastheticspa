<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Duracion;
use App\Form\DuracionType;

class DuracionController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $duraciones = $em->getRepository(Duracion::class)->findBy(
            array("activo"=>"true")
        );
        return $this->render("duracion/duracion_list.html.twig", array(
            "duraciones" => $duraciones
        ));
    }

    public function new(Request $request)
    {
    	$duracion = new Duracion();
        $form = $this->createForm(DuracionType::class, $duracion);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $duracion->setNombre($form->get("nombre")->getData());
            $duracion->setDuracion($form->get("duracion")->getData());
            $duracion->setActivo(true);
                
            $em->persist($duracion);
            $flush = $em->flush();
                
            if($flush==null){
              $mensaje = "Duración creada correctamente.";
              $tipomensaje = "success";
            }else{
              $mensaje = "La información registrada tiene errores.";
              $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("duracion_list");
        }
        
        return $this->render('duracion/duracion_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id) {
        $em=$this->getDoctrine()->getManager();
        $duracion = $em->getRepository(Duracion::class)->find($id);
        $form = $this->createForm(DuracionType::class,$duracion);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){                
                $duracion->setNombre($form->get("nombre")->getData());
                $duracion->setDuracion($form->get("duracion")->getData());
                $duracion->setActivo(true);
                
                $em->persist($duracion);
                $flush = $em->flush();

                if($flush==null){
                  $mensaje = "Duración editada correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "No fue posible editar el duración.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "La duración no se ha iditado, porque la información registrada contiene errores.";
                $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("duracion_list");
        }
        
        return $this->render("duracion/duracion_edit.html.twig", array(
            "form" => $form->createView()
        ));
    }//end function editAction

    public function delete($id) {
        $em=$this->getDoctrine()->getManager();
        $duracion = $em->getRepository(duracion::class)->find($id);
        $duracion->setActivo(false);

        $em->persist($duracion);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "Duración eliminada correctamente.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible eliminar la duración.";
          $tipomensaje = "danger";
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("duracion_list");
    }//end function deleteAction

    public function getDuraciones(){
                
        $em = $this->getDoctrine()->getManager();
        $duraciones = $em->getRepository(Duracion::class)->findBy(
            array("activo"=>"true")
        );
        
        return $this->render("duracion/duracion_getDuraciones.html.twig", array(
            "duraciones" => $duraciones
        ));
    }
}
