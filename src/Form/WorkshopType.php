<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Job;
use App\Entity\Sector;
use App\Entity\UniversityRoom;
use App\Entity\Workshop;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkshopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('sector', EntityType::class, [
                'class' => Sector::class
            ])
            ->add('edition', EntityType::class, [
                'class' => Edition::class
            ])
            ->add('jobs', EntityType::class, [
                'class' => Job::class,
                'multiple' => true,
                'expanded' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Workshop::class,
        ]);
    }
}
