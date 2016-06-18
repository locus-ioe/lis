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
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      if ($options['forupdate']) $submitlabel = " Update";
      else $submitlabel = " Save";

        $builder
        ->add('firstname', TextType::class, array(
          'attr' => array(
            'placeholder' => 'First Name',
          )
        ))
        ->add('lastname', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Last Name',
          )
        ))
        ->add('username', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Username'
          ),
          'disabled' => $options['forupdate'],
        ))
        ->add('address', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Address',
          )
        ))
        ->add('email', EmailType::class, array(
          'attr' => array(
            'placeholder' => 'E-Mail',
          )
        ))
        ->add('contact', TextType::class, array(
          'attr' => array(
            'placeholder' => 'Cell',
          )
        ))
        ->add('password', PasswordType::class, array(
          'attr' => array(
            'placeholder' => 'Password',
          )
        ))
        ->add('crnPost', TextType::class, array(
          'attr' => array(
            'placeholder' => 'CRN or Post',
          )
        ))
        ->add('institution', EntityType::class, array(
          'class' => 'AppBundle:Institution',
          'choice_label' => 'name',
          'placeholder' => 'Institution',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('privilege', EntityType::class, array(
          'class' => 'AppBundle:Privilege',
          'choice_label' => 'name',
          'placeholder' => 'Privilege',
          'multiple' => false,
          'expanded' => false,
        ))
        ->add('save', SubmitType::class, array('label' => $submitlabel));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Member',));
        $resolver->setRequired(array('forupdate'));
    }
}
