<?php
include_once("../../db.php");
$estado=-1;
$arreglo=array('activo','jubilado','retirado');
if($_REQUEST["iddoc"] && $_REQUEST["idformato"]){
  $actual = busca_filtro_tabla("idft_hoja_vida,estado","ft_hoja_vida","documento_iddocumento=".$_REQUEST["iddoc"],"",$conn);
  $longitud=count($arreglo);
  for($i=0;$i<$longitud;$i++){
    if($actual[0]["estado"]==$arreglo[$i]){
      $estado=$i;
    }
  }
  //echo($estado."<br /><br />".$arreglo[($estado+1)]);
  if(($estado+1)==$longitud)
    $estado=-1;
$sql="UPDATE ft_hoja_vida SET estado='".$arreglo[($estado+1)]."' WHERE documento_iddocumento=".$_REQUEST["iddoc"];
phpmkr_query($sql,$conn);
abrir_url('mostrar_hoja_vida.php?iddoc='.$_REQUEST["iddoc"]."&idofrmato=".$_REQUEST["idformato"],"_self");
}
?>
