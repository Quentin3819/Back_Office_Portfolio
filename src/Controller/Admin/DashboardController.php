<?php

namespace App\Controller\Admin;

use App\Entity\BlocLogo;
use App\Entity\BlocTexte;
use App\Entity\Footer;
use App\Entity\Github;
use App\Entity\Icone;
use App\Entity\Page;
use App\Entity\Projet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Proxies\__CG__\App\Entity\Projets;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(PageCrudController::class)->setAction(Crud::PAGE_NEW);
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('BackOffice');
    }
    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Pages', 'fa-solid fa-file')->setSubItems([
                MenuItem::linkToCrud('Crée une page', 'fas fa-plus', Page::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Voir les pages', 'fas fa-eye', Page::class)
        ]);
        yield MenuItem::subMenu('Blocs', 'fa-solid fa-cube')->setSubItems([
            MenuItem::section('Blocs Texte', 'fa-solid fa-comment'),
            MenuItem::linkToCrud('Crée un bloc texte', 'fas fa-plus', BlocTexte::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les blocs texte', 'fas fa-eye', BlocTexte::class),

            MenuItem::section('Blocs Logo', "fa-solid fa-icons"),
            MenuItem::linkToCrud('Crée un bloc logo', 'fas fa-plus', BlocLogo::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les blocs logo', 'fas fa-eye', BlocLogo::class),
        ]);
        yield MenuItem::subMenu('Icones', 'fa-solid fa-icons')->setSubItems([
            MenuItem::linkToCrud('Crée une icone', 'fas fa-plus', Icone::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les icones', 'fas fa-eye', Icone::class)
        ]);
        yield MenuItem::subMenu('Projets', 'fa-solid fa-diagram-project')->setSubItems([
            MenuItem::linkToCrud('Crée un projet', 'fas fa-plus', Projet::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les projets', 'fas fa-eye', Projet::class)
        ]);
        yield MenuItem::subMenu('Options', 'fa-solid fa-gear')->setSubItems([
            MenuItem::section('Github', 'fa-solid fa-code-branch'),
            MenuItem::linkToCrud('Ajouter un compte', 'fas fa-plus', Github::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les comptes', 'fas fa-eye', Github::class),

            MenuItem::section('Footer', "fa-solid fa-shoe-prints"),
            MenuItem::linkToCrud('Crée footer', 'fas fa-plus', Footer::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir footer', 'fas fa-eye', Footer::class),
        ]);
    }
}
