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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/header_formato.php");
include_once($ruta_db_superior."formatos/librerias/funciones.php");
include_once($ruta_db_superior."phpmkrfn.php");
include_once($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info'); 


// Initialize common variables
$x_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_contador_idcontador = Null;
$x_ruta_mostrar = Null;
$x_ruta_editar = Null;
$x_ruta_adicionar = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
$x_detalle= Null;
$x_item= Null;
$x_cod_padre = Null;
$x_tipo_edicion = Null;
$x_tabla = Null; 
$x_mostrar = Null;
$x_paginar = Null;
$x_serie_idserie = Null;
$x_banderas = Null;
$x_font_size = Null;  
$x_autoguardado = Null;
$x_mostrar_pdf = Null;
$enter2tab = Null;
$x_firma_digital = Null;
$x_fk_categoria_formato = Null;
$x_flujo_idflujo = Null;
$x_funcion_predeterminada = Null;
$x_pertenece_nucleo= Null;
  echo(librerias_jquery("1.7"));
  echo(librerias_arboles());    
?>
<?php session_start(); ?>
<?php ob_start(); ?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=700,height=500,scrollbars=YES,Resizable=yes");
}
function actualizar_contador(valor)
{$.ajax({
  url: 'formatoadd.php', 
  data:'consultar_contador=1&idcontador='+valor,
  success: function(data) {
    if(data==1)
      $("#reiniciar_contador").attr("checked",true); 
    else
      $("#reiniciar_contador").attr("checked",false);
  }
 });
}
</script> 
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {
	// Get fields from form
	$x_idformato = @$_POST["x_idformato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_contador_idcontador = @$_POST["x_contador_idcontador"];
	$x_ruta_mostrar = @$_POST["x_ruta_mostrar"];
	$x_ruta_editar = @$_POST["x_ruta_editar"];
	$x_ruta_adicionar = @$_POST["x_ruta_adicionar"];
	$x_librerias = @$_POST["x_librerias"];
	$x_encabezado = @$_POST["x_encabezado"];
	$x_cuerpo = @$_POST["x_cuerpo"];
	$x_pie_pagina = @$_POST["x_pie_pagina"];
	$x_margenes = @$_POST["x_mizq"].",".@$_POST["x_mder"].",".@$_POST["x_msup"].",".@$_POST["x_minf"];
	$x_orientacion = @$_POST["x_orientacion"];
	$x_papel = @$_POST["x_papel"];
	$x_exportar = @$_POST["x_exportar"];
	$x_detalle = @$_POST["x_detalle"];
  $x_font_size = @$_POST["x_font_size"];
	$x_cod_padre= @$_POST["x_cod_padre"]; 
  $x_autoguardado= @$_POST["x_autoguardado"];
  $x_mostrar_pdf= @$_POST["x_mostrar_pdf"];
  $x_mostrar= @$_POST["x_mostrar"];
  $x_paginar= @$_POST["x_paginar"];
	if(isset($_POST["x_item"]))
     $x_item = @$_POST["x_item"];
  else
     $x_item = 0;   
	$x_tipo_edicion = @$_POST["x_tipo_edicion"];
	$x_tabla = @$_POST["x_tabla"];
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$x_banderas = @$_POST["x_banderas"];
  $enter2tab = @$_POST["enter2tab"];
  $x_firma_digital = @$_POST["x_firma_digital"];
  $x_fk_categoria_formato = @$_POST["x_fk_categoria_formato"];
  $x_flujo_idflujo = @$_POST["x_flujo_idflujo"];
  $x_funcion_predeterminada = @$_POST["x_funcion_predeterminada"];
  $x_pertenece_nucleo = @$_POST["x_pertenece_nucleo"];
	//print_r($_POST);
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: formatolist.php");
	exit();
}
//$conn = phpmkr_db_connect();
$editar=@$_REQUEST["editar"];
if($editar!=""){
  $ledicion=explode(",",$editar);
  $sKey=array_shift($editar);
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
//			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatolist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
//			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatoview.php?key=".$sKey);
			exit();
		}
		break;
}
?>
<?php include ("header.php");

 ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
 $().ready(function() {
 	//Elimina espacios y convierte el texto en minuscula
 	$("#x_nombre").keyup(function(){
 		alert($(this).keypress());
 		var texto=$(this).val();
 		texto=texto.replace(/[^a-zA-Z0-9_]/,'')
 		$(this).val(texto.toLowerCase());
 	});
	// validar los campos del formato
	$('#formatoedit').validate({
		
	});
});
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor Seleccione un Nombre para el Formato"))
		return false;
}
if (EW_this.x_etiqueta && !EW_hasValue(EW_this.x_etiqueta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_etiqueta, "TEXT", "Por favor seleccione una etiqueta para los Formatos"))
		return false;
}
if (EW_this.x_ruta_mostrar && !EW_hasValue(EW_this.x_ruta_mostrar, "TEXT" )) {
/*	if (!EW_onError(EW_this, EW_this.x_ruta_mostrar, "TEXT", "Por favor ingrese - Ruta (Mostrar)"))
		return false;
}
if (EW_this.x_ruta_editar && !EW_hasValue(EW_this.x_ruta_editar, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_ruta_editar, "TEXT", "Please enter required field - Ruta (Editar)"))
		return false;
}
if (EW_this.x_ruta_adicionar && !EW_hasValue(EW_this.x_ruta_adicionar, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_ruta_adicionar, "TEXT", "Please enter required field - Ruta (Adicionar)"))
		return false;
}*/
if (EW_this.x_margenes && !EW_hasValue(EW_this.x_margenes, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_margenes, "TEXT", "Por favor seleccione las Margenes (Izquierda,Derecha,Superior,Inferior)"))
		return false;
}
return true;
}

