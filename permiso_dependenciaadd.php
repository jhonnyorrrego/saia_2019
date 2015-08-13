<?php include ("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
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
  		{ // en caso que sea una versión antigua
  		 try
  			{pagina_requerida = new ActiveXObject("Microsoft.XMLHTTP");
  			}
  		 catch (e){}
  		}
   	}
   else
  	return false
   pagina_requerida.onreadystatechange=function(){ // función de respuesta
   if(pagina_requerida.readyState==4)
   { 	
  	if(pagina_requerida.status==200)
        {
  			 cargarpagina(pagina_requerida, id_contenedor);
  		  }
     else if(pagina_requerida.status==404)
        {
  		   document.write("La página no existe");
  	    }
    }  
   } 
   pagina_requerida.open('POST', url, true); // asignamos los métodos open y send
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
$x_idpermiso_perfil = Null;
$x_modulo_idmodulo = Null;
$x_modulo = Null;
$x_perfil_idperfil = Null;
$x_caracteristica_propio = Null;
$x_caracteristica_grupo = Null;
$x_caracteristica_total = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
/*	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{   */
		$sAction = "I"; // Display blank record
	//}
}
else
{

	// Get fields from form
	$x_idpermiso_perfil = @$_POST["x_idpermiso_perfil"];
		$x_modulo = @$_POST["x_modulos"];	                               //el mudulo
	if(isset($_POST["x_modulo_idmodulo"]))
	  $x_modulo_idmodulo = implode(',',@$_POST["x_modulo_idmodulo"]);  //sub-modulos   
  else
    $x_modulo_idmodulo = "";  	
	//$x_modulo_idmodulo = @$_POST["x_modulo_idmodulo"];
	$x_perfil_idperfil = @$_POST["x_perfil_idperfil"];
	$x_caracteristica_propio = @$_POST["x_caracteristica_propio"];
	$x_caracteristica_grupo = @$_POST["x_caracteristica_grupo"];
	$x_caracteristica_total = @$_POST["x_caracteristica_total"];
}
//die($sAction);
switch ($sAction)
{
	/*case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No hay registros con = " . $sKey;
			ob_end_clean();
		//	header("Location: permiso_perfillist.php");
			exit();
		}
		break;   */
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			$_SESSION["ewmsg"] = "ADICION&Oacute; NUEVO REGISTRO CON &Eacute;XITO";
			ob_end_clean();
		//	header("Location: permiso_perfillist.php");
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

function EW_checkMyForm(EW_this) {
/*if (EW_this.x_modulo_idmodulo && !EW_hasValue(EW_this.x_modulo_idmodulo, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_modulo_idmodulo, "SELECT", "Por favor seleccione un modulo"))
		return false;
}*/

if (EW_this.x_perfil_idperfil && !EW_hasValue(EW_this.x_perfil_idperfil, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_perfil_idperfil, "SELECT", "Por favor seleccione un perfil"))
		return false;
}
if(!(valida_check(EW_this,"x_modulo_idmodulo[]")))
 return false;
 
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/permiso.png" border="0">&nbsp;&nbsp;ADICIONAR PERMISO A UN GRUPO/DEPENDENCIA<br><br>
<a href="dependenciaview.php">Regresar al listado</a></span></p>
<form name="permiso_perfiladd" id="permiso_perfiladd" action="permiso_dependenciaadd.php" method="post" onSubmit="return EW_checkMyForm(this);">

<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&Oacute;DULO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_modulo_idmodulo)) || ($x_modulo_idmodulo == "")) { $x_modulo_idmodulo = 0;} // Set default value ?>
<?php
$modulos = busca_filtro_tabla("*","modulo A","A.cod_padre=0 OR A.cod_padre is NULL","A.nombre",$conn);
$select_modulos = "<select name='x_modulos' onchange='sub_modulos(x_modulos.value);'><option value=''>Seleccionar..</option>";
if($modulos["numcampos"]>0)
for($i=0; $i<$modulos["numcampos"]; $i++)
{
 $select_modulos.="<option value=".$modulos[$i]["idmodulo"].">".$modulos[$i]["nombre"]."</option>";
}
$select_modulos.="</select>";
echo $select_modulos;
?>
 <div id="sub_modulo">
 </div></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DEPENDENCIA/GRUPO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php /*if (!(!is_null($x_perfil_idperfil)) || ($x_perfil_idperfil == "")) { $x_perfil_idperfil = 0;} // Set default value 
$x_perfil_idperfilList = "<select name=\"x_perfil_idperfil\">";
$x_perfil_idperfilList .= "<option value=''>Por favor seleccione</option>";
$sSqlWrk = "SELECT DISTINCT A.idperfil, A.nombre FROM perfil A" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_perfil_idperfilList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idperfil"] == @$x_perfil_idperfil) {
			$x_perfil_idperfilList .= "' selected";
		}
		$x_perfil_idperfilList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_perfil_idperfilList .= "</select>";
echo $x_perfil_idperfilList;       */
$dep=busca_filtro_tabla("nombre","dependencia","iddependencia=$sKey","",$conn);
//print_r($dep);
echo "<input type='hidden' name='x_perfil_idperfil' value='$sKey'>".$dep[0][0];
?>
</span></td>
	</tr>
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CARACTER&Iacute;STICA PROPIO</span></td>
		<td bgcolor="#F5F5F5" colspan="5"><span class="phpmaker">
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
		<td bgcolor="#F5F5F5" colspan="5"><span class="phpmaker">
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
		<td bgcolor="#F5F5F5" colspan="5"><span class="phpmaker">
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
?>
&nbsp;<a href="javascript:todos_check('x_caracteristica_total[]');">TODOS</a>&nbsp;|
<a href="javascript:ninguno_check('x_caracteristica_total[]')">NINGUNO</a>
</span></td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="ADICIONAR">
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
	$sSql = "SELECT * FROM permiso_perfil A";
	$sSql .= " WHERE A.idpermiso_perfil = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idpermiso_perfil"] = $row["idpermiso_perfil"];
		$GLOBALS["x_modulo_idmodulo"] = $row["modulo_idmodulo"];
		$GLOBALS["x_perfil_idperfil"] = $row["perfil_idperfil"];
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
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
	// Add New Record
