<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
include_once ("db.php");
include_once ("librerias_saia.php");

if (!isset($_GET['fin']) || !$_GET['fin']) {
	echo(estilo_bootstrap());
	echo(librerias_jquery("1.7"));
	echo(librerias_html5());
	echo(librerias_bootstrap());
	echo(librerias_highslide());
}

if ($_SESSION["LOGIN" . LLAVE_SAIA]!="") {
	almacenar_sesion(1, $_SESSION["LOGIN" . LLAVE_SAIA]);
	$usuario =  $_SESSION["usuario_actual"];
	$funcionario_idfuncionario = $_SESSION["idfuncionario"];
		
	$recarga = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='interfaz' AND A.nombre='intervalo_recarga'", "A.fecha DESC", $conn);
	if ($recarga["numcampos"]) {
		$intervalo_recarga_informacion = $recarga[0]["valor"];
	} else {
		$intervalo_recarga_informacion = 900000;
	}
	include_once ($ruta_db_superior . "pantallas/lib/mobile_detect.php");
	$detect = new Mobile_Detect;
	if ($detect -> isMobile()) {
		$_SESSION["tipo_dispositivo"] = "movil";
	}

	$proxima = busca_filtro_tabla("valor", "configuracion", "nombre='actualizacion_fin_anio'", "idconfiguracion DESC", $conn);
	if ($proxima["numcampos"]) {
		$fecha = busca_filtro_tabla(resta_fechas("'" . $proxima[0][0] . "'", "'" . date("Y-m-d") . "'"), "dual", "", "", $conn);
		if (@$fecha[0][0] < 0) {
			alerta("Se van a realizar algunas actualizaciones por el cambio de año, por favor espere.", 'success', 6000);
			abrir_url("actualizacion_cambio_anio.php");
		}
	}

	$mis_roles = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "funcionario_codigo=" . $usuario, "", $conn);
	if ($mis_roles["numcampos"]) {
		$roles = extrae_campo($mis_roles, "iddependencia_cargo");
		$concat = array();
		$cadena_concatenar = array("','", "responsable", "','");
		foreach ($roles AS $key => $value) {
			array_push($concat, concatenar_cadena_sql($cadena_concatenar) . " LIKE('%," . $value . ",%')");
		}
	}

	$permiso = new PERMISO();
	$per_pendientes = $permiso -> acceso_modulo_perfil("documentos_pendientes");
	if ($per_pendientes) {
		$etiquetados = busca_filtro_tabla("c.nombre", "documento a, documento_etiqueta b, etiqueta c", "LOWER(a.estado) NOT IN ('eliminado') AND a.iddocumento=b.documento_iddocumento AND b.etiqueta_idetiqueta=c.idetiqueta AND c.funcionario='" . $usuario . "' GROUP BY a.iddocumento", "", $conn);
		$pendientes = busca_filtro_tabla("count(*) AS cant", "documento A,asignacion B,formato c ", "LOWER(A.estado)<>'eliminado' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=" . $usuario . " and lower(A.plantilla)=c.nombre ", "GROUP BY A.iddocumento", $conn);
		$con_indicador = busca_filtro_tabla("", "documento a, prioridad_documento b,formato c ", "b.documento_iddocumento=a.iddocumento AND b.prioridad in (1,2,3,4,5) AND lower(a.estado) not in('ELIMINADO') AND lower(a.plantilla)=c.nombre AND b.funcionario_idfuncionario=" . $_SESSION["idfuncionario"], "group by a.iddocumento order by a.fecha  desc", $conn);
		$borradores = busca_filtro_tabla("count(*) AS cant", "documento A, formato c ", "ejecutor=" . $usuario . " AND A.estado='ACTIVO' AND A.numero='0' and lower(A.plantilla)=c.nombre", "", $conn);

		$componente_etiquetados = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='documentos_etiquetados'", "", $conn);
		$componente_pendiente = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='documento_pendiente'", "", $conn);
		$componente_prioridad = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='documentos_importantes'", "", $conn);
		$componente_borrador = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='borradores'", "", $conn);

	}

	$per_mis_tareas = $permiso -> acceso_modulo_perfil("mis_tareas");
	if ($per_mis_tareas) {
	$mis_roles=busca_filtro_tabla("","vfuncionario_dc","estado=1 and funcionario_codigo=".$_SESSION["usuario_actual"],"",$conn);
    if($mis_roles["numcampos"]){
      $roles=extrae_campo($mis_roles,"iddependencia_cargo");
      $concat=array();
	  $res_concat=concatenar_cadena_sql(array("','","responsable","','"));
      foreach ($roles AS $key=>$value){
        array_push($concat,$res_concat." LIKE('%,".$value.",%')");
      }
    }
	  
		$tareas=busca_filtro_tabla("count(*) AS cant","tareas A","((".implode(" or ",$concat).")) and estado_tarea<>2 and ruta_aprob<>-1 and ((ruta_aprob>=0 and estado_tarea in (3,4,5)) or(ruta_aprob>=0 and estado_tarea<>-1))","",$conn);
		$componente_tareas = busca_filtro_tabla("", "busqueda_componente A", "A.nombre='mis_tareas_pendientes'", "", $conn);
	}

	$per_mis_tareas_av = $permiso -> acceso_modulo_perfil("mis_tareas_avanzadas");
	if ($per_mis_tareas_av) {
		$tareas_responsable = busca_filtro_tabla("count(*) AS cant", "tareas_listado A", "A.generica=0 AND A.estado_tarea<>'TERMINADO' AND A.listado_tareas_fk<>-1 AND A.cod_padre=0 AND  A.responsable_tarea =" . $_SESSION["idfuncionario"], "", $conn);
		$condicion_coparticipantes_unico = " AND ( a.co_participantes LIKE '%," . $funcionario_idfuncionario . ",%' OR a.co_participantes LIKE '%," . $funcionario_idfuncionario . "' OR a.co_participantes LIKE '" . $funcionario_idfuncionario . ",%' OR  a.co_participantes='" . $funcionario_idfuncionario . "' )";
		$tareas_coparticipante = busca_filtro_tabla("count(*) AS cant", "tareas_listado a", "a.generica=0 AND a.estado_tarea<>'TERMINADO'  AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 " . $condicion_coparticipantes_unico, "", $conn);
		$condicion_seguidores_unico = " AND ( a.seguidores LIKE '%," . $funcionario_idfuncionario . ",%' OR a.seguidores LIKE '%," . $funcionario_idfuncionario . "' OR a.seguidores LIKE '" . $funcionario_idfuncionario . ",%' OR  a.seguidores='" . $funcionario_idfuncionario . "' )";
		$tareas_seguidor = busca_filtro_tabla("count(*) AS cant", "tareas_listado a", "a.generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 " . $condicion_seguidores_unico, "", $conn);
		$tareas_evaluador = busca_filtro_tabla("count(*) AS cant", "tareas_listado A", "A.generica=0 AND A.estado_tarea<>'TERMINADO' AND A.listado_tareas_fk<>-1 AND A.cod_padre=0 AND  A.evaluador =" . $_SESSION["idfuncionario"], "", $conn);

		$condicion_coparticipantes = " OR ( a.co_participantes LIKE '%," . $funcionario_idfuncionario . ",%' OR a.co_participantes LIKE '%," . $funcionario_idfuncionario . "' OR a.co_participantes LIKE '" . $funcionario_idfuncionario . ",%' OR  a.co_participantes='" . $funcionario_idfuncionario . "' )";
		$condicion_seguidores = " OR ( a.seguidores LIKE '%," . $funcionario_idfuncionario . ",%' OR a.seguidores LIKE '%," . $funcionario_idfuncionario . "' OR a.seguidores LIKE '" . $funcionario_idfuncionario . ",%' OR  a.seguidores='" . $funcionario_idfuncionario . "' )";
		$condicion_evaluador = " OR a.evaluador=" . $funcionario_idfuncionario;
		$condicion_tareas_total = "generica=0 AND a.estado_tarea<>'TERMINADO' AND a.listado_tareas_fk<>-1 AND a.cod_padre=0 AND ( a.responsable_tarea=" . $funcionario_idfuncionario . "" . $condicion_coparticipante . $condicion_coparticipantes . $condicion_seguidores . $condicion_evaluador . "  )";
		$tareas_total = busca_filtro_tabla("count(*) AS cant", "tareas_listado a", $condicion_tareas_total, "", $conn);
		//DESARROLLO TODAS LAS TAREAS
		$componente_tareas_responsable = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listado_tareas_responsable'", "", $conn);
		$componente_tareas_coparticipante = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listado_tareas_coparticipante'", "", $conn);
		$componente_tareas_seguidor = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listado_tareas_seguidor'", "", $conn);
		$componente_tareas_evaluador = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listado_tareas_evaluador'", "", $conn);
		$componente_tareas_total = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listado_tareas_total'", "", $conn);
		$componente_planeador = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "lower(nombre)='tareas_listado_paneador'", "", $conn);
	}

	//$actualizaciones = busca_filtro_tabla("count(*) AS cant", "documento_accion A,asignacion B", "A.documento_iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=" . $usuario, "GROUP BY A.documento_iddocumento", $conn);

	include_once ("tarea_limpiar_carpeta.php");
	if (!is_dir($_SESSION["ruta_temp_funcionario"])) {
		mkdir($_SESSION["ruta_temp_funcionario"], 0777, true);
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SAIA-SGDEA</title>
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery-ui.min.js"></script>
<script src="asset/js/main.js"></script>
<link rel="stylesheet" type="text/css" href="asset/css/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="asset/css/main.css"/>
<style type="text/css">
.modal-body{max-height:80%}
.modal-footer{min-height:0}
.footer_login { font-weight: bold; background-color: #69b3e3; background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: fixed; bottom: 0px; }
.footer_login_text, .footer_login_text * { color:#FFF; font-size:10px; font-weight:bold; }
#timer{margin:0px auto 0;width:130px; border: 1px solid;border-radius: 5px;}
#timer .timer_container{padding-right:15px;padding-left:15px;}
#timer .timer_container div{display:table-cell;}
#timer .timer_container .divider{width:10px;}


<?php if($_SESSION["tipo_dispositivo"]=="movil"){ ?>
body {padding-right:0px;padding-left:0px;}
.dropdown-submenu {
    position: relative;
    text-align:left;
}

#left ul.nav {
    margin-bottom: 2px;
    font-size: 12px; /* to change font-size, please change instead .lbl */
    text-align: left;
}
#left ul.nav ul,
#left ul.nav ul li {
    list-style: none!important;
    list-style-type: none!important;
    margin-top: 1px;
    margin-bottom: 1px;
}
#left ul.nav ul {
    padding-left: 0;
    width: auto;
}
#left ul.nav ul.children {
    padding-left: 12px;
    width: auto;
}
#left ul.nav ul.children li{
    margin-left: 0px;
}
#left ul.nav li a:hover {
    text-decoration: none;
}

