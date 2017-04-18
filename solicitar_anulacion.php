<?php

if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["doc"];
	$doc_menu=@$_REQUEST["key"];
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento($doc_menu,@$_REQUEST["vista"]));
}

include_once("header.php");

include_once("librerias_saia.php");
echo(estilo_bootstrap());

if(@$_REQUEST["accion"]=="adicionar" && $_REQUEST["key"]){
	$documento=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["key"],"",$conn);
	if($documento[0]["ejecutor"]!=usuario_actual('funcionario_codigo')){
		$ruta_formato=busca_filtro_tabla("","formato a","lower(a.nombre)='".strtolower($documento[0]["plantilla"])."'","",$conn);
		include_once("librerias_saia.php");
		echo(librerias_notificaciones());
		?>
		<script>
		notificacion_saia('<b>ATENCI&Oacute;N</b><br>Usted no es el creador del documento','warning','',4000);
		window.open("<?php echo(FORMATOS_CLIENTE . $ruta_formato[0]["nombre"]); ?>/<?php echo($ruta_formato[0]["ruta_mostrar"]); ?>?iddoc=<?php echo($_REQUEST["key"]); ?>&idformato=<?php echo($ruta_formato[0]["idformato"]); ?>","_self");
		</script>
		<?php
		die();
	}

 	$anulacion=busca_filtro_tabla("","documento_anulacion","documento_iddocumento='".$_REQUEST["key"]."'","",$conn);
