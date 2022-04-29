<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\UX\Dropzone\Form\DropzoneType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'registration.lastname.label',
            ])
            ->add('firstname', TextType::class, [
                'label' => 'registration.firstname.label',
            ])
            ->add('company', TextType::class, [
                'label' => 'registration.company.label',
            ])
            ->add('file', DropzoneType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'label' => 'registration.file.label',
                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new Image([
                        'minHeight' => 700,
                        'minHeightMessage' => 'The image height is too small ({{ height }}px). Minimum height expected is {{ min_height }}px.',
                        'minWidth' => 1000,
                        'minWidthMessage' => 'The image width is too small ({{ width }}px). Minimum width expected is {{ min_width }}px',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/jpg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Expected jpeg / jpg or png.',
                        'maxSize' => '20M',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.',
                    ]),
                ],
            ])
            ->add('address', AddressType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'translation_domain' => 'form',
        ]);
    }
}
