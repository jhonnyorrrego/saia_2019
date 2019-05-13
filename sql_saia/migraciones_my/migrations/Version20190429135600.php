<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190429135600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('permiso_perfil');

        if ($table->hasColumn('caracteristica_propio')) {
            $table->dropColumn('caracteristica_propio');
        }

        if ($table->hasColumn('caracteristica_grupo')) {
            $table->dropColumn('caracteristica_grupo');
        }

        if ($table->hasColumn('caracteristica_total')) {
            $table->dropColumn('caracteristica_total');
        }


        if($schema->hasTable('pantalla_anexos')){

            $schema->dropTable('pantalla_anexos');
        }

        if($schema->hasTable('pantalla_campos')){

            $schema->dropTable('pantalla_campos');
        }

        if($schema->hasTable('pantalla')){

            $schema->dropTable('pantalla');
        }

        if($schema->hasTable('pantalla_accion')){

            $schema->dropTable('pantalla_accion');
        }

        if($schema->hasTable('pantalla_busqueda')){

            $schema->dropTable('pantalla_busqueda');
        }

        if($schema->hasTable('pantalla_componente_20181214')){

            $schema->dropTable('pantalla_componente_20181214');
        }

        if($schema->hasTable('pantalla_encabezado')){

            $schema->dropTable('pantalla_encabezado');
        }

        if($schema->hasTable('pantalla_esquema')){

            $schema->dropTable('pantalla_esquema');
        }

        if($schema->hasTable('pantalla_func_param')){

            $schema->dropTable('pantalla_func_param');
        }

        if($schema->hasTable('pantalla_funcion')){

            $schema->dropTable('pantalla_funcion');
        }

        if($schema->hasTable('pantalla_funcion_exe')){

            $schema->dropTable('pantalla_funcion_exe');
        }

        if($schema->hasTable('pantalla_impresion')){

            $schema->dropTable('pantalla_impresion');
        }

        if($schema->hasTable('pantalla_include')){

            $schema->dropTable('pantalla_include');
        }

        if($schema->hasTable('pantalla_libreria')){

            $schema->dropTable('pantalla_libreria');
        }

        if($schema->hasTable('pantalla_libreria_def')){

            $schema->dropTable('pantalla_libreria_def');
        }

        if($schema->hasTable('pantalla_pdf')){

            $schema->dropTable('pantalla_pdf');
        }

        if($schema->hasTable('pantalla_ruta')){

            $schema->dropTable('pantalla_ruta');
        }

        $this->connection->executeQuery('drop view if exists vpantalla_formato');

        $this->connection->update('modulo',[
            'imagen' => ''
        ], [
            'imagen' => 'botones/formatos/modulo.gif'
        ]);


        $table = $schema->getTable('permiso');

        if ($table->hasColumn('caracteristica_propio')) {
            $table->dropColumn('caracteristica_propio');
        }

        if ($table->hasColumn('caracteristica_grupo')) {
            $table->dropColumn('caracteristica_grupo');
        }

        if ($table->hasColumn('caracteristica_total')) {
            $table->dropColumn('caracteristica_total');
        }

        $this->connection->update('modulo', [
            'cod_padre' => 0
        ], [
            'cod_padre' => null
        ]);
    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
