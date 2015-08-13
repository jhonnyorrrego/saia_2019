<?php
session_start();
include_once("db.php");
global $conn;
$modulo=busca_filtro_tabla("","modulo","nombre='documentos_pendientes'","",$conn);
abrir_url($modulo[0]["enlace"],"centro");
//$buscar=new Sql($conn->Obtener_Conexion(),$conn->Motor);
$datos=busca_filtro_tabla("","busquedas","idbusquedas=41","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=41","orden asc",$conn);
if($funciones["numcampos"])
{for($i=0;$i<$funciones["numcampos"];$i++)
    {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
    }
 $id_func=implode(",",$id_func);
}
$adicion="";
if(isset($_REQUEST["ejecutor"]) && $_REQUEST["ejecutor"]!="")
 $adicion = "ejecutor,".$_REQUEST["ejecutor"].";";
$destino =  usuario_actual("funcionario_codigo");
$otro="";
if(isset($_REQUEST["permiso"]) && $_REQUEST["permiso"]!="")
 { $otro = ";fun_permiso,".$_REQUEST["permiso"];
   $destino = $_REQUEST["permiso"];
 }
 
 // Nueva busqueda
$doc_usuario = busca_filtro_tabla("documento_iddocumento","asignacion","entidad_identidad=1 and llave_entidad=$destino and  estado='PENDIENTE' and tarea_idtarea=2","",$conn);
for($i=0; $i<$doc_usuario["numcampos"]; $i++)
 $resultados[]=$doc_usuario[$i]["documento_iddocumento"];
// fin Nueva busqueda      
if(!isset($resultados))
    $resultados[0]=0;
$resultados=array_unique($resultados);   
  //die($resultados);
$_SESSION["ldocs"]=implode(",",$resultados);         
if($datos["numcampos"])
  {  
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="20">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="adicionales" value="filtro,funcionario;tipo_filtro,destino;pantalla,pendientes;<?php echo $adicion; ?>lista_docs,<?php echo implode("-",$resultados).$otro; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"]; ?>">
<input type="image" src=" <?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>

<script>
form1.submit();
</script>
<?php  
  }die();
?>
