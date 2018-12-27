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


if(@$_REQUEST["valor"]){
    $datos=busca_filtro_tabla(concatenar_cadena_sql(array("ISNULL(A.nombres,'')","' '","ISNULL(A.apellidos,'')","' ('",'A.cargo',"' - '",'A.dependencia',"')'"))." as nombre, A.iddependencia_cargo as id, A.estado, A.nombres, A.apellidos, A.estado_dc, A.idfuncionario","vfuncionario_dc A","".concatenar_cadena_sql(array("ISNULL(A.nombres,'')","' '","ISNULL(A.apellidos,'')"))." like '%".htmlentities(str_replace(" ","%",trim($_REQUEST["valor"])))."%' ","A.estado, nombre",$conn);
    
    if($datos['numcampos']){
        $html="<ul>";
        for($i=0;$i<$datos['numcampos'];$i++){
            if($datos[$i]["estado"]==1 && $datos[$i]["estado_dc"]==1){
                $html.="<li onclick=\"cargar_datos(".$datos[$i]['id'].",'".eregi_replace("[\n|\r|\n\r]", "", trim($datos[$i]['nombre']))."',1)\">".eregi_replace("[\n|\r|\n\r]", "", trim($datos[$i]['nombre']))."</li>";
            }
            else if($datos[$i]["estado"]==0){
                if(!in_array($datos[$i]['idfuncionario'],$no_encontrados)){
                    $html.="<li>".eregi_replace("[\n|\r|\n\r]", "", trim($datos[$i]['nombres'])." ".trim($datos[$i]['apellidos']))." (El funcionario no se encuentra activo, comuniquese con el administrador)</li>";
                    $no_encontrados[]=$datos[$i]['idfuncionario'];
                }
            }
        }
        $html.="</ul>";
    }
    echo utf8_encode($html);
}