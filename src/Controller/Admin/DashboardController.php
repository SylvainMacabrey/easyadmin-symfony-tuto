<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Entity\User;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img src="..."> ACME <span class="text-small">Corp.</span>')
            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')
            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')
            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()
            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            ->renderSidebarMinimized()
            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()
        ;
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Blog'),
            MenuItem::subMenu('Blog', 'fa fa-newspaper-o')->setSubItems([
                MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
                MenuItem::linkToCrud('Add Category', 'fa fa-tags', Category::class)->setAction('new'),
            ]),
            MenuItem::subMenu('Post', 'fa fa-file-text')->setSubItems([
                MenuItem::linkToCrud('Posts', 'fa fa-tags', Post::class),
                MenuItem::linkToCrud('Add Post', 'fa fa-tags', Post::class)->setAction('new'),
                //MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            ]),
            MenuItem::section('Users'),
            MenuItem::subMenu('Users', 'fa fa fa-user')->setSubItems([
                MenuItem::linkToCrud('Users', 'fa fa-user', User::class),
                MenuItem::linkToCrud('Add User', 'fa fa-user', User::class)->setAction('new'),
                //MenuItem::linkToCrud('Posts', 'fa fa-file-text', BlogPost::class),
                //MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            ]),
            //MenuItem::section('Déconnexion'),
            //MenuItem::linkToLogout('Logout', 'fa fa-exit'),
        ];
    }
}
