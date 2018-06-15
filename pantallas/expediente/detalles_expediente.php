<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
?>
<!DOCTYPE html>     
<?php               
echo(librerias_html5());
echo(estilo_bootstrap()); 
include_once($ruta_db_superior."pantallas/documento/librerias.php");
include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
include_once($ruta_db_superior."pantallas/ejecutor/librerias.php");
include_once($ruta_db_superior."pantallas/flujo/librerias.php");
include_once($ruta_db_superior."pantallas/almacenamiento/librerias.php");
include_once($ruta_db_superior."pantallas/expediente/librerias.php");
include_once($ruta_db_superior."pantallas/anexos/librerias.php");
include_once($ruta_db_superior."pantallas/tareas/librerias.php");
include_once($ruta_db_superior."pantallas/workflow/librerias.php");
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());
if(@$_REQUEST["idexpediente"]){
	$idexpediente=$_REQUEST["idexpediente"];	
} 
$expediente=busca_filtro_tabla("a.*,".fecha_db_obtener("a.fecha","Y-m-d")." AS fecha, ".fecha_db_obtener("a.fecha_extrema_i","Y-m-d")." as fecha_extrema_i, ".fecha_db_obtener("a.fecha_extrema_f","Y-m-d")." as fecha_extrema_f","expediente a","idexpediente=".$idexpediente,"",$conn);
?>   
<style>
.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px;  padding: 10px;}  body{ font-size:12px; line-height:100%;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
.pull-center.navbar .nav,.pull-center.navbar .nav > li { float:none; display:inline-block; *display:inline;    *zoom:1; vertical-align: top;}
.pull-center .navbar-inner {text-align:center;}
.pull-center .dropdown-menu {text-align: left;}
.pull-center{text-align:center;}
.table th, .table td {line-height: 10px;text-align: left;}
</style>
<body>
<?php 
    $etiqueta_expediente="expediente";
    if($expediente[0]["agrupador"]){
        $etiqueta_expediente="agrupador";
    }
    
?>    

<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
   hs.outlineType = 'rounded-white';
</script> 

    
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_expediente" style="cursor:pointer;">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del <?php echo($etiqueta_expediente); ?></b>
</div>
<div id="div_info_expediente"  class="collapse in opcion_informacion"> 


<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Nombre del <?php echo($etiqueta_expediente); ?>:</b>
    </td>
    <td>
       <?php echo($expediente[0]["nombre"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Fecha de creaci&oacute;n:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["fecha"]);?>
    </td>
  </tr>
  
  <?php
      if($expediente[0]["agrupador"]){
        
        echo('</table></div></div>');
        echo('
        <script>
            $(document).ready(function(){
                $(".opcion_informacion").on("hide",function(){
                    $(this).prev().children("i").removeClass();
                    $(this).prev().children("i").addClass("icon-plus-sign");
                });
                $(".opcion_informacion").on("show",function(){
                    $(this).prev().children("i").removeClass();
                    $(this).prev().children("i").addClass("icon-minus-sign");
                });
                  $(".documento_actual",parent.document).removeClass("alert-info");
                  $(".documento_actual",parent.document).removeClass("documento_actual");
                  $("#resultado_pantalla_'.$idexpediente.'",parent.document).addClass("documento_actual").addClass("alert-info");                  
            });    
        </script></body></html>
        ');
        echo(librerias_bootstrap());
        die();
      }
  
  ?>
  
  <tr>
    <td class="prettyprint">
      <b>Descripci&oacute;n del expediente:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["descripcion"]);?>
    </td>
  </tr>
    <tr>
    <td class="prettyprint">
      <b>Indice uno:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["indice_uno"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Indice Dos:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["indice_dos"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Indice Tres:</b>
    </td>
    <td colspan="3">
       <?php echo($expediente[0]["indice_tres"]);?>
    </td>
  </tr>
  <tr>
  <tr>
    <td class="prettyprint">    	
      <b>Expediente superior:</b>
    </td>
    <td colspan="3">
       <?php 
        if($expediente[0]["cod_padre"]){
          $padre=busca_filtro_tabla("","expediente","idexpediente=".$expediente[0]["cod_padre"],"",$conn);
          if($padre["numcampos"]){
            echo($padre[0]["nombre"]);
          }
        }  
        else{
          echo("---");
        }  
       ?>
    </td>
  </tr>
  <tr>
  	<td class="prettyprint"><b>Responsable del expediente:</b></td>
  	<td colspan="3">
  	<?php 
  	if($expediente[0]["propietario"]){
  		$nombres=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$expediente[0]["propietario"],"",$conn);
  		echo(ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"])));
  	}else{
			echo("<span style='color:red'>Expediente creado por el sistema</span>");
	}
  	?>
  	
  	
  	<?php 
  	    $configuracion_administrador=busca_filtro_tabla("valor","configuracion","nombre='login_administrador'","",$conn);
  	
  	    if( ($expediente[0]["propietario"] == @$_SESSION['usuario_actual']) ||  (!$expediente[0]["propietario"] && $configuracion_administrador[0]["valor"] == @$_SESSION['LOGIN'.LLAVE_SAIA]) ){
  	?>
          	&nbsp; &nbsp; &nbsp; 
  		    <button class='btn btn-mini btn-default cambiar_responsable_expediente'>
  		        <i class='icon-user' title='Cambiar Responsable'></i>
  		    </button>
  		    <script>
  		        $(document).ready(function(){
  		            $('.cambiar_responsable_expediente').click(function(){
                         var enlace='<?php echo($ruta_db_superior); ?>pantallas/expediente/cambiar_responsable_expediente.php?idexpediente=<?php echo($idexpediente); ?>';
                        hs.htmlExpand(this, { objectType: 'iframe',width: 400, height: 200,contentId:'cuerpo_paso', 		preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
  		            });
  		        });
  		    </script>
		    
  	<?php 
  	    } //fin if  $expediente[0]["propietario"] == @$_SESSION['usuario_actual']
  	?>
  		    
  	</td>
  </tr>
  <tr>
  	<td class="prettyprint">    	
      <b>Vinculado a la caja:</b>
    </td>
    <td>
    	<?php 
        if($expediente[0]["fk_idcaja"]){
          $caja=busca_filtro_tabla("","caja","idcaja=".$expediente[0]["fk_idcaja"],"",$conn);
          if($caja["numcampos"]){
            echo($caja[0]["codigo"]." - ".$caja[0]["fondo"]);
          }
        }  
        else{
          echo("---");
        }  
       ?>
    </td>
  </tr>
  <?php
  $cadena_cierre=array();
  if(is_object($expediente[0]["fecha_cierre"]))$expediente[0]["fecha_cierre"]=$expediente[0]["fecha_cierre"]->format('Y-m-d');
  $usuario_cierre=busca_filtro_tabla("","vfuncionario_dc a","a.idfuncionario=".$expediente[0]["funcionario_cierre"],"",$conn);
  $estado_cierre="";
  $enlace_abrir='<a style="cursor:pointer" class="accion_abrir_cierre" accion="1">Abrir</a><input type="hidden" name="accion" value="1" />';
  $permiso_abrir_expediente=new Permiso();
  $ok=$permiso_abrir_expediente->acceso_modulo_perfil("permiso_abrir_expediente");
  if(!$ok){
      $enlace_abrir='';
  }
  
  $vector_abrir_cerrar=array(2=>'abrir',1=>'cerrar');
  $enlace_cerrar='<a style="cursor:pointer" class="accion_abrir_cierre" accion="2">Cerrar</a><input type="hidden" name="accion" value="2" />';
  $observaciones_abrir_cerrar='
      <td style="text-align:center" colspan="2">
            <textarea id="observaciones_abrir_cerrar" name="observaciones" placeholder="Observaci&oacute;n para '.$vector_abrir_cerrar[$expediente[0]["estado_cierre"]].' expediente..."></textarea>
    </td>
  ';
  if($expediente[0]["estado_cierre"]==1){
    $estado_cierre="Abierto";
    $enlace_abrir='';
  }else if($expediente[0]["estado_cierre"]==2){
    $estado_cierre="Cerrado";
    $enlace_cerrar='';
  }else{
		$estado_cierre="Abierto";
		$enlace_abrir='';		
	}
  
  $cadena_cierre[]="<b>Estado:</b> ".$estado_cierre;
  $cadena_cierre[]=$expediente[0]["fecha_cierre"];
  $cadena_cierre[]=ucwords(strtolower($usuario_cierre[0]["nombres"]." ".$usuario_cierre[0]["apellidos"]));
  ?>
  <tr>
    <td class="prettyprint">      
      <?php echo(implode("<br/>",$cadena_cierre)); ?>
    </td>
    <td><form name="form_abrir_cerrar" id="form_abrir_cerrar">
      <table class="table table-bordered">
        <tr>
            <?php echo($observaciones_abrir_cerrar); ?>
          <td style="text-align:center;" >
               <br>
              <?php echo($enlace_abrir); ?><?php echo($enlace_cerrar); ?>
              <input type="hidden" name="ejecutar_expediente" value="abrir_cerrar_expediente" />
              <input type="hidden" name="tipo_retorno" value="1" />
              <input type="hidden" name="idexpediente" value="<?php echo($expediente[0]["idexpediente"]); ?>" />
              <br>
              <br>
                    <button class='btn btn-mini btn-default historial_abrir_cerrar' type="button" id="button_historial">
                      <i class='icon-info-sign ' title='Ver Historial de Cambio'></i>
                    </button>     
                      <script>
                          $(document).ready(function(){
                              $('.historial_abrir_cerrar').click(function(){
                                     var enlace='<?php echo($ruta_db_superior); ?>pantallas/expediente/historial_abrir_cerrar.php?idexpediente=<?php echo($idexpediente); ?>';
                                    hs.htmlExpand(this, { objectType: 'iframe',width: 400, height: 200,contentId:'cuerpo_paso',     preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
                              });
                          });
                      </script>                   
          </td>
        </tr> 
      </table>
      </form>
    </td>
  </tr>
  
<?php 
if($expediente[0]["estado_cierre"]==2){  //si esta cerrado
    $idexpediente=$expediente[0]["idexpediente"];
    $serie_idserie=$expediente[0]["serie_idserie"];
    $estado_expediente=$expediente[0]["estado_archivo"];
    $vector_estado_expediente=array(1=>'gestion',2=>'central');
    $datos_serie=busca_filtro_tabla("retencion_".$vector_estado_expediente[$estado_expediente],"serie","idserie=".$serie_idserie,"",$conn);
    $datos_cierre=busca_filtro_tabla(fecha_db_obtener("fecha_cierre","Y-m-d")." as fecha_cierre,estado_cierre","expediente_abce","expediente_idexpediente=".$idexpediente,"idexpediente_abce DESC",$conn);
    $fecha_cierre=$datos_cierre[0]['fecha_cierre'];
    
    if($datos_cierre[0]['estado_cierre']==2){
        $dias_calcular=365*$datos_serie[0]["retencion_".$vector_estado_expediente[$estado_expediente]];
       // $dias_calcular=60;
        include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
        $fecha_calculo=calculaFecha("days",+$dias_calcular,$fecha_cierre);
        $interval=resta_dos_fechas_saia(date('Y-m-d'),$fecha_calculo);
        $interval_pos_neg=$interval->invert;  //Es 1 si el intervalo representa un periodo de tiempo negativo y 0 si no
        $interval_diferencia=$interval->days; //dias de diferencia
        $interval_anio=$interval->y;
        $interval_mes=$interval->m;
        $interval_dia=$interval->d;
        $interval_hora=$interval->h;
        $interval_minuto=$interval->i;
        $interval_segundo=$interval->s;
        $cadena_horas=$interval_hora.':'.$interval_minuto.':'.$interval_segundo;
        list($h, $m, $s) = explode(':', $cadena_horas); 
        $segundos = ($h * 3600) + ($m * 60) + $s; 
        $horas_minutos_segundos_parseados=( conversor_segundos_hm(intval($segundos)) );
        $cadena_final='';
        
        $cadena_inicial='Faltan ';
        $color='green';
        if($interval_mes<=2 && $interval_anio==0 && $interval_dia==0 && $interval_hora==0 && $interval_minuto==0 && $interval_segundo==0){
            $color='orange';
        }
        
        if($interval_pos_neg==1){
            $cadena_inicial='Hace ';
            $color='red';
        }  
        
        $color='color:'.$color.';';
        
        if($interval_anio>0){
            $cadena_final.=$interval_anio.' años, ';
        }
        if($interval_mes>0){
            $cadena_final.=$interval_mes.' meses, ';
        }
        if($interval_dia>0){
            $cadena_final.=$interval_dia.' dias, ';
        }
        if($interval_hora>0){
            $cadena_final.=$interval_hora.' horas, ';
        }
        if($interval_minuto>0){
            $cadena_final.=$interval_minuto.' minutos, ';
        }
        if($interval_segundo>0){
            $cadena_final.=$interval_segundo.' segundos, ';
        }
        if($cadena_final==''){
            $cadena_final='Hoy';
        }else{
            $cadena_final=$cadena_inicial.$cadena_final;
        }
    }

    ?>
      <tr>
        <td class="prettyprint">      
          <b>Alerta de Retenci&oacute;n:</b>
        </td>
        <td>
              <span style="<?php echo($color); ?>"><?php echo($cadena_final); ?></span>
        </td>
      </tr>
    <?php 
}
?>

  
  
  <script>
  $(document).ready(function(){
    $('#observaciones_abrir_cerrar').focus(function(){
        $('.obligatorio_observaciones_expediente').remove();
    });      
      
    $(".accion_abrir_cierre").click(function(){
        $('.obligatorio_observaciones_expediente').remove();
        var ejecutar_ajax=1;
        var x_accion=$(this).attr("accion");
        var observaciones='';
        observaciones=$('#observaciones_abrir_cerrar').val();
        if(x_accion==1){
            
            if(observaciones==''){
                ejecutar_ajax=0;
                $('#observaciones_abrir_cerrar').after("<span class='obligatorio_observaciones_expediente' style='color:red;'><br>Debe ingresar la observaci&oacute;n</span>");
            }
        }
        
        if(ejecutar_ajax){
          if(confirm('Esta seguro de realizar esta accion?')){
            if(ejecutar_ajax){
              <?php encriptar_sqli("form_abrir_cerrar",0,"form_info",$ruta_db_superior); ?>
                $.ajax({
                  url:"<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
                  data:$("#form_abrir_cerrar").serialize(),
                  type:"POST",
                  success: function(html){
                    if(html){
                      var objeto=jQuery.parseJSON(html);
                      if(objeto.exito){
                        notificacion_saia(objeto.mensaje,"success","",2500);
                        if(x_accion==1){
                            window.parent.$('#seleccionados_expediente_<?php echo(@$_REQUEST["idexpediente"]); ?>').attr('style','display:none;');
                        }else{
                            window.parent.$('#seleccionados_expediente_<?php echo(@$_REQUEST["idexpediente"]); ?>').attr('style','display:block;');
                        }
                        window.open("detalles_expediente.php?idexpediente=<?php echo(@$_REQUEST["idexpediente"]); ?>&idbusqueda_componente=<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>","_self");
                      }
                    }
                  }
                });
            } //fin if ejecutar ajax
          } //fin esta seguro
        } //fin ejecutar ajax
    });
  });
 	</script>
  <?php
  if(MOTOR=='MySql'){
  	$transferencia_doc=busca_filtro_tabla("","ft_transferencia_doc a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO') and (CONCAT(',',a.expediente_vinculado,',') like '%,".$expediente[0]["idexpediente"].",%')","a.idft_transferencia_doc DESC",$conn);
	}
	if(MOTOR=='Oracle'){
  	$transferencia_doc=busca_filtro_tabla("","ft_transferencia_doc a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO') and (CONCAT(',',CONCAT(a.expediente_vinculado,',')) like '%,".$expediente[0]["idexpediente"].",%')","a.idft_transferencia_doc DESC",$conn);
	}
	if(MOTOR=='SqlServer'){
  	$transferencia_doc=busca_filtro_tabla("","ft_transferencia_doc a, documento b","a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ACTIVO') and (','+a.expediente_vinculado+',' like '%,".$expediente[0]["idexpediente"].",%')","a.idft_transferencia_doc DESC",$conn);
	}
	
  if($transferencia_doc["numcampos"]){
  	
  ?>
  <tr>
  	<td class="prettyprint"><b>Transferencia documental</b></td>
  	<td>
  	    <?php
  	        for($i=0;$i<$transferencia_doc['numcampos'];$i++){
  	            if(is_object($transferencia_doc[$i]["fecha"]))$transferencia_doc[$i]["fecha"]=$transferencia_doc[$i]["fecha"]->format('Y-m-d H:i');
  	            ?>
  	                <a class="previo_high" enlace="<?php echo($ruta_db_superior.$transferencia_doc[$i]["pdf"]); ?>" style="cursor:pointer">Ver transferencia No <?php echo($transferencia_doc[$i]["numero"]); ?> (<?php echo($transferencia_doc[$i]["fecha"]); ?>)</a>
  	                <br>
  	            <?php
  	        }
  	    ?>
  	    
  	
  	</td>
  </tr>
  <script>
		$(document).ready(function(){
			$(".previo_high").click(function(e){
				var enlace=$(this).attr("enlace");
				top.hs.htmlExpand(this, { objectType: 'iframe',width: 1000, height: 600,contentId:'cuerpo_paso', preserveContent:false, src:"pantallas/expediente/visor_pdf.php?ruta="+enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
				
			});
		});
		</script>
  <?php } ?>
</table>
</div>
<?php 
$almacenamiento["numcampos"]=0;
if($almacenamiento["numcampos"]){
?>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_almacenamiento" style="cursor:pointer;">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n almacenamiento</b>
</div>
<div id="div_info_almacenamiento"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Ubicaci&oacute;n:</b>
    </td>
    <td>
       <?php echo($almacenamiento[0]["ubicacion"]);?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Estanter&iacute;a:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["estantetia"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Nivel:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["nivel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">    	
      <b>Panel:</b>
    </td>
    <td colspan="3">
      <?php echo($almacenamiento[0]["panel"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">
      <b>Caja:</b>
    </td>
    <td colspan="3">
       <?php echo($almacenamiento[0]["caja"]);?>
    </td>
  </tr> 
</table>
</div>
<?php 
}
$contenido["numcampos"]=1;
if($contenido["numcampos"]){
?>
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_contenido" style="cursor:pointer;">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n contenido</b>
</div>
<div id="div_info_contenido"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>N&uacute;mero de documentos almacenados:</b>
    </td>
    <td>
       <?php
      $expedientes=arreglo_expedientes_asignados();
			$arreglo=array();
			obtener_expedientes_padre($idexpediente,$expedientes);
			$arreglo=array_merge($arreglo,array($idexpediente));
			//return(implode(",",$arreglo));
			$documentos=busca_filtro_tabla("count(*) as cantidad","expediente_doc A, documento B","A.expediente_idexpediente in(".implode(",",$arreglo).") AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO')","",$conn);
			//return($cantidad["sql"]);
			
			if(!$documentos["numcampos"])$documentos[0]["cantidad"]=0;
				echo($documentos[0]["cantidad"]);
			?>
    </td>    
  </tr>
  <tr>
    <td class="prettyprint">
      <b>N&uacute;mero de expedientes:</b>
    </td>
    <td colspan="3">
       <?php 
       $expedientes_hijos=busca_filtro_tabla("count(*) AS cant_hijos","expediente","cod_padre=".$idexpediente,"",$conn);
       echo($expedientes_hijos[0]["cant_hijos"]);?>
    </td>
  </tr>
  <?php          
  if($documentos_almacenados[0]["cant_doc"]){
    $fecha_max=busca_filtro_tabla(fecha_db_obtener("MAX(A.fecha)","Y-m-d")." AS fecha_max","documento A,expediente_doc B","A.iddocumento=B.documento_iddocumento AND B.expediente_idexpediente=".$idexpediente,"",$conn);
    $fecha_min=busca_filtro_tabla(fecha_db_obtener("MIN(A.fecha)","Y-m-d")." AS fecha_min","documento A,expediente_doc B","A.iddocumento=B.documento_iddocumento AND B.expediente_idexpediente=".$idexpediente,"",$conn);
  ?>
  <tr>
    <td class="prettyprint">
      <b>Fecha m&iacute;nima de documento:</b>
    </td>
    <td colspan="3">
       <?php echo($fecha_min[0]["fecha_min"]);?>
    </td>
  </tr>
  <tr>
    <td class="prettyprint">    	
      <b>Fecha m&aacute;xima de documento:</b>
    </td>
    <td colspan="3">
      <?php echo($fecha_max[0]["fecha_max"]);?>
    </td>
  </tr>
  <?php
  }
  ?>
  
  <tr>
    <td class="prettyprint">
         <b>Tomo:</b>
    </td>
    <td colspan="3">
       <?php 
            $expediente_actual=busca_filtro_tabla("tomo_padre,tomo_no","expediente","idexpediente=".$idexpediente,"",$conn);
            $tomo_padre=$idexpediente;
            if($expediente_actual[0]['tomo_padre']){
                $tomo_padre=$expediente_actual[0]['tomo_padre'];
            }
            $ccantidad_tomos=busca_filtro_tabla("idexpediente","expediente","tomo_padre=".$tomo_padre,"",$conn);
            $cantidad_tomos=$ccantidad_tomos['numcampos']+1; //tomos + el padre  
            echo($expediente_actual[0]['tomo_no'].' de '.$cantidad_tomos);
       ?>
    </td>    
  </tr>
  
</table>
</div>
<?php 
}
?>
</div>
<?php
echo(librerias_tooltips());
echo(librerias_bootstrap());
echo(librerias_acciones_kaiten());
?>
<script type="text/javascript">
$(document).ready(function(){		
	iniciar_tooltip();
  $(".opcion_informacion").on("hide",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-plus-sign");
  });
  $(".opcion_informacion").on("show",function(){
    $(this).prev().children("i").removeClass();
    $(this).prev().children("i").addClass("icon-minus-sign");
  });
 
  
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo($idexpediente);?>",parent.document).addClass("documento_actual").addClass("alert-info");    
});
</script>
</body>