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

class CommitteeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('member', EntityType::class, array(
          'class' => 'AppBundle:Member',
          'choice_label' => 'username',
          'placeholder' => 'Member',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('post', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Committee Post'
          )
        ))
        ->add('year', DateType::class, array(
          'widget' => 'single_text',
          'attr' => array(
            'placeholder' => 'Committee Year'
          )
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Committee',));
        $resolver->setRequired(array('forupdate'));
    }
}
