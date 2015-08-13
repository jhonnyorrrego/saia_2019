
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
function calcular_edad_hv($idformato,$iddoc){
$edad=busca_filtro_tabla(fecha_db_obtener("fecha_nacimiento","Y-m-d")." AS fecha_dif","ft_hoja_vida","documento_iddocumento=".$iddoc,"",$conn);
if($edad[0]["fecha_dif"]){ 
  tiempo_transcurrido($edad[0]["fecha_dif"],'2011-09-01');
}
}

function mostrar_anexos_hoja_vida($idformato,$iddoc){
global $conn,$ruta_db_superior;

$anexos=busca_filtro_tabla("ruta,etiqueta","anexos","documento_iddocumento=".$iddoc,"",$conn);
if($anexos["numcampos"]>0){
for ($i=0;$i<$anexos["numcampos"];$i++) {
echo "<a href=../../".$anexos[$i]["ruta"].">".$anexos[$i]["etiqueta"]."</a><br />";
}
} 
}
?>