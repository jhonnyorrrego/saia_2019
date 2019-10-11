<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191007231928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creando funciones y su enlace para obtener tipo recorrido y mostrar destino entre sedes en planilla de distribucion, Se crea una columna en cf_ventanilla para definir el gestor de correspondencia de la sede';
    }


    public function up(Schema $schema): void
    {

        $this->connection->insert('funciones_formato', [
            'idfunciones_formato' => 1601,
            'nombre' => '{*obtener_tipo_recorrido*}',
            'nombre_funcion' => 'obtener_tipo_recorrido',
            'etiqueta' => 'obtener tipo recorrido',
            'descripcion' => 'Retorna si el recorrido es matutino o vespertino',
            'ruta' => 'funciones.php',
            'formato' => '353',
            'acciones' => 'm'
        ]);

        $this->connection->insert('funciones_formato', [
            'idfunciones_formato' => 1602,
            'nombre' => '{*mostrar_destino_entre_sedes*}',
            'nombre_funcion' => 'mostrar_destino_entre_sedes',
            'etiqueta' => 'mostrar destino entre sedes',
            'descripcion' => 'Retorna la sede destino si la distribucion se encuentran distribuida desde la opicion entre sedes',
            'ruta' => 'funciones.php',
            'formato' => '353',
            'acciones' => 'm'
        ]);

        $this->connection->insert('funciones_formato_enlace', [
            'funciones_formato_fk' => 1601,
            'formato_idformato' => 353
        ]);

        $this->connection->insert('funciones_formato_enlace', [
            'funciones_formato_fk' => 1602,
            'formato_idformato' => 353
        ]);

        $cf_ventanilla = $schema->getTable('cf_ventanilla');
        if (!$cf_ventanilla->hasColumn('iddependencia_cargo')) {
            $cf_ventanilla->addColumn('iddependencia_cargo', 'integer', [
                'default' => 0
            ]);
        }
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('funciones_formato', [
            'nombre' => '{*obtener_tipo_recorrido*}'
        ]);

        $this->connection->delete('funciones_formato', [
            'nombre' => '{*mostrar_destino_entre_sedes*}'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 1601,
            'formato_idformato' => 353
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 1602,
            'formato_idformato' => 353
        ]);

        $cf_ventanilla = $schema->getTable('cf_ventanilla');
        if ($cf_ventanilla->hasColumn('iddependencia_cargo')) {
            $cf_ventanilla->dropColumn('iddependencia_cargo');
        }
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