#left ul.nav li a:hover .lbl {
    color: #999!important;
}

#left ul.nav li.current>a .lbl {
    background-color: #999;
    color: #fff!important;
}

/* parent item */
#left ul.nav li.parent a {
    padding: 0px;
    color: #ccc;
}
#left ul.nav>li.parent>a {
    border: solid 1px #999;
    text-transform: uppercase;
}    
#left ul.nav li.parent a:hover {
    background-color: #fff;
    -webkit-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);
    -moz-box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);
    box-shadow:inset 0 3px 8px rgba(0,0,0,0.125);    
}

/* link tag (a)*/
#left ul.nav li.parent ul li a {
    color: #222;
    border: none;
    display:block;
    padding-left: 5px;    
}

#left ul.nav li.parent ul li a:hover {
    background-color: #fff;
    -webkit-box-shadow:none;
    -moz-box-shadow:none;
    box-shadow:none;  
}

/* sign for parent item */
#left ul.nav li .sign {
    display: inline-block;
    width: 14px;
    padding: 10px 8px;
    background-color: transparent;
    color: #fff;
}
#left ul.nav li.parent>a>.sign{
    margin-left: 0px;
    background-color: #999;
}

/* label */
#left ul.nav li .lbl {
    padding: 5px 12px;
    display: inline-block;
}
#left ul.nav li.current>a>.lbl {
    color: #fff;
}
#left ul.nav  li a .lbl{
    font-size: 12px;
}



