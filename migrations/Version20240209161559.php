<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240209161559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE attempt_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE attempt_answer (id INT NOT NULL, attempt_id INT NOT NULL, question_id INT NOT NULL, answer_id INT DEFAULT NULL, score INT DEFAULT NULL, started_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, ended_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_FEC920DCB191BE6B ON attempt_answer (attempt_id)');
        $this->addSql('CREATE INDEX IDX_FEC920DC1E27F6BF ON attempt_answer (question_id)');
        $this->addSql('CREATE INDEX IDX_FEC920DCAA334807 ON attempt_answer (answer_id)');
        $this->addSql('COMMENT ON COLUMN attempt_answer.started_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN attempt_answer.ended_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE attempt_answer ADD CONSTRAINT FK_FEC920DCB191BE6B FOREIGN KEY (attempt_id) REFERENCES attempt (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attempt_answer ADD CONSTRAINT FK_FEC920DC1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE attempt_answer ADD CONSTRAINT FK_FEC920DCAA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE attempt_answer_id_seq CASCADE');
        $this->addSql('ALTER TABLE attempt_answer DROP CONSTRAINT FK_FEC920DCB191BE6B');
        $this->addSql('ALTER TABLE attempt_answer DROP CONSTRAINT FK_FEC920DC1E27F6BF');
        $this->addSql('ALTER TABLE attempt_answer DROP CONSTRAINT FK_FEC920DCAA334807');
        $this->addSql('DROP TABLE attempt_answer');
    }
}
