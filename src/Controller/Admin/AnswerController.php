<?php

namespace App\Controller\Admin;

use App\Entity\Answer;
use App\Entity\Question;
use App\Form\Admin\AnswerType;
use App\Service\MistralAPIClient;
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

    #[Route('/{id}/generer', name: 'generate')]
    public function generate(MistralAPIClient       $APIClient,
                             EntityManagerInterface $entityManager,
                             Question               $question): Response
    {
        $answers = $APIClient->generateAnswers($question);
        if(!empty($answers)) {
            $lines = explode("[END]", trim($answers));
            $formattedAnswers = [];

            foreach($lines as $line) {
                if(!empty($line)) {
                    $line = str_replace("\n", '', $line);
                    preg_match('/\s*\[1\]\s*(.*?)\s*\[2\]\s*(.*?)\s*\[3\]\s*(Correcte|Incorrecte)\s*/s', $line, $matches);
                    if(isset($matches[1]) && isset($matches[2]) && isset($matches[3])) {
                        $formattedAnswers[] = [
                            'text' => $matches[1],
                            'help' => $matches[2],
                            'correct' => $matches[3] === 'Correcte',
                        ];
                    } else {
                        dd($answers);
                    }
                }
            }

            foreach($question->getAnswers() as $answer) {
                $entityManager->remove($answer);
                $entityManager->flush();
            }

            foreach($formattedAnswers as $formattedAnswer) {
                $answer = (new Answer())
                    ->setQuestion($question)
                    ->setText($formattedAnswer['text'])
                    ->setHelp($formattedAnswer['help'])
                    ->setCorrect($formattedAnswer['correct'])
                    ->setPosition($entityManager->getRepository(Answer::class)->findMaxPositionForQuestion($question->getId()) + 1);
                $entityManager->persist($answer);
                $entityManager->flush();
            }

            $this->addFlash('success', "Les réponses ont été générées pour la question n°{$question->getPosition()}");
        } else {
            $this->addFlash('danger', "Impossible de générer les réponses pour la question n°{$question->getPosition()}");
        }

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
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

    #[Route('/{id}/vider', name: 'clean')]
    public function clean(EntityManagerInterface $entityManager, Question $question): Response
    {
        foreach($question->getAnswers() as $answer) {
            $entityManager->remove($answer);
        }
        $entityManager->flush();

        $this->addFlash('success', "Les réponses à la question n°{$question->getPosition()} ont été supprimées");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $question->getQuizz()->getId()], Response::HTTP_SEE_OTHER);
    }
}
