<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190925150937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $value = <<<INFO
            [{"title":"N&uacute;mero","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center"},{"title":"Fecha de registro","field":"{*fecha*}","align":"center"},{"title":"No. Distribuci&oacute;n","field":"{*numero_distribucion*}","align":"center"},{"title":"Ventanilla","field":"{*ventanilla*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Diligencia","field":"{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}","align":"center"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Fecha de Radicaci&oacute;n","field":"{*fecha*}","align":"center"},{"title":"Asunto","field":"{*descripcion*}","align":"left"}]
        INFO;

        $this->connection->update('busqueda_componente', [
            'info' => $value
        ], [
            'nombre' => 'reporte_distribucion_general_pordistribuir'
        ]);

        $this->connection->update(
            'busqueda_componente',
            [
                'etiqueta' => 'Pendientes',
                'nombre' => 'reporte_distribucion_general_pendientes'
            ],
            [
                'nombre' => 'reporte_distribucion_general_pordistribuir'
            ]
        );

        $this->connection->update(
            'busqueda_componente',
            [
                'etiqueta' => 'En distribución',
            ],
            [
                'nombre' => 'reporte_distribucion_general_endistribucion'
            ]
        );

        $this->connection->update(
            'busqueda_componente',
            [
                'etiqueta' => 'Finalizado',
            ],
            [
                'nombre' => 'reporte_distribucion_general_finalizado'
            ]
        );

        $this->connection->delete(
            'busqueda_componente',
            [
                'nombre' => 'reporte_distribucion_general_sinrecogida'
            ]
        );

        $this->connection->delete(
            'busqueda_condicion',
            [
                'fk_busqueda_componente' => '303'
            ]
        );

        $this->connection->update(
            'modulo',
            [
                'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=109"}]',
            ],
            [
                'nombre' => 'reporte_distribucion_documentos'
            ]
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
