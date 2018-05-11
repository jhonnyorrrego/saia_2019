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
usuario_actual("login");

?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php


global $ruta_db_superior;

include_once($ruta_db_superior."librerias_saia.php");
$funciones=array();
$datos_componente=$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);


$busqueda_documento_expediente=busca_filtro_tabla("","busqueda_componente A","A.nombre LIKE'tareas_listado'","",$conn);
?>    
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css" />
<?php 
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_notificaciones());	
echo(estilo_bootstrap()); 
?>
<script>
	  $.fn.addBack = function (selector) {
    return this.add(selector == null ? this.prevObject : this.prevObject.filter(selector));
  }
</script>
<?php

if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));


  array_walk($librerias,"incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);

}

$idtareas_listado='';
if($_REQUEST["idtareas_listado"]){
  $idtareas_listado=$_REQUEST["idtareas_listado"];
}
$idbusqueda_componente='';
if(@$_REQUEST["idbusqueda_componente"]){
  $idbusqueda_componente=$_REQUEST["idbusqueda_componente"];
}



	$rol_tareas='';
	if(@$_REQUEST['rol_tareas']){
		$rol_tareas="&rol_tareas=".$_REQUEST['rol_tareas'];
	}
	
	$idtareas_listado_unico='';
	if(@$_REQUEST['idtareas_listado_unico']){
		$idtareas_listado_unico="&idtareas_listado_unico=".$_REQUEST['idtareas_listado_unico'];
	}	
	
	
?>      
<style>
.row-fluid [class*="span"]{min-height:20px;}.row-fluid {min-height:20px;}.well{ margin-bottom: 3px; min-height: 11px; padding: 4px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:35px;padding:0px;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8} #panel_body{margin-top:0px; width: 100%; overflow: auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>} #panel_detalle{margin-top:0px; width: 50%; border: 0px; overflow:auto;<?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}



