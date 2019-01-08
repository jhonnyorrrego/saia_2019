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

function documentos_pendientes_reporte($funcionario_codigo){
    global $ruta_db_superior,$conn;
    
    $datos=busca_filtro_tabla("","documento a,asignacion b","(lower(a.estado)<>'eliminado' and a.iddocumento=b.documento_iddocumento and b.tarea_idtarea<>-1 and b.entidad_identidad=1  and b.llave_entidad='$funcionario_codigo')","group by a.fecha,a.estado,a.ejecutor,a.serie,a.descripcion,a.pdf,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,date_format(b.fecha_inicial,'y-m-d'),a.iddocumento order by b.fecha_inicial  desc",$conn);
    return $datos['numcampos'];
    
}

function calcular_ultimo_acceso($login){
    global $ruta_db_superior,$conn;
    
    $datos=busca_filtro_tabla("max(fecha) AS fecha","log_acceso","exito=1  AND (fecha!='' AND fecha IS NOT NULL) AND login='$login'","",$conn);
	if(is_null($datos[0]['fecha']) OR $datos[0]['fecha']==''){
		return('Sin Acceso Registrado');
	}
    return $datos[0]['fecha'];
}