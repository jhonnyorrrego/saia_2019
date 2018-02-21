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
ini_set("display_errors",true);
echo( estilo_bootstrap() );
echo( librerias_jquery('1.7') );	
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
<!--a href="<?php echo $ruta_db_superior; ?>formatos/formatoexport.php?key=<?php echo $_REQUEST["idformato"];?>">Exportar Formato</a-->
<a href="<?php echo $ruta_db_superior; ?>webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1&idformato=<?php echo $_REQUEST["idformato"];?>">Exportar Formato</a>
</div>
	<?php
}
function validar_respuesta_medio($respuesta_medio,$tipo_conexion=0){
	global $conn,$ruta_db_superior;
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
		$vidformato['idformato']=$idformato;
		$vidformato = json_encode($vidformato);
		if($tipo_conexion==1){
			$rlista_funciones = $cliente->call('generar_lista_funciones', array($vidformato));
		}
		else{
			$rlista_funciones=generar_lista_funciones($vidformato);
		}
		$rlista_funciones = json_decode($rlista_funciones,true);
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
			window.open("'.$ruta_db_superior.'webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1&idformato='.$_REQUEST["idformato"].'","_self");
		});
	</script>';
	echo($cadena_respuesta);
}
$base_configuracion=busca_filtro_tabla("","configuracion","tipo='exportar_formato'","",conn);
for($i=0;$i<$base_configuracion["numcampos"];$i++){
  if($base_configuracion[$i]["nombre"]=="servidor_medio"){
      $servidor_medio=$base_configuracion[$i]["valor"];
  }
  else if($base_configuracion[$i]["nombre"]=="servidor_importar"){
      $servidor_importar=$base_configuracion[$i]["valor"];
  }
}
$valida_exportar=1;
if($servidor_medio==''){
	$valida_exportar=0;
	$mensaje_error.='No es posible exportar el formato si no se tiene una servidor intermedio!.<br>';
}	
if($servidor_importar==''){
	$valida_exportar=0;
	$mensaje_error.='No es posible exportar el formato si no se tiene una ruta destino!.<br>';
}	
if($valida_exportar){
	$servidor_medio_tmp=explode('webservice_saia',$servidor_medio);
	$servidor_importar_tmp=explode('webservice_saia',$servidor_importar);
}
if(@$_REQUEST['pre_exportar_formato'] && @$_REQUEST['idformato']){
	$mensaje_error='<center><b>ATENCI&Oacute;N</b></center><br>';
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
			<td><?php $server=PROTOCOLO_CONEXION.RUTA_PDF; echo($server); ?></td>
		</tr>	
		<tr>
			<th>El servidor intermediario es:</th>
			<td><?php echo($servidor_medio_tmp[0]); ?></td>
		</tr>
		<tr>
			<th>El formato ser&aacute; creado en:</th>
			<td><?php echo($servidor_importar_tmp[0]); ?></td>
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
		?>
		<div class="container">
			<input type="button" name="confirmar_exportacion" class="btn btn-mini btn-primary" value="Confirmar Exportaci&oacute;n">
			<input type="button" name="solo_exportar" class="btn btn-primary btn-mini" value="S&oacute;lo exportar" id="solo_exportar">
			<input type="button" name="solo_importar" class="btn btn-primary btn-mini" value="S&oacute;lo importar" id="solo_importar">
			
		</div>
		<script>
			$('[name="confirmar_exportacion"]').click(function(){
				window.open('exportar_formato.php?exportar_formato=1&idformato=<?php echo(@$_REQUEST['idformato']); ?>','_self');			
			});
			$('#solo_exportar').click(function(){
				window.open('exportar_formato.php?exportar_formato=1&idformato=<?php echo(@$_REQUEST['idformato']); ?>&imprimir_json=1','_self');			
			});
			$('#solo_importar').click(function(){
				window.open('exportar_formato.php?solo_importar=1&idformato=<?php echo(@$_REQUEST['idformato']); ?>','_self');
			});
		</script>
		<?php
	}
	
}

if(@$_REQUEST["solo_importar"]){
	if(@$_REQUEST["datos_formato_importar"]){
		include_once($ruta_db_superior."webservice_saia/exportar_importar_formato/importar_formato/funciones.php");
		$retorno=generar_importar($_REQUEST["datos_formato_importar"]);
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

if(@$_REQUEST['exportar_formato'] && $valida_exportar){
	require_once('lib/nusoap.php'); 
	if(@$_REQUEST['nombre_formato']){
		$nombre_formato = array();
		$nombre_formato['nombre_formato']=$_REQUEST['nombre_formato'];
		$nombre_formato = json_encode($nombre_formato);
		$ridformato = generar_idformato($nombre_formato);
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
		$vidformato = generar_exportar($vidformato);
		if($vidformato->exito){
			$idformato = $vidformato->idformato;
		}
		$ridformato = json_decode($vidformato);
	
		if($ridformato->exito){
		    $ridformato->servidor_importar=$servidor_importar;
		    $ridformato->usuario_saia_radica_ws="cerok";
			$exportar=json_encode($ridformato);
			if(@$_REQUEST["imprimir_json"]){
				echo('<br><form><textarea class="form-control" style="min-width: 100%; height: 80%">');
				echo(trim($exportar));
				echo("</textarea></form>");
				die();
			}
			$medio = new nusoap_client($servidor_medio);
			$respuesta_medio = $medio->call('conexion_exportar_importar', array($exportar));
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