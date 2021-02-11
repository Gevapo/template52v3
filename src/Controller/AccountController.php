<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;

/**
 * Class AccountController
 * @package App\Controller
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/account_index", name="account_index")
     * @param LoggerInterface $logger
     * @return Response
     */
    public function index(LoggerInterface $logger): Response
    {
        $logger->debug('Checking account page for '.$this->getUser()->getEmail());

        return $this->render('security/index.html.twig', []);
    }

    /**
     * @Route("/account", name="account")
     * @param Request $request
     * @return Response
     */
    public function edit(Request $request): Response
    {
//        $logger->debug('Checking account page for '.$this->getUser()->getEmail());
        $em = $this->getDoctrine()->getManager();

        if ($request->isMethod('POST')) {
            /** @var User $user */
            $user = $this->getUser();
            $user->setFirstName($request->request->get('firstName'));
//            dump($user->setFirstName());
//            dd($user);

            $em->persist($user);
            $em->flush();
        }
        return $this->render('security/account.html.twig', []);
    }
}
