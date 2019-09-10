<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190906203611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('campos_formato', [
            'tipo_dato' => 'integer'
        ], [
            'tipo_dato' => 'INT'
        ]);

        $this->connection->update('campos_formato', [
            'tipo_dato' => 'string'
        ], [
            'tipo_dato' => 'varchar'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
