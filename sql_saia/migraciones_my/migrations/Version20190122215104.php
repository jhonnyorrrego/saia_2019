<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190122215104 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualizacion del proceso de expedientes, se elimina tabla y se generan nuevamente';
    }

    public function preUp(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        if ($schema->hasTable("serie")) {
            $schema->dropTable("serie");
        }

        if ($schema->hasTable("entidad_serie")) {
            $schema->dropTable("entidad_serie");
        }

        if ($schema->hasTable("permiso_serie")) {
            $schema->dropTable("permiso_serie");
        }

        if ($schema->hasTable("expediente")) {
            $schema->dropTable("expediente");
        }

        if ($schema->hasTable("entidad_expediente")) {
            $schema->dropTable("entidad_expediente");
        }

        if ($schema->hasTable("permiso_expediente")) {
            $schema->dropTable("permiso_expediente");
        }

        if ($schema->hasTable("expediente_doc")) {
            $schema->dropTable("expediente_doc");
        }

        if ($schema->hasTable("expediente_eli")) {
            $schema->dropTable("expediente_eli");
        }
        
    }

    public function up(Schema $schema) : void
    {

        /*if ($schema->hasTable("serie")) {
            $schema->dropTable("serie");
        }

        if ($schema->hasTable("entidad_serie")) {
            $schema->dropTable("entidad_serie");
        }

        if ($schema->hasTable("permiso_serie")) {
            $schema->dropTable("permiso_serie");
        }

        if ($schema->hasTable("expediente")) {
            $schema->dropTable("expediente");
        }

        if ($schema->hasTable("entidad_expediente")) {
            $schema->dropTable("entidad_expediente");
        }

        if ($schema->hasTable("permiso_expediente")) {
            $schema->dropTable("permiso_expediente");
        }

        if ($schema->hasTable("expediente_doc")) {
            $schema->dropTable("expediente_doc");
        }

        if ($schema->hasTable("expediente_eli")) {
            $schema->dropTable("expediente_eli");
        }*/
        


        $tabla = $schema->createTable("serie");
        $tabla->addColumn("idserie", "integer", ["autoincrement" => true]);
        $tabla->addColumn("nombre", "string", ["length" => 255]);
        $tabla->addColumn("cod_padre", "integer", ["notnull" => false]);
        $tabla->addColumn("dias_entrega", "integer", ["default" => 8]);
        $tabla->addColumn("codigo", "string", ["length" => 20, "notnull" => false]);
        $tabla->addColumn("retencion_gestion", "integer", ["default" => 3]);
        $tabla->addColumn("retencion_central", "integer", ["default" => 5]);
        $tabla->addColumn("conservacion", "integer", ["length" => 1, "notnull" => false, "comment" => "1,Conservacion;0,Eliminacion"]);
        $tabla->addColumn("digitalizacion", "integer", ["length" => 1, "notnull" => false, "comment" => "1,Si;0,No"]);
        $tabla->addColumn("seleccion", "integer", ["length" => 1, "notnull" => false, "comment" => "1,Si;0,No"]);
        $tabla->addColumn("otro", "string", ["length" => 255, "notnull" => false]);
        $tabla->addColumn("procedimiento", "text", ["notnull" => false]);
        $tabla->addColumn("copia", "integer", ["length" => 1, "default" => 0, "comment" => "1,Si;0,No"]);
        $tabla->addColumn("tipo", "integer", ["length" => 1, "default" => 0, "comment" => "1,Serie;2,Subserie;3,Tipo Documental"]);
        $tabla->addColumn("estado", "integer", ["length" => 1, "default" => 1, "comment" => "1,Activo;0,Inactivo"]);
        $tabla->addColumn("categoria", "integer", ["length" => 1, "default" => 2, "comment" => "2,Produccion Documental;3,Otras Categorias"]);
        $tabla->addColumn("cod_arbol", "string", ["length" => 255, "notnull" => false]);
        $tabla->setPrimaryKey(["idserie"]);


        $tabla2 = $schema->createTable("entidad_serie");
        $tabla2->addColumn("identidad_serie", "integer", ["autoincrement" => true]);
        $tabla2->addColumn("fk_serie", "integer", ["default" => 0]);
        $tabla2->addColumn("fk_dependencia", "integer", ["default" => 0]);
        $tabla2->addColumn("estado", "integer", ["length" => 1, "default" => 1, "comment" => "1,Activo;0,Eliminado"]);
        $tabla2->addColumn("fecha_creacion", "datetime", ["notnull" => false]);
        $tabla2->addColumn("fecha_eliminacion", "datetime", ["notnull" => false]);
        $tabla2->setPrimaryKey(["identidad_serie"]);


        $tabla3 = $schema->createTable("expediente");
        $tabla3->addColumn("idexpediente", "integer", ["autoincrement" => true]);
        $tabla3->addColumn("nombre", "string", ["length" => 255]);
        $tabla3->addColumn("fecha", "datetime");
        $tabla3->addColumn("descripcion", "text", ["notnull" => false]);
        $tabla3->addColumn("cod_padre", "integer", ["default" => 0, "notnull" => false]);
        $tabla3->addColumn("propietario", "integer", ["comment" => "fk_funcionario"]);
        $tabla3->addColumn("responsable", "integer", ["comment" => "fk_funcionario"]);
        $tabla3->addColumn("cod_arbol", "text");
        $tabla3->addColumn("codigo_numero", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("fondo", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("proceso", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("fecha_extrema_i", "date", ["notnull" => false]);
        $tabla3->addColumn("fecha_extrema_f", "date", ["notnull" => false]);
        $tabla3->addColumn("no_unidad_conservacion", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("no_folios", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("no_carpeta", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("soporte", "integer", ["notnull" => false]);
        $tabla3->addColumn("frecuencia_consulta", "integer", ["notnull" => false]);
        $tabla3->addColumn("ruta_qr", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("estado_archivo", "integer", ["length" => 1, "default" => 1, "comment" => "1,Gestion;2,Central;3,Historico"]);
        $tabla3->addColumn("estado_cierre", "integer", ["length" => 1, "default" => 1, "comment" => "1,Abierto;2,Cerrado"]);
        $tabla3->addColumn("fecha_cierre", "datetime", ["notnull" => false]);
        $tabla3->addColumn("funcionario_cierre", "integer", ["notnull" => false, "comment" => "fk_funcionario"]);
        $tabla3->addColumn("notas_transf", "text", ["notnull" => false]);
        $tabla3->addColumn("tomo_padre", "integer", ["notnull" => false, "comment" => "fk_expediente"]);
        $tabla3->addColumn("tomo_no", "integer", ["default" => 1]);
        $tabla3->addColumn("agrupador", "integer", ["length" => 1, "default" => 0, "comment" => "0,Expediente;1,Dependencia;2,Serie;3,Separador"]);
        $tabla3->addColumn("indice_uno", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("indice_dos", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("indice_tres", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("consecutivo_inicial", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("consecutivo_final", "string", ["length" => 255, "notnull" => false]);
        $tabla3->addColumn("nucleo", "integer", ["length" => 1, "default" => 1]);
        $tabla3->addColumn("estado", "integer", ["length" => 1, "default" => 1]);
        $tabla3->addColumn("fk_expediente_eli", "integer", ["notnull" => false]);
        $tabla3->addColumn("fk_caja", "integer", ["notnull" => false]);
        $tabla3->addColumn("fk_serie", "integer");
        $tabla3->addColumn("fk_dependencia", "integer");
        $tabla3->addColumn("fk_entidad_serie", "integer");
        $tabla3->setPrimaryKey(["idexpediente"]);


        $tabla4 = $schema->createTable("permiso_serie");
        $tabla4->addColumn("idpermiso_serie", "integer", ["autoincrement" => true]);
        $tabla4->addColumn("fk_entidad", "integer");
        $tabla4->addColumn("llave_entidad", "integer");
        $tabla4->addColumn("fk_entidad_serie", "integer");
        $tabla4->addColumn("permiso", "string", ["length" => 10, "comment" => "l:Lectura;a:Adicion"]);
        $tabla4->setPrimaryKey(["idpermiso_serie"]);


        $tabla5 = $schema->createTable("permiso_expediente");
        $tabla5->addColumn("idpermiso_expediente", "integer", ["autoincrement" => true]);
        $tabla5->addColumn("fk_funcionario", "integer");
        $tabla5->addColumn("fk_entidad", "integer");
        $tabla5->addColumn("llave_entidad", "integer");
        $tabla5->addColumn("fk_entidad_serie", "integer");
        $tabla5->addColumn("tipo_permiso", "integer", ["comment" => "1:Serie;2:Candado;"]);
        $tabla5->addColumn("tipo_funcionario", "integer", ["default" => 0, "comment" => "1:Creador;2:Responsable;0,Otros"]);
        $tabla5->addColumn("permiso", "string", ["length" => 10, "comment" => "l:Lectura;a:Adicion;e;Editar;d;Eliminar;c:Compartir"]);
        $tabla5->addColumn("fk_expediente", "integer");
        $tabla5->setPrimaryKey(["idpermiso_expediente"]);


        $tabla6 = $schema->createTable("entidad_expediente");
        $tabla6->addColumn("identidad_expediente", "integer", ["autoincrement" => true]);
        $tabla6->addColumn("fk_funcionario", "integer");
        $tabla6->addColumn("fk_expediente", "integer");
        $tabla6->addColumn("permiso", "string", ["length" => 10, "comment" => "d:Eliminar;e:Editarc:Compartir"]);
        $tabla6->addColumn("tipo_funcionario", "integer", ["default" => 0, "comment" => "1:Creador;2:Responsable;0,Otros"]);
        $tabla6->addColumn("fecha", "datetime", ["notnull" => false]);
        $tabla6->setPrimaryKey(["identidad_expediente"]);


        $tabla7 = $schema->createTable("expediente_doc");
        $tabla7->addColumn("idexpediente_doc", "integer", ["autoincrement" => true]);
        $tabla7->addColumn("fk_expediente", "integer");
        $tabla7->addColumn("fk_documento", "integer");
        $tabla7->addColumn("fk_funcionario", "integer");
        $tabla7->addColumn("fecha", "datetime");
        $tabla7->setPrimaryKey(["idexpediente_doc"]);

        $tabla8 = $schema->createTable("expediente_eli");
        $tabla8->addColumn("idexpediente_eli", "integer", ["autoincrement" => true]);
        $tabla8->addColumn("fk_expediente", "integer");
        $tabla8->addColumn("fk_funcionario", "integer");
        $tabla8->addColumn("fecha_eliminacion", "datetime");
        $tabla8->addColumn("fecha_restauracion", "datetime", ["notnull" => false]);
        $tabla8->setPrimaryKey(["idexpediente_eli"]);

        $this->addSql("DELETE FROM busqueda WHERE idbusqueda=37");
        $this->addSql("INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades, elastic) VALUES (37, 'expediente', ' Mis expedientes', 1, 200, NULL, NULL, 'vpermiso_expediente v', 'pantallas/expediente/librerias.php', 'pantallas/expediente/librerias_js.php', 20, 500, 'pantallas/busquedas/consulta_busqueda_expediente.php', 1, NULL, 0)");
        
        $this->addSql("DELETE FROM busqueda_componente WHERE idbusqueda_componente=110");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (110, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda_expediente.php', 'Archivo de Gesti&oacute;n', 'expediente', 1, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_expediente@idexpediente*}</div>', NULL, NULL, NULL, 2, 320, 2, NULL, NULL, 'v.nombre', 'asc', 'v.idexpediente', 'pantallas/expediente/buscar_expediente.php', 'adicionar_expediente,compartir_expediente,transferencia_documental', 1644, 'barra_superior_busqueda', NULL, NULL, 'v.idexpediente')");
        
        $this->addSql("DELETE FROM busqueda_condicion WHERE fk_busqueda_componente = 110");
        $this->addSql("INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (81, NULL, 110, 'v.estado_archivo=1 {*conditions*}', 'Gestion')");

        $this->addSql("DELETE FROM busqueda_componente WHERE idbusqueda_componente=111");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (111, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda.php', 'Expediente Documento', 'expediente_documento', 1, '<div id=\"resultado_pantalla_{*iddocumento*}\" class=\"well\">{*numero*}</div>', NULL, NULL, NULL, 0, 320, 2, 'd.numero', 'documento d,expediente_doc ed', 'd.fecha', 'desc', 'd.iddocumento,d.numero', NULL, NULL, 0, NULL, NULL, NULL, 'd.iddocumento')");

        $this->addSql("DELETE FROM busqueda_condicion WHERE fk_busqueda_componente = 111");
        $this->addSql("INSERT INTO busqueda_condicion (idbusqueda_condicion, busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (82, NULL, 111, 'v.idexpediente=ed.fk_expediente AND ed.fk_documento=d.iddocumento AND d.estado not in (\'ELIMINADO\') AND v.idexpediente={*conditions_exp_documents*}', 'expediente documento')");

        /*$sql= "CREATE OR REPLACE VIEW vpermiso_expediente AS
        SELECT
        e.idexpediente,
        e.nombre,
        e.estado_archivo,
        e.cod_padre,
        e.fk_serie,
        e.fk_entidad_serie,
        e.fk_dependencia,
        e.nucleo,
        e.estado,
        e.agrupador,
        p.fk_funcionario
        FROM expediente e 
        LEFT JOIN permiso_expediente p ON p.fk_expediente=e.idexpediente
        LEFT JOIN entidad_serie es ON p.fk_entidad_serie=es.identidad_serie
        LEFT JOIN serie s ON es.fk_serie=s.idserie
        WHERE e.estado=1";
        $this->addSql($sql);*/
               

       
        /*
        permiso

        delete permiso
        232 editar_expediente
        128 adicionar_expediente
        1387 eliminar_documento_expediente
        1432 asignar_expediente
        1431 eliminar_expediente
        1711 compartir_expediente
        1986 mover_expediente

        validar
        transferencia_doc

        DROP VIEW vpermiso_serie;
        DROP VIEW vdependencia_serie;
        DROP VIEW vpermiso_serie_entidad;
        DROP VIEW vexpediente_serie;

         */

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
