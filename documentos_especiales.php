<?php
/*
<Clase>
<Nombre>documentos_especiales
<Parametros>
<Responsabilidades>invocar el buscador para que liste los documentos, segun sea el caso
                    gestion, central y historico.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/ 
session_start();
include_once("db.php");
//$conn=new Conexion("");
global $conn;
//$buscar=new Sql($conn->Obtener_Conexion(),$conn->Motor);
$datos=busca_filtro_tabla("A.*","busquedas A","idbusquedas=14","",$conn);
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=14","",$conn);
if($funciones["numcampos"]>0)
  {for($i=0;$i<$funciones["numcampos"];$i++)
      {
        $id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }

$_REQUEST["tipo_listado"]=str_replace('?cmd=resetall','',$_REQUEST["tipo_listado"]);
if($datos["numcampos"]>0)
  {
   if(strncmp ( $_REQUEST["tipo_listado"], "central", 7)==0)
      $datos[0]["codigo"]=str_replace("GESTION","CENTRAL",$datos[0]["codigo"]);
   if(strncmp ( $_REQUEST["tipo_listado"], "historico", 7)==0)
      $datos[0]["codigo"]=str_replace("GESTION","HISTORICO",$datos[0]["codigo"]);   
  ?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tipo_listado" value="<?php echo $_REQUEST["tipo_listado"]; ?>">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="documento">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="adicionales" value="estado,<?php echo strtoupper($_REQUEST["tipo_listado"]); ?>;filtro,funcionario">
<input type="hidden" name="sql" value="<?php echo str_replace('"',"'",$datos[0]["codigo"]); ?>">
<input type="image" src="<?php echo PROTOCOLO_CONEXION.RUTA_PDF."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
