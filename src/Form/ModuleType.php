<?php

namespace App\Form;

use App\Entity\Module;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('type', null,
            [
                // permet de convertir type en string (sans mettre de __toString dans l'entity)
               'choice_label' => 'name',
               'placeholder' => "",
           ])
            ->add('active')
            ->add('temperature',
            null,
           [
              'attr' => [
                  'min' => 0,
                  'step' => 1,
              ]
          ]
       )
            ->add('uptime',
            null,
           [
              'attr' => [
                  'min' => 0,
                  'max' => 45,
                  'step' => 1,
              ]
          ]
       )
            ->add('dataSent',
                  null,
                 [
                    'attr' => [
                        'min' => 0,
                        'step' => 1,
                    ]
                ]
             )
            ->add('displayActive')
            ->add('displayTemperature')
            ->add('displayUptime')
            ->add('displayDataSent');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
