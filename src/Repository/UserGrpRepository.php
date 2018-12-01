<?php

namespace App\Repository;

use App\Entity\UserGrp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserGrp|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserGrp|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserGrp[]    findAll()
 * @method UserGrp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserGrpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserGrp::class);
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
