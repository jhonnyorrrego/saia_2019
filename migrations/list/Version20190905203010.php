<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905203010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        //DELETE
        $this->connection->delete('modulo', [
            'nombre' => 'actual_trd'
        ]);

        //UPDATE 1
        $this->connection->update('modulo', [
            'etiqueta' => 'Versiones',
            'nombre' => 'versiones_trd',
            'orden' => 2
        ], [
            'nombre' => 'historial_versiones_trd'
        ]);

        $this->connection->update('busqueda', [
            'etiqueta' => 'Versiones',
            'nombre' => 'versiones_trd'
        ], [
            'nombre' => 'historial_versiones_trd'
        ]);

        $this->connection->update('busqueda_componente', [
            'etiqueta' => 'Versiones',
            'nombre' => 'versiones_trd',
            'ordenado_por' => 'version',
            'direccion' => 'DESC'
        ], [
            'nombre' => 'historial_versiones_trd'
        ]);

        $this->connection->update('busqueda_condicion', [
            'etiqueta_condicion' => 'versiones_trd',
            'codigo_where' => '1=1'
        ], [
            'etiqueta_condicion' => 'historial_versiones_trd'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
