<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Form\Admin\CourseType;
use App\Service\FileUploaderService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/parcours', name: 'app_admin_course_')]
class CourseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/course/index.html.twig', [
            'courses' => $entityManager->getRepository(Course::class)->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'add')]
    public function add(Request                $request,
                        EntityManagerInterface $entityManager,
                        FileUploaderService    $fileUploaderService,
                        SluggerInterface       $slugger): Response
    {
        $course = (new Course())
            ->setActive(true);
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $coverFileName = $fileUploaderService->upload($coverFile, 'course', strtolower($slugger->slug($course->getName())));
                $course->setCover($coverFileName);
            }

            $entityManager->persist($course);
            $entityManager->flush();

            $this->addFlash('success', "Le parcours {$course->getName()} a été créé");

            return $this->redirectToRoute('app_admin_course_index');
        }

        return $this->render('admin/course/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'show')]
    public function show(Course $course): Response
    {
        return $this->render('admin/course/show.html.twig', [
            'course' => $course,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request                $request,
                         EntityManagerInterface $entityManager,
                         FileUploaderService    $fileUploaderService,
                         SluggerInterface       $slugger,
                         Course                 $course): Response
    {
        $form = $this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $coverFile */
            $coverFile = $form->get('cover')->getData();
            if($coverFile) {
                $fileUploaderService->remove('course/' . $course->getCover());
                $coverFileName = $fileUploaderService->upload($coverFile, 'course', strtolower($slugger->slug($course->getName())));
                $course->setCover($coverFileName);
            }

            $entityManager->persist($course);
            $entityManager->flush();

            $this->addFlash('success', "Le parcours {$course->getName()} a été modifié");

            return $this->redirectToRoute('app_admin_course_show', ['id' => $course->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/course/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete', methods: ['GET'])]
    public function delete(Course                 $course,
                           EntityManagerInterface $entityManager,
                           FileUploaderService    $fileUploaderService): Response
    {
        /*foreach($quizzCategory->getQuizzs() as $quizz) {
            $quizz->setQuizzCategory(null);
            $entityManager->persist($quizz);
        }*/

        foreach($course->getQuizzCategories() as $courseCategory) {
            $courseCategory->setParent(null);
            $entityManager->persist($courseCategory);
        }

        $fileUploaderService->remove('course/' . $course->getCover());

        $entityManager->remove($course);
        $entityManager->flush();

        $this->addFlash('success', "Le parcours {$course->getName()} a été supprimé");

        return $this->redirectToRoute('app_admin_course_index', [], Response::HTTP_SEE_OTHER);
    }
}
