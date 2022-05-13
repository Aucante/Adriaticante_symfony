<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
                'required' => true,
            ])
            ->add('street_address_line_1', TextType::class, [
                'label' => 'address.street_address_line_1.label',
                'required' => true,
            ])
            ->add('street_address_line_2', TextType::class, [
                'label' => 'address.street_address_line_2.label',
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'label' => 'address.city.label',
                'required' => true,
            ])
            ->add('state_zip_code', IntegerType::class, [
                'label' => 'address.state_zip_code.label',
                'required' => true,
            ])
            ->add('country', CountryType::class, [
                'label' => 'address.country.label',
                'required' => true,
            ])
            ->add('county', TextType::class, [
                'label' => 'address.county.label',
                'required' => false,
            ])
            ->add('dialCode', ChoiceType::class, [
                'label' => 'address.dialCode.label',
                'choices' => [
                    '+1' => 'USA/Canada +1',
                    '+31' => 'Netherlands +3',
                    '+32' => 'Belgium +32',
                    '+33' => 'France +33',
                    '+34' => 'Spain +34',
                    '+351' => 'Portugal +351',
                    '+358' => 'Finland +358',
                    '+381' => 'Serbia +381',
                    '+382' => 'Montenegro +382',
                    '+385' => 'Croatia +385',
                    '+386' => 'Slovenia +386',
                    '+41' => 'Switzerland +41',
                    '+44' => 'UK +44',
                    '+45' => 'Denmark +45',
                    '+46' => 'Sweden +46',
                    '+49' => 'Germany +49',
                    '+ X' => 'Other',
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => 'address.phone.label',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'translation_domain' => 'form',
        ]);
    }
}
