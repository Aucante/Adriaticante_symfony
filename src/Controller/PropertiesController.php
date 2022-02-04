<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertiesController extends AbstractController
{
    /**
     * @Route("/properties", name="properties")
     */
    public function properties(PropertyRepository $propertyRepository): Response
    {
        return $this->render('properties/index.html.twig', [
            'properties' => $propertyRepository->findAll(),
        ]);
    }
}
