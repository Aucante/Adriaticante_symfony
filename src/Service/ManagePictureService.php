<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ManagePictureService
{
    protected SluggerInterface $slugger;
    private ParameterBagInterface $params;

    public function __construct(SluggerInterface $slugger, ParameterBagInterface $params)
    {
        $this->slugger = $slugger;
        $this->params = $params;
    }

    public function addImageUser(string $originalFilename, UploadedFile $file, User $user)
    {
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();

        $file->move(
            $this->params->get('file_user_directory'),
            $newFilename);

        $user->setFile($newFilename);
    }
}