<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EquipEditarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
        ->add('nom', TextType::class)
        ->add('cicle', TextType::class)
        ->add('curs', TextType::class)
        ->add('imatge',FileType::class, ['mapped' => false,'required' => false])
        ->add('nota', NumberType::class)
        ->add('save', SubmitType::class, array('label' => 'Enviar'));
    }
}
?>