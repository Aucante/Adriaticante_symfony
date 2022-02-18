<?php

namespace App\Controller;

use App\Entity\File;
use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\Status;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use function PHPUnit\Framework\directoryExists;

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

            $this->addFlash('success', 'The real estate informations were saved correctly.');
            return $this->redirectToRoute('properties_add_features', ['id' => $property->getId()]);
        }



        return $this->render('properties/create.html.twig', [
            'propertyForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/addfeatures-realestate/{id}", name="properties_add_features")
     */
    public function addFeatures(Property $property): Response
    {
        return $this->render('properties/addFeatures.html.twig', [
            'property' => $property
        ]);
    }

    /**
     * @Route("/addfiles-realestate/{id}", name="properties_add_files")
     */
    public function addFiles(Property $property): Response
    {

        return $this->render('properties/addFiles.html.twig', [
            'property' => $property
        ]);
    }

    /**
     * @Route("/addPhotos-realestate/{id}", name="properties_add_photos")
     */
    public function addPhotos(Request $request, Property $property, KernelInterface $kernel, EntityManagerInterface $entityManager): Response
    {

        foreach ($request->files as $currentFile)
        {
            /** @var $currentFile UploadedFile */
            $fileName = $property->getId() . uniqid('_', true) . '.' . $currentFile->getClientOriginalExtension();
            $res = $currentFile->move($kernel->getProjectDir() . '/public/upload/properties', $fileName);
            $file = new File();
            $file->setProperty($property)
                ->setName($fileName);

            $entityManager->persist($file);

        }
        $entityManager->flush();

        return new JsonResponse([
            'success' => true
        ]);
    }


}
