<?php
include_once("../../db.php");
if($_REQUEST["padre"])
{$riesgos=busca_filtro_tabla("idft_riesgos_proceso,consecutivo","ft_riesgos_proceso r,documento d","documento_iddocumento=iddocumento and d.estado<>'ELIMINADO' and ft_proceso=".$_REQUEST["padre"]." AND r.estado<>'INACTIVO'","consecutivo asc",$conn);
    
 $j=1;
 for($i=0;$i<$riesgos["numcampos"];$i++)
   {if($riesgos[$i]["consecutivo"]<>$j)
      {$sql="update ".DB.".ft_riesgos_proceso set consecutivo=$j where idft_riesgos_proceso='".$riesgos[$i]["idft_riesgos_proceso"]."'";
       phpmkr_query($sql,$conn);
      }
    $j++;
   }
 alerta("Los riesgos han sido reordenados");  
}   
//consecutivo_riesgo($idformato,$idcampo,$iddoc=NULL)
?>