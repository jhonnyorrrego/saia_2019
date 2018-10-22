<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}

include_once($ruta_db_superior."db.php");

function codigo_serie($idserie){
    global $ruta_db_superior,$conn;
    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);
    if($datos[0]['tipo']==1){
        return $datos[0]['codigo'];
    }
    
}

function codigo_subserie($idserie){
    global $ruta_db_superior,$conn;
    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);
    if($datos[0]['tipo']==2){
        return $datos[0]['codigo'];
    }
}

function nombre_serie($idserie){
    global $ruta_db_superior,$conn;
    $datos=busca_filtro_tabla('','serie','idserie='.$idserie,'',conn);
    if($datos[0]['tipo']==1){
        return ("<span style='color: black;'>".$datos[0]['nombre']."<span>");
    }else{
        return ("<span style='color: black;'>".$datos[0]['nombre']."<span>");
    }
}

function condicion_adicional_series(){
    global $ruta_db_superior,$conn;
    
    //$condicion=" AND iddependencia=-1";
    if(@$_REQUEST['variable_busqueda']){
        $condicion="AND iddependencia=".$_REQUEST['variable_busqueda'];
    }
    
    return $condicion;
}

function colocar_select_dependencias(){
    global $ruta_db_superior,$conn;
    
    $select="<select class='pull-left btn btn-mini dropdown-toggle' style='height:34px; margin-left: 30px;' name='filtro_dependencias' id='filtro_dependencias'>";
    $select.="<option value=''>Por favor seleccione</option>";
    $datos=busca_filtro_tabla("iddependencia, nombre","dependencia","estado=1","nombre ASC",$conn);
    //print_r($datos);die();
    for($i=0;$i<$datos['numcampos'];$i++){
    	if(@$_REQUEST['variable_busqueda']==$datos[$i]['iddependencia']){
    		$select.="<option value='{$datos[$i]['iddependencia']}' selected>{$datos[$i]['nombre']}</option>";
    	}else{
    		$select.="<option value='{$datos[$i]['iddependencia']}'>{$datos[$i]['nombre']}</option>";
    	}
        
    }
    $select.="</select>";

    return $select;
}
