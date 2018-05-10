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
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) { 
  header("Content-type: application/xhtml+xml"); 
} 
else { 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
echo("<tree id=\"0\">\n");
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/lib/buscar_patron_archivo.php");
llena_categorias($_REQUEST["pantalla_idpantalla"]); 
echo("</tree>\n");                                    
$activo = "";
?>
<?php

function llena_categorias($pantalla_idpantalla){
if($pantalla_idpantalla){
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Campos\" id=\"cat-campos\">");        
  listado_campos($pantalla_idpantalla);
  echo("</item>\n");     
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Funciones\" id=\"cat-funciones\">");        
  listado_librerias($pantalla_idpantalla,1);
  echo("</item>\n");  
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Funciones Usadas\" id=\"cat-funciones-usadas\">");        
  listado_librerias_usadas($pantalla_idpantalla,1);
  echo("</item>\n");   
 /* 
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Funciones Sistema\" id=\"cat-funciones-system\">");        
  listado_librerias($pantalla_idpantalla,2);
  echo("</item>\n");

  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Esquemas visuales\" id=\"cat-esquemas\">");        
  listado_esquemas($pantalla_idpantalla);
  echo("</item>\n");
   */
	echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"Campos heredados\" id=\"cat-campos-heredados\">");        
  listado_campos_heredados($pantalla_idpantalla);
  echo("</item>\n");
}  
else{  
  echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"existe un error al tratar de buscar funciones de la pantalla\" id=\"cat-funciones\" open=\"1\">");          
  echo("</item>\n");     
}
return;
}
function listado_librerias($pantalla_idpantalla,$tipo){
global $conn;
//Librerias diferentes a las del sistema (tipo_libreria<>2)  
$librerias=busca_filtro_tabla("","pantalla_libreria A,pantalla_include B","A.idpantalla_libreria=B.fk_idpantalla_libreria AND B.pantalla_idpantalla=".$pantalla_idpantalla." AND A.tipo_libreria=".$tipo,"B.orden,A.ruta",$conn);

$texto='';
if($librerias["numcampos"]){ 
  for($i=0; $i<$librerias["numcampos"]; $i++){
  	$texto_temp=listado_funciones($librerias[$i]["ruta"],$librerias[$i]["idpantalla_libreria"]);
		if($texto_temp!=''){    
    	$texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($librerias[$i]["ruta"])."\" id=\"lib_".$librerias[$i]["idpantalla_libreria"]."\">";
      $texto.=$texto_temp;
    	$texto.="</item>\n";
			$texto_temp='';
		}
  }     
}
echo($texto);
}
function listado_funciones($ruta_libreria,$idlibreria){
global $conn;

  $listado_funciones=buscar_patron_archivo($ruta_libreria,"function",0); 
//print_r($listado_funciones);die();

  $texto='';
  foreach($listado_funciones["resultado"] AS $key=>$valor){ 
    $cant_funciones='';
    $pos1=strpos($valor,"(");
    $pos2=strpos($valor,")");
    $nombre=trim(substr($valor,8,($pos1-8)));        
    $dato=trim(substr($valor,8));
    
    
    $texto_param=$dato; 
    $texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($texto_param)."\" id=\"func_".$idlibreria."_".$nombre."\" >";    
    $texto.="<userdata name='myfunc'>{*".$texto_param."*}</userdata>\n";
    $texto.="</item>\n";    
    
  }

/*$listado_funciones= busca_filtro_tabla("","pantalla_funcion A, pantalla_funcion_exe B " ,"A.idpantalla_funcion=B.fk_idpantalla_funcion AND A.fk_idpantalla_libreria=".$idlibreria." AND B.pantalla_idpantalla=".$idpantalla,"", $conn);
if($listado_funciones["numcampos"]){  
  for($i=0;$i<$listado_funciones["numcampos"];$i++){
    $params=array();
    $parametros=busca_filtro_tabla("","pantalla_func_param B","B.fk_idpantalla_funcion_exe=".$listado_funciones[$i]["idpantalla_funcion_exe"],"",$conn);    
    if($parametros["numcampos"]){
      for($j=0;$j<$parametros["numcampos"];$j++){
        
        if($parametros[$j]["tipo"]==1){
          $campo_temp=  busca_filtro_tabla("", "pantalla_campos", "idpantalla_campos=".$parametros[$j]["valor"],"", $conn);          
          if($campo_temp["numcampos"]){                       
            array_push($params,$campo_temp[0]["nombre"]);
          }
          else{
            array_push($params,"''");          
          }          
        }  
        else if($parametros[$j]["tipo"]==2){
          array_push($params,"'".$parametros[$j]["valor"]."'");
        }  
        else if($parametros[$j]["tipo"]==3){
          array_push($params,"REQUEST[".$parametros[$j]["nombre"]."]");
        }
      }
    } 
    $texto_param=''; 
    $texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($listado_funciones[$i]["nombre"])."\" id=\"func_".$idlibreria."_".$listado_funciones[$i]["nombre"]."\" >";    
    if(count($params)){
      $texto_param="@".implode(",",$params);
    }
    $texto.="<userdata name='myfunc'>{*".$listado_funciones[$i]["nombre"].$texto_param."*}</userdata>\n";
    $texto.="</item>\n";
  }
}  */         
return($texto);
}
function listado_librerias_usadas($pantalla_idpantalla,$tipo){
global $conn;
//Librerias diferentes a las del sistema (tipo_libreria<>2)  
$librerias=busca_filtro_tabla("","pantalla_libreria A,pantalla_include B","A.idpantalla_libreria=B.fk_idpantalla_libreria AND B.pantalla_idpantalla=".$pantalla_idpantalla." AND A.tipo_libreria=".$tipo,"B.orden,A.ruta",$conn);

$texto='';
if($librerias["numcampos"]){ 
  for($i=0; $i<$librerias["numcampos"]; $i++){
  	$texto_temp=listado_funciones_usadas($pantalla_idpantalla,$librerias[$i]["idpantalla_libreria"]);
		if($texto_temp!=''){    
    	$texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($librerias[$i]["ruta"])."\" id=\"lib_uso_".$librerias[$i]["idpantalla_libreria"]."\">";
      $texto.=$texto_temp;
    	$texto.="</item>\n";
			$texto_temp='';
		}
  }     
}
echo($texto);
}
function listado_funciones_usadas($pantalla_idpantalla,$idlibreria){
global $conn;

    $listado_funciones_usadas=busca_filtro_tabla("a.nombre AS nombre_funcion,b.idpantalla_funcion_exe","pantalla_funcion a, pantalla_funcion_exe b","a.fk_idpantalla_libreria=".$idlibreria." AND a.idpantalla_funcion=b.fk_idpantalla_funcion AND b.accion='mostrar' AND b.pantalla_idpantalla=".$pantalla_idpantalla,"",$conn);
  
  //print_r($listado_funciones_usadas);die();
  
  
   $cadena_funcion='';
   $texto='';
    for($i=0;$i<$listado_funciones_usadas['numcampos'];$i++){
        
        $cadena_funcion=$listado_funciones_usadas[$i]['nombre_funcion'];
        
        $parametros_funcion=busca_filtro_tabla("","pantalla_func_param a","fk_idpantalla_funcion_exe=".$listado_funciones_usadas[$i]['idpantalla_funcion_exe'],"a.idpantalla_func_param ASC",$conn);
        $cadena_parametros='';
        $vector_parametros=array();
        if($parametros_funcion['numcampos']){
            for($j=0;$j<$parametros_funcion['numcampos'];$j++){
                switch($parametros_funcion[$j]['tipo']){
                    case 1: //campo 
                        $vector_parametros[]=$parametros_funcion[$j]['valor'];
                        break;
                    case 2: //dato 
                        $vector_parametros[]='"'.$parametros_funcion[$j]['valor'].'"';
                        break;
                    case 3: //request
                        $vector_parametros[]='$_REQUEST["'.$parametros_funcion[$j]['valor'].'"]';
                        break;
                }  //fin switch              
            } //fin for
            
            $cadena_parametros='('.implode(',',$vector_parametros).')';
        }else{ //fin if numcampos $parametros_funcion
            $cadena_parametros='()';
        }

        $texto.="<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($cadena_funcion.$cadena_parametros)."\" id=\"funcuso_".$listado_funciones_usadas[$i]['idpantalla_funcion_exe']."\">";    
        $texto.="<userdata name='myfuncuso'>".$cadena_funcion."</userdata>\n";
        $texto.="</item>\n";        
    }
    return($texto);
}

