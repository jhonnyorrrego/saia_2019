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

include_once("../db.php");

include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery());
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
desencriptar_sqli('form_info');



if(!@$_REQUEST["idgrafico"]){
  alerta("No se ha seleccionado un gráfico");
  volver(1);
}
include_once("includes/FusionCharts_Gen.php");
include_once("includes/funciones.php");
?>
<HTML>
<HEAD> 
  <SCRIPT LANGUAGE="Javascript" SRC="FusionCharts/FusionCharts.js"></SCRIPT>
  <script src="../js/jquery.js" type="text/javascript"></script>
  <script type="text/javascript"> 
  $().ready(function() {
    $('#opbusqueda').click(function(){
    mostrar_opciones_busqueda();
    });
    mostrar_opciones_busqueda();
  });
  function mostrar_opciones_busqueda(){
    if($('#opbusqueda:checked').length){
      $('#opciones_busqueda').show();
    }
    else $('#opciones_busqueda').hide();
  }
  </script>
</HEAD>
<BODY>
<?php	
include_once("../header.php");
$grafico=busca_filtro_tabla("","grafico","idgrafico=".$_REQUEST["idgrafico"],"",$conn);
//print_r($grafico);
$ancho=$grafico[0]["ancho"];
$alto=$grafico[0]["alto"];
$titulo=utf8_encode(html_entity_decode($grafico[0]["etiqueta"]));
$subtitulo="";
$titulo_x=utf8_encode(html_entity_decode($grafico[0]["etiquetax"]));
$titulo_y=utf8_encode(html_entity_decode($grafico[0]["etiquetay"]));
$prefijo=$grafico[0]["prefijo"];  //aplica para todos los numeros que se muestran
$precision=$grafico[0]["presicion_dato"];
$separados_decimal="";
$separado_miles="";
$rotar_titulos=$grafico[0]["direccion_titulo"];
$transparencia="50";
$tipo=array();
?>
<table border="1px" width="100%">
  <tr>
    <td width="60%">
      <span class="internos">
      <img class="imagen_internos" src="../botones/configuracion/proceso_usuario.png" border="0">&nbsp;&nbsp;REPORTE <?php echo(strtoupper($titulo))?><br /><a href="listado_graficos.php">Ir al listado de Graficos y Reportes</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:history.go(0);">Recargar</a>
      </span>
    </td>
    <td>
      Tipo de grafico:<input type="checkbox" name="opbusqueda" id="opbusqueda" >
      <div id="opciones_busqueda"> 
        <form name="graficas" id="graficas" action="#" method="POST">
          <input type="checkbox" name="tipo_graf[]" value="Column2D" <?php if(in_array("Column2D",$tipo)) echo("checked"); ?>>Columnas 2D<br />
          <input type="checkbox" name="tipo_graf[]" value="Column3D" <?php if(in_array("Column3D",$tipo)) echo("checked"); ?>>Columnas 3D<br />
          <input type="checkbox" name="tipo_graf[]" value="Line" <?php if(in_array("Line",$tipo)) echo("checked"); ?>>Lineas<br />
          <input type="checkbox" name="tipo_graf[]" value="Pie3D" <?php if(in_array("Pie3D",$tipo)) echo("checked"); ?>>Torta<br />
          <input type="checkbox" name="tipo_graf[]" value="Area2D" <?php if(in_array("Area2D",$tipo)) echo("checked"); ?>>&Aacute;rea 2D<br /><br>
          <input type="submit" valeu="Graficar">
        </form>  
</div>

    </td>
  </tr>
<?php      
if(@$_REQUEST["tipo_graf"])
  $tipo=$_REQUEST["tipo_graf"];
else if($grafico[0]["tipo_grafico"]){
  switch($grafico[0]["tipo_grafico"]){
    case "torta":
      $tipo=array("Pie3D");
    break;
    case "barra":
      $tipo=array("Column3D");
    break;
    default: $tipo=array($grafico[0]["tipo_grafico"]);
    break;
  }
}
else array_push($tipo,"Column3D");

/*array_push($tipo,"Column3D");
array_push($tipo,"Column2D");
array_push($tipo,"Line");
array_push($tipo,"Pie3D");
array_push($tipo,"Area2D");
array_push($tipo,"MSColumn3DLineDY");
array_push($tipo,"Doughnut2D");
array_push($tipo,"Pie2D");
array_push($tipo,"Bar2D");
array_push($tipo,"MSColumn3D");
array_push($tipo,"MSColumn2D");
array_push($tipo,"MSArea2D");
array_push($tipo,"MSLine");
array_push($tipo,"MSBar2D");
array_push($tipo,"StackedColumn2D");
array_push($tipo,"StackedColumn3D");
array_push($tipo,"StackedBar2D");
array_push($tipo,"StackedArea2D");*/
if(isset($_REQUEST["filtro"])&&$_REQUEST["filtro"])
  $grafico[0]["sql_grafico"]=str_replace("/*filtro*/"," and ".stripslashes($_REQUEST["filtro"]),$grafico[0]["sql_grafico"]);
 // echo ("<br /><br />".$grafico[0]["sql_grafico"]."<br />");
