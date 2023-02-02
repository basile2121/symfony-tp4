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
        $output->writeln(['['. date('d/m/Y-H:s'). '] Debut de la command']);
        // Recuperation des ateliers de l'années

        $output->writeln(['['. date('d/m/Y-H:s'). '] Recuperation des inscriptions et des salles d\'université pas utilisé']);
        $universityRoomsAvailable = $this->universityRoomRepository->findAvailableRoom();
        $registersWorkshops = $this->registrationRepository->getNbInscritByWorkshopBySlotTime(intval(date('Y')));
        $workshopsWithoutRoomArray = [];

        // Pour chaque ateliers
        foreach ($registersWorkshops as $workshop) {
            $tempMinDiffId = [
                'id' => 0,
                'minTempdiff' => -1,
            ];

            // On cherche les salle qui est le plus proche en terme de capacité par rapport au nombre d'inscrit à l'atelier
            $output->writeln(['['. date('d/m/Y-H:s'). '] Recherche de salle pour l\`atelier : ' . $workshop['name'] ]);
            foreach ($universityRoomsAvailable as $universityRoom) {
                $nbInscrit = intval($workshop['nombre']);
                $diff = $universityRoom->getCapacity() - $nbInscrit;
                if ($diff >= 0 && ($diff < $tempMinDiffId['minTempdiff'] || $tempMinDiffId['minTempdiff'] === -1) ) {
                    $tempMinDiffId['id'] = $universityRoom->getId();
                    $tempMinDiffId['minTempdiff'] = $diff;
                }
            }

            if ($tempMinDiffId['minTempdiff'] === -1) {
                $output->writeln(['[' . date('d/m/Y-H:s') . '] Aucune salle disponible pour : ' . $workshop['name']]);
                $workshopsWithoutRoomArray[] = $this->workshopRepository->find($workshop['id']);
            }

            $workshopToUpdate = $this->workshopRepository->find($workshop['id']);
            $output->writeln(['['. date('d/m/Y-H:s'). '] Association de la salle : '. $universityRoom->getName()]);

            $universityRoom = $this->universityRoomRepository->find($tempMinDiffId['id']);
            $output->writeln(['['. date('d/m/Y-H:s'). '] A l\`atelier : ' . $workshopToUpdate->getName()]);

            $workshopToUpdate->setUniversityRoom($universityRoom);
            $this->entityManager->persist($workshopToUpdate);

            // On supprime la salle de notre tableau car elle n'est plus disponible
            $idArrayRoomAssign = $this->_findIndexUniversityRoomsFromId($universityRoom->getId(), $universityRoomsAvailable);
            unset($universityRoomsAvailable[$idArrayRoomAssign]);
        }
        $this->entityManager->flush();

        if (count($workshopsWithoutRoomArray) > 0) {
            $output->writeln(['['. date('d/m/Y-H:s'). '] Ateliers sans salle : ']);
            foreach ($workshopsWithoutRoomArray as $item) {
                $output->writeln([$item->getName()]);
            }
        } else {
            $output->writeln(['['. date('d/m/Y-H:s'). '] Toutes les ateliers ont eu une salle ']);
        }

        return Command::SUCCESS;
    }

    private function _findIndexUniversityRoomsFromId(int $index, array $universityRooms) {
        foreach ($universityRooms as $key => $universityRoom) {
            if ($universityRoom->getId() === $index) {
                return $key;
            }
        }
    }
}
