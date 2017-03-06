<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$ewCurSec = 0; // Initialise    
?>
<?php

// Initialize common variables
$x_idexpediente = Null;
$x_nombre = Null;
$x_documento_iddocumento = Null;
$x_fecha = Null;
$x_descripcion = Null;
$x_codigo = Null;
/*


$permiso = false;
$perm=new PERMISO();
$permiso=$perm->permiso_usuario("editar_expediente","");  */

$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	header("Locationexpedientelist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			abrir_url("expediente_principal.php","centro");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/expediente.png" border="0">&nbsp;&nbsp;VER EXPEDIENTE<br><br>
<?php if(!isset($_REQUEST["ocultar_links"])){ ?>
<a href="expediente_detalles.php?key=<?php echo($sKey);?>">Regresar al listado</a>&nbsp;
<?php } 
else
  {  
?>
<script>
document.getElementById("ocultar").style.display="none";
</script>

<?php } ?>
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO DE EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idexpediente; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE DEL EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo ($x_nombre); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PROPIETARIO DEL EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$funcionario=busca_filtro_tabla("f.idfuncionario, dc.dependencia_iddependencia, dc.cargo_idcargo","funcionario f, dependencia_cargo dc, dependencia d, cargo c","f.funcionario_codigo=".usuario_actual("funcionario_codigo")." and f.idfuncionario=dc.funcionario_idfuncionario and dc.estado=1 and c.idcargo=dc.cargo_idcargo and c.estado=1 and dc.dependencia_iddependencia=d.iddependencia and d.estado=1","",$conn);
$propietario=busca_filtro_tabla("nombres,apellidos,ver_todos,editar_todos,propietario","funcionario,expediente","funcionario_codigo=propietario and idexpediente=$x_idexpediente","",$conn);
//$acceso_expediente=busca_filtro_tabla("","permiso_expediente_func","funcionario=".usuario_actual("funcionario_codigo")." and expediente_idexpediente=$x_idexpediente","",$conn);
$acceso_expediente_dependencia=busca_filtro_tabla("","entidad_expediente","entidad_identidad=2 and llave_entidad =".$funcionario[0]["dependencia_iddependencia"]." and estado=1 and expediente_idexpediente=$x_idexpediente","",$conn);
if($acceso_expediente_dependencia["numcampos"]){
$dependencia_expediente = explode(",",$acceso_expediente_dependencia[0]["permiso"]);
if(in_array("l",$dependencia_expediente)){
$dependencia=1;
}
}
//print_r($acceso_expediente_dependencia);
$acceso_expediente_cargo=busca_filtro_tabla("","entidad_expediente","entidad_identidad=4 and llave_entidad =".$funcionario[0]["cargo_idcargo"]." and estado=1 and expediente_idexpediente=$x_idexpediente","",$conn);

if($acceso_expediente_cargo["numcampos"]){
$cargo_expediente = explode(",",$acceso_expediente_cargo[0]["permiso"]);

if(in_array("l",$cargo_expediente)){
$cargo=1;
}
}
//print_r($acceso_expediente_cargo);
$acceso_expediente_funcionario=busca_filtro_tabla("","entidad_expediente","entidad_identidad=1 and llave_entidad =".$funcionario[0]["idfuncionario"]." and estado=1 and expediente_idexpediente=$x_idexpediente","",$conn);
if($acceso_expediente_funcionario["numcampos"]){
$funcionario_expediente = explode(",",$acceso_expediente_funcionario[0]["permiso"]);
if(in_array("l",$funcionario_expediente )){
$funcionario=1;
}
}
//print_r($acceso_expediente_funcionario."<br>");
//print_r($acceso_expediente_funcionario);


echo ucwords($propietario[0]["nombres"]." ".$propietario[0]["apellidos"]);
?>

</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTOS ASOCIADOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php	
 //if($propietario[0]["propietario"]==usuario_actual("idfuncionario") || $propietario[0]["ver_todos"] || $propietario[0]["editar_todos"] || $acceso_expediente["numcampos"] )
 
  
 if($propietario[0]["propietario"]==usuario_actual("funcionario_codigo") || $dependencia==1 || $cargo==1 || $funcionario==1)
	{$doc = busca_filtro_tabla("distinct iddocumento,numero,documento.descripcion,serie","documento,expediente_doc,expediente","expediente_idexpediente=$sKey and documento_iddocumento=iddocumento and documento.estado<>'ELIMINADO' AND expediente_idexpediente=idexpediente","",$conn);
	 
  //$doc = busca_filtro_tabla("distinct iddocumento,numero,documento.descripcion,serie","documento,expediente_doc,expediente","expediente_idexpediente=$sKey and documento_iddocumento=iddocumento AND expediente_idexpediente=idexpediente","",$conn);
 //print_r($doc);  	
	if($doc["numcampos"]>0)
	{echo "<table border='1' cellspacing='0' bordercolor=silver cellpadding='4' style='border-collapse:collapse;'>";
	 echo "<tr align=center><td><b>Radicado</b></td>
         <td><b>Tipo de documento</b></td>
         <td><b>Descripci&oacute;n</b></td>
         <td>&nbsp;</td></tr>";
   $codfunc = $_SESSION["usuario_actual"];      
   for($i=0; $i<$doc["numcampos"]; $i++)
     {        
         $serie=busca_filtro_tabla("nombre","serie","idserie='".$doc[$i]["serie"]."'","",$conn);
          echo "<tr><td>".$doc[$i]["numero"]."</td>";
          if($serie["numcampos"])
            echo "</td><td>".$serie[0]["nombre"]."</td>";
          else
            echo "</td><td>Sin clasificar</td>"; 
          echo "<td>".delimita($doc[$i]["descripcion"],100);  
         // } 
        $transferencias=busca_filtro_tabla("count(idtransferencia)","buzon_salida","archivo_idarchivo=".$doc[$i]["iddocumento"]." and (origen='$codfunc' or destino='$codfunc') and nombre<>'LEIDO'","",$conn);        
       // if($transferencias[0][0])          
       if(isset($_REQUEST["ocultar_links"]))
          echo "<td>&nbsp;</td>";
        elseif($transferencias[0][0]) 
         
          echo "<td><a href='documentoview.php?key=".$doc[$i]["iddocumento"]."'>Detalle</a></td></tr>";
        else
          echo "<td>No tiene acceso al documento</td>";    
        }
     echo "</table>";     
  }
  else     
   echo "El expediente se encuetra vac&iacute;o";
  }
 else
   echo "No tiene permiso asignado para ver el contenido del expediente.";
  ?> 
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha,5); ?>
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo ($x_descripcion); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO DEL EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo ($x_codigo); ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM expediente";
	$sSql .= " WHERE idexpediente = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;		
  		// Get the field contents
		$GLOBALS["x_idexpediente"] = $row["idexpediente"];
		$GLOBALS["x_nombre"] = $row["nombre"];		
		$GLOBALS["x_fecha"] = $row["fecha"];
		$GLOBALS["x_descripcion"] = $row["descripcion"];
		$GLOBALS["x_codigo"] = $row["codigo"];		
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
