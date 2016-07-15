<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");


function formula_calculo($idformato,$iddoc){
  global $conn;
  $respuesta=busca_filtro_tabla("","respuesta,documento","destino=iddocumento and documento.estado<>'ELIMINADO' and origen=".$iddoc,"",$conn); 
  $texto='<table  class="phpmaker" width="100%">';
  $texto.='<tr class="encabezado_list" ><td style="font-size:10pt;">Form</td><td style="font-size:10pt;">Formula del calculo</td><td style="font-size:10pt;">Unidad</td><td style="font-size:10pt;">Naturaleza</td><td style="font-size:10pt;">Periocidad</td><td style="font-size:10pt;">Descripci&oacute;n de variables</td><td style="font-size:10pt;">Observaciones</td></tr>';
  for($i=0;$i<$respuesta["numcampos"];$i++){
    $formula=busca_filtro_tabla("","ft_formula_indicador","documento_iddocumento=".$respuesta[$i]["destino"],"",$conn); 
    $texto.='<tr><td style="font-size:10pt;">'.$formula[0]["idft_formula_indicador"].'</td><td align="center">'.$formula[0]["nombre"].'</td><td align="center">'.$formula[0]["unidad"].'</td><td align="center" style="font-size:10pt;">'.mostrar_valor_campo('naturaleza',51,$respuesta[$i]["destino"],1).'</td><td align="center" style="font-size:10pt;">'.mostrar_valor_campo('periocidad',51,$respuesta[$i]["destino"],1).'</td><td style="font-size:10pt;">'.strip_tags(utf8_encode(html_entity_decode($formula[0]["observacion"]))).'</td><td>'.mostrar_valor_campo('observaciones',51,$respuesta[$i]["destino"],1).'</td></tr>';
  } 
  $texto.='</table>';
  echo($texto);   
}

function mostrar_fuente_datos($idformato,$iddoc){
    $datos=busca_filtro_tabla("fuente_datos","ft_indicadores_calidad","documento_iddocumento=".$iddoc,"",$conn);
    echo( strip_tags(utf8_encode(html_entity_decode($datos[0]["fuente_datos"]))) );
}
function mostrar_objetivo_calidad_indicador($idformato,$iddoc){
    $datos=busca_filtro_tabla("objetivo_calidad_indicador","ft_indicadores_calidad","documento_iddocumento=".$iddoc,"",$conn);
    echo( strip_tags(utf8_encode(html_entity_decode($datos[0]["objetivo_calidad_indicador"]))) );    
}
function mostrar_objetivo_indicador($idformato,$iddoc){
    $datos=busca_filtro_tabla("objetivo_indicador","ft_indicadores_calidad","documento_iddocumento=".$iddoc,"",$conn);
    echo( strip_tags(utf8_encode(html_entity_decode($datos[0]["objetivo_indicador"]))) );    
}
function documento_referencia2($idformato,$iddoc,$tipo=NULL){
  global $conn;
  $respuesta=busca_filtro_tabla("","respuesta","destino=".$iddoc,"",$conn);
  if($respuesta["numcampos"]){
    $formato=busca_filtro_tabla("B.iddocumento,B.descripcion, B.numero","documento B","B.iddocumento=".$respuesta[0]["origen"],"",$conn);
  }else {
    $formato["numcampos"]=0;
  }
  return($formato);
}

/*Busca el padre del documento actual y muestra el campo nombre */
function nombre_padre($idformato,$iddoc,$tipo=NULL){
  global $conn;
  $dato=documento_referencia2($idformato,$iddoc);
  if($dato["numcampos"]){
    echo($dato[0]["descripcion"]);
  }
}

