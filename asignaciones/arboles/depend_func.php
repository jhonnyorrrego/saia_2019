<?php
include_once '../db.php';

function busca_raiz_dependencia($idcodpadre)
{    
	 global $conn;
     $retorno="";
     
    if ($idcodpadre == NULL)
	 {
	 	return null;
	 }
	else 
	{  $encontrado =-1;
	 
	  do 
	  {	
	  	
	    $temp=busca_filtro_tabla("iddependencia,cod_padre","dependencia d","d.iddependencia=".$idcodpadre,"",$conn); 
	  //  print_r($temp);
		    if(!$temp['numcampos']) // No se encontraron padres
		     {   $encontrado=NULL;
		         
		     }
			    
			else 
			{   
				  if($retorno!="")  
                      $retorno.=",".$temp[0]["iddependencia"];
                    else 
                       $retorno.=$temp[0]["iddependencia"]; 
				 
				if($temp[0]["cod_padre"] != NULL)
				 {  
				    $idcodpadre=$temp[0]["cod_padre"];
				  }
				  
				else  // Es la dependencia raiz ... se twermina el proceso 
				  {    
				  	$encontrado = 1;
				  } 
			    
			}	    
			//die("3");
	  }while($encontrado==-1); 
	} 
 if($encontrado)
  { 
    return($retorno); 
   }

}


function subarbolfunc($nombre,$posicion)
{  
   global $conn;
   $rol_actual=NULL;	
     // Saco todos los func concordantes con el nombre a buscar  func activos inactivos etc .. por rendiento se filtran en la consulta siguiente
    $funcionarios=busca_filtro_tabla("idfuncionario","funcionario"," nombres LIKE '%".$nombre."%'"." AND  funcionario.estado=1","",$conn);
    if($funcionarios["numcampos"])
    {  $lfunc=$funcionarios[0]["idfuncionario"];
    
    for($i=1;$i<$funcionarios["numcampos"];$i++)
     {
     	$lfunc.=",".$funcionarios[$i]["idfuncionario"];
     }
    }
   else 
    {
      return (NULL);
    }  
  // print_r($funcionarios);
    
  // $fun_activos = busca_filtro_tabla("f.idfuncionario,d.iddependencia","funcionario f, dependencia d, cargo c,dependencia_cargo dc","dc.funcionario_idfuncionario IN(".$lfunc.")"." AND f.estado=1"." AND c.estado=1 AND c.idcargo= dc.cargo_idcargo"." AND d.estado=1 AND d.iddependencia=dc.dependencia_iddependencia" ,"d.iddependencia",$conn);
 //  print_r($fun_activos);die();
  
   if($funcionarios["numcampos"]) // Itera ordenadamente por los funcionarions con  nombres coincidentes y luego en sus roles  
    { 
    	$total_recorridos = 0;
    for($i=0;$i<$funcionarios["numcampos"];$i++) // Itero en los roles 
   	   {
   	        $idfunc=$funcionarios[$i]["idfuncionario"]; 
   	        
            $rol = busca_filtro_tabla("d.dependencia_iddependencia,d.cargo_idcargo","dependencia_cargo d","d.funcionario_idfuncionario =".$idfunc,"d.dependencia_iddependencia",$conn);
            
            if($rol["numcampos"])
   	   	      {  
   	   	         $fin_recorridos = $total_recorridos + $rol["numcampos"];  
   	   	        
   	   	         if($fin_recorridos >= $posicion )  // se puede obtener el desplazamiento      
   	   	          {  
   	   	              // Obtengo los datos necesarios en la posicion 
                     $desplazamiento = ($posicion  - 1) -$total_recorridos;  
   	   	          	 $rol_actual = $rol[$desplazamiento];
   	   	          	
   	   	          	 $dependencia=busca_filtro_tabla("d.cod_padre","dependencia d ","d.iddependencia=".$rol_actual['dependencia_iddependencia'],"",$conn);
   	   	            
                     if($dependencia["numcampos"]) 
                     { if($dependencia[0]["cod_padre"]!=NULL) // El funcionario pertenece a una subdependencia
                        { $retorno=busca_raiz_dependencia($dependencia[0]["cod_padre"]); // Buscar los antecesores de la dependencia actual
                          return($retorno);
                        }
                       else
                       {
                       	 return($rol_actual['dependencia_iddependencia']); 
                       } 
                         
                     }  
                     else   	 
   	   	          	   return(NULL); 
   	   	                  
   	   	          }
   	   	         else  
   	   	          {
   	   	         	if ($i+1 >$funcionarios["numcampos"]) // ya no queda mas para desplazar
   	   	         	  {
   	   	         	  	return NULL;
   	   	         	  }
   	   	         	else 
   	   	         	{
   	   	         		$total_recorridos+= $rol["numcampos"]; 
   	   	         	}  
   	   	          } 
		          	 
   	   	      } // Fin if rol
   	   	     else  // El funcionario no pertenence a dependencias
   	   	     { 
   	   	         return (NULL);
   	   	     } 
   	  
     } 
    
    // proceso  dependencias padres hacia atras
    if($rol_actual != NULL)	 
     {  // print_r($)
     	// print_r($rol_actual);
     	
     }  
  }  // Fin  if  
	
} 

