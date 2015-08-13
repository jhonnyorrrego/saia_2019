<?php
$datos_ciudad=array();
$datos_secretaria=array();
if(!isset($_SESSION))
  session_start();
include_once("db.php");
if(!isset($_REQUEST["export"]))
 include_once("header.php");

if(isset($_REQUEST["export"])&& $_REQUEST["export"])
  {      
    header('Content-Type: application/vnd.ms-excel');
    header("Content-Disposition: attachment; filename=reporte_despacho".date("Y-m-d").".xls");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    echo "REPORTE DE DESPACHO";
  }
else
 {  
?>
 <p><span class="internos"><img class="imagen_internos" src="botones/configuracion/salidaslist.png" border="0">&nbsp;&nbsp;REPORTE DE DESPACHO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php
 echo '&nbsp;&nbsp;<a href="impresion_despacho.php?export=excel"><img src="enlaces/excel.gif" border="0" ALT="Exportar a Excel"></a></P>';  
}
$despachos=busca_filtro_tabla("DISTINCT documento_iddocumento,a.numero_guia,b.numero,".fecha_db_obtener("a.fecha_despacho","Y-m-d H:i")." AS fecha_despacho","salidas a,documento b","a.documento_iddocumento=b.iddocumento AND ".fecha_db_obtener("a.fecha_despacho","Y-m-d")." ='".date("Y-m-d")."'","b.numero,fecha_despacho",$conn);
 //   print_r($despachos);
if(!$despachos["numcampos"])
  die("No se han despachado documentos el dia de hoy.");
$key="documento_iddocumento";
$campos="destino,numero,fecha_salida,responsable,numero_guia,ciudad_destino";
$texto="<table border='1' style='empty-cells:show; border-collapse:collapse; font-family:verdana; font-size:11px;' align=center cellpadding=3>";
$texto.="<tr class='encabezado_list' style='font-weight:bold;' align='center'>";
$texto.="<td>Radicado</td><td>No Gu&iacute;a</td><td>Fecha Salida</td><td>Destinatario</td><td>Direccion Destino</td><td>Ciudad Destino</td>";
$texto.="</tr>";
$ldespachos=array();
for($i=0;$i<$despachos["numcampos"];$i++)
{
  $documento=busca_documento($key,$despachos[$i][$key]);
  $documento["salidas"]=$despachos[$i];
  $texto.=formatea($documento);
}

$texto.="</table>";
$texto_ciudad="<br /><table border='1' style='empty-cells:show; border-collapse:collapse; font-family:verdana; font-size:11px;' align=center>";
$texto_ciudad.="<tr class='encabezado_list' style='font-weight:bold;' align='center'>";
$texto_ciudad.="<td colspan='4'>Ciudad</td><td colspan='2'>Cantidad</td></tr>";
 $nombres=array_keys($datos_ciudad);
 sort($nombres);

  foreach($nombres AS $llave){
    $texto_ciudad.="<trclass='encabezado_list' style='font-weight:bold;' align='center'><td colspan='4'>".strtoupper($llave)."</td><td colspan='2' align=right>".$datos_ciudad[$llave]."</td></tr>";
    $valor_total+=$datos_ciudad[$llave];
  }
$texto_ciudad.="<tr class='encabezado_list' style='font-weight:bold;' align='center'><td colspan='4'>Total</td><td colspan='2' align=right>".$valor_total."</td></tr>";
$texto_ciudad.="</table>";
$texto_secretaria="<br /><table border='1' style='empty-cells:show; border-collapse:collapse; font-family:verdana; font-size:11px;' align=center>";
$texto_secretaria.="<tr class='encabezado_list' style='font-weight:bold;' align='center'>";
$texto_secretaria.="<td colspan='4'>Secretaria</td><td colspan='2'>Cantidad</td></tr>";
$nombres=array_keys($datos_secretaria);
 sort($nombres);
  foreach($nombres AS $llave){
    $texto_secretaria.="<tr><td colspan='4'>".ucwords($llave)."</td><td colspan='2' align=right>".$datos_secretaria[$llave]."</td></tr>";
    $total+=$datos_secretaria[$llave];
  }
$texto_secretaria.="<tr class='encabezado_list' style='font-weight:bold;' align='center'><td colspan='4'>Total</td><td colspan='2' align=right>".$valor_total."</td></tr>";
$texto_secretaria.="</table>";
echo($texto);
echo($texto_ciudad);
echo($texto_secretaria);



