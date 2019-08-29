<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190819211227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->connection->delete('modulo', [
            'nombre' => 'reporte_trd_gd'
        ]);

        $this->connection->delete('modulo', [
            'nombre' => 'serie'
        ]);


        $this->connection->delete('busqueda', [
            'idbusqueda' => 98
        ]);

        $this->connection->delete('busqueda_componente', [
            'busqueda_idbusqueda' => 98
        ]);

        $this->connection->executeQuery('DELETE FROM busqueda_condicion WHERE fk_busqueda_componente IN (270,271,272,287,364)');


        $this->connection->update('modulo', [
            'imagen' => 'fa fa-list-alt',
            'cod_padre' => 1944
        ], [
            'nombre' => 'trd'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
