<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"]){
	include_once("formatos/librerias/menu_principal_documento.php");
	echo(menu_principal_documento($_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
  include_once ("db.php");
// Initialize common variables
$x_iddocumento = Null;
$x_numero = Null;
$x_serie = Null;
$x_fecha = Null;
$x_ejecutor = Null;
$x_descripcion = Null;
$x_paginas = Null;
$x_fecha_oficio = Null;
$x_oficio = Null;
$x_anexo = Null;
$x_dias = Null;
$x_descripcion_anexo = Null;
$x_plantilla = Null;
$x_tipo_radicado = Null;
$x_tipo_despacho = Null;
$x_plantilla = Null;
$x_estado = Null;
$x_tipo_ejecutor = Null;
unset($_SESSION['pagina_actual']);
?>
<?php include_once ("phpmkrfn.php");
if(isset($_REQUEST["key"]))
{ 
$sKey = @$_REQUEST["key"];
}
if (($sKey == "") || (($sKey == NULL))) { 
	 redirecciona("documentolist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

function validar_borrador($doc)
{
 global $conn;
 $usu = usuario_actual("funcionario_codigo");
 /*$borradores = busca_filtro_tabla("iddocumento","documento,buzon_entrada","archivo_idarchivo=iddocumento and iddocumento=$doc and numero=0 and origen= $usu and destino=$usu and nombre='BORRADOR'","",$conn);
 if($borradores["numcampos"]>0) 
  echo "<a title='Elimina un documento que no tiene asignado numero de radicado ya que no ha sido aprobado' href='documento_borrar.php?iddoc=$doc'><img src='images/eliminar_pagina.png' alt='Permite eliminar un documento en borrardor, es decir, un documento sin aprobar'hspace='0' vspace='3' border='0'><br /><B>ELIMINAR DOCUMENTO</B></a>";
*/
}
// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) 
    { // Load Record based on key
			$_SESSION["ewmsg"] = " NO SE ENCUENTRAN REGISTROS POR= " . $sKey;
			//phpmkr_db_close($conn);			
			redirecciona("documentolist.php");
		}
}
$_SESSION["iddoc"]=$x_iddocumento; 
?>
<?php include_once ("header.php");?>
<?php 
if(isset($_GET["dep"]) && $_GET["dep"])
  $row["dependencia_destino"]=$_GET["dep"];
else $row["dependencia_destino"]=0;
?>
<div  align="center">
<?php
menu_ordenar($x_iddocumento,0,1);
?>
</div><br /><br />
<?php validar_borrador($sKey); ?>
<p><span class="internos"><img class="imagen_internos" src="botones/comentarios/detalles.png" border="0"><span class="phpmaker">&nbsp;&nbsp;DETALLES DEL DOCUMENTO</span></span>
<br />
<form><p><center>
<table width="95%" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
 <tr> 
  <td width="15%" class="encabezado" title="N&uacutemero de radicado asignado al documento."><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO DE RADICADO</span></td>
  <td width="40%" bgcolor="#F5F5F5"><span class="phpmaker"> <?php echo $x_numero;?></span></td>          
  <td width="15%" class="encabezado"  title="Tipo de documento de acuerdo a los tipos documentales de la Organizaci&oacute;n."><span class="phpmaker" style="color: #FFFFFF;">CLASIFICACI&Oacute;N DEL DOCUMENTO</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"> 
  <?php
    if (($x_serie != NULL) && ($x_serie <> "")) {
    	$sSqlWrk = "SELECT DISTINCT A.nombre  FROM serie A";
    	$sTmp = $x_serie;
    	$sTmp = addslashes($sTmp);
    	$sSqlWrk .= " WHERE (A.idserie = " . $sTmp . ")";
    	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
    	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
    		$sTmp = $rowwrk["nombre"];
    	}
    	@phpmkr_free_result($rswrk);
    } else {
    	$sTmp = "";
    }
    $ox_serie = $x_serie; // Backup Original Value
    $x_serie = $sTmp;
    if($x_serie=='0')
    	$x_serie='---';
    echo codifica_encabezado($x_serie); 
    $x_serie = $ox_serie; // Restore Original Value 
  ?>
  </span></td>
 </tr>
 <tr> 
  <td class="encabezado" title="Fecha en que se radic&oacute; o gener&oacute; el documento."><span class="phpmaker" style="color: #FFFFFF;">FECHA DE RADICACI&Oacute;N</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"> <?php echo ($x_fecha); ?></span></td>          
  <td width="150" class="encabezado" title="Ciudad al cual pertenece la persona natural o jur&iacute;dica que env&iacute;a el documento."><span class="phpmaker" style="color: #FFFFFF;">CIUDAD ORIGEN</span></td>
  <?php                 
    $mun = busca_filtro_tabla("nombre","municipio","idmunicipio=$x_municipio","",$conn);                  
  ?>
  <td width="150" bgcolor="#F5F5F5"><span class="phpmaker"> <?php echo $mun[0]["nombre"];?></span></td>
 </tr> 
 <?php
 if($x_tipo_radicado==1)
   echo "<tr><td class='encabezado'>ESTADO DOCUMENTO</td><td colspan=3 bgcolor='#F5F5F5'>$x_estado</td></tr>";
 ?>
 <tr> 
  <td class="encabezado" title="Breve resumen del contenido del documento."><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N O ASUNTO</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo stripslashes($x_descripcion);?></span></td>          
  <td class="encabezado" title="Cantidad de folios digitalizados del documento."><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO DE P&Aacute;GINAS</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <?php
   $paginas=busca_filtro_tabla("*","pagina A","A.id_documento=".$sKey,"A.pagina DESC",$conn);
   if($paginas["numcampos"])
     $x_paginas=($paginas[0]["pagina"]);    
   else $x_paginas="NO EXISTEN P&Aacute;GINAS";
     echo $x_paginas; ?>
  </span></td>
 </tr>
 <tr> 
  <td class="encabezado" title="Nombre de la persona natural o jur&iacute;dica (empresa) que env&iacute;a el documento."><span class="phpmaker" style="color: #FFFFFF;">
 <?php if($x_tipo_radicado==1 || $x_plantilla!="") 
         echo "REMITENTE DEL DOCUMENTO";
       else
         echo "DESTINATARIO DEL DOCUMENTO";
 ?> 
  </span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"> 
  <?php

    if (($x_ejecutor != NULL) && ($x_ejecutor <> "")) 
    {
      $sSqlWrk = "SELECT DISTINCT nombre,identificacion,cargo,empresa,direccion,telefono,email FROM ejecutor A, datos_ejecutor d";
      $sTmp = $x_ejecutor;
      $sTmp = addslashes($sTmp);
      $sSqlWrk .= " WHERE (A.idejecutor=d.ejecutor_idejecutor and d.iddatos_ejecutor = '" . $sTmp . "') ";
      $rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA BuSQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);	
      if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
      $sTmp ="";
      $i=0;
      $sTmp.= "<table>";
      for($i=0; $i<count($rowwrk)/2; $i++)		 
      { if($rowwrk[$i] != "") 
        { $clave = array_keys($rowwrk,$rowwrk[$i]);   
          //echo $clave[1];
          if($clave[1]!='ciudad' && $clave[1]!='titulo')     
          $sTmp .= "<tr><td><b>".strtoupper($clave[1])."</b></td><td>".$rowwrk[$i]."</td></tr>";      
        } 
      }   
      $sTmp.= "</table>";     		
      }

      if($x_plantilla!="")  
      {
        $sSqlWrk = "SELECT DISTINCT A.funcionario_codigo,A.nombres,A.apellidos  FROM funcionario A";
        $sTmp = $x_ejecutor;
        $sTmp = addslashes($sTmp);
        $sSqlWrk .= " WHERE (A.funcionario_codigo = " . $sTmp . ")";
        $rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
        if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) 
           $sTmp = $rowwrk["nombres"]." ".$rowwrk["apellidos"];
      }
      @phpmkr_free_result($rswrk);
    } 
    else
     $sTmp="";   
 
    $ox_ejecutor = $x_ejecutor; // Backup Original Value
    $x_ejecutor = $sTmp;  
    echo $x_ejecutor;  
    $x_ejecutor = $ox_ejecutor; // Restore Original Value 
  ?>
  </span></td>          
  <td class="encabezado" title="D&iacute;as para dar respuesta al documento."><span class="phpmaker" style="color: #FFFFFF;">D&Iacute;AS DE ENTREGA (H&Aacute;BILES)</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $x_dias;?></span></td>
 </tr>
 <?php if($x_plantilla==""&&$x_tipo_ejecutor&&($x_tipo_radicado==1||$x_tipo_radicado==2)){ ?>
 <tr> 
  <td class="encabezado" title="Tipo de anexos con los que viene documento."><span class="phpmaker" style="color: #FFFFFF;">ANEXOS F&Iacute;SICOS</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $x_anexo;?></span></td>
  <td class="encabezado" title="Descripci&oacute;n de los anexos con los que viene documento."><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N DE ANEXOS </span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo stripslashes($x_descripcion_anexo);?></span></td>           
 </tr>
 <?php } ?>
  <tr> 
  <td class="encabezado" title="Tipo de anexos con los que viene documento."><span class="phpmaker" style="color: #FFFFFF;">ANEXOS DIGITALES</span></td>
  <td bgcolor="#F5F5F5" colspan="3"><span class="phpmaker">
 <?php 
  $anexos=busca_filtro_tabla("count(*)","anexos","documento_iddocumento=".$sKey,"",$conn); 
