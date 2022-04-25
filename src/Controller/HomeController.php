<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\PropertySearchType;
use App\Repository\CountryRepository;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        PropertyRepository $propertyRepository,
        CountryRepository $countryRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        // Filter search
        $search = new SearchData();
        $formSearch = $this->createForm(PropertySearchType::class, $search);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted())
        {
            $data = $propertyRepository->findSearch($search);
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

            return $this->redirectToRoute('property');
        }

        return $this->render('home/index.html.twig', [
            'property' => $propertyRepository->lastThree(),
            'formSearch' => $formSearch->createView(),
            'countries' => $countryRepository->findAll()
        ]);
    }
}
