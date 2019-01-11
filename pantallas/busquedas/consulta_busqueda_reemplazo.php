<?php
$max_salida=10; 
$ruta_db_superior=$ruta="";
while($max_salida>0){
    if(is_file($ruta."db.php")){
        $ruta_db_superior=$ruta; 
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
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
if($datos_busqueda["numcampos"]==0){
	echo "Datos no encontrados";	
	die();
}
$busqueda_documento_reemplazo=busca_filtro_tabla("","busqueda_componente A","A.nombre LIKE 'reemplazo_documento'","",$conn);
if($busqueda_documento_reemplazo["numcampos"]==0){
	echo "Componente NO encontrado";	
	die();
}

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
$idreemplazo='';
if(@$_REQUEST["idreemplazo"]){
  $idreemplazo=$_REQUEST["idreemplazo"];
}
$idbusqueda_componente='';
if(@$_REQUEST["idbusqueda_componente"]){
  $idbusqueda_componente=$_REQUEST["idbusqueda_componente"];
}
$datos_reemplazo=busca_filtro_tabla("B.nombres AS nombres_origen,B.apellidos AS apellidos_origen, C.nombres AS nombres_destino,C.apellidos AS apellidos_destino,B.funcionario_codigo AS codigo_origen, C.funcionario_codigo AS codigo_destino","reemplazo_equivalencia A, funcionario B,funcionario C","A.llave_entidad_origen=B.funcionario_codigo AND A.entidad_identidad=1 AND A.llave_entidad_destino=C.funcionario_codigo AND A.fk_idreemplazo_saia=".$idreemplazo,"",$conn);
?>
<style>
.row-fluid [class*="span"]{min-height:20px;}.row-fluid {min-height:20px;}.well{ margin-bottom: 3px; min-height: 11px; padding: 4px;} body{ font-size:12px; line-height:100%; margin-top:0px;padding:0px;} #panel_body{margin-top:0px; overflow: auto; <?php if($_SESSION["tipo_dispositivo"]=='movil'){?>-webkit-overflow-scrolling:touch;<?php } ?>}
</style>
<input type="hidden" id="seleccionados" value="" name="seleccionados">
<div class="row-fluid">
  <div class="row-fluid well span5">    
    <div class="pull-center legend" ><b>Funcionario Origen</b></div><br />
    <span class="legend">Funcionario:</span>
    <?php echo($datos_reemplazo[0]["nombres_origen"]);?> <?php echo($datos_reemplazo[0]["apellidos_origen"]);?><br /><br />
    <span class="legend">C&oacute;digo:</span>
    <?php echo($datos_reemplazo[0]["codigo_origen"]);?> <br /><br />
  </div>
  <div class="span1 pull-center"><i class="icon-circle-arrow-right"></i></div>
  <div class="row-fluid well span6">
    <div class="pull-center legend" ><b>Funcionario Destino</b></div><br />
    <span class="legend">Funcionario:</span><?php echo($datos_reemplazo[0]["nombres_destino"]);?> <?php echo($datos_reemplazo[0]["apellidos_destino"]);?><br /><br />
    <span class="legend">C&oacute;digo:</span>
    <?php echo($datos_reemplazo[0]["codigo_destino"]);?> <br /><br />
  </div>
  <div id="resultado_busqueda_<?php echo($datos_componente);?>"></div>
</div>
	<div class="panel_body" id="panel_body">
		<div id="resultado_busqueda_principal<?php echo($datos_componente);?>" class="panel_hidden">  
	    <div class="legend">Documentos Vinculados en el reemplazo</div><br />
	    <br />
	    <div id="resultado_busqueda<?php echo($busqueda_documento_reemplazo[0]["idbusqueda_componente"]);?>">
	    </div>
	    <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">
	    <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">
	    <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">
	    <input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
	    <input type="hidden" value="0" name="fila_actual" id="fila_actual">
	    <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">
	    <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">
	
	    <input type="hidden" value="<?php echo($busqueda_documentos_reemplazo[0]['cantidad_registros']);?>" name="busqueda_total_registros_doc" id="busqueda_registros_doc">
	    <input type="hidden" value="1" name="busqueda_pagina_doc" id="busqueda_pagina_doc">
	    <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas_doc">
	    <input type="hidden" value="<?php echo($busqueda_documentos_reemplazo[0]['idbusqueda_componente']);?>" name="iddatos_componente_doc" id="iddatos_componente_doc">
	    <input type="hidden" value="0" name="fila_actual_doc" id="fila_actual_doc">
		</div>
</div>
<script>
  var alto_inicial=($(window).height());
  var carga_final=false;
  var forma_cargar=<?php echo($datos_busqueda[0]["cargar"]);?>;
  $("#panel_body").height(alto_inicial);
  $("#panel_body").scroll(function(){   
    if($("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height()+3) || $("#panel_body").scrollTop()==($("#resultado_busqueda_principal<?php echo($datos_componente);?>").height()-$("#panel_body").height())){
      cargar_datos_scroll2();
    }
  });
  
	$(document).ready(function(){
	  cargar_datos_scroll();
	});
  
  function cargar_datos_scroll(){
    $.ajax({
      type:'POST',
      url: "servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?>&page="+$("#busqueda_pagina").val()+"&rows=todos&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&idreemplazo=<?php echo($idreemplazo);?>",
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html);
          if(objeto.exito){
	          $("#busqueda_pagina").val(objeto.page);
	          $("#busqueda_total_paginas").val(objeto.total);
	          $("#fila_actual").val(objeto.actual_row);
	          $.each(objeto.rows,function(index,item){
	            if(forma_cargar===1)
	              $("#resultado_busqueda_<?php echo($datos_componente);?>").prepend(item.info);
	            else{
	              $("#resultado_busqueda_<?php echo($datos_componente);?>").append(item.info);
	            }
	          });
	          $(".kenlace_saia").attr("onclick"," ");
	          iniciar_tooltip();
	          if(objeto.actual_row>=objeto.records){
	            cargar_datos_scroll2();
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
      $.ajax({
        type:'POST',
        url: "servidor_busqueda.php",
        data: "idbusqueda_componente=<?php echo($busqueda_documento_reemplazo[0]['idbusqueda_componente']);?>&page="+$("#busqueda_pagina_doc").val()+"&rows="+$("#busqueda_registros").val()+"&actual_row="+$("#fila_actual_doc").val()+"&idreemplazo=<?php echo($idreemplazo);?>",
        success: function(html){
          if(html){
            var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
  	          $("#busqueda_pagina_doc").val(objeto.page);
  	          $("#busqueda_total_paginas_doc").val(objeto.total);
  	          $("#fila_actual_doc").val(objeto.actual_row);
  	          $.each(objeto.rows,function(index,item){
  	            if(forma_cargar===1)
  	              $("#resultado_busqueda<?php echo($busqueda_documento_reemplazo[0]['idbusqueda_componente']);?>").prepend("<div id='resultado_pantalla_"+item.llave+"' class='well'>"+item.info+"</div>");
  	            else{
  	              $("#resultado_busqueda<?php echo($busqueda_documento_reemplazo[0]['idbusqueda_componente']);?>").append("<div id='resultado_pantalla_"+item.llave+"' class='well'>"+item.info+"</div>");
  	            }
  	          });
  	          $(".kenlace_saia").attr("onclick"," ");
  	          iniciar_tooltip();
  	          if(objeto.actual_row>=objeto.records){
  	            finalizar_carga_datos();
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
  }
  function finalizar_carga_datos(){
    carga_final=2;
  }
  $(".well").live("mouseenter",function(){
      $(this).addClass("alert-success");
  });
  $(".well").live("mouseleave",function(){
      $(this).removeClass("alert-success");
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