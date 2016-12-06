<?php
include_once("header.php");
$tipo="texto";

//function agrega_boton($nombre,$imagen,$dir,$destino,$texto,$acceso,$modulo,
$enlaces="<table><tr><td>..".agrega_boton($tipo,'','planes_mejoramiento.php?tipo_plan=1','centro','Planes Institucionales','1','planes_institucionales',1)."&nbsp;</td>";
$enlaces.="<td>".agrega_boton($tipo,'','planes_mejoramiento.php?tipo_plan=2','centro','Planes de Proceso','1','planes_funcionales',1)."&nbsp;</td>";
$enlaces.="<td>".agrega_boton($tipo,'','planes_mejoramiento.php?tipo_plan=3','centro','Planes Individuales','1','planes_individuales',1)."&nbsp;</td>";
$enlaces.="<td>".agrega_boton($tipo,'','planes_mejoramiento.php?tipo_plan=4','centro','Planes Individuales2','1','planes_individuales',1)."&nbsp;</td>";
$enlaces.="<td>".agrega_boton($tipo,'','planes_mejoramiento.php?tipo_plan=5','centro','Planes Cerrados','1','planes_cerrados',1)."&nbsp;</td>";
$enlaces.="</tr></table>"
?>
<br><B>PLANES DE MEJORAMIENTO</B> <br><br><br>

<?php
echo $enlaces;
if(isset($_REQUEST["tipo_plan"]))
{$datos=busca_filtro_tabla("","busquedas","etiqueta='planes_mejoramiento'","",$conn);
if($_REQUEST["tipo_plan"]==3 && $_REQUEST["restringir_usuario"]){
  $func=usuario_actual("funcionario_codigo");
  $condicion=" and (A.ejecutor='$func' or idft_plan_mejoramiento in(select distinct ft_plan_mejoramiento from ft_hallazgo where responsable_seguimiento like '$func' or responsable_seguimiento like '%,$func' or responsable_seguimiento like '$func,%' or responsable_seguimiento like '%,$func,%'))";
  $datos[0]["codigo"]=str_replace("/*filtro*/",$condicion." /*filtro*/ ",$datos[0]["codigo"]);
 } 
 if($_REQUEST["tipo_plan"]!=5){
  $datos[0]["codigo"]=str_replace("/*filtro*/"," AND (B.estado_terminado<>'1' or (B.estado<>'INACTIVO' and B.estado_terminado is null)) ",$datos[0]["codigo"]);
  $datos[0]["codigo"]=str_replace("/*tipo_plan*/"," AND tipo_plan=".$_REQUEST["tipo_plan"],$datos[0]["codigo"]);  
 }
 else{
  $datos[0]["codigo"]=str_replace("/*filtro*/"," AND (B.estado='INACTIVO' or B.estado_terminado='1')",$datos[0]["codigo"]);
  $datos[0]["codigo"]=str_replace("/*tipo_plan*/","",$datos[0]["codigo"]);  
 }  
 $funciones=busca_filtro_tabla("idfunciones_busqueda","funciones_busqueda","busquedas_idbusqueda=".$datos[0]["idbusquedas"],"orden asc",$conn);
if($funciones<>"")
  {for($i=0; $i<$funciones["numcampos"]; $i++)
      {$id_func[]=$funciones[$i]["idfunciones_busqueda"];
      }
   $id_func=implode(",",$id_func);
  }

//print_r($datos);die();
if($datos["numcampos"])
  {
?>
<form name=form1 action="buscador/index.php" method="post">
<input type="hidden" name="busqueda" value="busqueda">
<input type="hidden" name="func_busqueda" value="<?php echo $id_func; ?>">
<input type="hidden" name="llave" value="<?php echo $datos[0]["llave"]; ?>">
<input type="hidden" name="registros" value="10">
<input type="hidden" name="tablas" value="tablas">
<input type="hidden" name="tabla" value="ft_plan_mejoramiento,documento">
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
}
include_once("footer.php");
?>