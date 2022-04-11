<?php

namespace App\Form;

use App\Entity\{Highlight, Milestone, Project};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, DateType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class HighlightEditType extends AbstractType
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
            ->add('date', DateType::class, [
                'label' => 'Date',
                'required' => true,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'col-2 col-form-label',
                )
            ])
            ->add('description', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('milestone', EntityType::class, [
                'label' => 'Milestone',
                'class' => Milestone::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('project', EntityType::class, [
                'label' => 'Project',
                'class' => Project::class,
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Change portfolio information',
                'attr'   =>  array(
                    'class'   => 'btn btn-primary my-3',
                )
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Highlight::class,
        ]);
    }
}
