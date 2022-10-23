<?php

namespace App\Controller\Admin;

use App\Entity\BlocTexte;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class BlocTexteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BlocTexte::class;
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
            TextEditorField::new('sous_titre')->setFormType(CKEditorType::class),
            TextEditorField::new('description')->setFormType(CKEditorType::class),
            ImageField::new('image')->setBasePath('upload/images/blocTexte')->setUploadDir('public/upload/images/blocTexte'),
            AssociationField::new('pages')->setFormTypeOptionIfNotSet('by_reference', false)
        ];
    }

}
