<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190904151358 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        //DELETE
        $this->connection->delete('modulo', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);

        $this->connection->delete('busqueda', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);

        $this->connection->delete('busqueda_componente', [
            'nombre' => 'cuadro_clasificacion_trd'
        ]);

        $this->connection->delete('busqueda_condicion', [
            'etiqueta_condicion' => 'cuadro_clasificacion_trd'
        ]);

        //UPDATE 1
        $this->connection->update('modulo', [
            'etiqueta' => 'Historial',
            'nombre' => 'historial_versiones_trd',
            'orden' => 3
        ], [
            'nombre' => 'versiones_anteriores_trd'
        ]);

        $this->connection->update('busqueda', [
            'etiqueta' => 'Historial',
            'nombre' => 'historial_versiones_trd'
        ], [
            'nombre' => 'versiones_anteriores_trd'
        ]);

        $this->connection->update('busqueda_componente', [
            'etiqueta' => 'Historial',
            'nombre' => 'historial_versiones_trd',
            'info' => '[{"title":"Nombre","field":"{*nombre*}","align":"center"},{"title":"Version","field":"{*version*}","align":"center"},{"title":"Tipo de versi&oacute;n","field":"{*tipo*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion*}","align":"center"},{"title":"Anexo","field":"{*anexos*}","align":"center"},{"title":"TRD","field":"{*view_trd@idserie_version*}","align":"center"},{"title":"Cuadro Clasificaci&oacute;n","field":"{*view_clasification@idserie_version*}","align":"center"}]'
        ], [
            'nombre' => 'versiones_anteriores_trd'
        ]);

        $this->connection->update('busqueda_condicion', [
            'etiqueta_condicion' => 'historial_versiones_trd'
        ], [
            'etiqueta_condicion' => 'versiones_anteriores_trd'
        ]);

        //UPDATE 2
        $this->connection->update('modulo', [
            'etiqueta' => 'Nuevo',
            'nombre' => 'nueva_trd',
            'imagen' => 'fa fa-upload'
        ], [
            'nombre' => 'cargar_trd'
        ]);


        //INSERT
        $data = $this->connection->fetchAll("select idmodulo from modulo where nombre='trd'");

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => '1',
            'nombre' => 'actual_trd',
            'tipo' => '2',
            'imagen' => 'fa fa-sitemap',
            'etiqueta' => 'Listar',
            'enlace' => 'views/serie/listar_trd.php',
            'cod_padre' => $data[0]['idmodulo'],
            'orden' => 2
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
