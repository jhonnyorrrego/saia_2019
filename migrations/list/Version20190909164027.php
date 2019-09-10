<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909164027 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'pertenece_nucleo' => 1,
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "html.page","url": "views/formatos/listado_categoria.php?idbusqueda=7"}]'
        ], [
            'nombre' => 'radicacion_entrada_formulario'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
