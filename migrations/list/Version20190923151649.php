<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190923151649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Borrando funciones_formato_enlace que generan conflicto y no son necesarios';
    }

    public function up(Schema $schema): void
    {
        $this->connection->delete('funciones_formato_enlace', [
            'idfunciones_formato_enlace' => '556'
        ]);

        $this->connection->delete('funciones_formato', [
            'idfunciones_formato' => '598'
        ]);

        $this->connection->update('modulo', [
            'etiqueta' => 'CAD',
        ], [
            'nombre' => 'agrupador_radicacion'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
