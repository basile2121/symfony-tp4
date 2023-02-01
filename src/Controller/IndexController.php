<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\WorkshopRepository;
use App\Entity\Workshop;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
 
    #[Route('/workshops', name: 'app_index')]
    public function all_workshops(WorkshopRepository $workshopRepository):Response
    {
        return $this->render('workshop/index.html.twig', [
            'workshops' => $workshopRepository->findAll(),
        ]);
    }

    #[Route('/workshop/{id}', name: 'app_workshop_public_show', methods: ['GET'])]
    public function show(Workshop $workshop, WorkshopRepository $workshopRepository): Response
    {
        $id = $workshop->getId();
        $nbParticipant = $workshopRepository->nbParticipant($id);
        return $this->render('public/workshop/show.html.twig', [
            'workshop' => $workshop,
            'nbParticipant'=> $nbParticipant
        ]);
    }
}
