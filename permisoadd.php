<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
if(is_file($ruta."db.php")){
  $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."librerias_saia.php"); 
include_once($ruta_db_superior."db.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
echo(librerias_arboles());
?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 

$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idpermiso = Null;
$x_funcionario_idfuncionario = Null;
$x_modulo_idmodulo = Null;
$x_accion = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
$x_modulo = Null;
?>

<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
$x_funcionario_idfuncionario=@$_REQUEST["func"];
$datos_func=busca_filtro_tabla("","funcionario","idfuncionario=$x_funcionario_idfuncionario","",$conn);
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{
	// Get fields from form
	$x_idpermiso = @$_POST["x_idpermiso"];
	$x_funcionario_idfuncionario = @$_POST["funcionario_elegido"];
	$x_modulo = @$_POST["x_modulos"];	                               //el mudulo
  $x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];  //sub-modulos
  $x_accion = @$_POST["x_accion"];
	//$x_ = @$_POST["x_accion"];
	$x_caracteristica_propio = @$_POST["x_caracteristica_propio"];
	$x_caracteristica_grupo = @$_POST["x_caracteristica_grupo"];
	$x_caracteristica_total = @$_POST["x_caracteristica_total"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			alerta("Registro no encontrado" . $sKey);
			abrir_url("funcionariolist.php","centro");		}
		break;
}
?>
<br>
		<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		 <script type='text/javascript'>
		   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		   hs.outlineType = 'rounded-white';
		</script>  
<a style="display:none;" id="enlace_highslide" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 300, height: 100,preserveContent:false} )" >I</a>
<legend>&nbsp;&nbsp;ADICIONAR PERMISO DE ACCESO</legend><br>
<form name="permisoadd" id="permisoadd" action="permisoadd.php" method="post" >
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="funcionario_elegido" value="<?php echo($x_funcionario_idfuncionario);?>">
<input type="hidden" name="x_funcionario_idfuncionario"  id="x_funcionario_idfuncionario" class="required" value="<?php echo($x_funcionario_idfuncionario);?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:100%;">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&Oacute;DULO ASIGNADO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
     <input type="hidden" name="x_modulo_idmodulo" id="x_modulo_idmodulo"  value="" >
        <br />
          Buscar:<br><input type="text" id="stext_3" width="200px" size="20">
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,1)">
          <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value,0,1)">
          <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
          <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext_3').value)">
          <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a>
        <br /><div id="esperando_modulo">
        <img src="imagenes/cargando.gif"></div>
        <div id="treeboxbox_tree3"></div>
    	<script type="text/javascript">
          var browserType;
          if (document.layers) {browserType = "nn4"}
          if (document.all) {browserType = "ie"}
          if (window.navigator.userAgent.toLowerCase().match("gecko")) {
             browserType= "gecko"
          }
    			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
    			tree3.setImagePath("imgs/");
    			tree3.enableIEImageFix(true);
    			tree3.enableAutoTooltips(1);
          tree3.enableCheckBoxes(1);
    			tree3.setOnLoadingStart(cargando_serie);
          tree3.setOnLoadingEnd(fin_cargando_serie);
    			//tree3.enableThreeStateCheckboxes(true);
    			tree3.loadXML("test_permiso_modulo.php?entidad=funcionario&llave_entidad=<?php echo $x_funcionario_idfuncionario; echo $condicion; ?>");
    			tree3.setOnCheckHandler(onNodeSelect);
    			tree3.setOnClickHandler(high_slide_permiso_crear_formato);
          function fin_cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                  eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "hidden";
            <?php 
                $cmodulo_crear=busca_filtro_tabla("idmodulo","modulo","nombre='creacion_formatos'","",$conn);
                if($cmodulo_crear['numcampos']){
                    echo("tree3.deleteItem('".$cmodulo_crear[0]['idmodulo']."');");
                }
            ?>  
          }
          function onNodeSelect(nodeId){
        	$.ajax({
        	    url: '<?php echo($ruta_db_superior);?>pantallas/permisos/validar_permiso_funcionario.php', 
                type:'POST',
                dataType: 'json',
                data: {
                    idfuncionario:$('#x_funcionario_idfuncionario').val(),
                    idmodulo:nodeId,
                    adicionar_quitar_permiso:1
                },
                success: function(retorno){
                    var tipo='warning';
                    var mensaje='<b>ATENCI&Oacute;N</b><br>Se ha retirado el permiso al modulo: '+tree3.getItemText(nodeId)+retorno.mensaje_crear_formato;
                    if(retorno.accion==1){
                        tipo='success';
                        mensaje='<b>ATENCI&Oacute;N</b><br>Se ha adicionado el permiso al modulo: '+tree3.getItemText(nodeId)+retorno.mensaje_crear_formato;
                    }
                    notificacion_saia(mensaje,tipo,"topRight",3000);
                }
        	});
          }   
          function high_slide_permiso_crear_formato(nodeId){
            var idfuncionario=parseInt($('#x_funcionario_idfuncionario').val());
            if(idfuncionario){   
                $.ajax({
                    type:'POST',
                    dataType: 'html',
                    url: "<?php echo($ruta_db_superior); ?>pantallas/permisos/validar_permiso_funcionario.php",
                    data: {
                        valida_modulo_formato:1,
                        idmodulo:nodeId
                    },
                    success: function(exito){
                        exito=parseInt(exito);
                        if(exito){ //es formato
                            var enlace="<?php echo($ruta_db_superior); ?>pantallas/permisos/validar_permiso_funcionario.php?valida_permiso_crear_formato=1&idmodulo="+nodeId+"&idfuncionario="+idfuncionario;
                            $('#enlace_highslide').attr('href',enlace);
                            $('#enlace_highslide').click();
                           // hs.htmlExpand(this, { objectType: 'iframe',width: 500, height: 200,preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});	
                        }
                    }
                });   
            }    
          }          
          function cargando_serie() {
            if (browserType == "gecko" )
               document.poppedLayer =
                   eval('document.getElementById("esperando_modulo")');
            else if (browserType == "ie")
               document.poppedLayer =
                  eval('document.getElementById("esperando_modulo")');
            else
               document.poppedLayer =
                   eval('document.layers["esperando_modulo"]');
            document.poppedLayer.style.visibility = "visible";
          }

    	</script>
    </td>
	</tr>
</table>
</form>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM permiso A";
	$sSql .= " WHERE A.idpermiso = " . $sKeyWrk;
	$sGroupBy = "";
	$sHaving = "";
	$sOrderBy = "";
	if ($sGroupBy <> "") {
		$sSql .= " GROUP BY " . $sGroupBy;
	}
	if ($sHaving <> "") {
		$sSql .= " HAVING " . $sHaving;
	}
	if ($sOrderBy <> "") {
		$sSql .= " ORDER BY " . $sOrderBy;
	}
	$rs = phpmkr_query($sSql,$conn) or error("Falla la busqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$_POST["x_idpermiso"] = $row["idpermiso"];
		$_POST["x_funcionario_idfuncionario"] = $row["funcionario_idfuncionario"];
		$_POST["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$_POST["x_accion"] = $row["accion"];
	/*	$_POST["x_caracteristica_propio"] = $row["caracteristica_propio"];
		$_POST["x_caracteristica_grupo"] = $row["caracteristica_grupo"];
		$_POST["x_caracteristica_total"] = $row["caracteristica_total"];  */
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>