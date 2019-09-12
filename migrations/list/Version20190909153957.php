<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909153957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update(
            'campos_formato',
            [
                'tipo_dato' => 'datetime'
            ],
            ['tipo_dato' => 'DATETIME']
        );

        $this->connection->update(
            'campos_formato',
            [
                'tipo_dato' => 'date'
            ],
            ['tipo_dato' => 'DATE']
        );

        $this->connection->update(
            'campos_formato',
            [
                'tipo_dato' => 'text'
            ],
            ['tipo_dato' => 'TEXT']
        );

        $this->connection->update(
            'campos_formato',
            [
                'tipo_dato' => 'string'
            ],
            ['tipo_dato' => 'CHAR']
        );

        $this->connection->update(
            'campos_formato',
            [
                'tipo_dato' => 'float'
            ],
            ['tipo_dato' => 'DOUBLE']
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
