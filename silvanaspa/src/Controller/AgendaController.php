<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use App\Entity\Agenda;
use App\Entity\DescansoAgenda;
use App\Entity\Descanso;
use App\Form\AgendaType;

class AgendaController extends AbstractController
{
    private $session;
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $agendas = $em->getRepository(Agenda::class)->findBy(
            array("activo"=>"true")
        );
        return $this->render("agenda/agenda_list.html.twig", array(
            "agendas" => $agendas
        ));
    }

    public function new(Request $request)
    {
    	$agenda = new Agenda();
        $form = $this->createForm(AgendaType::class, $agenda);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $agenda->setNombre($form->get("nombre")->getData());
            $agenda->setDescripcion($form->get("descripcion")->getData());
            $agenda->setActivo(true);
                
            $em->persist($agenda);
            $flush = $em->flush();
                
            if($flush==null){
              $mensaje = "Agenda creada correctamente.";
              $tipomensaje = "success";
            }else{
              $mensaje = "La informacion registrada tiene errores.";
              $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("agenda_list");
        }
        
        return $this->render('agenda/agenda_new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function edit(Request $request, $id) {
        $em=$this->getDoctrine()->getManager();
        $agenda = $em->getRepository(Agenda::class)->find($id);
        $form = $this->createForm(AgendaType::class,$agenda);
        
        $form->handleRequest($request);
        if($form->isSubmitted()){
            if($form->isValid()){                
                $agenda->setNombre($form->get("nombre")->getData());
                $agenda->setDescripcion($form->get("descripcion")->getData());
                $agenda->setActivo(true);
                
                $em->persist($agenda);
                $flush = $em->flush();

                if($flush==null){
                  $mensaje = "agenda editada correctamente.";
                  $tipomensaje = "success";
                }else{
                  $mensaje = "No fue posible editar el agenda.";
                  $tipomensaje = "danger";
                }
            }else{
                $mensaje = "El agenda no se ha iditado, porque la informacion registrada contiene errores.";
                $tipomensaje = "danger";
            }
            $this->session->getFlashBag()->add("mensaje",$mensaje);
            $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
            return $this->redirectToRoute("agenda_list");
        }
        
        return $this->render("agenda/agenda_edit.html.twig", array(
            "form" => $form->createView()
        ));
    }//end function editAction

    public function delete($id) {
        $em=$this->getDoctrine()->getManager();
        $agenda = $em->getRepository(agenda::class)->find($id);
        $agenda->setActivo(false);

        $em->persist($agenda);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "agenda eliminada correctamente.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible eliminar la agenda.";
          $tipomensaje = "danger";
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("agenda_list");
    }//end function deleteAction

    public function panel() {
        $em=$this->getDoctrine()->getManager();
        $em = $this->getDoctrine()->getManager();
        $agendas = $em->getRepository(Agenda::class)->findBy(
            array("activo"=>"true")
        );
       
        if($agendas==null){
          $mensaje = "No existen agendas creadas.";
          $tipomensaje = "info";
        }else{
          return $this->render("agenda/agenda_panel.html.twig", array(
            "agendas" => $agendas
          ));
        }
        
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
         return $this->render("agenda/agenda_panel.html.twig", array(
            "agendas" => $agendas
        ));
    }

    public function parametrizar($id) {
        $em=$this->getDoctrine()->getManager();
        $agenda = $em->getRepository(Agenda::class)->find($id);
        
        if($agenda==null){
          $mensaje = "No se pudo recuperar la agenda.";
          $tipomensaje = "danger";
          $this->session->getFlashBag()->add("mensaje",$mensaje);
          $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
          return $this->redirectToRoute("agenda_panel");
        }else{
          $descansos_agenda = $em->getRepository(DescansoAgenda::class)->findBy(
            array("agenda"=>$agenda->getId())
          );
        
        return $this->render("agenda/agenda_parametrizar.html.twig", array(
          "agenda" => $agenda,
          "descansos_agenda" => $descansos_agenda,
          ));
        }
        
        return $this->render("agenda/agenda_parametrizar.html.twig", array(
            "agenda" => $agenda
        ));
    }

    public function getDescansos(Request $request){
        $agendaId = $request->get("id");
        $em = $this->getDoctrine()->getManager();
        
        $nativeSql = "SELECT *
                        FROM descanso d
                        WHERE NOT EXISTS (SELECT NULL
                                            FROM descanso_agenda da
                                            WHERE da.descanso_id = d.id
                                            AND da.agenda_id = $agendaId)";
        
        $rsm = new ResultSetMapping();

        $rsm->addScalarResult('id', 'id');
        $rsm->addScalarResult('nombre', 'nombre');
        $rsm->addScalarResult('duracion', 'duracion');
        $rsm->addScalarResult('estado', 'estado');

        $query = $em->createNativeQuery($nativeSql, $rsm);

        $descansos = $query->getResult();
        
        return $this->render("agenda/agenda_getDescansos.html.twig", array(
            "descansos" => $descansos,
            "agendaId" => $agendaId,
        ));
    }

    public function setDescansos(Request $request){
        $agendaId = $request->get("agendaId");
        $descansoId = $request->get("descansoId");
        $HoraInicio = $request->get("HoraInicio");
        
        $em = $this->getDoctrine()->getManager();
        $agenda = $em->getRepository(Agenda::class)->findOneBy(
                array("id"=>$agendaId)
            );
        $descanso = $em->getRepository(Descanso::class)->findOneBy(
            array("id"=>$descansoId)
        );
        $duracion = $descanso->getDuracion();
        $descansoagenda = new DescansoAgenda();
        $descansoagenda->setAgenda($agenda);
        $descansoagenda->setDescanso($descanso);
        $descansoagenda->setHoraInicio(new \DateTime($HoraInicio));
        
        $descansoagenda->setHoraFin(new \DateTime($HoraInicio));
        $duracion = $duracion->format('H:i');
        $duracion = explode(':', $duracion);
        $horas = $duracion[0];
        $minutos = $duracion[1];
        $HoraFin = $descansoagenda->getHoraFin()->modify("+".$horas." hour");
        $HoraFin = $HoraFin->modify("+".$minutos." minute");
        $descansoagenda->setHoraFin($HoraFin);
        
        $em->persist($descansoagenda);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "Descanso asignado.";
          $tipomensaje = "success";
          $response = "1";
        }else{
          $mensaje = "No fue posible asignar el descanso";
          $tipomensaje = "danger";
          $response = "-1";
        }
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return new Response($response);
       // return $this->redirectToRoute("agenda_parametrizar",array('id'=>$agendaId));
    }

    public function deleteDescanso(Request $request){
        $agendaId = $request->get("agendaId");
        $descansoId = $request->get("descansoId");

        $em = $this->getDoctrine()->getManager();
        $descansoagenda = $em->getRepository(DescansoAgenda::class)->findOneBy(
                    array("agenda"=>$agendaId
                    )
                );
        
        $em->remove($descansoagenda);
        $flush = $em->flush();

        if($flush==null){
          $mensaje = "Descanso desasignado.";
          $tipomensaje = "success";
        }else{
          $mensaje = "No fue posible desasignar el descanso.";
          $tipomensaje = "danger";
        }
        $this->session->getFlashBag()->add("mensaje",$mensaje);
        $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
        return $this->redirectToRoute("agenda_parametrizar",array('id'=>$agendaId));
    }
}
