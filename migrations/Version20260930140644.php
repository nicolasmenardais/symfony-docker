<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260930140644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Suppression en cascade des vidéos quand on supprime un membre';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE stwitcho.video DROP CONSTRAINT fk_254c6f7b6a99f74a');
        $this->addSql('ALTER TABLE stwitcho.video ADD CONSTRAINT FK_254C6F7B6A99F74A FOREIGN KEY (membre_id) REFERENCES stwitcho.membre (id) ON DELETE CASCADE NOT DEFERRABLE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE stwitcho.video DROP CONSTRAINT FK_254C6F7B6A99F74A');
        $this->addSql('ALTER TABLE stwitcho.video ADD CONSTRAINT fk_254c6f7b6a99f74a FOREIGN KEY (membre_id) REFERENCES stwitcho.membre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}