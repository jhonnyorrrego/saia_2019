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
include_once($ruta_db_superior."assets/librerias.php");
echo(jquery());
include_once("../../header.php");


$indicadores=busca_filtro_tabla("i.*, p.idft_proceso","ft_indicadores_calidad i,ft_proceso p","ft_proceso=idft_proceso and p.documento_iddocumento=".$_REQUEST["proceso"],"lower(i.nombre) asc");

?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<br><br><b>SEGUIMIENTOS <?php echo date("Y"); ?></b>&nbsp;&nbsp;&nbsp;
<a href='JavaScript:window.history.go(0);'>Actualizar</a>&nbsp;&nbsp;&nbsp;<?php 
  $perm=new PERMISO();
  $ok=FALSE;     
  $ok=$perm->permiso_usuario('indicadores_calidad',1);
  if($ok){
    echo('<a href="../../responder.php?idformato=50&iddoc='.$indicadores[0]["idft_proceso"].'" target="centro">Adicionar Indicador</a>');
  }
?>
<br><br>
<table width="100%" style="border-collapse:collapse" border="1">
<tr class="encabezado_list">
<td style="width:15%">Nombre del Indicador</td>
<td style="width:15%">Fuente de Datos</td>
<td style="width:15%">Periocidad</td>
<td style="width:15%"><img id="anterior" class="cambiar_mes" style="cursor:pointer;" src="../../assets/images/anterior.png" border="0px"> <div id="mes">Enero</div> <img id="siguiente" class="cambiar_mes" style="cursor:pointer;" src="../../assets/images/siguiente.png" border="0px"></td>
<td style="width:20%">Gr&aacute;fico Cumplimiento</td>
<td style="width:20%">Gr&aacute;fico Resultado</td>
</tr>
<?php
for($i=0;$i<$indicadores["numcampos"];$i++)
  {$planes=busca_filtro_tabla("distinct d.*","seguimiento_planes a,documento d,ft_indicadores_calidad b,ft_formula_indicador, ft_seguimiento_indicador c,ft_plan_mejoramiento e","c.idft_seguimiento_indicador=a.idft_seguimiento_indicador and c.ft_formula_indicador=idft_formula_indicador and ft_indicadores_calidad=idft_indicadores_calidad and d.estado<>'ELIMINADO' and iddocumento=a.plan_mejoramiento and e.documento_iddocumento=a.plan_mejoramiento and e.estado<>'INACTIVO' and idft_indicadores_calidad=".$indicadores[$i]["idft_indicadores_calidad"],"");
  
  $formulas=busca_filtro_tabla("nombre,idft_formula_indicador as id,unidad,documento_iddocumento","ft_formula_indicador","ft_indicadores_calidad=".$indicadores[$i]["idft_indicadores_calidad"],"");
  
  echo "<tr>
<td><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../indicadores_calidad/mostrar_indicadores_calidad.php?iddoc=".$indicadores[$i]["documento_iddocumento"]."'>".$indicadores[$i]["nombre"]."</a></td>
<td>".($indicadores[$i]["fuente_datos"])."</td>";

echo "<td>";
include_once("../librerias/funciones_generales.php");
for($j=0;$j<$formulas["numcampos"];$j++)
  echo mostrar_valor_campo('periocidad',51,$formulas[$j]["documento_iddocumento"],1)." (".$formulas[$j]["nombre"].")<br /><br />";
echo "</td>
<td><div id='".$indicadores[$i]["idft_indicadores_calidad"]."'>".seguimientos_fecha("01",$indicadores[$i]["idft_indicadores_calidad"])."</div></td>
<td>";
$graficas=graficas_cumplimiento($formulas,$indicadores[$i]["documento_iddocumento"]);
if($graficas<>"")
  echo $graficas;
else
  echo "No tiene seguimientos o no se ha generado el grafico. <a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../indicadores_calidad/mostrar_indicadores_calidad.php?iddoc=".$indicadores[$i]["documento_iddocumento"]."'>Ver</a>";   
echo"</td>
<td>";
$graficas=graficas_resultado($formulas,$indicadores[$i]["documento_iddocumento"]);
if($graficas<>"")
  echo $graficas;
else
  echo "No tiene seguimientos o no se ha generado el grafico. <a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../indicadores_calidad/mostrar_indicadores_calidad.php?iddoc=".$indicadores[$i]["documento_iddocumento"]."'>Ver</a>";  
echo "</td>
</tr>";
  }
?>
</table>
<script>
	
	$(document).ready(function(){
		var mes=1;
		$(".cambiar_mes").click(function(){
			
			if($(this).attr("id")=="siguiente"){
				if(mes==12){
					mes=1;
				}else{
					mes++;
				}
				
			}
			if($(this).attr("id")=="anterior"){
				if(mes==1){
					mes=12;
				}else{
					mes--;
				}
			}

				$.ajax({
					async:false,
					type:'POST',
					url: "cambiar_mes_indicador.php",
					dataType: "json",
					data: {
						tipo:$(this).attr("id"),
						mes:mes,
						proceso:"<?php echo($_REQUEST["proceso"]);?>",
					},
					success:function (data){					
							$("#mes").html(data.mes);
							
							console.log(data);
							$.each(data, function(i, item) {
							    $("#"+i).html(item);
							});
							

					}
				});
	
			

			
			
			
			
		});
		
	});
	
	
</script>
<?php
include_once("../../footer.php");

function seguimientos_fecha($mes,$indicador)
{
 $seguimientos=busca_filtro_tabla(fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento,c.observaciones,iddocumento,numero,f.nombre as formula","documento d,ft_indicadores_calidad b,ft_formula_indicador f, ft_seguimiento_indicador c","c.ft_formula_indicador=idft_formula_indicador and ft_indicadores_calidad=idft_indicadores_calidad and d.estado<>'ELIMINADO' and c.documento_iddocumento=iddocumento and ".fecha_db_obtener("fecha_seguimiento","Y-m")." like '".date("Y")."-"."$mes' and idft_indicadores_calidad=".$indicador,"");
 
 $cadena="";
 for($i=0;$i<$seguimientos["numcampos"];$i++)
  {$cadena.="<a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../seguimiento_indicador/mostrar_seguimiento_indicador.php?iddoc=".$seguimientos[$i]["iddocumento"]."'>".$seguimientos[$i]["fecha_seguimiento"]." ".strip_tags(html_entity_decode($seguimientos[$i]["observaciones"]))."</a> (".$seguimientos[$i]["formula"].")<br /><br />";
  }
 return ($cadena); 
}

function graficas_cumplimiento($formulas,$indicador)
{
 $cadena="";
 for($i=0;$i<$formulas["numcampos"];$i++)
   {if(is_file("../indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png"))
    $cadena.=$formulas[$i]["nombre"]."<br /><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:400,preserveContent:false } )' href='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png'><img src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png' width='300px' /></a><br />";
   }
 return($cadena);  
}


function graficas_resultado($formulas,$indicador)
{
 $cadena="";
 for($i=0;$i<$formulas["numcampos"];$i++)
   {if(is_file("../indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png"))
    $cadena.=$formulas[$i]["nombre"]."<br /><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:400,preserveContent:false } )' href='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png'><img src='http://".RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png' width='300px' /></a><br />";
   }
 return($cadena);  
}
?>