//-->
</script>
<!--p><span class="phpmaker"><img class="imagen_internos" src="../botones/configuracion/crear_documentos.png" border="0">Editar Formatos<br-->
<!--<br><a href="formatolist.php">Ir al Listado</a> -->
<br><a href="formatoadd_paso2.php?key=<?php echo($_REQUEST["key"]);?>">Editar cuerpo</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo $_REQUEST['key'];?>">Generar el Formato</a>
</span></p>
<form name="formatoedit" id="formatoedit" action="formatoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="casilla" id="casilla" value="">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idformato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idformato; ?><input type="hidden" name="x_idformato" value="<?php echo $x_idformato; ?>">
<input type="hidden" name="x_tabla" value="<?php echo $x_tabla; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo htmlspecialchars(@$x_nombre) ?>
<input type="hidden" name="x_nombre" id="x_nombre" class="required" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo @$x_etiqueta ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato Padre</span></td>
		<td bgcolor="#F5F5F5">
      <!--span class="phpmaker">
        <?php
          $formatos=busca_filtro_tabla("idformato,nombre,etiqueta","formato A","idformato<>".$x_idformato,"nombre DESC",$conn);
          if($formatos["numcampos"]){
            $inicio='<SELECT name="x_cod_padre"><OPTION value="0">---Pertenece a la ra&iacute;z---</OPTION>';
            $fin='</SELECT>';
          }
          for($i=0;$i<$formatos["numcampos"];$i++){
            $check="";
            if($formatos[$i]["idformato"]==$x_cod_padre){
              $check="SELECTED";
            }
            $inicio.='<OPTION value="'.$formatos[$i]["idformato"].'" '.$check.' >'.$formatos[$i]["etiqueta"].'</OPTION>';
          }
          echo($inicio.$fin);
        ?>
      </span-->
      <div id="esperando_formato">
        <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
      </div>
    	<div id="treeboxbox_tree3" class="arbol_saia"></div>
      <input type="hidden" name="x_cod_padre" value="<?php echo($x_cod_padre);?>" id="x_cod_padre">
    <script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
      tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
      tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
      tree3.enableIEImageFix(true);
      tree3.enableCheckBoxes(1);
			tree3.enableRadioButtons(true);
      tree3.setOnLoadingStart(cargando_serie);
      tree3.setOnLoadingEnd(fin_cargando_serie);
      tree3.setOnCheckHandler(onNodeSelect_tree3);
      tree3.loadXML("<?php echo($ruta_db_superior);?>test_serie.php?tabla=formato&seleccionado=<?php echo($x_cod_padre); ?>");
      function onNodeSelect_tree3(nodeId){
        if(nodeId=="<?php echo($x_idformato);?>"){
          alert("No es posible seleccionarse a si mismo como padre");
          tree3.setCheck(nodeId,false);
          return;
        }
        valor_destino=document.getElementById("x_cod_padre");
        if(tree3.isItemChecked(nodeId)){
          if(valor_destino.value!=="")
            tree3.setCheck(valor_destino.value,false);
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
           document.poppedLayer =
               eval('document.getElementById("esperando_formato")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_formato")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_formato"]');
        document.poppedLayer.style.visibility = "hidden";
      }
      
      function cargando_serie() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_formato")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_formato")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_formato"]');
        document.poppedLayer.style.visibility = "visible";
      }              
    </script>      
    </td>
	</tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Serie Documental</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php
        /*
          $serie=busca_filtro_tabla("","serie A","1=1","lower(nombre) asc",$conn);
          if($serie["numcampos"]){
            $inicio2='<SELECT name="x_serie_idserie"><OPTION value="0">Sin Serie Documental</OPTION><OPTION value="" selected>Crear Serie Documental</OPTION>';
            $fin2='</SELECT>';
          }
          for($i=0;$i<$serie["numcampos"];$i++){
            $inicio2.='<OPTION value="'.$serie[$i]["idserie"].'"';
            if($serie[$i]["idserie"]==$x_serie_idserie){
              $inicio2.=" SELECTED ";
            }            
            $inicio2.='>'.$serie[$i]["nombre"]." - ".$serie[$i]["codigo"].'</OPTION>';
          }
          echo($inicio2.$fin2);
          */
        ?>
        
					<input type="hidden" name="x_serie_idserie" id="x_serie_idserie" value="<?php echo($x_serie_idserie); ?>">
					<input type="hidden" name="x_serie_idserie_uncheck" id="x_serie_idserie_uncheck">
					 <div id="esperando_serie"><img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
					<div id="tree_serie_idserie" ></div> 
                    <script>
                        

			            tree2=new dhtmlXTreeObject("tree_serie_idserie","100%","100%",0);
			            tree2.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
			            tree2.enableTreeImages(false);
			            tree2.enableIEImageFix(true);
			            tree2.setXMLAutoLoadingBehaviour("id");
			            tree2.enableCheckBoxes(1);
			            tree2.enableRadioButtons(true);
			            tree2.setOnCheckHandler(onNodeSelect_serie_idserie);
			            tree2.setOnLoadingStart(cargando_serie_idserie);
                        tree2.setOnLoadingEnd(fin_cargando_serie_idserie);
		            	tree2.setXMLAutoLoading("<?php echo($ruta_db_superior);?>test_dependencia_serie.php?tabla=dependencia&sin_padre_dependencia=1&sin_padre=1&estado=1&carga_partes_dependencia=1&carga_partes_serie=1&mostrar_nodos=dsa,soc");
			            tree2.loadXML("<?php echo($ruta_db_superior);?>test_dependencia_serie.php?tabla=dependencia&sin_padre_dependencia=1&estado=1&carga_partes_dependencia=1&carga_partes_serie=1&mostrar_nodos=dsa,soc&sin_padre=1");
            			function onNodeSelect_serie_idserie(nodeId){
                            valor_destino=document.getElementById("x_serie_idserie_uncheck");
                            
                            
                            //es tipo_documental?
                            var datos=nodeId.split("-");
                            var datos2=nodeId.split("sub");
                            if(datos[1] || datos2[1]){
                                var dato=datos[1];
                                if(datos2[1]){
                                    dato=datos2[1];
                                }
                                
                            }                           
                            
                            if(tree2.isItemChecked(nodeId)){
                                if(valor_destino.value!==""){
                                    tree2.setCheck(valor_destino.value,false);
                                }
                                valor_destino.value=nodeId;
                                $('#x_serie_idserie').val(dato);
                            }else{
                                valor_destino.value="";
                                 $('#x_serie_idserie').val('');
                            }
                            
                            
                        }
                        function fin_cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                              eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.display = "none";
                        }
            
                        function cargando_serie_idserie() {
                        if (browserType == "gecko" )
                           document.poppedLayer =
                               eval('document.getElementById("esperando_serie")');
                        else if (browserType == "ie")
                           document.poppedLayer =
                              eval('document.getElementById("esperando_serie")');
                        else
                           document.poppedLayer =
                               eval('document.layers["esperando_serie"]');
                        document.poppedLayer.style.display = "";
                        }                        
                    </script>							        
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Contador</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_contador_idcontadorList = "<select name=\"x_contador_idcontador\" id=\"x_contador_idcontador\" onchange=\"actualizar_contador(this.value)\">";
$x_contador_idcontadorList .= "<option value=''>Crear Contador</option>";
$sSqlWrk = "SELECT DISTINCT idcontador, nombre FROM contador" . " ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_contador_idcontadorList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idcontador"] == @$x_contador_idcontador) {
			$x_contador_idcontadorList .= "' selected";
		}
		$x_contador_idcontadorList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_contador_idcontadorList .= "</select>";
