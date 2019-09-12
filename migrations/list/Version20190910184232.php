<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190910184232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
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
              }'
        ], [
            'nombre' => 'Arbol de seleccion v2'
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
                        "tipo": {
                          "title": "Tipo de Campo",
                          "type": "string",
                          "required": true,
                          "enum": [
                            "date",
                            "datetime"
                            ]
                        },
                        "criterio": {
                          "title": "Criterio",
                          "type": "string",
                          "enum": [
                            "max_lt",
                            "max",
                            "min_gt",
                            "min",
                            "between",
                            "not_between"
                          ]
                        },
                        "fecha_1": {
                          "type": "date"
                        },
                        "fecha_2": {
                          "type": "date"
                        }
                      },
                      "dependencies": {
                        "fecha_1": "criterio",
                        "fecha_2": "criterio"
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
                        "tipo": {
                          "vertical": false,
                          "removeDefaultNone": true,
                          "optionLabels": [
                            "S&#243;lo fecha",
                            "Fecha y hora"
                            ]
                        },
                        "criterio": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": false,
                          "noneLabel": "Cualquier fecha",
                          "optionLabels": [
                            "Antes del",
                            "El o antes del",
                            "Despu&#233;s del",
                            "El o despu&#233;s del",
                            "Entre",
                            "No entre"
                          ]
                        },
                        "fecha_1": {
                          "type": "date",
                          "dependencies": {
                            "criterio": [
                              "max_lt",
                              "max",
                              "min_gt",
                              "min", "between",
                              "not_between"
                            ]
                          },
                      "picker": {
                        "locale": "es",
                        "format": "YYYY/MM/DD"
                      }
                        },
                        "fecha_2": {
                          "type": "date",
                          "dependencies": {
                            "criterio": [
                              "between",
                              "not_between"
                            ]
                          },
                          "picker": {
                              "locale": "es",
                              "format": "YYYY/MM/DD"
                          }
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
            'nombre' => 'datetime'
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
              }'
        ], [
            'nombre' => 'ejecutor'
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
            'nombre' => 'arbol_fancytree'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
