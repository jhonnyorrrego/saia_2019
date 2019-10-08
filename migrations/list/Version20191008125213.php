<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191008125213 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Actualiza la obligatoriedad de la fk_caja';
    }

    public function up(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }

        $table = $schema->getTable('expediente');
        $table->changeColumn('fk_caja', [
            'default' => 0,
            'notnull' => false
        ]);

        $table->changeColumn('estado_archivo', [
            'default' => 0,
            'comment' => '0,Sin trd;1,Gestion;2,Central;3,Historico'
        ]);

        $table->changeColumn('tomo_padre', [
            'default' => 0,
            'notnull' => false
        ]);

        $table->changeColumn('tomo_no', [
            'default' => 1,
            'notnull' => false
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
