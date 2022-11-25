<?php

namespace App\Form;

use App\Entity\Franchise;
use App\Entity\FranchisePermission;
use App\Entity\Permission;
use App\Entity\Structure;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => 'Nom :',
                'attr' =>[
                    'placeholder' => "Veuillez saisir le nom de la structure"
                    ]
            ])

            ->add('Adress', TextType::class, [
                'label' => 'Adresse : ',
                'attr' => [
                    'placeholder' => 'Veuillez saisir l\'adresse de la structure'
                ]
            ])

            ->add('CodePostal', TextType::class, [
                'label' => 'Code Postal',
                'attr' => [
                    'placeholder' => 'Saisissez le code Postal',
                ],
                'constraints' => new Length ([
                    'min' => 1,
                    'max' => 5,
                ]),
            ])

            ->add('City', TextType:: class, [
                'label' => 'Ville',
                'attr' => [
                    'placeholder' => 'Saisissez la ville de la structure'
                ]
            ])

            ->add('PhoneNumber', TextType:: class, [
                'label' => 'Numéro de Téléphone',
                'attr'=> [
                    'placeholder' => 'Entrer le numéro de téléphone de la structure'
                 ]
    
            ])

            ->add('Description', TextType:: class, [
                'label' => 'Description',
                'attr' => [
                    'placeholder'=> 'Veuillez indiquer une description ou des informations concernant la structure'
                ]
            ])

            ->add('Actif', ChoiceType::class, [
                'label' => "Structure Actif :",
                'label_attr' => ['class' => 'switch-custom actif-btn'],
                'required' => true,
                'choices'  => [
                    'Oui' => true,
                    'Non' => false,
                ],
            ])

            ->add('User', EntityType::class, [
                'class' => User:: class,
                'choice_label' =>'Name',
                'placeholder' => "Nom de l'utilisateur ",
                'label' => 'Nom : ',
                'multiple' => false,
            ])
// voir collectionType ??
            ->add('FranchisePermission', EntityType::class, [
                'class' => FranchisePermission:: class,
                'choice_label' =>'franchise',
                'placeholder' => 'Franchise référente : ',
                'label' => 'Franchise : ',
                'multiple' => false,
                
            ])
  
            ->add('permissions', EntityType::class, [
                'class' => Permission:: class,
                'choice_label' =>'Name',
                'placeholder' => "permissions ",
                'label' => 'Permission de la structure:' ,
                'multiple' => true,
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('p')
                      ->orderBy('p.Name', 'ASC');
                    }, 'attr' => [
                       'class' => 'form-select'
                  ],
                  'expanded' => true,
                  'constraints' => new NotBlank(['message' => 'veuillez choisir une ou plusieurs permissions ']),
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Valider"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}
