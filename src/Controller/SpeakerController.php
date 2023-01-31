<?php

namespace App\Controller;

use App\Entity\Speaker;
use App\Form\SpeakerType;
use App\Repository\SpeakerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/speaker')]
class SpeakerController extends AbstractController
{
    #[Route('/', name: 'app_speaker_index', methods: ['GET'])]
    public function index(SpeakerRepository $speakerRepository): Response
    {
        return $this->render('speaker/index.html.twig', [
            'speakers' => $speakerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_speaker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SpeakerRepository $speakerRepository): Response
    {
        $speaker = new Speaker();
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $speakerRepository->save($speaker, true);

            return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('speaker/new.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_show', methods: ['GET'])]
    public function show(Speaker $speaker): Response
    {
        return $this->render('speaker/show.html.twig', [
            'speaker' => $speaker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_speaker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Speaker $speaker, SpeakerRepository $speakerRepository): Response
    {
        $form = $this->createForm(SpeakerType::class, $speaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $speakerRepository->save($speaker, true);

            return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('speaker/edit.html.twig', [
            'speaker' => $speaker,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_speaker_delete', methods: ['POST'])]
    public function delete(Request $request, Speaker $speaker, SpeakerRepository $speakerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$speaker->getId(), $request->request->get('_token'))) {
            $speakerRepository->remove($speaker, true);
        }

        return $this->redirectToRoute('app_speaker_index', [], Response::HTTP_SEE_OTHER);
    }
}
