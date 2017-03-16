<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo( librerias_jquery('1.7'));
echo(estilo_file_upload());
echo(librerias_notificaciones());

echo(estilo_bootstrap());
echo(librerias_bootstrap());


if ($_REQUEST['enviar']) {
		$sql1='UPDATE configuracion SET valor="#'.$_REQUEST["color_btn_buscar_exportar_ini"].',#'.$_REQUEST["color_btn_buscar_exportar_fin"].'" WHERE nombre="btn_primary"';
		phpmkr_query($sql1);
		$sql2='UPDATE configuracion SET valor="#'.$_REQUEST["enlace_superior"].'" WHERE nombre="letra_tabs_superior"';
		phpmkr_query($sql2);
		$sql3='UPDATE configuracion SET valor="#'.$_REQUEST["color_letra_submodulo"].'" WHERE nombre="color_letra_ppal"';
		phpmkr_query($sql3);
		$sql4='UPDATE configuracion SET valor="#'.$_REQUEST["color_letra_modulo"].'" WHERE nombre="letra_tabs"';
		phpmkr_query($sql4);
		$sql5='UPDATE configuracion SET valor="#'.$_REQUEST["fondo_tab_ini"].',#'.$_REQUEST["fondo_tab_fin"].'" WHERE nombre="fondo_tab"';
		phpmkr_query($sql5);
		$sql6='UPDATE configuracion SET valor="#'.$_REQUEST["color_encabezado_list"].'" WHERE nombre="color_encabezado"';
		phpmkr_query($sql6);
		$sql7='UPDATE configuracion SET valor="#'.$_REQUEST["color_barra_busqueda_ini"].',#'.$_REQUEST["color_barra_busqueda_fin"].'" WHERE nombre="barra_busqueda"';
		phpmkr_query($sql7);
		$sql8='UPDATE configuracion SET valor=#'.$_REQUEST["boton_hover"].' WHERE nombre="boton_hover"';
		phpmkr_query($sql8);
		$sql9='UPDATE configuracion SET valor="#'.$_REQUEST["foco_input"].'" WHERE nombre="foco_input"';
		phpmkr_query($sql9);
		$sql10='UPDATE configuracion SET valor="#'.$_REQUEST["border_input"].'" WHERE nombre="borde_input"';
		phpmkr_query($sql10);
		$sql11='UPDATE configuracion SET valor="#'.$_REQUEST["enlace_hover"].'" WHERE nombre="enlace_hover"';
		phpmkr_query($sql11);
		$sql12='UPDATE configuracion SET valor="#'.$_REQUEST["letra_panel"].'" WHERE nombre="letra_panel_kaiten"';
		phpmkr_query($sql12);
		$sql13='UPDATE configuracion SET valor="#'.$_REQUEST["color_barra_inferior"].'" WHERE nombre="barra_inferior"';
		phpmkr_query($sql13);
		$sql14='UPDATE configuracion SET valor="#'.$_REQUEST["imagen_minimizar"].'" WHERE nombre="imagen_minimizar"';
		phpmkr_query($sql14);
		$sql15='UPDATE configuracion SET valor="#'.$_REQUEST["icono_maximizar"].'" WHERE nombre="icono_maximizar"';
		phpmkr_query($sql15);
		
		//print_r($_FILES);die();
	if ($_FILES['logo_fondo']['name']!=''){
		$ruta_fondo="imagenes/login/";
		guardar_anexo("logo_fondo",$ruta_fondo,"mainbkg.png");
	}
	if ($_FILES['logo_superior_login']['name']!=''){
		$ruta_fondo="imagenes/login/";
		guardar_anexo("logo_superior_login",$ruta_fondo,"loginbkg.png");
	} 
	if ($_FILES['icono_saia_principal']['name']!=''){
		$ruta_fondo="asset/img/layout/";
		guardar_anexo("icono_saia_principal",$ruta_fondo,"logosaia.png");
	} 
	
	if ($_FILES['logo_saia']['name']!=''){
		$ruta_logo=busca_filtro_tabla("valor","configuracion","nombre='logo'","",$conn);
		$imagen=str_replace(RUTA_LOGO_SAIA, "", $ruta_logo[0]['valor']);
		$ruta_fondo=RUTA_LOGO_SAIA;
		guardar_anexo("logo_saia",$ruta_fondo,$imagen);
	} 
}

