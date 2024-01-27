<?php

namespace App\Controller\Admin;

use App\Entity\QuizzCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/quizzcategory', name: 'app_admin_quizzcategory_')]
class QuizzCategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/quizzcategory/index.html.twig', [
            'quizzCategories' => $entityManager->getRepository(QuizzCategory::class)->findTopLevelCategories(),
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(QuizzCategory $quizzCategory): Response
    {
        return $this->render('admin/quizzcategory/show.html.twig', [
            'quizzCategory' => $quizzCategory,
        ]);
    }
}
