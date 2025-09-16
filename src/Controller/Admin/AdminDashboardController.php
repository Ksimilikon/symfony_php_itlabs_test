<?php

namespace App\Controller\Admin;

use App\Entity\GuestList;
use App\Entity\Table;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use function pcov\waiting;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class AdminDashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(TableCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Test');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('The Label', 'fas fa-list', Table::class);

        yield MenuItem::section('Control Table');
        yield MenuItem::linkToCrud('Tables', 'fas fa-chair', Table::class)
            ->setController(TableCrudController::class);

        yield MenuItem::section('Control Guests');
        yield MenuItem::linkToCrud('Guests', 'fas fa-users', GuestList::class)
            ->setController(GuestListCrudController::class);
    }
}
