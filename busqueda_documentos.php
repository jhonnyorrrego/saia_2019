<?php include_once ("db.php");
      include_once ("header.php");
      include_once("calendario/calendario.php");
?>
<?php
   header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
  header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
  header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
  header("Cache-Control: post-check=0, pre-check=0", true);
  header("Pragma: no-cache"); // HTTP/1.0
?>
<script type="text/javascript" src="popcalendar.js"></script>
<script type="text/javascript" src="anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type='text/javascript' src='js/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<link rel="stylesheet" type="text/css" href="css/jquery.autocomplete.css" />
<script type='text/javascript'>
    hs.graphicsDir = 'anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>

<script>
/*
<Clase>
<Nombre>despachar</Nombre>
<Parametros></Parametros>
<Responsabilidades>guarda todos los documentos chequeados en un string para posteriormente realizar el despacho<Responsabilidades>
<Notas></Notas>
<Excepciones>Se debe seleccionar por lo menos un documento</Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function despachar()
  {var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("resultados").elements.length;i=i+1)
    {var objeto=document.getElementById("resultados").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("despachar_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
   if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else
    {document.getElementById("docs").value=docs;
     document.getElementById("resultados").action="despachar.php";
     document.getElementById("resultados").submit();
    }
  }
$().ready(function() {

	function findValueCallback(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}

	function formatItem(row) {
		return row[1] + " (<strong>Documento: " + row[2] + "</strong>)";
	}
	function formatResult(row) {
		return row[1].replace(/(<.+?>)/gi, '');
	}

	$("#auto1").autocomplete('formatos/librerias/seleccionar_ejecutor.php?tipo=nombre', {
		width: 500,
		max:20,
    scroll: true,
		scrollHeight: 150,
		matchContains: true,
    minChars:4,
    formatItem: formatItem,
    formatResult: function(row) {
		return row[4];
		}
	});
	$("#auto1").result(function(event, data, formatted) {
		if (data){
      $("#ejecutor").val(data[0]);
		}
	});
});
////////////////////////////////////////////////////////////////////////////////
</script>
<?php
$sExport = "";
$sExport = @$_REQUEST["exportar"]; // Load Export Request
if ($sExport == "csv") {
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment; filename=resultado_consulta.xls');
}
if ($sExport == "word") {
	header('Content-Type: application/vnd.ms-word');
	header('Content-Disposition: attachment; filename=resultado_consulta.doc');
}
 $numero = "";
 $x_fecha_ingreso = "";
 $y_fecha_ingreso = "";
 $serie = "";
 $ejecutor = "";
 $descripcion = "";
 $expediente = "";
 $plantilla = "";
 $funcionario ="";
 $transferido ="";
 $nDisplayRecs = 10;
 $order ="";
//Se reciben los datos del formulario
if(isset($_REQUEST["buscar"]))
 {
 if(!isset($_REQUEST["where"]))
 {
 $numero = @$_POST["numero"];
 $x_fecha_ingreso = @$_POST["x_fecha_ingreso"];
 $y_fecha_ingreso = @$_POST["y_fecha_ingreso"];
 $tipo_fecha =$_POST["z_fecha_ingreso"];
 $tipo_fechax = split(',',$tipo_fecha[0]);
 $tipo_fechay = split(',',$tipo_fecha[1]);
 $serie = @$_POST["x_serie"];
 $anexos_digitales=@$_REQUEST["anexos_digitales"];
 if(isset($_POST["ejecutor"])&&$_POST["ejecutor"]<>"")
	{
	 $ejecutor = $_POST["ejecutor"];
  }
 $descripcion = @$_POST["x_descripcion"];
 $plantilla = @$_POST["plantilla"];
 $contenido = @$_POST["contenido"];
 $tipo = @$_POST["tipo_b"];
 $funcionario = @$_POST["funcionario"];
 $transferido = @$_POST["transferido"];
 $expediente = @$_POST["expediente"];
 $where ="";
 $user = $_SESSION["usuario_actual"];
$despacho=false;

 switch ($tipo)
 {
  case "pendiente":
    $tablas = "documento";
    $volver = "pendienteslist.php";
    $doc_usuario = "SELECT DISTINCT documento_iddocumento FROM asignacion,documento WHERE iddocumento=documento_iddocumento and documento.estado<>'ELIMINADO' and entidad_identidad=1 and llave_entidad=$user and asignacion.estado='PENDIENTE' and tarea_idtarea=2";
    $rs = phpmkr_query($doc_usuario,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $doc_usuario);
    $vector=array();
    $j=0;
    while($vector[]=phpmkr_fetch_array($rs))
    {$resultados[]=$vector[$j][0];
     $j++;
    }
    @phpmkr_free_result($rs);

    if(!isset($resultados))
        $resultados[0]=0;
    $resultados=array_unique($resultados);
   $where0 = " iddocumento IN (".implode(",",$resultados).")";

  break;

  case "proceso":
    $tablas = "documento";
    $volver = "procesolist.php";

    $doc_usuario="SELECT DISTINCT iddocumento,1 as creado FROM buzon_salida s,documento d WHERE s.archivo_idarchivo=d.iddocumento AND s.nombre IN('BORRADOR','REVISADO','RESPONDIDO','TRAMITE','TRANSFERIDO','DEVOLUCION','APROBADO', 'TERMINADO') AND d.estado IN('APROBADO', 'ACTIVO','ANULADO') AND s.origen =$user ORDER BY iddocumento";

    $enviados = "SELECT DISTINCT documento_iddocumento FROM asignacion WHERE entidad_identidad=1 and llave_entidad=$user and  estado='PENDIENTE' and tarea_idtarea=2";
    $rs = phpmkr_query($doc_usuario,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $doc_usuario);
    $vector=array();
    while($vector[]=phpmkr_fetch_array($rs));
    @phpmkr_free_result($rs);

    $rs2= phpmkr_query($enviados,$conn) or error("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $enviados);
    $l_enviados=array();
    while($fila=phpmkr_fetch_array($rs2))
      {$l_enviados[]=$fila[0];
      }
    @phpmkr_free_result($rs2);
    $resultados=array();

    foreach($vector as $fila)
      {if(!in_array($fila[0],$l_enviados) && $fila[0]<>"")
          $resultados[]=$fila[0];
      }
    $where0 = " iddocumento IN (".implode(",",$resultados).")";

  break;

  case "gestion":
    $volver = "documentos_especiales.php?tipo_listado=gestion";
    $tablas = "documento,buzon_salida";
    $where0 .= "documento.estado = 'GESTION' AND archivo_idarchivo=iddocumento AND (buzon_salida.origen=$user OR destino = $user)";
  break;

  case "central":
    $volver = "documentos_especiales.php?tipo_listado=central";
    $tablas = "documento,buzon_salida";
    $where0 .= "documento.estado = 'CENTRAL' AND archivo_idarchivo=iddocumento AND (buzon_salida.origen=$user OR destino = $user)";
  break;

  case "historico":
   $volver = "documentos_especiales.php?tipo_listado=historico";
   $tablas = "documento,buzon_salida";
   $where0 .= "documento.estado = 'HISTORICO' AND archivo_idarchivo=iddocumento AND (buzon_salida.origen=$user OR destino = $user)";
  break;

  case "rad_pendientes":
   $volver = "documentolist.php?estado=iniciado";
   $tablas = "documento";
   $where0 = "documento.estado='INICIADO'";
  break;

  case "rad_proceso":
   $volver = "documentolist.php";
   $tablas = "documento";
   $where0 = "tipo_radicado=1 AND estado in ('ACTIVO','APROBADO') ";
  break;

  case "no_transferidos":
   $volver = "documento_no_tranf.php";
   $tablas = "documento LEFT JOIN buzon_salida ON (iddocumento=archivo_idarchivo)";
   $where0 = "archivo_idarchivo is null and estado='ACTIVO' and tipo_radicado='1'";
  break;

  case "ejecutados":
   $volver = "documentolistsal.php";
   $tablas = "documento";
   $where0 = "tipo_radicado = 2 and estado not in('ELIMINADO','INICIADO')";
   $despacho = true;
  break;
  case "permisos_doc":
   $volver = "permiso_perfillist.php";
   $tablas = "documento";
   $where0 = "estado<>'ELIMINADO' and plantilla is not null";
  break;
  case "general":
   $volver = "documentolist_todo.php";
   $tablas = "documento";
   $where0 = "estado<>'ELIMINADO'";
  break;
  case 'solicitud_mantenimiento':
  $volver="solicitudes_mantenimiento.php";
  $tablas="documento,ft_solicitud_mantenimiento";
  $where0="documento_iddocumento=iddocumento";
  break;
  default:
   $tablas = "documento,buzon_salida";
   $volver = "general_usuario.php";
   $where0 = "estado<>'ELIMINADO' AND archivo_idarchivo=iddocumento AND (buzon_salida.origen=$user OR buzon_salida.destino = $user) ";
  break;

 }
 if($numero!="")
  $where .= "numero = $numero AND ";
 if($x_fecha_ingreso != "" ){
   $where .= "documento.fecha ".$tipo_fechax[0]." ".fecha_db_almacenar($x_fecha_ingreso,'Y-m-d H:i:s')." AND ";
   if($y_fecha_ingreso != "" ){
    $where .= "documento.fecha ".$tipo_fechay[0]." ".fecha_db_almacenar($y_fecha_ingreso,'Y-m-d H:i:s')." AND ";
   }
   else {
    $where .= "documento.fecha ".$tipo_fechay[0]." ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." AND ";
   }
  }
 if($serie<>"" )
  $where .= "serie = $serie AND ";
 if(@$anexos_digitales&& $anexos_digitales!="" ){
  $where .= " iddocumento IN (SELECT documento_iddocumento FROM anexos WHERE etiqueta LIKE '%".$anexos_digitales."%') AND ";
 }
 if(isset($_REQUEST["pagina_reserva"]))
  $where.=" almacenado=1 AND ";
 if(isset($_REQUEST["expediente"]))
  {$tablas.=",expediente_doc";
   $where.=" expediente_doc.documento_iddocumento=iddocumento and expediente_idexpediente='$expediente' AND ";
  }
 if($ejecutor<>"" )
 {
  /*$idejecutor = busca_filtro_tabla("ejecutor_idejecutor as id","datos_ejecutor","iddatos_ejecutor=$ejecutor","",$conn);
  print_r($idejecutor);*/
  $ejecutores = busca_filtro_tabla("iddatos_ejecutor as id","datos_ejecutor","ejecutor_idejecutor=$ejecutor","",$conn);
  for($j=0; $j<$ejecutores["numcampos"]; $j++)
  { $ids[] = $ejecutores[$j]["id"];
  }
  $where .= "ejecutor IN (".implode(',',$ids).") AND plantilla ='' AND ";
 }
 if($descripcion<>"" )
  $where .= "lower(descripcion) LIKE '%".strtolower((($descripcion)))."%' AND ";
 if($plantilla<>"")
  { $where .= "plantilla LIKE '$plantilla' AND ";
  if($contenido<>"")
   {
    $tablas .= ",ft_".strtolower($plantilla);
    $where .= "documento_iddocumento=iddocumento AND lower(contenido) LIKE '%".strtolower((((($contenido)))))."%' AND ";
   }
  }
 if($funcionario<>"")
  {
   /*if(!strpos($tablas,"buzon_salida"))
     {$tablas .=",buzon_salida";
      $where .="iddocumento=archivo_idarchivo AND ";
     }*/
   $where .="ejecutor = $funcionario AND (plantilla is not null) AND ";
   //$where .="buzon_salida.origen = $funcionario AND buzon_salida.nombre='APROBADO' AND";
  }
  if($transferido<>"")
  {if(!strpos($tablas,"buzon_salida"))
     {$tablas .=",buzon_salida";
      $where .="iddocumento=archivo_idarchivo AND ";
     }
   $where .="buzon_salida.origen=".$_SESSION["usuario_actual"]." AND buzon_salida.destino = $transferido AND ";
  }
 $where .= $where0;
 }
 else
 {
   $where = stripslashes($_REQUEST["where"]);
   $tablas = $_REQUEST["tablas"];
   $volver = $_REQUEST["volver"];
   $orden = $_REQUEST["orden"];
   $ordenar = $_REQUEST["ordenar"];
   if(isset($_REQUEST["ordenar"]) && $_REQUEST["ordenar"]<>"")
     $order = $ordenar." ".$orden;
 }
 if(isset($_REQUEST["pagina_exp"]) && $_REQUEST["pagina_exp"]<>"")
    {
      $sql_query = "SELECT distinct iddocumento,numero,".fecha_db_obtener("documento.fecha","Y-m-d H:i:s")." as fecha,serie,ejecutor,documento.descripcion,plantilla from $tablas where $where ";
      if($order <> "")
       $sql_query .= "order by $order";
      redirecciona("expediente.php?idexpediente=".$_REQUEST["pagina_exp"]."&sql=$sql_query");
    }
 if($_REQUEST["campos_formato"]<>"")
   {$where.=" and  iddocumento IN ".stripslashes($_REQUEST["campos_formato"]);
   }

 $consulta = busca_filtro_tabla("distinct iddocumento,numero,".fecha_db_obtener("documento.fecha","Y-m-d H:i:s")." as fecha,serie,ejecutor,documento.descripcion,estado,plantilla","$tablas","$where","$order",$conn);
