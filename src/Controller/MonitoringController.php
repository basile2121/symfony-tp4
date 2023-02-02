<?php

namespace App\Controller;

use App\Repository\HighSchoolRepository;
use App\Repository\RegistrationRepository;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/admin/monitoring')]
class MonitoringController extends AbstractController
{

    #[Route('/', name: 'app_monitoring')]
    public function index(AuthenticationUtils $authenticationUtils, WorkshopRepository $workshopRepository, HighSchoolRepository $highSchoolRepository, RegistrationRepository $registrationRepository): Response
    {
        $workshops = $workshopRepository->findAll();

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/monitoring/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error

        ]);
    }
    #[Route('/workshop', name: 'app_monitoring_workshop')]
    public function showWorkshop(AuthenticationUtils $authenticationUtils, WorkshopRepository $workshopRepository): Response
    {
        $workshops = $workshopRepository->findAll();

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/monitoring/workshop.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'workshops' => $workshops

        ]);
    }

    #[Route('/highschool', name: 'app_monitoring_highschool')]
    public function showHighSchool(AuthenticationUtils $authenticationUtils, HighSchoolRepository $highSchoolRepository): Response
    {
        $highSchools = $highSchoolRepository->getNbStudentRegisterByHighSchool();

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/monitoring/highschool.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
            'highschools' => $highSchools

        ]);
    }
}