$datos=arreglo_sql($grafico[0]["sql_grafico"],$conn);
/************************** mascaras******************************/

if($grafico[0]["mascaras"]<>"")
 {$mascaras=explode("|",$grafico[0]["mascaras"]);
  $campo=$mascaras[0];
  $mascaras=explode("!",$mascaras[1]);

  for($i=0;$i<count($mascaras);$i++)
    {$fila=explode("@",$mascaras[$i]);
     $valores[$fila[0]]=$fila[1];
    }
  
  for($i=0;$i<$datos["numcampos"];$i++)
    {$datos[$i][$campo]=$valores[$datos[$i][$campo]];
    }
 }

/************************** fin mascaras**************************/
for($i=0;isset($tipo[$i]);$i++){
  echo('<tr>
    <td valign="top">');
  switch($tipo[$i]){
  case "Column2D":
    $strParam="xAxisName=".$titulo_x.";yAxisName=".$titulo_y;
  break;
  case "Column3D":
    $strParam="xAxisName=".$titulo_x.";yAxisName=".$titulo_y;
    $mostrar_valores="1";
  break;
  case "Line":
    $strParam="xAxisName=".$titulo_x.";yAxisName=".$titulo_y;
    $mostrar_valores="0";
  break;
  case "Pie3D":
    $ancho=$grafico[0]["ancho"]+150;
    $alto=$grafico[0]["alto"];  
    $strParam="anchorSides=1";
    $mostrar_valores="1";
  break;
  case "Area2D":
    $strParam="xAxisName=".$titulo_x.";yAxisName=".$titulo_y;
    $mostrar_valores="0";
  break;  
  case "Pie2D":
    $strParam="anchorSides=20;anchorRadius=3;anchorBorderColor=FF8000";
  break;
  case "MSColumn3DLineDY":
    $strParam="xAxisName=".$titulo_x.";pYAxisName=".$titulo_x;
  break;
  case "Doughnut2D":
    $strParam="pieRadius=3";
  break;  
  }
  $strParam.=";bgAlpha=".$transparencia.";caption=".$titulo.";subcaption=".$subtitulo.";numberPrefix=".$prefijo.";decimalPrecision=".$precision.";decimalSeparator=".$separador_decimal.";thousandSeparator=".$separador_miles.";rotateNames=".$rotar_titulos.";showValues=".$mostrar_valores.";animation=1; exportEnabled=1; exportHandler='http://www.domain.com/FusionCharts/ExportHandlers/PHP/FCExporter.php'";

  $FC =new FusionCharts($tipo[$i],$ancho,$alto); 
  $FC->setSWFPath("FusionCharts/");
  $FC->setChartParams($strParam);                                              
  $suma=0;
  $datos_grafico=array();
  $leyenda="";
  if($datos["numcampos"]){
    $suma=0; 
    for($j=0;$j<$datos["numcampos"];$j++){ 
        
       $color2="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       if($color!=$color2)
        $color=$color2;
       else {
        $color="#".dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15)).dechex(rand(0,15));
       } 
      $FC->addChartData($datos[$j]["valor"],"color=".$color.";name=".utf8_encode(html_entity_decode($datos[$j]["dato"])));
      $leyenda.='<tr style="border:1px solid;"><td style="width:10px; border:1px solid; background-color:'.$color.';">&nbsp;</td><td style="border:1px solid;">'.$datos[$j]["dato"].'</td><td style="border:1px solid; text-align:right;">'.$datos[$j]["valor"].'</td></tr>'; 
      $suma+=$datos[$j]["valor"];  
    } 
    $FC->renderChart();   
    echo '</td><td valign="top"><br><br><table style="width:100%;border-collapse:collapse;border:1px solid;"><tr align="center" style="border:1px solid; font-weight:bold;"><td style="border:1px solid;">&nbsp;</td><td style="border:1px solid;">Etiqueta</td><td style="border:1px solid;">Valor</td></tr>'.$leyenda.'<tr><td colspan="2" style="border:1px solid; font-weight:bold;">SUMA TOTAL</td><td style="border:1px solid; text-align:right; font-weight:bold;">'.$suma.'</td></tr>';
   if($_REQUEST["etiquetasfiltro"]<>"")
      echo '<tr><td colspan=2><br /><b>Filtro</b>: <br />'.$_REQUEST["etiquetasfiltro"].'</td></tr>';
   echo '</table></td></tr>';
  }  
}
?>
</table> 
<?php include_once("../footer.php");
encriptar_sqli("graficas",1,"form_info",$ruta_db_superior);

?>
</BODY>
</HTML>
