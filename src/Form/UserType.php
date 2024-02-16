<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['show_role_field']) {
            $builder->add('roles', ChoiceType::class, [
                'label' => 'Rôles',
                'label_attr' => ['class' => 'label'],
                'choices' => [
                    'Candidat' => 'ROLE_CANDIDATE',
                    'Recruteur' => 'ROLE_RECRUITER',
                ],
                'expanded' => false,
                'multiple' => true,
                'choice_value' => function ($choice) {
                    return $choice;
                },
                'choice_attr' => function ($choice, $key, $value) {
                    return ['class' => 'form-radio-input'];
                },
                'attr' => ['class' => 'form-radio', 'id' => 'role', 'required' => 'required'],
            ]);
        };

        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'email', 'placeholder' => 'Email', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Mot de Passe',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'password', 'placeholder' => 'Mot de Passe', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'lastName', 'placeholder' => 'Nom', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'firstName', 'placeholder' => 'Prénom', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'show_role_field' => true,
        ]);

        $resolver->setAllowedTypes('show_role_field', 'bool');
    }
}