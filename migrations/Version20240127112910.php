<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240127112910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE quizz_category_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quizz_category (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8798E5D3727ACA70 ON quizz_category (parent_id)');
        $this->addSql('COMMENT ON COLUMN quizz_category.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE quizz_category ADD CONSTRAINT FK_8798E5D3727ACA70 FOREIGN KEY (parent_id) REFERENCES quizz_category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE quizz_category_id_seq CASCADE');
        $this->addSql('ALTER TABLE quizz_category DROP CONSTRAINT FK_8798E5D3727ACA70');
        $this->addSql('DROP TABLE quizz_category');
    }
}
