<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190823165309 extends AbstractMigration
{
    public function getDescription() : string
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

    public function up(Schema $schema) : void
    {
        $table = $schema->getTable('dependencia');
        if ($table->dropColumn('sigla')) {
            $table->addColumn('sigla', 'string', [
                'length' => 45,
                'notnull' => true
            ]);
        }

        if (!$schema->hasTable("dependencia_cargo_log")) {
            $table = $schema->createTable('dependencia_cargo_log');
            $table->addColumn('iddependencia_cargo_log', 'integer', [
                'autoincrement' => true,
                'length' => 11
            ]);
            $table->setPrimaryKey(['iddependencia_cargo_log']);

            $table->addColumn('fk_log', 'integer', [
                'notnull' => true,
                'length' => 11
            ]);

            $table->addColumn('fk_dependencia_cargo', 'integer', [
                'notnull' => true,
                'length' => 11
            ]);
        }

        $this->connection->update('formato', [
            'mostrar_pdf' => '0'
        ], [
            'idformato' => 404
        ]);

        $this->connection->update('busqueda_componente', [
            'ordenado_por' => 'a.fecha'
        ], [
            'idbusqueda_componente' => 280
        ]);

        $this->connection->update('busqueda_condicion', [
            'codigo_where' => 'lower(a.estado)=\'iniciado\' AND a.tipo_radicado=2 AND a.iddocumento=b.documento_iddocumento {*condicion_por_ingresar_ventanilla_distribucion*}'
        ], [
            'idbusqueda_condicion' => 222
        ]);

        $this->connection->update('formato', [
            'etiqueta' => 'Planilla de Distribuci&oacute;n'
        ], [
            'idformato' => 353
        ]);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
