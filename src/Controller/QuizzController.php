<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Attempt;
use App\Entity\AttemptAnswer;
use App\Entity\Quizz;
use App\Entity\UserGroup;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/{slug}/play', name: 'play')]
    public function play(Request $request, EntityManagerInterface $entityManager, Quizz $quizz): Response
    {
        if(!$quizz->getQuestions()->first()) {
            return $this->redirectToRoute('app_quizz_index');
        }

        $user = $this->getUser();
        $userAttempt = $entityManager->getRepository(Attempt::class)->findOneBy([
            'quizz' => $quizz,
            'player' => $user,
        ]);

        if(!$userAttempt) {
            $userAttempt = (new Attempt())
                ->setQuizz($quizz)
                ->setPlayer($user)
                ->setCurrentQuestion($quizz->getQuestions()->first());
            $entityManager->persist($userAttempt);
            $entityManager->flush();
        }

        $currentQuestion = $userAttempt->getCurrentQuestion();
        $attemptAnswer = $entityManager->getRepository(AttemptAnswer::class)->findOneBy([
            'attempt' => $userAttempt,
            'question' => $currentQuestion,
        ]);

        if(!$attemptAnswer && $currentQuestion) {
            $attemptAnswer = new AttemptAnswer();
            $attemptAnswer->setAttempt($userAttempt)
                ->setQuestion($currentQuestion);
            $entityManager->persist($attemptAnswer);
            $entityManager->flush();
        }

        // Si une réponse a été soumise, redirige vers la méthode de traitement
        if($request->isMethod('POST')) {
            return $this->redirectToRoute('app_quizz_handle_answer', [
                'slug' => $quizz->getSlug(),
                'answerId' => $request->request->get('answer'),
            ]);
        }

        return $this->render('quizz/play.html.twig', [
            'quizz' => $quizz,
            'question' => $currentQuestion,
            'attempt' => $userAttempt,
        ]);
    }

    #[Route('/{slug}/handle-answer', name: 'handle_answer', methods: ['POST'])]
    public function handleAnswer(Request $request, EntityManagerInterface $entityManager, Quizz $quizz): Response
    {
        $userAttempt = $entityManager->getRepository(Attempt::class)->findOneBy([
            'quizz' => $quizz,
            'player' => $this->getUser(),
        ]);

        if($userAttempt) {
            $currentQuestion = $userAttempt->getCurrentQuestion();

            // Obtention de answerId, qui peut être null si aucune réponse n'est sélectionnée
            $answerId = $request->request->get('answerId');

            // Création ou récupération de AttemptAnswer pour la question courante
            $attemptAnswer = $entityManager->getRepository(AttemptAnswer::class)->findOneBy([
                'attempt' => $userAttempt,
                'question' => $currentQuestion,
            ]);

            if(!$attemptAnswer) {
                $attemptAnswer = new AttemptAnswer();
                $attemptAnswer->setAttempt($userAttempt)
                    ->setQuestion($currentQuestion)
                    ->setEndedAt(new \DateTimeImmutable());
                $entityManager->persist($attemptAnswer);
            }

            // Traitement de la réponse si une réponse a été soumise
            if($answerId !== null) {
                $answer = $entityManager->getRepository(Answer::class)->find($answerId);
                if($answer) {
                    $attemptAnswer->setAnswer($answer);
                    $attemptAnswer->setScore($answer->isCorrect() ? 1 : 0);
                    if($answer->isCorrect()) {
                        $userAttempt->setScore($userAttempt->getScore() + 1);
                    }
                }
            } else {
                // Aucune réponse soumise
                $attemptAnswer->setScore(0); // Vous pouvez ajuster cette logique selon les besoins de votre application
            }

            // Mise à jour de la question suivante ou fin du quiz
            $questions = $quizz->getQuestions()->getValues();
            $currentIndex = array_search($currentQuestion, $questions);
            $nextIndex = $currentIndex + 1;

            if(isset($questions[$nextIndex])) {
                $userAttempt->setCurrentQuestion($questions[$nextIndex]);
            } else {
                $userAttempt->setCurrentQuestion(null);
                $userAttempt->setEndedAt(new \DateTimeImmutable()); // Marquer la fin du quiz
            }

            $entityManager->flush(); // Sauvegarde les modifications dans la base de données

            // Redirection vers la page de jeu ou les résultats du quiz
            return $userAttempt->getCurrentQuestion() === null
                ? $this->redirectToRoute('app_quizz_show', ['slug' => $quizz->getSlug()])
                : $this->redirectToRoute('app_quizz_play', ['slug' => $quizz->getSlug()]);
        }

        // Si aucun Attempt n'est trouvé, rediriger vers l'index du quizz
        return $this->redirectToRoute('app_quizz_index');
    }
}
