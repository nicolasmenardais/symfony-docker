<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260916120156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stwitcho.categorie (id serial, libelle VARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE stwitcho.categorie_video (categorie_id INT NOT NULL, video_id INT NOT NULL, PRIMARY KEY (categorie_id, video_id))');
        $this->addSql('CREATE TABLE stwitcho.membre (id serial, mel VARCHAR(50) NOT NULL, mdp VARCHAR(255) NOT NULL, pseudo VARCHAR(15) NOT NULL, photo_profil VARCHAR(100) NOT NULL, date_creation_compte DATE NOT NULL, utilisateur_role BOOLEAN NOT NULL, return VARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE stwitcho.video (id serial, titre VARCHAR(25) NOT NULL, duree VARCHAR(5) NOT NULL, taille INT NOT NULL, nb_vues INT DEFAULT NULL, nb_like INT DEFAULT NULL, live BOOLEAN NOT NULL, membre_id INT DEFAULT NULL, PRIMARY KEY (id))');
        $this->addSql('ALTER TABLE stwitcho.categorie_video ADD CONSTRAINT FK_89BF37FCBCF5E72D FOREIGN KEY (categorie_id) REFERENCES stwitcho.categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stwitcho.categorie_video ADD CONSTRAINT FK_89BF37FC29C1004E FOREIGN KEY (video_id) REFERENCES stwitcho.video (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stwitcho.video ADD CONSTRAINT FK_254C6F7B6A99F74A FOREIGN KEY (membre_id) REFERENCES stwitcho.membre (id) NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA stwitcho');
        $this->addSql('ALTER TABLE categorie_video DROP CONSTRAINT FK_89BF37FCBCF5E72D');
        $this->addSql('ALTER TABLE categorie_video DROP CONSTRAINT FK_89BF37FC29C1004E');
        $this->addSql('ALTER TABLE stwitcho.video DROP CONSTRAINT FK_254C6F7B6A99F74A');
        $this->addSql('DROP TABLE stwitcho.categorie');
        $this->addSql('DROP TABLE categorie_video');
        $this->addSql('DROP TABLE stwitcho.membre');
        $this->addSql('DROP TABLE stwitcho.video');
    }
}
