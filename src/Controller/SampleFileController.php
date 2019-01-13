<?php

namespace App\Controller;

use App\Entity\SampleFile;
use App\Form\SampleFileType;
use App\Repository\SampleFileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sample/files")
 */
class SampleFileController extends AbstractController
{
    /**
     * @Route("/", name="sample_file_index", methods={"GET"})
     * @param SampleFileRepository $sampleFileRepository
     * @return Response
     */
    public function index(SampleFileRepository $sampleFileRepository): Response
    {
        return $this->render('sample_file/index.html.twig', [
            'sample_files' => $sampleFileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sample_file_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $sampleFile = new SampleFile();
        $form = $this->createForm(SampleFileType::class, $sampleFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sampleFile);
            $entityManager->flush();

            return $this->redirectToRoute('sample_file_index');
        }

        return $this->render('sample_file/new.html.twig', [
            'sample_file' => $sampleFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_file_show", methods={"GET"})
     * @param SampleFile $sampleFile
     * @return Response
     */
    public function show(SampleFile $sampleFile): Response
    {
        return $this->render('sample_file/show.html.twig', [
            'sample_file' => $sampleFile,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sample_file_edit", methods={"GET","POST"})
     * @param Request $request
     * @param SampleFile $sampleFile
     * @return Response
     */
    public function edit(Request $request, SampleFile $sampleFile): Response
    {
        $form = $this->createForm(SampleFileType::class, $sampleFile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sample_file_index', [
                'id' => $sampleFile->getId(),
            ]);
        }

        return $this->render('sample_file/edit.html.twig', [
            'sample_file' => $sampleFile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sample_file_delete", methods={"DELETE"})
     * @param Request $request
     * @param SampleFile $sampleFile
     * @return Response
     */
    public function delete(Request $request, SampleFile $sampleFile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sampleFile->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sampleFile);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sample_file_index');
    }
}
