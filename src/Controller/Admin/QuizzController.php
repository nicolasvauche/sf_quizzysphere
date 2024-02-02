<?php

namespace App\Controller\Admin;

use App\Entity\QuizzCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/quizz', name: 'app_admin_quizz_')]
class QuizzController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/quizz/index.html.twig', [
            'quizzCategories' => $entityManager->getRepository(QuizzCategory::class)->findAll(),
        ]);
    }
}
