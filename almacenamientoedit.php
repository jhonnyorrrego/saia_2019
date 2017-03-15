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
$ewCurSec = 0; // Initialise				
?>
<?php

// Initialize common variables
$x_idalmacenamiento = Null;
$x_documento_iddocumento = Null;
$x_folder_idfolder = Null;
$x_soporte = Null;
$x_num_folios = Null;
$x_anexos = Null;
$x_deterioro = Null;
$x_responsable = Null;
$x_registro_entrada = Null;
?>
<?php include ("db.php"); 

include_once("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idalmacenamiento","x_documento_iddocumento"); 
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ($sKey == NULL)) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
} else {

	// Get fields from form
	$x_idalmacenamiento = @$_POST["x_idalmacenamiento"];
	$x_documento_iddocumento = @$_POST["x_documento_iddocumento"];
	$x_folder_idfolder = @$_POST["x_folder_idfolder"];
	$x_soporte = @$_POST["x_soporte"];
	$x_num_folios = @$_POST["x_num_folios"];
	$x_anexos = @$_POST["x_anexos"];
	$x_deterioro = @$_POST["x_deterioro"];
	$x_responsable = @$_POST["x_responsable"];
	$x_registro_entrada = @$_POST["x_registro_entrada"];
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean();
	header("Location: almacenamientograf.php?folder=$x_folder_idfolder");
	exit();
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			ob_end_clean();
			header("Location: almacenamientograf.php?folder=$x_folder_idfolder");
			exit();
		}
		break;
	case "U": // Update
		if (EditData($sKey,$conn)) { // Update Record based on key
			$_SESSION["ewmsg"] = "Update Record Successful for Key = " . $sKey;
			ob_end_clean();
			header("Location: almacenamientograf.php?folder=$x_folder_idfolder");
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
function todos_soporte()
{for(i=0;i<document.getElementById("almacenamientoedit").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoedit").elements[i];
      if(objeto.name=="x_soporte[]")
         objeto.checked=true;
     } 
}
function todos_deterioro1()
{for(i=0;i<document.getElementById("almacenamientoedit").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoedit").elements[i];
      if(objeto.value=="rasgado" || objeto.value=="mutilado" || objeto.value=="perforado" || objeto.value=="faltantes")
         objeto.checked=true;
     } 
}
function todos_deterioro2()
{for(i=0;i<document.getElementById("almacenamientoedit").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoedit").elements[i];
      if(objeto.value=="oxidacion" || objeto.value=="tinta" || objeto.value=="soporte_debil")
         objeto.checked=true;
     } 
}//
function todos_deterioro3()
{for(i=0;i<document.getElementById("almacenamientoedit").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoedit").elements[i];
      if(objeto.value=="hongos" || objeto.value=="insectos" || objeto.value=="roedores")
         objeto.checked=true;
     } 
}
function EW_checkMyForm(EW_this) {
if (EW_this.x_documento_iddocumento && !EW_hasValue(EW_this.x_documento_iddocumento, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_documento_iddocumento, "TEXT", "Please enter required field - documento iddocumento"))
		return false;
}
if (EW_this.x_folder_idfolder && !EW_hasValue(EW_this.x_folder_idfolder, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_folder_idfolder, "TEXT", "Please enter required field - folder idfolder"))
		return false;
}

if (EW_this.x_num_folios && !EW_checkinteger(EW_this.x_num_folios.value)) {
	if (!EW_onError(EW_this, EW_this.x_num_folios, "TEXT", "Incorrect integer - num folios"))
		return false; 
}
return true;
}

//-->
</script>
<?php menu_ordenar($x_documento_iddocumento); ?>
<span class="phpmaker">Editar almacenamiento<br><a href="almacenamientograf.php?folder=<?php echo $x_folder_idfolder."&serie=".$_REQUEST["serie"]; ?>">IR AL LISTADO</a></span><br>
<form name="almacenamientoedit" id="almacenamientoedit" action="almacenamientoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="serie" value="<?php echo(@$_REQUEST["serie"]);?>">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
		//print_r($_REQUEST);
    $descripdoc = busca_filtro_tabla("A.numero, A.descripcion,A.serie","documento A", "A.iddocumento=".$x_documento_iddocumento, "", $conn);
    if($descripdoc["numcampos"]){
      $idserie=buscar_serie_papa($descripdoc[0]["serie"]);
    }    
    ?>
    <input type="hidden" name="x_documento_iddocumento" id="x_documento_iddocumento" value="<?php echo $x_documento_iddocumento?>">    
		<label ><?php echo $descripdoc[0]["numero"]." - ".$descripdoc[0]["descripcion"]; ?></label>
