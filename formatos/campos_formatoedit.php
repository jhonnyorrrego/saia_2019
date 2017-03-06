<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

// Initialize common variables
$x_idcampos_formato = Null;
$x_formato_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_tipo_dato = Null;
$x_longitud = Null;  
$x_autoguardado = Null;
$x_obligatoriedad = Null;
$x_acciones = Null;
$x_etiqueta_html = Null;
$x_valor = Null;
$x_predeterminado = Null;
$x_mascara = Null;
$x_ayuda = Null;
$x_banderas =array();
?>
<?php include ("db.php") ?>
<?php
include ("phpmkrfn.php");
include_once("librerias/funciones.php");
include_once($ruta_db_superior."librerias_saia.php");
?>
<?php
$idformato=@$_REQUEST["idformato"];
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idcampos_formato = @$_POST["x_idcampos_formato"];
	$x_formato_idformato = @$_POST["x_formato_idformato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_tipo_dato = @$_POST["x_tipo_dato"];
	$x_longitud = @$_POST["x_longitud"];
	$x_obligatoriedad = @$_POST["x_obligatoriedad"];
	$x_acciones = @$_POST["x_acciones"];
	$x_etiqueta_html = @$_POST["x_etiqueta_html"];
	$x_valor = @$_POST["x_valor"];
	$x_predeterminado = @$_POST["x_predeterminado"];
	$x_mascara = @$_POST["x_mascara"];
	$x_ayuda = @$_POST["x_ayuda"];
	$idformato=@$_POST["x_formato_idformato"];
	$x_banderas=@$_POST["x_banderas"]; 
  $x_autoguardado=@$_POST["x_autoguardado"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: campos_formatolist.php");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			redirecciona("campos_formatolist.php?idformato=".$idformato);
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			alerta("Edicion exitosa");
			if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
			  redirecciona("../tinymce34/jscripts/tiny_mce/plugins/formatos/formatos.php?formato=".$idformato."&tipo=campos_formato");
			else
			  redirecciona("campos_formatolist.php?idformato=".$idformato);
		}
		break;
}
?>
<?php include ($ruta_db_superior."header.php");
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
{echo '<script type="text/javascript">
document.getElementById("header").style.display="none";
</script>';
}
 echo(librerias_jquery());
 ?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<script type="text/javascript">
	 $().ready(function() {
 	//Elimina espacios y convierte el texto en minuscula
 	$("#x_nombre").keyup(function(){
 		var texto=$(this).val();
 		texto=texto.replace(/[^a-zA-Z0-9_]/,'')
 		$(this).val(texto.toLowerCase());
 	});
 	/*Valida que el nombre del campo no este repetido*/
 	$("#x_nombre").change(function(){
 		$.ajax({
           url: "validar_nombres.php?campo="+$("#x_nombre").val()+"&idformato=<?php echo($_REQUEST["idformato"]); ?>",
           type: "POST",
           success : function(data){
           	if(data==1){
           		$("#action").attr("disabled",true);
           		alert("El campo ya existe en este formato. Por favor verifique.");
           	}else{
           		$("#action").attr("disabled",false);
           	}
           }
       	});
 	});
 	cadena='';
 	
 	if($("input[name='x_tipo_dato']:checked").val()=='VARCHAR'){
 		for(i=1;i<5;i++){
 			cadena+='<option value="'+i+'">'+i+'</option>';
 		}
 		for(i=5;i<260;i+=5){
 			cadena+='<option value="'+i+'"';
 			if(i==<?php echo($x_longitud);?>)
 				cadena+=' selected ';
 			cadena+='">'+i+'</option>';
 		}
 	}else if($("input[name='x_tipo_dato']:checked").val()=='INT'){
 		for(i=1;i<12;i++){
 			cadena+='<option value="'+i+'"';
 			if(i==<?php echo($x_longitud);?>)
 				cadena+=' selected ';
 			cadena+='>'+i+'</option>';
 		}
 	}
	
	//cadena+='<option value="11" selected>11</option>';
	$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 	$("[name='x_tipo_dato']").change(function (){
 		var cadena="";
 		var i=0;
 		switch($(this).val()){
 			case "CHAR":
 				cadena='';
 				for(i=1;i<5;i++){
 					cadena+='<option value="'+i+'">'+i+'</option>';
 				}
 				for(i=5;i<260;i+=5){
 					cadena+='<option value="'+i+'"';
 					if(i==<?php echo($x_longitud);?>)
 						cadena+=' selected '; 					
 					cadena+='">'+i+'</option>';
 					
 				}
				$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 			break;
 			case "INT":
 				cadena='';
 				for(i=1;i<12;i++){
 					cadena+='<option value="'+i+'"';
 					if(i==<?php echo($x_longitud);?>)
 						cadena+=' selected ';
 					cadena+='>'+i+'</option>';
 				}
 				$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 			break;
 			case "VARCHAR":
 				cadena='';
 				for(i=1;i<5;i++){
 					cadena+='<option value="'+i+'">'+i+'</option>';
 				}
 				for(i=5;i<260;i+=5){
 					cadena+='<option value="'+i+'"';
 					if(i==<?php echo($x_longitud);?>)
 						cadena+=' selected '; 					
 					cadena+='">'+i+'</option>';
 					
 				}
 				$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 			break;
 			default:
 				$("#div_longitud").html('<input type="hidden" value="" name="x_longitud" id="x_longitud">No aplica');
 			break;
 		}
 	});
	// validar los campos del formato
	$('#formatoadd').validate();
	});
