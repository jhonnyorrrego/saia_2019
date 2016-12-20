<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once ($ruta_db_superior.'db.php');
include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function barra_inferior_documento($iddoc,$numero){
$dato_prioridad=busca_filtro_tabla("","prioridad_documento","documento_iddocumento=".$iddoc,"fecha_asignacion DESC",$conn);

$prioridad="icon-flag";
if($dato_prioridad["numcampos"]){
  switch ($dato_prioridad[0]["prioridad"]) {
    case 1:
      $prioridad='icon-flag-rojo';
    break;
    case 2:
      $prioridad='icon-flag-morado';
	  break;
    case 3:
      $prioridad='icon-flag-naranja';
	  break;
    case 4:
      $prioridad='icon-flag-amarillo';
	  break;
    case 5:
      $prioridad='icon-flag-verde';
	  break;
    default:
      $prioridad='icon-flag';
    break;
  }
}



$dato_leido=documento_leido($iddoc);
$clase_info="detalle_documento_saia";
if($_SESSION["tipo_dispositivo"]=="movil"){
    $clase_info="kenlace_saia";
}
$texto.='<div class="btn-group pull" >
	<button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" onClick=" " enlace="pantallas/documento/detalles_documento.php?iddoc='.$iddoc.'&idbusqueda_componente='.$_REQUEST["idbusqueda_componente"].'" titulo="Detalle Doc No.'.$numero.'" conector="iframe" idregistro="'.$iddoc.'"ancho_columna="470" eliminar_hijos_kaiten="1">
    <i class="'.$dato_leido[1].'"></i>
  </button>

  <button type="button" class="btn btn-mini '.$clase_info.' tooltip_saia" conector="iframe" onClick=" " enlace="pantallas/documento/detalles_documento.php?iddoc='.$iddoc.'" titulo="No.'.$numero.'" idregistro="'.$iddoc.'"><i class="icon-info-sign"></i></button>
  <button type="button" class="btn btn-mini tooltip_saia adicionar_seleccionados" title="Seleccionar" idregistro="'.$iddoc.'">
    <i class="icon-uncheck"></i>
  </button>
  <button type="button" class="btn btn-mini dropdown-toggle tooltip_saia" data-toggle="dropdown" title="Prioridad">
    <i class="'.$prioridad.'" id="prioridad_'.$iddoc.'" prioridad="'.$prioridad.'"></i><span class="caret"></span>
  </button>
    <ul class="dropdown-menu">
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="1"><i class="icon-flag-rojo"></i> Rojo</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="2"><i class="icon-flag-morado"></i> Morado</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="3"><i class="icon-flag-naranja"></i> Naranja</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="4"><i class="icon-flag-amarillo"></i> Amarillo</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="5"><i class="icon-flag-verde"></i> Verde</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="0"><i class="icon-flag"></i>Sin indicador</a></li>
    </ul>
    </div>';
//$texto.=barra_estandar_documento($iddoc,$funcionario);
return($texto);
}

