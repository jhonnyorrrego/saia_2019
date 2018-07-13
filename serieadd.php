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
include_once ($ruta_db_superior . "db.php");
include ("header.php");
include ("phpmkrfn.php");
include_once ($ruta_db_superior . "pantallas/expediente/librerias.php");

include_once ("pantallas/lib/librerias_cripto.php");
$validar_enteros = array("x_idserie");
desencriptar_sqli('form_info');

$x_idserie = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_dias_entrega = Null;
$x_codigo = Null;
$x_retencion_gestion = Null;
$x_retencion_central = Null;
$x_conservacion = Null;
$x_seleccion = Null;
$x_otro = Null;
$x_procedimiento = Null;
$x_digitalizacion = Null;
$x_copia = Null;
$x_categoria = Null;
$x_tipo = Null;
$x_tipo_expediente = Null;

$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C";
	} else {
		$sAction = "I";
	}
} else {
	$x_idserie = @$_POST["x_idserie"];
	$x_nombre = @$_POST["x_nombre"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_dias_entrega = @$_POST["x_dias_entrega"];
	$x_codigo = @$_POST["x_codigo"];
	$x_retencion_gestion = @$_POST["x_retencion_gestion"];
	$x_retencion_central = @$_POST["x_retencion_central"];
	$x_conservacion = @$_POST["x_conservacion"];
	$x_seleccion = @$_POST["x_seleccion"];
	$x_otro = @$_POST["x_otro"];
	$x_procedimiento = @$_POST["x_procedimiento"];
	$x_digitalizacion = @$_POST["x_digitalizacion"];
	$x_copia = @$_POST["x_copia"];
	$x_categoria = @$_POST["x_categoria"];
	$x_tipo = @$_POST["x_tipo"];
	$x_tipo_expediente = @$_POST["x_tipo_expediente"];
}
switch ($sAction) {
	case "C" :
		if (!LoadData($sKey, $conn)) {// Load Record based on key
			$_SESSION["ewmsg"] = "Registro " . $sKey . " No encontrado";
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
	case "A" :
		$ok = AddData($conn);
		if ($ok) {
			notificaciones('Serie adicionada con exito', 'success', 6000);
			$parametro_dependencia_serie = '';
			if (@$_REQUEST['dependencia_serie']) {
				$parametro_dependencia_serie = "&dependencia_serie=" . $_REQUEST['dependencia_serie'];
			}
			if (@$_REQUEST['x_cod_padre']) {
				$ok = $_REQUEST['x_cod_padre'];
			}

			$url = array();
			if (@$_REQUEST['from_dependencia_request']) {
				$url[] = "from_dependencia=" . $_REQUEST['from_dependencia_request'];
			}
			if (@$_REQUEST['key_padre_request']) {
				$url[] = "key_padre=" . $_REQUEST['key_padre_request'];
			}
			if (@$_REQUEST['dependencia_serie_request']) {
				$url[] = "dependencia_serie=" . $_REQUEST['dependencia_serie_request'];
			}
			if (@$_REQUEST['tvd_request']) {
				$url[] = "tvd=" . $_REQUEST['tvd_request'];
			}
			abrir_url("serieadd.php?" . implode("&", $url), "_self");
			exit();
		}
		break;
}


include ("librerias_saia.php");
echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
echo librerias_arboles();
 
if(@$_REQUEST['key_padre']){
	$serie_padre=busca_filtro_tabla('','serie','idserie='.$_REQUEST['key_padre'],'',$conn);
	$x_idserie = @$serie_padre[0]["idserie"];
	$x_nombre_padre = @$serie_padre[0]["nombre"];
	$x_cod_padre = @$serie_padre[0]["cod_padre"];
	$x_dias_entrega = @$serie_padre[0]["dias_entrega"];
	$x_codigo = @$serie_padre[0]["codigo"];
	$x_retencion_gestion = @$serie_padre[0]["retencion_gestion"];
	$x_retencion_central = @$serie_padre[0]["retencion_central"];
	$x_conservacion = @$serie_padre[0]["conservacion"];
	$x_seleccion = @$serie_padre[0]["seleccion"];
	$x_otro = @$serie_padre[0]["otro"];
	$x_procedimiento = @$serie_padre[0]["procedimiento"];
	$x_digitalizacion = @$serie_padre[0]["digitalizacion"];
	$x_copia = @$serie_padre[0]["copia"];
  $x_categoria = @$serie_padre[0]["categoria"];
	$x_tipo = @$serie_padre[0]["tipo"];
	$x_tipo_expediente = @$serie_padre[0]["tipo_expediente"];
?>
<script>
$(document).ready(function(){
	$('#cat<?php echo($x_categoria); ?>').attr('checked',true);
	var check=0;
	var tipo=parseInt('<?php echo($x_tipo); ?>');
	switch(tipo){
		case 1:
			check=2;
			break;
		case 2:
			check=3;
			break;		
		case 3:
			check=3;
			break;				
	}
	$('#x_tipo'+check).attr('checked',true);
});
</script>
<?php
}
?>

<p><span class="internos">&nbsp;&nbsp;ADICIONAR SERIES DOCUMENTALES<br><br>
<form name="serieadd" id="serieadd" action="serieadd.php" method="post">

<?php if(@$_REQUEST['from_dependencia']){ ?>
  <input type="hidden" name="from_dependencia_request" value="<?php echo($_REQUEST['from_dependencia']); ?>">
<?php } ?>
<?php if(@$_REQUEST['key_padre']){ ?>
  <input type="hidden" name="key_padre_request" value="<?php echo($_REQUEST['key_padre']); ?>">
<?php } ?>
<?php if(@$_REQUEST['dependencia_serie']){ ?>
  <input type="hidden" name="dependencia_serie_request" value="<?php echo($_REQUEST['dependencia_serie']); ?>">
<?php } ?>
<?php if(@$_REQUEST['tvd']){ ?>
  <input type="hidden" name="tvd_request" value="<?php echo($_REQUEST['tvd']); ?>">
<?php } ?>
<?php if(@$_REQUEST['idnodopadre']){ ?>
  <input type="hidden" name="idnodopadre_request" value="<?php echo($_REQUEST['idnodopadre']); ?>">
<?php } ?>

<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"  title="Categoria a la cual pertenece" >CATEGORIA
		</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php if(!@$_REQUEST['otras_categorias']){ $disabled=''; if(@$_REQUEST['key_padre'] && @$_REQUEST['dependencia_serie']){ $disabled='style="display:none;"'; } ?>	
    <input type='radio' name='x_categoria' value='2' id='cat2' checked <?php echo($disabled); ?> >
    <label for='cat2'>Produccion Documental</label>
    <?php } ?>
    
    <?php if(!@$_REQUEST['dependencia_serie']){ ?>
    <input type='radio' name='x_categoria' value='3' id='cat3' >
    <label for='cat3'>Otras categorias</label>
    <?php } ?>
  </span>
    </td>
	</tr>
	<script>
	
	function filtrar_arbol_series(){
		    tree2.deleteItem('3-categoria-Otras categorias');
		    tree2.deleteItem('1-categoria-Comunicaciones Oficiales');
		    tree2.deleteItem('2-categoria-Produccion Documental');	
		    $('[name="x_cod_padre"]').val('');
		    var tipo=$('input:radio[name=x_tipo]:checked').val();
		    var filtrar_arbol='';		    
		    switch(parseInt(tipo)){
		        case 1:
		            
		            break;
		        case 2:
		            filtrar_arbol="&filtrar_arbol=series";
		            tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
		            break;
		        case 3:
		            filtrar_arbol="&filtrar_arbol=documental";
		            tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
		            break;
		    }	    
	}
	
	$(document).ready(function(){
		<?php if(!@$_REQUEST['dependencia_serie']){ ?>
	    $('[name="x_tipo"]').click(function(){
	        $('#nombre_padre_muestra').remove();
		    filtrar_arbol_series();
	    });
	    <?php } ?>
	    
		$("#cat2").click(function(){
            $('#x_tipo1').attr('disabled',false);
        	$('#x_tipo2').attr('disabled',false);	
        	$('#x_tipo3').attr('disabled',false);
		    $('#nombre_padre_muestra').remove();
		    $('#x_cod_padre').val('');
		    filtrar_arbol_series();
			$(".ocultar").each(function(){
				$(this).show();
			});
		});
		$("#cat3").click(function(){
		    $('#x_cod_padre').val('');
		    $('#nombre_padre_muestra').remove();
            $('#x_tipo1').attr('disabled',false);
        	$('#x_tipo2').attr('disabled',false);	
        	$('#x_tipo3').attr('disabled',false);		    
		    tree2.deleteItem('3-categoria-Otras categorias');
		    tree2.deleteItem('1-categoria-Comunicaciones Oficiales');
		    tree2.deleteItem('2-categoria-Produccion Documental');	
		    tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=3");
			$(".ocultar").each(function(){
				$(this).hide();
			});
		});
		
		

	});
	</script>
	<tr class="ocultar">
		<td class="encabezado" title="Definir el tipo de serie que se esta creando" >TIPO *</td>
		<td bgcolor="#F5F5F5">
			
			<?php if(!@$_REQUEST['dependencia_serie']){ ?>
				<input type="radio" name="x_tipo" id="x_tipo1" value="1">Serie<br>
			<?php } ?>
			<?php if(@$_REQUEST['from_dependencia']){ ?>
				<input type="radio" name="x_tipo" id="x_tipo1" value="1" checked>Serie<br>
			<?php }else{ ?>
				<input type="radio" name="x_tipo" id="x_tipo2" value="2">Subserie<br>
				<input type="radio" name="x_tipo" id="x_tipo3" value="3" checked>Tipo documental<br>				
			<?php } ?>			

		</td>
	</tr>

	<tr class="ocultar">
		<td class="encabezado" title="C&oacute;digo de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>			
	<tr>
		<td class="encabezado" title="Nombre de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	
		<?php if(@$_REQUEST['dependencia_serie']){ ?>
			<input type="hidden" name="dependencia_serie" id="dependencia_serie" value="<?php echo($_REQUEST['dependencia_serie']); ?>">
		<?php } ?>		
		<?php if(@$_REQUEST['tvd']){ ?>
			<input type="hidden" name="tvd" id="tvd" value="<?php echo($_REQUEST['tvd']); ?>">
		<?php } ?>			
	<?php if(!@$_REQUEST['from_dependencia']){ ?>
	<tr>
		<td class="encabezado" title="Nombre de la serie a la cual pertenece"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
	
			
		<?php 
			
		if(@$_REQUEST['key_padre']){
			echo('<div id="nombre_padre_muestra"><b>Padre: </b>'.$x_nombre_padre.'<br/></div>');
			?>
			<input type="hidden" class="required"  name="x_cod_padre" id="x_cod_padre" value="<?php echo($_REQUEST['key_padre']); ?>">
			<?php
		}else{	
		?>	
			
			
		<br />  Buscar: <input type="text" id="stext_serie_idserie" width="200px" size="25"><a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value),1)"> <img src="botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a><a href="javascript:void(0)" onclick="buscar_nodo();"> <img src="botones/general/buscar.png" alt="Buscar" border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext_serie_idserie').value))" id="siguiente_nodo"><img src="botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
                          </span>
			  <div id="esperando_serie"><img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree2" width="100px" height="100px"></div>
				<input type="hidden" class="required"  name="x_cod_padre" id="x_cod_padre" value="<?php echo($x_idserie); ?>">
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
      
      tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","70%",0);
      tree2.setImagePath("imgs/");
      tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
      tree2.enableIEImageFix(true);
      tree2.setOnLoadingStart(cargando_serie);
      tree2.setOnLoadingEnd(fin_cargando_serie);
      var filtrar_arbol='&filtrar_arbol=documental';
      
		<?php 

		if(@$_REQUEST['key_padre']){
			?>
		    switch(parseInt('<?php echo($x_tipo); ?>')){
		     case 1:
          $('#x_tipo1').attr('disabled','disabled');
          filtrar_arbol='&filtrar_arbol=series';
          break;
        case 2:
          $('#x_tipo1').attr('disabled','disabled');
          $('#x_tipo2').attr('disabled','disabled');
          filtrar_arbol='&filtrar_arbol=documental';
         break;
		    }		            
			<?php
			
		}	
		?>	      
      
      tree2.setXMLAutoLoading("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2&solo_series=1"+filtrar_arbol);
      tree2.loadXML("test_serie.php?tabla=serie&admin=1&arbol_series=1&categoria=2"+filtrar_arbol);
      
	  tree2.setOnCheckHandler(onNodeSelect_tree2);
      function onNodeSelect_tree2(nodeId){
      	valor_destino=document.getElementById("x_cod_padre");
        if(tree2.isItemChecked(nodeId))
         {if(valor_destino.value!=="")
          tree2.setCheck(valor_destino.value,false);
          if(nodeId.indexOf("_")!=-1)
             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
          valor_destino.value=nodeId;
         }
       else
         {valor_destino.value="";
         }
      }
      function fin_cargando_serie() {
      	if (browserType == "gecko" )
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else if (browserType == "ie")
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else
      		document.poppedLayer = eval('document.layers["esperando_serie"]');
      	document.poppedLayer.style.display = "none";
      }
      
      function cargando_serie() {
      	if (browserType == "gecko" )
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else if (browserType == "ie")
      		document.poppedLayer = eval('document.getElementById("esperando_serie")');
      	else
      		document.poppedLayer = eval('document.layers["esperando_serie"]');
      	document.poppedLayer.style.display = "";
       }
       function buscar_nodo(){
       	$.ajax({
       		type:'POST',
       		url: "buscar_test_serie.php",
       		dataType:"json",
       		data: {
       			nombre: $('#stext_serie_idserie').val(),
       			 tabla: "serie"
       		},
       		success: function(data){
       			$.each(data, function(i, item) {
       				$.each(item, function(j, value) {
       					tree2.openItem(value);
       					if(j==item.length-1){
       						tree2.selectItem(value);
       						tree2.focusItem(value);
       					}
       				});
       			});
			}
		});
		tree2.findItem((document.getElementById('stext_serie_idserie').value));
       }
--> 		
	</script>

	<?php }?>
</span></td>
	</tr>
	<?php }?>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de d&iacute;as para dar tr&aacute;mite y respuesta al documento"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS) *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_dias_entrega)) || ($x_dias_entrega == "")) { $x_dias_entrega = 8;} // Set default value ?>
