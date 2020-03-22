<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Contract;
use App\Form\ContractType;
use App\Repository\ContractRepository;
use App\Repository\ContractStateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contracts")
 */
class ContractController extends AbstractController
{
    /**
     * @Route("/", name="contract_index", methods={"GET"})
     */
    public function index(ContractRepository $contractRepository): Response
    {
        return $this->render('contract/index.html.twig', [
            'contracts' => $contractRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contract_new", methods={"GET","POST"})
     */
    public function new(Request $request, ContractStateRepository $contractStateRepository): Response
    {
        $contract = new Contract();
        $client1 = new Client();
        $state = $contractStateRepository->find(1);
        $contract->setState($state);
        $contract->getClients()->add($client1);
//        $client2 = new Client();
//        $contract->getClients()->add($client2);

        $form = $this->createForm(ContractType::class, $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            //var_dump($client1);
            $this->calculePriceContract($contract);
            $entityManager->persist($client1);
            $entityManager->flush();

            $entityManager->persist($contract);
            $entityManager->flush();

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/new.html.twig', [
            'contract' => $contract,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_show", methods={"GET"})
     */
    public function show(Contract $contract): Response
    {
        return $this->render('contract/show.html.twig', [
            'contract' => $contract,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="contract_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Contract $contract): Response
    {
        $form = $this->createForm(ContractType::class, $contract);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->calculePriceContract($contract);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contract_index');
        }

        return $this->render('contract/edit.html.twig', [
            'contract' => $contract,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contract_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contract $contract): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contract->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contract);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contract_index');
    }

    protected function calculePriceContract(Contract $contract)
    {
        $carDaysAmount = $contract->getDays() * $contract->getCar()->getPriceByDay();
        if ($contract->getDaysExtension())
            $carDaysAmount += $contract->getDays() * $contract->getCar()->getPriceByDay();
        $contract->setCarDaysAmount($carDaysAmount);
        $options = $contract->getOptions();
        $optionsAmount = 0;
        foreach ($options as $option) {
            $optionsAmount += $option->getPrice();
        }
        $contract->setOptionsAmount($optionsAmount);
        $amountTotaleHt = $contract->getOptionsAmount() + $contract->getCarDaysAmount();
        $contract->setAmountTotaleHt($amountTotaleHt);
        $amountTotaleTtc = $amountTotaleHt * (($contract->getTva() / 100) + 1);
        $contract->setAmountTotaleTtc($amountTotaleTtc);
        $contract->setAmountTotaleTtcAfterDiscount($amountTotaleTtc);
        $contract->setAmountTotale($amountTotaleTtc);

        if ($contract->getDiscount() > 0) {
            $amountTotaleTtcAfterDiscount = $amountTotaleTtc * (1 - ($contract->getDiscount() / 100));
            $contract->setAmountTotaleTtcAfterDiscount($amountTotaleTtcAfterDiscount);
            $contract->setAmountTotale($amountTotaleTtcAfterDiscount);
        }
        // return $contract;
    }
}
