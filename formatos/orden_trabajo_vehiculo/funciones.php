<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function separar_miles_kilometros($idformato,$iddoc){
	 global $conn;
?>
    <script>
        function cargar_puntos(){
            Moneda_r($("#kilometros_vehiculo").attr('id'));
        }
       
        cargar_puntos();
        $("#kilometros_vehiculo").keyup(function(){
            Moneda_r($("#kilometros_vehiculo").attr('id'));
        });
        $("#kilometros_vehiculo").blur(function(){
            Moneda_r($("#kilometros_vehiculo").attr('id'));
        });
          
        $('#formulario_formatos').
validate({
            submitHandler: function(form){
                var valor_ =new String($("#kilometros_vehiculo").val());
                var nuevo_valor = valor_.replace(/\./g,"");
                $("#kilometros_vehiculo").val(nuevo_valor);
                     
                form.submit();  
            }      
        });
          
        function Moneda_r(input){
            var num = $("#"+input).val().replace(/\./g,'');
            if(!isNaN(num)){
                 num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.');
                num = num.split('').reverse().join('').replace(/^[\.]/,'');
                $("#"+input).val(num);
            }
        }
    </script>
<?php
}

function cargar_funcionario_recibo($idformato,$iddoc){
	global $conn;	
	$usuario=usuario_actual("funcionario_codigo");
	$datos=busca_filtro_tabla("A.nombres, A.apellidos","funcionario A","A.funcionario_codigo=".$usuario,"",$conn);	
	
?>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#funcionario_recibo").attr("value","<?php echo(mayusculas(utf8_encode(html_entity_decode($datos[0]['nombres']." ".$datos[0]['apellidos']))))?>");
			$("#funcionario_recibo").attr("readonly",true);
		});
	</script>
<?php
}

