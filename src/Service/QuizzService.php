<?php

namespace App\Service;

use App\Repository\CourseRepository;

class QuizzService
{
    private CourseRepository $courseRepository;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param int $courseId
     * @return array
     */
    public function getQuizzsByCourse(int $courseId): array
    {
        $course = $this->courseRepository->find($courseId);

        if(!$course) {
            return [];
        }

        $categories = $course->getQuizzCategories();

        return $this->collectQuizzsFromCategories($categories);
    }

    /**
     * @param $categories
     * @return array
     */
    public function collectQuizzsFromCategories($categories): array
    {
        $quizzs = [];
        foreach($categories as $category) {
            foreach($category->getQuizzs() as $quizz) {
                if(!in_array($quizz, $quizzs)) {
                    $quizzs[] = $quizz;
                }
            }

            $children = $category->getChildren(); // Assure-toi que cette méthode existe et renvoie les sous-catégories
            if($children) {
                $quizzs = array_merge($quizzs, $this->collectQuizzsFromCategories($children));
            }
        }

        return $quizzs;
    }
}
