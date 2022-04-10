<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Team;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\{Length, NotBlank};
use Symfony\Component\Form\Extension\Core\Type\{TextType, EmailType, ChoiceType, SubmitType};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email address',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'User administration permissions',
                'choices' => ['Administrator' => 'ROLE_ADMIN'],
                'expanded' => true,
                'multiple' => true,
            ])
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'required' => true,
                'attr'   =>  array(
                    'class'   => 'form-control',
                )
            ])
            ->add('team', EntityType::class, [
                'label' => 'Team',
                'class' => Team::class,
                'choice_label' => 'name',
                'required' => true,
            ])
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
            'data_class' => User::class,
        ]);
    }
}
