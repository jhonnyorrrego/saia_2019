<?php
namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180802181957 extends AbstractMigration {

    public function getDescription(): string {
        return 'Actualizar formato vincular_doc_expedie';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $conn = $this->connection;

        $result = $conn->fetchColumn("select idformato from formato where nombre=:nombre", [
            "nombre" => 'vincular_doc_expedie'
        ]);

        $this->skipIf(!$result, "No existe el formato 'vincular_doc_expedie'");

        $idformato = $result;

        $result = $conn->fetchColumn("select idcampos_formato from campos_formato where nombre=:nombre and formato_idformato = :idformato", [
            "nombre" => 'serie_idserie',
            "idformato" => $idformato
        ]);

        $this->skipIf(!$result, "No existe el campo 'serie_idserie' en el formato 'vincular_doc_expedie'");

        $idcampo_serie = $result;

        $result = $conn->fetchColumn("select idcampos_formato from campos_formato where nombre=:nombre and formato_idformato = :idformato", [
            "nombre" => 'fk_idexpediente',
            "idformato" => $idformato
        ]);

        $this->abortIf(!$result, "No existe el campo 'fk_idexpediente' en el formato 'vincular_doc_expedie'");

        $idcampo_expediente = $result;

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

        $result_ff = $conn->fetchColumn("select idfunciones_formato from funciones_formato where nombre=:nombre", [
            "nombre" => 'fk_idexpediente_funcion'
        ]);

        if ($result_ff) {
            $condicion_ffe = [
                "funciones_formato_fk" => $result_ff,
                "formato_idformato" => $idformato
            ];
            $conn->delete("funciones_formato_enlace", $condicion_ffe);
            $condicion_ff = [
                "idfunciones_formato" => $result_ff
            ];
            $conn->delete("funciones_formato", $condicion_ff);
        }

    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
