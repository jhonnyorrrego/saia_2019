<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181228154312 extends AbstractMigration
{
    private $campos_formato = array('idcampos_formato' => '7009','formato_idformato' => '3','nombre' => 'colilla','etiqueta' => 'Colilla','tipo_dato' => 'INT','longitud' => '11','obligatoriedad' => '1','valor' => '1,Vertical;2,Horizontal','acciones' => 'a,b','ayuda' => NULL,'predeterminado' => '1','banderas' => NULL,'etiqueta_html' => 'radio','orden' => '31','mascara' => NULL,'adicionales' => NULL,'autoguardado' => '0','fila_visible' => '1','placeholder' => NULL,'longitud_vis' => NULL,'opciones' => NULL,'estilo' => NULL);

    public function getDescription() {
        return 'Actualizar campo colilla radicacion de correspondencia';
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

        $conn->beginTransaction();

        $idcampos_formato = $this->guardar("campos_formato", $this->campos_formato);

        $conn->commit();
    }
    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
    private function guardar($tabla, $datos, $campo_nombre = "nombre", $idname = null) {
        $conn = $this->connection;

        if(empty($idname)) {
            $idname = "id$tabla";
        }

        $resp = $conn->insert($tabla, $datos);

         if (empty($resp)) {
            $conn->rollBack();
            print_r($conn->errorInfo());
            die("Fallo la creacion del $tabla");
         }
        $idreg = $conn->lastInsertId();

        return $idreg;
    }
}