</style>       
<div class="navbar navbar-fixed-top" id="menu_buscador">
  <div class="navbar-inner">                           
    <ul class="nav pull-left">                             
      <li>            
      <div class="btn-group">
        <?php 
       
          if($datos_busqueda[0]["busqueda_avanzada"]!=''){
            if(strpos($datos_busqueda[0]["busqueda_avanzada"],"?"))
              $datos_busqueda[0]["busqueda_avanzada"].="&";
            else 
              $datos_busqueda[0]["busqueda_avanzada"].="?";  
           $datos_busqueda[0]["busqueda_avanzada"].='idbusqueda_componente='.$datos_busqueda[0]["idbusqueda_componente"]; 
		   
		    $datos_busqueda[0]["busqueda_avanzada"].=$rol_tareas;
		   
        ?>            
          <button class="btn btn-mini kenlace_saia" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>" titulo="Buscar Tareas">B&uacute;squeda &nbsp;</button>
        <?php
          }
        ?>                                 
      </div>
      <!-- /btn-group -->        
      </li>                              
      <li class="divider-vertical">
      </li>             
      <li>            
      <div class="btn-group">            
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader" >M&aacute;s Resultados
        </button>            
        <button type="button" class="btn dropdown-toggle btn-mini" data-toggle="dropdown" id="flecha_abajo">
          <span class="caret">
          </span>&nbsp;
        </button>            
        <ul class="dropdown-menu" id='listado_resultados'>                           
          <li class="nav-header">Resulta do por P&aacute;gina
          </li>              
          <li>
          <a href="#" id="resultado_20" >Mostrar 20 resultados</a>
          </li>              
          <li>
          <a href="#" id="resultado_50">Mostrar 50 resultados</a>
          </li>              
          <li>
          <a href="#" id="resultado_100">Mostrar 100 resultados</a>
          </li>                       
        </ul>             
      </div>
      <!-- /btn-group -->                   
      </li>
      <?php if(@$datos_busqueda[0]["menu_busqueda_superior"]){   	?>
        <?php 
          $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
          echo($funcion_menu[0](@$funcion_menu[1]));
        ?>
      <?php }             
      ?> 
      
      <?php if(@$datos_busqueda[0]["enlace_adicionar"]){   	?>
		<li>
			<!-- button class="btn dropdown-toggle btn-mini btn-primary" onclick="window.open('<?php echo($ruta_db_superior.$datos_busqueda[0]["enlace_adicionar"]); ?>','iframe_detalle');">Adicionar Tarea</button -->
			
			
			&nbsp;<button class="btn dropdown-toggle btn-mini btn-primary kenlace_saia" enlace="<?php echo($datos_busqueda[0]["enlace_adicionar"]); ?>" conector="iframe" titulo="Adicionar Tarea" title="Adicionar Tarea" >Adicionar Tarea</button>
			
			

		</li>
      <?php }             
      ?>       
 
		<li>
			&nbsp;
			<?php
			    $idserie_macro=busca_filtro_tabla("idserie","serie","lower(nombre) LIKE 'macroprocesos%-%procesos'","",$conn);
				$macros=busca_filtro_tabla("idserie,nombre","serie","cod_padre=".$idserie_macro[0]['idserie']." AND estado=1","nombre ASC",$conn);
				
				$cadena='<select class="btn btn-mini dropdown-toggle" id="macros"> ';
				$cadena.='<option value="0" selected>Macroprocesos...</option>';
				for($i=0;$i<$macros['numcampos'];$i++){
					$cadena.='<option value="'.$macros[$i]['idserie'].'" >'.$macros[$i]['nombre'].'</option>';
				}
				$cadena.='</select>';
				
				echo($cadena);			
			?>			
		</li> 
      	<li>
      		&nbsp;
      		<?php
      		echo('<select class="btn btn-mini dropdown-toggle" id="procesos"><option value="0" selected>Procesos...</option></select>');
			?>
      	</li>
      	<li>
      		&nbsp;
      		<?php
      		echo('<select class="btn btn-mini dropdown-toggle" id="listado_tareas_fk"><option value="0" selected>Listados...</option></select>');
			?>
      	</li>      	
      	 <li class="divider-vertical">
    	 </li> 
      	<li>
      		<?php 
					$etiquetas_tarea=busca_filtro_tabla("","tareas_listado_etiquetas a, etiqueta b","a.etiqueta_idetiqueta=b.idetiqueta AND b.funcionario=".usuario_actual('funcionario_codigo')." GROUP BY b.idetiqueta","b.nombre ASC",$conn);
					$cadena='<select class="btn btn-mini dropdown-toggle" id="filtro_etiqueta"><option value="0" selected>Etiquetas...</option>';	
					for($i=0;$i<$etiquetas_tarea['numcampos'];$i++){
						$cadena.='
							<option value="'.$etiquetas_tarea[$i]['etiqueta_idetiqueta'].'" >'.ucwords(strtolower($etiquetas_tarea[$i]['nombre'])).'</option>
						';
					}	
					$cadena.='</select>';	
					echo($cadena);
      		?>
      	</li>          
    </ul>      
  </div>
</div>
<br>
<input type="hidden" id="seleccionados" value="" name="seleccionados">

<div class="panel_body pull-left" id="panel_body">  
    <div id="resultado_busqueda_principal<?php echo($datos_componente);?>" class="panel_hidden">  
      <div id="resultado_busqueda<?php echo($datos_componente);?>">  
      </div>
      <div id="resultado_busqueda<?php echo($busqueda_documento_expediente[0]["idbusqueda_componente"]);?>">  
      </div>                                                         
      <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">  
      <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">  
      <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">  
      <input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
      <input type="hidden" value="0" name="fila_actual" id="fila_actual">
      <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">    
      <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">    
      
      <input type="hidden" value="<?php echo($busqueda_documentos_expediente[0]['cantidad_registros']);?>" name="busqueda_total_registros_doc" id="busqueda_registros_doc">  
      <input type="hidden" value="1" name="busqueda_pagina_doc" id="busqueda_pagina">  
      <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas_doc">  
      <input type="hidden" value="<?php echo($busqueda_documentos_expediente[0]['idbusqueda_componente']);?>" name="iddatos_componente_doc" id="iddatos_componente_doc">
      <input type="hidden" value="0" name="fila_actual_doc" id="fila_actual_doc">                
    </div>
