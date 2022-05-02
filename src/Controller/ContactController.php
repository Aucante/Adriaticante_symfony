<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Notification\MailjetNotification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(
        Request $request,
        ContactNotification $contactNotification,
        MailjetNotification $mailjetNotification,
        TranslatorInterface $translator
    ): Response {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
//            $contactNotification->notifyContactPage($contact);
            $mailjetNotification->send(
                'adriaticante.pro@gmail.com',
                'test',
                'sujet',
                'contenu'
            );
            $messageFlash = $translator->trans('Your message has been sent successfully.');
            $this->addFlash('success', $messageFlash);
            $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
