<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191009123623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adicionando columna ventanilla_radicacion de funcionario en la vista vfuncionario_dc, y eliminando funcion fecha_formato de varios formatos de nucleo';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("CREATE OR REPLACE VIEW vfuncionario_dc AS  select b.idfuncionario AS idfuncionario,b.funcionario_codigo AS funcionario_codigo,b.login AS login,b.nombres AS nombres,b.apellidos AS apellidos,b.firma AS firma,b.estado AS estado,b.fecha_ingreso AS fecha_ingreso,b.clave AS clave,b.nit AS nit,b.perfil AS perfil,b.debe_firmar AS debe_firmar,b.mensajeria AS mensajeria,b.email AS email,b.sistema AS sistema,b.tipo AS tipo,b.ultimo_pwd AS ultimo_pwd,b.direccion AS direccion,b.telefono AS telefono,b.ventanilla_radicacion AS ventanilla_radicacion,c.nombre AS cargo,c.idcargo AS idcargo,c.tipo_cargo AS tipo_cargo,c.estado AS estado_cargo,a.nombre AS dependencia,a.estado AS estado_dep,a.codigo AS codigo,a.tipo AS tipo_dep,a.iddependencia AS iddependencia,a.fecha_ingreso AS creacion_dep,a.cod_padre AS cod_padre,a.extension AS extension,a.ubicacion_dependencia AS ubicacion_dependencia,a.logo AS logo,d.iddependencia_cargo AS iddependencia_cargo,d.estado AS estado_dc,d.fecha_inicial AS fecha_inicial,d.fecha_final AS fecha_final,d.fecha_ingreso AS creacion_dc,d.tipo AS tipo_dc from dependencia a join funcionario b join cargo c join dependencia_cargo d where a.iddependencia = d.dependencia_iddependencia and b.idfuncionario = d.funcionario_idfuncionario and c.idcargo = d.cargo_idcargo");

        $this->connection->delete('funciones_formato', [
            'nombre' => '{*fecha_formato*}'
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 1
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 2
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 3
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 272
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 312
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 404
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 411
        ]);

        $this->connection->delete('funciones_formato_enlace', [
            'funciones_formato_fk' => 9,
            'formato_idformato' => 412
        ]);
    }

    public function down(Schema $schema): void
    { }
}