function busca_documento($key,$idkey){
global $conn;
$destinos=array();
switch($key){
  case "numero":
    $documento=busca_filtro_tabla("","documento","numero=".$idkey." AND tipo_radicado=2","",$conn);
  
  break;
  default:
    $documento=busca_filtro_tabla("","documento","iddocumento=".$idkey." AND tipo_radicado=2","",$conn);
    
  break;
}

if($documento["numcampos"]){
  if($documento[0]["plantilla"]!=""){
  
    $datos_adicionales=busca_filtro_tabla("",strtolower("ft_".$documento[0]["plantilla"]),"documento_iddocumento=".$documento[0]["iddocumento"],"",$conn);

    if($datos_adicionales["numcampos"]){
      switch($documento[0]["plantilla"]){
        case "CARTA":
          $destinos_carta=explode(",",$datos_adicionales[0]["destinos"]);
          foreach($destinos_carta AS $llave=>$valor){
            {array_push($destinos,$valor);
            }
           // echo("Carta:".$valor."<br />");
          }
        break;
        case "MEMORANDO":
          $destinos_memo=explode(",",$datos_adicionales[0]["destino"]);
          foreach($destinos_memo AS $llave=>$valor){
            array_push($destinos,$valor);
          //  echo("Memo:".$valor."<br />");
          }
        break;
      }
    }
  }
  else{
    if($documento[0]["tipo_radicado"]==2){
      array_push($destinos,$documento[0]["ejecutor"]);
      $ejecutor_salida=busca_filtro_tabla("","datos_ejecutor","iddatos_ejecutor=".$documento[0]["ejecutor"],"",$conn);
      print_r($ejecutor_salida);
      if($ejecutor_salida["numcampos"]){
        if($ejecutor_salida[0]["ciudad"]==""){
          //$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$documento[0]["municipio_idmunicipio"],"",$conn);
          $sql="UPDATE datos_ejecutor SET ciudad='".$documento[0]["municipio_idmunicipio"]."' WHERE iddatos_ejecutor=".$documento[0]["ejecutor"];
          //echo($sql."<br />".$documento[0]["numero"]);
          phpmkr_query($sql,$conn);
        }
      }
      //echo("RS:".$documento[0]["ejecutor"]."<br />");
    }
  }
}
$ejecutor=busca_filtro_tabla("","datos_ejecutor","iddatos_ejecutor IN('".implode("','",$destinos)."')","",$conn);
$responsable=busca_filtro_tabla("","dependencia","iddependencia=".$documento[0]["responsable"],"",$conn);
//print_r($responsable);
$total["documento"]=$documento;
$total["formato"]=$datos_adicionales;
$total["destinos"]=$ejecutor;
$total["secretaria"]=$responsable;
return($total);
}

function formatea($documento){
$texto="";
for($i=0;$i<$documento["destinos"]["numcampos"];$i++){

if(is_numeric($documento["destinos"][$i]["ciudad"]))
{$ciudad=busca_filtro_tabla("nombre","municipio","idmunicipio=".$documento["destinos"][$i]["ciudad"],"",$conn);
 $documento["destinos"][$i]["ciudad"]=$ciudad[0]["nombre"];
}
if(!isset($documento["destinos"][$i]["nombre"]))
{$ejecutor=busca_filtro_tabla("nombre","ejecutor","idejecutor=".$documento["destinos"][$i]["ejecutor_idejecutor"],"",$conn);
 $documento["destinos"][$i]["nombre"]=$ejecutor[0]["nombre"];
}

  $texto.="<tr>";
  $texto.="<td>".$documento["documento"][0]["numero"]."</td><td>".$documento["salidas"]["numero_guia"]."</td><td>".$documento["salidas"]["fecha_despacho"]."</td><td>".$documento["destinos"][$i]["nombre"]."</td><td>".$documento["destinos"][$i]["direccion"]."</td><td>".$documento["destinos"][$i]["ciudad"]."</td>";
  $texto.="</tr>";
contar_campos($documento["destinos"][$i]["ciudad"],"ciudad");
contar_campos($documento["secretaria"][0]["nombre"],"secretaria");
}
return($texto);
}
function contar_campos($registro,$tipo){
global $datos_ciudad,$datos_secretaria;
$registro=strtolower($registro);
switch($tipo){
  case "ciudad":
    if(array_key_exists($registro,$datos_ciudad)){
      $datos_ciudad[$registro]+=1;
    }
    else
      $datos_ciudad[$registro]=1;
  break;
  case "secretaria":
    if(array_key_exists($registro,$datos_secretaria)){
      $datos_secretaria[$registro]+=1;
    }
    else
      $datos_secretaria[$registro]=1;

  break;
}
}
if(!isset($_REQUEST["export"])) 
 include_once("footer.php");
?>