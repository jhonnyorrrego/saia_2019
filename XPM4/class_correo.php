<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
include_once($ruta_db_superior.'XPM4/IMAP.php');
include_once($ruta_db_superior."db.php");
/*function date_create($date){
  return($date);
}
function date_parse($date){
  $dato=explode(" ",$date);
  $fecha=explode("-",$dato);
  $hora=explode(":",$dato);
  return(array("year"=>$fecha[2],"mounth"=>$fecha[1],"day"=>$fecha[0]));
}
function date_format($date,$format){
  return($date);
}*/
class correo_saia 
{private $conexion_correo;
 private $usuario;
 private $codigo_usuario;
 private $clave;
 private $puerto;
 private $carpeta;
 private $ip;
 
 function __construct()
   {global $conn; 
    $email=busca_filtro_tabla("valor","configuracion","nombre='servidor_correo'","",$conn); 
    $puerto_correo=busca_filtro_tabla("valor","configuracion","nombre='puerto_servidor_correo'","",$conn); 
    $usuario=busca_filtro_tabla("email,email_contrasena,funcionario_codigo","funcionario","idfuncionario=".usuario_actual("id"),"",$conn);
    if(!$usuario[0]["email"] || !$usuario[0]["email_contrasena"])
      echo "El funcionario no tiene configurados los datos de su correo.<br />"; 
    elseif(!$email[0][0] || !$puerto_correo[0][0])
      echo "No se encuentran configurados los datos del servidor de correo.<br />";
    else
      {$this->puerto=trim($puerto_correo[0][0]);
       $this->ip=trim($email[0][0]);
       $this->usuario=trim($usuario[0]["email"]);
       $this->clave=$usuario[0]["email_contrasena"];
       $this->codigo_usuario=trim($usuario[0]["funcionario_codigo"]);
       $this->verificar_conexion() ;
      }
   }
 function conexion_correcta()
   {if($this->conexion_correo)
      return($this->conexion_correo->get_is_connected());
    else
      return false;  
   }  
 function actualizar_correos($carpeta="")
   {$lista_mensajes=array();
    phpmkr_query("delete from correo_usuario where funcionario=".$this->codigo_usuario);
    $this->seleccionar_carpeta($carpeta);
    $listado=$this->conexion_correo->returnMailBoxHeaderArr();
    //diferencia en segundos con la zona GMT de nosotros
    $serverGMT=intval(date('Z'));
    foreach($listado as $mensaje)
      {if($mensaje["to"]<>"" && date_create($mensaje["date"]))
         {$datos_fecha=date_parse($mensaje["date"]);
          $fecha = date_create($mensaje["date"]);             
          $fechaf=date_format($fecha, 'Y-m-d H:i:s');
          //diferencia en segundos con la zona GMT de la fecha recibida
          $clientGMT=intval(date_format($fecha,"Z"));
          //cambio de zona horaria para que coincida con la de bogota
          if($clientGMT<>$serverGMT)
            $fechaf=gmdate('Y-m-d H:i:s',strtotime($mensaje["date"])+$serverGMT);
          $de=htmlentities($this->decodificar_cabecera($mensaje["from"]));
          $para=htmlentities($this->decodificar_cabecera($mensaje["to"]));
          $asunto=$mensaje["subject"][0]->text; 
          $charset=$mensaje["subject"][0]->charset;
                    
          if($charset=="ISO-8859-1")
            $asunto=iconv("ISO-8859-1","UTF8//TRANSLIT",$asunto);
          elseif($charset<>"default")
             $asunto=utf8_encode(iconv($charset,"ISO-8859-1//IGNORE",$asunto));   
          $sql="insert into correo_usuario(de,para,asunto,fecha,funcionario,idcorreo,codificacion,estado) values('".$de."','".$para."','".$asunto."',".fecha_db_almacenar($fechaf,"Y-m-d H:i:s").",'".$this->codigo_usuario."',".$mensaje["msgno"].",'".$charset."','".$mensaje["status"]."')";        
          phpmkr_query($sql);                 
         }  
      }     
   } 
 function listar_carpetas()
   {
    $listado=$this->conexion_correo->returnMailboxListArr();
    return($listado);
   }   
 function listar_mensaje($id)
   {$listado=$this->conexion_correo->returnEmailMessageArr($id);
    $retorno=$this->parsear_mensaje($listado);
    return($retorno);
   }
  function parsear_mensaje($listado)
   {$charset=$listado["body_charset"];
    $asunto=$listado["header"]["subject"][0]->text;
    $anexos=array();
    $id=$listado["header"]["msgno"];
    if($listado["html"] && strpos($listado["html"],"xmlns:")==false && strpos($listado["html"],"cid:")==false)
      {$contenido=$listado["html"];
      }
    else
      $contenido=$listado["plain"];  
        
    if($charset=="ISO-8859-1")
      {$asunto=iconv("ISO-8859-1","UTF8//TRANSLIT",$asunto);
       $contenido=iconv("ISO-8859-1","UTF8//TRANSLIT",$contenido);
      }
    elseif($charset<>"default")
      {$asunto=utf8_encode(iconv($charset,"ISO-8859-1//IGNORE",$asunto));
       $contenido=utf8_encode(iconv($charset,"ISO-8859-1//IGNORE",$contenido));
      }
    
    if(count($listado["attachments"]))
     {foreach($listado["attachments"] as $fila)
       {$nombre=$this->decodificar_cabecera($fila["name"]);
        $anexos[]=array("parte"=>$fila["part"],'mensaje'=>trim($id),'tipo'=>"adjunto","nombre"=>$nombre);
       }
     }
     if(count($listado["inline"]))
     {foreach($listado["inline"] as $fila)
       {$nombre=$this->decodificar_cabecera($fila["name"]);
        $anexos[]=array("parte"=>$fila["part"],'mensaje'=>trim($id),'tipo'=>"inline","nombre"=>$nombre);
       }
     }
      
    $fecha = date_create($listado["header"]["date"]);
    $clientGMT=intval(date_format($fecha,"Z"));
    $serverGMT=intval(date('Z'));
    if($clientGMT<>$serverGMT)
      $fecha=gmdate('Y-m-d H:i:s',strtotime($listado["header"]["date"])+$serverGMT);
    else
      $fecha=date_format($fecha,"Y-m-d H:i:s");  
    $retorno["fecha"]=$fecha;
    $retorno["de"]=$this->decodificar_cabecera($listado["header"]["from"]);
    $retorno["para"]=$this->decodificar_cabecera($listado["header"]["to"]);
    $retorno["copia"]=$this->decodificar_cabecera($listado["header"]["cc"]);
    $retorno["copia_oculta"]=$this->decodificar_cabecera($listado["header"]["bcc"]);
    $retorno["asunto"]=$asunto;
    $retorno["contenido"]=$contenido;
    $retorno["anexos"]=$anexos;
    $retorno["charset"]=$charset;
    $retorno["carpeta"]=$this->carpeta;
    $retorno["estado"]=$listado["header"]["status"];
    return($retorno);
   } 
  function copiar_mover_mensaje($idmensaje,$carpeta,$tipo)
   {if($tipo=="mover")
     {imap_mail_move($this->conexion_correo->get_stream(), $idmensaje,$carpeta);
      imap_expunge($this->conexion_correo->get_stream());
      phpmkr_query("delete from correo_usuario where idcorreo=".$idmensaje);
     } 
    else //copiar
     {imap_mail_copy($this->conexion_correo->get_stream(), $idmensaje,$carpeta);
      imap_expunge($this->conexion_correo->get_stream());
     } 
   } 
  function marcar_no_leido($idmensaje)
   {imap_clearflag_full($this->conexion_correo->get_stream(), $idmensaje,'\\Seen');
    imap_expunge($this->conexion_correo->get_stream());
    phpmkr_query("update correo_usuario set estado='Unread' where idcorreo=".$idmensaje);
   } 
  function buscar_mensajes($criterios)
   {$resultado=imap_search( $this->conexion_correo->get_stream(), $criterios);
    if(!$resultado)
      return false;
    else
      {$lista=explode(",",$resultado);
       phpmkr_query("delete from correo_usuario where funcionario=".$this->codigo_usuario);
       foreach($resultado as $fila)
         {if($fila<>"")
            {$mensaje=$this->conexion_correo->returnEmailMessageArr($fila);
             $info=$this->parsear_mensaje($mensaje);
             $sql="insert into correo_usuario(de,para,asunto,fecha,funcionario,idcorreo,codificacion,estado) values('".$info["de"]."','".$info["para"]."','".$info["asunto"]."',".fecha_db_almacenar($info["fecha"],"Y-m-d H:i:s").",'".$this->codigo_usuario."',".$fila.",'".$info["charset"]."','".$info["estado"]."')";
             phpmkr_query($sql);     
            }
         }
       return(true);  
      }  
   }    
  function decodificar_cabecera($texto)
   {$listado=array();
    $valor=imap_mime_header_decode($texto);
    foreach($valor as $fila)
      $listado[]=utf8_encode(htmlentities($fila->text));
    return(implode(" ",$listado));   
   } 
  function datos_anexo($parte,$idmensaje)
   {global $conn;
    $retorno=array(); 
    $datos=imap_bodystruct($this->conexion_correo->get_stream(),$idmensaje, $parte);
  	$contenido=imap_fetchbody ($this->conexion_correo->get_stream(), $idmensaje,$parte);
  	$retorno["contenido"]=imap_base64($contenido);
  	$retorno["nombre"]=$datos->dparameters[0]->value;
  	$retorno["extension"]=strtolower($datos->subtype); 
    return($retorno);   
   } 
  function descargar_anexo($parte,$idmensaje)
   {$datos=imap_bodystruct($this->conexion_correo->get_stream(),$idmensaje, $parte);
  	$contenido=imap_fetchbody ($this->conexion_correo->get_stream(), $idmensaje,$parte);
  	$nombre=$datos->dparameters[0]->value;
  	switch (strtolower($datos->subtype)) { 
        case "pdf": $ctype="application/pdf"; break; 
        case "exe": $ctype="application/octet-stream"; break; 
        case "zip": $ctype="application/zip"; break; 
        case "doc": $ctype="application/msword"; break; 
        case "xls": $ctype="application/vnd.ms-excel"; break; 
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break; 
        case "gif": $ctype="image/gif"; break; 
        case "png": $ctype="image/png"; break; 
        case "jpeg": $ctype="image/jpeg"; break; 
        case "jpg": $ctype="image/jpg"; break; 
        default: $ctype="application/force-download"; 
      } 
    header("Content-Type: $ctype");
    header("Content-Disposition: attachment; filename=\"".html_entity_decode($nombre)."\"");
    echo imap_base64 ($contenido);
    exit;
   }
 function seleccionar_carpeta($carpeta)
   {$this->carpeta=$carpeta;
    $this->conexion_correo->change_folder($this->ip,$this->carpeta,$this->puerto);
   }  
 function verificar_conexion()
   {
   	if(!$this->conexion_correo)
     {$this->conexion_correo=new Imap($this->ip,$this->usuario,$this->clave,$this->carpeta,$this->puerto,"ssl");
	 
     if(!$this->conexion_correcta())
       echo "<br />Problemas al conectarse con el servidor. ".imap_last_error();      
     }  
   }    
 function __destruct()
   {if($this->conexion_correo)
      imap_close ($this->conexion_correo->get_stream());
   }
}
