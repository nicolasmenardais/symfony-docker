<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260916144341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion de catégories, vidéos et liens catégorie/vidéo';
    }

    public function up(Schema $schema): void
    {
        // 1) Catégories
        $categories = ['Tutoriel', 'Vlog', 'Musique', 'Gaming'];

        foreach ($categories as $libelle) {
            $this->addSql(
                "INSERT INTO stwitcho.categorie (libelle) VALUES ('{$libelle}')"
            );
        }

        // 2) Vidéos (membre_id de 1 à 10, correspondant aux membres déjà insérés)
       $videos = [
    ['titre' => 'Découverte de Symfony',    'duree' => '12:30', 'taille' => 45000, 'vues' => 120, 'like' => 15, 'live' => 'false', 'membre_id' => 1],
    ['titre' => 'Mon setup gaming',         'duree' => '08:15', 'taille' => 30000, 'vues' => 340, 'like' => 42, 'live' => 'false', 'membre_id' => 2],
    ['titre' => 'Balade en forêt',          'duree' => '03:45', 'taille' => 15000, 'vues' => 89,  'like' => 20, 'live' => 'false', 'membre_id' => 3],
    ['titre' => 'Créer une API REST',       'duree' => '45:00', 'taille' => 90000, 'vues' => 50,  'like' => 8,  'live' => 'true',  'membre_id' => 4],
    ['titre' => 'Top 5 jeux indépendants',  'duree' => '20:10', 'taille' => 60000, 'vues' => 210, 'like' => 33, 'live' => 'false', 'membre_id' => 5],
    ['titre' => 'Cuisine facile',           'duree' => '15:00', 'taille' => 48000, 'vues' => 175, 'like' => 27, 'live' => 'false', 'membre_id' => 6],
    ['titre' => 'Comprendre Git',           'duree' => '10:20', 'taille' => 38000, 'vues' => 260, 'like' => 51, 'live' => 'false', 'membre_id' => 7],
    ['titre' => 'Ma première compétition',  'duree' => '30:00', 'taille' => 75000, 'vues' => 95,  'like' => 19, 'live' => 'true',  'membre_id' => 8],
    ['titre' => 'Les bases de PostgreSQL',  'duree' => '18:40', 'taille' => 52000, 'vues' => 140, 'like' => 22, 'live' => 'false', 'membre_id' => 9],
    ['titre' => 'Challenge 24 heures',      'duree' => '25:00', 'taille' => 68000, 'vues' => 310, 'like' => 47, 'live' => 'true',  'membre_id' => 10],
];

        foreach ($videos as $v) {
            $this->addSql(
                "INSERT INTO stwitcho.video (titre, duree, taille, nb_vues, nb_like, live, membre_id) " .
                "VALUES ('{$v['titre']}', '{$v['duree']}', {$v['taille']}, {$v['vues']}, {$v['like']}, {$v['live']}, {$v['membre_id']})"
            );
        }

        // 3) Liens catégorie <-> vidéo (table de jointure categorie_video)
        // suppose : categorie_id de 1 à 4, video_id de 1 à 8
        $liens = [
            ['categorie_id' => 1, 'video_id' => 1],
            ['categorie_id' => 1, 'video_id' => 6],
            ['categorie_id' => 2, 'video_id' => 2],
            ['categorie_id' => 2, 'video_id' => 7],
            ['categorie_id' => 3, 'video_id' => 3],
            ['categorie_id' => 3, 'video_id' => 8],
            ['categorie_id' => 4, 'video_id' => 4],
            ['categorie_id' => 4, 'video_id' => 5],
        ];

        foreach ($liens as $l) {
            $this->addSql(
                "INSERT INTO stwitcho.categorie_video (categorie_id, video_id) " .
                "VALUES ({$l['categorie_id']}, {$l['video_id']})"
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE stwitcho.categorie_video RESTART IDENTITY CASCADE');
        $this->addSql('TRUNCATE TABLE stwitcho.video RESTART IDENTITY CASCADE');
        $this->addSql('TRUNCATE TABLE stwitcho.categorie RESTART IDENTITY CASCADE');
    }
}