</div>                           
<!-- div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" name="iframe_detalle" style="width: 100%;" frameborder="no"></iframe>
</div-->
<script>         
  var espacio_menu=$("#menu_buscador").height()+18;
  var alto_inicial=($(window).height()-espacio_menu); 
  var carga_final=false;
  var contador=1;
  var forma_cargar=<?php echo($datos_busqueda[0]["cargar"]);?>;
  $("#resultado_20").click(function(){
    $("#busqueda_registros").val("20");
    cargar_datos_scroll();
  });
  $("#resultado_50").click(function(){
    $("#busqueda_registros").val("50"); 
    cargar_datos_scroll();
  });
  $("#resultado_100").click(function(){
    $("#busqueda_registros").val("100"); 
    cargar_datos_scroll();
  });   
$(document).ready(function(){
  cargar_datos_scroll();
  setTimeout("contador_buzon("+<?php echo($datos_componente);?>+",'cantidad_maxima')",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
});




  function cargar_datos_scroll(){    
    $('#loadmoreajaxloader').html("Cargando");
    $.ajax({
      type:'POST',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?><?php if(@$_REQUEST['filtro_macroproceso_proceso']){ echo('&filtro_macroproceso_proceso='.$_REQUEST['filtro_macroproceso_proceso']); } ?><?php if(@$_REQUEST['filtro_macroproceso']){ echo('&filtro_macroproceso='.$_REQUEST['filtro_macroproceso']); } ?><?php if(@$_REQUEST['listado_tareas_fk']){ echo('&listado_tareas_fk='.$_REQUEST['listado_tareas_fk']); } ?><?php if(@$_REQUEST['filtro_etiqueta']){ echo('&filtro_etiqueta='.$_REQUEST['filtro_etiqueta']); } ?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp'].$rol_tareas.$idtareas_listado_unico);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"",
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){ 
	          $("#busqueda_pagina").val(objeto.page);
	          $("#busqueda_total_paginas").val(objeto.total);
	          //$("#busqueda_sql").html(objeto.sql);          
	          $("#fila_actual").val(objeto.actual_row);          
	          $.each(objeto.rows,function(index,item){                
	            if(objeto.page===2 && index===0){                
	                $("#iframe_detalle").attr({
	                    'src':'<?php echo($ruta_db_superior);?>pantallas/busquedas/consulta_busqueda_subtareas_listado.php?idtareas_listado='+item.idtareas_listado+"&idbusqueda_componente=221&rand=<?php echo(rand());?>",
	                    'height': ($("#panel_body").height())
	                });
	            }
	            if(forma_cargar===1)         
	              $("#resultado_busqueda<?php echo($datos_componente);?>").prepend("<div id='resultado_pantalla_"+item.llave+"'>"+item.info+"</div>");
	            else{
	              $("#resultado_busqueda<?php echo($datos_componente);?>").append("<div id='resultado_pantalla_"+item.llave+"'>"+item.info+"</div>");   
	            }             
	          });
	          $(".kenlace_saia").attr("onclick"," ");
	          iniciar_tooltip();                         
	          if(objeto.actual_row>=objeto.records){
	            cargar_datos_scroll2();
	          }
	          else{
	            $('#loadmoreajaxloader').html("M&aacute;s Resultados");            
	          }                                          
	          if(($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()<alto_inicial)&& !carga_final){
	            cargar_datos_scroll();
	          } 
          } 
          else{
          	cargar_datos_scroll2();
          }              
        }else{
          cargar_datos_scroll2();
        }
      }      
    });
  }
  function cargar_datos_scroll2(){
    if(carga_final!=2){
      $('#loadmoreajaxloader').html("Cargando");
      $.ajax({
        type:'POST',
        url: "servidor_busqueda.php",
        data: "idbusqueda_componente=<?php echo($busqueda_documento_expediente[0]['idbusqueda_componente']);?><?php if(@$_REQUEST['filtro_macroproceso_proceso']){ echo('&filtro_macroproceso_proceso='.$_REQUEST['filtro_macroproceso_proceso']); } ?><?php if(@$_REQUEST['listado_tareas_fk']){ echo('&listado_tareas_fk='.$_REQUEST['listado_tareas_fk']); } ?><?php if(@$_REQUEST['filtro_etiqueta']){ echo('&filtro_etiqueta='.$_REQUEST['filtro_etiqueta']); } ?><?php if(@$_REQUEST['filtro_macroproceso']){ echo('&filtro_macroproceso='.$_REQUEST['filtro_macroproceso']); } echo $rol_tareas; ?>&page="+$("#busqueda_pagina_doc").val()+"&rows="+$("#busqueda_registros_doc").val()+"&actual_row="+$("#fila_actual_doc").val()+"",
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){ 
  	          $("#busqueda_pagina_doc").val(objeto.page);
  	          $("#busqueda_total_paginas_doc").val(objeto.total);
  	          //$("#busqueda_sql").html(objeto.sql);          
  	          $("#fila_actual_doc").val(objeto.actual_row);          
  	          $.each(objeto.rows,function(index,item){                
  	            if(objeto.page===2 && index===0){                
  	                $("#iframe_detalle").attr({
  	                    'src':'<?php echo($ruta_db_superior);?>pantallas/documento/detalles_documento.php?iddocumento='+item.iddocumento+"&idbusqueda_componente=<?php echo($idbusqueda_componente);?>&rand=<?php echo(rand());?>",
  	                    'height': ($("#panel_body").height())
  	                });                
  	            }
  	            if(forma_cargar===1)         
  	              $("#resultado_busqueda<?php echo($busqueda_documento_expediente[0]['idbusqueda_componente']);?>").prepend(item.info);
  	            else{
  	              $("#resultado_busqueda<?php echo($busqueda_documento_expediente[0]['idbusqueda_componente']);?>").append(item.info);   
  	            }             
  	          });
  	          $(".kenlace_saia").attr("onclick"," ");
  	          iniciar_tooltip();                         
  	          if(objeto.actual_row>=objeto.records){
  	            finalizar_carga_datos();
  	          }
  	          else{
  	            $('#loadmoreajaxloader').html("M&aacute;s Resultados");            
  	          }                                          
  	          if(($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()<alto_inicial)&& carga_final!=2){
  	            cargar_datos_scroll2();
  	          } 
            } 
            else{
            	finalizar_carga_datos();
            }              
          }else{
            finalizar_carga_datos();
          }
        }
      });
    }
    if(carga_final){
      $('#loadmoreajaxloader').html("Finalizado");
    }  
  }
  function finalizar_carga_datos(){
    carga_final=2;
    $('#loadmoreajaxloader').html('Finalizado');
    $('#loadmoreajaxloader').addClass("disabled");
  } 
  
  $('#loadmoreajaxloader').click(function(){
     cargar_datos_scroll();
  });  
  $('.dropdown input, .dropdown label .dropdownn select').click(function(e) {
    e.stopPropagation();
  });  
    
  $(".well").live("mouseenter",function(){
      $(this).addClass("alert-success");
  });
  $(".well").live("mouseleave",function(){
      $(this).removeClass("alert-success");
  });
  
  $('#flecha_abajo').click(function(){
  	if( $(this).parent().hasClass('open') ){
  		$(this).parent().removeClass('open');
  	}else{
  		$(this).parent().addClass('open');
  	}
  	
  	 
  });
  
  function contador_buzon(idcomponente,capa){
  	$.ajax({
  		type:'POST',
	    url: "servidor_busqueda.php",     
	    data: "idbusqueda_componente="+idcomponente+"<?php if(@$_REQUEST['filtro_macroproceso_proceso']){ echo('&filtro_macroproceso_proceso='.$_REQUEST['filtro_macroproceso_proceso']); } ?><?php if(@$_REQUEST['listado_tareas_fk']){ echo('&listado_tareas_fk='.$_REQUEST['listado_tareas_fk']); } ?><?php if(@$_REQUEST['filtro_macroproceso']){ echo('&filtro_macroproceso='.$_REQUEST['filtro_macroproceso']); } echo $rol_tareas; ?><?php if(@$_REQUEST['filtro_etiqueta']){ echo('&filtro_etiqueta='.$_REQUEST['filtro_etiqueta']); } ?>&page=0&rows="+$("#busqueda_registros").val()+"&actual_row=0&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>",
	    success: function(html){
	    	if(html){  
	      	var objeto=jQuery.parseJSON(html);
	      	$("#busqueda_total_paginas").val(objeto.total);
	      	if(objeto.total)$("#boton_exportar_excel").show();
					$("#"+capa).html(objeto.records+")"); 
					$("#cantidad_total").val(objeto.records);
					$("#cantidad_total_copia").val(objeto.records);
					if(parseInt($("#fila_actual").val())>=parseInt(objeto.records)){
						$('#loadmoreajaxloader_parent').addClass("disabled");
					}
	      }
	    }
	  });
  }  
  
