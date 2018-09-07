<?php

namespace App\Repository;

use App\Entity\Eresa;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class EresaRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Eresa::class);
    }

    /**
     * @param User $user
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getCountByUser(User $user)
    {
        return $this->createQueryBuilder('e')
            ->select('count(e.id)')
            ->where('e.user = :user')
            ->andWhere('e.isActivated = true')
            ->setParameters([
                'user' => $user
            ])
            ->getQuery()
            ->getSingleScalarResult();
    }
}
