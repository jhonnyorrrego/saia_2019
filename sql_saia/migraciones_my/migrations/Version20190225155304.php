<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190225155304 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
       
       $componente1 = [
                'nombre' => "{*fecha_creacion*}",
                'nombre_funcion' => "fecha_creacion",
                'etiqueta' => "Fecha de fecha creaci&oacute;n",
                'descripcion' => "fecha_creacion",
                'ruta' => "../../formatos/librerias/funciones_cliente.php",
                'acciones' => "m"

        ];

        $this->connection->insert('funciones_formato', $componente1);

        $componente2 = [
                'nombre' => "{*fecha_aprobacion*}",
                'nombre_funcion' => "fecha_aprobacion",
                'etiqueta' => "Fecha de aprobaci&oacute;n",
                'descripcion' => "fecha_aprobacion",
                'ruta' => "../../formatos/librerias/funciones_cliente.php",
                'acciones' => "m"

        ];

        $this->connection->insert('funciones_formato', $componente2);
    }

  public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->getTable('funciones_formato');

        if($table && $table->hasColumn('formato')){
            $table->dropColumn('formato');
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) : void
    {
        $table = $schema->getTable('funciones_formato');

        if($table && $table->hasColumn('formato')){
            $table->dropColumn('formato');
        }

    }
}
