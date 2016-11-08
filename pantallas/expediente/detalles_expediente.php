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
<div class="container"> 
<div data-toggle="collapse" data-target="#div_info_expediente" style="cursor:pointer;">
  <i class="icon-minus-sign"></i>  <b>Informaci&oacute;n del expediente</b>
</div>
<div id="div_info_expediente"  class="collapse in opcion_informacion"> 
<table class="table table-bordered">
  <tr>
    <td width="40%" class="prettyprint">
      <b>Nombre del expediente:</b>
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
        
        echo('</table></div></div></body></html>');
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
  	<?php if($expediente[0]["propietario"]){
  		$nombres=busca_filtro_tabla("","funcionario A","A.funcionario_codigo=".$expediente[0]["propietario"],"",$conn);
  		echo(ucwords(strtolower($nombres[0]["nombres"]." ".$nombres[0]["apellidos"])));
  	}else{
			echo("<span style='color:red'>Expediente creado por el sistema</span>");
	}
  	?>
  	
          	&nbsp; &nbsp; &nbsp; 
  		    <button class='btn btn-mini btn-default cambiar_responsable_expediente'>
  		        <i class='icon-user' title='Cambiar Responsable'></i>
  		    </button>
 		<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		 <link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
		 <script type='text/javascript'>
		   hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
		   hs.outlineType = 'rounded-white';
		</script> 		    
  		    <script>
  		        $(document).ready(function(){
  		            $('.cambiar_responsable_expediente').click(function(){
                         var enlace='<?php echo($ruta_db_superior); ?>pantallas/expediente/cambiar_responsable_expediente.php?idexpediente=<?php echo($idexpediente); ?>';
                        hs.htmlExpand(this, { objectType: 'iframe',width: 400, height: 200,contentId:'cuerpo_paso', 		preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
  		            });
  		        });
  		    </script>
		    
  		    
  		    
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
	$enlace_abrir='<a style="cursor:pointer" class="accion_abrir_cierre" accion="1">Abrir</a>';
	$permiso_abrir_expediente=new Permiso();
	$ok=$permiso_abrir_expediente->acceso_modulo_perfil("permiso_abrir_expediente");
	if(!$ok){
	    $enlace_abrir='';
	}
	
	$enlace_cerrar='<a style="cursor:pointer" class="accion_abrir_cierre" accion="2">Cerrar</a>';
	$observaciones_abrir_cerrar='';
	if($expediente[0]["estado_cierre"]==1){
		$estado_cierre="Abierto";
		$enlace_abrir='';
	}else if($expediente[0]["estado_cierre"]==2){
		$estado_cierre="Cerrado";
		$enlace_cerrar='';
		$observaciones_abrir_cerrar='
		    <tr>
		       <td style="text-align:center" colspan="2">
		           <textarea id="observaciones_abrir_cerrar"></textarea>
		       </td>
		    </tr>
		
		';
	}
	
	$cadena_cierre[]="<b>Estado:</b> ".$estado_cierre;
	$cadena_cierre[]=$expediente[0]["fecha_cierre"];
	$cadena_cierre[]=ucwords(strtolower($usuario_cierre[0]["nombres"]." ".$usuario_cierre[0]["apellidos"]));
  ?>
  <tr>
  	<td class="prettyprint">    	
      <b>Acciones:</b>
    </td>
    <td>
    	<table class="table table-bordered">
    		<tr>
    			<td style="text-align:center"><?php echo($enlace_abrir); ?></td>
    			<td rowspan="2" style="text-align:center" class="prettyprint"><?php echo(implode("<br/>",$cadena_cierre)); ?></td>
    		</tr>
    		<tr>
    			<td style="text-align:center"><?php echo($enlace_cerrar); ?></td>
    		</tr>
    		<?php echo($observaciones_abrir_cerrar); ?>
    	</table>
    </td>
  </tr>
  <script>
  $(document).ready(function(){
  	$(".accion_abrir_cierre").click(function(){
  		if(confirm('Esta seguro de realizar esta accion?')){
  			var x_accion=$(this).attr("accion");
  			
  			
  			var ejecutar_ajax=1;
  			var observaciones='';
  			if(x_accion==1){
  			    observaciones=$('#observaciones_abrir_cerrar').val();
  			    if(observaciones==''){
  			        ejecutar_ajax=0;
  			        notificacion_saia("<b>ATENCI&Oacute;N</b><br>Debe ingresar la observaci&oacute;n","warning","",2500);
  			    }
  			    
  			}
  			
  			if(ejecutar_ajax){
      			$.ajax({
      				url:"<?php echo($ruta_db_superior);?>pantallas/expediente/ejecutar_acciones.php",
      				data:{ejecutar_expediente: 'abrir_cerrar_expediente', tipo_retorno: 1, accion: x_accion, idexpediente: '<?php echo($expediente[0]["idexpediente"]); ?>',observaciones:observaciones},
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
  			}	
  		}
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
  	if(is_object($transferencia_doc[0]["fecha"]))$transferencia_doc[0]["fecha"]=$transferencia_doc[0]["fecha"]->format('Y-m-d H:i');
  ?>
  <tr>
  	<td class="prettyprint"><b>Transferencia documental</b></td>
  	<td><a class="previo_high" enlace="<?php echo($ruta_db_superior.$transferencia_doc[0]["pdf"]); ?>" style="cursor:pointer">Ver transferencia No <?php echo($transferencia_doc[0]["numero"]); ?> (<?php echo($transferencia_doc[0]["fecha"]); ?>)</a></td>
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