</script>

<script type="text/javascript">
$(document).ready(function() {            
  $("#panel_body").height(alto_inicial);
  $("#panel_body").scroll(function(){   
    if($("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height()+3) || $("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height())){
      cargar_datos_scroll();
    }
  });
});
</script>    
<?php echo(librerias_bootstrap());
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());

if($datos_busqueda[0]["ruta_libreria_pantalla"]){
  $librerias=explode(",",$datos_busqueda[0]["ruta_libreria_pantalla"]);
  foreach($librerias AS $key=>$valor){
    include_once($ruta_db_superior.$valor);
  }
}
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior."pantallas/lib/main.js");?>"></script> 

<script>
	$(document).ready(function(){
		$('#macros').change(function(){
			var macro=$(this).val();
			
				$.ajax({
	            	type:'POST',
	                dataType: 'json',
	                url: "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/traer_proceso_segun_macro.php",
	                data: {
	                	idserie:macro
	                },
	                success: function(datos){
	                	window.location='consulta_busqueda_tareas_listado2.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&macros='+macro+'&filtro_macroproceso='+datos.cadena_procesos+'<?php echo($rol_tareas); ?>';
	                	
	                }
				});  
		});

		$('#procesos').change(function(){
			var proceso=$(this).val();
			var macro=$('#macros').val();
			window.location='consulta_busqueda_tareas_listado2.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&macros='+macro+'&filtro_macroproceso_proceso='+proceso+'<?php echo($rol_tareas); ?>';
		});
		
		$('#listado_tareas_fk').change(function(){
			var proceso=$('#procesos').val();
			var macro=$('#macros').val();
			var listado_tareas_fk=$('#listado_tareas_fk').val();
			window.location='consulta_busqueda_tareas_listado2.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&macros='+macro+'&filtro_macroproceso_proceso='+proceso+'&listado_tareas_fk='+listado_tareas_fk+'<?php echo($rol_tareas); ?>';
		});		
		
		
		$('#filtro_etiqueta').change(function(){
			var filtro_etiqueta=$(this).val();
			var proceso=$('#procesos').val();
			var macro=$('#macros').val();
			var listado_tareas_fk=$('#listado_tareas_fk').val();
			window.location='consulta_busqueda_tareas_listado2.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&macros='+macro+'&filtro_etiqueta='+filtro_etiqueta+'&listado_tareas_fk='+listado_tareas_fk+'&filtro_macroproceso_proceso='+proceso+'<?php echo($rol_tareas); ?>';
		});		
		
	});
