<?php

namespace App\Controller;

use App\Entity\Registration;
use App\Entity\Workshop;
use App\Repository\RegistrationRepository;
use App\Repository\WorkshopRepository;
use App\Form\RegistrationType; 
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        // dd($this->getUser());
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    #[Route('/workshops', name: 'app_workshop_public_index')]
    public function all_workshops(WorkshopRepository $workshopRepository):Response
    {
        return $this->render('public/workshop/index.html.twig', [
            'workshops' => $workshopRepository->findAll(),
        ]);
    }

    #[Route('/workshop/{id}', name: 'app_workshop_public_show', methods: ['GET'])]
    public function show(Workshop $workshop, RegistrationRepository $registrationRepository): Response
    {
        $id = $workshop->getId();
        $nbParticipant = $registrationRepository->nbParticipant($id);
        return $this->render('public/workshop/show.html.twig', [
            'workshop' => $workshop,
            'nbParticipant'=> $nbParticipant[0][1]
        ]);
    }
    #[Route('/workshop/registration/{id}', name: 'app_workshop_registration_public_new', methods: ['GET'])]
    public function getRegistration(Workshop $workshop, Request $request, RegistrationRepository $registrationRepository): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration->setStudent($this->getUser());
            dd($this->getUser());
            $registration->setRegisterAt(new DateTimeImmutable());
            $registrationRepository->save($registration, true);

            return $this->redirectToRoute('app_workshop_public_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('public/workshop/registerForm.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }

     
    #[Route('/new', name: 'app_registration_public_workshop_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RegistrationRepository $registrationRepository): Response
    {
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $registration->setStudent($this->getUser());
            dd($this->getUser());
            $registration->setRegisterAt(new DateTimeImmutable());
            $registrationRepository->save($registration, true);

            return $this->redirectToRoute('app_workshop_public_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('registration_workshop/new.html.twig', [
            'registration' => $registration,
            'form' => $form,
        ]);
    }
}
