<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 


//Variables Comunes 
$x_iddocumento= Null;
$x_id_asignacion = Null;
$x_llave_entidad =NULL;
$x_anio =Null;

?>
<?php include ("../db.php") ?>
<?php include ("../phpmkrfn.php") ?>
<?php include_once 'funciones.php'; ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	header("asignaciones.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { 
			// TODO seguir estudio .. modificar la funcion LOAD data y enlazar en el calendario ! 
			// Load Record based on key

			$_SESSION["ewmsg"] = "Registro no encontrado" . $sKey;
			phpmkr_db_close($conn);
			ob_end_clean();
			header("asignaciones.php"); // redireccionamiento
			exit();
		}
}
?>

<?php include ("../header.php") ?>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	  <tr>
		<td colspan="1" class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">INFORMACION DE LA TAREA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
        <?php
            $sSqlWrk = "SELECT DISTINCT *  FROM asignacion A,tarea B"; 
			$sSqlWrk .= " WHERE (A.idasignacion = '" . $x_idasignacion. "' AND A.tarea_idtarea=B.idtarea)";
			$rswrk2 = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
    	    
			if($rswrk2)
    	    {  
    	      $datos=phpmkr_fetch_array($rswrk2);   	    
    	      $info="Tarea:      ".$datos["nombre"]."<br/>"."Estado:     ".$datos["estado"]."<br/>"."Descripcion :".$datos["descripcion"] ;
    	      echo $info;	
    	    }
           
        
        ?> 	
	</span></td></tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">RESPONSABLE(S)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_idasignacion)) && ($x_idasignacion <> "")) {
	
	$sSqlWrk = "SELECT DISTINCT *  FROM entidad A,asignacion_entidad B";
	$sTmp = $x_idasignacion;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (B.asignacion_idasignacion = '" . $sTmp . "' AND A.identidad=B.entidad_identidad)";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	
	if ($rswrk) {
			//Datos de la ASIGANCION 
	while ($datawrk = phpmkr_fetch_array($rswrk)) { 
		
	$nomentidad=$datawrk["nombre"];echo $nomentidad;
	$llave_entidad=$datawrk["llave_entidad"];
    switch ($nomentidad) {
    	 
    	case "dependencia":
			
    		$sSqlWrk = "SELECT  *  FROM dependencia"; 
			$sSqlWrk .= " WHERE (iddependencia = '" . $llave_entidad . "')";
			$rswrk2 = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
    	    if($rswrk2)
    	    {
    	      $datos=phpmkr_fetch_array($rswrk2);   	    
    	      echo $datos["iddependencia"]."-".$datos["nombre"]."<br/>";	
    	    }
    case "funcionario":
			
    		$sSqlWrk = "SELECT  *  FROM funcionario"; 
			$sSqlWrk .= " WHERE (idfuncionario = '" . $llave_entidad . "')";
			$rswrk2 = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
    	    if($rswrk2)
    	    {
    	      $datos=phpmkr_fetch_array($rswrk2);   	    
    	      echo $datos["funcionario_codigo"]."-".$datos["nombres"]." ".$datos["apellidos"]."<br/>";	
    	    }	 
    	break;
    	 //TODO cargos funcionarios .. etc 
    	default:
    		
    	break;
    }
    
    
   } // Fin while 
  ?></span></td><?php  
 } // Fin if		
} else {
	$sTmp = "";
}

?>

	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA INICIAL DE ASIGNACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_inicial,5); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA FINAL DE ASIGNACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_fecha_final,5); ?>
</span></td>
	</tr>
</table>
</form>
<div></div>
<p>
<?php include ("../footer.php") ?>
<?
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{   global $conn;
    
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM asignacion";
	$sSql .= " WHERE idasignacion = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idasignacion"] = $row["idasignacion"];
		$GLOBALS["x_idtarea"] = $row["tarea_idtarea"];
		$GLOBALS["x_documento_iddocumento"] = $row["documento_iddocumento"];
		$GLOBALS["x_fecha_inicial"] = $row["fecha_inicial"];
		$GLOBALS["x_fecha_final"] = $row["fecha_final"];
		
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
