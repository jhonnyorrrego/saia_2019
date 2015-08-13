<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");     
include_once($ruta_db_superior."workflow/libreria_paso.php");
//actualizar_vencimientos_pasos();
$idbusqueda=162;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=".$idbusqueda,"",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$idbusqueda,"orden",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
if($datos["numcampos"]){
  $usu=usuario_actual("funcionario_codigo");
  $condicion_flujo="";
  if(@$_REQUEST["estado_flujo"]){
    $condicion_flujo=" AND d.estado_diagram_instance IN(".@$_REQUEST["estado_flujo"].")";
  }
  if(@$_REQUEST["verificar_asignacion"]){    
    $datos[0]["codigo"]="SELECT a.idpaso_documento AS key1, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial FROM paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f, asignacion g WHERE a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso AND  a.documento_iddocumento=g.documento_iddocumento AND g.llave_entidad=".$usu.$condicion_flujo." GROUP BY d.iddiagram_instance ORDER BY fecha_inicial DESC";
    //$datos[0]["codigo"]=str_replace("/*codigo_adicional*/",$cadena,$datos[0]["codigo"]);
  }
  else if(@$_REQUEST["administrar_mis_flujo"]){
    $datos[0]["codigo"]="SELECT a.idpaso_documento AS key1, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial FROM paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f,buzon_salida g WHERE a.documento_iddocumento=g.archivo_idarchivo AND a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso AND ".$usu."=g.destino  GROUP BY d.iddiagram_instance,a.idpaso_documento,e.title,b.descripcion,a.fecha_asignacion ORDER BY fecha_inicial DESC";
  }
  else if(@$_REQUEST["administrar_flujo"]){
    $datos[0]["codigo"]="SELECT a.idpaso_documento AS key, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial FROM paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f WHERE a.documento_iddocumento=b.iddocumento AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso  GROUP BY d.iddiagram_instance,a.idpaso_documento, e.title, b.descripcion, a.fecha_asignacion ORDER BY fecha_inicial DESC";
  }
  else if(@$_REQUEST["estado_flujo"]==7){
    $datos[0]["codigo"]="SELECT a.idpaso_documento AS key1, d.iddiagram_instance AS No_Flujo, e.title AS flujo__nombre,b.descripcion AS descripcion_documento, a.fecha_asignacion AS fecha_inicial FROM paso_documento a, documento b, diagram e, diagram_instance d,paso_actividad f,buzon_salida g WHERE a.documento_iddocumento=g.archivo_idarchivo AND a.documento_iddocumento=b.iddocumento AND a.estado_paso_documento=7 AND a.diagram_iddiagram_instance=d.iddiagram_instance AND d.diagram_iddiagram=e.id AND f.paso_idpaso=a.paso_idpaso  AND ".$usu." =g.destino GROUP BY d.iddiagram_instance ORDER BY fecha_inicial DESC";
    //print_r($datos);
    //die();
  }
  else{
    $cadena=" AND ".$usu." =g.destino ";
    if(@$_REQUEST["estado_flujo"]){
        $cadena.=" AND d.estado_diagram_instance IN(".$_REQUEST["estado_flujo"].")"; 
    } 
    $datos[0]["codigo"]=str_replace("/*codigo_adicional*/",$cadena,$datos[0]["codigo"]);  
    $datos[0]["codigo"].=" GROUP BY d.iddiagram_instance ORDER BY fecha_inicial DESC ";
  }
//print_r($datos);

//die($datos[0]["codigo"]);
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10"><input type="hidden" name="adicionales" value="no_encabezado,1">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="diagram">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
