<?php
namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181206225012 extends AbstractMigration {

    private $pantalla_componente = array(
        array(
            'nombre' => 'text',
            'etiqueta' => 'Texto en una l&iacute;nea',
            'clase' => 'fa fa-minus',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*etiqueta_html*}">{*clase_eliminar_pantalla_componente*}<label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class="controls"><input type="{*etiqueta_html*}" name="{*nombre*}" maxlength="{*longitud*}" class="elemento_formulario" placeholder="{*placeholder*}" idpantalla_campos="{*idpantalla_campos*}" value="{*procesar_texto*}" id="{*nombre*}" />{*procesar_opcion_buscar*}</div></div>',
            'opciones' => '{"nombre":"campo_texto","etiqueta":"Texto en una l&iacute;nea","tipo_dato":"varchar","longitud":255,"obligatoriedad":1,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"text","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"campo texto"}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'text',
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
}'
        ),
        array(
            'nombre' => 'radio',
            'etiqueta' => 'Selecci&oacute;n &uacute;nica',
            'clase' => 'fa fa-check-circle-o',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">
  {*clase_eliminar_pantalla_componente*}
  <label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b>
  </label>
  <div class="controls">
    {*procesar_radio*}
  </div>
</div>',
            'opciones' => '{"nombre":"radio","etiqueta":"Selecci&oacute;n &uacute;nica","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"1,1;2,2;3,3;4,4","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"radio","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Campo texto"}',
            'procesar' => 'mostrar_radio',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'radio',
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
}'
        ),
        array(
            'nombre' => 'checkbox',
            'etiqueta' => 'Selecci&oacute;n m&uacute;ltiple',
            'clase' => 'fa fa-check-square-o',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">
  {*clase_eliminar_pantalla_componente*}
  <label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b>
  </label>
  <div class="controls">
    {*procesar_checkbox*}
  </div>
</div>',
            'opciones' => '{"nombre":"checkbox","etiqueta":"Selecci&oacute;n m&uacute;ltiple","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"1,1;2,2;3,3;4,4","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"checkbox","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1}',
            'procesar' => 'mostrar_checkbox',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'checkbox',
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
}'
        ),
        array(
            'nombre' => 'textarea',
            'etiqueta' => 'Texto en varias l&iacute;neas',
            'clase' => 'fa fa-bars',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">{*clase_eliminar_pantalla_componente*}<label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class="controls"><textarea name="{*nombre*}" class="elemento_formulario" placeholder="{*placeholder*}" idpantalla_campos="{*idpantalla_campos*}" id="{*nombre*}">{*procesar_textarea*}</textarea></div></div>',
            'opciones' => '{"nombre":"textarea","etiqueta":"Texto en varias l&iacute;neas","tipo_dato":"text","longitud":"","obligatoriedad":1,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"textarea","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Area de texto"}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'textarea',
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
}'
        ),
        array(
            'nombre' => 'select',
            'etiqueta' => 'Lista desplegable',
            'clase' => 'fa fa-caret-square-o-down',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">{*clase_eliminar_pantalla_componente*}<label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class="controls">{*procesar_select*}</div></div>',
            'opciones' => '{"nombre":"select","etiqueta":"Lista desplegable","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"1,1;2,2;3,3;4,4","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"select","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"seleccionar.."}',
            'procesar' => 'mostrar_select',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'select',
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
}'
        ),
        array(
            'nombre' => 'hidden',
            'etiqueta' => 'Campo oculto (Hidden)',
            'clase' => 'fa fa-eye-slash',
            'componente' => '{*procesar_hidden*}',
            'opciones' => '{"nombre":"hidden","etiqueta":"Campo oculto (Hidden)","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"hidden","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Campo hidden"}',
            'procesar' => '',
            'categoria' => 'Campos avanzados',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'hidden',
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
}'
        ),
        array(
            'nombre' => 'datetime',
            'etiqueta' => 'Fecha y Hora',
            'clase' => 'fa fa-calendar',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">
  {*clase_eliminar_pantalla_componente*}
  <label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b>
  </label>
  <div class="controls">
		<div id="{*nombre*}" class="input-append date">
			{*procesar_datetime*}

			<span class="add-on">
				<i data-time-icon="icon-time" data-date-icon="icon-calendar">
				</i>
			</span>
		</div>
  </div>
</div>',
            'opciones' => '{"nombre":"datetime","etiqueta":"Fecha y Hora","tipo_dato":"datetime","longitud":"","obligatoriedad":1,"valor":"yyyy-MM-dd hh:mm:ss","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"fecha","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"0000-00-00"}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => 'css/bootstrap/saia/css/bootstrap-datetimepicker.min.css,js/bootstrap-datetimepicker.js@h,pantallas/generador/datetime/adicional_js.js@h',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'fecha',
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
}'
        ),
        array(
            'nombre' => 'spin',
            'etiqueta' => 'Campo numérico',
            'clase' => 'fa fa-calculator',
            'componente' => '{*procesar_contador*}',
            'opciones' => '{"nombre":"contador","etiqueta":"Campo numérico","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"spin","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":""}',
            'procesar' => NULL,
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => '',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'spin',
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
      "fs_opciones": {
        "fields": {
          "con_decimales": {
            "rightLabel": "Incluye decimales"
          },
          "decimales": {
            "validate": true,
            "inputType": "number",
            "data": {"min" : 0, "max": 9}
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
                "min", "between",
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
}'
        ),
        array(
            'nombre' => 'ejecutor',
            'etiqueta' => 'Terceros',
            'clase' => 'fa fa-users',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">{*clase_eliminar_pantalla_componente*}
  <label class="control-label" for="label_{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b>
  </label>
  <div class="controls">
    {*procesar_remitente*}
  </div>
</div>',
            'opciones' => '{"nombre":"ejecutor","etiqueta":"Terceros","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":"unico@identificacion,nombre@empresa,cargo,direccion,telefono","acciones":"a,e,b","ayuda":"","predeterminado":"1","banderas":"","etiqueta_html":"ejecutor","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":""}',
            'procesar' => 'mostrar_remitente',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => 'anexosdigitales/highslide-4.0.10/highslide/highslide.css@h,anexosdigitales/highslide-4.0.10/highslide/highslide-full.js@h,pantallas/generador/remitente/funciones_remitente.php',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'ejecutor',
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
}'
        ),
        array(
            'nombre' => 'archivo',
            'etiqueta' => 'Adjuntos',
            'clase' => 'fa fa-paperclip',
            'componente' => '<div class="control-group element" idpantalla_componente="{*idpantalla_componente*}" idpantalla_campo="{*idpantalla_campos*}" id="pc_{*idpantalla_campos*}" nombre="{*nombre_componente*}">{*clase_eliminar_pantalla_componente*}
<label class="control-label" for="{*nombre*}"><b>{*etiqueta*}{*obligatoriedad*}</b></label><div class="controls">{*procesar_archivo*}</div>
</div>
',
            'opciones' => '{"nombre":"archivo","etiqueta":"Adjuntos","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"archivo","orden":1,"mascara":"","adicionales":"","autoguardado":0,"fila_visible":1}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => 'dropzone/dist/dropzone_saia.css,dropzone/dist/dropzone.js@h',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'archivo',
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
}'
        ),
        array(
            'nombre' => 'textarea_cke',
            'etiqueta' => 'Texto con formato',
            'clase' => 'fa fa-newspaper-o',
            'componente' => '{*procesar_textarea_cke*}',
            'opciones' => '{"nombre":"textarea_cke","etiqueta":"Texto con formato","tipo_dato":"text","longitud":"","obligatoriedad":1,"valor":"avanzado","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"textarea_cke","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Area de texto"}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => 'js/ckeditor/4.11/ckeditor_std/ckeditor.js@h',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'textarea_cke',
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
}'
        ),
        array(
            'nombre' => 'arbol_fancytree',
            'etiqueta' => '&Aacute;rbol de Selecci&oacute;n',
            'clase' => 'fa fa-sitemap',
            'componente' => '{*procesar_fancytree*}',
            'opciones' => '{"nombre":"arbol_fancytree","etiqueta":"&Aacute;rbol de Selecci&oacute;n","tipo_dato":"varchar","longitud":"255","obligatoriedad":1,"valor":{"url":"","checkbox":"radio","buscador":"0","funcion_select":"","funcion_click":"","funcion_dobleclick":""},"acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"arbol_fancytree","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"Arbol fancytree"}',
            'procesar' => '',
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => 'js/jquery-ui/1.12.1/jquery-ui.js@h,js/jquery.fancytree/2.30.0/jquery.fancytree.min.js@h,js/jquery.fancytree/2.30.0/skin-lion/ui.fancytree.css',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'arbol_fancytree',
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
}'
        ),
        array(
            'nombre' => 'etiqueta_titulo',
            'etiqueta' => 'T&iacute;tulo de secci&oacute;n',
            'clase' => 'fa fa-header',
            'componente' => '{*procesar_etiqueta_titulo*}',
            'opciones' => '{"nombre":"etiqueta_titulo","etiqueta":"T&iacute;tulo de secci&oacute;n","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"etiqueta_titulo","orden":1,"mascara":"","adicionales":"","autoguardado":0,"fila_visible":1}',
            'procesar' => NULL,
            'categoria' => 'Elementos de dise&ntilde;o',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'etiqueta_titulo',
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
}'
        ),
        array(
            'nombre' => 'etiqueta_parrafo',
            'etiqueta' => 'Texto descriptivo',
            'clase' => 'fa fa-paragraph',
            'componente' => '{*procesar_etiqueta_parrafo*}',
            'opciones' => '{"nombre":"etiqueta_parrafo","etiqueta":"Texto descriptivo","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"etiqueta_parrafo","orden":1,"mascara":"","adicionales":"","autoguardado":0,"fila_visible":1}',
            'procesar' => NULL,
            'categoria' => 'Elementos de dise&ntilde;o',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'etiqueta_parrafo',
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
        ),
        array(
            'nombre' => 'etiqueta_linea',
            'etiqueta' => 'L&iacute;nea de separaci&oacute;n',
            'clase' => 'fa fa-arrows-h',
            'componente' => '{*procesar_etiqueta_linea*}',
            'opciones' => '{"nombre":"etiqueta_linea","etiqueta":"L&iacute;nea de separaci&oacute;n","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"a","etiqueta_html":"etiqueta_linea","orden":1,"mascara":"","adicionales":"","autoguardado":0,"fila_visible":1}',
            'procesar' => NULL,
            'categoria' => 'Elementos de dise&ntilde;o',
            'estado' => '1',
            'librerias' => NULL,
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'etiqueta_linea',
            'opciones_propias' => '{
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
}'
        ),
        array(
            'nombre' => 'moneda',
            'etiqueta' => 'Moneda',
            'clase' => 'fa fa-dollar',
            'componente' => '{*procesar_moneda*}',
            'opciones' => '{"nombre":"moneda","etiqueta":"Moneda","tipo_dato":"varchar","longitud":"255","obligatoriedad":0,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"moneda","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":""}',
            'procesar' => NULL,
            'categoria' => 'Campos del formato',
            'estado' => '1',
            'librerias' => '',
            'tipo_componente' => '1',
            'eliminar' => '',
            'etiqueta_html' => 'moneda',
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
      "fs_opciones": {
        "fields": {
          "con_decimales": {
            "rightLabel": "Incluye decimales"
          },
          "decimales": {
            "validate": true,
            "inputType": "number",
            "data": {"min" : 0, "max": 9}
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
                "min", "between",
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
}'
        )
    );

    public function getDescription() {
        return 'Actualizar los compoentes para los cambios en el generador';
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
        $conn = $this->connection;
        foreach ($this->modulo as $value) {
            $result = $conn->fetchColumn("select idpantalla_componente from pantalla_componente where nombre=:nombre", [
                "nombre" => $value["nombre"]
            ]);

            if (!$result) {
                $conn->insert("pantalla_componente", $value);
            } else {
                $conn->update("pantalla_componente", $value, [
                    "idpantalla_componente" => $result
                ]);
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
