<?php
include_once("db.php");

function ver_caja_almacenamiento($idfolder){
	global $conn, $ruta_db_superior;
	$caja=busca_filtro_tabla("","folder a","a.idfolder=".$idfolder,"",$conn);
	return '<td style="text-align:center"><a href="'.$ruta_db_superior.'pantallas/almacenamiento/almacenamiento.php?idcaja='.$caja[0]["caja_idcaja"].'">Ver caja</a></td>';
}

function rotulo_carpeta_almacenamiento($idfolder){
	global $conn, $ruta_db_superior;
	return '<td style="text-align:center"><a href="'.$ruta_db_superior.'pantallas/almacenamiento/rotulo.php?idcarpeta='.$idfolder.'&no_redireccionar=1" target="_blank">Rotulo</a></td>';
}

function ver_carpeta_almacenamiento($idfolder){
	global $conn, $ruta_db_superior;
	$caja=busca_filtro_tabla("","folder a","a.idfolder=".$idfolder,"",$conn);
	return '<td style="text-align:center"><a href="'.$ruta_db_superior.'pantallas/almacenamiento/almacenamiento.php?idcaja='.$caja[0]["caja_idcaja"].'&idcarpeta='.$idfolder.'">Ver carpeta</a></td>';
}

function nombre_serie_almacenamiento($idfolder){
	global $conn;
	$serie=busca_filtro_tabla("","folder a, serie b","a.serie_idserie=b.idserie and a.idfolder=".$idfolder,"",$conn);
	return '<td>'.ucfirst(strtolower($serie[0]["nombre"])).'</td>';
}

function unidad_administrativa_almacenamiento($idfolder){
	global $conn;
	$dependencia=busca_filtro_tabla("","folder a, dependencia b","a.unidad_admin=b.iddependencia and a.idfolder=".$idfolder,"",$conn);
	return '<td>'.ucfirst(strtolower($dependencia[0]["nombre"])).'</td>';
}