/* theme 2 */
#left ul.nav>li.item-8.parent>a {
    border: solid 1px #51c3eb;
}
#left ul.nav>li.item-8.parent>a>.sign,
#left ul.nav>li.item-8 li.parent>a>.sign{
    margin-left: 0px;
    background-color: #51c3eb;
}
#left ul.nav>li.item-8 .lbl {
    color: #51c3eb;
}
#left ul.nav>li.item-8 li.current>a .lbl {
    background-color: #51c3eb;
    color: #fff!important;
}

/* theme 3 */
#left ul.nav>li.item-15.parent>a {
    border: solid 1px #94cf00;
}

#left ul.nav>li.item-15 .lbl {
    color: #94cf00;
}
#left ul.nav>li.item-15 li.current>a .lbl {
    background-color: #94cf00;
    color: #fff!important;
}
<?php }?>
</style>
<?php
include_once("css/index_estilos.php");
echo index_estilos('temas_main');
?>
</head>
<?php
$mayor_informacion=busca_filtro_tabla("valor","configuracion","nombre='mayor_informacion'","",$conn);
?>
<body>
<?php if($_SESSION["tipo_dispositivo"]!="movil"){ ?>
<div class="footer_login">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr class="footer_login_text">
      <td width="1%" height="25">&nbsp;</td>
      <td>©<?php echo date(Y);?> CEROK</td>
      <!--<td><a href="">Términos de uso y servicio - SAIA</a><sup>®</sup></td>-->
      <td>Para mayor información: <?php echo($mayor_informacion[0]["valor"]); ?></td>
      <td></td>
      <td width="30%" align="right">Todos los derechos reservados CERO K&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table>
</div>
<?php } ?>
<div id="ventana_modal" class="modal hide" tabindex="-1" role="dialog">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="encabezado_modal">Cambiar Contrase&ntilde;a</h3>
</div>
<div class="modal-body">
<p>Cuerpo</p>
</div>
<div class="modal-footer">
</div>
</div>
<div id="ventana_modal_correo" class="modal hide" tabindex="-1" role="dialog">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="encabezado_modal_correo">Cambiar Contrase&ntilde;a de correo</h3>
</div>
<div class="modal-body">
<p>Cuerpo</p>
</div>
<div class="modal-footer">
</div>
</div>

