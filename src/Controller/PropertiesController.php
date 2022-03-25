<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Contact;
use App\Entity\Image;
use App\Entity\Message;
use App\Entity\Property;
use App\Entity\Thread;
use App\Form\ContactType;
use App\Form\MessageType;
use App\Form\PropertySearchType;
use App\Form\PropertyType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class PropertiesController extends AbstractController
{
    /**
     * @Route("/real-estate", name="property")
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


        return $this->render('property/index.html.twig', [
            'properties' => $properties,
            'formSearch' => $formSearch->createView()
        ]);
    }


    /**
     * @Route("/user/real-estate", name="user_properties")
     */
    public function userProperties(
        PropertyRepository $propertyRepository
    ): Response
    {
        $user = $this->getUser();

        $userProperties = $propertyRepository->findUserProperties($user);

        return $this->render('property/userProperties.html.twig', [
            'userProperties' => $userProperties
        ]);
    }


    /**
     * @Route("/real-estate/create", name="properties_create")
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
            $property->setCreatedAt(new \DateTimeImmutable());
            $property->setStatus('In Progress');

            // Recuperate Files
            $files = $form->get('images')->getData();
            dump($files);
            foreach ($files as $file)
            {
                /** @var File $file */
                // Generate new files name
                $fileUploaded = md5(uniqid()) . '.' . $file->guessExtension();

                // Copy file in upload folder
                $file->move(
                    $this->getParameter('file_property_directory'),
                    $fileUploaded
                );

                // Persist file in database
                $image = new Image();
                $image->setName($fileUploaded);
                $property->addImage($image);
            }
            $entityManager->persist($property);
            $entityManager->flush();

            $this->addFlash('success', 'The real estate informations were saved correctly.');
            return $this->redirectToRoute('user_properties');
        }

        return $this->render('property/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/real-estate/{slug}", name="properties_details")
     */
    public function details(
        Request $request,
        Property $property,
        TranslatorInterface $translator,
        EntityManagerInterface $entityManager
    ): Response
    {
        $price = $property->getPrice();
        $area = $property->getArea();
        $priceArea = $price / $area;

        $sender = $this->getUser();
        $recipient = $property->getUser();

        $message = new Message();
        $messageForm = $this->createForm(MessageType::class, $message);
        $messageForm->handleRequest($request);

        if ($messageForm->isSubmitted() && $messageForm->isValid())
        {
            $title = 'Message for ' . $property->getSlug() . ' from ' . $sender->getUsername();

            $thread = new Thread();
            $thread->setTitle($title);
            $thread->setSender($sender);
            $thread->setProperty($property);

            $message->setThread($thread);
            $message->setSender($sender);
            $message->setRecipient($recipient);

            $entityManager->persist($thread);
            $entityManager->persist($message);
            $entityManager->flush();
           // $contactNotification->notifyPropertyPage($contact, $user);
            $messageFlash = $translator->trans('Email has been sent successfully.');
            $this->addFlash('success', $messageFlash);
            $this->redirectToRoute('properties_details', ['slug' => $property->getSlug()]);
        }

        return $this->render('property/details.html.twig', [
            'property' => $property,
            'priceArea' => $priceArea,
            'messageForm' => $messageForm->createView()
        ]);
    }

    /**
     * @Route("/real-estate/delete/{slug}", name="properties_delete")
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
     * @Route("/addPhotos-realestate-vue/{id}", name="properties_add_photos_vue")
     */
    public function addPhotosVue(
        Request $request,
        Property $property
    ): Response
    {
        return $this->render('property/addFiles.html.twig', [
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
                    $currentFile->move($kernel->getProjectDir() . '/public/uploads/property', $fileName);
                    $file = new Image();
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
