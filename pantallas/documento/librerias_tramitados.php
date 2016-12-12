<?php
function despachar_doc(){
	global $ruta_db_superior;
  $texto='<li><a href="#" id="despachar_documentos">Despacho por gu&iacute;a</a></li>';
  $texto.='<script>
    $("#despachar_documentos").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	enlace_katien_saia("despachar.php?docs="+docus+",","Despachar documentos","iframe","");
	  }
	  else{
	  	//alert("Seleccione por lo menos un documento");
	  	notificacion_saia("<b>ATENCI&Oacute;N</b><br>Seleccione por lo menos un documento","warning","",4000);
	  }
    });
  </script>';
  return $texto;
}
function despachar_fisico_doc(){
	global $ruta_db_superior;
  $texto='<li><a href="#" id="despachar_fisico_documentos">Despacho f&iacute;sico</a></li>';
  $texto.='<script>
    $("#despachar_fisico_documentos").click(function(){
      var docus=$("#seleccionados").val();
	  if(docus!=""){
	  	//enlace_katien_saia("pantallas/documento/despachar_fisico.php?docs="+docus+",","Despachar documentos","iframe","");
			enlace_katien_saia("formatos/despacho_fisico/adicionar_despacho_fisico.php?docs="+docus+",","Despachar documentos","iframe","");
	  }
	  else{
	  	notificacion_saia("<b>ATENCI&Oacute;N</b><br>Seleccione por lo menos un documento","warning","",4000);
	  }
    });
  </script>'; 
  return $texto;
}
function planilla_control(){
  global $ruta_db_superior;
  $texto='<li><a href="#" id="planilla_control">Entrega Interna</a></li>';
  $texto.='<script>
    $("#planilla_control").click(function(){
      var docus=$("#seleccionados").val();
    if(docus!=""){
      //enlace_katien_saia("pantallas/documento/planilla_control.php?docs="+docus+",","Entrega Interna","iframe","");
      enlace_katien_saia("formatos/despacho_ingresados/adicionar_despacho_ingresados.php?docs="+docus+",","Entrega Interna","iframe","");
    }
    else{
      alert("Seleccione por lo menos un documento");
    }
    });
  </script>';
  return $texto;
}
function filtrar_despachados(){
	$texto='<li><a href="#" id="filtrar_despachados">Filtrar despachados</a></li>
	<li><a href="#" id="restaurar_despachados">Restaurar listado</a></li>
	';
  $texto.='<script>
    $("#filtrar_despachados").click(function(){
      $(".sin_despacho_documentos").parent().parent().hide();
    });
	$("#restaurar_despachados").click(function(){
      $(".sin_despacho_documentos").parent().parent().show();
    });
  </script>';
  return $texto;
}
function no_guia($iddoc){
	$despacho=busca_filtro_tabla("A.numero_guia,B.tipo_despacho","salidas A, documento B","B.iddocumento=".$iddoc." AND A.documento_iddocumento=B.iddocumento","",$conn);
	
  if($despacho["numcampos"] && ($despacho[0]["tipo_despacho"]==1 || $despacho[0]["tipo_despacho"]==2 || $despacho[0]["tipo_despacho"]==3)){
	$texto.='<div class="despachados_documentos"></div>';
    switch($despacho[0]["tipo_despacho"]){
      case 1://mensajeria Externa genera salida 
        $texto=("<b>Guia:</b> ".$despacho[0]["numero_guia"]);
      break;
      case 2://Mensajeria Interna enviada con mensajero.
        $texto=("Mensajeria interna");
      break;  
      case 3: //Personal enviada con el ejecutor.
        $texto=("Personal");
      break;     
    }  
  }
  else{
	  $doc=busca_filtro_tabla("A.numero","documento A","A.iddocumento=$iddoc","",$conn);
	  if($doc["numcampos"] && !$doc[0]["numero"]){
	    $texto=("En Tr&aacute;mite");
	    }
	  $texto.='<div class="sin_despacho_documentos"></div>';
  }
  return ($texto);
}
function barra_inferior_documento_tramitados($iddoc,$numero){
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
$dato_leido=documento_leido($iddoc);
$texto.='<div class="btn-group pull-left" >
  <button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" onClick=" " enlace="pantallas/documento/detalles_documento.php?iddoc='.$iddoc.'&idbusqueda_componente='.$_REQUEST["idbusqueda_componente"].'" titulo="Detalle Doc No.'.$numero.'" conector="iframe" idregistro="'.$iddoc.'"ancho_columna="470" eliminar_hijos_kaiten="1">
    <i class="'.$dato_leido[1].'"></i>
  </button>
  <button type="button" class="btn btn-mini dropdown-toggle tooltip_saia" data-toggle="dropdown" titulo="Prioridad">
    <i class="'.$prioridad.'" id="prioridad_'.$iddoc.'" prioridad="'.$dato_prioridad[0]["prioridad"].'"></i><span class="caret"></span>
  </button> 
    <ul class="dropdown-menu">
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="1"><i class="icon-star"></i> Importante</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="2"><i class="icon-star-empty"></i> Destacada</a></li>
      <li><a href="#" idregistro="'.$iddoc.'" class="documento_prioridad" prioridad="0"><i class="icon-flag"></i>Normal</a></li>
    </ul>
  <button type="button" class="btn btn-mini tooltip_saia adicionar_seleccionados" titulo="Seleccionar" idregistro="'.$iddoc.'">
    <i class="icon-uncheck"></i>
  </button>';
  $texto.=impresion_doc($iddoc);
  $texto.='</div>';
$texto.=barra_estandar_documento($iddoc,$funcionario);
return((str_replace("\\r","",str_replace("\\n","",$texto))));
}
function impresion_doc($iddoc){
	$plantilla=busca_filtro_tabla("lower(plantilla) as plantilla","documento a","a.iddocumento=".$iddoc,"",$conn);
	$texto.='<button onclick="window.open(this.value,this.title);" value="../../html2ps/public_html/demo/html2ps.php?iddoc='.$iddoc.'&plantilla='.$plantilla[0]["plantilla"].'" title="_blank"><i class="icon-print"></i></button>';
	return ($texto);
}
function usuario_aprobador_tramitados($iddocumento){
	global $conn;
	$buzon_salida=busca_filtro_tabla("B.nombres,B.apellidos","buzon_salida A, funcionario B","A.archivo_idarchivo=".$iddocumento." AND nombre='APROBADO' AND A.origen=B.funcionario_codigo","",$conn);
	return(ucwords(strtolower($buzon_salida[0]["nombres"]." ".$buzon_salida[0]["apellidos"])));
}
function destino_remitente($iddocumento,$plantilla){
	global $conn,$datos_remitente;
	if(strtolower($plantilla)=='radicacion_salida'){
		$campo="persona_natural";
	}
	if(strtolower($plantilla)=='carta'){
		$campo="destinos";
	}
	$campo_remitente=busca_filtro_tabla($campo,"ft_".strtolower($plantilla)." A","A.documento_iddocumento=".$iddocumento,"",$conn);
	$datos_remitente=busca_filtro_tabla("B.nombre,A.*","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor IN (".$campo_remitente[0][$campo].")","",$conn);
	$nombres=extrae_campo($datos_remitente,"nombre");
	return(ucwords(strtolower(implode(",",$nombres))));
}
function direccion_destino_remitente($iddocumento){
	global $conn,$datos_remitente;
	$nombres=extrae_campo($datos_remitente,"direccion");
	return(ucwords(strtolower(implode(",",$nombres))));
}
function telefono_destino_remitente($iddocumento){
	global $conn,$datos_remitente;
	$nombres=extrae_campo($datos_remitente,"telefono");
	return(ucwords(strtolower(implode(",",$nombres))));
}
function ciudad_destino_remitente($iddocumento){
	global $conn,$datos_remitente;
	$ciudades=extrae_campo($datos_remitente,"ciudad");
	$municipios=busca_filtro_tabla("A.nombre","municipio A","A.idmunicipio in(".implode(",",$ciudades).")","",$conn);
	$nombres=extrae_campo($municipios,"nombre");
	return(ucwords(strtolower(implode(",",$nombres))));
}
function recibido_por($iddocumento){
	
}
function recibido_fecha_por($iddocumento){
	
}
function recibido_hora_por($iddocumento){
	
}
function retornar_fecha_hoy(){
	return(date('Y-m-d'));
}
function mostrar_campo_salida($iddocumento,$campo){
	global $conn;
	$dato=busca_filtro_tabla($campo,"ft_radicacion_salida A","A.documento_iddocumento=".$iddocumento,"",$conn);
	$series=busca_filtro_tabla("A.nombre","serie A","A.idserie in(".$dato[0][$campo].")","",$conn);
	$etiquetas=extrae_campo($series,"nombre","m");
	return(implode(", ",$etiquetas));
}
function remitente_entrada($iddocumento){
	global $conn;
	$datos=busca_filtro_tabla("A.persona_natural","ft_radicacion_entrada A","A.documento_iddocumento=".$iddocumento,"",$conn);
	$datos_ejecutor=busca_filtro_tabla("B.nombre,B.identificacion","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos[0]["persona_natural"],"",$conn);
	$texto=$datos_ejecutor[0]["nombre"];
	return($texto);
}
function registrar_despacho(){
	global $conn;
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
	
	$documentos=explode(",",@$_REQUEST["docs"]);
	$mensajero=@$_REQUEST["mensajero"];
	$tipo_despacho=2;
	
	$cant=count($documentos);
	for($i=0;$i<$cant;$i++){
		if($documentos[$i]){
			$sql1="INSERT INTO salidas(documento_iddocumento,responsable,fecha_despacho,tipo_despacho,notas) VALUES ($documentos[$i],$mensajero,".fecha_db_almacenar(date("Y-m-d H:i:s"),"Y-m-d H:i:s").",'$tipo_despacho','Despacho realizado por despacho fisico.')";
			phpmkr_query($sql1);
		}
	}
}
if(@$_REQUEST["ejecutar_accion"]){
	$_REQUEST["ejecutar_accion"]();
}
?>