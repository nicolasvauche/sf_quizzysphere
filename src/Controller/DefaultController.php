<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\QuizzService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager, QuizzService $quizzService): Response
    {
        if($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_index');
        }

        if($this->getUser()) {
            $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
            if($user) {
                $userCourses = $user->getUserCourses();
                $userQuizzCategories = new ArrayCollection();
                foreach($userCourses as $userCourse) {
                    foreach($userCourse->getQuizzCategories() as $userQuizzCategory) {
                        if(!$userQuizzCategories->contains($userQuizzCategory)) {
                            $userQuizzCategories->add($userQuizzCategory);
                        }
                    }
                }
            }
        }

        return $this->render('default/index.html.twig', [
            'users' => $entityManager->getRepository(User::class)->findByNotAdmin(),
            'userCourses' => $userCourses ?? null,
            'userCategories' => $userQuizzCategories ?? null,
        ]);
    }

    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('default/cgu.html.twig');
    }
}
