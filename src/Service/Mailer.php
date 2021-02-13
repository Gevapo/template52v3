<?php
/**
 * Created by Gevapo (geert) on 11/02/2021
 */

namespace App\Service;


use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;
use Twig\Environment;

class Mailer
{
    private MailerInterface $mailer;
    private Environment $twig;
    private VerifyEmailHelperInterface $verifyEmailHelper;

    /**
     * Mailer constructor.
     * @param MailerInterface $mailer
     * @param Environment $twig
     * @param VerifyEmailHelperInterface $verifyEmailHelper
     */
    public function __construct(MailerInterface $mailer, Environment $twig, VerifyEmailHelperInterface $verifyEmailHelper)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->verifyEmailHelper = $verifyEmailHelper;
    }

    /**
     * @param User $user
     * @throws TransportExceptionInterface
     */
    public function sendTestMessage(User $user)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@gevapo.be', 'The Template52 site'))
            ->to(new Address($user->getEmail(), $user->getFirstName()))
            ->subject('Welkom op de Template52 site')
            ->htmlTemplate('email/test.html.twig')
        ;

        $this->mailer->send($email);

        return $email; // for unit test
    }


    /**
     * @param User $user
     * @return TemplatedEmail
     * @throws TransportExceptionInterface
     */
    public function sendRegistrationMessage(User $user): TemplatedEmail
    {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'verify',
            $user->getId(),
            $user->getEmail()
        );

        $userName = $user->getFirstName() ? $user->getFirstName() : $user->getEmail();

        $email = (new TemplatedEmail())
            ->from(new Address('noreply@gevapo.be', 'The Template52 site'))
            ->to(new Address($user->getEmail(), $userName))
            ->subject('Registratie voor de Template52 site')
//            ->htmlTemplate('email/confirmation_email.html.twig')
            ->htmlTemplate('email/registratie.html.twig')
            ->context(['signedUrl' => $signatureComponents->getSignedUrl()])
        ;

        $this->mailer->send($email);

        return $email; // for unit test
    }
}