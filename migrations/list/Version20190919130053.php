<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919130053 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->update('modulo', [
            'etiqueta' => 'CAD'
        ], [
            'idmodulo' => 1
        ]);

        $this->connection->update('funciones_formato', [
            'ruta' => '../librerias/funciones_generales.php'
        ], [
            'nombre' => '{*digitalizar_formato*}'
        ]);

        $this->connection->delete('funciones_formato', [
            'idfunciones_formato' => '1166'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'idfunciones_formato_enlace' => '399'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'idfunciones_formato_enlace' => '1108'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'idfunciones_formato_enlace' => '1146'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'idfunciones_formato_enlace' => '1147'
        ]);

        $this->connection->update('pantalla_componente', [
            'opciones' => '{"nombre":"datetime","etiqueta":"Fecha y Hora","tipo_dato":"datetime","longitud":null,"obligatoriedad":1,"valor":"{*fecha_formato*}","acciones":"a,e,b","ayuda":null,"predeterminado":null,"banderas":null,"etiqueta_html":"fecha","orden":1,"mascara":null,"adicionales":null,"autoguardado":1,"fila_visible":1,"placeholder":"0000-00-00"}'
        ], [
            'nombre' => 'datetime'
        ]);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
    }
}
