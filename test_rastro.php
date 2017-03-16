<?php 
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0
if(isset($_GET["iddoc"]))
  $iddoc = @$_GET["iddoc"];
else $iddoc=$_SESSION["iddoc"];  
if(isset($_GET["id"]))
  $idusu = @$_GET["id"];
else $idusu=NULL;  
if ( stristr($_SERVER["HTTP_ACCEPT"],"application/xhtml+xml") ) 
{ 
  header("Content-type: application/xhtml+xml"); 
} 
else 
{ 
  header("Content-type: text/xml"); 
}
echo("<?xml version=\"1.0\" encoding=\"UTF-8\"?".">");
if($idusu && $idusu<>"")
  echo("<tree id=\"".$idusu."\">\n"); 
else
  echo("<tree id=\"0\">\n");
include_once("db.php");
llena_rastro($idusu);
echo("</tree>\n");
?>
<?php

function llena_rastro($idusu){
global $conn,$iddoc,$sql;
  if(!$idusu){
    $papas=busca_filtro_tabla("A.idtransferencia,A.nombre,A.origen,A.destino,to_char(A.fecha,'yyyy-mm-dd HH24:MI:SS') as fecha,A.tipo_origen,A.tipo_destino,A.notas","buzon_entrada A","A.archivo_idarchivo=".$iddoc,"A.idtransferencia ASC, origen asc",$conn);

    $ftorigen=$papas[0]["destino"];
    for($i=0;$i<$papas["numcampos"];$i++)
    {
      if($i==0 || $ftorigen==$papas[$i]["destino"]){
        if($papas[$i]["tipo_destino"]==1){
          $forigen=busca_filtro_tabla("nombres,apellidos","funcionario A","A.funcionario_codigo=".$papas[$i]["destino"],"",$conn);
        }
        if($papas[$i]["tipo_origen"]==1){
          $fdestino=busca_filtro_tabla("nombres,apellidos","funcionario A","A.funcionario_codigo=".$papas[$i]["origen"],"",$conn);
        }
        echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
        echo("text=\"".(ucwords($forigen[0]["nombres"]." ".$forigen[0]["apellidos"])." PARA ".ucwords($fdestino[0]["nombres"]." ".$fdestino[0]["apellidos"]))." (".$papas[$i]["nombre"]."-".$papas[$i]["fecha"].") \" id=\"".$papas[$i]["idtransferencia"]);
        if($papas[$i]["origen"]<>$papas[$i]["destino"])
          {$tiene_hijos=busca_filtro_tabla("count(idtransferencia) as cuantos","buzon_entrada","archivo_idarchivo=$iddoc and destino=".$papas[$i]["origen"],"",$conn);
          if(isset($tiene_hijos[0]["cuantos"]) && $tiene_hijos[0]["cuantos"])
             echo("\" child=\"1\">\n");
          else
             echo("\" child=\"0\">\n");
          }
        else
          echo("\" child=\"0\">\n");
        //llena_serie($papas[$i]["id$tabla"]);
        echo("</item>\n");
      }  
    }
  }    
  else{
    $torigen=busca_filtro_tabla("to_char(A.fecha,'yyyy-mm-dd HH24:MI:SS') as fecha,A.origen","buzon_entrada A","A.idtransferencia=".$idusu,"A.idtransferencia ASC",$conn); 
    if($torigen["numcampos"]){
      $papas=busca_filtro_tabla("A.idtransferencia,A.nombre,A.origen,A.destino,to_char(A.fecha,'yyyy-mm-dd HH24:MI:SS') as fecha2,A.fecha,A.tipo_origen,A.tipo_destino,A.notas","buzon_entrada A","archivo_idarchivo=".$iddoc." AND A.destino='".$torigen[0]["origen"]."' and A.fecha>=TO_DATE('".$torigen[0]['fecha']."','yyyy-mm-dd HH24:MI:SS')","A.idtransferencia ASC",$conn);
      $ftorigen=$papas[0]["destino"];
      for($i=0;$i<$papas["numcampos"];$i++)
      {
        if($i==0 || $ftorigen==$papas[$i]["destino"]){
          if($papas[$i]["tipo_destino"]==1){
            $forigen=busca_filtro_tabla("nombres,apellidos","funcionario A","A.funcionario_codigo=".$papas[$i]["destino"],"",$conn);
          }
          if($papas[$i]["tipo_origen"]==1){
            $fdestino=busca_filtro_tabla("nombres,apellidos","funcionario A","A.funcionario_codigo=".$papas[$i]["origen"],"",$conn);
          }
          echo("<item style=\"font-family:verdana; font-size:7pt;\" ");
          echo("text=\"".(ucwords($forigen[0]["nombres"]." ".$forigen[0]["apellidos"])." PARA ".ucwords($fdestino[0]["nombres"]." ".$fdestino[0]["apellidos"]))."(".$papas[$i]["nombre"]."-".$papas[$i]["fecha2"].") \" id=\"".$papas[$i]["idtransferencia"]);
          if($papas[$i]["origen"]<>$papas[$i]["destino"])
            {$tiene_hijos=$papas=busca_filtro_tabla("count(A.idtransferencia) as cuantos","buzon_entrada A","archivo_idarchivo=".$iddoc." AND A.destino='".$papas[$i]["origen"]."' and A.fecha>=TO_DATE('".$papas[$i]['fecha']."','yyyy-mm-dd HH24:MI:SS')","A.idtransferencia ASC",$conn);
             if(isset($tiene_hijos[0]["cuantos"]) && $tiene_hijos[0]["cuantos"]>0)
                echo("\" child=\"1\">\n");
             else
                echo("\" child=\"0\">\n");
            }
          else
            echo("\" child=\"0\">\n");
          echo("</item>\n");
        }      
      }            
    }
    else $papas["numcampos"]=0;
  }  
return;
}
?>
