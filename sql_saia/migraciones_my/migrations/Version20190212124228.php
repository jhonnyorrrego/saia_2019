<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190212124228 extends AbstractMigration
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
        $this->addSql('truncate table log_accion');
        $this->addSql("insert into log_accion (idlog_accion,nombre,descripcion) values ('1','CREAR','crea un registro')");
        $this->addSql("insert into log_accion (idlog_accion,nombre,descripcion) values ('2','EDITAR','edita un registro')");
        $this->addSql("insert into log_accion (idlog_accion,nombre,descripcion) values ('3','BORRAR','elimina un registro')");

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
