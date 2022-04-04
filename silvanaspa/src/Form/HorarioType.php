<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Horario;
use App\Entity\Agenda;

class HorarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('agenda', EntityType::class, array(
                'class' => Agenda::class,
                'choice_label' => 'nombre',
                'attr'=>array('class'=>'form-control')
            ))
            ->add('fecha', DateType::class, array(
                "required"=>false,
                'widget' => 'single_text',
                'attr'=>array('class'=>'form-control')
            ))
            ->add('festivo', ChoiceType::class, array(
                "required"=>false,
                'choices'  => array(
                    '' => '',
                    'Si' => true,
                    'No' => false),
                'attr'=>array('class'=>'form-control')
            ))
            ->add('dia', ChoiceType::class, array(
                "required"=>false,
                'choices'  => array(
                    '' => '',
                    'Domingo' => 'Domingo',
                    'Lunes' => 'Lunes',
                    'Martes' => 'Martes',
                    'Miercoles' => 'Miercoles',
                    'Jueves' => 'Jueves',
                    'Viernes' => 'Viernes',
                    'Sabado' => 'Sabado'),
                'attr'=>array('class'=>'form-control')
            ))
            ->add('horaInicio', TextType::class, array(
                'label' => 'Hora Inicio',
                "required"=>false,
                'attr'=>array('class'=>'form-control timepicker-default')
            ))
            ->add('horaFin', TextType::class, array(
                'label' => 'Hora Fin',
                "required"=>false,
                'attr'=>array('class'=>'form-control timepicker-default')
            ))
            ->add('duracion', TextType::class, array(
                'label' => 'Duación',
                "required"=>false,
                'attr'=>array('class'=>'form-control timepicker-default')
            ))
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horario::class,
        ]);
    }
}
