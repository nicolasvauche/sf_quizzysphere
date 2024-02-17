<?php

namespace App\Controller;

use App\Entity\Quizz;
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

        return $this->render('quizz/index.html.twig', [
            'quizzCategories' => $userQuizzCategories,
        ]);
    }

    #[Route('/{slug}', name: 'show')]
    public function show(Quizz $quizz): Response
    {
        $userAttempt = null;
        foreach($this->getUser()->getAttempts() as $attempt) {
            if($attempt->getQuizz() === $quizz) {
                $userAttempt = $attempt;
                break;
            }
        }

        if(!$userAttempt || !$userAttempt->getEndedAt()) {
            return $this->forward('App\Controller\QuizzController::play', [
                'quizz' => $quizz,
            ]);
        }

        return $this->render('quizz/show.html.twig', [
            'quizz' => $quizz,
        ]);
    }

    public function play(Quizz $quizz): Response
    {
        $userAttempt = null;
        foreach($this->getUser()->getAttempts() as $attempt) {
            if($attempt->getQuizz() === $quizz) {
                $userAttempt = $attempt;
                break;
            }
        }

        if($userAttempt) {
            foreach($quizz->getQuestions() as $question) {
                if($userAttempt->getCurrentQuestion() === $question) {
                    $currentQuestion = $question;
                }
            }
        } else {
            $currentQuestion = $quizz->getQuestions()->first();
            if(!$currentQuestion) {
                return $this->redirectToRoute('app_quizz_index');
            }
        }

        return $this->render('quizz/play.html.twig', [
            'quizz' => $quizz,
            'question' => $currentQuestion,
        ]);
    }
}
