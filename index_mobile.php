<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
if(!isset($_SESSION["LOGIN".LLAVE_SAIA])){
  @session_name();
  @session_start();
  @ob_start();
} 
date_default_timezone_set ("America/Bogota");
if(isset($_REQUEST['sesion']))
  $_SESSION["LOGIN".LLAVE_SAIA]=$_REQUEST['sesion'];  
if(!isset($_GET['fin']) || !$_GET['fin']){
include_once("db.php");
include_once("librerias_saia.php");
echo(estilo_bootstrap()); 
echo(librerias_jquery("1.7"));
echo(librerias_html5());
echo(librerias_bootstrap());
}
//include_once("cargando.php");
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
//$fondo=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='fondo'","A.fecha,A.valor DESC",$conn);
almacenar_sesion(1,"");
//$alto_menu=78;  
$recarga=busca_filtro_tabla("A.valor","configuracion A","A.tipo='interfaz' AND A.nombre='intervalo_recarga'","A.fecha DESC",$conn);
if($recarga["numcampos"]){
  $intervalo_recarga_informacion=$recarga[0]["valor"];
}
else{
  $intervalo_recarga_informacion=900000; ////Esto debería estar en configuración aquí recarga cada 15 minutos
}  
include_once($ruta_db_superior."pantallas/lib/mobile_detect.php");
$detect = new Mobile_Detect;
if ( $detect->isMobile() ) {
	$_SESSION["tipo_dispositivo"]="movil";
}
/*************actualizacion de fin de año ********/
/*
$proxima=busca_filtro_tabla("valor","configuracion","nombre='actualizacion_fin_anio'","",$conn);
if($proxima["numcampos"])
{
$fecha=busca_filtro_tabla(resta_fechas("'".$proxima[0][0]."'","'".date("Y-m-d")."'"),"","","",$conn);
if(@$fecha[0][0]<0)
  {alerta("Se van a realizar algunas actualizaciones por el cambio de año, por favor espere.");
   abrir_url("actualizacion_cambio_anio.php");
  }
}
*/
$proxima=busca_filtro_tabla("valor","configuracion","nombre='actualizacion_fin_anio'","idconfiguracion DESC",$conn);
if($proxima["numcampos"]){
$fecha=busca_filtro_tabla(resta_fechas("'".$proxima[0][0]."'","'".date("Y-m-d")."'"),"dual","","",$conn);
if(@$fecha[0][0]<0)
  {alerta("Se van a realizar algunas actualizaciones por el cambio de año, por favor espere.");
   abrir_url("actualizacion_cambio_anio.php");
  }
}
$usuario=usuario_actual("funcionario_codigo");
$idfuncionario=usuario_actual("idfuncionario");
$proximos_vencer=busca_filtro_tabla("count(*) AS cant","documento A,asignacion B","A.estado<>'ELIMINADO' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=".$usuario,"GROUP BY A.iddocumento",$conn);
$pendientes=busca_filtro_tabla("count(*) AS cant","documento A,asignacion B","A.estado<>'ELIMINADO' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=".$usuario,"GROUP BY A.iddocumento",$conn);
$vencidos=busca_filtro_tabla("count(*) AS cant","documento A,asignacion B","A.estado<>'ELIMINADO' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=".$usuario,"GROUP BY A.iddocumento",$conn);
$importantes=busca_filtro_tabla("","prioridad_documento A, documento B","A.prioridad=1 AND iddocumento=documento_iddocumento AND funcionario_idfuncionario=".usuario_actual("idfuncionario"),"",$conn);
$borradores=busca_filtro_tabla("count(*) AS cant","documento A","ejecutor=".$usuario." AND A.estado='ACTIVO' AND A.numero='0'","",$conn); 
$actualizaciones=busca_filtro_tabla("count(*) AS cant","documento_accion A,asignacion B","A.documento_iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=".$usuario,"GROUP BY A.documento_iddocumento",$conn);
//limpieza carpetas
include_once("tarea_limpiar_carpeta.php");
borrar_archivos_carpeta('temporal_'.usuario_actual("login"), 0); 
/*************actualizacion de fin de año ********/
/*include_once("class_transferencia.php");
include_once("paso_buzones.php");
revisar_fechas2("gestion");
revisar_fechas2("central");
revisar_fechas2("historico");*/ 
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SAIA 2.0</title>
<style type="text/css">
li{line-height:10px;} .badge{line-height:11px;padding: 1px 4px 1px; font-size:11px;} 
.footer_login { font-weight: bold; background-image: url(imagenes/login/footerbkg.png); background-repeat: repeat-x; background-position: left top; height: 25px; width: 100%; padding-top: 0px; padding-bottom: 0px; text-align: right; color: #FFF; position: absolute; bottom: 0px; } .footer_login_text, .footer_login_text * { color:#FFF; font-size:10px; font-weight:bold; } .user-menu-top div > a{padding-left:5px; padding-right:5px;}
</style>
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery-ui.min.js"></script>
<script src="asset/js/main.js"></script>      
<link rel="stylesheet" type="text/css" href="asset/css/smoothness/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="asset/css/main.css"/>
</head>
<body>
<div id="ventana_modal" class="modal hide" tabindex="-1" role="dialog">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="encabezado_modal">Encabezado</h3>
</div>
<div class="modal-body">
<p>Cuerpo</p>
</div>
<div class="modal-footer">
</div>
</div>
<div class="user-menu-top">
  <div class="dropdown pull-right">|<a href="logout.php<?php if(@$_SESSION["INDEX"]!='')echo("?INDEX_SALIDA=".$_SESSION["INDEX"]);?>">Salir</a></div>
  <div class="dropdown pull-right">|<a href="#">Opciones</a></div>
  <div class="dropdown pull-right"> 
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Mi Cuenta<b class="caret"></b></a>
   	<ul class="dropdown-menu" >
      <li><a href="<?php echo($ruta_db_superior);?>pantallas/mi_cuenta/cambio_clave.php" data-toggle="modal" data-target="#ventana_modal" class="cambiar_pwd" titulo="Cambiar Contrase&ntilde;a">Cambiar Contrase&ntilde;a</a></li>
    </ul>
  </div>
  <div class="pull-right" style="color:#000; padding-right: 5px;"><b>Usuario: <?php echo(usuario_actual("nombres")." ".usuario_actual("apellidos"));?></b></div>
</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="100%" align="left" valign="top" id="PanelLaterialMainUI">
      <div class="modbox-saia-main ui-corner-all shadow" style="width: 90%">          
        <div class="modbox-saia-main-title ui-corner-top">
            <div class="pull-right" style="height:15px; line-height: 12px; "><br><br><br><a href="#" id="actualizar_info_index" style="text-decoration:none;"><i class="icon-refresh"></i> &nbsp;&nbsp;<div class="pull-right" style="font-size: 11px; color: #000;">Actualizado:<span  id="div_actualizar_info_index" style="font-size: 11px; color: #000;"></span>&nbsp;&nbsp;&nbsp;</div></a></div>
        </div>          
        <div class="icon-collapser ui-corner-tr"></div>    
        <div class="modbox-saia-main-content ui-corner-bottom">
          <ul id="MenuSaiaVin">
            <li><i class="icon-inbox"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall" target="centro"> Documentos recibidos Pendientes <div class="pull-right"><span class="badge" id="documentos_pendientes"><?php echo($pendientes["numcampos"]);?></span></div></a>
            </li>
            <li><i class="icon-por_vencer"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall&default_componente=documento_proximo_vencer" target="centro"> Documentos pr&oacute;ximos a vencerse <div class="pull-right"><span class="badge" id="documento_proximo_vencer"><?php echo("-");?></span></div></a>
            </li>
            <li><i class="icon-vencidos"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall&default_componente=documento_vencido" target="centro"> Vencidos <div class="pull-right"><span class="badge" id="documento_vencido"><?php echo("-");?></span></div></a>
            </li>                       
            <li><i class="icon-prioridad1"></i><a href="pantallas/buscador_principal.php?idbusqueda=24&cmd=resetall" target="centro"> Importantes <div class="pull-right"><span class="badge" id="documentos_importantes"><?php echo(intval($importantes["numcampos"]));?></span></div></a>
            </li>
            <!--li><i class="icon-ok-circle"></i><a href="pantallas/buscador_principal.php?idbusqueda=3&cmd=resetall" target="centro"> Actividades Recientes <div class="pull-right"><span class="badge" id="documentos_importantes"><?php echo(intval($actualizaciones[0]["cant"]));?></span></div></a>
            </li-->
            <li><i class="icon-calendar"></i><a href="pantallas/buscador_principal.php?idbusqueda=25&cmd=resetall" target="centro"> Borradores <div class="pull-right"><span class="badge" id="documentos_borradores"><?php echo($borradores[0]["cant"]);?></span></div></a>
            </li>            
            <li><i class="icon-calendario_actividades"></i><a href="calendario/fullcalendar.php?idcalendario=3" target="centro"> Tareas Pendientes <div class="pull-right"><span class="badge" id="tareas_pendientes"><?php echo("-");?></span></div></a>
            </li>
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
      <div class="modbox-saia-addon ui-corner-all shadow" style="width: 90%">    
        <div class="modbox-saia-addon-title">
          <span id="ModulosSaiaTab">M&oacute;dulos Saia</span><img src="asset/img/layout/tabline.png" width="24" height="28" align="absmiddle" /><!--span id="BusquedaRapidaTab">Busqueda Rapida</span--></div>
        <div class="icon-collapser  ui-corner-tr"></div>
        <div class="modbox-saia-addon-content">
        <div id="menu-modulos">
        <?php 
        if(isset($_SESSION["LOGIN".LLAVE_SAIA])&& $_SESSION["LOGIN".LLAVE_SAIA]){
          $nombres=array();
          $cerrar=array();
          $modulos=busca_filtro_tabla("modulo.idmodulo","permiso_perfil,modulo,funcionario","permiso_perfil.modulo_idmodulo = modulo.idmodulo and modulo.cod_padre is not null AND permiso_perfil.perfil_idperfil=funcionario.perfil and funcionario.idfuncionario =".usuario_actual("idfuncionario"),"orden",$conn);
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
              echo '<div class="ac-title">'.strtoupper($modulo[$i]["etiqueta"]).'</div>';
              echo('<div class="ac-content">'); 
              mostrar_iconos($modulo[$i]["idmodulo"]);
              echo('</div>');             
            }
          }
         }
        function mostrar_iconos($modulo_actual){
          global $conn;
          $cols=4;
          $usuario_actual=usuario_actual("funcionario_codigo");
		      $idfuncionario_actual=usuario_actual("idfuncionario");
          $modulo=busca_filtro_tabla("A.idmodulo","modulo A","A.idmodulo=".$modulo_actual,"",$conn);
          if($modulo["numcampos"]){
            $condicion="A.modulo_idmodulo=B.idmodulo AND B.cod_padre=".$modulo[0]["idmodulo"]." AND A.funcionario_idfuncionario=".$idfuncionario_actual;
            $adicionados=busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND A.accion=1","",$conn);
            $suprimidos= busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND (A.accion=0 OR A.accion IS NULL)","",$conn);
            $permisos_perfil=busca_filtro_tabla("C.idmodulo","permiso_perfil A,funcionario B,modulo C","A.perfil_idperfil=B.perfil AND A.modulo_idmodulo=C.idmodulo AND C.cod_padre=".$modulo[0]["idmodulo"]." AND B.idfuncionario=".$idfuncionario_actual,"",$conn);
            $adicionales=extrae_campo($adicionados,"idmodulo","U");
            $suprimir=extrae_campo($suprimidos,"idmodulo","U");
            $permisos=extrae_campo($permisos_perfil,"idmodulo","U");
            $finales=array_diff(array_merge((array)$permisos,(array)$adicionales),$suprimir);
            if(count($finales))
              $tablas=busca_filtro_tabla("A.nombre,A.etiqueta,A.imagen,A.enlace,A.destino,A.ayuda,A.parametros","modulo A","A.idmodulo IN(".implode(",",$finales).")","A.orden ASC",$conn);
            else
              $tablas["numcampos"]=0; 
            if($tablas["numcampos"]){
              echo('<table width="100%" border="0" cellspacing="5" cellpadding="0"><tr>');
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
      	        if($j>0&&$j%$cols==0){
                  echo('</tr><tr>');
                }    
                echo('<td width="'.(($cols*35)) .'px" height="44" align="center" valign="top"><a href="'.$tablas[$j]["enlace"]);
                if(!strpos($tablas[$j]["enlace"],"?"))
                  echo('?cmd=resetall"');
                else 
                  echo("&cmd=resetall\"");
                echo(' target="'.$tablas[$j]["destino"].'"><img src="'.$tablas[$j]["imagen"].'" border="0" width="35px"');
                echo (' ><br />'.$tablas[$j]["etiqueta"].'</a></td>');
              }
              for(;$j%$cols!=0;$j++){
                echo('<td>&nbsp;</td>');
              }
              echo('</tr></table>'); 
            }
		  }
        }
        ?>
		  </div>
        </div>
      </div></td>        
  </tr>
