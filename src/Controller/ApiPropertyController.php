<?php

namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/api/property", name="api_")
 */
class ApiPropertyController extends AbstractController
{
    /**
     * @Route(name="property_collection_get", methods={"GET"})
     */
    public function collection(
        PropertyRepository $propertyRepository
    ): Response
    {
        return $this->json($propertyRepository->findAll(), 200, [], ['groups' => 'property:read']);
    }

    /**
     * @Route("/{id}", name="property_item_get", methods={"GET"})
     */
    public function item(
        Property $property
    ): Response
    {
        return $this->json($property, 200, [], ['groups' => 'property:read']);
    }

}
