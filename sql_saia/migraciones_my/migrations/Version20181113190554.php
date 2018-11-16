<?php
namespace Migrations;

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
        $this->addSql("");

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
                "librerias" => "js\/ckeditor\/4.11\/ckeditor_std\/ckeditor.js@h",
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
                "librerias" => "js\/jquery.fancytree\/2.30.0\/jquery.fancytree.min.js@h,js\/jquery.fancytree\/2.30.0\/skin-lion\/ui.fancytree.css",
                "tipo_componente" => 1,
                "eliminar" => "",
                "etiqueta_html" => "arbol_fancytree"
            ]
        ];
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
        // this down() migration is auto-generated, please modify it to your needs
    }
}
