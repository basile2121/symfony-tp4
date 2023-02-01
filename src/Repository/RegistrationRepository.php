<?php

namespace App\Repository;

use App\Entity\Registration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Registration>
 *
 * @method Registration|null find($id, $lockMode = null, $lockVersion = null)
 * @method Registration|null findOneBy(array $criteria, array $orderBy = null)
 * @method Registration[]    findAll()
 * @method Registration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegistrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Registration::class);
    }

    public function save(Registration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Registration $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function nbParticipant(int $id) {
        return $this->createQueryBuilder('r')
         ->leftJoin("r.workshop", "w")
         ->select("count(w)")
         ->andWhere('r.workshop =:id')
         ->setParameter('id', $id)
         ->getQuery()
         ->getResult();
      }

    /**
     * @return array Returns an array
     */
    public function getNbInscritByWorkshopBySlotTime($edition = null): array
    {
        $builder =  $this->createQueryBuilder('r');
        $builder->select(['w.name', 'ts.label', 'COUNT(w.id) as nombre']);
        $builder->join('r.workshop', 'w');
        $builder->join('r.timeslot', 'ts');
        $builder->join('r.student', 's');
        $builder->groupBy('w.name');
        $builder->addGroupBy('ts.label');
        if ($edition !== null) {
            $builder->addSelect(['w.id as id', 'w.name as name']);
            $builder->join('w.edition', 'e');
            $builder->where('e.year = :year');
            $builder->setParameter('year', $edition);
        }
        return $builder->getQuery()->getArrayResult();
    }

//    /**
//     * @return Registration[] Returns an array of Registration objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Registration
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
