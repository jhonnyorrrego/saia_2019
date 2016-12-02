<?php 
include_once("db.php");
include_once("header.php");
include_once("pantallas/expediente/librerias.php");
include_once("librerias_saia.php");
echo(librerias_notificaciones());

function eliminar_permiso($idserie,$tipo_entidad,$entidad)
{global $conn;
 phpmkr_query("DELETE from entidad_serie where serie_idserie='$idserie' and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad'",$conn);
}

//si viene de la pantalla asignar_serie_entidad.php
if(isset($_REQUEST["serie_entidad"]) && $_REQUEST["serie_entidad"])
{$tipo_entidad = $_REQUEST["tipo_entidad"];
 $entidades=explode(',',$_REQUEST["entidad_identidad"]);
 $series=explode(',',$_REQUEST["serie_idserie"]); 
 //validaci�n de ids
 if($tipo_entidad==1)
 {$nuevas=array();
  for($i=0;$i<count($entidades);$i++) //verifico que si es una entidad repetida, ponga bien el id
    {if(strpos($entidades[$i],"_")!==false)
       $nuevas[]=substr($entidades[$i],0,strpos($entidades[$i],"_"));
     elseif($entidades[$i]<>"RI#")
       $nuevas[]=$entidades[$i];  
    }
  $entidades=$nuevas;
  
  $funcionarios=busca_filtro_tabla("idfuncionario","funcionario","funcionario_codigo in(".implode(",",$entidades).")","",$conn);
    $entidades=extrae_campo($funcionarios,"idfuncionario","U");
   } 

 $nuevas=array();
 for($i=0;$i<count($series);$i++)//quito las categorias de la lista de series
  {if(strpos($series[$i],"-")==false)
     $nuevas[]=$series[$i];
  }
 $series=$nuevas; 
 //fin validaci�n ids
 for($j=0;$j<count($series);$j++){
 if(!$_REQUEST["opcion"])//si voy a quitar el permiso
  {$encontradas=busca_filtro_tabla("","entidad_serie","entidad_identidad='$tipo_entidad' and serie_idserie='".$series[$j]."' and llave_entidad in(".implode(",",$entidades).")","",$conn);  
   for($i=0;$i<$encontradas["numcampos"];$i++){
     eliminar_permiso($encontradas[$i]["serie_idserie"],$encontradas[$i]["entidad_identidad"],$encontradas[$i]["llave_entidad"]);
   } 
  }
 else //si voy a adicionar el permiso
  {for($i=0;$i<count($entidades);$i++){
     insertar_permiso($series[$j],$tipo_entidad,$entidades[$i]);
    }
  } 
 }
$ruta="asignarserie_entidad.php";
//print_r($_REQUEST);

?>
<script>
notificacion_saia('Asignacion realizada','success','',4000);
</script>
<?php

if(@$_REQUEST["tipo_entidad"] && @$_REQUEST["llave_entidad"])
  $ruta.="?tipo_entidad=".$_REQUEST["tipo_entidad"]."&llave_entidad=".$_REQUEST["llave_entidad"];
if(@$_REQUEST["origen"])
  $ruta.="&origen=".$_REQUEST["origen"];
if(@$_REQUEST["filtrar_categoria"])
  $ruta.="?filtrar_categoria=".$_REQUEST["filtrar_categoria"]; 
if(@$_REQUEST["filtrar_serie"]){
  $ruta.="?filtrar_serie=".$_REQUEST["filtrar_serie"];
  abrir_url("arbolserie.php","arbol");
}
if(@$_REQUEST["pantalla"]){
	if($_REQUEST["pantalla"]=="funcionario"){
		abrir_url("funcionario.php?key=".$_REQUEST["llave_entidad"],"_parent");
	}
}
redirecciona($ruta); 
die();
}

function insertar_permiso($idserie,$tipo_entidad,$entidad)
{global $conn;
 $datos=busca_filtro_tabla("*","entidad_serie","entidad_identidad=".$tipo_entidad." AND serie_idserie=".$idserie." AND llave_entidad=".$entidad,"",$conn);

   if(!@$datos["numcampos"])
      {$sqlInsert = "INSERT INTO entidad_serie(entidad_identidad, serie_idserie, llave_entidad, estado) VALUES (".$tipo_entidad.",".$idserie.",".$entidad.",'1')";
     
      }
    else $sqlInsert = "UPDATE entidad_serie SET estado=1 WHERE entidad_identidad=".$tipo_entidad." AND serie_idserie=".$idserie." AND llave_entidad=".$entidad;
		
		insertar_expediente_automatico($idserie);
		$idexp=obtener_idexpediente($idserie);
		asignar_expediente($idexp,$tipo_entidad, $entidad);
		
 $conn->Ejecutar_Sql($sqlInsert);  
}
function obtener_idexpediente($idserie,$indice=1){
	$indice++;
	if($indice>100)return false;
	$serie=busca_filtro_tabla("","serie a","a.idserie=".$idserie,"",$conn);
	if($serie[0]["tipo"]=="3"){
		$idexp=obtener_idexpediente($serie[0]["cod_padre"]);
		return $idexp;
	}
	else if($serie[0]["tipo"]=="1"||$serie[0]["tipo"]=="2"){
		$expediente=busca_filtro_tabla("","expediente a","a.serie_idserie=".$idserie,"",$conn);
		if($expediente["numcampos"]){
			return $expediente[0]["idexpediente"];
		}
		else{
			$idexp=obtener_idexpediente($serie[0]["cod_padre"],$indice);
			return $idexp;
		}
	}
	else{
		$expediente=busca_filtro_tabla("","expediente a","a.serie_idserie=".$idserie,"",$conn);
		if($expediente["numcampos"]){
			return $expediente[0]["idexpediente"];
		}
		else{
			$idexp=obtener_idexpediente($serie[0]["cod_padre"],$indice);
			return $idexp;
		}
	}
}
function padres($idserie,$tipo_entidad,$entidad,$tipo)
{global $conn;
 $padre=busca_filtro_tabla("cod_padre","serie","idserie='$idserie'","",$conn);
 
  if($padre[0]["cod_padre"]=='')
   return (true);               
  else
   {if($tipo==1)
      insertar_permiso($padre[0]["cod_padre"],$tipo_entidad,$entidad);
    if($tipo==2)
      {$hijos=busca_filtro_tabla("count(*)","entidad_serie,serie","serie_idserie=idserie and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad' and cod_padre='".$padre[0]["cod_padre"]."'","",$conn);

       if(!$hijos[0][0])
         eliminar_permiso($padre[0]["cod_padre"],$tipo_entidad,$entidad); 

      }
    padres($padre[0]["cod_padre"],$tipo_entidad,$entidad,$tipo);
    return(true);
   }  
}

function hijos($idserie,$tipo_entidad,$entidad,$tipo)
{global $conn;
 $hijos=busca_filtro_tabla("idserie","serie","estado=1 and cod_padre='$idserie'","",$conn);

 if(!$hijos["numcampos"])
   return(true);
 else
   {for($j=0;$j<$hijos["numcampos"];$j++)
       {if($tipo==1)
          insertar_permiso($hijos[$j]["idserie"],$tipo_entidad,$entidad);
        elseif($tipo==2)
          eliminar_permiso($hijos[$j]["idserie"],$tipo_entidad,$entidad);
        hijos($hijos[$j]["idserie"],$tipo_entidad,$entidad,$tipo);
       }
    return(true);
   }  
} 
   
include_once("footer.php");
?>
