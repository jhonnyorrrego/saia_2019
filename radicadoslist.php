<?php
include_once("db.php");
if(!isset($_REQUEST["export"]))
include_once("header.php");
include_once("calendario/calendario.php");

if(isset($_REQUEST["funcionario"])&&$_REQUEST["funcionario"])
 {   
 $x_fecha_ingreso = @$_REQUEST["x_fecha_ingreso"];
 $y_fecha_ingreso = @$_REQUEST["y_fecha_ingreso"];
 $tipo_fecha =$_REQUEST["z_fecha_ingreso"];
 $tipo_fechax = split(',',$tipo_fecha[0]);
 $tipo_fechay = split(',',$tipo_fecha[1]);
 $tipo = $_REQUEST["tipo"];
 $where = "";
 if($x_fecha_ingreso != "" )
 {
   $where = "a.fecha ".$tipo_fechax[0]." ".fecha_db_almacenar($x_fecha_ingreso,'Y-m-d H:i:s')." AND ";  
   if($y_fecha_ingreso != "" )   
    $where .= "a.fecha ".$tipo_fechay[0]." ".fecha_db_almacenar($y_fecha_ingreso,'Y-m-d H:i:s')." AND "; 
   else 
   { $where .= "a.fecha ".$tipo_fechay[0]." ".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s')." AND ";
     $y_fecha_ingreso = date('Y-m-d H:i:s');
   }    
   $fecha = $x_fecha_ingreso." a ".$y_fecha_ingreso;
 }
 else
 { $where = fecha_db_obtener("a.fecha","Y-m-d")." like '".date("Y-m-d")."' AND ";
   $fecha = date("Y-m-d");
 }
 if($tipo=='entrada')
   $where .= "tipo_radicado=1 and ";
 else
   $where .= "tipo_radicado=2 and "; 
 if($_REQUEST["funcionario"]=='todos')
 { $func = explode(',',$_REQUEST["todos"]);
   echo "<br /><a href='radicadoslist.php'>Volver</a><br /><br />";
echo "<b>LISTADO TOTAL DE DOCUMENTOS RADICADOS DE ENTRADA POR RADICADOR. FECHA: $fecha </b><br /><br />";   
   echo "<table border='1'><tr class='encabezado_list'><td>Total Documentos</td><td>Radicador</td></tr>";  
   for($i=0; $i<(count($func)-1); $i++)
   { $resultado=busca_filtro_tabla("count(a.numero) as total","documento a,buzon_salida b",$where."b.archivo_idarchivo=a.iddocumento and b.origen='".$func[$i]."' and b.idtransferencia=(select min(c.idtransferencia) from buzon_salida c where c.archivo_idarchivo=a.iddocumento)","",$conn);
   //print_r($resultado);
     $funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$func[$i],"",$conn);
     echo "<tr><td>".$resultado[0]["total"]."</td><td>".$funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"]."</td></tr>";
   }
   echo "</table>"; 
 }
 else
 {  
 $resultado=busca_filtro_tabla("numero,".fecha_db_obtener("a.fecha","Y-m-d H:i:s")." as fecha,descripcion,a.iddocumento,b.idtransferencia","documento a,buzon_salida b",$where."b.archivo_idarchivo=a.iddocumento and b.origen='".$_REQUEST["funcionario"]."' and b.idtransferencia=(select min(c.idtransferencia) from buzon_salida c where c.archivo_idarchivo=a.iddocumento)","fecha asc,numero asc",$conn);
 //echo $resultado["sql"]; 
$funcionario=busca_filtro_tabla("nombres,apellidos","funcionario","funcionario_codigo=".$_REQUEST["funcionario"],"",$conn);
if(!isset($_REQUEST["export"]))
  echo "<br /><a href='radicadoslist.php'>Volver</a><br /><br />";
echo "<b>LISTADO DE DOCUMENTOS RADICADOS POR ".ucwords($funcionario[0]["nombres"]." ".$funcionario[0]["apellidos"])."</b><br /><br />";
  if($resultado["numcampos"])
  { 
  if(isset($_REQUEST["export"])&& $_REQUEST["export"])
      {       
       header('Content-Type: application/vnd.ms-excel');
  	   header("Content-Disposition: attachment; filename=radicados_".date("Y-m-d").".xls");
  	   header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      }
   else
     echo '<a href="radicadoslist.php?funcionario='.$_REQUEST["funcionario"].'&export=excel&x_fecha_ingreso='.$_REQUEST["x_fecha_ingreso"].'&y_fecha_ingreso='.$_REQUEST["y_fecha_ingreso"].'&z_fecha_ingreso[0]='.stripslashes($_REQUEST["z_fecha_ingreso"][0]).'&z_fecha_ingreso[1]='.stripslashes($_REQUEST["z_fecha_ingreso"][1]).'&tipo='.$_REQUEST["tipo"].'"><img src="enlaces/excel.gif" border="0" ALT="Exportar a Excel"></a>';   
   echo "<br /><br />
        <table border=1 style='border-collapse:collapse' align=center ><tr class='encabezado_list'><td>FILA</td><td>NUMERO</td><td>FECHA</td><td>DESCRIPCION</td></tr>";
   for($j=0;$j<$resultado["numcampos"];$j++)
     echo "<tr><td>".($j+1)."</td><td>".$resultado[$j]["numero"]."</td><td>".$resultado[$j]["fecha"]."</td><td>".$resultado[$j]["descripcion"]."</td></tr>";
   echo "</table>";
   }
  else
   {echo "<br /><br />No hay documentos radicados por el funcionario";
   }
 } 
}
else
 {
  $rad = array();
  $radicadores=busca_filtro_tabla("distinct nombres,apellidos,funcionario_codigo","funcionario,dependencia_cargo,cargo,dependencia","dependencia_iddependencia=iddependencia and dependencia.estado=1 and cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and lower(cargo.nombre) like '%radicador%' and cargo.estado=1 and funcionario.estado=1 and dependencia_cargo.estado=1","nombres,apellidos",$conn); 
  for($i=0; $i<$radicadores["numcampos"]; $i++)
    array_push($rad,$radicadores[$i]["funcionario_codigo"]);    
 $rad_perfil = busca_filtro_tabla("distinct nombres,apellidos,funcionario_codigo","funcionario,perfil","idperfil=perfil and  lower(perfil.nombre) like lower('RADICADOR')","",$conn); 
 for($i=0; $i<$rad_perfil["numcampos"]; $i++)
    array_push($rad,$rad_perfil[$i]["funcionario_codigo"]);
  $rad =array_unique($rad);   
  $rad["numcampos"] = count($rad);  
  echo "<br><br><form name='radicadoslist' action='radicadoslist.php' method='POST'>
  <table style='border-collapse:collapse' width='70%' border=1 align='center'><tr class='encabezado'><td align='center' colspan='4'><b>RADICADORES</b></td></tr>";
  ?> 
      <tr>
      <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA DE INGRESO AL SISTEMA</span></td>      
<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="hidden" name="z_fecha_ingreso[]" value=">=,','">
<label >ENTRE</label> 
<input type="text" name="x_fecha_ingreso" id="x_fecha_ingreso" value="" size="22">
&nbsp;
<?php selector_fecha("x_fecha_ingreso","radicadoslist","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,7,00,"AM"); ?>
&nbsp;&nbsp;&nbsp;
  <input type="hidden" name="z_fecha_ingreso[]" value="<=,','">
  <label >Y</label>&nbsp;&nbsp;&nbsp;
  <input type="text" name="y_fecha_ingreso" id="y_fecha_ingreso" value="" size="22">
&nbsp;
<?php selector_fecha("y_fecha_ingreso","radicadoslist","Y-m-d H:i:s",date("m"),date("Y"),"default.css","","AD:VALOR","VENTANA",false,false,10,00,"PM"); ?>
</span></td>
</tr>  
  <?php
  echo "<tr><td class='encabezado'>RADICADORES: <!--a href='?funcionario=".$radicadores[$i]["funcionario_codigo"]."'>".$radicadores[$i]["nombres"]." ".$radicadores[$i]["apellidos"]."</a--></td><td><select name='funcionario'>";
  $todos = "";
  for($i=0;$i<$rad["numcampos"];$i++)
    {
    $radicadores = busca_filtro_tabla("funcionario_codigo,nombres,apellidos","funcionario","funcionario_codigo=".$rad[$i],"",$conn);    
    echo "<option value='".$radicadores[0]["funcionario_codigo"]."'>".$radicadores[0]["nombres"]." ".$radicadores[0]["apellidos"]."</option>";
     $todos .= $radicadores[0]["funcionario_codigo"].",";
    }
  echo "<option value='todos'>Todos</option>";      
  echo "</select></td></tr>
       <tr><td class='encabezado'>TIPO DE RADICACI&Oacute;N</td><td><input type='radio' name='tipo' value='entrada' checked>Radicaci&oacute;n Entrada &nbsp;&nbsp;
       <input type='radio' name='tipo' value='salida'>Radicaci&oacute;n Salida</td></tr>
       <tr><td colspan='2' align='center'>
        <input type='hidden' name='todos' value='$todos'>
        <input type='submit' value='Aceptar'></td></tr></table></form>";  
 }
if(!isset($_REQUEST["export"])) 
include_once("footer.php");  
?>