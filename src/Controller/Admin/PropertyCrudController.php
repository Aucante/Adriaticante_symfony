<?php

namespace App\Controller\Admin;

use App\Entity\Property;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('price')
            ->add('area')
            ->add('totalRooms')
            ->add('totalBedrooms')
            ->add('totalBathrooms')
            ->add('type')
            ->add('advertType')
            ->add('createdAt')
            ->add('city');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('area'),
            IntegerField::new('total_rooms'),
            IntegerField::new('total_bedrooms'),
            IntegerField::new('total_bathrooms'),
            ChoiceField::new('type')->setChoices([
                'Villa' => 'Villa',
                'House' => 'House',
                'Penthouse' => 'Penthouse',
                'Apartment' => 'Apartment',
                'Condo' => 'Condo',
                'New Developments' => 'New Developments',
                'Chalets' => 'Chalets',
                'Commercial space' => 'Commercial space',
            ]),
            ChoiceField::new('advert_type')->setChoices([
                'Purchase' => 'Purchase',
                'Rental' => 'Rental',
            ]),
            TextField::new('link_website'),
            TextField::new('dial_code'),
            NumberField::new('phone_contact'),
            TextField::new('name_contact'),
            AssociationField::new('user'),
            CollectionField::new('features')->hideOnForm(),
            SlugField::new('slug')->setTargetFieldName('name'),
            DateTimeField::new('createdAt'),
            AssociationField::new('city'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['id' => 'DESC']);
    }
}