function fecha_barra_documento($iddoc){
$fecha_vencimiento=fecha_documento($iddoc);
$texto.='<div class="btn-group fecha_barra_documento pull-right">';
$texto.='<button type="button" class="btn btn-mini tooltip_saia '.$fecha_vencimiento[0].'" title="Vence" idregistro="'.$iddoc.'"><i class="icon-time icon-white"></i> '.mostrar_fecha_saia($fecha_vencimiento[1]).'</button>';
$texto.='</div><br /><br />';
return($texto);
}
function barra_estandar_documento($iddoc,$funcionario){
$cant_anexos=0;
$cant_notas=0;
$cant_paginas=0;
$fecha_vencimiento=fecha_documento($iddoc);
$texto.='<div class="btn-group barra_inferior pull-right">';
$texto.='<button type="button" class="btn btn-mini tooltip_saia ver_indicador_documento" titulo="Ver indiciadores documento" idregistro="'.$iddoc.'"><i class="icon-bell"></i></button>';
$texto.='<button type="button" class="btn btn-mini tooltip_saia '.$fecha_vencimiento[0].'" titulo="Vence" idregistro="'.$iddoc.'"><i class="icon-time icon-white"></i> '.mostrar_fecha_saia($fecha_vencimiento[1]).'</button>';
$texto.='</div><br /><br />';
return($texto);
}
function barra_adicional_documento($iddoc){
$texto='';
$cant_actividades=contar_tareas_flujo($iddoc);
$cant_tareas=contar_tareas($iddoc);
$cant_anexos=contar_cantidad($iddoc,$_SESSION["usuario_actual"],'adjuntos_documento');
$cant_notas=contar_cantidad($iddoc,$_SESSION["usuario_actual"],'ver_notas');
$cant_paginas=contar_cantidad($iddoc,$_SESSION["usuario_actual"],'ordenar_pag');
$conector='conector="iframe"';
$adicional="";
$texto='';
if(!$cant_paginas['ordenar_pag']){
  $adicional='disabled="disabled"';
  $conector='';
}
$texto.='<button '.$adicional.' type="button" class="btn btn-mini tooltip_saia kenlace_saia" titulo="P&aacute;ginas del documento" idregistro="'.$iddoc.'" '.$conector.' enlace="ordenar.php?key='.$iddoc.'"><i class="icon-file" '.$adicional.'></i> '.intval($cant_paginas['ordenar_pag']).'</button>';
$adicional="";
$conector='conector="iframe"';
if(!is_array($cant_actividades)){
	$adicional='disabled="disabled"';
	$conector='';
}
$texto.='<button '.$adicional.' type="button" class="btn btn-mini '.$cant_actividades[0].' kenlace_saia tooltip_saia" enlace="flujos_documento.php?key='.$iddoc.'" titulo="Actividades del flujo sobre el documento" '.$conector.' ><i class="icon-ok-circle icon-white"></i> '.intval($cant_actividades[1]).'/'.intval($cant_actividades[2]).'</button>';
$adicional="";
$conector='conector="iframe"';
if(!$cant_tareas[2]){
  	$adicional='disabled="disabled"';
	$conector='';
}
//$texto.='<button '.$adicional.' type="button" class="btn btn-mini '.$cant_tareas[0].' tooltip_saia" enlace="#" titulo="Tareas sobre el documento" '.$conector.' ><i class="icon-tasks icon-white"></i> '.intval($cant_tareas[1]).'/'.intval($cant_tareas[2]).'</button>';
$adicional="";
$conector='conector="iframe"';
if(!$cant_notas['ver_notas']){
  $adicional='disabled="disabled"';
  $conector='';
}
$texto.='<button '.$adicional.' type="button" class="btn btn-mini tooltip_saia" titulo="Notas y observaciones del documento" idregistro="'.$iddoc.'"><i class="icon-tags"></i> '.intval($cant_notas['ver_notas']).'</button>';
$adicional="";
$conector='conector="iframe"';
if(!$cant_anexos['adjuntos_documento']){
  $adicional='disabled="disabled"';
	$conector='';
}
$texto.='<button '.$adicional.' type="button" class="btn btn-mini tooltip_saia kenlace_saia" titulo="Anexos" idregistro="'.$iddoc.'" enlace="anexosdigitales/anexos_documento.php?key='.$iddoc.'&no_menu=1" conector="iframe"><i class="icon-book"></i> '.intval($cant_anexos['adjuntos_documento']).'</button>';
return($texto);
//return(addslashes(str_replace("\\r","",str_replace("\\n","",$texto))));
}
function contar_tareas($iddoc){
	global $conn;
	$tareas=busca_filtro_tabla("A.*,".resta_fechas("A.fecha_vencimiento","'".date("Y-m-d")."'")." AS dias","tareas A","documento_iddocumento=".$iddoc,"",$conn);
	$fin=$tareas["numcampos"];
	$realizados=0;
	$clase1='';
	$clase2='';
	$clase3='';
	$dias_retraso=busca_filtro_tabla("","configuracion","nombre='dias_retraso'","",$conn);
	for($i=0;$i<$fin;$i++){
		$realizado=busca_filtro_tabla("","tareas_buzon","tareas_idtareas=".$tareas[$i]["idtareas"],"",$conn);

		if($tareas[$i]["dias"]>$dias_retraso[0]["valor"]){
	      $clase="btn-success";
	    }
	    else if($tareas[$i]["dias"]<$dias_retraso[0]["valor"]){
	      $clase="btn-danger";
	    }
	    else{
	      $clase="btn-warning";
	    }
		if($realizado["numcampos"]){
			$realizados++;
			continue;
		}
	}

	return array($clase,$realizados,$fin);
}
function origen_documento($doc,$numero,$origen="",$tipo_radicado="",$estado="",$serie="",$tipo_ejecutor=""){
$ruta="";
$numero=intval($numero);
$pre_texto='';
if(in_array($estado,array("APROBADO","GESTION","CENTRAL","HISTORICO","ACTIVO"))!==FALSE){
	$docu=busca_filtro_tabla("lower(plantilla) as plantilla, nombre_tabla,cod_padre,idformato","documento A, formato B","A.iddocumento=".$doc." AND lower(plantilla)=lower(B.nombre)","",$conn);
	if($docu[0]["plantilla"]=='radicacion_entrada'||$docu[0]["plantilla"]=='radicacion_salida'){
		$remitente=busca_filtro_tabla("",$docu[0]["nombre_tabla"]." A, datos_ejecutor B, ejecutor C","persona_natural=B.iddatos_ejecutor AND ejecutor_idejecutor=idejecutor AND A.documento_iddocumento=".$doc,"",$conn);
		$texto=ucwords(strtolower($remitente[0]["nombre"]));
	}else{
		$remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);
		$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"];
	}
  if($remitente["numcampos"]){
  	$ruta=$texto."-".serie_documento($serie);
  }
}else{
  $remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);
	$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"];
  if($remitente["numcampos"]){
    $ruta=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"]."-".serie_documento($serie);
  }
}

