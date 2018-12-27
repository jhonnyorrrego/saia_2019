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

    $opciones_propias = json_decode($pantalla_campos[0]["opciones_propias"], true);
    if (json_last_error() === JSON_ERROR_NONE) {
        if(is_array($valores)) {
            $opciones_propias["value"] = $valores;
        }
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
echo jquery();
?>
	<script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/underscore.js"></script>
	<script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/jsv.js"></script>
	<script type="text/javascript" src="<?=$ruta_db_superior?>assets/theme/assets/js/jsonform.js"></script>
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
		opciones_form["params"] = {
		    "fieldHtmlClass": "input-small"
		};
		opciones_form['form'].unshift({
			"key": "fs_etiqueta",
			"onChange": function (evt) {
		        var value = $(evt.target).val();
		        if (value) {
		        	value = normalizar(value);
		        	$("[name='fs_nombre']").val(value);
		        }
		    }
		});

		opciones_form['form'].push({
			"type": "submit",
			"title": "Enviar"
		});
		opciones_form['form'].push({
            "type": "button",
            "title": "Cancelar",
            "onClick": function (evt) {
            	parent.hs.close();
            }
        });
	    //console.log(JSON.stringify(opciones_form));
		$('#editar_pantalla_campo').jsonForm(opciones_form);

		//radio radio-inline
		$(".radio").each(function() {
			$(this).addClass("radio-inline");
			$(this).css("display", "inline");
			$(this).find("label").first().addClass("radio-inline control-label");
			//$(this).find("label").first().css("display", "inline");
		});
	});
	</script>
</body>

</html>