<?php
/**
 * Created by Gevapo (geert) on 26/01/2021
 */

namespace App\Controller;


use App\Entity\Product;
use App\Entity\ProductOption;
use App\Entity\ProductOptionChoice;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */
    public function homepage()
    {
        return $this->render('home/homepage.html.twig');
    }

    /**
     * @Route("/bootswatch", name="bootswatch")
     */
    public function bootswatch()
    {
        return $this->render('home/bootswatch.html.twig');
    }

    /**
     * @Route("/testdata", name="testdata")
     */
    public function testdata(): Response
    {
        $em = $this->getDoctrine()->getManager();

        $optionChoice1 = new ProductOptionChoice();
        $optionChoice1->setName('Rood');
        $optionChoice1->setPrice(4.0);
        $em->persist($optionChoice1);

        $optionChoice2 = new ProductOptionChoice();
        $optionChoice2->setName('Wit');
        $optionChoice2->setPrice(3.0);
        $em->persist($optionChoice2);

        $optionChoice3 = new ProductOptionChoice();
        $optionChoice3->setName('Zilver');
        $optionChoice3->setPrice(5.0);
        $em->persist($optionChoice3);

        $em->flush();

        $option1 = new ProductOption();
        $option1->setName('T-shirt Kleur');
        $option1->setLabel('Kleur');

        $option1->addProductOptionChoice($optionChoice1);
        $option1->addProductOptionChoice($optionChoice2);
        $option1->addProductOptionChoice($optionChoice3);

        $em->persist($option1);
        $em->flush();

        $optionChoice4 = new ProductOptionChoice();
        $optionChoice4->setName('Small');
        $optionChoice4->setPrice(2.40);
        $em->persist($optionChoice4);

        $optionChoice5 = new ProductOptionChoice();
        $optionChoice5->setName('Medium');
        $optionChoice5->setPrice(2.75);
        $em->persist($optionChoice5);

        $optionChoice6 = new ProductOptionChoice();
        $optionChoice6->setName('Large');
        $optionChoice6->setPrice(3.50);
        $em->persist($optionChoice6);

        $optionChoice7 = new ProductOptionChoice();
        $optionChoice7->setName('Extra large');
        $optionChoice7->setPrice(3.75);
        $em->persist($optionChoice7);

        $option2 = new ProductOption();
        $option2->setName('T-shirt maat');
        $option2->setLabel('Maat');
        $option2->addProductOptionChoice($optionChoice4);
        $option2->addProductOptionChoice($optionChoice5);
        $option2->addProductOptionChoice($optionChoice6);
        $option2->addProductOptionChoice($optionChoice7);

        $em->persist($option2);
        $em->flush();



        $product1 = new Product();
        $product1->setName('Super Cool Symfony T-shirt');
        $product1->setPrice(20.0);
        $product1->addProductoption($option1);
        $product1->addProductoption($option2);
        $em->persist($product1);

        $product2 = new Product();
        $product2->setName('Super Cool Symfony Baseball Cap');
        $product2->setPrice(14.5);
        $product2->addProductoption($option1);
        $em->persist($product2);

        $product3 = new Product();
        $product3->setName('Symfony Tea Cup');
        $product3->setPrice(3.95);
        $em->persist($product3);

//        dump($option1);
//        dump($option2);
//        dump($product1);
//        dump($product2);
//        dump($product3);

        $em->flush();
//        die('.. end');

        return new Response('Testdata is aangemaakt.');
    }
}