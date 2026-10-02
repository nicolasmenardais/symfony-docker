<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260916124931 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insertion de 10 membres';
    }

    public function up(Schema $schema): void
    {
        $membres = [
            ['mel' => 'lea.martin@btsmalraux.net',    'pseudo' => 'LeaM',      'photo' => 'avatar1.jpg', 'date' => '2026-09-01', 'role' => 'true',  'return' => 'aucun'],
            ['mel' => 'tom.dubois@btsmalraux.net',    'pseudo' => 'TomD',      'photo' => 'avatar2.jpg', 'date' => '2026-09-02', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'sara.petit@btsmalraux.net',    'pseudo' => 'SaraP',     'photo' => 'avatar3.jpg', 'date' => '2026-09-03', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'nico.moreau@btsmalraux.net',   'pseudo' => 'NicoM',     'photo' => 'avatar4.jpg', 'date' => '2026-09-04', 'role' => 'true',  'return' => 'aucun'],
            ['mel' => 'chloe.lambert@btsmalraux.net', 'pseudo' => 'ChloeL',    'photo' => 'avatar5.jpg', 'date' => '2026-09-05', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'hugo.fontaine@btsmalraux.net', 'pseudo' => 'HugoF',     'photo' => 'avatar6.jpg', 'date' => '2026-09-06', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'emma.roux@btsmalraux.net',     'pseudo' => 'EmmaR',     'photo' => 'avatar7.jpg', 'date' => '2026-09-07', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'lucas.girard@btsmalraux.net',  'pseudo' => 'LucasG',    'photo' => 'avatar8.jpg', 'date' => '2026-09-08', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'julie.bonnet@btsmalraux.net',  'pseudo' => 'JulieB',    'photo' => 'avatar9.jpg', 'date' => '2026-09-09', 'role' => 'false', 'return' => 'aucun'],
            ['mel' => 'maxime.faure@btsmalraux.net',  'pseudo' => 'MaximeF',   'photo' => 'avatar10.jpg','date' => '2026-09-10', 'role' => 'false', 'return' => 'aucun'],
        ];

        foreach ($membres as $m) {
            // mot de passe hashé (bcrypt) — jamais en clair
            $mdpHash = password_hash('MotDePasse123!', PASSWORD_BCRYPT);

            $this->addSql(
                "INSERT INTO stwitcho.membre (mel, mdp, pseudo, photo_profil, date_creation_compte, utilisateur_role, return) " .
                "VALUES ('{$m['mel']}', '{$mdpHash}', '{$m['pseudo']}', '{$m['photo']}', '{$m['date']}', {$m['role']}, '{$m['return']}')"
            );
        }
    }

    public function down(Schema $schema): void
    {
        $this->addSql('TRUNCATE TABLE stwitcho.membre RESTART IDENTITY CASCADE');
    }
}