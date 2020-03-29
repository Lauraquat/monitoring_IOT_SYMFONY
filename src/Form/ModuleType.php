<?php

namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
            ])
            ->add('description')
            ->add(
                'type',
                null,
                [
                    // permet de convertir type en string (sans mettre de __toString dans l'entity)
                    'choice_label' => 'name',
                    'placeholder' => "",
                ]
            )
            ->add('active', ChoiceType::class, [
                'label' => 'Module actif',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ]
            ])
            ->add(
                'temperature',
                null,
                [
                    'label' => 'Température',
                    'attr' => [
                        'min' => 15,
                        'max' => 30,
                        'step' => 1,
                    ]
                ]
            )
            ->add(
                'uptime',
                null,
                [
                    'label' => 'Durée de fonctionnement',
                    'attr' => [
                        'min' => 0,
                        'step' => 1,
                    ]
                ]
            )
            ->add(
                'dataSent',
                ChoiceType::class,
                [
                    'label' => 'Données envoyées',
                    'choices' => [
                        '' => null,
                        '50' => '50',
                        '100' => '100',
                        '150' => '150',
                        '200' => '200',
                    ]
                ]
            )
            ->add('displayActive',
            null,
            [
                'label' => "Affichage de l'activité",
            ])
            ->add('displayTemperature',
            null,
            [
                'label' => "Affichage de la température",
            ])
            ->add('displayUptime',
            null,
            [
                'label' => "Affichage de la durée de fonctionnement",
            ])
            ->add('displayDataSent',
            null,
            [
                'label' => "Affichage des données envoyées",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
