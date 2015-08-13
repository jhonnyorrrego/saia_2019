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
if(!@$_REQUEST["idpaso"])
  die("Por favor Seleccione un Paso");
$arreglo1 = busca_filtro_tabla("*","paso A,paso_documento B","A.idpaso=B.paso_idpaso AND B.idpaso_documento=".$_REQUEST['idpaso'],"",$conn);
if($arreglo1[0]["estado"] == 1)
	$fin = "Activo";
if($arreglo1[0]["estado"] == 0)
	$fin = "Inactivo";  
?>  <br /><br />
<table border="0" width="100%">
  <tr>
    <td class="encabezado">Nombre paso</td>
    <td><?php echo $arreglo1[0][3]; ?></td>
  </tr>
  <tr>
    <td class="encabezado">Descripcion</td>
    <td><?php echo $arreglo1[0][1]; ?></td>
  </tr>
  <tr>
    <td class="encabezado">Estado</td>
    <td><?php echo $fin; ?></td>
  </tr>
</table>