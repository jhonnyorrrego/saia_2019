<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Types\Type;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190302013627 extends AbstractMigration
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

        $table = $schema->getTable('modulo');
        $table->changeColumn('tipo', [
            'notnull' => false,
            "type" => Type::getType(Type::INTEGER)
        ]);
    }

    public function up(Schema $schema): void
    {
        $table = $schema->getTable('modulo');
        $table->changeColumn('tipo', [
            'notnull' => false,
            "type" => Type::getType(Type::INTEGER)
        ]);

        $this->connection->update('modulo', [
            'nombre' => 'tema_saia',
            'etiqueta' => 'Tema saia',
            'enlace' => 'views/configuracion/cambio_tema.php'
        ], [
            'nombre' => 'temas_saia'
        ]);

        $this->connection->update('modulo', [
            'tipo' => 0
        ], [
            'tipo' => 'grouper'
        ]);

        $this->connection->update('modulo', [
            'tipo' => 3
        ], [
            'tipo' => 'secundario'
        ]);

        $record = $this->connection->fetchAll("select idbusqueda from busqueda where nombre='temas_saia'");

        if($record[0]['idbusqueda']){

            $this->addSql('delete from busqueda where idbusqueda = ' . $record[0]['idbusqueda']);
            $this->addSql('delete from busqueda_componente where busqueda_idbusqueda = ' . $record[0]['idbusqueda']);
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
