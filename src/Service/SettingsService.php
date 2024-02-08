<?php

namespace App\Service;

use App\Entity\Settings;
use Doctrine\ORM\EntityManagerInterface;

class SettingsService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    private function getSettings()
    {
        return $this->entityManager->getRepository(Settings::class)->find(1);
    }

    public function getDefaultUserGroup()
    {
        return $this->getSettings()?->getDefaultUserGroup();
    }

    public function getQuizzQuestionsMax()
    {
        return $this->getSettings()?->getQuizzQuestionsMax();
    }

    public function getQuizzAnswersMax()
    {
        return $this->getSettings()?->getQuizzAnswersMax();
    }
}
