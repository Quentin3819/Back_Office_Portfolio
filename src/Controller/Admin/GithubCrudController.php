<?php

namespace App\Controller\Admin;

use App\Entity\Github;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class GithubCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Github::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextEditorField::new('titre')->setFormType(CKEditorType::class),
            TextField::new('nom_utilisateur'),
            AssociationField::new('github_id')->setFormTypeOptionIfNotSet('by_reference', false)

        ];
    }
}