function guardar_anexo($nombre_anexo,$ruta_imagen,$imagen_actual){
	global $ruta_db_superior;
	//alerta('paso'); 
	$tipo=explode(".",$_FILES[$nombre_anexo]["name"]);
	$cant=count($tipo);
	$extension=$tipo[$cant-1];
	if($extension=="jpg"||$extension=="jpeg" || $extension=="png"){ 
		$aleatorio="_".rand(1,999)."_".date("Y-m-d");
		$imagen_actual2=explode(".",$imagen_actual);
		rename($ruta_db_superior.$ruta_imagen.$imagen_actual,$ruta_db_superior.$ruta_imagen.$imagen_actual2[0].$aleatorio.".".$imagen_actual2[1]);
		
		if($imagen_actual=='mainbkg.png'){
			$sql='UPDATE configuracion SET valor="'.$imagen_actual2[0].$aleatorio.".".$imagen_actual2[1].'" WHERE nombre="logo_saia_inicio_principal" AND (valor IS NULL OR valor="")';	
		}elseif($imagen_actual=='loginbkg.png'){
			$sql='UPDATE configuracion SET valor="'.$imagen_actual2[0].$aleatorio.".".$imagen_actual2[1].'" WHERE nombre="logo_fondo_inicio_principal" AND (valor IS NULL OR valor="")';	
		}elseif($imagen_actual=='logosaia.png'){
			$sql='UPDATE configuracion SET valor="'.$imagen_actual2[0].$aleatorio.".".$imagen_actual2[1].'" WHERE nombre="icono_saia_principal" AND (valor IS NULL OR valor="")';
		}else{
			$sql='UPDATE configuracion SET valor="'.$imagen_actual2[0].$aleatorio.".".$imagen_actual2[1].'" WHERE nombre="logo_saia_anterior" AND (valor IS NULL OR valor="")';
		}
		phpmkr_query($sql);
		//print_r($sql);
				
		rename($_FILES[$nombre_anexo]["tmp_name"],$ruta_db_superior.$ruta_imagen.$imagen_actual);
		chmod($ruta_db_superior.$ruta_imagen.$imagen_actual,0777); 
			
	} 
	else{
		alerta("El archivo no es valido");
		return false;
	}
	return true;
}


$datos=busca_filtro_tabla("","configuracion","tipo IN('temas_main','temas_bootstrap','temas_kaiten')","",$conn);
for ($i=0; $i < $datos['numcampos']; $i++) { 
	switch ($datos[$i]['nombre']) {
		case 'letra_tabs_superior':
				$letra_tabs_superior=$datos[$i]['valor']; 
			break;
		case 'enlace_hover':
				$enlace_hover=$datos[$i]['valor'];
			break;
		case 'fondo_tab':
				$fondo_tab=explode(",",$datos[$i]['valor']);
			break;	
		case 'letra_tabs':
				$letra_tabs=$datos[$i]['valor'];
			break;		
		case 'color_letra_ppal':
				$color_letra_ppal=$datos[$i]['valor'];
			break;	
		case 'btn_primary':
				$btn_primary=explode(",", $datos[$i]['valor']);
			break;	
		case 'color_encabezado':
				$color_encabezado_list=$datos[$i]['valor'];
			break;		
		case 'barra_busqueda':
				$barra_busqueda=explode(",", $datos[$i]['valor']);
			break;		
		case 'boton_hover':
				$boton_hover=$datos[$i]['valor'];
			break;	
		case 'foco_input':
				$foco_input=$datos[$i]['valor']; 
			break;	
		case 'borde_input':
				$borde_input=$datos[$i]['valor'];
			break;	
		case 'letra_panel_kaiten':
				$letra_panel_kaiten=$datos[$i]['valor'];
			break;
		case 'barra_inferior':
				$barra_inferior=$datos[$i]['valor'];
			break;
		case 'imagen_minimizar':
				$imagen_minimizar=$datos[$i]['valor'];
			break;
		case 'icono_maximizar':
				$icono_maximizar=$datos[$i]['valor'];
			break;				
	}
}


?>
 
