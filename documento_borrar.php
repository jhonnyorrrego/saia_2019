<?php
include_once ("db.php");
include_once ("formatos/librerias/estilo_formulario.php");
include_once ("librerias_saia.php");

include_once($ruta_db_superior.'pantallas/documento/class_documento_elastic.php');

echo (librerias_notificaciones());
?>
<script src="js/jquery.js"></script>
<script src="js/jquery.validate.js"></script>
<script type="text/javascript">
function no_palitos(evt)
  {
   evt = (evt) ? evt : event;
   var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
       ((evt.which) ? evt.which : 0));
   if (charCode == 124){
      return false;
   }
   return true;
  }
$(document).ready(function(){
	$("#documento_eliminar").validate();
});
</script>
<?php
$x_id_documento = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_plantilla = Null;
$x_descripcion = Null;
$x_estado = Null;

include ("phpmkrfn.php");

if (isset($_POST["iddoc"])) {
	// Se cambia el estado del documento de ACTIVO a ELIMINADO.
	$usuario = $_SESSION["usuario_actual"];
	$sql_borrar = "UPDATE documento SET estado='ELIMINADO' WHERE iddocumento=" . $_POST["iddoc"];
	phpmkr_query($sql_borrar, $conn);
	$sql_buzon = "INSERT INTO buzon_entrada (archivo_idarchivo,nombre,destino,tipo_destino,fecha,origen,tipo_origen,notas) VALUES (" . $_POST["iddoc"] . ",'ELIMINADO','$usuario',1," . fecha_db_almacenar(date("Y-m-d"), "Y-m-d") . ",'$usuario',1,'" . $_POST["x_detalle"] . "')";
	// die($sql_buzon);
	phpmkr_query($sql_buzon, $conn);
	registrar_accion_digitalizacion($_POST["iddoc"], 'ELIMINACION DOCUMENTO', $_POST["x_detalle"]);
	$sql = "UPDATE ruta SET tipo='INACTIVO' WHERE documento_iddocumento=" . $_POST["iddoc"];
	phpmkr_query($sql, $conn);
	$buzones = busca_filtro_tabla("A.idtransferencia,A.nombre", "buzon_entrada A", "A.archivo_idarchivo=" . $_POST["iddoc"] . " AND A.nombre NOT LIKE('ELIMINA_%') AND A.nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','BORRADOR','TERMINADO')", "", $conn);
	for($i = 0; $i < $buzones["numcampos"]; $i++) {
		phpmkr_query("UPDATE buzon_entrada SET nombre=('ELIMINA_" . $buzones[$i]["nombre"] . "') WHERE idtransferencia=" . $buzones[$i]["idtransferencia"], $conn);
	}
	phpmkr_query($sql_update, $conn);
	$sql = "UPDATE buzon_salida SET nombre=" . concatenar_cadena_sql(array("'ELIMINA_'","nombre"
	)) . " WHERE archivo_idarchivo=" . $_POST["iddoc"] . " AND nombre NOT LIKE('ELIMINA_%') AND nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','BORRADOR','TERMINADO')";
	phpmkr_query($sql, $conn);

	// Eliminar el documento del indice elasticsearch
	if (INDEXA_ELASTICSEARCH) {
		$d2j = new DocumentoElastic($_POST["iddoc"]);
		$exportado = $d2j->borrar_documento_elasticsearch();
	}

	if (@$_REQUEST["doc_principal"]) {
		$busqueda_componente = busca_filtro_tabla("", "busqueda A", "A.nombre='borradores'", "", $conn);
		abrir_url("pantallas/buscador_principal.php?idbusqueda=" . $busqueda_componente[0]["idbusqueda"], "centro");
		die();
	} else {
		echo "<script>
           direccion=window.parent.frames[0].location;
           window.parent.frames[0].location=direccion+'&no_seleccionar=1';
           </script>";
		redirecciona("vacio.php");
	}
}
$llave = $_REQUEST["iddoc"];

  if (LoadData($x_id_documento,$conn))
  {
  	if($x_estado<>'ACTIVO'){
  		$formato=busca_filtro_tabla("","formato A","lower(A.nombre)='".strtolower($x_plantilla)."'","",$conn);
  		?>
  		<script>
  		notificacion_saia('Este documento no es un borrador','alert','',3500);
  		</script>
  		<?php
  		abrir_url(FORMATOS_CLIENTE.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?idformato=".$formato[0]["idformato"]."&iddoc=".$x_id_documento,"_self");
			die();
  	}
    ?>
    <style>
		label.error{
			color:red;
		}
		</style>
    <span style="font-family:verdana"><img class="imagen_internos" src="images/eliminar_pagina.png" border="0">&nbsp;&nbsp;ElIMINAR BORRADOR</span>
    <form action="documento_borrar.php" method="POST" id="documento_eliminar" name="documento_eliminar">
    <p>
    <input type="hidden" name="iddoc" value="<?php echo  ($llave); ?>">
    <input type="hidden" name="doc_principal" value="<?php echo $_REQUEST["doc_principal"]; ?>">
    <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF;">TIPO DE DOCUMENTO</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000">
    <?php
    $nombre_serie = busca_filtro_tabla("nombre","serie","idserie=".$x_serie,"",$conn);
    if($nombre_serie["numcampos"]>0)
      echo $nombre_serie[0][0];

    ?></font></span></td>
    </tr>
    <tr class="encabezado">
    <td width="175" valign="top"><span class="phpmaker" style="color: #FFFFFF;">FECHA RADICADO</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo $x_fecha; ?></font></span></td>
    </tr><tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF;">EJECUTOR</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000">
    <?php
    if($x_plantilla<>"")
    {$nombre_ejecutor = busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=$x_ejecutor","",$conn);
     if($nombre_ejecutor["numcampos"]>0)
       echo $nombre_ejecutor[0]["nombres"]." ".$nombre_ejecutor[0]["apellidos"];
     else
       echo "&nbsp;&nbsp;";
     }
    else
    {
      $nombre_ejecutor = busca_filtro_tabla("nombre","ejecutor","idejecutor=".$x_ejecutor,"",$conn);
    if($nombre_ejecutor["numcampos"]>0)
      echo $nombre_ejecutor[0][0];
    }
    ?></font></span></td>
    </tr>
    <tr class="encabezado">
    <td width="175" valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo stripslashes($x_descripcion); ?></font></span></td>
    </tr>
    <tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF; text-aling:justify; font-family: Verdana;font-size: 9px;">JUSTIFICACI&Oacute;N</span></td>
    <td valign="top" bgcolor="#F5F5F5" colspan="3"><span class="phpmaker"><font color="#000000">
    <textarea cols="50" rows="2" id="x_detalle" name="x_detalle"  onkeypress='return no_palitos(event)' style="font-family: Verdana;font-size: 9px;" class="required"><?php echo @$x_detalle; ?></textarea>
    </font></span></td>
    </tr>
    <tr><td colspan="4" bgcolor="#F5F5F5"><span style="text-aling:justify; font-family: Verdana;font-size: 11px;"><center>
    <input type="submit" name="Action" value="Eliminar Documento" style="font-family: Verdana;font-size: 9px;"></center></td></tr>
    </table>
    <p>
    </form>
    <?php
  }
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
function LoadData($sKey,$conn)
{
  global $x_id_documento;
  global $x_serie;
  global $x_fecha;
  global $x_ejecutor;
  global $x_descripcion;
  global $llave;
  global $x_plantilla;
	global $x_estado;
  $sSql = "SELECT A.iddocumento,A.serie,".fecha_db_obtener("A.fecha","Y-m-d")." as fecha,A.ejecutor,A.descripcion,A.plantilla,A.estado FROM documento A";
  $sSql .= " WHERE iddocumento = " . $llave;
  $sGroupBy = "";
  $sHaving = "";
  $sOrderBy = "";
  if ($sGroupBy <> "")
  {
   $sSql .= " GROUP BY " . $sGroupBy;
  }
  if ($sHaving <> "")
  {
   $sSql .= " HAVING " . $sHaving;
  }
  if ($sOrderBy <> "")
  {
   $sSql .= " ORDER BY " . $sOrderBy;
  }
  $rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA B�SQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
  $row = phpmkr_fetch_array($rs);
	if (!$row)
  {
   $LoadData = false;
  }
  else
  {
    $LoadData = true;
    // Get the field contents
    $x_id_documento = $row["iddocumento"];
    $x_serie = $row["serie"];
    $x_fecha = $row["fecha"];
    $x_ejecutor = $row["ejecutor"];
    $x_descripcion = $row["descripcion"];
    $x_plantilla = $row["plantilla"];
		$x_estado = $row["estado"];
  }
  phpmkr_free_result($rs);
  //print_r($row);
  //die($LoadData);
  return $LoadData;
}
?>
<?php
//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey
function LoadRecordCount($sqlKey,$conn)
{
global $_SESSION;
$sSql = "SELECT A.* FROM documento A";
$sSql .= " WHERE iddocumento=" . $sqlKey;
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
	$temp=array();
  $temp=phpmkr_fetch_array($rs);
  $i=0;
  for($i=0;$temp;$temp=phpmkr_fetch_array($rs),$i++);
	phpmkr_free_result($rs);
  return $i;
}
?>
<?php
//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey
function DeleteData($llave,$conn)
{
  global $_SESSION;
  global $conn;
  global $x_descripcion;
  global $x_detalle;
  terminar(codifica_encabezado($x_detalle),$x_descripcion,$llave);
  return $llave;
}
?>
