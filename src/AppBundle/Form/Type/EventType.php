<?php

namespace AppBundle\Form\Type;

use Symfony\Component\OptionsResolver\OptionsResolver;

// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['forupdate']) $submitlabel = "Save";
        else $submitlabel = "Add";

        $builder
        ->add('title', TextType::class)
        ->add('datetime', DateTimeType::class, array('widget' => 'single_text'))
        ->add('venue', TextType::class)
        ->add('type', TextType::class)
        ->add('description', TextType::class)
        ->add('report', TextType::class)
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Event',));
        $resolver->setRequired(array('forupdate'));
    }
}
