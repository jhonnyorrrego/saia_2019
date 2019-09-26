<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190926162238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cambios en el reporte de distribución - pendientes';
    }

    public function up(Schema $schema): void
    {
        $value = <<<INFO
[{"title":"N. Registro","field":"{*ver_numero_registro@iddocumento,tipo_origen,fecha*}","align":"center","width":"180"},{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"110"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*descripcion*}","align":"left"},{"title":"Sede Origen","field":"{*ventanilla*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*ventanilla*}","align":"left"},{"title":"Trámite","field":"{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}","align":"center"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
INFO;

        $this->connection->update(
            'busqueda_componente',
            [
                'info' => $value,
            ],
            [
                'nombre' => 'reporte_distribucion_general_pendientes'
            ]
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
