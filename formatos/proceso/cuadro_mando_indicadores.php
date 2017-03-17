<?php
include_once("../../db.php");
include_once("../../header.php");

$indicadores=busca_filtro_tabla("i.*, p.idft_proceso","ft_indicadores_calidad i,ft_proceso p","ft_proceso=idft_proceso and p.documento_iddocumento=".$_REQUEST["proceso"],"lower(i.nombre) asc",$conn);

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
<td>Nombre del Indicador</td>
<td>Fuente de Datos</td>
<td>Planes Vinculados</td>
<td>Periocidad</td>
<td>Enero</td>
<td>Febrero</td>
<td>Marzo</td>
<td>Abril</td>
<td>Mayo</td>
<td>Junio</td>
<td>Julio</td>
<td>Agosto</td>
<td>Septiembre</td>
<td>Octubre</td>
<td>Noviembre</td>
<td>Diciembre</td>
<td>Gr&aacute;fico Cumplimiento</td>
<td>Gr&aacute;fico Resultado</td>
</tr>
<?php
for($i=0;$i<$indicadores["numcampos"];$i++)
  {$planes=busca_filtro_tabla("distinct d.*","seguimiento_planes a,documento d,ft_indicadores_calidad b,ft_formula_indicador, ft_seguimiento_indicador c,ft_plan_mejoramiento e","c.idft_seguimiento_indicador=a.idft_seguimiento_indicador and c.ft_formula_indicador=idft_formula_indicador and ft_indicadores_calidad=idft_indicadores_calidad and d.estado<>'ELIMINADO' and iddocumento=a.plan_mejoramiento and e.documento_iddocumento=a.plan_mejoramiento and e.estado<>'INACTIVO' and idft_indicadores_calidad=".$indicadores[$i]["idft_indicadores_calidad"],"",$conn);
  
  $formulas=busca_filtro_tabla("nombre,idft_formula_indicador as id,unidad,documento_iddocumento","ft_formula_indicador","ft_indicadores_calidad=".$indicadores[$i]["idft_indicadores_calidad"],"",$conn);
  
  echo "<tr>
<td><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../indicadores_calidad/mostrar_indicadores_calidad.php?iddoc=".$indicadores[$i]["documento_iddocumento"]."'>".$indicadores[$i]["nombre"]."</a></td>
<td>".html_entity_decode($indicadores[$i]["fuente_datos"])."</td>
<td>";
for($j=0;$j<$planes["numcampos"];$j++)
  {echo "<a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../plan_mejoramiento/mostrar_plan_mejoramiento.php?iddoc=".$planes[$j]["iddocumento"]."'>Plan ".$planes[$j]["numero"]."</a><br /><br />";
  }
echo "</td><td>";
include_once("../librerias/funciones_generales.php");
for($j=0;$j<$formulas["numcampos"];$j++)
  echo mostrar_valor_campo('periocidad',51,$formulas[$j]["documento_iddocumento"],1)." (".$formulas[$j]["nombre"].")<br /><br />";
echo "</td>
<td>".seguimientos_fecha("01",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("02",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("03",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("04",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("05",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("06",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("07",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("08",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("09",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("10",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("11",$indicadores[$i]["idft_indicadores_calidad"])."</td>
<td>".seguimientos_fecha("12",$indicadores[$i]["idft_indicadores_calidad"])."</td>
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
<?php
include_once("../../footer.php");

function seguimientos_fecha($mes,$indicador)
{global $conn;
 $seguimientos=busca_filtro_tabla(fecha_db_obtener("fecha_seguimiento","Y-m-d")." as fecha_seguimiento,c.observaciones,iddocumento,numero,f.nombre as formula","documento d,ft_indicadores_calidad b,ft_formula_indicador f, ft_seguimiento_indicador c","c.ft_formula_indicador=idft_formula_indicador and ft_indicadores_calidad=idft_indicadores_calidad and d.estado<>'ELIMINADO' and c.documento_iddocumento=iddocumento and ".fecha_db_obtener("fecha_seguimiento","Y-m")." like '".date("Y")."-"."$mes' and idft_indicadores_calidad=".$indicador,"",$conn);
 
 $cadena="";
 for($i=0;$i<$seguimientos["numcampos"];$i++)
  {$cadena.="<a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:500,preserveContent:false } )' href='../seguimiento_indicador/mostrar_seguimiento_indicador.php?iddoc=".$seguimientos[$i]["iddocumento"]."'>".$seguimientos[$i]["fecha_seguimiento"]." ".strip_tags(html_entity_decode($seguimientos[$i]["observaciones"]))."</a> (".$seguimientos[$i]["formula"].")<br /><br />";
  }
 return ($cadena); 
}

function graficas_cumplimiento($formulas,$indicador)
{global $conn;
 $cadena="";
 for($i=0;$i<$formulas["numcampos"];$i++)
   {if(is_file("../indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png"))
    $cadena.=$formulas[$i]["nombre"]."<br /><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:400,preserveContent:false } )' href='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png'><img src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"].".png' width='300px' /></a><br />";
   }
 return($cadena);  
}


function graficas_resultado($formulas,$indicador)
{global $conn;
 $cadena="";
 for($i=0;$i<$formulas["numcampos"];$i++)
   {if(is_file("../indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png"))
    $cadena.=$formulas[$i]["nombre"]."<br /><a class='highslide' onclick='return hs.htmlExpand(this, { objectType: \"iframe\",width: 650, height:400,preserveContent:false } )' href='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png'><img src='".PROTOCOLO_CONEXION.RUTA_PDF."/formatos/indicadores_calidad/imagenes/resultado_".$indicador."_".$formulas[$i]["id"]."_2.png' width='300px' /></a><br />";
   }
 return($cadena);  
}
?>
