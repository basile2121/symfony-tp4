<?php

namespace App\Controller;

use App\Entity\Questionary;
use App\Form\QuestionaryType;
use App\Repository\QuestionaryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/questionary')]
class QuestionaryController extends AbstractController
{
    #[Route('/', name: 'app_questionary_index', methods: ['GET'])]
    public function index(QuestionaryRepository $questionaryRepository): Response
    {
        return $this->render('questionary/index.html.twig', [
            'questionaries' => $questionaryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_questionary_new', methods: ['GET', 'POST'])]
    public function new(Request $request, QuestionaryRepository $questionaryRepository): Response
    {
        $questionary = new Questionary();
        $form = $this->createForm(QuestionaryType::class, $questionary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionaryRepository->save($questionary, true);

            return $this->redirectToRoute('app_questionary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('questionary/new.html.twig', [
            'questionary' => $questionary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_questionary_show', methods: ['GET'])]
    public function show(Questionary $questionary): Response
    {
        return $this->render('questionary/show.html.twig', [
            'questionary' => $questionary,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_questionary_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Questionary $questionary, QuestionaryRepository $questionaryRepository): Response
    {
        $form = $this->createForm(QuestionaryType::class, $questionary);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $questionaryRepository->save($questionary, true);

            return $this->redirectToRoute('app_questionary_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('questionary/edit.html.twig', [
            'questionary' => $questionary,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_questionary_delete', methods: ['POST'])]
    public function delete(Request $request, Questionary $questionary, QuestionaryRepository $questionaryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$questionary->getId(), $request->request->get('_token'))) {
            $questionaryRepository->remove($questionary, true);
        }

        return $this->redirectToRoute('app_questionary_index', [], Response::HTTP_SEE_OTHER);
    }
}
