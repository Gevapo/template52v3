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
use Twig\Environment;

class Mailer
{
    private MailerInterface $mailer;
    private Environment $twig;

    /**
     * Mailer constructor.
     * @param MailerInterface $mailer
     * @param Environment $twig
     */
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
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
            ->subject('Test message')
            ->htmlTemplate('email/test.html.twig')
        ;

        $this->mailer->send($email);
    }
}