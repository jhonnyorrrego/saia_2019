<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190909150032 extends AbstractMigration
{
  public function getDescription(): string
  {
    return '';
  }

  public function up(Schema $schema): void
  {
    // this up() migration is auto-generated, please modify it to your needs
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
                    "fs_estilo": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "rows": {
                          "title": "Ancho del campo",
                          "type": "string",
                          "enum": [
                            "3",
                            "6",
                            "9"
                          ]
                        },
                        "cols": {
                          "title": "Alto del campo",
                          "type": "string",
                          "enum": [
                            "10",
                            "20",
                            "30"
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
                    "fs_estilo": {
                      "fields": {
                        "rows": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": false,
                          "optionLabels": [
                            "Peque&#241;o",
                            "Mediano",
                            "Grande"
                          ]
                        },
                        "cols": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": false,
                          "optionLabels": [
                            "Peque&#241;o",
                            "Mediano",
                            "Grande"
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
      'nombre' => 'select'
    ]);


    $this->connection->update(
      'busqueda_componente',
      [
        'acciones_seleccionados' => 'opciones_acciones_formato'
      ],
      [
        'nombre' => 'generador_formatos'
      ]
    );

    $this->connection->update(
      'busqueda',
      [
        'ruta_libreria_pantalla' => 'views/generador/js/funciones_generador_js.php'
      ],
      [
        'nombre' => 'generador_formatos'
      ]
    );
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs

  }
}
