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
function cargar_items_radicacion($idformato,$iddoc){
    global $conn;
    $registros=busca_filtro_tabla("b.idft_destino_radicacion,b.numero_item","ft_radicacion_entrada a,ft_destino_radicacion b,ft_item_despacho_ingres c, documento d,ft_despacho_ingresados e","b.ft_radicacion_entrada=a.idft_radicacion_entrada AND c.ft_destino_radicacio=b.idft_destino_radicacion AND d.iddocumento=a.documento_iddocumento AND c.ft_despacho_ingresados=e.idft_despacho_ingresados AND e.documento_iddocumento=".$_REQUEST['anterior'],"",$conn);
    $html="<td><select name='item_radicacion' id='item_radicacion'><option value=''>Seleccione</option>";
    for ($i=0; $i < $registros['numcampos']; $i++) { 
        $html.="<option value='".$registros[$i]['idft_destino_radicacion']."'>".$registros[$i]['numero_item']."</option>";
    }
    $html.="</select></td>";
    echo($html);
}
function mostrar_numero_item_novedad($idformato,$iddoc){
    $registros=busca_filtro_tabla("b.numero_item","ft_novedad_despacho a, ft_destino_radicacion b","a.item_radicacion=b.idft_destino_radicacion AND a.documento_iddocumento=".$iddoc,"",$conn);
    echo($registros[0]['numero_item']);
}
?>