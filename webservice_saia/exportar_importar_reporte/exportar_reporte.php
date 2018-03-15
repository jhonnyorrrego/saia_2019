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
$ruta_db_superior_tmp=$ruta_db_superior;
include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."webservice_saia/exportar_importar_reporte/exportar_reporte/funciones.php");
$ruta_db_superior=$ruta_db_superior_tmp;
$cliente='';
if(!@$_REQUEST["solo_nombre"]){
	echo( estilo_bootstrap() );
	echo( librerias_jquery('1.7') );	
}
function validar_respuesta_medio($respuesta_medio,$tipo_conexion=0){
	global $conn,$ruta_db_superior,$cliente,$servidor_importar,$servidor_exportar;
	$respuesta_medio = json_decode($respuesta_medio,true);
	$cadena_respuesta2='';
	$cadena_respuesta='<br>
			<div class="container">
			<table class="table table-bordered">';
	$vector_exito=array(0=>'<div class="label label-important"> Error </div>',1=>'<div class="label label-success"> &Eacute;xito </div>');
	$cadena_respuesta.='
				<tr>
					<th colspan="2" style="text-align:center;">Confirmaci&oacute;n al '.$_REQUEST['operacion'].'</th>
				</tr>
				<tr>
					<th>Nombre:</th><td>'.$_REQUEST["nombre_reporte"].'</td>
				</tr>
				<tr>
					<th>Resultado de la operaci&oacute;n:</th><td>'.$vector_exito[$respuesta_medio['exito']].'</td>
				</tr>
				<tr>
					<th>Servidor Origen: </th><td>'.$servidor_exportar.'</td>
				</tr>
				<tr>
					<th>Servidor Destino: </th><td>'.$servidor_importar.'</td>
				</tr>

				<tr>
					<th>Mensaje: </th><td>'.implode("<br>",$respuesta_medio['mensaje']).'</td>
				</tr>
			';
	
	$cadena_respuesta.='</table></div>';
	if($respuesta_medio['exito']){
	    $cadena_lista_funciones='';
	    $cant=count($respuesta_medio["archivos"]);	
		if($cant){
			$vector_lista_funciones=$respuesta_medio["archivos"];
			$cadena_lista_funciones.='
					<br>
					<div class="container">
					<table class="table table-bordered">
					<tr>
						<th style="text-align:center;">Archivos Relacionados con el reporte</th>
					</tr>
					';
			for($i=0;$i<$cant;$i++){
				$cadena_lista_funciones.='
						<tr>
							<td>'.$respuesta_medio["archivos"][$i].'</td>';
				$cadena_lista_funciones.='</tr>
						';
			}
			$cadena_lista_funciones.='</table></div>';
			//echo($cadena_lista_funciones);
		}
		$cant=count($respuesta_medio["tablas"]);		
		if($cant){
			$vector_lista_funciones=$respuesta_medio["tablas"];
			$cadena_lista_funciones.='
					<br>
					<div class="container">
					<table class="table table-bordered">
					<tr>
						<th style="text-align:center;">Tablas Relacionadas con el reporte</th>
					</tr>
					';
			for($i=0;$i<$cant;$i++){
				$cadena_lista_funciones.='
						<tr>
							<td>'.$respuesta_medio["tablas"][$i].'</td>';
				$cadena_lista_funciones.='</tr>
						';
			}
			$cadena_lista_funciones.='</table></div>';
			//echo($cadena_lista_funciones);
		}
	}
	$cadena_respuesta.='<div class="container"><input type="button" name="continuar_importar" class="btn btn-primary btn-mini" value="Continuar" id="continuar_importar"></div>
	<script>
		$(document).on("click","#continuar_importar",function(){
			window.open("'.$ruta_db_superior.'webservice_saia/exportar_importar_reporte/exportar_reporte.php?pre_exportar_reporte=1","_self");
		});
	</script>';
	$cadena_respuesta2.='<br>
			<div class="container">
			<table class="table table-bordered">';
	$cadena_respuesta2.='<tr><th colspan="2" style="text-align:center;font-weight:bold;"><h6>Detalles del proceso</h6></th></tr>';		
	$tablas_warning_error=array("busqueda","busqueda_componente","busqueda_condicion","busqueda_condicion_enlace","busqueda_grafico","busqueda_grafico_serie","busqueda_indicador","busqueda_encabezado","indicador");
	$errores=0;
	$warnings=0;
	foreach($tablas_warning_error AS $key=>$valor){
        $cant_respuestas=count($respuesta_medio['error_'.$valor]);
        if($cant_respuestas){
            $errores++;
        	$cadena_respuesta2.='
        					<tr>
        						<th colspan="2" style="text-align:left;font-weight:bold;"><h6>'.$valor.'</h6></th>
        					</tr>
        				';
        	for($i=0;$i<$cant_respuestas;$i++){
        	    $cadena_respuesta2.='<tr class="alert alert-danger">
        						<td nowrap>Error Campo Nro.'.($i+1).': </td><td>'.$respuesta_medio['error_'.$valor][$i].'</td></tr>
        				';
        	}
        }
        $cant_respuestas=count($respuesta_medio['warning_'.$valor]);
        if($cant_respuestas){
            $warnings++;
            if(!$errores){
                $warnings++;
                //Crea el encabezado si no existe error
        	    $cadena_respuesta2.='
        					<tr>
        						<th colspan="2" style="text-left:center;font-weight:bold;"><h6>'.$valor.'</h6></th>
        					</tr>
        				';
            }
        	for($i=0;$i<$cant_respuestas;$i++){
        	    $cadena_respuesta2.='<tr class="alert alert-important">
        						<td nowrap>Alerta Nro.'.($i+1).': </td><td>'.$respuesta_medio['warning_'.$valor][$i].'</td></tr>
        				';
        	}
        }
        $cant_respuestas=count($respuesta_medio['insertados_'.$valor]);
        if($cant_respuestas){
            if(!$errores && !$warnings){
                //Crea el encabezado si no existe error
        	    $cadena_respuesta2.='
        					<tr>
        						<th colspan="2" style="text-left:center;font-weight:bold;"><h6>'.$valor.'</h6></th>
        					</tr>
        				';
            }
        	for($i=0;$i<$cant_respuestas;$i++){
        	    $cadena_respuesta2.='<tr class="alert alert-success">
        						<td nowrap>Insertado Nro.'.($i+1).': </td><td>'.$respuesta_medio['insertados_'.$valor]["sql"][$i].'</td></tr>
        				';
        	}
        }
	}
	$cadena_respuesta2.='</table></div>';
	if($errores || $warnings){
	    $cadena_respuesta.=$cadena_respuesta2;
	}
	if($cadena_lista_funciones){
	   $cadena_respuesta.=$cadena_lista_funciones; 
	}
	echo($cadena_respuesta);
}
$base_configuracion=busca_filtro_tabla("","configuracion","tipo='exportar_importar' AND nombre='servidor_destino'","",conn);
if($base_configuracion["numcampos"]){
	$servidor_importar_tmp=$base_configuracion[0]["valor"];
}else{
	$servidor_importar_tmp="last-release.netsaia.com/saia_release/saia";
}
$error_exportar=0;	
if(!$_REQUEST["servidor_local"]){
	$_REQUEST["servidor_local"]=PROTOCOLO_CONEXION.RUTA_PDF;
}
if(@$_REQUEST["servidor_destino"] && @$_REQUEST["operacion"]){
	if($_REQUEST["operacion"]=="importar"){
		$servidor_importar=$_REQUEST["servidor_local"].'/webservice_saia/exportar_importar_reporte/importar_reporte/receptor_importar.php';
		$servidor_exportar=$_REQUEST["servidor_destino"].'/webservice_saia/exportar_importar_reporte/exportar_reporte/receptor_exportar.php';
	}
	else if($_REQUEST["operacion"]=="exportar"){
		$servidor_importar=$_REQUEST["servidor_destino"].'/webservice_saia/exportar_importar_reporte/importar_reporte/receptor_importar.php';
		$servidor_exportar=$_REQUEST["servidor_local"].'/webservice_saia/exportar_importar_reporte/exportar_reporte/receptor_exportar.php';
	}
	else{
		$error_exportar=1;
		$mensaje_error="<center><b>No es posible realizar la operacion ".$_REQUEST["operacion"]." en el sistema por favor valide su informaci&oacute;n";
	}
}
if(@$_REQUEST['pre_exportar_reporte']){
	?>
	<br>
	<div class="container">
	<form method="post" action="exportar_reporte.php" id="form_exportar">
	<table class="table table-bordered">
		<tr>
			<th colspan="2" style="text-align:center;">Exportar/importar reportes</th>
		</tr>			
		<tr>
			<th>Acci&oacute;n sobre el reporte:</th>
			<td>
				<select name="operacion" id="operacion">
					<option value="importar">Importar</option>
					<option value="exportar">Exportar</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>reporte:</th>
			<td><input type="text" name="nombre_reporte" id="nombre_reporte" value="<?php echo(@$_REQUEST["nombre_reporte"]); ?>" ><span id="check_reporte" class="error"><i class="icon-remove"></i></span></td>
		</tr>
		<tr>		
			<th>El servidor para <span id="operacion_span">importar</span>:</th>
			<td><input type="text" name="servidor_destino" id="servidor_destino" value="<?php echo($servidor_importar_tmp); ?>" class="input-large"><span id="check_server"><i class="icon-remove"></i></span></td>
		</tr>	
		<tr>
			<td colspan="2">
				<div  <?php if(!$error_exportar){ echo('style="display:none;"');}	?> class="alert alert-warning" id="div_mensaje_error"><?php echo($mensaje_error); ?></div>
				<div class="alert alert-warning" style="display:none;" id="div_error_nombre"></div>
			</td>
		</tr>				
	</table>
	</div>
		<div class="container">
			<input type="hidden" name="idreporte" id="idreporte" value="<?php echo(@$_REQUEST["idreporte"]);?>">
			<input type="button" name="confirmar_exportar" id="confirmar_exportar" class="btn btn-mini btn-primary btn_valida_error" value="Confirmar">
			<input type="button" name="solo_exportar" class="btn btn-primary btn-mini btn_valida_error" value="Mostrar Json" id="solo_exportar">
			<input type="button" name="solo_importar" class="btn btn-primary btn-mini" value="S&oacute;lo importar" id="solo_importar">
			<input type="hidden" id="servidor_local" value="<?php echo($_REQUEST['servidor_local']);?>">
		</div>
		</form>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#confirmar_exportar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='exportar_reporte' value='1'>");
				$("#form_exportar").submit();			
			});
			$('#solo_exportar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='exportar_reporte' value='1'>");
				$("#form_exportar").append("<input type='hidden' name='imprimir_json' value='1'>");
				$("#form_exportar").submit();
			});
			$('#solo_importar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='solo_importar' value='1'>");
				$("#form_exportar").submit();
			});
			$("#operacion").change(function(){
				$("#operacion_span").html($(this).val());
				$("#nombre_reporte").focus();
			});
			$("#nombre_reporte").focusout(function(){
				$.ajax({
			       	type:'POST',
			        url: "exportar_reporte.php?solo_nombre=1&exportar_reporte=1",
			        data:$("#form_exportar").serialize(),
			        datatype:"json",
			        success: function(datos){
			    	   	var datos2=$.parseJSON(datos);
			    	   	if(datos2.exito){
							$("#idreporte").val(datos2.idreporte);
							$("#div_error_nombre").html("").hide();
							$("#check_reporte").removeClass("error");
							$("#check_reporte").html('<i class="icon-ok"></i>');
							validar_botones();
				    	}
			    	   	else{
			    	   		$("#check_reporte").html('<i class="icon-remove"></i>');
			    	   		$("#check_reporte").addClass("error");
			    	   		validar_botones();
				    	   	var servidor='';
				    	   	if($("#operacion").val()==="importar"){
					    	   servidor=$("#servidor_destino").val();
				    	   	}
				    	   	else if($("#operacion").val()==="exportar"){
								servidor=$("#servidor_local").val();
					    	}
							$("#div_error_nombre").show().html('<br><div class="label label-important">El reporte '+$("#nombre_reporte").val()+' no existe en '+servidor+'</div>');
				    	}
					}
				});
			});
			$("#servidor_destino").focusout(function(){					
				validar_existe_destino( $("#servidor_destino").val()+"/webservice_saia/exportar_importar_reporte/existe_carpeta.php");
			});
			/**
			Esto se hace para que siempre que se le de click en el input partamos de la premisa que esta mal, al momento en que hace el blur debe hacer la validacion, se deja asi porque no se encuentra forma de validar el error 404 cuando no existe la pagina
			*/
			$("#servidor_destino").click(function(){
				$("#check_server").html('<i class="icon-remove"></i>');
				$("#check_server").addClass("error");
				validar_botones();
			});
			validar_existe_destino( $("#servidor_destino").val()+"/webservice_saia/exportar_importar_reporte/existe_carpeta.php");
		});
		function validar_botones(){
		    console.log($(".error").length);
		    if($(".error").length===0){
		        $(".btn_valida_error").removeAttr('disabled');
		    }else{
		        $(".btn_valida_error").attr("disabled","disabled"); 
		    }
		}
		function validar_existe_destino(destino){
			$.ajax({
				  url:destino,
				  dataType: "jsonp",
				  success: function(datos){
						if(datos.existe){
							$("#check_server").html('<i class="icon-ok"></i>');
							$("#check_server").removeClass("error");
						}
						validar_botones();
				    },
				    error : function(jqXHR, textStatus, errorThrown) { 
				    	$("#check_server").html('<i class="icon-remove"></i>');
				    	validar_botones();
				    }
			});
			validar_botones();
		}
		</script>
		<?php
}

