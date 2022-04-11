<?php

namespace App\Form;

use App\Entity\{Portfolio, User};
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\{TextType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PortfolioEditType extends AbstractType
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
            ->add('supervisor', EntityType::class, [
                'label' => 'Supervisor',
                'class' => User::class,
                'choice_label' => 'lastName',
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
            'data_class' => Portfolio::class,
        ]);
    }
}
