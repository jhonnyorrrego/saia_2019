<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Type;


/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190308141713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }
    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('modulo', [
            'enlace' => 'views/documento/seguidores.php'
        ], [
            'nombre' => 'asignar_responsable'
        ]);

        if($schema->hasTable('documento_funcionario')){
            $schema->dropTable('documento_funcionario');
        }
        $table = $schema->createTable('documento_funcionario');
        $table->addColumn('iddocumento_funcionario', 'integer', [
            'autoincrement' => true,
            'length' => 11,
        ]);
        $table->addColumn('fk_funcionario', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fk_documento', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('tipo', 'integer', [
            'notnull' => true,
            'length' => 11
        ]);
        $table->addColumn('fecha', 'datetime', [
            'notnull' => true
        ]);
        $table->addColumn('estado', 'integer', [
            'notnull' => true,
            'length' => 1,
            'default' => 1
        ]);
        
        $table->setPrimaryKey(['iddocumento_funcionario']);

        $this->connection->executeQuery("update funcionario set ultimo_pwd=null");
        $this->connection->executeQuery("update funcionario set firma = ''");

        $table = $schema->getTable('funcionario');
        $table->changeColumn('firma', [
            "type" => Type::getType(Type::STRING)
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
