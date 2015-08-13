<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php include ("db.php") ?>
<script type="text/javascript"> 
//funcion de ajax para actualizar la posicion del comentario en la imagen.
  function sub_modulos(idmodulo)
  { 
   var param="modulo="+idmodulo;      
   llamado("posicion.php","sub_modulo",param);
  }
 
  function llamado(url, id_contenedor,parametros)
  {
   var pagina_requerida = false
   if (window.XMLHttpRequest) 
  	{// Si es Mozilla, Safari etc
  	 pagina_requerida = new XMLHttpRequest();
  	} 
   else if (window.ActiveXObject)
  	{ // pero si es IE
  	 try 
  		{pagina_requerida = new ActiveXObject("Msxml2.XMLHTTP");
  		} 
  	 catch (e)
  		{ // en caso que sea una versi�n antigua
  		 try
  			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
  			}
  		 catch (e){}
  		}
   	}
   else
  	return false
   pagina_requerida.onreadystatechange=function(){ // funci�n de respuesta
   if(pagina_requerida.readyState==4)
   { 	
  	if(pagina_requerida.status==200)
        {
  			 cargarpagina(pagina_requerida, id_contenedor);
  		  }
     else if(pagina_requerida.status==404)
        {
  		   document.write("La p�gina no existe");
  	    }
    }  
   } 
   pagina_requerida.open('POST', url, true); // asignamos los m�todos open y send
   pagina_requerida.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
   pagina_requerida.send(parametros);
  }

function cargarpagina(pagina_requerida, id_contenedor)
  {
   if (pagina_requerida.readyState == 4 && (pagina_requerida.status==200 || window.location.href.indexOf("http")==-1))
      document.getElementById(id_contenedor).innerHTML=pagina_requerida.responseText;      
      //alert("comentarios.php?key="+doc+"&pag="+pag);
    //parent.centroimg.location="comentario_mostrar.php?key="+doc+"&pag="+pag;  
  }
</script>  
<?php
$ewCurSec = 0; // Initialise

