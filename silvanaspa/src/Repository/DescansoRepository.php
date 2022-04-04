<?php

namespace App\Repository;

use App\Entity\Descanso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Descanso|null find($id, $lockMode = null, $lockVersion = null)
 * @method Descanso|null findOneBy(array $criteria, array $orderBy = null)
 * @method Descanso[]    findAll()
 * @method Descanso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescansoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Descanso::class);
    }

    // /**
    //  * @return Descanso[] Returns an array of Descanso objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Descanso
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
