<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919133858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Actualizar la URL de cargar TRD';
    }

    public function up(Schema $schema): void
    {
        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $this->connection->update('configuracion', [
            'valor' => 0
        ], [
            'nombre' => 'habilita_usuarios_concurrentes'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/trd/serie_version/cargar_trd.php'
        ], [
            'nombre' => 'nueva_trd'
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/trd/serie_version/funciones_reporte.php',
            'ruta_libreria_pantalla' => 'views/trd/serie_version/js/acciones_reporte.php',
            'campos' => 'version,tipo,descripcion,nombre,anexos,estado,vigente'
        ], [
            'nombre' => 'versiones_trd'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => '[{"title":"Nombre","field":"{*nombre*}","align":"center"},{"title":"Version","field":"{*version*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion*}","align":"center"},{"title":"Estado","field":"{*ver_estado@estado*}","align":"center"},{"title":"Opciones","field":"{*opciones@idserie_version,estado,vigente,anexos*}","align":"center"}]'
        ], [
            'nombre' => 'versiones_trd'
        ]);

        $table = $schema->getTable('serie_version');
        $table->addColumn('vigente', 'boolean', [
            'default' => false,
            'comment' => '1,TRD Vigente; 0, TRD obsoleta'
        ]);

        $table = $schema->getTable('serie_temp');
        $table->addColumn('fk_serie_version', 'integer');
        $table->addColumn('cod_arbol', 'string', [
            'length' => 255
        ]);

        if ($schema->hasTable("dependencia_serie")) {
            $schema->dropTable('dependencia_serie');
        }

        if ($schema->hasTable("dependencia_serie_temp")) {
            $schema->dropTable('dependencia_serie_temp');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
