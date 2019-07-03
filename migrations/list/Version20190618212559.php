<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190618212559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->executeQuery("delete from configuracion where nombre in ('pais', 'departamento', 'ciudad')");

        $this->connection->insert('configuracion', [
            'nombre' => 'pais',
            'valor' => 547,
            'tipo' => 'empresa',
            'fecha' => date('Y-m-d H:i:s'),
            'encrypt' => 0
        ]);

        $this->connection->insert('configuracion', [
            'nombre' => 'departamento',
            'valor' => 2800,
            'tipo' => 'empresa',
            'fecha' => date('Y-m-d H:i:s'),
            'encrypt' => 0
        ]);

        $this->connection->insert('configuracion', [
            'nombre' => 'ciudad',
            'valor' => 15358,
            'tipo' => 'empresa',
            'fecha' => date('Y-m-d H:i:s'),
            'encrypt' => 0
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
