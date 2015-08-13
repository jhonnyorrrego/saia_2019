<?php 
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");

function phrqid($idformato,$iddoc){
	
 	echo "<td><input type='hidden' name='campo_phrqid' id='campo_phrqid' value='123'></td>";

}
function phbuyc($idformato,$iddoc){
	
	echo "<td><input type='hidden' name='codigo_comprador' id='codigo_comprador' value='123'></td>";


}
function phvend($idformato,$iddoc){

	echo "<td><input type='hidden' name='codigo_proveedor' id='codigo_proveedor' value='123'></td>";

}
function enlace_item_requisicion_compra($idformato,$iddoc){
    global $conn;
$estado_doc=busca_filtro_tabla("","ft_requisicion_compra A, documento B","A.documento_iddocumento = B.iddocumento AND B.estado NOT IN('ELIMINADO','ANULADO') AND A.documento_iddocumento=".$iddoc,"",$conn);
    
    $datos_papa=busca_filtro_tabla("","ft_requisicion_compra A","A.documento_iddocumento=".$iddoc,"",$conn);
//Datos del ITEM
    $datos=busca_filtro_tabla("B.*","ft_requisicion_compra A, ft_hpo B","A.idft_requisicion_compra=B.ft_requisicion_compra AND A.documento_iddocumento=".$iddoc,"B.idft_hpo",$conn);
    
    $idformato_item=busca_filtro_tabla("A.idformato","formato A","A.nombre='hpo'","",$conn);
    if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
        $enlace_campos="<a href='http://".RUTA_PDF."/formatos/hpo/adicionar_hpo.php?pantalla=padre&idpadre=".$iddoc."&idformato=".$idformato."&padre=".$datos_papa[0]['idft_requisicion_compra']."'>Adicionar CAMPOS item </a><br/><br/>";
                
        echo($enlace_campos);
    }
 }
?>