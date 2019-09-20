<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190919133243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'etiqueta' => 'pruiebá'
        ], [
            'idmodulo' => 1
        ]);

        $tables = $schema->getTables();

        foreach ($tables as $Table) {
            $columnName = "id" . $Table->getName();
            if ($Table->hasColumn($columnName) && !$Table->hasPrimaryKey()) {
               /* $Table->changeColumn($columnName, [
                    'autoincrement' => true,
                    'length' => 11,
                    'notnull' => true
                ]);*/
                $Column = $Table->getColumn($columnName);
                $Table->setPrimaryKey([$columnName]);
                //$Type = Type::getType('integer');
                //$Column->settype($Type);
            }
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }


    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
