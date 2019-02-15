<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190215194308 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
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
        "type": "object",
        "properties": {
          "tipos": {
            "type": "string",
            "title": "Tipos de archivo"
          },
          "longitud": {
            "type": "number",
            "title": "Tama&ntilde;o m&aacute;ximo de archivo (Mb)",
            "minimum": 1,
            "maximum": 20
          },
          "cantidad": {
            "type": "number",
            "title": "Cantidad de anexos",
            "required": true,
            "minimum": 1,
            "maximum": 10
          }
        }
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
          "longitud": {
            "inputType": "number",
            "data": {
              "min": 1,
              "max": 20
            }
          },
          "cantidad": {
            "inputType": "number",
            "data": {
              "min": 1,
              "max": 10
            }
          }
        }
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  },
  "data": {
    "fs_opciones": {
      "tipos": "pdf,doc,docx,jpg,jpeg,gif,png,bmp,xls,xlsx,ppt"
    }
  }
}'], ["nombre" => "archivo"]);

    }

    public function preUp(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }

    public function preDown(Schema $schema) : void
    {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }
}