</span></td>
	</tr>
			<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
    $folders = busca_filtro_tabla("A.idfolder,A.etiqueta, A.caja_idcaja,A.serie_idserie,B.numero,B.ubicacion","folder A,caja B","A.caja_idcaja=B.idcaja AND A.serie_idserie = '".$idserie."'", "B.numero, A.idfolder", $conn); 
		if($folders["numcampos"])
		{  
			?>
      <select id="x_folder_idfolder" name="x_folder_idfolder"><option value="">Seleccione folder...</option>
		<?php
      for($i=0; $i<$folders["numcampos"]; $i++)
      {
        echo "<option value=".$folders[$i]["idfolder"];
        if($folders[$i]["idfolder"]==$x_folder_idfolder)
          echo " selected";
        echo ">Caja: ".$folders[$i]["numero"]."(".$folders[$i]["ubicacion"].") Carpeta:".$folders[$i]["etiqueta"]."</option>";
      }
    ?>
    </select>
    <?php 
    } 
    else if($folder_idfolder)
    {
    echo "Caja: ".$datosfolder[0]["numero"]." ".$datosfolder[0]["ubicacion"].", Folder: ". $datosfolder[0]["idfolder"]." ".$datosfolder[0]["etiqueta"]; 
    ?>
  		<input type="hidden" name="x_folder_idfolder" id="x_folder_idfolder" value="<?php echo $folder_idfolder?>">
  		<?php
      $datosfolder = busca_filtro_tabla("A.numero, A.ubicacion, B.idfolder, B.etiqueta","caja A, folder B", "A.idcaja=B.caja_idcaja AND B.idfolder=".$folder_idfolder, "", $conn);
      ?>
		<?php 
    } 
    else if($idserie){
      alerta("No existen Carpetas para la Serie del Documento favor Cree la Carpeta y asigne el Documento respectivo");
      redirecciona("folderadd.php?idserie=".$idserie);
    } 
    else if($x_documento_iddocumento){
      alerta("su documento no ha sido Calisifaco por Favor Clasifiquelo Antes de almacenarlo");
      redirecciona("clasificar.php?origen=view&iddocumento=".$x_documento_iddocumento);
    } 
    else {
      alerta("Su documento no Existe o no se puede Almacenar por favor Verifique sus datos");
      redirecciona("pendienteslist.php?cmd=resetall");
    
    }
    ?>

</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SOPORTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
     $opciones=array("MICROFILMES","VIDEO","CASSETTE","CD","DVD","OTRO");
     $seleccionado=explode(",",$x_soporte);
   
      for($j=0;$j<count($opciones);$j++)
        {echo '<input type="checkbox" name="x_soporte[]"';
         if(in_array(strtolower($opciones[$j]),$seleccionado))
            echo " checked ";
         echo ' value="'.strtolower($opciones[$j]).'">'.$opciones[$j];
        }
      ?>
      <br /><a href="javascript:todos_soporte();">Seleccionar Todos</a>
    
</span></td>
	</tr>	
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NUMERO DE FOLIOS *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_num_folios" id="x_num_folios" size="10" maxlength="255" value="<?php echo $x_num_folios;?>">
</span></td>
	</tr>	
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ANEXOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_anexos" id="x_anexos" size="80" maxlength="255" value="<?php echo $x_anexos?>">
</span></td>
	</tr>	
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DETERIORO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
    
    ?>
<table border="2" style="empty-cells: show; border-collapse:collapse;">
<tr>
<td style="font-weight: bold;">FISICO:</td>
<?php
$opciones=array("RASGADO","MUTILADO","PERFORADO","FALTANTES");
$seleccionado=explode(",",$x_deterioro);

