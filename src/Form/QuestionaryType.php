<?php

namespace App\Form;

use App\Entity\Edition;
use App\Entity\Questionary;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required'   => true,
                'label' => 'Nom du questionnaire'
            ])
            ->add('edition',EntityType::class, array(
                'class' => Edition::class,
                'placeholder' => 'Choisir une édition',
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Questionary::class,
        ]);
    }
}
