<?php session_start(); ?>
<?php ob_start(); ?>
<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 

include ($ruta_db_superior."db.php");
include ($ruta_db_superior."librerias_saia.php");

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

include_once("librerias/funciones.php");

// Initialize common variables
$x_idcampos_formato = Null;
$x_formato_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_tipo_dato = "INT";
$x_longitud = Null;
$x_obligatoriedad = Null;
$x_acciones = Null;
$x_etiqueta_html = Null;
$x_valor = Null;
$x_predeterminado = Null;
$x_ayuda = Null;
$x_autoguardado = Null;
$idformato=@$_REQUEST["idformato"];
$x_banderas =array();
?>

<?php include ($ruta_db_superior."phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
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
	$x_ayuda = @$_POST["x_ayuda"];
	$x_banderas = @$_POST["x_banderas"]; 
  $x_autoguardado = @$_POST["x_autoguardado"];
}

switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
      alerta("No se ha podido encontrar el campo original del formato");
			redirecciona("campos_formatolist.php?idformato=".$idformato);
			exit();
		}
		break;
	case "A": // Add
		if (AddData($conn)) { // Add New Record
      alerta("Adicion Exitosa"); 
			redirecciona("campos_formatolist.php?idformato=".$idformato);
		}
		break;
}
?>
<?php 
echo(librerias_jquery());
include ($ruta_db_superior."header.php"); 

?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>ew.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate.js"></script>
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
 	$("#action").attr("disabled",true);
 	$("#x_nombre").keyup(function(){
 		var texto=$(this).val();
 		texto=texto.replace(/[^a-zA-Z0-9_]/,'')
 		$(this).val(texto.toLowerCase());
 	});
 	/*Valida que el nombre del campo no este repetido*/
 	$("#x_nombre").change(function(){
 		$("#action").attr("disabled",false);
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
	for(i=1;i<11;i++){
		cadena+='<option value="'+i+'">'+i+'</option>';
	}
	cadena+='<option value="11" selected>11</option>';
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
 					if(i==255)
 						cadena+=' selected '; 					
 					cadena+='">'+i+'</option>';
 					
 				}
				$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 			break;
 			case "INT":
 				cadena='';
 				for(i=1;i<11;i++){
 					cadena+='<option value="'+i+'">'+i+'</option>';
 				}
 				cadena+='<option value="11" selected>11</option>';
 				$("#div_longitud").html('<select name="x_longitud" id="x_longitud">'+cadena+'</select>');
 			break;
 			case "VARCHAR":
 				cadena='';
 				for(i=1;i<5;i++){
 					cadena+='<option value="'+i+'">'+i+'</option>';
 				}
 				for(i=5;i<260;i+=5){
 					cadena+='<option value="'+i+'"';
 					if(i==255)
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
	$('#campos_formatoadd').validate({
		submitHandler: function(form) {
				<?php encriptar_sqli("campos_formatoadd",0,"form_info",$ruta_db_superior);?>
			    form.submit();
			    
			  }
	});
	});
<!--
function EW_checkMyForm(EW_this) {
	//PALABRAS RESERVADAS EN LOS CAMPOS
var palabras_reservadas_saia=Array("select","insert","update","delete","input");
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
<p><span class="phpmaker">Campos del Formato<br><br>
<?php
if(!isset($_REQUEST["pantalla"]))
{
?>
<a href="campos_formatolist.php?idformato=<?php echo(@$_REQUEST["idformato"]);?>">Listado de Campos</a></span>
<?php }
else
  echo "<script>document.getElementById('header').style.display='none';</script>";
 ?>
</p>
<form name="campos_formatoadd" id="campos_formatoadd" action="campos_formatoadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<input type="hidden" name="idformato" id="idformato" value="<?php echo @$_REQUEST["idformato"];?>">
<?php
if(!isset($_REQUEST["pantalla"]))
{echo '<input type="hidden" name="pantalla" value="'.$_REQUEST["pantalla"].'">';
}
?>

<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_formato_idformato)) || ($x_formato_idformato == "")) { $x_formato_idformato = @$_REQUEST["idformato"];} // Set default value ?>
<?php
$x_formato_idformatoList = "<select name=\"x_formato_idformato\">";
$condicionf="";
if($x_formato_idformato){
  $condicionf=" WHERE idformato=".$x_formato_idformato;
}
$sSqlWrk = "SELECT DISTINCT idformato, nombre, etiqueta FROM formato ".$condicionf." ORDER BY etiqueta Asc";
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
$datos_formato=busca_filtro_tabla("item","formato","idformato=$x_formato_idformato","",$conn);
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" maxlength="20" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<table style="text-transform:Uppercase;"><tr><td>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "INT") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("INT"); ?>">
<?php echo "Entero"; ?>
<?php echo EditOptionSeparator(0); ?><br>
<!--<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "NUMBER") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("NUMBER"); ?>">
<?php echo "N&uacute;mero"; ?>
<?php echo EditOptionSeparator(1); ?><br>-->
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "BLOB") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("BLOB"); ?>">
<?php echo "Binario"; ?>
<?php echo EditOptionSeparator(1); ?><br>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DOUBLE") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DOUBLE"); ?>">
<?php echo "Doble"; ?>
<?php echo EditOptionSeparator(2); ?><br>
</td><td>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "CHAR") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("CHAR"); ?>">
<?php echo "Caracter"; ?>
<?php echo EditOptionSeparator(3); ?><br>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "VARCHAR") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("VARCHAR"); ?>">
<?php echo "Caracter Variable"; ?>
<?php echo EditOptionSeparator(4); ?><br>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "TEXT") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TEXT"); ?>">
<?php echo "Texto"; ?>
<?php echo EditOptionSeparator(5); ?><br>
</td><td>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DATE") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DATE"); ?>">
<?php echo "Fecha"; ?>
<?php echo EditOptionSeparator(6); ?><br>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "TIME") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TIME"); ?>">
<?php echo "Hora"; ?>
<?php echo EditOptionSeparator(7); ?><br>
<input type="radio" name="x_tipo_dato"<?php if (@$x_tipo_dato == "DATETIME") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("DATETIME"); ?>">
<?php echo "Fecha y Hora"; ?>
<?php echo EditOptionSeparator(8); ?><br>
</td></tr></table>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Longitud</span></td>
		<td bgcolor="#F5F5F5">
			<span class="phpmaker">
				<div id="div_longitud">
					<input type="text" name="x_longitud" id="x_longitud" value="<?php echo htmlspecialchars(@$x_longitud) ?>">
				</div>
			</span>
		</td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_obligatoriedad" value="0"> Nulo