echo $x_contador_idcontadorList;

?>
<input type="checkbox" value="1" name="reiniciar_contador" id="reiniciar_contador" >Reiniciar contador con el cambio de a&ntilde;o
<script>actualizar_contador('<?php echo $x_contador_idcontador; ?>');</script>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="checkbox" name="x_detalle" id="x_detalle" <?php if($x_detalle==1) echo "checked"; ?> value="1"> Detalle
 <input type="checkbox" name="x_item" id="x_item" <?php if($x_item==1) echo "checked"; ?> value="1"> Item
      <input type="checkbox" name="x_tipo_edicion" id="x_tipo_edicion" <?php if($x_tipo_edicion==1) echo "checked"; ?> value="1"> Edicion Continua
      <input type="checkbox" name="x_banderas[]" id="x_banderas" value="e" <?php if(in_array("e",$x_banderas)) echo("checked");?> >Aprobacion Automatica
      <input type="checkbox" name="x_mostrar" id="x_mostrar" value="1" <?php if($x_mostrar==1) echo("checked");?> >Mostrar
      <br>
      
      <input type="checkbox" name="x_paginar" id="x_paginar" value="1" <?php if($x_paginar==1) echo("checked");?> >Paginar al mostrar
      <input type="checkbox" name="x_banderas[]" id="x_banderas" value="r" <?php if(in_array("r",$x_banderas)) echo("checked");?> >Tomar el asunto del padre al responder
      <!--input type="checkbox" name="x_firma_digital[]" id="x_firma_digital" value="r" <?php if($x_firma_digital==1) echo "checked"; ?>>Estampar documento al aprobar-->
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librerias</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="hidden" name="x_ruta_editar" id="x_ruta_editar" value="<?php echo htmlspecialchars(@$x_ruta_editar) ?>">
<input type="hidden" name="x_ruta_mostrar" id="x_ruta_mostrar" value="<?php echo htmlspecialchars(@$x_ruta_mostrar) ?>">
<input type="hidden" name="x_ruta_adicionar" id="x_ruta_adicionar" value="<?php echo htmlspecialchars(@$x_ruta_adicionar) ?>">
<input type="text" name="x_librerias" id="x_librerias" value="<?php echo htmlspecialchars(@$x_librerias) ?>">
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o de letra</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<select name="x_font_size" id="x_font_size">
				<?php 
				for($i=7;$i<31;$i++){
					echo('<option value="'.$i.'"');
					if($x_font_size==$i){
						echo(' selected="selected" ');
					}
					echo('>'.$i.'</option>');
				} 
				?>
			</select>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes</span></td>
		<?php
		function combo($valor)
      {$combo_margenes=array();
       for($i=10;$i<51;$i++)
         $combo_margenes[]=$i;
       
       $seleccionado=0;
       
       for($i=0;$i<count($combo_margenes);$i++)
         {echo "<option value='".$combo_margenes[$i]."'";
          if($combo_margenes[$i]==$valor)
            {echo " selected ";
             $seleccionado=1;
            }
          echo ">".$combo_margenes[$i]."</option>";
         }
       if($seleccionado==0)  
         echo "<option value='".$valor."' selected >".$valor."</option>";
      }
    
    $margenes=explode(",",$x_margenes);
    ?>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		Izquierda <select name="x_mizq">
		<?php combo($margenes["0"]); ?>
    </select> 
    Derecha <select name="x_mder">
		<?php combo($margenes["1"]); ?>    </select>
    Superior <select name="x_msup">
		<?php combo($margenes["2"]); ?>    </select>
    Inferior <select name="x_minf">
		<?php combo($margenes["3"]); ?>    </select>
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Usar la tecla enter para pasar de un campo a otro</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		
<input type="radio" name="enter2tab" value=0 <?php if(!$enter2tab) echo "checked";?>>No&nbsp;&nbsp;
<input type="radio" name="enter2tab" value=1 <?php if($enter2tab) echo "checked";?>>Si
</span></td>
	</tr>
  <tr>
    <?php 
    $checkedh="";
    $checkedv="";
    if($x_orientacion==0){
      $checkedh=' checked="checked" ';
    }else if($x_orientacion==1){
      $checkedv=' checked="checked" ';
    }?>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_orientacion" id="x_orientacion" value="0" <?php echo($checkedh);?>>Horizontal
<input type="radio" name="x_orientacion" id="x_orientacion" value="1" <?php echo($checkedv);?>>Vertical
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o del Papel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <select name="x_papel" id="x_papel">
      <option value="A4"<?php if(@$x_papel=="A4"){echo(' selected="selected"');}?>>A4</option>
      <option value="A5"<?php if(@$x_papel=="A5"){echo(' selected="selected"');}?>>Media Carta</option>
      <option value="Letter"<?php if(@$x_papel=="Letter"){echo(' selected="selected"');}?>>Carta</option>
      <option value="Legal"<?php if(@$x_papel=="Legal"){echo(' selected="selected"');}?>>Oficio</option>
    </select>
</span></td>
	</tr>
	<tr>
	<td class="encabezado">Tiempo Autoguardado (ms)</td><td bgcolor="#F5F5F5">
  <input type="text" name="x_autoguardado" id="x_autoguardado" value="<?php echo $x_autoguardado; ?>" > 
	</td></tr>
<tr>
	<td class="encabezado">Mostrar</td><td bgcolor="#F5F5F5">
  <input type="radio" name="x_mostrar_pdf" value="1" <?php if($x_mostrar_pdf==1) echo "checked"; ?>> PDF
  <input type="radio" name="x_mostrar_pdf" value="0" <?php if(!$x_mostrar_pdf) echo "checked"; ?>> Html 
  <input type="radio" name="x_mostrar_pdf" value="2" <?php if($x_mostrar_pdf==2) echo "checked"; ?>> PDF Word</td>
</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo Exportar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_exportar = explode(",",@$x_exportar);
$x_exportarChk = "";
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("pdf"). "\"";
foreach ($ar_x_exportar as $cnt_x_exportar) {
	if (trim($cnt_x_exportar) == "pdf") {
		$x_exportarChk .= " checked";
		break;
	}
}
	$x_exportarChk .= ">" . "PDF" . EditOptionSeparator(0);
