<?php

declare (strict_types = 1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190620184649 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->insert('pantalla_grafico', [
            'nombre' => 'funcionario',
        ]);
        $query = $this->connection->fetchAll("select idpantalla_grafico from pantalla_grafico where nombre  = 'funcionario'");
        $this->connection->update('modulo', [
            'enlace' => 'views/graficos/dashboard.php?screen=' . $query[0]['idpantalla_grafico'],
            'pertenece_nucleo' => 1
        ], [
            'nombre' => 'funcionario'
        ]);

        $component = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre  = 'funcionario'");
        $this->connection->insert('grafico', [
            'fk_busqueda_componente' => $component[0]['idbusqueda_componente'],
            'fk_pantalla_grafico' => $query[0]['idpantalla_grafico'],
            'tipo' => 1,
            'configuracion' => "",
            'query' => 'select estado,count(*) from funcionario group by estado',
            'columna' => 'estado',
            'estado' => "1",
            'titulo_x' => 'Estados',
            'titulo_y' => 'Cantidad usuarios',
            'busqueda' => '',
            'nombre' => 'funcionario'
        ]);
    }

    public function down(Schema $schema): void
    {
        $this->connection->delete('pantalla_grafico', [
            'nombre' => 'funcionario',
        ]);

        $this->connection->delete('grafico', [
            'nombre' => 'funcionario',
        ]);
    }
}
