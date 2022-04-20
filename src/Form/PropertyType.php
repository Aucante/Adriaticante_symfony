<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\Country;
use App\Entity\Feature;
use App\Entity\Property;
use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaV3Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\Dropzone\Form\DropzoneType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'property.name.label',
            ])
            ->add('price', IntegerType::class, [
                'label' => 'property.price.label'
            ])
            ->add('description', TextareaType::class, [
                'label' => 'property.description.label'
            ])
            ->add('area', IntegerType::class, [
                'label' => 'property.area.label'
            ])
            ->add('totalRooms', ChoiceType::class, [
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                    '10' => 10,
                    '11' => 11,
                    '12' => 12,
                    '13' => 13,
                    '14' => 14,
                    '15' => 15,
                    '16' => 16,
                    '17' => 17,
                    '18' => 18,
                    '19' => 19,
                ],
                'label' => 'property.total_rooms.label'
            ])
            ->add('totalBedrooms', ChoiceType::class, [
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ],
                'label' => 'property.total_bedrooms.label'
            ])
            ->add('totalBathrooms', ChoiceType::class, [
                'choices'  => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                    '7' => 7,
                    '8' => 8,
                    '9' => 9,
                ],
                'label' => 'property.total_bathrooms.label'
            ])
            ->add('type', ChoiceType::class, [
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
                'label' => 'property.type.label'
            ])
            ->add('advertType', ChoiceType::class, [
                'choices'  => [
                    'Purchase' => 'Purchase',
                    'Rental' => 'Rental',
                ],
                'label' => 'property.advert_type.label'
            ])
            ->add('linkWebsite', UrlType::class, [
                'label' => 'property.link_website.label'
            ])
            ->add('dialCode', ChoiceType::class, [
                'label' => 'property.dialCode.label',
                'choices' => [
                    '+33' => '+33 France',
                    '+385' => '+385 Croatia',
                    '+386' => '+386 Slovenia',
                    '+382' => '+382 Montenegro',
                    '+44' => '+44 UK',
                    '+49' => '+49 Germany',
                    '+41' => '+41 Switzerland',
                    '+34' => '+34 Spain',
                    '+351' => '+351 Portugal',
                    '+31' => '+31 Netherlands',
                    '+45' => '+45 Denmark',
                    '+46' => '+46 Sweden',
                    '+358' => '+358 Finland',
                    '+32' => '+32 Belgium',
                    '+381' => '+381 Serbia',
                    '+1' => '+1 USA/Canada',
                ]
            ])
            ->add('phoneContact', TelType::class, [
                'label' => 'property.phone_contact.label',
               // 'row_attr' => ['data-controller' => 'intl'],
               // 'attr' => ['data-intl-target' => 'input'],
            ])
            ->add('nameContact', TextType::class, [
                'label' => 'property.name_contact.label'
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
            ->add('country', EntityType::class, [
                'mapped' => false,
                'class' => Country::class,
                'choice_label' => 'name',
                'placeholder' => 'Choose Country',
                'label' => 'property.country.label'
            ])
            ->add('city', ChoiceType::class, [
                'label' => 'property.city.label',
                'placeholder' => 'Choose City',
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => DropzoneType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'error_bubbling' => false,
                'required' => false,
                'label' => false,
                'mapped' => false
            ])
            ->add('recaptcha', EWZRecaptchaV3Type::class, [
                'action_name' => 'contact',
            ])
        ;

        $formModifier = function (FormInterface $form, Country $country = null) {
            $cities = (null === $country) ? [] : $country->getCity();

            $form->add('city', EntityType::class, [
                'class' => City::class,
                'choices' => $cities,
                'choice_label' => 'name',
                'placeholder' => 'Choose City',
                'label' => 'property.city.label',
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
            'data_class' => Property::class,
            'translation_domain' => 'form'
        ]);
    }
}