<!--
function EW_checkMyForm(EW_this) {
var palabras_reservadas_saia=Array("select","insert","update","delete","input","idserie");
if (EW_this.x_formato_idformato && !EW_hasValue(EW_this.x_formato_idformato, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_formato_idformato, "SELECT", "Por favor inserte el Formato asociado"))
		return false;
}
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor inserte el nombre del campo"))
		return false;	
}
else if(palabras_reservadas_saia.indexOf(EW_this.x_nombre.value)!=-1){
	alert("La palabra '"+EW_this.x_nombre.value+"' no es una palabra permitida como nombre de campo.");
	EW_this.x_nombre.focus();
	return false;
}
if (EW_this.x_etiqueta && !EW_hasValue(EW_this.x_etiqueta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_etiqueta, "TEXT", "Por favor inserte la Etiqueta a mostrar"))
		return false;
}
if (EW_this.x_tipo_dato && !EW_hasValue(EW_this.x_tipo_dato, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo_dato, "RADIO", "Por favor inserte el tipo de dato"))
		return false;
}
if (EW_this.x_obligatoriedad && !EW_hasValue(EW_this.x_obligatoriedad, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_obligatoriedad, "RADIO", "Por favor inserte la Obligatoriedad del Campo (Nulo u Obligatorio)"))
		return false;
}
if (EW_this.x_acciones && !EW_hasValue(EW_this.x_acciones, "CHECKBOX" )) {
	if (!EW_onError(EW_this, EW_this.x_acciones, "CHECKBOX", "Por favor inserte Los lugares donde debe aparecer el campo"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Modificar Campos del Formato</span></p>
<form name="campos_formatoedit" id="campos_formatoedit" action="campos_formatoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<?php
if(isset($_REQUEST["pantalla"])&&$_REQUEST["pantalla"]=="tiny")
   echo '<input type="hidden" name="pantalla" value="tiny">';
?>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idcampos formato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<b><?php echo $x_idcampos_formato; ?></b><input type="hidden" name="x_idcampos_formato" value="<?php echo $x_idcampos_formato; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_formato_idformatoList = "<select name=\"x_formato_idformato\">";
$x_formato_idformatoList .= "<option value=''>Please Select</option>";
$sSqlWrk = "SELECT DISTINCT idformato, nombre, etiqueta FROM formato";
if(@$idformato){
  $sSqlWrk.=" WHERE idformato=".$idformato;
}
$sSqlwrk.= " ORDER BY etiqueta Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_formato_idformatoList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idformato"] == @$x_formato_idformato) {
			$x_formato_idformatoList .= "' selected";
		}
		$x_formato_idformatoList .= ">" . $datawrk["nombre"] . ValueSeparator($rowcntwrk) . $datawrk["etiqueta"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_formato_idformatoList .= "</select>";
echo $x_formato_idformatoList;
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" maxlength="20" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo ((@$x_etiqueta)); ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "INT") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("INT"); ?>">
<?php echo "Entero"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "NUMBER") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("NUMBER"); ?>">
<?php echo "N&uacute;mero"; ?>
<?php echo EditOptionSeparator(1); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DOUBLE") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DOUBLE"); ?>">
<?php echo "Doble"; ?>
<?php echo EditOptionSeparator(2); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "CHAR") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("CHAR"); ?>">
<?php echo "Caracter"; ?>
<?php echo EditOptionSeparator(3); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "VARCHAR") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("VARCHAR"); ?>">
<?php echo "Caracter Variable"; ?>
<?php echo EditOptionSeparator(4); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "TEXT") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TEXT"); ?>">
<?php echo "Texto"; ?>
<?php echo EditOptionSeparator(5); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DATE") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DATE"); ?>">
<?php echo "Fecha"; ?>
<?php echo EditOptionSeparator(6); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "TIME") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TIME"); ?>">
<?php echo "Hora"; ?>
<?php echo EditOptionSeparator(7); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DATETIME") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DATETIME"); ?>">
<?php echo "Fecha y Hora"; ?>
<?php echo EditOptionSeparator(8); ?>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "BLOB") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("BLOB"); ?>">
<?php echo "Binario"; ?>
<?php echo EditOptionSeparator(9); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Longitud</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<div id="div_longitud">
					<input type="text" name="x_longitud" id="x_longitud" value="<?php echo htmlspecialchars(@$x_longitud) ?>">
				</div>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_obligatoriedad"<?php if (@$x_obligatoriedad == "0") { ?> checked<?php } ?> value="0">
