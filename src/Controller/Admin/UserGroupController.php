<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\UserGroup;
use App\Form\Admin\UserGroupType;
use App\Form\Admin\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/utilisateurs/groupes', name: 'app_admin_usergroup_')]
class UserGroupController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        return $this->render('admin/usergroup/index.html.twig', [
            'userGroups' => $entityManager->getRepository(UserGroup::class)->findAll(),
        ]);
    }

    #[Route('/nouveau', name: 'add')]
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $userGroup = (new UserGroup())
            ->setActive(true);
        $form = $this->createForm(UserGroupType::class, $userGroup);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($userGroup);
            $entityManager->flush();

            $this->addFlash('success', "Le groupe d'utilisateurs {$userGroup->getName()} a été créé");

            return $this->redirectToRoute('app_admin_usergroup_index');
        }

        return $this->render('admin/usergroup/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/details', name: 'show')]
    public function show(UserGroup $userGroup): Response
    {
        return $this->render('admin/usergroup/show.html.twig', [
            'userGroup' => $userGroup,
        ]);
    }

    #[Route('/{id}/modifier', name: 'edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, UserGroup $userGroup): Response
    {
        $form = $this->createForm(UserGroupType::class, $userGroup, [
            'mode' => 'edit',
            'members' => $entityManager->getRepository(User::class)->findAll(),
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', "Le groupe d'utilisateurs {$userGroup->getName()} a été modifié");

            return $this->redirectToRoute('app_admin_usergroup_index');
        }

        return $this->render('admin/usergroup/edit.html.twig', [
            'userGroup' => $userGroup,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/supprimer', name: 'delete')]
    public function delete(EntityManagerInterface $entityManager, UserGroup $userGroup): Response
    {
        $entityManager->remove($userGroup);
        $entityManager->flush();

        $this->addFlash('success', "Le groupe d'utilisateurs {$userGroup->getName()} a été supprimé");

        return $this->redirectToRoute('app_admin_usergroup_index');
    }
}
