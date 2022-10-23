<?php

namespace App\Controller\Admin;

use App\Entity\Github;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GithubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Github::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom_utilisateur'),
            AssociationField::new('github_id')->setFormTypeOptionIfNotSet('by_reference', false)

        ];
    }
}