<!DOCTYPE html>
<html lang="es">
	<head>
		<title> SAIA 2.0 Interfaz Saia</title>
		<script type="text/javascript" src="jscolor/jscolor.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/kaiten.min.css">
		<style>
			input.degradado {
				width: 5%;
			}
			html {
            overflow: scroll;
        	}

		</style>
		

	</head>
	<body>

		<div class="container master-container" style="width: 80%; margin: 15px auto;">


			<form enctype="multipart/form-data" accept-charset="UTF-8" id="kformulario_saia"  method="post" class="form-horizontal">
				<legend>
					Interfaz SAIA
				</legend>
<?php			
		if(isset($_POST['enviar'])){ ?>
	
<script>
notificacion_saia('La información ha sido guardada','success','',4000);
</script>

<?php  }?>
				
		</br></br>

				<div class="" data-toggle="collapse" data-target="#div_inicio">
					<i class=""></i><b>Inicio </b>
				</div>
				<div id="div_inicio"  class="collapse opcion_informacion">

				

					<div class="control-group">
						<label class="string required control-label" for="logo_inicio_login"> <b>Logo Inicio Saia (669px x 520px)</b> </label>
						<div class="controls">
							
							<span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:0px; margin-top: 13px;" id="contenedor_anexos">
                  			<span>Examinar</span>
                				<input type="file" ng-disabled="disabled" name="logo_superior_login" id="logo_superior_login">
            				</span>	
							
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="logo_inicio_login"> <b>Logo Fondo (1300px x 700px)</b> </label>
						<div class="controls">
							<span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:0px; margin-top: 5px;" id="contenedor_anexos">
                  			<span>Examinar</span>
                				<input type="file" ng-disabled="disabled" name="logo_fondo" id="logo_fondo">
            				</span>
						</div>
					</div>

				</div>

				<!-- fin inicio -->

				<div data-toggle="collapse" data-target="#div_cent_notific">
					<i class=""></i><b>Centro de notificaciones</b>
				</div>
				<div id="div_cent_notific"  class="collapse opcion_informacion">

					<div class="control-group">
						<label class="string required control-label" for="icono_saia_principal"> <b>Icono saia principal (79px x 39px)</b> </label>
						<div class="controls">
							<span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:0px; margin-top: 10px;" id="contenedor_anexos">
                  			<span>Examinar</span>
                				<input type="file" ng-disabled="disabled" name="icono_saia_principal" id="icono_saia_principal">
            				</span>
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="enlace_superior"> <b>Letra de los enlances superior Saia</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:0px; margin-top: 10px;" class="jscolor {valueElement:'enlace_superior'}">
								
							</button>
							<input  style="width: 65px; margin-left:0px; margin-top: 10px;" id="enlace_superior" name="enlace_superior" value="<?php echo $letra_tabs_superior;?>">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="imagen_minimizar"> <b>Color icono minimizar</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:0px; margin-top: 10px;" class="jscolor {valueElement:'imagen_minimizar'}">
								
							</button>
							<input style="width: 65px; margin-left:0px; margin-top: 10px;" id="imagen_minimizar" name="imagen_minimizar" value="<?php echo $imagen_minimizar;?>">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="icono_maximizar"> <b>Color icono maximizar</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:0px; margin-top: 10px;" class="jscolor {valueElement:'icono_maximizar'}">
								
							</button>
							<input style="width: 65px; margin-left:0px; margin-top: 10px;" id="icono_maximizar" name="icono_maximizar" value="<?php echo $icono_maximizar;?>">
						</div>
					</div>

				</div>

				<!-- fin notificaciones -->

				<div data-toggle="collapse" data-target="#div_modulo">
					<i class=""></i><b>Módulo</b>
				</div>
				<div id="div_modulo"  class="collapse opcion_informacion">

					<div class="control-group">
						<label class="string required control-label" for="fondo_tab_ini"> <b>Fondo tab de módulos</b> </label>

						<div class="controls">
							<input type="text" class="degradado" id="fondo_tab_modulo" name="degradado_fondo_tab_modulo" width="30px" height="30px" readonly="true">
							<button style="height: 25px;" class="jscolor {valueElement:'fondo_tab_ini'}">
								
							</button>
							<input style="width: 65px;" nombre="fondo" id="fondo_tab_ini" class="color_ini  color" name="fondo_tab_ini" value="<?php echo $fondo_tab[0]?>">
							<button style="height: 25px;" class="jscolor {valueElement:'fondo_tab_fin'}">
								
							</button>
							<input style="width: 65px;" nombre="fondo" id="fondo_tab_fin" class="color_fin color color" value="<?php echo $fondo_tab[1]?>" name="fondo_tab_fin">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="color_letra_modulo"> <b>Color de letras de modulo</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:31px;" class="jscolor {valueElement:'color_letra_modulo'}">
								
							</button>
							<input style="width: 65px;" id="color_letra_modulo" name="color_letra_modulo" value="<?php echo $letra_tabs;?>">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="color_letra_submodulo"> <b>Color de letras en enlaces de submodulos</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:31px; margin-top: 10px;" class="jscolor {valueElement:'color_letra_submodulo'}">
								
							</button>
							<input style="width: 65px; margin-left:0px; margin-top: 10px;" id="color_letra_submodulo" name="color_letra_submodulo" value="<?php echo $color_letra_ppal;?>">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="barra_inferior_footer"> <b>Barra inferior footer</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:31px;" class="jscolor {valueElement:'color_barra_inferior'}">
								
							</button>
							<input style="width: 65px;" id="color_barra_inferior" name="color_barra_inferior" value="<?php echo $barra_inferior;?>">
						</div>
					</div>

				</div>

				<!-- fin modulo -->

				<div data-toggle="collapse" data-target="#div_busqueda">
					<i class=""></i><b>Busqueda</b>
				</div>
				<div id="div_busqueda"  class="collapse opcion_informacion">

					<div class="control-group">
						<label class="string required control-label" for="color_btn_buscar_exportar_ini"> <b>Color botón buscar y exportar</b> </label>
						<div class="controls">
							<input type="text" class="degradado" id="btn_busqueda_tab_modulo" name="degradado_boton_busca_exportar" width="30px" height="30px" readonly="true">
							
							<button style="height: 25px;" class="jscolor {valueElement:'btn_busqueda_tab_ini'}">
								
							</button>
							<input  style="width: 65px;" nombre ="btn_busqueda" class="color_ini color" id="btn_busqueda_tab_ini" name="color_btn_buscar_exportar_ini" value="<?php echo $btn_primary[0]?>">
							<button style="height: 25px;" class="jscolor {valueElement:'btn_busqueda_tab_fin'}">
								
							</button>
							<input style="width: 65px;" class="color_fin color" id="btn_busqueda_tab_fin" value="<?php echo $btn_primary[1]?>" name="color_btn_buscar_exportar_fin">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="color_barra_busqueda_ini"> <b>Color de fondo barra busqueda</b> </label>
						<div class="controls">
							<input type="text" class="degradado" id="color_barra_busqueda_modulo" name="color_barra_busqueda_modulo" width="30px" height="30px" readonly="true">
							<button style="height: 25px;" class="jscolor {valueElement:'color_barra_busqueda_ini'}">
								
							</button>
							<input style="width: 65px;" class="color_ini color" id="color_barra_busqueda_ini" name="color_barra_busqueda_ini" value="<?php echo $barra_busqueda[0]?>">
							<button style="height: 25px;" class="jscolor {valueElement:'color_barra_busqueda_fin'}">
								
							</button>
							<input style="width: 65px;" class="color_fin color" id="color_barra_busqueda_fin" value="<?php echo $barra_busqueda[1]?>" name="color_barra_busqueda_fin">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="letra_panel"> <b>Letra panel</b> </label>
						<div class="controls">
							<button style="height: 25px; margin-left:31px;" class="jscolor {valueElement:'letra_panel'}">
								
							</button>
							<input style="width: 65px;" id="letra_panel" value="<?php echo $letra_panel_kaiten;?>" name="letra_panel">
						</div>
					</div>

				</div>

				<div data-toggle="collapse" data-target="#div_contenido">
					<i class=""></i><b>Contenido</b>
				</div>
				<div id="div_contenido"  class="collapse opcion_informacion">


					<div class="control-group">
						<label class="string required control-label" for="logo_saia"> <b>Logo Saia (100px x 90px)</b> </label>
						<div class="controls">
							<span class="btn btn-mini btn-default fileinput-button" ng-class="{disabled: disabled}" style="margin-left:0px; margin-top: 5px;" id="contenedor_anexos">
                  			<span>Examinar</span>
                				<input type="file" ng-disabled="disabled" name="logo_saia" id="logo_saia">
            				</span>
						
						</div>
					</div>
					
					<div class="control-group">
						<label class="string required control-label" for="color_encabezado_list"><b>Color fondo encabezado list</b> </label>
						<div class="controls">
			
							<button style="height: 25px;" class="jscolor {valueElement:'color_encabezado_list_fin'}">
								
							</button>
							<input style="width: 65px;" class="color_fin color" id="color_encabezado_list_fin" value="<?php echo $color_encabezado_list;?>" name="color_encabezado_list">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="boton_hover"> <b>Botón hover</b> </label>
						<div class="controls">
							<button style="height: 25px;" class="jscolor {valueElement:'boton_hover', onFineChange:'setTextColor(this)'}">
								
							</button>
							<input style="width: 65px;" id="boton_hover" value="<?php echo $boton_hover;?>" name="boton_hover">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="foco_input"> <b>Foco input</b> </label>
						<div class="controls">
							<button style="height: 25px;" class="jscolor {valueElement:'foco_input'}">
								
							</button>
							<input style="width: 65px;" id="foco_input" value="<?php echo $foco_input;?>" name="foco_input">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="border_input"> <b>Border input</b> </label>
						<div class="controls">
							<button style="height: 25px;" class="jscolor {valueElement:'border_input'}">
								
							</button>
							<input style="width: 65px;" id="border_input" value="<?php echo $borde_input;?>" name="border_input">
						</div>
					</div>

					<div class="control-group">
						<label class="string required control-label" for="enlace_hover"> <b>Enlace hover</b> </label>
						<div class="controls">
							<button style="height: 25px;" class="jscolor {valueElement:'enlace_hover'}">
								
							</button>
							<input style="width: 65px;" id="enlace_hover" value="<?php echo $enlace_hover;?>" name="enlace_hover">
							<br>
							<br>
						</div>
					</div>
				</div>
				
				</br></br>
				<input class="btn btn-primary dropdown-toggle btn-mini" type="submit" name="enviar" id="enviar" value="Guardar Cambios"> <input class="btn btn-warning dropdown-toggle btn-mini" type="button" name="restablecer" id="restablecer" value="Restablecer" style="margin-left: 25px;">

			</form>
			
			
		</div>
