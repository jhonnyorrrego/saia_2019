<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180802181957 extends AbstractMigration {

    public function getDescription() {
        return 'Actualizar formato vincular_doc_expedie';
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
        $conn = $this->connection;

        $result = $conn->fetchAll("select idformato from formato where nombre=:nombre", [
            "nombre" => 'vincular_doc_expedie'
        ]);

        $this->abortIf(!$result, "No existe el formato 'vincular_doc_expedie'");

        $idformato = $result[0]["idformato"];

        $result = $conn->fetchAll("select idcampos_formato from campos_formato where nombre=:nombre and formato_idformato = :idformato", [
            "nombre" => 'serie_idserie',
            "idformato" => $idformato
        ]);

        $this->abortIf(!$result, "No existe el campo 'serie_idserie' en el formato 'vincular_doc_expedie'");

        $idcampo_serie = $result[0]["idcampos_formato"];

        $result = $conn->fetchAll("select idcampos_formato from campos_formato where nombre=:nombre and formato_idformato = :idformato", [
            "nombre" => 'fk_idexpediente',
            "idformato" => $idformato
        ]);

        $this->abortIf(!$result, "No existe el campo 'fk_idexpediente' en el formato 'vincular_doc_expedie'");

        $idcampo_expediente = $result[0]["fk_idexpediente"];

        // var_dump($result);

        $datos_campo1 = [
            "etiqueta" => 'Expediente vinculado',
            "valor" => "../../test/test_expediente_funcionario.php;2;0;1;1;0;1"
        ];
        $condicion1 = [
            "formato_idformato" => $idformato,
            "idcampos_formato" => $idcampo_serie
        ];
        $conn->update("campos_formato", $datos_campo1, $condicion1);

        $datos_campo2 = [
            "valor" => null,
            "etiqueta_html" => "hidden"
        ];
        $condicion2 = [
            "formato_idformato" => $idformato,
            "idcampos_formato" => $idcampo_expediente
        ];
        $conn->update("campos_formato", $datos_campo2, $condicion2);

        $result_ff = $conn->fetchAll("select idfunciones_formato from funciones_formato where nombre=:nombre", [
            "nombre" => 'fk_idexpediente_funcion'
        ]);

        if ($result_ff) {
            $condicion_ffe = [
                "funciones_formato_fk" => $result_ff[0]["idfunciones_formato"],
                "formato_idformato" => $idformato
            ];
            $conn->delete("funciones_formato_enlace", $condicion_ffe);
            $condicion_ff = [
                "idfunciones_formato" => $result_ff[0]["idfunciones_formato"]
            ];
            $conn->delete("funciones_formato", $condicion_ff);
        }

    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
