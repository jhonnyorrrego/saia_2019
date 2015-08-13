<?php
function filtro_estado($estado){
	return " AND B.estado IN('".$estado."') ";
}
function foto_hoja_vida($iddoc){
$idformato=71;
$dato=busca_filtro_tabla("","ft_hoja_vida","idft_hoja_vida=".$idft_hoja_vida,"",$conn);
$foto=busca_filtro_tabla("consecutivo,imagen,ruta","pagina","id_documento=".$iddoc,"pagina DESC LIMIT 0,1",$conn);
  if($foto["numcampos"]){
    return("<div class='thumbnail'><img src='../../".$foto[0]["imagen"]."'></div>");
  }
  else return("<a href='../../paginaadd.php?key=".$iddoc."&x_enlace=".$_SERVER["PHP_SELF"]."&idformato=".$idformato."&iddoc=$iddoc'><div class='thumbnail' style='height:120px; width:90px'>&nbsp;&nbsp;Sin Foto&nbsp;&nbsp;</div></a>");
} 
?>
