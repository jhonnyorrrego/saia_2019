<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190520211431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $conn = $this->connection;
        if (!$schema->hasTable("dt_recep_despacho")) {
            $table = $schema->createTable("dt_recep_despacho");
            $table->addColumn("iddt_recep_despacho", "integer", [
                "length" => 11,
                'autoincrement' => true
            ]);
            $table->addColumn("iddistribucion", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->addColumn("ft_item_despacho_ingres", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->addColumn("recepcion", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->addColumn("fecha", "datetime", [
                "notnull" => false
            ]);
            $table->addColumn("idfuncionario", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->setPrimaryKey([
                "iddt_recep_despacho"
            ]);
        }
        if (!$schema->hasTable("dt_ventanilla_doc")) {
            $table = $schema->createTable("dt_ventanilla_doc");
            $table->addColumn("iddt_ventanilla_doc", "integer", [
                "length" => 11,
                'autoincrement' => true
            ]);
            $table->addColumn("documento_iddocumento", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->addColumn("idcf_ventanilla", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->addColumn("fecha", "datetime", [
                "notnull" => false
            ]);
            $table->addColumn("idfuncionario", "integer", [
                "length" => 11, "notnull" => false
            ]);
            $table->setPrimaryKey([
                "iddt_ventanilla_doc"
            ]);
        }
        $busqueda = [
            'idbusqueda' => '139', 'nombre' => 'reporte_planilla_disitrbucion', 'etiqueta' => 'Planillas de distribucion', 'estado' => '1', 'campos' => 'a.iddocumento,a.idft_item_despacho_ingres,a.numero,a.ventanilla,a.tipo_mensajero,a.tipo_origen,a.numero_distribucion,case when recepcion=1 then "si" else "no" end as recepcion', 'llave' => 'a.iddocumento', 'tablas' => 'vplanilla_distribucion a', 'ruta_libreria' => 'distribucion/funciones_distribucion.php', 'ruta_libreria_pantalla' => 'distribucion/funciones_distribucion_js.php', 'cantidad_registros' => '20', 'ruta_visualizacion' => 'pantallas/busquedas/consulta_busqueda_tabla.php', 'tipo_busqueda' => '2'
        ];

        $conn->insert('busqueda', $busqueda);
        $busqueda = [
            'tablas' => 'distribucion a,documento b,funcionario c, cf_ventanilla d, dt_ventanilla_doc e',
            'campos' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla'
        ];
        $condicion = ['idbusqueda' => '109'];


        $conn->update("busqueda", $busqueda, $condicion);

        $busqueda_componente = [
            'idbusqueda_componente' => '379', 'busqueda_idbusqueda' => '139', 'tipo' => '3', 'conector' => '2', 'url' => 'pantallas/busquedas/consulta_busqueda_tabla.php', 'etiqueta' => '3.1 Planilla distribucion', 'nombre' => 'reporte_planilla_distribucion', 'orden' => '3', 'info' => 'N&uacute;mero|{*ver_documento_planilla@iddocumento,numero*}|center|210|-|ventanilla|{*ventanilla*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Recepcion|{*recepcion*}|center', 'exportar' => NULL, 'exportar_encabezado' => NULL, 'encabezado_componente' => NULL, 'estado' => '1', 'ancho' => '600', 'cargar' => '1', 'campos_adicionales' => NULL, 'tablas_adicionales' => NULL, 'ordenado_por' => 'a.idft_item_despacho_ingres', 'direccion' => 'DESC', 'agrupado_por' => NULL, 'busqueda_avanzada' => 'distribucion/busqueda_distribucion.php?idbusqueda_componente=301', 'acciones_seleccionados' => 'opciones_acciones_distribucion', 'modulo_idmodulo' => NULL, 'menu_busqueda_superior' => NULL, 'enlace_adicionar' => NULL, 'encabezado_grillas' => NULL, 'llave' => 'a.idft_item_despacho_ingres'
        ];

        $conn->insert('busqueda_componente', $busqueda_componente);

        $busqueda_componente = [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre'

        ];
        $condicion = ['idbusqueda_componente' => '303'];

        $conn->update("busqueda_componente", $busqueda_componente, $condicion);

        $busqueda_componente = [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre'

        ];
        $condicion = ['idbusqueda_componente' => '302'];

        $conn->update("busqueda_componente", $busqueda_componente, $condicion);

        $busqueda_componente = [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre'

        ];
        $condicion = ['idbusqueda_componente' => '301'];

        $conn->update("busqueda_componente", $busqueda_componente, $condicion);

        $busqueda_componente = [
            'info' => 'N&uacute;mero|{*ver_documento_distribucion@iddocumento,tipo_origen*}|center|210|-|Fecha de registro|{*fecha*}|center|210|-|No. Distribuci&oacute;n|{*numero_distribucion*}|center|100|-|Ventanilla|{*ventanilla*}|left|100|-|Estado|{*ver_estado_distribucion@estado_distribucion*}|center|-|Diligencia|{*mostrar_diligencia_distribucion@tipo_origen,estado_recogida*}|center|80|-|Ruta|{*mostrar_nombre_ruta_distribucion@tipo_origen,estado_recogida,ruta_origen,ruta_destino,tipo_destino,iddistribucion*}|left|-|Mensajero|{*select_mensajeros_ruta_distribucion@iddistribucion*}|left|-|Planilla Asociada|{*mostrar_planilla_diligencia_distribucion@iddistribucion*}|center|-|Origen|{*mostrar_origen_distribucion@tipo_origen,origen*}|left|250|-|Destino|{*mostrar_destino_distribucion@tipo_destino,destino*}|left|250|-|Fecha de Radicaci&oacute;n|{*fecha*}|center|-|Asunto|{*descripcion*}|left',
            'agrupado_por' => 'a.iddistribucion,a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,	a.estado_distribucion,	a.estado_recogida,	a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre'

        ];
        $condicion = ['idbusqueda_componente' => '300'];

        $conn->update("busqueda_componente", $busqueda_componente, $condicion);

        $campos_formato = [ 'formato_idformato' => '353', 'nombre' => 'ventanilla', 'etiqueta' => 'VENTANILLA', 'tipo_dato' => 'varchar', 'longitud' => '255', 'obligatoriedad' => '1', 'valor' => '1,Array', 'acciones' => 'a,e,b', 'ayuda' => '', 'predeterminado' => '', 'banderas' => '', 'etiqueta_html' => 'select', 'orden' => '14', 'mascara' => '', 'adicionales' => '', 'autoguardado' => '1', 'fila_visible' => '1', 'placeholder' => 'seleccionar..', 'longitud_vis' => NULL, 'opciones' => '[{"llave":1,"item":"Sin ventanilla"}]', 'estilo' => NULL];

        $conn->insert('campos_formato', $campos_formato);

        $campos_formato = [ 'formato_idformato' => '3', 'nombre' => 'distribuid_entre_sedes', 'etiqueta' => 'DISTRIBUIDO ENTRE SEDES', 'tipo_dato' => 'varchar', 'longitud' => '255', 'obligatoriedad' => '1', 'valor' => '1,Array;2,Array', 'acciones' => 'a,e,b', 'ayuda' => '', 'predeterminado' => '', 'banderas' => '', 'etiqueta_html' => 'radio', 'orden' => '8', 'mascara' => '', 'adicionales' => '', 'autoguardado' => '1', 'fila_visible' => '1', 'placeholder' => 'Campo texto', 'longitud_vis' => NULL, 'opciones' => '[{"llave":"1","item":"Si"},{"llave":"2","item":"No"}]', 'estilo' => NULL];
        $conn->insert('campos_formato', $campos_formato);

        $busqueda_condicion = ['idbusqueda_condicion' => '298', 'busqueda_idbusqueda' => NULL, 'fk_busqueda_componente' => '379', 'codigo_where' => '{*filtro_planilla_distribucion*}', 'etiqueta_condicion' => 'reporte_planilla_disitrbucion'];
        $conn->insert('busqueda_condicion', $busqueda_condicion);

        $busqueda_condicion = [
            'codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=0 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}'
        ];
        $condicion = ['idbusqueda_condicion' => '238'];
        $conn->update("busqueda_condicion", $busqueda_condicion, $condicion);

        $busqueda_condicion = [
            'codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=3 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}'
        ];
        $condicion = ['idbusqueda_condicion' => '237'];
        $conn->update("busqueda_condicion", $busqueda_condicion, $condicion);

        $busqueda_condicion = [
            'codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=2 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}'
        ];
        $condicion = ['idbusqueda_condicion' => '236'];
        $conn->update("busqueda_condicion", $busqueda_condicion, $condicion);

        $busqueda_condicion = [
            'codigo_where' => 'a.documento_iddocumento=b.iddocumento AND lower(b.estado)=\'aprobado\' AND a.estado_distribucion=1 AND b.ejecutor=c.funcionario_codigo AND c.ventanilla_radicacion=d.idcf_ventanilla AND b.ventanilla_radicacion=e.idcf_ventanilla {*condicion_adicional_distribucion*}'
        ];
        $condicion = ['idbusqueda_condicion' => '235'];
        $conn->update("busqueda_condicion", $busqueda_condicion, $condicion);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