function mostrar_info_orden_trabajo($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("A.*, B.numero AS numero_solicitud","ft_orden_trabajo_vehiculo A, documento B","A.documento_iddocumento=B.iddocumento AND A.documento_iddocumento=".$iddoc,"",$conn);
	
	//Informacion del cliente
	$datos_cliente=busca_filtro_tabla("A.datos_cliente","ft_confir_negoci_vehiculo A, ft_orden_trabajo_vehiculo B","A.idft_confir_negoci_vehiculo=B.ft_confir_negoci_vehiculo AND B.documento_iddocumento=".$iddoc,"",$conn);
	$cliente=busca_filtro_tabla("A.direccion, A.ciudad, B.nombre, B.identificacion","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos_cliente[0]['datos_cliente'],"",$conn);
	$ciudad=busca_filtro_tabla("A.nombre AS ciudad, B.nombre AS departamento","municipio A, departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$cliente[0]['ciudad'],"",$conn);
	
	if($datos[0]['tipo_servicio']=="1"){
		$externo="X";
	}else{
		$taller="X";
	}
	$tabla_info="<table style=\"border-collapse: collapse; font-size: 8pt; width: 100%;\" border=\"0\">";
	$tabla_info.="<tbody>";
	$tabla_info.="<tr>";
	$tabla_info.="<td style=\"width: 20%;\">S. EXTERNO:  <b>".$externo."</b></td>";
	$tabla_info.="<td style=\"width: 20%;\">F. OT: <b>".$datos[0]['fecha_orden_trabajo']."</b></td>";
	$tabla_info.="<td style=\"width: 25%;\">SOL. No: <b>".$datos[0]['numero_solicitud']."</b></td>";
	$tabla_info.="<td>CTTO No: <b>".$datos[0]['ctto_numero']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>S. TALLER:  <b>".$taller."</b></td>";
	$tabla_info.="<td>F. SOL: <b>".$datos[0]['fecha_solicitud_orden']."</td>";
	$tabla_info.="<td>Prioridad: <b>".mostrar_valor_campo("prioridad_servicio",262,$datos[0]['documento_iddocumento'],1)."</b></td>";
	$tabla_info.="<td>SERVICIO: <b>".$datos[0]['campo_servicio']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td colspan=\"2\">F. COMPROMISO:&nbsp; <b>".$datos[0]['fecha_compromiso']."</b></td>";
	$tabla_info.="<td colspan=\"2\">ASEGURADOR: <b>".$datos[0]['nombre_asegurador']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="</tbody>";
	$tabla_info.="</table>";
	$tabla_info.="<hr>";
	//Datos cliente
	$tabla_info.="<table style=\"border-collapse: collapse; font-size: 8pt; width: 100%;\" border=\"0\">";
	$tabla_info.="<tbody>";
	$tabla_info.="<tr>";
	$tabla_info.="<td style=\"width: 50%;\">CLIENTE: <b>".$cliente[0]['nombre']."</b></td>";
	$tabla_info.="<td style=\"width: 50%;\">NIT: <b>".$cliente[0]['identificacion']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>DIRECCI&Oacute;N: <b>".$cliente[0]['direccion']."</b></td>";
	if($ciudad['numcampos']){
		$tabla_info.="<td>CIUDAD: <b>".$ciudad[0]['ciudad'].", ".$ciudad[0]['departamento']."</b></td>";		
	}else{
		$tabla_info.="<td>CIUDAD:</td>";		
	}
	$tabla_info.="</tr>";
	$tabla_info.="</tbody>";
	$tabla_info.="</table>";
	
	echo($tabla_info);
}

function mostrar_info_orden_vehiculo($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("A.nombre_solicitante, A.kilometros_vehiculo","ft_orden_trabajo_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);
	//INFORMACION SOLICITANTE
	$solicitante=busca_filtro_tabla("A.cargo,A.telefono,B.nombre,B.identificacion","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos[0]['nombre_solicitante'],"",$conn);
	//INFORMACION VEHICULO
	$datos_vehiculo=busca_filtro_tabla("A.datos_vehiculo, A.placa_asignada_vehiculo","ft_confir_negoci_vehiculo A, ft_orden_trabajo_vehiculo B","A.idft_confir_negoci_vehiculo=B.ft_confir_negoci_vehiculo AND B.documento_iddocumento=".$iddoc,"",$conn);
	$vehiculo=busca_filtro_tabla("","ft_datos_vehiculo A","A.idft_datos_vehiculo=".$datos_vehiculo[0]['datos_vehiculo'],"",$conn);
	$tipo_vehiculo=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$vehiculo[0]['nombre_vehiculo'],"",$conn);
	
	
	$tabla_info.="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"0\">";
	$tabla_info.="<tbody>";
	$tabla_info.="<tr>";
	$tabla_info.="<td style=\"width: 50%;\" colspan=\"2\">SOLICITANTE: <b>".$solicitante[0]['nombre']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td style=\"width: 50%;\" colspan=\"2\">CARGO: <b>".$solicitante[0]['cargo']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td style=\"width: 50%;\">TELEFONO: <b>".$solicitante[0]['telefono']."</b></td>";
	$tabla_info.="<td style=\"width: 50%;\">FAX:</td>";
	$tabla_info.="</tr>";
	$tabla_info.="</tbody>";
	$tabla_info.="</table>";
	$tabla_info.="<div >";
	$tabla_info.="<hr style=\"background-color=#000000;\">";
	//DATOS VEHICULO	
	$tabla_info.="<table style=\"border-collapse: collapse; font-size: 8pt; width: 100%;\" border=\"0\">";
	$tabla_info.="<tbody>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>VEH&Iacute;CULO: <b>".$tipo_vehiculo[0]['nombre']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>MODELO: <b>".$vehiculo[0]['modelo_vehiculo']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>MARCA: <b>KIA</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>PLACA: <b>".$datos_vehiculo[0]['placa_asignada_vehiculo']."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="<tr>";
	$tabla_info.="<td>KMS: <b>".number_format($datos[0]['kilometros_vehiculo'],0,"",".")."</b></td>";
	$tabla_info.="</tr>";
	$tabla_info.="</tbody>";
	$tabla_info.="</table>";

	echo($tabla_info);
}

function mostrar_info_firmas($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.funcionario_recibo","ft_orden_trabajo_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn); 

	
	$identificacion=busca_filtro_tabla("C.identificacion","ft_orden_trabajo_vehiculo A, datos_ejecutor B, ejecutor C","A.nombre_solicitante=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor AND A.documento_iddocumento=".$iddoc,"","",$conn);

	$tabla_firmas="<table style=\"border-collapse: collapse; font-size: 8pt; width: 100%;\" border=\"0\">";
	$tabla_firmas.="<tbody>";
	$tabla_firmas.="<tr>";
	$tabla_firmas.="<td style=\"width: 15%; font-weight: bold; text-align:right;\">RECIBIDO <BR/>VEH&Iacute;CULO:</td>";
	$tabla_firmas.="<td style=\"width: 35%; border-bottom: 1px solid #000000;\">&nbsp;".mayusculas($datos[0]['funcionario_recibo'])."</td>";
	$tabla_firmas.="<td style=\"width: 15%;\">&nbsp;</td>";
	$tabla_firmas.="<td>&nbsp;</td>";
	$tabla_firmas.="</tr>";
	$tabla_firmas.="<tr>";
	$tabla_firmas.="<td style=\"font-weight: bold;text-align:right;\">FIRMA <BR/>CLIENTE:</td>";
	$tabla_firmas.="<td style=\"border-bottom: 1px solid #000000;text-align:center\">".firma_externa_funcion($idformato,$iddoc,"","firma_externa_cliente","documento_iddocumento","","",1)."</td>";
	$tabla_firmas.="<td style=\"font-weight: bold;text-align:right;\">RECIBIDO A <BR/>SATISFACCI&Oacute;N:</td>";
	$tabla_firmas.="<td style=\"border-bottom: 1px solid #000000;text-align:center;\">".firma_externa_funcion($idformato,$iddoc,"","firma_externa_satisfaccion","documento_iddocumento","","",1)."</td>";
	$tabla_firmas.="</tr>";
	$tabla_firmas.="<tr>";
	$tabla_firmas.="<td style=\"font-weight: bold;text-align:right;\">C.C.</td>";
	$tabla_firmas.="<td style=\"border-bottom: 1px solid #000000;\">&nbsp;".$identificacion[0]['identificacion']."</td>";
	$tabla_firmas.="<td style=\"font-weight: bold;text-align:right;\">C.C.</td>";
	$tabla_firmas.="<td style=\"border-bottom: 1px solid #000000;\">&nbsp;".$identificacion[0]['identificacion']."</td>";
	$tabla_firmas.="</tr>";
	$tabla_firmas.="</tbody>";
	$tabla_firmas.="</table>";
	
	echo($tabla_firmas);
}

function mostrar_orden_ot($idformato,$iddoc){
  global $conn;
  //Estado del documento Papa
	$estado_doc=busca_filtro_tabla("","ft_orden_trabajo_vehiculo A, documento B","A.documento_iddocumento = B.iddocumento AND B.estado<>'ELIMINADO' AND A.documento_iddocumento=".$iddoc,"",$conn);
		//Datos ITEM
	$datos=busca_filtro_tabla("B.*","ft_orden_trabajo_vehiculo A,ft_planea_orden_trabajo B","A.idft_orden_trabajo_vehiculo=B.ft_orden_trabajo_vehiculo AND A.documento_iddocumento=".$iddoc,"B.idft_planea_orden_trabajo",$conn);	
	$datos_papa=busca_filtro_tabla("","ft_orden_trabajo_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);

	if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5 && !$_REQUEST['ventana']){
		$enlace_accesorios="<a href='http://".RUTA_PDF."/formatos/planea_orden_trabajo/adicionar_planea_orden_trabajo.php?pantalla=padre&idpadre=".$iddoc."&idformato=".$idformato."&padre=".$datos_papa[0]['idft_orden_trabajo_vehiculo']."' style='font-size:12px;'>Adicionar PLANEACIÓN DE OT</a><br/><br/>";
		echo($enlace_accesorios);
	}
		
	if($datos['numcampos']){
		$tabla_orden="<table style=\"width: 100%; border-collapse: collapse; font-size: 8pt;\" border=\"1\">";
		$tabla_orden.="<tbody>";
		$tabla_orden.="<tr>";		
		$tabla_orden.="<td style=\"background-color: #1a2898; color: white; font-weight: bold; text-align:center;\">&nbsp;Concepto</td>";
		$tabla_orden.="<td style=\"background-color: #1a2898; color: white; font-weight: bold; text-align:center;\">&nbsp;Descripci&oacute;n</td>";
		$tabla_orden.="<td style=\"background-color: #1a2898; color: white; font-weight: bold; text-align:center;\">&nbsp;Cnt</td>";
		$tabla_orden.="<td style=\"background-color: #1a2898; color: white; font-weight: bold; text-align:center;\">&nbsp;Costo</td>";
		if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
			$tabla_orden.="<td style=\"width:7%;\">&nbsp;</td>";
		}
		$tabla_orden.="</tr>";
		for($i=0;$i<$datos['numcampos'];$i++){
			//Busco el nombre del Concepto
			$concepto=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos[$i]['concepto_trabajo'],"",$conn);
			
			$tabla_orden.="<tr>";
			$tabla_orden.="<td style=\"text-align:center;\">".$concepto[0]['nombre']."</td>";
			$tabla_orden.="<td>".utf8_encode(html_entity_decode($datos[$i]['descripcion_orden']))."</td>";
			$tabla_orden.="<td style=\"text-align:center;\">".$datos[$i]['cantidad_solicitada']."</td>";
			$tabla_orden.="<td style=\"text-align:center;\">$".number_format($datos[$i]['costo_trabajo'],0,"",".")."</td>";
			if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
				$tabla_orden.="<td>";
				$tabla_orden.="<a href=\"http://".RUTA_PDF."/formatos/planea_orden_trabajo/editar_planea_orden_trabajo.php?idformato=261&item=".$datos[$i]['idft_planea_orden_trabajo']."\"><img border=\"0\" src=\"../../botones/comentarios/editar_documento.png\" title=\"Editar\"></a>&nbsp;";
				$tabla_orden.="<a onclick='if(confirm(\"¿En realidad desea borrar esta Forma de Pago?\")) window.location=\"../librerias/funciones_item.php?formato=263&idpadre=".$iddoc."&accion=eliminar_item&tabla=ft_planea_orden_trabajo&id=".$datos[$i]['idft_planea_orden_trabajo']."\";' href=\"#\"><img border=\"0\" src=\"../../images/eliminar_pagina.png\" title=\"Eliminar\"></a>";
				$tabla_orden.="</td>";
			}
			$tabla_orden.="</tr>";
		}
		$tabla_orden.="</tbody>";
		$tabla_orden.="</table>";
		echo($tabla_orden);
	}
	echo("&nbsp;");
}

