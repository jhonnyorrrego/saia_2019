<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009222257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $info = <<<JSON
    [{"title":"Foto","field":"{*get_image@foto_original,foto_recorte,idfuncionario,nombres,apellidos*}","align":"center"},{"title":"Nombre","field":"{*get_name@idfuncionario,nombres,apellidos*}","align":"center"},{"title":"Identificación","field":"{*nit*}","align":"center"},{"title":"Login","field":"{*login*}","align":"center"},{"title":"Perfil","field":"{*get_profile@perfil*}","align":"center"},{"title":"Estado","field":"{*get_state@estado*}","align":"center"},{"title":"Opciones","field":"{*options_button@idfuncionario*}","align":"center"}]
JSON;
        $this->connection->update('busqueda_componente', [
            'info' => $info
        ], [
            'nombre' => 'funcionario'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
