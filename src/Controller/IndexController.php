<?php

namespace App\Controller;

use App\Repository\JobRepository;
use App\Repository\SpeakerRepository;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(WorkshopRepository $workshopRepository, JobRepository $jobRepository, SpeakerRepository $speakerRepository): Response
    {
        $workshops = $workshopRepository->findAll();
        $jobs = $jobRepository->findAll();
        $speakers = $speakerRepository->findAll();
        // dd($this->getUser());
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'workshops' => $workshops,
            'jobs' => $jobs,
            'speakers' => $speakers,
            'user' => $this->getUser(),
        ]);
    }
}
