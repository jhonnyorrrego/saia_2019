<?php
include_once("../librerias/funciones_generales.php");
include_once("../../header.php");
if(@$_REQUEST["idhallazgo"]){
  $seguimiento=busca_filtro_tabla("A.*","ft_seguimiento A","A.ft_hallazgo=".$_REQUEST["idhallazgo"],"idft_seguimiento DESC",$conn);
  if($seguimiento["numcampos"]){
    echo(listar_formato_hijo(array("logros_alcanzados","observaciones","porcentaje"),"ft_seguimiento","ft_hallazgo",$_REQUEST["idhallazgo"],"idft_seguimiento asc"));
  }

}
include_once("../../footer.php");
?>
<script>
window.document.getElementById("header").style.display="none";</script>
