<?php

namespace App\Form;

use App\Entity\PossibleAnswer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PossibleAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('answer')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('balise')
            ->add('questions')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PossibleAnswer::class,
        ]);
    }
}
