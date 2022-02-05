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
        $properties->setCustomParameters([
            'align' => 'center', # center|right (for template: twitter_bootstrap_v4_pagination and foundation_v6_pagination)
            'size' => '', # small|large (for template: twitter_bootstrap_v4_pagination)
            'rounded' => true,
            'span_class' => 'whatever',
        ]);


        return $this->render('properties/index.html.twig', [
            'properties' => $properties
        ]);
    }
}
