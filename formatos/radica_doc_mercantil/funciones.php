<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

//ADICIONAR - EDITAR
//******************************
function carga_lista_anexos_fisicos($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("","serie A","A.cod_padre=982","",$conn);	

	$lista_anexos="<td><select name='anexos_fisicos_radi' id='anexos_fisicos_radi'>";
  $lista_anexos.="<option value='' selected>Por favor seleccione...</option>";
  for($i=0;$i<$datos['numcampos'];$i++){
    $lista_anexos.="<option value='".$datos[$i]['idserie']."'>".$datos[$i]['nombre']."</option>";
  }
  $lista_anexos.="</select></td>";
  echo ($lista_anexos);
}

function cargar_lista_solicitud_servicio($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("A.idft_solicitud_servicio, A.asunto_solicitud, A.serie_idserie, B.numero","ft_solicitud_servicio A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado NOT IN('ELIMINADO','ANULADO','ACTIVO')","",$conn);

	$lista_solicitud="<td><select name='numero_solicitud' id='numero_solicitud' class='required'>";
  $lista_solicitud.="<option value='' selected>Por favor seleccione...</option>";
  for($i=0;$i<$datos['numcampos'];$i++){
		$serie=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[$i]['serie_idserie'],"",$conn);
    $lista_solicitud.="<option value='".$datos[$i]['idft_solicitud_servicio']."'>".$datos[$i]['numero']." - ".$datos[$i]['asunto_solicitud']." - ".$serie[0]['nombre']."</option>";
  }
  $lista_solicitud.="</select></td>";
  echo ($lista_solicitud);
?>
	<script type="text/javascript">
		$(document).ready(function(){
			//Oculto campo Solicitud Seleccionada
			$("#numero_solici_selec").parent().parent().hide();
			
			$("#numero_solicitud").change(function(){
				$("#numero_solicitud option:selected").each(function () {
					var seleccionado = "";
					if($(this).val()){						
						seleccionado = $(this).text();
						$("#numero_solici_selec").attr("value",seleccionado);
					}else{						
						$("#numero_solici_selec").attr("value","");
					}
				});
			});
		});
	</script>
<?php
}/**/

//POSTERIOR AL ADICIONAR
//******************************
function genera_colilla_servicios($idformato,$iddoc){
	global $conn;
  $enlace="busqueda_categoria.php?idcategoria_formato=1&defecto=radica_doc_mercantil";
  abrir_url($ruta_db_superior."colilla.php?key=".$iddoc."&enlace=".$enlace,'_self');
}

//MOSTRAR
//******************************
function mostrar_fecha_mercantil($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla(fecha_db_obtener("A.fecha_radicacion_doc","d-m-Y h:i")." AS fecha_radicacion_doc,".fecha_db_obtener("A.fecha_radicacion_doc","H")." AS horas","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	if($datos[0]['horas']>=12){
		$hora=" PM";
	}else{
		$hora=" AM";
	}
	
	echo($datos[0]['fecha_radicacion_doc'].' '.$hora);
	
}

function mostrar_anexo_fisico_recepcion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.anexos_fisicos_radi","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$anexo_fisico=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[0]['anexos_fisicos_radi'],"",$conn);

	echo($anexo_fisico[0]['nombre']);
}

function mostrar_serie_mercantil($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.serie_idserie","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	$nombre_serie=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos_solicitud[0]['serie_idserie'],"",$conn);
	echo($nombre_serie[0]['nombre']);
}

function mostrar_solicitud_mercantil($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.tipo_solicitud_servi,A.documento_iddocumento","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	
	$idformato_solicitud=busca_filtro_tabla("A.idformato","formato A","A.nombre='solicitud_servicio'","",$conn);
	$solicitud=mostrar_valor_campo("tipo_solicitud_servi",$idformato_solicitud[0]['idformato'],$datos_solicitud[0]['documento_iddocumento'],1);
	echo($solicitud);
}

