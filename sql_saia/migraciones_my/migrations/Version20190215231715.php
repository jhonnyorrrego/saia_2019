<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215231715 extends AbstractMigration
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
    }

    public function up(Schema $schema) : void
    {
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

        if ($schema->hasTable("expediente_abce")) {
            $schema->dropTable("expediente_abce");
        }

        if ($schema->hasTable("expediente_cierre")) {
            $schema->dropTable("expediente_cierre");
        }

        if ($schema->hasTable("caja")) {
            $schema->dropTable("caja");
        }

        if ($schema->hasTable("caja_entidadserie")) {
            $schema->dropTable("caja_entidadserie");
        }

        if ($schema->hasTable("caja_eli")) {
            $schema->dropTable("caja_eli");
        }

        if ($schema->hasTable("expediente_directo")) {
            $schema->dropTable("expediente_directo");
        }

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
        $tabla3->addColumn("fk_caja_eli", "integer", ["notnull" => false]);
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
        $tabla7->addColumn("tipo", "integer", ["default"=>1,"comment" => "1,NO compartido; 2,Compartido"]);
        $tabla7->addColumn("fecha", "datetime",["comment"=>"fecha creacion"]);
        $tabla7->addColumn("fecha_indice", "datetime");
        $tabla7->setPrimaryKey(["idexpediente_doc"]);


        $tabla8 = $schema->createTable("expediente_eli");
        $tabla8->addColumn("idexpediente_eli", "integer", ["autoincrement" => true]);
        $tabla8->addColumn("fk_expediente", "integer");
        $tabla8->addColumn("fk_funcionario", "integer");
        $tabla8->addColumn("fecha_eliminacion", "datetime");
        $tabla8->addColumn("fecha_accion", "datetime", ["notnull" => false]);
        $tabla8->addColumn("accion", "integer", ["notnull" => false,"comment"=>"1:Eli.Definitiva;2,Restauracion"]);
        $tabla8->setPrimaryKey(["idexpediente_eli"]);


        $tabla9 = $schema->createTable("expediente_cierre");
        $tabla9->addColumn("idexpediente_cierre", "integer", ["autoincrement" => true]);
        $tabla9->addColumn("fk_expediente", "integer");
        $tabla9->addColumn("fk_funcionario", "integer");
        $tabla9->addColumn("accion", "integer", ["comment" => "1:Abierto;2:Cierre;"]);
        $tabla9->addColumn("fecha_accion", "datetime");
        $tabla9->addColumn("observacion", "text", ["notnull" => false]);
        $tabla9->setPrimaryKey(["idexpediente_cierre"]);


        $tabla10 = $schema->createTable("caja");
        $tabla10->addColumn("idcaja", "integer", ["autoincrement" => true]);
        $tabla10->addColumn("codigo", "string", ["length" => 255]);
        $tabla10->addColumn("estado_archivo", "integer", ["length" => 1, "default" => 1, "comment" => "1,Gestion;2,Central;3,Historico"]);
        $tabla10->addColumn("seccion", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("subseccion", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("division", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("modulo", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("panel", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("nivel", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("fondo", "string", ["length" => 255, "notnull" => false]);
        $tabla10->addColumn("material", "integer", ["comment" => "1,Carton;2,Otro", "notnull" => false]);
        $tabla10->addColumn("seguridad", "integer", ["comment" => "1,Confidencia;2,Publico;3,Rutinario", "notnull" => false]);
        $tabla10->addColumn("propietario", "integer", ["comment" => "fk_funcionario"]);
        $tabla10->addColumn("responsable", "integer", ["comment" => "fk_funcionario"]);
        $tabla10->addColumn("fecha_creacion", "datetime", ["notnull" => false]);
        $tabla10->addColumn("estado", "integer", ["default" => 1, "comment" => "1,Activo;0,Eliminado"]);
        $tabla10->addColumn("fk_caja_eli", "integer", ["notnull" => false]);
        $tabla10->setPrimaryKey(["idcaja"]);


        $tabla11 = $schema->createTable("caja_entidadserie");
        $tabla11->addColumn("idcaja_entidadserie", "integer", ["autoincrement" => true]);
        $tabla11->addColumn("fk_caja", "integer");
        $tabla11->addColumn("fk_entidad_serie", "integer");
        $tabla11->addColumn("fecha_creacion", "datetime", ["notnull" => false]);
        $tabla11->addUniqueIndex(["fk_caja", "fk_entidad_serie"]);
        $tabla11->setPrimaryKey(["idcaja_entidadserie"]);


        $tabla12 = $schema->createTable("caja_eli");
        $tabla12->addColumn("idcaja_eli", "integer", ["autoincrement" => true]);
        $tabla12->addColumn("fk_caja", "integer");
        $tabla12->addColumn("eliminar_expediente", "integer", ["default" => 1, "comment" => "1,Eli.Caja/Exp;0,Eli.Caja"]);
        $tabla12->addColumn("fk_funcionario", "integer", ["comment" => "Elimino"]);
        $tabla12->addColumn("fecha_eliminacion", "datetime");
        $tabla12->addColumn("fecha_accion", "datetime", ["notnull" => false]);
        $tabla12->addColumn("accion", "integer", ["notnull" => false,"comment"=>"1:Eli.Definitiva;2,Restauracion"]);
        $tabla12->setPrimaryKey(["idcaja_eli"]);

        $tabla13 = $schema->createTable("expediente_directo");
        $tabla13->addColumn("idexpediente_directo", "integer", ["autoincrement" => true]);
        $tabla13->addColumn("fk_funcionario", "integer", ["comment" => "Creador"]);
        $tabla13->addColumn("fk_expediente", "integer");
        $tabla13->addColumn("fecha_creacion", "datetime", ["notnull" => false]);
        $tabla13->setPrimaryKey(["idexpediente_directo"]);

        $this->addSql("DELETE FROM modulo WHERE (nombre LIKE '%expedie%' OR nombre like '%permiso_admin_archivo%') and nombre<>'expediente_admin'");


       /* $this->addSql("DELETE FROM busqueda WHERE idbusqueda IN (37,48,115,116)");
        $this->addSql("DELETE FROM busqueda_componente WHERE idbusqueda_componente IN (9,10,110,111,160,323,368,320,321,371,372,373,324)");
        $this->addSql("DELETE FROM busqueda_condicion WHERE fk_busqueda_componente IN (9,10,110,111,160,323,368,320,321,371,372,373,324)");

        $this->addSql("INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades, elastic) VALUES (37, 'expediente', ' Mis expedientes', 1, 200, NULL, NULL, NULL, 'pantallas/expediente/librerias.php', 'pantallas/expediente/librerias_js.php', 20, 500, 'pantallas/busquedas/consulta_busqueda_expediente.php', 1, NULL, 0)");
        $this->addSql("INSERT INTO busqueda (idbusqueda, nombre, etiqueta, estado, ancho, campos, llave, tablas, ruta_libreria, ruta_libreria_pantalla, cantidad_registros, tiempo_refrescar, ruta_visualizacion, tipo_busqueda, badge_cantidades, elastic) VALUES (48, 'cajas', 'Cajas', 1, 200, NULL, NULL, NULL, 'pantallas/caja/librerias.php', 'pantallas/caja/librerias_js.php', 20, 500, 'pantallas/busquedas/consulta_busqueda_caja.php', 1, NULL, 0)");

        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (9, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda_expediente.php', 'Archivo Hist&oacute;rico', 'expediente_historico', 3, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_expediente@idexpediente*}</div>', NULL, NULL, NULL, 1, 320, 2, NULL, 'vpermiso_expediente v', 'v.nombre', 'asc', 'v.idexpediente', 'pantallas/expediente/buscar_expediente.php', 'adicionar_expediente,compartir_expediente,transferencia_documental', NULL, 'barra_superior_busqueda', NULL, NULL, 'v.idexpediente')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (10, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda_expediente.php', 'Archivo Central', 'expediente_central', 2, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_expediente@idexpediente*}</div>', NULL, NULL, NULL, 1, 320, 2, NULL, 'vpermiso_expediente v', 'v.nombre', 'asc', 'v.idexpediente', 'pantallas/expediente/buscar_expediente.php', 'adicionar_expediente,compartir_expediente,transferencia_documental', NULL, 'barra_superior_busqueda', NULL, NULL, 'v.idexpediente')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (110, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda_expediente.php', 'Archivo de Gesti&oacute;n', 'expediente_gestion', 1, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_expediente@idexpediente*}</div>', NULL, NULL, NULL, 2, 320, 2, NULL, 'vpermiso_expediente v', 'v.nombre', 'asc', 'v.idexpediente', 'pantallas/expediente/buscar_expediente.php', 'adicionar_expediente,compartir_expediente,transferencia_documental', NULL, 'barra_superior_busqueda', NULL, NULL, 'v.idexpediente')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (111, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda.php', 'Expediente Documento', 'expediente_documento', 4, '<div id=\"resultado_pantalla_{*iddocumento*}\" class=\"well\">{*numero*}</div>', NULL, NULL, NULL, 0, 320, 2, 'd.numero', 'vpermiso_expediente v,documento d,expediente_doc ed', 'd.fecha', 'desc', 'd.iddocumento,d.descripcion', NULL, NULL, NULL, NULL, NULL, NULL, 'd.iddocumento')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (160, 37, 2, 2, NULL, 'Listado de Cajas', 'listado_cajas', 5, '<div title=\"Cajas\" data-load=\'{\"kConnector\":\"iframe\",\"url\":\"../../pantallas/busquedas/consulta_busqueda_caja.php?idbusqueda_componente=323\",\"kTitle\":\"Cajas\",\"kWidth\":\"320px\"}\' class=\"items navigable\"><div class=\"head\"></div><div class=\"label\">Cajas</div><div class=\"tail\"></div></div>', NULL, NULL, NULL, 1, 320, 1, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'a.idexpediente')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (323, 48, 3, 2, 'pantallas/busquedas/consulta_busqueda_caja.php', 'Cajas', 'caja', 1, '<div id=\"resultado_pantalla_{*idcaja*}\" class=\"well\">{*info_caja@idcaja*}</div>', NULL, NULL, NULL, 2, 320, 2, NULL, 'caja', 'idcaja', 'asc', NULL, NULL, NULL, NULL, NULL, 'pantallas/caja/adicionar_caja.php?idbusqueda_componente=323', NULL, 'idcaja')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (371, 48, 3, 2, 'pantallas/busquedas/consulta_busqueda_caja.php', 'Caja Expediente', 'caja_expediente', 2, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_caja_expediente@idexpediente*}</div>', NULL, NULL, NULL, 0, 320, 2, NULL, 'expediente e', 'e.nombre', 'asc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e.idexpediente')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (372, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda.php', 'Papelera', 'papelera', 7, '{*info_restaurar@idtabla,fk_tipo,tipo*}', NULL, NULL, NULL, 2, 320, 2, 'fk_tipo,tipo,fecha_eliminacion,idtabla', 'vpapelera_expediente v', 'fecha_eliminacion', 'desc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'id')");
        $this->addSql("INSERT INTO busqueda_componente (idbusqueda_componente, busqueda_idbusqueda, tipo, conector, url, etiqueta, nombre, orden, info, exportar, exportar_encabezado, encabezado_componente, estado, ancho, cargar, campos_adicionales, tablas_adicionales, ordenado_por, direccion, agrupado_por, busqueda_avanzada, acciones_seleccionados, modulo_idmodulo, menu_busqueda_superior, enlace_adicionar, encabezado_grillas, llave) VALUES (373, 37, 3, 2, 'pantallas/busquedas/consulta_busqueda_expediente.php?hiddenBusqueda=1', 'Accesos directos', 'expedientes_directos', 8, '<div id=\"resultado_pantalla_{*idexpediente*}\" class=\"well\">{*info_expediente_directo@idexpediente,idexpediente_directo*}</div>', NULL, NULL, NULL, 2, 320, 2, 'idexpediente_directo', 'expediente e,expediente_directo ed', 'e.nombre', 'asc', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'e.idexpediente')");

        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 9, 'v.estado_archivo=3 {*conditions*}', 'Historico')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 10, 'v.estado_archivo=2 {*conditions*}', 'Central')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 110, 'v.estado_archivo=1 {*conditions*}', 'Gestion')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 111, 'v.idexpediente=ed.fk_expediente AND ed.fk_documento=d.iddocumento AND d.estado not in (\'ELIMINADO\') AND v.idexpediente={*conditions_exp_documents*}', 'Documentos del Expediente')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 323, 'estado=1', 'Cajas')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 371, '{*conditions_caja_expediente*}', 'Caja Expediente')");
        $this->addSql("INSERT INTO busqueda_condicion (busqueda_idbusqueda, fk_busqueda_componente, codigo_where, etiqueta_condicion) VALUES (NULL, 373, 'e.idexpediente=ed.fk_expediente {*user_actual*}', 'Accesos Directos')");
*/

        /*
            CREATE OR REPLACE VIEW vpapelera_expediente AS 
            select concat(ce.fk_caja,'1') AS id,ce.idcaja_eli AS idtabla,'CAJA' AS tipo,ce.fk_caja AS fk_tipo,ce.fk_funcionario AS fk_funcionario,ce.fecha_eliminacion AS fecha_eliminacion,ce.eliminar_expediente AS eliminar_expediente
            from caja_eli ce where isnull(ce.fecha_accion) 
            union all
            select concat(ee.fk_expediente,'2') AS id,ee.idexpediente_eli AS idtabla,'EXPEDIENTE' AS tipo,ee.fk_expediente AS fk_tipo,ee.fk_funcionario AS fk_funcionario,ee.fecha_eliminacion AS fecha_eliminacion,0 AS eliminar_expediente
            from expediente_eli ee where isnull(ee.fecha_accion)
        
            CREATE OR REPLACE VIEW vpermiso_expediente AS 
            select e.idexpediente AS idexpediente,e.nombre AS nombre,e.estado_archivo AS estado_archivo,e.cod_padre AS cod_padre,e.fk_serie AS fk_serie,e.fk_entidad_serie AS fk_entidad_serie,
            e.fk_dependencia AS fk_dependencia,e.nucleo AS nucleo,e.estado AS estado,e.agrupador AS agrupador,p.fk_funcionario AS fk_funcionario 
            from (((expediente e left join permiso_expediente p on((p.fk_expediente = e.idexpediente))) left join entidad_serie es on((p.fk_entidad_serie = es.identidad_serie))) left join serie s on((es.fk_serie = s.idserie))) where (e.estado = 1)

            CREATE OR REPLACE VIEW vpermiso_serie AS
            SELECT s.idserie,s.nombre,s.tipo,s.cod_padre,e.identidad_serie,e.fk_dependencia,p.permiso,f.idfuncionario FROM serie s,entidad_serie e,permiso_serie p,funcionario f 
            WHERE s.idserie=e.fk_serie AND e.identidad_serie=p.fk_entidad_serie AND f.idfuncionario=p.llave_entidad AND p.fk_entidad=1 AND s.estado=1 AND e.estado=1 
            UNION ALL
            SELECT s.idserie,s.nombre,s.tipo,s.cod_padre,e.identidad_serie,e.fk_dependencia,p.permiso,f.idfuncionario FROM serie s,entidad_serie e,permiso_serie p,vfuncionario_dc f 
            WHERE s.idserie=e.fk_serie AND e.identidad_serie=p.fk_entidad_serie AND f.idcargo=p.llave_entidad AND p.fk_entidad=4 AND s.estado=1 AND e.estado=1
            UNION ALL
            SELECT s.idserie,s.nombre,s.tipo,s.cod_padre,e.identidad_serie,e.fk_dependencia,p.permiso,f.idfuncionario FROM serie s,entidad_serie e,permiso_serie p,vfuncionario_dc f 
            WHERE s.idserie=e.fk_serie AND e.identidad_serie=p.fk_entidad_serie AND f.iddependencia=p.llave_entidad AND p.fk_entidad=2 AND s.estado=1 AND e.estado=1


115,116    
320,321,

            DROP VIEW IF EXISTS vdependencia_serie;
            DROP VIEW IF EXISTS vpermiso_serie_entidad;
            DROP VIEW IF EXISTS vexpediente_serie;

         */

    }

    public function down(Schema $schema) : void
    {


    }
}