<div class="user-menu-top">
<?php
//Menu SAIA para movil
if($_SESSION["tipo_dispositivo"]=="movil"){ ?>
	<div id="left" class="">
		<ul id="menu-group-1" class="nav menu">
			<li class="item-8 deeper parent">
				<a class="" href="#">
					<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-8" id="menu_primer_nodo" class="sign"><i class="icon-plus icon-white"></i></span>
					
					<span class="lbl">SAIA</span>
					<div style="float: right; padding-top:5%">|<b><?php echo(usuario_actual("nombres")." ".usuario_actual("apellidos"));?></b></div>                      
                </a>
                <ul class="children nav-child unstyled small collapse" id="sub-item-8">
                	<?php
                	   menu_saia();
                	?>
                	<li class="item-9 deeper parent">
                		<a class="" href="#">
                			<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-cuenta" class="sign"><i class="icon-plus icon-white"></i></span>
                			<span class="lbl">Mi Cuenta</span>
                		</a>
                		<ul class="children nav-child unstyled small collapse" id="sub-cuenta">
                			<li class="enlace_final item-5">
                    			<a href="<?php echo($ruta_db_superior);?>pantallas/mi_cuenta/cambio_clave2.php" data-toggle="modal" data-target="#ventana_modal" class="cambiar_pwd" titulo="Cambiar Contrase&ntilde;a">
                    				<span class="sign"><i class="icon-play"></i></span>
                    				<span class="lbl">Cambiar Contrase&ntilde;a</span>
                    			</a>
                    		</li>
                    		<li class="enlace_final item-5">
                    			<a href="<?php echo($ruta_db_superior);?>pantallas/mi_cuenta/cambio_clave_correo.php" data-toggle="modal" data-target="#ventana_modal_correo" class="cambiar_pwd" titulo="Cambiar Contrase&ntilde;a de correo">
                    				<span class="sign"><i class="icon-play"></i></span>
                    				<span class="lbl">Contrase&ntilde;a de correo</span>
                    			</a>
                    		</li>
                    	</ul>
                    </li>
                	<li class="item-10">
            	  		<a class="" href="logout.php<?php if(@$_SESSION["INDEX"]!='')echo("?INDEX_SALIDA=".$_SESSION["INDEX"]);?>">
            	  			<span class="lbl">Salir</span>
            	  		</a>
                    </li>
    	  		</ul>
    	  	</li>
    	 </ul>
    	 
    </div>
<?php }else{ ?>
  <div class="dropdown pull-right">| <a href="logout.php<?php if(@$_SESSION["INDEX"]!='')echo("?INDEX_SALIDA=".$_SESSION["INDEX"]);?>">Salir</a></div>
  <div class="dropdown pull-right">|
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi Cuenta<b class="caret"></b></a>
      <ul class="dropdown-menu" >
      <li><a href="<?php echo($ruta_db_superior);?>pantallas/mi_cuenta/cambio_clave.php" data-toggle="modal" data-target="#ventana_modal" class="cambiar_pwd" titulo="Cambiar Contrase&ntilde;a">Cambiar Contrase&ntilde;a</a></li>
      <li><a href="<?php echo($ruta_db_superior);?>pantallas/mi_cuenta/cambio_clave_correo.php" data-toggle="modal" data-target="#ventana_modal_correo" class="cambiar_pwd" titulo="Cambiar Contrase&ntilde;a de correo">Contrase&ntilde;a de correo</a></li>
    </ul>
  </div>
  <div class="dropdown pull-right">|<b><?php echo(usuario_actual("nombres")." ".usuario_actual("apellidos"));?></b></div>
  <div id="timer" class="pull-right" style="display:none">
    <div class="timer_container pull-left" >
        <div id="hour_crono">00</div>
        <div class="divider">:</div>
        <div id="minute_crono">00</div>
        <div class="divider">:</div>
        <div id="second_crono">00</div>
    </div>
    <div id="btn_iniciar_crono" class="pull-left" estado_crono=1><i id="icon_iniciar_crono" class="icon-play"></i></div>
    <div id="btn_guardar_crono" class="pull-left" idtarea="0" fecha_inicio="00-00-00" hora_ini="00:00"><i class="icon-check"></i></div>
  </div>
  <div id="tareas_pendientes_dia" class="pull-right" ></div>

  <?php
  }
  /*if($_SESSION["tipo_dispositivo"]=="movil"){
    echo('<div class="dropdown pull-right"><div class="icon-fullscreen" id="resize_centro"></div></div>');
  }*/
  ?>
  <!--a href="#">Opciones</a-->
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <?php if($_SESSION["tipo_dispositivo"]!="movil"){ ?>
    <td width="275" align="left" valign="top" id="PanelLaterialMainUI">
      <div class="modbox-saia-main ui-corner-all shadow">
        <div class="modbox-saia-main-title ui-corner-top">
        </div>
        <div class="icon-collapser ui-corner-tr" style="text-align: center; border-bottom-left-radius: 9px; height: 22px;
    width: 39px;"> <i class="icon-minus icon-white"></i></div>
        <div class="modbox-saia-main-content ui-corner-bottom">
          <ul id="MenuSaiaVin">
             
             
             <!-- INICIO OPCIONES PRINCIPALES -->
             
             <!-- DOCUMENTOS RECIBIDOS -->
            <?php
            if($per_pendientes){
            ?>
            <li><i class="icon-inbox"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_pendiente[0]["idbusqueda_componente"]); ?>" nombre_componente="documento_pendiente">Documentos Recibidos <div class="pull-right"><span class="badge" id="documento_pendiente"><?php echo($pendientes["numcampos"]);?></span></div></a>
            </li>
            
             <!-- DOCUMENTOS CON INDICADOR -->
            
            <li><i class="icon-flag"></i><a href="pantallas/buscador_principal.php?idbusqueda=24&cmd=resetall" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_prioridad[0]["idbusqueda_componente"]); ?>" nombre_componente="documentos_importantes">Con Indicador <div class="pull-right"><span class="badge" id="documentos_importantes"><?php echo(intval($con_indicador["numcampos"]));?></span></div></a>
            </li>
 
             <!-- DOCUMENTOS EN BORRADOR -->
 
            <li><i class="icon-calendar"></i><a href="pantallas/buscador_principal.php?idbusqueda=25&cmd=resetall" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_borrador[0]["idbusqueda_componente"]); ?>" nombre_componente="borradores">Borradores <div class="pull-right"><span class="badge" id="borradores"><?php echo($borradores[0]["cant"]);?></span></div></a>
            </li>
            <?php
            }
            if($per_mis_tareas){
            	?>
             <!-- TAREAS BASICAS -->
            
            <li><i class="icon-tasks"></i><a href="pantallas/buscador_principal.php?nombre=listado_tareas&cmd=resetall" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_tareas[0]["idbusqueda_componente"]); ?>" nombre_componente="mis_tareas_pendientes">Mis Tareas <div class="pull-right"><span class="badge" id="mis_tareas_pendientes"><?php echo($tareas[0]["cant"]);?></span></div></a>
            </li>
						<?php
            }
            if($per_mis_tareas_av){
            	?>

            <!-- PLANEADOR TAREAS AVANZADAS -->

            <li>
            	<i class="icon-calendar"></i>
            		<a href="calendario/fullcalendar.php?nombre_calendario=calendario_tareas_planeador&idbusqueda_componente=<?php echo($componente_planeador[0]['idbusqueda_componente']); ?>" target="centro" class="enlace_indicadores_index"  >
            			Planeador
            		</a>
            </li>
            
            <!-- TAREAS AVANZADAS -->
            
            <li>
            	<i class="icon-tasks"></i>
            		<a href="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?click=tareas&rol_tareas=todos" target="centro" class="enlace_indicadores_index" nombre_componente="listado_tareas_total" idcomponente="<?php echo($componente_tareas_total[0]["idbusqueda_componente"]); ?>" >
            			Mis Tareas (Av)
            		</a>
            		&nbsp;<span class="badge" id="listado_tareas_total" title="Total" data-toggle="tooltip"><?php echo($tareas_total[0]["cant"]);?></span>
            			<div class="pull-right">


            				<a href="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?click=tareas&rol_tareas=evaluador"  target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_tareas_evaluador[0]["idbusqueda_componente"]); ?>" nombre_componente="listado_tareas_evaluador" style="text-decoration:none;">
            					<span class="badge" id="listado_tareas_evaluador" title="Evaluador" data-toggle="tooltip"><?php echo($tareas_evaluador[0]["cant"]);?></span>
            				</a>

            				<a href="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?click=tareas&rol_tareas=seguidor"  target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_tareas_seguidor[0]["idbusqueda_componente"]); ?>" nombre_componente="listado_tareas_seguidor" style="text-decoration:none;">
            					<span class="badge" id="listado_tareas_seguidor" title="Seguidor" data-toggle="tooltip"><?php echo($tareas_seguidor[0]["cant"]);?></span>
            				</a>
            				<a href="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?click=tareas&rol_tareas=coparticipante" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_tareas_coparticipante[0]["idbusqueda_componente"]); ?>" nombre_componente="listado_tareas_coparticipante" style="text-decoration:none;">
            					<span class="badge" id="listado_tareas_coparticipante" title="Co-participante" data-toggle="tooltip"><?php echo($tareas_coparticipante[0]["cant"]);?></span>
            				</a>
            				<a href="pantallas/tareas_listado/principal_listados_tareas_calendarios.php?click=tareas&rol_tareas=responsable" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_tareas_responsable[0]["idbusqueda_componente"]); ?>" nombre_componente="listado_tareas_responsable" style="text-decoration:none;">
            					<span class="badge" id="listado_tareas_responsable" title="Responsable" data-toggle="tooltip"><?php echo($tareas_responsable[0]["cant"]);?></span>
            				</a>
            			</div>

            </li>
						<?php
            }
            if($per_pendientes){
            	?>
            <!-- ETIQUETADOS -->

            <li><i class="icon-tag"></i><a href="pantallas/buscador_principal.php?nombre=documentos_etiquetados&cmd=resetall" target="centro" class="enlace_indicadores_index" idcomponente="<?php echo($componente_etiquetados[0]["idbusqueda_componente"]); ?>" nombre_componente="documentos_etiquetados">Etiquetados <div class="pull-right"><span class="badge" id="documentos_etiquetados"><?php echo($etiquetados["numcampos"]);?></span></div></a>
            </li>
            <?php
            }
            ?>
            
            <!-- FIN OPCIONES PRINCIPALES -->
            
            
            <li><i class="icon-refresh"></i><a href="#" id="actualizar_info_index">Actualizado<div class="pull-right"><span class="badge" id="div_actualizar_info_index"></span></div></a>
            </li>
            <!--li><i class="icon-tasks"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall" target="centro"> Tareas Pendientes <div class="pull-right"><span class="badge" id="documentos_pendientes"><?php echo(0);?></span></div></a>
            </li-->
            <!--li class="iconMisTareas"><a href="/nueva_interfaz/saia2.0/formatos/campos_formatos/paginas_documentos.php" target="centro">Mis Tareas</a>
            </li>
            <li class="iconMensajes"><a href="#">Mensajes</a>
            </li>
            <li class="iconNoticiasNovedades"><a href="#">Noticias &amp; Novedades</a>
            </li>
            <li class="iconFuncionarios"><a href="http://www.netsaia.com/nueva_interfaz/saia2.0/funcionarios/listar_nombres.php" target="centro">Funcionarios</a>
            </li>
            <li class="iconUtilidades"><a href="http://www.netsaia.com/nueva_interfaz/saia2.0/formatos/campos_formatos/adicionar_campos_formatos.php" target="centro">Utilidadades</a>
            </li-->
          </ul>
          <br>
        </div>
      </div>
      <div class="modbox-saia-addon ui-corner-all shadow">
        <div class="modbox-saia-addon-title">
          <span id="ModulosSaiaTab">M&oacute;dulos Saia</span><img src="asset/img/layout/tabline.png" width="24" height="28" align="absmiddle" /><!--span id="BusquedaRapidaTab">Busqueda Rapida</span--></div>
        <div class="icon-collapser  ui-corner-tr" style="text-align: center; border-bottom-left-radius: 9px; height: 22px;
    width: 39px;"> <i class="icon-minus icon-white"></i></div>
        <div class="modbox-saia-addon-content">
        <!--div id="busquedaRapidaForm">
          <form id="form1" name="form1" method="post" action="">
            Poner aqui formulario de busqueda rapida.<br />
            <input type="text" name="textfield" id="textfield" />
            <br />
            <textarea name="textarea" id="textarea"></textarea>
