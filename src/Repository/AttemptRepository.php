<?php

namespace App\Repository;

use App\Entity\Attempt;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Attempt>
 *
 * @method Attempt|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attempt|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attempt[]    findAll()
 * @method Attempt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttemptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attempt::class);
    }

    public function findMaxLevelsByUserAndCategories(User $user, $categories): array
    {
        $qb = $this->createQueryBuilder('a')
            ->select('qc.id AS categoryId, MAX(q.level) AS maxLevel')
            ->innerJoin('a.quizz', 'q')
            ->innerJoin('q.quizzCategories', 'qc')
            ->where('a.player = :user')
            ->andWhere('qc IN (:categories)')
            ->groupBy('qc.id')
            ->setParameter('user', $user)
            ->setParameter('categories', $categories);

        $result = $qb->getQuery()->getResult();

        $nextLevels = [];
        foreach($result as $row) {
            // Extraire le numéro du niveau actuel à partir de maxLevel
            $currentLevelNum = (int)substr($row['maxLevel'], 0, 1);
            // Déterminer le niveau suivant
            $nextLevelNum = $currentLevelNum + 1;
            // Convertir le numéro du niveau suivant en sa représentation textuelle
            switch($nextLevelNum) {
                case 2:
                    $nextLevel = "2 - Intermédiaire";
                    break;
                case 3:
                    $nextLevel = "3 - Avancé";
                    break;
                default:
                    // Si le niveau actuel est déjà le plus élevé, tu peux décider de ne pas augmenter le niveau
                    // ou de retourner le niveau actuel comme "maximum atteint".
                    $nextLevel = "3 - Avancé"; // ou garder le niveau actuel si tu ne veux pas dépasser le niveau Avancé
                    break;
            }
            $nextLevels[$row['categoryId']] = $nextLevel;
        }

        return $nextLevels;
    }
}
