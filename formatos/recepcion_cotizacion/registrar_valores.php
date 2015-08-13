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
$id=@$_REQUEST["id"];
$valor=str_replace(".","",@$_REQUEST["x_valor"]);
$idft=@$_REQUEST["idft"];
$valor_subtotal=$_REQUEST["valor_subtotal"];
$iddoc_recep=$_REQUEST['iddoc_recepcion'];
$iva=$_REQUEST['iva_recep'];
$total=$valor_subtotal+(($iva*$valor_subtotal)/100);

if($iddoc_recep){
$UPDATE="UPDATE ft_recepcion_cotizacion SET valor_total='".str_replace(".",",",$total)."',subtotal='".str_replace(".",",",$valor_subtotal)."' WHERE documento_iddocumento=".$iddoc_recep;
phpmkr_query($UPDATE);
}

$busqueda=busca_filtro_tabla("","ft_valores_item_recepcion A","A.fk_idft_item='".$id."' AND A.ft_recepcion_cotizacion=".$idft,"",$conn);

if($busqueda["numcampos"]){
	$sql1="UPDATE ft_valores_item_recepcion SET valor='".$valor."' where fk_idft_item='".$id."' AND ft_recepcion_cotizacion=".$idft;
	phpmkr_query($sql1);
}else{
	$sql1="INSERT INTO ft_valores_item_recepcion(valor,fk_idft_item,ft_recepcion_cotizacion)values('".$valor."','".$id."',".$idft.")";
	phpmkr_query($sql1);
}
echo ($UPDATE." -- ".$sql1);
?>