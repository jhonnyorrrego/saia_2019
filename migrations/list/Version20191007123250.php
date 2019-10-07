<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007123250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=19"}]'
        ], [
            'nombre' => 'configuracion_boton'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=16"}]'
        ], [
            'nombre' => 'modulos'
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=84'
        ], [
            'nombre' => 'configuracion'
        ]);

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=30'
        ], [
            'nombre' => 'modulo'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
