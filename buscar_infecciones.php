<?php
ini_set("display_errors",true);
?>
<form method="post" action="#">
  <table>
  <tr>
    <td>
      <input type="hidden" value="1" name="evaluar">
      Ruta Inicio relativa al script
    </td>
    <td>
      <input type="text" name="ruta_defecto" value=".">
    </td>
  </tr>
  <tr>
    <td>
      Contenido a Buscar 
    </td>
    <td>
      <textarea name="contenido"></textarea>
    </td>
  </tr>
  <!--tr>
    <td>
      Reemplazar el contenido?
    </td>
    <td>
      <input name="reemplazar" type="radio" value="1">SI <input name="reemplazar" type="radio" value="0" checked="true">NO
    </td>
  </tr>
  <tr>
    <td>
      Contenido a Reemplazar 
    </td>
    <td>
      <textarea name="contenido_reemplazo"></textarea>
    </td>
  </tr-->
  <tr>
    <td colspan="2">
      <input type="submit">
    </td>
  </tr>
</table>    
</form>
<?php
include_once("pantallas/lib/librerias_archivo.php");
if(@$_REQUEST["evaluar"] && @$_REQUEST["contenido"]!='' && @$_REQUEST["ruta_defecto"]!=''){
  buscar_archivos($_REQUEST["ruta_defecto"],$_REQUEST["contenido"],1,0);
  print_r($resultado_buscar_archivo);
  
  echo("Archivos evaluados ".$contador_archivos);
}
?>