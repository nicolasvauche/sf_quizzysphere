<?php

namespace App\Controller;

use App\Entity\UserGroup;
use Doctrine\Common\Collections\ArrayCollection;
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
        $userCourses = new ArrayCollection();
        foreach($entityManager->getRepository(UserGroup::class)->findAll() as $userGroup) {
            foreach($userGroup->getCourses() as $userCourse) {
                if(!$userCourses->contains($userCourse)) {
                    $userCourses->add($userCourse);
                }
            }
        }

        $userQuizzCategories = new ArrayCollection();
        foreach($userCourses as $userCourse) {
            foreach($userCourse->getQuizzCategories() as $userQuizzCategory) {
                if(!$userQuizzCategories->contains($userQuizzCategory)) {
                    $userQuizzCategories->add($userQuizzCategory);
                }
            }
        }

        /*$userQuizzs = new ArrayCollection();
        foreach($userQuizzCategories as $userQuizzCategory) {
            foreach($userQuizzCategory->getQuizzs() as $userQuizz) {
                if(!$userQuizzs->contains($userQuizz)) {
                    $userQuizzs->add($userQuizz);
                }
            }
        }*/

        return $this->render('quizz/index.html.twig', [
            'quizzCategories' => $userQuizzCategories,
        ]);
    }
}
