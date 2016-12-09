<?php
include_once("../../db.php");
include_once("../../header.php");
if(isset($_REQUEST["seguimiento_indicador"])&&$_REQUEST["seguimiento_indicador"]);
{/*if($_REQUEST["tipo"]=="indicador")
   $target="_blank";
 else*/
   $target="centro";  
 $planes=busca_filtro_tabla("iddocumento,descripcion,numero","seguimiento_planes,documento","iddocumento=plan_mejoramiento and documento.estado<>'ELIMINADO' and idft_seguimiento_indicador=".$_REQUEST["seguimiento_indicador"],"",$conn);
 if($planes["numcampos"]==0)
   echo "<br /><br />No existen planes relacionados con el seguimiento.";
 elseif($planes["numcampos"]==1)
   {echo "<script>
          //window.parent.hs.close();
          window.open('../../ordenar.php?accion=mostrar&mostrar_formato=1&key=".$planes[0][0]."','_blank');
          </script>";  
   }
 else
   {echo "<B><br /><br />PLANES DE MEJORAMIENTO RELACIONADOS CON EL SEGUIMIENTO</B><br /><br /><br />
          <table border=1 style='border-collapse:collapse' cellpadding=5 align='center'><tr class='encabezado_list'><td>NUMERO</td><td>DESCRIPCION</td><td></td></tr>";
    for($i=0;$i<$planes["numcampos"];$i++)
      echo "<tr><td align=center>".$planes[$i]["numero"]."</td><td>".$planes[$i]["descripcion"]."</td><td><a target='$target' href='../../ordenar.php?accion=mostrar&mostrar_formato=1&key=".$planes[$i]["iddocumento"]."'>Ver</a></td></tr>";      
    echo "</table>";      
   }  
}

include_once("../../footer.php");
?>
<script>
document.getElementById("header").style.display="none";
document.getElementById("ocultar").style.display="none";
</script>
