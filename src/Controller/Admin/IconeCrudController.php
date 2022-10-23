<?php

namespace App\Controller\Admin;

use App\Entity\Icone;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class IconeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Icone::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('image'),
            TextField::new('lien'),
            AssociationField::new('blocLogos')->setFormTypeOptionIfNotSet('by_reference', false),
        ];
    }

}
