<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."header.php");
$procesos=busca_filtro_tabla("nombre,idft_proceso","ft_proceso p,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' AND p.estado<>'INACTIVO'","nombre",$conn);
?>
<br><b>CONSOLIDADO DE RIESGOS POR PROCESO Y ESTADO</b><br><br>
<table border="1" width="100%">
<tr class="encabezado_list">
<td>PROCESO</td><td>RIESGO ACEPTABLE</td><td>RIESGO TOLERABLE</td><td>RIESGO MODERADO</td><td>RIESGO IMPORTANTE</td><td>RIESGO INACEPTABLE</td><td>TOTAL</td>
</tr>
<?php
$totales=array("aceptable"=>0,"tolerable"=>0,"moderado"=>0,"importante"=>0,"inaceptable"=>0);
for($i=0;$i<$procesos["numcampos"];$i++)
  {$valores[$i]=array("aceptable"=>cuadrante($procesos[$i]["idft_proceso"],"aceptable"),"tolerable"=>cuadrante($procesos[$i]["idft_proceso"],"tolerable"),"moderado"=>cuadrante($procesos[$i]["idft_proceso"],"moderado"),"importante"=>cuadrante($procesos[$i]["idft_proceso"],"importante"),"inaceptable"=>cuadrante($procesos[$i]["idft_proceso"],"inaceptable"),"dato"=>$procesos[$i]["nombre"]);
   
   $total_riesgos=$valores[$i]["aceptable"]+$valores[$i]["tolerable"]+$valores[$i]["moderado"]+$valores[$i]["importante"]+$valores[$i]["inaceptable"];
   
   $valores[$i]["valor"]=$total_riesgos;
   
   echo '<tr><td>'.$procesos[$i]["nombre"].'</td>
        <td align="center">'.$valores[$i]["aceptable"].'</td>
        <td align="center">'.$valores[$i]["tolerable"].'</td>
        <td align="center">'.$valores[$i]["moderado"].'</td>
        <td align="center">'.$valores[$i]["importante"].'</td>
        <td align="center">'.$valores[$i]["inaceptable"].'</td>
        <td align="center"><b>'.$total_riesgos.'</b></td>
        </tr>';
   
   $totales["aceptable"]+=$valores[$i]["aceptable"];
   $totales["tolerable"]+=$valores[$i]["tolerable"];
   $totales["moderado"]+=$valores[$i]["moderado"];
   $totales["importante"]+=$valores[$i]["importante"];
   $totales["inaceptable"]+=$valores[$i]["inaceptable"];
   
        
  }
$valores["numcampos"]=$procesos["numcampos"];  
$sumatotal=$totales["aceptable"]+$totales["tolerable"]+$totales["moderado"]+$totales["importante"]+$totales["inaceptable"];
echo '<tr style="font-weight:bold">
<td>TOTALES</td>
<td align="center">'.$totales["aceptable"].'</td>
<td align="center">'.$totales["tolerable"].'</td>
<td align="center">'.$totales["moderado"].'</td>
<td align="center">'.$totales["importante"].'</td>
<td align="center">'.$totales["inaceptable"].'</td>
<td align="center">'.$sumatotal.'</td>
</tr></table>';        
?>

<SCRIPT LANGUAGE="Javascript" SRC="<?php echo $ruta_db_superior.'graficos/'; ?>FusionCharts/FusionCharts.js"></SCRIPT>
<?php
include_once($ruta_db_superior."graficos/includes/funciones.php");
include_once($ruta_db_superior."graficos/includes/FusionCharts_Gen.php");


$suma=0;
$strParam="xAxisName=Proceso;yAxisName=Riesgos;bgAlpha=50;caption=Riesgos por proceso;rotateNames=1;showValues=1;animation=1;";
  $FC =new FusionCharts("Column2D",500,500); 
  $FC->setSWFPath($ruta_db_superior."graficos/FusionCharts/");
  $FC->setChartParams($strParam);                                              
  $suma=0;
  $datos_grafico=array();
  $leyenda="";
