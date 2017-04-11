<?php

namespace AppBundle\Repository;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;

class AsinChildRepository extends EntityRepository
{
    public function findByUser(User $user)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->join('c.asin','a');
        $qb->where('a.user = :user');

        $qb->setParameter('user',$user->getId());

        return $qb->getQuery()->getResult();
    }
}
