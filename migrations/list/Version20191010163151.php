<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010163151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Se eliminan campos del expediente';
    }

    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->getTable('expediente');
        $table->dropColumn('codigo');
        $table->dropColumn('fecha_extrema_i');
        $table->dropColumn('fecha_extrema_f');
        $table->dropColumn('consecutivo_inicial');
        $table->dropColumn('consecutivo_final');
        $table->dropColumn('estado');
        $table->addColumn('consecutivo', 'integer', [
            'length' => 11,
            'default' => 0
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
