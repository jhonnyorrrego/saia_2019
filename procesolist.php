<?php
session_start();
include_once("db.php");
global $conn;
//$buscar=new Sql($conn->Obtener_Conexion(),$conn->Motor);
$modulo=busca_filtro_tabla("","modulo","nombre='documentos_proceso'","",$conn);
abrir_url($modulo[0]["enlace"],'centro');
$datos=busca_filtro_tabla("","busquedas","idbusquedas=42","",$conn);
//print_r($datos); die();
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=42","orden asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}
/*
$doc_usuario="SELECT DISTINCT iddocumento,0 as creado
FROM buzon_entrada,documento
WHERE origen ='".usuario_actual("funcionario_codigo")."' 
AND nombre NOT IN ('APROBADO') AND documento.estado NOT IN('ELIMINADO','GESTION','HISTORICO','CENTRAL')
AND  archivo_idarchivo=iddocumento
UNION
SELECT DISTINCT iddocumento,1 as creado
FROM buzon_salida s,documento d
WHERE (s.nombre='TRANSFERIDO' OR s.nombre='APROBADO'OR s.nombre='REVISADO') AND (d.estado ='APROBADO' OR d.estado ='ACTIVO') 
AND s.archivo_idarchivo=d.iddocumento AND s.origen ='".usuario_actual("funcionario_codigo")."'
GROUP BY s.archivo_idarchivo,d.iddocumento
";
SELECT DISTINCT A.iddocumento as key, IF(A.numero>0,A.numero,'--') as documento__numero,max(B.fecha) as documento__recibido,A.descripcion as documento__descripcion FROM documento A,buzon_salida B WHERE A.estado IN('APROBADO', 'ACTIVO') and archivo_idarchivo=iddocumento AND B.nombre IN('BORRADOR','REVISADO','RESPONDIDO','TRAMITE','TRANSFERIDO','DEVOLUCION','APROBADO', 'TERMINADO') AND origen='/*para_idfunci' group by iddocumento 
*/
$destino =  usuario_actual("funcionario_codigo");
$doc_usuario="SELECT DISTINCT iddocumento,1 as creado FROM buzon_salida s,documento d WHERE s.archivo_idarchivo=d.iddocumento AND s.nombre IN('BORRADOR','REVISADO','RESPONDIDO','TRAMITE','TRANSFERIDO','DEVOLUCION','APROBADO', 'TERMINADO','DELEGADO','DISTRIBUCION') AND d.estado IN('APROBADO', 'ACTIVO','ANULADO') AND s.origen ='$destino' ORDER BY iddocumento";
//die($doc_usuario);
$enviados = "SELECT DISTINCT documento_iddocumento FROM asignacion WHERE entidad_identidad=1 and llave_entidad='$destino' and  estado='PENDIENTE' and tarea_idtarea=2";
//order by documento.fecha desc

$rs = phpmkr_query($doc_usuario,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $doc_usuario);

$vector=array();
//echo "ejecutada $doc_usuario";
while($vector[]=phpmkr_fetch_array($rs));
@phpmkr_free_result($rs);

/*$enviados="
SELECT e.archivo_idarchivo
FROM buzon_entrada e,buzon_salida s
where
e.origen ='".usuario_actual("funcionario_codigo")."'
and s.nombre NOT IN('LEIDO','BLOQUEADO')
and e.origen = s.origen
AND e.archivo_idarchivo = s.archivo_idarchivo 
GROUP BY e.archivo_idarchivo
HAVING max( s.fecha )>= max( e.fecha )";*/
//echo $enviados;// die();
//print_r($vector);
 $rs2= phpmkr_query($enviados,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $enviados);

$l_enviados=array();
while($fila=phpmkr_fetch_array($rs2))
  {$l_enviados[]=$fila[0];
  }
@phpmkr_free_result($rs2); 
$resultados=array();
foreach($vector as $fila)
      {if(!in_array($fila[0],$l_enviados) && $fila[0]<>"")
          $resultados[]=$fila[0];
       //else if($fila["creado"]==1 && $fila[0]<>"")
        //  {$resultados[]=$fila[0];
         // } 
      }   
/*
if($doc_usuario["numcampos"])
 for($i=0; $i<$doc_usuario["numcampos"]; $i++)
 {
  $resultado[]=$doc_usuario[$i]["iddocumento"];
 }*/
if($datos["numcampos"])
  {  
   if(is_array($resultados))
     {$resultados=array_unique($resultados);
     }
   if(count($resultados)) 
   $_SESSION["ldocs"]=$resultados ;
//print_r($resultados);
//die(";lista_docs,".implode('-',$resultados));
?>
<form name="form1" id="form1" action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="20">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="adicionales" value="filtro,funcionario;tipo_fitro=origen;pantalla,proceso<?php if(count($resultados)>0) echo ";lista_docs,".implode('-',$resultados); ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form> 

<script>
form1.submit();
</script>
<?php  
  }die();
?>

