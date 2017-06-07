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
include_once($ruta_db_superior . "pantallas/documento/class_documento_informacion.php");
//echo(estilo_bootstrap());
/**
 *
 * @param type $iddoc es el iddocumento
 * @param type $tipo_visualizacion es el tipo de visualizacion por defecto vacio que equivale a documento
 */
function menu_principal_documento($iddoc,$tipo_visualizacion){
	return false;
global $ruta_db_superior;
    ?>
<style>
    .navbar-inner{height: 50px;}
    body{ font-size:12px; line-height:100%; margin-top:60px}
    .navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;}
    .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
    .texto-azul{ color:#3176c8}
    .btn-under {text-align: center;vertical-align: top; }
    .btn-under ul{text-align: left;}
    .btn-under h6{margin-top: 0px; font-size: 11; font-weight:normal;}
    .btn-under > .dropdown-menu{top:40%; left: 40%;}
</style>
<div class="navbar navbar-fixed-top pull-center">
  <div class="navbar-inner">
    <ul class="nav">
      <li>
      <div min-width="50px" style="float:left"> &nbsp;</div>
        <div class="btn-group pull-left btn-under">
            <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                <i class="icon-flag"></i>
                <span class="caret alignPreview">&nbsp;</span>
            </button><h6>Acciones</h6>
            <ul class="dropdown-menu">
                <?php
                echo(permisos_modulo_menu_intermedio("acciones_menu_intermedio",1));
                ?>
            </ul>
        </div>
      </li>
      <li class="divider-vertical"></li>
      <li>
        <div class="btn-group pull-left btn-under">
            <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown" >
                <i class="icon-flag"></i>
                <span class="caret alignPreview">&nbsp;</span>
            </button><h6>Seguimiento</h6>
            <ul class="dropdown-menu">
                <?php
                echo(permisos_modulo_menu_intermedio("informacion_menu_intermedio",1));
                ?>
            </ul>
        </div>
      </li>
      <li class="divider-vertical"></li>
      <li>
        <div class="btn-group pull-left btn-under">
            <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown">
                <i class="icon-flag"></i>
                <span class="caret alignPreview">&nbsp;</span>
            </button><h6>Otros</h6>
            <ul class="dropdown-menu">
                <?php
                echo(permisos_modulo_menu_intermedio("otros_menu_intermedio",1));
                ?>
            </ul>
        </div>
      </li>
      <li class="divider-vertical"></li>
      <li>
        <div class="btn-group pull-left btn-under">
            <?php
            echo(permisos_modulo_menu_intermedio("rapidos_menu_intermedio",0));
            ?>
            <h6>Acciones r&aacute;pidas</h6>
        </div>
      </li>
      <li class="divider-vertical"></li>
      <li>
          <div class="btn-group pull-left">
               <button type="button" class="btn btn-mini dropdown-toggle" data-toggle="dropdown" id="informativos_documento">
                   Informaci&oacute;n
                <span class="caret alignPreview">&nbsp;</span>
               </button>
               <ul class="dropdown-menu">
                   <li><a href="#" id="ver_notas_mi"><span id="cantidad_notas">Notas <img src="<?php echo($ruta_db_superior."images/loader-ajax.gif");?>"></span></a></li>
                   <li><a href="#" id="ver_paginas_mi"><span id="cantidad_paginas">P&aacute;ginas <img src="<?php echo($ruta_db_superior."images/loader-ajax.gif");?>"></span></a></li>
                   <li><a href="#" id="ver_anexos_mi"><span id="cantidad_anexos">Anexos <img src="<?php echo($ruta_db_superior."images/loader-ajax.gif");?>"></span></a></li>
               </ul>
          </div>
      </li>
    </ul>
  </div>
</div>
    <?php
}
function permisos_modulo_menu_intermedio($modulo_padre,$lista){
    global $ruta_db_superior;
    $texto='';
    if($modulo_padre=="rapidos_menu_intermedio"){
        $datos_modulos=array('vista_previa','devolucion','transferir','responder','tareas','seguimiento','verificar_flujo_documento');
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
    for($i=0;$i<$modulo["numcampos"];$i++){
        $ok=$permiso->permiso_usuario($modulo[$i]["nombre"],1);
        if($ok){
        	$dir=$modulo[$i]["enlace"];
            if(@$_REQUEST["iddoc"]){
            	$doc=$_REQUEST["iddoc"];
                $dir=str_replace('@key@',$doc,$dir);
			}
            else if(@$_REQUEST["key"]){
            	$doc=$_REQUEST["key"];
                $dir=str_replace('@key@',$doc,$dir);
            }
			if(strpos($modulo[$i]["enlace"],"@idformato@")){
				$formato=busca_filtro_tabla("","documento a, formato b","lower(a.plantilla)=lower(b.nombre) and iddocumento=".$doc,"",$conn);
				$dir=str_replace('@idformato@',$formato[$i]["idformato"],$dir);
			}
			else if(strpos($modulo[$i]["enlace"],"@nombreformato@")){
				$formato=busca_filtro_tabla("b.nombre","documento a, formato b","lower(a.plantilla)=lower(b.nombre) and iddocumento=".$doc,"",$conn);
				$dir=str_replace('@nombreformato@',$formato[$i]["nombre"],$dir);
			}
            if($lista){
               $texto.='<li><a href="/'.RUTA_SAIA.$dir.'" class="kenlace_saia_propio" enlace="/' . RUTA_SAIA .$dir.'"><img hspace="0" height="16" width="16" vspace="0" border="0" src="'.$ruta_db_superior.$modulo[$i]["imagen"].'"> '.$modulo[$i]["etiqueta"].'</a></li>';
            }
            else{
               $texto.='<button type="button" class="btn btn-mini tooltip_saia_abajo kenlace_saia_propio" titulo="'.$modulo[$i]["etiqueta"].'" enlace="'.$ruta_db_superior.$dir.'">
                 &nbsp; <img hspace="0" height="16" width="16" vspace="0" border="0" src="'.$ruta_db_superior.$modulo[$i]["imagen"].'"> &nbsp;
                </button>';
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
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
    $(document).ready(function(){
        $("#informativos_documento").click(function(){
            $.ajax({
                type:'GET',
                url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
                data: "librerias=pantallas/documento/class_documento_informacion.php&funcion=llamado_general_documento&parametros=<?php echo($_REQUEST['iddoc']);?>",
                success: function(html){
                  var objeto=jQuery.parseJSON(html);
                  $("#cantidad_notas").html("Notas: "+objeto.notas);
                  $("#cantidad_paginas").html("P&aacute;ginas: "+objeto.paginas);
                  $("#cantidad_anexos").html("Anexos: "+objeto.anexos);

                }
            });
        });
    iniciar_tooltip();
    });
</script>