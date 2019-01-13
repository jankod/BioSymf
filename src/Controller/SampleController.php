<?php

namespace App\Controller;

use App\Entity\Sample;
use App\Form\SampleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/samples")
 */
class SampleController extends AbstractController
{
    /**
     * @Route("/", name="sample_index", methods={"GET"})
     */
    public function index(): Response
    {

        $samples = $this->getDoctrine()
            ->getRepository(Sample::class)
            ->findAll();

        return $this->render('sample/index.html.twig', [
            'samples' => $samples,
        ]);
    }

    /**
     * @Route("/new", name="sample_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sample = new Sample();
        $form = $this->createForm(SampleType::class, $sample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sample);
            $entityManager->flush();

            return $this->redirectToRoute('sample_index');
        }

        return $this->render('sample/new.html.twig', [
            'sample' => $sample,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_show", methods={"GET"})
     * @param Sample $sample
     * @return Response
     */
    public function show(Sample $sample): Response
    {
        return $this->render('sample/show.html.twig', [
            'sample' => $sample,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sample_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sample $sample): Response
    {
        $form = $this->createForm(SampleType::class, $sample);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sample_index', [
                'id' => $sample->getId(),
            ]);
        }

        return $this->render('sample/edit.html.twig', [
            'sample' => $sample,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sample $sample): Response
    {
        if ($this->isCsrfTokenValid('delete' . $sample->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sample);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sample_index');
    }
}
