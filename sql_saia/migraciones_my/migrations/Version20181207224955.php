<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181207224955 extends AbstractMigration {

   private $pantalla_componente = array(
        array('nombre' => 'text','opciones_propias' => '{
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
          "size": {
            "title": "Ancho del campo",
            "type": "string",
            "enum": [
              "10",
              "25",
              "50"
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
          "size": {
            "type": "select",
            "sort": false,
            "removeDefaultNone": false,
            "optionLabels": [
              "Pequeño",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'radio','opciones_propias' => '{
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
          "item": "Item 1",
          "type": "string",
          "minLength": 1
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
	"hideInitValidationError": true,
        "fields": {
          "item": {
            "label": "Item"
          }
        }
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
}'),
        array('nombre' => 'checkbox','opciones_propias' => '{
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
          "item": "Item 1",
          "type": "string",
          "minLength": 1
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
	"hideInitValidationError": true,
        "fields": {
          "item": {
            "label": "Item"
          }
        }
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
}'),
        array('nombre' => 'textarea','opciones_propias' => '{
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
              "Pequeño",
              "Mediano",
              "Grande"
            ]
          },
          "cols": {
            "type": "select",
            "sort": false,
            "removeDefaultNone": false,
            "optionLabels": [
              "Pequeño",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'select','opciones_propias' => '{
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
          "item": "Item 1",
          "type": "string",
          "minLength": 1
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
	"hideInitValidationError": true,
        "fields": {
          "item": {
            "label": "Item"
          }
        }
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
}'),
        array('nombre' => 'hidden','opciones_propias' => '{
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
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_obligatoriedad": {
        "type": "checkbox",
        "rightLabel": "Obligatorio"
      }
    }
  }
}'),
        array('nombre' => 'datetime','opciones_propias' => '{
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
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_opciones": {
        "fields": {
          "tipo": {
            "vertical": false,
            "removeDefaultNone": true,
            "optionLabels": [
              "Sólo fecha",
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
              "Después del",
              "El o después del",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'spin','opciones_propias' => '{
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
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_estilo": {
        "fields": {
          "size": {
            "type": "select",
            "sort": false,
            "removeDefaultNone": false,
            "optionLabels": [
              "Pequeño",
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
            "noneLabel": "Cualquier número",
            "optionLabels": [
              "Antes del",
              "El o antes del",
              "Después del",
              "El o después del",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'ejecutor','opciones_propias' => '{
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
            "title": "Selección",
            "required": true,
            "enum": [
              "multiple",
              "unico"
            ]
          },
          "adicional": {
            "title": "Información adicional",
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
              "Múltiple",
              "Simple"
            ]
          },
          "adicional": {
            "type": "checkbox",
            "sort": false,
            "optionLabels": [
              "Cargo",
              "Empresa",
              "Dirección",
              "Teléfono",
              "Correo electrónico",
              "Título",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'archivo','opciones_propias' => '{
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
            "title": "Tamaño máximo de archivo (Mb)",
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
}'),
        array('nombre' => 'textarea_cke','opciones_propias' => '{
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
              "Pequeño",
              "Mediano",
              "Grande"
            ]
          },
          "cols": {
            "type": "select",
            "sort": false,
            "removeDefaultNone": false,
            "optionLabels": [
              "Pequeño",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}'),
        array('nombre' => 'arbol_fancytree','opciones_propias' => '{
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
              "funcionario",
              "dependencia",
              "cargo",
              "serie"
            ]
          },
          "checkbox": {
            "type": "string",
            "title": "Selección",
            "enum": [
              "1",
              "radio"
            ]
          },
          "buscador": {
            "type": "boolean"
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
            "optionLabels": [
              "Funcionario",
              "Dependencia",
              "Cargo",
              "Serie"
            ]
          },
          "checkbox": {
            "type": "radio",
            "vertical": false,
            "removeDefaultNone": true,
            "optionLabels": [
              "Múltiple",
              "Simple"
            ]
          },
          "buscador": {
            "rightLabel": "Tiene buscador"
          }
        }
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
}'),
        array('nombre' => 'etiqueta_titulo','opciones_propias' => '{
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
            "title": "Título",
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
}'),
        array('nombre' => 'etiqueta_parrafo','opciones_propias' => '{
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
}'),
        array('nombre' => 'etiqueta_linea','opciones_propias' => '{
  "schema": {
    "title": "",
    "description": "Editar propiedades",
    "type": "object",
    "properties": {
      "fs_valor": {
        "type": "string",
        "title": "Etiqueta del campo",
        "maxLength": 255,
        "required": true
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
}'),
        array('nombre' => 'moneda','opciones_propias' => '{
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
      "fs_nombre": {
        "type": "hidden"
      },
      "fs_estilo": {
        "fields": {
          "size": {
            "type": "select",
            "sort": false,
            "removeDefaultNone": false,
            "optionLabels": [
              "Pequeño",
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
            "noneLabel": "Cualquier número",
            "optionLabels": [
              "Antes del",
              "El o antes del",
              "Después del",
              "El o después del",
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
        "rightLabel": "Incluirse en la descripción del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}')
    );
   
   private $orden = [
   		"etiqueta_titulo" => 1,
   		"etiqueta_parrafo" => 2,
   		"etiqueta_linea" => 3,
   		"text" => 4,
   		"textarea" => 5,
   		"textarea_cke" => 6,
   		"contador" => 7,
   		"moneda" => 8,
   		"datetime" => 9,
   		"checkbox" => 10,
   		"radio" => 11,
   		"select" => 12,
   		"arbol_fancytree" => 13,
   		"ejecutor" => 14,
   		"archivo" => 15,
   		"hidden" => 20
   ];

   public function getDescription() {
       return 'Cambios opciones de configuración';
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
        //DONE: Orden en los componentes, se requiere nuevo campo en pantalla_camponente.orden
    	$cmp = $schema->getTable('pantalla_componente');
    	
    	if (!$cmp->hasColumn("orden")) {
    		$cmp->addColumn("orden", "integer", [
    				"length" => 11,
    				"notnull" => false,
    				"default" => 1
    		]);
    	}
    	
        //DONE: Ajustar el ancho de los iconos para que queden alineados
        //TODO: Cambiar el idioma del componente fecha y ocultar/pìntar reloj dependiendo del tipo date/datetime
        //TODO: En el editor de campos poner icono para editar y quitar el evento click sobre todo el componente
    }
    
    public function postUp(Schema $schema) {
    	$conn = $this->connection;
    	foreach ($this->orden as $key => $value) {
    		$result = $conn->fetchColumn("select idpantalla_componente from pantalla_componente where nombre=:nombre", [
    				"nombre" => $key
    		]);
    		
    		if ($result) {
    			$conn->update("pantalla_componente", ["orden" => $value], [
    					"idpantalla_componente" => $result
    			]);
    			
    			if($key == 'hidden') {
    				$conn->update("pantalla_componente", ["categoria" => "Campos avanzados"], [
    						"idpantalla_componente" => $result
    				]);
    			}
    		}
    	}
    }

    /**
     *
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
