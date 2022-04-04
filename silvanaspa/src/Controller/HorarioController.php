<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Horario;
use App\Entity\Agenda;
use App\Form\HorarioType;

class HorarioController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $horarios = $em->getRepository(Horario::class)->findAll();
        return $this->render("horario/horario_list.html.twig", array(
            "horarios" => $horarios
        ));
    }

    public function new(Request $request)
    {
    	$horario = new Horario();
        $form = $this->createForm(HorarioType::class, $horario);
        
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $em=$this->getDoctrine()->getManager();
            $horario->setAgenda($form->get("agenda")->getData());
            $horario->setFecha($form->get("fecha")->getData());
            $horario->setFestivo($form->get("festivo")->getData());
            $horario->setDia($form->get("dia")->getData());
            $horario->setHoraInicio($form->get("horaInicio")->getData());
            $horario->setHoraFin($form->get("horaFin")->getData());
            $horario->setDuracion($form->get("duracion")->getData());

            $em->persist($horario);
            $flush = $em->flush();
                
            if($flush==null){
              $mensaje = "horario creado correctamente.";
              $tipomensaje = "success";
            }else{
              $mensaje = "La informacion registrada tiene errores.";
              $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("horario_list");
        }
        
        return $this->render('horario/horario_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id) {
        $em=$this->getDoctrine()->getManager();
        $horario = $em->getRepository(Horario::class)->find($id);
        $form = $this->createForm(HorarioType::class,$horario);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){                
                $horario->setAgenda($form->get("agenda")->getData());
                $horario->setFecha($form->get("fecha")->getData());
                $horario->setFestivo($form->get("festivo")->getData());
                $horario->setDia($form->get("dia")->getData());
                $horario->setHoraInicio($form->get("horaInicio")->getData());
                $horario->setHoraFin($form->get("horaFin")->getData());
                $horario->setDuracion($form->get("duracion")->getData());
                               
                $em->persist($horario);
                $flush = $em->flush();

                if($flush==null){
                  $mensaje = "horario editado correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "No fue posible editar el horario.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "El horario no se ha iditado, porque la informacion registrada contiene errores.";
                $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("horario_list");
        }
        
        return $this->render("horario/horario_edit.html.twig", array(
            "form" => $form->createView()
        ));
    }//end function editAction

    public function delete($id) {
        $em=$this->getDoctrine()->getManager();
        $horario = $em->getRepository(Horario::class)->find($id);
        $horario->setActivo(false);

        $em->persist($horario);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "horario eliminado correctamente.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible eliminar el horario.";
          $tipomensaje = "danger";
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("horario_list");
    }//end function deleteAction
}
