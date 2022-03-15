<?php

namespace App\Repository;

use App\Entity\Transaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Transaction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transaction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transaction[]    findAll()
 * @method Transaction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transaction::class);
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
    public function findOneBySomeField($value): ?Transaction
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */



    public function countSearch($params){
        $builder = $this->createQueryBuilder('s');
        $builder->select('count(s.id)');

        foreach($params as $key => $value){
            if ($value["like"])
                $builder->andWhere($builder->expr()->like('s.'.$value["key"],$builder->expr()->literal("%".$value["value"]."%")));
            else
                $builder->andWhere("s.".$value["key"]."=".$value["value"]);
        }

        return $builder->getQuery()->getSingleScalarResult();

    }

    public function paramsSearch($params,$limit,$offset,$order=true){
        $builder = $this->createQueryBuilder('s');

        foreach($params as $key => $value){
            if ($value["like"])
                $builder->andWhere($builder->expr()->like('s.'.$value["key"],$builder->expr()->literal("%".$value["value"]."%")));
            else
                $builder->andWhere("s.".$value["key"]."=".$value["value"]);
        }

        if ($limit)
            $builder->setMaxResults($limit);

        if ($offset)
            $builder->setFirstResult($offset);

        if ($order){
            $builder->orderBy("s.id","desc");
        }else{
            $builder->orderBy("s.id","asc");
        }

        return $builder->getQuery()->getArrayResult();

    }

}
