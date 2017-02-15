<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
$ewCurSec = 0; // Initialise
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
	if(is_file($ruta."class_transferencia.php"))
	{
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}			
// Initialize common variables
$x_idbpmn = Null;
$x_nombre = Null;
$x_descripcion = Null;
$x_archivo_bpmn = Null;
?>
<?php include($ruta_db_superior."db.php");?>
<?php include($ruta_db_superior."phpmkrfn.php"); ?>
<?php include($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());


?>
<?php
include ($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include ($ruta_db_superior."formatos/librerias/header_formato.php");

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
	$x_idbpmn = @$_POST["x_idbpmn"];
	$x_nombre = @$_POST["x_nombre"];
	$x_descripcion = @$_POST["x_descripcion"];
  $x_archivo_bpmn = @$_POST["x_archivo_bpmn"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			ob_end_clean();
			header("Location: bpmnlist.php");
			exit();
		}
		break;
	case "A": // Add
		if ($id=AddData($conn)){ // Add New Record
			//abrir_url($ruta_db_superior."bpmn/procesar_bpmn.php?idbpmn=".$id."&vista_bpmn=1","_self");
			abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=23","centro");
			
			exit();
		}
		break;
}
?>
<?php include ($ruta_db_superior."header.php");
echo(librerias_jquery());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">

function validar_formulario() {
	
	if($('#x_nombre').val()==''){
		notificacion_saia("Debe de Ingresar un Nombre Valido","alert","",3500);
		return false;
		
	}else if($('#imagen').val()==''){
		notificacion_saia("Debe de Seleccionar un Flujo Valido","alert","",3500);
		return false;
	}
	else if($('#imagen').val()!=''){
		
		var str = $('#imagen').val();
   	 	var punto = str.indexOf(".bpmn");
    	
    	if(punto!=-1){
    		return true;
    	}
    	else{
    		notificacion_saia("El flujo debe llevar la extencion .bpmn","alert","",3500);
    		return false;
    	}
	}
	else{
		return true;
	}
}

</script>
<p><span class="internos">ADICIONAR BPMN</span></p>
<form name="bpmnadd" id="bpmnadd" action="<?php echo($ruta_db_superior);?>bpmn/bpmn/adicionar_bpmn.php" method="post"  enctype="multipart/form-data">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Nombre*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Descripcion del nuevo bpmn"><span class="phpmaker" style="color: #FFFFFF;">Descripcion</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea name="x_descripcion" id="x_descripcion" style="width:200px;height:50px" ><?php echo htmlspecialchars(@$x_descripcion) ?></textarea>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Archivo bpmn*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php 
		if($contenido[0]["imagen"]<>"")
			echo "<a href='".$ruta_db_superior.$contenido[0]["imagen"]."' target='_blank'>Ver Imagen Actual</a><br />Borrar Imagen<input type='checkbox' value='1' name='borrar_imagen'><br />Subir nueva <input type='file' name='imagen' id='imagen' >";
		else
			echo "<input type=file name='imagen' id='imagen' >";
		?>
		</span></td>
	</tr>	
	
</table>
<p>
<input type="submit" name="Action" value="Adicionar" onClick="return validar_formulario();">
</form>
<?php include ($ruta_db_superior."footer.php") ?>
<?php

/*
<Clase>
<Nombre>LoadData
<Parametros>sKey-id del bpmn a buscar;conn-objeto de conexion con la base de datos
<Responsabilidades>Verificar si un bpmn existe o no en la bd
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/


function LoadData($sKey,$conn){
global $x_idbpmn;
global $x_nombre;
global $x_descripcion;
global $x_archivo_bpm;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM diagram a, diagramdata b";
	$sSql .= " WHERE a.id=b.diagramId AND a.id=" . $sKeyWrk;
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
	$i=0;
	while(phpmkr_fetch_array($rs))
	   $i++;
	$rs = phpmkr_query($sSql,$conn) or error("Falla la busqueda" . phpmkr_error() . ' SQL:' . $sSql);   
	
  if ($i == 0) 
    {
  		$LoadData = false;
  	}
  	
  else
    {
  		$LoadData = true;
  		$row = phpmkr_fetch_array($rs);
  
  		// Get the field contents
  		$x_idbpmn = $row["iddiagram"];
  		$x_nombre = $row["title"];
			$x_descripcion = $row["description"];
      $x_archivo_bpm = $row["filename"];
  	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

/*
<Clase>
<Nombre>AddData
<Parametros>$conn-objeto de conexion con la base de datos
<Responsabilidades>insertar los datos de un bpmn nuevo en la base de datos
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
function AddData($conn)
{
global $x_idbpmn;
global $x_nombre;
global $x_descripcion;
global $x_cod_padre;
global $x_tipo_bpmn;
global $ruta_db_superior;
	// Add New Record
	$sSql = "SELECT * FROM diagram A";
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
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '".trim($theValue)."'" : "NULL";
	$fieldList["title"] = $theValue;
	$fieldList["description"] = "'".$x_descripcion."'";
	$fieldList["createdDate"] = fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
	$fieldList["lastUpdate"] = fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
	$fieldList2["lastUpdate"] = fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s');
	$fieldList["hash"]="'".generateRandom(6)."'";
	$fieldList["publico"]='1';
	
	if(is_uploaded_file($_FILES["imagen"]["tmp_name"])){
		$extension=explode(".",($_FILES["imagen"]["name"]));
		$ultimo=count($extension);
		$formato=$extension[$ultimo-1];
		$aleatorio=rand(5,15);
		$aux=RUTA_ARCHIVOS_BPMN;
		$archivo=$ruta_db_superior.$aux;
		crear_destino($archivo);
		$archivo=$archivo.$aleatorio.".".$formato;
		if(copy($_FILES["imagen"]["tmp_name"],$archivo)){
			$fieldList2["fileName"]="'".$aux.$aleatorio.".".$formato."'";
			$fieldList["tamano"]=$_FILES["imagen"]["size"];
			$fieldList2["fileSize"]=$_FILES["imagen"]["size"];
			$fieldList2["type"]="'".$formato."'";
			@unlink($_FILES["imagen"]["tmp_name"]);
		}
		else{
			die("No es posible procesar el archivo ".$_FILES["imagen"]["tmp_name"]." Posible error al tratar de copiar a ".$archivo);
		}	
	}
	// insert into database
	$strsql = "INSERT INTO diagram(";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ")VALUES(";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";
	phpmkr_query($strsql, $conn);
	$id=phpmkr_insert_id();
	$sql2="INSERT INTO diagramdata(".implode(",", array_keys($fieldList2)).", diagramId)values(".implode(",", array_values($fieldList2)).", ".$id.")";
	phpmkr_query($sql2, $conn) or error("Falla en la base de datos" . phpmkr_error() . ' SQL:' . $sql2);
	
	return $id;
}

encriptar_sqli("bpmnadd",1,"form_info",$ruta_db_superior);
/*
 * generateRandom=Funcion traida del antiguo generador del diagram. Utilizado para generar el hash.
 */
function generateRandom($length = 10, $vals = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabchefghjkmnpqrstuvwxyz0123456789-') {
    $s = "";
    while(strlen($s) < $length) {
        mt_getrandmax();
        $num = rand() % strlen($vals);
        $s .= substr($vals, $num+4, 1);
    }
    return $s;
}
?>