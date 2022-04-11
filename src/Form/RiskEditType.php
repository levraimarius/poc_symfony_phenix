<?php

namespace App\Form;

use App\Entity\{Risk, Project};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, DateType, ChoiceType, NumberType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RiskEditType extends AbstractType
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
            ->add('identificationDate', DateType::class, [
                'label' => 'Identification date',
                'required' => true,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('resolutionDate', DateType::class, [
                'label' => 'Resolution date',
                'required' => true,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('severity', ChoiceType::class, [
                'choices'  => [
                    'Low' => "low",
                    'Medium' => "medium",
                    'High' => "high",
                ],
                'label' => 'Severity',
                'required' => true,
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('probability', NumberType::class, [
                'label' => 'Probability',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('project', EntityType::class, [
                'label' => 'Project',
                'class' => Project::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Change risk information',
                'attr'   =>  array(
                    'class'   => 'btn btn-primary my-3',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Risk::class,
        ]);
    }
}