function listado_campos($pantalla_idpantalla){
global $conn;                                                              
$campos=busca_filtro_tabla("","pantalla_campos A","A.pantalla_idpantalla=".$pantalla_idpantalla." and etiqueta_html<>'campo_heredado'","A.nombre",$conn);	
if($campos["numcampos"]){ 
  for($i=0; $i<$campos["numcampos"]; $i++){    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($campos[$i]["nombre"])."\" id=\"campo_".$campos[$i]["idpantalla_campos"]."\" tooltip=\"".utf8_encode(htmlspecialchars($campos[$i]["etiqueta"]))."\" >");
      echo("<userdata name='mycampo'>{*".$campos[$i]["nombre"]);      
      echo("*}</userdata>\n");
    echo("</item>\n");
  }     
}
}
function listado_campos_heredados($pantalla_idpantalla){
global $conn;                                                              
$campos=busca_filtro_tabla("","pantalla_campos A","A.pantalla_idpantalla=".$pantalla_idpantalla." and etiqueta_html='campo_heredado'","A.nombre",$conn);	
if($campos["numcampos"]){ 
  for($i=0; $i<$campos["numcampos"]; $i++){    
    echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".htmlspecialchars($campos[$i]["nombre"])."\" id=\"campo_".$campos[$i]["idpantalla_campos"]."\" tooltip=\"".utf8_encode(htmlspecialchars($campos[$i]["etiqueta"]))."\" >");
      echo("<userdata name='mycampo'>{*".$campos[$i]["nombre"]);      
      echo("*}</userdata>\n");
    echo("</item>\n");
  }     
}
}
function listado_esquemas($idpantalla){
$esquemas=busca_filtro_tabla("","pantalla_esquema","1=1","",$conn);
for($i=0;$i<$esquemas["numcampos"];$i++){
	$etiqueta=utf8_encode(htmlspecialchars($esquemas[$i]["etiqueta"]));	
	echo("<item style=\"font-family:verdana; font-size:7pt;\" text=\"".$etiqueta."\" id=\"esquema_".$esquemas[$i]["idpantalla_esquema"]."\" tooltip=\"".utf8_encode(htmlspecialchars($etiqueta))."\" >");
		echo("<userdata name='myesquema'>".$esquemas[$i]["ruta"]."?idpantalla=".$idpantalla."</userdata>\n");
	echo("</item>\n");
}	
}
?>