if(!$ruta){
	if($tipo_ejecutor==1&&$tipo_radicado==1){
		$datos_ejecutor=busca_filtro_tabla("A.plantilla,B.ejecutor_idejecutor","documento A,datos_ejecutor B","A.ejecutor=B.iddatos_ejecutor and A.iddocumento=".$doc,"",$conn);
		$ejecutor=busca_filtro_tabla("nombre","ejecutor","idejecutor=".$datos_ejecutor[0]["ejecutor_idejecutor"],"",$conn);
	}
	
	print_r($datos_ejecutor);die();
	
	
	if($ejecutor["numcampos"]&&$datos_ejecutor[0]["plantilla"]==""){
		$ruta=$ejecutor[0]["nombre"]."-".serie_documento($serie);
	}else{
    $ruta="Error al buscar remitente-".serie_documento($serie);
	}
}
$ver_estado='';
if($estado=='ANULADO'){
	$ver_estado='<font color="red">-(ANULADO)</font>';
}
$pre_texto="<div class='link kenlace_saia pull-left' enlace='ordenar.php?key=".$doc."&accion=mostrar&mostrar_formato=1' conector='iframe' titulo='Documento No.".$numero."'><b>".$numero."-".$ruta.$ver_estado."</b></div>";

return($pre_texto);
}

function origen_documento_excel($doc,$numero,$origen="",$tipo_radicado="",$estado="",$serie="",$tipo_ejecutor=""){
$ruta="";
$numero=intval($numero);
$pre_texto='';
if(in_array($estado,array("APROBADO","GESTION","CENTRAL","HISTORICO","ACTIVO"))!==FALSE){
	$docu=busca_filtro_tabla("lower(plantilla) as plantilla, nombre_tabla,cod_padre,idformato","documento A, formato B","A.iddocumento=".$doc." AND lower(plantilla)=lower(B.nombre)","",$conn);
	if($docu[0]["cod_padre"]){
    $papa=buscar_papa_primero($doc);
    if($papa!=$doc){
      $doc_papa=busca_filtro_tabla("","documento","iddocumento=".$papa,"",$conn);
      if($doc_papa["numcampos"]){
        $pre_texto="<div class='link kenlace_saia' enlace='ordenar.php?key=".$doc_papa[0]["iddocumento"]."&accion=mostrar&mostrar_formato=1' conector='iframe' titulo='Documento No.".$doc_papa[0]["numero"]."'><b>".$doc_papa[0]["numero"]."-".$doc_papa[0]["descripcion"]."</b></div><br/><br/><br/>";
      }
    }
  }
	if($docu[0]["plantilla"]=='radicacion_entrada'||$docu[0]["plantilla"]=='radicacion_salida'){
		$remitente=busca_filtro_tabla("",$docu[0]["nombre_tabla"]." A, datos_ejecutor B, ejecutor C","persona_natural=B.iddatos_ejecutor AND ejecutor_idejecutor=idejecutor AND A.documento_iddocumento=".$doc,"",$conn);

		$texto=ucwords(strtolower($remitente[0]["nombre"]));
	}
	else{
		  $remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);
		$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"];
	}
  if($remitente["numcampos"]){
  	$ruta=$texto;
  }
}
else{
  $remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);
$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"];
  if($remitente["numcampos"]){
    $ruta=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"];
  }
}
if(!$ruta){
	if($tipo_ejecutor==1&&$tipo_radicado==1){
		$datos_ejecutor=busca_filtro_tabla("A.plantilla,B.ejecutor_idejecutor","documento A,datos_ejecutor B","A.ejecutor=B.iddatos_ejecutor and A.iddocumento=".$doc,"",$conn);
		$ejecutor=busca_filtro_tabla("nombre","ejecutor","idejecutor=".$datos_ejecutor[0]["ejecutor_idejecutor"],"",$conn);
	}
	if($ejecutor["numcampos"]&&$datos_ejecutor[0]["plantilla"]==""){
		$ruta=$ejecutor[0]["nombre"];
	}
	else{
    $ruta="Error al buscar remitente-";
	}
}
if($pre_texto==''){
  $pre_texto="<div class='link kenlace_saia' enlace='ordenar.php?key=".$doc."&accion=mostrar&mostrar_formato=1' conector='iframe' titulo='Documento No.".$numero."'><b>".$ruta."</b></div>";
}
else{
  $pre_texto.=$ruta."<br />";
}
return($pre_texto);
}
function contar_tareas_flujo($iddoc){
global $conn;
$idpaso_documento=busca_filtro_tabla("","paso_documento","documento_iddocumento=".$iddoc,"idpaso_documento desc",$conn);
if($idpaso_documento["numcampos"]==0){
	return 0;
}
include_once($ruta_db_superior."workflow/libreria_paso.php");
$flujo=estado_flujo_instancia($idpaso_documento[0]["idpaso_documento"]);
$pasoo = busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo[0]["iddiagram_instance"]." and paso_idpaso=".$flujo[0]["paso_idpaso"],"idpaso_documento desc",$conn);

$terminados = 0;
$actividades = busca_filtro_tabla("","paso_actividad","estado=1 AND paso_idpaso=".$pasoo[0]["paso_idpaso"],"",$conn);
for($i=0;$i<$actividades["numcampos"];$i++){
	$terminada = busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividades[$i]["idpaso_actividad"]." and documento_iddocumento=".$pasoo[0]["documento_iddocumento"],"",$conn);
	if($terminada["numcampos"] > 0){
		$terminados++;
	}
}
$dia = busca_filtro_tabla(resta_fechas(fecha_db_almacenar($flujo["fecha_final_paso"],'Y-m-d'),fecha_db_almacenar(date('Y-m-d'),'Y-m-d'))."as dias");
  $dias = $dia[0]["dias"];
