<?php

namespace App\Form;

use App\Entity\ReservationResto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ReservationRestoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

        ->add('nomClient')
                            
        ->add('numeroClient')


        ->add('nbrPersonnes', null, [
            'attr' => ['class' => 'form-control'] 
        ])
        




// Modifier le champ pour utiliser DateTimeType
->add('dateReserv', DateTimeType::class, [
    'data' => new \DateTime(), // Utiliser la date et l'heure actuelle du serveur comme valeur par défaut
    'format' => 'yyyy-MM-dd HH:mm', // Format de date avec heure et minute
    'html5' => false, // Disable HTML5 to allow custom format
    'attr' => [
        'class' => 'datepicker', // Ajouter une classe pour identifier le champ de date dans le JS
        'autocomplete' => 'off', // Désactiver l'autocomplétion du navigateur
        'min' => (new \DateTime())->format('Y-m-d') // Bloquer les dates précédentes
    ]
])






        ->add('nomRestaurant', null, [
            'attr' => ['class' => 'form-control'],
            'label' => 'Identifiant restaurant'
        ]);
    
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReservationResto::class,
        ]);
    }
}
