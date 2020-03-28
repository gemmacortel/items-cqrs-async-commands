<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Item;
use App\Domain\Repository\ItemsRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class DoctrineItemsRepository extends ServiceEntityRepository implements ItemsRepository
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Doctrine\ORM\EntityRepository
     */
    private $repository;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Item::class);

        $this->repository = $this->getEntityManager()->getRepository(Item::class);
    }

    public function search(int $id):?Item
    {
        return $this->repository->find($id);
    }

    public function getAll():array
    {
        return $this->repository->findAll();
    }

    public function save(Item $item): void
    {
        $this->getEntityManager()->persist($item);
        $this->getEntityManager()->flush();
    }

    public function delete(Item $item): void
    {
        $this->getEntityManager()->remove($item);
        $this->getEntityManager()->flush();
    }
}
