<?php
namespace App\Repository;

use App\Entity\TypeBonbon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method TypeBonbon|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeBonbon|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeBonbon[]    findAll()
 * @method TypeBonbon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeBonbonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeBonbon::class);
    }
}