</table>
<div class="footer_login">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr class="footer_login_text">
      <td width="1%" height="25">&nbsp;</td>
      <td>©<?php echo date(Y);?> CEROK</td>
        <!--<td><a href="">Términos de uso y servicio - SAIA</a><sup>®</sup></td>-->
    <td>Para mayor información: <a href="http://www.cerok.com" target="_blank">www.cerok.com</a> - <a href="mailto:info@cerok.com" target="_blank">info@cerok.com</a></td>
      <td></td>
      <td width="30%" align="right">Todos los derechos reservados CERO K&nbsp;&nbsp;&nbsp;</td>
    </tr>
  </table>
</div>
</body>
</html>  
<?php //include_once("fin_cargando.php");
echo(librerias_UI());
echo(librerias_notificaciones());
?>
<script type="text/javascript">
  $(document).ready(function(){ 
   $(".cambiar_pwd").click(function(event){
    $("#encabezado_modal").html($(".cambiar_pwd").attr("titulo"));     
   });                 
	$("#iFrameContainer").height($(window).height()-55);
  $("#ventana_modal").draggable({
    handle: ".modal-header"
  });
  var meses=new Array("En","Feb","Mar","Abr","May","Jun","Jul","Ag","Sep","Oct","Nov","Dic");
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
	        success: function(html){
	          if(html){
	            var valor=$("#documentos_pendientes").html();
	            var objeto=jQuery.parseJSON(html); 
	            if(valor!=objeto.records){
	              $("#documentos_pendientes").html(objeto.records); 
	              $("#documentos_pendientes").removeClass("label-success");
	              $("#documentos_pendientes").addClass("label-important");
	              //clearInterval(refreshInterval_SAIA);                    
	            }                  
	            if(objeto.records==0){                
	              $("#documentos_pendientes").removeClass("label-important");
	              $("#documentos_pendientes").addClass("label-success");
	            }
	            //else alert("0k");            
	          }
	          else{ 
	            $("#documentos_pendientes").html(0);
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
   /*
    function actualizar_datos_index_saia2(){
      $.ajax({
        type:'POST',
        url: "pantallas/busquedas/servidor_busqueda.php",
        data: "idbusqueda_componente=7&page=0&rows=1&actual_row=0",
        success: function(html){
          if(html){
            var valor=$("#documentos_pendientes").html();
            var objeto=jQuery.parseJSON(html); 
            if(valor!=objeto.records){
              $("#documentos_pendientes").html(objeto.records); 
              $("#documentos_pendientes").removeClass("label-success");
              $("#documentos_pendientes").addClass("label-important");
              //clearInterval(refreshInterval_SAIA);                    
            }                  
            if(objeto.records==0){                
              $("#documentos_pendientes").removeClass("label-important");
              $("#documentos_pendientes").addClass("label-success");
            }
            //else alert("0k");            
          }
          else{ 
            $("#documentos_pendientes").html(0);
            $("#documentos_pendientes").removeClass("label-important");
            $("#documentos_pendientes").addClass("label-success");
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
    }*/
    //actualizar_datos_index_saia();
    $("#actualizar_info_index").click(function(){
    	actualizar_datos_index_saia2();	
    });
  });
</script>