function resultados_indicador($idformato,$iddoc){
  global $conn, $ruta_db_superior;
	
	include_once("pchart/pChart/pData.class");
	include_once("pchart/pChart/pChart.class");
?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';

	$(document).ready(function() {
		$(".previo_high").click(function(e) {
			var enlace = $(this).attr("enlace");
			top.hs.htmlExpand(this, {
				objectType : 'iframe',
				width : 1000,
				height : 600,
				contentId : 'cuerpo_paso',
				preserveContent : false,
				src : enlace,
				outlineType : 'rounded-white',
				wrapperClassName : 'highslide-wrapper drag-header'
			});

		});
	}); 
</script>
<?php
echo "<br /><span class='phpmaker'><b>SEGUIMIENTOS</b></span><br />";
$formulas = busca_filtro_tabla("nombre,idft_formula_indicador as id,unidad,rango_colores,tipo_rango", "ft_formula_indicador,documento d", "documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_indicadores_calidad=(select idft_indicadores_calidad from ft_indicadores_calidad where documento_iddocumento=$iddoc)", "", $conn);
if ($formulas["numcampos"]) {
	for ($i = 0; $i < $formulas["numcampos"]; $i++) {
		echo "<table width='100%' cellpadding=5 class='phpmaker'><tr class='encabezado_list'><td colspan='7' style='font-size:10pt;'>Formula del Calculo:<br />" . $formulas[$i]["nombre"] . "</td></tr><tr class='encabezado_list'><td  style='font-size:10pt;'>Fecha</td><td  style='font-size:10pt;'>Meta</td><td  style='font-size:10pt;'>Resultado</td><td  style='font-size:10pt;'>Cumplimiento</td><td  style='font-size:10pt;'>An&aacute;lisis de Datos</td><td colspan=2  style='font-size:10pt;'></td></tr>";
		$DataSet = new pData;

		$seg = busca_filtro_tabla("f.*," . fecha_db_obtener("fecha_seguimiento", "Y-m-d") . " as fecha_seguimiento", "ft_seguimiento_indicador f,documento d", "documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=" . $formulas[$i]["id"], "f.fecha_seguimiento", $conn);

		$rango = explode(",", $formulas[$i]["rango_colores"]);
		
		$dato = array();
		$dato2 = array();
		$dato3 = array();
		$dato4 = array();
		$dato5 = array();
		$array_colores=array();
		$DataSet = new pData;
		$DataSet1 = new pData;
		for ($j = 0; $j < $seg["numcampos"]; $j++) {
			$vector = explode(";", $seg[$j]["resultado"]);
			$formula2 = $formulas[$i]["nombre"];
			$formula2 = preg_replace_callback("([A-Za-z_]+[0-9]*)", create_function('$matches', 'return ("{".$matches[0]."}");'), $formula2);
			foreach ($vector as $fila) {$aux = explode(":", $fila);
				$formula2 = str_replace("{" . $aux[0] . "}", $aux[1], $formula2);
			}
			eval("\$respuesta=$formula2;");

			if ($formulas[0]["tipo_rango"] == 1) {
				$cumplimiento = number_format(($respuesta / $seg[$j]["meta_indicador_actual"]) * 100, 0, ".", "");
			} else if ($formulas[0]["tipo_rango"] == 0) {
				if ($respuesta <= $seg[$j]["meta_indicador_actual"]) {
					$cumplimiento = (1 + (($seg[$j]["meta_indicador_actual"] - $respuesta) / $seg[$j]["meta_indicador_actual"])) * 100;
				} else {
					$cumplimiento = (($seg[$j]["meta_indicador_actual"] - $respuesta) / $seg[$j]["meta_indicador_actual"]) * 100;
				}
			}
			if ($respuesta < $rango[0]) {
				if ($formulas[$i]["tipo_rango"] == "1")
					$color = "#FF4000";
				//ROJO
				else
					$color = "#00FF51";
				//VERDE
			} elseif ($respuesta >= $rango[0] && $respuesta <= $rango[1])
				$color = "#EAFF00";
			//AMARILLO
			else {
				if ($formulas[$i]["tipo_rango"] == "0")
					$color = "#FF4000";
				//ROJO
				else
					$color = "#00FF51";
				//VERDE
			}
			echo "<tr>
              <!--td align='center' class='phpmaker'>" . $seg[$j]["idft_seguimiento_indicador"] . "</td>
              <td align='center' class='phpmaker'>" . $formulas[$i]["id"] . "</td-->
              <td align='center' class='phpmaker'>" . $seg[$j]["fecha_seguimiento"] . "</td>
              <td align='right' class='phpmaker'>" . $seg[$j]["meta_indicador_actual"] . $formulas[$i]["unidad"] . "</td>
              <td bgcolor='$color' align='right' class='phpmaker'>" . $respuesta . $formulas[$i]["unidad"] . "</td>
              <td align='center' class='phpmaker'>" . $cumplimiento . "%</td>";
			
			echo "<td class='phpmaker' style='text-align:center'><a class='previo_high' enlace='formatos/seguimiento_indicador/mostrar_seguimiento_indicador.php?iddoc=" . $seg[$j]["documento_iddocumento"] . "' style='color:blue;cursor:pointer'>Ver</a></td>";
			if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1)
				echo "<td align='center' width='200px'  class='phpmaker'><a target='centro' href='../plan_mejoramiento/adicionar_plan_mejoramiento.php?seguimiento_indicador=" . $seg[$j]["idft_seguimiento_indicador"] . "'>Adicionar Plan</a></td>
              <td align='center'  class='phpmaker'><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 500, height:400,preserveContent:false } )'  href='planes_relacionados.php?tipo=indicador&seguimiento_indicador=" . $seg[$j]["idft_seguimiento_indicador"] . "'>Ver Planes</a></td>";
			else
				echo "<td></td><td></td>";
			echo "</tr>";
			if (is_numeric($cumplimiento)) {
				array_push($dato, $cumplimiento);
				array_push($dato2, "Fecha:" . $seg[$j]["fecha_seguimiento"] . ", Valor: " . $cumplimiento . "%");
				array_push($dato3, $seg[$j]["fecha_seguimiento"] . "(" . $cumplimiento . "%)");
	            array_push($array_colores, $color);
				array_push($dato4, $respuesta);
				array_push($dato5, $seg[$j]["fecha_seguimiento"] . "(" . $respuesta . "%)");
			}	
		}
		echo "<tr><td colspan=7  style='font-size:10pt;'><b>Resultado:</b><table class='phpmaker'><tr><td bgcolor='FF4000'  style='font-size:10pt;'>Deficiente</td><td bgcolor='EAFF00'  style='font-size:10pt;'>Satisfactorio</td><td bgcolor='00FF51'  style='font-size:10pt;'>Sobresaliente</td></tr></table><br /></td></tr>";
		
		if (empty($dato) || empty($dato2)) {
			echo("No es posible generar un grafico, no se han generado seguimientos");
		} else {
			$tipo_grafico = busca_filtro_tabla("tipo_grafico", "ft_indicadores_calidad", "documento_iddocumento=$iddoc", "", $conn);
			if ($dato[0] != 0) {
				switch(trim($tipo_grafico[0]["tipo_grafico"])){
					case 'torta':
						//grafico cumplimiento
						$DataSet -> AddPoint($dato, "Serie1");
						$DataSet -> AddPoint($dato2, "Serie2");
						$DataSet -> AddAllSeries();
						$DataSet -> SetAbsciseLabelSerie("Serie2");
						$Test = new pChart(600, 230);
						$Test -> drawFilledRoundedRectangle(7, 7, 600, 223, 5, 240, 240, 240);
						$Test -> drawRoundedRectangle(5, 5, 600, 225, 5, 230, 230, 230);
						$Test -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test -> drawPieGraph($DataSet -> GetData(), $DataSet -> GetDataDescription(), 150, 90, 110, PIE_PERCENTAGE, TRUE, 50, 20, 5);
						$Test -> drawPieLegend(310, 30, $DataSet -> GetData(), $DataSet -> GetDataDescription(), 250, 250, 250);
						//grafico valores

						$DataSet1 -> AddPoint($dato4, "Serie1");
						$DataSet1 -> AddPoint($dato5, "Serie2");
						$DataSet1 -> AddAllSeries();
						$DataSet1 -> SetAbsciseLabelSerie("Serie2");
						$Test1 = new pChart(600, 230);
						$Test1 -> drawFilledRoundedRectangle(7, 7, 600, 223, 5, 240, 240, 240);
						$Test1 -> drawRoundedRectangle(5, 5, 600, 225, 5, 230, 230, 230);
						$Test1 -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test1 -> drawPieGraph($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), 150, 90, 110, PIE_PERCENTAGE, TRUE, 50, 20, 5);
						$Test1 -> drawPieLegend(310, 30, $DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), 250, 250, 250);
						break;
					case 'barras':
						$DataSet -> AddPoint($dato, "serie1");
						$DataSet -> AddPoint($dato3, "Serie2");
						$DataSet -> SetAbsciseLabelSerie("Serie2");
						$DataSet -> SetYAxisName("Cumplimiento");
						$DataSet -> SetXAxisName("Seguimiento");
						$DataSet -> AddAllSeries();
						$Test = new pChart(600, 330);
						$Test -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test -> setGraphArea(70, 30, 550, 180);
						$Test -> drawFilledRoundedRectangle(7, 7, 600, 323, 5, 240, 240, 240);
						$Test -> drawRoundedRectangle(5, 5, 600, 325, 5, 230, 230, 230);
						$Test -> drawGraphArea(255, 255, 255);
						$Test -> drawScale($DataSet -> GetData(), $DataSet -> GetDataDescription(), SCALE_START0, 150, 150, 150, TRUE, 90, 2, TRUE);
						$Test -> drawGrid(4, TRUE, 230, 230, 230, 50);
						$Test -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test -> writeValues($DataSet -> GetData(), $DataSet -> GetDataDescription(), "serie1");
						$Test -> drawTreshold(0, 143, 55, 72, TRUE, TRUE);
						$Test -> drawBarGraph($DataSet -> GetData(), $DataSet -> GetDataDescription(), TRUE);
						$Test -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);

						$DataSet1 -> AddPoint($dato4, "serie1");
						$DataSet1 -> AddPoint($dato5, "Serie2");
						$DataSet1 -> SetAbsciseLabelSerie("Serie2");
						$DataSet1 -> SetYAxisName("Resultado");
						$DataSet1 -> SetXAxisName("Seguimiento");
						$DataSet1 -> AddAllSeries();
						$Test1 = new pChart(600, 330);
						$Test1 -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test1 -> setGraphArea(70, 30, 550, 180);
						$Test1 -> drawFilledRoundedRectangle(7, 7, 600, 323, 5, 240, 240, 240);
						$Test1 -> drawRoundedRectangle(5, 5, 600, 325, 5, 230, 230, 230);
						$Test1 -> drawGraphArea(255, 255, 255);
						$Test1 -> drawScale($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), SCALE_START0, 150, 150, 150, TRUE, 90, 2, TRUE);
						$Test1 -> drawGrid(4, TRUE, 230, 230, 230, 50);
						$Test1 -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test1 -> writeValues($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), "serie1");
						$Test1 -> drawTreshold(0, 143, 55, 72, TRUE, TRUE);
						$Test1 -> drawBarGraph($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), TRUE);
						$Test1 -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						
						break;
					case 'lineas' :
						$DataSet -> AddPoint($dato, "Serie1");
						$DataSet -> AddPoint($dato3, "Serie2");
						$DataSet -> AddAllSeries();
						$DataSet -> SetAbsciseLabelSerie("Serie2");
						$DataSet -> SetYAxisName("Cumplimiento");
						$DataSet -> SetXAxisName("Seguimiento");
						$Test = new pChart(600, 230);
						$Test -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test -> setGraphArea(70, 30, 500, 180);
						$Test -> drawFilledRoundedRectangle(5, 5, 600, 223, 5, 240, 240, 240);
						$Test -> drawRoundedRectangle(7, 7, 600, 225, 5, 230, 230, 230);
						$Test -> drawGraphArea(255, 255, 255, TRUE);
						$Test -> drawScale($DataSet -> GetData(), $DataSet -> GetDataDescription(), SCALE_START0, 150, 150, 150, TRUE, 0, 2);
						$Test -> drawGrid(4, TRUE, 230, 230, 230, 50);
						$Test -> drawTreshold(0, 143, 55, 72, TRUE, TRUE);
						$Test -> drawLineGraph($DataSet -> GetData(), $DataSet -> GetDataDescription());
						$Test -> drawPlotGraph($DataSet -> GetData(), $DataSet -> GetDataDescription(), 3, 2, 255, 255, 255);

						$DataSet1 -> AddPoint($dato4, "Serie1");
						$DataSet1 -> AddPoint($dato3, "Serie2");
						$DataSet1 -> AddAllSeries();
						$DataSet1 -> SetAbsciseLabelSerie("Serie2");
						$DataSet1 -> SetYAxisName("Resultado");
						$DataSet1 -> SetXAxisName("Seguimiento");
						$Test1 = new pChart(600, 230);
						$Test1 -> setFontProperties("pchart/Fonts/tahoma.ttf", 8);
						$Test1 -> setGraphArea(70, 30, 500, 180);
						$Test1 -> drawFilledRoundedRectangle(5, 5, 600, 223, 5, 240, 240, 240);
						$Test1 -> drawRoundedRectangle(7, 7, 600, 225, 5, 230, 230, 230);
						$Test1 -> drawGraphArea(255, 255, 255, TRUE);
						$Test1 -> drawScale($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), SCALE_START0, 150, 150, 150, TRUE, 0, 2);
						$Test1 -> drawGrid(4, TRUE, 230, 230, 230, 50);
						$Test1 -> drawTreshold(0, 143, 55, 72, TRUE, TRUE);
						$Test1 -> drawLineGraph($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription());
						$Test1 -> drawPlotGraph($DataSet1 -> GetData(), $DataSet1 -> GetDataDescription(), 3, 2, 255, 255, 255);
						break;
				}
			}
			$Test -> drawTitle(20, 20, "PORCENTAJE DE CUMPLIMIENTO POR SEGUIMIENTO", 50, 50, 50, 585);
			if (is_file("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . ".png"))
				unlink("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . ".png");
			$Test -> Render("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . ".png");
			echo('<tr><td colspan="5"  style="font-size:10pt;"><br /><br /><img src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/formatos/indicadores_calidad/imagenes/resultado_' . $iddoc . "_" . $formulas[$i]["id"] . '.png?rnd=' . rand(0, 100) . '"><br /><b>Nota:</b>Los valores mostrados en el grafico son los valores de cumplimiento del indicador</td></tr>');
			$Test1 -> drawTitle(20, 20, "RESULTADO POR SEGUIMIENTO", 50, 50, 50, 585);
			if (is_file("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . "_2.png"))
				unlink("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . "_2.png");
			$Test1 -> Render("imagenes/resultado_" . $iddoc . "_" . $formulas[$i]["id"] . "_2.png");
			echo('<tr><td colspan="5" style="font-size:10pt;"><br /><br /><img src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/formatos/indicadores_calidad/imagenes/resultado_' . $iddoc . "_" . $formulas[$i]["id"] . '_2.png?rnd=' . rand(0, 100) . '"><br /><b>Nota:</b>Los valores mostrados en el grafico son los valores de Resultado del indicador</td></tr>');
			
			
			if($_SESSION['LOGIN'.LLAVE_SAIA]=='cerok'){
			    
			
			?>
			    
                <tr><td colspan="5">
                    <script src="echarts.min.js"></script>
                    <div id="porcentaje_cumplimiento_contenedor_grafico" style="width: 700px;height:240px;"></div>
                </td> </tr>
			<?php
			
			
			
			if ($dato[0] != 0) {
				switch(trim($tipo_grafico[0]["tipo_grafico"])){
					case 'torta':

						break;
					case 'barras':
                	    //$dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
                	    $titulo_grafico='PORCENTAJE DE CUMPLIMIENTO POR SEGUIMIENTO';
                	    $idcontenedor='porcentaje_cumplimiento_contenedor_grafico';
                	    $tipo_grafico='barras';
                	    $color=$color;
                	    $titulox='Seguimiento';
                	    $tituloy='Cumplimiento';
        			    $valores=$dato;
        			    $nombres['nombres']=$dato3;       
                        $nombres['colores']=$array_colores;
                	    generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
                	    
                	    
                	    
						break;
					case 'lineas' :

						break;
				}
			}			
			} //fin if session cerok
			
			
		} //fin if datos de indicador
	}
}
echo "</table>";
}


function generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
    global $conn;
        $valores=json_encode($valores);
        $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);
        
       $data_nombres=array();
       for($i=0;$i<count($nombres['nombres']);$i++){
            $data_nombres[$i]['value']=$nombres['nombres'][$i];
            $data_nombres[$i]['textStyle']['color']=$nombres['colores'][$i];
            $data_nombres[$i]['textStyle']['fontWeight']='bold';           
       }        
        $data_nombres=json_encode($data_nombres);
       // echo($titulos);die();
    ?>
        <script type="text/javascript">
 		    var myChart = echarts.init(document.getElementById('<?php echo($idcontenedor); ?>'));

            var option = {
                
                title: {text: '<?php echo($titulo_grafico); ?>', x:'center'},
                color: ['<?php echo($color_saia[0]['valor']); ?>'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                   // left: '3%',
                   // right: '4%',
                    //bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:21,                        
                        name:'<?php echo($titulox); ?>',
                        type : 'category',
                        data: <?php echo($data_nombres); ?>,
                       
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:30,
                        name:'<?php echo($tituloy); ?>', //
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Valor',
                        type:'bar',
                        barWidth: '50%',
                        data:<?php echo($valores); ?>
                        
                    }
                ]
            };
            
            myChart.setOption(option);

        </script>
    <?php
}
?>