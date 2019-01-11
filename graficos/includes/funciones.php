<?php
function valida($dato,$default=false){
if(isset($_REQUEST[$dato])){
  return($_REQUEST[$dato]);
}
else if(isset($_SESSION[$dato]))
  return($_SESSION[$dato]);
else return($default);  
}
function arreglo_sql($sql,$conn){
$retorno=array();
$rs=phpmkr_query($sql,$conn) or die("Error en Bsqueda de Proceso SQL: $sql");
$temp=@phpmkr_fetch_array($rs);
$i=0;
for(;$temp;$temp=phpmkr_fetch_array($rs),$i++)
 array_push($retorno,$temp);
$retorno["numcampos"]=$i;
if($rs)
  phpmkr_free_result($rs);
return($retorno);
}
function remplaza($dato){
  $remplazo=valida("remplazo");
  if($remplazo){
    $remplazo1=explode(";",$remplazo);
    $cont1=0;
    if(is_array($remplazo1))
      $cont1=count($remplazo); 
    for($i=0;$i<=$cont1;$i++){
      $remplazo2=explode(",",$remplazo1[$i]);
      if($remplazo2[0]==$dato)
        return($remplazo2[1]); 
    }
  }
return($dato);
}
function valor_minimo($dato,$valor){
if($dato<$valor)
  return($valor);
return($dato);  
}
?>
