<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MeetingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('datetime', DateTimeType::class, array(
          'widget' => 'single_text',
          'attr' => array(
            'placeholder' => 'Date-Time'
          )
        ))
        ->add('venue', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Venue'
          )
        ))
        ->add('agenda', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Agenda'
          )
        ))
        ->add('minute', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Minute'
          )
        ))
        ->add('attendees', EntityType::class, array(
          'class' => 'AppBundle:Member',
          'choice_label' => 'username',
          'placeholder' => 'Attendees',
          'multiple' => true,
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Meeting',));
        $resolver->setRequired(array('forupdate'));
    }
}
