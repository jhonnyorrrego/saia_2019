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
$_REQUEST["tabla"]="dependencia_cargo";
if($_REQUEST['tabla']){
    $tabla=$_REQUEST['tabla'];
    $_REQUEST["nombre"]=strtolower($_REQUEST["nombre"]);
    
    $busca_papas=busca_filtro_tabla("iddependencia_cargo,iddependencia","vfuncionario_dc"," ISNULL(nombres,'')+' '+ISNULL(apellidos,'') like('%".$_REQUEST['nombre']."%') OR ISNULL(nombres,'')+' '+ISNULL(apellidos,'') like('%".str_replace(" ", "%", $_REQUEST['nombre'])."%')","cod_padre",$conn);
    
    $resultados=array();
    $funcionarios=array();
    $dependencias=array();
    if($busca_papas['numcampos']){
        for ($i=0; $i < $busca_papas['numcampos']; $i++) {
            lista_papas($busca_papas[$i]['iddependencia'], $tabla);
            $funcionarios[]=$busca_papas[$i]['iddependencia_cargo'];
        }
    }else{
		$busca_papas_dep=busca_filtro_tabla("iddependencia","dependencia","lower(nombre) like('%".$_REQUEST['nombre']."%')","cod_padre",$conn);
    	for ($i=0; $i < $busca_papas_dep['numcampos']; $i++) {
    		lista_papas($busca_papas_dep[$i]['iddependencia'], $tabla);
    		$dependencias[]=$busca_papas_dep[$i]['iddependencia']."#";
    	}
    }    
    if(!$busca_papas["numcampos"] && !$busca_papas_dep["numcampos"]){
    	echo(json_encode(array("error"=>1,"mensaje"=>"No se encuentra informaci&oacute;n sobre ".$_REQUEST["nombre"])));
    }
    else{
    	$resultados2["datos"]=implode(",",($resultados));
    	$resultados2["funcionarios"]=array_unique($funcionarios);
    	$resultados2["numcampos_func"]=$busca_papas["numcampos"];
    	$resultados2["dependencias"]=array_unique($dependencias);
    	$resultados2["numcampos_dep"]=$busca_papas_dep["numcampos"];
    	$resultados2["error"]=0;
    	echo(json_encode($resultados2));
    }
    
}
function lista_papas($id,$tabla){
    global $conn,$resultados;
    $buscar_campo=busca_filtro_tabla("cod_padre","dependencia","cod_padre IS NOT NULL AND iddependencia=".$id,"cod_padre",$conn);
    if($buscar_campo["numcampos"]){
        lista_papas($buscar_campo[0]["cod_padre"], $tabla);
    }
    if($id==0){
    	if(array_search($id,$resultados)===false){
    		$resultados[]=$id;
    	}
    }
    else{
    	if(array_search($id,$resultados)===false){
    		$resultados[]=$id."#";
    	}
    }
    return;
}
?>