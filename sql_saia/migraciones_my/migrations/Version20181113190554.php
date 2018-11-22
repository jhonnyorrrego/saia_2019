<?php
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181113190554 extends AbstractMigration {

    public function getDescription() {
        return 'Nuevo editor de formatos: nuevos componentes';
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

        $datos = [
            [
                "nombre" => "textarea_cke",
                "etiqueta" => "&Aacute;rea de texto(con ck editor)",
                "clase" => "icon-cuadro_texto",
                "componente" => "{*procesar_textarea_cke*}",
                "opciones" => "{\"nombre\":\"textarea_cke\",\"etiqueta\":\"Area de texto\",\"tipo_dato\":\"text\",\"longitud\":\"\",\"obligatoriedad\":1,\"valor\":\"avanzado\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"textarea_cke\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Area de texto\"}",
                "procesar" => "",
                "categoria" => "Texto",
                "estado" => 1,
                "librerias" => "js/ckeditor/4.11/ckeditor_std/ckeditor.js@h",
                "tipo_componente" => 1,
                "eliminar" => "",
                "etiqueta_html" => "textarea_cke"
            ],
            [
                "nombre" => "arbol_fancytree",
                "etiqueta" => "Arbol Fancy",
                "clase" => "icon-checkbox",
                "componente" => "{*procesar_fancytree*}",
                "opciones" => "{\"nombre\":\"arbol_fancytree\",\"etiqueta\":\"Arbol Fancy\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":1,\"valor\":{\"url\":\"\",\"checkbox\":\"radio\",\"buscador\":\"0\",\"funcion_select\":\"\",\"funcion_click\":\"\",\"funcion_dobleclick\":\"\"},\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"arbol_fancytree\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"Arbol fancytree\"}",
                "procesar" => "",
                "categoria" => "Arbol",
                "estado" => 1,
                "librerias" => "js/jquery-ui/1.12.1/jquery-ui.js@h,js/jquery.fancytree/2.30.0/jquery.fancytree.min.js@h,js/jquery.fancytree/2.30.0/skin-lion/ui.fancytree.css",
                "tipo_componente" => 1,
                "eliminar" => "",
                "etiqueta_html" => "arbol_fancytree"
            ]
        ];
        foreach ($datos as $data) {
            $conn->insert("pantalla_componente", $data);
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

        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $sql = "select idpantalla_componente from pantalla_componente where nombre IN (?)";
        $filtro = [
            [
                "arbol_fancytree",
                "textarea_cke"
            ]
        ];
        $stmt = $conn->executeQuery($sql, $filtro, $types);
        $result = $stmt->fetchAll();

        if (!empty($result)) {
            foreach ($result as $row) {
                $ident = [
                    'idpantalla_componente' => $row["idpantalla_componente"]
                ];
                $resp = $conn->delete('pantalla_componente', $ident);
            }
        }
    }
}
