<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertiesController extends AbstractController
{
    /**
     * @Route("/properties", name="properties")
     */
    public function properties(
        PropertyRepository $propertyRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data = $propertyRepository->findAll();

        $properties = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            8
        );

        return $this->render('properties/index.html.twig', [
            'properties' => $properties,
        ]);
    }
}
