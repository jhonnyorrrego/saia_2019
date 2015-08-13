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
$funcionario_codigo="24512396";

$documentos_funcionario=busca_filtro_tabla("*","documento","fecha BETWEEN ".fecha_db_obtener("fecha","Y-m-d").">='2014-04-01' AND ".fecha_db_obtener("fecha","Y-m-d").">='2014-06-30' AND a.ejecutor =".$funcionario_codigo,"",$conn);


$resultados="<table style='border-collapse:collapse;' border='1'>
						<tr style='text-align:center;'>
							<td>No. documento</td>
							<td>Fecha</td>
							<td>Remitente</td>
							<td>Asunto</td>
							<td>No. respuesta</td>
						</tr>
					";
for($i=0;$i<$documentos_funcionario['numcampos'];$i++){
	$respuesta_documento=busca_filtro_tabla("b.numero,","respuesta a, documento b","b.iddocumento=a.origen AND a.destino=".$documentos_funcionario[$i]['iddocumento'],"",$conn);
	$remitente=busca_filtro_tabla("","","","",$conn);
	
	
	$resultados.="<tr>";
	$resultados.="<td style='text-align:center;'>".$documentos_funcionario[$i]['numero']."</td>";
	$resultados.="<td style='text-align:center;'>".$documentos_funcionario[$i]['fecha']."</td>";
	$resultados.="<td style='text-align:center;'>REMITENTE</td>";
	$resultados.="<td style='text-align:center;'>".$documentos_funcionario[$i]['descripcion']."</td>";
	$resultados.="<td style='text-align:center;'>".$respuesta_documento[$i]['numero']."</td>";
	$resultados.="</tr>";
}

$evaluacion_proveedores =  busca_filtro_tabla("c.numero as numero_solicitud,a.tipo_contrato,b.contrato,b.documento_iddocumento,".fecha_db_obtener("d.fecha","Y-m-d")." as fecha_evaluacion,b.observaciones","ft_solicitud_compra a, ft_evaluacion_prov b, documento c, documento d","
a.documento_iddocumento=c.iddocumento 
AND lower(c.estado) not in('eliminado','anulado') 
AND b.documento_iddocumento=d.iddocumento 
AND lower(d.estado) not in('probado') 
AND a.idft_solicitud_compra=b.ft_solicitud_compra 
AND ".fecha_db_obtener("d.fecha","Y-m-d")." >= '2014-01-01'","c.fecha DESC",$conn);
echo($resultados);
die();
$tabla = "<table style='border-collapse:collapse;' border='1'>
						<tr style='text-align:center;'>
							<td>No solicitud</td>
							<td>Tipo contrato</td>
							<td>No contrato</td>
							<td>Nit proveedor</td>
							<td>Proveedor</td>
							<td>Interventor</td>
							<td>Gerente area</td>
							<td>Fecha de la evaluaci&oacute;n</td>
							<td>Calificaci&oacute;n</td>
							<td>Observaciones</td>
						</tr>						
					";
				
				for($i=0; $i < $evaluacion_proveedores["numcampos"]; $i++){					
					$tabla .= "	<tr>
												<td style='text-align:center;'>".$evaluacion_proveedores[$i]["numero_solicitud"]."</td>
												<td style='text-align:center;'>".obtener_tipo_contrato($evaluacion_proveedores[$i]["tipo_contrato"])."</td>
												<td style='text-align:center;'>".obtener_numero_contrato($evaluacion_proveedores[$i]["contrato"])."</td>
												<td style='text-align:center;'>".obtener_nit_proveedor($evaluacion_proveedores[$i]["contrato"])."</td>
												<td style='text-align:center;'>".obtener_proveedor($evaluacion_proveedores[$i]["contrato"])."</td>
												<td style='text-align:center;'>".obtener_interventor($evaluacion_proveedores[$i]["contrato"])."</td>
												<td style='text-align:center;'>".obtener_gerente_area($evaluacion_proveedores[$i]["documento_iddocumento"])."</td>
												<td style='text-align:center;'>".$evaluacion_proveedores[$i]["fecha_evaluacion"]."</td>
												<td style='text-align:center;'>".calificacion_funcion(2,$evaluacion_proveedores[$i]["documento_iddocumento"],1)."</td>
												<td>".$evaluacion_proveedores[$i]["observaciones"]."</td>
											</tr>
										";
				}		
								
$tabla .= "</table>";

/*header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=Reporte_de_Evaluacion_de_Proveedores.xls");*/

echo($tabla);


?>