function identifica_ejecutor($iddoc){
	global $conn;

	$datos=busca_filtro_tabla("C.identificacion","ft_radicacion_entrada A, datos_ejecutor B, ejecutor C","A.persona_natural=B.iddatos_ejecutor AND C.idejecutor=B.ejecutor_idejecutor AND A.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$datos[0]['identificacion']."</td>");
}

function nombre_empresa_ejec($iddoc){
	global $conn;

	$datos=busca_filtro_tabla("B.empresa","ft_radicacion_entrada A, datos_ejecutor B","A.persona_natural=B.iddatos_ejecutor AND A.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$datos[0]['empresa']."</td>");
}

function cargo_persona_elaboro($iddoc){
	global $conn;

	$datos=busca_filtro_tabla("E.nombre","ft_radicacion_entrada A, documento B, funcionario C, dependencia_cargo D, cargo E","A.documento_iddocumento=B.iddocumento AND B.ejecutor=C.funcionario_codigo AND C.idfuncionario=D.funcionario_idfuncionario AND D.cargo=E.idcargo AND B.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$datos[0]['nombre']."</td>");
}
//******************

function identificacion_ejecutor($iddoc){
	global $conn;

	$identificacion=busca_filtro_tabla("e.identificacion","ft_radicacion_entrada a, datos_ejecutor de, ejecutor e","a.persona_natural=de.iddatos_ejecutor and e.idejecutor=de.ejecutor_idejecutor and a.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$identificacion[0]["identificacion"]."</td>");
}
function empresa_ejecutor($iddoc){
	global $conn;

	$empresa=busca_filtro_tabla("de.empresa","ft_radicacion_entrada a, datos_ejecutor de","a.persona_natural=de.iddatos_ejecutor and a.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$empresa[0]["empresa"]."</td>");
}
function cargo_creador_documento($iddoc){
	global $conn;

	$cargo=busca_filtro_tabla("c.nombre","documento d, ft_radicacion_entrada a, cargo c, funcionario f, dependencia_cargo dc","d.ejecutor=f.funcionario_codigo AND f.idfuncionario=dc.funcionario_idfuncionario AND c.idcargo=dc.cargo_idcargo AND d.iddocumento=a.documento_iddocumento AND a.documento_iddocumento=".$iddoc,"",$conn);

	return("<td>".$cargo[0]["nombre"]."</td>");
}

function prueba_funcion($iddoc){
	global $conn;
	echo "<td>Prueba</td>";
}

function transferencia_masiva_checkbox($iddoc)
{echo "<td align='center'><input type='checkbox' value='$iddoc' name='transferir' ></td>";
}

function solicitud_gasto($iddoc)
{global $conn;
 $accion=busca_filtro_tabla("s.documento_iddocumento doc1,r.documento_iddocumento doc2,d.estado,r.fecha_reembolso,r.fecha_aprobacion,usuario_aprobacion","ft_recibo_caja_menor r,ft_solicitud_gastos_caja_menor s,documento d","s.documento_iddocumento=d.iddocumento and ft_solicitud_gastos_caja_menor=idft_solicitud_gastos_caja_menor and r.documento_iddocumento=$iddoc","",$conn);

 $permiso=new PERMISO();
 $ok=$permiso->acceso_modulo_perfil("aprobar_solicitud_gastos");
 echo '<td align="center">';
 if(!@$_REQUEST["export"])
 	echo '<a class="highslide" href="../' . FORMATOS_CLIENTE . 'solicitud_gastos_caja_menor/mostrar_solicitud_gastos_caja_menor.php?iddoc='.$accion[0][0].'&idformato=176" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height:250,preserveContent:false } )" ><img src="../botones/general/ver.png" style="border:0px" /></a>';

 if($accion[0]["fecha_aprobacion"]<>"")
  echo "<br />Aprobado<br />".$accion[0]["fecha_aprobacion"]."<br />".$accion[0]["usuario_aprobacion"];
 elseif($accion[0]["estado"]=="ACTIVO")
  echo "<br />Documento Activado";

 elseif($ok && $accion[0]["fecha_reembolso"]<>"" && $accion[0]["fecha_aprobacion"]=="" && !$_REQUEST["export"]){
 	echo ' <a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height:250,preserveContent:false } )" href="../' . FORMATOS_CLIENTE . 'solicitud_gastos_caja_menor/aprobar_rechazar_solicitud.php?accion_solicitud=rechazar&iddoc='.$accion[0]["doc1"].'&tipo='.$_REQUEST["tipo"].'"><img src="../botones/general/menos.png" style="border:0px"/></a><!--a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 700, height:250,preserveContent:false } )" href="../' . FORMATOS_CLIENTE . 'solicitud_gastos_caja_menor/aprobar_rechazar_solicitud.php?accion_solicitud=aprobar&iddoc='.$accion[0]["doc2"].'"><img src="../botones/general/mas.png" /></a--><input type="checkbox" value="'.$iddoc.'" name="aprobar_'.$iddoc.'" >
  <input type="hidden" name="tipo" value="'.$_REQUEST["tipo"].'">
  ';
 }
 echo '</td>';
}
function dependencia_permisos($iddoc){
	global $conn,$ruta_db_superior;
	$dato = busca_filtro_tabla("idfuncionario","ft_reporte_permisos a,documento b,funcionario c","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc." and ejecutor=funcionario_codigo","",$conn);
	$rol = busca_filtro_tabla("","dependencia_cargo a,dependencia b","funcionario_idfuncionario=".$dato[0]["idfuncionario"]." and a.estado=1 and dependencia_iddependencia=iddependencia","",$conn);
	return '<td>'.$rol[0]["nombre"].'</td>';
}
function horas_permiso($iddoc){
	global $conn,$ruta_db_superior;
	$dato = busca_filtro_tabla(resta_horas('hora_entrada','hora_salida')." as horas","ft_reporte_permisos a","documento_iddocumento=".$iddoc,"",$conn);
	return '<td>'.$dato[0]["horas"].'</td>';
}
function tipo_permiso($iddoc){
	global $conn,$ruta_db_superior;
	$formato = busca_filtro_tabla("","formato","nombre like '%reporte_permisos%'","",$conn);
	include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
	$valor = mostrar_valor_campo('motivo_permiso',$formato[0]["idformato"],$iddoc,1);
	return '<td>'.$valor.'</td>';
}
function dias_vacaciones($idformato,$iddoc)
{global $conn;

  $consulta=busca_filtro_tabla("","ft_proceso_vacaciones a, documento b","b.iddocumento=a.documento_iddocumento and a.documento_iddocumento=".$iddoc,"",$conn);
  $dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($consulta[0]["dia_terminacion"],'Y-m-d'),fecha_db_almacenar($consulta[0]["dia_salida"]),'Y-m-d')."as dias");
  $consul=busca_filtro_tabla("count(*)","asignacion","fecha_inicial>='".$consulta[0]["dia_salida"]."' and fecha_inicial<='".$consulta[0]["dia_terminacion"]."' and documento_iddocumento=-1","",$conn);
  $resta=$dia[0]["dias"]-$consul[0][0];
  return($resta);
}
function dias_disfrutados($iddoc){
	global $conn,$ruta_db_superior;
	$formato = busca_filtro_tabla("","formato","nombre like '%proceso_vacaciones%'","",$conn);
	return '<td>'.dias_vacaciones($formato[0]["idformato"],$iddoc).'</td>';

}
function causacion_button()
{global $conn;
 $pos=strpos($_SESSION["sql"],"FROM documento A");
 $valor=ejecuta_filtro_tabla("SELECT sum(B.valor_total) ".stripslashes(substr($_SESSION["sql"],$pos)),$conn);
 $permiso=new PERMISO();
 $ok1=$permiso->acceso_modulo_perfil("registrar_remision_recibos");
 $ok2=$permiso->acceso_modulo_perfil("registrar_causacion");
 $ok3=$permiso->acceso_modulo_perfil("registrar_reembolso_recibos");
 $ok4=$permiso->acceso_modulo_perfil("registrar_aprobacion");

 $texto= "<table width='100%'><tr><td class='encabezado_list' colspan='4'><b>VALOR TOTAL: $".number_format($valor[0][0],0,'','.')."</b></td></tr>";
 if(@$_REQUEST["export"]=="")
 $texto.="<tr>";
 if($ok1)
 $texto.="<td align='center'><a href='JavaScript:seleccionar_todos(\"remision\",1)'>Todos</a>&nbsp;&nbsp;<a href='JavaScript:seleccionar_todos(\"remision\",0)'>Ninguno</a></td>";
 if($ok2)
 $texto.="<td align='center'><a href='JavaScript:seleccionar_todos(\"causacion\",1)'>Todos</a>&nbsp;&nbsp;<a href='JavaScript:seleccionar_todos(\"causacion\",0)'>Ninguno</a></td>";
 if($ok3)
 $texto.="<td align='center'><a href='JavaScript:seleccionar_todos(\"reembolso\",1)'>Todos</a>&nbsp;&nbsp;<a href='JavaScript:seleccionar_todos(\"reembolso\",0)'>Ninguno</a></td>";
 if($ok4)
 $texto.="<td align='center'><a href='JavaScript:seleccionar_todos(\"aprobar\",1)'>Todos</a>&nbsp;&nbsp;<a href='JavaScript:seleccionar_todos(\"aprobar\",0)'>Ninguno</a></td>";
 $texto .= '</tr>';
 $texto.="<tr><input type='hidden' name='docs' id='docs' value=''><input type='hidden' name='accion' id='accion' value=''><input type='hidden' name='descripcion_reembolso' id='descripcion_reembolso'>
 ";
 if($ok1)
 $texto.="<td align='center'><input type='button' value='Registrar Remisi&oacute;n' onclick='registrar_causacion(\"remision\");'></td>";
 if($ok2)
 $texto.="<td align='center'><input type='button' value='Registrar Causaci&oacute;n' onclick='registrar_causacion(\"causacion\");'></td>";
 if($ok3)
 $texto.="<td align='center'><input type='button' value='Registrar Reembolso' onclick='registrar_causacion(\"reembolso\");'></td>";
 if($ok4)
 $texto.="<td align='center'><input type='button' value='Aprobar' onclick='registrar_aprobacion(\"aprobar\");'></td>";
 $texto.="</tr></table>";
 return($texto);
}



function registrar_causacion($iddoc)
{global $conn;
 $permiso=new PERMISO();
 $ok=$permiso->acceso_modulo_perfil("registrar_causacion");
 echo "<td align='center'>";
 if(!$_REQUEST["export"]){
 $accion=busca_filtro_tabla("fecha_causacion,usuario_causante,usuario_remision","ft_recibo_caja_menor r","r.documento_iddocumento=$iddoc","",$conn);

 if($accion[0]["usuario_remision"]=="")
    echo "Falta remisi&oacute;n.";
 elseif($accion[0]["usuario_causante"]=="")
    {if($ok)
      echo "<input type='hidden' name='tipo' value='".$_REQUEST["tipo"]."'>
          <input type='checkbox' name='causacion_$iddoc' value='$iddoc'>";
    }
 else
    echo $accion[0]["fecha_causacion"]."<br />(".$accion[0]["usuario_causante"].")";
 }
 echo "</td>";
}

function registrar_remision($iddoc)
{global $conn;
 echo "<td align='center'>";
 if(!$_REQUEST["export"]){
 $accion=busca_filtro_tabla("fecha_remision,usuario_remision","ft_recibo_caja_menor r","r.documento_iddocumento=$iddoc","",$conn);
 $permiso=new PERMISO();
 $ok=$permiso->acceso_modulo_perfil("registrar_remision_recibos");

 if($accion[0][1]=="")
    {if($ok)
     echo "<input type='hidden' name='tipo' value='".$_REQUEST["tipo"]."'>
          <input type='checkbox' name='remision_$iddoc' value='$iddoc'>";
    }
 else
    echo $accion[0]["fecha_remision"]."<br />(".$accion[0]["usuario_remision"].")";
 }
 echo "</td>";
}

function registrar_reembolso($iddoc)
{global $conn;
 $permiso=new PERMISO();
 $ok=$permiso->acceso_modulo_perfil("registrar_reembolso_recibos");
 echo "<td align='center'>";
 if(!$_REQUEST["export"]){
 $accion=busca_filtro_tabla("fecha_causacion,usuario_reembolso,fecha_reembolso","ft_recibo_caja_menor r,ft_solicitud_gastos_caja_menor","idft_solicitud_gastos_caja_menor=ft_solicitud_gastos_caja_menor and r.documento_iddocumento=$iddoc","",$conn);
 if($accion[0]["fecha_causacion"]==0)
    echo "Falta causaci&oacute;n";
 elseif($accion[0]["usuario_reembolso"]=="")
    {if($ok)
      echo "<input type='hidden' name='tipo' value='".$_REQUEST["tipo"]."'>
          <input type='checkbox' name='reembolso_$iddoc' value='$iddoc'>";
    }
 else
    echo $accion[0][2]."<br />(".$accion[0][1].")";
 }
 echo "</td>";
}
function calculo_prg($iddoc)
{global $conn;
 $accion=busca_filtro_tabla("codigo,cod_padre","ft_resumen_presupuestal rp,ft_solicitud_gastos_caja_menor s,ft_recibo_caja_menor r","r.documento_iddocumento=$iddoc and ft_solicitud_gastos_caja_menor=idft_solicitud_gastos_caja_menor and idaccion=idft_resumen_presupuestal","",$conn);
 $proyecto=busca_filtro_tabla("codigo,cod_padre","ft_resumen_presupuestal","idft_resumen_presupuestal=".$accion[0][1],"",$conn);
 $linea=busca_filtro_tabla("codigo","ft_resumen_presupuestal","idft_resumen_presupuestal=".$proyecto[0][1],"",$conn);
 $numero=explode(".",$accion[0][0]);
 echo "<td>".$linea[0][0].$proyecto[0][0].$numero[1]."</td>";
}
function transferencia_masiva_boton($iddoc)
{
	$html = "<table style='width:100%'>
 <td align='center' bgcolor='white' >
 <input type='button' onclick=\"revisar_checkbox()\" value='Transferir' >
 </td>
	</table>
 <script>
 function revisar_checkbox()
   {elementos=document.getElementsByName('transferir');
    seleccionados=new Array();
    j=0;
    for(i=0;i<elementos.length;i=i+1)
      {if(elementos[i].checked)
          {seleccionados[j]=elementos[i].value;
           j++;
          }
      }
      alert(seleccionados.join(','));
    window.location='../transferenciaadd_plantillas.php?docs='+seleccionados.join(',')+','+'&retorno=pendienteslist.php';
   }
 </script>";
 echo $html;
}
function mostrar_flujo_doc($idpaso_documento){
    $dato = "<td width='70px'><a href='../workflow/mapeo_diagrama.php?idpaso_documento=".$idpaso_documento."' target='centro'><img src='../botones/workflow/verificar_flujo.png' style='border:0px'></a>&nbsp;&nbsp;&nbsp;Flujo<br />";
    $dato .= "<a href='../workflow/resumen_flujo.php?idpaso_documento=".$idpaso_documento."' class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 700, height:250,preserveContent:false } )\"><img src='../botones/comentarios/ver_documentos.png' style='border:0px'></a>&nbsp;&nbsp;&nbsp;Ver Doc</td>";
	return $dato;
}
function mostrar_flujo_paso($idpaso_documento){
global $ruta_db_superior;
include_once($ruta_db_superior."workflow/libreria_paso.php");
  $flujo=estado_flujo_instancia($idpaso_documento);
  $porcentaje=$flujo["porcentaje"];
  $fecha_final_diagram=$flujo["fecha_final_diagrama"];
  $fecha_inicio = busca_filtro_tabla(fecha_db_obtener('b.fecha','Y-m-d H:i:s')." as fecha_inicio","paso_documento a, diagram_instance b","idpaso_documento=".$idpaso_documento." and diagram_iddiagram_instance=iddiagram_instance","",$conn);
  $dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_final_diagram,'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $dias = $dia[0]["dias"];
   if($flujo["devueltos"]){
     $flujo[0]["estado_diagram_instance"]=7;
   }
   	if($dias < 0){
   		$color = '#FF3333';
   	}
	else if($dias >= 0 && $dias <=1){
		$color = '#FFFF66';
	}
	else if($dias > 1){
		$color = '#99FF66';
	}

  $texto='<div class="texto_paso">Paso Actual: '.$flujo[0]["nombre_paso"]."<br />".$estadod." <br />Inicio: ".$fecha_inicio[0]["fecha_inicio"]."
  </br>Terminados: (".(($flujo["numcampos"]))."/".$flujo["pasos_flujo"]."):".$porcentaje."%<br />
  Fecha limite: ".$fecha_final_diagram."<br />
  Estado: Vence en ".$dias." dia(s)<br />
  Prioridad: Normal</div>";

    echo "<td class='paso".$flujo[0]["estado_diagram_instance"]."' style='background:".$color."'>".$texto."</td>";
}
function mostrar_flujo_tarea($idpaso_documento){
	global $ruta_db_superior,$conn;
	include_once($ruta_db_superior."workflow/libreria_paso.php");
	$flujo=estado_flujo_instancia($idpaso_documento);

	$pasoo = busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"]." and paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_documento desc",$conn);

	$restringido = false;

	$terminados = 0;
	$actividades = busca_filtro_tabla("","paso_actividad","paso_idpaso=".$pasoo[0]["paso_idpaso"],"",$conn);
	for($i=0;$i<$actividades["numcampos"];$i++){
		$terminada = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividades[$i]["idpaso_actividad"]." and documento_iddocumento=".$pasoo[0]["documento_iddocumento"],"",$conn);
		if($terminada["numcampos"] > 0){
			$terminados++;
		}
	}
	$porcentaje = round((($terminados*100)/$actividades["numcampos"]),2);
	$pocentaje_tarea = '('.$terminados.'/'.$actividades["numcampos"].'):'.$porcentaje.'%';


	$paso = busca_filtro_tabla("","paso_actividad","idpaso_actividad=".$idactividad,"",$conn);
	$tareas = busca_filtro_tabla("","paso_actividad","paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_actividad asc",$conn);
	for($i=0;$i<$tareas["numcampos"];$i++){
		$tarea .= ($i+1).". ".$tareas[$i]["descripcion"]."<br>";
	}
	$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($flujo["fecha_final_paso"],'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $dias = $dia[0]["dias"];

   	if($dias < 0){
   		$color = '#FF3333';
   	}
	else if($dias >= 0 && $dias <=1){
		$color = '#FFFF66';
	}
	else if($dias > 1){
		$color = '#99FF66';
	}
	//print_r($d);
	$fecha_inicio=date_parse($pasoo[0]["fecha_asignacion"]);
  	$anioinicial=$fecha_inicio["year"];
   	$mesinicial=$fecha_inicio["month"];
   	$diainicial=$fecha_inicio["day"];
	if($mesinicial < 10)
		$mesinicial = '0'.$mesinicial;
	if($diainicial < 10)
		$diainicial = '0'.$diainicial;
	$pasoo[0]["fecha_asignacion"] = $anioinicial.'-'.$mesinicial.'-'.$diainicial;
	$texto = '';
	$texto .= '
	Inicio: '.$pasoo[0]["fecha_asignacion"].'<br />
	Terminados: '.$pocentaje_tarea.'<br />
	Fecha l&iacute;mite: '.$flujo["fecha_final_paso"].'<br />
	Tareas: <br />'.$tarea;
	echo '<td width="140px" style="background:'.$color.'">'.$texto.'</td>';
}
function enviadopor_flujo($idpaso_documento){
	global $ruta_db_superior,$conn;
	include_once($ruta_db_superior."workflow/libreria_paso.php");
	$flujo=estado_flujo_instancia($idpaso_documento);

	$pasoo = busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"]." and paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_documento desc",$conn);
	//print_r($pasoo);
	$destino = busca_filtro_tabla("","buzon_entrada,funcionario","archivo_idarchivo=".$pasoo[0]["documento_iddocumento"]." and nombre='TRANSFERIDO' and destino=funcionario_codigo","",$conn);
	//print_r($destino);
	echo '<td width="80px"><center>'.$destino[0]["nombres"].' '.$destino[0]["apellidos"].'</center></td>';
}
function nombre_formato($iddoc)
{global $conn;
 $datos=busca_filtro_tabla("etiqueta","documento,formato","iddocumento=$iddoc and plantilla=nombre","",$conn);
 echo "<td>";
 if($datos["numcampos"])
    echo ucwords(strtolower($datos[0]["etiqueta"]));
 echo "</td>";
}
function mostrar_plan_mejoramiento($iddoc)
{global $conn;
 $plan=busca_filtro_tabla("a.documento_iddocumento","ft_plan_mejoramiento a,ft_hallazgo b","idft_plan_mejoramiento=ft_plan_mejoramiento and b.documento_iddocumento=$iddoc","",$conn);
 if($plan["numcampos"])
   return("<td align='center'><a href='../ordenar.php?mostrar_formato=1&key=".$plan[0][0]."'>DETALLES PLAN</a></td>");
 else
   return("<td align='center'>PLAN NO ENCONTRADO</td>");
}
function mostrar_estructura($key)
{
 global $conn;
 $datos = busca_filtro_tabla("documento_iddocumento","ft_estructura_hoja_vida","idft_estructura_hoja_vida=".$key,"",$conn);
 //echo "<td><a href='../formatos/estructura_hoja_vida/mostrar_estructura_hoja_vida.php?idformato=73&iddoc=".$datos[0]["documento_iddocumento"]."'>Detalles</a></td>";
 echo "<td><a href='../ordenar.php?accion=mostrar&mostrar_formato=1&key=".$datos[0]["documento_iddocumento"]."'>Detalles</a></td>";

}
/*
function mostrar_formato($key)
{
 global $conn;
 $datos = busca_filtro_tabla("documento_iddocumento","ft_hoja_vida","idft_hoja_vida=".$key,"",$conn);
 //echo "<td><a href='../formatos/hoja_vida/mostrar_hoja_vida.php?idformato=71&iddoc=".$datos[0]["documento_iddocumento"]."'>Detalles</a></td>";
 echo "<td><a href='../ordenar.php?accion=mostrar&mostrar_formato=1&key=".$datos[0]["documento_iddocumento"]."'>Detalles</a></td>";
}
*/
function dependencia($iddoc)
{global $conn;
 $doc=busca_filtro_tabla("plantilla,responsable","documento","iddocumento=$iddoc","",$conn);
 if($doc[0]["responsable"]<>"")
   {$dep=busca_filtro_tabla("nombre","dependencia","iddependencia=".$doc[0]["responsable"],"",$conn);
    if(!$dep["numcampos"])
      {$dep=busca_filtro_tabla("nombre","dependencia,funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and dependencia_iddependencia=iddependencia and idfuncionario=".$doc[0]["responsable"],"",$conn);
      }
   }
 if($doc[0]["plantilla"]<>"")
   {$dep=busca_filtro_tabla("dependencia.nombre","ft_".strtolower($doc[0]["plantilla"]).",dependencia,dependencia_cargo","dependencia_iddependencia=iddependencia and dependencia=iddependencia_cargo and documento_iddocumento=$iddoc","",$conn);
   }
   //print_r($dep);
  if(isset($dep[0]["nombre"]))
    return("<td>".$dep[0]["nombre"]."</td>");
 else
    return("<td></td>");
}

function serie($iddoc)
{global $conn;
 $nombre=busca_filtro_tabla("serie","documento","iddocumento=$iddoc","",$conn);

 if($nombre[0]["serie"]<>0)
    {$serie=busca_filtro_tabla("nombre","serie","idserie=".$nombre[0]["serie"],"",$conn);
     return("<td>".ucwords(strtolower($serie[0]["nombre"]))."</td>");
    }
 else
   return("<td>&nbsp;</td>");
}

function cargo_padre($id)
{
 global $conn;
 $padre = busca_filtro_tabla("cod_padre","cargo","idcargo=$id","",$conn);
 if($padre["numcampos"])
  $nombre = busca_filtro_tabla("nombre","cargo","idcago=".$padre[0]["cod_padre"],"",$conn);
 return("<td>".$nombre[0]["nombre"]."</td>");
}
function asignacion_solicitud($iddoc)
{global $conn;
 $usu_mantenimiento=busca_filtro_tabla("funcionario_codigo","funcionario","nombres LIKE '%antenimiento%'","",$conn);
 for($i=0;$i<$usu_mantenimiento["numcampos"];$i++)
 {$mantenimiento[]=$usu_mantenimiento[$i][0];
 }
 $mantenimiento=implode(',',$mantenimiento);
 $asignacion=busca_filtro_tabla("DISTINCT nombres,apellidos","ft_solicitud_mantenimiento,buzon_salida,funcionario","funcionario_codigo=destino and archivo_idarchivo=documento_iddocumento and archivo_idarchivo=$iddoc and ((nombre='TRANSFERIDO' and origen in(".$mantenimiento.")) or nombre='RESPONDIDO')","",$conn);
 if(!$asignacion["numcampos"])
   return("<td align='center'>NO</td>");
 else
   {$asignados=array();
    for($i=0;$i<$asignacion["numcampos"];$i++)
      $asignados[]=ucwords($asignacion[$i]["nombres"]." ".$asignacion[$i]["apellidos"]);
    return("<td ><ul><li>".implode("</li><li>",$asignados)."</li></ul></td>");
   }
}

function transferir($iddoc)
{global $conn;
 return("<td><a href='../transferenciaadd.php?doc=$iddoc'>Transferir</td>");
}
function remitente($iddoc)
{ global $conn;
  $nombre=busca_filtro_tabla("ejecutor,plantilla,tipo_radicado,responsable","documento","iddocumento=$iddoc","",$conn);
//si es una radicacion de entrada o de salida

 if($nombre[0]["tipo_radicado"]==1 || ($nombre[0]["tipo_radicado"]==2 && $nombre[0]["plantilla"]==""))
    {
     $funcionario=busca_filtro_tabla("nombre","ejecutor,datos_ejecutor","idejecutor=ejecutor_idejecutor and iddatos_ejecutor=".$nombre[0]["ejecutor"],"",$conn);
     return("<td>".ucwords(strtolower($funcionario[0]["nombre"]))."</td>");
    }
 else
    {$transferencia=busca_filtro_tabla("origen,nombre","buzon_salida","destino='".usuario_actual("funcionario_codigo")."' and archivo_idarchivo='$iddoc' and nombre not in('BLOQUEADO','LEIDO','POR_APROBAR','TERMINADO','ANULADO','RESPONDIDO','TRAMITE','GESTION','CENTRAL','HISTORICO')","idtransferencia desc",$conn);
     // print_r($transferencia);
     $funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$transferencia[0]["origen"]."","",$conn);
     return("<td>".ucwords($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"])."</td>");
    }
}

function fecha_respuesta($iddoc)
{global $conn;
 include_once("../calendario/calendario.php");
 include_once("phpmkrfn.php");
  $dias1=busca_filtro_tabla("iddocumento,".fecha_db_obtener("fecha",'Y-m-d')." as fecha,numero,".case_fecha('dias',"''",'dias_entrega','dias')." as dias_r,documento.estado","documento left join serie on serie=idserie","iddocumento=$iddoc","",$conn);

  $estado = "";
  if($dias1[0]["estado"]=='APROBADO')
   $estado=$dias1[0]["estado"];
  if($dias1[0]["dias_r"]<>"")
      {
       $fecha_f=dias_habiles($dias1[0]["dias_r"]+1,'Y-m-d',$dias1[0]["fecha"]);
       //echo resta_fechas(fecha_db_almacenar($fecha_f,'Y-m-d'),"");
       $dias2=busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_f,'Y-m-d'),"")." as respuesta","dual","","",$conn);

      }

 $aprobado=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_aprobado'","",$conn);
 $pendiente=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_pendiente'","",$conn);
 $atrasado=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_atrasado'","",$conn);
 $retraso=busca_filtro_tabla("A.valor","configuracion A","A.nombre='dias_retraso'","",$conn);

 if(isset($dias2) && $dias2["numcampos"])
    {
     $cadena="<td align='center' ";
     $retraso=busca_filtro_tabla("A.valor","configuracion A","A.nombre='dias_retraso'","",$conn);

    if($dias2["numcampos"])
       {$dias=intval(ceil($dias2[0]["respuesta"]));
        if($dias<0)
        {
          $cadena.="bgcolor=\"".$atrasado[0]["valor"]."\">"."<FONT SIZE=1>".$fecha_f."</FONT><br>".($dias)." Dias Calendario";
          $texto ="(Atrasado)";
        }
        else if($dias>$retraso[0]["valor"])
        {   $cadena.="bgcolor=\"".$aprobado[0]["valor"]."\">"."<FONT SIZE=1>".$fecha_f."</FONT><br>".$dias." Dias  Calendario";
           $texto ="(Normal)";
        }
        else if($dias<=$retraso[0]["valor"] && $dias>=0)
        {
           $cadena.="bgcolor=\"".$pendiente[0]["valor"]."\">"."<FONT SIZE=1>".$fecha_f."</FONT><br>".$dias." Dias Calendario";
           $texto ="(Urgente)";
        }
       }
   else
      $cadena.="bgcolor=\"".$pendiente[0]["valor"]."\">No asignado (Urgente)";
   if($estado=="")
     $cadena.=$texto;
    else
     $cadena.="($estado)";
   $cadena.="</td>";
     //$cadena.=$dias1[0]["dias_r"]."</td>";
     return($cadena);
    }
 else
    {return("<td align='center' bgcolor='".$pendiente[0]["valor"]."'>No Asignado (Urgente)</td>");
    }
}
function detalles_recibo_caja($iddoc){
	global $conn,$ruta_db_superior;
	$doc = busca_filtro_tabla("a.documento_iddocumento as doc","ft_solicitud_gastos_caja_menor a,ft_recibo_caja_menor b","b.documento_iddocumento=".$iddoc." and ft_solicitud_gastos_caja_menor=idft_solicitud_gastos_caja_menor","",$conn);
	return ('<td><a href="'.$ruta_db_superior.'ordenar.php?mostrar_formato=1&key='.$doc[0]["doc"].'">DETALLES</a></td>');
}
function terminar($iddoc)
{global $conn;
 $estado=busca_filtro_tabla("estado,plantilla,numero","documento","iddocumento=".$iddoc,"",$conn);

 if( ($estado[0]['plantilla']=="" || ($estado[0]['plantilla']<>"" && $estado[0]['estado']<>'ACTIVO' && $estado[0]['numero']>'0')))
   {
   if(isset($_REQUEST["ejecutor"]) && $_REQUEST["ejecutor"]!="")
     $link='<td><a href="../documentoTerminar.php?doc='.$iddoc.'&ejecutor='.$_REQUEST["ejecutor"].'">TERMINAR</a></td>';
   else
     $link='<td><a href="../documentoTerminar.php?doc='.$iddoc.'">TERMINAR</a></td>';
   }
 else
   {$link="<td>&nbsp;</td>";
   }
 return($link);
}

function estado_actual($iddoc)
  {global $conn;

   $aprobado=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_aprobado'","",$conn);
   $pendiente=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_pendiente'","",$conn);
   $atrasado=busca_filtro_tabla("nombre,valor","configuracion","nombre='color_atrasado'","",$conn);
   $retraso=busca_filtro_tabla("A.valor","configuracion A","A.nombre='dias_retraso'","",$conn);
   $color="";

   $recibido=busca_filtro_tabla(fecha_db_obtener("max(BE.fecha)","Y-m-d H:i:s")." AS fechaf","buzon_entrada BE","BE.archivo_idarchivo=$iddoc and nombre not in('POR_APROBAR','BLOQUEADO') and BE.origen='".usuario_actual("funcionario_codigo")."'","",$conn);
    $enviado=busca_filtro_tabla(fecha_db_obtener("max(BS.fecha)","Y-m-d H:i:s")." AS fechaf","buzon_salida BS","BS.archivo_idarchivo=$iddoc and nombre not in('BLOQUEADO') and BS.origen='".usuario_actual("funcionario_codigo")."'","",$conn);
    $estado=busca_filtro_tabla("BS.nombre","buzon_salida BS","BS.archivo_idarchivo=$iddoc and origen='".usuario_actual("funcionario_codigo")."' and ".fecha_db_obtener("BS.fecha",'Y-m-d H:i:s')."='".$enviado[0]["fechaf"]."'","idtransferencia desc",$conn);
 //print_r($estado);
//echo($enviado[0]["fechaf"]." ".$recibido[0]["fechaf"]." ".$estado[0]["nombre"]);
    $estado_doc=busca_filtro_tabla("estado","documento A","A.iddocumento='$iddoc'","",$conn);
     if($estado_doc[0]["estado"]=='ANULADO')
      {$texto="ANULADO";
       $color=$pendiente[0]["valor"];
      }
     elseif($recibido["numcampos"] && ($enviado["numcampos"] && $enviado[0][0]!="")&& $estado[0]["nombre"]<>'LEIDO')
      {
      //echo  $enviado[0]["fechaf"]." - ". $recibido[0]["fechaf"]." - ". $estado[0]["nombre"];
       if($enviado[0]["fechaf"]>=$recibido[0]["fechaf"])
         {
          $texto=$estado[0]["nombre"];
          $color=$aprobado[0]["valor"];//color verde
         }
       elseif($recibido["numcampos"])
        {
         $estado=busca_filtro_tabla("nombre","buzon_entrada","fecha=".fecha_db_almacenar($recibido[0]["fechaf"],'y-m-d H:i:s')." and archivo_idarchivo=$iddoc","",$conn);
         //print_r($estado);
          if($estado["numcampos"]&&$estado[0]["nombre"]=="DEVOLUCION")
              {
               $texto="DEVUELTO";
               $color=$atrasado[0]["valor"];//color rojo
              }
           else
              {$texto="PENDIENTE";
               $color=$pendiente[0]["valor"];//col  or amarillo
              }
         }
       else
         {
          $estado_d=busca_filtro_tabla("A.estado","documento A ","A.iddocumento=$iddoc","",$conn);

          if($estado_d[0]["estado"]=="RECHAZADO")
              {$texto="RECHAZADO";
               $color=$atrasado[0]["valor"];//color rojo
              }
          else
              {$texto="PENDIENTE";
               $color=$pendiente[0]["valor"];//col  or amarillo
              }
         }
      }
    else
      {
      $estado_e=busca_filtro_tabla("nombre","buzon_entrada","fecha=".fecha_db_almacenar(@$enviado[0]["fechaf"],'Y-m-d H:i:s')." and archivo_idarchivo=$iddoc","",$conn);
       if((!isset($estado[0]["nombre"]) && @$estado_e[0]["nombre"]=="LEIDO")|| (isset($estado[0]["nombre"]) && @$estado[0]["nombre"]=="LEIDO"))
          {$texto="LEIDO";
           $color=$pendiente[0]["valor"];//color amarillo
          }
       else if(!$recibido["numcampos"])
          {//creado por el usuario
           $texto=$estado[0]["nombre"];
           $color=$aprobado[0]["valor"];//color verde
          }
       else
          {$texto="PENDIENTE";
           $color=$pendiente[0]["valor"];//color amarillo
          }
      }
   $ayuda = ayuda_estado($texto);
    return("<td bgcolor='$color' align='center'><a href='#' style='text-decoration:none;color:black;' onmouseout='hideTooltip()' onmouseover=\"showTooltip(event,'$ayuda');return false\">".$texto."</a></td>");
  }

function ayuda_estado($estado)
{
 $ayuda="";
 switch($estado)
 {
    case ("LEIDO"):
   $ayuda = "Usted ya ha tenido un contacto visual con el documento que est&aacute; bajo su responsabilidad, debe de hacer el seguimiento respectivo para brindar una respuesta o TRANSFERIRLO para delegar responsabilidad";
   break;
  case ("PENDIENTE"):
   $ayuda = "Este documento se encuentra pendiente de ser le&iacute;do. Debe hacer clic en detalles para tener acceso visual al documento y as&iacute; definir el procedimiento a seguir.";
   break;
   case("BORRADOR"):
    $ayuda = "Este documento es un formato el cual falta confirmar para seguir su proceso.";
   break;
   case("TRANSFERIDO"):
    $ayuda = "El documento ha sido remitido para asignar una responsabilidad o brindar  una copia";
   break;
   case("APROBADO"):
    $ayuda = "El documento interno se ha ejecutado efectivamente";
   break;
  case("RESPONDIDO"):
    $ayuda = "El documento ha sido tramitado y respondido, este documento tiene una respuesta asociada en un formato interno .";
   break;
  case("TERMINADO"):
    $ayuda = "El documento ha terminado con su ciclo &uacute;til en la organizaci&oacute;n.   Este documento lo podr&aacute; localizar posteriormente en la opci&oacute;n DOCUMENTOS EN GESTI&Oacute;N";
   break;
  case("REVISADO"):
    $ayuda = "El documento ha sido confirmado por usted";
   break;
  case("DEVOLUCION"):
    $ayuda="Le ha sido devuelto un documento que usted hab&iacute;a enviado previamente, debe revisarlo nuevamente ya sea para realizar el tr&aacute;mite respectivo o para reasignar una responsabilidad.";
  break;
 }
// return ('class="tooltip_text" href="#" onmousemove="showToolTip(event,'.$ayuda.'); return false" onmouseout="hideToolTip();');
 return($ayuda);
}

function codigo_padre($key)
{
 global $conn;
 $cod_padre = busca_filtro_tabla("cod_padre","estructura_calidad","idestructura_calidad=$key","",$conn);
 $padre = busca_filtro_tabla("nombre,codigo","estructura_calidad","idestructura_calidad=".$cod_padre[0]["cod_padre"],"",$conn);
 echo "<td>".$padre[0]["nombre"]." - ".$padre[0]["codigo"]."</td>";
}

function checkbox($iddoc)
{
global $conn;
  $despacho=busca_filtro_tabla("A.numero_guia,B.tipo_despacho","salidas A, documento B","B.iddocumento=".$iddoc." AND A.documento_iddocumento=B.iddocumento and A.estado=1","",$conn);
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

function detalles_calidad($iddoc)
{echo "<td><a href='../documentoview.php?key=$iddoc' target='derecha'>Ver</a></td>";
}

function arbol_calidad()
{echo "<table width=100% ><tr><td  bgcolor='#FFFFFF' colspan=10 align=center>";
  agrega_boton("botones/documentacion","../botones/documentacion/carta.gif","../factura/class_plantillas.php?funcion=listado_calidad","izquierda","ARBOL","","calidad");
 echo "</td></tr></table>";
}

function despachar()
{return("<input type='hidden' name='docs' id='docs' value=''>
       <input type='button' value='Despachar' onclick='despachar();'>");
}

function enviar_email($iddoc)
{
 global $conn;
 echo "<td>";
 $despachado=busca_filtro_tabla("A.idsalida","salidas A","A.estado=1 and A.documento_iddocumento=".$iddoc,"",$conn);
   if($despachado["numcampos"]==0)
    {
  ?>
 <input value="Crear E-mail" type=button onclick="window.location='../email/email_doc.php?iddoc=<?php echo $iddoc ?>';" >
  <?php
    }
  echo "</td>";
}

function numero_detalles($iddoc){
  global $conn;
  if($iddoc){
    $numero=busca_filtro_tabla("A.numero","documento A","A.iddocumento=".$iddoc,"",$conn);
    if($numero["numcampos"])
      echo('<td><a href="../documentoview.php?key='.$iddoc.'">'.$numero[0]["numero"].'</a></td>');
    else echo('<td><a href="../documentoview.php?key='.$iddoc.'">-----</a></td>');
  }
}

function llenar_expediente($id)
{
 global $conn;
 /*$datos=busca_filtro_tabla("","busquedas","idbusquedas=17","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=17","",$conn);
$id_func = array();
 if($funciones["numcampos"]>0)
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {
       $id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
   $tablas="documento";
  $busqueda = "index.php?bavanzada=documentolist.php&tabla=documento&llave=".$datos[0]["llave"]."&func_busqueda=".$id_func."&registros=1000&tablas=tablas&formu=$tablas&tipo=busqueda&pagina_exp=$id";
  */
  $busqueda = "../busqueda_documentos.php?pagina_exp=$id&tipo_b=todos";
  echo '<td><span class="phpmaker"><a href="'.$busqueda.'">Llenar</a></span></td>';


}

function adicionar_expediente($idexpediente)
{
 global $conn;
 $iddoc = $_REQUEST["iddoc"];
 $guardado = busca_filtro_tabla("expediente_idexpediente","expediente_doc","expediente_idexpediente=$idexpediente and documento_iddocumento=$iddoc","",$conn);
  if($guardado["numcampos"]>0)
    echo "<td>Guardado</td>";
  else
   { echo "<td><input type=checkbox name='exp_$idexpediente';></td>";
     $muestra_boton=true;
   }

}

function mostrar_expediente($idexpediente)
{
   echo "<td><a href='../expedienteview.php?key=$idexpediente' target='centro'>Mostrar</a></td>";
}
function editar_flujo($Id){
    $ruta="<td><a href='../workflow/index.php?diagramId=".$Id."' target='editar_flujo'>Editar</a></td>";
    echo($ruta);
}
function mostrar_flujo_documento($idpaso_documento){
    echo "<td><a href='../workflow/mapeo_diagrama.php?idpaso_documento=".$idpaso_documento."' target='centro'>Verificar</a>&nbsp;|&nbsp;";
    echo "<a href='../workflow/resumen_flujo.php?idpaso_documento=".$idpaso_documento."' class=\"highslide\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 700, height:250,preserveContent:false } )\">Ver Doc</a></td>";
}
function mostrar_flujo_estado_paso($idpaso_documento){
global $ruta_db_superior;
include_once($ruta_db_superior."workflow/libreria_paso.php");
  $flujo=estado_flujo_instancia($idpaso_documento);
  //print_r($flujo);
  $porcentaje=$flujo["porcentaje"];
  $fecha_final_diagram=$flujo["fecha_final_diagrama"];
   if($flujo["devueltos"]){
     $flujo[0]["estado_diagram_instance"]=7;
   }
  $texto='
  <link rel="stylesheet" type="text/css" href="'.$ruta_db_superior.'css/estilo_flujos.css"/></style>
  <div class="texto_paso"><strong>Paso Actual: </strong>'.$flujo[0]["nombre_paso"]."<br />".@$estadod." <br /><strong>Terminados:</strong> (".(($flujo["numcampos"]))."/".$flujo["pasos_flujo"]."):".$porcentaje."%<br />Pasos Devueltos: ".$flujo["devueltos"]."</div>";
    echo "<td class='paso".$flujo[0]["estado_diagram_instance"]."'>".$texto."</td>";
}
function mostrar_flujo_fecha_finalizacion($idpaso_documento){
global $ruta_db_superior;
include_once($ruta_db_superior."workflow/libreria_paso.php");
  $flujo=estado_flujo_instancia($idpaso_documento);
  //print_r($flujo);
  $fecha_final_diagram=$flujo["fecha_final_diagrama"];
  $diferencia=$flujo["diferenciad"];
   switch($flujo[0]["estado_diagram_instance"]){
    case 1:
      $estadod=$fecha_final_diagram;
    break;
    case 2:
      $estadod=$fecha_final_diagram;
    break;
    case 3:
      $estadod=$fecha_final_diagram;
    break;
    case 4:
      $estadod=$fecha_final_diagram;
    break;
    case 5:
      $estadod=$fecha_final_diagram." <br />Atrasado: ".$diferenciad["year"]." A&ntilde;os ".$diferenciad["month"]." Meses ".$diferenciad["day"]." d&iacute;as";
    break;
    case 6:
      $estadod=$fecha_final_diagram;
    break;
  }
  echo "<td align='center'>".$estadod."</td>";
}
function adicionar_documento()
{return("<input type='hidden' name='expediente' id='expediente' value=''>
        <input type='hidden' name='iddoc' id='iddoc' value='".$_REQUEST["iddoc"]."'>
       <input type='button' value='Adicionar' onclick='adicionar_expediente();'>");
}

function filtro_remitente($iddoc)
{ global $conn;
  $ejecutor = busca_filtro_tabla("ejecutor","documento","iddocumento=$iddoc","",$conn);
  return "<td><a href='../pendienteslist.php?ejecutor=".$ejecutor[0]["ejecutor"]."'>filtrar</a></td>";
}

function valor_reporte($iddoc)
{ global $conn;
$consulta=busca_filtro_tabla("","ft_recibo_caja_menor","documento_iddocumento=".$iddoc,"",$conn);
return '<td> $'.number_format($consulta[0]["valor_total"],0,",",".").'</td>';
}

if(isset($_REQUEST["funcion"]))
    $_REQUEST["funcion"]();
?>
<script>
<!--
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
     document.getElementById("resultados").action="../despachar.php";
     document.getElementById("resultados").submit();
    }
  }
 function registrar_causacion(tipo)
  {var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("resultados").elements.length;i=i+1)
    {var objeto=document.getElementById("resultados").elements[i];
     if(objeto.checked==true && objeto.name.indexOf(tipo+"_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
   if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else
    {
     if(tipo == 'reembolso'){
     	descripcio = prompt("Digite el numero de cheque");
     	var descrip = new String(descripcio);
     	document.getElementById("descripcion_reembolso").value=descrip;
     }
     document.getElementById("docs").value=docs;
     document.getElementById("accion").value=tipo;
     document.getElementById("resultados").action="../registrar_causacion.php";
     if(tipo == 'reembolso'){
     	if(descripcio){
     		document.getElementById("resultados").submit();
     	}
     }
     else
     	document.getElementById("resultados").submit();
    }
  }
  function registrar_aprobacion(tipo){
   var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("resultados").elements.length;i=i+1)
    {var objeto=document.getElementById("resultados").elements[i];
     if(objeto.checked==true && objeto.name.indexOf(tipo+"_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
   if(elementos==0)
    {alert("Seleccione por lo menos un documento.")}
   else
    {
     document.getElementById("docs").value=docs;
     document.getElementById("accion").value=tipo;
     document.getElementById("resultados").action="../formatos/solicitud_gastos_caja_menor/aprobar_rechazar_solicitud.php";
     document.getElementById("resultados").submit();
    }
  }
 function seleccionar_todos(tipo,opcion)
  {for(i=0;i<document.getElementById("resultados").elements.length;i=i+1)
    {var objeto=document.getElementById("resultados").elements[i];

     if(objeto.name.indexOf(tipo+"_")==0)
        {objeto.checked=opcion;
        }
    }
  }
 function adicionar_expediente()
 {
  var elementos=0;
   var docs="";
   for(i=0;i<document.getElementById("resultados").elements.length;i=i+1)
    {var objeto=document.getElementById("resultados").elements[i];
     if(objeto.checked==true && objeto.name.indexOf("exp_")==0)
        {docs+=objeto.name.substring(objeto.name.indexOf("_")+1,objeto.name.length)+",";
         elementos+=1;
        }
    }
   if(elementos==0)
    {alert("Seleccione por lo menos un expediente.")}
   else
    {document.getElementById("expediente").value=docs;
     document.getElementById("resultados").action="../expediente_llenar.php";
     document.getElementById("resultados").submit();
    }
 }
  -->
</script>