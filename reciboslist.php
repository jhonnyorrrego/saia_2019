<?php
include_once("db.php");
global $conn;
$datos=busca_filtro_tabla("","busquedas","idbusquedas=94","",$conn);   //id de la busqueda
if(@$_REQUEST["tipo"]){
$funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=94","orden asc",$conn);

if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }
$filtro="";
$filtro1="";
switch($_REQUEST["tipo"])
{case 'privado': $filtro.=" and tipo_radicado=17 ";
      break;
 case 'publico': $filtro.=" and tipo_radicado=16 ";
      break;
 case 'exp1': $filtro.=" and tipo_radicado=18 ";
      break;
 case 'exp2': $filtro.=" and tipo_radicado=19 ";
      break;            
}
}
else
  $id_func="1690,1685";

if(@$_REQUEST["inicial"])
  $filtro.=" and A.numero>=".$_REQUEST["inicial"]."";
if(@$_REQUEST["final"])
  $filtro.=" and A.numero<=".$_REQUEST["final"]."";

if(@$_REQUEST["categoria"]==1){
$filtro.=" and (B.usuario_remision is null or B.usuario_remision='')";	
	
}elseif(@$_REQUEST["categoria"]==2){
$filtro.=" and (B.usuario_causante is null or B.usuario_causante='') and usuario_remision<>'' ";			
}elseif(@$_REQUEST["categoria"]==3){
	
$filtro.=" and S.aprobado=0 and B.fecha_causacion<>'' and A.estado<>'ACTIVO' and 'ACTIVO'<>(select K.estado from documento K where K.iddocumento=S.documento_iddocumento) and usuario_causante<>''";	
		
}elseif(@$_REQUEST["categoria"]==4){	
$filtro.=" and S.documento_iddocumento in(select iddocumento from documento where estado='ACTIVO' and activa_admin=1)";			
}
elseif(@$_REQUEST["categoria"]==5){	
$filtro.=" and S.aprobado=1";	
			
}
if($filtro<>"")
    {$datos[0]["codigo"]=str_replace("/*filtro*/",$filtro,$datos[0]["codigo"]);
//die($datos[0]["codigo"]);
}

if($datos<>"")
  {?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="orden" value="<?php echo $datos[0]["orden"]; ?>">
<input type="hidden" name="ordenar" value="<?php echo $datos[0]["ordenado"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="ft_recibo_caja_menor,documento">
<input type="hidden" name="adicionales" value="tipo,<?php echo $_REQUEST["tipo"]; ?>">
<input type="hidden" name="grafico" value="<?php echo $datos[0]["grafico"]; ?>">
<input type="hidden" name="subtitulo" value="<?php echo $datos[0]["subtitulo"]; ?>">
<input type="hidden" name="totales" value="<?php echo $datos[0]["totales"]; ?>">
<input type="hidden" name="sql" value="<?php echo $datos[0]["codigo"];?>">
<input type="image" src="<?php echo "/".RUTA_SCRIPT."/imagenes/cargando.gif"; ?>">
</form>  
<script>
form1.submit();
</script>
<?php  
  }
?>