function llena_dependencia($codigo, $ruta,$dom=NULL)
{  
	global $conn,$sql;
	
	if(!$dom)
	{ 
		$dom = new DomDocument('1.0');
		$tree = $dom->appendChild($dom->createElement('TREE')); 
	}
	  
	$llenado=FALSE;
	
	if($codigo == 0){
	  $prof=busca_filtro_tabla("","dependencia","iddependencia=1","",$conn);
	  if($prof["numcampos"]){	  	
	  	$dependencia = $tree->appendChild($dom->createElement('item'));
	  	$dependencia->setAttribute("style", "font-family:verdana; font-size:7pt;");
	    $dependencia->setAttribute("text",  ucwords(($prof[0]["nombre"])) );
	    $dependencia->setAttribute("id",  $prof[0]["iddependencia"]."#" );
	    $dependencia->setAttribute("child",  "1" );
	  }
	}
	else
	{
	  $prof=busca_filtro_tabla("*","dependencia","1=1","",$conn);
	  print_r($prof);
	  if($prof["numcampos"]){
	    $hijos=busca_filtro_tabla("*","dependencia A","A.cod_padre=".$prof[0]["iddependencia"],"A.nombre ASC",$conn);
	 
	  if($hijos["numcampos"]){
	    for($i=0;$i<$hijos["numcampos"];$i++){ 
	      $hijos2=busca_filtro_tabla("*","dependencia A","A.cod_padre=".$hijos[$i]["iddependencia"],"A.nombre ASC",$conn);
	      $hijos3=busca_filtro_tabla("distinct A.login,A.funcionario_codigo,A.nombres AS nombres_ord,A.apellidos AS apellidos","funcionario A,dependencia_cargo B, cargo C","B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 AND B.dependencia_iddependencia=".$hijos[$i]["iddependencia"],"nombres_ord ASC",$conn);
	      if($hijos2["numcampos"] || $hijos3["numcampos"])
	        {
	        	$dependencia = $tree->appendChild($dom->createElement('item'));
			  	$dependencia->setAttribute("style", "font-family:verdana; font-size:7pt;");
			    $dependencia->setAttribute("text",  (formato_cargo($hijos[$i]["nombre"])) );
			    $dependencia->setAttribute("id",  $hijos[$i]["iddependencia"]."#" );
			    $dependencia->setAttribute("child",  "1" );	
	        } 
	      }
	    } 
	 // llena_funcionarios($codigo,$ruta,$dependencia);     
	  return;
	  }
	 }
	return $dom;
 } 
  
function llena_funcionarios($codigo,$ruta,&$dom)
{
	global $conn,$sql;
	$usuarios=busca_filtro_tabla("A.login,A.funcionario_codigo,A.nombres AS nombres_ord,A.apellidos AS apellidos,C.nombre AS cargo","funcionario A,dependencia_cargo B, cargo C","B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 AND B.dependencia_iddependencia=".$codigo,"nombres_ord ASC",$conn);
	if($ruta == 0)
	 $ruta = "";
	else
	  $ruta = "%".$ruta; 
	for($j=0;$j<$usuarios["numcampos"];$j++){
		$func = $dom->appendChild($dom->createElement('item'));
	    $func->setAttribute("style", "font-family:verdana; font-size:7pt;");
		$func->setAttribute("id",  $hijos[$i]["iddependencia"]."#" );
		$func->setAttribute("child",  "1" );	
	   
	   if($usuarios[$j]["nombres_ord"])
	   	{
	     $func->setAttribute("text",ucwords($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"])." (".($usuarios[$j]["login"])."-".(formato_cargo($usuarios[$j]["cargo"])).")"); 
	     $func->setAttribute("id",  $usuarios[$j]["funcionario_codigo"].$ruta);
	     $func->setAttribute("ruta",$ruta);
	     $func->setAttribute("child", "0");
	     
		//  echo("text=\"".ucwords(($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"]))." (".($usuarios[$j]["login"])."-".(formato_cargo($usuarios[$j]["cargo"])).")\" id=\"".$usuarios[$j]["funcionario_codigo"]."$ruta\" ruta=\"$ruta\" child=\"0\">");
	   	}
	   else  
	    {
	   	  $func->setAttribute("text",ucwords($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"])." (".($usuarios[$j]["login"])."-".(formato_cargo($usuarios[$j]["cargo"])).")"); 
	      $func->setAttribute("id",  $usuarios[$j]["funcionario_codigo"].$ruta);
	      $func->setAttribute("ruta",$ruta);
	      $func->setAttribute("child", "0");
	      
	    }
	}
	if($usuarios["numcampos"])
	  return(TRUE);
	else  return(FALSE); 
}                            
 
echo subarbolfunc("carlos",9);
/*
$dom=llena_dependencia(1,0,NULL);
$dom->formatOutput = true; // set the formatOutput attribute of
$test1 = $dom->saveXML(); // put string in test1

 echo $test1;
 */

 //$dom->save('test1.xml'); // save as file 
 
?>