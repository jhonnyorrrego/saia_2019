<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
if(@$_REQUEST['ejecutar_accion']){
	
	$retorno=array();
	
	switch(intval(@$_REQUEST['ejecutar_accion'])){
		case 1:   //ELIMINAR ACTIVIDAD PASO
			$sql="UPDATE paso_actividad SET estado=0 WHERE idpaso_actividad=".$_REQUEST['idpaso_actividad'];
			phpmkr_query($sql);		
			$retorno['exito']=1;
			break;
		
		case 2:  //CANCELAR PASO DESDE PANTALLA USUARIO FINAL
		
				include("cancelar_paso.php");
		
				
			
			break;
			
		case 3: //VALIDA QUE EXISTA ADICIONAR CUANDO SE SELECCIONA (APROBAR-CONFIRMAR-EDITAR), al crear una nueva actividad
				$cadena_pasos=implode(',',listado_pasos_anteriores_admin(@$_REQUEST['idpaso']));
				$cadena_pasos.=','.@$_REQUEST['idpaso'];
				$actividad_adicionar=busca_filtro_tabla("","paso_actividad","tipo=1 AND estado=1 AND accion_idaccion=1 AND paso_idpaso IN(".$cadena_pasos.")","",$conn);
				$retorno['exito']=0;
				if($actividad_adicionar['numcampos']){
					$retorno['exito']=1;
				}
			break;				
	
	} //FIN SWITCH
	
	
	echo(json_encode($retorno));	
	
}  //FIN IF EXIST


?>