<?php

namespace App\Repository;

use App\Entity\FranchisePermission;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FranchisePermission>
 *
 * @method FranchisePermission|null find($id, $lockMode = null, $lockVersion = null)
 * @method FranchisePermission|null findOneBy(array $criteria, array $orderBy = null)
 * @method FranchisePermission[]    findAll()
 * @method FranchisePermission[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FranchisePermissionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FranchisePermission::class);
    }

    public function save(FranchisePermission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FranchisePermission $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FranchisePermission[] Returns an array of FranchisePermission objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FranchisePermission
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
