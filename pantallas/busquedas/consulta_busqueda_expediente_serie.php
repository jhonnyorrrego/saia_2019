<meta http-equiv="X-UA-Compatible" content="IE=9">
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
$padre=explode("/**/",$_REQUEST["variable_busqueda"]);
?>
<style>
.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:50px}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
</style>       

<div class="navbar navbar-fixed-top" id="menu_buscador">
  <div class="navbar-inner">
    <ul class="nav pull-left">
      <li>
        <button class="btn btn-mini" id="guardar_padre">Guardar
        </button>
      </li>
      <li class="divider-vertical">
      </li>
      <li>
      	<input type="text" name="bqsaia_nombre" id="bqsaia_nombre">
      </li>
      <li class="divider-vertical">
      </li>
      <li>
      	<button class="btn btn-mini" id="filtrar_listado">Filtrar
        </button>
      </li>
      <li class="divider-vertical">
      </li>
      <li>            
      <div class="btn-group">            
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader" >M&aacute;s Resultados
        </button>
      </div>
      </li>
      <li class="divider-vertical">
      </li>
      <li>         
        <button class="btn btn-mini" id="adicionar_expediente2">Adicionar expediente
        </button>
      </li>
      <?php if(@$datos_busqueda[0]["menu_busqueda_superior"]){ ?>
        <?php 
          $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
          echo($funcion_menu[0](@$funcion_menu[1]));
        ?>
      <?php } ?>
    </ul>
  </div>
</div>
<br>
<input type="hidden" id="seleccionados" value="" name="seleccionados">
<div class="panel_body" style="margin-top:0px" id="panel_body">
  <div id="resultado_panel" style="overflow:hidden;">      
    <div id="resultado_busqueda_principal<?php echo($datos_componente);?>">  
      <div id="resultado_busqueda<?php echo($datos_componente);?>">  
      </div>                                                         
      <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">  
      <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">  
      <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">  
      <input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
      <input type="hidden" value="0" name="fila_actual" id="fila_actual">
      <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">    
      <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">
      
      <input type="hidden" value="" name="seleccionados_expediente" id="seleccionados_expediente">
    </div>
  </div>                           
</div>                                           
<script>
	$("#adicionar_expediente2").click(function(){
		window.open("<?php echo($ruta_db_superior); ?>pantallas/expediente/adicionar_expediente.php?idbusqueda_componente=<?php echo($_REQUEST["idbusqueda_componente"]); ?>&cod_padre=<?php echo($padre[1]); ?>&volver=1&enlace=pantallas/busquedas/consulta_busqueda_expediente_serie.php","_self");
	});
  <!--
  $("#filtrar_listado").click(function(){
	  $.ajax({
		  type:'GET',
		  url: "<?php echo($ruta_db_superior); ?>pantallas/busquedas/procesa_filtro_busqueda.php",
		  data: "idbusqueda_componente=<?php echo($datos_componente); ?>&adicionar_consulta=1&json=1&bksaiacondicion_nombre=like_total&bqsaia_nombre="+$("#bqsaia_nombre").val(),
		  dataType:"json",
		  success: function(data){
		  	enlace=data.url;
		  	if(enlace!=''){
		  		window.open("<?php echo($ruta_db_superior); ?>"+enlace+"&variable_busqueda="+$("#variable_busqueda").val(),"_self");
			  }
		  }
	  });
	});

  var espacio_menu=$("#menu_buscador").height()+18;
  var alto_inicial=($(window).height()-espacio_menu); 
  alto_inicial=480;
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
  while(($("#resultado_panel").height()<alto_inicial) && !carga_final){    
    setTimeout("cargar_datos_scroll()",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
    contador++; 
    if($("#busqueda_pagina").val()>=$("#busqueda_total_paginas").val()){
      carga_final=true;
    }                      
  }
  function cargar_datos_scroll(){
    $('#loadmoreajaxloader').html("Cargando");
    $.ajax({
      type:'GET',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val(),
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html); 
          $("#busqueda_pagina").val(objeto.page);
          $("#busqueda_total_paginas").val(objeto.total);
          //$("#busqueda_sql").html(objeto.sql);
          $("#fila_actual").val(objeto.actual_row);
          if(objeto.rows!==undefined){
	          $.each(objeto.rows,function(i,item){
	          	if(!$("#resultado_pantalla_"+item.llave).length){
	    
	            if(forma_cargar==1){
	            	$("#resultado_busqueda_principal<?php echo($datos_componente);?>").prepend(item.info);
	            }else{
	              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").append(item.info);   
	            } 
	           } 
	          });
          }
          
          $(".kenlace_saia").attr("onclick"," ");
          iniciar_tooltip();                         
          if(objeto.actual_row>=objeto.records){
            finalizar_carga_datos();
          }
          else{
            $('#loadmoreajaxloader').html("M&aacute;s Resultados ("+objeto.actual_row+" de "+objeto.records+")");
            
          }                                 
          if($("#resultado_panel").height()<alto_inicial){
            cargar_datos_scroll();
          }                
          $("#resultado_panel").getNiceScroll().resize()
        }else{
          finalizar_carga_datos();
        }
      }
    });
  } 
  function finalizar_carga_datos(){
    carga_final=true;
    $('#loadmoreajaxloader').html('resultados('+$("#fila_actual").val()+" de "+$("#fila_actual").val()+').');
    $('#loadmoreajaxloader').addClass("disabled");
  } 
  $('#loadmoreajaxloader').click(function(){
     cargar_datos_scroll();
  });  
  $('.dropdown input, .dropdown label .dropdownn select').click(function(e) {
    e.stopPropagation();
  });   

	$("#guardar_padre").click(function(){
		var seleccionados=new Array();
		var etiquetas=new Array();
		$(".eliminar_seleccionado").each(function(i){
			seleccionados[i]=$(this).attr("idregistro");
			etiquetas[i]=$(this).attr("etiqueta");
		});
		parent.document.getElementById("fk_idexpediente").value=seleccionados.join(",");
		parent.document.getElementById("etiqueta_expediente").innerHTML=etiquetas.join(", ");
		window.parent.hs.close();
	});
    -->                           
</script>
<script type="text/javascript" src="<?php echo($ruta_db_superior."js/jquery.nicescroll.js");?>"></script>
<script type="text/javascript">
$(document).ready(function() {
	window.parent.$(".block-iframe").attr("style","margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");
	
  $("#resultado_panel").height("");
  $("#resultado_panel").height(alto_inicial);
  $("#resultado_panel").niceScroll({autohidemode:false, cursorwidth: 8});
  $("#resultado_panel").scroll(function(){
    //$("#ayuda").html("RES-PANEL:"+$("#resultado_panel").scrollTop()+"->T:"+($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#resultado_panel").height()+3));
    if($("#resultado_panel").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#resultado_panel").height()+3) || $("#resultado_panel").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#resultado_panel").height())){
      setTimeout("cargar_datos_scroll()",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
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