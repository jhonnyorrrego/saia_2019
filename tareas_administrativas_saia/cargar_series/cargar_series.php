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

//CONFIGURACION

/*CONDICIONES DEL ARCHIVO A SUBIR:
	- No debe existir comas(,) en los textos
 	- No debe existir saltos de linea dentro de las celdas
 	- Si se va a almacenar entidad_serie se debe validar que las dependencias existan en saia y que tengan el mismo nombre (incluidas tildes), de igual manera no funciona si no encuentra una dependencia. 
	 
*/
die();
$archivo="carga_final_series.csv"; //RUTA ARCHIVO A CARGAR
$insertar_entidad_serie=1; //SI SE DESEA O NO INSERTAR EN ENTIDAD_SERIE;
$consecutivo_serie=153; //EL ULTIMO CONSECUTIVO INGRESADO EN LA TABLA SERIE A INSERTAR
$cod_padre_fijos=array(); //COD_PADRES QUE NO CAMBIAN DE VALOR, ES DECIR QUE YA ESTAN CREADOS EN BASE DE DATOS

//---------------------------------------------------------------------------------------------------------------------


function tildes_html($cadena){ 
    return str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"),
                                         array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;",
                                                    "&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $cadena);     
}

$gestor = fopen($archivo, "rb");
if($gestor){
    $contenido = fread($gestor, filesize($archivo));
}
else{
    alerta("No se encuentra el CSV, verifique la ruta o los permisos");
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
        $dependencias_no_encontradas[]='- '.$dependencias[$i];
    }
}

$realizar_insert=0;
if(count($dependencias)==count($iddependencias)){
    $realizar_insert=1;
}else{
    if(!$insertar_entidad_serie){
        $realizar_insert=1;
    }else{
        echo('No fue posible encontrar las siguientes dependencias: <br><br>');
        echo(implode('<br>',$dependencias_no_encontradas));
        echo('<br><br>Por favor verifique el nombre de las dependencias e intentelo nuevamente.');       
    }
}

$series_no_insertadas=array();
$entidad_series_no_insertadas=array();
if($realizar_insert){
    for($i=6;$i<count($records);$i++){ //EMPIEZA A VALIDAD APARTIR DE LA COLUMNA 6
    	$valores=explode(',',$records[$i]);
    	if( $valores[2]!='' && $valores[4]!=''){  // C - E
    
            //SERIE
    		$fieldList=array();//cols
    		
    		$fieldList["idserie"] = intval($valores[0])+$consecutivo_serie; //A
    		$fieldList["codigo"] = $valores[1]; //B
    		$fieldList["nombre"] = html_entity_decode($valores[2]); //C
    		$fieldList["categoria"] = intval($valores[3]); //D
    		$fieldList["tipo"] = intval($valores[4]); //E
    		
    		if($valores[5]!='' && !is_null($valores[5])){
    			
				if(in_array($valores[5], $cod_padre_fijos)){
					$fieldList["cod_padre"] = intval($valores[5]); //F
				}else{
					$fieldList["cod_padre"] = intval($valores[5])+$consecutivo_serie; //F
				}	
    		}
    		
    		$fieldList["dias_entrega"] = intval($valores[6]); //G
    		$fieldList["retencion_gestion"] = intval($valores[7]); //H
    		$fieldList["retencion_central"] = intval($valores[8]); //I
    		$fieldList["conservacion"] = intval($valores[9]); //J
    		$fieldList["seleccion"] = intval($valores[10]); //K
    		$fieldList["digitalizacion"] = intval($valores[11]); //L
    		$fieldList["procedimiento"] = $valores[12]; //M
    		$fieldList["copia"] = intval($valores[13]); //N
    		$fieldList["estado"] =intval($valores[15]); //P
    		 
    		$tabla="serie";
    		$strsql = "INSERT INTO ".$tabla." (";
    		$strsql .= implode(",", array_keys($fieldList));			
    		$strsql .= ") VALUES ('";			
    		$strsql .= implode("','", array_values($fieldList));			
    		$strsql .= "')";
			
			//print_r($strsql);die('');
			
            phpmkr_query($strsql);
            $idserie=$fieldList["idserie"];              
			 
            //ENTIDAD_SERIE
            if($idserie && $insertar_entidad_serie){
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
            }else if(!$idserie){
                $series_no_insertadas[]=$strsql;
            }
        }
    }//fin for
    
    //LOG_ERROR
    
    if( count($series_no_insertadas) ){
    	$ruta_log='errores.txt';
		
        $fp = fopen($ruta_log, 'a');
        fwrite($fp, "----------------------------------------------------------------------------");
        fwrite($fp, "Series NO insertadas (".date('Y-m-d H:i:s').")");
        fwrite($fp, "\n");
        fwrite($fp, "\n");
        for($i=0;$i<count($series_no_insertadas);$i++){
            fwrite($fp, $series_no_insertadas[$i]);
            fwrite($fp, "\n");
        }
        fwrite($fp, "\n");
        fwrite($fp, "\n");         
        fclose($fp);
        chmod($ruta_log,0777);
		echo('problemas al insertar algunas series<br>');
    }
    if( count($entidad_series_no_insertadas) ){
    	$ruta_log='errores.txt';
        $fp = fopen($ruta_log, 'a');
        fwrite($fp, "----------------------------------------------------------------------------");
        fwrite($fp, "Entidad Series NO insertadas (".date('Y-m-d H:i:s').")");
        fwrite($fp, "\n");
        fwrite($fp, "\n");        
        for($i=0;$i<count($entidad_series_no_insertadas);$i++){
            fwrite($fp, $entidad_series_no_insertadas[$i]);
            fwrite($fp, "\n");
        }
        fwrite($fp, "\n");
        fwrite($fp, "\n");         
        fclose($fp); 
		chmod($ruta_log,0777);
        echo('problemas al insertar algunas entidad series<br>');       
    }
}

echo('fin: '.date('Y-m-d H:i:s')); 
die();
      
?> 
