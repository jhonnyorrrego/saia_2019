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

$archivo="prueba_carga.csv";
$gestor = fopen($archivo, "rb");
if($gestor){
    $contenido = fread($gestor, filesize($archivo));
}
else{
    alerta("No Se Realizo la Actualizacion de Datos de Intranet por el archivo");
    return(false);
}
fclose($gestor);
$records = explode("\n",$contenido);

//VALIDO EXISTENCIA DE TODAS LAS DEPENDENCIAS
$dependencias=array();
for($i=6;$i<count($records);$i++){ //EMPIEZA A VALIDAD APARTIR DE LA COLUMNA 6
	$valores=explode(',',$records[$i]);
	if( $valores[2]!='' && $valores[4]!=''){  // C - E
	    $entidad=html_entity_decode($valores[14]); // O
	    $dependencias[]=$entidad;
	}
}	
$dependencias=array_unique($dependencias);
$dependencias=htmlentities($dependencias);

print_r($dependencias);

$dependencias=explode(',',TildesHtml(implode(',',$dependencias)));

print_r($dependencias);

function TildesHtml($cadena){ 
    return str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
                                         array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
                                                    "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);     
}

$iddependencias=array();
for($i=0;$i<count($dependencias);$i++){
    $busca_dependencia=busca_filtro_tabla("","dependencia","estado=1 AND lower(nombre) like'".strtolower($dependencias[$i])."' ","",$conn);
    
    if($busca_dependencia['numcampos']){
        $iddependencias[$dependencias[$i]]=$busca_dependencia[0]['iddependencia'];
    }
    
    
    
}



print_r($iddependencias);

for($i=6;$i<count($records);$i++){ //EMPIEZA A VALIDAD APARTIR DE LA COLUMNA 6
	$valores=explode(',',$records[$i]);
	if( $valores[2]!='' && $valores[4]!=''){  // C - E

        //SERIE
		$fieldList=array();//cols
		$fieldList["codigo"] = $valores[1]; //B
		$fieldList["nombre"] = utf8_encode($valores[2]); //C
		$fieldList["categoria"] = $valores[3]; //D
		$fieldList["tipo"] = $valores[4]; //E
		$fieldList["cod_padre"] = $valores[5]; //F
		$fieldList["dias_entrega"] = $valores[6]; //G
		$fieldList["retencion_gestion"] = $valores[7]; //H
		$fieldList["retencion_central"] = $valores[8]; //I
		$fieldList["conservacion"] = $valores[9]; //J
		$fieldList["seleccion"] = $valores[10]; //K
		$fieldList["digitalizacion"] = $valores[11]; //L
		$fieldList["procedimiento"] = $valores[12]; //M
		$fieldList["copia"] = $valores[13]; //N
		$fieldList["estado"] = $valores[15]; //P
		
		$tabla="serie";
		$strsql = "INSERT INTO ".$tabla." (";
		$strsql .= implode(",", array_keys($fieldList));			
		$strsql .= ") VALUES ('";			
		$strsql .= implode("','", array_values($fieldList));			
		$strsql .= "')";
       // phpmkr_query($strsql);
        $idserie=phpmkr_insert_id();
        
        //ENTIDAD_SERIE
        
        $entidad=utf8_encode($valores[14]); // O
        
        //PENDIENTE DESARROLLAR INSERT ENTIDAD SERIE 
        //$entidad : llega el nombre, solo hay que hacer la busqueda like a dependencia.
        $dependencia=busca_filtro_tabla("","dependencia","","",$conn);

    }
}
 
die();
      
?> 
