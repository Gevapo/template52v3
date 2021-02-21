<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\LoginFormAuthenticator;
use App\Service\Mailer;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use function Sodium\add;

class SecurityController extends AbstractController
{

    private VerifyEmailHelperInterface $verifyEmailHelper;

    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper)
    {
        $this->verifyEmailHelper = $verifyEmailHelper;
    }

    /**
     * @Route("/login", name="login")
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     * @throws Exception
     */
    public function logout()
    {
        throw new Exception('Will be intercepted before getting here');
    }

    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param Mailer $mailer
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return Response|null
     * @throws TransportExceptionInterface
     */
    public function register(
        Request $request, Mailer $mailer,
        UserPasswordEncoderInterface $passwordEncoder,
        GuardAuthenticatorHandler $guardHandler,
        LoginFormAuthenticator $formAuthenticator): ?Response
    {
            $error = '';
        if ($request->isMethod('POST')) {

            if (empty($request->request->get('email'))) {
                $this->addFlash('verify_email_error', 'Gelieve een correct e-mailadres in te vullen!');
                $error = 'email_error';
//                array_push($errors, 'email_error');
            } elseif (empty($request->request->get('password'))) {
                $this->addFlash('verify_password_error', 'Een wachtwoord is verpicht!');
                $error = 'password_error';
            } elseif (empty($request->request->get('privacy'))) {
                $this->addFlash('verify_privacy_error', 'Gelieve de privacyverklaring te lezen!');
                $error = 'privacy_error';
            } else {
//                dd($request->request->get('privacy'));
                $user = new User();
                $user
                    ->setEmail($request->request->get('email')) // get $_POST data
    //              ->setFirstName('Mystery');
                    ->setPassword($passwordEncoder->encodePassword(
                    $user,
                    $request->request->get('password')
                ));

                $em = $this->getDoctrine()->getManager();
                $roles[] = 'ROLE_VISITOR';
                $user->setRoles($roles);
                $em->persist($user);
                $em->flush();

                $mailer->sendRegistrationMessage($user);

                $this->addFlash('success', 'De registratiemail is verzonden.');

                // Authentication after Registration
//                return $guardHandler->authenticateUserAndHandleSuccess(
//                    $user,
//                    $request,
//                    $formAuthenticator,
//                    'main'
//                );

                return $this->redirectToRoute('homepage');

            }
        }

        return $this->render('security/register.html.twig', [
            'error' => $error,
        ]);
    }


    /**
     * @Route("/verify", name="verify")
     * @param Request $request
     * @param UserRepository $userRepository
     * @param GuardAuthenticatorHandler $guardHandler
     * @param LoginFormAuthenticator $formAuthenticator
     * @return Response|null
     */
    public function verifyUserEmail(Request $request, UserRepository $userRepository, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator): ?Response
    {
//        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
//        $user = $this->getUser();

        $id = $request->get('id'); // retrieve the user id from the url

        // Verify the user id exists and is not null
        if (null === $id) {
            return $this->redirectToRoute('homepage');
        }

        $user = $userRepository->find($id);

        // Ensure the user exists in persistence
        if (null === $user) {
            return $this->redirectToRoute('homepage');
        }

        try {
            $this->verifyEmailHelper->validateEmailConfirmation(
                $request->getUri(), $user->getId(), $user->getEmail()
            );
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('verify_email_error', $e->getReason());
            return $this->redirectToRoute('register');
        }

        $em = $this->getDoctrine()->getManager();
        $roles[] = 'ROLE_VERIFIED'; // ROLE_VERIFIED
        $user->setRoles($roles);
        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'Uw email werd geverifieerd.');

        return $guardHandler->authenticateUserAndHandleSuccess(
            $user,
            $request,
            $formAuthenticator,
            'main'
        );
//        return $this->redirectToRoute('homepage');

    }
}
