<?php

namespace App\Controller\Admin;

use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ProjetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Projet::class;
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
            ImageField::new('image')->setBasePath('upload/images/projet')->setUploadDir('public/upload/images/projet'),
            TextField::new('titre'),
            TextEditorField::new('description')->setFormType(CKEditorType::class),
            DateTimeField::new('date_creation'),
            TextField::new('lien'),
            AssociationField::new('pages')->setFormTypeOptionIfNotSet('by_reference', false)
        ];
    }
}