<input type="text" name="x_dias_entrega" id="x_dias_entrega" size="30" value="<?php echo htmlspecialchars(@$x_dias_entrega) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo de gesti&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_gestion)) || ($x_retencion_gestion == "")) { $x_retencion_gestion = 3;} // Set default value ?>
<input type="text" name="x_retencion_gestion" id="x_retencion_gestion" size="30" value="<?php echo htmlspecialchars(@$x_retencion_gestion) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo central"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_central)) || ($x_retencion_central == "")) { $x_retencion_central = 5;} // Set default value ?>
<input type="text" name="x_retencion_central" id="x_retencion_central" size="30" value="<?php echo htmlspecialchars(@$x_retencion_central) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute; conservado o eliminado?"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_conservacionTOTAL" name="x_conservacion"<?php if (@$x_conservacion == "TOTAL") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TOTAL"); ?>">
<?php echo "Conservaci&oacute;n total"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_conservacionELIMINACION" name="x_conservacion"<?php if (@$x_conservacion == "ELIMINACION") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ELIMINACION"); ?>">
<?php echo "Eliminaci&oacute;n"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
	<td class="encabezado" title="�El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_seleccion1" name="x_seleccion"<?php if (@$x_seleccion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio"  id="x_seleccion0" name="x_seleccion"<?php if (@$x_seleccion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
		<tr class="ocultar">
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute digitalizado?"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" id="x_digitalizacion1" name="x_digitalizacion"<?php if (@$x_digitalizacion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Si"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_digitalizacion0" name="x_digitalizacion"<?php if (@$x_digitalizacion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "No"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado"  title="Si va a hacerse algo diferente a Conservar, Eliminar o Seleccionar el documento"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_otro" id="x_otro" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_otro) ?>">
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado"  title="Describir el procedimiento de conservaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_procedimiento" name="x_procedimiento"><?php echo @$x_procedimiento; ?></textarea>
</span></td>
	</tr>
	<tr class="ocultar">
		<td class="encabezado"  title="Decidir si se permite copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" id="x_copia1" name="x_copia"<?php if (@$x_copia == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" id="x_copia0" name="x_copia" checked value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	

</table>
<p>
<input type="submit" name="Action" value="Adicionar">
<input type="hidden" id="tipo_expediente0" name="x_tipo_expediente"  value="0">
</form>

<?php
include ("footer.php");
function LoadData($sKey, $conn) {
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE A.idserie = " . $sKeyWrk;

	$rs = phpmkr_query($sSql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	} else {
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_dias_entrega"] = $row["dias_entrega"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_retencion_gestion"] = $row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = $row["retencion_central"];
		$GLOBALS["x_conservacion"] = $row["conservacion"];
		$GLOBALS["x_seleccion"] = $row["seleccion"];
		$GLOBALS["x_otro"] = $row["otro"];
		$GLOBALS["x_procedimiento"] = $row["procedimiento"];
		$GLOBALS["x_digitalizacion"] = $row["digitalizacion"];
		$GLOBALS["x_tipo"] = $row["tipo"];
		$GLOBALS["x_tipo_expediente"] = $row["tipo_expediente"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}

function AddData($conn) {
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field cod_padre
	$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
	$fieldList["cod_padre"] = $theValue;

	// Field formato
	// Field conservacion

	// Field dias_entrega
	$theValue = ($GLOBALS["x_dias_entrega"] != "") ? intval($GLOBALS["x_dias_entrega"]) : "NULL";
	$fieldList["dias_entrega"] = $theValue;

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	// Field retencion_gestion
	$theValue = ($GLOBALS["x_retencion_gestion"] != "") ? intval($GLOBALS["x_retencion_gestion"]) : "NULL";
	$fieldList["retencion_gestion"] = $theValue;

	// Field retencion_central
	$theValue = ($GLOBALS["x_retencion_central"] != "") ? intval($GLOBALS["x_retencion_central"]) : "NULL";
	$fieldList["retencion_central"] = $theValue;

	// Field conservacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["conservacion"] = $theValue;

	// Field seleccion
	$theValue = ($GLOBALS["x_seleccion"] != "") ? intval($GLOBALS["x_seleccion"]) : "NULL";
	$fieldList["seleccion"] = $theValue;

	// Field otro
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["otro"] = $theValue;

	// Field procedimiento
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"];
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["procedimiento"] = $theValue;

	// Field digitalizacion
	$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
	$fieldList["digitalizacion"] = $theValue;

	// Field digitalizacion
	$theValue = ($GLOBALS["x_copia"] != "") ? intval($GLOBALS["x_copia"]) : "NULL";
	$fieldList["copia"] = $theValue;
	$fieldList["categoria"] = $GLOBALS["x_categoria"];

	// tipo
	$fieldList["tipo"] = "'" . $GLOBALS["x_tipo"] . "'";

	//tipo_expediente
	$fieldList["tipo_expediente"] = "'" . $GLOBALS["x_tipo_expediente"] . "'";
	$tipo_expediente = $GLOBALS["x_tipo_expediente"];

	if (@$_REQUEST['tvd']) {
		$fieldList["tvd"] = 1;
	}
	// insert into database
	$strsql = "INSERT INTO serie (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn);
	$id = phpmkr_insert_id();

	if ($id && @$_REQUEST['dependencia_serie']) {
		$sql_es = "INSERT INTO entidad_serie(entidad_identidad, serie_idserie, llave_entidad, estado) VALUES (2," . $id . "," . $_REQUEST['dependencia_serie'] . ",'1')";
		phpmkr_query($sql_es);
	}

  if($id && @$_REQUEST['idnodopadre_request']){
    ?>
    <script>
    window.parent.frames['arbol'].tree2.refreshItem('<?php echo($_REQUEST['idnodopadre_request']); ?>');
    </script>
    <?php
  }
	if (intval($tipo_expediente) != 0) {
		insertar_expediente_automatico($id);
	}
	return $id;
}

encriptar_sqli("serieadd", 1,"form_info","",false,false);
?>

<script>
$(document).ready(function(){
	<?php if(!@$_REQUEST['dependencia_serie']){ ?>
	tree2.setOnCheckHandler(cargar_datos_padre);	
	<?php } ?>
	
	<?php if(@$_REQUEST['otras_categorias']){ ?>
		setTimeout(function(){ $("#cat3").click(); }, 500);
	<?php } ?>
	
	$("#serieadd").validate({
		rules : {
			x_nombre : {
				required : true
			},
			x_tipo : {
				required : true
			},
			x_dias_entrega : {
				required : true
			},
			x_retencion_gestion : {
				required : true
			},
			x_retencion_central : {
				required : true
			},
			x_seleccion : {
				required : true
			}
		}
	});
});
function cargar_datos_padre(){
		<?php 
		if(@$_REQUEST['key_padre']){
			echo("$('#nombre_padre_muestra').html('');");
		}	
		?>		
	$.ajax({ 
		type:"POST",
		dataType:"json",
		url: "buscar_datos_serie.php",
		data: {
			idserie:$('#x_cod_padre').val()
		},
		success: function(datos){
						
			$('#x_dias_entrega').val(datos.dias_entrega);
			$('#x_codigo').val(datos.codigo);
			$('#x_retencion_gestion').val(datos.retencion_gestion);
			$('#x_retencion_central').val(datos.retencion_central);
			$('#x_conservacion'+datos.conservacion).attr('checked',true);
			$('#x_seleccion'+datos.seleccion).attr('checked',true);
			$('#x_digitalizacion'+datos.digitalizacion).attr('checked',true);	
			$('#x_otro').val(datos.otro);	
			$('#x_procedimiento').text(datos.procedimiento);	
			$('#x_copia'+datos.copia).attr('checked',true);	
			
		}
	}); 	
}
</script>