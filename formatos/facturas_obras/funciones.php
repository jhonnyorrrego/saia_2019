<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "app/qr/librerias.php");

/*ADICIONAR*/
function mostrar_radicado_obra($idformato, $iddoc) {
    global $conn;
    $fecha = date('Y-m-d');
    if ($_REQUEST["iddoc"]) {
        $doc = busca_filtro_tabla("numero", "documento a", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
        echo '<td id="numero_radicado"><b>' . $doc[0]["numero"] . '</b></td>';
    } else
        echo '<td id="numero_radicado">' . $fecha . "-<b>" . muestra_contador("radicacion_entrada") . '</b>-E</td>';
}
/*ADICIONAR-EDITAR*/
function add_edit_rad_obras($idformato,$iddoc) {
	global $conn,$ruta_db_superior;
	if ($_REQUEST["iddoc"]) {
		$opt = 1;
	} else {
		$opt = 0;
	}
	?>
	<script>
		$(document).ready(function() {
			var opt=parseInt(<?php echo $opt;?>);
			if(opt==0){
				$("#vence_factura").val("");
			}
			$("#vence_factura").after('<input type="button" value="Cargar Fecha" id="btn">');
			$("#valor_factura").keyup(function() {
				this.value = (this.value + '').replace(/[^0-9]/g, '');
				separador_miles(this.id)
			});
			
			$("#btn").click(function (){
				obtener_fecha_ven(0);
			});
			
		});
		
		$("#formulario_formatos").validate({
		  submitHandler: function(form) {
		    var valor=$("#valor_factura").val().replace(/\./g, '');
		    $("#valor_factura").val(valor);
		    var ok=obtener_fecha_ven();
		    if(ok){
		    	form.submit();
		    }else{
		    	return false;
		    }
		  }
		});
		
		function obtener_fecha_ven(){
			var retorno=false;
			var fecha=$("#fecha_factura").val();
			if(fecha!="0000-00-00" && fecha!=""){
				$.ajax({
				  method: "POST",
				  url: "<?php echo $ruta_db_superior;?>formatos/facturas_obras/ajax_rad_obras.php",
				  data: { fecha: fecha, opt: 1, cant_dias:30 },
				  dataType: "json",
				  async:false,
				  success:function (data){
				  	if(data.exito==1){
				  		$("#vence_factura").val(data.fecha_habil);
				  		retorno=true;
				  	}else{
				  		alert(data.msn);
				  	}
				  },error: function (){
				  	alert("Error en el servidor, intente de nuevo");
				  	return false;
				  }
				});
			}else{
				alert("Por favor ingrese la fecha de la factura");
				return false;
			}
			return retorno;
		}
		

		function separador_miles(input) {
			var dec = 0;//cantidad decimales
			var pat = /[\*,\+,\(,\),\?,\\,\$,\[,\],\^]/;
			var valor = $("#" + input).val().replace(/\./g, '');
			var largo = $("#" + input).val().replace(/\./g, '').length;
			var nums = new Array();
			cont = 0;
			for ( m = 0; m < largo; m++) {
				if (valor.charAt(m) == "." || valor.charAt(m) == " " || valor.charAt(m) == ",") {
					continue;
				} else {
					nums[cont] = valor.charAt(m)
					cont++
				}
			}
			ctdd = eval(1 + dec);
			nmrs = dec;
	
			var cad1 = "", cad2 = "", cad3 = "",  tres = 0
			if (largo > nmrs) {
				for ( k = nums.length - ctdd; k >= 0; k--) {
					cad1 = nums[k]
					cad2 = cad1 + cad2
					tres++
					if ((tres % 3) == 0) {
						if (k != 0) {
							cad2 = "." + cad2
						}
					}
				}
				for ( dd = dec; dd > 0; dd--) {
					cad3 += nums[nums.length - dd]
				}
				if (dec !=0) {
					cad2 += "," + cad3
				}
				$("#" + input).val(cad2);
			}
		}
	</script>
	<?php
}

/*POSTERIOR EDITAR*/
function post_edit_rad_obras($idformato, $iddoc){
	global $conn;
	$datos = busca_filtro_tabla("d.estado,ft.vence_factura,ft.destino,ft.copia", "ft_facturas_obras ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=".$iddoc, "", $conn);
	if($datos[0]["estado"]=="INICIADO"){
		$update="UPDATE documento SET estado='APROBADO' WHERE iddocumento=".$iddoc;
		phpmkr_query($update);
		post_aprob_rad_obras($idformato, $iddoc);
	}else{
		if($datos[0]["vence_factura"]!=""){
			$update="UPDATE documento SET fecha_limite=".fecha_db_almacenar($datos[0]["vence_factura"],"Y-m-d")." WHERE iddocumento=".$iddoc;
			phpmkr_query($update);
		}
	}
	return;
}

/*MOSTRAR*/
function mostrar_destino_facturas_obras($idformato,$iddoc){
    global $conn;
    $funcionario=busca_filtro_tabla("a.nombres,a.apellidos","vfuncionario_dc a, ft_facturas_obras b","a.iddependencia_cargo=b.destino AND b.documento_iddocumento=".$iddoc,"",$conn);
    echo($funcionario[0]['nombres']." ".$funcionario[0]['apellidos']);
}
function cargar_datos_rad_obras($idformato, $iddoc) {
	global $conn, $datos;
	$html="";
	$datos = busca_filtro_tabla("valor_factura,d.estado,".fecha_db_obtener("ft.fecha_accion_pago","Y-m-d")." as fecha_accion_pago,ft.func_fecha_pago,".fecha_db_obtener("d.fecha","Y-m-d")." as fecha,".fecha_db_obtener("ft.vence_factura","Y-m-d")." as vence_factura,".fecha_db_obtener("ft.fecha_pago","Y-m-d")." as fecha_pago,ft.dependencia,d.numero,ft.serie_idserie,DATEDIFF(day, CONVERT(date, GETDATE()),CONVERT(date, ft.vence_factura)) as dias", "ft_facturas_obras ft,documento d", "d.iddocumento=ft.documento_iddocumento and d.iddocumento=".$iddoc, "", $conn);
	if($datos["numcampos"]){
		if($datos[0]["estado"]=="INICIADO" && $_REQUEST["tipo"]!=5){
			$html='<button class="btn btn-mini btn-warning" onclick="window.location=\'editar_facturas_obras.php?iddoc='.$iddoc.'&idformato='.$idformato.'\'">Llenar datos</button>';
		}
	}
	echo $html;
}
function mostrar_valor_factura($idformato, $iddoc) {
	global $conn, $datos;
	echo(number_format($datos[0]['valor_factura'],0,"","."));
}
function ver_qr_rad_obras($idformato, $iddoc){
	global $conn,$datos;
	$html=mostrar_codigo_qr($idformato,$iddoc,true);
	$dependencia_creador = busca_filtro_tabla("b.codigo", "vfuncionario_dc a, dependencia b", "b.iddependencia=a.iddependencia AND a.iddependencia_cargo=" . $datos[0]['dependencia'], "", $conn);
	if($dependencia_creador["numcampos"]){
		$html.="<br/>".$dependencia_creador[0]['codigo']."-";
	}
	$html.=$datos[0]["fecha"]."-".$datos[0]['numero']."-E";
	echo $html;
}

function color_vence_factura($idformato, $iddoc){
	global $conn,$datos;
	if($datos[0]["vence_factura"]!=""){
		$array_color=array(0=>'class="badge badge-info"',1=>'class="badge badge-warning"',2=>'class="badge badge-success"');
		$dia=intval($datos[0]["dias"]);
		if($dia<=0){
			$color=0;
		}else if($dia>0 && $dia<6){
			$color=1;
		}else{
			$color=2;
		}
		$html='<span '.$array_color[$color].'>'.$datos[0]["vence_factura"].'</span>';	
	}
	echo $html;
}

function ver_tipo_doc($idformato, $iddoc){
	global $conn,$datos;
	$html="";
	$tipo_doc=busca_filtro_tabla("nombre","serie","idserie=".$datos[0]["serie_idserie"],"",$conn);
	if($tipo_doc["numcampos"]){
		$html=$tipo_doc[0]["nombre"];
	}
	echo $html;
}

function ver_fecha_pago($idformato, $iddoc){
	global $conn,$datos,$ruta_db_superior;
	$html="";
	//if($datos[0]["fecha_pago"]!=""){
		$fun=busca_filtro_tabla("nombres,apellidos","funcionario","idfuncionario=".$datos[0]["func_fecha_pago"],"",$conn);
		$html.=$datos[0]["fecha_pago"]."<br/><strong>Funcionario:</strong> ".ucwords(strtolower($fun[0]["nombres"]." ".$fun[0]["apellidos"]))."<br/><strong>Fecha:</strong> ".$datos[0]["fecha_accion_pago"];
	//}else{
		$html.="<a class='btn btn-mini btn-warning' onclick=\"return hs.htmlExpand(this, { objectType: 'iframe',width: 300, height:190,preserveContent:false } )\" target='_blank' href='actualiza_fecha_pago.php?iddoc=".$iddoc."&idformato=".$idformato."'>Fecha Pago</a>";
	//}
	echo $html;
	?>
		<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		<script type='text/javascript'>
			hs.graphicsDir = '<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.close = function() {
				window.location = "<?php echo($ruta_db_superior); ?>formatos/facturas_obras/mostrar_facturas_obras.php?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($idformato); ?>";
			}
		</script>
	<?php
}

