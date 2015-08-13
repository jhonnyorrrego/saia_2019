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
$formatos=busca_filtro_tabla("","formato","","",$conn);
$mostrar='';
$mostrar.='<select name="bqsaia_plantilla" id="bqsaia_plantilla"><option value="">Seleccione...</option>';
for($i=0;$i<$formatos["numcampos"];$i++){
	$mostrar.='<option value="'.$formatos[$i]["nombre"].'">'.$formatos[$i]["etiqueta"].'</option>';
}
$mostrar.='</select><br><br>';
echo $mostrar;
?>