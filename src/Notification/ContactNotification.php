<?php
namespace App\Notification;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactNotification {

    protected MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }


    public function notify(Contact $contact): void
    {
        $email = new Email();
        $email->from('adriaticante@contact.com')
            ->to('Papercut@user.com')
            ->subject('new message : ' . $contact->getMessage() . $contact->getProperty()->getId())
            ->html('<p>ok</p>');
        $this->mailer->send($email);
    }
}