<br />
            <input type="submit" name="button" id="button" value="Submit" />
          </form>
        </div-->
        <div id="menu-modulos">
        <?php
        menu_saia();
        ?>
		  </div>
        </div>
      </div>
    </td>
    <td width="16px" id="collapser_mainui" title="Contraer área de trabajo">
    </td>
    <script>
        $(document).ready(function(){
            $('#collapser_mainui').click(function(){
                var title=$(this).attr('title');
                if(title=="Contraer área de trabajo"){
                    title="Expandir área de trabajo";
                }else{
                    title="Contraer área de trabajo";
                }
                $(this).attr('title',title);
            });
        });
    </script>
    <?php } ?>
    <td align="left" valign="top" id="CellContainer">
    <div class="<?php if($_SESSION["tipo_dispositivo"]!="movil"){echo("container-saia");}?> ui-corner-all shadow" style="padding-bottom: 0px;">
        <!--div class="container-saia-title">
          <div class="icon-help  ui-corner-tr"></div>
          <span id="TituloContenedor"></span>
        </div-->
<?php
	$pagina_ini=busca_filtro_tabla("","configuracion A","nombre='pagina_inicio'","",$conn);
	if($_SESSION["tipo_dispositivo"]=="movil"){
	    $pagina_inicio="pantallas/buscador_principal.php?idbusqueda=25&cmd=resetall";
	}
	elseif($pagina_ini["numcampos"]>0){
	    $pagina_inicio = $pagina_ini[0]["valor"];
	}else{
		$pagina_inicio = '';
	}
?>
        <div class="ui-corner-all">
          <iframe name="centro" src="<?php echo $pagina_inicio; ?>" id="iFrameContainer" allowtransparency="1" frameborder="0" framespacing="5px" scrolling="auto" width="100%" src=""  hspace="0" vspace="0"></iframe>
        </div>
      </div>
    </td>
  </tr>
