<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191001123916 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Cambiando llaves para  origen y destino -> interno/externo';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 2
            ],
            [
                'idcampo_opciones' => '13'
            ]
        );

        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 2
            ],
            [
                'idcampo_opciones' => '14'
            ]
        );
        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 1
            ],
            [
                'idcampo_opciones' => '10'
            ]
        );
        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 1
            ],
            [
                'idcampo_opciones' => '7'
            ]
        );

        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 3
            ],
            [
                'idcampo_opciones' => '8'
            ]
        );

        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 1
            ],
            [
                'idcampo_opciones' => '5'
            ]
        );

        $this->connection->update(
            'campo_opciones',
            [
                'llave' => 0
            ],
            [
                'idcampo_opciones' => '6'
            ]
        );

        $campos_adicionales = <<<CAMPOS
        a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre as ventanilla
        CAMPOS;

        $this->connection->update(
            'busqueda_componente',
            [
                'campos_adicionales' => $campos_adicionales
            ],
            [
                'idbusqueda_componente' => '300'
            ]
        );

        $agrupado_por = <<<AGRUPADO
        a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre
        AGRUPADO;

        $this->connection->update(
            'busqueda_componente',
            [
                'agrupado_por' => $agrupado_por
            ],
            [
                'idbusqueda_componente' => '300'
            ]
        );

        $infoEnDistribucion = <<<INFO
        [{"title":"N. Registro","field":"{*ver_numero_registro@iddocumento,tipo_origen,fecha*}","align":"center","width":"180"},{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
        INFO;

        $this->connection->update(
            'busqueda_componente',
            [
                'info' => $infoEnDistribucion
            ],
            [
                'nombre' => 'reporte_distribucion_general_endistribucion'
            ]
        );

        $campos_adicionales = <<<CAMPOS
        a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre as ventanilla
        CAMPOS;

        $this->connection->update(
            'busqueda_componente',
            [
                'campos_adicionales' => $campos_adicionales
            ],
            [
                'idbusqueda_componente' => '301'
            ]
        );

        $agrupado_por = <<<AGRUPADO
        a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre
        AGRUPADO;

        $this->connection->update(
            'busqueda_componente',
            [
                'agrupado_por' => $agrupado_por
            ],
            [
                'idbusqueda_componente' => '301'
            ]
        );
        $infoFinalizdos = <<<INFO
        [{"title":"N. Registro","field":"{*ver_numero_registro@iddocumento,tipo_origen,fecha*}","align":"center","width":"180"},{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
        INFO;

        $this->connection->update(
            'busqueda_componente',
            [
                'info' => $infoFinalizdos
            ],
            [
                'nombre' => 'reporte_distribucion_general_finalizado'
            ]
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
