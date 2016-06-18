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

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('title', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Title',
          )
        ))
        ->add('type', ChoiceType::class, array(
          'choices' => array(
            'Electrical' => 'electrical',
            'Hardware' => 'hardware',
            'Open' => 'open',
            'Software' => 'software',
          ),
          'placeholder' => 'Type',
          'choices_as_values' => true,
        ))
        ->add('description', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Description',
          )
        ))
        ->add('detail', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Detail',
          )
        ))
        ->add('theme', EntityType::class, array(
          'class' => 'AppBundle:Theme',
          'choice_label' => 'slug',
          'placeholder' => 'Theme',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('stall', EntityType::class, array(
          'class' => 'AppBundle:Stall',
          'choice_label' => 'id',
          'placeholder' => 'Stall',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('events', EntityType::class, array(
          'class' => 'AppBundle:Event',
          'choice_label' => 'slug',
          'placeholder' => 'Events',
          'multiple' => true,
          'expanded' => false,
        ))
        ->add('members', EntityType::class, array(
          'class' => 'AppBundle:Member',
          'choice_label' => 'username',
          'placeholder' => 'Members',
          'multiple' => true,
          'expanded' => false,
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Project',));
        $resolver->setRequired(array('forupdate'));
    }
}
