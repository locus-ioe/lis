<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExhibitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('theme', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Exhibition Theme'
          )
        ))
        ->add('year', DateType::class, array(
          'widget' => 'single_text',
          'attr' => array(
            'placeholder' => 'Exhibition Year (yyyy/mm/dd)'
          )
        ))
        ->add('date', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Exhibition Date'
          )
        ))
        ->add('locationMap', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Exhibition Layout Map'
          )
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Exhibition',));
        $resolver->setRequired(array('forupdate'));
    }
}