</table>
<!--div class="user-footer-main shadow ui-corner-tl ui-corner-tr"></div-->
<input type="hidden" id="variable_session" value='<?php echo(session_id()); ?>' />
<input type="hidden" id="variable_log" value='<?php echo($_SESSION['LOGIN'.LLAVE_SAIA]); ?>' />
<input type="hidden" id="variable_uactual" value='<?php echo($_SESSION['usuario_actual']); ?>' />
</body>
</html>
<?php
echo(librerias_UI());
echo(librerias_notificaciones());
function mostrar_iconos($modulo_actual,$orden=NULL){
  global $conn;
  $cols=4;
  $usuario_actual=$_SESSION["usuario_actual"];
  $idfuncionario_actual=$_SESSION["idfuncionario"];
	
  $modulo=busca_filtro_tabla("A.idmodulo","modulo A","A.idmodulo=".$modulo_actual,"",$conn);
  if($modulo["numcampos"]){
    $condicion="A.modulo_idmodulo=B.idmodulo AND B.cod_padre=".$modulo[0]["idmodulo"]." AND A.funcionario_idfuncionario=".$idfuncionario_actual;
    $adicionados=busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND A.accion=1","",$conn);
    $suprimidos= busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND (A.accion=0 OR A.accion IS NULL)","",$conn);
    $permisos_perfil=busca_filtro_tabla("C.idmodulo","permiso_perfil A,modulo C","A.perfil_idperfil in(".usuario_actual('perfil').") AND A.modulo_idmodulo=C.idmodulo AND C.cod_padre=".$modulo[0]["idmodulo"],"",$conn);
    $adicionales=extrae_campo($adicionados,"idmodulo","U");
    $suprimir=extrae_campo($suprimidos,"idmodulo","U");
    $permisos=extrae_campo($permisos_perfil,"idmodulo","U");
    $finales=array_diff(array_merge((array)$permisos,(array)$adicionales),$suprimir);
    if(count($finales))
      $tablas=busca_filtro_tabla("A.nombre,A.etiqueta,A.imagen,A.enlace,A.destino,A.ayuda,A.parametros,A.enlace_pantalla,A.idmodulo","modulo A","A.idmodulo IN(".implode(",",$finales).")","A.orden ASC",$conn);
    else
      $tablas["numcampos"]=0;
    if($tablas["numcampos"]){
      if($_SESSION["tipo_dispositivo"]=='movil'){
        echo('<ul class="children nav-child unstyled small collapse" id="sub-item-'.$orden.'">');
      }else{
        echo('<table width="100%" border="0" cellspacing="5" cellpadding="0"><tr>');
      }
      for($j=0;$j<$tablas["numcampos"];$j++){
        $ayuda_submenu=$tablas[$j]["ayuda"];
        $arreglo=explode(",",$tablas[$j]["parametros"]);
        for($h=0;$h<count($arreglo)-1;$h++){
          if(array_search($arreglo[$h],$_REQUEST)!==FALSE && $_REQUEST[$arreglo[$h]]){
            if(!strpos($tablas[$j]["enlace"],"?"))
              $tablas[$j]["enlace"].="?".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
            else
              $tablas[$j]["enlace"].="&".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
          }
        }
        if(isset($_REQUEST["key"]) && $_REQUEST["key"]<>""){
          $tablas[$j]["enlace"]=str_replace("@key@",$_REQUEST["key"],$tablas[$j]["enlace"]);
        }
        if($j>0&&$j%$cols==0 && $_SESSION["tipo_dispositivo"]!='movil'){
            echo('</tr><tr>');
        }
        if(@$tablas[$j]["enlace_pantalla"]){  //si requiere de barra de navegacion (KAITEN)
            $tablas[$j]["enlace"]="pantallas/pantallas_kaiten/principal.php?idmodulo=".$tablas[$j]["idmodulo"];
        }
        if($_SESSION["tipo_dispositivo"]!='movil'){
          echo('<td width="'.(($cols*35)) .'px" height="44" align="center" valign="top"><a href="'.$tablas[$j]["enlace"]);
          if(!strpos($tablas[$j]["enlace"],"?"))
            echo('?cmd=resetall"');
          else
            echo("&cmd=resetall\"");
          echo(' target="'.$tablas[$j]["destino"].'"><img src="'.$tablas[$j]["imagen"].'" border="0" width="35px"');
          echo (' ><br />'.$tablas[$j]["etiqueta"].'</a></td>');
        }else{
          if(!strpos($tablas[$j]["enlace"],"?"))
            $tablas[$j]["enlace"].='?cmd=resetall"';
          else
            $tablas[$j]["enlace"].='&cmd=resetall"';
          echo('<li class="enlace_final item-'.$orden.'">
                    <a class="" tabindex="-1" href="'.$tablas[$j]["enlace"].'" target="'.$tablas[$j]["destino"].'">
                        <span class="sign"><i class="icon-play"></i></span>
                        <span class="lbl">'.$tablas[$j]["etiqueta"].'</span>
                    </a>
                </li>');
        }
      }
      if($_SESSION["tipo_dispositivo"]=="movil"){
        echo('</ul>');
      }else{
        for(;$j%$cols!=0;$j++){
            echo('<td>&nbsp;</td>');
        }
        echo('</tr>');
        echo('</table>');
      }
    }
  }
}

function menu_saia(){
  if(isset($_SESSION["LOGIN".LLAVE_SAIA])&& $_SESSION["LOGIN".LLAVE_SAIA]){
    $nombres=array();
    $cerrar=array();
    $modulos=busca_filtro_tabla("modulo.idmodulo","permiso_perfil,modulo","permiso_perfil.modulo_idmodulo = modulo.idmodulo and modulo.cod_padre is not null AND permiso_perfil.perfil_idperfil in (".usuario_actual("perfil").")","orden",$conn);
    $modulos2=busca_filtro_tabla("modulo.idmodulo","permiso,modulo,funcionario","permiso.modulo_idmodulo = modulo.idmodulo AND permiso.funcionario_idfuncionario=funcionario.idfuncionario and permiso.accion=1 and funcionario.idfuncionario =".usuario_actual("idfuncionario"),"orden",$conn);
    $suprimidos=busca_filtro_tabla("modulo.idmodulo","permiso,modulo,funcionario","permiso.modulo_idmodulo = modulo.idmodulo AND permiso.funcionario_idfuncionario=funcionario.idfuncionario and(permiso.accion=0 or permiso.accion is null) and funcionario.idfuncionario =".usuario_actual("id"),"orden",$conn);
    $mod1=extrae_campo($modulos,"idmodulo","U");
    $mod2=extrae_campo($modulos2,"idmodulo","U");
    $eliminar=extrae_campo($suprimidos,"idmodulo","U");
    $mod3=array_merge((array)$mod1,(array)$mod2);
    $mod3=array_diff($mod3,$eliminar);
    $mod4=array_unique($mod3);
    sort($mod3);
    $lista=implode(",",$mod4);
    $modulo=busca_filtro_tabla("A.tipo,A.etiqueta,A.idmodulo","modulo A","A.idmodulo IN(select distinct b.cod_padre from modulo b where b.idmodulo in(".$lista."))","orden",$conn);
    for($i=0;$i<$modulo["numcampos"];$i++){
      if($modulo["numcampos"] && $modulo[$i]["idmodulo"] && $modulo[$i]["etiqueta"] && $modulo[$i]["tipo"]=='1'){
        if($_SESSION["tipo_dispositivo"]=="movil"){
            ?>
            <li class="item-9 deeper parent">
            	<a class="" href="#">
            		<span data-toggle="collapse" data-parent="#menu-group-1" href="#sub-item-<?php echo($i);?>" class="sign"><i class="icon-plus icon-white"></i></span>
            		<span class="lbl"><?php echo(strtoupper($modulo[$i]["etiqueta"]));?></span> 
                </a>
                <?php mostrar_iconos($modulo[$i]["idmodulo"],$i);?>
            </li>
            <?php 

          
        }else{
          echo '<div class="ac-title">'.strtoupper($modulo[$i]["etiqueta"]).'</div>';
          echo('<div class="ac-content">');
          mostrar_iconos($modulo[$i]["idmodulo"]);
          echo('</div>');
        }
      }
    }
  }
}
?>
<script type="text/javascript">
	$(document).ready(function(){
		var refreshInterval_SESSION;

  	$("#encabezado_modal").click(function(event){
   		$("#encabezado_modal").html($("#ventana_modal").attr("titulo"));
   	});
  	$("#ventana_modal_correo").click(function(event){
   		$("#encabezado_modal_correo").html($("#ventana_modal_correo").attr("titulo"));
   	});
   	$("#ventana_modal").draggable({
   		handle: ".modal-header"
   	});
   	$("#ventana_modal_correo").draggable({
   		handle: ".modal-header"
   	});

	  var meses=new Array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
	  var refreshInterval_SAIA;
	  var today=new Date();
		var h=today.getHours();
		var m=today.getMinutes();
		var s=today.getSeconds();
		var y=today.getFullYear();
		var mt=today.getMonth();
		var d=today.getDate();
    function actualizar_datos_index_saia(){
	    refreshInterval_SAIA = setInterval(function(){
	      $.ajax({
	        type:'POST',
	        url: "pantallas/busquedas/servidor_busqueda.php",
	        data: "idbusqueda_componente=7&page=0&rows=1&actual_row=0",
	        dataType: "json",
	        success: function(objeto){
            var valor=$("#documentos_pendientes").html();
            if(valor!=objeto.records){
              $("#documentos_pendientes").html(objeto.records);
              $("#documentos_pendientes").removeClass("label-success");
              $("#documentos_pendientes").addClass("label-important");
            }
            if(objeto.records==0){
              $("#documentos_pendientes").removeClass("label-important");
              $("#documentos_pendientes").addClass("label-success");
            }	        
	        }
	      });
	    }, <?php echo($intervalo_recarga_informacion);?>);
	  today=new Date();
	  h=today.getHours();
	  m=today.getMinutes();
	  //s=today.getSeconds();
	  y=today.getFullYear();
	  mt=today.getMonth();
	  d=today.getDate();
	  if(parseInt(h)<10){
	  	h='0'+h;
	  }
	  if(parseInt(m)<10){
	  	m='0'+m;
	  }
      $("#div_actualizar_info_index").html(""+d+"/"+meses[mt]+"/"+y+" "+h+":"+m);
    }
    function actualizar_datos_index(){
	  	$(".enlace_indicadores_index").each(function(indice,valor){
	  		idcomponente=$(this).attr("idcomponente");
	  		div_actualizar=$(this).attr("nombre_componente");
	  		actualizar_datos_index_saia2(idcomponente,div_actualizar);
	  	});
		}
    function actualizar_datos_index_saia2(idcomponente,div_actualizar){
      $.ajax({
        type:'POST',
        url: "pantallas/busquedas/servidor_busqueda.php",
        data: "idbusqueda_componente="+idcomponente+"&page=0&rows=1&actual_row=0",
        dataType: "json",
        success: function(objeto){
	        var valor=$("#"+div_actualizar).html();
	        if(valor!=objeto.records){
	          $("#"+div_actualizar).html(objeto.records);
	          $("#"+div_actualizar).removeClass("label-success");
	          $("#"+div_actualizar).addClass("label-important");
	        }
	        if(objeto.records==0){
						$("#"+div_actualizar).html(0);
	          $("#"+div_actualizar).removeClass("label-important");
	          //$("#"+div_actualizar).addClass("label-success");
	        }
        }
      });

    today=new Date();
	  h=today.getHours();
	  m=today.getMinutes();
	  //s=today.getSeconds();
	  y=today.getFullYear();
	  mt=today.getMonth();
	  d=today.getDate();
	  if(parseInt(h)<10){
	  	h='0'+h;
	  }
	  if(parseInt(m)<10){
	  	m='0'+m;
	  }
      $("#div_actualizar_info_index").html(d+"/"+meses[mt]+"/"+y+" "+h+":"+m);
    }
    actualizar_datos_index_saia();
    $("#actualizar_info_index").click(function(){
    	actualizar_datos_index();
    });

    var tiempo = {
        hora: 0,
        minuto: 0,
        segundo: 0
    };
    var tiempo_corriendo = null;
    $("#btn_iniciar_crono").click(function(){
      //Los textos se debe modificar y cambiarlos por attibutos del div y los div deben quedar con iconos
      //en esta condicion se debe verificar que no exista otro contador activo en ese caso se debe sacar un noty con error diciendo que no es posible iniciar un contador porque ya existe otro contador iniciado con la tarea XXXX y el enlace a la tarea por si el usuario quiere ir a ella
      //comenzar=1, detener=2
      if(parseInt($("#btn_guardar_crono").attr("idtarea"))!==0){
        if ( $(this).attr("estado_crono") == 1){
            $("#icon_iniciar_crono").removeClass("icon-play");
            $("#icon_iniciar_crono").addClass("icon-pause");
            $(this).attr("estado_crono",2);
            window.clearInterval(tiempo_corriendo);
            tiempo_corriendo = window.setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60){
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }
                // Minutos
                if(tiempo.minuto >= 60){
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }
                $("#hour_crono").text(tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora);
                $("#minute_crono").text(tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto);
                $("#second_crono").text(tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo);
            }, 1000);
        }
        else {

          //Aqui detiene el contador
            $(this).attr("estado_crono",1);
            $("#icon_iniciar_crono").removeClass("icon-pause");
            $("#icon_iniciar_crono").addClass("icon-play");
            window.clearInterval(tiempo_corriendo);
        }
      }
      else{
        notificacion_saia("No es posible iniciar el cronometro sin una tarea","warning","",3000);
      }
    });
    $("#btn_guardar_crono").click(function(){
      var idtarea=$(this).attr("idtarea");

      var minutos=parseInt($("#minute_crono").text());

      var horas=parseInt($("#hour_crono").text());
      var fecha_ini=$(this).attr("fecha_inicio");
      var hora_ini=$(this).attr("hora_ini");
     	window.clearInterval(tiempo_corriendo);
      delete tiempo_corriendo;
      tiempo.segundo = 0;
      tiempo.minuto=0;
       tiempo.hora = 0;
      $("#hour_crono").text('00');
      $("#minute_crono").text('00');
      $("#second_crono").text('00');
      $("#timer").hide();
      hs.htmlExpand(this, { objectType: 'iframe',width: 800, height: 300, src:"pantallas/tareas_listado/avance_higslider.php?idtareas_listado="+idtarea+"&minutos="+minutos+"&horas="+horas+"&fecha_ini="+fecha_ini+"&hora_ini="+hora_ini+"&rand=<?php echo rand(0,10000);?>",outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header',preserveContent:false});
      $(this).attr("idtarea",'0');
    });

  });
