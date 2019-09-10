<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909204102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('funciones_nucleo', [
            'ruta' => 'app/documento/class_transferencia.php'
        ], [
            'nombre_funcion' => 'mostrar_estado_proceso'
        ]);

        $this->connection->update('funciones_formato', [
            'ruta' => '../../app/documento/class_transferencia.php'
        ], [
            'nombre_funcion' => 'mostrar_estado_proceso'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
