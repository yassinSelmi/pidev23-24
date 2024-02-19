<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Client' => 'client',
                    'Responsable Evenement' => 'responsable_evenement',
                    'Responsable Hotel' => 'responsable_hotel',
                    'Responsable Musee' => 'responsable_musee',
                    'Admin' => 'admin',
                    'Support' => 'support',
                    'Responsable Restaurant' => 'responsable_restaurant',
                ],
                'empty_data' => '',
                'constraints' => [
                    new NotBlank(),
                ],
            ])     
            ->add('password', PasswordType::class)

            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('num', TextType::class)
            ->add('cin', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
