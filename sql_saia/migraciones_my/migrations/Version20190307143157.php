<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190307143157 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update('modulo', [
            'imagen' => 'fa fa-comments-o'
        ], [
            'nombre' => 'discutir_documento'
        ]);

        $this->addSql("delete from configuracion where tipo like '%tema%'");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
