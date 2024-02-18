<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Candidate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class CandidateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['user'];

        $builder
            ->add('cvName', FileType::class, [
                'label' => 'Insérez votre CV (PDF uniquement)',
                'label_attr' => ['class' => 'label-file'],
                'attr' => [
                    'class' => 'input-file', 'id' => 'input-file', 'required' => 'required',
                    'accept' => '.pdf',
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
            'data_class' => Candidate::class,
            'user' => null,
        ]);
    }
}