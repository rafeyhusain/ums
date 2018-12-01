<?php

namespace App\Repository;

use App\Entity\Grp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Grp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Grp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Grp[]    findAll()
 * @method Grp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Grp::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('a')
            ->where('a.something = :value')->setParameter('value', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
