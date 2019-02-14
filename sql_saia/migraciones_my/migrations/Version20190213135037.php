<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190213135037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        if ($schema->hasTable("funciones_formato")) {
            $tabla = $schema->getTable("funciones_formato");
            $tabla->dropColumn("formato");
            $componente1 = [
                'nombre' => "{*asunto_documento*}",
                'nombre_funcion' => "asunto_documento",
                'etiqueta' => "Descripci&oacute;n del documento",
                'descripcion' => "asunto_documento",
                'ruta' => "../../formatos/librerias/funciones_cliente.php",
                'acciones' => "m"

            ];
            $this->connection->insert('funciones_formato', $componente1);
            
        }
     
        $this->connection->update('modulo', ['etiqueta' => 'Registro de correspondencia'], ["nombre" => "radicacion_entrada"]);
        $this->connection->update('modulo', ['etiqueta' => 'Crear Registro de correspondencia'], ["nombre" => "crear_radicacion_entrada"]);
        $this->connection->update('formato', ['etiqueta' => 'Registro de correspondencia'], ["nombre" => "radicacion_entrada"]);
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
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
        // this down() migration is auto-generated, please modify it to your needs

    }
}
