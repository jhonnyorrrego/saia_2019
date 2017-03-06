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
$x_idexpediente = Null;
$x_nombre = Null;
$x_documento_iddocumento = Null;
$x_fecha = Null;
$x_descripcion = Null;
$x_codigo = Null;
$x_cod_padre = Null;
?>
<?php 
include_once ("db.php");
include_once ("phpmkrfn.php"); 
//include_once ("permisos_tabla.php");
// Si es para llenar el expediente con documentos
if(isset($_GET["documentos"]) && isset($_GET["expediente"]))
{
 $posicion = @$_GET["posicion"];
 $arraydoc = explode(",", $_GET["documentos"]);
 $x_idexpediente = $_GET["expediente"];

 for($i=0; $i<count($arraydoc); $i++)
 {
  $sql = "INSERT INTO expediente_doc VALUES(Null,$x_idexpediente,".$arraydoc[$i].",".fecha_db_almacenar(date("Y-m-d h:i:s"),"Y-m-d h:i:s").")";

  phpmkr_query($sql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql);  
 }  
 redirecciona("expediente.php?idexpediente=$x_idexpediente");
}

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || (($sAction == NULL))) {
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
	$x_idexpediente = @$_POST["x_idexpediente"];
	$x_nombre = @$_POST["x_nombre"];	
	$x_descripcion = @$_POST["x_descripcion"];
  $x_codigo = @$_POST["x_codigo"];
  $x_cod_padre = @$_POST["x_cod_padre"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;			
			abrir_url("expediente_principal.php","_parent");
		}
		break;
	case "A": // Add
	 $id=AddData($conn);
	 if ($id) { // Add New Record
	    /*$usu=usuario_actual("idfuncionario");
	    asignar_permiso($id,"CARACTERISTICA_PROPIO","expediente","lme",$usu);
	    asignar_permiso($id,"CARACTERISTICA_TOTAL","expediente","l"); */
			//alerta(("Adición exitosa del registro"));
			if(@$_REQUEST["pantalla"]=="menu_ordenar")   
			  redirecciona("expediente_llenar.php?iddoc=".$_REQUEST["iddoc"]);
      else
			  abrir_url("arbolexpediente.php?mostrarexp=".$id,"arbol_expediente");
			die();
    }
    else alerta("Error al tratar de crear el expediente",'error',4000);
		break;
}
?>
<?php include ("header.php") ?>
<?php include ("formatos/librerias/header_formato.php") ?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
<!--
$().ready(function() {
	$('#expedienteadd').validate(); 
});
//-->
</script>
<p>ADICIONAR EXPEDIENTE<br><br><!--a href="expedientelist.php">Regresar al listado</a--></span></p>
<form name="expedienteadd" id="expedienteadd" action="expedienteadd.php" method="post" >
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">EXPEDIENTE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<input type="hidden" name="x_cod_padre" id="x_cod_padre" value="<?php echo @$_REQUEST['cod_padre'];?>">
		<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">      
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),1)">
      <img src="botones/general/anterior.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value),0,1)">
      <img src="botones/general/buscar.png"border="0px"></a>
      <a href="javascript:void(0)" onclick="tree2.findItem((document.getElementById('stext').value))">
      <img src="botones/general/siguiente.png"border="0px"></a>
<br /><br />
				<div id="treeboxbox_tree2"></div></span>
				<script type="text/javascript">
  <!--		
			tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
			tree2.setImagePath("imgs/");
			tree2.enableIEImageFix(true);
      tree2.enableCheckBoxes(1);
      tree2.enableRadioButtons(true);
      tree2.enableSingleRadioMode(true);
      tree2.enableSmartXMLParsing(true);			
			tree2.loadXML("test_expediente.php?permiso_editar=1<?php if(@$_REQUEST['cod_padre']) echo '&seleccionado='.$_REQUEST['cod_padre'];?>"); 
			tree2.setOnCheckHandler(onNodeSelect);
			function onNodeSelect(nodeId)
      {if(tree2.isItemChecked(nodeId)==true)
         $("#x_cod_padre").val(nodeId);
       else
         $("#x_cod_padre").val('');
      } 
			-->
      </script>
    </span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" class="required" id="x_nombre" size="54" maxlength="255" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO </span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="54" maxlength="255" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <textarea id="x_descripcion" name="x_descripcion" cols="53" rows="3"><?php echo htmlspecialchars(@$x_descripcion) ?></textarea>
    </span></td>
	</tr>
<!--	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERMISOS PARA TODOS LOS FUNCIONARIOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="checkbox" name="editar_todos" value="1">Editar
    <input type="checkbox" name="ver_todos" value="1">Ver contenido
    </span></td>-->
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
<?php
if(@$_REQUEST["pantalla"]=="menu_ordenar")
  {echo '<input type="hidden" name="iddoc" value="'.$_REQUEST["iddoc"].'">
         <input type="hidden" name="pantalla" value="menu_ordenar">';
  }
?>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
/*
<Clase>
<Nombre>LoadData</Nombre> 
<Parametros>$sKey:identificador del expediente;$conn:objeto de conexion</Parametros>
<Responsabilidades>Busca los datos del expediente<Responsabilidades>
<Notas>Esta funcion no se utiliza</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function LoadData($sKey,$conn)
{
	global $_SESSION,$x_cod_padre,$x_codigo,$x_nombre,$x_descripcion,$x_idexpediente;
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
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idexpediente = $row["idexpediente"];
		$x_nombre = $row["nombre"];		
		$x_descripcion= $row["descripcion"];
		$x_codigo= $row["codigo"];
		$x_cod_padre = $row["cod_padre"];
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

/*
<Clase>
<Nombre>AddData</Nombre> 
<Parametros>$conn:objeto de conexion</Parametros>
<Responsabilidades>Adiciona el expediente<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function AddData($conn)
{
	global $_SESSION,$x_cod_padre,$x_codigo,$x_nombre,$x_descripcion,$x_cod_padre;
	global $_POST;	

	// Add New Record	
	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_descripcion) : $x_descripcion; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["descripcion"] = $theValue;
	
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_codigo) : $x_codigo; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	$fieldList["cod_padre"] = intval($x_cod_padre);
  $fieldList["propietario"] = usuario_actual("funcionario_codigo");   //se adiciono
  
	$fieldList["fecha"] = fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s");
   if(isset($_REQUEST["ver_todos"]))  //se adiciono
     $fieldList["ver_todos"] =1;   
  if(isset($_REQUEST["editar_todos"]))
     $fieldList["editar_todos"] =1;           //se adiciono
	// insert into database
	$strsql = "INSERT INTO expediente (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";	

  phpmkr_query($strsql, $conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $strsql);
  
	return phpmkr_insert_id();
	
}
?>
<?php

?>