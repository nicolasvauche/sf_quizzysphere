<?php

namespace App\Controller\Admin;

use App\Entity\Quizz;
use App\Entity\QuizzCategory;
use App\Form\Admin\QuizzType;
use App\Service\FileUploaderService;
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
}
