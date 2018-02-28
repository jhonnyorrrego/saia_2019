<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once($ruta_db_superior. 'db.php');
$funciones=busca_filtro_tabla('','funciones_formato','','',$conn);
$texto='';
for ($i = 0; $i < $funciones["numcampos"]; $i++) {
    $formato_array=array();
    $lista_formatos=explode(",",$funciones[$i]["formato"]);
    $lista_formatos=array_unique($lista_formatos);
    $formato=busca_filtro_tabla("","formato","idformato IN(".implode(",",$lista_formatos).")","",$conn);
    //echo($formato["sql"]."--->".$formato["numcampos"]."<br>");
    if($formato["numcampos"]){
        for($j=0;$j<$formato["numcampos"];$j++){
            $cad_sql="INSERT INTO funciones_formato_enlace(funciones_formato_fk,formato_idformato) VALUES(".$funciones[$i]["idfunciones_formato"].",".$formato[$j]["idformato"].");";
            echo($cad_sql."<br>");
            array_push($formato_array,$formato[$j]["idformato"]);
        }
    }
    else{
        if(count($lista_formatos)==1){
            $texto.='DELETE FROM funciones_formato WHERE idfunciones_formato='.$funciones[$i]["idfunciones_formato"].";\n<br>";
        }
        foreach($lista_formatos AS $key=>$valor){
            $campos_formato=busca_filtro_tabla("","campos_formato","formato_idformato=".$valor,"",$conn);
            if($campos_formato["numcampos"]){
                $texto.='DELETE FROM campos_formato WHERE formato_idformato='.$valor.";<br>";
            }
        }
    }
    if($formato["numcampos"]!=count($lista_formatos)){
        $diff=array_diff($formato_array,$lista_formatos);
        if(count($diff)){
            echo("Existe inconsistencia con los formatos ".print_r($diff,true)."<hr>");
        }
    }
    
}
echo($texto);
?>