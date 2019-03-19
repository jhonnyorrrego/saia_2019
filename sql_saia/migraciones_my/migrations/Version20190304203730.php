<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190304203730 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualizacion arbols de funcionario correspondencia';
    }

    public function up(Schema $schema) : void
    {
        $conn = $this->connection;
        $resp = $conn->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php?idcampofun=1","checkbox":"radio"}',
            'etiqueta_html' => 'arbol_fancytree'
        ], ["idcampos_formato" => "43"]);
        $resp = $conn->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php?idcampofun=1","checkbox":"checkbox"}',
            'etiqueta_html' => 'arbol_fancytree'
        ], ["idcampos_formato" => "44"]);
        $resp = $conn->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php?idcampofun=1","checkbox":"checkbox"}',
            'etiqueta_html' => 'arbol_fancytree'
        ], ["idcampos_formato" => "4967"]);

    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
