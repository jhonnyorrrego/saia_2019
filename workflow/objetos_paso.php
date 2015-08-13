<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
menu_pasos(0,$_REQUEST["idpaso"]);
$paso_documento=busca_filtro_tabla("","paso_documento A,documento B","A.documento_iddocumento=B.iddocumento AND idpaso_documento=".$_REQUEST["idpaso"],"",$conn);
if($paso_documento["numcampos"]){
$texto='<table width="85%" ><tr><td colspan="2">Datos del Documento</td></tr>';
  $texto.='<tr><td class="encabezado">N&uacute;mero de radicado</td><td>'.$paso_documento[0]["numero"].'</td></tr>';
  $texto.='<tr><td class="encabezado">Descripcion</td><td>'.$paso_documento[0]["descripcion"].'</td></tr>';
  $serie=busca_filtro_tabla("","serie","idserie=".$paso_documento[0]["serie"],"",$conn);
  $texto.='<tr><td class="encabezado">Tipo Documental</td><td>'.$serie[0]["nombre"].'</td></tr>';
  if($paso_documento[0]["plantilla"]){
    $formato=busca_filtro_tabla("","formato","lower(nombre) LIKE lower('".$paso_documento[0]["plantilla"]."')","",$conn);
    $texto.='<tr><td class="encabezado">Formato / Plantilla</td><td>'.$formato[0]["etiqueta"].'</td></tr>';
  }
  $texto.='<tr><td class="encabezado">Ir al documento</td><td><a href="../ordenar.php?key='.$paso_documento[0]["iddocumento"].'&accion=mostrar&mostrar_formato=1" target="centro">Detalles</a></td></tr>';
}
$texto.='</table>';
echo($texto);
?>