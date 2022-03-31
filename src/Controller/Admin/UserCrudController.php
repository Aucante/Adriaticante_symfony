<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserCrudController extends AbstractCrudController
{
    private string $uploadDir;

    public function __construct(string $uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }


    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('company')
            ->add('email')
            ->add('username')
            ->add('lastname')
            ->add('firstname');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('company'),
            TextField::new('email'),
            TextField::new('username'),
            ArrayField::new('roles'),
            TextField::new('lastname'),
            TextField::new('firstname'),
            DateTimeField::new('updated_at'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms(),
            ImageField::new('file')
                ->setBasePath($this->uploadDir)
                ->hideOnForm(),
            AssociationField::new('address'),
        ];
    }

}
