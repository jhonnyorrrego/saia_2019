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

if(@$_REQUEST['cargar']){
	
	$iddoc=@$_REQUEST['iddoc'];
	$idformato=@$_REQUEST['idformato'];
	
	$anexo=busca_filtro_tabla("d.ruta,d.idanexos,c.idcampos_formato","documento a, formato b, campos_formato c, anexos d","lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=".$iddoc." AND d.documento_iddocumento=".$iddoc,"",$conn) ;
	
	if($anexo['numcampos']){
		
		for($i=0;$i<$anexo['numcampos'];$i++){
			$ruta_docx=$ruta_db_superior.$anexo[$i]["ruta"];	
			
			if(file_exists($ruta_docx)){
				chmod($ruta_docx,0777);
				unlink($ruta_docx);
			}			
		}
		
		include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");
		for($i=0;$i<$anexo['numcampos'];$i++){
			eliminar_archivo($anexo[$i]['idanexos'],$anexo[$i]['idcampos_formato'],$idformato,$iddoc);
			$sqld="DELETE FROM anexos WHERE idanexos=".$anexo[$i]['idanexos'];
			phpmkr_query($sqld);
		}		
	}else{
		include_once($ruta_db_superior."anexosdigitales/funciones_archivo.php");
		$anexo=busca_filtro_tabla("idcampos_formato","campos_formato","nombre='anexo_word' AND formato_idformato=".$idformato,"",$conn);
	}
	cargar_archivo($iddoc,'',$idformato, $anexo[0]['idcampos_formato']);		
	
	/*$anexo = busca_filtro_tabla("d.ruta,d.idanexos", "documento a, formato b, campos_formato c, anexos d", "lower(a.plantilla)=b.nombre AND b.idformato=c.formato_idformato AND c.nombre='anexo_word' AND c.idcampos_formato=d.campos_formato AND a.iddocumento=" . $iddoc . " AND d.documento_iddocumento=" . $iddoc, "", $conn);
	
	$vector_ruta=explode('../',$anexo[0]['ruta']);
	$nueva_ruta='../'.$vector_ruta[ count($vector_ruta)-1 ];
	$sql="UPDATE anexos SET ruta='".$nueva_ruta."' WHERE idanexos=".$anexo[0]['idanexos'];
	phpmkr_query($sql);*/

	$_REQUEST['from_externo']=1;
	include_once($ruta_db_superior.'pantallas/lib/PhpWord/exportar_word.php');
	
	echo "
		<script>
			window.parent.hs.close();
			window.parent.parent.location.reload();
		</script>
	";	
}else{
	
	?>
	
<form action="cargar_word.php" method="POST"
	enctype="multipart/form-data">
	<input type="file" name="anexos[]" id="anexos[]" /> <input
		type="hidden" name="iddoc" id="iddoc"
		value="<?php echo(@$_REQUEST['iddoc']); ?>" /> <input type="hidden"
		name="idformato" id="idformato"
		value="<?php echo(@$_REQUEST['idformato']); ?>" /> <input
		type="hidden" name="cargar" id="cargar" value="1" /> <br> <input
		type="submit" name="enviar" id="enviar" value="Cargar" />
		</form>
	
	<?php
}

?>
