<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");

$origen = Null;
$destino = Null;

$paso_documento=busca_filtro_tabla("","paso_documento","idpaso_documento=".@$_REQUEST["idpaso_documento"],"",$conn);
if($paso_documento["numcampos"]){
  $x_idpaso = $paso_documento[0]["paso_idpaso"];
  $x_iddocumento = $paso_documento[0]["documento_iddocumento"];
  $x_iddiagram = $paso_documento[0]["diagram_iddiagram_instance"]; 
}

?>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
<script type="text/javascript" src="../js/cmxforms.js"></script>
<script type="text/javascript" src="../js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="../js/dhtmlXTree.js"></script>

<?php

formulario();
function formulario(){
	global $conn,$origen,$destino,$x_idpaso,$x_iddocumento,$x_iddiagram;
	echo '
	<a href="actividades_paso_usuario.php?idpaso='.$x_idpaso.'&diagram='.$x_iddiagram.'&documento='.$x_iddocumento.'&idpaso_documento='.$_REQUEST["idpaso_documento"].'">Regresar al listado</a>
	<br>
	<br>
	<form method="POST" action="reemplazar_responsable.php">
	<table style="width:100%">
		<input type="hidden" name="x_llave_entidad" value="">
		<tr>
		<td colspan="2" style="text-align:center;" class="encabezado_list">Realizar reemplazo</td>
		</tr>
		<tr>
		<td class="encabezado" style="width:20%">Funcionario origen</td>
		<td id="origen">';
		mostrar_funcionarios("origen");
		echo '</td>
		</tr>
		<tr>
		<td class="encabezado">Funcionario destino</td>
		<td id="final">';
		mostrar_funcionarios("final");
		echo '</td>
		</tr>
		<tr>
		<td cols="2"><input type="submit" value="Continuar"></td>
		</tr>
	</table>
	</form>
	';
	
}

function mostrar_funcionarios($campo)
  {global $conn,$ruta_db_superior; 
   ?>
 Buscar: 
<input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),1)"> 
  <img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png"border="0px"></a>                   
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value),0,1)">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png"border="0px"></a>                                              
<a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem(htmlentities(document.getElementById('stext_<?php echo $campo; ?>').value))">
  <img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png"border="0px"></a>                            <br />
<div id="esperando_<?php echo $campo; ?>">
  <img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif">
</div>
<div id="treeboxbox_<?php echo $campo; ?>" height="90%">
</div>
<input type="hidden" maxlenght="11"  class="required"  name="<?php echo $campo; ?>" id="<?php echo $campo; ?>"   value="" >
<label style="display:none" class="error" for="<?php echo $campo; ?>">Campo obligatorio.
</label>
<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_<?php echo $campo; ?>","100%","100%",0);
                			tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
                			tree_<?php echo $campo; ?>.enableIEImageFix(true);
                      tree_<?php echo $campo; ?>.enableCheckBoxes(1);
                      tree_<?php echo $campo; ?>.enableRadioButtons(true);
                      tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
                      tree_<?php echo $campo; ?>.enableSmartXMLParsing(true);
                      tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior; ?>test.php?sin_padre=1");
                	    tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
                      function onNodeSelect_<?php echo $campo; ?>(nodeId)
                      {valor_destino=document.getElementById("<?php echo $campo; ?>");
 
                       if(tree_<?php echo $campo; ?>.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }
                      function fin_cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "none";
                      }
 
                      function cargando_<?php echo $campo; ?>() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_<?php echo $campo; ?>"]');
                        document.poppedLayer.style.display = "";
                      }
                	--></script>
   <?php                
}

?>

