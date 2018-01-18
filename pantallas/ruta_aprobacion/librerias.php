<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");

$_REQUEST["ejecutar_funcion"]();
if (@$_REQUEST['ejecutar_funcion']) {

	function set_categoria() {
		global $conn;
		echo(librerias_jquery('1.7'));
		echo(librerias_notificaciones());

		$tabla = "categoria_formato";
		$fieldList = array();
		$fieldList["cod_padre"] = 2;
		$fieldList["nombre"] = "'" . decodifica_encabezado(htmlentities($_REQUEST['nombre'])) . "'";
		$fieldList["descripcion"] = "'" . decodifica_encabezado(htmlentities($_REQUEST['descripcion'])) . "'";
		$fieldList["estado"] = 1;
		$strsql = "INSERT INTO " . $tabla . " (fecha,";
		$strsql .= implode(",", array_keys($fieldList));
		$strsql .= ") VALUES (" . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . ",";
		$strsql .= implode(",", array_values($fieldList));
		$strsql .= ")";
		phpmkr_query($strsql);

		die();
	}

	function edit_categoria() {
		global $conn;
		echo(librerias_jquery('1.7'));
		echo(librerias_notificaciones());
		$nombre = decodifica_encabezado(htmlentities($_REQUEST['nombre']));
		$descripcion = decodifica_encabezado(htmlentities($_REQUEST['descripcion']));
		$sql = "UPDATE categoria_formato SET nombre='" . $nombre . "',descripcion='" . $descripcion . "' WHERE idcategoria_formato=" . @$_REQUEST['idcategoria_formato'];
		phpmkr_query($sql);

		die();
	}

}

function insertar_cf_ruta_formato($ruta = array(), $iddoc) {
	global $conn;
	/*documento_iddocumento= iddoc
	 orden = orden en que firman
	 funcionario_codigo = funcionario_codigo del funcionario
	 estado = 1;ruta activa y 0;ruta inactiva
	 notificacion= 0,pendiente notificar y 1 ya se ha notificado
	 tipo_notificacion= 0 ninguno, 1 transferencia, 2 correo, 3 correo y transferencia
	 tipo_aprobacion 0 rechazado y 1 aprobado
	 observaciones = observaciones
	 nombre_funcion = nombre funcion que se ejecuta posterior al aprobar,devolver,rechazar
	 Recibe 4 parametros: 1. $datos_cf=array(todos los datos de la cf), $siguiente=array(todos los datos del siguiente en la ruta), $datos_formato=array(datos del formato) y opcion 1=>aprobado,2=>rechazado, 3=>devuelto,4=>reactivar proceso
	 libreria = ruta desde la raiz donde esta ubicada la funcion
	 NOTA: Las funciones se deben trabajar siempre con retornos, no pueden haber "echo" esto por que es ajax*/

	$cant = count($ruta);
	if ($cant > 0) {
		$datos = busca_filtro_tabla("", "cf_ruta_formato", "documento_iddocumento=" . $iddoc . " and estado=1", "", $conn);
		if ($datos["numcampos"]) {
			$sql_update = "UPDATE cf_ruta_formato SET estado=0 WHERE documento_iddocumento=" . $iddoc;
			phpmkr_query($sql_update);
		}
		for ($i = 0; $i < $cant; $i++) {
			$sql_ruta = "INSERT INTO cf_ruta_formato (documento_iddocumento,orden,funcionario_codigo,estado,notificacion,tipo_notificacion,observaciones,nombre_funcion,libreria) VALUES (" . $iddoc . "," . ($i + 1) . "," . $ruta[$i]["funcionario_codigo"] . ",1,0," . $ruta[$i]["tipo_notificacion"] . ",'" . @$ruta[$i]["observaciones"] . "','" . @$ruta[$i]["nombre_funcion"] . "','" . @$ruta[$i]["libreria"] . "')";
			phpmkr_query($sql_ruta);
		}
		return true;
	}
	return false;
}


