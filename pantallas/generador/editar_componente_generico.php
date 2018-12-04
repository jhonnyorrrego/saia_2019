<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
    if(is_file($ruta."db.php")){
        $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "assets/librerias.php");

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/generador/librerias.php");

$componente = busca_filtro_tabla("nombre, etiqueta, clase, opciones_propias", "pantalla_componente", "idpantalla_componente=" . $_REQUEST["idpantalla_componente"], "", $conn);
$texto_titulo = $componente[0]["etiqueta"];
$nombre_componente = $componente[0]["nombre"];
$valores = array();
if (@$_REQUEST["idpantalla_campos"]) {
    $pantalla_campos = get_pantalla_campos($_REQUEST["idpantalla_campos"], 0);

    $valores["fs_nombre"] = $pantalla_campos[0]["nombre"];
    $valores["fs_etiqueta"] = $pantalla_campos[0]["etiqueta"];

    $valores["fs_obligatoriedad"] = $pantalla_campos[0]["obligatoriedad"];
    $valores["fs_acciones"] = "";

    if(preg_match("/p/", $pantalla_campos[0]["acciones"])) {
        $valores["fs_acciones"] = "p";
    }
    $acciones_guardadas = explode(",", $pantalla_campos[0]["acciones"]);

    $opciones = json_decode($pantalla_campos[0]["valor"], true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $valores["fs_valor"] = $opciones;
    } else {
        $valores["fs_valor"] = $pantalla_campos[0]["valor"];
    }

    $opciones_propias = json_decode(mb_convert_encoding($pantalla_campos[0]["opciones_propias"], 'UTF-8', 'UTF-8'), true);
    //$opciones_propias = json_decode(utf8_encode($pantalla_campos[0]["opciones_propias"]), true);
    if (json_last_error() === JSON_ERROR_NONE) {
        $val_default = array();
        if(isset($opciones_propias["data"]) && is_array($valores)) {
            $val_default = $opciones_propias["data"];
            $resultado = array_merge_recursive($val_default, $valores);
            $opciones_propias["data"] = $resultado;
        } else if(is_array($valores)) {
            $opciones_propias["data"] = $valores;
        }
    } else {
    	//print_r(json_last_error_msg());
    	//die();
    }
} else {
    alerta("No es posible Editar el Campo");
}
$opciones_str = json_encode($opciones_propias, JSON_NUMERIC_CHECK);

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Configuraci&oacute;n del campo <?=$texto_titulo?></title>
<link rel="stylesheet" type="text/css" href="<?=$ruta_db_superior?>/css/bootstrap/3.3.7/css/bootstrap.css" />

<style type="text/css">
label {
vertical-align: middle;
}
</style>
<?php
echo librerias_jquery("2.2");
?>
    <script type="text/javascript" src="<?=$ruta_db_superior?>js/bootstrap/3.3.7/bootstrap.js"></script>

    <!-- handlebars -->
    <script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/handlebars.js"></script>

    <!-- alpaca -->
    <link type="text/css" href="<?=$ruta_db_superior?>assets/theme/assets/js/alpaca.min.css" rel="stylesheet" />
    <script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/alpaca.min.js"></script>

	<script type="text/javascript" src="<?=$ruta_db_superior?>js/jquery-ui/1.12.1/jquery-ui.js"></script>
    <link type="text/css" href="<?=$ruta_db_superior?>js/jquery-ui/1.12.1/jquery-ui.min.css" rel="stylesheet" />

<!-- Required for jQuery UI DateTimePicker control -->
<script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/plugins/jqueryui-timepicker-addon/dist/jquery-ui-timepicker-addon.js"></script>
<link type="text/css" href="<?=$ruta_db_superior?>assets/theme/assets/plugins/jqueryui-timepicker-addon/dist/jquery-ui-timepicker-addon.css" rel="stylesheet"/>

<!-- bootstrap datetimepicker for date, time and datetime controls -->
<script src="<?=$ruta_db_superior?>assets/theme/assets/plugins/moment/min/moment-with-locales.min.js"></script>
<script src="<?=$ruta_db_superior?>assets/theme/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" media="screen" href="<?=$ruta_db_superior?>assets/theme/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css"/>

	<script type="text/javascript" src="<?=$ruta_db_superior?>pantallas/generador/editar_componente_generico.js"></script>
