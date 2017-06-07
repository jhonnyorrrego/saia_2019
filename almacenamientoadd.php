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
$idserie=0;
?>
<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");

include_once("pantallas/lib/librerias_cripto.php");
$validar_enteros=array("x_idalmacenamiento","x_documento_iddocumento");
include_once("librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
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
	$x_idalmacenamiento = @$_POST["x_idalmacenamiento"];
  $x_documento_iddocumento = @$_POST["x_documento_iddocumento"];
  $x_folder_idfolder = @$_POST["x_folder_idfolder"];
  $x_soporte = implode(",", @$_POST["x_soporte"]);
  $x_num_folios = @$_POST["x_num_folios"];
  $x_anexos = @$_POST["x_anexos"];
  $x_responsable = @$_POST["x_responsable"];
  $x_registro_entrada = @$_POST["x_registro_entrada"];
  $x_deterioro = implode(",", @$_POST["x_deterioro"]);
}

$tipoVentana = "";
$listado = @$_REQUEST["documentos"];
$arraydoc = explode(",", $listado);
$posicion = intval(@$_REQUEST["posicion"]);
if($sAction != "A")
  $x_documento_iddocumento = $arraydoc[$posicion];

if(!@$x_folder_idfolder && $_REQUEST["folder"]){
  $folder = @$_REQUEST["folder"];
  $x_folder_idfolder = $folder;
}

switch ($sAction)
{
	case "A": // Add
		if (AddData($conn)) { // Add New Record
			//$_SESSION["ewmsg"] = "Adicion exitosa del registro.";
			?>
			<script>top.noty({text: "Documento almacenado",modal:true, type: alert,layout: "topCenter",timeout:2500});</script>
			<?php
			$formato=busca_filtro_tabla("ruta_mostrar, nombre, idformato","documento a, formato b","lower(a.plantilla)=lower(b.nombre) and iddocumento=".$_REQUEST["x_documento_iddocumento"],"",$conn);
			abrir_url(FORMATOS_CLIENTE.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$_REQUEST["x_documento_iddocumento"]."&idformato=".$formato[0]["idformato"],"detalles");
		}
		break;
	case "D": // Add
		if (RegistrarDevolucion($conn, $arraydoc[$posicion-1])) { // Add New Record
			//$_SESSION["ewmsg"] = "Adicion exitosa del registro.";
      if($posicion<count($arraydoc))
			 redirecciona("almacenamientoadd.php?documentos=".$listado."&posicion=".$posicion."&tipo='devolucion'");
			else
       redirecciona("devolveradd.php");
			exit();
		}
		break;
}

if(isset($_REQUEST["tipo"]) && $_REQUEST["tipo"]<>"")
{
  $tipoVentana = $_REQUEST["tipo"];
  cargaAlmacenamiento($x_documento_iddocumento);
}


?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator

//-->
</script>
<script type="text/javascript">
<!--
function todos_soporte()
{for(i=0;i<document.getElementById("almacenamientoadd").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoadd").elements[i];
      if(objeto.name=="x_soporte[]")
         objeto.checked=true;
     }
}
function todos_deterioro1()
{for(i=0;i<document.getElementById("almacenamientoadd").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoadd").elements[i];
      if(objeto.value=="rasgado" || objeto.value=="mutilado" || objeto.value=="perforado" || objeto.value=="faltantes")
         objeto.checked=true;
     }
}
function todos_deterioro2()
{for(i=0;i<document.getElementById("almacenamientoadd").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoadd").elements[i];
      if(objeto.value=="oxidacion" || objeto.value=="tinta" || objeto.value=="soporte_debil")
         objeto.checked=true;
     }
}//
function todos_deterioro3()
{for(i=0;i<document.getElementById("almacenamientoadd").elements.length;i=i+1)
     {var objeto=document.getElementById("almacenamientoadd").elements[i];
      if(objeto.value=="hongos" || objeto.value=="insectos" || objeto.value=="roedores")
         objeto.checked=true;
     }
}
function EW_checkMyForm(EW_this) {
lleno=true;
if (EW_this.x_documento_iddocumento && !EW_hasValue(EW_this.x_documento_iddocumento, "SELECT" )) {
	if (!EW_onError(EW_this, EW_this.x_documento_iddocumento, "TEXT", "Por favor ingrese los campos requeridos - documento"))
		lleno= false;
}

if (EW_this.x_folder_idfolder && !EW_hasValue(EW_this.x_folder_idfolder, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_folder_idfolder, "TEXT", "Por favor ingrese los campos requeridos - folder"))
		lleno= false;
}

