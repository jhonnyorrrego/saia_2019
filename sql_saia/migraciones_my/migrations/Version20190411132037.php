<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190411132037 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('modulo', [
            'imagen' => 'fa fa-users',
            'pertenece_nucleo' => 1
        ], [
            'nombre' => 'reporte_usuarios_concurrentes'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => 'Identificacion|{*nit*}|left|-|Nombres|{*nombre_completo*}|left|-|Login|{*login*}|left|-|Conexiones|{*cant_conexiones*}|center|-|Cerrar|{*close_session_button@login*}|center'
        ], [
            'nombre' => 'usuarios_conectados_concurrentes'
        ]);

        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/funcionario/librerias.php',
            'ruta_libreria_pantalla' => 'views/funcionario/js/librerias.php'
        ], [
            'nombre' => 'usuarios_concurrentes'
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