<?php echo "Nulo"; ?>
<input type="radio" name="x_obligatoriedad"<?php if (@$x_obligatoriedad == "1") { ?> checked<?php } ?> value="1">
<?php echo "Obligatorio"; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Banderas</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="checkbox" name="x_banderas[]"  <?php if(in_array("u",$x_banderas)){echo("CHECKED");} ?> value="u">&Uacute;inco
        <input type="checkbox" name="x_banderas[]"  <?php if(in_array("i",$x_banderas)){echo("CHECKED"); } ?> value="i"> Indice
        <!--input type="checkbox" name="x_banderas[]"  <?php if(in_array("pk",$x_banderas)){echo("CHECKED"); } ?> value="pk"> Llave Primaria
        <input type="checkbox" name="x_banderas[]"  <?php if(in_array("ai",$x_banderas)){echo("CHECKED"); } ?> value="ai"> Auto incremental -->                
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Campo Funcionario?</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="radio" name="x_banderas[]"  <?php if(in_array("ffc",$x_banderas)){echo("CHECKED"); } ?> value="ffc">funcionario_codigo
        <input type="radio" name="x_banderas[]"  <?php if(in_array("fdc",$x_banderas)){echo("CHECKED"); } ?> value="fdc">iddependencia_cargo
        <input type="radio" name="x_banderas[]"  <?php if(in_array("fid",$x_banderas)){echo("CHECKED"); } ?> value="fid">idfuncionario        
        <input type="radio" name="x_banderas[]"  <?php if(in_array("fc",$x_banderas)){echo("CHECKED"); } ?> value="fc">idcargo
        <input type="radio" name="x_banderas[]"  value="">Ninguno
      </span>
    </td>
	</tr>	
	
	
	<tr>
  <td class="encabezado">Caracter&iacute;sticas Adicionales</td>
  <td bgcolor="#F5F5F5" >
  <div class="textwrapper">
			<a href="caracteristicas_campos.php?idformato=<?php echo $x_formato_idformato; ?>&idcampo=<?php echo $x_idcampos_formato; ?>" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )">Administrar</a>
  </div>
  </td>
  </tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Acciones o Formularios</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_acciones = explode(",",@$x_acciones);
$x_accionesChk = "";
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "a") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Adicionar" . EditOptionSeparator(0);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "e") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Editar" . EditOptionSeparator(1);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("p"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "p") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Descripcion" . EditOptionSeparator(2);
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("d"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "d") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Detalles" . EditOptionSeparator(3);	
$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("b"). "\"";
foreach ($ar_x_acciones as $cnt_x_acciones) {
	if (trim($cnt_x_acciones) == "b") {
		$x_accionesChk .= " checked";
		break;
	}
}
	$x_accionesChk .= ">" . "Busqueda" . EditOptionSeparator(4);

