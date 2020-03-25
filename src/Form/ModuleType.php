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
            ->add('serialNumber')
            ->add('description')
            ->add('active')
            ->add('temperature')
            ->add('uptime')
            ->add('dataSent',
/*                 [
                    'attr' => [
                        'min' => 0,
                        'step' => 1,
                    ]
                ]
 */            )
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
