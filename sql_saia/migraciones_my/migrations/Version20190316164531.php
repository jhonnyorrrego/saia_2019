<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316164531 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('busqueda', [
            'campos' => 'a.nombre,a.etiqueta,a.enlace,a.imagen,a.cod_padre,a.orden,a.tipo'
        ], [
            'nombre' => 'modulo'
        ]);

        $this->connection->update('busqueda_componente', [
            'info' => '<div>{*barra_superior_modulo@idmodulo*}<br><b>Nombre:</b> {*nombre*}<br><b>Etiqueta:</b>{*etiqueta*}<br><b>Imagen:</b> {*imagen*}<br><b>tipo:</b> {*tipo*}<br><b>Enlace:</b> {*enlace*}<br><b>Destino:</b> {*destino*}<br><b>Padre:</b> {*nombre_padre@cod_padre*}<br><b>Orden:</b> {*orden*}<br></div>'
        ], [
            'nombre' => 'modulo'
        ]);
    }


    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