if(isNaN(parseInt(EW_this.x_num_folios.value)) || EW_this.x_num_folios.value<0 || EW_this.x_num_folios.value=="")
  {alert("Por favor ingrese un valor mayor que cero en el campo - numero folios");
   lleno= false;
  }
if(lleno)
  EW_this.submit();
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="carrito/documento.gif" border="0">&nbsp;&nbsp;ADICIONAR ALMACENAMIENTO<br><br>
<?php
menu_ordenar($x_documento_iddocumento);
if(@$folder){
?>
<a href="almacenamientograf.php?folder=<?php echo $folder; ?>">Ir a la Carpeta</a>
<?php
}
else {
?>
<a href="cajagraf.php?cmd=resetall">Ir al Listado de Cajas</a>
<?php
}
?>
</span></p>
<form name="almacenamientoadd" id="almacenamientoadd" action="almacenamientoadd.php" method="post">
<p>
<input type="hidden" name="a_add" value="<?php if($tipoVentana != "") echo "D"; else echo "A";?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
		//print_r($_REQUEST);
    $descripdoc = busca_filtro_tabla("A.numero, A.descripcion,A.serie","documento A", "A.iddocumento=".$x_documento_iddocumento, "", $conn);
    if($descripdoc["numcampos"]){
      if(!$descripdoc[0]["numero"]){
        alerta("<b>ATENCI&Oacute;N</b><br>No es posible almacenar Documentos que no posean un numero de radicado","warning");
        volver(1);
      }

      $idserie=($descripdoc[0]["serie"]);
      if(!$x_num_folios){
        $paginas=busca_filtro_tabla("","pagina","id_documento=".$x_documento_iddocumento,"",$conn);
        $x_num_folios=$paginas["numcampos"];
      }
      //die($idserie."HH");
      $almacenamiento=busca_filtro_tabla("","almacenamiento","documento_iddocumento=".$x_documento_iddocumento,"",$conn);
      if($almacenamiento["numcampos"]){
      	$folder=busca_filtro_tabla("codigo_numero, nombre_expediente","folder a","a.idfolder=".$almacenamiento[0]["folder_idfolder"],"",$conn);
        ?>
			<script>top.noty({text: "Documento almacenado en la carpeta <?php echo $folder[0]["nombre_expediente"];?>",modal:true, type: alert,layout: "topCenter",timeout:2500});</script>
			<?php
				$formato=busca_filtro_tabla("ruta_mostrar, nombre, idformato","documento a, formato b","lower(a.plantilla)=lower(b.nombre) and iddocumento=".$_REQUEST["documentos"],"",$conn);
				redirecciona(FORMATOS_CLIENTE.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$_REQUEST["documentos"]."&idformato=".$formato[0]["idformato"],"detalles");
      }
      //print_r($almacenamiento);
    }
    ?>
    <input type="hidden" name="x_documento_iddocumento" id="x_documento_iddocumento" value="<?php echo $x_documento_iddocumento?>">
    <label ><?php echo $descripdoc[0]["numero"]." - ".$descripdoc[0]["descripcion"]; ?></label>
