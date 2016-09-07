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

$archivo="cargar_tareas_final.csv";
$gestor = fopen($archivo, "rb");
if($gestor){
    $contenido = fread($gestor, filesize($archivo));
}
else{
    echo("No Se Realizo la Actualizacion de Datos de Intranet por el archivo");
    return(false);
}
fclose($gestor);
$records = explode("\n",$contenido);


$realizar_insert=1;
$tareas_no_insertadas=array();
if($realizar_insert){
    for($i=1;$i<count($records);$i++){ //EMPIEZA A VALIDAD APARTIR DE LA COLUMNA 1
    	$valores=explode(',',$records[$i]);
    	if( $valores[4]!=''){  // E
    
            
    		$fieldList=array();//cols
    		
    		//CAMPOS CSV
    		$fieldList["tipo_tarea"] = $valores[1]; //B
    		$fieldList["generica"] = $valores[2]; //C
    		$fieldList["listado_tareas_fk"] = $valores[3]; //D
    		$fieldList["nombre_tarea"] = html_entity_decode($valores[4]); //E
    		$fieldList["nombre_tarea"] = tildes_html($fieldList["nombre_tarea"]);    		
    		$fieldList["prioridad"] = $valores[5]; //F
    		

    		//ADICI0NALES
			$fieldList["fecha_creacion"] = date('Y-m-d');
			$fieldList["creador_tarea"] = 9; //FELIPE GARCIA
    		
    		$tabla="tareas_listado";
    		$strsql = "INSERT INTO ".$tabla." (";
    		$strsql .= implode(",", array_keys($fieldList));			
    		$strsql .= ") VALUES ('";			
    		$strsql .= implode("','", array_values($fieldList));			
    		$strsql .= "')";
            phpmkr_query($strsql);
            $idtareas_listado=phpmkr_insert_id();
            
            if(!$idtareas_listado){
            	$tareas_no_insertadas[]=$strsql;
            }
            
        }
    }//fin for
    
    //LOG_ERROR
    
    if( count($tareas_no_insertadas) ){
        $fp = fopen('errores.txt', 'a');
        fwrite($fp, "----------------------------------------------------------------------------");
        fwrite($fp, "listado tareas NO insertadas (".date('Y-m-d H:i:s').")");
        fwrite($fp, "\n");
        fwrite($fp, "\n");
        for($i=0;$i<count($tareas_no_insertadas);$i++){
            fwrite($fp, $tareas_no_insertadas[$i]);
            fwrite($fp, "\n");
        }
        fwrite($fp, "\n");
        fwrite($fp, "\n");         
        fclose($fp);
    }
}
 
 
echo('fin'); 
die();





?>