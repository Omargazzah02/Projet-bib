<?php

namespace App\Repository;

use App\Entity\Reserv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reserv>
 *
 * @method Reserv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reserv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reserv[]    findAll()
 * @method Reserv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserv::class);
    }

//    /**
//     * @return Reserv[] Returns an array of Reserv objects
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

//    public function findOneBySomeField($value): ?Reserv
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}