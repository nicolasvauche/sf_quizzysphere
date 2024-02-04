<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use App\Form\Admin\QuestionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/question', name: 'app_admin_question_')]
class QuestionController extends AbstractController
{
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

        $this->addFlash('success', "La question n°{$question->getPosition()} du quizz {$question->getQuizz()->getName()} a été supprimée");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
    }
}
