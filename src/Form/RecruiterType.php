<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Recruiter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class RecruiterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];

        $builder
            ->add('enterpriseName', TextType::class, [
                'label' => 'Nom de l\'entreprise',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'enterpriseName', 'placeholder' => 'Nom de l\'entreprise', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('street', TextType::class, [
                'label' => 'Rue',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'street', 'placeholder' => 'Rue', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('postalCode', TextType::class, [
                'label' => 'Code postal',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'postalCode', 'placeholder' => 'Code postal', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d+$/',
                        'message' => 'Le code postal doit contenir uniquement des chiffres.',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'Le code postal doit contenir exactement {{ limit }} chiffres.',
                    ]),
                ],
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'city', 'placeholder' => 'Ville', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/',
                        'message' => 'La ville doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('region', TextType::class, [
                'label' => 'Région',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'region', 'placeholder' => 'Région', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[A-Za-zÀ-ÖØ-öø-ÿ\s]+$/',
                        'message' => 'La région doit contenir uniquement des lettres.',
                    ]),
                ],
            ])
            ->add('logoName', FileType::class, [
                'label' => 'Insérez votre logo',
                'label_attr' => ['class' => 'label-file'],
                'attr' => [
                    'class' => 'input-file', 'id' => 'input-file', 'required' => 'required',
                    'accept' => '.png, .jpg',
                ],
                'row_attr' => [
                    'class' => 'upload-container',
                ],
            ])     
            ->add('user', HiddenType::class, [
                'data' => $user->getId(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recruiter::class,
            'user' => null,
        ]);
    }
}
