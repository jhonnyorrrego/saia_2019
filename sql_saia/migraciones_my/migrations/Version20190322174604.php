<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190322174604 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualizacion campos radio correspondencia';
    }

    public function up(Schema $schema) : void
    {

        $this->connection->update('modulo', [
            'valor' => '1,Vertical;2,Horizontal',
            'opciones' => '[{"llave":1,"item":"VERTICAL"},{"llave":2,"item":"HORIZONTAL"}]'
        ], [
            'idcampos_formato' => '7009'
        ]);
        $this->connection->update('modulo', [
            'valor' => '1,Si;0,No',
            'opciones' => '[{"llave":1,"item":"SI"},{"llave":0,"item":"NO"}]'
        ], [
            'idcampos_formato' => '5199'
        ]);
        $this->connection->update('modulo', [
            'valor' => '1,Si;3,No',
            'opciones' => '[{"llave":1,"item":"SI"},{"llave":3,"item":"NO"}]'
        ], [
            'idcampos_formato' => '4970'
        ]);
        $this->connection->update('modulo', [
            'valor' => '1,EXTERNO;2,INTERNO',
            'opciones' => '[{"llave":1,"item":"EXTERNO"},{"llave":2,"item":"INTERNO"}]'
        ], [
            'idcampos_formato' => '4968'
        ]);
        $this->connection->update('modulo', [
            'valor' => '1,Array;2,Array',
            'opciones' => '[{"llave":1,"item":"EXTERNO"},{"llave":2,"item":"INTERNO"}]'
        ], [
            'idcampos_formato' => '4966'
        ]);


    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
