<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191010151516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->connection->update('categoria_formato', [
            'nombre' => 'Trámites generales'
        ], [
            'idcategoria_formato' => 3
        ]);

        $component = $this->connection->fetchAll("select idbusqueda_componente from busqueda_componente where nombre='usuarios_conectados_concurrentes'");
        $this->connection->update('modulo', [
            'enlace' => "views/buzones/grilla.php?idbusqueda_componente={$component[0]['idbusqueda_componente']}"
        ], [
            'nombre' => 'reporte_usuarios_concurrentes'
        ]);

        $this->addSql("create or replace VIEW vusuarios_concurrentes AS select f.funcionario_codigo AS funcionario_codigo,f.nit AS nit,concat(f.nombres,' ',f.apellidos) AS nombre_completo,f.login AS login,count(l.login) AS cant_conexiones from (log_acceso l join funcionario f on(f.login = l.login)) where f.login not in ('cerok','mensajero','radicador_web','radicador_salida') and l.exito = 1 and l.fecha_cierre is null group by f.funcionario_codigo,f.nit,f.nombres,f.apellidos,f.login");

        $this->connection->delete('modulo', [
            'nombre' => 'anulaciones'
        ]);

        $this->connection->delete('modulo', [
            'nombre' => 'activar_documento'
        ]);

        $this->connection->delete('modulo', [
            'nombre' => 'terminar_actividad_paso_manual'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
