<?php
include_once("../../db.php");

function lista_destinos($idformato,$iddoc=NULL)
{global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 $destinos=explode(",",$resultado[0]["destino"]);  
$nombres=array();
 if(strpos($resultado[0]["destino"],'#')>0)
 { $i=0;
  foreach($destinos as $fila)
    { 
     if(strpos($fila,'#')>0)
      {$datos_d=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
      $nombres[]=ucwords($datos_d[0]["nombre"]);
      unset($destinos[$i]);
      $i++;
      }     
    }
  $nombres = array_merge($nombres,jerarquia_memo(implode(',',$destinos),$resultado[0]["fecha_".$datos[0]["nombre"]]));    
 }
 else 
  $nombres = jerarquia_memo($resultado[0]["destino"],$resultado[0]["fecha_".$datos[0]["nombre"]]);
 echo implode("<br />",$nombres);   
}

function jerarquia_memo($list_cargos,$fecha)
{ global $conn;  
  $cargo_array = array();  
  if($fecha < "2009-03-20")      
  { $cargos = busca_filtro_tabla("distinct idfuncionario,idcargo,nombre,nombres,apellidos","cargo,funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list_cargos) and cargo_idcargo=idcargo and (".fecha_db_obtener("fecha_inicial","Y-m-d")." <= '$fecha' and ".fecha_db_obtener("fecha_final","Y-m-d").">= '$fecha')","codigo_cargo",$conn);  
   if(!$cargos["numcampos"])
   $cargos = busca_filtro_tabla("distinct idfuncionario,idcargo,nombre,nombres,apellidos","cargo,funcionario,dependencia_cargo","funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list_cargos) and cargo_idcargo=idcargo","codigo_cargo",$conn);
  }
  else
  { $list_cargos = str_replace('r','',$list_cargos);
   $cargos = busca_filtro_tabla("nombres,apellidos,nombre","funcionario,dependencia_cargo,cargo","funcionario_idfuncionario=idfuncionario and cargo_idcargo=idcargo and iddependencia_cargo in ($list_cargos)","codigo_cargo",$conn);
  }
  //print_r($cargos);
  for($i=0; $i<$cargos["numcampos"]; $i++)
    $cargo_array[] = $cargos[$i]["nombres"]." ".$cargos[$i]["apellidos"].", ".$cargos[$i]["nombre"]; 
  return $cargo_array;
}

function mostrar_origen($idformato,$iddoc=NULL)
{global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);

 $destinos=explode(",",$resultado[0]["origen"]);
 //print_r($destinos);
 foreach($destinos as $fila)
    {      
     echo cargos_memo($fila,$resultado[0]["fecha_".$datos[0]["nombre"]],"de");
     echo "<br />";
     //$datos=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$fila,"",$conn);
     //echo ucwords($datos[0]["nombres"]." ".$datos[0]["apellidos"])."<br />";
    }
}
/*function cargos_memo($func,$fecha,$tipo)
{ 
 global $conn,$sql; 
 $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre,fecha_inicial","cargo c,dependencia_cargo,funcionario","c.idcargo=cargo_idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo='$func' and (".fecha_db_obtener("fecha_inicial","Y-m-d")." <= '$fecha' and ".fecha_db_obtener("fecha_final","Y-m-d").">= '$fecha')","fecha_inicial desc",$conn); 

//si no tiene rol activo en esas fechas busco el ultimo
 if(!$roles["numcampos"])
   {$roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","cargo c,dependencia_cargo,funcionario","c.idcargo=cargo_idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo='$func' and (".fecha_db_obtener("fecha_inicial","Y-m-d")." <= '$fecha' )","fecha_inicial desc",$conn);
  // print_r($roles); 
   }

  if($tipo=="para")
   return ucwords((($roles[0]["nombres"]." ".$roles[0]["apellidos"]).", ".($roles[0]["nombre"])));
  else
   return ucwords($roles[0]["nombre"]); 
}*/
function mostrar_copias_memo($idformato,$iddoc=NULL)
{global $conn; 
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $inf_memorando=busca_filtro_tabla("copia,fecha_".$datos[0]["nombre"],$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 if($inf_memorando[0]["copia"]<>"")
    {echo '<tr ><td colspan=2><font size="2"><br />Copia: ';
     $destinos=explode(",",$inf_memorando[0]["copia"]);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++) 
            {//si el destino es una dependencia
             if(strpos($destinos[$i],"#")>0)
                {$resultado=busca_filtro_tabla("nombre",DB.".dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
                 $lista[]=ucwords($resultado[0]["nombre"]); 
                }
             else//si el destino es un funcionario
                {
                $lista[]=cargos_memo($destinos[$i],$inf_memorando[0]["fecha_".$datos[0]["nombre"]],"para");
                /*$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre",DB.".funcionario,".DB.".cargo c,".DB.".dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$destinos[$i],"",$conn);
                 $cargo=busca_filtro_tabla("nombre","cargo,dependencia_cargo","cargo_idcargo=idcargo and funcionario_idfuncionario=".$resultado[0]["idfuncionario"],"",$conn);
                 $lista[]=ucwords(strtolower($resultado[0]["nombres"]." ".$resultado[0]["apellidos"]));*/
                }
            }    
     echo implode("; ",$lista);       
     echo '<br /></font></td>           
            </tr>';          
    }     
}
?>
