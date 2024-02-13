<?php

namespace App\Form;

use App\Entity\Recruiter;
use App\Entity\JobPosting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JobPostingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'annonce',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'jobPostingTitle', 'placeholder' => 'Titre de l\'annonce', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('hour', TextType::class, [
                'label' => 'Horaire',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'jobPostingHour', 'placeholder' => 'Horaire', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('salary', TextType::class, [
                'label' => 'Salaire',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input', 'id' => 'salary', 'placeholder' => 'Salaire', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'annonce',
                'label_attr' => ['class' => 'label'],
                'attr' => ['class' => 'form-input form-input-textarea', 'id' => 'jobPostingDescription', 'placeholder' => 'Description de l\'annonce', 'required' => 'required'],
                'row_attr' => ['class' => 'form-div'],
            ])
            ->add('recruiterId', HiddenType::class, [
                'data' => $user->getId(),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobPosting::class,
            'user' => null,
        ]);
    }
}
