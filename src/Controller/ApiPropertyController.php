<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class ApiPropertyController extends AbstractController
{
    /**
     * @Route("/api/property", name="api_property_index", methods={"GET"})
     */
    public function index(
        PropertyRepository $propertyRepository
    ): Response
    {
        return $this->json($propertyRepository->findAll(), 200, [], ['groups' => 'property:read']);
    }
}
