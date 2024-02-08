<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Entity\Quizz;
use App\Form\Admin\QuestionType;
use App\Service\SettingsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/question', name: 'app_admin_question_')]
class QuestionController extends AbstractController
{
    #[Route('/{id}/nouvelle', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager,
                        SettingsService        $settingsService,
                        Quizz                  $quizz): Response
    {
        $question = (new Question());
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $question->setQuizz($quizz)
                ->setPosition($entityManager->getRepository(Question::class)->findMaxPositionForQuizz($quizz->getId()) + 1);
            $entityManager->persist($question);
            $entityManager->flush();

            $this->addFlash('success', "La question a été créée");

            if(sizeOf($quizz->getQuestions()) < $settingsService->getQuizzQuestionsMax()) {
                return $this->redirectToRoute('app_admin_question_add', ['id' => $quizz->getId()], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_admin_quizz_show', ['id' => $quizz->getId()], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/question/add.html.twig', [
            'form' => $form->createView(),
            'quizz' => $quizz,
            'maxPosition' => $entityManager->getRepository(Question::class)->findMaxPositionForQuizz($quizz->getId()),
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit')]
    public function edit(Request                $request,
                         EntityManagerInterface $entityManager,
                         Question               $question): Response
    {
        $quizz = $question->getQuizz();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $question->setQuizz($quizz);
            $entityManager->persist($question);
            $entityManager->flush();

            $this->addFlash('success', "La question n°{$question->getPosition()} du quizz {$question->getQuizz()->getName()} a été modifiée");

            return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, Question $question): Response
    {
        $entityManager->remove($question);
        $entityManager->flush();

        $position = 1;
        foreach($question->getQuizz()->getQuestions() as $remainingQuestion) {
            $remainingQuestion->setPosition($position++);
            $entityManager->persist($remainingQuestion);
        }
        $entityManager->flush();

        $this->addFlash('success', "La question n°{$question->getPosition()} du quizz {$question->getQuizz()->getName()} a été supprimée");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
    }
}
