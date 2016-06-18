<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class LetterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('date', DateType::class, array(
          'widget' => 'single_text',
          'attr' => array(
            'placeholder' => 'Published Date'
          )
        ))
        ->add('regNo', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Registration Number'
          ),
          'disabled' => $options['forupdate'],
        ))
        ->add('salutation', EntityType::class, array(
          'class' => 'AppBundle:Member',
          'choice_label' => 'username',
          'placeholder' => 'Salutation',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('subject', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Subject'
          )
        ))
        ->add('content', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Content'
          )
        ))
        ->add('publisher', EntityType::class, array(
          'class' => 'AppBundle:Member',
          'choice_label' => 'username',
          'placeholder' => 'Publisher',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Letter',));
        $resolver->setRequired(array('forupdate'));
    }
}
