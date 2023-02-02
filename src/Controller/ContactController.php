<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ActivityRepository;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'contact', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('contact/contact.html.twig');
    }

    #[Route('/store', name: 'store', methods: ['POST'])]
    public function store(Request $r, EntityManagerInterface $em): Response
    {
        $data= json_decode($r->getContent());
        $contact = new Contact();
        $contact->setEmail($data->email);
        $contact->setName($data->name);
        $contact->setMessage($data->message);

        $em->persist($contact);
        $em->flush();
        return new JsonResponse();

       
    }
   
}
