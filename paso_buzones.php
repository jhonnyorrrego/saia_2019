<?php
include_once("db.php");
include_once("pantallas/lib/librerias_cripto.php");

$filtro_seguridad=seguridad_externa(@$_REQUEST['data']);
if($filtro_seguridad){  //pasa filtro de seguridad
	
	set_time_limit(0);
	
	function documentos_pendientes(){
	global $conn;  
	    $excluidos=array("radicador_salida","cerok","radicador_web");
		$where_excluidos='';
	    if(count($excluidos)){
	    	//$where_excluidos=" AND login NOT IN('".implode("','",$excluidos)."')";
	    	$where_excluidos=" AND login = 'cerok'";
	    }  
	    $pendientes=busca_filtro_tabla("llave_entidad,COUNT(llave_entidad) as cant","documento a,asignacion b","(lower(a.estado)<>'eliminado' and a.iddocumento=b.documento_iddocumento and b.tarea_idtarea<>-1 and b.entidad_identidad=1 ) group by llave_entidad","",$conn); 
	    for($i=0;$i<$pendientes['numcampos'];$i++){
			$funcionario=busca_filtro_tabla("nombres,apellidos,email","vfuncionario_dc","estado=1 and funcionario_codigo=".$pendientes[$i]['llave_entidad'].$where_excluidos,"",$conn);
			
	        $cuerpo="";
	       
	        unset($usuario);
	        if($funcionario['numcampos'] && $funcionario[0]['email']){
	            $nombre=$funcionario[0]['nombres']." ".$funcionario[0]['apellidos'];
	            
	            $cuerpo="<table align='center' border=1 style='border-collapse:collapse'>
	            <tr bgcolor='D8D8D8' align='center' colo> <td style='width:20%'>Fecha</td> <td style='width:10%'>Radicado</td> <td style='width:20%'>Formato</td> <td style='width:50%'>Descripcion</td> </tr>";
	            $pendientesUsuario=busca_filtro_tabla("a.fecha,a.estado,a.ejecutor,a.descripcion,a.tipo_radicado,a.plantilla,a.numero,a.tipo_ejecutor,".fecha_db_obtener('b.fecha_inicial', 'Y-m-d H:i:s')." as fecha_inicial,a.iddocumento","documento a,asignacion b","(lower(a.estado)<>'eliminado' and a.iddocumento=b.documento_iddocumento and b.tarea_idtarea<>-1 and b.entidad_identidad=1 and b.llave_entidad='".$pendientes[$i]['llave_entidad']."')","a.fecha desc",$conn);
	            
	            for($j=0;$j<$pendientesUsuario['numcampos'];$j++){
	                $cuerpo.="<tr>";
	                    $nombreFormato="";
	                    if($pendientesUsuario[$j]['plantilla']!=""){
	                        $plantilla=busca_filtro_tabla("etiqueta","formato","lower(nombre)='".$pendientesUsuario[$j]['plantilla']."'","",$conn);
	                        
	                        if($plantilla['numcampos']){
	                            $nombreFormato=$plantilla[0]['etiqueta'];
	                        }
	                    }
	                $cuerpo.="<td>".$pendientesUsuario[$j]['fecha_inicial']."</td> <td style='text-align:center'>".$pendientesUsuario[$j]['numero']."</td> <td>".$nombreFormato."</td> <td>".$pendientesUsuario[$j]['descripcion']."</td>";
	                $cuerpo.="</tr>";
	            }
	            $cuerpo.="</table>";
				
	            $mensaje="Usuario(a) ".$nombre.": <br />
	            En el sistema de gesti&oacute;n documental SAIA, usted tiene ".$pendientesUsuario['numcampos']." documentos en la bandeja de pendientes. Favor revisar y dar tr&aacute;mite a los documentos de tal forma que se pueda continuar con el normal desarrollo de la gesti&oacute;n documental a trav&eacute;s del sistema. <br /><br /><br />"
	            .$cuerpo.
	            "<br /><br />Agradecemos tener en cuenta esta recomendaci&oacute;n<br /><br />Antes de imprimir este mensaje, aseg&uacute;rese que sea necesario. Proteger el medio ambiente tambi&eacute;n est&aacute; en nuestras manos.";  
	            $usuario=array();
	            $usuario[]=$pendientes[$i]['llave_entidad'];
	            
	            enviar_mensaje("","codigo",$usuario,"Documentos Pendientes",$mensaje,"e-interno");
	        }
	    }     
	}
	
	$fecha_actual=date("Y-m-d H:i:s");
	$log="";
	documentos_pendientes(); 

}
?>