if($dias > 1 || $terminados){
	$color = 'btn-success';//verde
}
else if($dias < 0){
	$color = 'btn-danger';//rojo
}
else{
	$color = 'btn-warning';//amarillo
}

return (array($color,$terminados,$actividades["numcampos"]));
}
function documento_leido($iddoc){
$pendiente = busca_filtro_tabla(fecha_db_obtener("fecha_inicial","Y-m-d H:i:s")." as fecha_inicial","asignacion","documento_iddocumento=".$iddoc." and llave_entidad=".$_SESSION["usuario_actual"],"fecha_inicial DESC",$conn);
$leido["numcampos"]=0;
$dato_leido[1]="icon-leido";
$dato_leido[0]='Documento<br />sin leer';
if($pendiente["numcampos"]){
  $leido = busca_filtro_tabla("nombre,idtransferencia","buzon_entrada","archivo_idarchivo=".$iddoc." and origen=".$_SESSION["usuario_actual"]." and nombre='LEIDO' AND fecha >= ".fecha_db_almacenar($pendiente[0]["fecha_inicial"],"Y-m-d H:i:s"),"",$conn);
}
else{
    $leido = busca_filtro_tabla("nombre,idtransferencia","buzon_entrada","archivo_idarchivo=".$iddoc." and origen=".$_SESSION["usuario_actual"]." and nombre='LEIDO'","",$conn);
}
if($leido["numcampos"]){
  $dato_leido[1]="icon-no_leido";
  $dato_leido[0]="Documento<br />leido";
}
return($dato_leido);
}
function contar_cantidad($doc,$funcionario,$tipo){
global $conn;
$cantidades=array();
if($tipo=='adjuntos_documento'||$tipo=='todos'){
	$anexos=busca_filtro_tabla("count(*) AS anexos","anexos","documento_iddocumento=".$doc,"",$conn);
  $cantidades['adjuntos_documento']=intval($anexos[0]["anexos"]);
}//$modulos = busca_filtro_tabla("imagen,nombre","modulo","nombre LIKE 'ordenar_pag' OR nombre LIKE 'ver_notas' OR nombre LIKE 'adjuntos_documento' OR nombre LIKE 'documentos_relacionados'","",$conn);
if($tipo=='ver_notas'||$tipo=='todos'){
  $where_comentarios='';
  if(@$funcionario!=="funcionario"){
  	//$where_comentarios=" AND (funcionario=".$funcionario.")";
  }
  $comentarios=busca_filtro_tabla("count(*) AS notas","comentario_img","documento_iddocumento=".$doc.$where_comentarios,"",$conn);
  if(@$funcionario!=="funcionario"){
  	$where_notas=" AND (destino=".$funcionario." OR origen=".$funcionario." OR ver_notas<>0)";
  }
  $notas_transferencia=busca_filtro_tabla("count(notas) AS notas","buzon_salida","archivo_idarchivo=".$doc." AND notas!='' AND notas IS NOT NULL AND (lower(nombre) LIKE 'TRANSFERIDO' OR lower(nombre) LIKE 'DEVOLUCION')".$where_notas,"",$conn);
  $cantidades["ver_notas"]=intval($comentarios[0]["notas"]+$notas_transferencia[0]["notas"]);
}
if($tipo=='ordenar_pag'||$tipo=='todos'){
  $paginas=busca_filtro_tabla("count(*) AS paginas","pagina","id_documento=".$doc,"",$conn);
	$cantidades["ordenar_pag"]=intval($paginas[0]["paginas"]);
}
if($tipo=='documentos_relacionados'||$tipo=='todos'){
	$respuestas=busca_filtro_tabla("count(*) AS respuestas","respuesta","origen=".$doc,"",$conn);
	$vinculados=busca_filtro_tabla("count(*) AS vinculados","documento_vinculados","documento_origen=".$doc,"",$conn);
  $cantidades["documentos_relacionados"]=intval($respuestas[0]["respuestas"])+intval($vinculados[0]["vinculados"]);
}
if($tipo=='ver_tareas'||$tipo=='todos'){
	$tareas=busca_filtro_tabla("count(*) AS tareas","tareas","documento_iddocumento=".$doc,"",$conn);
	$cantidades["ver_tareas"]=intval($tareas[0]["tareas"]);
}
if($tipo=='ver_versiones'||$tipo=='todos'){
	$versiones=busca_filtro_tabla("count(*) AS tareas","version_documento","documento_iddocumento=".$doc,"",$conn);
	$cantidades["ver_versiones"]=intval($versiones[0]["tareas"]);
}
return($cantidades);
}
function serie_documento($idserie){
  $serie=busca_filtro_tabla("nombre","serie","idserie=".$idserie,"",$conn);
  if($serie["numcampos"]){
     return(ucwords(strtolower($serie[0]["nombre"])));
    }
 else
   return("Sin Serie Asignada");
}


