<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190703131719 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->insert('configuracion', [
            'nombre' => 'temporal_digitalizacion',
            'valor' => 'temporal/digitalizacion/temporal',
            'tipo' => 'ruta',
            'fecha' => date('Y-m-d H:i:s'),
            'encrypt' => 0
        ]);

        $this->connection->update('configuracion', [
            'valor' => 'dev/master/saia/temporal/digitalizacion/temporal',
            'tipo' => 'ruta',
            'fecha' => date('Y-m-d H:i:s'),
            'encrypt' => 0
        ], [
            'nombre' => 'ruta_ftp'
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
