<?php

declare (strict_types = 1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190613155149 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->executeQuery("update funcionario set foto_original='', foto_recorte=''");
        $this->connection->update('busqueda_componente', [
            'campos_adicionales' => 'nombres,apellidos,login,nit,perfil,estado,foto_recorte,foto_original',
            'info' => "Foto|{*get_image@foto_original,foto_recorte,idfuncionario,nombres,apellidos*}|center|-|Nombre|{*get_name@idfuncionario,nombres,apellidos*}|center|-|Identificacion|{*nit*}|center|-|Login|{*login*}|center|-|Perfil|{*get_profile@perfil*}|center|-|Estado|{*get_state@estado*}|center|-|Opciones|{*options_button@idfuncionario*}|center"
        ], [
            'nombre' => 'funcionario'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
