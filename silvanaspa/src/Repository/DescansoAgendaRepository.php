<?php

namespace App\Repository;

use App\Entity\DescansoAgenda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DescansoAgenda|null find($id, $lockMode = null, $lockVersion = null)
 * @method DescansoAgenda|null findOneBy(array $criteria, array $orderBy = null)
 * @method DescansoAgenda[]    findAll()
 * @method DescansoAgenda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescansoAgendaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DescansoAgenda::class);
    }

    // /**
    //  * @return DescansoAgenda[] Returns an array of DescansoAgenda objects
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
    public function findOneBySomeField($value): ?DescansoAgenda
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
