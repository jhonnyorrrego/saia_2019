<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190128195516 extends AbstractMigration {

    public function getDescription(): string {
        return 'Actualizacion mostrar de radicacion de entrada y nombre de perfiles';
    }

    public function up(Schema $schema): void {
        $data = [
            'cuerpo' => '<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td class="encabezado_list" style="text-align: left; width: 30%;">Fecha</td>
<td>{*fecha_documento*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Mensajero</td>
<td>{*nombre_mensajero*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Estado</td>
<td>{*nivel_urgencia*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Destino</td>
<td>{*destino*}</td>
</tr>
<tr>
<td class="encabezado_list" style="text-align: left;">Observaciones</td>
<td>{*observaciones*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>'
        ];
        $condition = ['idformato' => '272'];
        $this->connection->update('formato', $data, $condition);

        $data = [
            'cuerpo' => '<table class="table table-bordered" style="width: 100%;" border="1">
<tbody>
<tr>
<td>FECHA DE NOVEDAD:</td>
<td>{*fecha_novedad*}</td>
</tr>
<tr>
<td>ITEMS DE PLANILLA:</td>
<td>{*mostrar_numero_item_novedad*}</td>
</tr>
<tr>
<td>NOVEDAD:</td>
<td>{*novedad*}</td>
</tr>
<tr>
<td>OBSERVACIONES:</td>
<td>{*observaciones*}</td>
</tr>
<tr>
<td>ANEXOS / SOPORTE DE ENTREGA:</td>
<td>{*mostrar_novedad_despacho_anexo_soporte*}</td>
</tr>
</tbody>
</table>
<p>{*mostrar_estado_proceso*}</p>'
        ];
        $condition = ['idformato' => '411'];
        $this->connection->update('formato', $data, $condition);

        $data = [
            'nombre' => 'Gestor de Correspondencia'
        ];
        $condition = ['idperfil' => '10'];
        $this->connection->update('perfil', $data, $condition);
    }

    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }

}