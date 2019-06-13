<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190605222614 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $record = $this->connection->fetchAll("select idmodulo from modulo where nombre = 'organizacion'");
        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'nombre' => 'funciones',
            'tipo' => 1,
            'imagen' => 'fa fa-cogs',
            'etiqueta' => 'Funciones',
            'enlace' => 'views/funciones/grilla.php',
            'cod_padre' => $record[0]['idmodulo'],
            'orden' => 6
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
