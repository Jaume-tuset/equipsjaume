<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class MembreEditarType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('cognoms', TextType::class)
            ->add('email', TextType::class)
            ->add('dataNaixement', DateType::class, array('years' => range(1920, 2022)))
            ->add('imatgePerfil', FileType::class,  array('mapped' => false, 'required' => false))
            ->add('equip', EntityType::class, array('class' => Equip::class, 'choice_label' => 'nom', ))
            ->add('nota', NumberType::class)
            ->add('save', SubmitType::class, array('label' => 'Enviar'));
        }
}

?>