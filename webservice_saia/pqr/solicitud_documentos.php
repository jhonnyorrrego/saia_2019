<?php
include_once("../../db.php");
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
  $_SESSION["usuario_actual"]="123456";
  $_SESSION["conexion_remota"]=1; 
}
function solicitud_documento($datos)
{global $conn; 
 $resultado="";
 $arreglo=explode("/-/",$datos);
 foreach($arreglo AS $key=>$valor){
  $arreglo2=explode("/~/",$valor);
  $_REQUEST[$arreglo2[0]]=$arreglo2[1];
  }
 
 switch($_REQUEST["documento"]){
  case 'carnet':
  $resultado=buscar_carnet($_REQUEST["identificacion"]);
  break;
  case "certificado":
  $resultado=buscar_certificado($_REQUEST["identificacion"]);
  break;
  case "activacion_carnet":
  $resultado=solicitar_activacion($_REQUEST);
  break;
  }
 return($resultado);  
}

function buscar_certificado($identificacion){
global $conn;
$documento = busca_filtro_tabla("d.iddocumento","ft_dignatario a, ft_junta_accion_comunal_1 j,datos_ejecutor b, ejecutor c ,documento d, documento d2","nombre_dign=iddatos_ejecutor and ejecutor_idejecutor=idejecutor
and j.idft_junta_accion_comunal_1= a.ft_junta_accion_comunal_1
and c.identificacion='$identificacion' and activo_dign=1 and j.activa=1 and d.iddocumento=a.documento_iddocumento and d.estado<>'ELIMINADO'
and d2.iddocumento= j.documento_iddocumento and d2.estado<>'ELIMINADO'","d.fecha desc",$conn);
//return(0."|".$documento["sql"]."-".$documento["numcampos"]);
if($documento["numcampos"])
  {$pdf=busca_filtro_tabla("ruta","pdf_vista","documento_iddocumento=".$documento[0][0]." and idvista_formato=2","",$conn);
   if($pdf["numcampos"]&& is_file("../".$pdf[0]["ruta"]))
     return("1|".PROTOCOLO_CONEXION.RUTA_PDF."/".$pdf[0]["ruta"]."|".filesize("../".$pdf[0]["ruta"]));
   else
     return("0|No se encontro el pdf del certificado");
  }
else
  {return("0|No se encontro el documento en el sistema o no tiene un cargo activo actualmente en ninguna junta de accion comunal activa"); 
  }  
}

function buscar_carnet($identificacion){
global $conn;
$documento = busca_filtro_tabla("d.iddocumento,a.imprimir_carnet,a.idft_dignatario,b.email","ft_dignatario a, ft_junta_accion_comunal_1 j,datos_ejecutor b, ejecutor c ,documento d, documento d2","nombre_dign=iddatos_ejecutor and ejecutor_idejecutor=idejecutor
and j.idft_junta_accion_comunal_1= a.ft_junta_accion_comunal_1
and c.identificacion='$identificacion' and activo_dign=1 and j.activa=1 and d.iddocumento=a.documento_iddocumento and d.estado<>'ELIMINADO' and d2.iddocumento= j.documento_iddocumento and d2.estado<>'ELIMINADO'","d.fecha desc",$conn);
//return("0|".$documento["sql"]."-".$documento["numcampos"]);
if($documento["numcampos"])
  {$pdf=busca_filtro_tabla("ruta","pdf_vista","documento_iddocumento=".$documento[0][0]." and idvista_formato=3","",$conn);
   if($documento[0]["imprimir_carnet"]==1)
    {if($pdf["numcampos"]&& is_file("../".$pdf[0]["ruta"]))
      {$conn->Ejecutar_Sql("UPDATE ft_dignatario SET imprimir_carnet=0 WHERE idft_dignatario=".$documento[0]["idft_dignatario"]);
       return("1|".PROTOCOLO_CONEXION.RUTA_PDF."/".$pdf[0]["ruta"]."|".filesize("../".$pdf[0]["ruta"]));
      } 
     else
       return("0|No se encontro el pdf del carnet");
    }
   else
     return("0|El carnet solo puede imprimirse una vez via web. <a href='formulario_activacion_carnet.php?iddoc=".$documento[0]["iddocumento"]."&email=".$documento[0]["email"]."' target='datos'>Solicitar activaci&oacute;n</a>");  
  }
else
  {return("0|No se encontro el documento en el sistema o no tiene un cargo activo actualmente en ninguna junta de accion comunal activa"); 
  } 
}

function solicitar_activacion($datos)
{global $conn;
 $sql="insert into ft_activacion_carnet(documento_iddocumento,email,justificacion,ip) values('".$datos["iddocumento"]."','".$datos["email"]."','".$datos["justificacion"]."','".$datos["ip"]."')";
 phpmkr_query($sql);
 $insertado=phpmkr_insert_id();
 if($insertado)
  return("Su solicitud ha sido enviada.");
 else
  return("Error al registrar su solicitud."); 
}

function contenido_documento($direccion)
{$mh = curl_multi_init();
 $ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) { 
 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
 }
 curl_setopt($ch, CURLOPT_URL,$direccion); 
 curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
 $contenido=curl_exec ($ch);
 curl_close ($ch);
 return($contenido);
}
?>
