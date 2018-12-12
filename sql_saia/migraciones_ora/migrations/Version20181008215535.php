<?php
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181008215535 extends AbstractMigration {

    const VALORES = [
        "oracle" => [
            "busqueda" => [
                "reporte_tareas_cierre_dia" => "(a.nombres || ' ' || a.apellidos) as nombre_funcionario",
                "reporte_acceso_usuarios" => "F.nit AS documento, (nombres || '  ' || apellidos) AS nombre,F.email AS correo,F.login"
            ],
            "busqueda_componente" => [
                "reporte_estado_tareas_funcionario" => "(a.nombres || ' ' || a.apellidos) as nombre_funcionario,a.idfuncionario, c.macro_proceso, b.listado_tareas_fk"
            ],
            "busqueda_condicion" => [
                "funcionario" => "(',' || f.perfil || ',') like ('%,' || p.idperfil || ',%') {*where_funcionario*}"
            ]
        ]
    ];

    public function getDescription() {
        return 'Ajustes funcionamiento varios motores';
    }

    public function preUp(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema) {
        $motor = $this->connection->getDatabasePlatform()->getName();
        echo "Motor: $motor", PHP_EOL;
        $this->abortIf($motor != "oracle", "El motor debe ser oracle");
        $conn = $this->connection;

        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $result_b1 = $conn->fetchAll("select idbusqueda, nombre, campos from busqueda where nombre IN (?)", [[
            "reporte_tareas_cierre_dia",
            "reporte_acceso_usuarios"
        ]], $types);

        if (!empty($result_b1)) {
            $tabla = "busqueda";
            foreach ($result_b1 as $fila) {
                $idbusq = empty($fila["idbusqueda"]) ? $fila["IDBUSQUEDA"] : $fila["idbusqueda"];
                $nombre = empty($fila["nombre"]) ? $fila["NOMBRE"] : $fila["nombre"];
                $upd = $this->cadena_sql_motor($motor, $tabla, $nombre);

                if($upd) {
                    $datos_busq = [
                        'campos' => $upd,
                    ];
                    $ident_busq = [
                        'idbusqueda' => $idbusq
                    ];
                    $resp = $conn->update($tabla, $datos_busq, $ident_busq);

                }

            }
        }

        $result_c1 = $conn->fetchAll("select idbusqueda_componente, nombre, campos_adicionales from busqueda_componente where nombre = :nombre", [
            'nombre' => "reporte_estado_tareas_funcionario"
        ]);

        if (!empty($result_c1)) {
            $tabla = "busqueda_componente";
            foreach ($result_c1 as $fila) {
                $idbusq = empty($fila["idbusqueda_componente"]) ? $fila["IDBUSQUEDA_COMPONENTE"] : $fila["idbusqueda_componente"];
                $nombre = empty($fila["nombre"]) ? $fila["NOMBRE"] : $fila["nombre"];
                $upd = $this->cadena_sql_motor($motor, $tabla, $nombre);

                if($upd) {
                    $datos_comp = [
                        'campos_adicionales' => $upd,
                    ];
                    $ident_comp = [
                        'idbusqueda_componente' => $idbusq
                    ];
                    $resp = $conn->update($tabla, $datos_comp, $ident_comp);
                }
            }
        }

        $result_w1 = $conn->fetchAll("select b.idbusqueda_condicion, c.nombre, b.codigo_where from busqueda_condicion b join busqueda_componente c on b.fk_busqueda_componente = c.idbusqueda_componente where c.nombre = :nombre", [
            'nombre' => "funcionario"
        ]);

        if (!empty($result_w1)) {
            $tabla = "busqueda_condicion";
            foreach ($result_w1 as $fila) {
                $idcond = empty($fila["idbusqueda_condicion"]) ? $fila["IDBUSQUEDA_CONDICION"] : $fila["idbusqueda_condicion"];
                $nombre = empty($fila["nombre"]) ? $fila["NOMBRE"] : $fila["nombre"];
                $upd = $this->cadena_sql_motor($motor, $tabla, $nombre);

                if($upd) {
                    $datos_cond = [
                        'codigo_where' => $upd,
                    ];
                    $ident_cond = [
                        'idbusqueda_condicion' => $idcond
                    ];
                    $resp = $conn->update($tabla, $datos_cond, $ident_cond);

                }
            }
        }
    }

    /**
     * Reemplaza concat acorde al motor
     *
     * @return string
     */
    private function cadena_sql_motor($motor, $tabla, $nombre) {
        $resp = false;
        if ($motor == "oracle") {
            $resp = self::VALORES[$motor][$tabla][$nombre];
        }
        return $resp;
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
