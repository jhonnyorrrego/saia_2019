<?php 
include_once("db.php");
include_once("header.php");

$arreglo=$_REQUEST["opcion"];
$p=0;
foreach($arreglo as $dato){

if($dato!=""){
$opciones[$p]=$dato;
$p++;
}
} 


//si viene de la pantalla asignar_expediente_entidad.php
if(isset($_REQUEST["expediente_entidad"]) && $_REQUEST["expediente_entidad"])
{$tipo_entidad = $_REQUEST["tipo_entidad"];
$entidades=explode(',',$_REQUEST["entidad_identidad"]);
$expedientes=$_REQUEST["expediente"];
$permisos="";
 


for($h=0;$h<count($opciones);$h++){

if($opciones[$h]==0){
$permisos.="a";
}
if($opciones[$h]==1){
$permisos.="m";
}
if($opciones[$h]==2){
$permisos.="e";
}
if($opciones[$h]==3){
$permisos.="l";
}
if($opciones[$h]==4){
$permisos.="r";
}
if($h!=count($opciones)-1){
$permisos.=",";
}
}
   
 
 //validación de ids
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

 /*$nuevas=array();
 for($i=0;$i<count($expedientes);$i++)//quito las categorias de la lista de series
  {if(strpos($expedientes[$i],"-")==false)
     $nuevas[]=$expedientes[$i];
  }
 $expedientes=$nuevas;*/ 
 //fin validación ids
 for($j=0;$j<count($expedientes);$j++){ 

 for($i=0;$i<count($entidades);$i++){
     insertar_permiso($expedientes,$tipo_entidad,$entidades[$i],$permisos);
    }
 
 /*
 
 if(!$_REQUEST["accion"])//si voy a quitar el permiso
  {$encontradas=busca_filtro_tabla("","entidad_expediente","entidad_identidad='$tipo_entidad' and expediente_idexpediente='".$expedientes[$j]."' and llave_entidad in(".implode(",",$entidades).")","",$conn);  
   for($i=0;$i<$encontradas["numcampos"];$i++){
     eliminar_permiso($encontradas[$i]["expediente_idexpediente"],$encontradas[$i]["entidad_identidad"],$encontradas[$i]["llave_entidad"]);
   } 
  }
 else //si voy a adicionar el permiso
  {
  for($i=0;$i<count($entidades);$i++){
     insertar_permiso($expedientes,$tipo_entidad,$entidades[$i],$permisos);
    }
  }   */
 }
$ruta="permiso_expediente_funcionario.php?key=".$expedientes;
//print_r($_REQUEST);
if(@$_REQUEST["tipo_entidad"] && @$_REQUEST["llave_entidad"])
  $ruta.="?tipo_entidad=".$_REQUEST["tipo_entidad"]."&llave_entidad=".$_REQUEST["llave_entidad"];
if(@$_REQUEST["origen"])
  $ruta.="&origen=".$_REQUEST["origen"];
if(@$_REQUEST["filtrar_categoria"])
  $ruta.="?filtrar_categoria=".$_REQUEST["filtrar_categoria"]; 
if(@$_REQUEST["filtrar_expediente"])
  $ruta.="?filtrar_expediente=".$_REQUEST["filtrar_expediente"];  
    
redirecciona($ruta); 
die();  
}

function insertar_permiso($idexpediente,$tipo_entidad,$entidad,$permisos)
{global $conn;

 $datos=busca_filtro_tabla("*","entidad_expediente","entidad_identidad=".$tipo_entidad." AND expediente_idexpediente=".$idexpediente." AND llave_entidad=".$entidad,"",$conn);
 $fecha=date("Y-m-d");
   if(!@$datos["numcampos"])
      {$sqlInsert = "INSERT INTO entidad_expediente(entidad_identidad, expediente_idexpediente, llave_entidad, estado, permiso,fecha) VALUES (".$tipo_entidad.",".$idexpediente.",".$entidad.",'1','".$permisos."','".$fecha."')";
        
      }
    else $sqlInsert = "UPDATE entidad_expediente SET estado=1, permiso='".$permisos."', fecha=".$fecha." WHERE entidad_identidad=".$tipo_entidad." AND expediente_idexpediente=".$idexpediente." AND llave_entidad=".$entidad;
$conn->Ejecutar_Sql($sqlInsert);  
}

function padres($idexpediente,$tipo_entidad,$entidad,$tipo)
{global $conn;
 $padre=busca_filtro_tabla("cod_padre","expediente","idexpediente='$idexpediente'","",$conn);
 
  if($padre[0]["cod_padre"]=='')
   return (true);               
  else
   {if($tipo==1)
      insertar_permiso($padre[0]["cod_padre"],$tipo_entidad,$entidad);
    if($tipo==2)
      {$hijos=busca_filtro_tabla("count(*)","entidad_expediente,expediente","expediente_idexpediente=idexpediente and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad' and cod_padre='".$padre[0]["cod_padre"]."'","",$conn);

       if(!$hijos[0][0])
         eliminar_permiso($padre[0]["cod_padre"],$tipo_entidad,$entidad); 

      }
    padres($padre[0]["cod_padre"],$tipo_entidad,$entidad,$tipo);
    return(true);
   }  
}

function hijos($idexpediente,$tipo_entidad,$entidad,$tipo)
{global $conn;
 $hijos=busca_filtro_tabla("idexpediente","expediente","estado=1 and cod_padre='$idexpediente'","",$conn);

 if(!$hijos["numcampos"])
   return(true);
 else
   {for($j=0;$j<$hijos["numcampos"];$j++)
       {if($tipo==1)
          insertar_permiso($hijos[$j]["idexpediente"],$tipo_entidad,$entidad);
        elseif($tipo==2)
          eliminar_permiso($hijos[$j]["idexpediente"],$tipo_entidad,$entidad);
        hijos($hijos[$j]["idexpediente"],$tipo_entidad,$entidad,$tipo);
       }
    return(true);
   }  
} 


/*
function eliminar_permiso($idexpediente,$tipo_entidad,$entidad)
{global $conn;
 phpmkr_query("DELETE from entidad_expediente where expediente_idexpediente='$idexpediente' and entidad_identidad='$tipo_entidad' and llave_entidad='$entidad'",$conn);
} */

   
include_once("footer.php");
?>