$x_accionesChk .= "<input type=\"checkbox\" name=\"x_autoguardado\" value=\"1\"";
	if (trim($x_autoguardado) == "1") {
		$x_accionesChk .= " checked";
	}
	$x_accionesChk .= ">Autoguardado"; 	
echo $x_accionesChk;
$datos_formato=busca_filtro_tabla("item","formato","idformato=$idformato","",$conn);
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta html</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker"> <table width="100%" ><tr><td>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "etiqueta") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("etiqueta"); ?>">
<?php echo "Etiqueta(No se almacena)"; ?><br>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "text") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("text"); ?>">
<?php echo "Cuadro de Texto"; ?><br>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "password") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("password"); ?>">
<?php echo "Contrase&ntilde;a"; ?><br>
<?php echo EditOptionSeparator(1); ?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "textarea") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("textarea"); ?>">
<?php echo "Area de Texto"; ?>
<?php echo EditOptionSeparator(2); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "radio") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("radio"); ?>">
<?php echo "Boton de Selecci&oacute;n"; ?><br>
<?php echo EditOptionSeparator(3); ?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "checkbox") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("checkbox"); ?>">
<?php echo "Cuadro de Chequeo"; ?> </td><td>   
<?php echo EditOptionSeparator(4); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "select") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("select"); ?>">
<?php echo "Lista Deplegable"; ?>
<?php echo EditOptionSeparator(5); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "dependientes") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("dependientes"); ?>">
<?php echo "Listado Dependiente"; ?>
<?php echo EditOptionSeparator(7); ?> <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "hidden") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("hidden"); ?>">
<?php echo "Oculto"; ?>
<?php echo EditOptionSeparator(9); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "arbol") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("arbol"); ?>">
<?php echo "Arbol"; ?>
<?php echo EditOptionSeparator(10); ?>  <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "fecha") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("fecha"); ?>">
<?php echo "fecha"; ?>
<?php echo EditOptionSeparator(11); ?></td><td>
<?php
if(!$datos_formato[0]["item"]){
?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "archivo") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("archivo"); ?>">
<?php 
echo "archivo<br>"; 
}
?><?php echo EditOptionSeparator(12); ?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "detalle") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("detalle"); ?>">
<?php echo "detalle"; ?>
<?php echo EditOptionSeparator(13); ?><br>
<?php
if(!$datos_formato[0]["item"]){
?>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "item") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("item"); ?>">
<?php echo "item"; } ?>
<?php echo EditOptionSeparator(14); ?>  <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "valor") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("valor"); ?>">
<?php echo "valor"; ?>
<?php echo EditOptionSeparator(15); ?>   <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "ejecutor") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ejecutor"); ?>">
<?php echo "Remitente"; ?>
<?php echo EditOptionSeparator(16); ?>   <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "spin") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("spin"); ?>">
<?php echo "Lista num&eacute;rica"; ?>
<?php echo EditOptionSeparator(17); ?>   <br> 
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "link") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("link"); ?>">
<?php echo "Enlace"; ?>
</td></tr></table></span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Llenado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<a href="ayuda_campos.html" class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 550, height:400,preserveContent:false } )">Ayuda</a><br>
<textarea cols="35" rows="4" id="x_valor" name="x_valor"><?php echo @$x_valor; ?></textarea>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Predeterminado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_predeterminado" id="x_predeterminado" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_predeterminado) ?>">
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&aacute;cara del Campo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_mascara" id="x_mascara" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_mascara) ?>">
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Mensaje de Ayuda</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_ayuda" name="x_ayuda"><?php echo @$x_ayuda; ?></textarea>
</span></td>
	</tr>
