<?php

namespace App\Repository;


use App\Entity\PathwaysAbundance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class PathwaysAbundanceRepository extends ServiceEntityRepository
{


    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PathwaysAbundance::class);
    }

}