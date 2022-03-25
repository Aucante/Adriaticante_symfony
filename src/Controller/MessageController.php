<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Thread;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Repository\ThreadRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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
        MessageRepository $messageRepository,
        Thread $thread,
        Request $request,
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator
    ): Response
    {
        $recipient = $this->getUser();
        $messagesNotRead = $messageRepository->findRecipientMessageNotRead($recipient);

        $messages = $thread->getMessages();

        $answer = new Message();
        $answerForm = $this->createForm(MessageType::class, $answer);
        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid())
        {
            $answer->setThread($thread);
            $answer->setSender($thread->getSender());
            $answer->setRecipient($recipient);
            $entityManager->persist($answer);
            $entityManager->flush();


            $messageFlash = $translator->trans('Your reply was sent successfully.');
            $this->addFlash('success', $messageFlash);
            $this->redirectToRoute('messages_thread', ['title' => $thread->getTitle()]);

        }

        return $this->render('message/thread.html.twig', [
            'messageNotRead' => $messagesNotRead,
            'messages' => $messages,
            'answerForm' => $answerForm->createView()
        ]);
    }
}
