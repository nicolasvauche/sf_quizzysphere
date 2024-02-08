<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\Admin\AnswerType;
use App\Service\SettingsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/reponse', name: 'app_admin_answer_')]
class AnswerController extends AbstractController
{
    #[Route('/{id}/nouvelle', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager,
                        SettingsService        $settingsService,
                        Question               $question): Response
    {
        $answer = (new Answer());
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $answer->setQuestion($question)
                ->setPosition($entityManager->getRepository(Answer::class)->findMaxPositionForQuestion($question->getId()) + 1);
            $entityManager->persist($answer);

            if($form->get('correct')->getData()) {
                foreach($question->getAnswers() as $questionAnswer) {
                    if($questionAnswer->getId() !== $answer->getId() && $questionAnswer->isCorrect()) {
                        $questionAnswer->setCorrect(false);
                        $entityManager->persist($questionAnswer);
                    }
                }
                $entityManager->flush();
            }

            $entityManager->flush();

            $this->addFlash('success', "La réponse a été créée pour la question n°{$question->getPosition()}");

            if(sizeOf($question->getAnswers()) + 1 < $settingsService->getQuizzAnswersMax()) {
                return $this->redirectToRoute('app_admin_answer_add', ['id' => $answer->getQuestion()->getId()], Response::HTTP_SEE_OTHER);
            } else {
                return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('admin/answer/add.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
            'maxPosition' => $entityManager->getRepository(Answer::class)->findMaxPositionForQuestion($question->getId()),
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit')]
    public function edit(Request                $request,
                         EntityManagerInterface $entityManager,
                         Answer                 $answer): Response
    {
        $question = $answer->getQuestion();
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $answer->setQuestion($question);
            $entityManager->persist($answer);
            $entityManager->flush();

            if($form->get('correct')->getData()) {
                foreach($question->getAnswers() as $questionAnswer) {
                    if($questionAnswer->getId() !== $answer->getId() && $questionAnswer->isCorrect()) {
                        $questionAnswer->setCorrect(false);
                        $entityManager->persist($questionAnswer);
                    }
                }
                $entityManager->flush();
            }

            $this->addFlash('success', "La réponse à la question n°{$question->getPosition()} a été modifiée");

            return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/answer/edit.html.twig', [
            'question' => $question,
            'answer' => $answer,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $entityManager, Answer $answer): Response
    {
        $question = $answer->getQuestion();

        $entityManager->remove($answer);
        $entityManager->flush();

        $position = 1;
        foreach($question->getAnswers() as $remainingAnswer) {
            $remainingAnswer->setPosition($position++);
            $entityManager->persist($remainingAnswer);
        }

        $entityManager->flush();

        $this->addFlash('success', "La réponse à la question n°{$question->getPosition()} a été supprimée");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
    }
}
