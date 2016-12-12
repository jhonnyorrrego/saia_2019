
<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");


function mostrar_anexos_soporte_plan_calidad($idformato,$iddoc){
    global $conn, $ruta_db_superior;
    
    
    $anexos=busca_filtro_tabla("","anexos","documento_iddocumento=".$iddoc,"",$conn);
	if($anexos['numcampos']){
		$tabla='<ul>';
	    for($j=0;$j<$anexos['numcampos'];$j++){
	        if($anexos[$j]['tipo']=='jpg' || $anexos[$j]['tipo']=='JPG' || $anexos[$j]['tipo']=='pdf' || $anexos[$j]['tipo']=='PDF' || $anexos[$j]['tipo']=='png'){
	            $tabla.="<li><a href='".$ruta_db_superior.$anexos[$j]['ruta']."' target='_blank'>".$anexos[$j]['etiqueta']."</a></li>";
	        }
	        else{
	            $tabla.='<li><a title="Descargar" href="'.$ruta_db_superior.'anexosdigitales/parsea_accion_archivo.php?idanexo='.$anexos[$j]['idanexos'].'&amp;accion=descargar" border="0px">'.$anexos[$j]['etiqueta'].'</a></li>';
	        }
							
	    }
		$tabla.='</ul>';
		echo($tabla);
	}
    
}


?>

