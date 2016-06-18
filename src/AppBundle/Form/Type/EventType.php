<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class EventType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    if ($options['forupdate']) $submitlabel = " Update";
    else $submitlabel = " Save";

    $builder
    ->add('title', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Event Title'
      )
    ))
    ->add('datetime', DateTimeType::class, array(
      'widget' => 'single_text',
      'attr' => array(
        'placeholder' => 'Event Date'
      )
    ))
    ->add('venue', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Event Venue'
      )
    ))
    ->add('type', ChoiceType::class, array(
      'choices' => array(
        'Competition' => 'competition',
        'Meet-Up' => 'meet-up',
        'Training' => 'training',
        'Workshop' => 'workshop',
      ),
      'placeholder' => 'Type',
      'choices_as_values' => true,
    ))
    ->add('description', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Event Description'
      )
    ))
    ->add('report', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Event Report'
      )
    ))
    ->add('owner', EntityType::class, array(
      'class' => 'AppBundle:Member',
      'choice_label' => 'username',
      'placeholder' => 'Event Owner',
      'multiple' => false,
      'expanded' => false,
    ))
    ->add('exhibition', EntityType::class, array(
      'class' => 'AppBundle:Exhibition',
      'choice_label' => 'slug',
      'placeholder' => 'Event Exhibition',
      'multiple' => false,
      'expanded' => false,
    ))
    ->add('organizers', EntityType::class, array(
      'class' => 'AppBundle:Member',
      'choice_label' => 'username',
      'placeholder' => 'Event Organizers',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('collaborators', EntityType::class, array(
      'class' => 'AppBundle:Institution',
      'choice_label' => 'name',
      'placeholder' => 'Event Collaborators',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('attendees', EntityType::class, array(
      'class' => 'AppBundle:Member',
      'choice_label' => 'username',
      'placeholder' => 'Event Attendees',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('volunteers', EntityType::class, array(
      'class' => 'AppBundle:Member',
      'choice_label' => 'username',
      'placeholder' => 'Event Volunteers',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('stalls', EntityType::class, array(
      'class' => 'AppBundle:Stall',
      'choice_label' => 'id',
      'placeholder' => 'Event Stalls',
      'multiple' => true,
      'expanded' => false,
    ))
    ->add('save', SubmitType::class, array('label' => $submitlabel));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Event',));
    $resolver->setRequired(array('forupdate'));
  }
}
