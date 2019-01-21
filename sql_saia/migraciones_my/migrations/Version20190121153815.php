<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190121153815 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Actualizacion encabezado estandar con borde';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update("encabezado_formato", ['contenido' => '<table align="center" border="1" cellspacing="0" style="border-collapse:collapse; width:100%">
	<tbody>
		<tr>
			<td style="border-color:#b6b8b7; text-align:center; width:30%">{*nombre_empresa*}</td>
			<td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:40%"><strong>{*nombre_formato*}</strong></td>
			<td style="border-color:#b6b8b7; text-align:center; vertical-align:middle; width:30%">{*logo_empresa*}</td>
		</tr>
	</tbody>
</table>
'], ["idencabezado_formato" => 1]);
        

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
