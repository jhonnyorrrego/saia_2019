<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190123153041 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $data = [
            "info" => "<table style='width: 100%;font-size:10px' class='' border='0px'><tbody><tr><td style='width:35%;'><strong>Nombres y Apellidos:</strong> <span style='color:#347BB8'><a style='cursor:pointer' class='kenlace_saia'enlace='funcionario.php?key={*idfuncionario*}' title='{*nombres*} {*apellidos*}' titulo='{*nombres*}{*apellidos*}'conector='iframe'> {*nombres*} {*apellidos*} </a> </span><br /><b>Identificaci&oacute;n:</b><span style='color:#347BB8'> {*nit*}</span><br /><br />{*barra_superior_funcionario@idfuncionario,nombres,apellidos*}</td><td style='width:15%;'><b>Login:</b><span style='color:#347BB8'>{*login*}</span></td><td style='width:20%;'><b>Perfil:</b><span style='color:#347BB8'>{*nombre_perfil@perfil*}</span></td><td style='width:15%;'><b>Estado:</b><span style='color:#347BB8'>{*estado_funcionario@estado*}</span></td></tr></tbody></table>"
        ];
        $condition = ['nombre' => 'funcionario'];
        $this->connection->update('busqueda_componente', $data, $condition);
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
