<?php

namespace App\Controller;

use App\Entity\PossibleAnswer;
use App\Form\PossibleAnswerType;
use App\Repository\PossibleAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/possible/answer')]
class PossibleAnswerController extends AbstractController
{
    #[Route('/', name: 'app_possible_answer_index', methods: ['GET'])]
    public function index(PossibleAnswerRepository $possibleAnswerRepository): Response
    {
        return $this->render('possible_answer/index.html.twig', [
            'possible_answers' => $possibleAnswerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_possible_answer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PossibleAnswerRepository $possibleAnswerRepository): Response
    {
        $possibleAnswer = new PossibleAnswer();
        $form = $this->createForm(PossibleAnswerType::class, $possibleAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $possibleAnswerRepository->save($possibleAnswer, true);

            return $this->redirectToRoute('app_possible_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('possible_answer/new.html.twig', [
            'possible_answer' => $possibleAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_possible_answer_show', methods: ['GET'])]
    public function show(PossibleAnswer $possibleAnswer): Response
    {
        return $this->render('possible_answer/show.html.twig', [
            'possible_answer' => $possibleAnswer,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_possible_answer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PossibleAnswer $possibleAnswer, PossibleAnswerRepository $possibleAnswerRepository): Response
    {
        $form = $this->createForm(PossibleAnswerType::class, $possibleAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $possibleAnswerRepository->save($possibleAnswer, true);

            return $this->redirectToRoute('app_possible_answer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('possible_answer/edit.html.twig', [
            'possible_answer' => $possibleAnswer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_possible_answer_delete', methods: ['POST'])]
    public function delete(Request $request, PossibleAnswer $possibleAnswer, PossibleAnswerRepository $possibleAnswerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$possibleAnswer->getId(), $request->request->get('_token'))) {
            $possibleAnswerRepository->remove($possibleAnswer, true);
        }

        return $this->redirectToRoute('app_possible_answer_index', [], Response::HTTP_SEE_OTHER);
    }
}
