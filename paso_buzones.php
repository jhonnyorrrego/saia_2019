<?php
include_once("db.php");
include_once("calendario/calendario.php");
include_once("class_transferencia.php");
include_once("phpmailer/class.phpmailer.php"); 
include_once("phpmailer/language/phpmailer.lang-es.php");

set_time_limit(0);
function revisar_fechas2($tipo)
  {global $conn;   
       
   switch($tipo)
      {case "gestion":
          $where="documento.estado='APROBADO'";
          break;
       case "central":
          $where="documento.estado='GESTION'";
          break;
       case "historico":
          $where="documento.estado='CENTRAL'";
          break;      
      }
   $_SESSION["LOGIN".LLAVE_SAIA]='cerok';      
   $dias=busca_filtro_tabla("iddocumento,".fecha_db_obtener("fecha",'Y-m-d')." as fecha,numero,".case_fecha('dias',"''",'dias_entrega','dias')." as dias_r,retencion_gestion,retencion_central","documento,serie","serie=idserie and ".$where,"",$conn);   
   if($dias["numcampos"]>0)  
      {$docs=array();
       $datos["nombre"]=strtoupper($tipo);
       $datos["tipo"]="";
       $datos["tipo_origen"]="1";
       $datos["tipo_destino"]="1";
       $radicador=busca_filtro_tabla("funcionario_codigo","funcionario,configuracion","configuracion.nombre='radicador_salida' and configuracion.valor=funcionario.login","",$conn);
       
       for($i=0;$i<$dias["numcampos"];$i++)
          {$fecha_respuesta=dias_habiles($dias[$i]["dias_r"],'Y-m-d',$dias[$i]["fecha"]); 
           if($tipo=="central")
              {$fecha_final=busca_filtro_tabla(suma_fechas(fecha_db_almacenar($fecha_respuesta,'Y-m-d'),$dias[$i]["retencion_gestion"],'YEAR')." as final","","","",$conn);
               $fecha_respuesta=$fecha_final[0]["final"];
              }
           elseif($tipo=="historico")
              {$fecha_final=busca_filtro_tabla(suma_fechas(fecha_db_almacenar($fecha_respuesta,'Y-m-d'),$dias[$i]["retencion_gestion"]+$dias[$i]["retencion_central"],'YEAR')." as final","","","",$conn); 
               $fecha_respuesta=$fecha_final[0]["final"];
              }
           $dias2=busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_respuesta,'Y-m-d'),"")." as respuesta","","","",$conn); 
          
           if($dias2[0][0]<0)
              {$sql="UPDATE documento SET estado='".strtoupper($tipo)."' WHERE iddocumento=".$dias[$i]["iddocumento"];
              //echo "***************** ".$sql;                           
              phpmkr_query($sql,$conn);               
              $datos["archivo_idarchivo"]=$dias[$i]["iddocumento"];
              $datos["origen"]=$radicador[0][0];
              $destino[0]=$radicador[0][0];
              transferir_archivo_prueba($datos,$destino,'');
               /*for($j=0;$j<$buzones["numcampos"];$j++)
                  {$datos["archivo_idarchivo"]=$dias[$i]["iddocumento"];
                   $datos["origen"]=$buzones[$j]["origen"];
                   $destino[0]=$buzones[$j]["origen"];
                   transferir_archivo_prueba($datos,$destino,'');
                  }*/              
              }
          }
      }  
  }

