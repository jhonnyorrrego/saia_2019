<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191004225047 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/formatos/listar_radicacion.php"}]'
        ], [
            'nombre' => 'radicacion_entrada_formulario'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
