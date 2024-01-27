<?php

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Form\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parametres', name: 'app_admin_settings_')]
class SettingsController extends AbstractController
{
    #[Route('/utilisateurs', name: 'users')]
    public function users(Request $request, EntityManagerInterface $entityManager): Response
    {
        $settings = $entityManager->getRepository(Settings::class)->find(1);
        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $settings = $form->getData();
            $entityManager->persist($settings);
            $entityManager->flush();

            $this->addFlash('success', 'Les paramètres ont été mis à jour');

            return $this->redirectToRoute('app_admin_settings_users');
        }

        return $this->render('admin/settings/users.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
