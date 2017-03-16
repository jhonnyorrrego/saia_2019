<?php 
/*
 * Este script genera un arbol XML para la utiliacion o impresion con el arbol 
 * par esto declara un objeto de la clase TagXml que se encuentra en el archivo 
 * arbol.php, y realiza las busquedas necesarias en  la base de datos 
 * normalmente utiliza dependencia_cargo, funcionario, cargo
 *  
 *  Recibe :  una variable tipo post po get llamada 
 *   $tipo :   1 Dependencias
 * 	 		   2 Dependencias - Cargos  (las dependencias van se�anadas con un simbolo # en el id)
 * TODO : 	Implementar los tipos de arboles  faltantes ... roles rutas cargos hijos etc 
 * TODO :   Impleentar la carga incremental 
 *  Los anteriores TODO involucran a generaxml.php - arbol.php
 */  

header("content-type: text/xml");
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?>");

include_once("../db.php");
include_once("classarbol.php");

//Genera un Xml de las  dependencias unicamente
function arbol_dependencia(){
$xml=new TagXml(0,1,tree);
$xml->asigna_atributo("id",0);
$dependencias=busca_filtro_tabla("*","dependencia","1","nombre ASC",$conn);

if($dependencias["numcampos"]){
  for($i=0;$i<$dependencias["numcampos"];$i++) 
    {  
    	$xmldp=$xml->asigna_hijo("item");
        $xmldp->asigna_atributo("style","font-family:verdana; font-size:7pt;"); 
    	$xmldp->asigna_atributo("text",$dependencias[$i]["nombre"]);
        $xmldp->asigna_atributo("id",$dependencias[$i]["iddependencia"]);
        
    }
}
return $xml;
} 
/*
 *  Genera un Xml de las dependencias ordenadas en jerarquia
 *  si se le envia un id de una obtiene el sub Arbol arbol interno de una dependencia
 *  si no se le envian parametros obtiene todo el arbol de las dependencias
 */
function arbol_jerarqdependencia($id=NULL,$xml=NULL)
{ global $conn;  

if(!isset($xml))
{ 
 $xml=new TagXml(0,1,tree);  // nodo raiz no envian xml 
 $xml->asigna_atributo("id",0);
}
if(!isset($id))  //Obtengo la dependencia de mas alto nivel !! sin Padre 
 { 
  $dependencias=busca_filtro_tabla("*","dependencia","cod_padre is NULL","nombre ASC",$conn);
}
else // Dependencias con padre !!
{ 
  $dependencias=busca_filtro_tabla("*","dependencia","cod_padre=$id","nombre ASC",$conn);
  
 }

 if($dependencias["numcampos"])
	{  for($i=0;$i<$dependencias["numcampos"];$i++) 
	    { 
	     $xmlhijo=$xml->asigna_hijo("item");
		 $xmlhijo->asigna_atributo("style","font-family:verdana; font-size:7pt;");
	     $xmlhijo->asigna_atributo("text",htmlspecialchars($dependencias[$i]["nombre"]));
	     $xmlhijo->asigna_atributo("id",$dependencias[$i]["iddependencia"]."#");
	     $hijos=busca_filtro_tabla("*","dependencia D","D.cod_padre='".$dependencias[$i]["iddependencia"]."'","iddependencia",$conn);
	     
	      if($hijos["numcampos"]) // El hijo tiene mas hijos recursion 
	        {   
	          arbol_jerarqdependencia($dependencias[$i]["iddependencia"],$xmlhijo);
	        	      
	        }
        } 
     return  $xml;   
   } // fin if numcampos
 
 return($xml);      
} // Fin funcion