/*$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("xls"). "\"";
foreach ($ar_x_exportar as $cnt_x_exportar) {
	if (trim($cnt_x_exportar) == "xls") {
		$x_exportarChk .= " checked";
		break;
	}
}
	$x_exportarChk .= ">" . "Excel" . EditOptionSeparator(1);
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("word"). "\"";
foreach ($ar_x_exportar as $cnt_x_exportar) {
	if (trim($cnt_x_exportar) == "word") {
		$x_exportarChk .= " checked";
		break;
	}
}
	$x_exportarChk .= ">" . "Word (RTF)" . EditOptionSeparator(2);*/
echo $x_exportarChk;
?>
</span></td>
	</tr>
	<tr>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">El formato pertenece al n&uacute;cleo</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
            <input type="radio" name="x_pertenece_nucleo" value=0 <?php if(!$x_pertenece_nucleo) echo "checked";?>>No&nbsp;&nbsp;
            <input type="radio" name="x_pertenece_nucleo" value=1 <?php if($x_pertenece_nucleo) echo "checked";?>>Si
            </span>
        </td>
  </tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Categor&iacute;a</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"><?php
		 echo arbol_categorias('x_fk_categoria_formato',$x_fk_categoria_formato); ?></span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Flujo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
			$select=busca_filtro_tabla("","diagram","","",$conn);
			?>
			<select name="x_flujo_idflujo" id="flujo_idflujo"><option value="0">Seleccione...</option>
			<?php
			for($i=0;$i<$select["numcampos"];$i++){
				$checked='';
				if($x_flujo_idflujo==$select[$i]["id"]){
					$checked='selected';
				}
				echo '<option value="'.$select[$i]["id"].'" '.$checked.'>'.$select[$i]["title"].'</option>';
			}
			?>
			</select>
		</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Funci&oacute;n predeterminada</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php $funciones=explode(",",$x_funcion_predeterminada);
		$checked1=Null;
		$checked2=Null;
		$checked3=Null;
		if(in_array(1,$funciones))
			$checked1=' checked ';
		if(in_array(2,$funciones))
			$checked2=' checked ';
		if(in_array(3,$funciones))
			$checked3=' checked ';
		?>
		<input type="checkbox" name="x_funcion_predeterminada[]" value="1" <?php echo $checked1; ?>>Varios responsables
		<input type="checkbox" name="x_funcion_predeterminada[]" value="2" <?php echo $checked2; ?>>Digitalizaci&oacute;n
		<input type="checkbox" name="x_funcion_predeterminada[]" value="3" <?php echo $checked3; ?>>Anexos
			
		</span></td>
	</tr>
	
