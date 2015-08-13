<?php
function enlace_padre($idformato,$iddoc)
{global $conn;
 $padre=busca_filtro_tabla("d.plantilla,iddocumento,pdf","respuesta,documento d","origen=iddocumento and destino='$iddoc'","",$conn);
 if($padre[0]["pdf"]<>"")
  echo "<a href='../../".$padre[0]["pdf"]."' target='_blank'>Detalles</a>"; 
 elseif($padre[0]["plantilla"]<>"")
   echo "<a href='../../html2ps/public_html/demo/html2ps.php?iddoc=".$padre[0]["iddocumento"]."&plantilla=".strtolower($padre[0]["plantilla"])."' target='_blank'>Detalles</a>";
 else
   echo "<a href='../../documentoview.php?key=".$padre[0]["iddocumento"]."&no_menu=1' target='_blank'>Detalles</a>";
 
}
function descripcion($idformato,$idcampo,$iddoc=NULL)
{global $conn;
 if($iddoc==NULL)
  {$padre=busca_filtro_tabla("numero,descripcion","documento","iddocumento='".$_REQUEST["anterior"]."'","",$conn);
  }
 else
  {$padre=busca_filtro_tabla("numero,descripcion","respuesta,documento d","origen=iddocumento and destino='$iddoc'","",$conn);
  } 
 echo "<input type='hidden' name='descripcion' value='Solicitud de anulaci&oacute;n del documento con n&uacute;mero: ".$padre[0]["numero"]." y descripci&oacute;n: ".$padre[0]["descripcion"]."'>";
}
function anular_documento($idformato,$iddoc)
{global $conn;
 $padre=busca_filtro_tabla("origen,d.plantilla","respuesta,documento d","origen=iddocumento and destino='$iddoc'","",$conn);
 $sql="update documento set estado='ANULADO',pdf='' where iddocumento='".$padre[0]["origen"]."'";
 phpmkr_query($sql,$conn);
 $datos["archivo_idarchivo"]=$padre[0]["origen"];
 $datos["nombre"]="ANULADO";
 $datos["tipo_destino"]=1;
 $datos["tipo"]="";
 $aux_destino[0]=$_SESSION["usuario_actual"];
 transferir_archivo_prueba($datos,$aux_destino,"","");
 abrir_url("html2ps/public_html/demo/html2ps.php?plantilla=".strtolower($padre[0]["plantilla"])."&iddoc=".$padre[0]["origen"],"_blank");
}
?>
