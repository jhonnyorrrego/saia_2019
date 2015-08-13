<?php
if (@$_REQUEST["export"] == "excel") 
  {         
  	header('Content-Type: application/vnd.ms-excel');
  	header("Content-Disposition: attachment; filename=contratos.xls");
  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");     
  }
else  
  include_once("header.php");
include_once("formatos/librerias/funciones_generales.php");

$documentos=busca_filtro_tabla("idft_proceso_demanda as id,documento_iddocumento as iddoc,numero","ft_proceso_demanda p,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO'","d.fecha desc",$conn);

if (!isset($_REQUEST["export"]))
echo '<br /><div align=right><a style="cursor:pointer;" href="?export=excel"><img src="enlaces/excel.gif" border="0" ALT="Exportar a Excel"></a></div>';
echo '<br /><table width="100%" border="1" style="border-collapse:collapse"><tr class="encabezado_list">';
if (!isset($_REQUEST["export"]))
  echo '<td >Detalles</td>';
echo '<td >Radicado</td><td >Tipo</td><td >Juzgado</td><td >Demandado / Judicializado</td><td >Demandante</td><td >Observaciones</td><td >Anexos</td></tr>';

for($a=0;$a<$documentos["numcampos"];$a++)
  {echo '<tr>';
   if (!isset($_REQUEST["export"]))
    echo '<td><a href="ordenar.php?accion=mostrar&mostrar_formato=1&key='.$documentos[$a]["iddoc"].'">Detalles</a></td>';
   echo '<td align="center">'.$documentos[$a]["numero"].'</td><td>'.mostrar_valor_campo('tipo',13,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('juzgado',13,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('demandado',13,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('demandante',13,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('observaciones',13,$documentos[$a]["iddoc"],1).'</td><td>'.mostrar_valor_campo('anexos',13,$documentos[$a]["iddoc"],1).'</td>';
   echo '</tr>';
  }
echo '</table>';
if (@$_REQUEST["export"] <> "excel") 
include_once("footer.php");
?>