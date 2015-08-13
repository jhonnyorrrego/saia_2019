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

function separar_miles_confirmacion($idformato,$iddoc){
  global $conn;
?>
  <script>
    function cargar_puntos(){
      Moneda_r($("#valor_matricula").attr('id'));
      Moneda_r($("#valor_seguros").attr('id'));
    }
   
    cargar_puntos();
    $("#valor_matricula").keyup(function(){
      Moneda_r($("#valor_matricula").attr('id'));
    });
    $("#valor_matricula").blur(function(){
      Moneda_r($("#valor_matricula").attr('id'));
    });
    //********************
    $("#valor_seguros").keyup(function(){
      Moneda_r($("#valor_seguros").attr('id'));
    });
    $("#valor_seguros").blur(function(){
      Moneda_r($("#valor_seguros").attr('id'));
    });
     
    $('#formulario_formatos').validate({
      submitHandler: function(form){
      	//Valor matricula
        var valor_ =new String($("#valor_matricula").val());
        var nuevo_valor = valor_.replace(/\./g,"");
        $("#valor_matricula").val(nuevo_valor);
        
        //Valor seguros
        var valor_ =new String($("#valor_seguros").val());
        var nuevo_valor = valor_.replace(/\./g,"");
        $("#valor_seguros").val(nuevo_valor);
             
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

function cargar_datos_vehiculo($idformato,$iddoc){	
  	global $conn;
		if($_REQUEST['iddoc']){
			$datos=busca_filtro_tabla("A.datos_vehiculo, A.accesorios_vehiculo","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
		}
	$datos_vehiculo=busca_filtro_tabla("A.idft_datos_vehiculo,A.modelo_vehiculo, B.nombre","ft_datos_vehiculo A, serie B","A.nombre_vehiculo=B.idserie","",$conn);
	//print_r($datos_vehiculo);
	$lista_vehiculos="<td><select name='datos_vehiculo' id='datos_vehiculo' class='required'>";
	$lista_vehiculos.="<option selected='' value=''>Por favor seleccione...</option>";
	for($i=0;$i<$datos_vehiculo['numcampos'];$i++){			
	  $lista_vehiculos.="<option value='".$datos_vehiculo[$i]['idft_datos_vehiculo']."'>".$datos_vehiculo[$i]['nombre']." (modelo ".$datos_vehiculo[$i]['modelo_vehiculo'].")</option>";
	}
	$lista_vehiculos.="</select></td>";
	echo ($lista_vehiculos);
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var datos_vehiculo="<?php echo($datos[0]['datos_vehiculo'])?>";
			var accesorios_vehiculo="<?php echo($datos[0]['accesorios_vehiculo'])?>";
			var accesorios=accesorios_vehiculo.split(",");
			$("#datos_vehiculo").trigger('change').val(datos_vehiculo);
			
			//Cargo informacion del Vehiculo
			$("#ver_vehiculo,#ver_accesorios").parent().parent().show();
			$.ajax({url: 'enlace.php',
				type:'POST',
				dataType: 'json',
				data:'id='+$("#datos_vehiculo").val(),
				success: function(datos){												
					$('#ver_vehiculo').html(datos.enlace);
					$('#ver_accesorios').html(datos.accesorios);
					
					jQuery.each(accesorios,(function(i, value){
						$("#accesorios_vehiculo"+value).attr("checked",true);
					}));
				}
			});
		});
	</script>
<?php
}
if($_REQUEST["tipo"]!=6){
?>
<script type="text/javascript" src="../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<?php
}

function cargar_accesorios_vehiculo($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$_REQUEST['iddoc'],"",$conn);
	echo('<td><div id="ver_accesorios"></div></td>');
}
function cargar_info_vehiculo($idformato,$iddoc){
	global $conn;
	
	echo('<td><div id="ver_vehiculo"></div></td>');
?>
	<script type="text/javascript">
		$(document).ready(function(){
			var estado_doc="<?php echo($_REQUEST['iddoc'])?>";
			//Se ejecuta al Adicionar
			if(!estado_doc){
				$("#ver_vehiculo,#ver_accesorios").parent().parent().hide();				
			}
			
			$("#datos_vehiculo").change(function(){
				$("#datos_vehiculo option:selected").each(function () {
					if($(this).val()!=""){	
						$("#ver_vehiculo,#ver_accesorios").parent().parent().show();
						$.ajax({url: 'enlace.php',
							type:'POST',
							dataType: 'json',
							data:'id='+$("#datos_vehiculo").val(),
							success: function(datos){												
								$('#ver_vehiculo').html(datos.enlace);
								$('#ver_accesorios').html(datos.accesorios);
							}
						});
						//Actualizo campo en la Base de Datos
						$.ajax({url: 'actualizar_accesorios.php',
							type:'POST',
							dataType: 'json',
							data:'iddocumento='+estado_doc,
							success: function(datos){												
							}
						});
					}else{
						$('#ver_vehiculo,#ver_accesorios').html("");
						$("#ver_vehiculo,#ver_accesorios").parent().parent().hide();						
					}					
				});
				/*;*/
			});
		});
	</script>
<?php
}

function mostrar_datos_cliente_confirma($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("A.datos_cliente","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);
	$cliente=busca_filtro_tabla("B.nombre","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos[0]['datos_cliente'],"",$conn);
	
	$tabla_cliente="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"1\">";
	$tabla_cliente.="<tbody>";
	$tabla_cliente.="<tr>";
	$tabla_cliente.="<td>Primer Nombre o raz&oacute;n social</td>";
	$tabla_cliente.="<td><b>".$cliente[0]['nombre']."</b></td>";
	$tabla_cliente.="</tr>";
	$tabla_cliente.="<tr>";
	$tabla_cliente.="<td>Segundo Nombre o raz&oacute;n social</td>";
	$tabla_cliente.="<td>&nbsp;</td>";
	$tabla_cliente.="</tr>";
	$tabla_cliente.="</tbody>";
	$tabla_cliente.="</table>";	
	
  echo($tabla_cliente);
}

function mostrar_solicitud_confirma($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("A.datos_cliente","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);
	$cliente=busca_filtro_tabla("A.direccion,A.telefono,A.ciudad,B.nombre,B.identificacion","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$datos[0]['datos_cliente'],"",$conn);
	$ciudad=busca_filtro_tabla("A.nombre AS ciudad, B.nombre AS departamento","municipio A, departamento B","A.departamento_iddepartamento=B.iddepartamento AND A.idmunicipio=".$cliente[0]['ciudad'],"",$conn);

	$tabla_solicitud="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"1\">";
	$tabla_solicitud.="<tbody>";
	$tabla_solicitud.="<tr>";
	$tabla_solicitud.="<td colspan=\"2\">Primer Nombre o raz&oacute;n social:</td>";
	$tabla_solicitud.="<td colspan=\"2\"><b>".$cliente[0]['nombre']."</b></td>";
	$tabla_solicitud.="</tr>";
	$tabla_solicitud.="<tr>";
	$tabla_solicitud.="<td style=\"width: 15%;\">NIT. O C.C uno:</td>";
	$tabla_solicitud.="<td style=\"width: 25%;\"><b>".$cliente[0]['identificacion']."</b></td>";
	$tabla_solicitud.="<td style=\"width: 10%;\">TEL&Eacute;FONO:</td>";
	$tabla_solicitud.="<td style=\"width: 50%;\"><b>".$cliente[0]['telefono']."</b></td>";
	$tabla_solicitud.="</tr>";
	$tabla_solicitud.="<tr>";
	$tabla_solicitud.="<td>NIT. O C.C dos:</td>";
	$tabla_solicitud.="<td>&nbsp;</td>";
	$tabla_solicitud.="<td>TEL&Eacute;FONO:</td>";
	$tabla_solicitud.="<td>&nbsp;</td>";
	$tabla_solicitud.="</tr>";
	$tabla_solicitud.="<tr>";
	$tabla_solicitud.="<td>DIRECCI&Oacute;N:</td>";
	$tabla_solicitud.="<td><b>".$cliente[0]['direccion']."</b></td>";
	$tabla_solicitud.="<td>CIUDAD:</td>";
	if($ciudad[0]['ciudad']!=""){
		$tabla_solicitud.="<td><b>".$ciudad[0]['ciudad'].", ".$ciudad[0]['departamento']."</b></td>";		
	}else{
		$tabla_solicitud.="<td>&nbsp;</td>";		
	}
	$tabla_solicitud.="</tr>";
	$tabla_solicitud.="</tbody>";
	$tabla_solicitud.="</table>";
	
	echo($tabla_solicitud);
}

function mostrar_datos_vehiculo_confirma($idformato,$iddoc){
  global $conn;
	$datos=busca_filtro_tabla("","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);

	//Datos del Vehiculo
	$vehiculo=busca_filtro_tabla("","ft_datos_vehiculo A","A.idft_datos_vehiculo=".$datos[0]['datos_vehiculo'],"",$conn);
	$tipo_vehiculo=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$vehiculo[0]['nombre_vehiculo'],"",$conn);
	$color_vehiculo=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$vehiculo[0]['color_vehiculo'],"",$conn);
	$valor_vehiculo=busca_filtro_tabla("A.valor_vehiculo","ft_datos_vehiculo A","A.idft_datos_vehiculo=".$datos[0]['datos_vehiculo'],"",$conn);
	//Datos de los Accesorios
	$accesorios=explode(",",$datos[0]['accesorios_vehiculo']);
	$conteo_accesorios=sizeof($accesorios);
	
	//Busco la informacion de los Accesorios
	$complementos=array();
	$valor_complementos=0;
	if($accesorios){
		for($i=0;$i<$conteo_accesorios;$i++){
			$datos_accesorios=busca_filtro_tabla("","ft_accesorios_vehiculo A","A.idft_accesorios_vehiculo=".$accesorios[$i],"",$conn);

			$nombre_accesorio=busca_filtro_tabla("A.nombre","serie A","A.idserie=".$datos_accesorios[0]['accesorio_vehiculo'],"",$conn);
			$complementos[]=$nombre_accesorio[0]['nombre'];
			$valor_complementos=intval($datos_accesorios[0]['valor_accesorio'])+$valor_complementos;
		}		
	}
	//$=busca_filtro_tabla("","","","",$conn);
	//$=busca_filtro_tabla("","","","",$conn);
  
  $tabla_vehiculo="<table style=\"border-collapse: collapse; font-size: 8pt; width: 100%;\" border=\"1\">";
	$tabla_vehiculo.="<tbody>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td style=\"width: 40%;\">VEH&Iacute;CULO: <b>".$tipo_vehiculo[0]['nombre']."</b></td>";
	$tabla_vehiculo.="<td style=\"width: 30%;\">MODELO: <b>".$vehiculo[0]['modelo_vehiculo']."</b></td>";
	$tabla_vehiculo.="<td style=\"width: 30%;\">COLOR: <b>".$color_vehiculo[0]['nombre']."</b></td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>INVENTARIO:</td>";
	$tabla_vehiculo.="<td>MOTOR: <b>".$vehiculo[0]['motor_vehiculo']."</b></td>";
	$tabla_vehiculo.="<td>SERIE/CHASIS: <b>".$vehiculo[0]['serie_chasis_vehiculo']."</b></td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="</tbody>";
	$tabla_vehiculo.="</table>";
	$tabla_vehiculo.="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"1\">";
	$tabla_vehiculo.="<tbody>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td style=\"font-size: 8pt; font-weight: bold; text-align: center; width: 25%;\">PRECIOS</td>";
	$tabla_vehiculo.="<td style=\"font-size: 8pt; font-weight: bold; text-align: center; width: 25%;\">ITEM ACCESORIOS</td>";
	$tabla_vehiculo.="<td style=\"font-size: 8pt; font-weight: bold; text-align: center; width: 25%;\">VALOR</td>";
	$tabla_vehiculo.="<td style=\"font-size: 8pt; font-weight: bold; text-align: center; width: 25%;\">DETALLE SEGUROS</td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>VLR VEH&Iacute;CULO:</td>";
	$tabla_vehiculo.="<td>&nbsp;</td>";
	$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$".number_format($valor_vehiculo[0]['valor_vehiculo'],0,"",".")."</b></td>";
	$tabla_vehiculo.="<td rowspan=\"5\">&nbsp;</td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>ACCESORIOS:</td>";
	$tabla_vehiculo.="<td>".implode(" + ",$complementos)."</td>";
	if($valor_complementos!=0){
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$".number_format($valor_complementos,0,"",".")."</b></td>";		
	}else{
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$0</b></td>";
	}
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>MATR&Iacute;CULA:</td>";
	$tabla_vehiculo.="<td>".$datos[0]['numero_matricula']."</td>";
	if($datos[0]['valor_matricula']!=""){
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$".number_format($datos[0]['valor_matricula'],0,"",".")."</b></td>";	
	}else{
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$0</b></td>";
	}
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>SEGUROS</td>";
	$tabla_vehiculo.="<td>".utf8_encode(html_entity_decode($datos[0]['campo_seguros']))."</td>";
	if($datos[0]['valor_seguros']!=""){
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$".number_format($datos[0]['valor_seguros'],0,"",".")."</b></td>";	
	}else{
		$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$0</b></td>";
	}
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>TOTAL</td>";
	$tabla_vehiculo.="<td>&nbsp;</td>";
	//Sumo los cuatro valores (valor auto + accesorios + matricula + seguros).
	$total_items=intval($valor_complementos)+intval($valor_vehiculo[0]['valor_vehiculo'])+intval($datos[0]['valor_matricula'])+intval($datos[0]['valor_seguros']);
	$tabla_vehiculo.="<td style=\"text-align:right;\"><b>$".number_format($total_items,0,"",".")."</b></td>";	
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="</tbody>";
	$tabla_vehiculo.="</table>";
	$tabla_vehiculo.="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"1\">";
	$tabla_vehiculo.="<tbody>";
	$tabla_vehiculo.="<tr>";
	//Convierto el valor total a letras
	$valor_letras=numerotexto($total_items);
	$tabla_vehiculo.="<td>VALOR EN LETRAS: <b>".mayusculas($valor_letras)." PESOS M/C</b></td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="<tr>";
	$tabla_vehiculo.="<td>OBSERVACIONES: ".utf8_encode(html_entity_decode($datos[0]['observaciones_negocia']))."</td>";
	$tabla_vehiculo.="</tr>";
	$tabla_vehiculo.="</tbody>";
	$tabla_vehiculo.="</table>";
  
  echo($tabla_vehiculo);	
}

function mostrar_forma_pago($idformato,$iddoc){
  global $conn;
  
  $estado_doc=busca_filtro_tabla("","ft_confir_negoci_vehiculo A, documento B","A.documento_iddocumento = B.iddocumento AND B.estado<>'ELIMINADO' AND A.documento_iddocumento=".$iddoc,"",$conn);
		//Datos ITEM
	$datos=busca_filtro_tabla("B.*","ft_confir_negoci_vehiculo A,ft_forma_pago_vehiculo B","A.idft_confir_negoci_vehiculo=B.ft_confir_negoci_vehiculo AND A.documento_iddocumento=".$iddoc,"",$conn);	
	$datos_papa=busca_filtro_tabla("","ft_confir_negoci_vehiculo A","A.documento_iddocumento=".$iddoc,"",$conn);
	
	if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5 && !$_REQUEST['ventana']){
		$enlace_accesorios="<a href='http://".RUTA_PDF."/formatos/forma_pago_vehiculo/adicionar_forma_pago_vehiculo.php?pantalla=padre&idpadre=".$iddoc."&idformato=".$idformato."&padre=".$datos_papa[0]['idft_confir_negoci_vehiculo']."' style='font-size:12px;'>Adicionar FORMA DE PAGO</a><br/><br/>";
		echo($enlace_accesorios);
	}
		
	if($datos['numcampos']){
	  $tabla_pago="<table style=\"border-collapse: collapse; font-size:8pt; width: 100%;\" border=\"1\">";
		$tabla_pago.="<tbody>";
		$tabla_pago.="<tr>";
		$tabla_pago.="<td style=\"width: 12%;\">FECHA</td>";
		$tabla_pago.="<td style=\"width: 25%;\">CONCEPTO</td>";
		$tabla_pago.="<td style=\"width: 5%;\">&nbsp;</td>";
		$tabla_pago.="<td style=\"width: 20%;\">VALOR</td>";
		$tabla_pago.="<td>OBSERVACIONES</td>";
		if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
			$tabla_pago.="<td style=\"width:7%;\">&nbsp;</td>";
		}
		$tabla_pago.="</tr>";
		for($i=0;$i<$datos['numcampos'];$i++){
			$tabla_pago.="<tr>";
			$tabla_pago.="<td><b>".$datos[$i]['fecha_pago']."</b></td>";
			$tabla_pago.="<td><b>".mostrar_valor_campo('concepto_pago',261,$datos[$i]['idft_forma_pago_vehiculo'],1)."</b></td>";
			$tabla_pago.="<td style=\"text-align:center;\"><b>X</b></td>";
			$tabla_pago.="<td style=\"text-align:right;\"><b>$".number_format($datos[$i]['valor_forma_pago'],0,"",".")."</b></td>";
			$tabla_pago.="<td><b>".$datos[$i]['observaciones_pago']."</b></td>";
			if($estado_doc[0]['estado']=='ACTIVO' && $_REQUEST['tipo']!=5){
				$tabla_pago.="<td>";
				$tabla_pago.="<a href=\"http://".RUTA_PDF."/formatos/forma_pago_vehiculo/editar_forma_pago_vehiculo.php?idformato=261&item=".$datos[$i]['idft_forma_pago_vehiculo']."\"><img border=\"0\" src=\"../../botones/comentarios/editar_documento.png\" title=\"Editar\"></a>&nbsp;";
				$tabla_pago.="<a onclick='if(confirm(\"¿En realidad desea borrar esta Forma de Pago?\")) window.location=\"../librerias/funciones_item.php?formato=261&idpadre=".$iddoc."&accion=eliminar_item&tabla=ft_forma_pago_vehiculo&id=".$datos[$i]['idft_forma_pago_vehiculo']."\";' href='#'><img border=\"0\" src=\"../../images/eliminar_pagina.png\" title=\"Eliminar\"></a>";
				$tabla_pago.="</td>";
			}
			$tabla_pago.="</tr>";
		}
		$tabla_pago.="</tbody>";
		$tabla_pago.="</table>";
		echo($tabla_pago);
	}
}

function mostrar_texto_condiciones($idformato,$iddoc){
  global $conn;
	
	
	
	
	
  echo("<div style='font-size:6pt;text-align:justify;'>CONDICIONES COMERCIALES<br /><br />1.Todo pago debe efectuarse exclusivamente en la caja de SU ORGANIZACION Por todo pago exija su recibo de caja definitivo.<br />2.El presente pedido &uacute;nicamente producir&aacute; efecto para las partes, si sobre el mismo se encuentran suscritas la firmas del comprador, asesor comercial y gerente comercial de SU ORGANIZACION.<br />3.Este pedido se rige por las condiciones generales de venta impresas al respaldo y las particulares consignadas en &eacute;l, las cuales el comprador conoce y acepta expresamente.<br />4.AUTORIZACION USO DE INFORMACION: El comprador autoriza expresamente a SU ORGANIZACION para que en cualquier momento realice el reporte, procesamiento y consulta de informaci&oacute;n relaciona con su nivel de endeudamiento, trayectoria comercial con cualquier fuente o central de informaci&oacute;n legalmente autorizada. Asi mismo, autoriza compartii la base de sus datos con otras entidades para fines publicitarios.<br />5.El comprador acepta y declara expresamente haber le&iacute;do las condiciones generales impresa al respaldo de este documento.<br />6.El cliente acepta que la fecha probable de entrega esta sujeta a condiciones externes de importacion del vehiculo.<br /><br />MEDELLIN CARRERA 99 No. 99-10 TEL: 878787878 - FAX: 6767676<br />BOGOTA AC. 55 # 55A-55 TELS: 5555555/33/39 FAX: 555555 EXT. 115 / CLL 88 No 88-88 TEL: 8888-555555<br />MANIZALES CARRERA 88 # 88-11 PBX: 8849197 FAX: (6) 8847242 /AVENIDA 88 No. 65 -180 Tel 8815888<br />PEREIRA # 78-90 PBX: 8888 FAX 3204747 /AV. 50  # 33-67 TELS: 67676676 FAX: 767676<br /><br />CONDICIONES COMERCIALES DE VENTA DE VEHICULO NUEVO<br /><br />1. GARANTIA: SU ORGANIZACION y el Fabricante/Importador garantizan el funcionamiento del veh&iacute;culo en los t&eacute;rminos y condiciones del Manual de Garant&iacute;a que se entrega con el automotor. Estimado consumidor usted tiene derecho a presentar Peticiones, Quejas o Reclamos ante cualquier insatisfacci&oacute;n por el presunto incumplimiento de los t&eacute;rminos y condiciones de la garant&iacute;a respecto del producto adquirido. Toda nuestra red de distribuci&oacute;n tiene implementado un mecanismo de atenci&oacute;n y tr&aacute;mite de PQR`s. Las normas de protecci&oacute;n al consumidor relativas a los derechos que le asisten est&aacute;n contenidas en la Ley 1480 de 2011. Le informamos que nuestra l&iacute;nea de atenci&oacute;n al cliente es (6)8989896 &oacute; cel. 3205689858.<br /></div>");
}

function mostrar_logo_empresa($idformato,$iddoc){
	global $conn;
	if($_REQUEST['tipo']!="5"){
		echo("<img src='../../imagenes/logo_demo.jpg' style='width:150px; heigth:120px;'>");
	}else{
		echo("<img src='../../imagenes/logo_demo.jpg' style='width:150px; heigth:120px;'>");
	}
}

function numerotexto ($numero) {
    // Primero tomamos el numero y le quitamos los caracteres especiales y extras
    // Dejando solamente el punto "." que separa los decimales
    // Si encuentra mas de un punto, devuelve error.
    // NOTA: Para los paises en que el punto y la coma se usan de forma
    // inversa, solo hay que cambiar la coma por punto en el array de "extras"
    // y el punto por coma en el explode de $partes
   
    $extras= array("/[\$]/","/ /","/,/","/-/");
    $limpio=preg_replace($extras,"",$numero);
    $partes=explode(".",$limpio);
    if (count($partes)>2) {
        return "Error, el n&uacute;mero no es correcto";
        exit();
    }
   
    // Ahora explotamos la parte del numero en elementos de un array que
    // llamaremos $digitos, y contamos los grupos de tres digitos
    // resultantes
   
    $digitos_piezas=chunk_split ($partes[0],1,"#");
    $digitos_piezas=substr($digitos_piezas,0,strlen($digitos_piezas)-1);
    $digitos=explode("#",$digitos_piezas);
    $todos=count($digitos);
    $grupos=ceil (count($digitos)/3);
   
    // comenzamos a dar formato a cada grupo
   
    $unidad = array   ('un','dos','tres','cuatro','cinco','seis','siete','ocho','nueve');
    $decenas = array ('diez','once','doce', 'trece','catorce','quince');
    $decena = array   ('dieci','veinti','treinta','cuarenta','cincuenta','sesenta','setenta','ochenta','noventa');
    $centena = array   ('ciento','doscientos','trescientos','cuatrocientos','quinientos','seiscientos','setecientos','ochocientos','novecientos');
    $resto=$todos;
   
    for ($i=1; $i<=$grupos; $i++) {
       
        // Hacemos el grupo
        if ($resto>=3) {
            $corte=3; } else {
            $corte=$resto;
        }
            $offset=(($i*3)-3)+$corte;
            $offset=$offset*(-1);
       
        // la siguiente seccion es una adaptacion de la contribucion de cofyman y JavierB
       
        $num=implode("",array_slice ($digitos,$offset,$corte));
        $resultado[$i] = "";
        $cen = (int) ($num / 100);              //Cifra de las centenas
        $doble = $num - ($cen*100);             //Cifras de las decenas y unidades
        $dec = (int)($num / 10) - ($cen*10);    //Cifra de las decenas
        $uni = $num - ($dec*10) - ($cen*100);   //Cifra de las unidades
        if ($cen > 0) {
           if ($num == 100) $resultado[$i] = "cien";
           else $resultado[$i] = $centena[$cen-1].' ';
        }//end if
        if ($doble>0) {
           if ($doble == 20) {
              $resultado[$i] .= " veinte";
           }elseif (($doble < 16) and ($doble>9)) {
              $resultado[$i] .= $decenas[$doble-10];
           }else {
              $resultado[$i] .=' '. $decena[$dec-1];
           }//end if
           if ($dec>2 and $uni<>0) $resultado[$i] .=' y ';
           if (($uni>0) and ($doble>15) or ($dec==0)) {
              if ($i==1 && $uni == 1) $resultado[$i].="uno";
              elseif ($i==2 && $num == 1) $resultado[$i].="";
              else $resultado[$i].=$unidad[$uni-1];
           }
        }

        // Le agregamos la terminacion del grupo
        switch ($i) {
            case 2:
            $resultado[$i].= ($resultado[$i]=="") ? "" : " mil ";
            break;
            case 3:
            $resultado[$i].= ($num==1) ? " millon " : " millones ";
            break;
        }
        $resto-=$corte;
    }
   
    // Sacamos el resultado (primero invertimos el array)
    $resultado_inv= array_reverse($resultado, TRUE);
    $final="";
    foreach ($resultado_inv as $parte){
        $final.=$parte;
    }
    return strtoupper($final);
}
?>