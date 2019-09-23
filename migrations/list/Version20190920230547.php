<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190920230547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('busqueda', [
            'ruta_libreria' => 'app/trd/serie_version/funciones_reporte.php',
            'ruta_libreria_pantalla' => 'views/serie_version/js/acciones_reporte.php',
            'campos' => 'version,tipo,descripcion,nombre,anexos,estado,vigente'
        ], [
            'nombre' => 'versiones_trd'
        ]);


        $this->connection->update('modulo', [
            'enlace' => 'views/serie_version/cargar_trd.php'
        ], [
            'nombre' => 'nueva_trd'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
