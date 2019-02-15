<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215160342 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) : void
    {
        if($schema->hasTable('anexos')){
            if($schema->dropTable('anexos')){
                $schema->createTable('anexos');

                $anexos = $schema->getTable('anexos');
                $anexos->addColumn('idanexos', 'integer', [
                    'length' => 11,
                    'autoincrement' => true
                ]);
                $anexos->setPrimaryKey(['idanexos']);
                $anexos->addColumn('documento_iddocumento', 'integer', [
                    'length' => 11,
                    'notnull' => true
                ]);
                $anexos->addColumn('campos_formato', 'integer', [
                    'length' => 11,
                    'notnull' => false
                ]);
                $anexos->addColumn('idbinario', 'integer', [
                    'length' => 11,
                    'notnull' => false
                ]);
                $anexos->addColumn('formato', 'integer', [
                    'length' => 11,
                    'notnull' => false
                ]);
                $anexos->addColumn('fk_funcionario', 'integer', [
                    'length' => 11,
                    'notnull' => false
                ]);
                $anexos->addColumn('fk_anexos', 'integer', [
                    'length' => 11,
                    'default' => 0
                ]);

                $anexos->addColumn('ruta', 'string', [
                    'length' => 200,
                    'notnull' => true
                ]);
                $anexos->addColumn('etiqueta', 'string', [
                    'length' => 50,
                    'notnull' => true
                ]);
                $anexos->addColumn('tipo', 'string', [
                    'length' => 10,
                    'notnull' => true
                ]);
                $anexos->addColumn('fecha_anexo', 'datetime', [
                    'notnull' => false
                ]);
                $anexos->addColumn('fecha', 'datetime', [
                    'notnull' => false
                ]);
                $anexos->addColumn('estado', 'integer', [
                    'length' => 1,
                    'notnull' => true,
                    'default' => 1
                ]);
                $anexos->addColumn('version', 'integer', [
                    'length' => 11,
                    'notnull' => true,
                    'default' => 1
                ]);
                $anexos->addColumn('descripcion', 'string', [
                    'length' => 500
                ]);
                $anexos->addColumn('eliminado', 'integer', [
                    'length' => 1,
                    'notnull' => true,
                    'default' => 0
                ]);
            }
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