</script>
<script>
$(document).ready(function(){
	hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-5.0.0/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	$("#resize_centro").click(function(){
	    var nuevo_alto=$(top).height()-($(".footer_login").height()+$(".user-menu-top div").height()<?php if($_SESSION["tipo_dispositivo"]!="movil") echo("+20");?>);
	    $("#iFrameContainer").height(nuevo_alto);
	});
	// se saca el codigo porque el resize_centro existe solo para moviles
	var nuevo_alto=$(top).height()-($(".footer_login").height()+$(".user-menu-top div").height()+20);
	$("#iFrameContainer").height(nuevo_alto);
	$(".enlace_final").click(function(){
	  $(".dropdown").removeClass("open");
	});
});
!function ($) {
    
    // Le left-menu sign
    
    $('#left ul.nav li.parent > a > span.sign').click(function () {
        $(this).find('i:first').toggleClass("icon-minus");
    }); 
    
    /*$(document).on("click","#left ul.nav li.parent > a > span.sign", function(){          
        $(this).find('i:first').toggleClass("icon-minus");      
    }); */
    
    // Open Le current menu
    $("#left ul.nav li.parent.active > a > span.sign").find('i:first').addClass("icon-minus");
    $("#left ul.nav li.current").parents('ul.children').addClass("in");
    $(".enlace_final").click(function(){
        $("#menu_primer_nodo").trigger("click");
    });
}(window.jQuery);
</script>
<script>
	setInterval(function(){   //tareas_pendientes_dia
		$.ajax({
        	type:'POST',
            dataType: 'json',
            url: "pantallas/tareas_listado/cantidad_tareas_planeadas_dia.php",
            success: function(datos){
            	if(datos.cantidad>0){
            		$('#tareas_pendientes_dia').html(datos.mensaje);
            	}else{
            		$('#tareas_pendientes_dia').html('');
            	}
           	}
		});
  	}, 900000);  //cada 15 minutos

	$.ajax({
       	type:'POST',
        dataType: 'json',
        url: "pantallas/tareas_listado/cantidad_tareas_planeadas_dia.php",
        success: function(datos){
    	   	if(datos.cantidad>0){
        		$('#tareas_pendientes_dia').html(datos.mensaje);
            }else{
            	$('#tareas_pendientes_dia').html('');
            }
		}
	});
</script>
<?php
if(@$_SERVER['QUERY_STRING']){
	$parametro=$_SERVER['QUERY_STRING'];
	$parametro_uncrypt=base64_decode($parametro);
	$vector_parametro=explode('=',$parametro_uncrypt);

	if(strtolower(@$vector_parametro[0])=='idtareas_listado_unico' && is_numeric(@$vector_parametro[1])){
		?>
		<script>
			var idtareas_listado_unico='<?php echo($vector_parametro[1]); ?>';
			var link='pantallas/tareas_listado/principal_listados_tareas_calendarios.php?rol_tareas=tarea_unica&click=tareas&idtareas_listado_unico='+idtareas_listado_unico;
			window.open(link,'centro');
		</script>
		<?php
	}
}
?>