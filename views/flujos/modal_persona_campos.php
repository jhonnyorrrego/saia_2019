<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';

include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'controllers/autoload.php';

require_once ($ruta_db_superior . "arboles/crear_arbol_ft.php");

$idnotificacion = null;
$tipo_destinatario = TipoDestinatario::TIPO_CAMPO_FORMATO;
$idflujo = null;
$opciones_arbol = array("keyboard" => true, "selectMode" => 2);
$extensiones = array("filter" => array());

if(!empty($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];

    $notificacion = new Notificacion($idnotificacion);
    $idflujo = $notificacion->fk_flujo;
    $formatoFlujo= FormatoFlujo::conFkFlujo($idflujo);
    $formatos = $formatoFlujo->findFormatosByFlujo();
    $listaIdsFmt = [];
    foreach ($formatos as $fila) {
        $listaIdsFmt[] = $fila["idformato"];
    }

    $origenCampos = array("url" => "arboles/arbol_formatos_campos_flujo.php", "ruta_db_superior" => $ruta_db_superior,
        "params" => array(
            "seleccionable" => "checkbox",
            "obligatorio" => 1,
            "filtrar" => $idflujo,
            "idnotificacion" => $idnotificacion
        ));

    $lista_campos = obtenerListaFormatos($idnotificacion);
    if(!empty($lista_campos)) {
        $origenCampos["params"]["seleccionados"] = implode(",", $lista_campos["campos"]);
    }


    $arbolCampos = new ArbolFt("campos_formato_notificacion", $origenCampos, ["keyboard" => true, "selectMode" => 2, "onNodeClick" => "seleccionarCampo"], $extensiones);

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">


<?= estilo_tabla_bootstrap("1.13") ?>

<?= jquery() ?>
<?= bootstrap() ?>
<?= icons() ?>
<?= theme() ?>

<?= librerias_UI("1.12") ?>
<?= librerias_arboles_ft("2.24")?>

<?= librerias_tabla_bootstrap("1.13", false, false) ?>

</head>
<body>
<p>&nbsp;</p>
<div class="container">

	<div class="col col-md-4" style="height:150px; overflow: auto;">
	<?php
		echo $arbolCampos->generar_html();
	?>
	</div>


</div>

<script>

var idnotificacion = "<?= $idnotificacion ?>";
var tipodestinatario = "<?= $tipo_destinatario?>";

var destinos = <?php echo "[" . implode(",", $lista_campos["destinos"]) . "]"; ?>;

function seleccionarCampo(event, data) {
	//var elemento_evento = $.ui.fancytree.getEventTargetType(event.originalEvent);
    //console.log(event, data);
    //return false;
    if(!data.node.isFolder()) {

    	//console.log(data.node);
    	//console.log(data);
    	//return false;
    	var iddestinatario = $("#iddestinatario").val();
    	var fk_formato_flujo = data.node.parent.key;
    	var fk_campo_formato = data.node.key;
    	//Si lo va a seleccionar es false o undefined
    	if(!data.node.selected) {
    		var datos = {fk_formato_flujo: fk_formato_flujo, fk_campo_formato: fk_campo_formato};
    		var id = guardarDestinatario(idnotificacion, datos);
    		data.node.data["iddestinatario"] = id;
    		destinos.push(id);
    		return true;
    	} else {
    	    var ids = data.node.data.iddestinatario;
    	    return eliminarDestinatarios(idnotificacion, ids);
    	}
	}
}

function guardarDestinatario(idnotificacion, data) {
	if(data) {
		data['key'] = localStorage.getItem("key");
		data["fk_notificacion"] = idnotificacion;
		data["fk_tipo_destinatario"] = tipodestinatario;

	    console.log(idnotificacion, data);
		//return false;
		var pk = false;
		$.ajax({
			dataType: "json",
			url: "<?= $ruta_db_superior ?>app/flujo/guardarDestinatario.php",
			type: "POST",
			data: data,
			async: false,
			success: function(response) {
			  if(response["success"] == 1) {
				top.notification({type: "success", message: response.message});
				pk = response.data.pk;
			  } else {
				top.notification({type: "error", message: response.message});
			  }
			}
		});
		return pk;
	}
	return false;
}

function eliminarDestinatarios(idnotificacion, ids) {
	if(ids) {
		var data = {
			key: localStorage.getItem("key"),
			fk_notificacion: idnotificacion,
			fk_tipo_destinatario: tipodestinatario,
			ids: ids
		};

	    //console.log(idnotificacion, data);
		//return false;
		//TODO: Falta pedir confirmacion al usuario

		var pk = false;
		$.ajax({
			dataType: "json",
			url: "<?= $ruta_db_superior ?>app/flujo/borrarDestinatarioCampos.php",
			type: "POST",
			data: data,
			async: false,
			success: function(response) {
			  if(response["success"] == 1) {
				top.notification({type: "success", message: response.message});
				pk = true;
			  } else {
				  top.notification({type: "error", message: response.message});
			  }
			}
		});
		return pk;
	}
	return false;
}

</script>
</body>

<?php
function obtenerListaFormatos($idnotificacion) {
    global $conn;

    $lista_campos = [];
    $formatos = busca_filtro_tabla("df.*, dn.iddestinatario", "wf_dest_notificacion dn join wf_destinatario_formato df on dn.iddestinatario = df.iddestinatario", "dn.fk_notificacion= " . $idnotificacion, "", $conn);
    for ($i = 0; $i < $formatos["numcampos"]; $i++) {
        $lista_campos["campos"][] = $formatos[$i]["fk_campo_formato"];
        $lista_campos["destinos"][] = $formatos[$i]["iddestinatario"];
    }
    return $lista_campos;
}


?>