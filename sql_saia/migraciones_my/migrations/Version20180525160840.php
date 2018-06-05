<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180525160840 extends AbstractMigration {

    public function getDescription() {
        return 'Mover campo busqueda.llave a busqueda_componente.llave';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");

        $funcion = "CREATE FUNCTION " . $schema->getName() . ".func_inc_var_session() RETURNS INT(11) COMMENT 'Se usa para generar IDs unicos de filas en vistas' NOT DETERMINISTIC NO SQL SQL SECURITY DEFINER begin SET @var := IFNULL(@var,0) + 1; return @var; end";

        $result = $this->connection->fetchAssoc("SHOW PROCEDURE STATUS like '%" . $schema->getName() . ".func_inc_var_session'");
        if(!$result) {
            $this->addSql($funcion);
        }

        $vista = "ALTER VIEW " . $schema->getName() . ".vcontrol_documentos_calidad AS SELECT func_inc_var_session() num_fila, d.iddocumento AS iddocumento, DATE_FORMAT(d.fecha, '%Y-%m-%d') AS fecha, d.numero AS numero, ft.tipo_solicitud AS tipo_solicitud, ft.listado_procesos AS listado_procesos, ft.revisado AS revisado, ft.aprobado AS aprobado, ft.secretaria AS secretaria, p.nombre AS nombre_proceso, ft.tipo_documento AS tipo_documento, ft.serie_doc_control AS serie_doc_control, ft.fecha_confirmacion AS fecha_confirmacion, ft.iddocumento_calidad AS iddocumento_calidad, ft.nombre_documento AS nombre_documento, ft.otros_documentos AS otros_documentos, ft.version AS version, ft.estado_doc_calidad AS estado_doc_calidad, 2 AS origen_documento, 'Interno' AS nom_origen_documento, ft.almacenamiento AS almacenamiento, NULL AS vigencia, ft.iddocumento_version AS iddoc_version FROM saia_demo3.ft_control_documentos ft JOIN saia_demo3.documento d ON d.iddocumento = ft.documento_iddocumento JOIN saia_demo3.ft_proceso p ON p.idft_proceso = ft.listado_procesos WHERE d.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND ft.tipo_solicitud = 2 UNION ALL SELECT func_inc_var_session(), d.iddocumento AS iddocumento, DATE_FORMAT(d.fecha, '%Y-%m-%d') AS fecha, d.numero AS numero, ft.tipo_solicitud AS tipo_solicitud, ft.listado_procesos AS listado_procesos, ft.revisado AS revisado, ft.aprobado AS aprobado, ft.secretaria AS secretaria, p.nombre AS nombre_proceso, i.tipo_documento_i AS tipo_documento, i.serie_doc_control_i AS serie_doc_control, i.fecha_confirmacion_i AS fecha_confirmacion, i.iddocumento_calidad_i AS iddocumento_calidad, i.nombre_documento_i AS nombre_documento, i.otros_documentos_i AS otros_documentos, i.version_i AS version, i.estado_doc_calidad_i AS estado_doc_calidad, i.origen_documento_i AS origen_documento, ( CASE WHEN(i.origen_documento_i = 1) THEN 'Externo' ELSE 'Interno' END ) AS nom_origen_documento, i.almacenamiento_i AS almacenamiento, i.vigencia_i AS vigencia, i.iddocumento_version_i AS iddoc_version FROM saia_demo3.ft_control_documentos ft JOIN saia_demo3.documento d ON d.iddocumento = ft.documento_iddocumento JOIN saia_demo3.ft_proceso p ON p.idft_proceso = ft.listado_procesos JOIN saia_demo3.ft_item_control_versio i ON ft.idft_control_documentos = i.ft_control_documentos JOIN saia_demo3.documento di ON di.iddocumento = i.documento_iddocumento WHERE d.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND di.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND ft.tipo_solicitud IN(1, 3)";
        $this->addSql($vista);
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $vista = "ALTER view vcontrol_documentos_calidad AS SELECT d.iddocumento AS iddocumento, DATE_FORMAT(d.fecha, '%Y-%m-%d') AS fecha, d.numero AS numero, ft.tipo_solicitud AS tipo_solicitud, ft.listado_procesos AS listado_procesos, ft.revisado AS revisado, ft.aprobado AS aprobado, ft.secretaria AS secretaria, p.nombre AS nombre_proceso, ft.tipo_documento AS tipo_documento, ft.serie_doc_control AS serie_doc_control, ft.fecha_confirmacion AS fecha_confirmacion, ft.iddocumento_calidad AS iddocumento_calidad, ft.nombre_documento AS nombre_documento, ft.otros_documentos AS otros_documentos, ft.version AS version, ft.estado_doc_calidad AS estado_doc_calidad, 2 AS origen_documento, 'Interno' AS nom_origen_documento, ft.almacenamiento AS almacenamiento, NULL AS vigencia, ft.iddocumento_version AS iddoc_version FROM saia_demo3.ft_control_documentos ft JOIN saia_demo3.documento d ON d.iddocumento = ft.documento_iddocumento JOIN saia_demo3.ft_proceso p ON p.idft_proceso = ft.listado_procesos WHERE d.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND ft.tipo_solicitud = 2 UNION ALL SELECT d.iddocumento AS iddocumento, DATE_FORMAT(d.fecha, '%Y-%m-%d') AS fecha, d.numero AS numero, ft.tipo_solicitud AS tipo_solicitud, ft.listado_procesos AS listado_procesos, ft.revisado AS revisado, ft.aprobado AS aprobado, ft.secretaria AS secretaria, p.nombre AS nombre_proceso, i.tipo_documento_i AS tipo_documento, i.serie_doc_control_i AS serie_doc_control, i.fecha_confirmacion_i AS fecha_confirmacion, i.iddocumento_calidad_i AS iddocumento_calidad, i.nombre_documento_i AS nombre_documento, i.otros_documentos_i AS otros_documentos, i.version_i AS version, i.estado_doc_calidad_i AS estado_doc_calidad, i.origen_documento_i AS origen_documento, ( CASE WHEN(i.origen_documento_i = 1) THEN 'Externo' ELSE 'Interno' END ) AS nom_origen_documento, i.almacenamiento_i AS almacenamiento, i.vigencia_i AS vigencia, i.iddocumento_version_i AS iddoc_version FROM saia_demo3.ft_control_documentos ft JOIN saia_demo3.documento d ON d.iddocumento = ft.documento_iddocumento JOIN saia_demo3.ft_proceso p ON p.idft_proceso = ft.listado_procesos JOIN saia_demo3.ft_item_control_versio i ON ft.idft_control_documentos = i.ft_control_documentos JOIN saia_demo3.documento di ON di.iddocumento = i.documento_iddocumento WHERE d.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND di.estado NOT IN('ELIMINADO', 'ANULADO', 'ACTIVO') AND ft.tipo_solicitud IN(1, 3)";
        $this->addSql($vista);
        $result = $this->connection->fetchAssoc("SHOW PROCEDURE STATUS like '%" . $schema->getName() . ".func_inc_var_session'");
        if($result) {
            $this->addSql("DROP FUNCTION func_inc_var_session");
        }
    }
}