</script>



<?php
	if(@$_REQUEST['filtro_etiqueta']){	
?>
		<script>
			$(document).ready(function(){
				$('#filtro_etiqueta > option[value="<?php echo($_REQUEST['filtro_etiqueta']); ?>"]').attr('selected', 'selected');
			});
		</script>
<?php
	}
?>


<?php

	if(@$_REQUEST['filtro_macroproceso_proceso'] && @$_REQUEST['macros']){	
?>
		<script>
			$(document).ready(function(){
				 $('#macros > option[value="<?php echo($_REQUEST['macros']); ?>"]').attr('selected', 'selected');
				 
				 var macro='<?php echo($_REQUEST['macros']); ?>';
				$.ajax({
	            	type:'POST',
	                dataType: 'json',
	                url: "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/traer_proceso_segun_macro.php",
	                data: {
	                	idserie:macro
	                },
	                success: function(datos){
	                	$('#procesos').html('');
	                	if(datos.registros>0){
	                		$('#procesos').append(datos.cadena);
	                		
	                	}else{
	                		notificacion_saia('<span style="color:white;">El macroproceso seleccionado no tiene proceso asociados</span>','error','',4000);
	                	}
	                }
				}); 
				 
				 setTimeout(function(){ 
				 	 $('#procesos > option[value="<?php echo($_REQUEST['filtro_macroproceso_proceso']); ?>"]').attr('selected', 'selected');
				 	 
        				$.ajax({
        	            	type:'POST',
        	                dataType: 'json',
        	                url: "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/traer_proceso_segun_macro.php",
        	                data: {
        	                	macro_proceso:'<?php echo($_REQUEST['filtro_macroproceso_proceso']); ?>',
        	                },
        	                success: function(datos){
        	                    $('#listado_tareas_fk').html('');
        	                    if(datos.registros>0){
                                    $('#listado_tareas_fk').append(datos.cadena);
                                    
                                    <?php if(@$_REQUEST['listado_tareas_fk']){ ?>
                                    
                                        $('#listado_tareas_fk > option[value="<?php echo($_REQUEST['listado_tareas_fk']); ?>"]').attr('selected', 'selected');
                                        
                                    <?php } ?>
                                    
                                    
                                    
        	                    }else{
        	                        $('#listado_tareas_fk').html('<option value="0" selected>Listados...</option>');
        	                        notificacion_saia('<span style="color:white;">El proceso seleccionado no tiene listados asociados</span>','error','',4000);
        	                    }
        	                }
        				});				 	 
				 	 
				 	 
				 	 
				 	 
				 	 
				 }, 1500);
			});
		</script>
<?php			
	}
?>

<?php

	if(@$_REQUEST['filtro_macroproceso'] && @$_REQUEST['macros'] && !@$_REQUEST['filtro_macroproceso_proceso']){	
?>
		<script>
			$(document).ready(function(){
				
				var macro='<?php echo($_REQUEST['macros']); ?>';
				
				 $('#macros > option[value="<?php echo($_REQUEST['macros']); ?>"]').attr('selected', 'selected');
				

				$.ajax({
	            	type:'POST',
	                dataType: 'json',
	                url: "<?php echo($ruta_db_superior); ?>pantallas/tareas_listado/traer_proceso_segun_macro.php",
	                data: {
	                	idserie:macro
	                },
	                success: function(datos){
	                	$('#procesos').html('');
	                	if(datos.registros>0){
	                		$('#procesos').append(datos.cadena);
	                		
	                	}else{
	                		notificacion_saia('<span style="color:white;">EL macroproceso seleccionado no tiene proceso asociados</span>','error','',4000);
	                	}
	                }
				}); 

				 
			});
		</script>
<?php			
	}
?>






<style>
	#macros,#procesos,#filtro_etiqueta,#listado_tareas_fk{
		height:22px;
	}
</style>