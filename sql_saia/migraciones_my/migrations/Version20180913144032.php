<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180913144032 extends AbstractMigration {

    public function getDescription() {
        return 'Actualizacion de campos en bdd Req 20620';
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
        if ($schema->hasTable("expediente")) {
            $table = $schema->getTable("expediente");
            $table->getColumn("ver_todos")->setDefault(0);
            $table->getColumn("editar_todos")->setDefault(0);
        }

        $conn = $this->connection;
        $result = $conn->fetchAll("select idformato from formato where nombre = :nombre", [
            "nombre" => "vincular_doc_expedie"
        ]);

        if (!empty($result)) {
            $idfmt = $result[0]["idformato"];

            $this->actualizar_campo($schema, $idfmt);

            $this->actualizar_funcion($schema, $idfmt);
        }
    }

    private function actualizar_campo(Schema $schema, $idfmt) {
        $conn = $this->connection;
        $result = $conn->fetchAll("select idcampos_formato from campos_formato where formato_idformato = :formato_idformato AND nombre = :nombre", [
            "formato_idformato" => $idfmt,
            "nombre" => "fk_idexpediente"
        ]);

        if (!empty($result)) {
            $this->addSql("UPDATE campos_formato SET valor= :valor, etiqueta_html= :etiqueta WHERE idcampos_formato= :id",
                ["valor" => null, "etiqueta_html" => "hidden", "id" => $result[0]["idcampos_formato"]]);

            /*$datos = [
                'valor' => null,
                'etiqueta_html' => "hidden"
            ];
            $ident = [
                'idcampos_formato' => $result[0]["idcampos_formato"]
            ];

            $resp = $conn->update('campos_formato', $datos, $ident);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la modificacion del campo_formato");
            }*/
        }

    }

    private function actualizar_funcion(Schema $schema, $idfmt) {
        $conn = $this->connection;

        $result = $conn->fetchAll("select idfunciones_formato from funciones_formato where nombre_funcion = :nombre_funcion", [
            "nombre_funcion" => "fk_idexpediente_funcion"
        ]);

        if (!empty($result)) {

            $this->addSql("DELETE funciones_formato_enlace WHERE funciones_formato_fk= :fk AND formato_idformato= :id", ["fk" => $result[0]["idfunciones_formato"], "id" => $idfmt]);
            /*$ident = [
                'funciones_formato_fk' => $result[0]["idfunciones_formato"],
                "formato_idformato" => $idfmt
            ];

            $resp = $conn->delete('funciones_formato_enlace', $ident);

            if (empty($resp)) {
                $conn->rollBack();
                print_r($conn->errorInfo());
                die("Fallo la eliminacion de la funcion para el formato");
            }*/
        }

    }

    public function preDown(Schema $schema) {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        $conn = $this->connection;
        $result = $conn->fetchAll("select idformato from formato where nombre = :nombre", [
            "nombre" => "vincular_doc_expedie"
        ]);

        if (!empty($result)) {
            $idfmt = $result[0]["idformato"];

            $result = $conn->fetchAll("select idcampos_formato from campos_formato where formato_idformato = :formato_idformato AND nombre = :nombre", [
                "formato_idformato" => $idfmt,
                "nombre" => "fk_idexpediente"
            ]);

            if (!empty($result)) {
                $conn->beginTransaction();

                $datos = [
                    'valor' => "{*fk_idexpediente_funcion*}",
                    'etiqueta_html' => "text"
                ];
                $ident = [
                    'idcampos_formato' => $result[0]["idcampos_formato"]
                ];

                $resp = $conn->update('campos_formato', $datos, $ident);

                if (empty($resp)) {
                    $conn->rollBack();
                    print_r($conn->errorInfo());
                    die("Fallo la modificacion del campo_formato");
                }
                $conn->commit();
            }
        }
    }
}