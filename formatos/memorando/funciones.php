<?php
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
include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
function lista_destinos($idformato,$iddoc=NULL){
 global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("destino,".fecha_db_obtener("fecha_".$datos[0]["nombre"],"Y-m-d"),$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 
 $destinos=explode(",",$resultado[0]["destino"]);
 $nombres=array();
 $lista=array();
 foreach($destinos as $fila){
 	 
     if(strpos($fila,'#')>0){
	     	$datos=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$fila),"",$conn);
	      $roles = busca_filtro_tabla("distinct funcionario_idfuncionario,iddependencia_cargo","dependencia_cargo","dependencia_iddependencia=".str_replace("#","",$fila),"",$conn);
	
	      if($roles["numcampos"]==1){
	      	$lista[]=cargos_memo($roles[0]["iddependencia_cargo"],$resultado[0]["fecha_memo"],"para",5);
	      }else{
	      	$lista[]=ucwords($datos[0]["nombre"]);
	      }
		 }else{
       $lista[]=cargos_memo($fila,$resultado[0]["fecha_".$datos[0]["nombre_tabla"]],"para",5);
     }
    }
 
 foreach ($lista as $value) {
 	$des = explode(',', $value);
  if(sizeof($des)> 1){
  	echo(''.$des[0].'<br />');
		echo($des[1]);
  }else{
  	echo(''.$des[0].'');
  }
	echo('<br />');
 }
 
 /*$funcionario_cargo = explode(',',$lista[1]);
 echo('<b>'.$funcionario_cargo[0].'</b><br />'); 
 echo($funcionario_cargo[1].'<br />');
 //echo($lista[0]);*/   
}

function jerarquia_destinos($lista,$fecha)
{ global $conn;
 $hijo="";
 $list = implode(",",$lista);
  $cargos= busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre","cargo,dependencia_cargo,funcionario","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list) and (fecha_inicial <= ".fecha_db_almacenar($fecha,"Y-m-d")." and fecha_final >= ".fecha_db_almacenar($fecha,"Y-m-d").")","GROUP by funcionario_codigo order by codigo_cargo ASC",$conn); 
  if(!$cargos["numcampos"])
    $cargos= busca_filtro_tabla("funcionario_codigo,nombres,apellidos,nombre","cargo,dependencia_cargo,funcionario","cargo_idcargo=idcargo and funcionario_idfuncionario=idfuncionario and funcionario_codigo in ($list)","iddependencia_cargo desc",$conn); 
  if($cargos["numcampos"]>0)
  for($i=0; $i<$cargos["numcampos"]; $i++) 
    $hijo .= $cargos[$i]["nombres"]."  ".$cargos[$i]["apellidos"]." - ".$cargos[$i]["nombre"]."<br />";  
 echo $hijo; 
 return(true);  
}



function mostrar_origen($idformato,$iddoc=NULL){
	global $conn;
 $formato=busca_filtro_tabla("nombre_tabla,nombre","formato","idformato=$idformato","",$conn);
 $resultado=busca_filtro_tabla("dependencia,".fecha_db_obtener("b.fecha","Y-m-d")." as fecha",$formato[0]["nombre_tabla"].",documento b","documento_iddocumento=iddocumento and documento_iddocumento=$iddoc","",$conn);  
 $origen = explode(',',$resultado[0]["dependencia"]);  
 for($i=0; $i<count($origen); $i++){
 	$dependencia=busca_filtro_tabla("C.nombre,D.nombres,D.apellidos","dependencia_cargo A, cargo B, dependencia C,funcionario D","A.iddependencia_cargo=".$origen[$i]." AND D.idfuncionario=A.funcionario_idfuncionario AND B.idcargo=A.cargo_idcargo AND A.dependencia_iddependencia=C.iddependencia AND A.estado=1","",$conn);	 
     echo(''.$dependencia[0]["nombre"]."<br />");
	}

}

