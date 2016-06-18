<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StallType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('number', IntegerType::class, array(
          'attr' => array(
            'placeholder' => 'Stall Number',
          )
        ))
        ->add('size', ChoiceType::class, array(
          'choices' => array(
            'Small (2m*2m)' => 's',
            'Medium (3m*2m)' => 'm',
            'Large (3m*3m)' => 'l',
          ),
          'placeholder' => 'Size',
          'choices_as_values' => true,
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
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Stall',));
        $resolver->setRequired(array('forupdate'));
    }
}
