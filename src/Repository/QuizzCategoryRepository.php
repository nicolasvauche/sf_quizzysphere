<?php

namespace App\Repository;

use App\Entity\QuizzCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuizzCategory>
 *
 * @method QuizzCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizzCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizzCategory[]    findAll()
 * @method QuizzCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizzCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuizzCategory::class);
    }

    public function findTopLevelCategories(): array
    {
        return $this->createQueryBuilder('qc')
            ->where('qc.parent IS NULL')
            ->orderBy('qc.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getHierarchicalCategories(): array
    {
        $categories = $this->findBy([], ['name' => 'ASC']);

        return $this->buildHierarchy($categories);
    }

    private function buildHierarchy($categories, $parentId = null, $depth = 0): array
    {
        $result = [];
        foreach($categories as $category) {
            if(($category->getParent() ? $category->getParent()->getId() : null) == $parentId) {
                $category->setTemporaryDepth($depth);
                $result[] = $category;
                $children = $this->buildHierarchy($categories, $category->getId(), $depth + 1);
                $result = array_merge($result, $children);
            }
        }

        return $result;
    }

    //    /**
    //     * @return QuizzCategory[] Returns an array of QuizzCategory objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('q.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?QuizzCategory
    //    {
    //        return $this->createQueryBuilder('q')
    //            ->andWhere('q.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
