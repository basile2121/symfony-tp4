<?php

namespace App\Controller;

use App\Entity\UniversityRoom;
use App\Form\UniversityRoomType;
use App\Repository\UniversityRoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/university/room')]
class UniversityRoomController extends AbstractController
{
    #[Route('/', name: 'app_university_room_index', methods: ['GET'])]
    public function index(UniversityRoomRepository $universityRoomRepository): Response
    {
        return $this->render('admin/university_room/index.html.twig', [
            'university_rooms' => $universityRoomRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_university_room_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UniversityRoomRepository $universityRoomRepository): Response
    {
        $universityRoom = new UniversityRoom();
        $form = $this->createForm(UniversityRoomType::class, $universityRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $universityRoomRepository->save($universityRoom, true);

            return $this->redirectToRoute('app_university_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/university_room/new.html.twig', [
            'university_room' => $universityRoom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_university_room_show', methods: ['GET'])]
    public function show(UniversityRoom $universityRoom): Response
    {
        return $this->render('admin/university_room/show.html.twig', [
            'university_room' => $universityRoom,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_university_room_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UniversityRoom $universityRoom, UniversityRoomRepository $universityRoomRepository): Response
    {
        $form = $this->createForm(UniversityRoomType::class, $universityRoom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $universityRoom->setUpdatedAt(new \DateTimeImmutable());
            $universityRoomRepository->save($universityRoom, true);

            return $this->redirectToRoute('app_university_room_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/university_room/edit.html.twig', [
            'university_room' => $universityRoom,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_university_room_delete', methods: ['POST'])]
    public function delete(Request $request, UniversityRoom $universityRoom, UniversityRoomRepository $universityRoomRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$universityRoom->getId(), $request->request->get('_token'))) {
            $universityRoomRepository->remove($universityRoom, true);
        }

        return $this->redirectToRoute('app_university_room_index', [], Response::HTTP_SEE_OTHER);
    }
}