function mostrar_copias_memo($idformato,$iddoc=NULL)
{global $conn;
 $datos=busca_filtro_tabla("nombre,nombre_tabla","formato","idformato=$idformato","",$conn);
 $inf_memorando=busca_filtro_tabla("copia",$datos[0]["nombre_tabla"],"documento_iddocumento=$iddoc","",$conn);
 if($inf_memorando[0]["copia"]<>"")
    {echo '<span>Copia: ';
     $destinos=explode(",",$inf_memorando[0]["copia"]);
     $destinos=array_unique($destinos);
     sort($destinos);
     $lista=array();
        	for($i=0;$i<count($destinos);$i++) 
            {//si el destino es una dependencia
             if(strpos($destinos[$i],"#")>0)
                {$resultado=busca_filtro_tabla("nombre","dependencia","iddependencia=".str_replace("#","",$destinos[$i]),"",$conn);
                 $lista[]=ucwords($resultado[0]["nombre"]); 
                }
             else//si el destino es un funcionario
                {$resultado=busca_filtro_tabla("funcionario_codigo,nombres,idfuncionario,apellidos,c.nombre","funcionario,cargo c,dependencia_cargo dc","dc.cargo_idcargo=c.idcargo and dc.funcionario_idfuncionario=idfuncionario and iddependencia_cargo=".$destinos[$i],"",$conn);                 
                 $lista[]=ucwords(strtolower($resultado[0]["nombres"]." ".$resultado[0]["apellidos"]));
                }
            }    
     echo implode(", ",$lista);       
     echo '</span><br/>';
}
}

function nomenclatura($idformato,$iddoc=NULL)
{global $conn;
  $datos=busca_filtro_tabla("dependencia,fecha","ft_memorando, documento","iddocumento=documento_iddocumento and documento_iddocumento=$iddoc","",$conn);
  
 $resultado=busca_filtro_tabla("c.nombre,c.iddependencia ","dependencia c,dependencia_cargo dc","c.iddependencia =dc.dependencia_iddependencia  and dc.iddependencia_cargo=".$datos[0]["dependencia"],"",$conn);   
 $nueva_fecha=date_parse($datos[0]["fecha"]);

  $comp = strlen($nueva_fecha["month"]);
  if($comp==1){
  
  $nueva="0".$nueva_fecha["month"];
  }else {
  
  $nueva=$nueva_fecha["month"];
  
  }
  
  
 if($resultado[0]["iddependencia"]==4){
  $texto="DNC-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 } 
 if($resultado[0]["iddependencia"]==5){
   $texto="DPI-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 }  
 if($resultado[0]["iddependencia"]==6){
   $texto="GAF-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"]; 
 }
 
 if($resultado[0]["iddependencia"]==7){
  $texto="GMC-".$nueva_fecha["day"].$nueva.$nueva_fecha["year"];
 }
 echo($texto);
}
function organizar_imagenes($idformato,$iddoc){
	global $conn;
	include_once("../librerias/funciones_generales.php");
	registrar_imagenes_documento($idformato,$iddoc,'contenido');
}
function mostrar_imagenes_escaneadas_memo($idformato)
{ 
  global $conn;
  $formato = busca_filtro_tabla("","formato","idformato=".$idformato." and detalle=1","",$conn); 
  if(isset($_REQUEST["anterior"]) && $_REQUEST["anterior"]!="" && $formato["numcampos"] == 0)
  { 
   $doc = $_REQUEST["anterior"];
   $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","",$conn);
   echo "<b>Se est&aacute; dando respuesta al documento: </b>&nbsp;&nbsp;".$doc_anterior[0]["numero"]." ".$doc_anterior[0]["descripcion"]."<br /><br />";  
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
   $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,"",$conn); 
    $codigo="";
    if($imagenes<>"")
       { 
        echo '<div id="mainContainer">
              <div id="content">';                 
         for($i=0; $i<$imagenes["numcampos"]; $i++)
          { ?>                
          		<a href="#" onclick="displayImage('<?php echo "../../".$imagenes[$i]["ruta"]?>','P&aacute;gina <?php echo $imagenes[$i]["pagina"]?>.','');return false"><img src="<?php echo "../../".$imagenes[$i]["imagen"]?>" border="1"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
           if($imagenes[$i]["pagina"]==(round($imagenes[$i]["pagina"]/8)*8))
            echo "<br><br>";
          }
          echo "</div></div>";
       }
   echo "<HR>";
 }
else if($_REQUEST["iddoc"]){
	$doc = $_REQUEST["iddoc"];
    $doc_anterior = busca_filtro_tabla("descripcion,numero","documento","iddocumento=$doc","",$conn);
     
   //Si el documento tiene imagenes escaneadas las muestra antes del formato de respuesta
    $imagenes=busca_filtro_tabla("consecutivo,imagen,ruta,pagina","pagina","id_documento=".$doc,"",$conn); 
    $codigo="";
    if($imagenes["numcampos"] > 0)
       {
       	echo "<b>Documentos escaneados<br /><br />"; 
        echo '<div id="mainContainer">
              <div id="content">';                 
         for($i=0; $i<$imagenes["numcampos"]; $i++)
          { ?>                
          		<a href="#" onclick="displayImage('<?php echo "../../".$imagenes[$i]["ruta"]?>','P&aacute;gina <?php echo $imagenes[$i]["pagina"]?>.','');return false"><img src="<?php echo "../../".$imagenes[$i]["imagen"]?>" border="1"></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <?php
           if($imagenes[$i]["pagina"]==(round($imagenes[$i]["pagina"]/8)*8))
            echo "<br><br>";
          }
          echo "</div></div>";
		  echo "<HR>";
       }
   
}
 return true;  
}

