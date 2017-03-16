<?php
if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["doc"];
	include_once("pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento(@$_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
else{
	include("db.php");
}
 include ("phpmkrfn.php");
 include ("header.php");
 include_once("calendario/calendario.php");
 include_once("librerias_saia.php");
//echo estilo_bootstrap();
?>
<script type="text/javascript" src="js/tooltips_rastro.js"></script>
<style type="text/css">
	#dhtmlgoodies_tooltip{
		background-color:#EEE;
		border:1px solid #000;
		position:absolute;
		display:none;
		z-index:30000;
		padding:2px;
		font-size:0.9em;
		-moz-border-radius:6px;	/* Rounded edges in Firefox */
		font-family: "Trebuchet MS", "Lucida Sans Unicode", Arial, sans-serif;

	}
	#dhtmlgoodies_tooltipShadow{
		position:absolute;
		background-color:#555;
		display:none;
		z-index:10000;
		opacity:0.7;
		filter:alpha(opacity=70);
		-khtml-opacity: 0.7;
		-moz-opacity: 0.7;
		-moz-border-radius:6px;	/* Rounded edges in Firefox */
	}
	a{
		color: #000000;
		text-decoration:none;		;
	}
	a:hover{
		border-bottom:1px dotted #317082;
		color: #000000;
	}
	</style>
<?php
if(isset($_REQUEST["doc"]))
  $x_doc=$_REQUEST["doc"];
else if(isset($_SESSION["iddoc"]))
  $x_doc=$_SESSION["iddoc"];
else $x_doc=0;
//Muestra la informacion basica del documento
$datos = busca_filtro_tabla("numero,".fecha_db_obtener("fecha","Y-m-d")." as fecha,descripcion,serie,tipo_radicado,plantilla,estado","documento","iddocumento=$x_doc","",$conn);
$dias1=busca_filtro_tabla("iddocumento,".fecha_db_obtener("fecha",'Y-m-d')." as fecha,numero,".case_fecha('dias',"''",'dias_entrega','dias')." as dias_r","documento left join serie on serie=idserie","iddocumento=$x_doc","",$conn);
if($dias1[0]["dias_r"]<>"")
   $fecha_f=dias_habiles($dias1[0]["dias_r"]+1,'Y-m-d',$dias1[0]["fecha"]);
