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

function index_estilos($tipo_tema) {
	global $conn, $ruta_db_superior;
	$configuracion = busca_filtro_tabla("valor,nombre,tipo", "configuracion", "tipo='".$tipo_tema."'", "", $conn);
	//print_r($configuracion);
	$tema_index = "";
	if($configuracion['numcampos']) {
		for ($i = 0; $i < $configuracion['numcampos']; $i++) {
			switch(trim($configuracion[$i]['nombre'])) {
				case 'logo_saia_inicio' :
					$loginbkg = $configuracion[$i]['valor'];
					break;
				case 'barra_inferior' :
					$footer_login = $configuracion[$i]['valor'];
					break;
				case 'logo_fondo_inicio' :
					$body = $configuracion[$i]['valor'];
					break;
				case 'btn_primary' :
					$boton_ui = $configuracion[$i]['valor'];
					break;
				case 'icono_saia' :
					$icono_saia = $configuracion[$i]['valor'];
					break;
				case 'color_letra_ppal':
					$color_letra = $configuracion[$i]['valor'];
					break;
				case 'imagen_minimizar':
					$imagen_minimizar = $configuracion[$i]['valor'];
					break;
				case 'letra_tabs':
					$letra_tabs = $configuracion[$i]['valor'];
					break;
				case 'letra_tabs_superior':
					$letra_tabs_superior = $configuracion[$i]['valor'];
					break;
				case 'fondo_tab' :
					$explode=explode(",",$configuracion[$i]['valor']);
					 $fondo_tabs1=$explode[0];
					 $fondo_tabs2=$explode[1];
					break;
				case 'color_encabezado_list' :
					$encabezado_list = $configuracion[$i]['valor'];
					break;
				case 'color_encabezado' :
					$encabezado_list = $configuracion[$i]['valor'];
					break;
				
				case 'barra_busqueda' :
					$barra_busqueda = $configuracion[$i]['valor'];
					break;
				case 'boton_hover':
					$boton_hover=$configuracion[$i]['valor'];
					break;
				case 'foco_input':
					$foco_input=$configuracion[$i]['valor'];
					break;
				case 'borde_input':
					$borde_input=$configuracion[$i]['valor'];
					break;
				case 'label_info':
					$label_info=$configuracion[$i]['valor'];
					break;
				case 'enlace_hover':
					$enlace_hover=$configuracion[$i]['valor'];
					break;
				case 'icono_maximizar':
					$imagen_minimizar_close=$configuracion[$i]['valor'];
					break;
				case 'letra_panel_kaiten':
					$letra_panel_kaiten=$configuracion[$i]['valor'];
					break;
			}
		}

		switch($tipo_tema) {
		   case "temas_main":
			$tema_index .= '<style type="text/css">
				body, * { font-family: Verdana, Geneva, sans-serif; font-size: 10px;}
				body { overflow-x:hidden; margin-left: 0px; margin-top: 0px;margin-right: 0px; margin-bottom: 0px; 
				background-image: url('.$ruta_db_superior.'imagenes/login/' . $body . '); background-repeat: repeat-x; background-position: left top; background-color: #e7e7e7; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: normal; }
				#loginForm { margin: auto; width: 700px; height: 180px; }
				#LoginBkg { background-image: url('.$ruta_db_superior.'imagenes/login/' . $loginbkg . '); background-repeat: no-repeat; background-position: center center; }
				.footer_login { font-weight: bold; background-image: url('.$ruta_db_superior.'imagenes/login/'.$footer_login.'); background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: fixed; bottom: 0px; }
				.footer_login_text, .footer_login_text * { color:#FFF; font-size:11px; font-weight:bold; }
				.boton_ui { -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #FFF; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: bold; padding: 10px; border: 1px solid #CCC; }
				.blueTexts { font-family: Verdana, Geneva, sans-serif; font-size: 9px; font-weight: bold; color: #036; text-decoration: none; }
				#CustomerLogoContainer { width: 125px; height: 87px; overflow: hidden; margin-top: 10px; margin-bottom: 5px; }   
				#contenedor_tabla{width: 25%; padding:10px; vertical-align:bottom}
				#texto_pequenio{font-size:10px;font-weight:bold;}
				hr {margin: 2px 0;border: 0;border-top: 1px solid rgb(77, 167, 226);border-bottom: 1px solid rgb(84, 167, 233);}
				#userid, #passwd { background-color: transparent; height: auto; width: 200px; font-family: Verdana, Geneva, sans-serif; font-size: 20px; color: #999; font-weight: bold; margin-bottom:3px}
				a { color: '.$color_letra.'; text-decoration: underline; font-weight: bold; }
				a:hover { text-decoration: none; color: '.$enlace_hover.'; }
				.footer_login { font-weight: bold; background-color:'.$footer_login.'; background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: fixed; bottom: 0px; }
				.modbox-saia-main .modbox-saia-main-title {height: 45px; border-bottom:1px solid #E3E3E3; background-position:5px 5px; background-repeat: no-repeat; background-image:url('.$ruta_db_superior.'asset/img/layout/'.$icono_saia.'); background-color:#fff;}
				.icon-collapser { background-color: '.$imagen_minimizar.'; background-image: url('.$ruta_db_superior.'asset/img/layout/'.$imagen_minimizar.'); background-repeat: no-repeat; background-position: right top; height: 29px; width: 47px; float: right; cursor:pointer; margin-top:-29px; }
				
				.icon-collapser-close { background-color: '.$imagen_minimizar_close.'; background-image: url('.$ruta_db_superior.'asset/img/layout/'.$imagen_minimizar_close.'); background-repeat: no-repeat; background-position: right top; height: 29px; width: 47px; float: right; cursor:pointer; margin-top:-29px; }
				#menu-modulos .ac-title { font-weight: bold; color: '.$letra_tabs.'; padding: 2px; border: 1px solid #FFF; background: #EDF9FF; background: -moz-linear-gradient(top, '.$fondo_tabs1.' 0%, '.$fondo_tabs2.' 99%); background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, '.$fondo_tabs1.'), color-stop(99%, '.$fondo_tabs2.'));  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\''.$fondo_tabs1.'\', endColorstr=\''.$fondo_tabs2.'\', GradientType=0 );}
				ul#MenuSaiaVin li a { margin: 0px; list-style-type: none; list-style-position: inside; padding: 0px; text-decoration: none; color: '.$letra_tabs_superior.'; }
				.boton_saia { font-family: "Trebuchet MS", Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; color: #4c4c4c; padding: 5px; width:100px; text-align:center;}
				.sombra_f5 { -webkit-box-shadow: 0px 0px 10px 0px #E4E4E4; -moz-box-shadow: 0px 0px 10px 0px #E4E4E4; box-shadow: 0px 0px 10px 0px #E4E4E4; color:#4c4c4c; }
				</style>';
		break;
		case 'temas_bootstrap':
			$tema_index .= '<style type="text/css">
			.btn-primary{
				  background-color: '.$boton_hover.';
				  background-image: linear-gradient(to top, '.$boton_ui.');
			}
			.btn-primary:hover {
			  background-color: '.$boton_hover.';
			  background-image: linear-gradient(to bottom, '.$boton_ui.');
			}
			.encabezado_list { 
			    background-color: '.$encabezado_list.';
			}
			.encabezado { 
			    background-color: '.$encabezado_list.';
			}
			textarea, input[type="text"], input[type="password"], input[type="datetime"], 
			input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], 
			input[type="week"], input[type="number"], input[type="email"], input[type="url"], 
			input[type="search"], input[type="tel"], input[type="color"], .uneditable-input { 
			  border-color: '.$borde_input.';
			  box-shadow: inset 0 1px 1px '.$foco_input.', 0 0 8px '.$foco_input.';
			}
			textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, 
			input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, 
			input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, 
			input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus,
			 .uneditable-input:focus {
			  border-color: '.$borde_input.';
			  box-shadow: inset 0 1px 1px '.$foco_input.', 0 0 8px '.$foco_input.';
			}
			.label-info, .badge-info {
			    background-color: '.$label_info.';
			}
			</style>';
		break;
		case 'temas_kaiten':
			$tema_index .= '<style type="text/css">
			.k-panel.k-focus .titlebar{
				background:-webkit-linear-gradient('.$barra_busqueda.');
				background-color: #ed8222;
			}
			.k-panel .titlebar .title{width:auto;height:30px;line-height:30px;margin:0 auto;
			font-size:12px;font-weight:bold;color:'.$letra_panel_kaiten.';text-shadow:0 1px 0 black;-moz-user-select:none;
			-webkit-user-select:none;-o-user-select:none;user-select:none;overflow:hidden;
			white-space:nowrap;-o-text-overflow:ellipsis;text-overflow:ellipsis;white-space:nowrap}
			</style>';
		break;
		}
	}
    if($tipo_tema=="temas_index"){
    	$tema_index .= '<style type="text/css">
		body { overflow-x:hidden; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-image: url('.$ruta_db_superior.'imagenes/login/mainbkg.png); background-repeat: repeat-x; background-position: left top; background-color: #e7e7e7; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: normal; }
		#LoginBkg { background-image: url('.$ruta_db_superior.'imagenes/login/loginbkg.png); background-repeat: no-repeat; background-position: center center; }
		#loginForm { margin: auto; width: 700px; height: 180px; }
		.footer_login { font-weight: bold; background-image: url('.$ruta_db_superior.'imagenes/login/footerbkg.png); background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: fixed; bottom: 0px; }
		.footer_login_text, .footer_login_text * { color:#FFF; font-size:11px; font-weight:bold; }
		.blueTexts { font-family: Verdana, Geneva, sans-serif; font-size: 9px; font-weight: bold; color: #036; text-decoration: none; }
		.boton_ui { -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #FFF; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: bold; padding: 10px; border: 1px solid #CCC; }
		#CustomerLogoContainer { width: 125px; height: 87px; overflow: hidden; margin-top: 10px; margin-bottom: 5px; }   
		#contenedor_tabla{width: 25%; padding:10px; vertical-align:bottom}
		#texto_pequenio{font-size:10px;font-weight:bold;}
		hr {margin: 2px 0;border: 0;border-top: 1px solid rgb(77, 167, 226);border-bottom: 1px solid rgb(84, 167, 233);}
		#userid, #passwd { background-color: transparent; height: auto; width: 200px; font-family: Verdana, Geneva, sans-serif; font-size: 20px; color: #999; font-weight: bold; margin-bottom:3px}
		</style>';
    }
    if($tipo_tema=="temas_movil"){
    	$tema_index .= '<style type="text/css">
		body { overflow-x:hidden; margin-left: 0px; margin-top: 0px; margin-right: 0px; margin-bottom: 0px; background-color: #e7e7e7; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: normal;}
		.footer_login { display:none; font-weight: bold; background-image: url('.$ruta_db_superior.'imagenes/login/footerbkg.png); background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: fixed; bottom: 0px; left:0px;}
		.footer_login_text, .footer_login_text * { color:#FFF; font-size:11px; font-weight:bold; }
		.blueTexts { font-family: Verdana, Geneva, sans-serif; font-size: 9px; font-weight: bold; color: #036; text-decoration: none; }
		.boton_ui { -webkit-border-radius: 6px; -moz-border-radius: 6px; border-radius: 6px; background-color: #FFF; font-family: Verdana, Geneva, sans-serif; font-size: 10px; font-weight: bold; padding: 10px; border: 1px solid #CCC; }
		#CustomerLogoContainer { width: 125px; height: 87px; overflow: hidden; margin-top: 10px; margin-bottom: 5px; }   
		#contenedor_tabla{width: 25%; padding:10px; vertical-align:bottom}
		#texto_pequenio{font-size:10px;font-weight:bold;}
		hr {margin: 2px 0;border: 0;border-top: 1px solid rgb(77, 167, 226);border-bottom: 1px solid rgb(84, 167, 233);}
		.form-horizontal .control-label { width: auto; }
		.form-horizontal .control{ text-align:left;}
		</style>';
    }
return $tema_index;
}	
?>