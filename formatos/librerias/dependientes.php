<?php
include_once("../../db.php");

if($_REQUEST["idcomponente"] && isset($_REQUEST["pos"]))
{$componente=busca_filtro_tabla("valor","campos_formato","idcampos_formato=".$_REQUEST["idcomponente"],"");

 if($componente["numcampos"])
   {$select=explode("|",$componente[0][0]);
    $sql=explode(";",$select[$_REQUEST["pos"]+1]);
    $datos=ejecuta_filtro_tabla($sql[1].$_REQUEST["valor"]." order by nombre");
    echo "<option value='' selected>Seleccionar...</option>";
    for($i=0;$i<$datos["numcampos"];$i++)
      echo "<option value='".$datos[$i]["id"]."'>".$datos[$i]["nombre"]."</option>";
   }   
}
else
{echo "<option value='' selected>Seleccionar...</option>";
}
?>
