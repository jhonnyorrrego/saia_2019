<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190830154210 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/distribucion/funciones_distribucion.php',
            'ruta_libreria_pantalla' => 'views/distribucion/js/funciones_distribucion_js.php'
        ], [
            'idbusqueda' => '109',
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/distribucion/funciones_distribucion.php',
            'ruta_libreria_pantalla' => 'views/distribucion/js/funciones_distribucion_js.php'
        ], [
            'idbusqueda' => '139',
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_pendientes_entrada.php,app/distribucion/funciones_distribucion.php'
        ], [
            'idbusqueda' => '7',
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'pantallas/documento/librerias.php,pantallas/documento/librerias_pendientes_entrada.php,app/distribucion/funciones_distribucion.php'
        ], [
            'idbusqueda' => '7',
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'FECHA DEL DOCUMENTO'
        ], [
            'idcampos_formato' => 3454,
        ]);

        $this->connection->update('campos_formato', [
            'etiqueta' => 'No. Registro'
        ], [
            'idcampos_formato' => 54,
        ]);

        $this->connection->update('formato', [
            'cuerpo' => '<table align=\"center\" border=\"1\" cellspacing=\"0\" style=\"position:relative; top:0px; width:100%\">\r\n <tbody>\r\n <tr>\r\n <td style=\"width:30%\"><strong>Auxiliar de mensajer&iacute;a: </strong>{*mensajero_entrega_interna*}</td>\r\n <td style=\"width:50%\"><strong>Tipo de Mensajer&iacute;a: </strong>{*tipo_mensajero*}</td>\r\n <td style=\"width:20%\"><strong>Recorrido: </strong>{*tipo_recorrido*}</td>\r\n </tr>\r\n </tbody>\r\n </table>\r\n <p>{*mostrar_seleccionados_entrega*}</p>\r\n '
        ], [
            'idformato' => 353,
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
