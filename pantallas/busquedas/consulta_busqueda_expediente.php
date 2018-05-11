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
usuario_actual("login");
if (@$_REQUEST["idbusqueda_componente"]) {
	$idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
}
$datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $idbusqueda_componente, "", $conn);
$busqueda_documento_expediente = busca_filtro_tabla("", "busqueda_componente A", "A.nombre LIKE 'expediente_documento'", "", $conn);
$busq_docu = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre LIKE 'listado_documentos_avanzado'", "", $conn);

echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
if ($datos_busqueda[0]["ruta_libreria"]) {
	$librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
	array_walk($librerias, "incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento, $indice) {
	global $ruta_db_superior;
	include_once ($ruta_db_superior . $elemento);
}

$idexpediente = '';
if ($_REQUEST["idexpediente"]) {
	$idexpediente = $_REQUEST["idexpediente"];
}
$cod_arbol = '';
if ($_REQUEST["cod_arbol"]) {
	$cod_arbol = $_REQUEST["cod_arbol"];
}

if ($datos_busqueda[0]["busqueda_avanzada"] != '') {
	if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
		$datos_busqueda[0]["busqueda_avanzada"] .= "&";
	} else {
		$datos_busqueda[0]["busqueda_avanzada"] .= "?";
	}
	$datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
}
?>

