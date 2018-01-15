<?php
include_once('db.php');
$accion= $_REQUEST['func'];

switch ($accion) {
case 0:  // El documento se va a activar  
        $iddocumento= @$_REQUEST['key'];
        desactiva($iddocumento) or alerta("No se pudo DESACTIVAR EL DOCUEMNTO");
         break;
case 1:  // Se trata de Activar un documento por numero de radicado
        activa($_REQUEST['key']) or alerta("No se pudo ACTIVAR EL DOCUMENTO verifique el numero de radicado");
        
        break;
/*case 3: // el documento se va a anular
        anular($_REQUEST['key']) or alerta("No se pudo Anular el documento verifique el numero de radicado");
        break;   */          
default:
	
	break;
}

abrir_url("pantallas/buscador_principal.php?idbusqueda=22","centro");
/*
<Clase>
<Nombre>activa</Nombre> 
<Parametros>$iddoc:identificador del documento</Parametros>
<Responsabilidades>cambia de estado al documento por ACTIVO, borra el campo de PDF y activa_admin con valor 1<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones><Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function activa($iddoc)
{ global $conn;
  registrar_accion_digitalizacion($iddoc,'ACTIVA DOCUMENTO');
  $sql="UPDATE documento
   SET documento.estado  = 'ACTIVO',documento.pdf='',documento.activa_admin= '1' 
  WHERE documento.iddocumento=$iddoc";  
  phpmkr_query($sql,$conn);
  $permiso_doc=busca_filtro_tabla("","permiso_documento","documento_iddocumento=".$iddoc,"",$conn);
  if(!$permiso_doc["numcampos"]){
      $doc=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
      $sql1="INSERT INTO permiso_documento (funcionario, documento_iddocumento, permisos) VALUES ('".$doc[0]["ejecutor"]."','".$iddoc."','e,m,r')";
      phpmkr_query($sql1);
  }
       return (TRUE);  
}

/*
<Clase>
<Nombre>desactiva</Nombre> 
<Parametros>$iddocumento:identificador del documento</Parametros>
<Responsabilidades>coloca el documento en Aprobado y activa_admin en 0 y recrea el pdf<Responsabilidades>
<Notas></Notas>
<Excepciones></Excpciones>
<Salida></Salida>
<Pre-condiciones>el estado del documento debe ser activo y activa_admin en 1<Pre-condiciones>
<Post-condiciones><Post-condiciones>
</Clase>
*/
function desactiva($iddocumento)
{ global $conn;
 $res= busca_filtro_tabla("documento.iddocumento,tipo_radicado","documento","documento.iddocumento='$iddocumento' AND documento.estado = 'ACTIVO' AND documento.activa_admin='1'","",$conn); 
 if($res["numcampos"])
   {  
     $sql="UPDATE documento
       SET documento.estado  = 'APROBADO',documento.activa_admin= '0' 
     WHERE documento.iddocumento = '$iddocumento'
        AND  documento.estado = 'ACTIVO' AND  documento.activa_admin = '1' " ;   
     phpmkr_query($sql,$conn);
     registrar_accion_digitalizacion($iddocumento,'DESACTIVA DOCUMENTO');
     if($res[0]["tipo_radicado"]>1)
         redirecciona("borrar_pdf.php?iddoc=$iddocumento");
      else
        return(true);   
  }
  return (FALSE); 
}
?>
