<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomResto')
            ->add('adresseResto')
            ->add('numeroResto')
            ->add('specialtie', ChoiceType::class, array(
                'choices' => array(
                    'Francaise' => 'Francaise',
                    'Tunisienne' => 'Tunisienne',
                    'Italienne' => 'Italienne',
                    'Americaine' => 'Americaine',
                    'Syrien' => 'Syrien',
                ),
                'attr' => array(
                    'class' => 'form-select' // Ajoutez la classe Bootstrap form-select
                )
            ))
            ->add('image', FileType::class,array('data_class' => null,'required' => false), ['label' => true,] )
            ->add('nombreFourchette')
            ->add('FourchetteDePrix')
            ->add('heureOuverture', ChoiceType::class, array(
                'choices' => array(
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                    '16' => '16',
                    '17' => '17',
                    '18' => '18',
                    '19' => '19',
                    '20' => '20',
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '00' => '00',
                ),
                'attr' => array(
                    'class' => 'form-select' // Ajoutez la classe Bootstrap form-select
                )
            ))
            

            ->add('heureFermeture', ChoiceType::class, array(
                'choices' => array(
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                    '16' => '16',
                    '17' => '17',
                    '18' => '18',
                    '19' => '19',
                    '20' => '20',
                    '21' => '21',
                    '22' => '22',
                    '23' => '23',
                    '00' => '00',
                ),
                'attr' => array(
                    'class' => 'form-select' // Ajoutez la classe Bootstrap form-select
                )
            ))
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
