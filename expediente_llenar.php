<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
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
if($datos_doc["numcampos"]) {
    $idserie = $datos_doc[0]["serie"];
    //Solo traer los que son tipo documental
    $arbol = busca_filtro_tabla("cod_arbol", "serie", "tipo = 3 AND idserie=$idserie", "", $conn);
    if($arbol["numcampos"]) {
        $cod_arbol_padre = $arbol[0]["cod_arbol"];
        $series = preg_split("/\./", $cod_arbol_padre);
        //Quitar el ultimo que es la misma serie
        array_pop($series);
    }
}

if(!empty($series)) {
    $incluir_series = implode(",", $series);
}

?>
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">

<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<style type="text/css">
ul.fancytree-container {
    border: none;
    background-color:#F5F5F5;
}
span.fancytree-title 
{  
	font-family: Verdana,Tahoma,arial;
	font-size: 9px; 
}
</style>
<?php
    echo(menu_principal_documento($doc_menu,1));
    echo(librerias_jquery('3.3'));
    echo( librerias_validar_formulario(11) );
	echo librerias_UI("1.12");
	echo librerias_arboles_ft("2.24", 'filtro');
?>
<!--script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script-->
<legend>Adicionar a un expediente ya existente</legend>
<?php
$doc=busca_filtro_tabla("","documento","iddocumento in($iddoc)","",$conn);
?>
<form id="form1" name="form1" method="post" action="expediente_guardar.php">
<div class="control-group element">
	<label class="control-label" for="nombre">Expediente
  </label>
  <div class="controls">
			<!--input type="text" id="stext" width="200px" size="20">
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value))">
      <img src="botones/general/siguiente.png"border="0px"></a>
      <div id="esperando_expediente"><img src="imagenes/cargando.gif"></div-->
			<div id="treeboxbox_tree2"></div>
	</div>
</div>
		<script type="text/javascript">
		$(document).ready(function() {
		var incluir_series = "<?php echo $incluir_series;?>";
		if(incluir_series != "") {
			incluir_series = "&incluir_series=" + incluir_series;
		} 	
		var url_test = "<?php echo $ruta_db_superior;?>arboles/arbol_expediente_funcionario.php?doc=<?php echo($iddoc); ?>&accion=1&permiso_editar=1&estado_cierre=1&checkbox=radio&estado_archivo=1"+ incluir_series;
  		/*var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }

			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      //tree2.enableSmartXMLParsing(true);
      tree2.setOnLoadingStart(cargando_expediente);
      tree2.setOnLoadingEnd(fin_cargando_expediente);

			tree2.setXMLAutoLoading(url_test);
			tree2.loadXML(url_test);

			function fin_cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_expediente() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_expediente")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_expediente")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_expediente"]');
        document.poppedLayer.style.display = "";
      }*/
	     $.ajax({
				url : "<?php echo $ruta_db_superior;?>arboles/crear_arbol.php",
				data:{xml:url_test,campo:"expediente",selectMode:1,ruta_db_superior:"<?php echo $ruta_db_superior;?>",seleccionar_todos:1,busqueda_item:1},
				type : "POST",
				async:false,
				success : function(html) {
					$("#treeboxbox_tree2").empty().html(html);
				},error: function () {
					top.noty({text: 'No se pudo cargar la informacion',type: 'error',layout: 'topCenter',timeout:5000});
				}
			});
		});
      </script>

<?php if($doc["numcampos"]>1){ ?>
 <input type="hidden" name="accion" id="accion1" value="1">
<?php }
else{ ?>
	<input type="hidden" name="accion" id="accion4" value="4">
<?php } ?>


<?php
if(count($nombres_exp)){
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
 <button class="btn btn-mini" id="" onclick="window.open('<?php echo($ruta_db_superior); ?>pantallas/expediente/adicionar_expediente_documento.php?iddoc=<?php echo(@$_REQUEST["iddoc"]); ?>','_self'); return false;">Adicionar a un nuevo expediente</button>
</div>
 </form>
 <script>
 $(document).ready(function() {
	$('#form1').submit(function() {

    //seleccionados=tree2.getAllChecked();
    //if(data.node.selected)    
    //var lista_seleccionados = seleccionados.split(",");
	//var expedientes = 
    //console.log(seleccionados);
    //1574,1542_1536692460206,1540_1536692460207,1565

    /*var id_exp = null;
    var id_nodo = null;
    var id_serie = null;
    var expedientes = [];*/
	var seleccionados = $('#expediente').val();
	//var node=$("#treeboxbox_tree2").fancytree("getTree");//(expedientes);
	var expedientes = seleccionados.split(".");
    if(expedientes!="") {/*
    	for (var i = 0; i < lista_seleccionados.length; i++) {
    		id_nodo = lista_seleccionados[i];
    		//console.log(id_nodo);
			id_exp = tree2.getUserData(id_nodo, "idexpediente");

			if(!id_exp) {
				valores = id_nodo.split(".");
				id_exp = valores[1];
				id_serie = valores[0];
			} else {
				id_serie = tree2.getUserData(id_nodo, "idserie");
			}
    		//id_exp = tree2.getUserData(id_nodo, "idexpediente");
    	    //console.log("serie: " + id_serie);
    	    //console.log("exped: " + id_exp);
    		expedientes.push(id_exp);
    	}*/
	    //console.log(expedientes);
	    
      // $('#expedientes').val(expedientes.join(","));
       //$('#expedientes').val(expedientes);
       $('#expedientes').val(expedientes[1]);
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
