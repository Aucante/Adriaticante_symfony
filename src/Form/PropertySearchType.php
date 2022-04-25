<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Asset;
use App\Entity\City;
use App\Entity\Country;
use App\Entity\Feature;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
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
                    'placeholder' => 'search.search.label'
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
                'placeholder' => 'search.type.label',
                'attr' => [
                    'placeholder' => 'search.type.label'
                ],
                'choices'  => [
                    'Villa' => 'Villa',
                    'House' => 'House',
                    'Penthouse' => 'Penthouse',
                    'Apartment' => 'Apartment',
                    'Condo' => 'Condo',
                    'New Developments' => 'New Developments',
                    'Chalets' => 'Chalets',
                    'Commercial space' => 'Commercial space',
                ],
            ])
            ->add('advertType', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'advertType'
                ],
                'choices'  => [
                    'Purchase' => 'Purchase',
                    'Rental' => 'Rental',
                ],
                'placeholder' => 'search.advertType.label'
            ])
            ->add('country', EntityType::class, [
                'mapped' => false,
                'class' => Country::class,
                'choice_label' => 'name',
                'label' => false,
                'placeholder' => 'search.country.label',
                'required' => false
            ])
            ->add('city', EntityType::class, [
                'class' => City::class,
                'label' => false,
                'placeholder' => 'search.city.label',
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
        $formModifier = function (FormInterface $form, Country $country = null) {
            $cities = (null === $country) ? [] : $country->getCity();

            $form->add('city', EntityType::class, [
                'class' => City::class,
                'choices' => $cities,
                'choice_label' => 'name',
                'placeholder' => 'search.city.label',
                'label' => false,
                'required' => false
            ]);
        };

        $builder->get('country')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier)
            {
                $country = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $country);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method' => 'POST',
            'csrf_protection' => false,
            'translation_domain' => 'form'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
