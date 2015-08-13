<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
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

function mostrar_anexos_documento($idformato,$iddoc){
    global $conn,$ruta_db_superior;
   
    $anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);

    if($anexos["numcampos"]>0){
    	//$srt_anexos= 'Anexos: '; 
        for ($i=0;$i<$anexos["numcampos"];$i++) {
            $srt_anexos .= "<a href=../../".$anexos[$i]["ruta"].">".preg_replace('/\.\w*/','',$anexos[$i]["etiqueta"])."</a>,";
        }
    }
	echo html_entity_decode(substr($srt_anexos,0,-1));
}
?>