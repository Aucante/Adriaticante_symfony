<?php

namespace App\Twig;

use App\Entity\User;
use App\Repository\ThreadRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ThreadExtension extends AbstractExtension
{
    private ?array $result = null;

    private ThreadRepository $threadRepository;

    public function __construct(ThreadRepository $threadRepository)
    {
        $this->threadRepository = $threadRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('threads_not_read', [$this, 'getThreadsNotRead']),
        ];
    }

    public function getThreadsNotRead(?User $user): array
    {
        if (null != $this->result) {
            return $this->result;
        }
        $threads = $this->threadRepository->findSenderAndRecipientThread($user);
        $threadsNotRead = array_filter($threads, function ($thread) {
            return 1 == $thread[1];
        });
        $this->result = [
        'totalNotRead' => count($threadsNotRead),
        'total' => count($threads),
        ];

        return $this->result;
    }
}
