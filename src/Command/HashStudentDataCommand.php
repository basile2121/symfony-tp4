<?php

namespace App\Command;

use App\Repository\RegistrationRepository;
use App\Repository\StudentRepository;
use App\Repository\UniversityRoomRepository;
use App\Repository\WorkshopRepository;
use App\Service\HaschService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
        name: 'app:hash-students-data',
        description: 'Chiffrer les données personnelles des élèves'
)]
class HashStudentDataCommand extends Command
{

    private StudentRepository $studentRepository;

    private EntityManagerInterface $entityManager;

    private HaschService $haschService;

    public function __construct(
        StudentRepository $studentRepository,
        EntityManagerInterface $entityManager,
        HaschService $haschService,
        string $name = null
    )
    {
        $this->studentRepository = $studentRepository;
        $this->entityManager = $entityManager;
        $this->haschService = $haschService;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(['['. date('d/m/Y-H:s'). '] Début de la commande']);
        // Recuperation des ateliers de l'années

        $output->writeln(['['. date('d/m/Y-H:s'). '] Récupération des étudiants']);
        $students = $this->studentRepository->findAll();
        $compteur = 0;
        foreach ($students as $student) {
            if ($student->getQuestionary() !== null) {
                $output->writeln(['['. date('d/m/Y-H:s'). '] haschage des données pour l etudiant : ' . $student->getFirstName()]);
                $student->setPassword($this->haschService->hashData($student->getPassword()));
                $student->setEmail($this->haschService->hashData($student->getEmail()));
                $student->setLastName($this->haschService->hashData($student->getLastName()));
                $student->setFirstName($this->haschService->hashData($student->getFirstName()));
                $student->setPhone($this->haschService->hashData($student->getPhone(), 10));

                $this->entityManager->persist($student);
                $compteur += 1;
            }
        }

        $output->writeln(['['. date('d/m/Y-H:s'). '] Fin commande, Nombre étudiant annonymisé : ' . $compteur]);

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}