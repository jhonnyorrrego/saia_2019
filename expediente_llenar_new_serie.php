<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida --;
}

include_once ("db.php");
include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros = array(
    "iddoc"
);
include_once ("librerias_saia.php");
desencriptar_sqli('form_info');
include_once ("pantallas/expediente/librerias.php");
$iddoc = $_REQUEST["iddoc"];
$doc_menu = @$_REQUEST["iddoc"];
include_once ("pantallas/documento/menu_principal_documento.php");

$cadena .= "";
$cadena .= expedientes_asignados();
$cadena .= " AND a.idexpediente=b.expediente_idexpediente AND b.documento_iddocumento in(" . $iddoc . ")";

$expedientes_documento = busca_filtro_tabla("", "vexpediente_serie a, expediente_doc b", $cadena, "", $conn);
$nombres_exp = array_unique(extrae_campo($expedientes_documento, "nombre"));

$datos_doc = busca_filtro_tabla("serie", "documento", "iddocumento=$iddoc", "", $conn);
$idserie = 0;
$series = array();
$incluir_series = "";
if ($datos_doc["numcampos"]) {
    $idserie = $datos_doc[0]["serie"];
    // Solo traer los que son tipo documental
    $arbol = busca_filtro_tabla("cod_arbol", "serie", "tipo = 3 AND idserie=$idserie", "", $conn);
    if ($arbol["numcampos"]) {
        $cod_arbol_padre = $arbol[0]["cod_arbol"];
        $series = preg_split("/\./", $cod_arbol_padre);
        // Quitar el ultimo que es la misma serie
        array_pop($series);
    }
}

if (! empty($series)) {
    $incluir_series = implode(",", $series);
}

?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">

<link rel="stylesheet" type="text/css"
	href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css" />
<link rel="stylesheet" type="text/css"
	href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css" />
<?php
echo menu_principal_documento($doc_menu);
echo (librerias_jquery('1.7'));
echo (librerias_validar_formulario(11));
?>
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<legend>Adicionar a un expediente ya existente</legend>
<?php
$doc = busca_filtro_tabla("", "documento", "iddocumento in($iddoc)", "", $conn);
?>
<form id="form1" name="form1" method="post"
	action="expediente_guardar.php">

	<label class="control-label" for="serie_idserie">Expediente</label>
	<div class="controls">
		<div id="treeboxbox_tree3"></div>
	</div>

	<script type="text/javascript">

		var incluir_series = "<?php echo $incluir_series;?>";

		$(document).ready(function() {
    		url2="test/test_expediente_funcionario.php";
    
    		var data = {
				xml: url2,
				campo: "expedientes",
				busqueda_item: 1,
				onNodeSelect: "holaMundo"
    		};
    		if(incluir_series != "") {
    			data.incluir_series = incluir_series;
    		}
    
    		$.ajax({
    			url : "<?php echo($ruta_db_superior);?>test/crear_arbol.php",
    			data: data,
    			type : "POST",
    			async: false,
    			success : function(html_serie) {
    				$("#treeboxbox_tree3").empty().html(html_serie);
    			},
    			error: function (){
    				top.noty({text: 'No se pudo cargar el arbol de series',type: 'error',layout: 'topCenter',timeout:5000});
    			}
    		});

		});

		function holaMundo(nodeId) {
			console.log(nodeId);
			console.log(treeexpedientes.getIndexById(nodeId));
			//console.log(treeexpedientes.getUserData(nodeId, "idexpediente"));
		}
    </script>

<?php if($doc["numcampos"]>1){ ?>
 <input type="hidden" name="accion" id="accion1" value="1">
<?php

} else {
    ?>
	<input type="hidden" name="accion" id="accion4" value="4">
<?php } ?>


<?php
if (count($nombres_exp)) {
    ?>
<div class="control-group element">
		<label class="control-label" for="nombre"><?php echo("El documento se encuentra almacenado en:<br> <b>".ucwords(strtolower(implode("</b><br><b>",$nombres_exp)))); ?></b>
		</label>
	</div>
<?php
}
?>
<div>
		<input type="hidden" name="expedientes" id="expedientes" value="">
		<input type="hidden" name="iddoc" value="<?php echo $iddoc; ?>">
		<input type="submit" value="Continuar" class="btn btn-primary btn-mini">
		<button class="btn btn-mini" id=""
			onclick="window.open('<?php echo($ruta_db_superior); ?>pantallas/expediente/adicionar_expediente_documento.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>','_self'); return false;">
			Adicionar a un nuevo expediente</button>
	</div>
</form>
<script>
 $(document).ready(function() {
	$('#form1').submit(function() {

    seleccionados=tree2.getAllChecked();
    var lista_seleccionados = seleccionados.split(",");

    var id_exp = null;
    var id_nodo = null;
    var id_serie = null;
    var expedientes = [];

    if(seleccionados!="") {
    	for (var i = 0; i < lista_seleccionados.length; i++) {
    		id_nodo = lista_seleccionados[i];
    		console.log(tree2.getAttribute(id_nodo, "userData"));
    		id_exp = tree2.getUserData(id_nodo, "idexpediente");
		    id_serie = tree2.getUserData(id_nodo, "idserie");

    		//id_exp = tree2.getUserData(id_nodo, "idexpediente");
    	    console.log("serie: " + id_serie);
    	    console.log("exped: " + id_exp);
    		expedientes.push(id_exp);
    	}
	    //console.log(expedientes);
	    
	    return false;
	    
       $('#expedientes').val(expedientes.join(","));
	    <?php encriptar_sqli("form1",0); ?>
		if(salida_sqli) {
			return true;
		}
      } else {
      $('#expedientes').val('');
        <?php encriptar_sqli("form1",0); ?>
        if(salida_sqli) {
       		return(true);
       	}
      }
    return(false);
  });
  $('#accion1').click(function() {
    tree2.deleteChildItems(0);
    tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1");
  });
  $('#accion0').click(function() {
    tree2.deleteChildItems(0);
    tree2.loadXML("test_expediente.php?doc=<?php echo($iddoc); ?>&accion=0&permiso_editar=1");
  });
});
</script>
