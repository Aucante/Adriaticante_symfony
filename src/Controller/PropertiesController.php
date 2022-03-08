<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Contact;
use App\Entity\File;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\ContactType;
use App\Form\PropertySearchType;
use App\Form\PropertyType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

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

        // Filter search
        $search = new SearchData();
        $formSearch = $this->createForm(PropertySearchType::class, $search);
        $formSearch->handleRequest($request);

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


        return $this->render('properties/index.html.twig', [
            'properties' => $properties,
            'formSearch' => $formSearch->createView()
        ]);
    }


    /**
     * @Route("/my-properties", name="user_properties")
     */
    public function userProperties(
        PropertyRepository $propertyRepository
    ): Response
    {
        $user = $this->getUser();

        $userProperties = $propertyRepository->findUserProperties($user);

        return $this->render('properties/userProperties.html.twig', [
            'userProperties' => $userProperties
        ]);
    }

    /**
     * @Route("/properties/{id}", name="properties_details")
     */
    public function details(
        Request $request,
        Property $property,
        ContactNotification $contactNotification,
        TranslatorInterface $translator
    ): Response
    {
        $contact = new Contact();
        $contact->setProperty($property);
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        $price = $property->getPrice();
        $area = $property->getArea();
        $priceArea = $price / $area;

        $user = $property->getUser();

        if ($contactForm->isSubmitted() && $contactForm->isValid())
        {
            $contactNotification->notify($contact, $user);
            $messageFlash = $translator->trans('Email has been sent successfully.');
            $this->addFlash('success', $messageFlash);
            $this->redirectToRoute('properties_details', ['id' => $property->getId()]);
        }

        return $this->render('properties/details.html.twig', [
            'property' => $property,
            'priceArea' => $priceArea,
            'contactForm' => $contactForm->createView()
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
            return $this->redirectToRoute('properties_add_photos_vue', ['id' => $property->getId()]);
        }

        return $this->render('properties/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete-realestate/{id}", name="properties_delete")
     */
    public function delete(
        Property $property,
        EntityManagerInterface $entityManager
    ): Response
    {
        $entityManager->remove($property);
        $entityManager->flush();
        $this->addFlash('success', 'Real estate deleted.');
        return $this->redirectToRoute('user_properties');


    }

    /**
     * @Route("/update-realestate/{id}", name="properties_update")
     */
    public function update(
        Request $request,
        Property $property
    ): Response
    {

        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'The real estate informations were updated correctly.');
            return $this->redirectToRoute('home');
        }

        return $this->render('properties/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/addPhotos-realestate-vue/{id}", name="properties_add_photos_vue")
     */
    public function addPhotosVue(
        Request $request,
        Property $property
    ): Response
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
            $fileName = $property->getName() . uniqid('_', true) . '.' . $currentFile->getClientOriginalExtension();
            if ($fileName)
            {
                try {
                    $currentFile->move($kernel->getProjectDir() . '/public/uploads/properties', $fileName);
                    $file = new File();
                    $file->setProperty($property)
                        ->setName($fileName);

                    $entityManager->persist($file);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                    $this->addFlash('error', 'Upload failed.');
                    return $this->redirectToRoute('properties_add_photos_vue', ['id' => $property->getId()]);
                }
            }
        }
        $entityManager->flush();

        $this->addFlash('success', 'Upload successful.');
        return $this->redirectToRoute('user_properties');
    }




}
