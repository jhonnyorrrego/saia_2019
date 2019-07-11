<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190711142346 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {

        $this->connection->insert('pantalla_grafico', [
            'nombre' => 'funcionario'
        ]);

        $busqueda_componente = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre='funcionario'");
        $pantalla = $this->connection->fetchAll("select idpantalla_grafico from pantalla_grafico where nombre='funcionario'");
        $this->connection->insert('grafico', [
            'fk_busqueda_componente' => $busqueda_componente[0]['idbusqueda_componente'],
            'fk_pantalla_grafico' => $pantalla[0]['idpantalla_grafico'],
            'nombre' => 'funcionario',
            'tipo' => '1',
            'estado' => '1',
            'query' => 'select estado,count(*) from funcionario group by estado',
            'modelo' => 'Funcionario',
            'columna' => 'estado',
            'titulo_x' => 'Estados',
            'titulo_y' => 'Cantidad usuarios',
            'busqueda' => 'views/funcionario/busqueda_avanzada.php',
            'titulo' => 'Estado de los funcionarios'
        ]);

        $this->connection->insert('grafico', [
            'fk_pantalla_grafico' => $pantalla[0]['idpantalla_grafico'],
            'nombre' => 'estado_tareas',
            'tipo' => '2',
            'estado' => '1',
            'query' => 'SELECT b.valor,COUNT(*) FROM tarea a JOIN tarea_estado b ON a.idtarea = b.fk_tarea JOIN tarea_funcionario c ON a.idtarea = c.fk_tarea WHERE b.estado = 1 AND c.estado = 1 AND c.fk_funcionario = {*code_logged_user*} AND c.tipo = 1 GROUP BY b.valor',
            'modelo' => 'TareaEstado',
            'columna' => 'estado',
            'titulo_x' => 'Estados',
            'titulo_y' => 'Cantidad de tareas',
            'librerias' => 'pantallas/documento/librerias.php',
            'titulo' => 'Estados de las tareas'
        ]);

        $this->connection->update('modulo', [
            'enlace' => 'views/dashboard/kaiten_dashboard.php?panels=[{"kConnector": "iframe","url": "views/buzones/listado_componentes.php?searchId=138"},{"kConnector": "iframe","url": "views/graficos/dashboard.php?screen=' . $pantalla[0]['idpantalla_grafico'] . '", "kTitle": "Indicadores"}]'
        ], [
            'nombre' => 'funcionario'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
