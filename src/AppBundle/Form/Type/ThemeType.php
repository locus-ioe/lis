<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ThemeType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    if ($options['forupdate']) $submitlabel = " Update";
    else $submitlabel = " Save";

    $builder
    ->add('name', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Name',
      )
    ))
    ->add('exhibition', EntityType::class, array(
      'class' => 'AppBundle:Exhibition',
      'choice_label' => 'slug',
      'placeholder' => 'Exhibition',
      'multiple' => false,
      'expanded' => false,
    ))
    ->add('save', SubmitType::class, array('label' => $submitlabel));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Theme',));
    $resolver->setRequired(array('forupdate'));
  }
}
