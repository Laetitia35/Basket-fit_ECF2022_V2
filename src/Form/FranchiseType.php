<?php

namespace App\Form;

use App\Entity\Franchise;
use App\Entity\Permission;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FranchiseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Name', TextType::class, [
                'label' => 'Nom de la Franchise',
                'attr' =>[
                    'placeholder' => "Veuillez saisir le nom de la franchise "
                    ]
            ])

            ->add('Description', TextType::class, [
                'label' => 'Description :',
                'attr' =>[
                    'placeholder' => "Saisissez une description ou des informations sur la franchise "
                ],
                    'required' => true
            ])

            ->add('Logo', FileType::class, [
                'label' => 'Image du logo :',
                'multiple' => false,
                'required' => false
                
            ])

            ->add('Actif', ChoiceType::class, [
                'label' => 'Franchise Active : ',
                'label_attr' => ['class' => 'switch-custom actif-btn'],
                'required' => true,
                'choices' => [
                    'oui' => true,
                    'non' => false,
                ],
            ])

            ->add('User', EntityType::class, [
                'class' => User:: class,
                'choice_label' =>'Name',
                'placeholder' => "Nom du Franchisé ",
                'label' => 'Nom : ',
                'multiple' => false,
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('u')
                      ->orderBy('u.Name', 'ASC');
                    }, 'attr' => [
                       'class' => 'form-select'
                  ],
            ])

            -> add('permissions', EntityType::class, [
                'class' => Permission:: class,
                'multiple' => true,
                'query_builder' => function(EntityRepository $repository) {
                    return $repository->createQueryBuilder('p')
                      ->orderBy('p.Name', 'ASC');
                    }, 'attr' => [
                       'class' => 'form-select'
                  ],
                  'expanded' => true,
                  'constraints' => new NotBlank(['message' => 'veuillez choisir une ou plusieurs permissions'])
            ])

            ->add('submit', SubmitType::class, [
                'label' => "Valider"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Franchise::class,
        ]);
    }
}
