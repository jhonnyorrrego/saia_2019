<?php
include_once('define_remoto.php');
require_once('lib/nusoap.php');

ini_set("display_errors",false);
$cliente = new nusoap_client(SERVIDOR_REMOTO.'/servidor_respuesta_pqr.php');
$datos = json_encode($_REQUEST);
$resultado = $cliente->call('respuesta_pqr', array($datos));
$resultado = json_decode($resultado);

$tabla = "";
if($resultado->numcampos){
  	
  $tabla = '
  					<table class="table table-condensed table-bordered table-striped table-hover" border="1" style="border-collapse:collapse">
						  <caption><b>Documentos</b></caption>						  
					    <tr class="info ">
					      <td style="text-align: center;"><b>No. Radicado</b></td>
					      <!--td style="text-align: center;"><b>No. PQRD</b></td-->
					      <td style="text-align: center;"><b>Fecha de radicaci&oacute;n</b></td>
					      <!--td style="text-align: center;"><b>Tipo de requerimiento</b></td-->
					      <td style="text-align: center;"><b>Descripci&oacute;n</b></td>
					      <td style="text-align: center;"><b>Respuesta</b></td>
					    </tr>						  
						  <tbody>
						';
for($i=0; $i < $resultado->numcampos; $i++){
	$pdf="Sin respuesta";
	if($resultado->$i->pdf_respuesta){
		$pdf="<a href='".RUTA_PDF.$resultado->$i->pdf_respuesta."' target='_blank'>Ver Respuesta Radicado: ".$resultado->$i->numero_respuesta."</a>";
	}
	$tabla .= '  <tr>
						      <td>'.$resultado->$i->numero.'</td>
						      <!--td>'.$resultado->$i->numero_orden.'</td-->
						      <td style="width: 152px;">'.$resultado->$i->fecha.'</td>
						      <!--td>'.obtener_tipo_peticion($resultado->$i->tipo_peticion).'</td-->
						      <td>'.$resultado->$i->resumen_hechos.'</td>
						      <td>'.$pdf.'</td>
						    </tr>
						 ';
}						 
	$tabla .= ' </tbody>
						</table>
  			 	';
  
}else{
  $tabla = '<div class="alert alert-block">
  						<button type="button" class="close" data-dismiss="alert">&times;</button>
  							No se encontraron resultados para la búsqueda.
						</div>';
}

echo($tabla);

function obtener_tipo_peticion($tipo_peticion){
	
	switch ($tipo_peticion) {		
		case 1:
			$tipo = "Petici&oacute;n";
		break;	
		case 2:
			$tipo = "Queja";
		break;
		case 3:
			$tipo = "Reclamo";
		break;
		case 4:
			$tipo = "Sugerencia";
		break;
		case 5:
			$tipo = "Reconocimiento";
		break;
		case 6:
			$tipo = "Denuncia";
		break;
	}	
	return($tipo);
}
?>