</head>

<body>
    <h5><b>Configuraci&oacute;n del campo - <?=$texto_titulo?></b></h5>
    <div class="container">
    	<form id="editar_pantalla_campo" name="editar_pantalla_campo"></form>
    	<div id="res" class="alert"></div>
    </div>
	<script type="text/javascript">
	var nombre_componente = "<?=$nombre_componente?>";
	var opciones_form = <?=$opciones_str?>;
	$(document).ready(function(){
		var rutaSuperior = "<?=$ruta_db_superior?>";

		opciones_form["onSubmit"] = function (errors, values) {
			if (errors) {
				console.log(errors);
				$('#res').html('<p>Ruego por su perd&oacute;n?</p>');
			} else {
				console.log(JSON.stringify(values.fs_valor));
				console.log(JSON.stringify(values.fs_acciones));
			}
		};

		opciones_form["options"]["fields"]["fs_etiqueta"] = {
			events: {
    			change: function (evt) {
    		        var value = $(evt.target).val();
    		        if (value) {
    		        	value = normalizar(value);
    		        	$("[name='fs_nombre']").val(value);
    		        }
    		    }
			}
		};

		/*opciones_form["params"] = {
		    "fieldHtmlClass": "input-small"
		};*/

		//console.log(opciones_form);
		opciones_form["options"]['form'] = {
			buttons : {
				cancel : {
					"styles": "btn btn-danger",
		            "type": "button",
		            "value": "Cancelar",
		            "click": function (evt) {
		            	parent.hs.close();
		            }
				},
				submit: {
					"styles": "btn btn-primary",
	                "click": function() {
	                    this.refreshValidationState(true);
	                    if (this.isValid(true)) {
	                        var value = this.getValue();
	                        console.log(JSON.stringify(value, null, "  "));
	                        funcion_enviar(value);
	                    }
	        		}
				}
			}
		};

		opciones_form["view"] = {
	        "locale": "es_ES",
	        "messages": {
	            "es_ES": {
	                "stringNotANumber": "Escriba sólo números"
	            }
	        }
	    };

		opciones_form["postRender"] = function() {
			$(".alpaca-required-indicator").html("<span style='font-size:18px;color:red;'>*</span>");
			$(".alpaca-field-radio").find("label").css("display", "block");
		};

		$('#editar_pantalla_campo').alpaca(opciones_form);

	});

	function funcion_enviar(datos) {
		console.log("funcion envio");
		if(datos.fs_valor) {
			datos.fs_valor = JSON.stringify(datos.fs_valor)
		}
		if(datos.fs_opciones) {
			datos.fs_opciones = JSON.stringify(datos.fs_opciones)
		}
		if(datos.fs_estilo) {
			datos.fs_estilo = JSON.stringify(datos.fs_estilo)
		}

    	datos["ejecutar_campos_formato"] = "set_pantalla_campos";
    	datos["tipo_retorno"] = 1;

    	console.log(datos);
    	return false;
    	$.ajax({
            type:'POST',
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php",
            data: datos,
            async: false,
            dataType: "json",
            success: function(html) {
                if(html) {
                    var objeto=jQuery.parseJSON(html);
                    if(objeto.exito) {
                        $('#cargando_enviar').html("Terminado ...");
                        //$("#content").append(objeto.etiqueta_html);
                        //setTimeout(notificacion_saia("Actualizaci&oacute;n realizada con &eacute;xito.","success","",2500),5000);
                        $("#pc_"+idpantalla_campo,parent.document).find(".control-label").html(objeto.etiqueta);
                        //$("#pc_"+idpantalla_campo,parent.document).replaceWith(objeto.codigo_html);
                        //$("#pc_"+idpantalla_campo,parent.document).find(".elemento_formulario").attr("placeholder",objeto.placeholder);
                        parent.hs.close();
                    }
                }
            }
        });

	}
	</script>
</body>

</html>