function fecha_documento($iddoc){
$dias1=busca_filtro_tabla("iddocumento,".fecha_db_obtener("fecha",'Y-m-d')." as fecha,numero,".case_fecha('dias',"''",'dias_entrega','dias')." as dias_r","documento left join serie on serie=idserie","iddocumento=$iddoc","",$conn);
$dias2["numcampos"]=0;
if($dias1[0]["dias_r"]<>""){
  $fecha_f=dias_habiles_listado($dias1[0]["dias_r"]+1,'Y-m-d',$dias1[0]["fecha"]);
  $dias2=busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_f,'Y-m-d'),"")." as respuesta","dual","","",$conn);
}
if($dias2["numcampos"]){
  $retraso=busca_filtro_tabla("A.valor",DB.".configuracion A","A.nombre='dias_retraso'","",$conn);
  $dias=intval(ceil($dias2[0]["respuesta"]));
  if($dias<0){
    $cadena=array("btn-danger",$fecha_f,$dias,"Vencido ".$dias." d&iacute;as");
  }
  else if($dias>$retraso[0]["valor"]){
    $cadena=array("btn-success",$fecha_f,$dias,"Vence en ".$dias." d&iacute;as");
  }
  else if($dias<=$retraso[0]["valor"] && $dias>=0){
     $cadena=array("btn-warning",$fecha_f,$dias,"Vence en ".$dias." d&iacute;as");
  }
}
else{
   $cadena=array("btn-warning",date("Y-m-d"),0,"Sin vencimiento");
}
return($cadena);
}
function vincular_documentos(){
	global $ruta_db_superior;
  $texto='<li><a href="#" id="vincular_documentos">Vincular documentos</a></li>';
  $texto.='<script>
    $("#vincular_documentos").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	var coma=docus.indexOf(",");
		if(coma>0){
			$.post("'.$ruta_db_superior.'vincular_documento.php",{docs:docus},function(){
				//alert("Vinculacion exitosa");
				notificacion_saia("Vinculacion exitosa","success","",4000);
			});
		}
	  	else if(coma==-1){
	  		//alert("Seleccione mas documentos para la vinculacion");
	  		notificacion_saia("<b>ATENCI&Oacute;N</b><br>Seleccione mas documentos para la vinculacion","warning","",4000);
	  	}
	  }
	  else{
	  	//alert("Seleccione por lo menos dos documentos");
	  	notificacion_saia("<b>ATENCI&Oacute;N</b><br>Seleccione por lo menos dos documentos","warning","",4000);
	  }
    });
  </script>';
  return $texto;
}
function deseleccionar_documento($ldocs){
$ldocs=array_unique($ldocs);
$docs_eliminados=array();
$cant=count($ldocs);
$sql2='';
for($i=0;$i<$cant;$i++){
  $sql2.="DELETE FROM documento_por_vincular WHERE documento_iddocumento=".$ldocs[$i];
  phpmkr_query($sql2);
  array_push($docs_eliminados,$ldocs[$i]);
}
  return(array("mensaje"=>"Los documentos con No(".implode(",",$docs_eliminados).")se han deseleccionado","tipo"=>"alert"));
}

function fecha_creacion_documento($fecha0,$plantilla=Null,$doc=Null){
global $conn;
if($fecha0=='fecha_inicial'){
	$asignacion=busca_filtro_tabla("","asignacion","documento_iddocumento=".$doc,"",$conn);
	$fecha0=$asignacion[0]["fecha_inicial"];
}
$fecha1=date_parse($fecha0);
$fecha2=date_parse(date("Y-m-d"));
if($fecha1["year"]==$fecha2["year"] && $fecha1["month"]==$fecha2["month"]){
  if($fecha1["day"]==$fecha2["day"]){
    $fecha=$fecha1["hour"].":".$fecha1["minute"];
  }elseif(($fecha1["day"]+1)==($fecha2["day"])){
    $fecha='ayer';
  }else{
		$fecha=mostrar_fecha_saia($fecha1["day"]."-".$fecha1["month"]."-".$fecha1["year"]);
  }
}else{
	$fecha=mostrar_fecha_saia($fecha1["day"]."-".$fecha1["month"]."-".$fecha1["year"]);
}

$exito=0;
$docu=busca_filtro_tabla("cod_padre","documento A, formato B","A.iddocumento=".$doc." AND lower(plantilla)=lower(B.nombre)","",$conn);
if($docu[0]["cod_padre"]){
    $papa=buscar_papa_primero($doc);
    if($papa!=$doc){
      $doc_papa=busca_filtro_tabla("","documento","iddocumento=".$papa,"",$conn);
      if($doc_papa["numcampos"]){
      	$exito=1;	$iddoc_papa=$doc_papa[0]["iddocumento"];
      	$plantilla=$doc_papa[0]["plantilla"];
      }
    }
}
if($exito){
	$plantilla=nombre_plantilla($plantilla,$iddoc_papa);
}else{
	$iddoc_papa=$doc;
	$plantilla=nombre_plantilla($plantilla,$iddoc_papa);
}

$texto='<div class="pull-right">'.$fecha.'</div><br /><br /><div class="link kenlace_saia" enlace="ordenar.php?key='.$iddoc_papa.'&accion=mostrar&mostrar_formato=1" conector="iframe" titulo="Documento" style="float:right;" ><b>Ver: </b>'.$plantilla.'</div>';
return($texto);
}

