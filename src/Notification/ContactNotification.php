<?php
namespace App\Notification;

use App\Entity\Contact;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactNotification {

    protected MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function notify(Contact $contact, User $user): void
    {
        $email = (new TemplatedEmail());
        $email->from($contact->getEmail())
            ->to($user->getEmail())
            ->subject('new message : ' . $contact->getProperty()->getName())
            ->htmlTemplate('emails/contact_property.html.twig')
            ->context([
                'property' => $contact->getProperty()->getName(),
                'mail' => $contact->getEmail(),
                'message' => $contact->getMessage()
            ]);
        $this->mailer->send($email);
    }
}