// Initialize common variables
$x_idpermiso = Null;
$x_funcionario_idfuncionario = Null;
$x_modulo_idmodulo = Null;
$x_modulo = Null;
$x_accion = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
?>
<?php include ("phpmkrfn.php") ?>
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
	$x_idpermiso = @$_POST["x_idpermiso"];
	$x_funcionario_idfuncionario = @$_POST["x_funcionario_idfuncionario"];
	$x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];
	/*$x_modulo = @$_POST["x_modulos"];	                               //el mudulo
	if(isset($_POST["x_modulo_idmodulo"]))
	  $x_modulo_idmodulo = implode(',',@$_POST["x_modulo_idmodulo"]);  //sub-modulos   
  else
    $x_modulo_idmodulo = "";*/  		
  $x_accion = @$_POST["x_accion"];
	$x_accion = @$_POST["x_accion"];
	$x_caracteristica_propio = @$_POST["x_caracteristica_propio"];
	$x_caracteristica_grupo = @$_POST["x_caracteristica_grupo"];
	$x_caracteristica_total = @$_POST["x_caracteristica_total"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	redirecciona("funcionariolist.php");
	exit();
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			redirecciona("permisolist.php");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Actualizacion exitosa" . $sKey;			
			alerta("Actualizacion Exitosa");
			abrir_url("funcionario.php?key=".$x_funcionario_idfuncionario,"centro");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function todos_check(elemento)
{ 
   //check=document.getElementById("modulos");
   check=document.getElementsByName(elemento);
   for (i=0;i<check.length;++i)
   {
    check[i].checked=1    
   }  
}
function ninguno_check(elemento)
{ 
   //check=document.getElementById("modulos");
   check=document.getElementsByName(elemento);
   for (i=0;i<check.length;++i)
   {
    check[i].checked=0    
   }  
}

function valida_check(E,elemento)
{
 check = document.getElementsByName(elemento);
 var aux=0; //contador de los check seleccionados
 if(undefined == document.getElementById("modulo"))
 {
   if(E.x_modulos.value=="")
   { alert("Por favor seleccione un modulo para asignarle permisos"); return false}      
 } 
 else
 {
   for(i=0;i<check.length;++i)     
     if(check[i].checked==1)
       aux ++;
   if(aux == 0)
    {alert("Por favor seleccione un item del modulo para asignarle permisos"); return false}
 }   
 return true;  
} 
function EW_checkMyForm(EW_this) {
//alert(EW_this.x_modulo_idmodulo.value);
//return false;
if (EW_this.x_funcionario_idfuncionario && !EW_hasValue(EW_this.x_funcionario_idfuncionario, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_funcionario_idfuncionario, "SELECT", "Por favor ingrese los campos requeridos - Funcionario"))
		return false;
}
//if(!(valida_check(EW_this,"x_modulo_idmodulo[]")))
if(EW_this.x_modulo_idmodulo.value=="")
{alert("Por favor seleccione un modulo para asignarle permisos");
 return false;
} 
 
if (EW_this.x_modulo_idmodulo && !EW_hasValue(EW_this.x_modulo_idmodulo, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_modulo_idmodulo, "SELECT", "Por favor ingrese los campos requeridos - Modulo Asignado"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/permiso.gif" border="0">&nbsp;&nbsp;EDITAR PERMISO DE ACCESO<br><br><a href="permisolist.php">Regresar al listado</a>
&nbsp;&nbsp;&nbsp;<a href="permiso_perfiladd.php">Adicionar Permiso para un Perfil</a></span></p>
<form name="permisoedit" id="permisoedit" action="permisoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE PERMISO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idpermiso; ?><input type="hidden" name="x_idpermiso" value="<?php echo $x_idpermiso; ?>">
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FUNCIONARIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
  $x_funcionario_idfuncionarioList = busca_filtro_tabla("nombres,apellidos,login","funcionario","idfuncionario=$x_funcionario_idfuncionario","",$conn);  
  if($x_funcionario_idfuncionarioList["numcampos"]>0)
  {
   echo "<input type='hidden' name='x_funcionario_idfuncionario' value='$x_funcionario_idfuncionario'>";
   echo $x_funcionario_idfuncionarioList[0]["nombres"]." ".$x_funcionario_idfuncionarioList[0]["apellidos"]." - ".$x_funcionario_idfuncionarioList[0]["login"];
  }
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&Oacute;DULO ASIGNADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
 $modulo_list=busca_tabla("modulo",$x_modulo_idmodulo);
 if($modulo_list["numcampos"]>0)
 {echo "<input type='hidden' value='$x_modulo_idmodulo' name='x_modulo_idmodulo'>";
  echo $modulo_list[0]["nombre"];
 }
/*
$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
$rowcntwrk = 0;
if ($rswrk) {
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $datawrk[0];
		$sTmp1 = $datawrk[1];
?>
<input type="radio" name="x_modulo_idmodulo"<?php if (@$x_modulo_idmodulo == $sTmp) {?> checked<?php } ?> value="<?php echo htmlspecialchars($sTmp); ?>"><?php echo $sTmp1; ?><?php echo EditOptionSeparator($rowcntwrk); ?>
<?php
		$rowcntwrk++;
	}
}
phpmkr_free_result($rswrk);*/
?>
</span></td>
<!--td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_modulo_idmodulo)) || ($x_modulo_idmodulo == "")) { $x_modulo_idmodulo = 0;} // Set default value ?>
<?php
$modulos = busca_filtro_tabla("*","modulo","","nombre",$conn);
//cod_padre is Null OR cod_padre = 0 --- onchange='sub_modulos(x_modulos.value);'
$select_modulos = "<select name='x_modulo_idmodulo' disabled='true'><option value=''>Seleccionar..</option>";
if($modulos["numcampos"]>0)
for($i=0; $i<$modulos["numcampos"]; $i++)
{ //die($x_modulo_idmodulo); 
 if($x_modulo_idmodulo==$modulos[$i]["idmodulo"])
  $select_modulos.="<option value=\"".$modulos[$i]["idmodulo"]."\" SELECTED>".$modulos[$i]["nombre"]."</option>"; 
 else 
  $select_modulos.="<option value=\"".$modulos[$i]["idmodulo"]."\">".$modulos[$i]["nombre"]."</option>";
}
$select_modulos.="</select>";
echo $select_modulos;
?>
 <div id="sub_modulo">
 </div></td-->
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARACTER&Iacute;STICA PROPIO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_caracteristica_propio = explode(",",@$x_caracteristica_propio);
$x_caracteristica_propioChk = "";
$x_caracteristica_propioChk .= "<input type=\"checkbox\" name=\"x_caracteristica_propio[]\" value=\"" . htmlspecialchars("l"). "\"";
foreach ($ar_x_caracteristica_propio as $cnt_x_caracteristica_propio) {
	if (trim($cnt_x_caracteristica_propio) == "l") {
		$x_caracteristica_propioChk .= " checked";
		break;
	}
}
	$x_caracteristica_propioChk .= ">" . "leer" . EditOptionSeparator(0);
