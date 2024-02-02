<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240202103908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE quizz_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE quizz (id INT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, cover VARCHAR(255) DEFAULT NULL, level VARCHAR(255) NOT NULL, timer INT DEFAULT NULL, active BOOLEAN NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN quizz.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE quizz_quizz_category (quizz_id INT NOT NULL, quizz_category_id INT NOT NULL, PRIMARY KEY(quizz_id, quizz_category_id))');
        $this->addSql('CREATE INDEX IDX_D83A466BA934BCD ON quizz_quizz_category (quizz_id)');
        $this->addSql('CREATE INDEX IDX_D83A46634535201 ON quizz_quizz_category (quizz_category_id)');
        $this->addSql('ALTER TABLE quizz_quizz_category ADD CONSTRAINT FK_D83A466BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE quizz_quizz_category ADD CONSTRAINT FK_D83A46634535201 FOREIGN KEY (quizz_category_id) REFERENCES quizz_category (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE quizz_id_seq CASCADE');
        $this->addSql('ALTER TABLE quizz_quizz_category DROP CONSTRAINT FK_D83A466BA934BCD');
        $this->addSql('ALTER TABLE quizz_quizz_category DROP CONSTRAINT FK_D83A46634535201');
        $this->addSql('DROP TABLE quizz');
        $this->addSql('DROP TABLE quizz_quizz_category');
    }
}
