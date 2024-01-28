<?php

namespace App\Controller;

use App\Entity\QuizzCategory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/quizz', name: 'app_quizz_')]
class QuizzController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('quizz/index.html.twig', [
            'quizzCategories' => $entityManager->getRepository(QuizzCategory::class)->findBy(['active' => true], ['name' => 'ASC']),
        ]);
    }
}
