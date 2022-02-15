<?php

namespace App\Controller;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\Status;
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

    /**
     * @Route("/properties/{name}", name="properties_details")
     */
    public function details(Property $property): Response
    {
        $price = $property->getPrice();
        $area = $property->getArea();
        $priceArea = $price / $area;

        return $this->render('properties/details.html.twig', [
            'property' => $property,
            'priceArea' => $priceArea
        ]);
    }

    /**
     * @Route("/create-realestate", name="properties_create")
     */
    public function create(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response
    {

        $property = new Property();
        $user = $this->getUser();

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $property->setUser($user);
            $property->setStatus('In Progress');

            $entityManager->persist($property);
            $entityManager->flush();

            $this->addFlash('success', 'The information was saved correctly');
            return $this->redirectToRoute('properties_create');
        }



        return $this->render('properties/create.html.twig', [
            'propertyForm' => $form->createView()
        ]);
    }
}