menu_ordenar($x_doc);
?>
<br /><span class="internos">SEGUIMIENTO DE RUTA DE DOCUMENTOS<br><br>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:90%">
 <tr>
  <td class="encabezado" width="40%"><span class="phpmaker" style="color:#ffffff;">N&Uacute;MERO DE RADICACI&Oacute;N&nbsp;</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker"><?php echo $datos[0]["numero"];?></span></td>
 </tr>
 <tr>
  <td class="encabezado"><span class="phpmaker" style="color:#ffffff;">FECHA DE INICIO DE PROCESO</span></td>
  <td bgcolor="#ffffff"><span class="phpmaker"><?php echo $datos[0]["fecha"];?></span></td>
 </tr>
 <tr>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA L&Iacute;MITE DE RESPUESTA</td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <?php if($dias1[0]["dias_r"]<>"")
          echo $fecha_f;
        else
          echo("<a href='clasificar.php?origen=view&iddocumento=".$x_doc."&cmd=resetall'>FECHA NO ASIGNADA</a>");
  ?></span></td>
 </tr>
 <tr>
  <td class="encabezado"><span class="phpmaker" style="color:#ffffff;">DESCRIPCI&Oacute;N DEL DOCUMENTO&nbsp;</span></td>
  <td bgcolor="#ffffff"><span class="phpmaker"><?php echo str_replace(chr(10), "<br>", stripslashes($datos[0]["descripcion"])); ?></span></td>
 </tr>
 <tr>
  <td class="encabezado"><span class="phpmaker" style="color:#ffffff;">CLASIFICACI&Oacute;N DEL DOCUMENTO </span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <?php if($datos[0]["serie"]<>Null || $datos[0]["serie"]<>"Null")
  { $serie = busca_filtro_tabla("*","serie","idserie=".$datos[0]["serie"],"",$conn);
    if($serie["numcampos"])
      echo $serie[0]["nombre"];
    else
      echo("<a href='clasificar.php?origen=view&iddocumento=".$x_doc."&cmd=resetall'>CLASIFICACI&Oacute;N DEL DOCUMENTO NO ASIGNADA O NO ENCONTRADA</a>");
  }
  ?></span></td>
 </tr>
 <?php
 $anulacion=busca_filtro_tabla("b.nombres,b.apellidos,a.*,".fecha_db_obtener("fecha_solicitud","Y-m-d")." as fecha_solicitud,".fecha_db_obtener("fecha_anulacion","Y-m-d")." as fecha_anulacion","documento_anulacion a,funcionario b","documento_iddocumento='$x_doc' and funcionario=funcionario_codigo","",$conn);
 if($anulacion["numcampos"])
  {echo '<tr>
        <td class="encabezado"><span class="phpmaker" style="color:#ffffff;">DETALLES DE SOLICITUD DE ANULACION</span></td>
        <td bgcolor="#ffffff"><span class="phpmaker">Solicitante: '.$anulacion[0]["nombres"]." ".$anulacion[0]["apellidos"].'<br />Fecha Solicitud: '.$anulacion[0]["fecha_solicitud"].'<br />Justificaci&oacute;n: '.$anulacion[0]["descripcion"].'<br />Estado: '.$anulacion[0]["estado"].'<br />Fecha de anulaci&oacute;n: '.$anulacion[0]["fecha_anulacion"].'</span></td></tr>';
  }
  $respondiendo=respondiendo_documento($x_doc);
  $cadena="";
  if(@$respondiendo["numcampos"]){
   $cadena.="<ul>";
 ?>
 <tr>
  <td class="encabezado" title="Seguir Documento al que el documento actual ha servido como respuesta"><span class="phpmaker" style="color:#ffffff;">RESPONDIENDO A</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <?php
   for($j=0;$j<$respondiendo["numcampos"];$j++)
   {
    $cadena.="<li><a href='doctransflist.php?doc=".$respondiendo[$j]["iddocumento"]."'>".$respuesta[$j]["numero"]." - ".$respondiendo[$j]["descripcion"]."</a></li>";
   }
   $cadena.="</ul>";
   echo($cadena);
  ?>
  </td>
 </tr>
 <?php
  }
  $respuestas=respuestas_documento($x_doc);
  $cadena="";
  if(@$respuestas["numcampos"])
  {
    $cadena.="<ul>";
 ?>
 <tr>
  <td class="encabezado" title="Seguir respuestas del Documento"><span class="phpmaker" style="color:#ffffff;">RESPUESTAS</span></td>
  <td bgcolor="#F5F5F5"><span class="phpmaker">
  <?php
   for($j=0;$j<$respuestas["numcampos"];$j++)
   {
    $cadena.="<li><a href='doctransflist.php?doc=".$respuestas[$j]["iddocumento"]."'>".$respuesta[$j]["numero"]." - ".$respuestas[$j]["descripcion"]."</a></li>";
   }
   $cadena.="</ul>";
   echo($cadena);
  ?>
  </td>
 </tr>
 <?php
 }
 ?>
 </table>
 <br><br>
 <?php
  $ruta = busca_filtro_tabla("tipo_origen,tipo_destino,origen,destino,obligatorio","ruta","documento_iddocumento=$x_doc and tipo='ACTIVO'","idruta",$conn);
  if($ruta["numcampos"]>0)
  {
 ?>
  <a href="#" onclick="document.getElementById('ruta').style.display='block'">Responsables</a>&nbsp;&nbsp;
  <?php } ?>

