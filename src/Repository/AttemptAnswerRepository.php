<?php

namespace App\Repository;

use App\Entity\AttemptAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AttemptAnswer>
 *
 * @method AttemptAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttemptAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttemptAnswer[]    findAll()
 * @method AttemptAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttemptAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttemptAnswer::class);
    }

//    /**
//     * @return AttemptAnswer[] Returns an array of AttemptAnswer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?AttemptAnswer
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
