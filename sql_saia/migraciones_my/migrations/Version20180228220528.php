<?php
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180228220528 extends AbstractMigration {

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');

        if (!$schema->hasTable("funciones_formato_enlace")) {
            $table = $schema->createTable("funciones_formato_enlace");
            $table->addColumn("idfunciones_formato_enlace", "integer", [
                "length" => 11,
                "notnull" => false,
                'autoincrement' => true
            ]);
            $table->addColumn("funciones_formato_fk", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->addColumn("formato_idformato", "integer", [
                "length" => 11,
                "notnull" => false
            ]);
            $table->setPrimaryKey([
                "idfunciones_formato_enlace"
            ]);
        }
    }

    public function postUp(Schema $schema): void {
        $conn = $this->connection;

        $funciones = $conn->fetchAll("select idfunciones_formato, formato from funciones_formato", []);

        if (!empty($funciones)) {

            $conn->beginTransaction();

            $formato_array = array();

            $total = count($funciones);
            for ($i = 0; $i < $total; $i++) {
                $lista_formatos = explode(",", $funciones[$i]["formato"]);
                $lista_formatos = array_unique($lista_formatos);

                $sql = "select * from formato where idformato in (?)";
                $values = [
                    $lista_formatos
                ];
                $types = [
                    Connection::PARAM_INT_ARRAY
                ];
                $stmt = $conn->executeQuery($sql, $values, $types);
                $formato = $stmt->fetchAll();

                $total_fmt = 0;
                if (!empty($formato)) {
                    $total_fmt = count($formato);
                    for ($j = 0; $j < $total_fmt; $j++) {
                        $datos_ff = [
                            'funciones_formato_fk' => $funciones[$i]["idfunciones_formato"],
                            'formato_idformato' => $formato[$j]["idformato"]
                        ];

                        $resp = $conn->insert('funciones_formato_enlace', $datos_ff);
                        $id_ff = $conn->lastInsertId();

                        array_push($formato_array, $formato[$j]["idformato"]);
                    }
                } else {
                    if (count($lista_formatos) == 1) {
                        $ident = [
                            'idfunciones_formato' => $funciones[$i]["idfunciones_formato"]
                        ];
                        $resp = $conn->delete('funciones_formato', $ident);
                    }
                    foreach ($lista_formatos as $key => $valor) {
                        $campos_formato = $conn->fetchAll("select idcampos_formato from campos_formato where formato_idformato = :idformato", [
                            'idformato' => $valor
                        ]);

                        if (!empty($campos_formato["numcampos"])) {
                            $ident = [
                                'formato_idformato' => $valor
                            ];
                            $resp = $conn->delete('campos_formato', $ident);
                        }
                    }
                }
            }

            if ($total_fmt != count($lista_formatos)) {
                $diff = array_diff($formato_array, $lista_formatos);
                if (count($diff)) {
                    echo ("Existe inconsistencia con los formatos " . print_r($diff, true) . "\n");
                }
            }

            $conn->commit();
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        date_default_timezone_set("America/Bogota");
        $this->platform->registerDoctrineTypeMapping('enum', 'string');
        $schema->dropTable('funciones_formato_enlace');
    }
}
