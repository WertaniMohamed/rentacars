<?php

namespace App\Form;

use App\Entity\BodyType;
use App\Entity\Car;
use App\Entity\Fuel;
use App\Entity\Mark;
use App\Entity\Model;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('serial', null, [
                'label' => 'Numéro de série'
            ])
            ->add('color', null, [
                'label' => 'Couleur'
            ])
            ->add('prod_year', null, [
                'label' => 'Anneé',
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy',
            ])
            ->add('image')
            ->add('gearbox', null, [
                'label' => 'Boîte de vitesses',
            ])
            ->add('fiscalPower', null, [
                'label' => 'puissance fiscale'
            ])
            ->add('model', EntityType::class, [
                'label' => 'Modele',
                'class' => Model::class,
                'choice_label' => 'name',
            ])
            ->add('fuel', EntityType::class, [
                'label' => 'Carburent',
                'class' => Fuel::class,
                'choice_label' => 'name',
            ])
            ->add('bodyType', EntityType::class, [
                'label' => 'Type de corps',
                'class' => BodyType::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
        ]);
    }
}
