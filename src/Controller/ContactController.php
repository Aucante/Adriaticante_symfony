<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
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
        MailjetNotification $mailjetNotification,
        TranslatorInterface $translator
    ): Response {
        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        // Variables mail
        $emailAdmin = $this->getParameter('app.contact_email');
        $nameToAdmin = $this->getParameter('app.name');
        $subjectUser = $this->getParameter('app.message_sent_successfully');
        $subjectAdmin = 'Contact from '.$contact->getLastname().' '.$contact->getFirstname().' (Standard form). ';
        $templateIdUser = 3906681;
        $templateIdAdmin = 3909576;

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
//            $contactNotification->notifyContactPage($contact);
            // Mail for user
            $mailjetNotification->send(
                $contact->getEmail(),
                $contact->getLastname().' '.$contact->getFirstname(),
                $templateIdUser,
                $subjectUser,
                $contact->getLastname(),
                $contact->getFirstname(),
                $contact->getPhone(),
                $contact->getEmail(),
                $contact->getMessage(),
            );
            // Mail for adriaticante
            $mailjetNotification->send(
                $emailAdmin,
                $nameToAdmin,
                $templateIdAdmin,
                $subjectAdmin,
                $contact->getLastname(),
                $contact->getFirstname(),
                $contact->getPhone(),
                $contact->getEmail(),
                $contact->getMessage(),
            );

            $messageFlash = $translator->trans('Your message has been sent successfully.');
            $this->addFlash('success', $messageFlash);

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
