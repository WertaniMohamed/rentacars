<?php

namespace App\Controller;

use App\Entity\ContractPlace;
use App\Form\ContractPlaceType;
use App\Repository\ContractPlaceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contract/place")
 */
class ContractPlaceController extends AbstractController
{
    /**
     * @Route("/", name="contract_place_index", methods={"GET"})
     */
    public function index(ContractPlaceRepository $contractPlaceRepository): Response
    {
        return $this->render('contract_place/index.html.twig', [
            'contract_places' => $contractPlaceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_place_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contractPlace = new ContractPlace();
        $form = $this->createForm(ContractPlaceType::class, $contractPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contractPlace);
            $entityManager->flush();

            return $this->redirectToRoute('contract_place_index');
        }

        return $this->render('contract_place/new.html.twig', [
            'contract_place' => $contractPlace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_place_show", methods={"GET"})
     */
    public function show(ContractPlace $contractPlace): Response
    {
        return $this->render('contract_place/show.html.twig', [
            'contract_place' => $contractPlace,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_place_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContractPlace $contractPlace): Response
    {
        $form = $this->createForm(ContractPlaceType::class, $contractPlace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_place_index');
        }

        return $this->render('contract_place/edit.html.twig', [
            'contract_place' => $contractPlace,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_place_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ContractPlace $contractPlace): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contractPlace->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contractPlace);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_place_index');
    }
}
