<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InstitutionType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    if ($options['forupdate']) $submitlabel = " Update";
    else $submitlabel = " Save";

    $builder
    ->add('name', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Name'
      )
    ))
    ->add('address', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Address'
      )
    ))
    ->add('contact', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Contact'
      )
    ))
    ->add('email', EmailType::class, array(
      'attr' => array(
        'placeholder' => 'Email'
      )
    ))
    ->add('logo', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Logo'
      )
    ))
    ->add('stalls', EntityType::class, array(
      'class' => 'AppBundle:Stall',
      'choice_label' => 'slug',
      'placeholder' => 'Stall',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('save', SubmitType::class, array('label' => $submitlabel));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Institution',));
    $resolver->setRequired(array('forupdate'));
  }
}
