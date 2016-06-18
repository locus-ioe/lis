<?php

namespace AppBundle\Form\Type;

// Symfony component
use Symfony\Component\OptionsResolver\OptionsResolver;
// Symfony form
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FinanceType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    if ($options['forupdate']) $submitlabel = " Update";
    else $submitlabel = " Save";

    $builder
    ->add('date', DateType::class, array(
      'widget' => 'single_text',
      'attr' => array(
        'placeholder' => "Transaction Date"
      )
    ))
    ->add('billNumber', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Bill Number'
      ),
      'disabled' => $options['forupdate'],
    ))
    ->add('amount', MoneyType::class, array(
      'currency' => 'INR',
      'grouping' => true,
      'attr' => array(
        'placeholder' => 'Amount'
      )
    ))
    ->add('remarks', TextType::class, array(
      'attr' => array(
        'placeholder' => 'Remarks'
      )
    ))
    ->add('direction', ChoiceType::class, array(
      'choices' => array(
        'Income' => 'in',
        'Expense' => 'out',
      ),
      'placeholder' => 'Cash-Flow',
      'choices_as_values' => true,
    ))
    ->add('institution', EntityType::class, array(
      'class' => 'AppBundle:Institution',
      'choice_label' => 'name',
      'placeholder' => 'Collaborator',
      'multiple' => false,
    ))
    ->add('event', EntityType::class, array(
      'class' => 'AppBundle:Event',
      'choice_label' => 'title',
      'placeholder' => 'Event',
      'multiple' => false,
    ))
    ->add('receiver', EntityType::class, array(
      'class' => 'AppBundle:Member',
      'choice_label' => 'username',
      'placeholder' => 'Receiver',
      'multiple' => false,
    ))
    ->add('save', SubmitType::class, array(
      'label' => $submitlabel
    ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array('data_class' =>'AppBundle\Entity\Finance',));
    $resolver->setRequired(array('forupdate'));
  }
}
