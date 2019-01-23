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
include_once($ruta_db_superior."librerias_saia.php");
$funciones=array();


$datos_componente=$_REQUEST["idbusqueda_componente"];
$condicion_adicional="";

if(@$_REQUEST['idtareas_listado']){
	$condicion_adicional="&condicion_adicional=";
	$condicion_adicional.=" AND cod_padre=".$_REQUEST['idtareas_listado'];
	
}
if(@$_REQUEST['idlistado_tareas']){
	$condicion_adicional="&condicion_adicional=";
	$condicion_adicional.=" AND cod_padre=0 AND listado_tareas_fk=".$_REQUEST['idlistado_tareas'];
	
}


$ocultar_subtareas="";
if(@$_REQUEST['ocultar_subtareas']){
	$ocultar_subtareas="&ocultar_subtareas=1";
	
}

$rol_tareas="";
if(@$_REQUEST['rol_tareas']){
	$rol_tareas="&rol_tareas=".$_REQUEST['rol_tareas'];
	
}


$idtareas_listado_unico='';
if(@$_REQUEST['idtareas_listado_unico']){
	$idtareas_listado_unico="&idtareas_listado_unico=".$_REQUEST['idtareas_listado_unico'];
}	

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
.row-fluid [class*="span"]{min-height:20px;}.row-fluid {min-height:20px;}.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:50px}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8} #panel_body{margin-top:0px; width: 100%; overflow: auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}

@media (max-width: 767px)
body {
 padding-right: 0px; 
 padding-left: 10px; 
}

</style>       


<?php

if(!@$_REQUEST['noadiciona']){

	if(@$_REQUEST['idtareas_listado']){
		$listado_tareas=busca_filtro_tabla("","tareas_listado","idtareas_listado=".$_REQUEST["idtareas_listado"],"",$conn);
		
		if($listado_tareas[0]['listado_tareas_fk']!=-1){
			?>
				<div>
					<!--button class="btn dropdown-toggle btn-mini btn-primary" onclick="window.open('<?php echo($ruta_db_superior);?>pantallas/tareas_listado/adicionar_tareas_listado.php?cod_padre=<?php echo $_REQUEST["idtareas_listado"];?>&idlistado_tareas=<?php echo($listado_tareas[0]['listado_tareas_fk']); ?>','iframe_detalle');">Adicionar Subtarea</button -->	
					
			&nbsp;<button class="btn dropdown-toggle btn-mini btn-primary kenlace_saia" enlace="pantallas/tareas_listado/adicionar_tareas_listado.php?cod_padre=<?php echo $_REQUEST["idtareas_listado"];?>&idlistado_tareas=<?php echo($listado_tareas[0]['listado_tareas_fk']); ?>" conector="iframe" titulo="Adicionar Subtarea" title="Adicionar Subtarea" >Adicionar Subtarea</button>					
				</div>
				
			<?php
		}else{
			?>
				<div class="well alert-warning">
					<span>
						<center><strong>ATENCI&Oacute;N</strong><br/>Para adicionar &oacute; visualizar subtareas debe completar los datos de la tarea<br/>&nbsp;</center>
					</span>
				</div>
			<?php
		}	
		
		
	}
	if(@$_REQUEST['idlistado_tareas']){
	
	?>
			<div>
				<button class="btn dropdown-toggle btn-mini btn-primary" onclick="window.open('<?php echo($ruta_db_superior);?>pantallas/tareas_listado/adicionar_tareas_listado.php?idlistado_tareas=<?php echo $_REQUEST["idlistado_tareas"];?>','iframe_detalle');">Adicionar Tarea</button>	
			</div>
	
	<?php
		
	}

}

?>  
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
<script>  
  <!--               
  
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
  $("#resultado_todos").click(function(){
    $("#busqueda_registros").val("todos"); 
    cargar_datos_scroll();
  });    
$(document).ready(function(){
  cargar_datos_scroll();
  setTimeout("contador_buzon("+<?php echo($datos_componente);?>+",'cantidad_maxima')",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
});
  function cargar_datos_scroll(){
  	if($('#loadmoreajaxloader_parent').hasClass("disabled"))return;
    $('#loadmoreajaxloader').html("Cargando (... de ");
    $.ajax({
      type:'GET',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?><?php echo($condicion_adicional.$ocultar_subtareas.$idtareas_listado_unico.$rol_tareas); ?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&cantidad_total="+$("#cantidad_total").val(),
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){  
	          $("#busqueda_pagina").val(objeto.page);
	          $("#busqueda_total_paginas").val(objeto.total);
	          //$("#busqueda_sql").html(objeto.sql);
	          $("#fila_actual").val(objeto.actual_row);          
	          $.each(objeto.rows,function(i,item){
	          	 if(!$("#resultado_pantalla_"+item.llave).length){   
	            if(forma_cargar==1)         
		              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").prepend(""+item.info+"");
		            else{
		              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").append(""+item.info+"");
		            }
	           } 
	           <?php if(@$_REQUEST['rol_tareas']=="tarea_unica"){ //MUESTRA LA INFORMACION DE LA TAREA CUANDO PROVIENE DEL PLANEADOR ?>
                $("#div_info_doc_"+item.llave).addClass("in");
                $("#informacion"+item.llave).addClass('active');	
				$("#binformacion"+item.llave).addClass("btn-primary");
				$('#informacion'+item.llave).click();
                $("#tab4_"+item.llave).addClass('active');
             <?php } ?> 
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
	    data: "idbusqueda_componente="+idcomponente+"&page=0&rows="+$("#busqueda_registros").val()+"&actual_row=0&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>",
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
    -->                           
</script>
<script type="text/javascript">
$(document).ready(function() {
	
  <?php 
  if(!@$_REQUEST['idtareas_listado_unico']){
  ?>	            
  	$("#panel_body").height(alto_inicial);
  <?php
  }
  ?>
  
  
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
<script type="text/javascript" src="<?php echo($ruta_db_superior."pantallas/lib/librerias_ventana_modal.js");?>"></script>

<style>
	body{
		padding-right:0px;
		padding-left:0px;
		<?php if(@$_REQUEST['rol_tareas']!="tarea_unica"){ ?>
      overflow:hidden;
    <?php } ?>
		
	}
</style>


<?php
if(@$_REQUEST['idtareas_listado']){
?>

<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#well_<?php echo($_REQUEST['idtareas_listado']);?>",parent.document).addClass("documento_actual").addClass("alert-info");
  
</script>


<?php
}

if(@$_REQUEST['idlistado_tareas']){

?>
<script>
  $(".documento_actual",parent.document).removeClass("alert-info");
  $(".documento_actual",parent.document).removeClass("documento_actual");
  $("#resultado_pantalla_<?php echo($_REQUEST['idlistado_tareas']);?>",parent.document).children().addClass("documento_actual").addClass("alert-info");
  
</script>
<?php
	
}

?>

<style>
	body{
		margin-top:0px;
		margin-left:4px;
	}
</style>