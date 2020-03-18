<?php

namespace App\Controller;

use App\Entity\ContractOption;
use App\Form\ContractOptionType;
use App\Repository\ContractOptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contract/option")
 */
class ContractOptionController extends AbstractController
{
    /**
     * @Route("/", name="contract_option_index", methods={"GET"})
     */
    public function index(ContractOptionRepository $contractOptionRepository): Response
    {
        return $this->render('contract_option/index.html.twig', [
            'contract_options' => $contractOptionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_option_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contractOption = new ContractOption();
        $form = $this->createForm(ContractOptionType::class, $contractOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contractOption);
            $entityManager->flush();

            return $this->redirectToRoute('contract_option_index');
        }

        return $this->render('contract_option/new.html.twig', [
            'contract_option' => $contractOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_option_show", methods={"GET"})
     */
    public function show(ContractOption $contractOption): Response
    {
        return $this->render('contract_option/show.html.twig', [
            'contract_option' => $contractOption,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_option_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ContractOption $contractOption): Response
    {
        $form = $this->createForm(ContractOptionType::class, $contractOption);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_option_index');
        }

        return $this->render('contract_option/edit.html.twig', [
            'contract_option' => $contractOption,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_option_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ContractOption $contractOption): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contractOption->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contractOption);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_option_index');
    }
}
