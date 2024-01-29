<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_index');
        }

        if($this->getUser()) {
            $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
            if($user) {
                $userCourses = $user->getUserCourses();
            }
        }

        return $this->render('default/index.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findByNotAdmin(),
            'userCourses' => $userCourses ?? null,
        ]);
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('default/cgu.html.twig');
    }
}
