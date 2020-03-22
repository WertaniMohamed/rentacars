<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\Client;
use App\Entity\Contract;
use App\Entity\ContractOption;
use App\Entity\ContractPlace;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('clients', CollectionType::class, [
                'entry_type' => ClientCollectionType::class,
                'entry_options' => [
                    'label' => 'CLient',
                ],
                'label' => false,
            ])
            ->add('days', null, [
                    'label' => 'Nombre de jours',
                    'attr' => [
                        'min' => 1
                    ],
                ]
            )
            ->add('daysExtension', null, [
                'label' => 'prolongation',
                'attr' => [
                    'min' => 0
                ],
                'empty_data' => 0,
            ])
            ->add('dateDelivery', null, [
                'label' => 'début de location',
                'data' => new \DateTime(),
                'attr' => [
                    'min' => (new \DateTime())->format('Y-m-d H:i:s')
                ],
                'years' => range(date('Y'), date('Y') + 10),
            ])
            ->add('placeDelivery', EntityType::class, [
                'class' => ContractPlace::class,
                'placeholder' => 'Choisis un lieu',
                'label' => 'lieu de depart',
                'choice_label' => 'name'
            ])
            ->add('placeRecovery', EntityType::class, [
                'class' => ContractPlace::class,
                'placeholder' => 'Choisis un lieu',
                'label' => 'Lieu de restitution',
                'choice_label' => 'name'
            ])
            ->add('car', EntityType::class, [
                'label' => 'Voiture',
                'placeholder' => 'Choisis une voiture',
                'class' => Car::class,
                'choice_label' => function ($car) {
                    return $car->getSerial() . ' - ' . $car->getPriceByDay() . 'TND/Jour';
                }
            ])
            ->add('options', EntityType::class, [
                'class' => ContractOption::class,
                'placeholder' => 'Choisis options',
                'multiple' => true,
                'expanded' => true,
                'choice_label' => function ($option) {
                    return $option->getName() . ' - ' . $option->getPrice() . 'DNT';
                }
            ])
            ->add('discount', PercentType::class, [
                'label' => 'Remise',
                'type' => 'integer',
                'empty_data' => 0,
            ])
            ->add('optionsAmount', MoneyType::class, [
                'label' => 'frais des options',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ],
                'empty_data' => 0,
            ])
            ->add('carDaysAmount', MoneyType::class, [
                'label' => 'frais voiture',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ])
            ->add('amountTotaleHt', MoneyType::class, [
                'label' => 'totale HT',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ])
            ->add('tva', PercentType::class, [
                'data' => '19',
                'type' => 'integer',
                'disabled' => false,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ])
            ->add('amountTotaleTtc', MoneyType::class, [
                'label' => 'totale TTC',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ])
            ->add('amountTotaleTtcAfterDiscount', MoneyType::class, [
                'label' => 'totale TTC aprs Remise',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ])
            ->add('amountTotale', MoneyType::class, [
                'label' => 'totale prix a paye',
                'divisor' => 1,
                'attr' => [
                    'readonly' => 'readonly'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contract::class,
        ]);
    }
}
