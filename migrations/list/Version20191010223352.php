<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010223352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Trámite","field":"{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}","align":"center"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_pendientes',
        ]);

        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_endistribucion',
        ]);
        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_finalizado',
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion IN (0,1) AND (c.ventanilla_radicacion=a.sede_origen OR c.ventanilla_radicacion=a.sede_destino) AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}"
        ], [
            'fk_busqueda_componente' => 300,
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion = 2 AND (c.ventanilla_radicacion=a.sede_origen OR c.ventanilla_radicacion=a.sede_destino) AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}"
        ], [
            'fk_busqueda_componente' => 301,
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion = 3 AND (c.ventanilla_radicacion=a.sede_origen OR c.ventanilla_radicacion=a.sede_destino) AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}"
        ], [
            'fk_busqueda_componente' => 302,
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
