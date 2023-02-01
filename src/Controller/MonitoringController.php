<?php

namespace App\Controller;

use App\Repository\HighSchoolRepository;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class MonitoringController extends AbstractController
{
    #[Route('/monitoring', name: 'app_monitoring')]
    public function index(AuthenticationUtils $authenticationUtils, WorkshopRepository $workshopRepository, HighSchoolRepository $highSchoolRepository): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('public/monitoring/workshop.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}
