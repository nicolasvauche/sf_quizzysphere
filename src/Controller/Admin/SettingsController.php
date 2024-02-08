<?php

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Form\Admin\SettingsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/parametres', name: 'app_admin_settings_')]
class SettingsController extends AbstractController
{
    #[Route('/utilisateurs', name: 'users')]
    #[Route('/quizzs', name: 'quizzs')]
    public function users(Request $request, EntityManagerInterface $entityManager): Response
    {
        $settings = $entityManager->getRepository(Settings::class)->find(1);
        if(!$settings) {
            $settings = new Settings();
        }
        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        $currentUri = $request->getRequestUri();
        switch($currentUri) {
            case '/admin/parametres/utilisateurs':
                $currentTemplate = 'admin/settings/users.html.twig';
                $currentUri = '/admin/parametres/users';
                break;
            case '/admin/parametres/quizzs':
                $currentTemplate = 'admin/settings/quizzs.html.twig';
                $currentUri = '/admin/parametres/quizzs';
                break;
        }

        if($form->isSubmitted() && $form->isValid()) {
            switch($request->request->get('type')) {
                case 'users':
                    $settings->setDefaultUserGroup($form->get('defaultUserGroup')->getData());
                    break;
                case 'quizzs':
                    $settings->setQuizzQuestionsMax($form->get('quizzQuestionsMax')->getData());
                    $settings->setQuizzAnswersMax($form->get('quizzAnswersMax')->getData());
                    break;
            }
            $entityManager->persist($settings);
            $entityManager->flush();

            $this->addFlash('success', 'Les paramètres ont été mis à jour');

            return $this->redirect($currentUri);
        }

        return $this->render($currentTemplate, [
            'form' => $form->createView(),
            'settings' => $settings,
        ]);
    }
}
