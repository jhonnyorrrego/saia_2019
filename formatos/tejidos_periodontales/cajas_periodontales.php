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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

$opciones= '
			<form id="form_tejidos" name="form_tejidos" action="'.$ruta_db_superior.'formatos/tejidos_periodontales/cajas_periodontales.php">
				<input type="hidden" name="caja" value='.$_REQUEST["caja"].'>
		
				<input type="hidden" name="documento" value='.$_REQUEST["documento"].'>

				<input type="checkbox" name="opciones[]" id="valor1" value="1">Inflamacion
				<br>
				<input type="checkbox" name="opciones[]" id="valor2" value="2">Recesiones
				<br>
				<input type="checkbox" name="opciones[]" id="valor3" value="3">Sangrado
				&nbsp;&nbsp;&nbsp;&nbsp;<br>
				<input type="checkbox" name="opciones[]" id="valor4" value="4">Placa blanda
				<br>
				<input type="checkbox" name="opciones[]" id="valor5" value="5">Movilidad
				&nbsp;&nbsp;&nbsp;
				<br><input type="checkbox" name="opciones[]" id="valor6" value="6">Placa calsificada
				<br>
				<input type="checkbox" name="opciones[]" id="valor7" value="7">Defecto oseo vertical
				<br>
				<input type="checkbox" name="opciones[]" id="valor8" value="8">Compromiso de furca
				<br>
				<input type="checkbox" name="opciones[]" id="valor9" value="9">Otros
				<input type="hidden" name="guardar_periodontales" value="1"/>
				<br><center><input type="submit" name="almacenar" value="guardar" id="almacenar" onclick="parent.window.hs.close()"></center>
			</form>
		  ';

echo($opciones);

	$opciones_activadas=busca_filtro_tabla($_REQUEST["caja"],"ft_tejidos_periodontales","documento_iddocumento=".$_REQUEST["documento"],"",$conn);
	
	
	$activadas=explode(",",$opciones_activadas[0][$_REQUEST["caja"]]);
	$contador=count($activadas);
	$activo=json_encode($activadas);
	
	echo(librerias_jquery("1.7"));

if($_REQUEST["guardar_periodontales"] == 1){
	guardar_opciones_periodontales(implode(",",$_REQUEST["opciones"]));		
}

function guardar_opciones_periodontales($opciones){
		global $conn;
		echo(librerias_highslide());
		
	$datos="UPDATE ft_tejidos_periodontales SET ".$_REQUEST["caja"]."='".$opciones."' WHERE documento_iddocumento =".$_REQUEST["documento"];
		
		phpmkr_query($datos,$conn);				
}

?>
<script type='text/javascript'>   
   $(document).ready(function(){
   	
	   	var cont="<?php echo($contador)?>";  	
	   	
	   	var dato=eval(<?php echo($activo)?>);  	   
   	   	
   	    for (var i=0; i < cont; i++) {
		  
		   if(dato[i]==1)
		   		$("#valor1").prop("checked", true);
		   
		   if(dato[i]==2)
		   		$("#valor2").prop("checked", true);
		   		
		   if(dato[i]==3)
		   		$("#valor3").prop("checked", true);
		   	
		   if(dato[i]==4)
		   		$("#valor4").prop("checked", true);
		   
		   if(dato[i]==5)
		   		$("#valor5").prop("checked", true);
		   		
		   if(dato[i]==6)
		   		$("#valor6").prop("checked", true);
		   		
		   if(dato[i]==7)
		   		$("#valor7").prop("checked", true);
		   
		   if(dato[i]==8)
		   		$("#valor8").prop("checked", true);
		   		
		   if(dato[i]==9)
		   		$("#valor9").prop("checked", true);
		}
   	 	
   	  });
</script>

