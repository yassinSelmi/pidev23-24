<?php

namespace App\Form;

use App\Entity\Support;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SupportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomResponsable')
            ->add('numTel')
            ->add('domaine', ChoiceType::class, array(
                'choices' => array(
                    'Hotel' => 'Hotel',
                    'Evenement' => 'Evenement',
                    'Restaurant' => 'Restaurant',
                ),
                'attr' => array(
                    'class' => 'form-select'
                )
            ))
            ->add('image', FileType::class, [
                'data_class' => null,
                'required' => false,
                'label' => 'Choisir une image',
                'attr' => [
                    'class' => 'form-select' // Ajoutez ici le nom de votre classe CSS
                ]
            ])
                    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Support::class,
        ]);
    }
}
