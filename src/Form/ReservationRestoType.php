<?php

namespace App\Form;

use App\Entity\ReservationResto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class ReservationRestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('idClient', null, [
            'attr' => ['class' => 'form-control'] 
        ])
        ->add('nomClient', null, [
            'attr' => ['class' => 'form-control'] 
        ])
        ->add('numeroClient', null, [
            'attr' => ['class' => 'form-control']
        ])
        ->add('nbrPersonnes', null, [
            'attr' => ['class' => 'form-control'] 
        ])
        ->add('dateReserv', DateType::class, [
            'widget' => 'single_text',
            'attr' => [
                'class' => 'datepicker', // Ajouter une classe pour identifier le champ de date dans le JS
                'autocomplete' => 'off' // Désactiver l'autocomplétion du navigateur
            ]
        ])
        ->add('nomRestaurant', null, [
            'attr' => ['class' => 'form-control'] 
        ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationResto::class,
        ]);
    }
}
