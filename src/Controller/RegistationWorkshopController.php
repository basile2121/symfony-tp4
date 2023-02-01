<?php

namespace App\Controller;

use App\Entity\Registration;
use App\Form\RegistrationType;
use App\Repository\RegistrationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/registation/workshop')]
class RegistationWorkshopController extends AbstractController
{
    #[Route('/', name: 'app_registation_workshop_index', methods: ['GET'])]
    public function index(RegistrationRepository $registrationRepository): Response
    {
        return $this->render('admin/registation_workshop/index.html.twig', [
            'registrations' => $registrationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_registation_workshop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RegistrationRepository $registrationRepository): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registrationRepository->save($registration, true);

            return $this->redirectToRoute('app_registation_workshop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/registation_workshop/new.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_registation_workshop_show', methods: ['GET'])]
    public function show(Registration $registration): Response
    {
        return $this->render('admin/registation_workshop/show.html.twig', [
            'registration' => $registration,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_registation_workshop_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Registration $registration, RegistrationRepository $registrationRepository): Response
    {
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registrationRepository->save($registration, true);

            return $this->redirectToRoute('app_registation_workshop_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/registation_workshop/edit.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_registation_workshop_delete', methods: ['POST'])]
    public function delete(Request $request, Registration $registration, RegistrationRepository $registrationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$registration->getId(), $request->request->get('_token'))) {
            $registrationRepository->remove($registration, true);
        }

        return $this->redirectToRoute('app_registation_workshop_index', [], Response::HTTP_SEE_OTHER);
    }
}
