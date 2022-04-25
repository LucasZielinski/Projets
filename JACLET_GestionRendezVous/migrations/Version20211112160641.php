<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112160641 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE inheritance_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE test_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE inheritance (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE test (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE historique_consultation ADD la_consultation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_consultation ADD CONSTRAINT FK_324EEFC59BF5223C FOREIGN KEY (la_consultation_id) REFERENCES consultation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_324EEFC59BF5223C ON historique_consultation (la_consultation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE inheritance_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE test_id_seq CASCADE');
        $this->addSql('DROP TABLE inheritance');
        $this->addSql('DROP TABLE test');
        $this->addSql('ALTER TABLE historique_consultation DROP CONSTRAINT FK_324EEFC59BF5223C');
        $this->addSql('DROP INDEX IDX_324EEFC59BF5223C');
        $this->addSql('ALTER TABLE historique_consultation DROP la_consultation_id');
    }
}
