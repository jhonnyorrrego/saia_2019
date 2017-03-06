<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 ISO-8859-1

if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
//  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
 // header("Content-type: text/xml"); 
}
$rxml="";

//echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");

$id = @$_GET["id"];

if($id and $id<>"")
 $rxml.="<tree id=\"".$id."\">\n";
else
 $rxml.="<tree id=\"0\">\n";

require_once("../db.php");
  
if($id and $id<>"")
echo llena_dependencia(substr($id,0,strlen($id)-1),0);
else
  llena_dependencia(0,0); 
$tipo=valida_envio("tipo",1,3); 
/*en caso de tipo=1 o 3 envia el codigo de la dependencia,
 en caso de tipo=2 envia el codigo del documento*/
$codigo=valida_envio("key",0,3);
echo("</tree>\n");
?>
<?php


function llena_dependencia($codigo, $ruta){
global $conn,$sql;
$rxml="";

if($codigo)
 $prof=busca_filtro_tabla("iddependencia,nombre","dependencia","cod_padre=".$codigo,"",$conn);
else 
 $prof=busca_filtro_tabla("iddependencia,nombre","dependencia","cod_padre IS NULL","",$conn);
  
    
  if($prof["numcampos"]){
    $rxml.="<item style=\"font-family:verdana; font-size:7pt;\" ";

    $hijos=busca_filtro_tabla("*","dependencia A","A.cod_padre=".$prof[0]["iddependencia"],"A.nombre ASC",$conn);
    if($hijos["numcampos"])
   	{   
	      $rxml.="text=\"".(formato_cargo($prof[0]["nombre"]))."\" id=\"".$prof[0]["iddependencia"]."#\" child=\"1\">\n";
	     
	      for($i=0;$i<$hijos["numcampos"];$i++)
	    	{ 
	          $rxml.=llena_dependencia($hijos[$i]["iddependencia"],$ruta);
	        }
	    $tmp="";  	   
	   // $tmp=llena_funcionarios($codigo,$ruta);
	    $rxml.=$tmp."</item>\n"; 
	    
    }
   else  // No tiene dependencias  hijos llena el tag 
    { $tmp="";
     //$tmp=llena_funcionarios($codigo,$ruta);
     
     if($tmp!="")
      { $rxml.="text=\"".(formato_cargo($prof[0]["nombre"]))."\" id=\"".$prof[0]["iddependencia"]."#\" child=\"1\">\n";
        $rxml.=$tmp;
      }  
     else
     { 
        $rxml.="text=\"".(formato_cargo($prof[0]["nombre"]))."\" id=\"".$prof[0]["iddependencia"]."#\" child=\"0\" />\n";
     }       
   }       
  }
 else 
 {  //$rxml.="<item style=\"font-family:verdana; font-size:7pt;\" ";
    //$rxml.="text=\"".(formato_cargo($prof[0]["nombre"]))."\" id=\"".$prof[0]["iddependencia"]."#\" child=\"1\">\n";
    //$rxml.="</item>\n";
    
 } 
  
echo $rxml;
return $rxml; 
} 

function llena_funcionarios($codigo,$ruta){
global $conn,$sql;

//GROUP BY funcionario_codigo 
$usuarios=busca_filtro_tabla("A.login,A.funcionario_codigo,A.nombres AS nombres_ord,A.apellidos AS apellidos,C.nombre AS cargo","funcionario A,dependencia_cargo B, cargo C","B.cargo_idcargo=C.idcargo AND B.funcionario_idfuncionario=A.idfuncionario AND B.dependencia_iddependencia <> 1 AND A.estado=1 AND B.estado=1 AND B.dependencia_iddependencia=".$codigo,"nombres_ord ASC",$conn);
if($ruta == 0)
 $ruta = "";
else
  $ruta = "%".$ruta; 
for($j=0;$j<$usuarios["numcampos"];$j++){
   $rxml.="<item style=\"font-family:verdana; font-size:7pt;\" ";
   if($usuarios[$j]["nombres_ord"])
    $rxml.="text=\"".ucwords(($usuarios[$j]["nombres_ord"]." ".$usuarios[$j]["apellidos"]))." (".($usuarios[$j]["login"])."-".(formato_cargo($usuarios[$j]["cargo"])).")\" id=\"".$usuarios[$j]["funcionario_codigo"]."$ruta\" ruta=\"$ruta\" child=\"0\">";
   else  
    $rxml.="text=\"".($usuarios[$j]["login"])."\" id=\"".$usuarios[$j]["funcionario_codigo"]."$ruta\" ruta=\"$ruta\" child=\"0\">";
   $rxml.="</item>\n"; 
}
if($usuarios["numcampos"])
  return(TRUE);
else  return(FALSE); 
}

function llena_funcionario($codigo,$ruta){
global $conn,$sql;
$usuarios=busca_filtro_tabla("*","funcionario A","A.estado=1 AND A.funcionario_codigo=".$codigo,"",$conn);
if($usuarios["numcampos"]){
  $rxml.="<item style=\"font-family:verdana; font-size:7pt;\" ";
  if($usuarios[0]["nombres_ord"])
    $rxml.="text=\"".ucwords(($usuarios[0]["nombres_ord"]." ".$usuarios[0]["apellidos"]))." (".$usuarios[0]["funcionario_codigo"].")\" id=\"".$usuarios[0]["funcionario_codigo"]."%$ruta\" ruta=\"$ruta\">";
  else  
    $rxml.="text=\"".($usuarios[0]["login"]."\" id=\"".$usuarios[0]["funcionario_codigo"])."\" ruta=\"$ruta\">";
  $rxml.="</item>\n";
  return(TRUE);    
}
return(FALSE);
}

function llena_ruta($doc){
global $conn,$sql;
$llenado=FALSE;
$origen=usuario_actual("funcionario_codigo");
$documento=busca_filtro_tabla("","documento","iddocumento=".$doc,"",$conn);
if($documento["numcampos"]){
  $listado=busca_filtro_tabla("DISTINCT A.idruta,A.origen,A.destino,A.condicion_transferencia,A.tipo_destino","ruta A","A.idtipo_documental=".$documento[0]["serie"]." AND A.origen=".$origen." AND A.tipo_origen=1 AND A.tipo='ACTIVO'","",$conn);
  for($i=0;$i<$listado["numcampos"];$i++){    
    $tipo_destino=$listado[$i]["tipo_destino"];
    if($tipo_destino==1)
      $destino=busca_cargo_funcionario($listado[$i]["tipo_destino"],$listado[$i]["destino"],'',$conn);
    else if($tipo_destino==2)
      $destino=busca_filtro_tabla("","dependencia","iddependencia=".$listado[$i]["destino"],"",$conn);
    if($destino["numcampos"]){
      if($tipo_destino==2)
        $llenado=llena_dependencia($destino[0]["iddependencia"],$listado[$i]["idruta"]);
      else   
        $llenado=llena_funcionario($destino[0]["funcionario_codigo"],$listado[$i]["idruta"]);     
    }
  }
}
return $llenado;
}
?>
