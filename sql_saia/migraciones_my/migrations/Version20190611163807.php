<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190611163807 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $record = $this->connection->fetchAll("select idmodulo from modulo where nombre = 'cargo'");
        $this->connection->update('modulo', [
            'enlace' => 'views/cargo/listado.php',
            'etiqueta' => 'Cargos',
            'pertenece_nucleo' => 1
        ], [
            'idmodulo' => $record[0]['idmodulo']
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
