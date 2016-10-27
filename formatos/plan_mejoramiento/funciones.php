<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");

if(isset($_REQUEST["export"])&&$_REQUEST["export"]=="excel"&& @$_REQUEST["tipo"]!=5){
  header('Content-Type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=archivo.xls");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
}  
if(@$_REQUEST["tipo"]!=5){
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
function actualizar_estado(tipo,documento_estado){
  $.ajax({
      type:'POST',
      url:'modificar_estado_plan_mejoramiento.php',
      data:'iddocumento='+documento_estado+"&tipo="+tipo,
      success: function(datos,exito){
          if(tipo==1){
            $("#estado_elaborado").empty();
            $("#estado_elaborado").append(datos);
          }
          if(tipo==2){
            $("#estado_revisado").empty();
            $("#estado_revisado").append(datos);
          }
          if(tipo==3){
            $("#estado_aprobado").empty();
            $("#estado_aprobado").append(datos);
          }
          
          <?php $idformato_plan_mejoramiento=busca_filtro_tabla("idformato","formato","nombre='plan_mejoramiento'","",$conn); ?>
          
          window.open("mostrar_plan_mejoramiento.php?idformato=<?php echo($idformato_plan_mejoramiento[0]['idformato']); ?>&iddoc="+documento_estado,"_self");
      }
    });
}
</script>
<?php
}

function elaborado_por($idformato,$iddoc){
  global $conn;

  if($_REQUEST["tipo"]!=5){
  	$fun_cod=usuario_actual("funcionario_codigo");
  	$fun_login=usuario_actual("login");
  }
  $dato=busca_filtro_tabla("elaborado,nombres,apellidos,funcionario_codigo,".fecha_db_obtener("fecha_elaborado","Y-m-d H:i:s")." AS fecha_elaborado","ft_plan_mejoramiento,documento,funcionario","documento_iddocumento=$iddoc and  iddocumento=documento_iddocumento and funcionario_codigo=ejecutor","",$conn);
   
  $pos=strpos($dato[0][0],"_");
  if($pos)
    $dato[0][0]=substr($dato[0][0],0,$pos);
     
		
  if($dato[0][0]){
    $idformato_plan_mejoramiento=busca_filtro_tabla("idformato","nombre='plan_mejoramiento'","","",$conn);
    mostrar_valor_campo('elaborado',$idformato_plan_mejoramiento[0]['idformato'],$iddoc);   
    if($dato[0]["fecha_elaborado"] && $dato[0]["fecha_elaborado"]>'2010-01-01 00:00:00'){
      echo("(".$dato[0]["fecha_elaborado"].")");
    }
    elseif($dato[0][0]==$fun_cod || $fun_login=="cerok"){
  	  $datos=busca_filtro_tabla("","ft_plan_mejoramiento a, ft_hallazgo b, documento c","b.documento_iddocumento=c.iddocumento and c.estado not in('ELIMINADO', 'ANULADO', 'ACTIVO') and a.idft_plan_mejoramiento=b.ft_plan_mejoramiento and a.documento_iddocumento=".$iddoc,"",$conn);
	  	if($datos["numcampos"]){
				echo('<div id="estado_elaborado"  align="center"><a style="color:blue;cursor:pointer" onClick="actualizar_estado(1,\''.$iddoc.'\');">Confirmar</a></div>');
    	}else{
				echo ('<br><font style="color:red">No se ha realizado ningun hallazgo</font>');
		}
	}else{
	    echo('(Pendiente por confirmar)');
	}
  }else{
      $dato[0][0]=$dato[0]["funcionario_codigo"];
      echo ucwords($dato[0]["nombres"]." ".$dato[0]["apellidos"]);
  }
}
function revisado_por($idformato,$iddoc){
  global $conn;

  if($_REQUEST["tipo"]!=5){
  	$fun_cod=usuario_actual("funcionario_codigo");
  	$fun_login=usuario_actual("login");
  }
  $dato1=busca_filtro_tabla("revisado,fecha_elaborado,fecha_revisado","ft_plan_mejoramiento","documento_iddocumento=$iddoc","",$conn);

$dato=busca_filtro_tabla("revisado,".fecha_db_obtener("fecha_elaborado","Y-m-d H:i:s")." AS fecha_elaborado,".fecha_db_obtener("fecha_revisado","Y-m-d H:i:s")." AS fecha_revisado","ft_plan_mejoramiento","documento_iddocumento=$iddoc","",$conn);
 $pos=strpos($dato[0][0],"_");
  if($pos)
    $dato[0][0]=substr($dato[0][0],0,$pos);
  
if($dato[0][0]){
    $idformato_plan_mejoramiento=busca_filtro_tabla("idformato","nombre='plan_mejoramiento'","","",$conn);
    print_r($idformato_plan_mejoramiento);
  mostrar_valor_campo('revisado',$idformato_plan_mejoramiento[0]['idformato'],$iddoc);   
  if($dato[0]["fecha_elaborado"] && $dato[0]["fecha_elaborado"]>'2010-01-01 00:00:00' && $dato[0]["fecha_revisado"] && $dato[0]["fecha_revisado"]>'2010-01-01 00:00:00'){
    echo("(".$dato[0]["fecha_revisado"].")");
  }
  elseif(($dato[0]["fecha_elaborado"] && $dato[0]["fecha_elaborado"]>'2010-01-01 00:00:00') && ($dato[0][0]==$fun_cod || $fun_login=="cerok")){
	  echo('<div id="estado_revisado" align="center"><a style="color:blue;cursor:pointer" onClick="actualizar_estado(2,\''.$iddoc.'\');">Confirmar</a></div>');
  } 
  else{
    echo('(Pendiente por confirmar)');
  }
}
else{
  $ruta=busca_filtro_tabla("b.activo,c.nombres,c.apellidos,c.funcionario_codigo,b.fecha","ruta a,buzon_entrada b,funcionario c","ruta_idruta=idruta and a.origen=c.funcionario_codigo and a.tipo='ACTIVO' and b.nombre='POR_APROBAR' and a.obligatorio=2 and a.documento_iddocumento=$iddoc","",$conn);
  $revisados=array();
  if($ruta["numcampos"]){
    for($i=0;$i<$ruta["numcampos"];$i++){
      $cadena=ucwords($ruta[$i]["nombres"]." ".$ruta[$i]["apellidos"]);
      if($ruta[$i]["activo"]==1){
        $cadena.=" (Pendiente)";
      }else{
        $cadena.=" (".$ruta[$i]["fecha"].")";
      } 
      $revisados[]=$cadena;
    }
    echo implode("<br />",$revisados);
  }
}
}

function aprobado_por($idformato,$iddoc){
  global $conn;
  if($_REQUEST["tipo"]!=5){
  	$fun_cod=usuario_actual("funcionario_codigo");
  	$fun_login=usuario_actual("login");
  }
  $dato=busca_filtro_tabla("aprobado,revisado," .fecha_db_obtener("fecha_revisado","Y-m-d H:i:s")." AS fecha_revisado,".fecha_db_obtener("fecha_aprobado","Y-m-d H:i:s")." AS fecha_aprobado","ft_plan_mejoramiento","documento_iddocumento=$iddoc","",$conn);
		$pos=strpos($dato[0][0],"_");
		if($pos)
		$dato[0][0]=substr($dato[0][0],0,$pos);
		if($dato[0][0]){
		$idformato_plan_mejoramiento=busca_filtro_tabla("idformato","nombre='plan_mejoramiento'","","",$conn);   
		mostrar_valor_campo(
	'aprobado',$idformato_plan_mejoramiento[0]['idformato'],$iddoc);   
    if($dato[0]["fecha_revisado"] && $dato[0]["fecha_revisado"]>'2010-01-01 00:00:00' && $dato[0]["fecha_aprobado"] && $dato[0]["fecha_aprobado"]>'2010-01-01 00:00:00'){
      echo("(".$dato[0]["fecha_aprobado"].")");
    }
    elseif(($dato[0]["fecha_revisado"] && $dato[0]["fecha_revisado"]>'2010-01-01 00:00:00') && ($dato[0][0]==$fun_cod || $fun_login=="cerok")){
	  echo('<div id="estado_aprobado" align="center"><a style="color:blue;cursor:pointer" onClick="actualizar_estado(3,\''.$iddoc.'\');">Confirmar</a></div>');
    } 
    else{
      echo('(Pendiente por confirmar)');
    }
  }
  else{
    $ruta=busca_filtro_tabla("b.activo,c.nombres,c.apellidos","ruta a,buzon_entrada b,funcionario c","ruta_idruta=idruta and a.origen=c.funcionario_codigo and a.tipo='ACTIVO' and b.nombre='POR_APROBAR' and a.obligatorio=1 and a.documento_iddocumento=$iddoc","idruta desc",$conn);
    if($ruta["numcampos"]){
      $cadena=ucwords($ruta[0]["nombres"]." ".$ruta[0]["apellidos"]);
      if($ruta[0]["activo"]==1)
        $cadena.=" (Pendiente)";
      echo $cadena;
    }
  }
}


function mostrar_adjuntos($idformato,$iddoc){
	global $conn, $ruta_db_superior;
 	if(!isset($_REQUEST["tipo_impresion"])){
 		//mostrar_valor_campo('adjuntos',1,$iddoc);
 		//if(usuario_actual('login')=='cerok'){
		$campos=busca_filtro_tabla("idcampos_formato","campos_formato a","a.nombre='adjuntos' and formato_idformato=".$idformato,"",$conn);
 		$anexos=busca_filtro_tabla("","anexos a","a.documento_iddocumento=".$iddoc." and campos_formato='".$campos[0]["idcampos_formato"]."'","",$conn);
		$texto=array();
		for($i=0;$i<$anexos["numcampos"];$i++){
			$texto[]="<a href='".$ruta_db_superior."anexosdigitales/parsea_accion_archivo.php?idanexo=".$anexos[$i]["idanexos"]."&accion=descargar'>".ucfirst(strtolower($anexos[$i]["etiqueta"]))."</a>";
		}
		echo "<br>".implode("<br>",$texto);
 		//}
 	}
}
function relacionar_seguimiento_indicador($idformato,$iddoc){
  global $conn;
  if(isset($_REQUEST["seguimiento_indicador"])){
    $sql="insert into seguimiento_planes(idft_seguimiento_indicador,plan_mejoramiento) values('".$_REQUEST["seguimiento_indicador"]."','$iddoc')";
    phpmkr_query($sql,$conn);
    echo "<script>window.close();</script>";
  } 
}
function seguimiento_indicador($idformato,$iddoc){
  global $conn;
  if(isset($_REQUEST["seguimiento_indicador"]))
    echo "<input type='hidden' name='seguimiento_indicador' value='".$_REQUEST["seguimiento_indicador"]."'>";
}
function editar_plan($idformato,$iddoc){
  global $conn;

  if($_REQUEST["tipo"]!=5){
  	$fun_cod=usuario_actual("funcionario_codigo");
  	$fun_login=usuario_actual("login");
  }
  $formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
  $doc=busca_filtro_tabla("",$formato[0]["nombre_tabla"].",documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);

  if(($doc[0]["estado_plan_mejoramiento"]=='Pendiente por Aprobar'||$doc[0]["estado_plan_mejoramiento"]=='') && $doc[0]["ejecutor"]==$fun_cod&&!isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo"]!=5){
  ?>
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script>
    $().ready(function() {
   	$('#link_editar').click(function(){
       window.location="<?php echo $formato[0]['ruta_editar'].'?idformato='.$idformato.'&iddoc='.$iddoc; ?>";
     })
    });
    </script>
    <a href='#' id="link_editar"><span style='font-size:6pt'>Editar Plan</span></a>
  <?php
  } 
}

function estado_del_plan($idformato, $iddoc) {
	global $conn;
	if (@$_REQUEST["tipo"] != 5) {
		$fun_cod = usuario_actual('funcionario_codigo');
	}
	if (!isset($_REQUEST["exportar"]) && !isset($_REQUEST["tipo_impresion"])) {
		$estado = mostrar_valor_campo('estado_plan_mejoramiento', $idformato, $iddoc, 1);
		if ($estado == '') {
			$estado = 'Pendiente por Aprobar';
		}
		$cerrado = busca_filtro_tabla("estado_terminado, estado_plan_mejoramiento", "ft_plan_mejoramiento a", "a.documento_iddocumento=" . $iddoc, "", $conn);
		if ($cerrado[0]["estado_terminado"] == 1) {
			$estado = 'Terminado';
		}
		$seguimiento = busca_filtro_tabla("i.documento_iddocumento", "seguimiento_planes s,ft_seguimiento_indicador si,ft_indicadores_calidad i,ft_formula_indicador f", "plan_mejoramiento=$iddoc and s.idft_seguimiento_indicador=si.idft_seguimiento_indicador and idft_indicadores_calidad=ft_indicadores_calidad and ft_formula_indicador=idft_formula_indicador", "", $conn);
		$terminar_planes = busca_filtro_tabla("", "configuracion", "nombre='terminar_planes'", "", $conn);
		$permitidos = explode(",", $terminar_planes[0]["valor"]);

		echo '<table style="font-size:10pt;width:40%;border-collapse:collapse" border="0px">';
		if ($cerrado[0]["estado_plan_mejoramiento"] == 2 && in_array($fun_cod, $permitidos)) {
			$terminar_plan = "<tr><td><a style='cursor:pointer;color:blue' id='terminar_mejoramiento' onclick='aprobar_plan_mejora()'>Terminar plan de mejoramiento</a></td></tr>";
			if ($_REQUEST["tipo"] != 5) {
				echo "<script>
				function aprobar_plan_mejora(){
					var confirmacion=confirm('Seguro que desea terminar el plan de mejoramiento?');
					if(confirmacion){
						$.post('terminar_plan_mejoramiento.php',{iddoc:" . $iddoc . ", idformato:" . $idformato . "},function(){
							$('#mostrar_estado').html('Terminado');
						});
					}
				}
				</script>";
			}
			echo $terminar_plan;
		}
		echo '<tr> <td class="encabezado" style="width:20%">Estado del plan:</td><td id="mostrar_estado" style="width:20%">' . $estado . '</td><td>';
		editar_plan($idformato, $iddoc);
		if ($seguimiento["numcampos"]){
			echo "</td><td><a target='centro' href='../../ordenar.php?accion=mostrar&mostrar_formato=1&key=" . $seguimiento[0][0] . "'>Indicador que genera el Plan</a>";
		}
		echo "</td></tr></table>";
	}
}


function listar_hallazgo_plan_mejoramiento($idformato,$iddoc,$condicion=""){
  global $conn, $ruta_db_superior;
  $formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
  if($formato["numcampos"] ){
    $documento=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"",$conn);
  // print_r($documento);
  }
  //print_r($formato);
  if($condicion=="" && $documento[0]["idft_plan_mejoramiento"]){
    $condicion="a.ft_plan_mejoramiento=b.idft_plan_mejoramiento AND a.estado<>'INACTIVO' AND a.documento_iddocumento=iddocumento and c.estado<>'ELIMINADO' AND a.ft_plan_mejoramiento=".$documento[0]["idft_plan_mejoramiento"]." ";
  }
    
  if($condicion!=""){
    $formato_hallazgo=busca_filtro_tabla("","formato a","a.nombre LIKE '%hallazgo%plan%mejoramiento'","",$conn);
    $campos_formato_hallazgo=busca_filtro_tabla("nombre,idcampos_formato","campos_formato a","a.formato_idformato=".$formato_hallazgo[0]['idformato'],"",$conn);
    $vector_campos_id=array();
    for($i=0;$i<$campos_formato_hallazgo['numcampos'];$i++){
        $vector_campos_id[$campos_formato_hallazgo[$i]['nombre']]=$campos_formato_hallazgo[$i]['idcampos_formato'];
    }
    $hallazgos=busca_filtro_tabla("a.*,b.*,a.documento_iddocumento as hallazgo_iddoc","ft_hallazgo a, ft_plan_mejoramiento b,documento c","a.ft_plan_mejoramiento= b.idft_plan_mejoramiento and a.documento_iddocumento= c.iddocumento and a.estado<>'INACTIVO' and c.estado<>'ELIMINADO' AND ".$condicion,"idft_hallazgo asc",$conn);	
    //print_r($hallazgos);
  if($hallazgos["numcampos"]){
    $texto.="";
    $estado_actual="Todos";
    if(@$_REQUEST["estado"]){
      $estado_actual=$_REQUEST["estado"];
    }
    if(!isset($_REQUEST["tipo_impresion"])&& !$_REQUEST["papel"] && $_REQUEST["tipo"]!=5){
      $texto_enlaces.='<table border="1px" width="100%" style="border-collapse:collapse;font-size:6pt">
      <tr>
      <td colspan="2" align="center">Estado Actual('.ucfirst($estado_actual).')</td>
      <td align="center" valign="middle">Imprimir</td>
      </tr>
      <tr>
      <td align="center"><a href="'.genera_enlace_plan_mejoramiento().'&estado=pendientes">Hallazgos Pendientes</a></td>
      <td align="center" valign="middle"><a href="'.genera_enlace_plan_mejoramiento().'&estado=terminados" >Hallazgos Terminados</a></td>
      <td align="center" valign="middle"><a href="'.$ruta_db_superior.'class_impresion.php?iddoc='.$iddoc.'" target="_blank">Generar Plan de Mejoramiento (PDF)</a></td>
      <td align="center" valign="middle"><a href="archivo_plano_contraloria.php?iddoc='.$iddoc.'" target="_blank">Archivo Contralor&iacute;a</a></td>';
	  
      if(strpos($_SERVER["PHP_SELF"],"informe_contraloria")){
          
          $idformato_informe_contraloria=busca_filtro_tabla("idformato","formato","nombre='informe_contraloria'","",$conn);
        $texto_enlaces.='<td align="center"><a href="../../html2ps/public_html/demo/html2ps.php?plantilla=informe_contraloria&papel=Legal&orientacion=1&font_size=5&iddoc='.$_REQUEST["iddoc"].'&tipo_impresion=3&tipo=2&idformato='.$idformato_informe_contraloria[0]['idformato'].'" target="_blank">Seguimiento 23A</a></td>';
      }
      $texto_enlaces.='</tr></table>';
    }
    $texto.='
    <pagebreak/><table border="1px" style="border-collapse:collapse;font-size:6pt" width="100%">';
    $texto.='<tr class="encabezado_list">
<td rowspan="2" align="center">No<br />(A)</td>
<td colspan="4" align="center">ALCANCE</td>';
if(isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo_impresion"]==1)	
$texto.='<td rowspan="2">CAUSAS</td>';
$texto.='<td rowspan="2" align="center">ACCIONES DE MEJORAMIENTO<br />(E)</td>
<td rowspan="2" align="center">RESPONSABLE DE MEJORAMIENTO<br />(F)</td>
<td align="center">TIEMPO PROGRAMADO PARA EL CUMPLIMIENTO DE LAS ACCIONES DE MEJORAMIENTO</td>
<td colspan="2" align="center">MECANISMO DE SEGUIMIENTO INTERNO ADOPTADO<br />(H)</td>
<td rowspan="2" align="center">RESPONSABLE DEL SEGUIMIENTO<br />(I)
</td>
<td rowspan="2" align="center">INDICADOR DE ACCI&Oacute;N DE CUMPLIMIENTO<br />(J)</td>
<td rowspan="2" align="center">OBSERVACIONES<br />(K)</td>';
if(isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo_impresion"]==3)
  $texto.='<td rowspan="2">LOGROS ALCANZADOS</td>';
$texto.='</tr>
<tr class="encabezado_list">
<td align="center">DESCRIPCI&Oacute;N OBSERVACI&Oacute;N Y/O HALLAZGO<br />(C)</td>
<td>CAUSAS</td>
<td align="center">CLASE DE OBSERVACI&Oacute;N<br />(B)</td>
<td align="center">&Aacute;REAS,CICLOS O PROCESOS VINCULADOS<br />(D)</td>
<td align="center">TIEMPO PROGRAMADO<br />(G)</td>
<td align="center">ACTIVIDAD<br />(H<sub>1</sub>)</td>
<td align="center">TIEMPO<br />(H<sub>2</sub>)</td>
</tr>
';



$ingresa=0;
    for($i=0,$j=1;$i<$hallazgos["numcampos"];$i++){
      $seguimiento[$a]["total_porcentaje"]=0;
    if(isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo_impresion"]==3)
       $seguimiento=busca_filtro_tabla("A.*, A.porcentaje AS total_porcentaje","ft_seguimiento A","A.ft_hallazgo=".$hallazgos[$i]["idft_hallazgo"],"idft_seguimiento DESC",$conn);
    else
       {
        $porcentaje=busca_filtro_tabla("A.porcentaje","ft_seguimiento A","A.ft_hallazgo=".$hallazgos[$i]["idft_hallazgo"],"idft_seguimiento desc",$conn);
       $seguimiento=busca_filtro_tabla("'".$porcentaje[0]["porcentaje"]."' AS total_porcentaje","ft_seguimiento A","A.ft_hallazgo=".$hallazgos[$i]["idft_hallazgo"],"GROUP BY ft_hallazgo",$conn);
       }
       $a=0;       
      if((@$_REQUEST["estado"]=="pendientes" && $seguimiento[$a]["total_porcentaje"]<100) || (@$_REQUEST["estado"]=="terminados" && $seguimiento[$a]["total_porcentaje"]>=100) || (!@$_REQUEST["estado"])){
        $ingresa=1;
        if(!isset($_REQUEST["export"]))
           $texto.='<tr><td class="transparente" ><a href="../hallazgo/mostrar_hallazgo.php?iddoc='.$hallazgos[$i]["hallazgo_iddoc"].'&idformato='.$formato_hallazgo[0]["idformato"].'">&nbsp;'.$hallazgos[$i]["consecutivo_hallazgo"].'&nbsp;</a></td>'; 
        else
          $texto.='<tr><td class="transparente">'.$j.'</td>'; 
        $texto.='<td class="transparente" >'.mostrar_mensaje_accion($hallazgos[$i]["clase_accion"],$formato_hallazgo[0]["idformato"], $hallazgos[$i]["hallazgo_iddoc"]).'</td>';
        $texto.='<td class="transparente" >'.mostrar_valor_campo("causas",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1).'</td>'; 
        $texto.='<td class="transparente" >'.mostrar_valor_campo("clase_observacion",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1).'</td>'; 
		
						
        $texto.='<td class="transparente" ><b>Areas:</b> '.ucfirst(strtolower(strip_tags(mostrar_seleccionados($formato_hallazgo[0]["idformato"],$vector_campos_id['secretarias'],2,$hallazgos[$i]["hallazgo_iddoc"],1)))).'<br /><b>Procesos:</b> '.ucfirst(strtolower(strip_tags(procesos_vinculados_funcion2($formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"])))).'</td>';
        //condicion de encabezado 
if(isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo_impresion"]==1)
        {$texto.='<td class="transparente" >'.strip_tags(mostrar_valor_campo("causas",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1)).'</td>';
        }
        //fin condicion encabezado  
        $texto.='<td class="transparente" >'.strip_tags(str_replace("&nbsp;"," ",mostrar_valor_campo("accion_mejoramiento",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1))).'</td>'; 
        $texto.='<td class="transparente" >'.ucfirst(strtolower(mostrar_seleccionados($formato_hallazgo[0]["idformato"],$vector_campos_id['responsables'],0,$hallazgos[$i]["hallazgo_iddoc"],1))).'</td>'; 
        $texto.='<td class="transparente" align="center">'.mostrar_valor_campo("tiempo_cumplimiento",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1).'</td>'; 
        $texto.='<td class="transparente" >'.strip_tags(mostrar_valor_campo('mecanismo_interno',$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1)).'</td>'; 
        $texto.='<td class="transparente"  align="center">'.mostrar_valor_campo("tiempo_seguimiento",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1).'</td>'; 
        $texto.='<td class="transparente" >'.ucfirst(strtolower(mostrar_seleccionados($formato_hallazgo[0]["idformato"],$vector_campos_id['responsable_seguimiento'],0,$hallazgos[$i]["hallazgo_iddoc"],1))).'</td>'; 
        $texto.='<td class="transparente" >'.strip_tags(mostrar_valor_campo("indicador_cumplimiento",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1)).'</td>'; 
        $texto.='<td class="transparente" >'.strip_tags(mostrar_valor_campo("observaciones",$formato_hallazgo[0]["idformato"],$hallazgos[$i]["hallazgo_iddoc"],1)).'</td>';
        //condicion de encabezado
        if($seguimiento["numcampos"] && isset($_REQUEST["tipo_impresion"])&&$_REQUEST["tipo_impresion"]==3){
            $idformato_seguimiento=busca_filtro_tabla("idformato","formato"," nombre='seguimiento' ","",$conn);
           $texto.='<td class="transparente">'.mostrar_valor_campo('logros_alcanzados',$idformato_seguimiento[0]['idformato'],$seguimiento[$a]["documento_iddocumento"],1).'</td><td class="transparente" align="center" ><a href="../plan_mejoramiento/seguimiento_list.php?idhallazgo='.$hallazgos[$i]["idft_hallazgo"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: '."'".'iframe'."'".',width: 400, height:250 } )">'.$seguimiento[$a]["total_porcentaje"].'%</a></td>';
        }
        $texto.='</tr>';
        $j++;
      //}
     }
    }
    $texto.='</table>';
  }
}
if(!$ingresa)
  $texto.="<br /><br /><b>No se han definido hallazgos ".@$_REQUEST["estado"]." para el plan de mejoramiento mostrado</b>";
echo($texto_enlaces.$texto);
}
function genera_enlace_plan_mejoramiento(){
$parametros_ruta=array();
/*if($_REQUEST["estado"] && $enlace!="todos")
  array_push($parametros_ruta,"estado=".$_REQUEST["estado"]);*/
if($_REQUEST["tipo"])
  array_push($parametros_ruta,"tipo=".$_REQUEST["tipo"]);
if($_REQUEST["proceso"])
  array_push($parametros_ruta,"proceso=".$_REQUEST["proceso"]);
if($_REQUEST["usuario"])
  array_push($parametros_ruta,"usuario=".$_REQUEST["usuario"]);
if($_REQUEST["iddoc"])
  array_push($parametros_ruta,"iddoc=".$_REQUEST["iddoc"]);
if($_REQUEST["idformato"])
  array_push($parametros_ruta,"idformato=".$_REQUEST["idformato"]);
$ruta=$_SERVER["PHP_SELF"]."?".implode("&",$parametros_ruta);
return($ruta);
}

function mostrar_encabezado_plan($idformato,$iddoc)
{
}
function mostrar_pie_pagina_plan($idformato,$iddoc){
}
function ver_campo_estado($idformato,$iddoc){
  global $conn;
  if($_REQUEST["iddoc"]==""){
?>  
<script>
$(document).ready(function(){
  $('#descripcion_otros').parent().parent().hide();
  $('#estado_plan_mejoramiento1').parent().hide(); 
  $('#estado_plan_mejoramiento0').parent().hide(); 
  $("#auditor").change(function(){
  	if($(this).val()==8){
  		$('#descripcion_otros').parent().parent().show();
  	}
  	else{
  		$('#descripcion_otros').parent().parent().hide();
  	}
  });
});
</script>
<?php
} 
if($_REQUEST["tipo"]!=5){
	$fun_id=usuario_actual("id");
	$fun_cod=usuario_actual("funcionario_codigo");
	$fun_login=usuario_actual("login");
}
$dato=busca_filtro_tabla("destino","ruta","documento_iddocumento=$iddoc","",$conn);
for($i=0,$j=1;$i<$dato["numcampos"];$i++){
$idfuncionario=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo=".$dato[$i]["destino"],"",$conn);
  if(($fun_id<>$idfuncionario[0]["idfuncionario"])||($_REQUEST["iddoc"]!="") ){
   ?>
  <script>
    $('#estado_plan_mejoramiento1').parent().show(); 
    $('#estado_plan_mejoramiento0').parent().show(); 
  </script>
<?php
  }
  }
}
function mostrar_link_reporte($idformato,$iddoc){
	global $conn;
	$mostrar='';
	if($_REQUEST["tipo"]!=5){
		//$mostrar.='<a href="reporte_hallazgos_cumplimiento.php?iddoc='.$iddoc.'&idformato='.$idformato.'" style="font-size:6pt" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height: 400,preserveContent: false} )">VER REPORTE DE AVANCE PLAN DE MEJORAMIENTO</a>';
		$mostrar.='<a href="reporte_hallazgos_cumplimiento.php?iddoc='.$iddoc.'&idformato='.$idformato.'" style="font-size:6pt" onclick="" target="_self">VER REPORTE DE AVANCE PLAN DE MEJORAMIENTO</a>';
	}
	echo $mostrar;
}
function procesos_vinculados_funcion2($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("procesos_vinculados","ft_hallazgo a","a.documento_iddocumento=".$iddoc,"",$conn);
	$procesos=explode(",",$datos[0]["procesos_vinculados"]);
	$cant=count($procesos);
	$nombres=array();
	for($i=0;$i<$cant;$i++){
		if($procesos[$i]!=''){
			if($procesos[$i][0]!='m'){
				$proceso=busca_filtro_tabla("nombre","ft_proceso a","a.idft_proceso='".trim($procesos[$i])."'","",$conn);
				$nombres[]=$proceso[0]["nombre"];
			}
			else{
				$proceso=busca_filtro_tabla("nombre","ft_macroproceso_calidad a","a.idft_macroproceso_calidad='".str_replace("m","",trim($procesos[$i]))."'","",$conn);
				$nombres[]=$proceso[0]["nombre"];
			}
		}
	}
	//$nombres=extrae_campo($proceso,"nombre");
	return implode(", ",$nombres);
	//return "";
}
function obtener_fecha_actual($idformato,$iddoc){
	
}
function mostrar_mensaje_accion($clase_accion,$idformato,$hallazgo_iddoc){
	global $conn;
	
	if($clase_accion == 3){		
		$mensaje = "No Aplica porque es una acción de mejora";
			
	}else{
		$mensaje= strip_tags(mostrar_valor_campo("deficiencia",$idformato,$hallazgo_iddoc,1));
	}	
	return($mensaje);	
}

?>