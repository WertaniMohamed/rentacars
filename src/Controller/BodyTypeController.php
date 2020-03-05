<?php

namespace App\Controller;

use App\Entity\BodyType;
use App\Form\BodyTypeType;
use App\Repository\BodyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/body_type")
 */
class BodyTypeController extends AbstractController
{
    /**
     * @Route("/", name="body_type_index", methods={"GET"})
     */
    public function index(BodyTypeRepository $bodyTypeRepository): Response
    {
        return $this->render('body_type/index.html.twig', [
            'body_types' => $bodyTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="body_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bodyType = new BodyType();
        $form = $this->createForm(BodyTypeType::class, $bodyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bodyType);
            $entityManager->flush();

            return $this->redirectToRoute('body_type_index');
        }

        return $this->render('body_type/new.html.twig', [
            'body_type' => $bodyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="body_type_show", methods={"GET"})
     */
    public function show(BodyType $bodyType): Response
    {
        return $this->render('body_type/show.html.twig', [
            'body_type' => $bodyType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="body_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BodyType $bodyType): Response
    {
        $form = $this->createForm(BodyTypeType::class, $bodyType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('body_type_index');
        }

        return $this->render('body_type/edit.html.twig', [
            'body_type' => $bodyType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="body_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BodyType $bodyType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bodyType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bodyType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('body_type_index');
    }
}
