<?php
     
include_once("../db.php");
include_once("../header.php");
include_once("../formatos/librerias/funciones_generales.php");
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  //@ob_start();
}
//include_once("../calendario/calendario.php");
?>
<script type="text/javascript" src="../popcalendar.js"></script>
<style>
ul{
  margin-left:20px;
}
li{
  margin-top:10px;
}
.subtotal{
font-weight:bold;
}
.columna{
width:100px;
}
.columna_principal{
width:400px;
text-align:left;

}
</style>
<?php
if(isset($_REQUEST["categorias"])){
formulario_exportar($_REQUEST["categorias"]);     
}
else
  formulario();

?>
<script type="text/javascript">
function validar(f)
{ 
 if(f.categorias.value==-1)
 { alert("Por favor seleccione una categoria");
   return false; 
 }
 
 return true;
}
</script>
<?php
function formulario()
{ 
 global $conn;
 echo "<form name='reporte' id='reporte' action='categorias.php' method='POST' onSubmit='return validar(this);'>";
 $dep = busca_filtro_tabla("idserie,nombre","serie","","",$conn);
 //print_r($dep);
  echo '<center>&nbsp;&nbsp;&nbsp;<STRONG>REPORTE POR CATEGORIA</STRONG</center><br><br />';
 echo "<table border='0' width='100%'><tr><td class='encabezado'>CATEGORIA</td><td bgcolor='#f5f5f5' colspan='3'>
        <select name='categorias' id='categorias' ><option value='-1'>Seleccionar ...</option>";
 for($i=0; $i<$dep["numcampos"]; $i++)
 { 
 if(($dep[$i]["idserie"]==2843) || ($dep[$i]["idserie"]==2842) || ($dep[$i]["idserie"]==2841) || ($dep[$i]["idserie"]==2840) || ($dep[$i]["idserie"]==2844) || ($dep[$i]["idserie"]==2845)){
  echo "<option value='".$dep[$i]["idserie"]."'>".$dep[$i]["nombre"]."</option>";
  }
 } 
 echo "</select></td></tr>";
 ?>
 
<tr>
<td colspan="3" align="center">
  <input type="submit" name="Action" id="Action" value="Buscar">
</td>
 <?php
 echo "</table></form>";
}

function formulario_exportar($categoria){
$nombre_serie = busca_filtro_tabla("idserie,nombre","serie","idserie=".$categoria,"",$conn);
$serie = busca_filtro_tabla("","documento","estado<>'ELIMINADO' and tipo_radicado=2 and serie=".$categoria,"",$conn);
header('Content-Type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte ".$nombre_serie[0]["nombre"].".xls");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");  
echo("<b>Reporte categor&iacute;a: <b>".$nombre_serie[0]["nombre"]."<br>");
echo("<b>N&uacute;mero total de registros encontrados: <b>".$serie["numcampos"]);

echo '<br /><br /><table border=1><tr class="encabezado_list"><td>Cliente</td><td>Empresa</td><td>Direcci&oacute;n</td><td>Radicado</td></tr>';
//$documentos= busca_filtro_tabla("","documento","estado<>'ELIMINADO' and idserie=$categoria","",$conn);

for($i=0;$i<$serie["numcampos"];$i++)
{  
// $pqr=busca_filtro_tabla("","documento","estado<>'ELIMINADO' and documento_iddocumento=".$documentos[$i]["iddocumento"],"",$conn);
 //$datos_ejecuto=busca_filtro_tabla("","ejecutor a, datos_ejecutor b","solicitante=".$pqr[0]["solicitante"],"",$conn); 
$datos_ejecutor=busca_filtro_tabla("","ejecutor a,datos_ejecutor b","b.ejecutor_idejecutor=a.idejecutor and b.iddatos_ejecutor=".$serie[0]["ejecutor"],"",$conn);
 echo '<tr><td align="middle">'.$datos_ejecutor[$i]["nombre"].'</td><td align="middle">'.$datos_ejecutor[$i]["empresa"].'</td><td align="middle">'.$datos_ejecutor[$i]["direccion"].'</td><td align="middle">'.$serie[$i]["numero"].'</td></tr>';
}  

echo '</table>';
$usuario=usuario_actual("id");
$fecha=date("Y-m-d"); 
$actual=busca_filtro_tabla("nombres,apellidos","dependencia_cargo dc,funcionario","funcionario_codigo=".$usuario,"",$conn);
$cargo=cargos_memo($usuario,$fecha,"de",1);

echo("<b>Recibido por: <b>".$actual[0]["nombres"]."".$actual[0]["apellidos"]."<br>");
echo("<b>Cargo: <b>".$cargo."<br>");
echo("<b>Fecha impresi&oacute;n:</b>".$fecha);
include_once("../footer.php");
}
?>
