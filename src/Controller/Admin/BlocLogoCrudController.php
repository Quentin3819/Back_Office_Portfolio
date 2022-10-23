<?php

namespace App\Controller\Admin;

use App\Entity\BlocLogo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class BlocLogoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlocLogo::class;
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
            TextField::new('nom_bloc'),
            TextEditorField::new('titre')->setFormType(CKEditorType::class),
            TextEditorField::new('description')->setFormType(CKEditorType::class),
            AssociationField::new('bloc_texte_id')->setFormTypeOptionIfNotSet('by_reference', false) // is page ID
        ];
    }

}
