<?php
include_once("db.php");
include_once("header.php");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  @ob_start();
}
date_default_timezone_set ("America/Bogota");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  $_SESSION["LOGIN".LLAVE_SAIA]=$_POST['sesion'];
}
$clientes=busca_filtro_tabla("","ft_cliente","1=1","",$conn);
$texto.='<br /><br /><div align="center"><table border="1px" style="border-collapse:collapse;" cellpadding="20px"><tr>';
$items_fila=4;
for($i=0,$j=0;$i<$clientes["numcampos"];$i++){
  $logo=busca_filtro_tabla("","anexos","campos_formato=1203 AND documento_iddocumento=".$clientes[$i]["documento_iddocumento"],"idanexos DESC",$conn);
  //print_r($logo);
  $texto.='<td title="<b>Tel&eacute;fono:</b>'.$clientes[$i]["telefono"].'<br /><b>Actividad:</b>'.strip_tags(html_entity_decode($clientes[$i]["actividad"])).'" align="center" ><a href="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$clientes[$i]["documento_iddocumento"].'" target="_self"><b>'.$clientes[$i]["empresa"].'</b><br />';
  if($logo["numcampos"]){
    $texto.='<img src="'.$logo[0]['ruta'].'" border="0px";>';
  }
  $texto.='</a></td>';
  $j++;
  if(($j%$items_fila==0) && $j>0){
    $texto.='</tr><tr>';
  }
}
for($j;($j%$items_fila)!=0 && $j>0;$j++){
  $texto.="<td>&nbsp;</td>";
}                    
$texto.='</tr></table></div>';
echo($texto);
include_once("footer.php");
?>
<!--frameset cols="300,*">
     <frame name="izquierda" src="formatos/arboles/arbol_clientes.php" border="1" marginwidth="0" marginheight="10" scrolling="auto">
     <frame name="detalles" src="" marginwidth="10" marginheight="10" scrolling="auto" >
<frameset-->  
