<?php

namespace App\Controller;

use App\Entity\Timeslot;
use App\Form\TimeslotType;
use App\Repository\TimeslotRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/timeslot')]
class TimeslotController extends AbstractController
{
    #[Route('/', name: 'app_timeslot_index', methods: ['GET'])]
    public function index(TimeslotRepository $timeslotRepository): Response
    {
        return $this->render('timeslot/index.html.twig', [
            'timeslots' => $timeslotRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_timeslot_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TimeslotRepository $timeslotRepository): Response
    {
        $timeslot = new Timeslot();
        $form = $this->createForm(TimeslotType::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeslotRepository->save($timeslot, true);

            return $this->redirectToRoute('app_timeslot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('timeslot/new.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timeslot_show', methods: ['GET'])]
    public function show(Timeslot $timeslot): Response
    {
        return $this->render('timeslot/show.html.twig', [
            'timeslot' => $timeslot,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_timeslot_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Timeslot $timeslot, TimeslotRepository $timeslotRepository): Response
    {
        $form = $this->createForm(TimeslotType::class, $timeslot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $timeslotRepository->save($timeslot, true);

            return $this->redirectToRoute('app_timeslot_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('timeslot/edit.html.twig', [
            'timeslot' => $timeslot,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_timeslot_delete', methods: ['POST'])]
    public function delete(Request $request, Timeslot $timeslot, TimeslotRepository $timeslotRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$timeslot->getId(), $request->request->get('_token'))) {
            $timeslotRepository->remove($timeslot, true);
        }

        return $this->redirectToRoute('app_timeslot_index', [], Response::HTTP_SEE_OTHER);
    }
}
