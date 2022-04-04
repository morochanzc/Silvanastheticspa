<?php

namespace App\Repository;

use App\Entity\Duracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Duracion|null find($id, $lockMode = null, $lockVersion = null)
 * @method Duracion|null findOneBy(array $criteria, array $orderBy = null)
 * @method Duracion[]    findAll()
 * @method Duracion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DuracionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Duracion::class);
    }

    // /**
    //  * @return Duracion[] Returns an array of Duracion objects
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
    public function findOneBySomeField($value): ?Duracion
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
