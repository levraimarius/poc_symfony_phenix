<?php

namespace App\Form;

use App\Entity\{Project, Team, Status, Budget, Portfolio};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, TextareaType, NumberType, DateType, ChoiceType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ProjectEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Project name',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('code', NumberType::class, [
                'label' => 'Code',
                'required' => true,
                'attr' => array(
                    'class' => 'form-control',
                )
            ])
            ->add('startedAt', DateType::class, [
                'label' => 'Started at',
                'required' => true,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('endedAt', DateType::class, [
                'label' => 'Ended at',
                'required' => true,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('team', EntityType::class, [
                'label' => 'Team',
                'class' => Team::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('clientTeam', EntityType::class, [
                'label' => 'Client Team',
                'class' => Team::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('status', EntityType::class, [
                'label' => 'Status',
                'class' => Status::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('budget', EntityType::class, [
                'label' => 'Budget',
                'class' => Budget::class,
                'choice_label' => 'initial_value',
                'required' => true,
            ])
            ->add('portfolio', EntityType::class, [
                'label' => 'Portfolio',
                'class' => Portfolio::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('isArchived')
            ->add('submit', SubmitType::class, [
                'label' => 'Change user information',
                'attr'   =>  array(
                    'class'   => 'btn btn-primary my-3',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
