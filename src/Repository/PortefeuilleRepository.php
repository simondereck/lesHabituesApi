<?php

namespace App\Repository;

use App\Entity\Portefeuille;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Portefeuille|null find($id, $lockMode = null, $lockVersion = null)
 * @method Portefeuille|null findOneBy(array $criteria, array $orderBy = null)
 * @method Portefeuille[]    findAll()
 * @method Portefeuille[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PortefeuilleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Portefeuille::class);
    }

    // /**
    //  * @return Conference[] Returns an array of Conference objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Portefeuille
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOneByUidAndCid($uid,$cid):?Portefeuille
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.uid = :uid')
            ->andWhere('p.cid = :cid')
            ->setParameter('uid', $uid)
            ->setParameter('cid', $cid)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
