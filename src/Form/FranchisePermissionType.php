<?php

namespace App\Form;

use App\Entity\Franchise;
use App\Entity\FranchisePermission;
use App\Entity\Permission;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class FranchisePermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Actif',  ChoiceType::class, [
                'label' => 'Permissions Actif :',
                'label_attr' => ['class' => 'switch-custom actif-btn'],
                'required' => true,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
            ])

            ->add('franchise',EntityType::class, [
                'class' => Franchise:: class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('F')
                    ->orderBy('F.Name', 'ASC');
                },
                'choice_label' =>'Name',
                'placeholder' => 'Franchise référente : ',
                'label' => 'Franchise : ',
                'multiple' => false,
                
            ])

            ->add('permissions', EntityType::class, [
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
            'data_class' => FranchisePermission::class,
        ]);
    }
}
