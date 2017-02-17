<?php 
include_once("db.php");
include_once("librerias_saia.php");

include_once("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["doc"];
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento(@$_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}

echo(estilo_bootstrap());
echo(librerias_notificaciones());


?>
<?php include_once("class_transferencia.php"); 
include_once("header.php"); ?>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) 
{  
  if(EW_this.x_detalle.value=="")
  { 
		notificacion_saia('Por favor escriba una justificacion de la terminacion del documento.','warning','',3500);
    return false;
  }
  else  
  { var jus = EW_this.x_detalle.value;
    var num = jus.length;    
   if(num <= 10 ){
   		notificacion_saia('La justificacion debe tener mas de 10 caracteres.','warning','',3500);
    return false;
   }
  }      
  return true;
}
-->
</script>
<?php
$x_id_documento = Null;
$x_numero = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_descripcion = Null;
$x_plantilla = Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

$llave = @$_GET["doc"];
if($llave=="")
  $llave = $_POST["llave_d"];
$x_id_documento=$llave;

$sAction = @$_POST["a_delete"];
$x_detalle = @$_POST["x_detalle"];
if (($sAction == "") || (($sAction == NULL))) 
$sAction = "I";	// Display with input box
$ejecutor="";
if(isset($_REQUEST["ejecutor"]) && $_REQUEST["ejecutor"]!="")   
 $ejecutor = "&ejecutor=".$_REQUEST["ejecutor"];
