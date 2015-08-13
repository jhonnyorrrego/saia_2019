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
//include_once("cargando.php");
if(@$_SESSION["LOGIN".LLAVE_SAIA]){
$fondo=busca_filtro_tabla("A.valor","configuracion A","A.tipo='empresa' AND A.nombre='fondo'","A.fecha,A.valor DESC",$conn);
almacenar_sesion(1,"");
$alto_menu=78;
$intervalo_recarga_informacion=900000;
$proxima=busca_filtro_tabla("valor","configuracion","nombre='actualizacion_fin_anio'","idconfiguracion DESC",$conn);
if($proxima["numcampos"]){
$fecha=busca_filtro_tabla(resta_fechas("'".$proxima[0][0]."'","'".date("Y-m-d")."'"),"dual","","",$conn);
if(@$fecha[0][0]<0)
  {alerta("Se van a realizar algunas actualizaciones por el cambio de año, por favor espere.");
   abrir_url("actualizacion_cambio_anio.php");
  }
}
$pendientes=busca_filtro_tabla("count(*) AS cant,A.iddocumento","documento A,asignacion B","A.estado<>'ELIMINADO' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad=".usuario_actual("funcionario_codigo"),"GROUP BY A.iddocumento",$conn);

}
}
?>
<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SAIA 2.0</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
    	<div class="accordion" id="menu_saia">
        <?php 
        if(isset($_SESSION["LOGIN".LLAVE_SAIA])&& $_SESSION["LOGIN".LLAVE_SAIA]){
        	$texto='';
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
        				$texto.='<div class="accordion-group">
        					<div class="accordion-heading alert-info">
            				<div class="accordion-toggle" data-toggle="collapse" data-parent="#menu_saia" data-target="#modulo'.$modulo[$i]["idmodulo"].'">'.strtoupper($modulo[$i]["etiqueta"]).'</div> 
            			</div>
              		<div id="modulo'.$modulo[$i]["idmodulo"].'" class="accordion-body collapse" style="height: 0px;">
            				<div class="accordion-inner">'; 
              				$texto.=mostrar_iconos($modulo[$i]["idmodulo"]);
              			$texto.='</div>
              		</div></div>';             
       			} 
					} 
        } 
				echo($texto);
      ?>
      </div>
      <?php  
      	function mostrar_iconos($modulo_actual){
          global $conn;
          $cols=4;
					$texto='';
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
              $texto='<table width="100%" border="0" class="table table-bordered" cellpadding="0"><tr>';
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
                  $texto.='</tr><tr>';
                }    
                $texto.='<td width="'.(($cols*35)) .'px" height="44" align="center" valign="top"><a href="'.$tablas[$j]["enlace"];
                if(!strpos($tablas[$j]["enlace"],"?"))
                  $texto.='?cmd=resetall"';
                else 
                  $texto.="&cmd=resetall\"";
                $texto.=' target="'.$tablas[$j]["destino"].'"><img src="'.$tablas[$j]["imagen"].'" border="0" width="35px"';
                $texto.=' ><br />'.$tablas[$j]["etiqueta"].'</a></td>';
              }
              for(;$j%$cols!=0;$j++){
                $texto.='<td>&nbsp;</td>';
              }
              $texto.='</tr></table>'; 
            }
						return($texto);         
		  		}
        }
        ?>
    </div>
    <div class="span9">
      <!--Body content-->
      <div class="container">
      	Contenedor
      </div>
    </div>
  </div>
</div>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
?>