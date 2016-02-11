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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");
?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
include_once($ruta_db_superior."librerias_saia.php");
$funciones=array();
$datos_componente=$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
?>    
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css" />
<?php 
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 
if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
  array_walk($librerias,"incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}
?>      
<style>
.row-fluid [class*="span"]{min-height:20px;}.row-fluid {min-height:20px;}.well{ margin-bottom: 3px; min-height: 11px; padding: 4px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:35px;padding:0px;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8} #panel_body{margin-top:0px; width: 50%; overflow: auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>} #panel_detalle{margin-top:0px; width: 50%; border: 0px; overflow:auto;<?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}
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
        ?>            
          <button class="btn btn-mini kenlace_saia" titulo="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>">B&uacute;squeda &nbsp;</button>
        <?php
          }
        ?>                                 
      </div>
      <!-- /btn-group -->        
      </li>             
      <li>          
      <div class="btn-group">            
        <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Seleccionados &nbsp;
          <span class="caret">
          </span>&nbsp;
        </button>            
        <ul class="dropdown-menu" id='listado_seleccionados'>              
          <li>
          <a href="#">
            <div id="filtrar_seleccionados">Filtrar Seleccionados
            </div></a>
          </li>              
          <li>
          <a href="#">
            <div id="restaurar_seleccionados">Restaurar Listado
            </div></a>
          </li>              
          <!--li>
          <a href="#">
            <div id="restaurar_listado">Restaurar  Seleccionados
            </div></a>
          </li-->
          <?php 
            if($datos_busqueda[0]["acciones_seleccionados"]!=''){
              echo('<li class="nav-header">Acciones</li>');
            $acciones=explode(",",$datos_busqueda[0]["acciones_seleccionados"]);
            $cantidad=count($acciones);
            for($i=0;$i<$cantidad;$i++){
                echo($acciones[$i]());
            }
              
            }              
          ?>                                
        </ul>             
      </div>

      <!-- /btn-group -->               
      </li>              
      <li class="divider-vertical">
      </li>             
      <li>            
      <div class="btn-group">            
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader_parent">
        <span id="loadmoreajaxloader">Cargando (... 
        </span> 
        <span id="cantidad_maxima" >...)</span>
        </button>
        <button type="button" class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
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
      
      
      <!-- LISTA DE PROCESO -->
      <li class="divider-vertical"></li>
      <li>
      <div class="btn-group">
         <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Procesos &nbsp;
          <span class="caret">
          </span>&nbsp;
        </button>
         <ul class="dropdown-menu" id='listado_procesos'>

	          <li>
	          <a href="#">
	            <div name="filtro_categoria" valor=""><b>Restaurar Listado</b>
	            </div></a>
	          </li> 

			<?php
				$fun=usuario_actual("funcionario_codigo");
				$fun_id=usuario_actual("idfuncionario");
				
				if($datos_busqueda[0]["nombre"]=='documento_pendiente'){  //Documentos Recibidos
					
					$documentos=busca_filtro_tabla("","documento A,asignacion B","lower(A.estado)<>'eliminado' AND A.iddocumento=B.documento_iddocumento AND B.tarea_idtarea<>-1 AND B.entidad_identidad=1 AND B.llave_entidad='".$fun."'   GROUP BY A.fecha, A.estado, A.ejecutor, A.serie, A.descripcion, A.pdf, A.tipo_radicado, A.plantilla, A.numero, A.tipo_ejecutor, DATE_FORMAT( B.fecha_inicial,  'y-m-d' ) , A.iddocumento
			 ","B.fecha_inicial DESC",$conn);
				}
				else if($datos_busqueda[0]["nombre"]=='documentos_importantes'){  //Con Indicador
					
					$documentos=busca_filtro_tabla("","prioridad_documento A, documento B","A.prioridad in (1,2,3,4,5) AND iddocumento=documento_iddocumento AND funcionario_idfuncionario=".$fun_id." AND B.estado not in('ELIMINADO')","",$conn);
			 
				}				
				else if($datos_busqueda[0]["nombre"]=='borradores'){  //Borradores
					
					$documentos=busca_filtro_tabla("","documento A","ejecutor=".$fun." AND A.estado='ACTIVO' AND A.numero='0'","",$conn);
				}
				else if($datos_busqueda[0]["nombre"]=='documentos_etiquetados'){  //Etiquetados
					
					$documentos=busca_filtro_tabla("","documento a, documento_etiqueta b, etiqueta c","a.iddocumento=b.documento_iddocumento and b.etiqueta_idetiqueta=c.idetiqueta AND c.funcionario='".$fun."'","",$conn);
				}				
 


			 	$papas_array=array();
				for($i=0;$i<$documentos['numcampos'];$i++){			
					$formato=busca_filtro_tabla('a.idformato,b.iddocumento,a.nombre,a.cod_padre,a.nombre','formato a, documento b','a.nombre=lower(b.plantilla) AND b.iddocumento='.$documentos[$i]['iddocumento'],'',$conn);	
					$papa_iddoc=buscar_papa_formato($formato[0]['idformato'],$formato[0]['iddocumento'],'ft_',$formato[0]['nombre']);	
					if($papa_iddoc==0 or $papa_iddoc==NULL){
						$formato_papa=busca_filtro_tabla('','formato a, documento b','a.nombre=lower(b.plantilla) AND b.iddocumento='.$formato[0]['iddocumento'],'',$conn);	
					}else{
						$formato_papa=busca_filtro_tabla('','formato a, documento b','a.nombre=lower(b.plantilla) AND b.iddocumento='.$papa_iddoc,'',$conn);	
					}
					if(!in_array($formato_papa[0]['idformato'], $papas_array)){
						$papas_array[]=$formato_papa[0]['idformato'];
						$categoria_formato=busca_filtro_tabla('','categoria_formato','idcategoria_formato in('.$formato_papa[0]['fk_categoria_formato'].')','',$conn);
						$categorias_novisibles=array(1,2,3);
						for($j=0;$j<$categoria_formato['numcampos'];$j++){
									
							if(!in_array($categoria_formato[$j]['idcategoria_formato'], $categorias_novisibles)){
								echo'
						          <li>
						          <a href="#">
						            <div name="filtro_categoria" valor="'.$categoria_formato[$j]['idcategoria_formato'].'">'.$categoria_formato[$j]['nombre'].'
						            </div></a>
						          </li> 			
								';					
							}	
						}
					}	
				}	 	
			?>          
        </ul>
        <script>
        	$(document).ready(function(){
        		$('[name="filtro_categoria"]').click(function(){
        			
        			var valor=$(this).attr('valor');
        			window.location='consulta_busqueda_documento.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&filtro_categoria='+valor+'';
        		});
        	});
        </script>
        
             	
      </div>      	
      </li>      

	
	<?php
		if(@$datos_busqueda[0]["nombre"]=='documentos_importantes'){
	?>

      <!-- LISTA DE INDICADORES -->
      <li class="divider-vertical"></li>
      <li>
      <div class="btn-group">
         <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Indicadores &nbsp;
          <span class="caret">
          </span>&nbsp;
        </button>
         <ul class="dropdown-menu" id='listado_indicadores'>

	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor=""><b>Restaurar Listado</b>
	            </div></a>
	          </li>    
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="1"><span class="icon-flag-rojo"></span>&nbsp; Rojo
	            </div></a>
	          </li> 
	          </li>    
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="2"><span class="icon-flag-morado"></span>&nbsp; Morado
	            </div></a>
	          </li> 	          
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="3"><span class="icon-flag-naranja"></span>&nbsp; Naranja
	            </div></a>
	          </li> 	          
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="4"><span class="icon-flag-amarillo"></span>&nbsp; Amarillo
	            </div></a>
	          </li> 	          
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="5"><span class="icon-flag-verde"></span>&nbsp; Verde
	            </div></a>
	          </li>	
	          <li>
	          <a href="#">
	            <div name="filtro_indicadores" valor="0"><span class="icon-flag"></span>&nbsp; Sin indicador
	            </div></a>
	          </li>	                    	               
        </ul>	
        <script>
        	$(document).ready(function(){
        		$('[name="filtro_indicadores"]').click(function(){
        			
        			var valor=$(this).attr('valor');
        			window.location='consulta_busqueda_documento.php?idbusqueda_componente=<?php echo($datos_busqueda[0]['idbusqueda_componente']); ?>&filtro_indicadores='+valor+'';
        		});
        	});
        </script>        
        
      </div>      	
      </li>    

	<?php
		}
	?>

      <?php if(@$datos_busqueda[0]["enlace_adicionar"]){
      	?>
      	<li class="divider-vertical"></li><li><div class="btn-group">                    
          <button class="btn btn-mini kenlace_saia" conector="iframe" id="adicionar_pantalla" destino="_self" title="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" titulo="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" enlace="<?php echo($datos_busqueda[0]["enlace_adicionar"]); ?>">Adicionar</button></div></li>
      	<?php
      }
			?>
      <?php if(@$datos_busqueda[0]["menu_busqueda_superior"]){ ?>
        <?php 
          $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
          echo($funcion_menu[0](@$funcion_menu[1]));
        ?>
      <?php }     
				if(@$datos_busqueda[0]["exportar"]){
					if(function_exists(exportar_excel))
          	echo(exportar_excel());
				}        
      ?> 


      
             
    </ul>      
  </div>
</div>
<br>
<input type="hidden" id="seleccionados" value="" name="seleccionados">
<div class="panel_body pull-left" id="panel_body">  
    <div id="resultado_busqueda_principal<?php echo($datos_componente);?>" class="panel_hidden">  
      <div id="resultado_busqueda<?php echo($datos_componente);?>">  
      </div>                                                         
      <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">  
      <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">  
      <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">  
      <input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
      <input type="hidden" value="0" name="fila_actual" id="fila_actual">
      <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']); ?>" name="cantidad_total" id="cantidad_total">
      <input type="hidden" value="0" name="cantidad_total_copia" id="cantidad_total_copia">
      <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">    
      <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">    
    </div>
</div>                           
<div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" style="width: 100%;" frameborder="no"></iframe>
</div>
<script>         
  var espacio_menu=$("#menu_buscador").height()+18;
  var alto_inicial=($(document).height()-espacio_menu); 
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
  $("#panel_body").height(alto_inicial);
  $("#panel_detalle").height(alto_inicial);
  $("#panel_body").scroll(function(){   
    if($("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height()+3) || $("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height())){
      cargar_datos_scroll();
    }
  });
$(document).ready(function(){
  cargar_datos_scroll();
  setTimeout("contador_buzon("+<?php echo($datos_componente);?>+",'cantidad_maxima')",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
});
  function cargar_datos_scroll(){
  	if($('#loadmoreajaxloader_parent').hasClass("disabled"))return;
    $('#loadmoreajaxloader').html("Cargando (... de ");
    $.ajax({
      type:'POST',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&cantidad_total="+$("#cantidad_total").val()+"<?php if(@$_REQUEST['filtro_categoria']){ echo('&filtro_categoria='.$_REQUEST['filtro_categoria']); } ?>"+"<?php if(@$_REQUEST['filtro_indicadores']){ echo('&filtro_indicadores='.$_REQUEST['filtro_indicadores']); } ?>",
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
	                    'src':'<?php echo($ruta_db_superior);?>pantallas/documento/detalles_documento.php?iddoc='+item.iddocumento+"&idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]);?>&rand=<?php echo(rand());?>",
	                    'height': ($("#panel_body").height())
	                });                
	            }
	            if(!$("#resultado_pantalla_"+item.llave).length){
			            if(forma_cargar===1)         
			              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").prepend("<div id='resultado_pantalla_"+item.llave+"' class='well'>"+item.info+"</div>");
			            else{
			              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").append("<div id='resultado_pantalla_"+item.llave+"' class='well'>"+item.info+"</div>");   
			            }
			          }         
	          });
	          $(".kenlace_saia").attr("onclick"," ");
	          iniciar_tooltip();                         
	          if($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()<alto_inicial){
	          	//$('#loadmoreajaxloader').html("Cargando ( ...");
	            //cargar_datos_scroll();
	          }
	          if(objeto.actual_row>=objeto.records){
	            finalizar_carga_datos(objeto.records);
	          }
	          else{
	            $('#loadmoreajaxloader').html("resultados("+objeto.actual_row+" de ");            
	          }
          } 
          else{
          	$("#cantidad_total_copia").val("0");
          	finalizar_carga_datos(0);
          }              
        }else{
          $("#cantidad_total_copia").val("0");
          	finalizar_carga_datos(0);
        }
      }
    });
  } 
  function finalizar_carga_datos(total){
    $('#loadmoreajaxloader').html('resultados('+total+" de ");
    if(parseInt(total)<=parseInt($("#cantidad_total_copia").val())){
    	$('#loadmoreajaxloader_parent').addClass("disabled");
    }
    carga_final=true;
  } 
  $('#loadmoreajaxloader').click(function(){
     cargar_datos_scroll();
  });  
  $('.dropdown input, .dropdown label .dropdownn select').click(function(e) {
    e.stopPropagation();
  });    
  $(".well").live("mouseenter",function(){
      $(this).addClass("muted");
  });
  $(".well").live("mouseleave",function(){
      $(this).removeClass("muted");
  });
  
  function contador_buzon(idcomponente,capa){
  	$.ajax({
  		type:'POST',
	    url: "servidor_busqueda.php",
	    rsync:false,
	    data: "idbusqueda_componente="+idcomponente+"&page=0&rows="+$("#busqueda_registros").val()+"&actual_row=0&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&variable_busqueda="+$("#variable_busqueda").val()+"<?php if(@$_REQUEST['filtro_categoria']){ echo('&filtro_categoria='.$_REQUEST['filtro_categoria']); } ?>"+"<?php if(@$_REQUEST['filtro_indicadores']){ echo('&filtro_indicadores='.$_REQUEST['filtro_indicadores']); } ?>",
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