//---------------------------------mostrar qr------------------------------//
function parsear_arbol_expediente_serie_memorando(){
    global $conn,$ruta_db_superior;
    ?>
    <script>
        $(document).ready(function(){
             tree_serie_idserie.setOnCheckHandler(parsear_expediente_serie);
        });
        function parsear_expediente_serie(nodeId){
            var idexpediente_idserie = nodeId.split('sub');
            $('[name="serie_idserie"]').val(idexpediente_idserie[1]);
            $('[name="expediente_serie"]').val(idexpediente_idserie[0]);
            var seleccionados=tree_serie_idserie.getAllChecked();
            var vector_seleccionados=seleccionados.split(',');
            for(i=0;i<vector_seleccionados.length;i++){
            	if(vector_seleccionados[i]!=nodeId){
            		tree_serie_idserie.setCheck(vector_seleccionados[i],0 );
            	}
            }
        }
    </script>
    <?php  
}
function vincular_expediente_serie_memorando($idformato,$iddoc){ //POSTERIOR AL APROBAR
    global $conn,$ruta_db_superior;
    
    $datos=busca_filtro_tabla("expediente_serie,documento_iddocumento","ft_memorando","documento_iddocumento=".$iddoc,"",$conn);
    $vinculado=busca_filtro_tabla("","expediente_doc","documento_iddocumento=".$datos[0]['documento_iddocumento']." AND expediente_idexpediente=".$datos[0]['expediente_serie'],"",$conn);
    if(!$vinculado['numcampos']){
        $sql="INSERT INTO expediente_doc (expediente_idexpediente,documento_iddocumento,fecha) VALUES (".$datos[0]['expediente_serie'].",".$datos[0]['documento_iddocumento'].",".fecha_db_almacenar(date("Y-m-d H:i:s"),'Y-m-d H:i:s').")";
        phpmkr_query($sql);
    }    
}
function formato_radicado_interno($idformato,$iddoc,$retorno=0){ //MOSTRAR
	global $conn;
	$formato=busca_filtro_tabla("","formato A","A.idformato=".$idformato,"",$conn);
	$datos_documento=busca_filtro_tabla(fecha_db_obtener('A.fecha','Y-m-d')." as x_fecha, A.*, B.*","documento A, ".$formato[0]["nombre_tabla"]." B","A.iddocumento=B.documento_iddocumento AND A.iddocumento=".$iddoc,"",$conn);
	$dep=busca_filtro_tabla("B.codigo,B.codigo_arbol","dependencia_cargo A, dependencia B","A.iddependencia_cargo=".$datos_documento[0]["dependencia"]." AND A.dependencia_iddependencia=B.iddependencia","",$conn);
	
	
	$fecha=$datos_documento[0]["x_fecha"];//año mes dia
	$fecha_sin_guion=str_replace("-","",$fecha);
	$cadena=$fecha_sin_guion;
	
	$ruta=busca_filtro_tabla("","ruta","tipo<>'INACTIVO' and documento_iddocumento=".$iddoc,"",$conn);
	if($ruta['numcampos']>0){
					
		$depcar=$ruta[$ruta['numcampos']-1]['origen'];
		$dep2=busca_filtro_tabla("","vfuncionario_dc","iddependencia_cargo=".$depcar,"",$conn);
		$cod=busca_filtro_tabla("","dependencia","iddependencia=".$dep2[0]['iddependencia'],"",$conn);
		
		$dep=busca_filtro_tabla("codigo_arbol","dependencia","iddependencia=".$dep2[0]['iddependencia'],"",$conn);
        $tem=explode('.',$dep[0]['codigo_arbol']);
		
		
		
		if(count($tem)==2){
			$tercer=busca_filtro_tabla("","dependencia","iddependencia=".$tem[1],"",$conn);
		}
		else{
			$tercer=busca_filtro_tabla("","dependencia","iddependencia=".$tem[2],"",$conn);
		}

		$cadena.=$tercer[0]['codigo']; // (muestra la direccion del ultimo en la ruta)
		
	}else{
		
		
		//codigo_arbol
		
        $tem=explode('.',$dep[0]['codigo_arbol']);
		
		if(count($tem)==2){
			$tercer=busca_filtro_tabla("","dependencia","iddependencia=".$tem[1],"",$conn);
		}
		else{
			$tercer=busca_filtro_tabla("","dependencia","iddependencia=".$tem[2],"",$conn);
		}
		
		
		$cadena.=$tercer[0]["codigo"];  // (muestra la direccion creador por que no tiene ruta)
	}	
	
	
	//$cadena.=$dep[0]["codigo"];//Dirección de Archivo de los Derechos Humanos 
	//$cadena.=str_pad($datos_documento[0]["numero"],4,"0",STR_PAD_LEFT);
	
	if(strlen($datos_documento[0]["numero"])==1){
		$cadena.='000<b>'.$datos_documento[0]["numero"].'</b>';
	}
	if(strlen($datos_documento[0]["numero"])==2){
		$cadena.='00<b>'.$datos_documento[0]["numero"].'</b>';
	}	
	if(strlen($datos_documento[0]["numero"])==3){
		$cadena.='0<b>'.$datos_documento[0]["numero"].'</b>';
	}
	if(strlen($datos_documento[0]["numero"])>3){
		$cadena.='<b>'.$datos_documento[0]["numero"].'</b>';
	}
	
	$cadena.="-3";
  if($retorno==1){
    return($cadena);
  }
	echo($cadena);
}
function generar_correo_confirmacion_memorando($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	
	$formato=busca_filtro_tabla("nombre_tabla, nombre","formato","idformato=".$idformato,"",$conn);
	
	$formato_carta=busca_filtro_tabla("",$formato[0]['nombre_tabla'].",documento","documento_iddocumento=iddocumento and documento_iddocumento=".$iddoc,"",$conn);
	$usuario_confirma=busca_filtro_tabla("destino","buzon_entrada","nombre='POR_APROBAR' and activo=1 and archivo_idarchivo=".$iddoc,"idtransferencia asc",$conn);
	if($formato_carta[0]['email_aprobar']==1 && $formato_carta[0]['estado']=='ACTIVO'){
		$resultado=busca_filtro_tabla("","ruta","documento_iddocumento=".$iddoc,"idruta",$conn);
		if($resultado['numcampos']){
			
			$configuracion_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
			if($configuracion_temporal["numcampos"]){
				$ruta_temp=$configuracion_temporal[0]["valor"];
			}
			if(!is_dir($ruta_db_superior.$ruta_temp."_".$_SESSION["LOGIN"])){
        mkdir($ruta_db_superior.$ruta_temp."_".$_SESSION["LOGIN"],0777);
      }
			$borrar_pdf="UPDATE documento set pdf='' where iddocumento=".$iddoc;
			phpmkr_query($borrar_pdf);
			$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
			if($consulta[0]['pdf']!=""){
	      $anexos[]=$ruta_db_superior.$consulta[0]['pdf'];
	    }else{
				$ch = curl_init();
		    //$fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/class_impresion.php?iddoc=".$iddoc."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&conexion_remota=1&usuario_actual=".$_SESSION["usuario_actual"]."&LLAVE_SAIA=".LLAVE_SAIA;
		    $fila = PROTOCOLO_CONEXION.RUTA_PDF_LOCAL."/class_impresion.php?plantilla=".$formato[0]['nombre']."&iddoc=".$iddoc."&conexion_remota=1&conexio_usuario=".$_SESSION["LOGIN".LLAVE_SAIA]."&usuario_actual=".$_SESSION["usuario_actual"]."&LOGIN=".$_SESSION["LOGIN".LLAVE_SAIA]."&LLAVE_SAIA=".LLAVE_SAIA;
		    curl_setopt($ch, CURLOPT_URL,$fila);
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
		    $contenido=curl_exec($ch);
		    curl_close ($ch);
				//$anexos[]=$ruta_db_superior.$nombre_archivo.".pdf";
	    }
			$consulta=busca_filtro_tabla("","documento","iddocumento=".$iddoc,"",$conn);
			if($consulta[0]['pdf']!=""){
	      $anexos[]=$ruta_db_superior.$consulta[0]['pdf'];
	    }
			$funcionario=busca_filtro_tabla("","vfuncionario_dc","estado_dc=1 and estado=1 and funcionario_codigo=".$usuario_confirma[0]['destino'],"",$conn);
			$adjuntos=busca_filtro_tabla("ruta","anexos","documento_iddocumento=".$iddoc,"",$conn);
	    if($adjuntos["numcampos"]){
	      for($k=0;$k<$adjuntos["numcampos"];$k++){
	        $anexos[]=$ruta_db_superior.$adjuntos[$k]["ruta"];
	      }
	    }

			$info='iddoc-'.$iddoc.',usuario-'.$funcionario[0]['login'];
	    $resultado=base64_encode($info);
			$busca_configuracion_correo=busca_filtro_tabla("valor","configuracion","nombre='email_aprobacion'","",$conn);
			$enlaces='<a href="'.$busca_configuracion_correo[0]['valor'].'index.php?info='.$resultado.'" target="_blank">Gestionar Documento</a><br />';


			/*$mensaje='Saludos '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].',<br /><br />
	        A continuaci&oacute;n se adjunta en formato PDF el documento de la comunicacion externa donde se encuentra usted como responsable.<br /><br />
	        Por favor dar click en los siguiente(s) enlace(s) y Aprobar o Rechazar el documento.<br/>'.$enlaces.'<br /><br />Antes de imprimir este mensaje, asegurese que es necesario. Proteger el medio ambiente tambien esta en nuestras manos.<br /><br />
	        ESTE ES UN MENSAJE AUTOMATICO, FAVOR NO RESPONDER.';*/

			$mensaje='

			Saludos '.$funcionario[0]['nombres'].' '.$funcionario[0]['apellidos'].',<br /><br />
                        Por medio de la presente se permite solicitar su aprobación o rechazo al documento adjunto donde se encuentra usted como responsable de aprobación, para hacer esto por favor siga estos dos pasos:
                        <br /><br />
                        1. Haga lectura del documento adjunto.
                        <br /><br />
                        2. Una vez tenga conocimiento del documento, acceda al siguiente link y decida si Aprobar o Rechazar.
                        <br /><br />
                        '.$enlaces.'
                        <br /><br />
                        ';

			enviar_mensaje('','codigo',array($funcionario[0]['funcionario_codigo']),'GESTION DE COMUNICACIONES EXTERNAS',$mensaje,$anexos);
		}
	}
}
?>
