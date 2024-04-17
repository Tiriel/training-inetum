<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractWritingRepository extends ServiceEntityRepository
{
    public function save(object $entity, bool $flush = false): void
    {
        $className = $this->getClassName();
        if (!$entity instanceof $className) {
            throw new \InvalidArgumentException();
        }

        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(object $entity, bool $flush = false): void
    {
        $className = $this->getClassName();
        if (!$entity instanceof $className) {
            throw new \InvalidArgumentException();
        }

        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