function nombre_plantilla($plantilla,$iddoc=Null){
	$formato=busca_filtro_tabla("","formato","lower(nombre)='".strtolower($plantilla)."'","",$conn);
	if($formato["numcampos"])
		return (ucfirst(strtolower($formato[0]["etiqueta"])));
	else {
		if($iddoc){
			$tipo=busca_filtro_tabla("","documento a","a.iddocumento=".$iddoc,"",$conn);
			if($tipo[0]["tipo_radicado"]==1)
				return "Entrada";
			if($tipo[0]["tipo_radicado"]==2)
				return "Salida";
		}
		else return "Entrada";
	}
}
function mostrar_documentos_vinculados($iddoc){
	$vinculados=datos_documentos_vinculados($iddoc);
	$funcionario=$_SESSION["usuario_actual"];
	$texto='';
	if($vinculados["numcampos"]){
		$texto='<table class="table table-bordered">';
		for($i=0;$i<$vinculados["numcampos"];$i++){
			$texto.='<tr><td><b>'.$vinculados[$i]["numero"].'</b>-'.$vinculados[$i]["descripcion"].'</td>';
			$permiso_documento=permisos_documento($iddoc,$funcionario);
			if($permiso_documento){
				$texto.='<td><button type="button" class="btn btn-mini acceso_documento" iddocumento="'.$iddoc.'"><i class="icon-list-alt"></i></button></td>';
			}
			else{
				$texto.='<td>&nbsp;</td>';
			}
		}
		$texto.='</table>';
	}
	return($texto);
}
function datos_documentos_vinculados($iddoc){
	$dato=busca_filtro_tabla("","documento_vinculados A,documento B","A.documento_destino=B.iddocumento AND documento_origen=".$iddoc,"",$conn);
	return($dato);
}
function permisos_documento($iddoc,$funcionario){
	return(1);
}
function filtro_funcionario($funcionario){
  if($funcionario=='funcionario'){
   $retorno=" AND B.llave_entidad='".usuario_actual("funcionario_codigo")."'";
  }
  else{
    $retorno=" AND B.llave_entidad='".$funcionario."'";
  }
  if(@$_REQUEST["variable_busqueda"]){
  	$retorno=" AND B.llave_entidad='".$_REQUEST["variable_busqueda"]."'";
  }
return($retorno);
}
function barra_inferior_documentos_activos($iddoc,$numero){
$dato_prioridad=busca_filtro_tabla("","prioridad_documento","documento_iddocumento=".$iddoc,"fecha_asignacion DESC",$conn);
$prioridad="icon-flag";
if($dato_prioridad["numcampos"]){
  switch ($dato_prioridad[0]["prioridad"]) {
    case 1:
      $prioridad='icon-star';
    break;
    case 2:
      $prioridad='icon-star-empty';
	  break;
    default:
      $prioridad='icon-flag';
    break;
  }
}
$tarea="icon-check";
$dato_leido=documento_leido($iddoc);
$texto.='<div class="btn-group pull-left" >
  <button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" enlace="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$iddoc.'" titulo="'.$dato_leido[0].' No.'.$numero.'" conector="iframe" idregistro="'.$iddoc.'">
    <i class="'.$dato_leido[1].'"></i>
  </button>

  <button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Desactivar documento" enlace="activar_documentofunc.php?func=0&key='.$iddoc.'" conector="iframe" idregistro="'.$iddoc.'"><i class="icon-trash"></i></button>

  </div>';
$texto.=barra_estandar_documento($iddoc,$funcionario);
return((str_replace("\\r","",str_replace("\\n","",$texto))));
}
function barra_inferior_documentos_noactivos($iddoc,$numero){
$dato_prioridad=busca_filtro_tabla("","prioridad_documento","documento_iddocumento=".$iddoc,"fecha_asignacion DESC",$conn);
$prioridad="icon-flag";
if($dato_prioridad["numcampos"]){
  switch ($dato_prioridad[0]["prioridad"]) {
    case 1:
      $prioridad='icon-star';
    break;
    case 2:
      $prioridad='icon-star-empty';
	  break;
    default:
      $prioridad='icon-flag';
    break;
  }
}
$tarea="icon-check";
$dato_leido=documento_leido($iddoc);
$texto.='<div class="btn-group pull-left" >
  <button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Activar documento" enlace="activar_documentofunc.php?func=1&key='.$iddoc.'" conector="iframe" idregistro="'.$iddoc.'"><i class="icon-ok"></i></button>

  </div>';
$texto.=barra_estandar_documento($iddoc,$funcionario);
return(str_replace("\\r","",str_replace("\\n","",$texto)));
}
function exportar_excel(){
    global $conn;
    $texto='<li class="divider-vertical"></li><li><div class="btn-group">
          <button class="btn btn-mini btn-primary exportar_listado_saia pull-left" enlace="pantallas/documento/busqueda_avanzada_documento.php" title="Exportar reporte" id="boton_exportar_excel" style="display:none">Exportar a excel</button></div></li><li id="barra_exp_ppal" style="margin-top:5px;margin-left:5px;width:100px"></li>';
    //return($texto);
}
function origen_documento2_excel($doc,$numero,$origen="",$tipo_radicado="",$estado="",$serie="",$tipo_ejecutor=""){
$ruta="";
$numero=intval($numero);
if(in_array($estado,array("GESTION","CENTRAL","HISTORICO"))!==FALSE || $tipo_radicado==1 || $tipo_radicado==2){
	$docu=busca_filtro_tabla("lower(plantilla) as plantilla, nombre_tabla","documento A, formato B","A.iddocumento=".$doc." AND lower(plantilla)=lower(B.nombre)","",$conn);
	if($docu[0]["plantilla"]=='radicacion_entrada'||$docu[0]["plantilla"]=='radicacion_salida'||$docu[0]["plantilla"]=='radicacion_peticiones'){
		$remitente=busca_filtro_tabla("",$docu[0]["nombre_tabla"]." A, datos_ejecutor B, ejecutor C","persona_natural=B.iddatos_ejecutor AND ejecutor_idejecutor=idejecutor AND A.documento_iddocumento=".$doc,"",$conn);

		$texto=ucwords(strtolower($remitente[0]["nombre"]));
	}
  elseif($tipo_ejecutor==1&&$tipo_radicado==1){
		$datos_ejecutor=busca_filtro_tabla("A.plantilla,B.ejecutor_idejecutor","documento A,datos_ejecutor B","A.ejecutor=B.iddatos_ejecutor and A.iddocumento=".$doc,"",$conn);
		$ejecutor=busca_filtro_tabla("nombre","ejecutor","idejecutor=".$datos_ejecutor[0]["ejecutor_idejecutor"],"",$conn);
  	if($ejecutor["numcampos"]&&$datos_ejecutor[0]["plantilla"]==""){
  		$ruta=$ejecutor[0]["nombre"];
  	}
  	else{
    	$ruta="Error al buscar remitente";
  	}
	}
	else{
		$tipo=busca_filtro_tabla("origen,tipo_origen","ruta r","r.tipo='ACTIVO' and r.obligatorio=1 and r.documento_iddocumento=".$doc,"idruta desc",$conn);

    if($tipo[0]['tipo_origen']==1)
      $remitente=busca_filtro_tabla("B.nombres, B.apellidos,funcionario_codigo","funcionario B","B.funcionario_codigo=".$tipo[0]['origen'],"idruta desc",$conn);
    elseif($tipo[0]['tipo_origen']==5)
      $remitente=busca_filtro_tabla("B.nombres, B.apellidos,funcionario_codigo","funcionario B,dependencia_cargo dc","dc.funcionario_idfuncionario=idfuncionario and dc.iddependencia_cargo=".$tipo[0]['origen'],"",$conn);

  $adicional="";
  if($remitente["numcampos"]){
  	$confirmado=busca_filtro_tabla("","buzon_salida","nombre in('APROBADO','REVISADO') and archivo_idarchivo=$doc and origen=".$remitente[0]["funcionario_codigo"],"",$conn);

    if(!$confirmado["numcampos"])
      $adicional="(Pendiente)";
  }
  else
  	$remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);

	$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"].$adicional;
	}
  if($remitente["numcampos"]){
    $ruta=$texto;
  }
}
else{
  $ruta=busca_filtro_tabla("r.tipo_origen,r.idruta,r.origen","ruta r","r.tipo='ACTIVO' and r.obligatorio=1 and r.documento_iddocumento=".$doc,"idruta desc",$conn);
  $adicional="";
  if($ruta["numcampos"]){
    switch($ruta[0]["tipo_origen"]){
      case 5:
        $campo="iddependencia_cargo";
      break;
      default:
        $campo="funcionario_codigo";
      break;
    }
    $remitente=busca_filtro_tabla("","vfuncionario_dc",$campo."=".$ruta[0]["origen"],"",$conn);
    //return(implode("<br />",$remitente[0]));
    $confirmado=busca_filtro_tabla("","buzon_salida","nombre in('APROBADO','REVISADO') and archivo_idarchivo=$doc and origen=".$remitente[0]["funcionario_codigo"],"",$conn);

     if(!$confirmado["numcampos"])
       $adicional=" (Pendiente)";
    }
  else
    $remitente=busca_filtro_tabla("B.nombres, B.apellidos","documento A,funcionario B","A.ejecutor=B.funcionario_codigo AND A.iddocumento=".$doc,"",$conn);

$texto=$remitente[0]["nombres"]." ".$remitente[0]["apellidos"].$adicional;
  if($remitente["numcampos"]){
    $ruta=$texto;
  }
}
if(!$ruta){
	if($tipo_ejecutor==1&&$tipo_radicado==1){
		$datos_ejecutor=busca_filtro_tabla("A.plantilla,B.ejecutor_idejecutor","documento A,datos_ejecutor B","A.ejecutor=B.iddatos_ejecutor and A.iddocumento=".$doc,"",$conn);
		$ejecutor=busca_filtro_tabla("nombre","ejecutor","idejecutor=".$datos_ejecutor[0]["ejecutor_idejecutor"],"",$conn);

	}
	if($ejecutor["numcampos"]&&$datos_ejecutor[0]["plantilla"]==""){
		$ruta=$ejecutor[0]["nombre"];
	}
	else{
    	$ruta="Error al buscar remitente";
	}
}
return(str_replace('"'," ",str_replace("'"," ",$ruta)));
}