?>
<div  align="center">
<?php
menu_ordenar($_REQUEST["key"]);
?>
</div><br /><br />
<B>SOLICITUD DE ANULACI&Oacute;N</B><br><br>
<?php
 if($anulacion["numcampos"])
  {if($anulacion[0]["estado"]=="RECHAZADO")
     echo "La anulaci&oacute;n ya fu&eacute; solicitada, y ha sido RECHAZADA.";
  }

 if($documento["numcampos"]&&$documento[0]["estado"]=="APROBADO"&&(!$anulacion["numcampos"] || $anulacion[0]["estado"]=="RECHAZADO"))
 {
?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type='text/javascript'>
  $().ready(function() {
	$('#form1').validate();
});
</script>
<form name='form1' method='post' id='form1'>
<table border="0" style="WIDTH:100%;" bgcolor="#CCCCCC" cellpadding="4" cellspacing="4">
 <tr>
  <td class="encabezado">Fecha Solicitud</td>
  <td bgcolor="#F5F5F5"><input type="text" readonly="true" name="fecha_solicitud" id="fecha_solicitud" class="required" value="<?php echo date("Y-m-d H:i:s"); ?>"></td>
 </tr><tr>
  <td class="encabezado">Documento</td>
  <td bgcolor="#F5F5F5"><input type="hidden" name="documento_iddocumento" id="documento_iddocumento" class="required" value="<?php echo $_REQUEST["key"]; ?>"><?php echo $documento[0]["numero"]." - ".$documento[0]["descripcion"]; ?></td>
 </tr>
 <tr>
  <td class="encabezado">Justificaci&oacute;n</td>
  <td bgcolor="#F5F5F5"><textarea cols="50" rows="5" name="descripcion" id="descripcion" class="required" ></textarea></td>
 </tr>
 <tr>
  <td colspan="2">
  	<br>
  <input type="button" class="btn-mini btn-danger" value="Cancelar" onclick="window.history.back(-1);">
  <input type="submit" class="btn-mini btn-primary" value="Continuar">
  <input type="hidden" name="funcionario" value="<?php echo usuario_actual("funcionario_codigo"); ?>">
  <input type="hidden" name="estado" value="SOLICITADO">
  <input type="hidden" name="accion" value="guardar_adicionar">
  <input type="hidden" name="encargado" value="<?php echo $anulador[0][0];?>">
  <input type="hidden" name="idanulacion" value="<?php echo $anulacion[0]["iddocumento_anulacion"];?>">
  </td>
 </tr>
</table>
</form>
<?php
 }
 elseif(@$documento[0]["estado"]=="ANULADO")
   echo "<br />El documento ya fue anulado." ;
 elseif(@$anulacion[0]["estado"]=="SOLICITADO")
    echo "<br />La anulaci&oacute;n ya ha sido solicitada y se encuentra en proceso de revisi&oacute;n.";
 else
   echo "<br />El documento debe estar aprobado para solicitar su anulaci&oacute;n.";
}
elseif(@$_REQUEST["accion"]=="guardar_adicionar")
{// print_r($_REQUEST);die();
 if($_REQUEST["idanulacion"]<>"")
  {$sql="update documento_anulacion set fecha_solicitud=".fecha_db_almacenar($_REQUEST["fecha_solicitud"],"Y-m-d H:i:s").",funcionario='".$_REQUEST["funcionario"]."',descripcion='".$_REQUEST["descripcion"]."',estado='".$_REQUEST["estado"]."' where iddocumento_anulacion=".$_REQUEST["idanulacion"];
   phpmkr_query($sql,$conn);
   alerta("<b>ATENCI&Oacute;N</b><br>La solicitud ha sido enviada");
  }
 else
 {$sql="insert into documento_anulacion(fecha_solicitud,funcionario,descripcion,documento_iddocumento,estado) values(".fecha_db_almacenar($_REQUEST["fecha_solicitud"],"Y-m-d H:i:s").",'".$_REQUEST["funcionario"]."','".$_REQUEST["descripcion"]."','".$_REQUEST["documento_iddocumento"]."','".$_REQUEST["estado"]."')";
  phpmkr_query($sql,$conn);
  if(phpmkr_insert_id())
   alerta("<b>ATENCI&Oacute;N</b><br>La solicitud ha sido enviada");
  else
   echo "Problemas al enviar la solicitud";
 }
 $documento=busca_filtro_tabla("","documento","iddocumento=".$_REQUEST["documento_iddocumento"],"",$conn);
 $solicitante=busca_filtro_tabla("","funcionario","idfuncionario=".$_REQUEST["funcionario"],"",$conn);
 $revisores=busca_filtro_tabla("login","buzon_salida b,funcionario f","b.nombre in('REVISADO','APROBADO') and origen=funcionario_codigo and archivo_idarchivo='".$_REQUEST["documento_iddocumento"]."'","",$conn);
 $mensaje=$solicitante[0]["nombres"]." ".$solicitante[0]["apellidos"]." ha solicitado la ANULACION de un documento sobre el cual ud tiene responsabilidad. Radicado: ".$documento[0]["numero"].". Descripci�n:".$documento[0]["descripcion"].".  Motivo de la solicitud: ".$_REQUEST["descripcion"];
 /*for($i=0;$i<$revisores["numcampos"];$i++)
   enviar_mensaje($revisores[$i]["login"],$mensaje,'msg');*/

 $anuladores=busca_filtro_tabla("login","funcionario","perfil in(select idperfil from perfil ,permiso_perfil where perfil_idperfil=idperfil and modulo_idmodulo='265') or idfuncionario in(select funcionario_idfuncionario from permiso where modulo_idmodulo='265' and accion=1)","",$conn);
 $mensaje=$solicitante[0]["nombres"]." ".$solicitante[0]["apellidos"]." ha solicitado la ANULACION del documento con Radicado:".$documento[0]["numero"].". Descripci�n:".$documento[0]["descripcion"].".  Motivo de la solicitud: ".$_REQUEST["descripcion"];
 /*for($i=0;$i<$anuladores["numcampos"];$i++)
   enviar_mensaje($anuladores[$i]["login"],$mensaje,'msg');*/
 if($documento[0]["plantilla"]!=""){
 	$plantilla=busca_filtro_tabla("","formato a","lower(a.nombre)='".strtolower($documento[0]["plantilla"])."'","",$conn);
 	abrir_url(FORMATOS_CLIENTE.$plantilla[0]["nombre"]."/".$plantilla[0]["ruta_mostrar"]."?iddoc=".$documento[0]["iddocumento"]."&idformato=".$plantilla[0]["idformato"],"detalles");
 }
}
elseif(@$_REQUEST["accion"]=="rechazar")
{$sql="UPDATE documento_anulacion SET estado='RECHAZADO' WHERE documento_iddocumento='".$_REQUEST["key"]."' and estado='SOLICITADO'";
 phpmkr_query($sql,$conn);
 alerta("<b>ATENCI&Oacute;N</b><br>La solicitud ha sido RECHAZADA","warning");
 abrir_url("pantallas/buscador_principal.php?idbusqueda=26","centro");
}
elseif(@$_REQUEST["accion"]=="anular"){

 $sql="UPDATE documento SET estado  = 'ANULADO',pdf='' WHERE iddocumento=".$_REQUEST["key"];
 phpmkr_query($sql,$conn);

 $sql="UPDATE documento_anulacion SET estado='ANULADO',fecha_anulacion=".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s")." WHERE documento_iddocumento='".$_REQUEST["key"]."' and estado='SOLICITADO'";
 phpmkr_query($sql,$conn);
 $doc=busca_filtro_tabla("lower(plantilla)","documento","iddocumento='".$_REQUEST["key"]."'","",$conn);

 $ch = curl_init();
 $fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddoc."&conexion_remota=1&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA];
 curl_setopt($ch, CURLOPT_URL,$fila);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
 $contenido=curl_exec($ch);
 curl_close ($ch);


 $solicitante=busca_filtro_tabla("login,documento.descripcion,numero","funcionario,documento_anulacion,documento","documento_iddocumento=iddocumento and funcionario=funcionario_codigo and documento_iddocumento=".$_REQUEST["key"],"",$conn);
 $datos_documento=busca_filtro_tabla("a.iddocumento,b.idformato","documento a, formato b","lower(a.plantilla)=b.nombre AND a.iddocumento=".$_REQUEST["key"],"",$conn);
 $revisores=busca_filtro_tabla("origen","buzon_salida","nombre in('REVISADO','APROBADO') and archivo_idarchivo='".$_REQUEST["key"]."'","",$conn);
 $mensaje="Ha sido ANULADO el documento con Radicado: ".$solicitante[0]["numero"]." y Descripci&oacute;n:".$solicitante[0]["descripcion"].".";
 for($i=0;$i<$revisores["numcampos"];$i++)
   enviar_mensaje("",'codigo',array($revisores[$i]["login"]),"Solicitud de Anulacion".$datos[0]['numero'],utf8_encode($mensaje));

 	alerta("<b>ATENCI&Oacute;N</b><br>El documento ha sido ANULADO");
   $flujo = busca_filtro_tabla("","paso_documento","documento_iddocumento=".$_REQUEST["key"],"idpaso_documento desc",$conn);
   if($flujo["numcampos"] > 0){
   		include_once("workflow/libreria_paso.php");
   		cancelar_flujo($flujo[0]["idpaso_documento"]);
   }
   llama_funcion_accion($datos_documento[0]['iddocumento'],$datos_documento[0]['idformato'],"anular","POSTERIOR");
 abrir_url("pantallas/buscador_principal.php?idbusqueda=26","centro");
}
elseif(@$_REQUEST["accion"]=="listado_pendientes")
{$datos=busca_filtro_tabla("","busquedas","idbusquedas=92","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=92","",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    $id_func[]=$funciones[$i]["idfunciones_busqueda"];
 $id_func=implode(",",$id_func);
}

if($datos["numcampos"]){

  }die();

}
elseif(@$_REQUEST["accion"]=="listado_procesados")
{ $datos=busca_filtro_tabla("","busquedas","idbusquedas=93","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=93","",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    $id_func[]=$funciones[$i]["idfunciones_busqueda"];
 $id_func=implode(",",$id_func);
}

if($datos["numcampos"]){

  }die();
}
include_once("footer.php");
?>