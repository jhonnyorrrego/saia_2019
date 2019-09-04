<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190716133622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->delete('busqueda', [
            'nombre' => 'busqueda_admin'
        ]);
        $this->connection->delete('busqueda', [
            'nombre' => 'busqueda_general'
        ]);
        $this->connection->delete('busqueda_componente', [
            'nombre' => 'busqueda_admin'
        ]);
        $this->connection->delete('busqueda_componente', [
            'nombre' => 'busqueda_general'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'busqueda_admin'
        ]);
        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'busqueda_general'
        ]);

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.archivo_idarchivo = b.iddocumento and a.nombre <> 'LEIDO' and a.nombre not like 'ELIMINA_%' and b.estado <> 'ELIMINADO' and a.recibido = 1 and {*transfers*}"
        ], [
            'etiqueta_condicion' => 'busqueda_general_documentos'
        ]);

        $this->connection->delete('modulo', [
            'nombre' => 'busqueda_admin'
        ]);
        $this->connection->delete('modulo', [
            'nombre' => 'busqueda_general'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
