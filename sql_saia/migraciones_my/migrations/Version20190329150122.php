<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190329150122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Actualizacion arboles de roles';
    }

    public function up(Schema $schema): void
    {

        $this->connection->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php","checkbox":"checkbox"}',
            'opciones' => '{"url":"3ol","checkbox":"checkbox"}'
        ], [
            'idcampos_formato' => '43'
        ]);
        $this->connection->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php","checkbox":"checkbox"}',
            'opciones' => '{"url":"2ol","checkbox":"checkbox"}'
        ], [
            'idcampos_formato' => '44'
        ]);
        $this->connection->update('campos_formato', [
            'valor' => '{"url":"arboles/arbol_funcionario.php","checkbox":"checkbox"}',
            'opciones' => '{"url":"2ol","checkbox":"checkbox"}'
        ], [
            'idcampos_formato' => '4967'
        ]);
        $this->connection->update('pantalla_componente', [
            'opciones_propias' => '{
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
              "cargo",
              "rol"
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
              "Cargo",
              "Rol"
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
}'
        ], [
            'idpantalla_componente' => '35'
        ]);

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