for($j=0;$j<count($opciones);$j++)
  {echo '<td><input type="checkbox" name="x_deterioro[]"';
   if(in_array(strtolower($opciones[$j]),$seleccionado))
      echo " checked ";
   echo ' value="'.strtolower($opciones[$j]).'">'.$opciones[$j]."</td>";
  }
?>
<td><a href="javascript:todos_deterioro1();">Seleccionar Todos</a></td>
</tr><tr>
<td style="font-weight: bold;">QUIMICO:</td>
<?php
$opciones=array("OXIDACION","TINTA","SOPORTE DEBIL");

for($j=0;$j<count($opciones);$j++)
  {echo '<td><input type="checkbox" name="x_deterioro[]"';
   if(in_array(strtolower($opciones[$j]),$seleccionado))
      echo " checked ";
   echo ' value="'.strtolower($opciones[$j]).'">'.$opciones[$j]."</td>";
  }
?>
<td></td><td> <a href="javascript:todos_deterioro2();">Seleccionar Todos</a></td>
</tr><tr><td style="font-weight: bold;">BIOLOGICO:</td>
<?php
$opciones=array("HONGOS","INSECTOS","ROEDORES");

for($j=0;$j<count($opciones);$j++)
  {echo '<td><input type="checkbox" name="x_deterioro[]"';
   if(in_array(strtolower($opciones[$j]),$seleccionado))
      echo " checked ";
   echo ' value="'.strtolower($opciones[$j]).'">'.$opciones[$j]."</td>";
  }
?>
<td></td><td> <a href="javascript:todos_deterioro3();">Seleccionar Todos</a></td>
</tr>
</table>
<p>
</span></td>
</tr>	
</table>  
<p>
<input type="submit" name="Action" value="EDITAR">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	global $x_idalmacenamiento ;
	global 	$x_documento_iddocumento;
global $x_folder_idfolder;
		global $x_soporte;
		global $x_num_folios;
		global $x_anexos;
		global $x_deterioro;
		global $x_responsable;
		global $x_registro_entrada ;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM almacenamiento";
	$sSql .= " WHERE idalmacenamiento = " . $sKeyWrk;
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
		$x_idalmacenamiento = $row["idalmacenamiento"];
		$x_documento_iddocumento = $row["documento_iddocumento"];
		$x_folder_idfolder = $row["folder_idfolder"];
		$x_soporte = $row["soporte"];
		$x_num_folios = $row["num_folios"];
		$x_anexos = $row["anexos"];
		$x_deterioro = $row["deterioro"];
		$x_responsable = $row["responsable"];
		$x_registro_entrada = $row["registro_entrada"];
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
	global $conn;
  global $x_documento_iddocumento;
  global $x_folder_idfolder;
  global $x_soporte;
  global $x_num_folios;
  global $x_anexos;
  global $x_deterioro;
  global $x_idalmacenamiento;
	// Add New Record
	$sSql = "SELECT * FROM almacenamiento";
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
  $strsql = "UPDATE almacenamiento SET ";
		
  $strsql.="folder_idfolder=".$x_folder_idfolder.",";
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes(implode(",",$x_soporte)) : implode(",",$x_soporte); 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$strsql.="soporte=".$theValue.",";
	
	$strsql.="num_folios=".$x_num_folios.",";
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_anexos) : $x_anexos; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$strsql.="anexos=".$theValue.",";

	$theValue = (!get_magic_quotes_gpc()) ? addslashes(implode(",",$x_deterioro)) : implode(",",$x_deterioro); 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$strsql.="deterioro=".$theValue;
	 
	$strsql .= " WHERE idalmacenamiento=".$_POST["key"];

	phpmkr_query($strsql, $conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	
	return true;
}
function buscar_serie_papa($idserie){
  $serie=busca_filtro_tabla("","serie","idserie=".$idserie,"",$conn);
  if($serie["numcampos"] && $serie[0]["cod_padre"]){
    return(buscar_serie_papa($serie[0]["cod_padre"]));
  }
  return($idserie);
}

encriptar_sqli("almacenamientoedit",1);
?>
