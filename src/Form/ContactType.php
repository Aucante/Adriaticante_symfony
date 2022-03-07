<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'contact.firstname.label'
            ])
            ->add('lastname', TextType::class, [
                'label' => 'contact.lastname.label'
            ])
            ->add('email', TextType::class, [
                'label' => 'contact.email.label'
            ])
            ->add('phone', TextType::class, [
                'label' => 'contact.phone.label'
            ])
            ->add('message', TextareaType::class, [
                'label' => 'contact.message.label'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'translation_domain' => 'form'
        ]);
    }
}