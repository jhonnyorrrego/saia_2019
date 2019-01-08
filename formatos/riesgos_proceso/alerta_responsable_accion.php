<?php
@set_time_limit(0);
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."db.php");

	$acciones=busca_filtro_tabla(fecha_db_obtener('d.fecha','Y-m-d')."as fecha, TO_DATE(TO_CHAR(a.fecha_cumplimiento,'YYYY-MM-DD'),'YYYY-MM-DD')-TO_DATE('".date('Y-m-d')."','YYYY-MM-DD') as resta, a.reponsables, d.numero","ft_ft_acciones_riesgo a, documento d","a.documento_iddocumento=d.iddocumento and d.estado not in ('ANULADO','ELIMINADO','ACTIVO')","",$conn);
	if($acciones){
		
		for ($i=0; $i < $acciones["numcampos"] ; $i++) {
			if($acciones[$i]["resta"]==15 || $acciones[$i]["resta"]==10 || $acciones[$i]["resta"]==5){
				$contenido="Revisar la accion con radicado ".$acciones[$i]["numero"].", esta a punto de vencerse o ya fue vencido, por favor dar por cumplida la accion.";
				$responsables=traer_correos($acciones[$i]["reponsables"]);
				enviar_email_accion($responsables,$contenido);
			}
		}
	}
	
function traer_correos($valor){
	global $conn;
	$emails=array();
	$vector=explode(",",str_replace("#","d",$valor));
    $vector=array_unique($vector);
    sort($vector);
	foreach($vector as $fila){
		if(strpos($fila,'d')>0){
          	$datos=busca_filtro_tabla("b.email","dependencia_cargo a, funcionario b","dependencia_iddependencia=".str_replace("d","",$fila)." and a.estado=1 and b.estado=1 and a.funcionario_idfuncionario=b.idfuncionario","",$conn);
          	$emails=array_merge($emails,extrae_campo($datos,"email"));
        }
        else{
        	if($pos=strpos($fila,"_"))
          		$fila=substr($fila,0,$pos);
        	$datos=busca_filtro_tabla("email","funcionario","funcionario_codigo='".$fila."'","",$conn);
        	$emails[]=$datos[0]["email"];
        }
    }
	
	return $emails;
}


function enviar_email_accion($correos,$contenido){
	global $conn; 
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
   	define('DISPLAY_XPM4_ERRORS', true);
   	require_once $ruta_db_superior.'XPM4/MAIL.php';
   	$mail= new MAIL;

   	$copia = array();	
   	$email=busca_filtro_tabla("valor","configuracion","nombre='servidor_correo'","",$conn);   	
   	$puerto_correo=busca_filtro_tabla("valor","configuracion","nombre='puerto_servidor_correo'","",$conn);
	$notificador=busca_filtro_tabla("","configuracion","nombre='usuario_envio_correo'","",$conn);
	$clave=busca_filtro_tabla("","configuracion","nombre='clave_envio_correo'","",$conn);
	
	if($email["numcampos"]){
		$mail->Subject("Vencimiento de la accion de riesgos");
		$cant_des=count($correos);
		for($i=0;$i<$cant_des;$i++){
			if($correos[$i]!=''){
				$mail->AddTo($correos[$i]);
			}
		}


	   	$contenido=pc_html2ascii_hallazgo($contenido);
	   	$mail->Text($contenido);
		$from = $notificador[0]["valor"];
       	$mail->From($from);
   
		$nombre_email= $notificador[0]["valor"];
		$contrasena= $clave[0]["valor"];
		
		$id = MIME::unique();
		
		$c = $mail->Connect('smtp.gmail.com', 465, $nombre_email, $contrasena, 'tls', 10, 'localhost', null, 'plain')or die(print_r($mail->Result)."No se puede enviar el correo electronico por favor revise con el administrador los datos de acceso");

		if(!$mail->Send($c)){
        	alerta("No fue enviado el mensaje, configure los datos de su servidor de correo");
        }    
		
		
		$usuario=usuario_actual("id");
		$datos2 = busca_filtro_tabla("email,clave_correo,login,clave","funcionario","idfuncionario=".$usuario,"",$conn); 
		
		$datos2["archivo_idarchivo"]=$_REQUEST["iddoc"];
        $datos2["tipo_destino"]=1;
        $datos2["tipo"]="";
        $datos2["nombre"]="DISTRIBUCION";    
   }
}


function pc_html2ascii_hallazgo($s){
// convert links
$s = preg_replace('/<a\s+.*?href="?([^\" >]*)"?[^>]*>(.*?)<\/a>/i',
'$2 ($1)', $s);
// convert <br>, <hr>, <p>, <div> to line breaks
$s = preg_replace('@<(b|h)r[^>]*>@i',"\n",$s);
$s = preg_replace('@<p[^>]*>@i',"\n\n",$s);
$s = preg_replace('@<div[^>]*>(.*)</div>@i',"\n".'$1'."\n",$s);
// convert bold and italic
$s = preg_replace('@<b[^>]*>(.*?)</b>@i','*$1*',$s);
$s = preg_replace('@<i[^>]*>(.*?)</i>@i','/$1/',$s);
// decode named entities
$s = strtr($s,array_flip(get_html_translation_table(HTML_ENTITIES)));
// decode numbered entities
$s = preg_replace('//e','chr(\\1)',$s);
// remove any remaining tags
$s = strip_tags($s);
return $s;
}

?>