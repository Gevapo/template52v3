<?php

namespace App\Controller;

use App\Entity\Adressoort;
use App\Form\AdressoortType;
use App\Repository\AdressoortRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/profiel/adressoort")
 * @IsGranted("ROLE_ADMIN")
 */
class AdressoortController extends AbstractController
{
    /**
     * @Route("/", name="adressoort_index", methods={"GET"})
     * @param AdressoortRepository $adressoortRepository
     * @return Response
     */
    public function index(AdressoortRepository $adressoortRepository): Response
    {
        return $this->render('adressoort/index.html.twig', [
            'adressoorts' => $adressoortRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="adressoort_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $adressoort = new Adressoort();
        $form = $this->createForm(AdressoortType::class, $adressoort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($adressoort);
            $entityManager->flush();

            return $this->redirectToRoute('adressoort_index');
        }

        return $this->render('adressoort/new.html.twig', [
            'adressoort' => $adressoort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adressoort_show", methods={"GET"})
     * @param Adressoort $adressoort
     * @return Response
     */
    public function show(Adressoort $adressoort): Response
    {
        return $this->render('adressoort/show.html.twig', [
            'adressoort' => $adressoort,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="adressoort_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Adressoort $adressoort
     * @return Response
     */
    public function edit(Request $request, Adressoort $adressoort): Response
    {
        $form = $this->createForm(AdressoortType::class, $adressoort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adressoort_index');
        }

        return $this->render('adressoort/edit.html.twig', [
            'adressoort' => $adressoort,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="adressoort_delete", methods={"DELETE"})
     * @param Request $request
     * @param Adressoort $adressoort
     * @return Response
     */
    public function delete(Request $request, Adressoort $adressoort): Response
    {
        if ($this->isCsrfTokenValid('delete'.$adressoort->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($adressoort);
            $entityManager->flush();
        }

        return $this->redirectToRoute('adressoort_index');
    }
}
