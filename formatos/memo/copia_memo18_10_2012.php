<?php
include_once("../../db.php");

function lista_destinos($idformato,$iddoc=NULL)
{global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 $destinos=explode(",",$resultado[0]["destino"]);
 //print_r($destinos);
$nombres=array();
 foreach($destinos as $fila)
    { 
     if(strpos($fila,'#')>0)
      {$datos_d=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
      $nombres[]=ucwords($datos_d[0]["nombre"]);
      }
     else
      {              
       $nombres[]=cargos_memo($fila,$resultado[0]["fecha_".$datos[0]["nombre"]],"para",$resultado[0]["dependencia"]);
      }
    }    
 //echo implode("<br />",$nombres);
 $cant=count($nombres);
 //if($cant>1)  
 jerarquia_cargo($destinos, array(0));     
}

function jerarquia_cargo($usuarios, $padre){
 global $conn;
 if($padre[0][0]==0)
    $nulo=" or c.cod_padre is null ";
 $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre,fecha_inicial,idcargo,iddependencia_cargo","cargo c,dependencia_cargo,funcionario,dependencia d","c.idcargo=cargo_idcargo and funcionario_idfuncionario=idfuncionario and iddependencia_cargo in(".implode(",",$usuarios).") and dependencia_iddependencia=iddependencia and (c.cod_padre in(".implode(",",$padre).") $nulo)","nombres,apellidos",$conn);
 
 for($i=0;$i<$roles["numcampos"];$i++)
    {echo $roles[$i]["nombres"]." ".$roles[$i]["apellidos"].", ".$roles[$i]["nombre"]."<br />";
     $usuarios=array_diff($usuarios,array($roles[$i]["iddependencia_cargo"]));
    }
  sort($usuarios);
  $cargos=busca_filtro_tabla("idcargo","cargo","cod_padre in(".implode(",",$padre).")","",$conn);
 $padre=extrae_campo($cargos,"idcargo","");
 sort($padre);
 if(!empty($usuarios) && !empty($padre))
  {jerarquia_cargo($usuarios, $padre);
  }
 else
  return false; 
}
//function mostrar_origen($idformato,$iddoc=NULL)
/*
function mostrar_origen($idformato,$iddoc)
{global $conn;
  
  $formato=busca_filtro_tabla("nombre","ft_memo a,dependencia_cargo b,dependencia c","a.documento_iddocumento=$iddoc and b.iddependencia_cargo =a.dependencia and c.iddependencia =b.dependencia_iddependencia","",$conn);
  //print_r($formato);
 
if($formato[0]["nombre"]!="") {
echo($formato[0]["nombre"]); 
}else{
$datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);

 $destinos=explode(",",$resultado[0]["origen"]);
 foreach($destinos as $fila)
    { 
     echo cargos_memo($fila,$resultado[0]["fecha_".$datos[0]["nombre"]],"de");
     echo "<br />";
     //$datos=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$fila,"",$conn);
     //echo ucwords($datos[0]["nombres"]." ".$datos[0]["apellidos"])."<br />";
    }
}
}
 */
 function mostrar_origen($idformato,$iddoc=NULL){
 global $conn,$ruta_db_superior;
 include_once($ruta_db_superior."formatos/carta/funciones.php");
 
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);

 $destinos=explode(",",$resultado[0]["origen"]);
 $fecha=$resultado[0]["fecha_".$datos[0]["nombre"]];
 foreach($destinos as $fila)
    { 
     $roles["numcampos"]=0;
     $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","cargo c,dependencia_cargo a,funcionario b,dependencia d","c.idcargo=a.cargo_idcargo and a.funcionario_idfuncionario=b.idfuncionario and a.dependencia_iddependencia=d.iddependencia and d.iddependencia=".$resultado[0]["dependencia"]." AND b.funcionario_codigo='$fila' and (".fecha_db_obtener("fecha_inicial","Y-m-d")." <= '$fecha' AND  ".fecha_db_obtener("fecha_final","Y-m-d")." >= '$fecha')","fecha_inicial desc",$conn);
    //print_r($roles);
     if($roles["numcampos"]==0){
      $roles = busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","cargo c,dependencia_cargo a,funcionario b,dependencia d","c.idcargo=a.cargo_idcargo and a.funcionario_idfuncionario=b.idfuncionario and a.dependencia_iddependencia=d.iddependencia and d.tipo=1 AND b.funcionario_codigo='$fila' and (".fecha_db_obtener("fecha_inicial","Y-m-d")." <= '$fecha' AND  ".fecha_db_obtener("fecha_final","Y-m-d")." >= '$fecha')","fecha_inicial desc",$conn);
     }
    
    echo ($roles[0]["nombre"])."<br />";
    $reemplazos=busca_filtro_tabla("","reemplazo A, dependencia_cargo B, funcionario C","A.activo=1 and nuevo=iddependencia_cargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo=".$fila,"",$conn);
        //print_r($reemplazos);
        if($reemplazos["numcampos"]>0){
        $cargo=busca_filtro_tabla("","cargo","idcargo=".$reemplazos[0]["cargo_idcargo"],"",$conn);
        $dep=busca_filtro_tabla("","dependencia","iddependencia=".$reemplazos[0]["dependencia_iddependencia"],"",$conn);
        //echo $cargo[0]["nombre"]."<br>";
        reglas_documentos($idformato,$iddoc,$roles[0]["funcionario_codigo"]);
        }
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
    {echo '<font size="2">Copia: ';
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
     echo '<br /></font>';          
    }     
}
function mostrar_dependencia_memorando($idformato,$iddoc)
{
global $conn;
 $formato=busca_filtro_tabla("dependencia,mostrar_dependencia","ft_memorando","documento_iddocumento=$iddoc","",$conn);
 if($formato[0]["mostrar_dependencia"]==1){
$dependencia=busca_filtro_tabla("dependencia_iddependencia","dependencia_cargo","  iddependencia_cargo =".$formato[0]["dependencia"],"",$conn);
$nombre_dependencia=busca_filtro_tabla("nombre","dependencia","iddependencia =".$dependencia[0]["dependencia_iddependencia"],"",$conn);
echo($nombre_dependencia[0]["nombre"]);    

 }

}



?>
