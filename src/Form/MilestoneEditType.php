<?php

namespace App\Form;

use App\Entity\Milestone;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, NumberType, ChoiceType, SubmitType};

class MilestoneEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('value', NumberType::class, [
                'label' => 'Value',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('isMandatory', ChoiceType::class, [
                'choices'  => [
                    'Yes' => 1,
                    'No' => 0,
                ],
                'label' => 'Mandatory ?',
                'required' => true,
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Change milestone information',
                'attr'   =>  array(
                    'class'   => 'btn btn-primary my-3',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Milestone::class,
        ]);
    }
}
