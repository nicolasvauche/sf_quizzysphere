<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209112856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE attempt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE attempt (id INT NOT NULL, quizz_id INT NOT NULL, player_id INT NOT NULL, current_question_id INT DEFAULT NULL, score INT DEFAULT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_18EC0266BA934BCD ON attempt (quizz_id)');
        $this->addSql('CREATE INDEX IDX_18EC026699E6F5DF ON attempt (player_id)');
        $this->addSql('CREATE INDEX IDX_18EC0266A0F35D66 ON attempt (current_question_id)');
        $this->addSql('COMMENT ON COLUMN attempt.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN attempt.ended_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE attempt ADD CONSTRAINT FK_18EC0266BA934BCD FOREIGN KEY (quizz_id) REFERENCES quizz (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attempt ADD CONSTRAINT FK_18EC026699E6F5DF FOREIGN KEY (player_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attempt ADD CONSTRAINT FK_18EC0266A0F35D66 FOREIGN KEY (current_question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE attempt_id_seq CASCADE');
        $this->addSql('ALTER TABLE attempt DROP CONSTRAINT FK_18EC0266BA934BCD');
        $this->addSql('ALTER TABLE attempt DROP CONSTRAINT FK_18EC026699E6F5DF');
        $this->addSql('ALTER TABLE attempt DROP CONSTRAINT FK_18EC0266A0F35D66');
        $this->addSql('DROP TABLE attempt');
    }
}
