<?php
namespace Migrations;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181129143713 extends AbstractMigration {

    private $eliminar = array(
        "etiqueta",
        "arbol_checkbox",
        "date",
        "textarea_tiny"
    );

    private $texto_opciones = '{
  "schema": {
    "fs_etiqueta": {
      "type": "string",
      "title": "Etiqueta del campo",
      "maxLength": 255,
      "required": true
    },
    "fs_nombre": {
      "type": "string",
      "title": "Nombre",
      "maxLength": 255,
      "required": true
    },
    "fs_acciones": {
      "type": "string",
      "title": "Incluirse en la descripción del formato",
      "enum": [
        "",
        "p"
      ]
    },
    "fs_obligatoriedad": {
      "type": "string",
      "title": "Obligatoriedad",
      "enum": [
        "1",
        "0"
      ]
    },
    "fs_ayuda": {
      "type": "string",
      "title": "Ayuda para el usuario"
    }
  },
  "form": [
    {
      "key": "fs_nombre",
      "type": "hidden"
    },
    {
      "key": "fs_obligatoriedad",
      "type": "radios",
      "titleMap": {
        "0": "No obligatrio",
        "1": "Obligatorio"
      }
    },
    {
      "key": "fs_acciones",
      "type": "radios",
      "titleMap": {
        "": "No incluirse",
        "p": "Incluirse"
      }
    },
    {
      "key": "fs_ayuda",
      "type": "textarea"
    }
  ]
}';

    private $categorias = [
        "text" => "Texto",
        "radio" => "Selectores",
        "checkbox" => "Selectores",
        "textarea" => "Texto",
        "select" => "Selectores",
        "hidden" => "Texto",
        "datetime" => "Fecha y Hora",
        "etiqueta" => "Texto",
        "contador" => "Texto",
        "ejecutor" => "Terceros",
        "archivo" => "Adjuntos",
        "textarea_cke" => "Texto",
        "arbol_fancytree" => "&Aacute;rbol de Selecci&oacute;n"
    ];

    private $nuevos = [
        [
            "nombre" => "etiqueta_titulo",
            "etiqueta" => "T&iacute;tulo de secci&oacute;n",
            "clase" => "fa fa-header",
            "componente" => "{*procesar_etiqueta*}",
            "opciones" => "{\"nombre\":\"etiqueta_titulo\",\"etiqueta\":\"T&iacute;tulo de secci&oacute;n\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"etiqueta\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":1}",
            "procesar" => null,
            "categoria" => "Texto",
            "estado" => 1,
            "librerias" => null,
            "tipo_componente" => 1,
            "eliminar" => "",
            "etiqueta_html" => "etiqueta"
        ],
        [
            "nombre" => "etiqueta_parrafo",
            "etiqueta" => "Texto descriptivo",
            "clase" => "fa fa-paragraph",
            "componente" => "{*procesar_etiqueta*}",
            "opciones" => "{\"nombre\":\"etiqueta_parrafo\",\"etiqueta\":\"Texto descriptivo\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"etiqueta\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":1}",
            "procesar" => null,
            "categoria" => "Texto",
            "estado" => 1,
            "librerias" => null,
            "tipo_componente" => 1,
            "eliminar" => "",
            "etiqueta_html" => "etiqueta"
        ],
        [
            "nombre" => "etiqueta_linea",
            "etiqueta" => "L&iacute;nea de separaci&oacute;n",
            "clase" => "fa fa-arrows-h",
            "componente" => "{*procesar_etiqueta*}",
            "opciones" => "{\"nombre\":\"etiqueta_linea\",\"etiqueta\":\"L&iacute;nea de separaci&oacute;n\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"a\",\"etiqueta_html\":\"etiqueta\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":0,\"fila_visible\":1}",
            "procesar" => null,
            "categoria" => "Texto",
            "estado" => 1,
            "librerias" => null,
            "tipo_componente" => 1,
            "eliminar" => "",
            "etiqueta_html" => "etiqueta"
        ],
        [
            "nombre" => "moneda",
            "etiqueta" => "Moneda",
            "clase" => "fa fa-dollar",
            "componente" => "{*procesar_moneda*}",
            "opciones" => "{\"nombre\":\"moneda\",\"etiqueta\":\"Moneda\",\"tipo_dato\":\"varchar\",\"longitud\":\"255\",\"obligatoriedad\":0,\"valor\":\"\",\"acciones\":\"a,e,b\",\"ayuda\":\"\",\"predeterminado\":\"\",\"banderas\":\"\",\"etiqueta_html\":\"spin\",\"orden\":1,\"mascara\":\"\",\"adicionales\":\"\",\"autoguardado\":1,\"fila_visible\":1,\"placeholder\":\"\"}",
            "procesar" => null,
            "categoria" => "Texto",
            "estado" => 1,
            "librerias" => "",
            "tipo_componente" => 1,
            "eliminar" => "",
            "etiqueta_html" => "spin"
        ]

    ];

    public function getDescription() {
        return 'Modifica pantalla_componente y campos_formato para incluir nuevos componentes y configuraciones de los mismos';
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
        /*
         $table = $schema->getTable('mi_tabla');
         if ($table) {
             $table->changeColumn("serie_idserie", "integer", [
                 "length" => 11,
                 "default" => 0,
                 "notnull" => true
            ]);
         }
         */
        $table = $schema->getTable('campos_formato');
        if(!$table->hasColumn("longitud_vis")) {
        $table->addColumn("longitud_vis", "integer", [
            "length" => 11,
            "notnull" => false
            ]);
        }
        if(!$table->hasColumn("opciones")) {
            $table->addColumn("opciones", "string", [
            "length" => 4000,
            "notnull" => false
            ]);
        }
        if(!$table->hasColumn("estilo")) {
            $table->addColumn("estilo", "string", [
            "length" => 255,
            "notnull" => false
            ]);
        }
        $table = $schema->getTable('pantalla_componente');
        if(!$table->hasColumn("opciones_propias")) {
            $table->addColumn("opciones_propias", "text", [
                "notnull" => false
            ]);
        }

    }

    public function postUp(Schema $schema) {
        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $conn = $this->connection;
        foreach ($this->nuevos as $value) {
            $conn->insert("pantalla_componente", $value);
        }

        $sql = "update pantalla_componente set estado=0 where nombre IN (?)";
        $filtro = [
            $this->eliminar
        ];
        $result = $conn->executeUpdate($sql, $filtro, $types);

        $sql2 = "update campos_formato set opciones=valor, valor=null where valor like '{%' and valor not like '{*%'";
        $result = $conn->executeUpdate($sql2);

        $sql3 = "update campos_formato set longitud_vis=longitud where tipo_dato = :tipo";
        $result = $conn->executeUpdate($sql3, [
            "tipo" => "VARCHAR"
        ]);

        $sql4 = "update pantalla_componente set categoria=:cat where nombre not like :nombre and estado = :estado";
        $filtro4 = ["cat" => "Campos del formato", "nombre" => "etiqueta%", "estado" => 1];
        $result = $conn->executeUpdate($sql4, $filtro4);

        $sql5 = "update pantalla_componente set categoria=:cat where nombre like :nombre and estado = :estado";
        $filtro5 = ["cat" => "Elementos de dise&ntilde;o", "nombre" => "etiqueta%", "estado" => 1];
        $result = $conn->executeUpdate($sql5, $filtro5);

        $sql6 = "update pantalla_componente set opciones_propias = :opciones";
        $filtro6 = ["opciones" => $this->texto_opciones];
        $result = $conn->executeUpdate($sql6, $filtro6);
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
        $types = [
            Connection::PARAM_STR_ARRAY
        ];

        $conn = $this->connection;
        $sql = "update pantalla_componente set estado=1 where nombre IN (?)";
        $filtro = [
            $this->eliminar
        ];
        $stmt = $conn->executeUpdate($sql, $filtro, $types);

        $sql2 = "update campos_formato set valor=opciones where opciones like '{%'";
        $result = $conn->executeUpdate($sql2);

        foreach ($this->categorias as $key => $value) {
            $filtro = ["nombre" => $key];
            $conn->update("pantalla_componente", ["categoria" => $value], $filtro);
        }
    }

    public function postDown(Schema $schema) {
        // TODO: Eliminar los campos nuevos?
    }
}
