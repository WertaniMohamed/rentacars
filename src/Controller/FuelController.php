<?php

namespace App\Controller;

use App\Entity\Fuel;
use App\Form\FuelType;
use App\Repository\FuelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fuel")
 */
class FuelController extends AbstractController
{
    /**
     * @Route("/", name="fuel_index", methods={"GET"})
     */
    public function index(FuelRepository $fuelRepository): Response
    {
        return $this->render('fuel/index.html.twig', [
            'fuels' => $fuelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="fuel_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $fuel = new Fuel();
        $form = $this->createForm(FuelType::class, $fuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($fuel);
            $entityManager->flush();

            return $this->redirectToRoute('fuel_index');
        }

        return $this->render('fuel/new.html.twig', [
            'fuel' => $fuel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fuel_show", methods={"GET"})
     */
    public function show(Fuel $fuel): Response
    {
        return $this->render('fuel/show.html.twig', [
            'fuel' => $fuel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="fuel_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Fuel $fuel): Response
    {
        $form = $this->createForm(FuelType::class, $fuel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('fuel_index');
        }

        return $this->render('fuel/edit.html.twig', [
            'fuel' => $fuel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="fuel_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Fuel $fuel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$fuel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($fuel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('fuel_index');
    }
}
