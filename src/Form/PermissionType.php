<?php

namespace App\Form;

use App\Entity\Permission;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('Name', TextType::class, [
                'label' => 'Nom de la Permission',
                'attr' =>[
                    'placeholder' => "Veuillez saisir le nom de la permission "
                    ]
            ])
           
            ->add('Actif',  ChoiceType::class, [
                'label' => 'Permissions Actif :',
                'label_attr' => ['class' => 'switch-custom actif-btn'],
                'required' => true,
                'choices' => [
                    'oui' => true,
                    'non' => false
                ],
            ])
            
            ->add('submit', SubmitType::class, [
                'label' => "Valider"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permission::class,
        ]);
    }
}