function arbol_cargodependencia($id=NULL,$xml=NULL)
{ global $conn;
if(!isset($xml))
{
 $xml=new TagXml(0,1,tree);  // nodo raiz no envian xml 
 $xml->asigna_atributo("id",0); 
}
if(!isset($id))  //Obtengo la dependencia de mas alto nivel !! sin Padre 
 { 
  $dependencias=busca_filtro_tabla("*","dependencia D","D.cod_padre IS NULL","nombre ASC",$conn);
}
else // Dependencias con padre !!
{ 
  $dependencias=busca_filtro_tabla("*","dependencia D","D.cod_padre='$id'","nombre ASC",$conn);
    
 }
if($dependencias["numcampos"]||$funcionarios["numcampos"])
	{ 
     if($dependencias["numcampos"])
	    {
	     for($i=0;$i<$dependencias["numcampos"];$i++) 
	      {	        
	       $xmlhijo=$xml->asigna_hijo("item");
	       $xmlhijo->asigna_atributo("style","font-family:verdana; font-size:7pt;");
		   $xmlhijo->asigna_atributo("text",htmlspecialchars($dependencias[$i]["nombre"]));
	       $xmlhijo->asigna_atributo("id",$dependencias[$i]["iddependencia"]."#");   
	       
	       $hijos=busca_filtro_tabla("*","dependencia","cod_padre='".$dependencias[$i]["iddependencia"]."'","iddependencia",$conn);/*
          
          /*"dependencia_cargo.cargo_idcargo=cargo.idcargo AND
            dependencia_cargo.funcionario_idfuncionario=funcionario.idfuncionario AND 
            dependencia_iddependencia <> 1 AND funcionario.estado=1 AND dependencia_cargo.estado=1 AND dependencia_iddependencia=".$dependencias[$i]["iddependencia"],"GROUP BY funcionario_codigo ORDER BY funcionario.nombres ASC",$conn);
          */
	       $func_int=busca_filtro_tabla("f.login,f.idfuncionario,f.nombres,f.apellidos,c.nombre AS 
	       cargo","funcionario f,dependencia_cargo d,cargo c","d.cargo_idcargo=c.idcargo AND 
	       d.funcionario_idfuncionario=f.idfuncionario AND
	       d.dependencia_iddependencia <> 1 AND f.estado=1
	       AND d.estado=1 AND d.dependencia_iddependencia='".$dependencias[$i]['iddependencia']."'","c.idcargo",$conn);
           
           //print_r($func_int); echo "<br>";       
	        if($hijos["numcampos"]) // El hijo tiene mas hijos recursion 
	         {  
	          $tmphijo=arbol_cargodependencia($dependencias[$i]["iddependencia"],$xmlhijo);	           
	         }
            if($func_int["numcampos"]) // Funcionarios del internos de las dependencias
			    {
			      for($j=0;$j<$func_int["numcampos"];$j++)
			       { 
			       $func=$xmlhijo->asigna_hijo("item");
			       $func->asigna_atributo("style","font-family:verdana; font-size:7pt;");
			       $func->asigna_atributo("text",htmlspecialchars($func_int[$j]["nombres"])." ".htmlspecialchars($func_int[$j]["apellidos"])."-".htmlspecialchars($func_int[$j]["cargo"]));
			       $func->asigna_atributo("id",$func_int[$j]["idfuncionario"]);   
			       
			       } 
			    } 
	      
	      }  
	      
        } 
	  
     return  $xml;   
   } // fin if numcampos
 return($xml);      
}

function arbol_jerarqseries($id=NULL,$xml=NULL)
{ global $conn;
$serie=$id;
$funcionario=usuario_actual("id");
$datos = busca_datos_administrativos_funcionario($funcionario);
$papas = array();
if(!isset($xml))
{ 
 $xml=new TagXml(0,1,tree);  // nodo raiz no envian xml 
 if($serie)
  $xml->asigna_atributo("id",$serie); 
 else
  $xml->asigna_atributo("id",0); 
}
if(!isset($id))  //Obtengo la serie de mas alto nivel !! sin Padre 
 {
	$record=array();
     for($i=0; $i<count($datos["series"]);$i++)
    {
      $record=busca_filtro_tabla("*","serie","estado=1 AND idserie=".$datos["series"][$i],"",$conn);
       if($record["numcampos"])
        array_push($papas,array("idserie"=>$record[0]["idserie"],"nombre"=>$record[0]["nombre"],"codigo"=>$record[0]["codigo"]));
    }
    $papas["numcampos"]=count($datos["series"]);
}
else // Dependencias con padre !!
{
 $papas=busca_filtro_tabla("*","serie"," cod_padre=".$serie,"codigo ASC",$conn);
}
  
if($papas["numcampos"])
{ 
  for($i=0; $i<$papas["numcampos"]; $i++)
  {
    $hijos = busca_filtro_tabla("count(*)","serie","cod_padre=".$papas[$i]["idserie"],"",$conn);
    $xmlhijo=$xml->asigna_hijo("item");
	$xmlhijo->asigna_atributo("style","font-family:verdana; font-size:7pt;");
	$xmlhijo->asigna_atributo("text",html_entity_decode($papas[$i]["nombre"]));
	$xmlhijo->asigna_atributo("id",$papas[$i]["idserie"]);   
	
    if($hijos[0][0])
     { $xmlhijo->asigna_atributo("nocheckbox",0);
       $xmlhijo->asigna_atributo("child",1);       
      }
    else
     $xmlhijo->asigna_atributo("child",0);
   }     
 } // fin if
return $xml;
}




function arbol_tareas($id=NULL,$xml=NULL)
{
global $conn;  

if(!isset($xml))
{ 
 $xml=new TagXml(0,1,tree);  // nodo raiz no envian xml 
 $xml->asigna_atributo("id",0);
}

$tareas=busca_filtro_tabla("*","tarea","","nombre ASC",$conn);


 if($tareas["numcampos"])
	{  for($i=0;$i<$tareas["numcampos"];$i++) 
	    { 
	     $xmlhijo=$xml->asigna_hijo("item");
		 $xmlhijo->asigna_atributo("style","font-family:verdana; font-size:7pt;");
	     $xmlhijo->asigna_atributo("text",ucwords(($tareas[$i]["nombre"])));
	     $xmlhijo->asigna_atributo("id",$tareas[$i]["idtarea"]); // ."#") para idientificar las que tienen tareas hijas
	     $hijos=busca_filtro_tabla("*","tarea D","D.idpadre='".$tareas[$i]["idtarea"]."'","idpadre",$conn);
	   
        } 
     return  $xml;   
   } // fin if numcampos
 
 return($xml);    
}

if(isset($_REQUEST['tipo']))
  $tipo=$_REQUEST['tipo'];
else 
  $tipo =0;
	switch ($tipo)
	{
	case 1: // Dependencias
		 $xmldepende=arbol_jerarqdependencia();
         echo $xmldepende->r_xml();
         break;	    
	case 2: // Funcionarios de las dependencias
		 $xmldepende=arbol_cargodependencia();
		 echo $xmldepende->r_xml();
		 break;
	case 3: // Tareas
		 $xmldepende=arbol_tareas();
		 echo $xmldepende->r_xml();
		 break;		 
		 
	default : 
	    	$xmldepende=arbol_jerarqdependencia();
	 	    break;
	}	 

?>