<?php

namespace App\Form;

use App\Entity\Setting;
use App\Form\EventListener\AddfieldToDisabledInEditViewSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('value')
            ->add('description')
//            ->add('dateUpdate')
        ;
        $builder->addEventSubscriber(new AddfieldToDisabledInEditViewSubscriber());

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Setting::class,
        ]);
    }
}
