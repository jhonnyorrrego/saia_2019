<?php

namespace Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181213194456 extends AbstractMigration
{

    private $pantalla_componente = array(
        'spin' => '{
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
}',
        'etiqueta_titulo' => '{
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
            "title": "T&#237;­tulo",
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
}',
        'etiqueta_parrafo' => '{
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
}',
        'etiqueta_linea' => '{
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
}',
        'text' => '{
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
}',
        'textarea' => '{
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
}',
        'textarea_cke' => '{
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
}',
        'moneda' => '{
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
}',
        'datetime' => '{
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
}',
        'checkbox' => '{
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
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}',
        'radio' => '{
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
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}',
        'select' => '{
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
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}',
        'arbol_fancytree' => '{
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
            "title": "Selecci&#243;n",
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
              "M&#250;ltiple",
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
        "rightLabel": "Incluirse en la descripci&#243;n del formato"
      },
      "fs_ayuda": {
        "rows": 3,
        "type": "textarea"
      }
    }
  }
}',
        'ejecutor' => '{
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
              "TÃ­tulo",
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
}',
        'archivo' => '{
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
            "title": "TamaÃ±o mÃ¡ximo de archivo (Mb)",
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
}',
        'hidden' => '{
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
}',
    );

    public function getDescription(): string {
        return 'Convertir los json a ISO8859-1 para que se lean bien desde la bdd';
    }

    public function preUp(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     *
     * @param Schema $schema
     */
    public function up(Schema $schema): void {
        $conn = $this->connection;

        foreach ($this->pantalla_componente as $key => $value) {
            $result = $conn->fetchColumn("select idpantalla_componente from pantalla_componente where nombre=:nombre", [
                "nombre" => $key
            ]);

            if ($result) {
                $conn->update("pantalla_componente", ["opciones_propias" => $value], [
                    "idpantalla_componente" => $result
                ]);
            }
        }
    }

    public function preDown(Schema $schema): void {
        date_default_timezone_set("America/Bogota");

        if ($this->connection->getDatabasePlatform()->getName() == "mysql") {
            $this->platform->registerDoctrineTypeMapping('enum', 'string');
        }
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema): void {
        $conn = $this->connection;

        foreach ($this->pantalla_componente as $key => $value) {
            $result = $conn->fetchColumn("select idpantalla_componente from pantalla_componente where nombre=:nombre", [
                "nombre" => $key
            ]);

            if ($result) {
                $conn->update("pantalla_componente", ["opciones_propias" => $value], [
                    "idpantalla_componente" => $result
                ]);
            }
        }
    }
}
