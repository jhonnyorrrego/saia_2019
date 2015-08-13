<?php
function chechbox_despacho($iddoc)
{global $conn;
 $cadena='';
  $despacho=busca_filtro_tabla("A.numero_guia,B.tipo_despacho","salidas A, documento B","B.iddocumento=".$iddoc." AND A.documento_iddocumento=B.iddocumento","",$conn);  

 if($despacho["numcampos"] && ($despacho[0]["tipo_despacho"]==1 || $despacho[0]["tipo_despacho"]==2 || $despacho[0]["tipo_despacho"]==3)){

    switch($despacho[0]["tipo_despacho"]){
      case 1://mensajeria Externa genera salida 
        $cadena.=("Guia:".$despacho[0]["numero_guia"]);
      break;
      case 2://Mensajeria Interna enviada con mensajero.
        $cadena.=("Mensajeria Interna");
      break;  
      case 3: //Personal enviada con el ejecutor.
        $cadena.=("Personal");
      break;     
    }  
  }
  else{
  $doc=busca_filtro_tabla("A.numero,tipo_radicado","documento A","A.iddocumento=$iddoc","",$conn);
  if($doc["numcampos"] && !$doc[0]["numero"]){
    $cadena.=("En Tr&aacute;mite");
    }
  elseif($doc[0]["tipo_radicado"]>1)
    $cadena.= "<input type=checkbox name='despachar_$iddoc'>";

  }
 return(addslashes($cadena));  
}
function checkbox_expediente($iddoc)
{$cadena= "<input type=checkbox name='expediente_$iddoc'>";
 return(addslashes($cadena));  
}
function checkbox_vincular_documento($iddoc)
{$cadena= "<input type=checkbox name='vincular_documento_$iddoc'>";
 return(addslashes($cadena));  
}
?>