echo "<br /><br /><b>GRAFICOS</b><br /><br />
      <table width='100%'><tr><td valign='top'>";  
  if($valores["numcampos"]){
    $suma=0; 
    for($j=0;$j<$valores["numcampos"];$j++){ 
        
       $color2="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       if($color!=$color2)
        $color=$color2;
       else {
        $color="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       } 
      $FC->addChartData($valores[$j]["valor"],"color=".$color.";name=".$valores[$j]["dato"]);
      //$leyenda.='<tr style="border:1px solid;"><td style="width:10px; border:1px solid; background-color:'.$color.';">&nbsp;</td><td style="border:1px solid;">'.$valores[$j]["dato"].'</td><td style="border:1px solid; text-align:right;">'.$valores[$j]["valor"].'</td></tr>'; 
      $suma+=$valores[$j]["valor"];  
    } 
    $FC->renderChart();   
    //echo '</td><td valign="top"><table style="width:100%;border-collapse:collapse;border:1px solid;"><tr align="center" style="border:1px solid; font-weight:bold;"><td style="border:1px solid;">&nbsp;</td><td style="border:1px solid;">Etiqueta</td><td style="border:1px solid;">Valor</td></tr>'.$leyenda.'<tr><td colspan="2" style="border:1px solid; font-weight:bold;">SUMA TOTAL</td><td style="border:1px solid; text-align:right; font-weight:bold;">'.$suma.'</td></tr></table></td></tr>';
  }    
echo "</td><td valign='top'>";
$strParam="xAxisName=Estado;yAxisName=Riesgos;bgAlpha=50;caption=Riesgos por estado;rotateNames=0;showValues=1;animation=1;";
$FC =new FusionCharts("Column2D",550,300); 
$FC->setSWFPath($ruta_db_superior."graficos/FusionCharts/");
$FC->setChartParams($strParam);                
$suma=0; 
$valores=array();
$valores[]=array("valor"=>$totales["aceptable"],"dato"=>"ACEPTABLE");
$valores[]=array("valor"=>$totales["tolerable"],"dato"=>"TOLERABLE");
$valores[]=array("valor"=>$totales["moderado"],"dato"=>"MODERADO");
$valores[]=array("valor"=>$totales["importante"],"dato"=>"IMPORTANTE");
$valores[]=array("valor"=>$totales["inaceptable"],"dato"=>"INACEPTABLE");
$valores["numcampos"]=5;
 for($j=0;$j<$valores["numcampos"];$j++){ 
        
       $color2="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       if($color!=$color2)
        $color=$color2;
       else {
        $color="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       } 
      $FC->addChartData($valores[$j]["valor"],"color=".$color.";name=".$valores[$j]["dato"]);
      $leyenda.='<tr style="border:1px solid;"><td style="width:10px; border:1px solid; background-color:'.$color.';">&nbsp;</td><td style="border:1px solid;">'.$valores[$j]["dato"].'</td><td style="border:1px solid; text-align:right;">'.$valores[$j]["valor"].'</td></tr>'; 
      $suma+=$valores[$j]["valor"];  
    } 
    $FC->renderChart();   

echo "</tr></table>";

include_once($ruta_db_superior."footer.php");
function cuadrante($idproceso,$calificacion){
global $conn;
$texto="";
 
$riesgos=busca_filtro_tabla("impacto,probabilidad,descripcion AS nombre,idft_riesgos_proceso,consecutivo,documento_iddocumento ","ft_riesgos_proceso","estado<>'INACTIVO' AND ft_proceso=".$idproceso,"idft_riesgos_proceso asc",$conn);
$cuenta=0;
//print_r($riesgos);
for($i=0;$i<$riesgos["numcampos"];$i++)
{$seguimientos=busca_filtro_tabla("","ft_seguimiento_riesgo,documento","ft_riesgos_proceso=".$riesgos[$i]["idft_riesgos_proceso"]." AND documento_iddocumento=iddocumento and estado<>'ELIMINADO'","iddocumento asc",$conn);
 
  if($seguimientos["numcampos"]){ 
   for($j=0;$j<$seguimientos["numcampos"];$j++) 
    {if($seguimientos[$j]["probabilidad"]<>2)                                                
       {if($seguimientos[$j]["probabilidad"]==1 && $riesgos[$i]["probabilidad"]>1)
         $riesgos[$i]["probabilidad"]--;
        elseif($seguimientos[$j]["probabilidad"]==3 && $riesgos[$i]["probabilidad"]<3) 
         $riesgos[$i]["probabilidad"]++;
       }  
     if($seguimientos[$j]["impacto"]<>2) 
       {if($seguimientos[$j]["impacto"]==1 && $riesgos[$i]["impacto"]>5)
          $riesgos[$i]["impacto"]/=2;
        elseif($seguimientos[$j]["impacto"]==3 && $riesgos[$i]["impacto"]<20) 
          $riesgos[$i]["impacto"]*=2;
       } 
    }
 
  }

if($calificacion=="aceptable")
 {if($riesgos[$i]["impacto"]==5&&$riesgos[$i]["probabilidad"]==1)
    $cuenta++;
 }
elseif($calificacion=="tolerable")
 {if(($riesgos[$i]["impacto"]==10 && $riesgos[$i]["probabilidad"]==1) || ($riesgos[$i]["impacto"]==5 && $riesgos[$i]["probabilidad"]==2))
    $cuenta++;   
 }
elseif($calificacion=="moderado")
 {if(($riesgos[$i]["impacto"]==10 && $riesgos[$i]["probabilidad"]==2) || ($riesgos[$i]["impacto"]==20 && $riesgos[$i]["probabilidad"]==1) || ($riesgos[$i]["impacto"]==5 && $riesgos[$i]["probabilidad"]==3))
    $cuenta++;   
 }   
elseif($calificacion=="importante")
 {if(($riesgos[$i]["impacto"]==20 && $riesgos[$i]["probabilidad"]==2) || ($riesgos[$i]["impacto"]==10 && $riesgos[$i]["probabilidad"]==3))
    $cuenta++;   
 } 
elseif($calificacion=="inaceptable")
 {if($riesgos[$i]["impacto"]==20 && $riesgos[$i]["probabilidad"]==3)
    $cuenta++;   
 } 
}
return($cuenta);
}
?>
