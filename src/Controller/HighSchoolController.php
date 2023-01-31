<?php

namespace App\Controller;

use App\Entity\HighSchool;
use App\Form\HighSchoolType;
use App\Repository\HighSchoolRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/high/school')]
class HighSchoolController extends AbstractController
{
    #[Route('/', name: 'app_high_school_index', methods: ['GET'])]
    public function index(HighSchoolRepository $highSchoolRepository): Response
    {
        return $this->render('high_school/index.html.twig', [
            'high_schools' => $highSchoolRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_high_school_new', methods: ['GET', 'POST'])]
    public function new(Request $request, HighSchoolRepository $highSchoolRepository): Response
    {
        $highSchool = new HighSchool();
        $form = $this->createForm(HighSchoolType::class, $highSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $highSchoolRepository->save($highSchool, true);

            return $this->redirectToRoute('app_high_school_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('high_school/new.html.twig', [
            'high_school' => $highSchool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_high_school_show', methods: ['GET'])]
    public function show(HighSchool $highSchool): Response
    {
        return $this->render('high_school/show.html.twig', [
            'high_school' => $highSchool,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_high_school_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HighSchool $highSchool, HighSchoolRepository $highSchoolRepository): Response
    {
        $form = $this->createForm(HighSchoolType::class, $highSchool);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $highSchoolRepository->save($highSchool, true);

            return $this->redirectToRoute('app_high_school_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('high_school/edit.html.twig', [
            'high_school' => $highSchool,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_high_school_delete', methods: ['POST'])]
    public function delete(Request $request, HighSchool $highSchool, HighSchoolRepository $highSchoolRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$highSchool->getId(), $request->request->get('_token'))) {
            $highSchoolRepository->remove($highSchool, true);
        }

        return $this->redirectToRoute('app_high_school_index', [], Response::HTTP_SEE_OTHER);
    }
}
