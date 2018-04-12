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
echo(librerias_notificaciones());

if($_REQUEST['evento'] == 'Aceptar'){
	eliminar_paginas_documento2($_REQUEST['paginas'],$_REQUEST['iddocumento'],$_REQUEST['justificacion']);	
}
?>
<form class="form-horizontal" name="confirma_eliminacion_pagina" id="eliminar_pagina" action="#" method="POST">
	<legend class="texto-azul">Eliminar p&aacute;ginas</legend>
  <div class="control-group">
  	<?php $pagina=  busca_filtro_tabla("", "pagina A, documento B","A.id_documento=B.iddocumento AND consecutivo IN (".$_REQUEST['paginas'].") " , "", $conn);?>  	
    <label class="control-label"><b>Documento <?php echo($pagina[0]['numero'].'-'.$pagina[0]['plantilla']);?></b></label>    
    <div class="controls">            	      
      	<?php		
				for($i=0 ; $i< $pagina['numcampos']; $i++) {
					$texto .='<br />Pagina No '.$pagina[$i]['pagina'];															 	
				}
				echo($texto);
  			?>   
  	</div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputJustificacion"><b>Justificaci&oacute;n</b></label>
    <div class="controls">
      <textarea id="inputJustificacion" name="justificacion" required></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="control-label">
      <input type="hidden" name="paginas" value="<?php echo($_REQUEST['paginas']);?>">        
    	<input type="hidden" name="iddocumento" value="<?php echo($_REQUEST['iddocumento']);?>">
			<input type="submit" name="evento" class="btn btn-mini btn-primary" style="font-family: verdana; font-size: 10px;" value="Aceptar">

    </div>
  </div>
</form>
<?php	

	function eliminar_paginas_documento2($paginas,$iddocumento,$justificacion){
		global $conn,$ruta_db_superior;		
		$idpaginas = explode(',',$paginas);				
		$idfuncionario = usuario_actual('idfuncionario');			
		foreach ($idpaginas as $key){
			$inf_eliminado = busca_filtro_tabla("imagen,ruta","pagina","consecutivo=".$key,"",$conn);
			if($inf_eliminado["numcampos"]){
			$arr_imagen = StorageUtils::resolver_ruta($inf_eliminado[0]["imagen"]);
			$arr_origen = StorageUtils::resolver_ruta($inf_eliminado[0]["ruta"]);
			$alm_origen = $arr_origen["clase"];
			$alm_imagen = $arr_imagen["clase"];
				 
			$alm_backup = new SaiaStorage(RUTA_BACKUP_ELIMINADOS);
			$ruta_eliminacion = RUTA_BACKUP_ELIMINADOS . $iddocumento;
			$nombre = $iddocumento . "/" . date("Y-m-d_H_i_s") . "_" . basename($arr_origen["ruta"]);
			//crear_destino($ruta_eliminacion);
			//copy($ruta, $nombre);
			$alm_origen->copiar_contenido($alm_backup, $arr_origen["ruta"], $nombre);
			if ($alm_imagen->eliminar($arr_imagen["ruta"]) && $alm_origen->eliminar($arr_origen["ruta"])) {
							$sql_delete = "DELETE FROM pagina WHERE consecutivo=".$key.' AND id_documento='.$iddocumento;						
							phpmkr_query($sql_delete);
							$sql_digitalizacion ="INSERT INTO digitalizacion (documento_iddocumento,fecha,accion,funcionario, justificacion)VALUES (".$iddocumento.",'".date('Y-m-d H:m:s')."','ELIMINACION PAGINA','".$idfuncionario."','Identificador:".$key.",".$justificacion."')";
							phpmkr_query($sql_digitalizacion);
					}
			}						
		}		
		$resultado = ordenar_paginas_documento($iddocumento);	
		?>
		<script>
			notificacion_saia('Se ha eliminado la pagina','success','',4000);
			window.open("<?php echo $ruta_db_superior;?>ordenar.php?key=<?php echo $iddocumento;?>&mostrar_formato=1","_parent")
		</script>
		<?php
		die();
	}	
echo(librerias_jquery('1.7'));		
echo(librerias_validar_formulario());
?>
<script type="text/javascript">
$(document).ready(function(){
	$('#eliminar_pagina').validate();	
});
</script>
