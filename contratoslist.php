<?php
include_once("header.php");
include_once("formatos/librerias/funciones_generales.php");
$documentos=busca_filtro_tabla("idft_proceso_contractual as id,documento_iddocumento as iddoc,numero","ft_proceso_contractual p,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO'","d.fecha desc",$conn);
$estruct1=busca_filtro_tabla("idft_estructura_contratos as id,etiqueta,obligatorio","ft_estructura_contratos,documento","documento_iddocumento=iddocumento and documento.estado<>'ELIMINADO' and cod_padre=2","lower(etiqueta)",$conn);
$estruct2=busca_filtro_tabla("idft_estructura_contratos as id,etiqueta,obligatorio","ft_estructura_contratos,documento","documento_iddocumento=iddocumento and documento.estado<>'ELIMINADO' and cod_padre=3","lower(etiqueta)",$conn);

echo '<br /><br /><table width="100%" border="1" style="border-collapse:collapse"><tr class="encabezado_list"><td rowspan="2">Detalles</td><td rowspan="2">Radicado</td><td rowspan="2">Interventor</td><td rowspan="2">Numero del contrato</td><td rowspan="2">Objeto del contrato</td><td rowspan="2">Contratista</td><td rowspan="2">Subgerencia encargada</td><td rowspan="2">Plazo ejecuci&oacute;n</td><td rowspan="2">Fecha inicio</td><td rowspan="2">Fecha finalizaci&oacute;n</td><td colspan="'.$estruct1["numcampos"].'">1. Precontractual</td><td colspan="'.$estruct2["numcampos"].'">2. Contractual</td></tr>';
echo '<tr class="encabezado_list">';
for($i=0;$i<$estruct1["numcampos"];$i++)
  echo '<td>'.$estruct1[$i]["etiqueta"].'</td>';
for($i=0;$i<$estruct2["numcampos"];$i++)
  echo '<td>'.$estruct2[$i]["etiqueta"].'</td>';  
echo '</tr>';

for($a=0;$a<$documentos["numcampos"];$a++)
  {echo '<tr><td><a href="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$documentos[$a]["iddoc"].'">Detalles</a></td><td align="center">'.$documentos[$a]["numero"].'</td><td>'.mostrar_valor_campo('interventor',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('numero_contrato',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('objeto_contrato',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('contratista',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('subgerencia_encargada',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('plazo_ejecucion',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('fecha_inicio',12,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('fecha_finalizacion',12,$documentos[$a]["iddoc"],1).'</td>';
   for($i=0;$i<$estruct1["numcampos"];$i++)
      {$encontrados=busca_filtro_tabla("case when count(*)>0 then 'X' else '-' end","ft_contrato c,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso_contractual='".$documentos[$a]["id"]."' and estructura='".$estruct1[$i]["id"]."'","",$conn);
       echo '<td align="center"';
       if($estruct1[$i]["obligatorio"]==1 && $encontrados[0][0]=='-')
         echo ' bgcolor="red" ';
       echo '>'.$encontrados[0][0].'</td>';
      }
   for($i=0;$i<$estruct2["numcampos"];$i++)
      {$encontrados=busca_filtro_tabla("case when count(*)>0 then 'X' else '-' end","ft_contrato c,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso_contractual='".$documentos[$a]["id"]."' and estructura='".$estruct2[$i]["id"]."'","",$conn);
       echo '<td align="center"';
       if($estruct2[$i]["obligatorio"]==1 && $encontrados[0][0]=='-')
         echo ' bgcolor="red" ';
       echo '>'.$encontrados[0][0].'</td>';
      }   
   echo '</tr>';
  }
echo '</table>';
echo '<br /><br /><b>NOMENCLATURA</b><table border="1">
<tr class="encabezado_list"><td>Simbolo</td><td>Significado</td></tr>
<tr><td align="center">-</td><td>Falta llenar los datos y la secci&oacute;n NO ES OBLIGATORIA</td></tr>
<tr><td align="center">X</td><td>Ya se llenaron los datos para la secci&oacute;n</td></tr>
<tr><td bgcolor="red" align="center">-</td><td>Falta llenar los datos y la secci&oacute;n ES OBLIGATORIA</td></tr>
</table>';
include_once("footer.php");
?>