<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190912160133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('busqueda', [
            'ruta_libreria' => 'pantallas/configuracion/librerias.php,app/cf/librerias.php'
        ], [
            'idbusqueda' => 133
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
