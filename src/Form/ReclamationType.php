<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use App\Repository\SupportRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReclamationType extends AbstractType
{

    private $SupportRepository;
    public  function __construct(SupportRepository $SupportRepository)
    {
        $this->SupportRepository = $SupportRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('contenu')


            
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'datepicker', // Ajouter une classe pour identifier le champ de date dans le JS
                    'autocomplete' => 'off' // Désactiver l'autocomplétion du navigateur
                ]
            ])
            ->add('categorie', ChoiceType::class, [
                'choices' => [
                    'Proposition' => 'Proposition',
                    'Question' => 'Question',
                ],
                'expanded' => true,
                'multiple' => false,
                'choice_attr' => [
                    'Proposition' => ['style' => 'margin-right: 10px;'], 
                ],
            ])
            
            

            ->add('support', ChoiceType::class, [
                'multiple' => false,
                'choices' => $this->SupportRepository->createQueryBuilder('u')->select("(u.nomResponsable) as nomResponsable")->getQuery()->getResult(),
                'choice_label' => function ($choice) {
                    return $choice;
                },
                'attr' => [
                    'class' => 'form-select'
                ]
            ])
            





        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}
