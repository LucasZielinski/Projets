<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211112154214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE consultation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE historique_connexion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE historique_consultation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE indisponibilite_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE consultation (id INT NOT NULL, date_heure TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, motif VARCHAR(150) NOT NULL, etat VARCHAR(50) NOT NULL, duree TIME(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE historique_connexion (id INT NOT NULL, date_heure TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE historique_consultation (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE indisponibilite (id INT NOT NULL, date_heure_debut TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_heure_fin TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, motif VARCHAR(150) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE consultation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE historique_connexion_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE historique_consultation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE indisponibilite_id_seq CASCADE');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE historique_connexion');
        $this->addSql('DROP TABLE historique_consultation');
        $this->addSql('DROP TABLE indisponibilite');
    }
}
