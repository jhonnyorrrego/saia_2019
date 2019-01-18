<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190117164717 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $this->connection->update("busqueda_componente", ["info" => '<table style=\"width: 100%;font-size:10px\" class=\"\" border=\"0px\">\n    <tbody>\n        <tr>\n            <td style=\"width:35%;\">\n                <strong>Nombres y Apellidos:</strong> <span style=\"color:#347BB8\"><a style=\"cursor:pointer\" class=\"kenlace_saia\"\n                        enlace=\"funcionario.php?key={*idfuncionario*}\" title=\"{*nombres*} {*apellidos*}\" titulo=\"{*nombres*} {*apellidos*}\"\n                        conector=\"iframe\"> {*nombres*} {*apellidos*} </a> </span>\n                <br />\n                <b>Identificaci&oacute;n:</b> <span style=\"color:#347BB8\"> {*nit*}</span>\n                <br />\n                <br />\n                {*barra_superior_funcionario@idfuncionario,nombres,apellidos*}\n            </td>\n            <td style=\"width:15%;\">\n                <b>Login:</b> <span style=\"color:#347BB8\">{*login*}</span>\n            </td>\n            <td style=\"width:20%;\">\n                <b>Perfil:</b> <span style=\"color:#347BB8\">{*nombre_perfil@perfil*}</span>\n            </td>\n            <td style=\"width:15%;\">\n                <b>Estado:</b> <span style=\"color:#347BB8\">{*estado_funcionario@estado*}</span>\n            </td>\n        </tr>\n    </tbody>\n</table>'], ["idbusqueda_componente" => 3]);
        $this->connection->update("busqueda_componente", [
            "ordenado_por" => 'a.idtransferencia',
            "direccion" => "DESC"
        ], ["idbusqueda_componente" => 7]);
        $this->addSql('update funcionario set funcionario_codigo = idfuncionario where idfuncionario>0');
        $this->addSql("ALTER TABLE funcionario CHANGE COLUMN funcionario_codigo funcionario_codigo INT(20) NULL DEFAULT 0");
        $this->addSql("ALTER TABLE nota_funcionario DROP COLUMN nombre");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