</table>
<p>
<input type="submit" name="Action" value="EDIT">
</form>
<?php include ("footer.php") ?>
<?php
////phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn){
    global $enter2tab,$x_autoguardado, $x_mostrar_pdf,$x_item,$x_idformato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_ruta_editar,	$x_ruta_adicionar, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_cod_padre,$x_tipo_edicion,$x_serie_idserie,$x_banderas,$x_font_family, $x_font_size,$x_mostrar,$x_firma_digital,$x_fk_categoria_formato,$x_flujo_idflujo,$x_funcion_predeterminada,$x_paginar, $x_pertenece_nucleo;
    $formato=busca_filtro_tabla("","formato","idformato=".$sKey,"",$conn);
    $LoadData=0;
    if($formato["numcampos"]){
      $row=$formato[0];
    	// Get the field contents
    	$x_idformato = $row["idformato"];
    	$x_nombre = $row["nombre"];
    	$x_etiqueta = $row["etiqueta"];
    	$x_contador_idcontador = $row["contador_idcontador"];
    	$x_ruta_mostrar = $row["ruta_mostrar"];
    	$x_ruta_editar = $row["ruta_editar"];
    	$x_ruta_adicionar = $row["ruta_adicionar"];
    	$x_librerias = $row["librerias"];
    	$x_encabezado = $row["encabezado"];
    	$x_cuerpo = $row["cuerpo"];
    	$x_pie_pagina = $row["pie_pagina"];
    	$x_margenes = $row["margenes"];
    	$x_orientacion = $row["orientacion"];
    	$x_papel = $row["papel"];
    	$x_exportar = $row["exportar"];
    	$x_tabla = $row["nombre_tabla"];
    	$x_cod_padre = $row["cod_padre"];
    	$x_detalle = $row["detalle"];
    	$x_item = $row["item"];
    	$x_tipo_edicion = $row["tipo_edicion"];
    	$x_serie_idserie = $row["serie_idserie"];
    	$x_font_size = $row["font_size"];   
      $x_autoguardado = $row["tiempo_autoguardado"];
    	$x_mostrar_pdf = $row["mostrar_pdf"];
    	$x_mostrar = $row["mostrar"];
    	$x_paginar = $row["paginar"];
      $enter2tab = $row["enter2tab"];
      $x_banderas = explode(",",$row["banderas"]);
      $x_firma_digital = $row["firma_digital"];
      $x_fk_categoria_formato=$row["fk_categoria_formato"];
      $x_flujo_idflujo=$row["flujo_idflujo"];
	    $x_funcion_predeterminada=$row["funcion_predeterminada"];
      $x_pertenece_nucleo =$row["pertenece_nucleo"];
    	$LoadData=1;
	  }
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{
  global $enter2tab,$x_autoguardado, $x_mostrar_pdf,$x_item,$x_idformato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_ruta_editar,	$x_ruta_adicionar, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_cod_padre, $x_tipo_edicion,$x_serie_idserie,$x_banderas,$x_font_family,$x_font_size,$x_mostrar,$x_firma_digital,$x_fk_categoria_formato,$x_flujo_idflujo,$x_funcion_predeterminada,$x_paginar, $x_pertenece_nucleo;
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT idformato FROM formato";
	$sSql .= " WHERE idformato = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$pos=strpos("ft_",$x_tabla);
	  if($pos===false)
	     $x_tabla="ft_".$x_tabla;   
		$fieldList["nombre"] = $theValue;
    $fieldList["mostrar_pdf"] = $x_mostrar_pdf;

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  	if($x_banderas=="")
  	  $fieldList["banderas"]="'m'";
    elseif(is_array($x_banderas))
	   $fieldList["banderas"] = "'".implode(",",$x_banderas)."'";
	  $fieldList["tiempo_autoguardado"] = $x_autoguardado; 
		$fieldList["etiqueta"] = htmlentities($theValue);
		$theValue = ($x_contador_idcontador != "") ? intval($x_contador_idcontador) : crear_contador($x_nombre,$x_tabla);
		$fieldList["contador_idcontador"] = $theValue;
		
    if($fieldList["contador_idcontador"])
    {$reinicio=0;
     if($_REQUEST["reiniciar_contador"]&&$_REQUEST["reiniciar_contador"])
       $reinicio=1;
	 $sql="update contador set reiniciar_cambio_anio=$reinicio where idcontador=".$fieldList["contador_idcontador"];
	 $nombre_contador=busca_filtro_tabla("","contador","idcontador=".$fieldList["contador_idcontador"],"",$conn);
	 $sql_export=array("sql"=>"update contador set reiniciar_cambio_anio=$reinicio where idcontador=|-idcontador-|","variables"=>array("idcontador"=>"select idcontador from contador WHERE nombre LIKE '".$nombre_contador[0]["nombre"]."'"));
	 guardar_traza($sql,$x_tabla,$sql_export);
     phpmkr_query($sql);  
    }
    //crear la serie con el nombre del formato
  	if($x_serie_idserie==""){
  	 /* $sql="insert into serie(nombre,categoria) values('".$x_etiqueta."',3)";
  	  $sql_export=array("sql"=>$sql);
	  guardar_traza($sql,$x_tabla,$sql_export);
	  phpmkr_query($sql);
	  $fieldList["serie_idserie"]=phpmkr_insert_id();
	  $sql="update campos_formato set predeterminado=".$fieldList["serie_idserie"]."  where lower(nombre)='serie_idserie' and formato_idformato=".$sKeyWrk;
	  $sql_export=array("sql"=>"update campos_formato set predeterminado=|-idserie-|  where lower(nombre)='serie_idserie' and formato_idformato=|-idformato-|","variables"=>array("idserie"=>"select idserie FROM serie WHERE nombre='".$x_etiqueta."' AND categoria=3","idformato"=>"select idformato FROM formato WHERE nombre='".$x_nombre."'"));
	  guardar_traza($sql,$x_tabla,$sql_export);
	  phpmkr_query($sql);*/
   }
	else{  //otra serie elegida o sin serie
	$theValue = ($x_serie_idserie != 0) ? intval($x_serie_idserie) : 0;
	$fieldList["serie_idserie"] = $theValue;
	}
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta_mostrar) : $x_ruta_mostrar; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta_mostrar"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta_editar) : $x_ruta_editar; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta_editar"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta_adicionar) : $x_ruta_adicionar; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta_adicionar"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_librerias) : $x_librerias; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["librerias"] = $theValue;

		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_margenes) : $x_margenes; 
		$theValue = ($theValue != "") ? " '" . limpia_tabla($theValue) . "'" : "NULL";        
		$fieldList["margenes"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_orientacion) : $x_orientacion; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["orientacion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_papel) : $x_papel; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["papel"] = $theValue;
		$theValue = implode(",", $x_exportar);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["exportar"] = $theValue;
		//tipo detalle
		$theValue= ($x_detalle != "") ? intval($x_detalle) : 0;
		 $fieldList["detalle"] = $theValue;		
		 //tipo item
		 $fieldList["item"] = $x_item;
		 $fieldList["font_size"] = $x_font_size;
		 //tipo firma_digital
		$theValue= ($x_firma_digital != "") ? intval($x_firma_digital) : 0;
		 $fieldList["firma_digital"] = $theValue;
    // Field cod_padre
	  $theValue = ($x_cod_padre != 0) ? intval($x_cod_padre) : 0;
	  $fieldList["cod_padre"] = $theValue;
    // Field Tipo Edicion
	  $theValue = ($x_tipo_edicion != 0) ? intval($x_tipo_edicion) : 0;
	  $fieldList["tipo_edicion"] = $theValue;
	  // Field mostrar
	  $theValue = ($x_mostrar != 0) ? intval($x_mostrar) : 0;
	  $fieldList["mostrar"] = $theValue;

	  //paginar al mostrar
	  $theValue = ($x_paginar != 0) ? intval($x_paginar) : 0;
	  $fieldList["paginar"] = $theValue;

	$fieldList["enter2tab"] = $enter2tab;
	$fieldList["fk_categoria_formato"]="'".$x_fk_categoria_formato."'";
	$fieldList["flujo_idflujo"]="'".$x_flujo_idflujo."'";
	$fieldList["funcion_predeterminada"]="'".implode(",",$x_funcion_predeterminada)."'";
	$fieldList["pertenece_nucleo"] = intval($x_pertenece_nucleo);
     //print_r($fieldList);die();
		// update
		
$data ="adicionar_".$x_nombre.".php
editar_".$x_nombre.".php
buscar_".$x_nombre.".php
buscar_".$x_nombre."2.php
mostrar_".$x_nombre.".php
detalles_mostrar_".$x_nombre.".php";
    if(intval($x_pertenece_nucleo) == 0){
      $data='*';
    }
    
	$fp = fopen($x_nombre . "/.gitignore", 'w+');
    fwrite($fp,$data);
    fclose($fp);
	chmod($x_nombre . "/.gitignore",PERMISOS_ARCHIVOS);		
		/*
		if(!file_put_contents($x_nombre . "/.gitignore", $data)) {
			alerta("No se crea el archivo .gitignore para versionamiento");
		}*/
    
	$sSql = "UPDATE formato SET ";
	foreach ($fieldList as $key=>$temp) {
		$sSql .= "$key = $temp, ";
	}
	if (substr($sSql, -2) == ", ") {
		$sSql = substr($sSql, 0, strlen($sSql)-2);
	}
	$sSql .= " WHERE idformato =". $sKeyWrk;
	/* --------------------------------------*/
	
	$sSql_export = "UPDATE formato SET ";
	$arreglo_variables=array("cod_padre","serie_idserie","fk_categoria_formato","flujo_idflujo");
	foreach ($fieldList as $key=>$temp){
	    if(in_array($key,$arreglo_variables)){
	        $sSql_export.= "$key=|-$key-|, ";
	    }
	    else{
		    $sSql_export .= "$key = $temp, ";
	    }
	}
	if (substr($sSql_export, -2) == ", ") {
		$sSql_export = substr($sSql_export, 0, strlen($sSql_export)-2);
	}
	$sSql_export .= " WHERE idformato =|-idformato-|";
	$cod_padre=busca_filtro_tabla("","formato","idformato=".$x_cod_padre,"",$conn);
	$cat_formatos=explode(",",$x_fk_categoria_formato);
	$nombre_cat=array();
	$sql_cat='';
	foreach($cat_formatos AS $key_cat=>$val_cat){
	    $fk_categoria_formato=busca_filtro_tabla("","categoria_formato","idcategoria_formato=".$val_cat,"",$conn);
	    if($fk_categoria_formato["numcampos"]){
	        array_push($nombre_cat," nombre='".$fk_categoria_formato[0]["nombre"]."' ");
	    }
	}
	if(count($nombre_cat)){
	    $sql_cat="select idcategoria_formato FROM categoria_formato WHERE (".implode(" OR ",$nombre_cat).")";
	}
	$flujo=busca_filtro_tabla("","diagram","id=".$x_flujo_idflujo,"",$conn);
	$sql_export=array("sql"=>$sSql_export,"variables"=>array("cod_padre"=>"select idformato FROM formato WHERE nombre LIKE '".$cod_padre[0]["nombre"]."'","serie_idserie"=>"select idserie FROM serie WHERE nombre='".$x_etiqueta."' AND categoria=3","fk_categoria_formato"=>$sql_cat,"flujo_idflujo"=>"select id from diagram WHERE title LIKE '".$flujo[0]["title"]."'","idformato"=>"select idformato FROM formato WHERE nombre='".$x_nombre."'"));
	guardar_traza($sSql,$x_tabla,$sql_export);
	phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$EditData = true; // Update Successful
	
  	$idformato=$sKeyWrk;
  	//Se actualizan los campos padre
  	if($idformato!=''){
  		if($x_flujo_idflujo!=0){
			generar_campo_flujo($idformato,$x_flujo_idflujo,$flujo[0]["title"]);
		}	
		if(in_array("1",$x_funcion_predeterminada)){
			vincular_funcion_responsables($idformato);
		}
		else {
			desvincular_funcion_responsables($idformato);
		}
		if(in_array("2",$x_funcion_predeterminada)){
			vincular_funcion_digitalizacion($idformato,$x_banderas);
		}
		else{
			desvincular_funcion_digitalizacion($idformato,$x_banderas);
		}
		if(in_array("3",$x_funcion_predeterminada)){
			vincular_campo_anexo($idformato);
		}
		else{
			//desvincular_campo_anexo($idformato);
		}
	}
  	if($idformato){
      $campo_padre=0;
      $campo_serie=0;  	 
     $campos_formato=busca_filtro_tabla("nombre,idcampos_formato,etiqueta_html","campos_formato","formato_idformato=".$idformato,"",$conn);
      //print_r($campos_formato);
      for($i=0;$i<$campos_formato["numcampos"];$i++){
        if($campos_formato[$i]["nombre"]=="serie_idserie"){
          //alerta("Entre");
          /*$sql="UPDATE campos_formato SET valor=".$fieldList["serie_idserie"]." WHERE idcampos_formato=".$campos_formato[$i]["idcampos_formato"];
          phpmkr_query($sql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
          */$campo_serie=1;
        }
        if($cod_padre["numcampos"] && $campos_formato[$i]["nombre"]==$cod_padre[0]["nombre_tabla"]){
          $sql="UPDATE campos_formato SET valor=".$fieldList["cod_padre"]." WHERE idcampos_formato=".$campos_formato[$i]["idcampos_formato"];
          $sql_export=array("sql"=>"UPDATE campos_formato SET valor=|-cod_padre-| WHERE idcampos_formato=|-idcampos_formato-|","variables"=>array("cod_padre"=>"select idformato FROM formato WHERE nombre LIKE '".$cod_padre[0]["nombre"]."'","idcampos_formato"=>"select idcampos_formato FROM campos_formato WHERE nombre LIKE '".$campos_formato[$i]["nombre"]."'"));
		  guardar_traza($sql,$x_tabla,$sql_export);
          phpmkr_query($sql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
          $campo_padre=1;
        }
      }
      if(!$campo_serie){
        $strsql="INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html) VALUES (".$idformato.",'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1,".$fieldList["serie_idserie"].", 'a',".$fieldList["etiqueta"].", 'fk', 'hidden')";
        $strsql_export=array("sql"=>"INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html) VALUES (|-idformato-|,'serie_idserie', 'SERIE DOCUMENTAL', 'INT', 11, 1,|-idserie-|, 'a',".$fieldList["etiqueta"].", 'fk', 'hidden')","variables"=>array("idserie"=>"select idserie FROM serie WHERE nombre='".$x_etiqueta."' AND categoria=3","idformato"=>"select idformato FROM formato WHERE nombre='".$x_nombre."'"));
		guardar_traza($strsql,$x_tabla,$strsql_export);
      	phpmkr_query($strsql, $conn) or die("Falla al Ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
      }
      if(!$campo_padre && $fieldList["cod_padre"] && $cod_padre["numcampos"] && $fieldList["cod_padre"]){
        $strsql="INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html) VALUES (".$idformato.",'".$cod_padre[0]["nombre_tabla"]."', ".$fieldList["nombre"].", 'INT', 11, 1,".$fieldList["cod_padre"].", 'a',".$fieldList["etiqueta"].", 'fk', 'detalle')";
        $strsql_export=array("sql"=>"INSERT INTO campos_formato (formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, valor, acciones, ayuda, banderas, etiqueta_html) VALUES (|-idformato-|,'".$cod_padre[0]["nombre_tabla"]."', ".$fieldList["nombre"].", 'INT', 11, 1,|-cod_padre-|, 'a',".$fieldList["etiqueta"].", 'fk', 'detalle')","variables"=>array("idformato"=>"select idformato FROM formato WHERE nombre='".$x_nombre."'","cod_padre"=>"select idformato FROM formato WHERE nombre LIKE '".$cod_padre[0]["nombre"]."'"));
		  guardar_traza($strsql,$x_tabla,$strsql_export);
	      phpmkr_query($strsql, $conn) or die("Falla al Ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
      }
    }
	}
	return $EditData;
}
encriptar_sqli("formatoedit",1,"form_info",$ruta_db_superior);
function crear_contador($contador,$x_tabla){
global $conn;
  $cont=busca_filtro_tabla("","contador","nombre LIKE '".$contador."","",$conn);
  if(!$cont["numcampos"]){
    $sql= "INSERT INTO contador(consecutivo,nombre ) VALUE(1,'".$contador."')";
    $sql_export=array("sql"=>"INSERT INTO contador(consecutivo,nombre ) VALUE(1,'".$contador."')","variables"=>array());
	guardar_traza($sql,$x_tabla,$sql_export);
    phpmkr_query($sql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
    return(phpmkr_insert_id());
  }  
  else return($cont[0]["idcontador"]); 
}
function consultar_contador()
{global $conn;
 $contador=busca_filtro_tabla("reiniciar_cambio_anio","contador","idcontador=".$_REQUEST["idcontador"],"",$conn);
 echo $contador[0][0];
}
function arbol_categorias($campo,$seleccionados){
	$entidad=$campo;
	if($seleccionados)
		$seleccionado = seleccionados($seleccionados);
	?>
	<div ><?php echo $seleccionado; ?></div>
	<br>
	Buscar: <input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)"> 
<img src="../botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="../botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="../botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>
<div id="esperando<?php echo $entidad; ?>"><img src="../imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>" width="100px" height="100px"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
<script type="text/javascript">
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","100%","70%",0);
			tree<?php echo $entidad; ?>.setImagePath("../imgs/");
		  	tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php if($entidad==1 || $entidad==2){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      <?php }?>
			tree<?php echo $entidad; ?>.loadXML("../test_categoria.php?tipo=1&seleccionados=<?php echo $seleccionados; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
      		document.getElementById("<?php echo $campo; ?>").value=tree<?php echo $entidad; ?>.getAllChecked();
      }

      function fin_cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
         eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
            eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "none";
      document.getElementById('<?php echo $campo; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
    }
    function cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
             eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "";
    }
                    
                    --></script>
	<?php
	
}
function seleccionados($seleccionados){
	$sel = busca_filtro_tabla("","categoria_formato","idcategoria_formato IN (".$seleccionados.")","",$conn);
	
	$retorno = '';
	for($i=0;$i<$sel["numcampos"];$i++){
		$retorno .= $sel[$i]["nombre"];
		if(($sel["numcampos"]-1) > $i)
			$retorno .= ', ';
		
		$retorno .= '<br>';
	}
	return $retorno;
}
function generar_campo_flujo($idformato,$idflujo,$nombre_flujo){
	$buscar_campo=busca_filtro_tabla("","campos_formato A","formato_idformato=".$idformato." AND nombre='idflujo'","",$conn);
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if($buscar_campo["numcampos"]==0){
		$campo="INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(".$idformato.",'idflujo', 'idflujo', 'VARCHAR', '255', 0, 'a,e,b', '".$idflujo."', 'select', 0, 'Select id,title as nombre from diagram order by nombre')";
		$campo_export=array("sql"=>"INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(|-idformato-|,'idflujo', 'idflujo', 'VARCHAR', '255', 0, 'a,e,b', '|-idflujo-|', 'select', 0, 'Select id,title as nombre from diagram order by nombre')","variables"=>array("idformato"=>"select idformato FROM formato WHERE nombre='".$formato[0]["nombre"]."'","idflujo"=>"select id FROM diagram WHERE title='".$nombre_flujo."'"));
	}
	else{
		$campo="UPDATE campos_formato SET formato_idformato=".$idformato.", nombre='idflujo', etiqueta='idflujo', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='".$idflujo."', etiqueta_html='select', valor='Select id,title as nombre from diagram order by nombre' WHERE idcampos_formato=".$buscar_campo[0]["idcampos_formato"];
		$campo_export=array("sql"=>"UPDATE campos_formato SET formato_idformato=|-idformato-|, nombre='idflujo', etiqueta='idflujo', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='|-idflujo-|', etiqueta_html='select', valor='Select id,title as nombre from diagram order by nombre' WHERE idcampos_formato=|-idcampos_formato-|","variables"=>array("idformato"=>"select idformato FROM formato WHERE nombre='".$formato[0]["nombre"]."'","idflujo"=>"select id FROM diagram WHERE title='".$nombre_flujo."'","idcampos_formato"=>"select idcampos_formato FROM campos_formato WHERE nombre='".$buscar_campo[0]["nombre"]."'"));
	}
	guardar_traza($campo,$formato[0]["nombre_tabla"],$campo_export);
	phpmkr_query($campo,$conn);
}
function vincular_funcion_responsables($idformato){
	global $conn;
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='asignar_responsables'","",$conn);
	if($buscar_funcion["numcampos"]==0){
		$nueva_funcion="INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*asignar_responsables*}','asignar_responsables','asignar_responsables','asignar_responsables', 'funciones.php','".$idformato."','a')";
		$nueva_funcion_export=array("sql"=>"INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*asignar_responsables*}','asignar_responsables','asignar_responsables','asignar_responsables', 'funciones.php','|-idformato-|','a')","variables"=>array("idformato"=>"select idformato FROM formato WHERE nombre='".$formato[0]["nombre"]."'"));
		guardar_traza($nueva_funcion,$formato[0]["nombre_tabla"],$nueva_funcion_export);
		phpmkr_query($nueva_funcion,$conn);
	}
	if(!in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$sql="UPDATE funciones_formato SET formato='".$buscar_funcion[0]["formato"].",".$idformato."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
		$sql_export=array("sql"=>"UPDATE funciones_formato SET formato='|-funciones_formato-|,|-idformato-|' WHERE idfunciones_formato=|-idfunciones_formato-|","variables"=>array("funciones_formato"=>"select formato funciones_formato WHERE nombre='".$buscar_funcion[0]["nombre"]."'","idfunciones_formato"=>"select idfunciones_formato funciones_formato WHERE nombre='".$buscar_funcion[0]["nombre"]."'","idformato"=>"select idformato FROM formato WHERE nombre='".$formato[0]["nombre"]."'"),);
        guardar_traza($sql,$formato[0]["nombre_tabla"],$sql_export);
	    phpmkr_query($sql,$conn);		
	}
}
function vincular_funcion_digitalizacion($idformato,$x_banderas){
	global $conn;
	//PENDIENTE VINCULAR TRAZAS
	//--Vinculando funcion al adicionar de digitalizar
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='digitalizar_formato'","",$conn);
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if($buscar_funcion["numcampos"]==0){
		$nueva_funcion="INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*digitalizar_formato*}','digitalizar_formato','digitalizar_formato','digitalizar_formato', '../librerias/funciones_formatos_generales.php','".$idformato."','a,e')";
		guardar_traza($nueva_funcion,$formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion);
	}
	if(!in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$sql="UPDATE funciones_formato SET formato='".$buscar_funcion[0]["formato"].",".$idformato."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
		
	}
	guardar_traza($sql,$formato[0]["nombre_tabla"]);
	phpmkr_query($sql,$conn);
	
	//---Vinculando funcion de validacion al digitalizar
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='validar_digitalizacion_formato'","",$conn);
	if($buscar_funcion["numcampos"]==0){
		$nueva_funcion="INSERT INTO funciones_formato (nombre,nombre_funcion,etiqueta,descripcion, ruta, formato, acciones) VALUES ('{*validar_digitalizacion_formato*}', 'validar_digitalizacion_formato', 'validar_digitalizacion_formato', 'validar_digitalizacion_formato', '../librerias/funciones_formatos_generales.php', '".$idformato."','')";
		guardar_traza($nueva_funcion,$formato[0]["nombre_tabla"]);
		phpmkr_query($nueva_funcion);
	}
	if(!in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$sql="UPDATE funciones_formato SET formato='".$buscar_funcion[0]["formato"].",".$idformato."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
		guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql);
	}
	
	//Vinculando la accion de validar la digitalizar posterior a la accion correspondiente.
	if(in_array("e",$x_banderas)){
		$accion=busca_filtro_tabla("","accion","nombre='aprobar'","",$conn);
	}
	else{
		$accion=busca_filtro_tabla("","accion","nombre='adicionar'","",$conn);
	}
	$buscar_funcion_accion=busca_filtro_tabla("","funciones_formato_accion","idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"]." AND formato_idformato=".$idformato,"",$conn);
	if($buscar_funcion_accion["numcampos"]==0){
		$accion_digita="INSERT INTO funciones_formato_accion (idfunciones_formato, accion_idaccion, formato_idformato, momento, estado, orden) VALUES(".$buscar_funcion[0]["idfunciones_formato"].",".$accion[0]["idaccion"].", ".$idformato.", 'POSTERIOR',1,1)";
	}
	else{
		$accion_digita="UPDATE funciones_formato_accion SET idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"].", accion_idaccion=".$accion[0]["idaccion"].", formato_idformato=".$idformato.", momento='POSTERIOR', estado=1, orden=1 WHERE idfunciones_formato_accion=".$buscar_funcion_accion[0]["idfunciones_formato_accion"];
	}
	guardar_traza($accion_digita,$formato[0]["nombre_tabla"]);
	phpmkr_query($accion_digita);
}
function desvincular_funcion_responsables($idformato){
	global $conn;
	$formato=busca_filtro_tabla("","formato","idfotmato=".$idformato,"",$conn);
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='asignar_responsables'","",$conn);
	if(in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$formats=explode(",",$buscar_funcion[0]["formato"]);
		$cantidad=count($formats);
		
		for($i=0;$i<$cantidad;$i++){
			if($formats[$i]!=$idformato)
				$formatos.=$formats[$i].",";
		}
		
		$tamano=strlen($formatos);
		$formatos=substr($formatos,0,$tamano-1);
		
		$sql="UPDATE funciones_formato SET formato='".$formatos."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
	}
	guardar_traza($sql,$formato[0]["nombre_tabla"]);
	phpmkr_query($sql);
}
function desvincular_funcion_digitalizacion($idformato,$x_banderas){
	global $conn;
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='digitalizar_formato'","",$conn);
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if(in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$formats=explode(",",$buscar_funcion[0]["formato"]);
		$cantidad=count($formats);
		for($i=0;$i<$cantidad;$i++){
			if($formats[$i]!=$idformato)
				$formatos.=$formats[$i].",";
		}
		$tamano=strlen($formatos);
		$formatos=substr($formatos,0,$tamano-1);
		
		$sql="UPDATE funciones_formato SET formato='".$formatos."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
		guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql);
	}
	//------------------------------------------------------
	$buscar_funcion=busca_filtro_tabla("","funciones_formato A","nombre_funcion='validar_digitalizacion_formato'","",$conn);
	if(in_array($idformato,explode(",",$buscar_funcion[0]["formato"]))){
		$formats=explode(",",$buscar_funcion[0]["formato"]);
		$cantidad=count($formats);
		for($i=0;$i<$cantidad;$i++){
			if($formats[$i]!=$idformato)
				$formatos.=$formats[$i].",";
		}
		$tamano=strlen($formatos);
		$formatos=substr($formatos,0,$tamano-1);
		
		$sql="UPDATE funciones_formato SET formato='".$formatos."' WHERE idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"];
		guardar_traza($sql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sql);
	}
	//--------------------------------------------------------
	$buscar_funcion_accion=busca_filtro_tabla("","funciones_formato_accion","idfunciones_formato=".$buscar_funcion[0]["idfunciones_formato"]." AND formato_idformato=".$idformato,"",$conn);
	if($buscar_funcion_accion["numcampos"]){
		$sql="DELETE FROM funciones_formato_accion WHERE idfunciones_formato_accion=".$buscar_funcion_accion[0]["idfunciones_formato_accion"];
		guardar_traza($sql);
		phpmkr_query($sql);
	}
}
function vincular_campo_anexo($idformato){
	global $conn;
	$buscar_campo=busca_filtro_tabla("","campos_formato A","formato_idformato=".$idformato." AND nombre='anexo_formato'","",$conn);
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if($buscar_campo["numcampos"]==0){
		$campo="INSERT INTO campos_formato(formato_idformato, nombre, etiqueta, tipo_dato, longitud, obligatoriedad, acciones, predeterminado, etiqueta_html, orden, valor) VALUES(".$idformato.",'anexo_formato', 'Anexos digitales', 'VARCHAR', '255', 0, 'a,e,b', '".$idflujo."', 'archivo', 0, '')";
	}
	else{
		$campo="UPDATE campos_formato SET formato_idformato=".$idformato.", nombre='anexo_formato', etiqueta='Anexos digitales', tipo_dato='VARCHAR', longitud='255', obligatoriedad='0', acciones='a,e,b', predeterminado='".$idflujo."', etiqueta_html='archivo', valor='' WHERE idcampos_formato=".$buscar_campo[0]["idcampos_formato"];
	}
	guardar_traza($campo,$formato[0]["nombre_tabla"]);
	phpmkr_query($campo);
}
function desvincular_campo_anexo($idformato){
	global $conn;
	$buscar_campo=busca_filtro_tabla("","campos_formato A","formato_idformato=".$idformato." AND nombre='anexo_formato'","",$conn);
	$formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
	if($buscar_campo["numcampos"]>0){
		$campo="DELETE FROM campos_formato WHERE idcampos_formato=".$buscar_campo[0]["idcampos_formato"];
	}
	guardar_traza($campo,$formato[0]["nombre_tabla"]);
	phpmkr_query($campo);
}
?>