<input type="radio" name="x_obligatoriedad" value="1" checked> Obligatorio
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Banderas</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <input type="checkbox" name="x_banderas[]"  <?php if(in_array("u",$x_banderas)){echo("CHECKED"); } ?> value="u">&Uacute;nico
        <input type="checkbox" name="x_banderas[]"  <?php if(in_array("i",$x_banderas)){echo("CHECKED"); } ?> value="i"> Indice
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
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Acciones o Formularios</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_acciones)) || ($x_acciones == "")) { $x_acciones = "a,e,b";} // Set default value ?>
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
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta html</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_etiqueta_html)) || ($x_etiqueta_html == "")) { $x_etiqueta_html = "text";} // Set default value ?>
<table style="text-transform:Uppercase;"><tr><td>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "etiqueta") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("etiqueta"); ?>">
<?php echo "Etiqueta(No se almacena)"; ?>
<?php echo EditOptionSeparator(0); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "text") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("text"); ?>">
<?php echo "Cuadro de Texto"; ?>
<?php echo EditOptionSeparator(0); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "password") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("password"); ?>">
<?php echo "Contrase&ntilde;a"; ?>
<?php echo EditOptionSeparator(1); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "textarea") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("textarea"); ?>">
<?php echo "Area de Texto"; ?>
<?php echo EditOptionSeparator(2); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "radio") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("radio"); ?>">
<?php echo "Boton de Selecci&oacute;n"; ?>
<?php echo EditOptionSeparator(3); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "checkbox") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("checkbox"); ?>">
<?php echo "Cuadro de Chequeo"; ?> </td><td>
<?php echo EditOptionSeparator(4); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "select") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("select"); ?>">
<?php echo "Lista Deplegable"; ?>
<?php echo EditOptionSeparator(5); ?>   <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "dependientes") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("dependientes"); ?>"> 
<?php echo "Listado Dependiente"; ?>

