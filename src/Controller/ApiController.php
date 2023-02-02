<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Form\AnswerType;
use App\Repository\AnswerRepository;
use App\Repository\RegistrationRepository;
use App\Repository\WorkshopRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
class ApiController extends AbstractController
{
    #[Route('/numbersInscriptions', name: 'get_nombre_inscrit', methods: ['GET'])]
    public function index(RegistrationRepository $registrationRepository): JsonResponse
    {
        $datas = $registrationRepository->getNbInscritByWorkshopBySlotTime();
        $results = [];
        foreach ($datas as $data) {
            if (!isset($results[$data['name']])) {
                $results[$data['name']] = [];
            }
            $results[$data['name']][] = ['Créneau Horaire' => $data['label'], 'Nombre d\'inscrits' => $data['nombre']];
        }

        return new JsonResponse([$results]);
    }
}
