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
include_once($ruta_db_superior."class_transferencia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
$parametros=json_decode($_REQUEST['parametros']);
$parametros=array_filter($parametros); //Elimina campos vacios
$iddoc=$_REQUEST['iddoc'];
$tipo_mensajeria_radicacion=busca_filtro_tabla("tipo_mensajeria,area_responsable","ft_radicacion_entrada","documento_iddocumento=".$iddoc,"",$conn);

$idformato=$_REQUEST['idformato'];
$cont=count($parametros);

$repetidos=array(); //Se usa debido a que los mostrar cuando tienen mas de 1 pagina, duplican las validaciones js
for ($i=0; $i < $cont; $i++) {
    if(!in_array($parametros[$i][0], $repetidos)){
        $estado_item=busca_filtro_tabla("estado_item","ft_destino_radicacion","idft_destino_radicacion=".$parametros[$i][0],"",$conn); 
    	if($estado_item[0]['estado_item']==0){
            $sql="UPDATE ft_destino_radicacion SET observacion_destino='".$parametros[$i][1]."', estado_item=1 WHERE idft_destino_radicacion=".$parametros[$i][0];
        }else{
            $sql="UPDATE ft_destino_radicacion SET observacion_destino='".$parametros[$i][1]."' WHERE idft_destino_radicacion=".$parametros[$i][0];
        }
        phpmkr_query($sql);
        $tipo_destino=busca_filtro_tabla("tipo_destino,nombre_destino","ft_destino_radicacion","idft_destino_radicacion=".$parametros[$i][0],"",$conn);
        if($tipo_destino[0]['tipo_destino']==2){
            transferencia_automatica($idformato,$iddoc,$tipo_destino[0]['nombre_destino'],1,"");
        }
		
		
		
		//VINCULANDO MENSAJERO INMEDIATAMENTE
		if($tipo_mensajeria_radicacion[0]['tipo_mensajeria']==2 || $tipo_mensajeria_radicacion[0]['tipo_mensajeria']==1){
			$datos_destino[0]['nombre_destino']=$tipo_mensajeria_radicacion[0]['area_responsable'];
		}else{
			$datos_destino=busca_filtro_tabla('nombre_destino','ft_destino_radicacion','idft_destino_radicacion='.$parametros[$i][0],'',$conn);
		}
    	$destino=busca_filtro_tabla("iddependencia","vfuncionario_dc","iddependencia_cargo=".$datos_destino[0]['nombre_destino'],"",$conn);
    	$responsable=busca_filtro_tabla("mensajero_ruta","documento d,ft_ruta_distribucion a, ft_dependencias_ruta b, ft_funcionarios_ruta c","d.iddocumento=a.documento_iddocumento AND lower(d.estado)='aprobado' AND b.estado_dependencia=1 AND c.estado_mensajero=1 AND a.idft_ruta_distribucion=b.ft_ruta_distribucion AND a.idft_ruta_distribucion=c.ft_ruta_distribucion AND b.dependencia_asignada=".$destino[0]['iddependencia'],"",$conn);
    	if($responsable['numcampos']){
    		$sql="UPDATE ft_destino_radicacion SET mensajero_encargado=".$responsable[0]['mensajero_ruta']." WHERE idft_destino_radicacion=".$parametros[$i][0];
			phpmkr_query($sql);
    	}
    	//FIN VINCULANDO MENSAJERO INMEDIATAMENTE	
		
        $repetidos[]=$parametros[$i][0];
    }
}
transferencia_automatica($idformato,$iddoc,"copia_a",2,'','COPIA');
$radicado=busca_filtro_tabla('b.numero, c.idft_destino_radicacion,c.estado_item','ft_radicacion_entrada a,documento b,ft_destino_radicacion c','a.documento_iddocumento = b.iddocumento AND a.idft_radicacion_entrada = c.ft_radicacion_entrada AND a.documento_iddocumento='.$iddoc,'',conn);


$sql1="UPDATE ft_radicacion_entrada SET despachado=1 WHERE documento_iddocumento=".$iddoc;
phpmkr_query($sql1);

for($i=0;$i<$radicado['numcampos'];$i++){
    $numero_item=$i+1;
    $sql="UPDATE ft_destino_radicacion SET numero_item='".$radicado[$i]['numero'].".".$numero_item."' WHERE idft_destino_radicacion=".$radicado[$i]['idft_destino_radicacion'];
    phpmkr_query($sql);
}