function obtener_pantilla_documento($plantilla){
	global $conn;

	return(nombre_plantilla($plantilla));
}
function obtener_descripcion($descripcion){
    return (delimita(strip_tags($descripcion), 150));
}
function obtener_iddocumento(){
    return($_REQUEST['iddocumento']);
}
function mostrar_prioridad_tareas($prioridad){
    switch ($prioridad) {
        case 0:
            return("Baja");
        break;
        case 1:
            return("Media");
        break;
        case 2:
            return("Alta");
        break;
    }
}
/*function distribucion_interna_doc(){
	global $ruta_db_superior;
  $texto='<li><a href="#" id="distribucion_interna_doc">Despacho f&iacute;sico</a></li>';
  $texto.='<script>
    $("#distribucion_interna_doc").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	enlace_katien_saia("pantallas/documento/despachar_fisico.php?docs="+docus+",","Despachar documentos","iframe","");
	  }
	  else{
	  	alert("Seleccione por lo menos un documento");
	  }
    });
  </script>';
  //return $texto;
}*/


function filtro_despacho(){
	global $ruta_db_superior;
	
	if($_REQUEST['variable_busqueda'] && $_REQUEST['variable_busqueda']!='' ){
		$docs=busca_filtro_tabla("","documento,ft_despacho_ingresados","documento_iddocumento=iddocumento and estado not in ('ELIMINADO','ANULADO') and numero=".$_REQUEST['variable_busqueda'],"",$conn);
		if($docs['numcampos']){
			$where=" and iddocumento in(".$docs[0]['docs_seleccionados'].")";
		}else{
			$where=" and iddocumento in(0)";
		}
		return($where);
	}
}
function carga_soporte_ingresados($iddocumento){
	global $ruta_db_superior;
	if(isset($_REQUEST['variable_busqueda'])){
		$texto='<li><a href="#" id="cargar_soporte">Cargar soporte</a></li>';
		$texto.='<script>
		  $("#cargar_soporte").click(function(){	    	
		    var docus=$("#seleccionados").val();
			  if(docus!=""){			  	
						top.hs.htmlExpand(this, { objectType: "iframe",width: 400, height: 300, src:"http://'.RUTA_PDF.'/formatos/despacho_ingresados/anexos_despacho.php?docs="+docus,outlineType: "rounded-white",wrapperClassName:"highslide-wrapper drag-header"});
			  }else{
			  	alert("Seleccione por lo menos un documento");
			  }
		   });
		</script>';
		return $texto;
	}
}



