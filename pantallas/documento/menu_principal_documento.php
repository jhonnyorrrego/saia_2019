<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
$documento='';
$funcionario=usuario_actual("funcionario_codigo");
/**
 * @param type $iddoc es el iddocumento
 * @param type $tipo_visualizacion es el tipo de visualizacion por defecto vacio que equivale a documento
**/
function menu_principal_documento($iddoc,$tipo_visualizacion="",$modulo_adicional=""){
global  $documento,$conn,$ruta_db_superior,$funcionario;
$formato=busca_filtro_tabla("","formato,documento","lower(plantilla)=lower(nombre) and iddocumento=".$iddoc,"",$conn);
$nombre=$formato[0]["nombre"];
$_SESSION["pagina_actual"]=$iddoc;

if($formato[0]['mostrar_pdf']==1){
    $_SESSION["tipo_pagina"]="pantallas/documento/visor_documento.php?iddoc=".$iddoc."&rnd=".rand();
}elseif($formato[0]['mostrar_pdf']==2){
    $_SESSION["tipo_pagina"]="pantallas/documento/visor_documento.php?pdf_word=1&iddoc=".$iddoc;
}else{
    $_SESSION["tipo_pagina"]="formatos/$nombre/mostrar_$nombre.php?iddoc=$iddoc";
}

echo(librerias_jquery("1.7"));
//if(usuario_actual('login')!='cerok' || !$tipo_visualizacion)return true;
echo(estilo_bootstrap());
echo(librerias_bootstrap());
if(@$_REQUEST["tipo"]!==5 && !@$_REQUEST["output"] && !@$_REQUEST["imprimir"]){
    if(!@$iddoc){
        if(@$_REQUEST['iddocumento']){
            $iddoc=$_REQUEST['iddocumento'];
        }
        else if(@$_REQUEST['key']){
            $iddoc=$_REQUEST['key'];
        }
        else{
            die('No existe un documento valido');
        }
    }
    $documento=busca_filtro_tabla("","documento A","A.iddocumento=".$iddoc,"",$conn);
		$formato=busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddoc,"",$conn);
    $mostrar_menu_acciones_rapidas=0;
    if($_SESSION["tipo_dispositivo"]!="movil"){
      $mostrar_menu_acciones_rapidas=1;
      $dropdown_menu=' top:40%; left: 40%; ';
      $tipo_pagina=$_SESSION["tipo_pagina"];
    }
    else{
      $tipo_pagina="pantallas/documento/informacion_resumen_documento.php?iddoc=".$iddoc."&no_seleccionar=1";
      $dropdown_menu=' position: fixed; top: 35; left: 0px; ';  
    }
	$datos_admin=botones_administrativos_menu($iddoc);
    echo(librerias_acciones_kaiten());
        ?>
    <style>
        .navbar-inner{height: 50px;}
        body{ font-size:12px; line-height:100%; margin-top:70px}
        .navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;}
        .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
        .texto-azul{ color:#3176c8}
        .btn-under {text-align: center;vertical-align: top;}
        .btn-under ul{text-align: left;}
        .btn-under h6{margin-top: 0px; font-size: 11; font-weight:normal;font-family: arial;}
        .btn-under > .dropdown-menu{ <?php echo($dropdown_menu);?>}
    </style>
    <div class="navbar navbar-fixed-top pull-center" id="menu_principal_documento">
      <div class="navbar-inner">
          <div class="container">
            <ul class="nav">
              <li>
              	<div class="btn-group pull-left btn-under">
              		<a href="<?php echo($ruta_db_superior.$tipo_pagina); ?>" class="kenlace_saia_propio" enlace="<?php echo($tipo_pagina); ?>" destino="_centro">
                    <button type="button" class="btn btn-mini">
                      
                        <i class="icon-acciones_menu_mostrar"></i>
                      
                    </button>
                   </a>
                </div>
                <div class="btn-group pull-left btn-under">
                    <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-acciones_menu_intermedio"></i>
                        <span class="caret alignPreview">&nbsp;</span>
                    </button><h6>Acciones</h6>
                    <ul class="dropdown-menu  <?php echo($clase_menu);?>">
                        <?php
                        echo(permisos_modulo_menu_intermedio($iddoc,"acciones_menu_intermedio",array("tipo"=>2)));
                        ?>
                    </ul>
                </div>
              </li>
              <li class="divider-vertical"></li>
              <li>
                <div class="btn-group pull-left btn-under">
                    <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown" >
                        <i class="icon-informacion_menu_intermedio"></i>
                        <span class="caret alignPreview">&nbsp;</span>
                    </button><h6>Seguimiento</h6>
                    <ul class="dropdown-menu  <?php echo($clase_menu);?>">
                        <?php
                        echo(permisos_modulo_menu_intermedio($iddoc,"informacion_menu_intermedio",array("tipo"=>2)));
                        ?>
                    </ul>
                </div>
              </li>
              <li class="divider-vertical"></li>
              <li>
                <div class="btn-group pull-left btn-under">
                    <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-otros_menu_intermedio"></i>
                        <span class="caret alignPreview">&nbsp;</span>
                    </button><h6>Otros</h6>
                    <ul class="dropdown-menu <?php echo($clase_menu);?>">
                        <?php
                        echo(permisos_modulo_menu_intermedio($iddoc,"otros_menu_intermedio",array("tipo"=>2)));
                        ?>
                    </ul>
                </div>
              </li>
              <li class="divider-vertical"></li>
              <?php
                 if(@$mostrar_menu_acciones_rapidas){
              ?>
              <li id="acciones_rapidas_menu_saia">
                <div class="btn-group pull-left btn-under">
                    <?php
                    echo(permisos_modulo_menu_intermedio($iddoc,"rapidos_menu_intermedio",array("nombre"=>"rapidos_menu_intermedio","tipo"=>1)));
                    ?>
                    <h6>Acciones r&aacute;pidas</h6>
                </div>
              </li>
              <li class="divider-vertical"></li>
              <?php
                }
                $estado_documento="";
              ?>
              <li>
              	<div class="btn-group pull- btn-under">
              	<?php
              	$titulo=false;
              	if($datos_admin["confirmar"]){
              	$titulo=true;
              	?>
                <div class="btn btn-mini" id="aprobar_documento" titulo="Aprobar documento" title="Aprobar documento" destino="_self">
             &nbsp;<i class="icon-ok"></i>
                <script type="text/javascript">
                  $(document).ready(function(){
                    $("#aprobar_documento").click(function(){
                      window.open("<?php echo($ruta_db_superior); ?>class_transferencia.php?iddoc=<?php echo($iddoc); ?>&funcion=aprobar","_self");
                    });
                  });
                </script>
                </div>
              <?php
							}
              if($datos_admin["editar"]){ // || usuario_actual('login')=='cerok'
              	$titulo=true;
              	$datos_pantalla=busca_filtro_tabla("ruta_pantalla,nombre","pantalla A","A.idpantalla=".$documento->documento[0]["pantalla_idpantalla"],"",$conn);
              ?>
              	<div class="btn btn-mini" id="editar_documento" titulo="Editar" title="Editar" destino="_self">
              		&nbsp;<i class="icon-edit"></i>
             		<script type="text/javascript">
                  $(document).ready(function(){
                    $("#editar_documento").click(function(){
                      window.open("<?php echo($ruta_db_superior);?>formatos/<?php echo($formato[0]["nombre"]); ?>/<?php echo($formato[0]["ruta_editar"]); ?>?iddoc=<?php echo($iddoc); ?>&idformato=<?php echo($formato[0]["idformato"]); ?>","_self");
                    });
                  });
                </script>
               	</div>
              <?php } ?>
              <?php if($datos_admin["ver_responsables"]){
              	$titulo=true;
              ?>
              	<div class="btn btn-mini" id="ver_responsables" titulo="Ver responsables" title="Ver responsables" destino="_self">
              		&nbsp;<i class="icon-hand-right"></i>
             		<script type="text/javascript">
                  $(document).ready(function(){
                    $("#ver_responsables").click(function(){
                      window.open("<?php echo($ruta_db_superior); ?>mostrar_ruta.php?doc=<?php echo($iddoc);?>","_self");
                    });
                  });
                </script>
                </div>
              <?php } ?>
              <?php if($datos_admin["devolucion"]){
              	$titulo=true;
              ?>
              	<div class="btn btn-mini" id="devolver" titulo="Devolver" title="Devolver" destino="_self">
              		&nbsp;<i class="icon-hand-left"></i>
             		<script type="text/javascript">
                  $(document).ready(function(){
                    $("#devolver").click(function(){
                      window.open("<?php echo($ruta_db_superior); ?>class_transferencia.php?iddoc=<?php echo($iddoc); ?>&funcion=formato_devolucion","_self");
                    });
                  });
                </script>
                </div>
              <?php }
              if($titulo){
              ?>
              <h6>Acciones documento</h6>
              <?php } ?>
                </div>
              </li>
              <?php if(@$modulo_adicional["nombre"]!==''){
                    $modulos_adicionales=busca_filtro_tabla("","modulo", "nombre='".$modulo_adicional["nombre"]."'", "", $conn);
                    if($modulos_adicionales["numcampos"]){
                     ?>
              <li class="divider-vertical"></li>
              <li>
               <div class="btn-group btn-under" id="modulo_adicional_<?php echo($modulos_adicionales[0]["nombre"]);?>">
                   <?php
                    if(@$modulo_adicional["tipo"]){
                   ?>
                    <button class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                        <i class="icon-flag"></i>
                        <span class="caret alignPreview">&nbsp;</span>
                    </button><h6><?php echo($modulos_adicionales[0]["etiqueta"]);?></h6>
                    <ul class="dropdown-menu pull-right <?php echo($clase_menu);?>" style="top:50%;left:auto;">
                        <?php
                    }
                        echo(permisos_modulo_menu_intermedio($iddoc,$modulos_adicionales[0]["nombre"],array("tipo"=>$modulo_adicional["tipo"])));
                    if(!$modulo_adicional["tipo"]){
                        ?>
                        <h6><?php echo($modulos_adicionales[0]["etiqueta"]);?></h6>
                        <?php
                    }
                    else{
                        ?>
                    </ul>
                    <?php
                    } ?>
                </div>
              </li>
                    <?php
                    }

                }
              ?>
            </ul>
          </div>
      </div>
    </div>
        <?php
    }
}
/*
$iddoc=iddocumento
$modulo_padre=nombre del modulo padre
$lista=arreglo con nombre: nombre del modulo y tipo=1 botones con enlace, tipo=2 listado, tipo= 0 clase
$target=destino donde se debe abrir el enlace
*/
function permisos_modulo_menu_intermedio($iddoc, $modulo_padre,$lista,$target="_self"){
  global $ruta_db_superior,$documento,$funcionario;
  $texto='';
  if($modulo_padre=="rapidos_menu_intermedio"){
      $datos_modulos=array('devolucion','transferir','responder','seguimiento','terminar_documento','vista_previa');
  }
  else{
      $datos_modulos=  modulos_menu_intermedio($modulo_padre);
  }

    $documento_anulado=busca_filtro_tabla("estado","documento","iddocumento=".$iddoc,"",$conn);
    if($documento_anulado[0]['estado']=='ANULADO'){
        $modulos_documentos_anulados=array();
        switch(strtolower($modulo_padre)){
            case 'otros_menu_intermedio':
                $modulos_documentos_anulados=array('Almacenamiento');
                break;
            case 'acciones_menu_intermedio':
                $modulos_documentos_anulados=array('devolucion','transferir','expediente_menu','enviar_documento_correo');
                break;
            case 'rapidos_menu_intermedio':
                $modulos_documentos_anulados=array('transferir','seguimiento','devolucion','vista_previa');
                break;
            default:
                break;
        }
        
        $datos_modulos=$modulos_documentos_anulados;
    }
    
    $permiso=new PERMISO();
    $modulo=  busca_filtro_tabla("", "modulo", "nombre IN ('".implode("','",$datos_modulos)."')", "orden", $conn);
    //$ok=1;

    //print_r($modulo);die();
    for($i=0;$i<$modulo["numcampos"];$i++){
      $ok=$permiso->acceso_modulo_perfil($modulo[$i]["nombre"],1);
      if($ok || usuario_actual('login')=='cerok'){
				if($modulo[$i]["nombre"]=="eliminar_borrador" && ($documento[0]["estado"]!="ACTIVO" || $documento[0]["ejecutor"]!=$funcionario)){
					continue;
				}
      	if($modulo[$i]["nombre"]=='vista_previa' && @$_REQUEST["vista"]){
      		$modulo[$i]["enlace"].="&vista=".$_REQUEST["vista"];
      	}
				if($modulo[$i]["nombre"]=='ver_notas_posit'){
					$datos_documento=busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddoc,"",$conn);
					$modulo[$i]["enlace"]="formatos/".$datos_documento[0]["nombre"]."/".$datos_documento[0]["ruta_mostrar"]."?iddoc=".$datos_documento[0]["iddocumento"]."&idformato=".$datos_documento[0]["idformato"]."&ver_notas=1";
				}
      	if($modulo[$i]["destino"] && $modulo[$i]["destino"]!="centro"){
      		$target=$modulo[$i]["destino"];
      	}
        if(@$iddoc){
          $dir=str_replace('@key@',$iddoc,$modulo[$i]["enlace"]);
        }
        if($lista["tipo"]==2){
          //Menu listado
          $texto.='<li><a href="'.$ruta_db_superior.$dir.'" class="kenlace_saia_propio" enlace="'.$dir.'" destino="'.$target.'"><i class="icon-'.$modulo[$i]["nombre"].'"></i> '.$modulo[$i]["etiqueta"].'</a></li>';
        }
        else if($lista["tipo"]==1){
          //Menu rapido
           $texto.='<div class="btn btn-mini kenlace_saia_propio" titulo="'.$modulo[$i]["etiqueta"].'" enlace="'.$ruta_db_superior.$dir.'" title="'.$modulo[$i]["etiqueta"].'" destino="'.$target.'">
             &nbsp;<i class="icon-'.$modulo[$i]["nombre"].'"></i> &nbsp;
            </div>';
        }
        else{
           $texto.='<div class="btn btn-mini tooltip_saia_abajo '.$modulo[$i]["nombre"].'" title="'.$modulo[$i]["etiqueta"].'">
             &nbsp; <i class="icon-'.$modulo[$i]["nombre"].'"></i> &nbsp;
            </div>';
        }
      }
    }
    return($texto);
}
function modulos_menu_intermedio($nombre_padre){
    $modulo_padre=  busca_filtro_tabla("", "modulo", "nombre LIKE '".$nombre_padre."'", "orden", $conn);
    $lmodulos=  busca_filtro_tabla("", "modulo", "cod_padre=".$modulo_padre[0]["idmodulo"], "orden", $conn);
    $arreglo=  extrae_campo($lmodulos, "nombre","UL");
    return($arreglo);
}
function permisos_modulo_clase($iddoc, $modulo_padre,$lista,$target="_self"){
    global $ruta_db_superior,$documento;
    if(!@$documento["numcampos"]){
      $documento=  new documento();
      $documento->get_documento($iddoc);
    }
    $texto='';
    $datos_modulos=  modulos_menu_intermedio($modulo_padre);
    $permiso=new PERMISO();
    $modulo=  busca_filtro_tabla("", "modulo", "nombre IN ('".implode("','",$datos_modulos)."')", "orden", $conn);
    //$ok=1;
    for($i=0;$i<$modulo["numcampos"];$i++){
        $clase=$modulo[$i]["nombre"];
        $ok=$permiso->acceso_modulo_perfil($modulo[$i]["nombre"],1);
        if($ok){
            if(@$iddoc){
                $dir=str_replace(array('@key@','@iddoc@','@iddocumento@'),$iddoc,$modulo[$i]["enlace"]);
                    $dir=str_replace('@nombreformato@',strtolower($documento->documento[0]["plantilla"]),$dir);
            }
            if($lista==1){
               $texto.='<li><a href="'.$ruta_db_superior.$dir.'" class="enlace '.$clase.'" enlace="'.$dir.'" destino="'.$target.'"><i class="icon-'.$modulo[$i]["nombre"].'"></i>'.htmlentities($modulo[$i]["etiqueta"]).'</a></li>';
            }
            elseif($lista==2){
                $texto.='<a class="tooltip_saia_abajo pull-left '.$modulo[$i]["nombre"].' abrir_highslide enlace" title="'.  html_entity_decode($modulo[$i]["etiqueta"]).'" enlace="'.$dir.'" destino="'.$target.'" style="height: 19px;" id="'.$modulo_padre.'">
                 <i class="icon-'.$modulo[$i]["nombre"].'"></i></a>';
            }
            else{
               $texto.='<button type="button" class="btn btn-mini tooltip_saia_abajo enlace'.$clase.'" title="'.html_entity_decode($modulo[$i]["etiqueta"]).'" enlace="'.$ruta_db_superior.$dir.'" destino="'.$target.'">
                 &nbsp; <i class="icon-'.$modulo[$i]["nombre"].'"></i>
                </button>';
            }
        }
    }
    return($texto);
}
function botones_administrativos_menu($iddoc){
	global $conn;
	$formato=busca_filtro_tabla("","documento A, formato B","lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=".$iddoc,"",$conn);
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
	  if(is_file($ruta."db.php")){
	    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	  }
	  $ruta.="../";
	  $max_salida--;
	}
	include_once($ruta_db_superior."class_transferencia.php");
	$texto=array();
	$usuario_actual=$_SESSION["usuario_actual"];
	$usuario_reemplazo=reemplazo($_SESSION["usuario_actual"],'reemplazo');
	if($usuario_actual!=$usuario_reemplazo){
		$usuario_actual=$usuario_reemplazo;
	}

	$responsable=busca_filtro_tabla("destino,estado,plantilla","buzon_entrada,documento","iddocumento=archivo_idarchivo and archivo_idarchivo=".$iddoc,"buzon_entrada.idtransferencia asc",$conn);

	$ver_responsables_previo=false;
	$ver_responsables=false;
	$boton_editar=false;
	$boton_confirmar=false;
	$boton_devolucion=false;

	$v_permisos=array();
  $permisos=busca_filtro_tabla("","permiso_documento A","A.funcionario='".$usuario_actual."' AND documento_iddocumento=".$iddoc,"",$conn);
  if($permisos["numcampos"]){
  	$v_permisos=explode(",",$permisos[0]["permisos"]);
	}

	if($responsable["numcampos"]){
		$formato2=busca_filtro_tabla("","formato A","A.nombre LIKE '".strtolower($responsable[0]["plantilla"])."' AND tipo_edicion=1","",$conn);
		if($responsable[0]["estado"]=="ACTIVO" || $formato2["numcampos"]){
    	if($responsable[0]["estado"]=="ACTIVO"){
      	$ver_responsables_previo=true;
    	}
    	if(in_array("m",$v_permisos)){
      	if(@$_REQUEST["vista"] == ""){
        	$boton_editar=True;
      	}
    	}
  	}

		$actual=busca_filtro_tabla("A.idtransferencia as idtrans,A.destino,A.ruta_idruta","buzon_entrada A","A.activo=1 and A.archivo_idarchivo=".$iddoc." and (A.nombre='POR_APROBAR') and A.destino='".$usuario_actual."'","A.idtransferencia",$conn);
		if($actual["numcampos"]>0){
      $anterior=busca_filtro_tabla("A.idtransferencia,A.ruta_idruta","buzon_entrada A","A.idtransferencia <".$actual[0]["idtrans"]." and A.nombre='POR_APROBAR' and A.activo=1 and A.archivo_idarchivo=".$iddoc." and origen='".$usuario_actual."'","",$conn);
    }
    if($_REQUEST["vista"]==""){
    	$boton_confirmar=true;
   	}

		if($responsable["numcampos"]>0 && $responsable[0]["destino"]<>$usuario_actual){
			$boton_devolucion=true;
		}

    if(@$actual[0]["destino"]<>$usuario_actual || @$anterior["numcampos"]>0){
    	$ver_responsables=false;
    	if($ver_responsables_previo && in_array("r",$v_permisos)){
      	$ver_responsables=true;
			}
			$boton_confirmar=false;
			$boton_devolucion=false;
    }
   	if($ver_responsables_previo && in_array("r",$v_permisos)){
      if($_REQUEST["vista"]==""){
				$ver_responsables=true;
			}
		}
	}
	return(array("ver_responsables"=>$ver_responsables,"editar"=>$boton_editar,"devolucion"=>$boton_devolucion,"confirmar"=>$boton_confirmar));
}

if(@$_REQUEST["mostrar_menu"]){
  if($_REQUEST["iddocumento"]){
    menu_principal_documento($_REQUEST["iddocumento"]);
  }
}
?>
