<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street_number', IntegerType::class, [
            'label' => 'address.street_number.label',
            ])
            ->add('street_address_line_1', TextType::class, [
                'label' => 'address.street_address_line_1.label',
            ])
            ->add('street_address_line_2', TextType::class, [
                'label' => 'address.street_address_line_2.label',
            ])
            ->add('city', TextType::class, [
                'label' => 'address.city.label',
            ])
            ->add('state_zip_code', IntegerType::class, [
                'label' => 'address.state_zip_code.label',
            ])
            ->add('country', CountryType::class, [
                'label' => 'address.country.label',
            ])
            ->add('county', TextType::class, [
                'label' => 'address.county.label',
            ])
            ->add('phone', TelType::class, [
                'label' => 'address.phone.label',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'translation_domain' => 'form'
        ]);
    }
}