<script>
	$(document).ready(function() {
		
		$('#restablecer').click(function() {
		  $.ajax({
                        type:'POST',
                        dataType: 'json',
                        url: "restablecer.php",
                        data: {
                                        idft_solicitud:'seleccionado'
                        },
                        success: function(datos){
                        	//alert(datos);
                            window.history.back();
                            notificacion_saia('Se han restablecido las caracteristicas por defecto de SAIA','success','',4000);
                        }
                    });   
		});
		
		
		
		$(".opcion_informacion").prev().children("i").addClass("icon-plus-sign");

		$(".opcion_informacion").on("hide", function() {
			$(this).prev().children("i").removeClass();
			$(this).prev().children("i").addClass("icon-plus-sign");
		});
		$(".opcion_informacion").on("show", function() {
			$(this).prev().children("i").removeClass();
			$(this).prev().children("i").addClass("icon-minus-sign");
		});
		
		
		
		$('.color').change(function() {
			
			
			var fondo_modulo=$(this).attr("id").replace("_ini","").replace("_fin","");
			
			generar_degradado(fondo_modulo);									
			
		});	
					
		generar_degradado("fondo_tab");
		generar_degradado("btn_busqueda_tab");
		generar_degradado("color_barra_busqueda");
		
	}); 
	
	function generar_degradado(fondo_modulo){
			
			var fondo_inicial=$("#"+fondo_modulo+"_ini").val();
			var fondo_fin=$("#"+fondo_modulo+"_fin").val();
			
			var str = fondo_inicial;
			fondo_inicial = str.replace("#","");

			
			var str2 = fondo_fin;
			fondo_fin = str2.replace("#","");
			
//			console.log("linear-gradient(#" + fondo_inicial + ",#" + fondo_fin + ")")
			//$('#'+fondo_modulo+"_modulo").css("background", "-webkit-linear-gradient(#" + fondo_inicial + ",#" + fondo_fin + ")");
			
			$('#'+fondo_modulo+"_modulo").css("background", "linear-gradient(#" + fondo_inicial + ",#" + fondo_fin + ")");
							
	}
	
</script>
	</body>
</html>