function vincular_documentos_busqueda(){
	 global $ruta_db_superior;
  $texto='<li><a href="#" id="distribucion_interna_doc">Despacho fisico</a></li>';
  $texto.='<script>
    $("#distribucion_interna_doc").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	enlace_katien_saia("pantallas/documento/despachar_fisico.php?docs="+docus+",","Despachar documentos","iframe","");
	  }
	  else{
	  	alert("Seleccione por lo menos un documento");
	  }
    });
  </script>';
  return $texto;
}
function iddoc_distribuidos(){
  global $conn;
  $distribuidos=busca_filtro_tabla("docs_seleccionados","ft_despacho_ingresados","","",$conn);
  $iddoc=array();

  if($distribuidos['numcampos']){
    for ($i=0; $i < $distribuidos['numcampos']; $i++) {
      $tmp=explode(",",$distribuidos[$i]['docs_seleccionados']);
      $iddoc=array_merge($iddoc,$tmp);
    }
  }

  $iddoc=array_unique($iddoc);
  $iddoc=array_values($iddoc);
  $cantidad=count($iddoc);
  $where='';
  $where.="(";
  for($i=0;$i<$cantidad;$i++){
    if($i==0){
      $where.="(iddocumento like '".$iddoc[$i]."')";
    }else{
      $where.=" OR (iddocumento like '".$iddoc[$i]."')";
    }
  }
  $where.=")";
  return($where);
}

function iddoc_no_distribuidos(){
  global $conn;
  $distribuidos=busca_filtro_tabla("docs_seleccionados","ft_despacho_ingresados","","",$conn);
  
  $iddoc=array();

  if($distribuidos['numcampos']){
    for ($i=0; $i < $distribuidos['numcampos']; $i++) {
      $tmp=explode(",",$distribuidos[$i]['docs_seleccionados']);
      $iddoc=array_merge($iddoc,$tmp);
    }
  }
   
  $iddoc=array_unique($iddoc);
  $iddoc=array_values($iddoc);
  $cantidad=count($iddoc);
  $where='';
  $where.="(";
  for($i=0;$i<$cantidad;$i++){
    if($i==0){
      $where.="(iddocumento <>'".$iddoc[$i]."')";
    }else{
      $where.=" AND (iddocumento <> '".$iddoc[$i]."')";
    }
  }
  $where.=")";
  return($where);
}
function mostrar_fecha_limite_documento($fecha_limite){
	global $conn;
	
	if($fecha_limite=='fecha_limite'){
		$fecha_limite='Sin definir';
	}
	
	return('<div class="pull-right"><b>Vence:</b> '.$fecha_limite.'</div>');
	
}

?>
