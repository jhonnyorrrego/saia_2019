<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004154700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Algunos cambios en los reportes de distribucion';
    }

    public function up(Schema $schema): void
    {
        $value = <<<INFO
[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Trámite","field":"{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}","align":"center"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
INFO;

        $this->connection->update('busqueda_componente', [
            'info' => $value,
            'orden' => 1,
            'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre as ventanilla',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre'
        ], [
            'nombre' => 'reporte_distribucion_general_pendientes'
        ]);

        $value = <<<INFO
[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
INFO;
        $this->connection->update('busqueda_componente', [
            'info' => $value,
            'orden' => 2,
            'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre as ventanilla',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,c.ventanilla_radicacion,d.nombre'
        ], [
            'nombre' => 'reporte_distribucion_general_endistribucion'
        ]);

        $value = <<<INFO
[{"title":"N. Item","field":"{*ver_documento_distribucion@iddocumento,tipo_origen*}","align":"center","width":"150"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center","width":"150"},{"title":"Asunto","field":"{*obtener_asunto@iddocumento*}","align":"left"},{"title":"Sede Origen","field":"{*obtener_sede_origen@iddistribucion*}","align":"left"},{"title":"Origen","field":"{*mostrar_origen_distribucion@tipo_origen,origen*}","align":"left"},{"title":"Destino","field":"{*mostrar_destino_distribucion@tipo_destino,destino*}","align":"left"},{"title":"Sede Destino","field":"{*obtener_sede_destino@iddistribucion*}","align":"left"},{"title":"Ruta","field":"{*mostrar_nombre_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Mensajero","field":"{*select_mensajeros_ruta_distribucion@iddistribucion*}","align":"left"},{"title":"Estado","field":"{*ver_estado_distribucion@estado_distribucion*}","align":"center"},{"title":"Planilla Asociada","field":"{*mostrar_planilla_diligencia_distribucion@iddistribucion*}","align":"center"}]
INFO;

        $this->connection->update('busqueda_componente', [
            'info' => $value,
            'orden' => 3,
            'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre'
        ], [
            'nombre' => 'reporte_distribucion_general_finalizado'
        ]);

        $value = <<<INFO
[{"title":"N. Item","field":"{*obtener_radicado@iddocumento*}","align":"center"},{"title":"Fecha","field":"{*fecha_ruta_distribuc*}","align":"center"},{"title":"Nombre de la ruta","field":"{*nombre_ruta*}","align":"center"},{"title":"Descripci&oacute;n de la ruta","field":"{*descripcion_ruta*}","align":"center"}]
INFO;

        $this->connection->update('busqueda_componente', [
            'info' => $value,
            'orden' => 4
        ], [
            'nombre' => 'reporte_ruta_distribucion'
        ]);

        $value = <<<INFO
[{"title":"N&uacute;mero","field":"{*ver_documento_planilla@iddocumento*}","align":"center"},{"title":"Fecha","field":"{*fecha_distribucion@fecha*}","align":"center"},{"title":"Ventanilla","field":"{*obtener_ventanilla@iddocumento*}","align":"center"},{"title":"Mensajero","field":"{*obtener_mensajero@mensajero*}","align":"center"},{"title":"Recorrido","field":"{*obtener_tipo_recorrido@iddocumento*}","align":"center"},{"title":"No. Distribuci&oacute;n","field":"{*obtener_distribucion@*}","align":"center"}]
INFO;

        $this->connection->update('busqueda_componente', [
            'url' => 'views/buzones/grilla.php?idbusqueda_componente=379',
            'info' => $value,
            'orden' => 5,
            'etiqueta' => 'Planillas de distribución',
            'busqueda_idbusqueda' => 109,
            'campos_adicionales' => 'a.documento_iddocumento as iddocumento,a.mensajero,b.fecha,b.numero',
            'tablas_adicionales' => 'ft_despacho_ingresados a,documento b',
            'ordenado_por' => 'a.idft_despacho_ingresados',
            'agrupado_por' => 'a.documento_iddocumento,a.idft_despacho_ingresados',
            'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=379',
            'acciones_seleccionados' => 'opciones_acciones_distribucion'
        ], [
            'nombre' => 'reporte_planilla_distribucion'
        ]);

        $this->connection->insert('funciones_formato', [
            'idfunciones_formato' => '1600',
            'nombre' => '{*post_generar_planilla*}',
            'nombre_funcion' => 'post_generar_planilla',
            'etiqueta' => 'post_generar_planilla',
            'ruta' => 'funciones.php',
            'formato' => ''
        ]);

        $this->connection->insert('funciones_formato_accion', [
            'idfunciones_formato' => '1600',
            'accion_idaccion' => '3',
            'formato_idformato' => '353',
            'momento' => 'POSTERIOR',
            'estado' => '1',
            'orden' => '4'
        ]);

        $this->connection->update('formato', [
            'etiqueta' => 'Radicación de facturas',
            'orden' => 1
        ], [
            'nombre' => 'radicacion_facturas'
        ]);

        $this->connection->update('formato', [
            'orden' => 3
        ], [
            'nombre' => 'radicacion_entrada'
        ]);

        $this->connection->update('formato', [
            'etiqueta' => 'Radicación facturas de obras',
            'orden' => 2
        ], [
            'nombre' => 'facturas_obras'
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('funciones_formato', [
            'nombre' => '{*post_generar_planilla*}'
        ]);

        $this->connection->delete('funciones_formato_accion', [
            'idfunciones_formato' => '1600',
            'formato_idformato' => '353'
        ]);
    }
}
