<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('datedebut', DateType::class, [
            'widget' => 'single_text',
            'data' => new \DateTime(), // Utiliser la date actuelle du serveur comme valeur par défaut
            'format' => 'yyyy-MM-dd', // Format de date
            'attr' => [
                'class' => 'datepicker', // Ajouter une classe pour identifier le champ de date dans le JS
                'autocomplete' => 'off', // Désactiver l'autocomplétion du navigateur
                'min' => (new \DateTime())->format('Y-m-d') // Bloquer les dates précédentes
            ],
            'invalid_message' => 'La date est déjà réservée.'
        ])
        ->add('datefin', DateType::class, [
            'widget' => 'single_text',
            'data' => new \DateTime(), // Utiliser la date actuelle du serveur comme valeur par défaut
            'format' => 'yyyy-MM-dd', // Format de date
            'attr' => [
                'class' => 'datepicker', // Ajouter une classe pour identifier le champ de date dans le JS
                'autocomplete' => 'off', // Désactiver l'autocomplétion du navigateur
                'min' => (new \DateTime())->format('Y-m-d') // Bloquer les dates précédentes
            ],
            'invalid_message' => 'La date est déjà réservée.'
        ])
        
            
            ->add('nbrinvite')


            ->add('statut', ChoiceType::class, [
                'choices' => [
                    'En attente' => 'en_attente',
                    'confirme' => 'confirme',
                ],
                'placeholder' => 'Sélectionnez le statut',
                'required' => true,
            ])

            ->add('couttotale')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}