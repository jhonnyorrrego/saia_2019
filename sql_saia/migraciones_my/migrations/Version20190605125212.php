<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605125212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->executeQuery("drop trigger if exists adicionar_accion_anexo");
        $this->connection->executeQuery("drop trigger if exists adicionar_accion_pot_it");
        $this->connection->executeQuery("drop trigger if exists tr_cargo_update");
        $this->connection->executeQuery("drop trigger if exists tr_dependencia_cargo_insert");
        $this->connection->executeQuery("drop trigger if exists tr_dependencia_cargo_update");
        $this->connection->executeQuery("drop trigger if exists tr_dependencia_update");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
