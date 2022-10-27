<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Name', TextType::class, [
                'label' =>'Prénom et Nom de famille:',
                'required' => true,
                'constraints' => new Length ([
                    'min' => 6,
                    'max' => 60,
                ]),
                'attr' =>[
                    'placeholder' => "Merci de saisir le Prénom et le Nom de l'utilisateur"
                ]
            ])

            ->add('email', EmailType::class, [
                'label' =>'Email :',
                'required' => true,
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 60, 
                ]),
                'attr' => [
                    'placeholder' => "Merci de saisir l'adresse email de l'utilisateur"
                ]
            ])
            
            ->add('phone_number', TelType::class, [
                'label' =>'Numéro de téléphone portable :',
                'required' => true,
                'attr' => [
                    'placeholder' => "Merci de saisir le numéro de téléphone portable de l'utilisateur."
                ]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => "J'accepte de ne pas divulger les informations personnelles concernant mon utilisateur selon la RGPD.",
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new password',
                           'placeholder' => "Merci de copier/coller le mot de passe générer aléatoirement ci dessous" 
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrer le mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 255,
                    ]),
                ],
            ])

            ->add('actif', ChoiceType::class, [
                'label' => 'Utilisateur Actif :',
                'label_attr' => ['class' => 'switch-custom actif-btn'],
                'required' => true,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
            ])

            ->add('role', EntityType::class, [
                'expanded' => true,
                'class' => Role::class,
                'multiple' => false,
                'choice_label' => 'name',
                'placeholder' => 'Selectionner le type de rôle',
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Valider"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