function mostrar_autorizacion_orden($idformato,$iddoc){
	global $conn;
	$tabla_autorizacion="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"0\">";
	$tabla_autorizacion.="<tbody>";
	$tabla_autorizacion.="<tr>";
	$tabla_autorizacion.="<td style=\"width: 15%;\">AUTORIZADO</td>";
	$tabla_autorizacion.="<td style=\"border-bottom: 1px solid #000000; width: 50%;\">&nbsp;</td>";
	$tabla_autorizacion.="<td style=\"width: 5%;\">C.C.</td>";
	$tabla_autorizacion.="<td style=\"border-bottom: 1px solid #000000;\">&nbsp;</td>";
	$tabla_autorizacion.="</tr>";
	$tabla_autorizacion.="<tr>";
	$tabla_autorizacion.="<td>PROPIETARIO</td>";
	$tabla_autorizacion.="<td style=\"border-bottom: 1px solid #000000;\">&nbsp;</td>";
	$tabla_autorizacion.="<td>C.C.</td>";
	$tabla_autorizacion.="<td style=\"border-bottom: 1px solid #000000;\">&nbsp;</td>";
	$tabla_autorizacion.="</tr>";
	$tabla_autorizacion.="</tbody>";
	$tabla_autorizacion.="</table>";
	
	echo($tabla_autorizacion);
	
}
function guia_imagen($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$idft=busca_filtro_tabla("","ft_orden_trabajo_vehiculo a","a.documento_iddocumento=".$iddoc,"",$conn);
	$formato_hijo=busca_filtro_tabla("","formato a","a.nombre='informacion_dano'","",$conn);
	
	//$paginas=busca_filtro_tabla("","pagina a","id_documento=".$iddoc,"",$conn);
	$paginas=busca_filtro_tabla("","anexos a","documento_iddocumento=".$iddoc." and tipo in('jpg')","",$conn);
	
	list($width, $height) = getimagesize($ruta_db_superior.$paginas[0]["ruta"]);
	if($width>250||$height>250){
		cambia_tam($ruta_db_superior.$paginas[0]["ruta"],$ruta_db_superior.$paginas[0]["ruta"],250,250,"");
	}
	
	$texto="";
	if($paginas["numcampos"]){		
		if(@$_REQUEST["tipo"]!=5){
			$texto.='<script src="'.$ruta_db_superior.'js/jquery-1.8.2.js"></script>';
			$texto.='<script src="'.$ruta_db_superior.'js/jquery.Jcrop.js"></script>';
			$texto.='<link rel="stylesheet" href="'.$ruta_db_superior.'css/jquery.Jcrop.css" type="text/css" />';
		}
		$texto.="<div id='capa_contenedora_imagen' style='border:0px solid; position:relative;left:3%'>";		
		$guias=busca_filtro_tabla("","ft_informacion_dano a","a.ft_orden_trabajo_vehiculo=".$idft[0]["idft_orden_trabajo_vehiculo"],"idft_informacion_dano asc",$conn);
		for($i=0;$i<$guias["numcampos"];$i++){
			$texto.="<div style='z-index:99; border:1px solid #478CCD; position:absolute; top:".($guias[$i]["y"])."px;left:".($guias[$i]["x"]).";width:".($guias[$i]["x2"]-$guias[$i]["x"])."px; height:".($guias[$i]["y2"]-$guias[$i]["y"])."px'><center>".($i+1)."</center></div>";
		}
    $texto.="<img src='".$ruta_db_superior.$paginas[0]["ruta"]."' id='cropbox'>";
		$texto.="</div>";
		if(@$_REQUEST["tipo"]!=5){
			$texto.='<script>
			$(document).ready(function(){
				$("#cropbox").Jcrop({
					onSelect: showCoords
				});
			});
			function showCoords(c){
				var posicion=$("#capa_contenedora_imagen").position();
				//alert(parseFloat(posicion.left));
				//alert(parseFloat(posicion.top));
				var x=parseFloat(c.x);//+parseFloat(posicion.left);
				var y=parseFloat(c.y);//+parseFloat(posicion.top);
				var x2=parseFloat(c.x2);//+parseFloat(posicion.left);
				var y2=parseFloat(c.y2);//+parseFloat(posicion.top);   
        //alert(x+"-"+y+"-"+x2+"-"+y2+"-->"+(y2-y));     
				abrir_highslide(x,y,x2,y2,c.w,c.h);
			}
			function abrir_highslide(x,y,x2,y2,w,h){
				hs.htmlExpand(document,{ contentId: "cuerpo",preserveContent:false,marginTop:0,objectType: "iframe",width: 600, height: 200, src: "'.$ruta_db_superior.'formatos/informacion_dano/adicionar_informacion_dano.php?pantalla=padre&idpadre='.$iddoc.'&idformato='.$formato_hijo[0]["idformato"].'&padre='.$idft[0]["idft_orden_trabajo_vehiculo"].'&x="+x+"&y="+y+"&x2="+x2+"&y2="+y2+"&w="+w+"&h="+h});
			}
			</script>';
		}
	}
	else{
		//$texto.="<div style='width:100%;text-align:center'><a href='".$ruta_db_superior."paginaadd.php?key=".$iddoc."&no_menu=1'>Agregar imagen</a></div>";
		$texto.="<div style='width:100%;text-align:center'><a href='".$ruta_db_superior."anexosdigitales/anexos_documento.php?key=".$iddoc."&no_menu=1&iddoc=".$iddoc."'>Agregar imagen (solo im&aacute;genes jpg)</a></div>";
	}
	echo $texto;
}
function descripcion_problema($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	$formato=busca_filtro_tabla("b.valor","formato a, campos_formato b","a.nombre='informacion_dano' and a.idformato=b.formato_idformato and b.nombre='problema'","",$conn);
	$filas=explode(";",$formato[0]["valor"]);
	$cant=count($filas);
	$valores=array();
	for($i=0;$i<$cant;$i++){
		$datos=explode(",",$filas[$i]);
		$valores[$datos[0]]=$datos[1];
	}
	$idft=busca_filtro_tabla("","ft_orden_trabajo_vehiculo a","a.documento_iddocumento=".$iddoc,"",$conn);
	$guias=busca_filtro_tabla("","ft_informacion_dano a","a.ft_orden_trabajo_vehiculo=".$idft[0]["idft_orden_trabajo_vehiculo"],"idft_informacion_dano asc",$conn);
	$texto='';
	if($guias["numcampos"]){
		$texto.="<table style='font-size: 8pt; width: 100%;font-family:arial'>";
		$texto.="<tr><td style=''><b>Observaciones</b></td></tr>";
		$texto.="<tr><td>";
		for($i=0;$i<$guias["numcampos"];$i++){
			$texto.="<b>".($i+1).": </b>".mostrar_seleccionados_check($guias[$i]["problema"],$valores).". ";
		}
		$texto.="</td></tr>";
		$texto.="</table>";
		$texto.="<br/>";
	}
	echo $texto;
}
function mostrar_seleccionados_check($guardado,$valores){
	global $conn;
	$datos_guardados=explode(",",$guardado);
	$cant=count($datos_guardados);
	$datos=array();
	for($i=0;$i<$cant;$i++){
		$datos[]=$valores[$datos_guardados[$i]];
	}
	return implode(",",$datos);
}
?>