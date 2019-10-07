<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004214147 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cambiando algunos listados viejos al nuevo diseno y recuperando enlaces';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=7"}]'
        ], [
            'nombre' => 'pendientes'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=133"}]'
        ], [
            'nombre' => 'configuracion_radicacion'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=54"}]'
        ], [
            'nombre' => 'reporte_reservar_documentos'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