function guardar_evento_archivo()
{ global $conn;
  $ruta_log = busca_filtro_tabla("valor","configuracion","nombre='ruta_log'","",$conn);  
  $nombre=$ruta_log[0]["valor"]."/".DB."_log_".date("Y-m-d");
  $cadena ="";
  //die("SELECT * FROM evento INTO OUTFILE \"".$nombre."\" FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n\r';");
  if(!(ejecuta_sql("SELECT * FROM evento INTO OUTFILE \"".$nombre.".txt\" FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n\r';",$conn)))  
  { //ejecuta_sql("truncate evento",$conn);
    $rs=$conn->Ejecutar_Sql("truncate evento");
    //alerta("Se exporto la tabla evento satisfactoriamente");
  }  
  //else
//    alerta("Error al exportar la tabla");  
 return true;     
}

 function pendientes_correo($hora)
  { global $conn;    
    /*include_once("mensajeria/class.jabber.envio.php");
    if (!$jab->connect(JABBER_SERVER)) {
      alerta("No se puede conectar al servicio de Mensajeria");
      }
      // now, tell the Jabber class to begin its execution loop
      $jab->execute(CBK_FREQ,RUN_TIME);
       */
    if($hora==2)
    { $calculo = strtotime("-1 days");
      $fecha_aux = date("Y-m-d 12:45:00", $calculo);
      $limit = date("Y-m-d");
    }
    else
    { $fecha_aux = date("Y-m-d");
      $limit = date("Y-m-d 12:45:00");
    }   
   
    $pend = busca_filtro_tabla("llave_entidad,documento_iddocumento","asignacion,documento","documento_iddocumento=iddocumento and documento.estado not in('ELIMINADO','INICIADO') and tarea_idtarea=2 and asignacion.estado='PENDIENTE' and fecha_inicial >= '".$fecha_aux."' and fecha_inicial <= '".$limit."'","llave_entidad,fecha_inicial",$conn);
    
    for($i=0; $i<$pend["numcampos"]; $i++)
    {
     $correo=false;
     if($i==0 || ($pend["numcampos"]-1)==$i)
      $correo=true;    
      
     envio_correo($pend[$i]["llave_entidad"],$pend[$i]["documento_iddocumento"],@$jab,$correo);
     //envio_correo($pend[$i]["llave_entidad"],$pend[$i]["documento_iddocumento"]);
    }    
    //$jab->disconnect(); 
  // alerta("Envio exitoso");
   return true;
  }
   function envio_correo($cod,$iddoc,$jab,$correo )
  {   
   global $conn;
   $dato = array();
   $doc = busca_filtro_tabla("numero,descripcion,plantilla,fecha","documento","iddocumento=$iddoc","",$conn);
   //print_r($doc);
   $buzon = busca_filtro_tabla("origen,fecha","buzon_salida","archivo_idarchivo=$iddoc and nombre in('TRANSFERIDO','APROBADO','REVISADO','DEVOLUCION') and destino=$cod","idtransferencia DESC",$conn);
   $fun = busca_filtro_tabla(concatenar_cadena_sql(array("nombres","' '","apellidos"))." as nombre","funcionario","funcionario_codigo=".$buzon[0]["origen"],"",$conn);
   $login = busca_filtro_tabla("login","funcionario","funcionario_codigo=".$cod,"",$conn);
      
   $texto2 = "
   Tiene un nuevo documento para su revision
   Numero de Radicado:".$doc[0]["numero"]." ".$doc[0]["plantilla"]."
   Fecha Documento: ".$doc[0]["fecha"]."
   Fecha Transferencia: ".$buzon[0]["fecha"]."
   Asunto: ".$doc[0]["descripcion"]."
   Remitente: ".$fun[0]["nombre"]."
    
   Antes de imprimir este mensaje, aseg&uacute;rese que es necesario.
   Proteger el medio ambiente tambi&eacute;n est&aacute; en nuestras manos.";
   
   //$jab->message($login[0]["login"]."@".JABBER_SERVER,"chat",NULL,codifica_encabezado(html_entity_decode($texto2)));
   
   $texto = "Tiene un nuevo documento para su revision<br />
   Numero de Radicado:".$doc[0]["numero"]." ".$doc[0]["plantilla"]."<br />
   Fecha Documento: ".$doc[0]["fecha"]."<br />
   Fecha Transferencia: ".$buzon[0]["fecha"]."<br />
   Asunto: ".$doc[0]["descripcion"]."<br />
   Remitente: ".$fun[0]["nombre"]."<br /><br /><hr> 
   Antes de imprimir este mensaje, aseg&uacute;rese que es necesario.<br />Proteger el medio ambiente tambi&eacute;n est&aacute; en nuestras manos.";     
  
   $mail = new PHPMailer ();
   $mail->ClearAddresses();
   //$mail->AddAddress("andreagallego@gmail.com", $login);
   $mail->AddAddress($login[0]["login"]."@camarapereira.org.co", $login[0]["login"]);
             
   $mail->Subject = "Gestion de Archivos - SAIA ".$login[0]["login"];
   $mail->MsgHTML($texto);     
   $mail->Body = $texto; 
   $mail -> IsHTML (true);
   $mail->IsSMTP();
   $mail->Host = 'ssl://smtp.gmail.com';
   $mail->Port = 465;
   $mail->SMTPAuth = true;
   $mail->Username = 'noreply@camarapereira.org.co';
   $mail->Password = 'Enero12*';             
   if(!$mail->Send())
   {//$log.="error en correo electronico: ".$login[0]["login"].$texto."\n\r";
    Alerta("Existe un error al hacer la notificacion por correo");          
   }
   
   //$log.="correo electronico: ".$login[0]["login"].$texto."\n\r";
   if($correo)
   {
     $mail = new PHPMailer ();
     $mail->ClearAddresses();
     $mail->AddAddress("noreply@camarapereira.org.co", "notificaciones@cerok.com");                
     $mail->Subject = "Tiempo Correos  - SAIA";
     $mail->MsgHTML("Inicio - Fin envio de correo".date('Y-m-d H:i:s'));     
     $mail->Body = "Inicio - Fin envio de correo".date('Y-m-d H:i:s');             
     if(!$mail->Send())
     {
      Alerta("Existe un error al hacer la notificacion por correo");          
     }
   }  
   return true;
  }
  
  //Nuevo de notificacion de documentos atrasados
