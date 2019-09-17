<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190917143452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Limpieza de tablas y creacion de campo en serie version';
    }

    public function up(Schema $schema): void
    {
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->getTable('serie_version');
        $table->addColumn('estado', 'integer', [
            'comment' => '1-activo;0-Inactivo;2-Temporal',
            'default' => 1
        ]);

        $this->connection->update('busqueda', [
            'campos' => 'version,tipo,descripcion,nombre,anexos,estado'
        ], [
            'nombre' => 'versiones_trd'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => '[{"title":"Nombre","field":"{*nombre*}","align":"center"},{"title":"Version","field":"{*version*}","align":"center"},{"title":"Tipo de versi&oacute;n","field":"{*tipo*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion*}","align":"center"},{"title":"Estado","field":"{*ver_estado@estado*}","align":"center"},{"title":"Opciones","field":"{*opciones@idserie_version,estado,anexos*}","align":"center"}]'
        ], [
            'nombre' => 'versiones_trd'
        ]);

        if ($schema->hasTable('grafico_serie')) {
            $schema->dropTable('grafico_serie');
        }

        if ($schema->hasTable('busqueda_grafico_serie')) {
            $schema->dropTable('busqueda_grafico_serie');
        }

        if ($schema->hasTable('busqueda_indicador')) {
            $schema->dropTable('busqueda_indicador');
        }

        if ($schema->hasTable('indicador')) {
            $schema->dropTable('indicador');
        }

        if ($schema->hasTable('funciones_busqueda')) {
            $schema->dropTable('funciones_busqueda');
        }

        if ($schema->hasTable('busquedas')) {
            $schema->dropTable('busquedas');
        }

        if ($schema->hasTable('municipio_exterior')) {
            $schema->dropTable('municipio_exterior');
        }

        if ($schema->hasTable('log_acceso_editor')) {
            $schema->dropTable('log_acceso_editor');
        }

        if ($schema->hasTable('lista_negra_acceso')) {
            $schema->dropTable('lista_negra_acceso');
        }

        if ($schema->hasTable('historial_impresion')) {
            $schema->dropTable('historial_impresion');
        }

        if ($schema->hasTable('expediente_eli')) {
            $schema->dropTable('expediente_eli');
        }

        if ($schema->hasTable('expediente_directo')) {
            $schema->dropTable('expediente_directo');
        }

        if ($schema->hasTable('expediente_cierre')) {
            $schema->dropTable('expediente_cierre');
        }

        if ($schema->hasTable('filtro_grafica')) {
            $schema->dropTable('filtro_grafica');
        }

        if ($schema->hasTable('reporte')) {
            $schema->dropTable('reporte');
        }

        if ($schema->hasTable('filtro_reporte')) {
            $schema->dropTable('filtro_reporte');
        }

        if ($schema->hasTable('anexos_transferencia')) {
            $schema->dropTable('anexos_transferencia');
        }

        if ($schema->hasTable('anexos_tmp')) {
            $schema->dropTable('anexos_tmp');
        }

        $this->addSql("DROP VIEW vdocumento");
        $this->addSql("DROP VIEW vdocumentos_pendientes");
        $this->addSql("DROP VIEW vdocumentos_proceso");
        $this->addSql("DROP VIEW vusuarios_concurrentes");
    }


    public function down(Schema $schema): void
    {
        $table = $schema->getTable('serie_version');
        $table->dropColumn('estado');
    }
}
