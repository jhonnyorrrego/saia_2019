<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190315214132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $conn = $this->connection;
        $resp = $conn->update('pantalla_componente', ['opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
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
      "fs_opciones": {
        "type": "array",
        "items": {
          "type": "object",
          "minLength": 1,
          "properties" : {
            "llave" : {
              "type" : "string",
              "hidden" : true,
              "default" : "a#w#e"
            },
            "item" : {
               "type" : "string",
               "required": true
            }
          }
        },
        "minItems": 1
      },
      "fs_acciones": {
        "type": "boolean"
      },
      "fs_obligatoriedad": {
        "type": "boolean"
      },
      "fs_ayuda": {
        "type": "string",
        "title": "Ayuda para el usuario"
      }
    }
  },
  "options": {
    "fields": {
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "toolbarSticky": true,
        "toolbarPosition": "top",
        "hideInitValidationError": true
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_acciones": {
        "type": "checkbox",
        "rightLabel": "Incluirse en la descripcion del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'], ["nombre" => "radio"]);

        $resp = $conn->update('pantalla_componente', ['opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
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
      "fs_opciones": {
        "type": "array",
        "items": {
          "type": "object",
          "minLength": 1,
          "properties" : {
            "llave" : {
              "type" : "string",
              "hidden" : true,
              "default" : "a#w#e"
            },
            "item" : {
               "type" : "string",
               "required": true
            }
          }
        },
        "minItems": 1
      },
      "fs_acciones": {
        "type": "boolean"
      },
      "fs_obligatoriedad": {
        "type": "boolean"
      },
      "fs_ayuda": {
        "type": "string",
        "title": "Ayuda para el usuario"
      }
    }
  },
  "options": {
    "fields": {
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "toolbarSticky": true,
        "toolbarPosition": "top",
        "hideInitValidationError": true
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_acciones": {
        "type": "checkbox",
        "rightLabel": "Incluirse en la descripcion del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'], ["nombre" => "checkbox"]);

        $resp = $conn->update('pantalla_componente', ['opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
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
      "fs_opciones": {
        "type": "array",
        "items": {
          "type": "object",
          "minLength": 1,
          "properties" : {
            "llave" : {
              "type" : "string",
              "hidden" : true,
              "default" : "a#w#e"
            },
            "item" : {
               "type" : "string",
               "required": true
            }
          }
        },
        "minItems": 1
      },
      "fs_acciones": {
        "type": "boolean"
      },
      "fs_obligatoriedad": {
        "type": "boolean"
      },
      "fs_ayuda": {
        "type": "string",
        "title": "Ayuda para el usuario"
      }
    }
  },
  "options": {
    "fields": {
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "toolbarSticky": true,
        "toolbarPosition": "top",
        "hideInitValidationError": true
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_acciones": {
        "type": "checkbox",
        "rightLabel": "Incluirse en la descripcion del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'], ["nombre" => "select"]);

        $resp = $conn->update('pantalla_componente', ['opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
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
      "fs_opciones": {
        "type": "object",
        "title": "",
        "properties": {
          "url": {
            "title": "Tipo",
            "type": "string",
            "required": true,
            "enum": [
              "0",
              "funcionario",
              "dependencia",
              "cargo"
            ]
          },
          "checkbox": {
            "type": "string",
            "title": "Selecci&#243;n",
            "enum": [
              "checkbox",
              "radio"
            ],
            "required": true
          }
        }
      },
      "fs_acciones": {
        "type": "boolean"
      },
      "fs_obligatoriedad": {
        "type": "boolean"
      },
      "fs_ayuda": {
        "type": "string",
        "title": "Ayuda para el usuario"
      },     
      "fs_arbol": {
        "type": "string"
      }
    }
  },
  "options": {
    "fields": {
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "fields": {
          "url": {
            "sort" : false,
            "optionLabels": [
             "Seleccione un tipo de arbol",
              "Funcionario",
              "Dependencia",
              "Cargo"
            ]
          },
          "checkbox": {
            "type": "radio",
            "vertical": false,
            "removeDefaultNone": true,
            "optionLabels": [
              "M&#250;ltiple",
              "Simple"
            ]
          }
        }
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_acciones": {
        "type": "checkbox",
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      },
      "fs_arbol": {
        "type": "hidden",
        "default": "arbol_seleccionv2"
      }
    }
  }
}', 'nombre' => 'Arbol de seleccion v2', 'clase' => 'fa fa-sitemap', 'componente' => '<li class="ui-state-default element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">{*clase_eliminar_pantalla_componente*}<span class="ui-icon ui-icon-arrowthick-2-n-s" style="font-size:12px;"><b>{*etiqueta*}{*obligatoriedad*}</b></span> </li>', 'opciones' => '{"nombre":"arbol_checkbox","etiqueta":"Arbol de seleccion v2","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"../../pantallas/lib/arbol_funcionarios.php;1;0;1;1;0;0","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"arbol","orden":2,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1}'], ["nombre" => "arbol_checkbox"]);

        $resp = $conn->update('pantalla_componente', ['opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
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
      "fs_opciones": {
        "type": "object",
        "title": "",
        "properties": {
          "url": {
            "title": "Tipo",
            "type": "string",
            "required": true,
            "enum": [
              "0",
              "funcionario",
              "dependencia",
              "cargo"
            ]
          },
          "checkbox": {
            "type": "string",
            "title": "Selecci&#243;n",
            "enum": [
              "checkbox",
              "radio"
            ],
            "required": true
          }
        }
      },
      "fs_acciones": {
        "type": "boolean"
      },
      "fs_obligatoriedad": {
        "type": "boolean"
      },
      "fs_ayuda": {
        "type": "string",
        "title": "Ayuda para el usuario"
      }
    }
  },
  "options": {
    "fields": {
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "fields": {
          "url": {
            "sort" : false,
            "optionLabels": [
             "Seleccione un tipo de arbol",
              "Funcionario",
              "Dependencia",
              "Cargo"
            ]
          },
          "checkbox": {
            "type": "radio",
            "vertical": false,
            "removeDefaultNone": true,
            "optionLabels": [
              "M&#250;ltiple",
              "Simple"
            ]
          }
        }
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_acciones": {
        "type": "checkbox",
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'], ["nombre" => "arbol_fancytree"]);


    }

    public function preUp(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
    public function preDown(Schema $schema): void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
