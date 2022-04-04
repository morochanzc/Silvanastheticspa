<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use App\Entity\Cita;
use App\Entity\Agenda;
use App\Entity\Usuario;
use App\Entity\Duracion;
use App\Entity\DescansoAgenda;
use App\Entity\Descanso;
use App\Form\CitaType;

class CitaController extends AbstractController
{
  private $session;
  public function __construct(SessionInterface $session)
  {
      $this->session = $session;
  }

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
      return $this->render("cita/cita_panel.html.twig", array(
        "agendas" => $agendas
      ));
    }
    
    $this->session->getFlashBag()->add("mensaje",$mensaje);
    $this->session->getFlashBag()->add("tipomensaje",$tipomensaje);
     return $this->render("cita/cita_panel.html.twig", array(
        "agendas" => $agendas
    ));
  }

  public function list(Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $agendaId = $request->get('agendaId');
    
    if($request->get('fecha') != null){
        $fecha = new \DateTime($request->get('fecha'));
        $fecha = $fecha->format('Y-m-d');
    }else{
        $fecha = new \DateTime();
        $fecha = $fecha->format('Y-m-d');
    }
    // Horarios asociados a la agenda
    $horariosSql = "select horario.id as id, horario.agenda_id as agenda, "
            ."horario.fecha as fecha, horario.festivo as festivo, horario.dia as dia, horario.hora_inicio as inicio, "
            ."horario.hora_fin as fin, horario.duracion as duracion from horario "
            ."where horario.agenda_id = ".$agendaId."";
    
    $rsm = new ResultSetMapping();
    $rsm->addScalarResult('id', 'id');
    $rsm->addScalarResult('agenda', 'agenda');
    $rsm->addScalarResult('fecha', 'fecha');
    $rsm->addScalarResult('festivo', 'festivo');
    $rsm->addScalarResult('dia', 'dia');
    $rsm->addScalarResult('inicio', 'inicio');
    $rsm->addScalarResult('fin', 'fin');
    $rsm->addScalarResult('duracion', 'duracion');
    $query = $em->createNativeQuery($horariosSql, $rsm);
    $horarios = $query->getResult();
    if($horarios==null){
        $this->session->getFlashBag()->add("mensaje","No existen horarios configurados para esta agenda.");
        $this->session->getFlashBag()->add("tipomensaje","danger");
        $this->session->getFlashBag()->add("url","horarios_list");
        $this->session->getFlashBag()->add("boton","Agregar horario");
        return $this->redirectToRoute("cita_panel");
    }

    // Descansos asociados a la agenda
    $descansosSql = "select descanso.id as id, descanso.nombre as nombre, descanso.duracion as duracion, "
            ."descanso_agenda.hora_inicio as hora_inicio, descanso_agenda.hora_fin as hora_fin "
            ."from descanso_agenda "
            ."inner join descanso on descanso.id = descanso_agenda.descanso_id " 
            ."where descanso_agenda.agenda_id  = ".$agendaId."";
    
    $rsm = new ResultSetMapping();
    $rsm->addScalarResult('id', 'id');
    $rsm->addScalarResult('agenda', 'agenda');
    $rsm->addScalarResult('nombre', 'nombre');
    $rsm->addScalarResult('duracion', 'duracion');
    $rsm->addScalarResult('hora_inicio', 'hora_inicio');
    $rsm->addScalarResult('hora_fin', 'hora_fin');
    $query = $em->createNativeQuery($descansosSql, $rsm);
    $descansos = $query->getResult();
    
    if($descansos==null){
        $this->session->getFlashBag()->add("mensaje","No existen descansos configurados para esta agenda");
        $this->session->getFlashBag()->add("tipomensaje","danger");
        $this->session->getFlashBag()->add("url","agenda_panel");
        $this->session->getFlashBag()->add("boton","Agregar descanso");
        return $this->redirectToRoute("cita_panel");
    }
    
    // Citas agendadas en la fecha y agenda seleccionada        
    $citasSql = "select cita.id as id, cita.fecha_cita as fecha, cita.hora_cita as hora, "
            ."usuario.nombre, usuario.apellido, usuario.identificacion as identificacion"
            ." from cita "
            ."inner join usuario on usuario.id = cita.usuario_id " 
            ."where cita.fecha_cita between '".$fecha." 00:00:00' AND '".$fecha." 23:59:59' "
            ."and cita.agenda_id = ".$agendaId."";

    $rsm = new ResultSetMapping();
    $rsm->addScalarResult('id', 'id');
    $rsm->addScalarResult('fecha', 'fecha');
    $rsm->addScalarResult('hora', 'hora');
    $rsm->addScalarResult('nombre', 'nombre');
    $rsm->addScalarResult('apellido', 'apellido');
    $rsm->addScalarResult('identificacion', 'identificacion');
    $query = $em->createNativeQuery($citasSql, $rsm);
    $citasAgendadas = $query->getResult();
    
    // Inicia el ciclo de creacion de las citas segun los parametros de Horarios, Citas agendadas y descansos       
    $citas = array();
    $cita = array();

    for ($h = 1; $h < count($horarios); $h++) {
      if($horarios[$h]["fecha"]===$fecha && $horarios[$h]["festivo"]==1){
        $this->session->getFlashBag()->add("mensaje","La fecha seleccionada esta parametrisada como festivo.");
        $this->session->getFlashBag()->add("tipomensaje","danger");
        return $this->redirectToRoute("cita_panel");
      }else if($horarios[$h]["festivo"]==1){
        $dia = CitaController::getDia($fecha);
        if($horarios[$h]["dia"]===$dia){
          $this->session->getFlashBag()->add("mensaje","La fecha seleccionada esta parametrisada como festivo.");
          $this->session->getFlashBag()->add("tipomensaje","danger");
          return $this->redirectToRoute("cita_panel");
        }
      }else{
        if($horarios[$h]["fecha"]===$fecha){
            $horaInicio = $horarios[$h]["inicio"];
            $horFin = $horarios[$h]["fin"];
            $duracion = $horarios[$h]["duracion"];
        }else{
            $dia = CitaController::getDia($fecha);
            if($horarios[$h]["dia"]===$dia){
              $horaInicio = $horarios[$h]["inicio"];
              $horaFin = $horarios[$h]["fin"];
              $duracion = $horarios[$h]["duracion"];

              while ($horaInicio < $horaFin){
                for ($c = 1; $c <= count($citasAgendadas); $c++) {
                    $horaCita = new \DateTime($citasAgendadas[$c]['hora']);
                    $horaCita = $horaCita->format('H:i');
                    if($horaInicio===$horaCita){
                        array_push($citas, $citasAgendadas[$c]);
                    }
                }
                $cita = CitaController::pushCita($duracion, $horaInicio, $fecha, $agendaId);
                array_push($citas, $cita);

                $horaInicio = new \DateTime($horaInicio);
                list($hora, $min, $seg) = explode(':',$duracion);
                if($hora != '00'){
                    $horaInicio = $horaInicio->modify('+'.$hora.' hour');
                }
                if($min != '00'){
                    $horaInicio = $horaInicio->modify('+'.$min.' minute');
                }
                $horaInicio = $horaInicio->format('H:i');                
              } 
            }
        }
      }
    }
    return $this->render("Cita/cita_list.html.twig", array(
        "citas" => $citas,
        "agendaId" => $agendaId
    ));
  }


  public function getDia($fecha) {    
    $dias = array('','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
    $dia = $dias[date('N', strtotime($fecha))];
    return $dia;
  }

  public function pushCita($duracion, $horaInicio, $fecha, $agendaId) {
    $cita['id'] = '0';
    $cita['agenda'] = $agendaId;
    $cita['fecha'] = $fecha;
    $cita['hora'] = $horaInicio;
    $cita['nombre'] = '' ;
    $cita['estado'] = 'Disponible';

    return $cita;
  }

public function new(Request $request) {
    $agendaId = $request->get('agendaId');
    $personaId = $request->get('personaId');
    $duracionId = $request->get('duracionId');
    $fechaCita = $request->get('fechaCita');
    $horaCita = $request->get('horaCita');
    
    $cita = new Cita();
    $em = $this->getDoctrine()->getManager();
    $cita->setFechaCita(new \DateTime($fechaCita));
    $cita->setHoraCita(new \DateTime($horaCita));

    $agenda = new Agenda();
    $agenda = $em->getRepository(Agenda::class)->find($request->get('agendaId'));
    $cita->setAgenda($agenda);

    $duracion = new Duracion();
    $duracion = $em->getRepository(Duracion::class)->find($request->get('duracionId'));
    $cita->setDuracion($duracion);

    $usuario = new Usuario();
    $usuario = $em->getRepository(Usuario::class)->findOneBy(array("identificacion"=>$personaId));
    $cita->setUsuario($usuario);

    $cita->setFechaRegistro(new \DateTime());
    
    $em->persist($cita);
    $flush = $em->flush();

    if($flush==null){
        $mensaje = "Cita creada correctamente.";
    }else{
        $mensaje = "La cita no se ha creado, porque la informacion registrada contiene errores.";
    }
    $this->session->getFlashBag()->add("mensaje",$mensaje);
    return $this->redirectToRoute("cita_list", array(
      "agendaId" => $request->get('agendaId')
    ));  
  }
}
