<?php

namespace App\Form;

use App\Entity\Logement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Maison d\'hôte' => 'Maison d\'hôte',
                    'Villa' => 'Villa',
                    'Appartement' => 'Appartement',
                ],
            ])
            ->add('emplacement', TextType::class, [
                'label' => 'Emplacement (Format: Numéro Rue, nom rue, Ville): ',
            ])
            ->add('description')
            ->add('capacite')
            ->add('nbrchambre')
            ->add('nbrsdb')
            ->add('prix')
            
            ->add('image', FileType::class,array('data_class' => null,'required' => false), ['label' => true,] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logement::class,
        ]);
    }
}
