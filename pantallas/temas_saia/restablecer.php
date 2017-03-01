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

		$sql1='UPDATE configuracion SET valor="#6BA5DD,#0044CC" WHERE nombre="btn_primary"';
		phpmkr_query($sql1);
		$sql2='UPDATE configuracion SET valor="#0B7BB6" WHERE nombre="letra_tabs_superior"';
		phpmkr_query($sql2);
		$sql3='UPDATE configuracion SET valor="#0B7BB6" WHERE nombre="color_letra_ppal"';
		phpmkr_query($sql3);
		$sql4='UPDATE configuracion SET valor="#0B7BB6" WHERE nombre="letra_tabs"';
		phpmkr_query($sql4);
		$sql5='UPDATE configuracion SET valor="#EDF9FF,#EDF9FF" WHERE nombre="fondo_tab"';
		phpmkr_query($sql5);
		$sql6='UPDATE configuracion SET valor="#57B0DE" WHERE nombre="color_encabezado"';
		phpmkr_query($sql6);
		$sql7='UPDATE configuracion SET valor="#6BA5DD,#196BBA" WHERE nombre="barra_busqueda"';
		phpmkr_query($sql7);
		$sql8='UPDATE configuracion SET valor="#0044cc" WHERE nombre="boton_hover"';
		phpmkr_query($sql8);
		$sql9='UPDATE configuracion SET valor="#CCCCCC" WHERE nombre="foco_input"';
		phpmkr_query($sql9);
		$sql10='UPDATE configuracion SET valor="#CCCCCC" WHERE nombre="borde_input"';
		phpmkr_query($sql10);
		$sql11='UPDATE configuracion SET valor="#006699" WHERE nombre="enlace_hover"';
		phpmkr_query($sql11);
		$sql12='UPDATE configuracion SET valor="#FFFFFF" WHERE nombre="letra_panel_kaiten"';
		phpmkr_query($sql12);
		$sql13='UPDATE configuracion SET valor="#69B3E3" WHERE nombre="barra_inferior"';
		phpmkr_query($sql13);
		$sql14='UPDATE configuracion SET valor="#69B3E3" WHERE nombre="imagen_minimizar"';
		phpmkr_query($sql14);
		$sql15='UPDATE configuracion SET valor="#69B3E3" WHERE nombre="icono_maximizar"';
		phpmkr_query($sql15);
		
		
		$datos=busca_filtro_tabla("valor","configuracion","nombre='logo_saia_inicio_principal'","",$conn);
		if($datos[0]['valor']!=""){
		
		$aleatorio=rand(1,999)."_".date("Ymd");
		rename($ruta_db_superior.'imagenes/login/mainbkg.png',$ruta_db_superior.'imagenes/login/mainbkg'.$aleatorio.'.png');
		
		rename($ruta_db_superior.'imagenes/login/'.$datos[0]['valor'],$ruta_db_superior.'imagenes/login/mainbkg.png');
		phpmkr_query("UPDATE configuracion SET valor='' WHERE nombre='logo_saia_inicio_principal'");
		}
		
		$datos1=busca_filtro_tabla("valor","configuracion","nombre='logo_fondo_inicio_principal'","",$conn);
		if($datos1[0]['valor']!=""){
		$aleatorio1=rand(1,999)."_".date("Ymd");
		rename($ruta_db_superior.'imagenes/login/loginbkg.png',$ruta_db_superior.'imagenes/login/loginbkg'.$aleatorio1.'.png');
		
		rename($ruta_db_superior.'imagenes/login/'.$datos1[0]['valor'],$ruta_db_superior.'imagenes/login/loginbkg.png');
		phpmkr_query("UPDATE configuracion SET valor='' WHERE nombre='logo_fondo_inicio_principal'");
		}

		$datos2=busca_filtro_tabla("valor","configuracion","nombre='icono_saia_principal'","",$conn);
		
		if($datos2[0]['valor']!=""){		
		$aleatorio2=rand(1,999)."_".date("Ymd");
		rename($ruta_db_superior.'asset/img/layout/logosaia.png',$ruta_db_superior.'asset/img/layout/logosaia'.$aleatorio2.'.png');
		
		rename($ruta_db_superior.'asset/img/layout/'.$datos2[0]['valor'],$ruta_db_superior.'asset/img/layout/logosaia.png');
		phpmkr_query("UPDATE configuracion SET valor='' WHERE nombre='icono_saia_principal'");
		}
		
		//return json_encode($datos);
		
		
		
		
		
		
		
		