if($anexos[0][0]>0)
  echo "<a href='anexosdigitales/anexos_documento.php?key=$sKey&no_menu=1&iddoc=$sKey'>".$anexos[0][0]." anexos digitales";
  ?>
</span></td>          
 </tr>   
 <tr> 
  <td class="encabezado" title="Fecha externa del oficio."><span class="phpmaker" style="color: #FFFFFF;">FECHA OFICIO ENTRANTE</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $x_fecha_oficio;?></span></td>          
  <td class="encabezado" title="N&uacute;mero externo del oficio."><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO EXTERNO DEL OFICIO</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $x_oficio;?></span></td>
 </tr>
 <?php
  $expediente = busca_filtro_tabla("expediente.*","expediente,expediente_doc","documento_iddocumento=$x_iddocumento and idexpediente=expediente_idexpediente","",$conn);
  if($expediente["numcampos"]>0)
  {
   echo '<tr><td class="encabezado" title="Si el documento pertenece a un expediente." ><span class="phpmaker" style="color: #FFFFFF;">DESPACHADO</span></td><td colspan="3" bgcolor="#F5F5F5">';
   echo '<table><tr><td><b>Nombre:</b></td><td>'.$expediente[0]["nombre"].'</td></tr>';
   echo '<tr><td><b>Descripci&oacute;n:</b></td><td>'.$expediente[0]["descripcion"].'</td></tr>';
   echo '<tr><td><b>C&oacute;digo:</b></td><td>'.$expediente[0]["codigo"].'</td></tr></table>';
  }
  
  if($x_tipo_radicado==2)//si es un documento con radicacion de salida
  {    
    $despachado=busca_filtro_tabla("","salidas","estado=1 and documento_iddocumento=$x_iddocumento","",$conn);            
    if($despachado["numcampos"]>0)
    {
    echo '<tr><td class="encabezado" title="Si ha sido despachado por alguna empresa de correo." ><span class="phpmaker" style="color: #FFFFFF;">DESPACHADO</span></td><td colspan="3" bgcolor="#F5F5F5"><table border=0>';
    for($x=0; $x<$despachado["numcampos"]; $x++)
    {
     switch($despachado[$x]["tipo_despacho"])
     {
      case 1: //mensajeria Externa genera salida
          echo '<tr><td><b>N&Uacute;MERO DE GU&Iacute;A:</b></td><td>'.$despachado[$x]["numero_guia"].'</td></tr>             
                <tr><td><b>RESPONSABLE: </b></td><td>';                 
          $empresa=busca_filtro_tabla("nombre","ejecutor","idejecutor in ('".$despachado[$x]["responsable"]."','".$despachado[$x]["empresa"]."')","",$conn);         
          for($h=0; $h<$empresa["numcampos"]; $h++)
            echo @$empresa[$h]["nombre"]." - ";                                      
          echo "</td></tr><tr><td><b>FECHA:</b></td><td>".$despachado[$x]["fecha_despacho"]."</td></tr>";                    
      break;
      case 2: //Mensajeria Interna enviada con mensajero. 
         echo '<tr><td><B>MENSAJER&Iacute;A INTERNA:</B></td><td>';
         $empresa=busca_filtro_tabla(concatenar_cadena_sql(array("A.nombres","' '","A.apellidos"))." AS nombre","funcionario A","A.idfuncionario='".$despachado[$x]["responsable"]."'","",$conn);     
         echo @$empresa[0]["nombre"]."</td></tr>";            
      break;
      case 3://Personal enviada con el ejecutor.
        echo('<tr><td colspan="2">ENTREGA PERSONAL POR QUIEN ENV&iacute;A EL DOCUMENTO</td></tr>');                    
      break; 
      default:
        echo('<tr><td colspan="2">No</td></tr>');
      break;   
     }      
    }    
     echo("</table></td></tr>");
    }   
  }
  //Se crea los registros de leido si es necesario.    
  if(isset($_GET["key"])) 
    $doc = $_GET["key"];
  else
    $doc = @$_SESSION["iddoc"];
   $codigo=usuario_actual("funcionario_codigo");
   
  leido($codigo,$doc);
 $almacenado=busca_filtro_tabla("*","almacenamiento A","A.documento_iddocumento=".$doc,"",$conn);
 if($almacenado["numcampos"])
 {
 ?>
   <tr>
    <td class="encabezado" title="Datos del almacenamiento del documento."><span class="phpmaker" style="color: #FFFFFF;">DATOS DE ALMACENAMIENTO
  </span></td>
    <td bgcolor="#F5F5F5">
    <?php 
      $i=0;
      $folders = busca_filtro_tabla("caja.idcaja, caja.numero, caja.ubicacion, folder.idfolder, folder.etiqueta, caja.estanteria,caja.nivel,caja.panel", "folder,caja", "caja_idcaja=caja.idcaja AND folder.idfolder=".$almacenado[0]["folder_idfolder"], "caja_idcaja, idfolder", $conn);   
      echo("<table><tr><td><b>Ubicaci&oacute;n:</b></td><td>".$folders[$i]["ubicacion"]."</td></tr>");
      echo("<tr><td><b>Estanter&iacute;a:</b></td><td>".$folders[$i]["estanteria"]."</td></tr>");
      echo("<tr><td><b>Nivel:</b></td><td>".$folders[$i]["nivel"]."</td></tr>");
      echo("<tr><td><b>Panel:</b></td><td>".$folders[$i]["panel"]."</td></tr>");
      echo("<tr><td><b><a href='foldergraf.php?caja=".$folders[$i]["idcaja"]."'>Caja: </b></td><td>".$folders[$i]["numero"]."</a></td></tr>");
      echo("<tr><td><b><a href='almacenamientograf.php?folder=".$folders[$i]["idfolder"]."'>Folder:</b></td><td>". $folders[$i]["idfolder"]." ".$folders[$i]["etiqueta"]."</a></td></tr></table>");
    ?>
   </td>  
   <td class="encabezado" title="Estado y soporte del documento."><span class="phpmaker" style="color: #FFFFFF;">ESTADO Y SOPORTE DEL DOCUMENTO</span></td>
   <td bgcolor="#F5F5F5">
    <?php 
      $i=0;
      echo("<table><tr><td><b>N&uacute;mero de Folios:</b></td><td>".$almacenado[0]["num_folios"]." </td></tr>");
      echo("<tr><td><b>N&uacute;mero de anexos:</b></td><td>".$almacenado[0]["anexos"]."</td></tr>");
      echo("<tr><td><b>Soporte:</b></td><td>".$almacenado[0]["soporte"]."</td></tr>");
      echo("<tr><td><b>Deterioro:</b></td><td>".$almacenado[0]["deterioro"]."</td></tr></table>");      
    ?>
   </td>
  </tr>
 <?php 
 }
 ?>         