</span></td>
	</tr>
			<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACION*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
    $folders = busca_filtro_tabla("","folder a,caja b","a.caja_idcaja=b.idcaja AND a.serie_idserie=".$idserie,"", $conn);
    if($folders["numcampos"])
		{
			?>
      <select id="x_folder_idfolder" name="x_folder_idfolder">
      <option value="">Seleccione folder...</option>
		<?php
      for($i=0; $i<$folders["numcampos"]; $i++)
      {
        echo "<option value=".$folders[$i]["idfolder"];
        if($folders[$i]["idfolder"]==$x_folder_idfolder)
          echo " selected";
        echo ">Caja: ".$folders[$i]["fondo"]."(".$folders[$i]["codigo"].") Carpeta:".$folders[$i]["nombre_expediente"]."</option>";
      }
    ?>
    </select>
    <?php
    }
    else if($x_folder_idfolder)
    {
    echo "Caja: ".$datosfolder[0]["numero"]." ".$datosfolder[0]["ubicacion"].", Carpeta: ". $datosfolder[0]["idfolder"]." ".$datosfolder[0]["etiqueta"];
    ?>
  		<input type="hidden" name="x_folder_idfolder" id="x_folder_idfolder" value="<?php echo $folder_idfolder?>">
  		<?php
      $datosfolder = busca_filtro_tabla("A.numero, A.ubicacion, B.idfolder, B.etiqueta","caja A, folder B", "A.idcaja=B.caja_idcaja AND B.idfolder=".$x_folder_idfolder, "", $conn);
      ?>
		<?php
    }
    else if($idserie){
      alerta("<b>ATENCI&Oacute;N</b><br>No existen Carpetas para la Serie del Documento favor Cree la Carpeta y asigne el Documento respectivo","warning");
      redirecciona("vacio.php");
    }
    else if($x_documento_iddocumento){
      alerta("<b>ATENCI&Oacute;N</b><br>su documento no ha sido Calisifaco por Favor Clasifiquelo Antes de almacenarlo","warning");
      redirecciona("clasificar.php?origen=view&iddocumento=".$x_documento_iddocumento);
    }
    else {
      alerta("<b>ATENCI&Oacute;N</b><br>Su documento no Existe o no se puede Almacenar por favor Verifique sus datos","error");
      redirecciona("pendienteslist.php?cmd=resetall");

    }
    ?>

</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SOPORTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
    if($tipoVentana == "")
    {
    ?>
      <input type="checkbox" name="x_soporte[]" value="microfilmes">MICROFILMES
      <input type="checkbox" name="x_soporte[]" value="video">VIDEO
      <input type="checkbox" name="x_soporte[]" value="cassette">CASSETTE
      <input type="checkbox" name="x_soporte[]" value="cd">CD
      <input type="checkbox" name="x_soporte[]" value="dvd">DVD
      <input type="checkbox" name="x_soporte[]" value="otro">OTRO
      <br /><a href="javascript:todos_soporte();">Seleccionar Todos</a>
    <?php
    }
    else
    {
    ?>
      <input type="checkbox" name="x_soporte[]" value="microfilmes" <?php if(strpos($x_soporte, "microfilmes")!==False) echo " checked";?>>MICROFILMES
      <input type="checkbox" name="x_soporte[]" value="video" <?php if(strpos($x_soporte, "video")!==False) echo " checked";?>>VIDEO
      <input type="checkbox" name="x_soporte[]" value="cassette" <?php if(strpos($x_soporte, "cassette")!==False) echo " checked";?>>CASSETTE
      <input type="checkbox" name="x_soporte[]" value="cd" <?php if(strpos($x_soporte, "cd")!==False) echo " checked";?>>CD
      <input type="checkbox" name="x_soporte[]" value="dvd" <?php if(strpos($x_soporte, "dvd")!==False) echo " checked";?>>DVD
      <input type="checkbox" name="x_soporte[]" value="otro" <?php if(strpos($x_soporte, "otro")!==False) echo " checked";?>>OTRO
    <?php
    }
    ?>

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
<?php
if($tipoVentana != "")
{
  ?>
  <input type="hidden" name="tipo" value="devolucion">
  <?php
}
else
{
?>
<input type="hidden" id="folder" name="folder" value="<?php echo $folder; ?>">
<?php
}
?>
<input type="hidden" id="documentos" name="documentos" value="<?php echo $listado; ?>">
<input type="hidden" id="serie" name="serie" value="<?php echo $descripdoc[0]["serie"]; ?>">
<input type="hidden" id="posicion" name="posicion" value="<?php echo $posicion+1; ?>">
<input type="button" onclick="EW_checkMyForm(almacenamientoadd);" name="Action" value="Registrar">
</form>

