<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = (new Email())
                ->from($data['from'])
                ->to('admin@admin.com')
                ->subject($data['subject'])
                ->text($data['body']);

            $mailer->send($email);

            return $this->redirectToRoute('app_contact_success');
        }
        return $this->renderForm('contact/index.html.twig', [
            'form' => $form
        ]);
    }

    /**
     * @Route("/contact/success", name="app_contact_success")
     */
    public function success(): Response
    {
        return $this->render('contact/success.html.twig', [
        ]);
    }
}