<?php echo EditOptionSeparator(7); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "hidden") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("hidden"); ?>">
<?php echo "Oculto"; ?>
<?php echo EditOptionSeparator(9); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "arbol") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("arbol"); ?>">
<?php echo "Arbol"; ?> 
<?php echo EditOptionSeparator(10); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "fecha") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("fecha"); ?>">
<?php echo "fecha"; ?>  </td><td>   
<?php echo EditOptionSeparator(11); ?><br>
<?php
if(!$datos_formato[0]["item"]){
?><input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "archivo") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("archivo"); ?>">
<?php echo "archivo";}?> 
<?php echo EditOptionSeparator(12); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "detalle") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("detalle"); ?>">
<?php echo "detalle"; ?>
<?php echo EditOptionSeparator(13); ?>   <br>
<?php
if(!$datos_formato[0]["item"]){
?><input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "item") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("item"); ?>">
<?php echo "item"; } ?>
<?php echo EditOptionSeparator(14); ?><br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "valor") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("valor"); ?>">
<?php echo "Valor"; ?>
<?php echo EditOptionSeparator(15); ?> <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "ejecutor") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ejecutor"); ?>">
<?php echo "Remitente"; ?> <?php echo EditOptionSeparator(16); ?>   <br>
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "spin") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("spin"); ?>">
<?php echo "Lista num&eacute;rica"; ?>
<?php echo EditOptionSeparator(17); ?>   <br> 
<input type="radio" name="x_etiqueta_html"<?php if (@$x_etiqueta_html == "link") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("link"); ?>">
<?php echo "Enlace"; ?>
</td></tr></table>
</span></td>
	</tr>
	<tr>
	
		<td class="encabezado">
    <span class="phpmaker" style="color: #FFFFFF;">Valor Llenado</span></td>
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
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Mensaje de Ayuda</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_ayuda" name="x_ayuda"><?php echo @$x_ayuda; ?></textarea>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="ADICIONAR" id="action"> 
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
  global $x_idcampos_formato, $x_formato_idformato, $x_nombre, $x_etiqueta, $x_tipo_dato, $x_longitud, $x_obligatoriedad, $x_banderas,
  	$x_acciones, $x_etiqueta_html, $x_valor, $x_predeterminado, $x_ayuda;
 
		// Get the field contents
		$x_idcampos_formato = $row["idcampos_formato"];
		$x_formato_idformato = $row["formato_idformato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_tipo_dato = $row["tipo_dato"];
		$x_longitud = $row["longitud"];
		$x_obligatoriedad = $row["obligatoriedad"];
		$x_acciones = $row["acciones"];
		$x_etiqueta_html = $row["etiqueta_html"];
		$x_valor = $row["valor"];
		$x_predeterminado = $row["predeterminado"];
		$x_ayuda = $row["ayuda"];
		$x_autoguardado = $row["x_autoguardado"];
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
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
global $x_autoguardado,$x_idcampos_formato, $x_formato_idformato, $x_nombre, $x_etiqueta, $x_tipo_dato, $x_longitud, $x_obligatoriedad,$x_banderas,
  	$x_acciones, $x_etiqueta_html, $x_valor, $x_predeterminado, $x_ayuda;
 	$formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["idformato"],"",$conn);
	// Add New Record
	$sSql = "SELECT * FROM campos_formato";
	$sSql .= " WHERE 0 = 1";
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

	// Field formato_idformato
	$theValue = ($x_formato_idformato != "") ? intval($x_formato_idformato) : "NULL";
	$fieldList["formato_idformato"] = $theValue;

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field etiqueta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta"] = $theValue;
  // Field autoguardado
  $fieldList["autoguardado"] =$x_autoguardado ;
    if($fieldList["autoguardado"]<>1)
      $fieldList["autoguardado"]=0; 
	// Field tipo_dato
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_tipo_dato) : $x_tipo_dato; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["tipo_dato"] = $theValue;

	// Field longitud
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_longitud) : $x_longitud; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["longitud"] = $theValue;

	// Field obligatoriedad
	$theValue = ($x_obligatoriedad != "") ? intval($x_obligatoriedad) : "NULL";
	$fieldList["obligatoriedad"] = $theValue;

	// Field acciones
	if(is_array($x_acciones))
	 $theValue = implode(",", $x_acciones);
	else $theValue=""; 
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["acciones"] = $theValue;
	
		// Field banderas
	if(is_array($x_banderas))	
	 $theValue = implode(",",@$x_banderas);
	else $theValue=""; 
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["banderas"] = $theValue;

	// Field etiqueta_html
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta_html) : $x_etiqueta_html; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["etiqueta_html"] = $theValue;

	// Field valor
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_valor) : $x_valor; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["valor"] = $theValue;
  if(strpos($GLOBALS["x_valor"],"*}")>0)
    {$existe=busca_filtro_tabla("","funciones_formato","nombre='".$x_valor."'","",$conn);
     if(!$existe["numcampos"])
        $redirecciona="funciones_formatoadd.php?adicionar=".$x_valor."&idformato=".$x_formato_idformato;
     else
        {
         $formatos_func=busca_filtro_tabla("formato","funciones_formato","idfunciones_formato=".$existe[0]["idfunciones_formato"],"",$conn);
         $vector_f=explode(",",$formatos_func[0][0]);
         if(!in_array($x_formato_idformato,$vector_f))
             {$vector_f[]=$x_formato_idformato;
              $sqlf="UPDATE funciones_formato SET formato='".implode(",",$vector_f)."' WHERE idfunciones_formato=".$existe[0]["idfunciones_formato"];
			  guardar_traza($sqlf,$formato[0]["nombre_tabla"]);
              phpmkr_query($sqlf,$conn) or error("Falla Al Ejecutar ".$sqlf." <br /> Al Generar el Formato.");
             } 
        }    
    }
	// Field predeterminado
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_predeterminado) : $x_predeterminado; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["predeterminado"] = $theValue;

	// Field ayuda
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ayuda) : $x_ayuda; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["ayuda"] = $theValue;

	// insert into database
	$strsql = "INSERT INTO campos_formato (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	guardar_traza($strsql,$formato[0]["nombre_tabla"]);
	phpmkr_query($strsql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $strsql);

 if(!isset($_REQUEST["pantalla"]))
  {$redirecciona="../tinymce34/jscripts/tiny_mce/plugins/formatos/formatos.php?formato=".$fieldList["formato_idformato"]."&tipo=campos_formato";
  }
  if(isset($redirecciona))
	    redirecciona($redirecciona);
	return true;
}
?>