function mostrar_mercancia_mercantil($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.tipo_mercancia, A.documento_iddocumento","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	$mercancia=explode(",",$datos_solicitud[0]['tipo_mercancia']);
	
	foreach ($mercancia as $value) {		
		switch ($value) {
			case 1:
				$nombre[] ="Cajas";
			break;
			case 2:
				$nombre[] ="Sobres";
			break;
			case 3:
				$nombre[] ="Paquetes";
			break;
		}
	}
	
	echo(implode(",", $nombre));
}

function mostrar_privilegios_mercantil($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.tipo_privilegios, A.documento_iddocumento","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	
	$idformato_solicitud=busca_filtro_tabla("A.idformato","formato A","A.nombre='solicitud_servicio'","",$conn);
	$privilegios=mostrar_valor_campo("tipo_privilegios",$idformato_solicitud[0]['idformato'],$datos_solicitud[0]['documento_iddocumento'],1);
	echo($privilegios);
}

function mostrar_fecha_inicial_afiliacion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	
	$fecha_inicial=busca_filtro_tabla(fecha_db_obtener("MIN(A.fecha_solicitud)","d-m-Y")." AS fecha_solicitud","ft_solicitud_afiliacion A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado NOT IN('ANULADO','ELIMIANDO') AND idft_solicitud_afiliacion in(".$datos_solicitud[0]['fk_idsolicitud_afiliacion'].")","",$conn);
	
	echo($fecha_inicial[0]['fecha_solicitud']);
}

function mostrar_fecha_final_afiliacion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.numero_solicitud","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$datos_solicitud=busca_filtro_tabla("A.fk_idsolicitud_afiliacion","ft_solicitud_servicio A","A.idft_solicitud_servicio=".$datos[0]['numero_solicitud'],"",$conn);
	
	$fecha_final=busca_filtro_tabla(fecha_db_obtener("MAX(A.fecha_solicitud)","d-m-Y")." AS fecha_solicitud","ft_solicitud_afiliacion A, documento B","A.documento_iddocumento=B.iddocumento AND B.estado NOT IN('ANULADO','ELIMIANDO') AND idft_solicitud_afiliacion in(".$datos_solicitud[0]['fk_idsolicitud_afiliacion'].")","",$conn);
	
	echo($fecha_final[0]['fecha_solicitud']);
}

//POSTERIOR AL APROBAR
//***********************
function transferir_destino_recepcion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.destino_doc_mercantil","ft_radica_doc_mercantil A","A.documento_iddocumento=".$iddoc,"",$conn);
	$destino=busca_filtro_tabla("A.funcionario_codigo","funcionario A, dependencia_cargo B","A.idfuncionario=B.funcionario_idfuncionario AND A.estado=1 AND B.estado=1 AND B.iddependencia_cargo=".$datos[0]['destino_doc_mercantil'],"",$conn);
	
	if($destino['numcampos']){
	  transferencia_automatica($idformato,$iddoc,$destino[0]['funcionario_codigo']."@",3);
	}
}
function enlace_solicitud_servicios($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$datos=busca_filtro_tabla("B.documento_iddocumento,A.numero_solici_selec","ft_radica_doc_mercantil A, ft_solicitud_servicio B","A.documento_iddocumento=".$iddoc." AND numero_solicitud=idft_solicitud_servicio","",$conn);
	
	$formato=busca_filtro_tabla("","formato A","A.nombre='solicitud_servicio'","",$conn);
	
	?><script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
  <script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script><?php

	$texto='<a href="'.$ruta_db_superior.'formatos/solicitud_servicio/mostrar_solicitud_servicio.php?idformato='.$formato[0]["idformato"].'&iddoc='.$datos[0]["documento_iddocumento"].'&cargar_highslide=1" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 850, height: 500,contentId:\'cuerpo_paso\', preserveContent:false} )">'.$datos[0]["numero_solici_selec"].'</a>';
	echo($texto);
}
?>