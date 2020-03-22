<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientCollectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cin')
            ->add('permi', null, [
                'label' => 'Numéro permis'
            ])
            ->add('permiDate', null, [
                'label' => "Permis date d'obtention",
                'years' => range(date('Y') - 30, date('Y'))
            ])
            ->add('name', null, [
                'label' => 'Nom et prénom'
            ])
            ->add('email')
            ->add('phone', null, [
                'label' => 'Numéro de téléphone'
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'Date de naissance'
            ])
            ->add('nationality', CountryType::class, [
                'label' => 'Nationalité',
                'data' => 'TN'
            ])
            ->add('address', null, [
                'label' => 'Adresse'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
