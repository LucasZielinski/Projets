<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122073924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE assistant_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE medecin_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE patient_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE assistant (id INT NOT NULL, medecin_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C2997CD14F31A84 ON assistant (medecin_id)');
        $this->addSql('CREATE TABLE medecin (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE patient (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE assistant ADD CONSTRAINT FK_C2997CD14F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consultation ADD medecin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD patient_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A64F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_964685A64F31A84 ON consultation (medecin_id)');
        $this->addSql('CREATE INDEX IDX_964685A66B899279 ON consultation (patient_id)');
        $this->addSql('ALTER TABLE historique_connexion ADD utilisateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE historique_connexion ADD CONSTRAINT FK_C018B2D4FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C018B2D4FB88E14F ON historique_connexion (utilisateur_id)');
        $this->addSql('ALTER TABLE indisponibilite ADD medecin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE indisponibilite ADD CONSTRAINT FK_8717036F4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8717036F4F31A84 ON indisponibilite (medecin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE assistant DROP CONSTRAINT FK_C2997CD14F31A84');
        $this->addSql('ALTER TABLE consultation DROP CONSTRAINT FK_964685A64F31A84');
        $this->addSql('ALTER TABLE indisponibilite DROP CONSTRAINT FK_8717036F4F31A84');
        $this->addSql('ALTER TABLE consultation DROP CONSTRAINT FK_964685A66B899279');
        $this->addSql('DROP SEQUENCE assistant_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE medecin_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE patient_id_seq CASCADE');
        $this->addSql('DROP TABLE assistant');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE patient');
        $this->addSql('ALTER TABLE historique_connexion DROP CONSTRAINT FK_C018B2D4FB88E14F');
        $this->addSql('DROP INDEX IDX_C018B2D4FB88E14F');
        $this->addSql('ALTER TABLE historique_connexion DROP utilisateur_id');
        $this->addSql('DROP INDEX IDX_8717036F4F31A84');
        $this->addSql('ALTER TABLE indisponibilite DROP medecin_id');
        $this->addSql('DROP INDEX IDX_964685A64F31A84');
        $this->addSql('DROP INDEX IDX_964685A66B899279');
        $this->addSql('ALTER TABLE consultation DROP medecin_id');
        $this->addSql('ALTER TABLE consultation DROP patient_id');
    }
}
