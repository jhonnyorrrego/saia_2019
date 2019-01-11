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
include_once('../define_exportar_importar.php');
include_once($ruta_db_superior."librerias_saia.php");

if(@$_REQUEST['idformato']){
	?><br>
		<div class="container">
<a href="<?php echo "formatoedit.php?key=" . $_REQUEST['idformato']; ?>">Editar</a>&nbsp;   
<a href="<?php echo $ruta_db_superior; ?>formatos/<?php echo "formatoadd_paso2.php?key=" . $_REQUEST['idformato']; ?>">Editar cuerpo</a>&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/campos_formatolist.php?idformato=<?php echo $_REQUEST["idformato"];?>">Campos del Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/funciones_formatolist.php?idformato=<?php echo $_REQUEST["idformato"];?>">Funciones del Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo $_REQUEST["idformato"];?>">Generar el Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/formatoadd.php?x_cod_padre=<?php echo $_REQUEST["idformato"];?>">Adicionar hijo</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/transferencias_automaticas.php?idformato=<?php echo $_REQUEST["idformato"];?>">Transferencias automaticas</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/rutas_automaticas.php?idformato=<?php echo $_REQUEST["idformato"];?>">Rutas</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/formatoexport.php?key=<?php echo $_REQUEST["idformato"];?>">Exportar Formato</a>
&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1&idformato=<?php echo $_REQUEST["idformato"];?>">Pasar a productivo</a>
</div>
	<?php
}
if(@$_REQUEST['pre_exportar_formato'] && @$_REQUEST['idformato']){
	
	echo( estilo_bootstrap() );	

	$valida_exportar=1;
	$mensaje_error='<center><b>ATENCI&Oacute;N</b></center><br>';
	if(!defined("SERVIDOR_EXPORTAR") || SERVIDOR_EXPORTAR==''){
		$valida_exportar=0;
		$mensaje_error.='No es posible exportar el formato si no se tiene una ruta origen!.<br>';
	}
	if(!defined("SERVIDOR_MEDIO") || SERVIDOR_MEDIO==''){
		$valida_exportar=0;
		$mensaje_error.='No es posible exportar el formato si no se tiene una servidor intermedio!.<br>';
	}	
	if(!defined("SERVIDOR_IMPORTAR") || SERVIDOR_IMPORTAR==''){
		$valida_exportar=0;
		$mensaje_error.='No es posible exportar el formato si no se tiene una ruta destino!.<br>';
	}	
	if($valida_exportar){
		$servidor_exportar=explode('webservice_saia',SERVIDOR_EXPORTAR);
		$servidor_medio=explode('webservice_saia',SERVIDOR_MEDIO);
		$servidor_importar=explode('webservice_saia',SERVIDOR_IMPORTAR);
				
	}
	$etiqueta_formato=busca_filtro_tabla("etiqueta","formato","idformato=".@$_REQUEST['idformato'],"",$conn);	
	?>
	<br>
	<div class="container">
	<table class="table table-bordered">
		<tr>
			<th colspan="2" style="text-align:center;">Exportaci&oacute;n de Formatos</th>
		</tr>
		<tr>
			<th>Formato:</th>
			<td><?php echo(codifica_encabezado(html_entity_decode($etiqueta_formato[0]['etiqueta']))); ?></td>
		</tr>			
		<tr>
			<th colspan="2" style="text-align:center;">Datos de Exportaci&oacute;n</th>
		</tr>
		<?php 
		if($valida_exportar){
		?>		
		<tr>
			<th>El formato saldr&aacute; de:</th>
			<td><?php echo($servidor_exportar[0]); ?></td>
		</tr>	
		<tr>
			<th>El servidor intermediario es:</th>
			<td><?php echo($servidor_medio[0]); ?></td>
		</tr>
		<tr>
			<th>El formato ser&aacute; creado en:</th>
			<td><?php echo($servidor_importar[0]); ?></td>
		</tr>
		<?php 
		}else{
		?>
		<tr>
			<td colspan="2">
				<div class="alert alert-warning"><?php echo($mensaje_error); ?></div>
			</td>
		</tr>				
		<?php 	
		}
		?>								
	</table>
	</div>
	<?php
	if($valida_exportar){
		echo( librerias_jquery('1.7') );	
		?>
		<div class="container">
			<input type="button" name="confirmar_exportacion" class="btn btn-mini btn-primary" value="Confirmar Exportaci&oacute;n">
		</div>
		<script>
			$('[name="confirmar_exportacion"]').click(function(){
				window.open('exportar_formato.php?exportar_formato=1&idformato=<?php echo(@$_REQUEST['idformato']); ?>','_self');			
			});
		</script>
		<?php
	}
	
}

if(@$_REQUEST['exportar_formato']){
	
	require_once('lib/nusoap.php');  

	$cliente = new nusoap_client(SERVIDOR_EXPORTAR);

	if(@$_REQUEST['nombre_formato']){
		$nombre_formato = array();
		$nombre_formato['nombre_formato']=$_REQUEST['nombre_formato'];
		$nombre_formato = json_encode($nombre_formato);
		$ridformato = $cliente->call('generar_idformato', array($nombre_formato));
		$ridformato = json_decode($ridformato);	
		if($ridformato->exito){
			$idformato = $ridformato->idformato;
		}
	}
	if(@$_REQUEST['idformato'] || @$idformato){ //idformato a exportar
		if(@$_REQUEST['idformato']){
			$idformato=$_REQUEST['idformato'];
		}
		$vidformato = array();
		$vidformato['idformato']=$idformato; 
		$vidformato = json_encode($vidformato);
		$ridformato = $cliente->call('generar_exportar', array($vidformato));
		$ridformato = json_decode($ridformato);
	
		if($ridformato->exito){
			$exportar=json_encode($ridformato);
			
			if(@$_REQUEST["imprimir_json"]){
				print_r($exportar);
				die();
			}
			
			$medio = new nusoap_client(SERVIDOR_MEDIO);
			$respuesta_medio = $medio->call('conexion_exportar_importar', array($exportar));
			
			$respuesta_medio = json_decode($respuesta_medio,true);
			echo( estilo_bootstrap() );	
			$cadena_respuesta='<br>
			<div class="container">
			<table class="table table-bordered">';
			$vector_exito=array(0=>'icon-remove',1=>'icon-ok');
			$cadena_respuesta.='
				<tr>
					<th colspan="2" style="text-align:center;">Confirmaci&oacute;n del paso a productivo</th>
				</tr>
				<tr>
					<th>Exito de la operaci&oacute;n:</th><td><i class="'.$vector_exito[$respuesta_medio['exito']].'"></i></td>
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
			echo($cadena_respuesta);
			
			if($respuesta_medio['exito']){
				$vidformato = array();
				$vidformato['idformato']=$idformato; 
				$vidformato = json_encode($vidformato);
				$rlista_funciones = $cliente->call('generar_lista_funciones', array($vidformato));
				$rlista_funciones = json_decode($rlista_funciones,1);
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
			
			
			//echo($respuesta_medio);	//ARRAY CON RESPUESTA FINAL
		}
	}else{ 
		
		echo(json_encode(array('mensaje'=>'No existe formato con ese Nombre')));
	}
}//fin if exportar_formato
?>