/*POSTERIOR APROBAR*/
function post_aprob_rad_obras($idformato, $iddoc){
	global $conn;
	
	//distribucion
	include_once($ruta_db_superior."app/distribucion/funciones_distribucion.php");
	pre_ingresar_distribucion($iddoc,'persona_natural',2,'destino',1);	
	
	$datos = busca_filtro_tabla("vence_factura,valor_factura,persona_natural,destino", "ft_facturas_obras", "documento_iddocumento=".$iddoc, "", $conn);
	if($_REQUEST["radicacion_rapida"]==1){
		$update="UPDATE documento SET estado='INICIADO' WHERE iddocumento=".$iddoc;
		phpmkr_query($update);
	}else{
		if($datos["numcampos"]){
			if($datos[0]["destino"]!="-" && $datos[0]["destino"]!=0){
				transferencia_automatica($idformato, $iddoc,$datos[0]["destino"], 1, "Transferido al Destino");
			}
			if($datos[0]["copia"]!="-" && $datos[0]["copia"]!=0){
				transferencia_automatica($idformato, $iddoc,$datos[0]["destino"], 2, "Transferido a Copia Electronica");
			}
			if($datos[0]["vence_factura"]!=""){
				$update="UPDATE documento SET fecha_limite=".fecha_db_almacenar($datos[0]["vence_factura"],"Y-m-d")." WHERE iddocumento=".$iddoc;
				phpmkr_query($update);
			}
		}
		if ($_REQUEST["digitalizacion"] == 1) {
			$enlace = "paginaadd.php?key=" . $iddoc . "&enlace2=formatos/facturas_obras/detalles_mostrar_facturas_obras.php?iddoc=" . $iddoc."&idformato=".$idformato;
			abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, "_self");
			die();
		}else if ($_REQUEST["digitalizacion"] == 0) {
			$enlace = "ordenar.php?key=" . $iddoc . "&mostrar_formato=1";
			abrir_url($ruta_db_superior . "colilla.php?target=_self&key=" . $iddoc . "&enlace=" . $enlace, '_self');
			die();
		}
	}
	return;
}
