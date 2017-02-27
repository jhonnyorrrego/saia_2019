<?php

include_once("librerias_saia.php");
echo(librerias_jquery());
include_once("pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');

$texto="";
if(isset($_REQUEST["exportar"])&&$_REQUEST["exportar"]<>""){
  $sExport=$_REQUEST["exportar"];
}
//else $sExport="excel";

include_once("db.php");
if($_REQUEST["idreporte"]){
  $reporte=busca_filtro_tabla("","reporte","idreporte=".$_REQUEST["idreporte"],"",$conn);
  if(isset($_REQUEST["filtro_reporte"])&&$_REQUEST["filtro_reporte"])
     $reporte[0]["sql_reporte"]=str_replace("/*filtro*/"," and ".stripslashes($_REQUEST["filtro_reporte"]),$reporte[0]["sql_reporte"]);
     
  //echo $reporte[0]["sql_reporte"]."<br /><br />";   
  $datos=ejecuta_filtro_tabla($reporte[0]["sql_reporte"],$conn);
  
  /************************** mascaras******************************/
if($reporte[0]["mascaras"]<>"")
 {$campos_masc=explode("||",$reporte[0]["mascaras"]);

  for($j=0;$j<count($campos_masc);$j++)
   {$mascaras=explode("|",$campos_masc[$j]);
    $campo=$mascaras[0];
    $mascaras=explode("!",$mascaras[1]);
    $valores=array();
    for($i=0;$i<count($mascaras);$i++)
      {$fila=explode("@",$mascaras[$i]);
       $valores[$fila[0]]=$fila[1];
      }

    for($i=0;$i<$datos["numcampos"];$i++)
      {if($fila[0]=="*funcion*")
         $datos[$i][$campo]=$fila[1]($datos[$i][$campo]);
       else
         $datos[$i][$campo]=$valores[$datos[$i][$campo]];
      }
   }
  
 }
/************************** fin mascaras**************************/
  if($_REQUEST["exportar"]=="")
    {include_once("header.php");
     echo "<br /><b>".ucwords($reporte[0]["nombre_archivo"])."</b>
     <br /><br />Registros encontrados: ".$datos["numcampos"]."&nbsp;&nbsp;&nbsp;<a href='graficos/listado_graficos.php?cmd=0";
     if(@$_REQUEST["lreportes"]){
      echo("&lreportes=".$_REQUEST["lreportes"]);
     }
     if(@$_REQUEST["lgraficos"]){
      echo("&lgraficos=".$_REQUEST["lgraficos"]);
     }
     echo("'>Volver al listado</a><br /><br />");
     if($_REQUEST["etiquetasfiltroreporte"]<>"")
       echo "<b>Filtro</b><br /> ".$_REQUEST["etiquetasfiltroreporte"]."<br /><br />";

    }
  //print_r($reporte);
  //echo("<hr /><br /><br />");
  if($reporte["numcampos"]){
    $archivo=escapeshellcmd(strip_tags($reporte[0]["nombre_archivo"]));
    if ($sExport == "excel"){
      header('Content-Type: application/vnd.ms-excel');
      header("Content-Disposition: attachment; filename=".$archivo.".xls");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    }
    if ($sExport == "word"){
    	header('Content-Type: application/vnd.ms-word');
    	header("Content-Disposition: attachment; filename=".$archivo.".doc");
    	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    }
    /*if ($sExport == "xml"){
    	header('Content-Type: text/xml');
    	header("Content-Disposition: attachment; filename=".$archivo.".xml");
    	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    }*/
    if ($sExport == "csv"){
    	header('Content-Type: application/csv');
    	header('Content-Disposition: attachment; filename='.$archivo.'.csv');
    	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    	$caracter_csv=";";
    }
    
    if($datos["numcampos"]){
      if($sExport !="csv"){
        $texto.="<table border='1' width='100%'>";
      }
      $cont_datos=count($datos[0]);
      $nom_col=array_keys($datos[0]);
      for($j=0;$j<(($cont_datos));$j++){
        if($j%2){
          if($sExport =="csv"){
            if($j==1){
              $texto.=$nom_col[$j];
            }
            else{
              $texto.=$caracter_csv.$nom_col[$j];
            }
          }
          else{
            $texto.='<td align="center" ';
          if($_REQUEST["exportar"]=="")
            $texto.=' class="encabezado_list" ';
          $texto.='>'.strtoupper(str_replace("_"," ",$nom_col[$j])).'</td>';
          }
        }
      }
      if($sExport =="csv"){
        $texto.="\n";
      }
      for($i=0;$i<$datos["numcampos"];$i++){
        if($sExport !="csv"){
          $texto.='<tr>';
        }
        for($j=1;$j<count($nom_col);$j+=2){
          if($sExport =="csv"){
            if($j==0){
              $texto.=$datos[$i][$nom_col[$j]];
            }
            else{
              $texto.=$caracter_csv.$datos[$i][$nom_col[$j]];
            }
          }
          else {
            if($datos[$i][$nom_col[$j]]<>"")
              $texto.="<td>".strip_tags(htmlspecialchars_decode($datos[$i][$nom_col[$j]]))."</td>";
            else
              $texto.="<td>&nbsp;</td>";  
          }
        }
        if($sExport !="csv"){
          $texto.='</tr>';
        }
        else
          $texto.="\n";
      }
      if($sExport !="csv"){
        $texto.="</table>";
      }
    }
  }
}
echo($texto);
if($_REQUEST["exportar"]=="")
    include_once("footer.php");

?>