<?php

namespace App\Form;

use App\Entity\Asset;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', ChoiceType::class, [
                'label' => false,
                'choices' => [
                    'Balcony' => 'Balcony',
                    'Furniture' => 'Furniture',
                    'Parking' => 'Parking',
                    'Terrace' => 'Terrace',
                    'Garden' => 'Garden',
                    'Swimming pool' => 'Swimming pool',
                    'Sea view' => 'Sea view',
                    'Mountains view' => 'Mountains view',
                    'Lake view' => 'Lake view',
                    'Near sea' => 'Near sea',
                    'High-speed internet ' => 'High speed internet',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Asset::class,
        ]);
    }
}
