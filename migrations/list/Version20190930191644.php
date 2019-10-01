<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190930191644 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $module = $this->connection->fetchAll("select * from modulo where nombre='organizacion'");

        $this->connection->insert('modulo', [
            'pertenece_nucleo' => 1,
            'nombre' => 'funciones',
            'tipo' => 1,
            'imagen' => 'fa fa-user',
            'etiqueta' => 'Funciones',
            'enlace' => 'views/funciones/grilla.php',
            'cod_padre' => $module[0]['idmodulo']
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
