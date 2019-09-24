<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190924220741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $value = <<<JSON
{
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
            "type": "array",
            "items": {
            "type": "object",
            "minLength": 1,
            "properties" : {
                "idcampo_opciones" : {
                "type" : "string",
                "hidden" : true
                },
                "llave" : {
                "type" : "string",
                "hidden" : true
                },
                "valor" : {
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
}
JSON;
        $this->connection->update('pantalla_componente', [
            'opciones_propias' => $value
        ], [
            'etiqueta_html' => 'radio'
        ]);

        $value = <<<JSON
{
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
                "type": "array",
                "items": {
                    "type": "object",
                    "minLength": 1,
                    "properties": {
                        "idcampo_opciones": {
                            "type": "string",
                            "hidden": true
                        },
                        "llave": {
                            "type": "string",
                            "hidden": true
                        },
                        "valor": {
                            "type": "string",
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
}
JSON;
        $this->connection->update('pantalla_componente', [
            'opciones_propias' => $value
        ], [
            'etiqueta_html' => 'checkbox'
        ]);

        $value = <<<JSON
{
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
                "type": "array",
                "items": {
                    "type": "object",
                    "minLength": 1,
                    "properties": {
                        "idcampo_opciones": {
                            "type": "string",
                            "hidden": true
                        },
                        "llave": {
                            "type": "string",
                            "hidden": true
                        },
                        "valor": {
                            "type": "string",
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
}
JSON;
        $this->connection->update('pantalla_componente', [
            'opciones_propias' => $value
        ], [
            'etiqueta_html' => 'select'
        ]);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
