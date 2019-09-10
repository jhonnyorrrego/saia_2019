<?php

declare(strict_types=1);

namespace SAIA\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!   
 */
final class Version20190904141406 extends AbstractMigration
{
  public function getDescription(): string
  {
    return '';
  }

  public function up(Schema $schema): void
  {
    /////////////////// MIGRACIÓN JULIAN OTALVARO ////////////////////////
    $table = $schema->getTable('ft_dependencias_ruta');
    $table->dropColumn('descripcion_dependen');

    $this->connection->update('busqueda_componente', [
      'ordenado_por' => 'fecha_ruta_distribuc',
      'etiqueta' => 'Rutas de distribuci&oacute;n',
      'nombre' => 'reporte_ruta_distribucion',
      'info' => '[{"title":"No. de registro","field":"{*obtener_radicado@iddocumento*}","align":"center"},{"title":"Fecha","field":"{*fecha_ruta_distribuc*}","align":"center"},{"title":"Nombre de la ruta","field":"{*nombre_ruta*}","align":"center"},{"title":"Descripci&oacute;n de la ruta","field":"{*descripcion_ruta*}","align":"center"}]',
      'campos_adicionales' => 'f.documento_iddocumento as iddocumento,f.nombre_ruta,f.descripcion_ruta,f.fecha_ruta_distribuc,f.asignar_dependencias',
      'tablas_adicionales' => 'ft_ruta_distribucion f',
      'llave' => 'f.idft_ruta_distribucion'

    ], [
      'nombre' => 'crear_ruta_distribucion'
    ]);

    $this->connection->update('busqueda_componente', [
      'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla',
      'tablas_adicionales' => 'distribucion a,documento b,funcionario c, cf_ventanilla d, dt_ventanilla_doc e',
    ], [
      'nombre' => 'reporte_distribucion_general_pordistribuir'
    ]);

    $this->connection->update('busqueda_componente', [
      'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla',
      'tablas_adicionales' => 'distribucion a,documento b,funcionario c, cf_ventanilla d, dt_ventanilla_doc e',
    ], [
      'nombre' => 'reporte_distribucion_general_endistribucion'
    ]);

    $this->connection->update('busqueda_componente', [
      'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla',
      'tablas_adicionales' => 'distribucion a,documento b,funcionario c, cf_ventanilla d, dt_ventanilla_doc e',
    ], [
      'nombre' => 'reporte_distribucion_general_finalizado'
    ]);

    $this->connection->update('busqueda_componente', [
      'campos_adicionales' => 'a.tipo_origen,a.origen,a.tipo_destino,a.destino,a.numero_distribucion,a.estado_distribucion,a.estado_recogida,a.ruta_origen,a.ruta_destino,b.iddocumento,b.fecha,b.descripcion,c.ventanilla_radicacion,d.nombre as ventanilla',
      'tablas_adicionales' => 'distribucion a,documento b,funcionario c, cf_ventanilla d, dt_ventanilla_doc e',
    ], [
      'nombre' => 'reporte_distribucion_general_sinrecogida'
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
                    "fs_estilo": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "size": {
                          "title": "Ancho del campo",
                          "type": "string",
                          "enum": [
                            "25",
                            "50",
                            "100"
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
                        "size": {
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
      'nombre' => 'text'
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
              }'
    ], [
      'nombre' => 'radio'
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
              }'
    ], [
      'nombre' => 'checkbox'
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
      'nombre' => 'textarea'
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
                    "fs_nombre": {
                      "type": "hidden"
                    },
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
                    }
                  }
                },
                "options": {
                  "fields": {
                      "fs_obligatoriedad": {
                      "type": "checkbox",
                      "rightLabel": "Obligatorio"
                    }
                  }
                }
              }'
    ], [
      'nombre' => 'hidden'
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
                    "fs_estilo": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "size": {
                          "title": "Ancho del campo",
                          "type": "string",
                          "enum": [
                            "25",
                            "50",
                            "100"
                          ]
                        }
                      }
                    },
                    "fs_opciones": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "con_decimales": {
                          "title": "",
                          "type": "boolean"
                        },
                        "decimales": {
                          "type": "number",
                          "numericEntry": true
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
                        "valor_1": {
                          "type": "number"
                        },
                        "valor_2": {
                          "type": "number"
                        }
                      },
                      "dependencies": {
                        "decimales": "con_decimales",
                        "valor_1": "criterio",
                        "valor_2": "criterio"
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
                        "size": {
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
                    "fs_opciones": {
                      "fields": {
                        "con_decimales": {
                          "rightLabel": "Incluye decimales"
                        },
                        "decimales": {
                          "validate": true,
                          "inputType": "number",
                          "data": {
                            "min": 0,
                            "max": 9
                          }
                        },
                        "criterio": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": false,
                          "noneLabel": "Cualquier n&#250;mero",
                          "optionLabels": [
                            "Antes del",
                            "El o antes del",
                            "Despu&#233;s del",
                            "El o despu&#233;s del",
                            "Entre",
                            "No entre"
                          ]
                        },
                        "valor_1": {
                          "validate": true,
                          "inputType": "number",
                          "dependencies": {
                            "criterio": [
                              "max_lt",
                              "max",
                              "min_gt",
                              "min",
                              "between",
                              "not_between"
                            ]
                          }
                        },
                        "valor_2": {
                          "validate": true,
                          "inputType": "number",
                          "dependencies": {
                            "criterio": [
                              "between",
                              "not_between"
                            ]
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
      'nombre' => 'spin'
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
              }'
    ], [
      'nombre' => 'archivo'
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
              }'
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
                    "fs_opciones": {
                      "type": "object",
                      "properties": {
                        "texto": {
                          "type": "string",
                          "title": "T&#237;Â­tulo",
                          "maxLength": 255,
                          "required": true
                        }
                      }
                    },
                    "fs_ayuda": {
                      "type": "string",
                      "title": "Ayuda para el usuario"
                    }
                  }
                },
                "options": {
                  "fields": {
                    "fs_ayuda": {
                      "rows": 3,
                      "type": "textarea"
                    }
                  }
                }
              }'
    ], [
      'nombre' => 'etiqueta_titulo'
    ]);

    $this->connection->update('pantalla_componente', [

      'opciones_propias' => '{
                "schema": {
                  "title": "",
                  "description": "Editar propiedades",
                  "type": "object",
                  "properties": {
                    "fs_opciones": {
                      "type": "object",
                      "properties": {
                        "texto": {
                          "type": "string",
                          "title": "Texto descriptivo",
                          "maxLength": 2000,
                          "required": true
                        }
                      }
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
                        "texto": {
                          "type": "textarea",
                          "rows": 3
                        }
                      }
                    },
                    "fs_ayuda": {
                      "rows": 3,
                      "type": "textarea"
                    }
                  }
                }
              }'
    ], [
      'nombre' => 'etiqueta_parrafo'
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
                    "fs_estilo": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "size": {
                          "title": "Ancho del campo",
                          "type": "string",
                          "enum": [
                            "25",
                            "50",
                            "100"
                          ]
                        }
                      }
                    },
                    "fs_opciones": {
                      "type": "object",
                      "title": "",
                      "properties": {
                        "con_decimales": {
                          "title": "",
                          "type": "boolean"
                        },
                        "decimales": {
                          "type": "number",
                          "numericEntry": true
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
                        "valor_1": {
                          "type": "number"
                        },
                        "valor_2": {
                          "type": "number"
                        }
                      },
                      "dependencies": {
                        "decimales": "con_decimales",
                        "valor_1": "criterio",
                        "valor_2": "criterio"
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
                        "size": {
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
                    "fs_opciones": {
                      "fields": {
                        "con_decimales": {
                          "rightLabel": "Incluye decimales"
                        },
                        "decimales": {
                          "validate": true,
                          "inputType": "number",
                          "data": {
                            "min": 0,
                            "max": 9
                          }
                        },
                        "criterio": {
                          "type": "select",
                          "sort": false,
                          "removeDefaultNone": false,
                          "noneLabel": "Cualquier n&#250;mero",
                          "optionLabels": [
                            "Antes del",
                            "El o antes del",
                            "Despu&#233;s del",
                            "El o despu&#233;s del",
                            "Entre",
                            "No entre"
                          ]
                        },
                        "valor_1": {
                          "validate": true,
                          "inputType": "number",
                          "data": {"min" : 0},
                          "dependencies": {
                            "criterio": [
                              "max_lt",
                              "max",
                              "min_gt",
                              "min",
                              "between",
                              "not_between"
                            ]
                          }
                        },
                        "valor_2": {
                          "validate": true,
                          "inputType": "number",
                          "data": {"min" : 1},
                          "dependencies": {
                            "criterio": [
                              "between",
                              "not_between"
                            ]
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
      'nombre' => 'moneda'
    ]);
  }

  public function down(Schema $schema): void
  {
    // this down() migration is auto-generated, please modify it to your needs

  }

  public function preUp(Schema $schema): void
  {
    date_default_timezone_set("America/Bogota");

    if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
      $this->platform->registerDoctrineTypeMapping('enum', 'string');
    }
  }

  public function preDown(Schema $schema): void
  {
    date_default_timezone_set("America/Bogota");

    if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
      $this->platform->registerDoctrineTypeMapping('enum', 'string');
    }
  }
}
