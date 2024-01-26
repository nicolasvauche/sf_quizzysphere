<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_index')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }
}
