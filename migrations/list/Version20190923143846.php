<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923143846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('categoria_formato', [
            'nombre' => 'Trámites Generales'
        ], [
            'idcategoria_formato' => 3
        ]);

        $this->connection->update('modulo', [
            'etiqueta' => 'CAD'
        ], [
            'idmodulo' => 1
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
