<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905224535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('busqueda_componente', [
            'info' => '[{"title":"Nombre","field":"{*nombre*}","align":"center"},{"title":"Version","field":"{*version*}","align":"center"},{"title":"Tipo de versi&oacute;n","field":"{*tipo*}","align":"center"},{"title":"Descripci&oacute;n","field":"{*descripcion*}","align":"center"},{"title":"opciones","field":"{*opciones@idserie_version,anexos*}","align":"center"}]',
        ], [
            'nombre' => 'versiones_trd'
        ]);
    }

    public function down(Schema $schema): void
    { }
}
