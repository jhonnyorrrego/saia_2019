<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
include_once($ruta_db_superior."pantallas/pagina/librerias.php");
echo(estilo_bootstrap());
if($_REQUEST['evento'] == 'Aceptar'){
	eliminar_paginas_documento($_REQUEST['paginas'],$_REQUEST['iddocumento'],$_REQUEST['justificacion']);	
}
$pagina=  busca_filtro_tabla("", "pagina", "consecutivo=".$key, "", $conn);
?>
<form class="form-horizontal" name="confirma_eliminacion_pagina" id="eliminar_pagina" action="#" method="POST">
	<legend class="texto-azul">Eliminar p&aacute;ginas</legend>
  <div class="control-group">
  	<?php $pagina=  busca_filtro_tabla("", "pagina A, documento B","A.id_documento=B.iddocumento AND consecutivo IN (".$_REQUEST['paginas'].") " , "", $conn);?>  	
    <label class="control-label">Documento <?php echo($pagina[0]['numero'].'-'.$pagina[0]['plantilla']);?></label>    
    <div class="controls">            	      
      	<?php		
				for($i=0 ; $i< $pagina['numcampos']; $i++) {
					$texto .='<br />Pagina No '.$pagina[$i]['pagina'];															 	
				}
				echo($texto);
  			?>   
  	</div>
  <div class="control-group">
    <label class="control-label" for="inputJustificacion">Justificaci&oacute;n</label>
    <div class="controls">
      <textarea id="inputJustificacion" name="justificacion" required></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="control-label">
      <input type="hidden" name="paginas" value="<?php echo($_REQUEST['paginas']);?>">        
    	<input type="hidden" name="iddocumento" value="<?php echo($_REQUEST['iddocumento']);?>">
			<input type="submit" name="evento" class="btn btn-mini btn-primary" style="font-family: verdana; font-size: 10px;" value="Aceptar">
			<buttom name="cancelar" id="cancelar" class="btn btn-mini" style="font-family: verdana; font-size: 10px;">Cancelar</button>      
    </div>
  </div>
</form>
<?php	
	function eliminar_paginas_documento($paginas,$iddocumento,$justificacion){
		global $conn,$ruta_db_superior;		
		$idpaginas = explode(',',$paginas);				
		$idfuncionario = usuario_actual('idfuncionario');			
		foreach ($idpaginas as $key){			
			$sql_delete = "DELETE FROM pagina WHERE consecutivo=".$key.' AND id_documento='.$iddocumento;						
				phpmkr_query($sql_delete);
			$sql_digitalizacion ="INSERT INTO digitalizacion (documento_iddocumento,fecha,accion,funcionario, justificacion)VALUES (".$iddocumento.",'".date('Y-m-d H:m:s')."','ELIMINACION PAGINA','".$idfuncionario."','Identificador:".$key.",".$justificacion."')";
				phpmkr_query($sql_digitalizacion);
									
		}		
		$resultado = ordenar_paginas_documento($iddocumento);		
?>
<script type="text/javascript">
parent.window.hs.close();
</script>
<?php	
	}	
echo(librerias_jquery('1.7'));		
echo(librerias_validar_formulario());
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#cancelar').live('click',function(){
		parent.window.hs.close();	
	});
	$('#eliminar_pagina').validate();	
});
</script>