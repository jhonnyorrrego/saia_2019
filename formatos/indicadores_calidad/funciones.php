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
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/graficos/librerias.php");
echo( librerias_jquery('1.7') );
echo( librerias_graficos() );

function formula_calculo($idformato,$iddoc){
  global $conn;
  $respuesta=busca_filtro_tabla("","respuesta,documento","destino=iddocumento and documento.estado<>'ELIMINADO' and origen=".$iddoc,"",$conn); 
  $idformato_formula_indicador=busca_filtro_tabla("b.idformato","documento a, formato b","lower(a.plantilla)=lower(b.nombre) AND a.iddocumento=".$respuesta[0]["destino"],"",$conn);
  $texto='<table style="width:100%;">';
  $texto.='<tr class="encabezado_list" >
            <td style="font-size:10pt;">Form</td>
            <td style="font-size:10pt;">Formula del calculo</td>
            <td style="font-size:10pt;">Unidad</td>
            <td style="font-size:10pt;">Naturaleza</td>
            <td style="font-size:10pt;">Periocidad</td>
            <td style="font-size:10pt;">Descripci&oacute;n de variables</td>
            <td style="font-size:10pt;">Observaciones</td>
            </tr>';
            
            //mostrar_valor_campo($campo,$idformato,$iddoc,$tipo=NULL)
  for($i=0;$i<$respuesta["numcampos"];$i++){
    $formula=busca_filtro_tabla("","ft_formula_indicador","documento_iddocumento=".$respuesta[$i]["destino"],"",$conn); 
    $texto.='<tr>
                <td style="font-size:10pt;">'.$formula[0]["idft_formula_indicador"].'</td>
                <td align="center">'.$formula[0]["nombre"].'</td>
                <td align="center">'.$formula[0]["unidad"].'</td>
                <td align="center" style="font-size:10pt;">'.mostrar_valor_campo('naturaleza',$idformato_formula_indicador[0]['idformato'],$respuesta[$i]["destino"],1).'</td>
                <td align="center" style="font-size:10pt;">'.mostrar_valor_campo('periocidad',$idformato_formula_indicador[0]['idformato'],$respuesta[$i]["destino"],1).'</td>
                <td style="font-size:10pt;">'.strip_tags(utf8_encode(html_entity_decode($formula[0]["observacion"]))).'</td>
                <td>'.mostrar_valor_campo('observaciones',$idformato_formula_indicador[0]['idformato'],$respuesta[$i]["destino"],1).'</td>
            </tr>';
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
  
if(@$_REQUEST['tipo']!=5){
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
}   

$formulas = busca_filtro_tabla("nombre,idft_formula_indicador as id,unidad,rango_colores,tipo_rango", "ft_formula_indicador,documento d", "documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_indicadores_calidad=(select idft_indicadores_calidad from ft_indicadores_calidad where documento_iddocumento=$iddoc)", "", $conn);

if ($formulas["numcampos"]) {
    echo '<table style="width:100%;">
		        <tr>
		            <td class="encabezado_list" colspan="7" style="font-size:10pt;">SEGUIMIENTOS</td>
		        </tr>		        
		        <tr>
		            <td class="encabezado_list" colspan="7" style="font-size:10pt;">Formula del Calculo:<br />' . $formulas[$i]["nombre"] . '</td>
		        </tr>
		        <tr class="encabezado_list">
		            <td  style="font-size:10pt;">Fecha</td>
		            <td  style="font-size:10pt;">Meta</td>
		            <td  style="font-size:10pt;">Resultado</td>
		            <td  style="font-size:10pt;">Cumplimiento</td>
		            <td  style="font-size:10pt;">An&aacute;lisis de Datos</td>
		            <td colspan="2" style="font-size:10pt;">&nbsp;</td>
	            </tr>';
	for ($i = 0; $i < $formulas["numcampos"]; $i++) {

	

		$seg = busca_filtro_tabla("f.*," . fecha_db_obtener("fecha_seguimiento", "Y-m-d") . " as fecha_seguimiento", "ft_seguimiento_indicador f,documento d", "documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=" . $formulas[$i]["id"], "f.fecha_seguimiento", $conn);

		$rango = explode(",", $formulas[$i]["rango_colores"]);
		
		$dato = array();
		$dato2 = array();
		$dato3 = array();
		$dato4 = array();
		$dato5 = array();
		$array_colores=array();
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
			echo '<tr>
                    <td align="center" style="font-size:10pt;">' . $seg[$j]["fecha_seguimiento"] . '</td>
                    <td align="right" style="font-size:10pt;" >' . $seg[$j]["meta_indicador_actual"] . $formulas[$i]["unidad"] . '</td>
                    <td bgcolor="'.$color.'" align="right"  style="font-size:10pt;">' . $respuesta . $formulas[$i]["unidad"] . '</td>
                    <td align="center" style="font-size:10pt;">' . $cumplimiento . '%</td>';
			
			
			if (!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"] == 1){
			    echo '  <td style="text-align:center;font-size:10pt;"><a class="previo_high" enlace="formatos/seguimiento_indicador/mostrar_seguimiento_indicador.php?iddoc=' . $seg[$j]["documento_iddocumento"] . '" style="color:blue;cursor:pointer">Ver</a></td>';
			    echo '
			        <td align="center" width="200px" style="font-size:10pt;" ><a target="centro" href="../plan_mejoramiento/adicionar_plan_mejoramiento.php?seguimiento_indicador=' . $seg[$j]["idft_seguimiento_indicador"] . '">Adicionar Plan</a></td>
                    <td align="center" style="font-size:10pt;"><a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height:400,preserveContent:false } )"  href="planes_relacionados.php?tipo=indicador&seguimiento_indicador=' . $seg[$j]["idft_seguimiento_indicador"] . '">Ver Planes</a></td>';
			}else{
			    echo '<td></td><td></td><td></td>';
			}	
			echo '</tr>';
			if (is_numeric($cumplimiento)) {
				array_push($dato, $cumplimiento);
				array_push($dato2, "Fecha:" . $seg[$j]["fecha_seguimiento"] . ", Valor: " . $cumplimiento . "%");
				array_push($dato3, $seg[$j]["fecha_seguimiento"] . "(" . $cumplimiento . "%)");
	            array_push($array_colores, $color);
				array_push($dato4, $respuesta);
				array_push($dato5, $seg[$j]["fecha_seguimiento"] . "(" . $respuesta . "%)");
			}	
		}
		echo '<tr>
		        <td colspan="7"  style="font-size:10pt;">
		            <b>Resultado:</b>
		            <br/>
		            <table>
        		      <tr>
        		        <td bgcolor="#FF4000"  style="font-size:10pt;">Deficiente</td>
        		        <td bgcolor="#EAFF00"  style="font-size:10pt;">Satisfactorio</td>
        		        <td bgcolor="#00FF51"  style="font-size:10pt;">Sobresaliente</td>
        		      </tr>
		            </table>
		            <br/>
		        </td>
		      </tr>';
		
		if (empty($dato) || empty($dato2)) {
			echo("No es posible generar un grafico, no se han generado seguimientos");
		} else {
			$tipo_grafico = busca_filtro_tabla("tipo_grafico", "ft_indicadores_calidad", "documento_iddocumento=$iddoc", "", $conn);
		
			    
			if(@$_REQUEST['tipo']!=5){
    			echo('
                    <tr>
                        <td colspan="7">
                        <center>
                         <div id="contenedor_grafico_pc" style="width: 700px;height:240px;"></div>
                         <br/>
                         <div id="contenedor_grafico_rs" style="width: 700px;height:240px;"></div>
                         </center>
                        </td> 
                    </tr>
    			');
    			
    			if ($dato[0] != 0) {
    			    
    				switch(trim($tipo_grafico[0]["tipo_grafico"])){
    					case 'torta':
                            // -----> TORTA
                        	$configuracion_grafico=array();
                        	$configuracion_grafico['imagen']=1;
                        	$configuracion_grafico['titulo_grafico']='PORCENTAJE DE CUMPLIMIENTO POR SEGUIMIENTO';
                        	$configuracion_grafico['subtitulo_grafico']='';
                        	$configuracion_grafico['contenedor']='contenedor_grafico_pc';
                        	$configuracion_grafico['nombres']=$dato2;
                        	$configuracion_grafico['valores']=$dato;
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_torta($configuracion_grafico);						
    
                            // -----> TORTA
                        	$configuracion_grafico=array();
                        	$configuracion_grafico['imagen']=1;
                        	$configuracion_grafico['titulo_grafico']='RESULTADO POR SEGUIMIENTO';
                        	$configuracion_grafico['subtitulo_grafico']='';
                        	$configuracion_grafico['contenedor']='contenedor_grafico_rs';
                        	$configuracion_grafico['nombres']=$dato5;
                        	$configuracion_grafico['valores']=$dato4;
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_torta($configuracion_grafico);	
    						break;
    					case 'barras':
                            // -----> BARRA
                            $configuracion_grafico=array();
                            $configuracion_grafico['contenedor']='contenedor_grafico_pc';
                            $configuracion_grafico['titulo_grafico']='PORCENTAJE DE CUMPLIMIENTO POR SEGUIMIENTO';
                            $configuracion_grafico['subtitulo_grafico']='';
                            $configuracion_grafico['titulox']='Seguimiento';
                            $configuracion_grafico['tituloy']='Cumplimiento';
                            $configuracion_grafico['imagen']=1;
                            $configuracion_grafico['color_saia']=1;
                            $configuracion_grafico['nombres']=$dato3;
                            $configuracion_grafico['valores']=array($dato);
                            $configuracion_grafico['valores_nombre']=array('Valores');    
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_barra($configuracion_grafico);
                            
                            
                            // -----> BARRA
                            $configuracion_grafico=array();
                            $configuracion_grafico['contenedor']='contenedor_grafico_rs';
                            $configuracion_grafico['titulo_grafico']='RESULTADO POR SEGUIMIENTO';
                            $configuracion_grafico['subtitulo_grafico']='';
                            $configuracion_grafico['titulox']='Seguimiento';
                            $configuracion_grafico['tituloy']='Resultado';
                            $configuracion_grafico['imagen']=1;
                            $configuracion_grafico['color_saia']=1;
                            $configuracion_grafico['nombres']=$dato5;
                            $configuracion_grafico['valores']=array($dato4);
                            $configuracion_grafico['valores_nombre']=array('Valores');    
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_barra($configuracion_grafico);                        
    						break;
    					case 'lineas' :
                            // -----> LINEA
                            $configuracion_grafico=array();
                            $configuracion_grafico['contenedor']='contenedor_grafico_pc';
                            $configuracion_grafico['titulo_grafico']='PORCENTAJE DE CUMPLIMIENTO POR SEGUIMIENTO';
                            $configuracion_grafico['subtitulo_grafico']='';    
                            $configuracion_grafico['titulox']='Seguimiento';
                            $configuracion_grafico['tituloy']='Cumplimiento';
                            $configuracion_grafico['imagen']=1;
                            $configuracion_grafico['nombres']=$dato3;
                            $configuracion_grafico['valores']=array($dato);
                            $configuracion_grafico['valores_nombre']=array('Valores');
                            $configuracion_grafico['color_saia']=1;
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_linea($configuracion_grafico);	
                            
                            // -----> LINEA
                            $configuracion_grafico=array();
                            $configuracion_grafico['contenedor']='contenedor_grafico_rs';
                            $configuracion_grafico['titulo_grafico']='RESULTADO POR SEGUIMIENTO';
                            $configuracion_grafico['subtitulo_grafico']='';    
                            $configuracion_grafico['titulox']='Seguimiento';
                            $configuracion_grafico['tituloy']='Resultado';
                            $configuracion_grafico['imagen']=1;
                            $configuracion_grafico['nombres']=$dato5;
                            $configuracion_grafico['valores']=array($dato4);
                            $configuracion_grafico['valores_nombre']=array('Valores');
                            $configuracion_grafico['color_saia']=1;
                            $configuracion_grafico['colores']=$array_colores;
                            generar_grafico_linea($configuracion_grafico);	                        
    
    						break;
    				}
    				
    				$datos_guardar=array();
                    $datos_guardar['iddoc']=$iddoc;
                    $datos_guardar['nombre_imagen']='total_evaluacion'; 
                    $datos_guardar['extension']='jpg';
                    $datos_guardar['contenedor_grafico']='contenedor_grafico_pc';
                    guardar_grafico_temporal($datos_guardar);
                    
    				$datos_guardar=array();
                    $datos_guardar['iddoc']=$iddoc;
                    $datos_guardar['nombre_imagen']='competencias'; 
                    $datos_guardar['extension']='jpg';
                    $datos_guardar['contenedor_grafico']='contenedor_grafico_rs';
                    guardar_grafico_temporal($datos_guardar);     
                    
    			} //fin if dato !=0
			
			}else{ //fin if tipo 5

    			$idfuncionario=busca_filtro_tabla("","vfuncionario_dc","idfuncionario=".$_REQUEST["idfunc"],"",$conn);
    			$ruta_grafico="temporal_".$idfuncionario[0]['login']."/".$iddoc."/";
    				
    			
    			if(file_exists($ruta_db_superior.$ruta_grafico)){
    				$datos=explode(",",listado_directorio($ruta_db_superior.$ruta_grafico));
    				echo('<tr><td colspan="7"><center>');
    				for($x=0;$x<count($datos);$x++){
    					echo '<img src="'.PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/'.$ruta_grafico.$datos[$x].'" width="550" /><br/>';
    					//echo(PROTOCOLO_CONEXION.RUTA_PDF_LOCAL.'/'.$ruta_grafico.$datos[$x].'<br>');
    				}
    				echo('</center></td></tr>');
    			}			
    			
			}

			
			
		} //fin if datos de indicador
	   
	} //fin for i
	 echo "</table>";
} //fin if resultados

}






function listado_directorio($directorio) {
	$html=array();
	if(chdir($directorio)){
		foreach (scandir($directorio,1) as $elemento){
			if(file_exists($elemento) && $elemento!="." && $elemento!=".."){
				$html[].=$elemento;
			}
		}
	}
	return (implode(",",$html));
}

?>