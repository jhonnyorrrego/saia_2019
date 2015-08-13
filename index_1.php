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
include_once("cargando.php");
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
$fondo=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='fondo'","A.fecha,A.valor DESC",$conn);
almacenar_sesion(1,"");
$alto_menu=78;
//limpieza temporales
include_once("tarea_limpiar_carpeta.php");
borrar_archivos_carpeta("temporal_".usuario_actual("login"),0);
/*************actualizacion de fin de a�o ********/
/*
$proxima=busca_filtro_tabla("valor","configuracion","nombre='actualizacion_fin_anio'","",$conn);
if($proxima["numcampos"])
{
$fecha=busca_filtro_tabla(resta_fechas("'".$proxima[0][0]."'","'".date("Y-m-d")."'"),"","","",$conn);
if(@$fecha[0][0]<0)
  {alerta("Se van a realizar algunas actualizaciones por el cambio de a�o, por favor espere.");
   abrir_url("actualizacion_cambio_anio.php");
  }
}
*/

$proxima=busca_filtro_tabla("valor","configuracion","nombre='actualizacion_fin_anio'","",$conn);
if($proxima["numcampos"])
{
$fecha=busca_filtro_tabla(resta_fechas("'".$proxima[0][0]."'","'".date("Y-m-d")."'"),"","","",$conn);       
if(@$fecha[0][0]<0)
  {alerta("Se van a realizar algunas actualizaciones por el cambio de a�o, por favor espere.");
   abrir_url("actualizacion_cambio_anio.php");
  }
}
/*************actualizacion de fin de a�o ********/
/*include_once("class_transferencia.php");
include_once("paso_buzones.php");
revisar_fechas2("gestion");
revisar_fechas2("central");
revisar_fechas2("historico");*/
}
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>  
<head>
<title>SAIA - SISTEMA DE ADMINISTRACI&Oacute;N INTEGRAL DE ARCHIVOS</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">   
<style type="text/css">
body {overflow-x:hidden;}
</style>
<link type="text/css" href="css/ui-darkness/jquery-ui-1.8rc3.custom.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>
<script type="text/javascript">
	$(function(){	
		// Tabs
		$('#tabs').tabs();
	});
</script>
</head>
<body topmargin="0"  marginheight="0" topmargin="0" vspace="0"
marginwidth="0" leftmargin="0" hspace="0" style="margin:0; padding:0">
<div align="center"> 
  <table width="980" height="600" border="0"  cellpadding="0" cellspacing="0" <?php if(@$fondo["numcampos"]){ ?> background="<?php echo ($fondo[0][0]); ?>" <?php } ?> id="tabla" style="background-repeat: no-repeat; background-position:top;" valign="top">
    <tr valign="top" height="100">
      <td width="720" align="left">
        <div style="position:relative;left:154px; top:6px;">
        <div id="menu_principal">
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
          $modulo=busca_filtro_tabla("*","modulo A","A.idmodulo IN(select distinct b.cod_padre from modulo b where b.idmodulo in(".$lista."))","orden",$conn);
          echo '<div id="tabs"  style="top:0px;width:980px; height:50px ;font-family:verdana;font-size:8pt;"><ul>';
          for($i=0;$i<$modulo["numcampos"];$i++){
            if($modulo["numcampos"] && $modulo[$i]["idmodulo"] && $modulo[$i]["etiqueta"] && $modulo[$i]["tipo"]=='1'){ echo "<li><a href='auxiliar2.php?modulo=".$modulo[$i]["idmodulo"]."'>".strtoupper($modulo[$i]["etiqueta"])."</a></li>";              
            }
          }
          echo '</ul></div>';
          
         }
              ?>
        </div>
      </div>
      </td>
    </tr>
<?php
$pagina_inicio="login.php";
//print_r($_SESSION);
if((!isset($_REQUEST["fin"]) || !$_REQUEST["fin"])&& isset($_SESSION["LOGIN".LLAVE_SAIA]))
    {//busco en configuraci�n la pagina donde debe inicia saia
     $pag=busca_filtro_tabla("A.valor","configuracion A","A.nombre='pagina_inicio'","",$conn);
     if($pag["numcampos"])
     $pagina_inicio=$pag[0][0];
    }
?>    
    <tr align="center" height="460">
      <td colspan="3" align="center"><iframe name="centro" id="centro" height="450" width="970" style="position:relative; top:-20px;" scrolling="auto" frameborder="0" src="<?php echo $pagina_inicio; ?>" allowtransparency="yes"></iframe>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
<?php include_once("fin_cargando.php");?>