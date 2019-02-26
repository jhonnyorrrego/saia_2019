<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226193839 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        $conn = $this->connection;
        $resp = $conn->update('pantalla_componente', ['componente' => '<li class="ui-state-default element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}"><span class="ui-icon ui-icon-arrowthick-2-n-s" style="font-size:12px;"><b>{*etiqueta*} {*obligatoriedad*}</b></span> {*clase_eliminar_pantalla_componente*}<div class="controls"><div id="{*nombre*}" class="input-append date">{*procesar_datetime*}<span style="height: 20px;" class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span></div></div></li>'], ["nombre" => "datetime"]);
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
          "tipo": {
            "type": "string",
            "title": "Selecci&#243;n",
            "required": true,
            "enum": [
              "multiple",
              "unico"
            ]
          },
          "adicional": {
            "title": "Informaci&#243;n adicional",
            "type": "string",
            "minItems": 1,
            "enum": [
              "cargo",
              "empresa",
              "direccion",
              "telefono",
              "email",
              "titulo",
              "ciudad"
            ]
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
          "tipo": {
            "type": "radio",
            "vertical": false,
            "removeDefaultNone": true,
            "optionLabels": [
              "M&#250;ltiple",
              "Simple"
            ]
          },
          "adicional": {
            "type": "checkbox",
            "sort": false,
            "optionLabels": [
              "Cargo",
              "Empresa",
              "Direcci&#243;n",
              "Tel&#233;fono",
              "Correo electr&#243;nico",
              "T&#237;tulo",
              "Ciudad"
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
}'], ["nombre" => "datetime"]);

    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
     public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
