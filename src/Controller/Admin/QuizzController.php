<?php

namespace App\Controller\Admin;

use App\Entity\Attempt;
use App\Entity\Question;
use App\Entity\Quizz;
use App\Entity\QuizzCategory;
use App\Form\Admin\QuizzType;
use App\Service\FileUploaderService;
use App\Service\MistralAPIClient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/quizz', name: 'app_admin_quizz_')]
class QuizzController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/quizz/index.html.twig', [
            'quizzCategories' => $entityManager->getRepository(QuizzCategory::class)->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager,
                        FileUploaderService    $fileUploaderService,
                        SluggerInterface       $slugger): Response
    {
        $quizz = (new Quizz())
            ->setActive(true);
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $coverFileName = $fileUploaderService->upload($coverFile, 'quizz', strtolower($slugger->slug($quizz->getName())));
                $quizz->setCover($coverFileName);
            }

            $entityManager->persist($quizz);
            $entityManager->flush();

            $this->addFlash('success', "Le quizz {$quizz->getName()} a été créé");

            return $this->redirectToRoute('app_admin_quizz_index');
        }

        return $this->render('admin/quizz/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Quizz $quizz): Response
    {
        return $this->render('admin/quizz/show.html.twig', [
            'quizz' => $quizz,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request                $request,
                         EntityManagerInterface $entityManager,
                         FileUploaderService    $fileUploaderService,
                         SluggerInterface       $slugger,
                         Quizz                  $quizz): Response
    {
        $form = $this->createForm(QuizzType::class, $quizz);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $fileUploaderService->remove('quizz/' . $quizz->getCover());
                $coverFileName = $fileUploaderService->upload($coverFile, 'quizz', strtolower($slugger->slug($quizz->getName())));
                $quizz->setCover($coverFileName);
            }

            $entityManager->persist($quizz);
            $entityManager->flush();

            $this->addFlash('success', "Le quizz {$quizz->getName()} a été modifié");

            return $this->redirectToRoute('app_admin_quizz_show', ['id' => $quizz->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/quizz/edit.html.twig', [
            'quizz' => $quizz,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete', methods: ['GET'])]
    public function delete(Quizz                  $quizz,
                           EntityManagerInterface $entityManager,
                           FileUploaderService    $fileUploaderService): Response
    {
        $fileUploaderService->remove('quizz/' . $quizz->getCover());

        $entityManager->remove($quizz);
        $entityManager->flush();

        $this->addFlash('success', "Le quizz {$quizz->getName()} a été supprimé");

        return $this->redirectToRoute('app_admin_quizz_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/resultats', name: 'results')]
    public function results(Attempt $attempt): Response
    {
        return $this->render('admin/quizz/results.html.twig', [
            'attempt' => $attempt,
        ]);
    }

    #[Route('/{id}/resultats/supprimer', name: 'results_delete')]
    public function deleteResults(EntityManagerInterface $entityManager, Attempt $attempt): Response
    {
        $entityManager->remove($attempt);
        $entityManager->flush();

        $this->addFlash('success', "Les résultats du quizz de {$attempt->getPlayer()->getFullName()} ont été supprimés");

        return $this->redirectToRoute('app_admin_user_show', ['id' => $attempt->getPlayer()->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/generer', name: 'generate')]
    public function generate(MistralAPIClient $APIClient, EntityManagerInterface $entityManager, Quizz $quizz): Response
    {
        foreach($quizz->getQuestions() as $question) {
            $entityManager->remove($question);
        }
        $entityManager->flush();

        $questionsString = $APIClient->generateQuestions($quizz->getName(), $quizz->getLevel());
        $questions = explode("\n", trim($questionsString));
        foreach($questions as $question) {
            $question = (new Question())
                ->setQuizz($quizz)
                ->setText($question)
                ->setPosition($entityManager->getRepository(Question::class)->findMaxPositionForQuizz($quizz->getId()) + 1)
                ->setActive(true);
            $entityManager->persist($question);
        }

        $entityManager->flush();

        $this->addFlash('success', "Les questions du quizz {$quizz->getName()} ont été générées");

        return $this->redirectToRoute('app_admin_quizz_show', ['id' => $quizz->getId()], Response::HTTP_SEE_OTHER);
    }
}
