<?php
include_once("db.php");
$fecha=$_REQUEST["anio"]."-";
if($_REQUEST["mes"]<10)
   $fecha.="0".$_REQUEST["mes"];
else
   $fecha.=$_REQUEST["mes"];
if($_REQUEST["dia"]<10)
   $fecha.="-0".$_REQUEST["dia"];
else
   $fecha.="-".$_REQUEST["dia"];
$resultado=busca_filtro_tabla("distinct ".fecha_db_obtener("fecha_inicial","Y-m-d H:i")." as fecha_inicial,".fecha_db_obtener("fecha_final","Y-m-d H:i")." as fecha_final,descripcion,nombres,apellidos, numero","reserva,funcionario,documento",fecha_db_obtener("fecha_inicial","Y-m-d")."<='$fecha' and ".fecha_db_obtener("fecha_final","Y-m-d").">='$fecha' and documento_iddocumento=iddocumento and investigador_idinvestigador=funcionario_codigo","fecha_inicial",$conn);
include_once("header.php");
echo "<table border=1>";
echo "<tr class='encabezado_list'>
      <td>Fecha Inicial</td><td>Fecha Final</td>
      <td>Descripcion</td><td>Radicado</td><td>Investigador</td></tr>";
for($i=0;$i<$resultado["numcampos"];$i++)
    {echo "<tr>
      <td>".$resultado[$i]["fecha_inicial"]."</td><td>".$resultado[$i]["fecha_final"]."</td>
      <td>".$resultado[$i]["descripcion"]."</td><td>".$resultado[$i]["numero"]."</td>
      <td>".$resultado[$i]["nombres"]." ".$resultado[$i]["apellidos"]."</td></tr>";
    }
echo "</table>";  
include_once("footer.php");  
?>
<script>
document.getElementById("header").style.visibility="hidden";
document.getElementById("ocultar").style.visibility="hidden";
</script>
