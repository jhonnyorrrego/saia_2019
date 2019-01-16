<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190116211624 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=101"}]'], ["idmodulo" => 5]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=11"}]'], ["idmodulo" => 13]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=1"}]'], ["idmodulo" => 15]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=21"}]'], ["idmodulo" => 35]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=22"}]'], ["idmodulo" => 142]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=56"}]'], ["idmodulo" => 216]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=16"}]'], ["idmodulo" => 665]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=20"}]'], ["idmodulo" => 685]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=17"}]'], ["idmodulo" => 865]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=23"}]'], ["idmodulo" => 1013]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=27"}]'], ["idmodulo" => 1040]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=26"}]'], ["idmodulo" => 1060]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=44"}]'], ["idmodulo" => 1205]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=45"}]'], ["idmodulo" => 1211]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=7"}]'], ["idmodulo" => 1235]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=54"}]'], ["idmodulo" => 1320]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=59"}]'], ["idmodulo" => 1388]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=98"}]'], ["idmodulo" => 1609]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=100"}]'], ["idmodulo" => 1611]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=105"}]'], ["idmodulo" => 1639]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=106"}]'], ["idmodulo" => 1640]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=115"}]'], ["idmodulo" => 1660]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=120"}]'], ["idmodulo" => 1670]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=128"}]'], ["idmodulo" => 1906]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=129"}]'], ["idmodulo" => 1917]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=25"}]'], ["idmodulo" => 1932]);
        $this->connection->update("modulo", ["enlace" => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "pantallas/busquedas/componentes_busqueda.php?idbusqueda=131"}]'], ["idmodulo" => 1939]);
        $this->connection->update("busqueda_componente", ["url" => 'pantallas/busquedas/consulta_busqueda_tabla.php?idbusqueda_componente=94'], ["idbusqueda_componente" => 94]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