/*	$sSql = "SELECT * FROM permiso_perfil A";
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
	}   */
	echo $GLOBALS["x_perfil_idperfil"];
	$resultado=busca_funcionarios($GLOBALS["x_perfil_idperfil"]);
  
  // Field caracteristica_propio
	$theValue = implode(",", $GLOBALS["x_caracteristica_propio"]);
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["caracteristica_propio"] = $theValue;
	$fieldList["accion"] = 1;
	// Field caracteristica_grupo
	$theValue = implode(",", $GLOBALS["x_caracteristica_grupo"]);
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["caracteristica_grupo"] = $theValue;
  // Field caracteristica_total
	$theValue = implode(",", $GLOBALS["x_caracteristica_total"]);
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["caracteristica_total"] = $theValue;
	
  for($j=0;$j<count($resultado);$j++)
  {
	
  $fieldList["funcionario_idfuncionario"] =$resultado[$j]; 
   // Field modulo_idmodulo

  if($GLOBALS["x_modulo_idmodulo"] != "")
  {
    $id_modulos = split(',',$GLOBALS["x_modulo_idmodulo"]);
    $sql="";
    $strsql="";
    for($i=0; $i<count($id_modulos); $i++)
    {
      //$fieldList["modulo_idmodulo"] = $id_modulos[$i];  // insert into database
      $strsql = "INSERT INTO permiso(";
      $strsql .= implode(",", array_keys($fieldList));
      $strsql .= ",modulo_idmodulo) VALUES ";
      $strsql .= "(".implode(",", array_values($fieldList)).",".$id_modulos[$i].")";    	    	
      //echo $strsql;
      phpmkr_query($strsql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
    }

   //$strsql =  substr($strsql, 0, -1);      	
  }
  else
  {
	// Field modulo	
  	$theValue = ($GLOBALS["x_modulo"] != "") ? intval($GLOBALS["x_modulo"]) : "NULL";
  	$fieldList["modulo_idmodulo"] = $theValue;
    // insert into database
  	$strsql = "INSERT INTO permiso (";
  	$strsql .= implode(",", array_keys($fieldList));
  	$strsql .= ") VALUES (";
  	$strsql .= implode(",", array_values($fieldList));
  	$strsql .= ")";  	
  	phpmkr_query($strsql, $conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
  }	
 
 } 	

	return true;
}
function busca_funcionarios($dependencia)
{global $conn;

 $func=busca_filtro_tabla("funcionario_idfuncionario","dependencia_cargo d,funcionario f,cargo c","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and f.estado=1 and c.estado=1 and d.estado=1 and dependencia_iddependencia='$dependencia'","",$conn);
 $funcionarios=extrae_campo($func,"funcionario_idfuncionario","U");
 $hijas=busca_filtro_tabla("iddependencia","dependencia","cod_padre='$dependencia'","",$conn);
 if($hijas["numcampos"])
   {for($i=0;$i<$hijas["numcampos"];$i++)
      array_merge($funcionarios,busca_funcionarios($hijas[$i]["iddependencia"]));
   }
 else
   return($funcionarios);  
}
?>