function mostrar_cf_ruta_formato($idformato,$iddoc,$tipo_firma=0,$activa_obs=0,$act_proceso=0,$tipo=0,$carga_js=0,$genera_pdf=0,$asunto_correo=""){
global $conn,$ruta_db_superior;
  /*$tipo_firma= Carga las aprobaciones como 0=> listado (vertical) 1=>firmas (vertical) 2=> listado reporte (horizontal)
  $activa_obs= Solicita observaciones 0=> inactivo 1=>activo
  $act_proceso= En caso de Rechazo, se habilita para reactivar el proceso 0=>inactivo 1=>activo
  $tipo= 0=> para el echo, 1=>retorno
  $carga_js= si la funcion se llama varias en el mismo momento, no se puede cargar el javascript repetidas veces 0=>Se carga javascript una vez 1=> no se llama el javascript
  $genera_pdf = si desea que al enviar correo adjunte el pdf
  $asunto_correo el asunto del correo en caso que el tipo de notificacion sea por correo*/
  
  if($_REQUEST["tipo"]!=5 && $carga_js==0){
    echo(librerias_jquery("1.7"));
    ?>
    <script>
      $(document).ready(function (){
        var activa_obs=parseInt(<?php echo $activa_obs; ?>);
        $("[id$='_confirm']").click(function (){
        	$("[id$='_confirm']").hide()
        	$(this).after('<img src="<?php echo($ruta_db_superior); ?>images/loader-ajax.gif"/>');
          var observaciones=""; var ok=1;
          if($(this).attr("tipo")=="4"){
            if(confirm("Esta Seguro de Activar el Proceso?")===false){
               ok=0;
            }
          }else if($(this).attr("tipo")!="2" && activa_obs==1){
            observaciones=prompt("Observaciones");
          }else if($(this).attr("tipo")=="2"){
            if(confirm("Esta Seguro de Rechazar el Documento?")===false){
              ok=0;
            }else if(activa_obs==1){
              observaciones=prompt("Observaciones");
            }
          }
          if(ok){
            $.ajax({
              type:'POST',
              dataType:"json",
              url: "<?php echo($ruta_db_superior); ?>formatos/librerias/actualiza_cf_ruta_formato.php",
              data: {tipo_aprobacion:$(this).attr("tipo"), idcf:$(this).attr("idcf_ruta"), observ:observaciones,genera_pdf:'<?php echo $genera_pdf; ?>',asunto_correo:'<?php echo $asunto_correo; ?>'},
              success: function(data){
                if(data.exito!=1){
                  alert("Ha ocurrido un error, por favor intente de nuevo o comuniquese con el administrador");
                }
                window.location.reload();
              }, error:function(par1,par2,par3){
              	alert("Se ha producido un "+par2+" ("+par3+"), por favor intente de nuevo o comuniquese con el administrador");
              	window.location.reload();
              } 
            }); 
          }
        });
      });
    </script>
    <?php
  }

  $datos=busca_filtro_tabla("cf.*,f.nombres,f.apellidos,d.estado,".fecha_db_obtener('d.fecha','Y-m-d')." as fecha_aprob","cf_ruta_formato cf,funcionario f,documento d","cf.documento_iddocumento=".$iddoc." and cf.estado=1 and cf.funcionario_codigo=f.funcionario_codigo and d.iddocumento=cf.documento_iddocumento","cf.orden asc",$conn);
  if($datos["numcampos"]){
    $width_td="";
    if($tipo_firma==1){
      $ancho_firma=busca_filtro_tabla("valor","configuracion A","A.nombre='ancho_firma'","",$conn);
      if(!$ancho_firma["numcampos"]){$ancho_firma[0]["valor"]=200;}
      $alto_firma=busca_filtro_tabla("valor","configuracion A","A.nombre='alto_firma'","",$conn);
      if(!$alto_firma["numcampos"]){$alto_firma[0]["valor"]=100;}     
      $html='<table border="0" cellpadding="0" cellspacing="0" align="left" width="100%">';
      $width_td='width="50%"';
    }else if($tipo_firma==2){
      $html='<table style="width:100%; border-collapse:collapse" border="0" align="center"><tr>';
      
    }else{
      $html='<table>'; 
    }
    for($i=0;$i<$datos["numcampos"];$i++){
      $observaciones="";
      if(trim($datos[$i]["observaciones"]!="")){
        $observaciones="<br/>".$datos[$i]["observaciones"];
      }
      $activar_proceso="";
      if($_SESSION["usuario_actual"]==$datos[$i]["funcionario_codigo"] && $_REQUEST["tipo"]!=5 && $act_proceso==1){
         $activar_proceso='<br/><input type="button" value="Activar Proceso" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="4" id="activa_confirm">';
      }
      if($tipo_firma==1){
       if(($i % 2)==0){
          $html.='<tr>';
        }
        $parte_cargo=""; $imag=""; $botones='';
        if(is_null($datos[$i]["tipo_aprobacion"])){
          if($_SESSION["usuario_actual"]==$datos[$i]["funcionario_codigo"] && $_REQUEST["tipo"]!=5){
            if($datos[$i]["orden"]==1){
              $botones.='<input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm">';
            }else if($datos[$i-1]["tipo_aprobacion"]==1){
              $botones.='<input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm"><input type="button" value="Devolver" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="3" id="devol_confirm">';
            }else{
              $botones.='<font color="red">PENDIENTE</font><br/>';
            }
          }else{
            $botones.='<font color="red">PENDIENTE</font><br/>';
          }
        }else{
          $imag='<img src="http://'.RUTA_PDF.'/formatos/librerias/mostrar_foto.php?codigo='.$datos[$i]["funcionario_codigo"].'" width="'.$ancho_firma[0]["valor"].'" height="'.$alto_firma[0]["valor"].'"/><br />';
        }
        $cargos=busca_filtro_tabla("distinct cargo","vfuncionario_dc","tipo_cargo=1 and fecha_inicial<='".$datos[$i]["fecha_aprob"]."' and fecha_final>='".$datos[$i]["fecha_aprob"]."' and funcionario_codigo='".$datos[$i]["funcionario_codigo"]."'","",$conn);
         for($h=0;$h<$cargos["numcampos"];$h++){
          $parte_cargo.=formato_cargo($cargos[$h]["cargo"]).'&nbsp;&nbsp;&nbsp;<br/>';
        }
        if($datos[$i]["tipo_aprobacion"]===0){
          if(($i % 2)==0){
            $html.='<td '.$width_td.'>&nbsp;</td></tr>';
          }
         $html.='<tr><td colspan="2">&nbsp;</td></tr> <tr><td colspan="2"><b>RECHAZADO POR: '.$datos[$i]["nombres"].' '.$datos[$i]["apellidos"].'</b>'.$observaciones.$activar_proceso.'</td></tr>';
         break;
        }else{
          $html.='<td '.$width_td.'>'.$imag.'<strong>'.mayusculas($datos[$i]["nombres"].' '.$datos[$i]["apellidos"]).'</strong><br/>'.$parte_cargo.$botones.'<br/></td>';
          if(($i % 2)==1){
            $html.='</tr>';
          }else if(($i+1)==$datos["numcampos"]){
             $html.='<td '.$width_td.'>&nbsp;</td></tr>';
          }
        }
      }else if($tipo_firma==2){
        $info_td=$datos[$i]["nombres"].' '.$datos[$i]["apellidos"].'<br/>';
        if(is_null($datos[$i]["tipo_aprobacion"])){
          if($_SESSION["usuario_actual"]==$datos[$i]["funcionario_codigo"] && $_REQUEST["tipo"]!=5){
            if($datos[$i]["orden"]==1){
              $info_td.='<input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm">';
            }else if($datos[$i-1]["tipo_aprobacion"]==1){
              $info_td.='<input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm"><input type="button" value="Devolver" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="3" id="devol_confirm">';
            }else{
              $info_td.='<b>PENDIENTE</b>';
            }
          }else{
            $info_td.='<b>PENDIENTE</b>';
          }
        }else{
          if(is_object($datos[$i]["fecha"])){
            $datos[$i]["fecha"]=$datos[$i]["fecha"]->format("Y-m-d H:i:s");
          }else{
          	$date = new DateTime($datos[$i]["fecha"]);
						$datos[$i]["fecha"]=$date->format("Y-m-d H:i:s");
          }
          $info_td.=$datos[$i]["fecha"].'<br/>';
          if($datos[$i]["tipo_aprobacion"]==0){
            $info_td.='<font color="red">RECHAZADO</font>'.$observaciones.$activar_proceso;
            $html.='<td>'.$info_td.'</td>';
            for($j=$i;$j<$datos["numcampos"];$j++){
              $html.='<td>&nbsp;</td>';
            }
            break;
          }else{
            $info_td.='<font color="green">APROBADO</font>'.$observaciones;
          }
        }
        $html.='<td>'.$info_td.'</td>';
      }else{
        $html.='<tr> 
        <td width="50%">'.$datos[$i]["nombres"].' '.$datos[$i]["apellidos"].'</td>';
        if(is_null($datos[$i]["tipo_aprobacion"])){
          if($_SESSION["usuario_actual"]==$datos[$i]["funcionario_codigo"] && $_REQUEST["tipo"]!=5){
            if($datos[$i]["orden"]==1){
              $html.='<td><input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm"></td>';
            }else if($datos[$i-1]["tipo_aprobacion"]==1){
              $html.='<td><input type="button" value="Aprobar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="1" id="aprob_confirm"> <input type="button" value="Rechazar" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="2" id="recha_confirm"><input type="button" value="Devolver" idcf_ruta="'.$datos[$i]["idcf_ruta_formato"].'" tipo="3" id="devol_confirm"></td>';
            }else{
              $html.='<td>PENDIENTE</td>';
            }
          }else{
            $html.='<td>PENDIENTE</td>';
          }
          $html.='</tr>';
        }else{
          if(is_object($datos[$i]["fecha"])){
            $datos[$i]["fecha"]=$datos[$i]["fecha"]->format("Y-m-d H:i:s");
          }else{
          	$date = new DateTime($datos[$i]["fecha"]);
						$datos[$i]["fecha"]=$date->format("Y-m-d H:i:s");
          }
          $html.='<td width="50%">'.$datos[$i]["fecha"].' <img src="'.$ruta_db_superior.'images/leido.png"/></td></tr>';
          if($datos[$i]["tipo_aprobacion"]==0){
           $html.='<tr><td colspan="2"><b>RECHAZADO POR: '.$datos[$i]["nombres"].' '.$datos[$i]["apellidos"].'</b>'.$observaciones.$activar_proceso.'</td></tr>';
           break;
          }
        }
        if(($i+1)==$datos["numcampos"] && $datos[$i]["tipo_aprobacion"]==1){
          $html.='<tr><td colspan="2"><b>APROBADO POR: '.$datos[$i]["nombres"].' '.$datos[$i]["apellidos"].'</b>'.$observaciones.'</td></tr>';
        }
      }
   }
  if($tipo_firma==2){
    $html.='</tr>';
  }
   $html.='</table>';
   if($tipo){
     return($html);
   }else{
    echo $html; 
   }
  }
}
?>