<?php

namespace App\Form;

use App\Entity\Reservationhotel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationhotelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomhotel')
            ->add('nomClient')
            ->add('NbPersonne')
            ->add('NbNuit')
            ->add('DateArrive')
            ->add('DateSortie')
            ->add('prix')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservationhotel::class,
        ]);
    }
}
