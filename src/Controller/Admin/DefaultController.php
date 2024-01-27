<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\UserGroup;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/admin', name: 'app_admin_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {

        return $this->render('admin/index.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findByNotAdmin(),
            'userGroups' => $entityManager->getRepository(UserGroup::class)->findAll(),
        ]);
    }
}
