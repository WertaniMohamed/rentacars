<?php

namespace App\Controller;

use App\Entity\ContractState;
use App\Form\ContractStateType;
use App\Repository\ContractStateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contract/state")
 */
class ContractStateController extends AbstractController
{
    /**
     * @Route("/", name="contract_state_index", methods={"GET"})
     */
    public function index(ContractStateRepository $contractStateRepository): Response
    {
        return $this->render('contract_state/index.html.twig', [
            'contract_states' => $contractStateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_state_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contractState = new ContractState();
        $form = $this->createForm(ContractStateType::class, $contractState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contractState);
            $entityManager->flush();

            return $this->redirectToRoute('contract_state_index');
        }

        return $this->render('contract_state/new.html.twig', [
            'contract_state' => $contractState,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_state_show", methods={"GET"})
     */
    public function show(ContractState $contractState): Response
    {
        return $this->render('contract_state/show.html.twig', [
            'contract_state' => $contractState,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_state_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContractState $contractState): Response
    {
        $form = $this->createForm(ContractStateType::class, $contractState);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_state_index');
        }

        return $this->render('contract_state/edit.html.twig', [
            'contract_state' => $contractState,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_state_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ContractState $contractState): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contractState->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contractState);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_state_index');
    }
}
