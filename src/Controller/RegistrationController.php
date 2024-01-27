<?php

namespace App\Controller;

use App\Entity\Settings;
use App\Entity\User;
use App\Form\RegistrationType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request                     $request,
                             UserPasswordHasherInterface $userPasswordHasher,
                             UserAuthenticatorInterface  $userAuthenticator,
                             LoginFormAuthenticator      $authenticator,
                             EntityManagerInterface      $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setActive(true);

            $settings = $entityManager->getRepository(Settings::class)->find(1);
            if($settings->getDefaultUserGroup() !== null) {
                $user->addUserGroup($settings->getDefaultUserGroup());
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Bienvenue dans la QuizzySphere, ' . $user->getUsername() . ' !');

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
