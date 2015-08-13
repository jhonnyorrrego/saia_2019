<?php
include("db.php");


// iddocumento
$id = $_REQUEST['iddoc'];

//Consecutivo que desea volver el contador del documento.
$consecutivo = 1;

//Tipo de respuesta, si el documento es el origen o el destino. Opciones posibles:
//origen
//destino
$respuesta = 'destino';


eliminar($id,$consecutivo,$respuesta);


function eliminar($id,$consecutivo,$respuesta){
	$formato = busca_filtro_tabla("","documento a,formato b","iddocumento=".$id." and lower(plantilla)=lower(b.nombre)","",$conn);
	$paso_documento = busca_filtro_tabla("","paso_documento","documento_iddocumento=".$id,"",$conn);
	
	//--------------------Eliminar registro de la tabla correspondiente
	$sql = "delete from ".$formato[0]["nombre_tabla"]. " where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//--------------------Poniendo en estado eliminado el documento en la tabla documento
	$sql = "delete from documento where iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//--------------------Eliminar buzon entrada lo que tenga que ver con el documento
	$sql = "delete from buzon_entrada where archivo_idarchivo=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//--------------------Eliminar buzon salida lo que tenga que ver con el documento
	$sql = "delete from buzon_salida where archivo_idarchivo=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//-Eliminar destino de la tabla respuesta, en este caso cuando se le da respuesta a un documento cualquiera
	$sql = "delete from respuesta where ".$respuesta."=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//---Dejando consecutivo que el usuario defina.------------------------------
	$sql = "update contador set consecutivo='".$consecutivo."' where nombre='".strtolower($formato[0]["nombre"])."'";
	echo $sql."<br>";
	//phpmkr_query($sql);
	
	//--Eliminando datos de la tabla asignacion
	$sql = "delete from asignacion where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//--------Eliminando datos de la tabla comentario imagen
	$sql = "delete from comentario_img where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//---Eliminando datos de la tabla paso actividad anexo
	$sql = "delete from paso_actividad_anexo where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//-----Eliminando datos de la tabla paso instancia pendiente
	$sql = "delete from paso_instancia_pendiente where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//---- eliminando datos de la tabla paso instancia terminada-
	$sql = "delete from paso_instancia_terminada where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
	
	//------------Eliminando registros de las tablas paso inst terminacion y paso rastro
	if($paso_documento["numcampos"] > 0){
		for($i=0;$i<$paso_documento["numcampos"];$i++){
			$sql = "delete from paso_inst_terminacion where paso_documento_idpaso_documento=".$paso_documento[$i]["idpaso_documento"];
			echo $sql."<br>";
			phpmkr_query($sql);
			$sql = "delete from paso_rastro where paso_documento_idpaso_documento=".$paso_documento[$i]["idpaso_documento"];
			echo $sql."<br>";
			phpmkr_query($sql);
		}
	}
	
	
	
	//--eliminando datos de la tabla paso documento---------------------------------------
	$sql = "delete from paso_documento where documento_iddocumento=".$id;
	echo $sql."<br>";
	phpmkr_query($sql);
}
?>