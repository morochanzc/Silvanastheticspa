<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use App\Entity\Usuario;
use App\Entity\Rol;
use App\Entity\TipoIdentificacion;


class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, ["required"=>"required",'label' => 'Usuario','attr'=>array('class'=>'form-control')])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'invalid_message' => 'Las dos contraseñas deben coincidir',
                'options' => array('attr' => array('class' => 'form-control')),
                'required' => true,
                'first_options'  => array('label' => 'Contraseña'),
                'second_options' => array('label' => 'Repita Contraseña')])
            ->add('identificacion', TextType::class, array('label' => 'Identificación',"required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('nombre', TextType::class, array("required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('apellido', TextType::class, array("required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('direccion', TextType::class, array('label' => 'Dirección',"required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('telefono', TextType::class, array("required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('celular', TextType::class, array("required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('correo', EmailType::class, array("required"=>"required",'attr'=>array('class'=>'form-control')))
            ->add('tipoidentificacion', EntityType::class, [
                'label' => 'Tipo de identificación',
                'class' => TipoIdentificacion::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione...',
                "required"=>"required",
                'attr'=>array('class'=>'form-control')
            ])
            ->add('rol', EntityType::class, [
                'label' => 'Perfil',
                'class' => Rol::class,
                'choice_label' => 'descripcion',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('r')
                            ->where('r.id != ?1')
                            ->setParameter(1, 1); 
                },
                'placeholder' => 'Seleccione...',
                "required"=>"required",
                'attr'=>array('class'=>'form-control')
            ])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
