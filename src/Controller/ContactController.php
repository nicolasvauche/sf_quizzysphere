<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact', name: 'app_contact_')]
class ContactController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/', name: 'index')]
    public function index(Request $request, MailerService $mailerService): Response
    {
        $defaultData = [
            'email' => $this->getUser()?->getEmail(),
            'name' => $this->getUser()?->getFullname(),
        ];

        $form = $this->createForm(ContactType::class, $defaultData);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $mailerService->sendEmail([
                'from' => [
                    'name' => $form->get('name')->getData(),
                    'email' => $form->get('email')->getData(),
                ],
                'to' => [
                    'name' => 'Administrateur QuizzySphere',
                    'email' => 'hello@nicolasvauche.net',
                ],
                'subject' => $form->get('subject')->getData(),
                'message' => $form->get('message')->getData(),
            ]);

            $this->addFlash('success', 'Votre message a été envoyé');

            return $this->redirectToRoute('app_contact_index');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
