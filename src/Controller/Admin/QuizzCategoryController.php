<?php

namespace App\Controller\Admin;

use App\Entity\QuizzCategory;
use App\Form\Admin\QuizzCategoryType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/quizzcategory', name: 'app_admin_quizzcategory_')]
class QuizzCategoryController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/quizzcategory/index.html.twig', [
            'quizzCategories' => $entityManager->getRepository(QuizzCategory::class)->findTopLevelCategories(),
        ]);
    }

    #[Route('/nouvelle', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager,
                        FileUploaderService    $fileUploaderService,
                        SluggerInterface       $slugger): Response
    {
        $quizzCategory = (new QuizzCategory())
            ->setActive(true);
        $form = $this->createForm(QuizzCategoryType::class, $quizzCategory);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $coverFileName = $fileUploaderService->upload($coverFile, 'quizz_category', strtolower($slugger->slug($quizzCategory->getName())));
                $quizzCategory->setCover($coverFileName);
            }

            $entityManager->persist($quizzCategory);
            $entityManager->flush();

            $this->addFlash('success', "La catégorie {$quizzCategory->getName()} a été créée");

            return $this->redirectToRoute('app_admin_quizzcategory_index');
        }

        return $this->render('admin/quizzcategory/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(QuizzCategory $quizzCategory): Response
    {
        return $this->render('admin/quizzcategory/show.html.twig', [
            'quizzCategory' => $quizzCategory,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request                $request,
                         EntityManagerInterface $entityManager,
                         FileUploaderService    $fileUploaderService,
                         SluggerInterface       $slugger,
                         QuizzCategory          $quizzCategory): Response
    {
        $form = $this->createForm(QuizzCategoryType::class, $quizzCategory);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $fileUploaderService->remove('quizz_category/' . $quizzCategory->getCover());
                $coverFileName = $fileUploaderService->upload($coverFile, 'quizz_category', strtolower($slugger->slug($quizzCategory->getName())));
                $quizzCategory->setCover($coverFileName);
            }

            $entityManager->persist($quizzCategory);
            $entityManager->flush();

            $this->addFlash('success', "La catégorie {$quizzCategory->getName()} a été modifiée");

            return $this->redirectToRoute('app_admin_quizzcategory_show', ['id' => $quizzCategory->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/quizzcategory/edit.html.twig', [
            'quizzCategory' => $quizzCategory,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete', methods: ['GET'])]
    public function delete(QuizzCategory          $quizzCategory,
                           EntityManagerInterface $entityManager,
                           FileUploaderService    $fileUploaderService): Response
    {
        /*foreach($quizzCategory->getQuizzs() as $quizz) {
            $quizz->setQuizzCategory(null);
            $entityManager->persist($quizz);
        }*/

        foreach($quizzCategory->getChildren() as $subCategory) {
            $subCategory->setParent(null);
            $entityManager->persist($subCategory);
        }

        $fileUploaderService->remove('quizz_category/' . $quizzCategory->getCover());

        $entityManager->remove($quizzCategory);
        $entityManager->flush();

        $this->addFlash('success', "La catégorie {$quizzCategory->getName()} a été supprimée");

        return $this->redirectToRoute('app_admin_quizzcategory_index', [], Response::HTTP_SEE_OTHER);
    }
}
