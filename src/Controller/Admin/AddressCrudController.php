<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AddressCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Address::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('street_number'),
            TextField::new(('street_address_line_1')),
            TextField::new(('street_address_line_2')),
            TextField::new(('city')),
            IntegerField::new(('state_zip_code')),
            TextField::new(('country')),
            TextField::new(('county')),
            IntegerField::new(('phone')),
            IntegerField::new(('longitude')),
            IntegerField::new(('latitude')),
        ];
    }

}
