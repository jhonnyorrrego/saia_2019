<?php
include_once("db.php");
//include_once("header.php");
/*echo '<script> 
      document.getElementById("header").style.display="none";
      document.getElementById("ocultar").style.display="none";  
      </script>';

if(isset($_REQUEST["iddoc"]))
{}*/
//ESTE ARCHIVO YA NO SE USA ELIMINAR SIN PIEDAD, ESTA FUNCION SE MIGRO A doctransflist.php QUE ES DONDE SE UTILIZA

function imprimir_datos_digitalizacion($iddoc)
{global $conn;
 $doc=busca_filtro_tabla("","documento","iddocumento='".$iddoc."'","",$conn);
 $info=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d H:i:s")." as fecha,".concatenar_cadena_sql(array("nombres","' '","apellidos"))." as funcionario,justificacion,accion","digitalizacion,funcionario","funcionario=funcionario_codigo and documento_iddocumento='".$iddoc."'","fecha asc",$conn);
 if($info["numcampos"])
 {echo '<br>
       <table border="1" style="border-collapse:collapse;width:90%" cellpadding="4" > 
       <tr class="encabezado_list">
       <td colspan=4>INFORMACION ADICIONAL</td></tr>
       <tr class="encabezado_list"><td>FECHA</td>
       <td>FUNCIONARIO</td><td>ACCION</td><td>NOTAS</td></tr>';
  for($i=0;$i<$info["numcampos"];$i++)
    echo '<tr>
          <td>'.$info[$i]["fecha"].'</td>
          <td>'.$info[$i]["funcionario"].'</td>
          <td>'.$info[$i]["accion"].'</td>
          <td>'.$info[$i]["justificacion"].'</td>
          </tr>';     
  echo '</table>';
 } 
}
//include_once("footer.php");  
?>