//echo ($consulta["sql"]);

 if(isset($_REQUEST["pagina_reserva"]) && $_REQUEST["pagina_reserva"]<>"")
    {$documentos=array();
     if(!$consulta["numcampos"])
       alerta("Entre los documentos reservados no se encontraron coincidencias");
     else
      {for($i=0;$i<$consulta["numcampos"];$i++)
        $documentos[]=$consulta[$i]["iddocumento"];
      }
     redirecciona("solicitudadd.php?documentos=".implode(",",$documentos));
    }
 if(isset($_REQUEST["volver_ver"]))
 { $query = trim($_SESSION["sql"]);
   $posf= strpos($query,"FROM");
   $campos = substr($query,16,$posf-16);
   $posw = strpos($query,"WHERE");
   $from = substr($query,$posf+5,$posw-$posf-5);
   $where = substr($query,$posw+6);
   $consulta = busca_filtro_tabla($campos,$from,$where,"",$conn);
   $volver = $_REQUEST["volver_ver"];
 }
 else
  $_SESSION["sql"]=$consulta["sql"];
 //die($_SESSION["sql"]);
 $nTotalRecs = $consulta["numcampos"];
 if ($sExport != "")
  $nDisplayRecs = $nTotalRecs;
 if ($nDisplayRecs <= 0) { // Display All Records
	$nDisplayRecs = $nTotalRecs;
}
$nStartRec = 1;
if (isset($_REQUEST["pageno"]) && is_numeric($_REQUEST["pageno"]))
  {
   $nPageNo = $_REQUEST["pageno"];
	 $nStartRec = ($nPageNo-1)*$nDisplayRecs+1;
	 if ($nStartRec <= 0)
   		$nStartRec = 1;
	 elseif ($nStartRec >= (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1)
		$nStartRec = (($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
	 $_REQUEST["start"]=$nStartRec;
  }
if(isset($_REQUEST["start"]))
 $nStartRec = $_REQUEST["start"];
$_SESSION["start"]=$nStartRec;
$_SESSION["punto_retorno"]="busqueda_documentos.php?start=$nStartRec&buscar=b&volver_ver=$volver";
//print_r($_SESSION);
if ($sExport == "") {
?>
<p><span class="internos">
<img class="imagen_internos" src="botones/documentacion/documento.gif" border="0">&nbsp;&nbsp;RESULTADO DE LA BUSQUEDA<br><br>
<A href="<?php echo $volver; ?>" target="centro">Regresar al listado</a>&nbsp;&nbsp;
<div style="position:absolute; top:35px; right:10px; width:100px;">
<a href="javascript:document.getElementById('exportar').value='csv'; resultados.submit();"><img src="enlaces/excel.gif" border="0" alt="Exportar a Excel"></a>&nbsp;&nbsp;<a href="javascript:document.getElementById('exportar').value='word'; resultados.submit();"><img src="enlaces/word.gif" border="0" alt="Exportar a Word"></a>
</div>
</span></p>
<?php } else echo "RESULTADO DE LA BUSQUEDA <br /><br />"; ?>
<script>
/*
<Clase>
<Nombre>reordenar</Nombre>
<Parametros>campo:nombre del campo</Parametros>
<Responsabilidades>Almacena el valor del campo por el cual se va a ordenar en el formulario al igual que el tipo de ordenamiento ASC o DESC y ejecuta el formulario<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function reordenar(campo)
  {
   document.getElementById("ordenar").value=campo;
   if(document.getElementById("orden").value=="ASC")
     document.getElementById("orden").value="DESC";
   else if(document.getElementById("orden").value=="DESC")
     document.getElementById("orden").value="ASC";
   document.getElementById("resultados").submit();
  }
</script>
<form action="busqueda_documentos.php" method="POST" name="resultados">
<input type="hidden" name="ordenar" value="">
<?php
   //print_r($_POST);
   $orden_inicial = @$_POST["orden"];
   if(!isset($_POST["orden"]))
         $orden_inicial = "ASC";
?>
<input type="hidden" name="orden" value="<?php echo $orden_inicial?>">
<input type="hidden" name = "buscar" value="b">
<input type="hidden" name = "where" value="<?php echo $where; ?>">
<input type="hidden" name = "tipo_b" value="<?php echo $tipo; ?>">
<input type="hidden" name = "tablas" value="<?php echo $tablas; ?>">
<input type="hidden" name = "volver" value="<?php echo $volver; ?>">
<input type="hidden" name = "exportar" id = "exportar" value="">
<table border="0" align="center" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<thead>
<?php if ($nTotalRecs > 0) { ?>
	<tr class="encabezado_list">
	<?php if ($sExport == "") { ?>
	  <td valign="top"><span class="phpmaker" style="color: #FFFFFF;">&nbsp;</td>
	  <?php } ?>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    <label style="text-decoration:underline; cursor:pointer" onclick="reordenar('numero')">Numero</label></span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    <label style="text-decoration:underline; cursor:pointer" onclick="reordenar('fecha')">Fecha</label></span></td>
			<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    <label style="text-decoration:underline; cursor:pointer" onclick="reordenar('descripcion')">Descripci&oacute;n o Asunto</label></span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Remitente</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">
    <label style="text-decoration:underline; cursor:pointer" onclick="reordenar('plantilla')">Plantilla</label></span></td>
    <td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Buzon</span></td>
    <?php if($despacho)
     echo '<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Despachar</span></td>';

   if($_REQUEST["tipo_b"]=='permisos_doc')
      echo '<td>Permisos</td>';
   ?>

	</tr>	</thead>
	<tbody>
	<?php
if ($nStartRec > $nTotalRecs)
	$nStartRec = $nTotalRecs;
// Set the last record to display
$nStopRec = $nStartRec + $nDisplayRecs - 1;
// Move to first record directly for performance reason
$nRecCount = $nStartRec - 1;
$nRecActual = 0;
$i=0;
if(isset($_REQUEST["start"]))
 $i = $_REQUEST["start"]-1;
while($i<$consulta["numcampos"] && ($nRecCount < $nStopRec) )
{
 $nRecCount++;
 if ($nRecCount >= $nStartRec)
 {
 $nRecActual = $nRecActual + 1;
 $sItemRowClass = " bgcolor=\"#FFFFFF\"";
 	if ($i % 2 <> 0)
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
?>
  <tr<?php echo $sItemRowClass; ?>>
   <?php if ($sExport == "") { ?>
    <td><a href=ordenar.php?accion=mostrar&mostrar_formato=1&key=<?php echo $consulta[$i]["iddocumento"]?>>Detalles</a></td>
    <?php }?>
  	<td><?php echo $consulta[$i]["numero"]; ?></td>
    <td><?php echo $consulta[$i]["fecha"]; ?></td>
    <td><?php echo $consulta[$i]["descripcion"]; ?></td>
    <td><?php
      if($consulta[$i]["plantilla"]<>"")
       {$nejecutor=busca_filtro_tabla("idfuncionario,nombres,apellidos","funcionario","funcionario_codigo=".$consulta[$i]["ejecutor"],"",$conn);
        echo $nejecutor[0]["nombres"]." ".$nejecutor[0]["apellidos"];
       }
      else
       { $nejecutor = busca_filtro_tabla("nombre","ejecutor,datos_ejecutor","ejecutor_idejecutor=idejecutor and iddatos_ejecutor=".$consulta[$i]["ejecutor"],"",$conn);
         echo $nejecutor[0]["nombre"];
       }
    ?></td>
    <td><?php
     $nombre_plantilla = busca_filtro_tabla("etiqueta","formato","nombre='".strtolower($consulta[$i]["plantilla"])."'","",$conn);
    echo $nombre_plantilla[0]["etiqueta"]; ?></td>
    <td><?php if($consulta[$i]["estado"]!='GESTION' && $consulta[$i]["estado"]!='CENTRAL' && $consulta[$i]["estado"]!='HISTORICO'&& $consulta[$i]["estado"]!='ANULADO')
                echo "Pendiente/Proceso";
              else
                echo $consulta[$i]["estado"];
     ?></td>
     <?php if($despacho)
        checkbox($consulta[$i]["iddocumento"]);
     ?>
     <?php
   if($_REQUEST["tipo_b"]=='permisos_doc')
      echo '<td align="center"><a href="permisos_documento.php?iddoc='.$consulta[$i]["iddocumento"].'&accion=ver" '.'class="highslide" onclick="return hs.htmlExpand( this, {	objectType: \'iframe\', outlineType: \'rounded-white\', wrapperClassName: \'highslide-wrapper drag-header\',outlineWhileAnimating: true, preserveContent: false } )"'.'>Ver</a></td>';
   ?>
    </tr>
<?php
 $i++;
 }
}
if($despacho)
   echo "<tr $sItemRowClass><td colspan='10' align='center'><input type='hidden' name='docs' id='docs' value=''>
        <input type='button' value='Despachar' onclick='despachar();'></td></tr>";
?>
</tbody>
</table>
</form>
<?php
 }
////////////////////////////////
?>
<script type="text/javascript">

/*
<Clase>
<Nombre>validar_documentopend</Nombre>
<Parametros>valor:numero de registro del navegador</Parametros>
<Responsabilidades>asigna el varlor al campo start del formulario y ejecuta el formulario de navegación<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function validar_documentopend(valor)
{
document.getElementById("start").value=valor;
document.getElementById("pageno").value="";
document.getElementById("ewpagerform").submit();
}
</script>
<?php if ($sExport == "") {?>
<form action="busqueda_documentos.php" name="ewpagerform" id="ewpagerform" method="POST">
<input type="hidden" name = "buscar" value="b">
<input type="hidden" name = "start" id = "start"  value="">
<input type="hidden" name = "where" value="<?php echo $where; ?>">
<input type="hidden" name = "tipo_b" value="<?php echo $tipo; ?>">
<input type="hidden" name = "tablas" value="<?php echo $tablas; ?>">
<input type="hidden" name = "volver" value="<?php echo $volver; ?>">
<input type="hidden" name ="ordenar" value="<?php echo $ordenar; ?>">
<input type="hidden" name = "orden" value="<?php echo $orden; ?>">
<table bgcolor="" align="center" border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr><td nowrap>
<?php
if ($nTotalRecs > 0) {
	$rsEof = ($nTotalRecs < ($nStartRec + $nDisplayRecs));
	$PrevStart = $nStartRec - $nDisplayRecs;
	if ($PrevStart < 1)
    $PrevStart = 1;
	$NextStart = $nStartRec + $nDisplayRecs;
	if ($NextStart > $nTotalRecs) { $NextStart = $nStartRec ; }
	$LastStart = intval(($nTotalRecs-1)/$nDisplayRecs)*$nDisplayRecs+1;
	?>
	<table border="0" align="center" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker">P&aacute;gina&nbsp;</span></td>
<!--first page button-->
	<?php if ($nStartRec == 1) { ?>
	<td><img src="images/firstdisab.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><label onclick="validar_documentopend(1);"><img src="images/first.gif" alt="Primero" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($PrevStart == $nStartRec) { ?>
	<td><img src="images/prevdisab.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><label onclick="validar_documentopend(<?php echo($PrevStart);?>);"><img src="images/prev.gif" alt="Anterior" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="pageno" id="pageno" value="<?php echo intval(($nStartRec-1)/$nDisplayRecs+1); ?>" size="4"></td>
<!--next page button-->
	<?php if ($NextStart == $nStartRec) { ?>
	<td><img src="images/nextdisab.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><label onclick="validar_documentopend(<?php echo $NextStart; ?>);"><img src="images/next.gif" alt="Siguiente" width="16" height="16" border="0"></td>
	<?php  } ?>
<!--last page button-->
	<?php if ($LastStart == $nStartRec) { ?>
	<td><img src="images/lastdisab.gif" alt="Último" width="16" height="16" border="0"></td>
	<?php } else { ?>
	<td><label onclick="validar_documentopend(<?php echo $LastStart; ?>);"><img src="images/last.gif" alt="Último" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;de <?php echo intval(($nTotalRecs-1)/$nDisplayRecs+1);?></span></td>
	</tr></table>
	<?php if ($nStartRec > $nTotalRecs) { $nStartRec = $nTotalRecs; }
	$nStopRec = $nStartRec + $nDisplayRecs - 1;
	$nRecCount = $nTotalRecs - 1;
	if ($rsEof) { $nRecCount = $nTotalRecs; }
	if ($nStopRec > $nRecCount) { $nStopRec = $nRecCount; } ?>
	<span class="phpmaker">Registros <?php echo $nStartRec; ?> a <?php echo $nStopRec; ?> de <?php echo $nTotalRecs; ?></span>
<?php } else { ?>
	<span class="phpmaker">Registros no encontrados</span>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php
}
}
else
{ ?>
<script>

/*
<Clase>
<Nombre>EW_checkMyForm</Nombre>
<Parametros>f: objeto de formulario</Parametros>
<Responsabilidades>valida los campos obligatorios del formulario<Responsabilidades>
<Notas></Notas>
<Excepciones>Si hay algun campo vacio no se ejecuta el formulario</Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function EW_checkMyForm(f)
{
 if(typeof(tree3) != 'undefined')
 {
  var list_serie = tree3.getAllChecked();
  var serie = list_serie.split(",");
  if(serie.length>1)
  {
    alert("Se debe elegir solo una clasificacion del documento");
		return false;
  }
  if(list_serie!='')
    document.getElementById('x_serie').value=list_serie;
 }
 if(f.x_ejecutor2.value!="" && f.funcionario.value!="")
  {alert("Debe seleccionar un solo tipo de ejecutor ya sea interno (funcionarios) o externo (personas naturales o juridicas)");
  return false;
  }
 if(f.x_ejecutor2.value != "" && f.plantilla.value != "")
  {
   alert("Si desea buscar los documentos con plantilla "+f.plantilla.value+" el ejecutor externo debe estar vacio debido a que el ejecutor es un funcionario de la empresa");
   return false;
  }
 if(f.contenido.value != "" && f.plantilla.value == "")
  {
   alert("Debe seleccionar el tipo de formato del documento para buscar por contenido");
   return false;
  }
  if(f.x_fecha_ingreso.value!="" && f.y_fecha_ingreso.value!="")
  {
    var fecha = f.x_fecha_ingreso.value;
    var fecha1 = f.y_fecha_ingreso.value;
    var mes = eval(fecha1.substring(5,7)+"-1");
    fechay = new Date(fecha1.substring(0,4),mes,fecha1.substring(8,10));
    var mes2 =eval(fecha.substring(5,7)+"-1");
    fechax= new Date(fecha.substring(0,4),mes2,fecha.substring(8,10));
    if(fechax>fechay)
    {
     f.x_fecha_ingreso.value=fecha1;
     f.y_fecha_ingreso.value=fecha;
    }
  }
 return true;
}
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/documentacion/documento.gif" border="0">&nbsp;&nbsp;B&Uacute;SQUEDA DE DOCUMENTOS<br><br>
<form name="documentosearch" id="documentosearch" action="busqueda_documentos.php" method="post" onSubmit="return EW_checkMyForm(this);">
<?php
  if(isset($_REQUEST["pagina_exp"]) && $_REQUEST["pagina_exp"]<>"")
  {
    echo "<input type='hidden' name='pagina_exp' value=".$_REQUEST["pagina_exp"].">";
  }
 if(isset($_REQUEST["pagina_reserva"]) && $_REQUEST["pagina_reserva"]<>"")
  {
    echo "<input type='hidden' name='pagina_reserva' value=1>";
  }
?>
<input type="hidden" name="buscar" value="buscar">
  <table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
    <tr>
      <td class="encabezado" title="Buscar documentos por n&uacute;mero de radicado"><span class="phpmaker" style="color: #FFFFFF;">N&Uacute;MERO DE RADICACI&Oacute;N</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">IGUAL</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" name="numero" value=""></span></td>
    </tr>
    <tr>
      <td class="encabezado"  title="Puede seleccionar un rango de fechas para buscar los documentos que se radicaron en dicho rango"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO AL SISTEMA</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="hidden" name="z_fecha_ingreso[]" value=">=,','">
      <label >ENTRE</label>
      <!--select name="z_fecha_ingreso[]">
      <option value="<>,','">DIFERENTE</option>
      <option value="<,','">MENOR QUE</option>
      <option value="<=,','">MENOR O IGUAL</option>
      <option value=">,','">MAYOR QUE</option>
      <option value=">=,','" selected>ENTRE</option>
      </select></span--></td>
<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="" size="22">
&nbsp;
<!--input name="image" type="image" onclick="popUpCalendar(this, this.form.x_fecha_ingreso,'yyyy/mm/dd');return false;" src="images/ew_calendar.gif" alt="Seleccione una Fecha" /-->
<?php selector_fecha("x_fecha_ingreso","documentosearch","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>
&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="z_fecha_ingreso[]" value="<=,','">
  <label >Y</label>
  <!--select name="z_fecha_ingreso[]">
  <option value="<>,','">DIFERENTE</option>
  <option value="<,','">MENOR QUE</option>
  <option value="<=,','" selected>Y</option>
  <option value=">,','" >MAYOR QUE</option>
  <option value=">=,','">MAYOR O IGUAL</option>
  </select-->
&nbsp;&nbsp;&nbsp;
<input type="text" name="y_fecha_ingreso" id="y_fecha_ingreso" value="" size="22">
&nbsp;
<!--input name="image" type="image" onclick="popUpCalendar(this, this.form.y_fecha_ingreso,'yyyy/mm/dd');return false;" src="images/ew_calendar.gif" alt="Seleccione una Fecha" /-->
<?php selector_fecha("y_fecha_ingreso","documentosearch","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,12,00,"PM"); ?>
</span></td>
</tr>
    <tr>
      <td class="encabezado" title="Buscar documentos seg&uacute;n la clasificaci&oacute;n (Serie Documental)"><span class="phpmaker" style="color: #FFFFFF;">CLASIFICACION DEL DOCUMENTO </span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">=
        <input type="hidden" name="z_serie[]" value="=,,">
        </span></td>
      <td bgcolor="#F5F5F5"><link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
      <input type='hidden' name='x_serie' id='x_serie'/>
	<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
	<script type="text/javascript" src="js/dhtmlXTree.js"></script>
			<span class="phpmaker">
			      Buscar:<br><input type="text" id="stext" width="200px" size="20">
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value,1)">
      <img src="botones/general/anterior.png" border="0px" alt="Anterior"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value,0,1)">
      <img src="botones/general/buscar.png" border="0px" alt="Buscar"></a>
      <a href="javascript:void(0)" onclick="tree3.findItem(document.getElementById('stext').value)">
      <img src="botones/general/siguiente.png" border="0px" alt="Siguiente"></a><br />
<br />
         <div id="esperando_func">
    <img src="imagenes/cargando.gif"></div>
				<div id="treeboxbox_tree3"></div>
      	<script type="text/javascript">
  <!--
  		var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%","100%",0);
			tree3.setImagePath("imgs/");
			tree3.enableIEImageFix(true);
			tree3.enableCheckBoxes(1);
			tree3.setOnLoadingStart(cargando_func);
      tree3.setOnLoadingEnd(fin_cargando_func);
			tree3.enableThreeStateCheckboxes(true);
      tree3.enableSmartXMLParsing(true);
			tree3.loadXML("test_serie.php?tabla=serie&estado=1");
			function fin_cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "none";
      }

      function cargando_func() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_func")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_func")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_func"]');
        document.poppedLayer.style.display = "";
      }
	-->
	</script>
        <?php
        /*
$x_serieList = "<select name=\"x_serie\" onKeypress=buscar_op(this) onblur=borrar_buffer() onclick=borrar_buffer()>";
$x_serieList .= "<option value=''>POR FAVOR SELECCIONE</option>";
$sSqlWrk = "SELECT DISTINCT idserie, nombre FROM serie ORDER BY nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("PROBLEMAS AL EJECUTAR LA B�QUEDA" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_serieList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		$x_serieList .= ">" . $datawrk["nombre"] . "</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_serieList .= "</select>";
echo $x_serieList;*/
?>
        </span></td>
    </tr>
    <tr>
     <td class="encabezado" title="Buscar documentos externos (Radicaci&oacute;n entrada) que fueron entregados a la empresa por el remitente">
            <span class="phpmaker" style="color: #FFFFFF;">REMITENTE
            </span></td>
          <td bgcolor="#F5F5F5">
            <span class="phpmaker">SIMILAR
            <input type="hidden" name="ejecutor" id="ejecutor" value="">
            </span></td>
          <td bgcolor="#F5F5F5">
          <input type="text" size=53 name="x_ejecutor2" id="auto1" >
          </td>
    </tr>
    <tr>
    <td class="encabezado" title="Buscar documentos internos que fueron creados por el funcionario"><span class="phpmaker" style="color: #FFFFFF;">RESPONSABLE</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">SIMILAR</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
     $funcionario = busca_filtro_tabla("distinct funcionario_codigo as cod,nombres,apellidos","funcionario,documento","(plantilla is not null or tipo_radicado>1) and ejecutor=funcionario_codigo","nombres",$conn);
//     print_r($funcionario);
     //$funcionario = busca_filtro_tabla("distinct idfuncionario,nombres,apellidos","funcionario","estado='ACTIVO'","",$conn);
     if($funcionario["numcampos"]>0)
     { echo "<select name='funcionario'><option Value=''>Seleccionar...</option>";
       for($i=0; $i<$funcionario["numcampos"]; $i++)
       {
        echo "<option value='".$funcionario[$i]["cod"]."'>".ucwords($funcionario[$i]["nombres"]." ".$funcionario[$i]["apellidos"])."</option>";
       }
       echo "</select>";
     }
    ?>
    </td>
    </tr>
    <tr>
    <td class="encabezado" title="Buscar los documentos que se le han transferido a un funcionario"><span class="phpmaker" style="color: #FFFFFF;">TRANSFERIDO A</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">SIMILAR</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php
     $funcionario = busca_filtro_tabla("distinct idfuncionario,funcionario_codigo,nombres,apellidos","funcionario","estado=1","nombres",$conn);
     if($funcionario["numcampos"]>0)
     { echo "<select name='transferido'><option Value=''>Seleccionar...</option>";
       for($i=0; $i<$funcionario["numcampos"]; $i++)
       {
        echo "<option value='".$funcionario[$i]["funcionario_codigo"]."'>".$funcionario[$i]["nombres"]." ".$funcionario[$i]["apellidos"]."</option>";
       }
       echo "</select>";
     }
    ?>
    </td>
    </tr>
    <tr>
      <td class="encabezado" title="Buscar documentos por palabra o frase que corresponden al asunto o descripci&oacute;n del documento"><span class="phpmaker" style="color: #FFFFFF;">DESCRIPCI&Oacute;N O ASUNTO
        </span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">SIMILAR
        <input type="hidden" name="z_descripcion[]" value="LIKE,'%,%'">
        </span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
        <textarea cols="35" rows="4" id="x_descripcion" name="x_descripcion"></textarea>
        </span></td>
    </tr>
    <tr>
      <td class="encabezado" title="Buscar documentos por plantilla. En el enlace CAMPOS DENTRO DE LA PLANTILLA puede realizar b&uacute;squedas por datos m&aacute;s espec&iacute;ficos del formato)"><span class="phpmaker" style="color: #FFFFFF;">PLANTILLA
        </span></td>
        <td bgcolor="#F5F5F5"><span class="phpmaker">COMO</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
        <?php $plantillas = busca_filtro_tabla("nombre,etiqueta","formato","mostrar=1","etiqueta",$conn);
              if($plantillas["numcampos"]>0) {
               echo "<select name='plantilla' onchange='formato=this.options[selectedIndex].title; link_buscador.href=\"" . FORMATOS_CLIENTE . "\"+formato+\"/buscar_\"+formato+\".php?campo__retorno=campos_formato\"'><option value='' >Seleccionar...</option>";
                for($i=0; $i<$plantillas["numcampos"]; $i++)
                 echo "<option value='".strtoupper($plantillas[$i]["nombre"])."' title=\"".$plantillas[$i]["nombre"]."\">".$plantillas[$i]["etiqueta"]."</option>";
               echo "</select>";
              }
         ?>
         <!--div id='contenido' style="display:none;">
         <br />Frase en Contenido &nbsp;
         <input type='text' name='contenido' value='' size='45'>
        </div-->
         	<br><br>
           <a href="about:blank" class="highslide" name="link_buscador" id="link_buscador" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 700, height:500,preserveContent:false} )">Campos dentro de la plantilla</a>
         	<input type="hidden" id="campos_formato" name="campos_formato" value="">
        </span></td>
    </tr>
    <?php if(isset($_REQUEST["pagina_expediente"]))
    {
    ?>
    <tr><td class="encabezado" title="Buscar documento por clasificiaci&oacute;n en un expediente">EXPEDIENTE</td>
    <td bgcolor="#F5F5F5">SIMILAR</td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
      <div id="lista1" onmouseout="v=1;" onmouseover="v=0;">
           <div ><input type="text" size=53 id="auto3" autocomplete=off onkeyup="if(Teclados(event,'3') == 1){ autocompletar('3',auto3.value);Action.disabled=true;}" onkeydown = "casilla='expediente';ParaelTab(event,'3')" onfocus="document.getElementById('comple3').style.visibility='visible';" onblur="eliminarespacio(this);document.getElementById('Action').disabled=false;"></div>
           </div>
           <div id="comple3" name="comple3" style="position:absolute" onmouseout="document.getElementById('comple3').style.display='none';Action.disabled=false;"></div> <input type=hidden name=expediente id=expediente>
        </span></td>
    </tr>
    <?php } ?>
    <tr><td class="encabezado" title="Busca documentos que tienen un anexo digital">ANEXOS</td>
      <td bgcolor="#F5F5F5">SIMILAR</td>
      <td bgcolor="#F5F5F5">
        <span class="phpmaker">
          <input type="text" name="anexos_digitales" id="anexos_digitales" value="">
        </span>
      </td>
    </tr>
    <tr>
      <td class="encabezado" title="Filtra la b&uacute;squeda de los documentos por buzones (Pendiente, Procesos, Gesti&oacute;n, etc). La opci&oacute;n TODOS, busca en todos los documentos que usted tiene en SAIA."><span class="phpmaker" style="color: #FFFFFF;">TIPO B&Uacute;SQUEDA</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">&nbsp;&nbsp;</span></td>
      <td bgcolor="#F5F5F5"><span class="phpmaker">
       <input type='radio' name='tipo_b' value='pendiente' <?php if($_REQUEST["tipo_b"]=='pendientes') echo "checked"; ?>>Pendiente
       <input type='radio' name='tipo_b' value='proceso' <?php if($_REQUEST["tipo_b"]=='proceso') echo "checked"; ?>>Proceso
       <input type='radio' name='tipo_b' value='gestion' <?php if($_REQUEST["tipo_b"]=='gestion') echo "checked"; ?>>Gesti&oacute;n
       <input type='radio' name='tipo_b' value='central' <?php if($_REQUEST["tipo_b"]=='central') echo "checked"; ?>>Central
       <input type='radio' name='tipo_b' value='historico' <?php if($_REQUEST["tipo_b"]=='historico') echo "checked"; ?>>Hist&oacute;rico
       <input type='radio' name='tipo_b' value='todos' <?php if($_REQUEST["tipo_b"]=='todos') echo "checked"; ?>>Todos
       <?php
        $radicador = new PERMISO();
        $permiso = false;
        $permiso=$radicador->permiso_usuario("permiso_busqueda_general","1");
        if($permiso)
        {
       ?>
       <input type='radio' name='tipo_b' value='rad_pendientes' <?php if($_REQUEST["tipo_b"]=='rad_pendientes') echo "checked"; ?>>Radicacion Pendientes
       <input type='radio' name='tipo_b' value='rad_proceso' <?php if($_REQUEST["tipo_b"]=='rad_proceso') echo "checked"; ?>>Radicacion En Tramite
       <input type='radio' name='tipo_b' value='no_transferidos' <?php if($_REQUEST["tipo_b"]=='no_transferidos') echo "checked"; ?>>No Tansferidos
       <input type='radio' name='tipo_b' value='ejecutados' <?php if($_REQUEST["tipo_b"]=='ejecutados') echo "checked"; ?>>Ejecutados
       <input type='radio' name='tipo_b' value='general' <?php if($_REQUEST["tipo_b"]=='general') echo "checked"; ?>>General
       <input type='radio' name='tipo_b' value='solicitud_mantenimiento' <?php if($_REQUEST["tipo_b"]=='solicitud_mantenimiento') echo "checked"; ?>>Solicitudes de Mantenimiento
       <input type='radio' name='tipo_b' value='permisos_doc' <?php if($_REQUEST["tipo_b"]=='permisos_doc') echo "checked"; ?>>Permisos Documentos
<?php
       }
       ?>
      </span></td>
    </tr>
  </table>
<input type="submit" name="Action" id="Action" value="Buscar">
</form>
<?php
}
include_once("footer.php");
/*
<Clase>
<Nombre>checkbox</Nombre>
<Parametros>$iddoc:identificador del documento</Parametros>
<Responsabilidades>Muestra si el documento ya esta despachado y si no la opcion para seleccionar y posteriormente despacharlo<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function checkbox($iddoc)
{
global $conn;
  $despacho=busca_filtro_tabla("A.numero_guia,B.tipo_despacho","salidas A, documento B","B.iddocumento=".$iddoc." AND A.documento_iddocumento=B.iddocumento","",$conn);
  echo "<td>";
  if($despacho["numcampos"] && ($despacho[0]["tipo_despacho"]==1 || $despacho[0]["tipo_despacho"]==2 || $despacho[0]["tipo_despacho"]==3)){

    switch($despacho[0]["tipo_despacho"]){
      case 1://mensajeria Externa genera salida
        echo("Guia:".$despacho[0]["numero_guia"]);
      break;
      case 2://Mensajeria Interna enviada con mensajero.
        echo("Mensajeria Interna");
      break;
      case 3: //Personal enviada con el ejecutor.
        echo("Personal");
      break;
    }
  }
  else{
  $doc=busca_filtro_tabla("A.numero","documento A","A.iddocumento=$iddoc","",$conn);
  if($doc["numcampos"] && !$doc[0]["numero"]){
    echo("En Tr&aacute;mite");
    }
  else  echo "<input type=checkbox name='despachar_$iddoc'>";

  }
 echo "</td>";
}
?>
