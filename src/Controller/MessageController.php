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
        ThreadRepository $threadRepository
    ): Response {
        $user = $this->getUser();
        $threads = $threadRepository->findSenderAndRecipientThread($user);

        return $this->render('message/index.html.twig', [
            'threads' => $threads,
        ]);
    }

    /**
     * @Route("/messages/from-seller", name="messages_from_seller")
     */
    public function threadOnlyFromSeller(
        ThreadRepository $threadRepository
    ): Response {
        $user = $this->getUser();
        $threads = $threadRepository->findThreadAsSender($user);

        return $this->render('message/messagesFromSeller.html.twig', [
            'threads' => $threads,
        ]);
    }

    /**
     * @Route("/messages/from-purchaser", name="messages_from_purchaser")
     */
    public function threadOnlyFromPurchaser(
        ThreadRepository $threadRepository
    ): Response {
        $user = $this->getUser();
        $threads = $threadRepository->findThreadAsRecipient($user);

        return $this->render('message/messagesFromPurchaser.html.twig', [
            'threads' => $threads,
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
    ): Response {
        $user = $this->getUser();

        $messageRepository->updateRecipientMessageNotRead($thread, $user);

        $messages = $thread->getMessages();

        if ($this->getUser() === $thread->getSender()) {
            $recipient = $thread->getProperty()->getUser();
            $messagesNotRead = $messageRepository->findSenderMessageNotRead($user);
        } else {
            $recipient = $thread->getSender();
            $messagesNotRead = $messageRepository->findRecipientMessageNotRead($user);
        }

        $answer = new Message();
        $answerForm = $this->createForm(MessageType::class, $answer);
        $answerForm->handleRequest($request);

        if ($answerForm->isSubmitted() && $answerForm->isValid()) {
            $answer->setThread($thread);
            $answer->setSender($user);
            $answer->setRecipient($recipient);
            $entityManager->persist($answer);
            $entityManager->flush();

            $messageFlash = $translator->trans('Your message was sent successfully.');
            $this->addFlash('success', $messageFlash);
            $this->redirectToRoute('messages');
        }
        $entityManager->flush();

        return $this->render('message/thread.html.twig', [
            'messageNotRead' => $messagesNotRead,
            'messages' => $messages,
            'thread' => $thread,
            'answerForm' => $answerForm->createView(),
        ]);
    }
}
