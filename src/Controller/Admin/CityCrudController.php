<?php

namespace App\Controller\Admin;

use App\Entity\City;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CityCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return City::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('country');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            NumberField::new('latitude')->setNumDecimals(5),
            NumberField::new('longitude')->setNumDecimals(5),
            AssociationField::new('country')
        ];
    }

}
