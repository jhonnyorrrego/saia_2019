<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190829224657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        // MIGRACIONES JULIAN OTALVARO //////////////////////////////

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/grilla.php?idbusqueda_componente=363"}]'
        ], [
            'idmodulo' => '1939'
        ]);

        $this->connection->update('pantalla_componente', [
            'opciones' => '{"nombre":"contador","etiqueta":"Campo num&eacute;rico","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"spin","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":""}'
        ], [
            'idpantalla_componente' => '27'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => '[{"title":"N&deg;","field":"{*contador_formatos@*}","align":"center"},{"title":"Formatos","field":"{*etiqueta*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion_formato*}","align":"center"},{"title":"Versi&oacute;n","field":"{*version*}","align":"center"},{"title":" ","field":"{*boton_editar_formatos@idformato,etiqueta*}","align":"center"}]'
        ], [
            'idbusqueda_componente' => '363'
        ]);

        $this->connection->update('busqueda', [
            'campos' => 'a.etiqueta,a.descripcion_formato,a.version',
            'llave' => 'a.idformato',
            'tablas' => 'formato a',
            'ruta_libreria' => 'pantallas/formato/funciones.php',
            'cantidad_registros' => '20',
            'tipo_busqueda' => '2'
        ], [
            'idbusqueda' => '131'
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////////

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
