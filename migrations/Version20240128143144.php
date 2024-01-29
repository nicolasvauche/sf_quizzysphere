<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240128143144 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE course_user_group (course_id INT NOT NULL, user_group_id INT NOT NULL, PRIMARY KEY(course_id, user_group_id))');
        $this->addSql('CREATE INDEX IDX_50E0F11E591CC992 ON course_user_group (course_id)');
        $this->addSql('CREATE INDEX IDX_50E0F11E1ED93D47 ON course_user_group (user_group_id)');
        $this->addSql('ALTER TABLE course_user_group ADD CONSTRAINT FK_50E0F11E591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course_user_group ADD CONSTRAINT FK_50E0F11E1ED93D47 FOREIGN KEY (user_group_id) REFERENCES user_group (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE course_user_group DROP CONSTRAINT FK_50E0F11E591CC992');
        $this->addSql('ALTER TABLE course_user_group DROP CONSTRAINT FK_50E0F11E1ED93D47');
        $this->addSql('DROP TABLE course_user_group');
    }
}
