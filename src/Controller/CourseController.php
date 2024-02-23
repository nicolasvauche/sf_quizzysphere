<?php

namespace App\Controller;

use App\Entity\Course;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parcours', name: 'app_course_')]
class CourseController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if($this->getUser()) {
            $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
            if($user) {
                $userCourses = $user->getUserCourses();
            }
        }

        if($userCourses && sizeof($userCourses) === 1) {
            return $this->redirectToRoute('app_course_show', ['slug' => $userCourses[0]->getSlug()]);
        }

        return $this->render('course/index.html.twig', [
            'courses' => $userCourses ?? null,
        ]);
    }

    #[Route('/{slug}/details', name: 'show')]
    public function show(Course $course): Response
    {

        return $this->render('course/show.html.twig', [
            'course' => $course,
        ]);
    }
}
