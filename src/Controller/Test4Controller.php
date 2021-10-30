<?php

namespace App\Controller;

use App\Entity\Test4;
use App\Form\Test4Type;
use App\Repository\Test4Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/test4")
 */
class Test4Controller extends AbstractController
{
    /**
     * @Route("/", name="test4_index", methods={"GET"})
     */
    public function index(Test4Repository $test4Repository): Response
    {
        return $this->render('test4/index.html.twig', [
            'test4s' => $test4Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="test4_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $test4 = new Test4();
        $form = $this->createForm(Test4Type::class, $test4);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($test4);
            $entityManager->flush();

            return $this->redirectToRoute('test4_index');
        }

        return $this->render('test4/new.html.twig', [
            'test4' => $test4,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test4_show", methods={"GET"})
     */
    public function show(Test4 $test4): Response
    {
        return $this->render('test4/show.html.twig', [
            'test4' => $test4,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="test4_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Test4 $test4): Response
    {
        $form = $this->createForm(Test4Type::class, $test4);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('test4_index');
        }

        return $this->render('test4/edit.html.twig', [
            'test4' => $test4,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="test4_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Test4 $test4): Response
    {
        if ($this->isCsrfTokenValid('delete'.$test4->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($test4);
            $entityManager->flush();
        }

        return $this->redirectToRoute('test4_index');
    }
}
