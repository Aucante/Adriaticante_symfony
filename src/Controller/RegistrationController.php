<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Notification\MailjetNotification;
use App\Security\AppAuthenticator;
use App\Service\ManagePictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="app_register")
     */
    public function registerChoice(): Response
    {
        return $this->render('registration/registerChoice.html.twig', [
        ]);
    }

    /**
     * @Route("/professional/register", name="app_register_professional")
     */
    public function registerProfessional(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        AppAuthenticator $authenticator,
        EntityManagerInterface $entityManager,
        ManagePictureService $managePictureService,
        MailjetNotification $mailjetNotification
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $user->setFile('adriaticante.png');

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            if ($file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $managePictureService->addImageUser($originalFilename, $file, $user);
            }

            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setProfessional(true);
            $user->setUpdatedAt(new \DateTimeImmutable());
            $user->setRoles((array) ['ROLE_USER']);

            $entityManager->persist($user);
            $entityManager->flush();
            // Email notification

            // Variables mail
            $emailFrom = 'adriaticante.pro@gmail.com';
            $nameFrom = 'Adriaticante';
            $subject = 'Welcome ' . $user->getFirstname() . '.';
            $templateId = 3906679;

            $mailjetNotification->send(
                $emailFrom,
                $nameFrom,
                $user->getEmail(),
                $user->getLastname() . ' ' . $user->getFirstname(),
                $templateId,
                $subject,
                $user->getFirstname(),
                "",
                "",
                "",
                ""
            );


            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/registerProfessional.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/particular/register", name="app_register_particular")
     */
    public function registerParticular(
        Request $request,
        UserPasswordHasherInterface $userPasswordHasher,
        UserAuthenticatorInterface $userAuthenticator,
        AppAuthenticator $authenticator,
        EntityManagerInterface $entityManager,
        ManagePictureService $managePictureService,
        MailjetNotification $mailjetNotification
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setProfessional(false);
            $user->setCompany('N/A'.' '.uniqid());
            $user->setUpdatedAt(new \DateTimeImmutable());
            $user->setRoles((array) ['ROLE_USER']);
            dump($user);

            $entityManager->persist($user);
            $entityManager->flush();

            // Variables mail
            $emailFrom = 'adriaticante.pro@gmail.com';
            $nameFrom = 'Adriaticante';
            $subject = 'Welcome ' . $user->getFirstname() . '.';
            $templateId = 3906679;

            $mailjetNotification->send(
                $emailFrom,
                $nameFrom,
                $user->getEmail(),
                $user->getLastname() . ' ' . $user->getFirstname(),
                $templateId,
                $subject,
                $user->getFirstname(),
                "",
                "",
                "",
                ""
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/registerParticular.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
