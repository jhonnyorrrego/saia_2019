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
include_once($ruta_db_superior.'db.php');
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."webservice_saia/exportar_importar_formato/exportar_formato/funciones.php");
$cliente='';
if(!@$_REQUEST["solo_nombre"]){
	echo( estilo_bootstrap() );
	echo( librerias_jquery('1.7') );	
}
function validar_respuesta_medio($respuesta_medio,$tipo_conexion=0){
	global $conn,$ruta_db_superior,$cliente;
	$respuesta_medio = json_decode($respuesta_medio,true);
	$cadena_respuesta='<br>
			<div class="container">
			<table class="table table-bordered">';
	$vector_exito=array(0=>'<div class="label label-important"> Error </div>',1=>'<div class="label label-success"> &Eacute;xito </div>');
	$cadena_respuesta.='
				<tr>
					<th colspan="2" style="text-align:center;">Confirmaci&oacute;n del paso a productivo</th>
				</tr>
				<tr>
					<th>Resultado de la operaci&oacute;n:</th><td>'.$vector_exito[$respuesta_medio['exito']].'</td>
				</tr>
				<tr>
					<th>Mensaje: </th><td>'.$respuesta_medio['mensaje'].'</td>
				</tr>
			';
	
	if(@$respuesta_medio['campos_formato_error']){
		$cadena_respuesta.='
						<tr>
							<th colspan="2" style="text-align:center;font-weight:bold;">Errores En \'campos_formato\'</th>
						</tr>
					';
		for($i=0;$i<count($respuesta_medio['campos_formato_error']);$i++){
			$cadena_respuesta.='<tr>
							<th>Error Campo Nro.'.($i+1).': </th><td>'.$respuesta_medio['campos_formato_error']['campos_formato_error_'.$i].'</td></tr>
					';
		}
	}
	if(@$respuesta_medio['funciones_formato_error']){
		$cadena_respuesta.='<tr>
						<th colspan="2">Errores En \'funciones_formato\'</th>
						</tr>
					';
		for($i=0;$i<count($respuesta_medio['funciones_formato_error']);$i++){
			$cadena_respuesta.='<tr>
							<th>Error Funcion Nro.'.($i+1).': </th><td>'.$respuesta_medio['funciones_formato_error']['funciones_formato_error_'.$i].'</td></tr>
					';
			
		}
	}
	if(@$respuesta_medio['funciones_formato_accion_error']){
		$cadena_respuesta.='<tr>
						<th colspan="2">Errores En \'funciones_formato_accion\'</th>
						</tr>
					';
		for($i=0;$i<count($respuesta_medio['funciones_formato_accion_error']);$i++){
			$cadena_respuesta.='<tr>
							<th>Error Funcion Accion Nro.'.($i+1).': </th><td>'.$respuesta_medio['funciones_formato_accion_error']['funciones_formato_accion_error_'.$i].'</td></tr>
					';
			
		}
	}
	
	$cadena_respuesta.='</table></div>';
	if($respuesta_medio['exito']){
		$vidformato = array();
		$vidformato['idformato']=$respuesta_medio["idformato"];
		$vidformato = json_encode($vidformato);
		print_r($vidformato);
		if($tipo_conexion==1){
			$rlista_funciones = $cliente->call('generar_lista_funciones', array($vidformato));
		}
		else{
			$rlista_funciones=generar_lista_funciones($vidformato);
		}
		$rlista_funciones = json_decode($rlista_funciones,true);
		var_dump($tipo_conexion);
		print_r($rlista_funciones);
		if($rlista_funciones['lista_funciones']!=''){
			$vector_lista_funciones=explode('|',$rlista_funciones['lista_funciones']);
			$cadena_lista_funciones='
					<br>
					<div class="container">
					<table class="table table-bordered">
					<tr>
						<th style="text-align:center;">Archivos Relacionados con el formato</th>
					</tr>
					';
			$vector_lista_funciones=array_unique($vector_lista_funciones);
			$vector_lista_funciones=array_values($vector_lista_funciones);
			for($i=0;$i<count($vector_lista_funciones)-1;$i++){
				$cadena_lista_funciones.='
						<tr>
							<td>'.$vector_lista_funciones[$i].'</td>
						</tr>
						';
			}
			$cadena_lista_funciones.='</table></div>';
			echo($cadena_lista_funciones);
		}
	}
	$cadena_respuesta.='<input type="button" name="continuar_importar" class="btn btn-primary btn-mini" value="Continuar" id="continuar_importar">
	<script>
		$(document).on("click","#continuar_importar",function(){
			window.open("'.$ruta_db_superior.'webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1","_self");
		});
	</script>';
	die($cadena_respuesta);
}
$base_configuracion=busca_filtro_tabla("","configuracion","tipo='exportar_formato' AND nombre='servidor_importar'","",conn);
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
		$servidor_importar=$_REQUEST["servidor_local"].'/webservice_saia/exportar_importar_formato/importar_formato/receptor_importar.php';
		$servidor_exportar=$_REQUEST["servidor_destino"].'/webservice_saia/exportar_importar_formato/exportar_formato/receptor_exportar.php';
	}
	else if($_REQUEST["operacion"]=="exportar"){
		$servidor_importar=$_REQUEST["servidor_destino"].'/webservice_saia/exportar_importar_formato/importar_formato/receptor_importar.php';
		$servidor_exportar=$_REQUEST["servidor_local"].'/webservice_saia/exportar_importar_formato/exportar_formato/receptor_exportar.php';
	}
	else{
		$error_exportar=1;
		$mensaje_error="<center><b>No es posible realizar la operacion ".$_REQUEST["operacion"]." en el sistema por favor valide su informaci&oacute;n";
	}
}
if(@$_REQUEST['pre_exportar_formato']){
	?>
	<br>
	<div class="container">
	<form method="post" action="exportar_formato.php" id="form_exportar">
	<table class="table table-bordered">
		<tr>
			<th colspan="2" style="text-align:center;">Exportaci&oacute;n de Formatos</th>
		</tr>			
		<tr>
			<th>Acci&oacute;n sobre el formato:</th>
			<td>
				<select name="operacion" id="operacion">
					<option value="importar">Importar</option>
					<option value="exportar">Exportar</option>
				</select>
			</td>
		</tr>
		<tr>
			<th>Formato:</th>
			<td><input type="text" name="nombre_formato" id="nombre_formato" value="<?php echo(@$_REQUEST["nombre_formato"]); ?>" ><span id="check_formato" class="error"><i class="icon-remove"></i></span></td>
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
			<input type="hidden" name="idformato" id="idformato" value="<?php echo(@$_REQUEST["idformato"]);?>">
			<input type="button" name="confirmar_exportar" id="confirmar_exportar" class="btn btn-mini btn-primary btn_valida_error" value="Confirmar">
			<input type="button" name="solo_exportar" class="btn btn-primary btn-mini btn_valida_error" value="Mostrar Json" id="solo_exportar">
			<input type="button" name="solo_importar" class="btn btn-primary btn-mini" value="S&oacute;lo importar" id="solo_importar">
			<input type="hidden" id="servidor_local" value="<?php echo($_REQUEST['servidor_local']);?>">
		</div>
		</form>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#confirmar_exportar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='exportar_formato' value='1'>");
				$("#form_exportar").submit();			
			});
			$('#solo_exportar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='exportar_formato' value='1'>");
				$("#form_exportar").append("<input type='hidden' name='imprimir_json' value='1'>");
				$("#form_exportar").submit();
			});
			$('#solo_importar').click(function(){
				$("#form_exportar").append("<input type='hidden' name='solo_importar' value='1'>");
				$("#form_exportar").submit();
			});
			$("#operacion").change(function(){
				$("#operacion_span").html($(this).val());
				$("#nombre_formato").focus();
			});
			$("#nombre_formato").focusout(function(){
				$.ajax({
			       	type:'POST',
			        url: "exportar_formato.php?solo_nombre=1&exportar_formato=1",
			        data:$("#form_exportar").serialize(),
			        datatype:"json",
			        success: function(datos){
			    	   	var datos2=$.parseJSON(datos);
			    	   	if(datos2.exito){
							$("#idformato").val(datos2.idformato);
							$("#div_error_nombre").html("").hide();
							$("#check_formato").removeClass("error");
							$("#check_formato").html('<i class="icon-ok"></i>');
							validar_botones();
				    	}
			    	   	else{
			    	   		$("#check_formato").html('<i class="icon-remove"></i>');
			    	   		$("#check_formato").addClass("error");
			    	   		validar_botones();
				    	   	var servidor='';
				    	   	if($("#operacion").val()==="importar"){
					    	   servidor=$("#servidor_destino").val();
				    	   	}
				    	   	else if($("#operacion").val()==="exportar"){
								servidor=$("#servidor_local").val();
					    	}
							$("#div_error_nombre").show().html('<br><div class="label label-important">El formato '+$("#nombre_formato").val()+' no existe en '+servidor+'</div>');
				    	}
					}
				});
			});
			$("#servidor_destino").focusout(function(){					
				validar_existe_destino( $("#servidor_destino").val()+"/webservice_saia/exportar_importar_formato/exportar_formato/existe_carpeta.php");
			});
			/**
			Esto se hace para que siempre que se le de click en el input partamos de la premisa que esta mal, al momento en que hace el blur debe hacer la validacion, se deja asi porque no se encuentra forma de validar el error 404 cuando no existe la pagina
			*/
			$("#servidor_destino").click(function(){
				$("#check_server").html('<i class="icon-remove"></i>');
				$("#check_server").addClass("error");
				validar_botones();
			});
			validar_existe_destino( $("#servidor_destino").val()+"/webservice_saia/exportar_importar_formato/exportar_formato/existe_carpeta.php");
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
	if(@$_REQUEST["datos_formato_importar"]){
		include_once($ruta_db_superior."webservice_saia/exportar_importar_formato/importar_formato/funciones.php");
		$retorno=generar_importar($_REQUEST["datos_formato_importar"]);
		print_r($retorno);
		validar_respuesta_medio($retorno,0);
	}
	else{
?>
	<br>Por favor escriba el json a ser importado:<br>
	<form action="exportar_formato.php" method="post" action="exportar_formato.php">
	<textarea name="datos_formato_importar" class="form-control" style="min-width: 100%; height: 70%">
	</textarea>
	<input type="hidden" name="idformato" value="<?php echo($_REQUEST["idformato"]);?>" id="idformato">
	<input type="hidden" name="solo_importar" value="1">
	<input type="submit" name="importar_formato" class="btn btn-primary btn-mini" value="confirmar Importar" id="importar_formato">
	</form>
<?php 
	}
}
if(@$_REQUEST['exportar_formato'] && !$error_exportar){
	require_once('lib/nusoap.php'); 
	$cliente = new nusoap_client($servidor_exportar);
	if(@$_REQUEST['nombre_formato']){
		$nombre_formato = array();
		$nombre_formato['nombre_formato']=$_REQUEST['nombre_formato'];
		$nombre_formato = json_encode($nombre_formato);
		$ridformato = $cliente->call('generar_idformato', array($nombre_formato));
		$ridformato = json_decode($ridformato);
		if($ridformato->exito){
			$idformato = $ridformato->idformato;
		}
		if(@$_REQUEST["solo_nombre"]){
			die(json_encode($ridformato));
		}
	}
	if(@$_REQUEST['idformato'] || @$idformato){ //idformato a exportar
		//Validar muy bien el caso de importar y exportar ya que el idformato debe ser siempre el formato que se desea, como esta llama el idformato que puede cambiar entre servidores
		if(@$_REQUEST['idformato'] && !$idformato){
			$idformato=$_REQUEST['idformato'];
		}
		$vidformato = array();
		$vidformato['idformato']=$idformato; 
		$vidformato = json_encode($vidformato);
		$vidformato= $cliente->call('generar_exportar', array($vidformato));
		if($vidformato->exito){
			$idformato = $vidformato->idformato;
		}
		$ridformato = json_decode($vidformato);
		if($ridformato->exito){
		    $ridformato->servidor_importar=$servidor_importar;
		    $ridformato->usuario_saia_radica_ws="cerok";
			$exportar=json_encode($ridformato);
			if(@$_REQUEST["imprimir_json"]){
				?><br>
				<form>
				<textarea class="form-control" style="min-width: 100%; height: 70%"><?php echo(trim($exportar));?></textarea>
				<input type="hidden" name="idformato" value="<?php echo($_REQUEST["idformato"]);?>" id="idformato">
				<input type="hidden" name="pre_exportar_formato" id="idformato" value="1">
	<input type="submit" name="exportar_formato" class="btn btn-primary btn-mini" value="continuar" id="exportar_formato">
				</form>
			<?php 
				die();
			}
			$medio = new nusoap_client($servidor_importar);
			$respuesta_medio = $medio->call('generar_importar', array($exportar));
			print_r($respuesta_medio);
			if ($medio->fault) {
        		echo 'Fallo';
        		print_r($respuesta_medio);
        	} else {	// Chequea errores
        		$err = $medio->getError();
        		if ($err) {		// Muestra el error
        			die('Error' . $err);
        		} 
        	}
			validar_respuesta_medio($respuesta_medio,1);
		}
	}else{ 
		
		echo(json_encode(array('mensaje'=>'No existe formato con ese Nombre')));
	}
}//fin if exportar_formato

?>