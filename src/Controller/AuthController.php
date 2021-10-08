<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request,AuthenticationUtils $authenticationUtils, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {

        $user = new User();
        $user->setCreatedAt(new \DateTime('today'));
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            //  $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            //      (new TemplatedEmail())
            //          ->from(new Address('no-replay@medium-selim.com', 'security'))
            //          ->to($user->getEmail())
            //          ->subject('Please Confirm your Email')
            //          ->htmlTemplate('registration/confirmation_email.html.twig')
            //  );
            // do anything else you need here, like send an email

            return $this->redirectToRoute('article_index');
        }

         if ($this->getUser()) {
            return $this->redirectToRoute('article_index');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error, 'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        // controller can be blank: it will never be executed!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