<div id="ruta" style="display:none">
 <?php
  if($ruta["numcampos"]>0)
  {
  ?><br><br>
  <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:90%">
   <tr class="encabezado_list">
	  <td colspan="4"><SPAN class="phpmaker" syule="color:#ffffff">RESPONSABLES DEL DOCUMENTO
	 </tr>
   <tr class="encabezado_list">
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">De</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Para</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Firma</span></td>
   </tr>
    <?php
      for($i=0;$i<$ruta["numcampos"];$i++)
      {
      	$sItemRowClass = " bgcolor=\"#FFFFFF\"";
      	if ($i % 2 <> 0)  // Display alternate color for rows
      		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
        echo('<tr'.$sItemRowClass.'><td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta[$i]["tipo_origen"],$ruta[$i]["origen"]))."</span></td>");
        echo('<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta[$i]["tipo_destino"],$ruta[$i]["destino"]))."</span></td>");
        if($ruta[$i]["obligatorio"])
          echo('<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta[$i]["tipo_origen"],$ruta[$i]["origen"]))."</span></td>");
        else  echo('<td><span class="phpmaker" >&nbsp;</span></td>');
      }
    echo "</table>";
  }
    ?>
</div>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<br /><br /><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 500, height:400,preserveContent:false } )" href="listado_leidos.php?iddoc=<?php echo $x_doc; ?>">Listado de fechas de lectura</a><br /><br />
<div id="recorrido_filtro">
<a href="#" onclick="document.getElementById('recorrido').style.display='block'">Rastro</a>&nbsp;&nbsp;
<br><?php  tabla_colores(); ?><br>
<?php echo(rastro_documento($x_doc,"")); ?>
</div>
<br />
<div id="recorrido">
<?php echo(rastro_documento($x_doc,1)); ?>
</div>
<?php
echo $ruta_doc=mostrar_ruta_documento($x_doc);
?>
<br>
<script>
function mostrar_mas_rastro(){
	var ini=$("#mostrar_mas").attr("inicio");
	$.post("rastro_documento.php",{iddoc: <?php echo $x_doc; ?>, inicio: ini},function(respuesta){
		//alert(respuesta);
		$("#mostrar_mas").remove();
		$("#fila_mostrar_mas").remove();
		$("#tabla_rastro").append(respuesta);
	});
}
</script>
<?php
include("footer.php");

/*
<Clase>
<Nombre>mostrar_leido</Nombre>
<Parametros>$x_doc: iddocumento,$fun: codigo del funcionario, $fecha: fecha base para la consulta</Parametros>
<Responsabilidades>muestra la imagen de leido o no leido dependiendo si el documento ya fue leido<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function mostrar_leido($x_doc,$fun,$fecha)
{
 global $conn;
 $leido = busca_filtro_tabla("idtransferencia","buzon_salida","archivo_idarchivo=$x_doc and origen=$fun and (nombre='LEIDO' or nombre='BORRADOR') and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >= '$fecha'","",$conn);
 if($leido["numcampos"]>0)
  $texto.= "<img src='images/leido.png' border='0'>";
 else
  $texto.= "<img src='images/no_leido.png' border='0'>";
 return $texto;
}
/*
<Clase>
<Nombre>recorrido</Nombre>
<Parametros>$x_doc: iddocumento,$fun:funcionario codigo,$fecha:fecha base para la busqueda,$tipo:identifica para saber si muetra el recorrido siguiente del coumento o muetra quien ha leido el documento </Parametros>
<Responsabilidades>Mostra dependiendo el tipo el rastro del documento<Responsabilidades>
<Notas>Esta se ejecuta pora un POSIT</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>Librerias showTooltip <Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function recorrido($x_doc,$fun,$fecha,$tipo)
{
 global $conn;
 $texto = "";
 switch($tipo)
 {
  case "siguiente":
   $buzon_sig = busca_filtro_tabla("origen,destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." >='$fecha' ","fecha DESC",$conn);

   if($buzon_sig["numcampos"]>0)
   {
    $texto .= "<table border=1>";
    for($j=0; $j<$buzon_sig["numcampos"]; $j++)
    {if($buzon_sig[$j]["nombre"]=='BORRADOR')
       $buzon_sig[$j]["nombre"]='LEIDO' ;
     if($buzon_sig[$j]["nombre"]=='LEIDO')
      $texto.= "<tr><td colspan = 4>".$buzon_sig[$j]["nombre"]." ".$buzon_sig[$j]["fecha"]."</td></tr>";
     else
      $texto.= "<tr><td>".$buzon_sig[$j]["nombre"]." </td><td> ".codifica_encabezado(busca_entidad_ruta(1,$buzon_sig[$j]["destino"]))." ".$buzon_sig[$j]["fecha"]."</td></tr>";
    }
    $texto .= "</table>";
   }
  break;
  case "leido":
   /*$transferencias = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and origen=".$fun." and nombre not in('LEIDO','BORRADOR')","",$conn);
   if($transferencias["numcampos"]>0)
   { $texto .= "<table border=1><tr><td align=center>Destino</td><td align=center>Fecha de leido</td></tr>";
     for($i=0; $i<$transferencias["numcampos"]; $i++)
     { $buzon_sig = busca_filtro_tabla("destino,nombre,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha","buzon_salida","archivo_idarchivo=$x_doc and nombre='LEIDO' AND origen=".$transferencias[$i]["destino"]." and ".fecha_db_obtener("fecha","Y-m-d H:i:s")." > '".$transferencias[$i]["fecha"]."'","",$conn);
       if($buzon_sig["numcampos"]>0)
         $texto .= "<tr><td> ".codifica_encabezado(busca_entidad_ruta(1,$buzon_sig[0]["destino"]))."</td><td>&nbsp;".$buzon_sig[0]["fecha"]."</tr>";
       else
         $texto .= "<tr><td>".codifica_encabezado(busca_entidad_ruta(1,$transferencias[$i]["destino"]))."</td><td>No se ha leido</tr>";
     }
   } */
  break;
 }
 if($texto!="")
 {
   $texto = 'onmouseout="hideTooltip()" onMouseOver=\'showTooltip(event,"'.$texto.'");return false\'';
 }
 return($texto);
}
/*
<Clase>
<Nombre>respuestas_documento</Nombre>
<Parametros>$iddoc:identificador del documento</Parametros>
<Responsabilidades>Mostrar la informacion de o los documentos <Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>Retorna un array con el iddocumento, numero y descripcion del documento origen</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function respuestas_documento($iddoc)
{
  global $conn;
  $respuesta=busca_filtro_tabla("A.iddocumento,A.numero,A.descripcion","documento A,respuesta B","A.iddocumento=B.destino and B.origen=".$iddoc,"",$conn);
  return($respuesta);
}
/*
<Clase>
<Nombre>respondiendo_documento</Nombre>
<Parametros>$iddoc:identificador del documento</Parametros>
<Responsabilidades>Mostrar la informacion del documento el cual se est� respondiendo con el $iddoc<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida>Retorna un array con el iddocumento, numero y descripcion del documento origen</Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function respondiendo_documento($iddoc)
{
  global $conn;
  $respuesta=busca_filtro_tabla("A.iddocumento,A.numero,A.descripcion","documento A,respuesta B","A.iddocumento=B.origen and B.destino=".$iddoc,"",$conn);
  return($respuesta);
}

/*
<Clase>
<Nombre>busca_entidad_ruta</Nombre>
<Parametros>$tipo: funcionario o ejecutor
$llave: identificador del tipo
</Parametros>
<Responsabilidades>Validar el tipo y retorna el nombre si es funcionario retorna el nombre y apellido, si es ejecutor retorna el nombre.<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function busca_entidad_ruta($tipo,$llave)
{
  global $conn;
  switch($tipo){
    case 1:// Funcionario
      $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo='".$llave."'","",$conn);
      if($dato["numcampos"])
        return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
      else return("Funcionario no encontrado");
      break;
		case 5:
    $dato=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A,dependencia_cargo","A.idfuncionario=funcionario_idfuncionario and iddependencia_cargo='".$llave."'","",$conn);

    if($dato["numcampos"])
      return($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
    else return("Funcionario no encontrado");
  	break;
    case 2:// Ejecutor
      $dato=busca_filtro_tabla("b.nombre","datos_ejecutor A,ejecutor b","idejecutor=ejecutor_idejecutor and iddatos_ejecutor='".$llave."'","",$conn);
      //print_r($dato);
      if($dato["numcampos"])
        return(ucwords($dato[0]["nombre"]));
      else return("Destinatario no encontrado");
      break;
  }
}
/*
<Clase>
<Nombre>tabla_colores</Nombre>
<Parametros></Parametros>
<Responsabilidades>Muestra en pantalla las imagnes que identifican si el documento esta leido o no<Responsabilidades>
<Notas>Esta funcion es solo de explicacion para el usuario</Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function tabla_colores()
{
 echo "<table><tr><td bgcolor='#FFFFFF'><img src='images/leido.png'></td><td>El funcionario ya ley&oacute; el documento</td></tr>
       <tr><td bgcolor='#FFFFFF'><img src='images/no_leido.png'></td><td>El funcionario no ha le&iacutedo el documento</td></tr>";
}

function mostrar_ruta_documento($iddoc){
	global $conn;
	$ruta_actual=busca_filtro_tabla("A.*,destino as destino1,origen as origen1,tipo_origen,tipo_destino","ruta A","A.documento_iddocumento=".$iddoc." AND A.tipo='ACTIVO'","idruta",$conn);

	if(!$ruta_actual["numcampos"]){
		$ruta_actual=busca_filtro_tabla("destino as origen1, origen as destino1,1 as obligatorio, 1 as tipo_origen, 1 as tipo_destino","buzon_entrada","nombre='POR_APROBAR' and archivo_idarchivo=$iddoc","",$conn);
  	$unafirma=1;
	}
	$origen = @$ruta_actual[0]["origen1"];
	$tabla="";

	if($ruta_actual["numcampos"]>0){
		$tabla.='<br /><table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" style="width:90%">
		<tr class="encabezado_list">
			<td colspan="5" style="text-align:center"><span class="phpmaker" style="color: #FFFFFF;">RUTA DEL DOCUMENTO</span></td>
		</tr>
  	<tr class="encabezado_list">
  		<td><span class="phpmaker" style="color: #FFFFFF;">&nbsp;</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
          De
  		</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
  	     Para
  		</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
        Funcionario
  		</span></td>
  		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
        Opciones de firma
  		</span></td>
  	</tr>';
		for($i=0;$i<$ruta_actual["numcampos"];$i++){
			$sItemRowClass = " bgcolor=\"#FFFFFF\"";
			if($i % 2 <> 0){
      	$sItemRowClass = " bgcolor=\"#F5F5F5\"";
     	}
			$tabla.='<tr'.$sItemRowClass.'>
			<td><span class="phpmaker" >'.($i+1).'</span></td>
			<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen1"]))."</span></td>";
      $tabla.='<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_destino"],$ruta_actual[$i]["destino1"]))."</span></td>";

      $tabla.='<td><span class="phpmaker" >'.codifica_encabezado(busca_entidad_ruta($ruta_actual[$i]["tipo_origen"],$ruta_actual[$i]["origen1"]))."</span></td>";
      $tabla.='<td bgcolor="#F5F5F5"><span class="phpmaker" >';
			if($ruta_actual[$i]["obligatorio"]==1)
      	$tabla.=' Firma visible ';
    	if($ruta_actual[$i]["obligatorio"]==2)
      	$tabla.= ' Revisado ';
    	if($ruta_actual[$i]["obligatorio"]==5)
      	$tabla.= ' Firma externa ';
    	if($ruta_actual[$i]["obligatorio"]==0)
      	$tabla.=' Ninguno ';
    	$tabla.= '</span></td></tr>';
		}
		$tabla.='</table>';
	}
	return($tabla);
}
function rastro_documento($x_doc,$filtro){
 $condicion_radicador_salida='';

 $titulo="SEGUIMIENTO TOTAL DEL DOCUMENTO";
 if($filtro)$titulo="SEGUIMIENTO PERSONAL DEL DOCUMENTO";
 $cantidad_maxima_rastro=busca_filtro_tabla("","configuracion a","nombre='cantidad_maxima_rastro' and tipo='rastro'","",$conn);

 $cantidad=busca_filtro_tabla("count(*) as cant","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","",$conn);

 if($cantidad[0]["cant"]>$cantidad_maxima_rastro[0]["valor"] && !$filtro){
 	$start=0;
	$limit=$cantidad_maxima_rastro[0]["valor"];
 	$recorrido = busca_filtro_tabla_limit("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","order by idtransferencia desc",$start,($limit-1),$conn);
 }
 else if($filtro){
 	$recorrido = busca_filtro_tabla("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO') AND destino='".usuario_actual('funcionario_codigo')."'","idtransferencia DESC",$conn);
 }
 else{
 	$recorrido = busca_filtro_tabla("buzon_salida.*,".fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha_format","buzon_salida","archivo_idarchivo=$x_doc and nombre not in ('LEIDO','ELIMINA_LEIDO','ELIMINA_APROBADO','ELIMINA_REVISADO','ELIMINA_TERMINADO','ELIMINA_TRANSFERIDO')","idtransferencia DESC",$conn);
 }

 $documento=busca_filtro_tabla("plantilla","documento","iddocumento=$x_doc","",$conn);
 if($recorrido["numcampos"]>0)
 {
 	$id_tabla="tabla_rastro";
 	if($filtro)$id_tabla="tabla_rastro_propio";
?>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" id="<?php echo($id_tabla); ?>" name="<?php echo($id_tabla); ?>" style="width:90%">
   <tr class="encabezado_list">
	  <td colspan="6"><span class="phpmaker" style="color:#ffffff"><?php echo($titulo); ?></span>
	 </tr>
   <tr class="encabezado_list">
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Origen</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Acci&oacute;n</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Destino</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Fecha</span></td>
  	<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Observaciones</span></td>
   </tr>
    <?php
      for($i=0;$i<$recorrido["numcampos"];$i++)
      {
      	$sItemRowClass = " bgcolor=\"#FFFFFF\"";
      	if ($i % 2 <> 0)  // Display alternate color for rows
      		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
        if($recorrido[$i]["nombre"]!='BORRADOR')
          $leidos=recorrido($x_doc,$recorrido[$i]["origen"],$recorrido[$i]["fecha_format"],"leido");
        echo('<tr'.$sItemRowClass.'><td><span class="phpmaker" ><a href="#" '.$leidos.'>'.codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["origen"]))."</a></span></td>");

				$accion=str_replace("COPIA","Transferido con copia a",str_replace('TRANSFERIDO','Transferido a Destino Responsable',$recorrido[$i]["nombre"]));
        echo('<td><span class="phpmaker" >'.$accion."</span></td>");

        $sig="";
        //if($recorrido[$i]["nombre"]!='BORRADOR')
          $sig=recorrido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"],"siguiente");
        $leido = mostrar_leido($x_doc,$recorrido[$i]["destino"],$recorrido[$i]["fecha_format"]);
        if($recorrido[$i]["nombre"]=="DISTRIBUCION" && strpos($recorrido[$i]["notas"],"enviado por e-mail")===false)
          {if($documento[0]["plantilla"]=="")
             echo('<td><span class="phpmaker" ><a href="#" '.$sig.'>'.codifica_encabezado(busca_entidad_ruta(2,$recorrido[$i]["destino"])).'</a></span></td>');
           elseif($documento[0]["plantilla"]=="CARTA")
             {$destinos=busca_filtro_tabla("destinos","ft_carta","documento_iddocumento=$x_doc","",$conn);
              $codigos=explode(",",$destinos[0]["destinos"]);
              echo('<td><span class="phpmaker" >');
              foreach($codigos as $filacod)
                echo codifica_encabezado(busca_entidad_ruta(2,$filacod))."<br />";
              echo ('</span></td>');
             }
           else
             {echo('<td><span class="phpmaker" >');
              echo codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["destino"]))."<br />";
              echo ('</span></td>');
             }
          }
        else
          echo('<td><span class="phpmaker" >'.$leido.'<a href="#" '.$sig.'>'.codifica_encabezado(busca_entidad_ruta(1,$recorrido[$i]["destino"])).'</a></span></td>');

        echo('<td><span class="phpmaker" >'.$recorrido[$i]["fecha_format"]."</span></td>");
        if($_SESSION["usuario_actual"]==$recorrido[$i]["origen"] || $_SESSION["usuario_actual"]==$recorrido[$i]["destino"] || $recorrido[$i]["ver_notas"]==1){
            if($recorrido[$i]["nombre"]=="COPIA" && $recorrido[$i]["ver_notas"]==0){
                $recorrido[$i]["notas"]='';
            }
             echo('<td><span class="phpmaker" >'.$recorrido[$i]["notas"]."</span></td>");
        }else{
             echo('<td><span class="phpmaker" >&nbsp;</span></td>');
        }
      }
	if($cantidad[0]["cant"]>$cantidad_maxima_rastro[0]["valor"] && !$filtro){
		echo ('<tr '.$sItemRowClass.' id="fila_mostrar_mas"><td id="mostrar_mas" onclick="mostrar_mas_rastro();" colspan="6" style="cursor:pointer" inicio="'.$cantidad_maxima_rastro[0]["valor"].'"><button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Ver mas...</button></td></tr>');
	}
    ?>
  </table>
<?php }
elseif($datos[0]["tipo_radicado"]==2 && ($datos[0]["plantilla"]=='' || $datos[0]["plantilla"]== "null"))
 echo "<b>El documento fue realizado por radicaci&oacute;n de salida, por lo tanto no tiene rastro.</b>";
}

function imprimir_datos_digitalizacion($iddoc)
{global $conn;
 $doc=busca_filtro_tabla("","documento","iddocumento='".$iddoc."'","",$conn);
 $info=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha,".concatenar_cadena_sql(array("nombres","' '","apellidos"))." as funcionario,justificacion,accion","digitalizacion,funcionario","funcionario=funcionario_codigo and documento_iddocumento='".$iddoc."'","fecha asc",$conn);
 if($info["numcampos"])
 {echo '<br>
       <table border="1" style="border-collapse:collapse;width:90%" cellpadding="4" > 
       <tr class="encabezado_list">
       <td colspan=4>INFORMACION ADICIONAL</td></tr>
       <tr class="encabezado_list"><td>FECHA</td>
       <td>FUNCIONARIO</td><td>ACCION</td><td>NOTAS</td></tr>';
  for($i=0;$i<$info["numcampos"];$i++)
    echo '<tr>
          <td>'.$info[$i]["fecha"].'</td>
          <td>'.$info[$i]["funcionario"].'</td>
          <td>'.$info[$i]["accion"].'</td>
          <td>'.$info[$i]["justificacion"].'</td>
          </tr>';     
  echo '</table>';
 } 
}
?>