$x_caracteristica_propioChk .= "<input type=\"checkbox\" name=\"x_caracteristica_propio[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_caracteristica_propio as $cnt_x_caracteristica_propio) {
	if (trim($cnt_x_caracteristica_propio) == "a") {
		$x_caracteristica_propioChk .= " checked";
		break;
	}
}
	$x_caracteristica_propioChk .= ">" . "adicionar" . EditOptionSeparator(1);
$x_caracteristica_propioChk .= "<input type=\"checkbox\" name=\"x_caracteristica_propio[]\" value=\"" . htmlspecialchars("m"). "\"";
foreach ($ar_x_caracteristica_propio as $cnt_x_caracteristica_propio) {
	if (trim($cnt_x_caracteristica_propio) == "m") {
		$x_caracteristica_propioChk .= " checked";
		break;
	}
}
	$x_caracteristica_propioChk .= ">" . "modificar" . EditOptionSeparator(2);
$x_caracteristica_propioChk .= "<input type=\"checkbox\" name=\"x_caracteristica_propio[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_caracteristica_propio as $cnt_x_caracteristica_propio) {
	if (trim($cnt_x_caracteristica_propio) == "e") {
		$x_caracteristica_propioChk .= " checked";
		break;
	}
}
	$x_caracteristica_propioChk .= ">" . "eliminar" . EditOptionSeparator(3);
echo $x_caracteristica_propioChk;
?>
&nbsp;<a href="javascript:todos_check('x_caracteristica_propio[]');">TODOS</a>&nbsp;|
<a href="javascript:ninguno_check('x_caracteristica_propio[]')">NINGUNO</a>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARACTER&Iacute;STICA GRUPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_caracteristica_grupo = explode(",",@$x_caracteristica_grupo);
$x_caracteristica_grupoChk = "";
$x_caracteristica_grupoChk .= "<input type=\"checkbox\" name=\"x_caracteristica_grupo[]\" value=\"" . htmlspecialchars("l"). "\"";
foreach ($ar_x_caracteristica_grupo as $cnt_x_caracteristica_grupo) {
	if (trim($cnt_x_caracteristica_grupo) == "l") {
		$x_caracteristica_grupoChk .= " checked";
		break;
	}
}
	$x_caracteristica_grupoChk .= ">" . "leer" . EditOptionSeparator(0);
$x_caracteristica_grupoChk .= "<input type=\"checkbox\" name=\"x_caracteristica_grupo[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_caracteristica_grupo as $cnt_x_caracteristica_grupo) {
	if (trim($cnt_x_caracteristica_grupo) == "a") {
		$x_caracteristica_grupoChk .= " checked";
		break;
	}
}
	$x_caracteristica_grupoChk .= ">" . "adicionar" . EditOptionSeparator(1);
$x_caracteristica_grupoChk .= "<input type=\"checkbox\" name=\"x_caracteristica_grupo[]\" value=\"" . htmlspecialchars("m"). "\"";
foreach ($ar_x_caracteristica_grupo as $cnt_x_caracteristica_grupo) {
	if (trim($cnt_x_caracteristica_grupo) == "m") {
		$x_caracteristica_grupoChk .= " checked";
		break;
	}
}
	$x_caracteristica_grupoChk .= ">" . "modificar" . EditOptionSeparator(2);
$x_caracteristica_grupoChk .= "<input type=\"checkbox\" name=\"x_caracteristica_grupo[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_caracteristica_grupo as $cnt_x_caracteristica_grupo) {
	if (trim($cnt_x_caracteristica_grupo) == "e") {
		$x_caracteristica_grupoChk .= " checked";
		break;
	}
}
	$x_caracteristica_grupoChk .= ">" . "eliminar" . EditOptionSeparator(3);