<table>
<tr class="encabezado_list">
<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">NUMERO</span></td>
<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCION</span></td>
<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">ALMACENADO</span></td>
</tr>
<?php
foreach($arraydoc as $docum)
{
  $datosdoc=busca_filtro_tabla("A.numero, A.descripcion, A.almacenado","documento A", "A.iddocumento=".$docum, "", $conn);
?>
  <tr bgcolor="#FFFFFF">
  <td><?php echo $datosdoc[0]["numero"]?></td><td><?php echo $datosdoc[0]["descripcion"]?></td>
  <td><?php if($datosdoc[0]["almacenado"]==0) echo "NO"; else echo "SI";?></td>
  </tr>
<?php
}
?>

</table>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{global $conn;
  global $x_documento_iddocumento;
  global $x_folder_idfolder;
  global $x_soporte;
  global $x_num_folios;
  global $x_anexos;
  global $x_deterioro;
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

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_documento_iddocumento) : $x_documento_iddocumento;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["documento_iddocumento"] = $theValue;

  $fieldList["folder_idfolder"] = $x_folder_idfolder;

	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_soporte) : $x_soporte;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["soporte"] = $theValue;

	$fieldList["num_folios"] = $x_num_folios;

	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_anexos) : $x_anexos;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["anexos"] = $theValue;

	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_deterioro) : $x_deterioro;
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["deterioro"] = $theValue;

	$fieldList["responsable"] = usuario_actual("funcionario_codigo");

	$fieldList["registro_entrada"] = fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');

  // insert into database
	$strsql = "INSERT INTO almacenamiento (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	//die($strsql);
	phpmkr_query($strsql) or error("Fallo la busqueda" . phpmkr_error() . ' SQL:' . $sSql);

	$strsql = "UPDATE documento SET almacenado = 1 WHERE iddocumento = ".$x_documento_iddocumento;
	phpmkr_query($strsql) or error("Fallo la sentencia" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}

function cargaAlmacenamiento($documento)
{
	global $conn;
  $sSql = "SELECT A.documento_iddocumento, A.folder_idfolder, A.soporte, A.num_folios, A.anexos, A.deterioro FROM almacenamiento A, solicitud B";
	$sSql .= " WHERE B.idsolicitud = " . $documento . " AND B.idalmacenamiento = A.idalmacenamiento";
	$sSql .= " ORDER BY A.idalmacenamiento DESC";
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);
		// Get the field contents
		$x_documento_iddocumento = $row["documento_iddocumento"];
		$x_folder_idfolder = $row["folder_idfolder"];
		$x_soporte = $row["soporte"];
		$x_num_folios = $row["num_folios"];
		$x_anexos = $row["anexos"];
		$x_deterioro = $row["deterioro"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}

function RegistrarDevolucion($conn, $idprestamo)
{
  global $conn;
  global $x_documento_iddocumento;
  global $x_folder_idfolder;
  global $x_soporte;
  global $x_num_folios;
  global $x_anexos;
  global $x_deterioro;
  $sql = "UPDATE solicitud SET estado = 'DEVUELTO' WHERE idsolicitud = ".$idprestamo;
  phpmkr_query($sql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
  $solicitud = busca_filtro_tabla("documento_iddocumento", "solicitud", "idsolicitud = ". $idprestamo, "", $conn);
  $sql = "INSERT INTO almacenamiento(documento_iddocumento, folder_idfolder, soporte, num_folios, anexos, deterioro, responsable, registro_entrada)";
  $sql .= " VALUES (".$solicitud[0]["documento_iddocumento"].",".$x_folder_idfolder.",'".$x_soporte."',".$x_num_folios.",'".$x_anexos."','".$x_deterioro."',".usuario_actual('funcionario_codigo').",'".date("Y-m-d H:i:s")."')";
  phpmkr_query($sql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sql);
  return true;
}
function buscar_serie_papa($idserie){
	global $conn;
  $serie=busca_filtro_tabla("","serie","idserie=".$idserie,"",$conn);
  if($serie["numcampos"] && $serie[0]["cod_padre"]){
    return(buscar_serie_papa($serie[0]["cod_padre"]));
  }
  return($idserie);
}

encriptar_sqli("almacenamientoadd",1);
?>