</table></center>
</form>
<p>
<?php include ("footer.php"); 
//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $x_iddocumento,$x_numero,$x_serie,$x_fecha,$x_ejecutor,$x_descripcion,$x_pagina, $x_anexo,$x_dias,$x_fecha_oficio,$x_oficio,$x_descripcion_anexo,$x_plantilla,$x_tipo_radicado,$x_tipo_despacho,$x_municipio,$x_estado,$x_tipo_ejecutor;
	$sKeyWrk = "" . addslashes($sKey) . "";                        
	$sSql = "SELECT A.*, ".fecha_db_obtener("A.fecha",'Y-m-d H:i:s')." AS fecha,".fecha_db_obtener("A.fecha_oficio")." as fecha_oficio FROM documento A";
	
	$sSql .= " WHERE A.iddocumento = " . $sKeyWrk;
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
  $rs = phpmkr_query($sSql,$conn) or error("PROBLEMAS AL EJECUTAR LA BUSQUEDA" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	phpmkr_free_result($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
		//$row = phpmkr_fetch_array($rs);
		// Get the field contents
		$x_iddocumento = $row["iddocumento"];
		$x_numero = $row["numero"];
    $x_estado = $row["estado"];
		$x_serie = $row["serie"];
		$x_fecha = $row["fecha"];
		$x_municipio = $row["municipio_idmunicipio"];
		$x_ejecutor = $row["ejecutor"];
		$x_descripcion = $row["descripcion"];
		if($row["estado"]=="ANULADO")
		  $x_descripcion.="<font color='red'> (ANULADO)</font>";
		$x_paginas = $row["paginas"];
		$x_anexo = $row["anexo"];
		$x_descripcion_anexo = $row["descripcion_anexo"];
		$x_dias = $row["dias"];
		$x_fecha_oficio = $row["fecha_oficio"];
		$x_oficio = $row["oficio"];
		$x_plantilla = $row["plantilla"];
	 	$x_tipo_radicado = $row["tipo_radicado"];
	 	$x_tipo_despacho=$row["tipo_despacho"];
		$x_tipo_ejecutor=$row["tipo_ejecutor"];
   if($x_dias==0)
    {
     $dias = busca_filtro_tabla("","serie","idserie=".$x_serie,"",$conn);
     $x_dias = @$dias[0]["dias_entrega"];
    }	
	}
	return $LoadData;
}
?>
