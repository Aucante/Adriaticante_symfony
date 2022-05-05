<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index(
        PropertyRepository $propertyRepository
    ): Response
    {
        return $this->render('about/index.html.twig', [
            'properties' => $propertyRepository->lastFive(),
        ]);
    }
}