function envio_correo_atrasados($login,$cuerpo,$nombre)
{global $log;    
   $mail = new PHPMailer ();
   $mail->ClearAddresses();
   $mail->AddAddress($login."@camarapereira.org.co", $login);        
   $mail->Subject = "Gestion de Archivos - SAIA $login";
   $mail -> Body = $cuerpo;
   $mail -> IsHTML (true);
   $mail->IsSMTP();
   $mail->Host = 'ssl://smtp.gmail.com';
   $mail->Port = 465;
   $mail->SMTPAuth = true;
   $mail->Username = 'noreply@camarapereira.org.co';
   $mail->Password = 'Enero12*';            
   if(!$mail->Send()) {
     echo 'Error: ' . $mail->ErrorInfo;
    } 
   
 return true;  
}
  
function documentos_atrasados()
{ global $conn,$log;  
$funcionarios = busca_filtro_tabla("funcionario_codigo,login,nombres,apellidos","funcionario","estado=1 and sistema=1","nombres,apellidos",$conn);
for($i=0; $i<$funcionarios["numcampos"]; $i++)
{
 $nombre= $funcionarios[$i]["nombres"]." ".$funcionarios[$i]["apellidos"];
 $login = $funcionarios[$i]["login"];
 $fun = $funcionarios[$i]["funcionario_codigo"];
 $where = "documento_iddocumento=iddocumento and documento.estado NOT IN('ELIMINADO') and (asignacion.entidad_identidad = 1 AND asignacion.llave_entidad = ".$fun." and tarea_idtarea=2 and asignacion.estado='PENDIENTE')";
  $dias1=busca_filtro_tabla("DISTINCT iddocumento,".fecha_db_obtener("documento.fecha",'Y-m-d')." as fecha,numero,".case_fecha('dias',"''",'dias_entrega','dias')." as dias_r,documento.estado,documento.numero,documento.plantilla,documento.descripcion","asignacion,documento left join serie on serie=idserie",$where,"fecha DESC",$conn);
 $texto1=""; 
 $cuerpo =""; 
 $cont=0; 
 //echo $dias1["sql"]." aaaa <br />";
 for($j=0; $j<$dias1["numcampos"]; $j++)
 { 
  $seguimiento = true;
  
  if($seguimiento)
  {
    $estado = ""; 
    $cadena = ""; 
  if($dias1[$j]["estado"]=='APROBADO')
   $estado=$dias1[$j]["estado"];
  if($dias1[$j]["dias_r"]<>"")
  {       
   $fecha_f=dias_habiles($dias1[$j]["dias_r"],'Y-m-d',$dias1[$j]["fecha"]);       
   $dias2=busca_filtro_tabla(resta_fechas(fecha_db_almacenar($fecha_f,'Y-m-d'),"")." as respuesta","","","",$conn);   
   if($dias2["numcampos"])
   { $dias=intval(ceil($dias2[0]["respuesta"]));   
     if(!$dias1[$j]["plantilla"]!="")
      $dias1[$j]["plantilla"]="R-ENTRADA";          
     
      if($dias <= 2)
      { $cont++;
        $esp = " dias Atrasados";
        if($dias >= 0 )
         $esp = " dias";
        $texto1 .= "<tr><td>".$cont."</td><td>".$dias1[$j]["numero"]."</td><td>".$dias1[$j]["plantilla"]."</td><td>".$dias1[$j]["descripcion"]."</td><td>".$dias1[$j]["fecha"]."</td><td>".$dias.$esp."</td><td>".$fecha_f."</td></tr>";
      }    
   }
   else
    $texto4.= "<tr><td>".$dias1[$j]["numero"]."</td><td>".$dias1[$j]["plantilla"]."</td><td>".$dias1[$j]["descripcion"]."</td><td>".$dias1[$j]["fecha"]."</td></tr>";
   }  
  }  
 }
 
  if($texto1 != "")
     $cuerpo .= "<br /><table border='1'><tr><td></td><td>NUMERO</td><td>PLANTILLA</td><td>DESCRIPCION</td><td>FECHA RADICADO</td><td>DIAS</td><td>FECHA VENCIMIENTO</td></tr>".$texto1."</table><br /><br />";
  if($texto4 != "")
   $cuerpo .= "Documentos sin serie documental:<br /><table border='1'><tr><td>NUMERO</td><td>PLANTILLA</td><td>DESCRIPCION</td><td>FECHA RADICADO</td></tr>".$texto4."</table><br /><br />";   
 if($cuerpo != "")
  envio_correo_atrasados($login,"Usuario(a) $nombre: <br /> A continuaci&oacute;n recibe la relaci&oacute;n de los documentos que tiene en su bandeja de pendientes a hoy en  SAIA que ya cumplieron su tiempo o est&aacute;n por cumplirlo. Por favor recuerde terminar el proceso de cada documento. <br /> Este correo es enviado desde el servidor de la aplicaci&oacute;n de SAIA, por favor no lo responda.<br /><br /> ".$cuerpo." <br /><br />Antes de imprimir este mensaje, aseg&uacute;rese que sea necesario.<br />Proteger el medio ambiente tambi&eacute;n est&aacute; en nuestras manos.",$nombre);  
}     
 return true; 
}
  //Fin Nuevo de notificacion de documentos atrasados

