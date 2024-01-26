<?php

namespace App\Controller\Admin;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/utilisateurs', name: 'app_admin_user_')]
class UserController extends AbstractController
{
    #[Route('', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $entityManager->getRepository('App:User')->findAll(),
        ]);
    }
}
