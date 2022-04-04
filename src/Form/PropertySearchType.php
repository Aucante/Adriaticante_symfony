<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Asset;
use App\Entity\City;
use App\Entity\Feature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('q', SearchType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Research'
                ]
            ])
            ->add('priceMax', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Max'
                ]
            ])
            ->add('priceMin', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Min'
                ]
            ])
            ->add('areaMax', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Max'
                ]
            ])
            ->add('areaMin', IntegerType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Min'
                ]
            ])
            ->add('roomsMax', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Max',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                ],
            ])
            ->add('roomsMin', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Min',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                    '11' => '11',
                    '12' => '12',
                    '13' => '13',
                    '14' => '14',
                    '15' => '15',
                ],
            ])
            ->add('bedroomsMax', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Max',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
            ])
            ->add('bedroomsMin', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Min',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
            ])
            ->add('bathroomsMax', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Max',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
            ])
            ->add('bathroomsMin', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'placeholder' => 'Min',
                'choices'  => [
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ],
            ])
            ->add('type', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'type'
                ],
                'choices'  => [
                    'Purchase' => 'Purchase',
                    'Daily Rental' => 'Daily Rental',
                    'Monthly Rental' => 'Monthly Rental',
                ]
            ])
            ->add('advertType', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'advertType'
                ],
                'choices'  => [
                    'Purchase' => 'Purchase',
                    'Daily Rental' => 'Daily Rental',
                    'Monthly Rental' => 'Monthly Rental',
                ],
                'placeholder' => 'Rent or Purchase'
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'label' => false,
                'placeholder' => 'City',
                'required' => false
            ])
            ->add('features', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Feature::class,
                'multiple' => true,
                'attr' => [
                    'data-controller' => 'select2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