function borrar_archivos_carpeta($dir, $deleteRootToo) 
{ 
    if(!$dh = @opendir($dir)) 
    { 
        return; 
    } 
    while (false !== ($obj = readdir($dh))) 
    { 
        if($obj == '.' || $obj == '..') 
        { 
            continue; 
        } 

        if (!@unlink($dir . '/' . $obj)) 
        {   
            borrar_archivos_carpeta($dir.'/'.$obj, true); 
        }  
      // echo "borrado ".$dir.'/'.$obj."...<br />";
    }
    closedir($dh); 
    //para borrar la carpeta raiz tambien
    if ($deleteRootToo) 
    { 
        @rmdir($dir); 
    }
     return; 
}

function limpieza_temporales()
{
 borrar_archivos_carpeta("html2ps/public_html/cache",0);
 borrar_archivos_carpeta("html2ps/public_html/temp", 0);
 borrar_archivos_carpeta("temporal", 0); 
}  
$log="";
 if(date('Y-m-d H:i:s') < date('Y-m-d 03:00:00')) //3am
  { limpieza_temporales();
    revisar_fechas2("gestion"); 
    revisar_fechas2("central");
    revisar_fechas2("historico");
    //guardar_evento_archivo();
    pendientes_correo(2);    
    documentos_atrasados(); 
  }
 else //1pm            
  pendientes_correo(1);   
    
?>
