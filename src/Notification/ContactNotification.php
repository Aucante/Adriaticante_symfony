<?php
namespace App\Notification;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;

class ContactNotification {

    protected MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function notifyPropertyPage(Contact $contact, User $user): void
    {
        $email = (new TemplatedEmail());
        $email->from($contact->getEmail())
            ->to($user->getEmail())
            ->subject('New message from Adriaticante for : ' . $contact->getProperty()->getName())
            ->htmlTemplate('emails/contact_property.html.twig')
            ->context([
                'property' => $contact->getProperty()->getName(),
                'mail' => $contact->getEmail(),
                'message' => $contact->getMessage()
            ]);
        $this->mailer->send($email);
    }

    public function notifyContactPage(Contact $contact): void
    {
        $email = (new TemplatedEmail());
        $email->from($contact->getEmail())
            ->to('contact@adriaticante.com')
            ->subject('New message from contact page' )
            ->htmlTemplate('emails/contact_page.html.twig')
            ->context([
                'mail' => $contact->getEmail(),
                'message' => $contact->getMessage(),
                'lastname' => $contact->getLastname(),
                'firstname' => $contact->getfirstname(),
            ]);
        $this->mailer->send($email);
    }

}