echo $x_caracteristica_grupoChk;
?>
&nbsp;<a href="javascript:todos_check('x_caracteristica_grupo[]');">TODOS</a>&nbsp;|
<a href="javascript:ninguno_check('x_caracteristica_grupo[]')">NINGUNO</a>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARACTER&Iacute;STICA TOTAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_caracteristica_total = explode(",",@$x_caracteristica_total);
$x_caracteristica_totalChk = "";
$x_caracteristica_totalChk .= "<input type=\"checkbox\" name=\"x_caracteristica_total[]\" value=\"" . htmlspecialchars("l"). "\"";
foreach ($ar_x_caracteristica_total as $cnt_x_caracteristica_total) {
	if (trim($cnt_x_caracteristica_total) == "l") {
		$x_caracteristica_totalChk .= " checked";
		break;
	}
}
	$x_caracteristica_totalChk .= ">" . "leer" . EditOptionSeparator(0);
$x_caracteristica_totalChk .= "<input type=\"checkbox\" name=\"x_caracteristica_total[]\" value=\"" . htmlspecialchars("a"). "\"";
foreach ($ar_x_caracteristica_total as $cnt_x_caracteristica_total) {
	if (trim($cnt_x_caracteristica_total) == "a") {
		$x_caracteristica_totalChk .= " checked";
		break;
	}
}
	$x_caracteristica_totalChk .= ">" . "adicionar" . EditOptionSeparator(1);
$x_caracteristica_totalChk .= "<input type=\"checkbox\" name=\"x_caracteristica_total[]\" value=\"" . htmlspecialchars("m"). "\"";
foreach ($ar_x_caracteristica_total as $cnt_x_caracteristica_total) {
	if (trim($cnt_x_caracteristica_total) == "m") {
		$x_caracteristica_totalChk .= " checked";
		break;
	}
}
	$x_caracteristica_totalChk .= ">" . "modificar" . EditOptionSeparator(2);
$x_caracteristica_totalChk .= "<input type=\"checkbox\" name=\"x_caracteristica_total[]\" value=\"" . htmlspecialchars("e"). "\"";
foreach ($ar_x_caracteristica_total as $cnt_x_caracteristica_total) {
	if (trim($cnt_x_caracteristica_total) == "e") {
		$x_caracteristica_totalChk .= " checked";
		break;
	}
}
	$x_caracteristica_totalChk .= ">" . "eliminar" . EditOptionSeparator(3);
echo $x_caracteristica_totalChk;
?>&nbsp;<a href="javascript:todos_check('x_caracteristica_total[]');">TODOS</a>&nbsp;|
<a href="javascript:ninguno_check('x_caracteristica_total[]')">NINGUNO</a>
</span></td>
	</tr>
		<tr>
		<td class="encabezado" title="ACCION QUE SE REALIZA AL EVALUAR EL PERMISO"><span class="phpmaker" style="color: #FFFFFF;">AGREGAR/QUITAR</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_accion"<?php if (@$x_accion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Agregar"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_accion"<?php if (@$x_accion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "Quitar"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Editar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM ".DB.".permiso A";
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
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idpermiso"] = $row["idpermiso"];
		$GLOBALS["x_funcionario_idfuncionario"] = $row["funcionario_idfuncionario"];
		$GLOBALS["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$GLOBALS["x_accion"] = $row["accion"];
		$GLOBALS["x_caracteristica_propio"] = $row["caracteristica_propio"];
		$GLOBALS["x_caracteristica_grupo"] = $row["caracteristica_grupo"];
		$GLOBALS["x_caracteristica_total"] = $row["caracteristica_total"];
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

	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM ".DB.".permiso A";
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
	$rs = phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$EditData = false; // Update Failed
	}else{
		$theValue = ($GLOBALS["x_funcionario_idfuncionario"] != "") ? intval($GLOBALS["x_funcionario_idfuncionario"]) : "NULL";
		$fieldList["funcionario_idfuncionario"] = $theValue;
	
		$theValue = implode(",", $GLOBALS["x_caracteristica_propio"]);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["caracteristica_propio"] = $theValue;
		$theValue = implode(",", $GLOBALS["x_caracteristica_grupo"]);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["caracteristica_grupo"] = $theValue;
		$theValue = implode(",", $GLOBALS["x_caracteristica_total"]);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["caracteristica_total"] = $theValue;
    $theValue = ($GLOBALS["x_accion"] != "") ? intval($GLOBALS["x_accion"]) : "NULL";
	  $fieldList["accion"] = $theValue;

		// update
		$sSql = "UPDATE ".DB.".permiso SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idpermiso =". $sKeyWrk;
		phpmkr_query($sSql,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
	}
	return $EditData;
}
?>
