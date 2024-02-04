<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Form\Admin\AnswerType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/reponse', name: 'app_admin_answer_')]
class AnswerController extends AbstractController
{
    #[Route('/nouvelle', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager): Response
    {
        $answer = (new Answer());
        $form = $this->createForm(AnswerType::class, $answer);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($answer);
            $entityManager->flush();

            $this->addFlash('success', "La répponse a été créée");

            return $this->redirectToRoute('app_admin_quizz_show', ['id' => $answer->getQuestion()->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/answer/add.html.twig', [
            'form' => $form->createView(),
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

            $this->addFlash('success', "La réponse a été modifiée");

            return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/answer/edit.html.twig', [
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

        $this->addFlash('success', "La réponse a été supprimée");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
    }
}