if(@$_REQUEST["solo_importar"]){
	if(@$_REQUEST["datos_reporte_importar"]){
		include_once($ruta_db_superior."webservice_saia/exportar_importar_reporte/importar_reporte/funciones.php");
		$retorno=generar_importar($_REQUEST["datos_reporte_importar"]);
		validar_respuesta_medio($retorno,0);
	}
	else{
?>
	<br>Por favor escriba el json a ser importado:<br>
	<form action="exportar_reporte.php" method="post" action="exportar_reporte.php">
	<textarea name="datos_reporte_importar" class="form-control" style="min-width: 100%; height: 70%">
	</textarea>
	<input type="hidden" name="idreporte" value="<?php echo($_REQUEST["idreporte"]);?>" id="idreporte">
	<input type="hidden" name="solo_importar" value="1">
	<input type="submit" name="importar_reporte" class="btn btn-primary btn-mini" value="confirmar Importar" id="importar_reporte">
	</form>
<?php 
	}
}
if(@$_REQUEST['exportar_reporte'] && !$error_exportar){
	require_once('lib/nusoap.php'); 
	$cliente = new nusoap_client($servidor_exportar);
	$error_conexion=$cliente->getError();
	if($error_conexion){
	    print_r($error_conexion);
	}
	else if(@$_REQUEST['nombre_reporte'] && !$_REQUEST["idreporte"]){
		$nombre_reporte = array();
		$nombre_reporte['nombre_reporte']=$_REQUEST['nombre_reporte'];
		$nombre_reporte = json_encode($nombre_reporte);
		$ridreporte = $cliente->call('generar_idreporte', array($nombre_reporte));
		$ridreporte = json_decode($ridreporte);
		if($ridreporte->exito){
			$idreporte = $ridreporte->idreporte;
		}
		if(@$_REQUEST["solo_nombre"]){
			die(json_encode($ridreporte));
		}
	}
	if(@$_REQUEST['idreporte'] || @$idreporte){ //idreporte a exportar
		//Validar muy bien el caso de importar y exportar ya que el idreporte debe ser siempre el reporte que se desea, como esta llama el idreporte que puede cambiar entre servidores
		if(@$_REQUEST['idreporte'] && !$idreporte){
			$idreporte=$_REQUEST['idreporte'];
		}
		$vidreporte = array();
		$vidreporte['idreporte']=$idreporte; 
		$vidreporte = json_encode($vidreporte);
		$vidreporte= $cliente->call('generar_exportar', array($vidreporte));
		if($vidreporte->exito){
			$idreporte = $vidreporte->idreporte;
		}
		$ridreporte = json_decode($vidreporte);
		if($ridreporte->exito){
		    $ridreporte->servidor_importar=$servidor_importar;
		    $ridreporte->usuario_saia_radica_ws="cerok";
			$exportar=json_encode($ridreporte);
			if(@$_REQUEST["imprimir_json"]){
				?><br>
				<form>
				<textarea class="form-control" style="min-width: 100%; height: 70%"><?php echo(trim($exportar));?></textarea>
				<input type="hidden" name="idreporte" value="<?php echo($_REQUEST["idreporte"]);?>" id="idreporte">
				<input type="hidden" name="pre_exportar_reporte" id="idreporte" value="1">
	<input type="submit" name="exportar_reporte" class="btn btn-primary btn-mini" value="continuar" id="exportar_reporte">
				</form>
			<?php 
				die();
			}
			$medio = new nusoap_client($servidor_importar);
			$respuesta_medio = $medio->call('generar_importar', array($exportar));
			if ($medio->fault) {
        		echo 'Fallo';
        		print_r($respuesta_medio);
        	} else {	// Chequea errores
        		$err = $medio->getError();
        		if ($err) {		// Muestra el error
        			echo('<b>Error : </b>' . $err);
        			print_r($respuesta_medio);
        			print_r($medio);
        		} 
        	}
			validar_respuesta_medio($respuesta_medio,1);
		}
	}else{ 
		
		echo(json_encode(array('mensaje'=>'No existe reporte con ese Nombre')));
	}
}//fin if exportar_reporte

?>