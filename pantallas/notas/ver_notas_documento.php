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
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");

$comentario=busca_filtro_tabla("*","comentario_img","documento_iddocumento=".$_REQUEST["iddoc"]." AND tipo='PLANTILLA' AND pagina='".$_REQUEST["iddoc"]."'","",$conn);

for($i=0; $i<$comentario["numcampos"]; $i++){
	$texto=$comentario[$i]["comentario"];  
    $nombre_usuario_nota = busca_filtro_tabla("nombres, apellidos","funcionario","login='".$comentario[$i]["funcionario"]."'","",$conn);
    ?>
    Comentario N&ordm;
    <?php   
    echo ($i+1).".  Autor: ".$nombre_usuario_nota[0]["nombres"]." ".$nombre_usuario_nota[0]["apellidos"]."&nbsp;&nbspFecha: ".$comentario[0]["fecha"]."&nbsp;&nbsp;Texto:".$texto."<br>";
}

$notas=busca_filtro_tabla("notas,nombres,apellidos,".fecha_db_obtener("fecha","Y-m-d H:i")." as fecha","buzon_salida,funcionario","funcionario_codigo=origen and destino=".usuario_actual("funcionario_codigo")." and trim(notas)<>'' and archivo_idarchivo=".$_REQUEST["iddoc"],"fecha desc",$conn);
if($notas["numcampos"]){
	echo "<font size=1>Notas Transferencias:<br />";
    for($i=0; $i<$notas["numcampos"]; $i++)
    	echo ($i+1).". Autor: ".$notas[$i]["nombres"]." ".$notas[$i]["apellidos"]." Fecha: ".$notas[$i]["fecha"]." Nota: ".$notas[$i]["notas"]."<br />";
   	echo "</font>";
} 

if(!$notas["numcampos"]&&!$comentario["numcampos"]){
	echo "No hay notas relacionadas";
}
?>