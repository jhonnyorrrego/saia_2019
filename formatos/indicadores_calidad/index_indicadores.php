<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
echo(librerias_jquery("1.7"));

$procesos_rojo=array();
$procesos_amarillo=array();
$procesos_verde=array();

$colores=contadores($procesos_rojo, $procesos_amarillo, $procesos_verde);
$procesos_rojo=array_unique($procesos_rojo);
$procesos_amarillo=array_unique($procesos_amarillo);
$procesos_verde=array_unique($procesos_verde);

$componente_rojo=busca_filtro_tabla("","busqueda_componente A","A.nombre='numero_indicadores_rojo'","",$conn);
$componente_amarillo=busca_filtro_tabla("","busqueda_componente A","A.nombre='numero_indicadores_amarillo'","",$conn);
$componente_verde=busca_filtro_tabla("","busqueda_componente A","A.nombre='numero_indicadores_verde'","",$conn);
?>
<center><table style="width:70%;border-collapse:collapse" border="0">
	<tr>
		<td style="width:20%"><br /><br /></td>
		<td style="width:80%;text-align:right;text-decoration:underline">Total Indicadores <?php echo(($colores[0]+$colores[1]+$colores[2])); ?></td>
	</tr>
	<tr>
		<td rowspan="3" style="text-align:center"><img src="semaforo.jpg" style="width:90px;height:180px"></td>
		<td style=""><a class="link kenlace_saia" style="color:red;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_rojo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php if(count($procesos_rojo)){ echo(implode(",",$procesos_rojo)); }else{ echo('-1'); } ?>" titulo="ROJO"><?php echo($colores[0]); ?> INDICADORES EN ZONA ROJA</a></td>
	</tr>
	<tr>
		<td style=""><a class="link kenlace_saia" style="color:#D4AA00;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_amarillo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php if(count($procesos_amarillo)){ echo(implode(",",$procesos_amarillo)); }else{ echo('-1'); }?>" titulo="AMARILLO"><?php echo($colores[1]); ?> INDICADORES EN ZONA AMARILLA</a></td>
	</tr>
	<tr>
		<td style=""><a class="link kenlace_saia" style="color:green;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_verde[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php if(count($procesos_verde)){ echo(implode(",",$procesos_verde)); }else{ echo('-1'); }  ?>" titulo="VERDE"><?php echo($colores[2]); ?> INDICADORES EN ZONA VERDE</a></td>
	</tr>
</table></center>
<?php
echo(librerias_acciones_kaiten());

function contadores(&$procesos_rojo, &$procesos_amarillo, &$procesos_verde){
	global $conn;
	
	
	$formulas=busca_filtro_tabla("b.nombre, b.idft_formula_indicador AS id, b.unidad,b.rango_colores, b.tipo_rango,a.ft_proceso","ft_indicadores_calidad a,  ft_formula_indicador b,documento d,ft_proceso e, documento f","b.ft_indicadores_calidad=a.idft_indicadores_calidad AND b.documento_iddocumento =d.iddocumento AND d.estado<>'ELIMINADO' AND e.idft_proceso=a.ft_proceso AND e.documento_iddocumento=f.iddocumento AND lower(f.estado)='aprobado'  ","",$conn);

	$rojo=0;
	$amarillo=0;
	$verde=0;
	if($formulas["numcampos"]){
		
		for($i=0;$i<$formulas["numcampos"];$i++){
			$seg=busca_filtro_tabla("f.*,".fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento","ft_seguimiento_indicador f,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_formula_indicador=".$formulas[$i]["id"],"f.fecha_seguimiento desc",$conn);
			if(!$seg["numcampos"])continue;
			$rango=explode(",",$formulas[$i]["rango_colores"]);
			
			$dato=array();
    	$dato2=array();
    	$dato3=array();
    	$dato4=array();
    	$dato5=array();

     	for($j=0;$j<1;$j++){
      	$vector=explode(";",$seg[$j]["resultado"]);
        $formula2=$formulas[$i]["nombre"];
        $formula2=preg_replace_callback(
            "([A-Za-z_]+[0-9]*)",
            create_function(
            '$matches',
            'return ("{".$matches[0]."}");'
        ),
            $formula2);
        foreach($vector as $fila){
        	$aux=explode(":",$fila);
          $formula2=str_replace("{".$aux[0]."}",$aux[1],$formula2);
        }
        eval("\$respuesta=$formula2;");
     
   			if($formulas[0]["tipo_rango"]==1){
        	$cumplimiento=number_format(($respuesta/$seg[$j]["meta_indicador_actual"])*100,0,".","");
				}
				else if($formulas[0]["tipo_rango"]==0){
					if($respuesta<=$seg[$j]["meta_indicador_actual"]){
						$cumplimiento=(1+(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"]))*100;
					}
					else{
						$cumplimiento=(($seg[$j]["meta_indicador_actual"]-$respuesta)/$seg[$j]["meta_indicador_actual"])*100;
					}
				}
        if($respuesta<$rango[0]){
        	if($formulas[$i]["tipo_rango"]=="1"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
					}
          else{
            $color="#00FF51";  //VERDE
            $verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
					}  
        }
        elseif($respuesta>=$rango[0] && $respuesta<=$rango[1]){
        	$color="#EAFF00";//AMARILLO
        	$amarillo++;
					$procesos_amarillo[]=$formulas[$i]["ft_proceso"];
				}
        else{
        	if($formulas[$i]["tipo_rango"]=="0"){
          	$color="#FF4000";   //ROJO
          	$rojo++;
						$procesos_rojo[]=$formulas[$i]["ft_proceso"];
					}
          else{
          	$color="#00FF51";  //VERDE
          	$verde++;
						$procesos_verde[]=$formulas[$i]["ft_proceso"];
				} 
        }
      }
		}
	}
	return(array($rojo,$amarillo,$verde));
}
?>