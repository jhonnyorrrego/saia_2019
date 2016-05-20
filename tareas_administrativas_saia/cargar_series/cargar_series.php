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

function tildes_html($cadena){ 
    return str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
                                         array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
                                                    "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);     
}

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
$dependencias=explode(',',tildes_html(implode(',',$dependencias)));
$iddependencias=array();
$dependencias_no_encontradas=array();
for($i=0;$i<count($dependencias);$i++){
    $busca_dependencia=busca_filtro_tabla("","dependencia","estado=1 AND lower(nombre) like'".strtolower($dependencias[$i])."' ","",$conn);
    if($busca_dependencia['numcampos']){
        $iddependencias[$dependencias[$i]]=$busca_dependencia[0]['iddependencia'];
    }else{
        $dependencias_no_encontradas[]=$dependencias[$i];
    }
}

$realizar_insert=0;
if(count($dependencias)==count($iddependencias)){
    $realizar_insert=1;
}else{
    echo('No fue posible encontrar las siguientes dependencias: <br><br>');
    echo(implode('<br>',$dependencias_no_encontradas));
}


$series_no_insertadas=array();
$entidad_series_no_insertadas=array();
if($realizar_insert){
    for($i=6;$i<count($records);$i++){ //EMPIEZA A VALIDAD APARTIR DE LA COLUMNA 6
    	$valores=explode(',',$records[$i]);
    	if( $valores[2]!='' && $valores[4]!=''){  // C - E
    
            //SERIE
    		$fieldList=array();//cols
    		$fieldList["codigo"] = $valores[1]; //B
    		$fieldList["nombre"] = html_entity_decode($valores[2]); //C
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
            phpmkr_query($strsql);
            $idserie=phpmkr_insert_id();
            
            //ENTIDAD_SERIE
            if($idserie){
                $entidad=html_entity_decode($valores[14]); // O
        		$fieldList2=array();//cols
        		$fieldList2["entidad_identidad"] = 2;
        		$fieldList2["serie_idserie"] = $idserie;
        		$fieldList2["llave_entidad"] = $iddependencias[$entidad];
         		$tabla="entidad_serie";
        		$strsql2 = "INSERT INTO ".$tabla." (";
        		$strsql2 .= implode(",", array_keys($fieldList2));			
        		$strsql2 .= ") VALUES ('";			
        		$strsql2 .= implode("','", array_values($fieldList2));			
        		$strsql2 .= "')";  
        		phpmkr_query($strsql2);
        		$entidad_serie=phpmkr_insert_id();
        		if(!$entidad_serie){
        		    $entidad_series_no_insertadas[]=$strsql2;
        		}
            }else{
                $series_no_insertadas[]=$strsql;
            }
        }
    }
}


if(count($series_no_insertadas)){
    
}

 
die();
      
?> 
