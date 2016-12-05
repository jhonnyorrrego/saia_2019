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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
include_once($ruta_db_superior."formatos/mod_autocomisorio/funciones.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_notificaciones.php");

ini_set('display_errors',true);

function validar_tipo_documento($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	
	if($_REQUEST["iddoc"]){
		$documento_calidad = busca_filtro_tabla("documento_calidad","ft_control_documentos","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
	}
		
?>
<script type="text/javascript">
	$(document).ready(function(){		
		$("#serie_idserie").removeClass('required');
		$("#serie_idserie").parent().parent().hide();
		
		$("input[name='almacenamiento[]']").removeClass('required');
		$("input[name='almacenamiento[]']").parent().parent().parent().parent().parent().parent().parent().hide();
		
		if(parseInt($("input[name='tipo_documento']:checked").val()) === 2){
			$("#tr_serie_doc_control").hide();
			$("#serie_doc_control").removeClass('required');
			$("input[name='otros_documentos']").parent().parent().parent().parent().parent().parent().parent().show();
			$("input[name='otros_documentos']").addClass('required');
		}else{
			$("#serie_idserie").addClass('required');
			$("#serie_idserie").parent().parent().show();
			$("input[name='otros_documentos']").parent().parent().parent().parent().parent().parent().parent().hide();
			$("input[name='otros_documentos']").removeClass('required');
		}
		
		$("input[name='tipo_documento']").click(function(){		
			
			if(parseInt($(this).val()) == 1){
				$("#serie_idserie").addClass('required');
				$("#serie_idserie").parent().parent().show();
				
				
				$("#tr_serie_doc_control").show();
				$("#serie_doc_control").addClass('required');
				
				$("input[name='almacenamiento[]']").addClass('required');
				$("input[name='almacenamiento[]']").parent().parent().parent().parent().parent().parent().parent().show();
				
				$("input[name='otros_documentos']").parent().parent().parent().parent().parent().parent().parent().hide();				
				$("input[name='otros_documentos']").removeClass('required');
				
			}else{
				$("#tr_serie_doc_control").hide();
				$("#serie_doc_control").removeClass('required');
				
				$("#serie_idserie").removeClass('required');
				$("#serie_idserie").parent().parent().hide();
				
				$("input[name='almacenamiento[]']").removeClass('required');
				$("input[name='almacenamiento[]']").parent().parent().parent().parent().parent().parent().parent().hide();
		
				$("input[name='otros_documentos']").parent().parent().parent().parent().parent().parent().parent().show();
				$("input[name='otros_documentos']").addClass('required');
			}
			
			
			
			if((parseInt($(this).val()) === 1 || parseInt($(this).val()) === 2)){
				
				if(parseInt($("input[name='tipo_solicitud']:checked").val()) !== 3){				
					$("input[name='anexo_formato[]']").addClass('required');
				}
				
				$("input[name='anexo_formato[]']").parent().parent().parent().parent().show();
			}else{
				$("input[name='anexo_formato[]']").removeClass('required');
				$("input[name='anexo_formato[]']").parent().parent().parent().parent().hide();
			}			
		});
		
		
		$("input[name='tipo_solicitud']").click(function(){
			
			if(parseInt($(this).val()) == 3){
				$("#serie_idserie").removeClass('required');
				$("input[name='anexo_formato[]']").removeClass('required');
				$("#MultiFile1").parent().parent().parent().hide();				
			}else{								
				$("#MultiFile1").parent().parent().parent().show();
			}
		});		
		
		if(parseInt($("input[name='origen_documento']:checked").val()) === 1){
			$("#version").addClass('required');
			$("#version").parent().parent().show();
			
			$("#vigencia").addClass('required');
			$("#vigencia").parent().parent().show();
		}else{
			$("#version").removeClass('required');
			$("#version").parent().parent().hide();
			
			$("#vigencia").removeClass('required');
			$("#vigencia").parent().parent().hide();
		}
		
		$("input[name='origen_documento']").click(function(){
			
			if(parseInt($(this).val()) == 1){				
				$("#version").addClass('required');
				$("#version").parent().parent().show();
				
				$("#vigencia").addClass('required');
				$("#vigencia").parent().parent().show();								
			}else{								
				$("#version").removeClass('required');
				$("#version").parent().parent().hide();
				
				$("#vigencia").removeClass('required');
				$("#vigencia").parent().parent().hide();
			}
		});
		
		
		var iddoc = "<?php echo($_REQUEST["iddoc"]); ?>";
		
		if(iddoc){
			var documento;
			var proceso;				
			var tipo_solicitud = $("input[name='tipo_solicitud']:checked").val();
			var documento_calidad = "<?php echo($documento_calidad[0]["documento_calidad"]); ?>";
			
			if(parseInt($("input[name='tipo_documento']:checked").val()) == 1){
				documento = 10;
			}else{
				documento = $("input[name='otros_documentos']:checked").val(); 
			}				
			

			if($("select[name='listado_procesos'] option:selected").val()){
				proceso = $("select[name='listado_procesos'] option:selected").val().split('|');
			}else{
				proceso = [0,0];
			}
			
			tree_documento_calidad.deleteChildItems(0);					
			tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud="+tipo_solicitud+"&documento="+documento+"&proceso="+proceso[1]+"&seleccionado="+documento_calidad);
		}
		
	});
</script>
<?php
}

function ruta_aprobacion_control_documentos($idformato, $iddoc){
	global $conn;
	
	$funcionarios_responsables = busca_filtro_tabla("revisado,aprobado","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);
	
	
	$ruta = array();
	//Funcionario que crea el documento
	array_push($ruta,array("funcionario"=>usuario_actual('funcionario_codigo'),"tipo_firma"=>0));	
	
	//Funcionario que revisa 
	array_push($ruta,array("funcionario"=>$funcionarios_responsables[0]['revisado'],"tipo_firma"=>1));	
	
	//Funcionario que aprueba 
	array_push($ruta,array("funcionario"=>$funcionarios_responsables[0]['aprobado'],"tipo_firma"=>1));
	
	//CARGO_FUNCIONAL (aprobador calidad)
	$cf_versionador_calidad=busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'","",$conn);
	array_push($ruta,array("funcionario"=>$cf_versionador_calidad[0]['funcionario_codigo'],"tipo_firma"=>2)); 
	
	if(count($ruta)>1){		
		$radicador_salida=busca_filtro_tabla("origen","buzon_entrada","archivo_idarchivo=".$iddoc,"idtransferencia desc",$conn);
	    array_push($ruta,array("funcionario"=>$radicador_salida[0][0],"tipo_firma"=>0)); 
	    insertar_ruta_cierre_solicitud_calidad($ruta,$iddoc);	 
	    
	    $ruta=busca_filtro_tabla("idruta","ruta","documento_iddocumento=".$iddoc,"idruta ASC",$conn);
	    $sql="DELETE FROM ruta WHERE idruta=".$ruta[0]['idruta'];
	    phpmkr_query($sql);
	}
}


function insertar_ruta_cierre_solicitud_calidad($ruta,$iddoc){
    global $conn;
    for($i=0;$i<count($ruta)-1;$i++){
        if(!isset($ruta[$i]["tipo_firma"])){
            $ruta[$i]["tipo_firma"]=1;
        }
        $sql="insert into ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',1,1,$i,".$ruta[$i]["tipo_firma"].")" ;
        phpmkr_query($sql);
        $idruta=phpmkr_insert_id();
        $sql="insert into buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
        phpmkr_query($sql);
    }
}

function insertar_ruta_aprobacion_control_documentos($ruta,$iddoc){
	global $conn;	
 	for($i=0;$i<count($ruta)-1;$i++){
 		if(!isset($ruta[$i]["tipo_firma"]))
      		$ruta[$i]["tipo_firma"]=1;
    	$sql="insert into ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc','POR_APROBAR',1,1,$i,".$ruta[$i]["tipo_firma"].")" ;			
    	phpmkr_query($sql);
   		$idruta=phpmkr_insert_id();
    	$sql="insert into buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre) values('".$ruta[$i+1]["funcionario"]."','".$ruta[$i]["funcionario"]."','$iddoc',1,1,1,$idruta,'POR_APROBAR')" ;
    	phpmkr_query($sql);
   }
}

function obtener_numero_solicitud($idformato, $iddoc){
	global $conn;
	
	$numero = busca_filtro_tabla("numero","documento","iddocumento=".$iddoc,"",$conn);
	
	echo($numero[0]['numero']);
}

function obtener_nombre_solicitante($idformato, $iddoc){
	global $conn;
	
	$funcionario = busca_filtro_tabla("b.nombres, b.apellidos","documento a, funcionario b","a.ejecutor=b.funcionario_codigo AND a.iddocumento=".$iddoc,"",$conn);
	
	echo(ucwords(strtolower($funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'])));
}

function obtener_fecha_solicitud_control_documento($idformato, $iddoc){
	global $conn;
	
	$fecha = busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d")." as fecha","documento","iddocumento=".$iddoc,"",$conn);
	
	$fecha = date_parse($fecha[0]['fecha']);
	$fecha = $fecha['day'].' '.ucwords(obtener_mes_letra($fecha['month'])).' '.$fecha['year'];
	
	echo($fecha);	
}

function tranferencia_posterios_aprobar($idformato, $iddoc){
	global $conn,$ruta_db_superior;	
	
	//Se comento por la funcion 12317
	/*$profesional_universitario = busca_filtro_tabla("funcionario_codigo","vfuncionario_dc","LOWER(cargo) LIKE 'profesional%universitario%' AND LOWER(dependencia) LIKE'despacho%secretaria%administrativa' AND estado=1 AND estado_dep=1 AND estado_dc=1","",$conn);
	
	if($profesional_universitario[0]['funcionario_codigo']!=usuario_actual("funcionario_codigo")){
		transferencia_automatica($idformato,$iddoc,$profesional_universitario[0]['funcionario_codigo'],3);
	}*/
	
}

function obtener_documento_calidad($idformato, $iddoc){
	global $conn;
	
	$documento_calidad = busca_filtro_tabla("tipo_solicitud,listado_procesos,documento_calidad","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);
	
	$datos_formato = array();	
	
	$proceso = explode("|",$documento_calidad[0]["listado_procesos"]);
	
	switch($proceso[0]){
		case "1":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_proceso a, documento b, formato c","a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=".$proceso[1],"",$conn);
		break;
		case "2":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_macroproceso_calidad as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_macroproceso_calidad a, documento b, formato c","a.documento_idocumento=b.iddocumento AND LOWER(b.plantilla) LIKE(LOWER(c.nombre)) AND a.idft_macroproceso_calidad=".$proceso[1],"",$conn);
		break;	
	}
	
	$datos_formato = explode("|", $documento_calidad[0]["documento_calidad"]);	
	$datos_formato = array(
						"idformato"   => $datos_formato[0],
						"iddocumento" => $datos_formato[1]
					 );	
	
	$formato = busca_filtro_tabla("nombre, nombre_tabla","formato","idformato=".$datos_formato['idformato'],"",$conn);
					
	$etiqueta = strtoupper($proceso[0]["nombre"]."/".$formato[0]["nombre"]);			
				
	if($datos_formato['iddocumento']){
		$documento = busca_filtro_tabla("nombre",$formato[0]["nombre_tabla"]." a","a.documento_iddocumento=".$datos_formato["iddocumento"],"",$conn);			
		$etiqueta .= "/".$documento[0]["nombre"];			
	}
	
	$etiqueta=str_replace("ACUTE", "acute", $etiqueta);
	echo($etiqueta);	
}

function obtener_proceso_vinculado($idformato, $iddoc){
	global $conn;
	
	$proceso = busca_filtro_tabla("listado_procesos","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);	

	$proceso = explode("|",$proceso[0]["listado_procesos"]);	
	
	switch($proceso[0]){
		case "1":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_proceso a, documento b, formato c","a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=".$proceso[1],"",$conn);
		break;
		case "2":
			$proceso = busca_filtro_tabla("a.nombre, a.idft_macroproceso_calidad as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_macroproceso_calidad a, documento b, formato c","a.documento_idocumento=b.iddocumento AND LOWER(b.plantilla) LIKE(LOWER(c.nombre)) AND a.idft_macroproceso_calidad=".$proceso[1],"",$conn);
		break;	
	}
	
	echo($proceso[0]['nombre']);
}

function obtener_version_documento($idformato, $iddoc){
	global $conn;
	
	$documento = busca_filtro_tabla("tipo_solicitud,version","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);	
	
	switch($documento[0]["tipo_solicitud"]){
		case "1":	
			$version = "Se crea la versi&oacute;n ".$documento[0]["version"];		
		break;
		case "2":
			$version = "Pasa de la versi&oacute;n ".($documento[0]["version"]-1)." a la versi&oacute;n ".($documento[0]["version"]);			
		break;			
	}	
	echo($version);
}

function mostrar_anexos_control_documentos($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	
	$anexos = busca_filtro_tabla("B.ruta,B.etiqueta","ft_control_documentos A, anexos B","A.documento_iddocumento=B.documento_iddocumento AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	$anexo = '';
	
	for($i=0; $i < $anexos['numcampos']; $i++){
		$anexo .= "<a href='".$ruta_db_superior.$anexos[$i]['ruta']."'>".$anexos[$i]['etiqueta']."</a>";
	}
	
	echo($anexo);
	
}

function listar_macroprocesos_and_procesos($idformato,$iddoc){
	global $conn,$ruta_db_superior;	
	
	$procesos=busca_filtro_tabla("","ft_proceso a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO', 'ANULADO') and a.estado<>'INACTIVO'","nombre ASC",$conn);
	
	$macros=busca_filtro_tabla("","ft_macroproceso_calidad a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in ('ELIMINADO', 'ANULADO', 'ACTIVO')","nombre ASC",$conn);
	
	if($_REQUEST["iddoc"]){
		$control_documentos = busca_filtro_tabla("listado_procesos","ft_control_documentos","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
	}
	
	
	$texto='';
	
	$texto.='<select name="listado_procesos" id="listado_procesos" class="required"><option value="">Por favor seleccione...</option>';
	
	for($i=0;$i<$procesos["numcampos"];$i++){
	
		if($control_documentos[0]["listado_procesos"] == "1|".$procesos[$i]["idft_proceso"]){
			$texto.='<option value="1|'.$procesos[$i]["idft_proceso"].'" tipo="1" selected>'.$procesos[$i]["nombre"].' (Proceso)</option>';
		}else{
			$texto.='<option value="1|'.$procesos[$i]["idft_proceso"].'" tipo="1">'.$procesos[$i]["nombre"].' (Proceso)</option>';
		}
	}
	for($i=0;$i<$macros["numcampos"];$i++){
		if($control_documentos[0]["listado_procesos"] == "2|".$procesos[$i]["idft_proceso"]){
			$texto.='<option value="2|'.$macros[$i]["idft_macroproceso_calidad"].'" tipo="2" selected>'.$macros[$i]["nombre"].' (Macroproceso)</option>';
		}else{		
			$texto.='<option value="2|'.$macros[$i]["idft_macroproceso_calidad"].'" tipo="2">'.$macros[$i]["nombre"].' (Macroproceso)</option>';
		}
	}
	
	$texto.='</select>';
	
	echo '<td>'.$texto.'</td>';	
?>
<script type="text/javascript">	
	$(document).ready(function(){
		
		$("input[name='tipo_solicitud']").change(function(){
			var documento;
			var proceso;				
			var tipo_solicitud = $(this).val();
			
			if(parseInt($("input[name='tipo_documento']:checked").val()) == 1){
				documento = 10;
			}else{
				documento = $("input[name='otros_documentos']:checked").val(); 
			}				
			
			if($("select[name='listado_procesos'] option:selected").val()){
				proceso = $("select[name='listado_procesos'] option:selected").val().split('|');
			}else{
				proceso = [0,0];
			}
			
			tree_documento_calidad.deleteChildItems(0);					
			tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud="+tipo_solicitud+"&documento="+documento+"&proceso="+proceso[1]);
		})
		
		$("#listado_procesos").change(function(){		
			var documento;
			var proceso        = $(this).val().split('|');
			var tipo_solicitud = $("input[name='tipo_solicitud']:checked").val();
			 
			if(parseInt($("input[name='tipo_documento']:checked").val()) == 1){
				documento = 10;
			}else{
				documento = $("input[name='otros_documentos']:checked").val(); 
			}	
			
			tree_documento_calidad.deleteChildItems(0);					
			tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud="+tipo_solicitud+"&documento="+documento+"&proceso="+proceso[1]);			
		});
		
		
		$("input[name='tipo_documento']").change(function(){
			var documento;
			var proceso;				
			var tipo_solicitud = $("input[name='tipo_solicitud']:checked").val();
			
			if(parseInt($(this).val()) == 1){
				documento = 10;
			}else{
				documento = $("input[name='otros_documentos']:checked").val(); 
			}				
			
			if($("select[name='listado_procesos'] option:selected").val()){
				proceso = $("select[name='listado_procesos'] option:selected").val().split('|');
			}else{
				proceso = [0,0];
			}
			
			tree_documento_calidad.deleteChildItems(0);					
			tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud="+tipo_solicitud+"&documento="+documento+"&proceso="+proceso[1]);
		})		
		
		$("input[name='otros_documentos']").change(function(){
			var documento      = $(this).val();
			var proceso;				
			var tipo_solicitud = $("input[name='tipo_solicitud']:checked").val();			
			
			if($("select[name='listado_procesos'] option:selected").val()){
				proceso = $("select[name='listado_procesos'] option:selected").val().split('|');
			}else{
				proceso = [0,0];
			}
			
			tree_documento_calidad.deleteChildItems(0);					
			tree_documento_calidad.loadXML("<?php echo($ruta_db_superior); ?>formatos/control_documentos/test_documentos_calidad.php?tipo_solicitud="+tipo_solicitud+"&documento="+documento+"&proceso="+proceso[1]);
		})		
	});
</script>
<?php	
}

function mostrar_firma_confirmacion_documento($idformato, $iddoc){
	global $conn;
	
	$fecha_confirmacion = busca_filtro_tabla(fecha_db_obtener("a.fecha_confirmacion","Y-m-d")." as fecha_confirmacion","ft_control_documentos a","a.fecha_confirmacion is not null and a.documento_iddocumento=".$iddoc,"",$conn);
	
	if($fecha_confirmacion["numcampos"]){
		
		$ancho_firma=busca_filtro_tabla("valor","configuracion A","A.nombre='ancho_firma'","",$conn);
		if(!$ancho_firma["numcampos"]){
		$ancho_firma[0]["valor"]=200;	
		}
		$alto_firma=busca_filtro_tabla("valor","configuracion A","A.nombre='alto_firma'","",$conn);
		if(!$alto_firma["numcampos"]){
		$alto_firma[0]["valor"]=100;
		}
		
		$funcionario_codigo = busca_filtro_tabla("funcionario_codigo","funcionario","lower(login) like'lina.alzate'","",$conn);
		//$firma .= "<b>FIRMA COORDINADOR SGC:</b><br />";
		//$firma .= '<img src="http://'.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$funcionario_codigo[0]["funcionario_codigo"].'" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/>.<br />';
		$firma.= "<span style='font-size:12pt;'>FECHA DE TRAMITE Y VIGENCIA DEL DOCUMENTO : ".$fecha_confirmacion[0]["fecha_confirmacion"]."<br />";
		$firma .= "Solicitud procesada satisfactoriamente, por favor socializar con los involucrados en el proceso.</span>";
		
		echo($firma);	
	}
?>
<script>
$(document).ready(function(){
	$("#editar_ruta").hide();
});
</script>
<?php
}


function crear_arbol_procesos_calidad($idformato, $iddoc){
	global $conn, $ruta_db_superior;
}

function almacenar_version_documento($idformato, $iddoc){
	global $conn;
	
	$control_documento = busca_filtro_tabla("tipo_solicitud,listado_procesos,documento_calidad,nombre_documento,origen_documento","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);
			
	$datos_formato = explode("|", $control_documento[0]["documento_calidad"]);	
	$datos_formato = array(
						"idformato"   => $datos_formato[0],
						"iddocumento" => $datos_formato[1]
					 );
					 		
	if($control_documento[0]["tipo_solicitud"] == 2){
		
		if($datos_formato["iddocumento"]) {
			$version = busca_filtro_tabla("b.numero_version","documento a , documento_version b","a.iddocumento  =b.documento_iddocumento and a.iddocumento=".$datos_formato["iddocumento"],"numero_version desc",$conn);		
			
			if($version[0]["numero_version"]){
				$numero_version = $version[0]["numero_version"]+1;
			}else{
				$numero_version = 1;
			}		
			
			$update_version = "UPDATE ft_control_documentos SET version=".$numero_version." WHERE documento_iddocumento=".$iddoc;			
			phpmkr_query($update_version);
			
		}else{				
			notificaciones("<b>No se puede encontrar el documento a ser versionado y modificado. Favor comuniquese a sistemas.</b>","warning",8500);
		}
	}
	
	if($control_documento[0]["tipo_solicitud"] == 1 && $control_documento[0]["origen_documento"]==2){
		$update_version = "UPDATE ft_control_documentos SET version='0' WHERE documento_iddocumento=".$iddoc;			
		phpmkr_query($update_version);
	}
		
}

function aprobar_control_documentos($idformato, $iddoc){
	global $conn,$ruta_db_superior;	
	include_once($ruta_db_superior."class_transferencia.php");
	include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
	if($_REQUEST["activar_accion"]){
							
		$control_documento = busca_filtro_tabla("a.revisado,a.aprobado,a.tipo_solicitud,a.listado_procesos,a.documento_calidad,a.nombre_documento,a.origen_documento,a.version,a.vigencia,b.ejecutor,a.secretaria","ft_control_documentos a, documento b ","a.documento_iddocumento=b.iddocumento and a.documento_iddocumento=".$iddoc,"",$conn);		
		
			
		$datos_formato = explode("|",$control_documento[0]["documento_calidad"]);
		$datos_formato = array(
						"idformato"   => $datos_formato[0],
						"iddocumento" => $datos_formato[1]
					 );			
		
		$proceso = explode("|",$control_documento[0]["listado_procesos"]);
		
		switch($proceso[0]){
			case "1":
				$proceso = busca_filtro_tabla("a.nombre, a.idft_proceso as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_proceso a, documento b, formato c","a.documento_iddocumento=b.iddocumento AND lower(b.plantilla) like(lower(c.nombre)) and a.idft_proceso=".$proceso[1],"",$conn);
			break;
			case "2":
				$proceso = busca_filtro_tabla("a.nombre, a.idft_macroproceso_calidad as idft_tabla, lower(c.nombre_tabla) AS nombre_tabla, c.idformato","ft_macroproceso_calidad a, documento b, formato c","a.documento_idocumento=b.iddocumento AND LOWER(b.plantilla) LIKE(LOWER(c.nombre)) AND a.idft_macroproceso_calidad=".$proceso[1],"",$conn);
			break;	
		}
		
		$url="";		
		
		switch($control_documento[0]["tipo_solicitud"]){
			case 1://Solicitud de elaboracion(Creacion de un nuevo documento)		
					
				$dependencia_creador = busca_filtro_tabla("iddependencia_cargo","vfuncionario_dc","LOWER(NOMBRES) LIKE'%lina%' AND LOWER(APELLIDOS) LIKE'%alzate%' AND estado=1 AND estado_dc=1 AND estado_dep=1","",$conn);				
				if ($datos_formato['idformato']) {
				
					$campos_formato = busca_filtro_tabla("b.nombre, a.nombre as formato, a.nombre_tabla as tabla","formato a, campos_formato b","a.idformato=b.formato_idformato AND b.obligatoriedad=1 AND lower(b.nombre) NOT IN(concat('id',a.nombre_tabla), 'documento_iddocumento', 'encabezado', 'serie_idserie') AND a.idformato=".$datos_formato['idformato'],"b.nombre ASC",$conn);		
					
					$_REQUEST = "";
					
					for($i=0; $i < $campos_formato['numcampos']; $i++){					
						switch($campos_formato[$i]['nombre']){						
							case "dependencia":
								$_REQUEST['dependencia'] = $dependencia_creador[0]["iddependencia_cargo"];
							break;					
							case $proceso[0]["nombre_tabla"]:
								$_REQUEST[$proceso[0]["nombre_tabla"]] = $proceso[0]["idft_tabla"];
							break;					
						}
					}					
					
					$_REQUEST["firma"] = 1;
					$_REQUEST['nombre'] = $control_documento[0]["nombre_documento"];
					$_REQUEST["funcion"] = "radicar_plantilla";
					$_REQUEST["tipo_radicado"] = strtolower($campos_formato[0]['formato']);
					$_REQUEST["tabla"] = strtolower($campos_formato[0]['tabla']);
					$_REQUEST["formato"] = strtolower($campos_formato[0]['formato']);
					$_REQUEST["ejecutor"] = usuario_actual("funcionario_codigo");
					$_REQUEST["secretarias"] = $control_documento[0]["secretaria"];
										
					$_POST=$_REQUEST;				
					
					$iddocumento = radicar_plantilla3();								
					
					if($iddocumento){
										
						$update_documento_creado = "UPDATE ft_control_documentos SET iddocumento_calidad=".$iddocumento.", iddocumento_creado=".$iddocumento." WHERE documento_iddocumento=".$iddoc;				
						phpmkr_query($update_documento_creado);						
						$datos_documento_nuevo = obtener_datos_documento($iddocumento);						

						$formato_ruta = aplicar_plantilla_ruta_documento($datos_documento_nuevo["iddocumento"]);
						$ruta_archivos = ruta_almacenamiento("archivos");
						
						//$fecha_ruta = date("Y-m", strtotime($datos_documento_nuevo["fecha"]));						
						//$ruta_anexos = RUTA_ARCHIVOS.$datos_documento_nuevo["estado"]."/".$fecha_ruta."/".$datos_documento_nuevo["iddocumento"]."/anexos";
						$ruta_anexos = $ruta_archivos . $formato_ruta . "/anexos";
						
						if(!is_dir($ruta_anexos)){				
							if(!crear_destino($ruta_anexos)){
								notificaciones("<b>Error al crear la carpeta del anexo.</b>","warning",8500);
								return(false);			
							}
						}					
						
						$anexos = busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
						
						$array_anexos = array();
													
						for ($i=0; $i < $anexos["numcampos"]; $i++) {
							$nombre_anexo = explode("/", $anexos[$i]['ruta']);
							$nombre_anexo = $nombre_anexo[sizeof($nombre_anexo)-1];	
							
							$ruta_origen  = $ruta_db_superior.$anexos[$i]['ruta'];
							$ruta_destino = $ruta_anexos."/".$nombre_anexo; 					
																
							if(!copy($ruta_origen, $ruta_destino)){
								notificaciones("<b>Error al pasar el anexo ".$anexos[$i]["etiqueta"]." a la carpeta del documento.</b>","warning",8500);											
							}else{								
								$ruta_alm = substr($ruta_destino, strlen($ruta_db_superior));
								$sql_anexo = "INSERT INTO anexos(documento_iddocumento, ruta, tipo, etiqueta, formato, fecha_anexo) VALUES(".$iddocumento.",'".$ruta_alm."','".$anexos[$i]['tipo']."','".$anexos[$i]['etiqueta']."',".$datos_formato['idformato'].",".fecha_db_almacenar(date("Y-m-d"),"Y-m-d").")";							
													
								phpmkr_query($sql_anexo);								
								$idanexo = phpmkr_insert_id();							 
								
								$array_anexos[] = $idanexo;
								
								if(!$idanexo){
									notificaciones("<b>Error al registrar el anexo ".$anexos[$i]["etiqueta"]."</b>","warning",8500);
								}else{
									$permiso_anexo = busca_filtro_tabla("","permiso_anexo","anexos_idanexos=".$anexos[$i]["idanexos"],"",$conn);
									
									$sql_permiso_anexo = "INSERT INTO permiso_anexo(anexos_idanexos, idpropietario, caracteristica_propio, caracteristica_dependencia, caracteristica_cargo, caracteristica_total) VALUES(".$idanexo.",'".$permiso_anexo[0]['idpropietario']."','".$permiso_anexo[0]['caracteristica_propio']."','".$permiso_anexo[0]['caracteristica_dependencia']."','".$permiso_anexo[0]['caracteristica_cargo']."','".$permiso_anexo[0]["caracteristica_total"]."')";					
									phpmkr_query($sql_permiso_anexo);						
									$idpermiso_anexo = phpmkr_insert_id();							
							
									if(!$idpermiso_anexo){
										notificaciones("<b>Error al registrar los permisos del anexo ".$anexos[$i]["etiqueta"]."</b>","warning",8500);
									}									
								}															
							}	
						}						
						
						if(sizeof($array_anexos) <= 0){
							notificaciones("<b>No se adicionaron los anexo al documento <h6>".$control_documento[0]["nombre_documento"]."</h6> favor comuniquese con el administrador del sistema.</b>","warning",8500);
							return(false);
						}
								
						notificaciones("<b>El documento <h6>".$control_documento[0]["nombre_documento"]."</h6> ha sido creado con exito</b>","success",8500);							
						if($control_documento[0]["origen_documento"] == 1){
							$url = "http://".RUTA_PDF."/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=".$iddocumento."&tipo_versionamiento=".$control_documento[0]["tipo_solicitud"]."&version_numero=".$control_documento[0]["version"]."&iddocumento_anexo=".$iddoc."&funcionario_codigo=".usuario_actual("funcionario_codigo");
						}else{
							$url = "http://".RUTA_PDF."/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=".$iddocumento."&tipo_versionamiento=".$control_documento[0]["tipo_solicitud"]."&version_numero=".$control_documento[0]["version"]."&iddocumento_anexo=".$iddoc."&funcionario_codigo=".usuario_actual("funcionario_codigo");
						}											
					}else{						
						notificaciones("<b>No se creo el documento <h6>".$control_documento[0]["nombre_documento"]."</h6> favor comuniquese con el administrador del sistema.</b>","warning",8500);
						return(false);
					}
				}else{
					notificaciones("<b>No se puede encontrar el formato a ser creado.</b><br /> Favor comuniquese con sistemas.","warning",8500);
					return(false);
				}											
			break;
			default:						
				if ($datos_formato["iddocumento"]){	
				    
				    
				
					if($control_documento[0]["origen_documento"] == 1){
										
						$url = "http://".RUTA_PDF."/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=".$datos_formato["iddocumento"]."&iddocumento_anexo=".$iddoc."&tipo_versionamiento=".$control_documento[0]["tipo_solicitud"]."&nombre_documento=".$control_documento[0]["nombre_documento"]."&version_numero=".$control_documento[0]["version"]."&funcionario_codigo=".usuario_actual("funcionario_codigo");
						
						
					}else{
						$url = "http://".RUTA_PDF."/versionamiento/versionar_documentos.php?no_redirecciona=1&iddocumento=".$datos_formato["iddocumento"]."&iddocumento_anexo=".$iddoc."&tipo_versionamiento=".$control_documento[0]["tipo_solicitud"]."&nombre_documento=".$control_documento[0]["nombre_documento"]."&version_numero=".$control_documento[0]["version"]."&funcionario_codigo=".usuario_actual("funcionario_codigo");
					}									
				}else{				
					notificaciones("<b>No se puede encontrar el documento a ser versionado y modificado. Favor comuniquese a sistemas.</b>","warning",8500);
				}			
			break;	
		}
		$url = str_replace(" ", "||", $url);				
		
		
		
		if($url){	
			/**
			 * CURL utilizado para crear la versión del documento 
			 * ejecuta a /saia/versionamiento/versionar_documentos.php
			 */		
			//Se inicializa la instancia del curl
			$ch = curl_init();
		
			//Establecer URL y otras opciones apropiadas
			$datos_session="&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA;
			$url=$url.$datos_session;
			
			
			curl_setopt($ch, CURLOPT_URL, $url);		
			curl_setopt($ch, CURLOPT_HEADER, 0);

			//Capturar la URL y la pasa al navegador
			$response = curl_exec($ch);				
			
			//Cerrar el recurso cURL y liberar recursos del sistema
			curl_close($ch);		
			
			$update = "update ft_control_documentos set fecha_confirmacion=".fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s")." where documento_iddocumento=".$iddoc;
			phpmkr_query($update);	
			
			/*$array_destinos = array();
			$array_destinos[] = $control_documento[0]['ejecutor'];
			$array_destinos[] = $control_documento[0]['revisado'];
			$array_destinos[] = $control_documento[0]['aprobado'];
			
			foreach ($array_destinos as $value) {
				transferencia_automatica($idformato,$iddoc,$value,3,"El documento ".$control_documento[0]["nombre_documento"]." ha sido creado con exito.");	
			}*/					
			redirecciona($ruta_db_superior."formatos/control_documentos/mostrar_control_documentos.php?iddoc=".$iddoc."&idformato=".$idformato);																
		}else{
			if($control_documento[0]["tipo_solicitud"] != 1){
				notificaciones("<b>No se puede optener una URL valida del documento a ser modificado y/o eliminado.<br /> Favor comuniquese a sistemas.</b>","warning",8500);
			}			
		}
	}
}

function confirmar_control_documentos($idformato, $iddoc){
	global $conn,$ruta_db_superior;	

	$estado= busca_filtro_tabla("estado","documento","estado = 'APROBADO' AND iddocumento=".$iddoc,"",$conn);
	
	$fecha_confirmacion = busca_filtro_tabla(fecha_db_obtener("a.fecha_confirmacion","Y-m-d")." as fecha_confirmacion","ft_control_documentos a","a.fecha_confirmacion is not null and a.documento_iddocumento=".$iddoc,"",$conn);
	$boton = "<button class='btn btn-success' id='confirmar_cambios' >Aprobación de la Solicitud</button>";	
	
	if($_REQUEST["tipo"]!=5){
		echo(estilo_bootstrap());
		if($estado["numcampos"]){
			if(!$fecha_confirmacion["numcampos"]){
			    
			    //CARGO_FUNCIONAL (aprobador calidad)
	            $cf_versionador_calidad=busca_filtro_tabla("login","vfuncionario_dc","estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'","",$conn);
			    if(usuario_actual('login')==$cf_versionador_calidad[0]['login']){
			         echo($boton);
			    }
			
			}			
		}
	
		$funcionario=array();
		$responsables=busca_filtro_tabla("destino","buzon_entrada","nombre ='POR_APROBAR' and archivo_idarchivo=".$iddoc,"",$conn);
		for ($i=0; $i <$responsables["numcampos"] ; $i++) { 
			$funcionario[]=$responsables[$i]["destino"];
		}
		
		$estado=busca_filtro_tabla("","documento","estado='ACTIVO' and iddocumento=".$iddoc,"",$conn);
	    //CARGO_FUNCIONAL (aprobador calidad)
	    $cf_versionador_calidad=busca_filtro_tabla("login","vfuncionario_dc","estado=1 AND tipo_cargo=2 AND lower(cargo) LIKE 'aprobador%calidad'","",$conn);		
		if((in_array(usuario_actual("funcionario_codigo"), $funcionario) && $estado["numcampos"]) || (usuario_actual('login')==$cf_versionador_calidad[0]['login'])){
			echo "<button class='btn btn-info dropdown-toggle' id='btn_editar' >Editar</button>";	
		}
	}
		
?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#confirmar_cambios").click(function(){
			var ruta = "<?php echo($ruta_db_superior); ?>formatos/control_documentos/mostrar_control_documentos.php?activar_accion=1&iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";			
			window.location=ruta;
		});
		
		$("#btn_editar").click(function(){
			var ruta = "<?php echo($ruta_db_superior); ?>formatos/control_documentos/editar_control_documentos.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";			
			window.location=ruta;
		});
	});
</script>
<?php
}

function radicar_plantilla3(){ 
   global $conn,$sql,$ruta_db_superior;
    $_REQUEST['aprobacion_externa']=1;
	$valores=array();
	$plantilla="";
	$idformato=0;
	//hace el ejecutor igual al codigo del funcionario logueado actualmente
	if(!@$_POST["ejecutor"]){
		$_POST["ejecutor"]=$_SESSION["usuario_actual"];
	}

    if(@$_POST["formato"]){       
		$plantilla="'".strtoupper($_POST["formato"])."'";
		$formato=busca_filtro_tabla("idformato,nombre_tabla","formato A","A.nombre LIKE '".strtolower($_POST["formato"])."'","",$conn);
		
		if($formato["numcampos"]){
			$idformato=$formato[0]["idformato"];
			$campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND banderas LIKE '%u%'","",$conn);
			
			for($l=0;$l<$campos["numcampos"];$l++){
				if($_REQUEST[$campos[$l]["nombre"]]){
					$dato=busca_filtro_tabla("",$formato[0]["nombre_tabla"],$campos[$l]["nombre"]."=".$_REQUEST[$campo[$l]["nombre"]],"",$conn);
            
					if($dato["numcampos"]){              
						notificaciones("<b>El campo ".$campos[$l]["nombre"]." Debe ser Unico por Favor Vuelva a Insertar la informacion</b>","warning",8500);
						exit(0);
					}
				}  
			}
		}
    }
 	//busco los valores del formulario que van en la tabla documento
    $buscar = phpmkr_query("SELECT A.* FROM documento A WHERE 1=0",$conn);
    $lista_campos = array();
    for($i=0;$i<phpmkr_num_fields($buscar);$i++)
      array_push($lista_campos,strtolower(phpmkr_field_name($buscar,$i)));
    /////////////////////////////////////////////////////////////////////      	  
    $valores=array("fecha"=>fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s'));
    //print_r($_POST);
    //echo("<br />-------<br />");
    foreach($_POST as $key=>$valor){
      if(in_array($key,$lista_campos)&&$key<>"estado"){
        if($valor[0]!="'")
          $valor="'".$valor."'";
        $valores[$key]=$valor;
	   }
    }
    //si le env?o el tipo de radicado 
    if(isset($_POST["serie_idserie"]) && $_POST["serie_idserie"]){
      $valores["serie"]=$_POST["serie_idserie"];
    }
    else $valores["serie"]=0;
    $valores["plantilla"]=$plantilla;
    if(isset($_REQUEST["dependencia"]) && $_REQUEST["dependencia"]<>"")
      $valores["responsable"]=$_REQUEST["dependencia"];      
    if(@$_POST["tipo_radicado"]){  
      $tipo_radicado=busca_filtro_tabla("idcontador","contador","nombre='".$_POST["tipo_radicado"]."'","",$conn);
      if($tipo_radicado["numcampos"]){
        $valores["tipo_radicado"]=$tipo_radicado[0]["idcontador"];
      }  
      else if(isset($formato)&&$formato["numcampos"]){
        $valores["tipo_radicado"]=$formato[0]["contador_idcontador"];
      }
      else $valores["tipo_radicado"]=0;
    }
	
    if(isset($formato) && $formato["numcampos"] && $valores["tipo_radicado"]){
      $tipo_rad=busca_filtro_tabla("","contador","idcontador=".$valores["tipo_radicado"],"",$conn);
      if($tipo_rad["numcampos"])
        $_POST["tipo_radicado"]=$tipo_rad[0]["nombre"];
    }
    else{
    	return "No hay consecutivo";
    }
	
    $valores["numero"]=0;       
    if(isset($_POST["municipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio"];
    else if(isset($_POST["municipio_idmunicipio"]))
        $valores["municipio_idmunicipio"]=$_POST["municipio_idmunicipio"]; 
    else
    {$mun=busca_filtro_tabla("valor","configuracion","nombre='ciudad'","",$conn);
      if($mun["numcampos"])
          $valores["municipio_idmunicipio"]=$mun[0][0];
     else	  
          $valores["municipio_idmunicipio"]=633;
    }	  
    //radico el documento
    //print_r($valores);
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion(NULL,$idformato,"radicar","ANTERIOR");
	
    $_POST["iddoc"]=radicar_documento_prueba(trim($_POST["tipo_radicado"]),$valores,Null);
    $iddoc=$_POST["iddoc"];
	
    include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");  
   $permisos=NULL;    
   cargar_archivo($_POST["iddoc"],$permisos); 
    /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
    llama_funcion_accion($iddoc,$idformato,"radicar","POSTERIOR");

   if(!array_key_exists("destino",$_POST)) 	
        { 
         if($_POST["tabla"]=="encabezado_factura")
         		{$_POST["destino"]=$_POST["revisa"];
      		  }
         else
         		{$_POST["destino"]=$_POST["revisado"];
      		  }
      	}
   //  echo "Request  :"; print_r($_REQUEST); 	
   //  echo "Valores :"; print_r($valores);
   //  die();
    //guardo la relaci?n del documento creado como respuesta con su antecesor
    if(array_key_exists("anterior",$_REQUEST))
      {          
       /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
       llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","ANTERIOR");
       $idbuzon=busca_filtro_tabla("max(A.idtransferencia) as idbuzon","buzon_entrada A","A.archivo_idarchivo=".$_REQUEST["anterior"],"",$conn);
       phpmkr_query("INSERT INTO respuesta(fecha,destino,origen,idbuzon,plantilla) VALUES (".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').",".$_POST["iddoc"].",".$_REQUEST["anterior"].",".$idbuzon[0]["idbuzon"].",".$plantilla.")",$conn);
       $estado_anterior=busca_filtro_tabla("A.estado,B.nombre_tabla","documento A,formato B","A.plantilla=B.nombre AND A.iddocumento=".$_REQUEST["anterior"],"",$conn);       
        if($estado_anterior["numcampos"]){
          if($estado_anterior[0]["estado"]=="ACTIVO"){         
          phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);
          //arreglo con los datos que necesita transferir archivo
          }
          $formato_detalle=busca_filtro_tabla("id".$estado_anterior[0]["nombre_tabla"],$estado_anterior[0]["nombre_tabla"],"documento_iddocumento=".$_REQUEST["anterior"],"",$conn);
          if($formato_detalle["numcampos"])
            $valores[$estado_anterior[0]["nombre_tabla"]]=$formato_detalle[0]["id".$estado_anterior[0]["nombre_tabla"]];
        }
        else
         { $estado_anterior=busca_filtro_tabla("A.estado","documento A","A.iddocumento=".$_REQUEST["anterior"],"",$conn);       
           if($estado_anterior["numcampos"] && $estado_anterior[0]["estado"]=="ACTIVO")          
             phpmkr_query("update documento set estado='TRAMITE' where iddocumento=".$_REQUEST["anterior"],$conn);      
         }       
        $datos["archivo_idarchivo"]=$_REQUEST["anterior"];
        $datos["nombre"]="TRAMITE";
        $datos["tipo_destino"]=1;
        $datos["tipo"]="";
        $destino_tramite[]=usuario_actual("funcionario_codigo");        
        transferir_archivo_prueba($datos,$destino_tramite,"","");
        /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
        llama_funcion_accion($_REQUEST["anterior"],$idformato,"responder","POSTERIOR");
      }     
    $ins_calidad["numcampos"]=0;  
    if(isset($_REQUEST["tabla"]))  
      $ins_calidad=busca_filtro_tabla("*","estructura_calidad","nombre LIKE '".strtolower($_REQUEST["tabla"])."'","",$conn);    
    //guardo los datos del formulario principal del documento (plantilla)
    if($_POST["tabla"]=="scdp")
      phpmkr_query("UPDATE scdp SET documento_iddocumento=".$_POST["iddoc"]." WHERE num_previo=".$_POST["num_previo"],$conn);
    elseif($ins_calidad["numcampos"]){
      $estructuras=explode(",",$_REQUEST["estructura"]);
      foreach($estructuras as $fila){
        $datos_est=explode("#",$fila); 
        $sql_calidad="insert into doc_calidad(documento_iddocumento,estructura_idestructura,cod_padre) values(".$_POST["iddoc"].",".$datos_est[0].",".$datos_est[1].")"; 
        phpmkr_query($sql_calidad,$conn);
      }
      if(!isset($_POST["descripcion"])){
        if(isset($_POST["nombre_".strtolower($REQUEST["tabla"])])){
          $_POST["descripcion"]=$_POST["nombre_".strtolower($REQUEST["tabla"])];
        }
        $_POST["encabezado"]=1;
      }       
    } 
    llama_funcion_accion($iddoc,$idformato,"adicionar","ANTERIOR");
    
    if($_POST["iddoc"])
      $idplantilla=guardar_documento($_POST["iddoc"]);
 	  //die();
    if(!$idplantilla)  
      {alerta("No se ha podido Crear el Formato..");
       phpmkr_query("update documento set estado='ELIMINADO' where iddocumento=".$_POST["iddoc"],$conn);
      } 
    else
    {  
    //si es una factura busco el id de la ruta donde voy
    $formato=busca_filtro_tabla("","formato","nombre_tabla LIKE '".@$_POST["tabla"]."'","",$conn);
    $banderas=array();
    if($formato["numcampos"])
      $banderas=explode(",",$formato[0]["banderas"]);
    //print_r($banderas);
    //arreglo con los datos que necesita transferir archivo
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="BORRADOR";
    $datos["tipo_destino"]=1;
    $datos["tipo"]="";
    $aux_destino[0]=$_SESSION["usuario_actual"];
    if(!isset($adicionales))
      $adicionales="";
    //realizo la primera transferencia del creador de la plantilla para el mismo,
    //para poder editarla antes de enviarla
    transferir_archivo_prueba($datos,$aux_destino,$adicionales,"");
    //para enviarla a los otros destinos si los tiene
    $datos["archivo_idarchivo"]=$_POST["iddoc"];
    $datos["nombre"]="POR_APROBAR";
    $datos["tipo"]="";
    $adicionales["activo"]="1";
    if( (!isset($_POST["firmado"]) || (isset($_POST["firmado"]) && $_POST["firmado"]=="una")))
    {
      //lo transfiero al radicador de salida
      $radicador=busca_filtro_tabla("f.funcionario_codigo","configuracion c,funcionario f","c.nombre='radicador_salida' and f.login=c.valor","",$conn);
      if($radicador["numcampos"]){
        $aux_destino[0]=$radicador[0]["funcionario_codigo"];
        transferir_archivo_prueba($datos,$aux_destino,$adicionales);   
      }      
    }
    elseif(isset($_POST["firmado"]) && $_POST["firmado"]=="varias")
    {
     die();
    }
    if(in_array("e",$banderas)){
      aprobar3($_POST["iddoc"]);
    }   
   llama_funcion_accion($iddoc,$idformato,"adicionar","POSTERIOR"); 
   
   
   aprobar3($_POST["iddoc"]); //apruebo los formatos si o si
   
   return $_POST["iddoc"];
   }
}

function aprobar3($iddoc=0,$url=""){
	//$con=new Conexion("radica_camara");
   //$buscar=new SQL($con->Obtener_Conexion(), "Oracle");
   global $conn;
   $transferir=1;
    if(isset($_REQUEST["iddoc"])&&$_REQUEST["iddoc"])
      $iddoc=$_REQUEST["iddoc"];

   $tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,idformato","documento,contador,formato","idcontador=tipo_radicado and iddocumento=$iddoc and lower(plantilla)=lower(formato.nombre)","",$conn);
   
   $formato=strtolower($tipo_radicado[0]["plantilla"]);
   $registro_actual=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and A.destino=".$_SESSION["usuario_actual"],"A.idtransferencia",$conn);
       
   /*Se adiciona esta linea para las ejecutar las acciones sobre los formatos*/
   llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","ANTERIOR");
   if($registro_actual["numcampos"]>0)
      {$registro_anterior=busca_filtro_tabla("A.*","buzon_entrada A","A.nombre='POR_APROBAR' and A.activo=1 and A.idtransferencia<".$registro_actual[0]["idtransferencia"]." and A.archivo_idarchivo=".$iddoc." and origen=".$_SESSION["usuario_actual"],"A.idtransferencia desc",$conn);
       $terminado=busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.nombre='POR_APROBAR' and A.activo=1","A.idtransferencia",$conn);
	   
	   
     //realizar la transferencia
      if($registro_actual["numcampos"]>0 && $registro_anterior["numcampos"]==0)
        {
          $destino=$registro_actual[0]["destino"];
          $origen=$registro_actual[0]["origen"]; 
          //cambie count($terminado)
          
          if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"]))
              $estado="APROBADO";
          else
              $estado="REVISADO"; 
          $campos="archivo_idarchivo,nombre,origen,fecha,destino,tipo,tipo_origen,tipo_destino,ruta_idruta";
          //buzon de salida
         for($i=0;$i<$registro_actual["numcampos"];$i++)
            {
              //--------------Actualizacion para cuando se cree una ruta se le pueda mandar a una misma persona-----------
              $registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);             
              if($registro_intermedio["numcampos"])
                  break;              
             $valores=$iddoc.",'$estado',".$registro_actual[$i]["destino"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["origen"].",'DOCUMENTO',1,1";
             if($registro_actual[$i]["ruta_idruta"]<>"")
              $valores.=",".$registro_actual[$i]["ruta_idruta"];
             else
              $valores.=",''"; 
             phpmkr_query("INSERT INTO buzon_salida (".$campos.") VALUES (".$valores.")",$conn);
             //buzon de entrada
             phpmkr_query("UPDATE buzon_entrada SET activo=0 WHERE idtransferencia=".$registro_actual[$i]["idtransferencia"],$conn);
             $valores=$iddoc.",'$estado',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1,";
            }                            
          if($registro_actual[0]["ruta_idruta"]<>"")
            $valores.=$registro_actual[0]["ruta_idruta"];
          else
            $valores.="''";   
          //reviso si la ruta es restrictiva
          if($registro_actual[0]["ruta_idruta"]>0)
           {$restrictiva=busca_filtro_tabla("restrictivo","ruta","idruta=".$registro_actual[0]["ruta_idruta"],"",$conn);
            if($restrictiva["numcampos"] && $restrictiva[0]["restrictivo"]==1)
              {//busco cuantos faltan por aprobar si es restrictiva
               $cuantos_faltan=busca_filtro_tabla("count(idtransferencia) as cuantos","buzon_entrada","nombre='POR_APROBAR' and activo=1 and ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=".$_REQUEST["iddoc"],"",$conn);
               if($cuantos_faltan[0]["cuantos"])
                  {$valores=$iddoc.",'VERIFICACION',$origen,".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",$destino,'DOCUMENTO',1,1";
                   if($registro_actual[$i]["ruta_idruta"]<>"")
                    $valores.=",".$registro_actual[$i]["ruta_idruta"];
                   else
                    $valores.=",''"; 
                   phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);
                   if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"])
                 {  
                   $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);
                   $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
                   $x_tipo_envio[] = 'msg';
                   $x_tipo_envio[] = 'e-interno';                         
                   $destino_mns[0] = $registro_actual[$i]["origen"];             
                   //enviar_mensaje("origen",$destino_mns,$mensaje);
                  }
                   $transferir=0;
                  }
               else
                  {$update="update buzon_entrada set nombre='TRANSFERIDO' where ruta_idruta=".$registro_actual[0]["ruta_idruta"]." and archivo_idarchivo=$iddoc and nombre='VERIFICACION'"; 
                   phpmkr_query($update,$conn);
                   $transferir=1;
                  }   
              }
           }
         if($transferir==1)
            {
             for($i=0;$i<$registro_actual["numcampos"];$i++)
                {
                  $registro_intermedio= busca_filtro_tabla("A.*","buzon_entrada A","A.archivo_idarchivo=".$iddoc." and A.activo=1 and (A.nombre='POR_APROBAR') and idtransferencia<".$registro_actual[$i]["idtransferencia"],"A.idtransferencia",$conn);             
              if($registro_intermedio["numcampos"])
                  break;                  
                  $valores=$iddoc.",'$estado',".$registro_actual[$i]["origen"].",".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",".$registro_actual[$i]["destino"].",'DOCUMENTO',1,1,";
                 if($registro_actual[$i]["ruta_idruta"]<>"")
                    $valores.=$registro_actual[$i]["ruta_idruta"];
                 else
                    $valores.="''";    
                 phpmkr_query("INSERT INTO buzon_entrada(".$campos.") VALUES (".$valores.")",$conn);
                 procesar_estados($registro_actual[$i]["destino"],$registro_actual[$i]["origen"],$estado,$iddoc);
                 if($registro_actual[$i]["origen"] != $registro_actual[$i]["destino"])
                 { 
                  $documento_mns = busca_filtro_tabla("descripcion,plantilla","documento","iddocumento=$iddoc","",$conn);
                  $mensaje = "Tiene un nuevo documento para su revision: Tipo: ".ucfirst($documento_mns[0]["plantilla"])." - Descripcion: ".$documento_mns[0]["descripcion"];
                  $x_tipo_envio[] = 'msg';
                  $x_tipo_envio[] = 'e-interno';      
                  $destino_mns[0] = $registro_actual[$i]["origen"];                               
                  //enviar_mensaje("origen",$destino_mns,$mensaje,$x_tipo_envio);   
                 }
                }
            }
          if(($terminado["numcampos"]==$registro_actual["numcampos"]) || ($terminado["numcampos"]==1 && $terminado[0]["destino"]==$_SESSION["usuario_actual"]))
              {llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","ANTERIOR");
               $tipo_radicado=busca_filtro_tabla("documento.*,contador.nombre,plantilla,idformato","documento,contador,formato C","idcontador=tipo_radicado and iddocumento=$iddoc AND lower(plantilla)=lower(C.nombre)","",$conn);
            
               if($tipo_radicado[0]["numero"]==0)
                  {$numero=contador_($tipo_radicado[0]["nombre"]); 
                 
                   phpmkr_query("UPDATE documento SET estado='APROBADO',numero=".$numero[0]["consecutivo"].", fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);
                  }
               else
                   phpmkr_query("UPDATE documento SET estado='APROBADO',activa_admin=0, fecha=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." WHERE iddocumento=".$iddoc,$conn);               
              // Para los casos de los formatos mensajes (e-mail)
               if($tipo_radicado[0]["plantilla"]=='MENSAJE')
               {                
                require("email/email_doc.php");                                
                enviar_email($iddoc);
               }
                              //si el formato tiene el campo de la fecha con el nombre predeterminado lo actualizo tambien    

              $nombre_tabla=busca_filtro_tabla("nombre_tabla,banderas","formato","nombre like '$formato'","",$conn);
              $tabla=$nombre_tabla[0]["nombre_tabla"];
               $campos_formato=listar_campos_tabla($tabla); 
              
               if(in_array('fecha_'.$formato,$campos_formato))
                  {$sql="update ".$tabla." set fecha_".$formato."=".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." where documento_iddocumento=".$iddoc;
                  //echo ($sql);
                   phpmkr_query($sql,$conn);
                  }
               $respuestas=busca_filtro_tabla("origen,estado","respuesta,documento","iddocumento=origen and destino='".$iddoc."' and estado in('TRAMITE','ACTIVO','APROBADO')","",$conn);
               if($respuestas["numcampos"]>0)      
               { $origen_respuesta = busca_filtro_tabla("origen","buzon_salida","archivo_idarchivo=$iddoc and nombre='BORRADOR'","",$conn);        
                 $datos["origen"]=$origen_respuesta[0]["origen"];
                 $datos["nombre"]="RESPONDIDO";
                 $datos["tipo"]="";
                 $datos["tipo_origen"]="1";
                 $datos["tipo_destino"]="1";
                 for($i=0;$i<$respuestas["numcampos"];$i++)
                  {if($respuestas[$i]["estado"]=="TRAMITE" || $respuestas[$i]["estado"]=="ACTIVO")
                     {$sql="UPDATE documento set estado='APROBADO' where iddocumento='".$respuestas[$i]["origen"]."'";
                      phpmkr_query($sql,$conn);
                     } 
                   $datos["archivo_idarchivo"]=$respuestas[$i]["origen"];
                   $destino_respuesta[0]=$origen_respuesta[0]["origen"];
                   $destino_respuesta[0]=usuario_actual("funcionario_codigo");
                   transferir_archivo_prueba($datos,$destino_respuesta,"","");    
                  }
               }       
               //para enviarla a los otros destinos si los tiene
               $datos["archivo_idarchivo"]=$iddoc;
               $datos["nombre"]="APROBADO";
               $datos["tipo"]="";
                 $destino=array();               
                 llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"aprobar","POSTERIOR");                
               }
              $array_banderas=explode(",",$nombre_tabla[0]["banderas"]);
            } 
        }
        else
         aprobar_reemplazo($iddoc);  

  llama_funcion_accion($iddoc,$tipo_radicado[0]["idformato"],"confirmar","POSTERIOR");
  return;
}


function modificar_campos_identificacion_documento_calidad($idformato, $iddoc){
	global $conn;
		
	$control_documento = busca_filtro_tabla("documento_calidad","ft_control_documentos","documento_iddocumento=".$iddoc,"",$conn);	
			
	$datos_formato = explode("|",$control_documento[0]["documento_calidad"]);
	$datos_formato = array(
					"idformato"   => $datos_formato[0],
					"iddocumento" => $datos_formato[1]
				 );
	
	$update ="update ft_control_documentos set iddocumento_calidad=".$datos_formato["iddocumento"].", idformato_calidad=".$datos_formato["idformato"]." where documento_iddocumento =".$iddoc;	
	phpmkr_query($update);
}
