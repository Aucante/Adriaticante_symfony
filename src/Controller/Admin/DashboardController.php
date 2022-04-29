<?php

namespace App\Controller\Admin;

use App\Entity\Address;
use App\Entity\Feature;
use App\Entity\Image;
use App\Entity\Property;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig', [
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ADRIATICANTE');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Dashboard');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Entity');
        yield MenuItem::linkToCrud('Real Estate', 'far fa-building', Property::class);
        yield MenuItem::linkToCrud('Image', 'far fa-file', Image::class);
        yield MenuItem::linkToCrud('Address', 'fas fa-globe-europe', Address::class);
        yield MenuItem::linkToCrud('Feature', 'fas fa-sliders-h', Feature::class);
        yield MenuItem::section('User');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::section('Redirection');
        yield MenuItem::linkToRoute('Return to website', 'fas fa-arrow-left', 'home');
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
    }
}
