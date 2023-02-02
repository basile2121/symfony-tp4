<?php

namespace App\Command;

use App\Repository\RegistrationRepository;
use App\Repository\UniversityRoomRepository;
use App\Repository\WorkshopRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:assign-workshop-to-university-room',
    description: 'Asigner les ateliers à des salles d\'universités'
)]
class AssignWorkshopToUniversityRoomCommand extends Command
{

    private WorkshopRepository $workshopRepository;

    private UniversityRoomRepository $universityRoomRepository;

    private RegistrationRepository $registrationRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(
        WorkshopRepository $workshopRepository,
        UniversityRoomRepository $universityRoomRepository,
        RegistrationRepository $registrationRepository,
        EntityManagerInterface $entityManager,
        string $name = null
    ) {
        $this->workshopRepository = $workshopRepository;
        $this->universityRoomRepository = $universityRoomRepository;
        $this->registrationRepository = $registrationRepository;
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln(['[' . date('d/m/Y-H:s') . '] Début de la commande']);
        // Recuperation des ateliers de l'années

        $output->writeln(['[' . date('d/m/Y-H:s') . '] Récupération des inscriptions et des salles d\'université']);
        $universityRooms = $this->universityRoomRepository->findAll(['']);
        $registersWorkshop = $this->registrationRepository->getNbInscritByWorkshopBySlotTime(intval(date('Y')));

        // Pour chaque ateliers
        foreach ($registersWorkshop as $workshop) {
            $tempDiffArray = [];

            // On créer un tableau pour trouver le nombre de place restante par rapport au nombre d'inscritpiton
            $output->writeln(['[' . date('d/m/Y-H:s') . '] Recherche de salle pour l\`atelier : ' . $workshop['name']]);
            foreach ($universityRooms as $universityRoom) {
                $nbInscrit = intval($workshop['nombre']);
                $diff = $universityRoom->getCapacity() - $nbInscrit;
                if ($diff > 0) {
                    $tempDiffArray[$universityRoom->getId()] = $diff;
                }
            }

            // On trie ce tableau dans l'ordre croissant pour avoir la plus petite diff en
            asort($tempDiffArray);
            foreach ($tempDiffArray as $id => $diff) {
                $universityRoom = $this->universityRoomRepository->find($id);
                $output->writeln(['[' . date('d/m/Y-H:s') . '] Association de la salle : ' . $universityRoom->getName() . '  l\`atelier : ' . $workshop['name']]);
                $workshopToUpdate = $this->workshopRepository->find($workshop['id']);
                $workshopToUpdate->setUniversityRoom($universityRoom);
                $this->entityManager->persist($workshopToUpdate);
                unset($tempDiffArray[$id]);
                // Il faudrait refaire des intérations de boucli jusqu'a ce qu'une salle sois disponible si elle ne l'est pas (Mais pas le temps)
                break;
            }
        }
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
