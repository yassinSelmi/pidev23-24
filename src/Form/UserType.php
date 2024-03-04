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
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;



class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('num', TextType::class)
            ->add('cin', TextType::class)
            ->add('profileImage', FileType::class, [
                'label' => 'Image de profil',
                'mapped' => false, // ne pas mapper ce champ à une propriété de l'entité User
                'required' => false, // rendre ce champ facultatif
              ]) 
              
            ->add('roles', ChoiceType::class, [
                'label' => 'ROLES',
                'choices' => [
                    'Client' => 'ROLE_USER',
                   
                    'Admin' => 'ROLE_ADMIN',
                   
                ],
                'multiple' => true, // Permettre la sélection multiple
                'expanded' => true, // Afficher sous forme de cases à cocher
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add("recaptcha", ReCaptchaType::class);
            

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
