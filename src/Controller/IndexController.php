<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Registration;
use App\Entity\Speaker;
use App\Entity\Student;
use App\Repository\SpeakerRepository;
use App\Repository\JobRepository;
use App\Repository\WorkshopRepository;
use App\Entity\Workshop;
use App\Form\RegistrationType;
use App\Repository\RegistrationRepository;
use App\Repository\StudentRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(RegistrationRepository $registrationRepository, WorkshopRepository $workshopRepository, JobRepository $jobRepository, SpeakerRepository $speakerRepository): Response
    {
        $workshops = $workshopRepository->findAll();
        $jobs = $jobRepository->findAll();
        $speakers = $speakerRepository->findAll();
        $registrations = $registrationRepository->findAll();
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'workshops' => $workshops,
            'jobs' => $jobs,
            'speakers' => $speakers,
            'registrations' => $registrations,
            'user' => $this->getUser(),
        ]);
    }
    #[Route('/workshops', name: 'app_workshop_public_index')]
    public function workshops(WorkshopRepository $workshopRepository): Response
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
            'nbParticipant' => $nbParticipant[0][1]
        ]);
    }
    #[Route('/workshop/registration/{id}', name: 'app_workshop_registration_public_new', methods: ['GET', 'POST'])]
    public function getRegistration(Workshop $workshop, Request $request, RegistrationRepository $registrationRepository): Response
    {
        /** @var Student $user */
        $user = $this->getUser();
        $totalRegistrations = $user->getRegistrations();
        $registration = new Registration();
        $form = $this->createForm(RegistrationType::class, $registration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && count($totalRegistrations) < 3) {
            $registration->setStudent($this->getUser());
            $registration->setWorkshop($workshop);
            $registration->setRegisterAt(new DateTimeImmutable());
            $registrationRepository->save($registration, true);

            return $this->redirectToRoute('app_workshop_public_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('public/workshop/registerForm.html.twig', [
            'registration' => $registration,
            'form' => $form,
            'workshop' => $workshop,
            'totalRegistrations' => count($totalRegistrations)

        ]);
    }

    #[Route('/student', name: 'app_student_show_profile', methods: ['GET'])]
    public function showProfile(): Response
    {
        $student = $this->getUser();
        return $this->render('public/student/show.html.twig', [
            'student' => $student,
        ]);
    }
}