<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css" />
<style>
.row-fluid [class*="span"]{min-height:20px;}.row-fluid {min-height:20px;}.well{ margin-bottom: 3px; min-height: 11px; padding: 4px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:35px;padding:0px;}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8} #panel_body{margin-top:0px; width: 50%; overflow: auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>} #panel_detalle{margin-top:0px; width: 50%; border: 0px; overflow:auto;<?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}
</style>
<div class="navbar navbar-fixed-top" id="menu_buscador">
  <div class="navbar-inner">
    <ul class="nav pull-left">
      <li>
	      <div class="btn-group">            
	        <button type="button" class="btn btn-mini">Busqueda</button>
	        <button type="button" class="btn dropdown-toggle btn-mini" data-toggle="dropdown"><span class="caret"> </span>&nbsp;</button>
	        <ul class="dropdown-menu" id='lista_busqueda'>
	          <li class="nav-header">Busqueda de:</li>
	          <li>
	          	<a href="#" class="kenlace_saia" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>" titulo="Formulario B&uacute;queda">Expedientes</a>
	          </li>
	          <li>
	          	<a href="#" class="kenlace_saia" title="B&uacute;squeda Documentos en el Expediente" conector="iframe" enlace="pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=<?php echo $busq_docu[0]["idbusqueda_componente"];?>&idexpediente=<?php echo $idexpediente;?>" titulo="Formulario B&uacute;queda">Documentos</a>
	          </li>
	        </ul>
	      </div>
      </li>
      
      
      <!-- /btn-group -->
      </li>
      <li>          
      <div class="btn-group">            
        <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Acciones &nbsp;
          <span class="caret">
          </span>&nbsp;
        </button>            
        <ul class="dropdown-menu" id='listado_seleccionados'>              
          <?php 
            if($datos_busqueda[0]["acciones_seleccionados"]!=''){
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
      <?php if(@$datos_busqueda[0]["menu_busqueda_superior"]){ ?>
        <?php
          $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
          echo($funcion_menu[0](@$funcion_menu[1]));
        ?>
      <?php }
      ?>
       <li class="divider-vertical"> </li>
      <li>            
      <div class="btn-group">            
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader" >M&aacute;s Resultados
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
    </ul>
  </div>
</div>
<br>
<input type="hidden" id="seleccionados" value="" name="seleccionados">
<input type="hidden" id="seleccionados_expediente" value="" name="seleccionados_expediente">
<div class="panel_body pull-left" id="panel_body">
    <div id="resultado_busqueda_principal<?php echo($idbusqueda_componente);?>" class="panel_hidden">
      <div id="resultado_busqueda<?php echo($idbusqueda_componente);?>">
      </div>
      <div id="resultado_busqueda<?php echo($busqueda_documento_expediente[0]["idbusqueda_componente"]);?>">
      </div>
      <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">
      <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">
      <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">
      <input type="hidden" value="<?php echo($idbusqueda_componente);?>" name="iddatos_componente" id="iddatos_componente">
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
<div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" name="iframe_detalle" style="width: 100%;" frameborder="no"></iframe>
</div>
<script>
$(document).ready(function(){
	window.parent.$(".block-iframe").attr("style","margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");
});

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
  $("#panel_body").height(alto_inicial);
  $("#panel_detalle").height(alto_inicial);
  $("#iframe_detalle").height(alto_inicial);
  $("#panel_body").scroll(function(){
    if(($("#panel_body").scrollTop() >= $("#resultado_busqueda_principal<?php echo($idbusqueda_componente);?>").height() - $("#panel_body").height()) && carga_final<2){
      cargar_datos_scroll();
    }
  });
  while(($("#resultado_busqueda_principal<?php echo($idbusqueda_componente);?>").height()<alto_inicial) && !carga_final){
    setTimeout("cargar_datos_scroll()",<?php echo($datos_busqueda[0]["tiempo_refrescar"]); ?>);
    contador++;
    if($("#busqueda_pagina").val()>=$("#busqueda_total_paginas").val()){
      carga_final=1;
    }
  }
  function cargar_datos_scroll(){
    $('#loadmoreajaxloader').html("Cargando");
    $.ajax({
      type:'POST',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($idbusqueda_componente);?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&idexpediente=<?php echo($idexpediente);?>&idcaja=<?php echo($_REQUEST["idcaja"]);?>",
      dataType:'json',
      success: function(objeto){
          if(objeto.exito){
	          $("#busqueda_pagina").val(objeto.page);
	          $("#busqueda_total_paginas").val(objeto.total);
	          $("#fila_actual").val(objeto.actual_row);
	          $.each(objeto.rows,function(index,item){
	            if(objeto.page===2 && index===0){
	                $("#iframe_detalle").attr({
	                    'src':'<?php echo($ruta_db_superior);?>pantallas/expediente/detalles_expediente.php?idexpediente='+item.idexpediente+"&idbusqueda_componente=<?php echo($idbusqueda_componente);?>&rand=<?php echo(rand());?>",
	                    'height': ($("#panel_body").height())
	                });
	            }
	            if(forma_cargar===1)
	              $("#resultado_busqueda<?php echo($idbusqueda_componente);?>").prepend(item.info);
	            else{
	              $("#resultado_busqueda<?php echo($idbusqueda_componente);?>").append(item.info);
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
	          if(($("#resultado_busqueda_principal<?php echo($idbusqueda_componente);?>").height()<alto_inicial)&& !carga_final){
	            cargar_datos_scroll();
	          }
          }else{
               $("#busqueda_total_paginas").val(0);
          	cargar_datos_scroll2();
          }
      },error:function (){
      	alert("Error al procesar la solicitud");
      }
    });
  }
  function cargar_datos_scroll2(){
    if(carga_final!=2){
      $('#loadmoreajaxloader').html("Cargando");
      $.ajax({
        type:'POST',
        url: "servidor_busqueda.php",
        data: "idbusqueda_componente=<?php echo($busqueda_documento_expediente[0]['idbusqueda_componente']);?>&page="+$("#busqueda_pagina_doc").val()+"&rows="+$("#busqueda_registros_doc").val()+"&actual_row="+$("#fila_actual_doc").val()+"&idexpediente=<?php echo($idexpediente);?>",
        dataType:'json',
        success: function(objeto){
            if(objeto.exito){
  	          $("#busqueda_pagina_doc").val(objeto.page);
  	          $("#busqueda_total_paginas_doc").val(objeto.total);
  	          $("#fila_actual_doc").val(objeto.actual_row);
  	          $.each(objeto.rows,function(index,item){
  	            if(parseInt($("#busqueda_total_paginas").val())==0 && index===0){
  	                $("#iframe_detalle").attr({
  	                    'src':'<?php echo($ruta_db_superior);?>pantallas/documento/detalles_documento.php?iddoc='+item.iddocumento+"&idbusqueda_componente=<?php echo($idbusqueda_componente);?>&rand=<?php echo(rand());?>",
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
  	          if(($("#resultado_busqueda_principal<?php echo($idbusqueda_componente);?>").height()<alto_inicial)&& carga_final!=2){
  	            cargar_datos_scroll2();
  	          }
            }
            else{
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
       $(this).addClass("muted");
  });
  $(".well").live("mouseleave",function(){
      $(this).removeClass("muted");
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