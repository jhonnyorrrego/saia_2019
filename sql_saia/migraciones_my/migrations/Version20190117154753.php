<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117154753 extends AbstractMigration {

    public function getDescription(): string {
        return 'Actualiza mostrar del formato ruta_distribucion';
    }

    public function up(Schema $schema): void {
        $this->connection->update("formato",
                ['cuerpo' => '<table class="table table-bordered" style="width: 100%;"><tbody><tr><td><strong>Fecha</strong></td><td>{*fecha_creacion*}&nbsp;</td><td style="text-align: center;" rowspan="2">&nbsp;{*mostrar_codigo_qr*} <br>Radicado: {*formato_numero*}</td></tr><tr><td><strong>Asunto</strong></td><td>{*asunto_documento*}</td></tr></table><br><table class="table table-bordered" style="width: 100%;"><tbody><tr>
    <td style="width:50%;"><strong>Fecha<strong></td>
    <td>{*fecha_ruta_distribuc*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Nombre de la Ruta<strong></td>
    <td>{*nombre_ruta*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Descripci&Oacute;n ruta<strong></td>
    <td>{*descripcion_ruta*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Dependencias de la Ruta<strong></td>
    <td>{*asignar_dependencias*}</td>
    </tr><tr>
    <td style="width:50%;"><strong>Mensajeros de la Ruta<strong></td>
    <td>{*asignar_mensajeros*}</td>
    </tr></tbody></table>'], ['idformato' => 404]);
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

}
