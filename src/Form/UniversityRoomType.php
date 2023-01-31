<?php

namespace App\Form;

use App\Entity\UniversityRoom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UniversityRoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('stage')
            ->add('capacity')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('workshop')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UniversityRoom::class,
        ]);
    }
}
