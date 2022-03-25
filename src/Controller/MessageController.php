<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\ThreadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MessageController extends AbstractController
{
    /**
     * @Route("/messages", name="messages")
     */
    public function index(
        MessageRepository $messageRepository
    ): Response
    {
        $user = $this->getUser();
        $messagesNotRead = $messageRepository->findRecipientMessageNotRead($user);

        return $this->render('message/index.html.twig', [
            'messageNotRead' => $messagesNotRead
        ]);
    }

    /**
     * @Route("/thread/messages/{title}", name="messages_thread")
     */
    public function showThread(
        MessageRepository $messageRepository
    ): Response
    {
        $user = $this->getUser();
        $messagesNotRead = $messageRepository->findRecipientMessageNotRead($user);

        return $this->render('message/thread.html.twig', [
            'messageNotRead' => $messagesNotRead
        ]);
    }
}
