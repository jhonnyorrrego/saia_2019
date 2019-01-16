<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180118194327 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        // Por defecto notnull=true
        if ($schema->hasTable("expediente")) {
            $table = $schema->getTable('expediente');
            $table->addColumn("indice_uno", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("indice_dos", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("indice_tres", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("dependencia_iddependencia", "integer");
        }
        if ($schema->hasTable("caja")) {
            $table = $schema->getTable('caja');
            $table->addColumn("modulo", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("nivel", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("dependencia_iddependencia", "integer");
        }
        if (!$schema->hasTable("cf_material")) {
            $table = $schema->createTable("cf_material");
            $table->addColumn("idcf_material", "integer", [
                "length" => 11,
                'autoincrement' => true
            ]);
            $table->addColumn("nombre", "string", [
                "length" => 255
            ]);
            $table->addColumn("valor", "string", [
                "length" => 255
            ]);
            $table->addColumn("cod_padre", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("descripcion", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("tipo", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("categoria", "string", [
                "length" => 255,
                "notnull" => false
            ]);
            $table->addColumn("estado", "integer", [
                "length" => 11
            ]);
            $table->setPrimaryKey([
                "idcf_material"
            ]);
        }
        // this up() migration is auto-generated, please modify it to your needs
    }

    public function postUp(Schema $schema): void {
        $conn = $this->connection;
        
        $conn->beginTransaction();
        
        $datos = [
            'cantidad_registros' => '100',
            'etiqueta' => 'Inventario Documental',
            'campos' => 'a.nombre,a.codigo_numero,a.nombre_serie,a.fecha_extrema_i,a.fecha_extrema_f,a.indice_uno,a.indice_dos,a.indice_tres,a.no_folios,a.no_unidad_conservacion,a.soporte,a.notas_transf'
        ];
        $ident = [
            'nombre' => 'reporte_expediente_grid'
        ]; // idbusqueda = 115
        
        $resp = $conn->update('busqueda', $datos, $ident);
        
        $datos = [
            'etiqueta' => 'Inventario Documental',
            'info' => 'SELECCIONE|{*check_expedientes@idexpediente*}|center|80|-|CODIGO|{*codigo_numero*}|left|80|-|NOMBRE DEL EXPEDIENTE|{*direcciona_nombre@idexpediente,nombre*}|left|200|-|SERIE|{*nombre_serie*}|left|200|-|FECHA INICIAL|{*fecha_extrema_i*}|center|80|-|FECHA FINAL|{*fecha_extrema_f*}|center|80|-|INDICE 1|{*indice_uno*}|left|130|-|INDICE 2|{*indice_dos*}|left|130|-|INDICE 3|{*indice_tres*}|left|130|-|FOLIOS|{*no_folios*}|center|80|-|UNID CONSERV|{*no_unidad_conservacion*}|left|80|SOPORTE 3|{*soporte*}|left|80|-|NOTAS|{*notas_transf*}|left|200|-|Retenci&oacute;n|{*fecha_reten@idexpediente*}|left|200|SELECCIONE|{*check_expedientes@idexpediente*}|center|80|-|CODIGO|{*codigo_numero*}|left|80|-|NOMBRE DEL EXPEDIENTE|{*direcciona_nombre@idexpediente,nombre*}|left|200|-|SERIE|{*nombre_serie*}|left|200|-|FECHA INICIAL|{*fecha_extrema_i*}|center|80|-|FECHA FINAL|{*fecha_extrema_f*}|center|80|-|INDICE 1|{*indice_uno*}|left|130|-|INDICE 2|{*indice_dos*}|left|130|-|INDICE 3|{*indice_tres*}|left|130|-|FOLIOS|{*no_folios*}|center|80|-|UNID CONSERV|{*no_unidad_conservacion*}|left|80|SOPORTE 3|{*soporte*}|left|80|-|NOTAS|{*notas_transf*}|left|200|-|Retenci&oacute;n|{*fecha_reten@idexpediente*}|left|200|',
            'ordenado_por' => 'a.fecha',
            'acciones_seleccionados' => 'acciones_expediente',
            'agrupado_por' => 'a.nombre,a.codigo_numero,a.nombre_serie,a.fecha_extrema_i,a.fecha_extrema_f,a.indice_uno,a.indice_dos,a.indice_tres,a.no_folios,a.no_unidad_conservacion,a.soporte,a.notas_transf'
        ];
        $ident = [
            'nombre' => 'reporte_expediente_grid_exp'
        ]; // idbusqueda_componente = 320
        $resp = $conn->update('busqueda_componente', $datos, $ident);
        
        $datos = [
            'codigo_where' => '1=1 {*filtro_cod_arbol*}{*tipo_expediente*} AND {*expedientes_asignados*} AND a.agrupador <> 1'
        ];
        $ident = [
            'etiqueta_condicion' => 'condicion_reporte_expediente_grid'
        ]; // idbusqueda_condicion = 245
        $resp = $conn->update('busqueda_condicion', $datos, $ident);
        
        $datos = [
            'info' => '<div title="Cajas" data-load=\'{"kConnector":"iframe","url":"../pantallas/busquedas/consulta_busqueda_caja.php?idbusqueda_componente=323","kTitle":"Cajas","kWidth":"320px"}\' class="items navigable"><div class="head"></div><div class="label">Cajas</div><div class="tail"></div></div>'
        ];
        $ident = [
            'nombre' => 'cajas'
        ]; // idbusqueda_componente = 160;
        $resp = $conn->update('busqueda_componente', $datos, $ident);
        
        $datos = [
            'etiqueta' => 'Indice de Expediente'
        ];
        $ident = [
            'nombre' => 'reporte_docs_expediente_grid'
        ]; // idbusqueda = 116;
        $resp = $conn->update('busqueda', $datos, $ident);
        
        $datos = [
            'direccion' => 'asc',
            'ordenado_por' => 'a.fecha',
            'info' => 'expediente_idexpediente|{*expediente_idexpediente*}|left|200|-|documento_iddocumento|{*documento_iddocumento*}|left|200|-|fecha|{*fecha*}|left'
        ];
        $ident = [
            'nombre' => 'reporte_docs_expediente_grid_exp'
        ]; // idbusqueda_componente = 321;
        $resp = $conn->update('busqueda_componente', $datos, $ident);
        
        $datos = [
            'campos_adicionales' => 'b.documento_iddocumento, b.idft_solicitud_prestamo, b.serie_idserie, b.estado_documento, b.anexos, b.documento_archivo, b.observaciones, b.nombre_solicita, b.fecha, b.fecha_prestamo_rep, b.fecha_devolucion_rep, b.transferencia_presta,c.idft_item_prestamo_exp, c.fecha_prestamo, c.fecha_devolucion, c.estado_prestamo, c.funcionario_prestamo, c.observacion_prestamo,c.fecha_devolucion,c.observacion_devolver,c.funcionario_devoluci,c.fk_expediente'
        ];
        $ident = [
            'nombre' => 'reporte_solicitud_prestamo'
        ]; // idbusqueda_componente` = 203;
        $resp = $conn->update('busqueda_componente', $datos, $ident);
        
        $result = $conn->fetchAll("select idbusqueda from busqueda where nombre = :nombre", [
            'nombre' => 'cajas'
        ]);
        
        $idbusq = null;
        if (! empty($result)) {
            $idbusq = $result[0]["idbusqueda"];
            
            $componente1 = [
                'busqueda_idbusqueda' => $idbusq, // busqueda_idbusqueda = 48
                'tipo' => 3,
                'conector' => 2,
                'url' => 'pantallas/busquedas/consulta_busqueda_caja.php',
                'etiqueta' => 'Cajas',
                'nombre' => 'cajas1',
                'orden' => 1,
                'info' => '<div id=\"resultado_pantalla_{*idcaja*}\" class=\"well\"><div class=\"btn btn-mini enlace_caja pull-right\" idregistro=\"{*idcaja*}\" title=\"{*no_consecutivo*}\"><i class=\"icon-info-sign\"></i></div>{*enlaces_adicionales_caja@idcaja,no_consecutivo*}<div class=\"btn btn-mini enlace_caja tooltip_saia pull-right\" idregistro=\"{*idcaja*}\" title=\"Asignar {*no_consecutivo*}\" enlace=\"pantallas/caja/asignar_caja.php?idcaja={*idcaja*}\"><i class=\"icon-lock\"></i></div><i class=\' icon-folder-open pull-left\'></i>{*enlace_caja@idcaja,no_consecutivo*}<br/><div class=\'descripcion_documento\'>{*obtener_descripcion_caja@fondo,seccion,subseccion,codigo*}</div></div>',
                'estado' => 2,
                'ancho' => 320,
                'cargar' => 2,
                'ordenado_por' => 'a.idcaja',
                'direccion' => 'desc',
                'busqueda_avanzada' => 'pantallas/caja/buscar_caja.php?idbusqueda_componente=161',
                'menu_busqueda_superior' => 'barra_superior_busqueda'
            ];
            $idcmp1 = $this->guardar_componente($componente1);
        }
        $conn->executeQuery('CREATE OR REPLACE VIEW vexpediente_serie AS select a.propietario AS propietario,c.nombre AS nombre_serie,a.fecha AS fecha,a.nombre AS nombre,a.codigo_numero AS codigo_numero,a.descripcion AS descripcion,a.cod_arbol AS cod_arbol,a.cod_padre AS cod_padre,a.estado_archivo AS estado_archivo,a.fk_idcaja AS fk_idcaja,a.estado_cierre AS estado_cierre,a.idexpediente AS idexpediente,b.entidad_identidad AS identidad_exp,b.llave_entidad AS llave_exp,d.entidad_identidad AS identidad_ser,d.llave_entidad AS llave_ser,d.estado AS estado_entidad_serie,a.prox_estado_archivo AS prox_estado_archivo,a.fecha_extrema_i AS fecha_extrema_i,a.fecha_extrema_f AS fecha_extrema_f,a.no_unidad_conservacion AS no_unidad_conservacion,a.no_folios AS no_folios,a.no_carpeta AS no_carpeta,a.soporte AS soporte,a.notas_transf AS notas_transf,a.tomo_no AS tomo_no,a.agrupador AS agrupador,a.indice_uno AS indice_uno,a.indice_dos AS indice_dos,a.indice_tres AS indice_tres from (((expediente a left join entidad_expediente b on((a.idexpediente = b.expediente_idexpediente))) left join serie c on((a.serie_idserie = c.idserie))) left join entidad_serie d on((c.idserie = d.serie_idserie)))');
        $conn->commit();
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

    private function guardar_componente($datos) {
        if (empty($datos)) {
            return false;
        }
        
        $conn = $this->connection;
        
        $result = $conn->fetchAll("select idbusqueda_componente from busqueda_componente where nombre = :nombre", [
            'nombre' => $datos["nombre"]
        ]);
        
        $idbusq = null;
        if (! empty($result)) {
            $idbusq = $result[0]["idbusqueda_componente"];
        } else {
            $resp = $conn->insert('busqueda_componente', $datos);
            
            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la creacion de la busqueda_componente");
            }
            $idbusq = $conn->lastInsertId();
        }
        return $idbusq;
    }
}
