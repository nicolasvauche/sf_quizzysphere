<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\AttemptRepository;
use App\Repository\CourseRepository;

class QuizzService
{
    private CourseRepository $courseRepository;
    private AttemptRepository $attemptRepository;

    public function __construct(CourseRepository $courseRepository, AttemptRepository $attemptRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->attemptRepository = $attemptRepository;
    }

    /**
     * @param int $courseId
     * @param User $user
     * @return array
     */
    public function getQuizzsByCourse(int $courseId, ?User $user = null): array
    {
        $course = $this->courseRepository->find($courseId);

        if(!$course) {
            return [];
        }

        $categories = $course->getQuizzCategories();

        return $this->collectQuizzsFromCategories($categories, $user);
    }

    /**
     * @param $categories
     * @param User|null $user
     * @return array
     */
    public function collectQuizzsFromCategories($categories, ?User $user = null): array
    {
        $quizzs = [];
        $maxUserLevels = $user ? $this->getMaxLevelsByUserAndCategories($user, $categories) : null;
        foreach($categories as $category) {
            foreach($category->getQuizzs() as $quizz) {
                if($quizz->isActive()) {
                    if($user) {
                        $quizzLevel = $quizz->getLevel();
                        $maxLevelForCategory = $maxUserLevels[$category->getId()] ?? '1 - Débutant';

                        if($quizzLevel === $maxLevelForCategory && !in_array($quizz, $quizzs)) {
                            $quizzs[] = $quizz;
                        }
                    } else {
                        if(!in_array($quizz, $quizzs)) {
                            $quizzs[] = $quizz;
                        }
                    }
                }
            }

            $children = $category->getChildren();
            if($children) {
                $quizzs = array_merge($quizzs, $this->collectQuizzsFromCategories($children, $user));
            }
        }

        return $quizzs;
    }

    public function getMaxLevelsByUserAndCategories(User $user, $categories): array
    {
        return $this->attemptRepository->findMaxLevelsByUserAndCategories($user, $categories);
    }
}
