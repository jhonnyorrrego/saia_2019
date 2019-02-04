<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190204214750 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function up(Schema $schema) : void
    {
        $componente1 = [
            'contenido' => '<table align="center" border="0" cellspacing="0" style="border-collapse:collapse; width:100%">
    <tbody>
        <tr>
            <td style="border-color:#b6b8b7; text-align:left; vertical-align:middle; width:30%">
            <p>{*logo_empresa*}</p>

            <p><strong>{*nombre_empresa*}</strong>&nbsp;</p>

            <p>Tel&eacute;fono: xxx</p>
            </td>
            <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:50%">&nbsp;</td>
            <td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:20%">
            <p>&nbsp;</p>

            <p style="margin-left:20px"><strong>{*nombre_formato*}</strong></p>

            <p>&nbsp;</p>
            </td>
        </tr>
    </tbody>
</table>
',
            'etiqueta' => 'encabezado radicacion'
        ];

        $this->connection->insert('encabezado_formato', $componente1);

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