</table>
<p>
<button name="Action" id="action">EDITAR</button>
</form>
<?php include ("footer.php") ?>
<?php
//phpmkr_db_close($conn);
?>
<?php
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
  global $x_banderas;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM campos_formato";
	$sSql .= " WHERE idcampos_formato = " . $sKeyWrk;
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
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idcampos_formato"] = $row["idcampos_formato"];
		$GLOBALS["x_formato_idformato"] = $row["formato_idformato"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_etiqueta"] = $row["etiqueta"];
		$GLOBALS["x_tipo_dato"] = $row["tipo_dato"];
		$GLOBALS["x_longitud"] = $row["longitud"];
		$GLOBALS["x_obligatoriedad"] = $row["obligatoriedad"];
		$GLOBALS["x_acciones"] = $row["acciones"];
		$GLOBALS["x_etiqueta_html"] = $row["etiqueta_html"];
		$GLOBALS["x_valor"] = $row["valor"];
		$GLOBALS["x_predeterminado"] = $row["predeterminado"];
		$GLOBALS["x_ayuda"] = $row["ayuda"];
		$GLOBALS["x_mascara"] = $row["mascara"];   
    $GLOBALS["x_autoguardado"] = $row["autoguardado"];
		if($row["banderas"])
		  $x_banderas=explode(",",$row["banderas"]);
		else $x_banderas=array();  
	}
	phpmkr_free_result($rs);
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
  global $x_banderas;
	// Open record
	$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM campos_formato";
	$sSql .= " WHERE idcampos_formato = " . $sKeyWrk;
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
		$theValue = ($GLOBALS["x_formato_idformato"] != "") ? intval($GLOBALS["x_formato_idformato"]) : "NULL";
		$fieldList["formato_idformato"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_etiqueta"]) : $GLOBALS["x_etiqueta"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["etiqueta"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_tipo_dato"]) : $GLOBALS["x_tipo_dato"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["tipo_dato"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_longitud"]) : $GLOBALS["x_longitud"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["longitud"] = $theValue;
		$theValue = ($GLOBALS["x_obligatoriedad"] != "") ? intval($GLOBALS["x_obligatoriedad"]) : "NULL";
		$fieldList["obligatoriedad"] = $theValue;
		if(is_array($GLOBALS["x_acciones"]))
		  $theValue = implode(",", $GLOBALS["x_acciones"]);
		else $theValue="";  
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["acciones"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_etiqueta_html"]) : $GLOBALS["x_etiqueta_html"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["etiqueta_html"] = $theValue;
  	if(is_array($x_banderas))	
  	 $theValue = implode(",",@$x_banderas);
  	else $theValue=""; 
  	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
  	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  	$fieldList["banderas"] = $theValue;
    $theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_valor"]) : $GLOBALS["x_valor"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["valor"] = $theValue;
		if(strpos($GLOBALS["x_valor"],"*}")>0)
    {$existe=busca_filtro_tabla("","funciones_formato","nombre='".$GLOBALS["x_valor"]."'","",$conn);
     if(!$existe["numcampos"])
        $redirecciona="funciones_formatoadd.php?adicionar=".$GLOBALS["x_valor"]."&idformato=".$GLOBALS["x_formato_idformato"];
     else
        {
          if($existe[0]["ruta"]!="../librerias/funciones_generales"){
            $formatos_func=busca_filtro_tabla("formato","funciones_formato","idfunciones_formato=".$existe[0]["idfunciones_formato"],"",$conn);
           $vector_f=explode(",",$formatos_func[0][0]);
           if(!in_array($GLOBALS["x_formato_idformato"],$vector_f))
             {$vector_f[]=$GLOBALS["x_formato_idformato"];
              $sqlf="UPDATE funciones_formato SET formato='".implode(",",$vector_f)."' WHERE idfunciones_formato=".$existe[0]["idfunciones_formato"];
			  guardar_traza($sqlf,$formato[0]["nombre_tabla"]);
              phpmkr_query($sqlf,$conn) or error("Falla Al Ejecutar ".$sqlf." <br /> Al Generar el Formato.");
             } 
          }
        }   
    }

    $theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_predeterminado"]) : $GLOBALS["x_predeterminado"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["predeterminado"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_ayuda"]) : $GLOBALS["x_ayuda"]; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ayuda"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_mascara"]) : $GLOBALS["x_mascara"];		
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["mascara"] = $theValue;
		
    $fieldList["autoguardado"] =$GLOBALS["x_autoguardado"] ;
    if($fieldList["autoguardado"]<>1)
      $fieldList["autoguardado"]=0; 
		// update
		$sSql = "UPDATE campos_formato SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idcampos_formato =". $sKeyWrk;
		guardar_traza($sSql,$formato[0]["nombre_tabla"]);
		phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	//die($sSql);
	if(isset($redirecciona))
	    redirecciona($redirecciona);
	return $EditData;
}
?>