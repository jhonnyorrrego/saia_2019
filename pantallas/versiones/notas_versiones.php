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
if(@$_REQUEST['guardar']){
	/*
	 * 
	 
version_notas


idversion_notas
fecha
funcionario_idfuncionario
observaciones
fk_idversion_documento
	 */
	

	
	$fecha=date('Y-m-d H:i:s');
	$funcionario_idfuncionario=usuario_actual('idfuncionario');
	$observaciones=@$_REQUEST["observaciones"];
	$fk_idversion_documento=@$_REQUEST["idversion_documento"];
	
	$tabla="version_notas";
	$fieldList=array();
	$fieldList["fecha"] = $fecha;
	$fieldList["funcionario_idfuncionario"] = $funcionario_idfuncionario;	
	$fieldList["observaciones"] = $observaciones;	
	$fieldList["fk_idversion_documento"] = $fk_idversion_documento;	
	
	
		
	$strsql = "INSERT INTO ".$tabla." (";
	$strsql .= implode(",", array_keys($fieldList));			
	$strsql .= ") VALUES ('";			
	$strsql .= implode("','", array_values($fieldList));			
	$strsql .= "')";	
	phpmkr_query($strsql);
	
	echo("
	<script>
		var mensaje_exito='<b>ATENCI&Oacute;N</b><br>Nota ingresada con exito!';
       	top.noty({text: mensaje_exito,type: 'success',layout: 'topCenter',timeout:2500});	
	</script>
	
	");
}


if(@$_REQUEST['iddoc']){
	$idversion_documento=@$_REQUEST["idversion_documento"];
	$iddoc=@$_REQUEST['iddoc'];
	@$_REQUEST['doc']=$iddoc;
}else{
	$vector_idversion_documento_iddoc=explode('|',@$_REQUEST['id']);
	@$_REQUEST['doc']=$vector_idversion_documento_iddoc[1];
	$iddoc=$vector_idversion_documento_iddoc[1];
	$idversion_documento=$vector_idversion_documento_iddoc[0];	
}



if(@$_REQUEST["iddoc"] || @$_REQUEST["key"] || @$_REQUEST["doc"]){
	$_REQUEST["iddoc"]=@$_REQUEST["doc"];
	include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
	echo(menu_principal_documento(@$_REQUEST["iddoc"],@$_REQUEST["vista"]));
}
?>
<form action="notas_versiones.php"  method="POST" id="formulario_notas_versiones">
	<legend>Adicionar notas a la versi&oacute;n</legend>
	<div class="control-group element">
	  <label class="control-label" for="observaciones"><b>Observaciones*</b>
	  </label>
	  <div class="controls"> 
	  		<textarea tabindex="1" name="observaciones" id="observaciones" cols="53" rows="3" class="required"></textarea>
	  </div>
	</div>	
	<input type="hidden" name="idversion_documento" value="<?php echo($idversion_documento); ?>">	
	<input type="hidden" name="iddoc" value="<?php echo($iddoc); ?>">		
	<button type="submit" class="guardar btn btn-mini btn-primary" name="guardar" value="1">Guardar</button>
</form>
<?php
echo(librerias_jquery('1.7'));
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script>
  var formulario_notas_versiones=$("#formulario_notas_versiones");
	formulario_notas_versiones.validate();	
</script>
<?php 

	$notas_versiones=busca_filtro_tabla("","version_notas","fk_idversion_documento=".$idversion_documento,"fecha DESC",$conn);
	if($notas_versiones['numcampos']){
		$tabla_historial='<table class="table table-bordered">';
		$tabla_historial.='
			<tr>
				<th style="text-align:center;">Fecha</th>
				<th style="text-align:center;">Funcionario</th>
				<th style="text-align:center;">Observaciones</th>
			</tr>
		';
		for($i=0;$i<$notas_versiones['numcampos'];$i++){
			$fun=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$notas_versiones[$i]['funcionario_idfuncionario'],"",$conn);
			$nombre_fun=codifica_encabezado(html_entity_decode($fun[0]['nombres'].' '.$fun[0]['apellidos']));
			$tabla_historial.='
				<tr>
					<td style="text-align:center;">'.$notas_versiones[$i]['fecha'].'</td>
					<td>'.$nombre_fun.'</td>
					<td>'.codifica_encabezado(html_entity_decode($notas_versiones[$i]['observaciones'])).'</td>
				</tr>
			';			
		}
		$tabla_historial.='</table>';
		echo($tabla_historial);
	}
?>








