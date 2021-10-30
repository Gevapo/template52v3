<?php
/**
 * Created by Gevapo (geert) on 26/01/2021
 */

namespace App\Controller;

use App\Entity\User;
use App\Service\Mailer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class HomeController extends AbstractController
{
//    private $session;
//    const CART_KEY_NAME = 'cart_id';
//
//    /**
//     * CartSessionStorage constructor.
//     *
//     * @param SessionInterface $session
//     */
//    public function __construct(SessionInterface $session)
//    {
//        $this->session = $session;
//    }

    /**
     * @Route("/", name="homepage")
     * @return Response
     */
    public function homepage(): Response
    {
        return $this->render('home/homepage.html.twig', [

        ]);
    }

    /**
     * @Route("/test_contact", name="test_contact")
     */
    public function testAction(): Response
    {
        return $this->render('home/contact.html.twig');
    }

    /**
     * @Route("/contact", name="contactpage")
     * @return Response
     */
    public function contactpage(): Response
    {
        return $this->render('home/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/info", name="infopage")
     * @return Response
     */
    public function infopage(): Response
    {
        $test1 = is_array(opcache_get_status()) ? 'enabled' : 'disabled';
        $test2 = "starting test\nopcache status:".is_array(opcache_get_status()) ? 'enabled' : 'disabled';
        return $this->render('home/info.html.twig', [
            'test1' => $test1,
            'test2' => $test2,
        ]);
    }

    /**
     * @Route("/privacy", name="privacy")
     * @return Response
     */
    public function privacypage(): Response
    {
        return $this->render('home/privacy.html.twig', [
        ]);
    }

    /**
     * @Route("/testmail", name="testmail")
     * @param Request $request
     * @param Mailer $mailer
     * @return Response
     * @throws TransportExceptionInterface
     * @IsGranted("ROLE_ADMIN")
     */
    public function sendTestMessage(Request $request, Mailer $mailer): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        $mailer->sendTestMessage($user);
//        $mailer->sendBevestigingBestellingKlant($bestellingManager->getCurrentBestelling());

        $this->addFlash('success', 'Test message mailed.');

        return $this->render('home/homepage.html.twig');
    }

    /**
     * @Route("/testdata", name="testdata")
     * @IsGranted("ROLE_ADMIN")
     */
    public function testdata(): Response
    {
        $em = $this->getDoctrine()->getManager();

//        $optionChoice1 = new ProductOptionChoice();
//        $optionChoice1->setName('Rood');
//        $optionChoice1->setPrice(4.0);
//        $em->persist($optionChoice1);
//
//        $optionChoice2 = new ProductOptionChoice();
//        $optionChoice2->setName('Wit');
//        $optionChoice2->setPrice(3.0);
//        $em->persist($optionChoice2);
//
//        $optionChoice3 = new ProductOptionChoice();
//        $optionChoice3->setName('Zilver');
//        $optionChoice3->setPrice(5.0);
//        $em->persist($optionChoice3);
//
//        $em->flush();
//
//        $option1 = new ProductOption();
//        $option1->setName('T-shirt Kleur');
//        $option1->setLabel('Kleur');
//
//        $option1->addProductOptionChoice($optionChoice1);
//        $option1->addProductOptionChoice($optionChoice2);
//        $option1->addProductOptionChoice($optionChoice3);

//        $em->persist($option1);
//        $em->flush();



        $em->flush();
//        die('.. end');

        return new Response('Testdata is aangemaakt.');
    }
}
