<?php
/**
 * Created by Gevapo (geert) on 26/01/2021
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}