switch ($sAction)
{
  case "I": // Display
    if (LoadRecordCount($llave,$conn) <= 0) 
    {     
      abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall","centro");
      exit();
    }
  break;
  case "D": // Delete
    $x_id_documento=DeleteData($llave,$conn);
    if ($x_id_documento) 
    {        
      abrir_url($ruta_db_superior."pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall","centro");
      exit();
    }
  break;
}
  if (LoadData($x_id_documento,$conn)) 
  {
menu_ordenar($x_id_documento);
    $pendiente = busca_filtro_tabla("idasignacion","asignacion","documento_iddocumento=$x_id_documento and entidad_identidad=1 and llave_entidad=".$_SESSION["usuario_actual"],"",$conn);
    
    $formato=busca_filtro_tabla("B.ruta_mostrar,B.idformato,B.nombre","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$x_id_documento,"",$conn);
    if(!$pendiente["numcampos"]) 
    {
     //alerta("El documento no se puede terminar porque no esta en su buzon de documentos pendientes.");
		 ?>
		 <script>
				notificacion_saia('El documento no se puede terminar porque no esta en su buzon de documentos pendientes.','warning','',3500);
		 </script>
		 <?php
     abrir_url($ruta_db_superior."formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$x_id_documento."&idformato=".$formato[0]["idformato"]."&random=".rand(),'_self');        
    }  
    $leido = busca_filtro_tabla("nombre,origen,destino","buzon_salida","archivo_idarchivo=$x_id_documento and nombre='LEIDO' and destino='".$_SESSION["usuario_actual"]."'","idtransferencia DESC",$conn);      
    
    if($leido["numcampos"]>0 && ($leido[0]["nombre"]!='LEIDO' && $leido[0]["nombre"]!='TRAMITE' && $leido[0]["nombre"]!='DISTRIBUCION'))
    {
     //alerta("Antes de terminar un documento por favor leer el contenido del documento.");
		 ?>
		 <script>
				notificacion_saia('Antes de terminar un documento por favor leer el contenido del documento.','warning','',3500);
		 </script>
		 <?php
     abrir_url($ruta_db_superior."formatos/".$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$x_id_documento."&idformato=".$formato[0]["idformato"]."&random=".rand(),'_self');
    }    
    ?>
<span class="internos"><!--img class="imagen_internos" src="botones/documentacion/documento.gif" border="0"-->&nbsp;&nbsp;TERMINAR EL DOCUMENTO</span>

    <form id="documentoTerminar" name="documentoTerminar" action="documentoTerminar.php" method="post" onSubmit="return EW_checkMyForm(this);">
    <?php if(isset($_REQUEST["ejecutor"]) && $_REQUEST["ejecutor"]!="") 
      echo "<input type='hidden' name='ejecutor' value='".$_REQUEST["ejecutor"]."'>";
    ?>
    <p>
    <input type="hidden" name="a_delete" value="D">
    <input type="hidden" name="llave_d" value="<?php echo  ($llave); ?>">
    <table  border="0" style="WIDTH:100%;" bgcolor="#CCCCCC" cellpadding="4" cellspacing="4">
    <tr class="encabezado">
    <td width="175" valign="top"><span class="phpmaker" style="color: #FFFFFF;">DOCUMENTO N&Uacute;MERO</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo $x_numero; ?></font></span></td>
    </tr><tr class="encabezado">
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
    </tr><!--tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF;">EJECUTOR</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000">
    <?php 
    /*if($x_plantilla=="")
    {$funcionario=busca_filtro_tabla("nombre","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$x_ejecutor,"",$conn);
     echo ucwords(strtolower($funcionario[0]["nombre"]));
    }
    else
    {$transferencia=busca_filtro_tabla("origen","buzon_salida","destino='".usuario_actual("funcionario_codigo")."' and archivo_idarchivo=$iddoc and nombre not in('BLOQUEADO','LEIDO','POR_APROBAR')","idtransferencia desc",$conn);
    //print_r($transferencia);
     $funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$transferencia[0]["origen"]."","",$conn);
     echo ucwords($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]);
    
    } 
    include_once("funciones.php");
    echo strip_tags(remitente($llave));*/    
    ?></font></span></td>
    </tr-->
    <tr class="encabezado">
    <td width="175" valign="top"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N</span></td>
    <td valign="top" bgcolor="#F5F5F5"><span class="phpmaker"><font color="#000000"><?php echo $x_descripcion; ?></font></span></td>
    </tr>    
    <tr class="encabezado">
    <td width="131" valign="top"><span class="phpmaker" style="color: #FFFFFF; text-aling:justify; font-family: Verdana;font-size: 9px;">JUSTIFICACI&Oacute;N</span></td>
    <td valign="top" bgcolor="#F5F5F5" colspan="3"><span class="phpmaker"><font color="#000000">
    	
    <?php
    	$justificaciones_configuracion=busca_filtro_tabla('','configuracion','nombre="justificacion_terminar"','',$conn);
		$justificaciones=explode(',',$justificaciones_configuracion[0]['valor']);
		echo('<dl>');
		for($i=0;$i<count($justificaciones);$i++){
			echo("<dd><input type='radio' name='detalle' onclick='document.getElementById(\"x_detalle\").value=this.value;' style='font-family: Verdana;font-size: 9px;' value='".$justificaciones[$i]."'>".$justificaciones[$i]."</dd>");
					
		}
		echo('</dl>');
		echo('<br/>');
    ?>
    
    	
    	

    
    
     
    <textarea cols="100" rows="4" id="x_detalle" name="x_detalle" style="font-family: Verdana;font-size: 9px;"><?php echo @$x_detalle; ?></textarea>
    </font></span></td>
    </tr>
    <tr><td colspan="4" ><!--span style="text-aling:justify; font-family: Verdana;font-size: 9px;">
    IMPORTANTE<br><br> Usted est&aacute; a punto de terminar el proceso de gesti&oacute;n de este documento, al hacerlo el estado del documento ser&aacute; de "TERMINADO" para todas las personas que tienen acceso al documento. Por esta raz&oacute;n debe estar seguro que todos los responsables del documento hayan ejecutado las acciones correspondientes, y que por lo tanto NO HAY NING&Uacute;N PROCESO PENDIENTE por ejecutar. �Realmente quiere TERMINAR el proceso de este documento?<br> 
    </span--><br>
    
     <input type="button" class="btn btn-mini btn-danger" value="Cancelar" onclick="window.history.back(-1);">
  	<input type="submit" name="Action" value="Terminar Documento" class="btn btn-mini btn-primary">
    
    
   </td></tr>
    </table>
    <p>
    </form>
    <?php
  }
  else
  {
  	?>
		 <script>
				notificacion_saia('El documento no se puede terminar, por favor clasificarlo o cumunicarle al responsable.','warning','',3500);
		 </script>
		 <?php
    redirecciona("clasificar.php?origen=view&iddocumento=".$llave);
    /*
    volver(2);*/
  }
?>

<?php include ("footer.php") ?>
<?php
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
function LoadData($sKey,$conn)
{
  global $_SESSION;
  global $x_id_documento;
  global $x_numero;
  global $x_serie;
  global $x_fecha;
  global $x_ejecutor;
  global $x_descripcion;
  global $x_plantilla;
  global $llave;
  $sSql = "SELECT A.*, ". fecha_db_obtener("A.fecha")." as fecha FROM documento A";
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
  { if($row["serie"]!='0')
    {
     $LoadData = true;
    }
    else
     $LoadData = false;
    // Get the field contents
    $x_id_documento = $row["iddocumento"];
    $x_numero = $row["numero"];
    $x_serie = $row["serie"];
    $x_fecha = $row["fecha"];
    $x_ejecutor = $row["ejecutor"];
    $x_descripcion = $row["descripcion"];
    $x_plantilla = $row["plantilla"];   
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
  global $conn,$sql;
  global $x_descripcion;  
  global $x_detalle;
  $estado=busca_filtro_tabla("estado","documento","iddocumento=".$llave,"",$conn);

  if($estado[0]["estado"]=="ACTIVO")
   { $actualice = "UPDATE documento SET estado = 'APROBADO' WHERE iddocumento=".$llave;
    phpmkr_query($actualice,$conn);
    }

  //$radicadores = busca_filtro_tabla("distinct funcionario_codigo","funcionario A,cargo B,dependencia_cargo C","C.estado=1 AND A.estado=1 AND C.funcionario_idfuncionario=A.idfuncionario AND C.cargo_idcargo=B.idcargo AND B.nombre='radicador'","",$conn);
  $destinos = array();
  /*for($i=0;$i<$radicadores["numcampos"];$i++)
    array_push($destinos,$radicadores[$i][0]);*/
  $destinos[0]=usuario_actual("funcionario_codigo");   
  $fieldList = array();
  $fieldList["archivo_idarchivo"] = $llave;
  $fieldList["nombre"] = 'TERMINADO';
  $fieldList["fecha"] = date("Y-m-d H:i:s");
  $fieldList["respuesta"] = '';
  $fieldList["entregado"] = '';
  $fieldList["recibido"] = '';
  $fieldList["notas"] = $x_detalle;
  $fieldList["ver_notas"] = '';
  $fieldList["transferencia_descripcion"] = "'".$x_descripcion."'";
  $fieldList["tipo"] = 0;
  $fieldList["ruta"] = '';
  $fieldList["tipo_destino"] = 1;
  $fieldList["serie"] = '';
  $datos_adicionales=array();
	$datos_adicionales["notas"]="'".$fieldList["notas"]."'";
  transferir_archivo_prueba($fieldList,$destinos,$datos_adicionales);
  return $llave;
}

encriptar_sqli("documentoTerminar",1);
?>

