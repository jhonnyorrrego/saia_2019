<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190918214353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->connection->update('pantalla_componente', [
            'opciones' => '{"nombre":"archivo","etiqueta":"Adjuntos","tipo_dato":"string","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"archivo","orden":1,"mascara":"","adicionales":"","autoguardado":0,"fila_visible":1,"opciones":"{\"tipos\":\".pdf,.doc,.docx,.jpg,.jpeg,.gif,.png,.bmp,.xls,.xlsx,.ppt\",\"longitud\":\"3\",\"cantidad\":\"3\"}"}',
        ], [
            'nombre' => 'archivo'
        ]);

        $this->connection->update('pantalla_componente', [
            'opciones' => '{"nombre":"textarea_cke","etiqueta":"Texto con formato","tipo_dato":"string","longitud":255,"obligatoriedad":1,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"textarea_cke","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"campo texto con formato"}',
        ], [
            'nombre' => 'textarea_cke'
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
                    "fs_obligatoriedad": {
                      "type": "checkbox",
                      "rightLabel": "Obligatorio"
                    },
                    "fs_acciones": {
                      "type": "checkbox",
                      "rightLabel": "Incluirse en la descripción del formato"
                    },
                    "fs_ayuda": {
                      "rows": 3,
                      "type": "textarea"
                    }
                  }
                }
              }',
        ], [
            'nombre' => 'textarea_cke'
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
                    "fs_opciones": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "clase": {
                          "title": "Ancho del campo",
                          "type": "string",
                          "enum": [
                            "col-md-12",
                            "col-md-6",
                            "col-md-3"
                          ]
                        },
                        "items": {
                        "title":"Listado de opciones",
                        "type": "array",
                        "required":true,
                        "properties" : {
                          "llave" : {
                            "type" : "string",
                            "default" : "a#w#e"
                          },
                          "item" : {
                             "type" : "string",
                             "required": true
                          }
                        }
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
                    "fs_opciones": {
                      "fields": {
                        "clase": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": true,
                          "optionLabels": [
                            "Grande",
                            "Mediano",
                            "Pequeño"
                          ]
                        }
                      },
                      "toolbarSticky": false,
                      "toolbarPosition": "top",
                      "hideInitValidationError": true
                    },
                    "fs_obligatoriedad": {
                      "type": "checkbox",
                      "rightLabel": "Obligatorio"
                    },
                    "fs_acciones": {
                      "type": "checkbox",
                      "rightLabel": "Incluirse en la descripción del formato"
                    },
                    "fs_ayuda": {
                      "rows": 3,
                      "type": "textarea"
                    }
                  }
                }
              }',
        ], [
            'nombre' => 'select'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
