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
        return 'Organizando busqueda condicion, componente y cf_ventanilla para la funcionalidad entre sedes';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,a.estado_recogida,	b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre,d.idcf_ventanilla',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Trámite","field":"{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}","align":"center"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_pendientes',
        ]);

        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_endistribucion',
        ]);
        $this->connection->update('busqueda_componente', [
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre',
            'info' => '[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]'
        ], [
            'nombre' => 'reporte_distribucion_general_finalizado',
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => " a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion IN (0,1) AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_pendientes*}"
        ], [
            'fk_busqueda_componente' => 300,
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=2 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_endistribucion*}"
        ], [
            'fk_busqueda_componente' => 301,
        ]);
        $this->connection->update('busqueda_condicion', [
            'codigo_where' => "a.documento_iddocumento=b.iddocumento AND lower(b.estado)='aprobado' AND a.estado_distribucion=3 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla {*condicion_adicional_endistribucion*}"
        ], [
            'fk_busqueda_componente' => 302,
        ]);

        $ventanilla = $schema->getTable('cf_ventanilla');
        if ($ventanilla->hasColumn('iddependencia_cargo')) {
            $ventanilla->dropColumn('iddependencia_cargo');
        }

        if (!$ventanilla->hasColumn('idfuncionario')) {
            $ventanilla->addColumn('idfuncionario', 'integer', [
                'default' => 0
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
