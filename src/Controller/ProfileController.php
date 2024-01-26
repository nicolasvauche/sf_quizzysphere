<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserGroup;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfileController extends AbstractController
{
    #[Route('/mon-compte', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->find($this->getUser()->getId());
        $form = $this->createForm(ProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /*$formUserGroups = $form->get('userGroups')->getData();

            foreach($entityManager->getRepository(UserGroup::class)->findAll() as $mainUserGroup) {
                if($formUserGroups->contains($mainUserGroup)) {
                    $mainUserGroup->addMember($user);
                    $entityManager->persist($mainUserGroup);
                } else {
                    $mainUserGroup->removeMember($user);
                    $entityManager->persist($mainUserGroup);
                }
            }*/

            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() && !$form->isValid() ? 422 : 200));
    }
}
