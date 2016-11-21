<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
//include_once($ruta_db_superior."pantallas/documento/librerias_flujo.php");
echo(estilo_bootstrap());
if($_SESSION["tipo_dispositivo"]=="movil"){
    if(!@$_REQUEST["iddoc"]) $_REQUEST["iddoc"]=@$_REQUEST["key"];
    include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");
    menu_principal_documento($_REQUEST["iddoc"]);
}
$adicionales_enlace="";
$busquedas=busca_filtro_tabla("", "busqueda_componente", "nombre LIKE 'notas_documento' OR nombre LIKE 'anexos' OR nombre LIKE 'paginas_documento' OR nombre LIKE 'buzon_salida' OR nombre LIKE 'documentos_relacionados' OR nombre LIKE 'documentos_respuesta' OR nombre LIKE 'tareas_documento' OR nombre LIKE 'versiones_documento'", "", $conn);
$modulos=busca_filtro_tabla("nombre,etiqueta","modulo","nombre LIKE 'ordenar_pag' OR nombre LIKE 'ver_notas' OR nombre LIKE 'adjuntos_documento' OR nombre LIKE 'documentos_relacionados' OR nombre LIKE 'arbol_documento' OR nombre LIKE 'tareas_documento' OR nombre LIKE 'ver_versiones'","",$conn);
$iconos = array();
for($i=0; $i< $modulos['numcampos']; $i++){
	$iconos = array_merge($iconos,array($modulos[$i][nombre] => $modulos[$i]["etiqueta"])); 
}
for($i=0;$i<$busquedas["numcampos"];$i++){
    switch ($busquedas[$i]["nombre"]){
        case 'notas_documento':
            $notas_documento=$busquedas[$i]["idbusqueda_componente"];
        break;
        case 'anexos':
            $anexos=$busquedas[$i]["idbusqueda_componente"];
        break;
        case 'paginas_documento':
            $paginas_documento=$busquedas[$i]["idbusqueda_componente"];			
        break;
        case 'buzon_salida':
            $buzon_salida=$busquedas[$i]["idbusqueda_componente"];
        break;
        case 'documentos_relacionados':
            $documentos_relacionados=$busquedas[$i]["idbusqueda_componente"];            
        break;
		case 'documentos_respuesta':
            $documentos_respuesta=$busquedas[$i]["idbusqueda_componente"];			            
        break;
        case 'tareas_documento':
            $tareas_documento=$busquedas[$i]["idbusqueda_componente"];			            
        break;
				case 'versiones_documento':
            $versiones_documento=$busquedas[$i]["idbusqueda_componente"];			            
        break;
    }
}
$iddocumento=0;
if($_REQUEST["iddoc"]){
$iddocumento=$_REQUEST["iddoc"];
  $formato=busca_filtro_tabla("A.numero,A.descripcion AS etiqueta,B.nombre_tabla,B.idformato,B.nombre, A.iddocumento","documento A,formato B","lower(A.plantilla)=B.nombre AND A.iddocumento=".$iddocumento,"",$conn);
  //print_r($formato);
  if($formato["numcampos"]){
    $numero=$formato[0]["numero"];
    $texto.='<b>'.strtoupper($formato[0]["nombre"]).':</b><br>';
    $texto.="Numero Radicado: ".$formato[0]["numero"]."<br>";
    $texto.=strip_tags(html_entity_decode("Descripcion:".htmlentities(stripslashes($formato[0]["etiqueta"]))),"<br>");
    $descripcion=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"]." AND acciones LIKE '%d%'","",$conn);
    if($descripcion["numcampos"]){
      $campo_descripcion=$descripcion[0]["nombre"];
    }
    else{
      $campo_descripcion="id".$formato[0]["nombre_tabla"];
    }
  $papas=busca_filtro_tabla("id".$formato[0]["nombre_tabla"]." AS llave, ".$campo_descripcion." AS etiqueta ,'".$formato[0]["nombre_tabla"]."' AS nombre_tabla",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddocumento,"id".$formato[0]["nombre_tabla"]." ASC",$conn);
 
    if($papas["numcampos"]){
      $iddoc=$formato[0]["idformato"]."-".$papas[0]["llave"]."-id".$formato[0]["nombre_tabla"];
      $iddoc2=$iddoc;
      $llave_formato=$formato[0]["idformato"]."-id".$formato[0]["nombre_tabla"]."-".$papas[0]["llave"]."-".$iddocumento;
    }
    else {
      $iddoc=0;
      $llave_formato=0;
    }
  $_SESSION["iddoc"]=$formato[0]["iddocumento"];
  }
  else {
    $iddoc=0;
    $texto="Existen Problemas al buscar el documento";
  }
leido(usuario_actual("funcionario_codigo"),$iddocumento);
}
else {
  alerta("No se ha podido encontrar el Documento");
  volver(1);
}
$_SESSION["iddoc"]=$iddocumento;
if(@$_REQUEST["seleccionar"])
  {$datos_seleccionar=explode("-",$_REQUEST["seleccionar"]);
   $id=busca_filtro_tabla("id".$datos_seleccionar[2],$datos_seleccionar[2],"documento_iddocumento=".$datos_seleccionar[3],"",$conn);
   $nodoinicial=$datos_seleccionar[0]."-".$datos_seleccionar[1]."-".$id[0]["id".$datos_seleccionar[2]]."-".$datos_seleccionar[3];
  }
elseif(@$_REQUEST["llave"]){
  $nodoinicial=$_REQUEST["llave"];
}
else $nodoinicial=$llave_formato;

if(@$_REQUEST["alto_pantalla"]){
  $alto_inicial=($_REQUEST["alto_pantalla"]-47)."px";
}
else{
  $alto_inicial='90%';
}
?>
<style type="text/css">
.well{padding: 0px;margin-bottom: 3px;}.tabs-right > .nav-tabs{margin-left:0px;}.tabs-right > .nav-tabs > li > a{min-width: 40px;} .badge{line-height:11px;padding: 1px 4px 1px; margin-left: 15px; font-size:11px;} .nav-tabs > li > a, .nav-pills > li > a {padding-right: 2px;padding-left: 2px;} body{padding:5px;} .div_pagina{text-align: center;} .tabs-left,tabs-right {margin-bottom:0px;} .ordenar_paginas { list-style-type: none;}  .btn-group div{line-height: 0px;}
.navbar-inner {min-height: 15px;} #anexos .well{background: transparent;border: none;} .lista_datos > li{list-style: none; margin-left: 0px; margin-bottom:2px;} #panel_notas_tranferencia > li > .well > div{padding-left:5px;} .lista_datos{margin: 0px;} .alert{padding:0px; margin-bottom:0px;} li {line-height: 15px;} .npaginas{margin-left: 55px;margin-right: -42px; margin-top: 3px;} .cb_pagina{margin-left: 5px; margin-bottom: 3px;}
</style>                
<div class="tabbable tabs-right">
  <ul class="nav nav-tabs">
    <li class="active">
    	<a href="#arbol" id="arbol_documento" data-toggle="tab" class="tooltip_saia_izquierda" title="<?php echo($iconos['arbol_documento']);?>" componente="arbol_documento">
    		<i class="icon-arbol_documento"></i>
    	</a>
    </li>
    <li>
    	<a href="#paginas" id="ordenar_pag" data-toggle="tab" componente="<?php echo($paginas_documento);?>"  class="tooltip_saia_izquierda" title="<?php echo($iconos['ordenar_pag']);?>">
    		<i class="icon-ver_pag_documento"><span class="badge badge-info" id="cantidad_paginas"></span></i>
    	</a>
    </li>
    <li>
    	<a href="#anexos" id="adjuntos_documento" data-toggle="tab" componente="<?php echo($anexos);?>" class="tooltip_saia_izquierda" title="<?php echo($iconos['adjuntos_documento']);?>">
    		<i class="icon-adjuntos_documento"><span class="badge badge-info" id="cantidad_anexos"></span></i>		
    	</a>
    </li>
    <li>        
    	<a href="#respuesta" id="documentos_relacionados" data-toggle="tab" componente="<?php echo($documentos_relacionados);?>" componente2="<?php echo($documentos_respuesta);?>" class="tooltip_saia_izquierda" title="<?php echo($iconos['documentos_relacionados']);?>">
            
            <i class="icon-documentos_relacionados"><span class="badge badge-info" id="cantidad_documentos_relacionados"></span></i>
    	</a>        
    </li>    
    <li>        
    	<a href="#notas" id="ver_notas" data-toggle="tab" componente="<?php echo($notas_documento);?>" class="tooltip_saia_izquierda" title="<?php echo($iconos['ver_notas']);?>">
            
            <i class="icon-ver_notas"><span class="badge badge-info" id="cantidad_notas"></span></i>
    	</a>        
    </li>
    <li>        
    	<a href="#tareas" id="ver_tareas" data-toggle="tab" componente="<?php echo($tareas_documento);?>" class="tooltip_saia_izquierda" title="<?php echo($iconos['tareas_documento']);?>">
            
            <i class="icon-ver_tareas"><span class="badge badge-info" id="cantidad_tareas"></span></i>
    	</a>        
    </li>
    <li>        
    	<a href="#versiones" id="ver_versiones" data-toggle="tab" componente="<?php echo($versiones_documento);?>" class="tooltip_saia_izquierda" title="<?php echo($iconos['versiones_documento']);?>">
            
            <i class="icon-ver_versiones"><span class="badge badge-info" id="cantidad_versiones"></span></i>
    	</a>        
    </li>
  </ul>
  <div class="tab-content" style="overflow: auto;">
    <div class="tab-pane active" id="arbol">
      <div id="esperando_arbol">
        <img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif"></div>
      <div id="tree_box" class="arbol_saia"></div>
    </div>      
    <div class="tab-pane" id="paginas">  
      <b><?php echo($iconos['ordenar_pag']);?></b>        
      <ul id="panel_paginas" class="ordenar_paginas" style="margin:5px 0 10px 0;">
      </ul>   
    </div>
    <div class="tab-pane" id="anexos">
  		<b><?php echo($iconos['adjuntos_documento']);?></b>
  		<div><button class="btn btn-mini" id="adicionar_anexos">Adicionar</button></div>
  		<form name="listado_anexos" method="post" id="listado_anexos">
  			<ul class="lista_datos" id="panel_anexos">
        </ul>
  		</form>
		</div>
    <div class="tab-pane" id="respuesta">
      <div id="encabezado_relacionados">
        <b><?php echo($iconos['documentos_relacionados']);?></b>
      </div>
    	<b>a. Vinculados como respuesta</b>
    	<ul class="lista_datos" id="panel_respuesta">
      </ul>
    	<!--button class="btn btn-mini btn-primary pull-right vinculado_respuesta" iddocumento="<?php echo($_REQUEST['iddocumento']);?>">Vincular otro</button-->
    	<br />
    	<b>b. Asociado a</b>
    	<ul class="lista_datos" id="panel_asociado_a">
    	<?php
    	$origen=busca_filtro_tabla("B.*","respuesta A, documento B","A.destino='".$iddocumento."' AND A.origen=B.iddocumento","",$conn);
    	if($origen["numcampos"]){
    		echo('<li><div class="row-fluid"><div class="pull-left tootltip_saia_abajo">'.$origen[0]["numero"].'-'.$origen[0]["descripcion"].'</div><div class="pull-right"><a href="#" enlace="ordenar.php?key='.$origen[0]["iddocumento"].'&mostrar_formato=1'.$adicionales_enlace.'" conector="iframe"  titulo="Documento No.'.$origen[0]["numero"].'" class="kenlace_saia pull-left" ><i class="icon-download tooltip_saia_izquierda" title="Ver documento"></i></a></div></div></li>');
    	}
			?>
      </ul><br />
    	<b>c. Vinculados por funcionario</b>
    	<ul class="lista_datos" id="panel_relacionados_funcionario"></ul>
    	<!--button class="btn btn-mini btn-primary pull-right" id="boton_documentos_relacionados" enlace="pantallas/vincular_documento/adicionar_vincular_documento.php?iddocumento=<?php echo($_REQUEST['iddocumento'].$adicionales_enlace);?>">Vincular otro</button-->
    	<div id="pie_relacionados"></div>
    </div>
    <div class="tab-pane" id="notas">
      <div id="encabezado_notas">
        <b><?php echo($iconos['ver_notas']);?></b>
      </div>
    	a. Notas de transferencia
    	<ul id="panel_notas_tranferencia" class="lista_datos"></ul>
    	b. Notas post-it
    	<ul id="panel_notas" class="lista_datos"></ul>
    	<div id="pie_notas"></div>
    </div>
    <div class="tab-pane" id="tareas">
      <div id="encabezado_tareas">
        <b><?php echo($iconos['ver_tareas']);?></b>
      </div>
    	a. Tareas del documento
    	<ul id="panel_tareas" class="lista_datos"></ul>
    	<?php
    		$tareas=busca_filtro_tabla("idtareas,tarea,prioridad,fecha_tarea","tareas","documento_iddocumento=".$iddocumento,"",$conn);
			$mostrar_tarea="";
    		for($i=0;$i<$tareas['numcampos'];$i++){
				if(is_object($tareas[$i]['fecha_tarea'])){
					$fecha_tarea=$tareas[$i]['fecha_tarea']->format("Y-m-d");
				}else{
					$fecha_tarea=$tareas[$i]['fecha_tarea'];
				}
    			$mostrar_tarea.="<li class='tarea' enlace='pantallas/tareas/mostrar_tareas.php?idtareas=".$tareas[$i]['idtareas']."&iddoc=".$iddocumento."'><b>".$tareas[$i]['tarea']." - ".$fecha_tarea."</a></b></li>";
    		}
			//echo($mostrar_tarea);
    	?>
    	<div id="pie_tareas"></div>
    </div>
    <div class="tab-pane" id="versiones">
      <div id="encabezado_versiones">
        <b><?php echo($iconos['ver_versiones']);?></b><br/>
      </div>
      <span class="phpmaker">
      <div id="esperando_version"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
	  <div id="treeboxbox_tree5" class="arbol_saia"></div>
      </span>
    	<!--ul id="panel_versiones" class="lista_datos"></ul-->
    	<!--div id="pie_versiones"></div-->
    </div>
  </div>
</div>
<?php
echo(librerias_arboles());
echo(librerias_jquery('1.7')); 
echo(librerias_UI());//Se mueve de posicion, se encontraba de ultima en esta lista.
echo(librerias_tooltips());
echo(librerias_bootstrap());
echo(librerias_notificaciones());
echo(librerias_acciones_kaiten());
?>
<script>
$(document).ready(function(){
  $("#adicionar_anexos").live('click',function(){
    window.open("<?php echo($ruta_db_superior); ?>anexosdigitales/anexos_documento.php?key=<?php echo($iddocumento); ?>","detalles");
  });
});
</script>
<script type="text/javascript">	
$(document).ready(function(){
var item="<?php echo($nodoinicial);?>";
open_tabs=1;
$(".tooltip_saia").attr("class","");
function click_funcion(div){
	$("#"+div).click();				
}
  $('[data-toggle=tab]').click(function(){
    if ($(this).parent().hasClass('active') ){
      $($(this).attr("href")).toggleClass('active');
      if(open_tabs==1){      
        open_tabs=0;
        ///Se debe tener en cuenta que elimina reemplaza la clase 
        //$(this).attr("class","tooltip_saia tooltip_saia_derecha");
        $("#izquierdo_saia",parent.document).parent().attr("class","span1");   
        $("#contenedor_saia",parent.document).parent().attr("class","span11");
              
      }      
      else{
        open_tabs=1;
        //$(this).attr("class","tooltip_saia tooltip_saia_izquierda");
        $("#izquierdo_saia",parent.document).parent().attr("class","span3");   
        $("#contenedor_saia",parent.document).parent().attr("class","span9");      
      }  
      //$('.tooltip_saia').tooltip();
    }
    if(open_tabs==1){
      var enlace=$(this).attr("href").replace("#","").trim();
      var div=$(this).attr("href");
      if(enlace!==''){
        var componente = $(this).attr('componente');
        var componente2 = '';
        if($(this).attr('componente2')){
        	var componente2 = $(this).attr('componente2');
        }
        var div = "#panel_"+$(this).attr('href').replace("#","");
        var etiqueta = $(this).attr('href').replace("#","");
        
        if(div!=='#arbol'){
            $.ajax({
              type: "POST",
              url: "<?php echo $ruta_db_superior ;?>"+"pantallas/busquedas/servidor_busqueda.php",		  		  
              data:{idbusqueda_componente: $(this).attr('componente'),iddocumento : "<?php echo $iddocumento;?>",rows:"100",actual_row:"0",limpio:"1"},
              success:function(html){
              	if(jQuery.isEmptyObject(html)){
              		$(div).html('');
              		switch(etiqueta){
        						case 'paginas':
        							$(div).append("<li class='alert'>No hay "+etiqueta+"</li>");
        							$('#encabezado_paginas').hide(); 
        						break;
        						case 'anexos': 
        						alert("12");
        							$(div).append("<li class='alert'>No hay "+etiqueta+"</li>");
        						break;
        						case 'respuesta': 
        							$(div).append("<li class='alert' style='margin-bottom:3px;'>No hay documentos vinculados como "+etiqueta+"</li>");
        						break;					
        						case 'notas': 
        							$(div).append("<li class='alert'>No hay "+etiqueta+" post-it</li>");
        						break;
        					}              		
              	}else{
              		var objeto=jQuery.parseJSON(html);
	                $(div).html('');                    
	                $.each(objeto.rows,function(i,item){
	                    $(div).append("<li>"+item.info+"</li>");	                           
	                });	
              	}
                cargar_cantidades_documento("<?php echo($iddocumento);?>");
              }
            });
        }    
        if(componente === '<?php echo($notas_documento);?>'){ 
        	$("#panel_notas_tranferencia").html('');                
            $.ajax({
            type: "POST",
            url: "<?php echo $ruta_db_superior ;?>"+"pantallas/busquedas/servidor_busqueda.php",		  		  
            data:{idbusqueda_componente:'<?php echo($buzon_salida);?>',iddocumento : "<?php echo $iddocumento;?>",actual_row:"0",limpio:"1",rows:"100"},
            success:function(html){
            	$("#panel_notas_tranferencia").html('');
            	if(jQuery.isEmptyObject(html)){            		
            		$("#panel_notas_tranferencia").append("<li class='alert'>No hay notas de transferencia</li>");
            	}else{            		
	                var objeto=jQuery.parseJSON(html);	                              
	                $.each(objeto.rows,function(i,item){   
                        if(parseInt('<?php echo($_SESSION["usuario_actual"]) ?>')==parseInt(item.origen) || parseInt('<?php echo($_SESSION["usuario_actual"]); ?>')==parseInt(item.destino) || parseInt(item.ver_notas)==1){
                            if(item.nombre=="COPIA" && item.ver_notas==0){
                                item.info='';
                            }
                        }    
	                	$("#panel_notas_tranferencia").append("<li>"+item.info+"</li>");
	                });	               
               }
            	//iniciar_tooltip();
            }
          });         
        }
        if(componente === '<?php echo($documentos_relacionados);?>'){ 
          $("#panel_relacionados_funcionario").html('');                
          $.ajax({
            type: "POST",
            url: "<?php echo $ruta_db_superior ;?>"+"pantallas/busquedas/servidor_busqueda.php",		  		  
            data:{idbusqueda_componente:'<?php echo($documentos_relacionados);?>',iddocumento : "<?php echo $iddocumento;?>",actual_row:"0",limpio:"1",rows:"100"},
            success:function(html){
            	$("#panel_relacionados_funcionario").html('');
            	if(jQuery.isEmptyObject(html)){
            		$("#panel_relacionados_funcionario").append("<li class='alert' style='margin-bottom:3px;'>No hay documentos relacionados por funcionario</li>");
            	}else{
	                var objeto=jQuery.parseJSON(html);                    
	                $.each(objeto.rows,function(i,item){                          
                        $("#panel_relacionados_funcionario").append("<li>"+item.info+"</li>");        
	                });	               
               }
            	//iniciar_tooltip();
            }            
          });         
        }
        if(componente2 === '<?php echo($documentos_respuesta);?>'){
          $("#panel_respuesta").html('');                
          $.ajax({
            type: "POST",
            url: "<?php echo $ruta_db_superior ;?>"+"pantallas/busquedas/servidor_busqueda.php",		  		  
            data:{idbusqueda_componente:'<?php echo($documentos_respuesta);?>',iddocumento : "<?php echo $iddocumento;?>", actual_row:"0",limpio:"1",rows:"100"},
            success:function(html){
            	$("#panel_respuesta").html('');
            	if(jQuery.isEmptyObject(html)){
            		$("#panel_respuesta").append("<li class='alert' style='margin-bottom:3px;'>No hay documentos relacionados por funcionario</li>");
            	}else{
	                var objeto=jQuery.parseJSON(html);                    
	                $.each(objeto.rows,function(i,item){                          
                  	$("#panel_respuesta").append("<li>"+item.info+"</li>");        
	                });	               
               }
            	//iniciar_tooltip();
            }            
          });         
        }
        if(componente==='<?php echo($versiones_documento);?>'){
            tree5.deleteChildItems(0);
            tree5.setXMLAutoLoading("<?php echo($ruta_db_superior); ?>pantallas/versiones/test_versiones.php?iddoc=<?php echo($iddocumento); ?>");	
  	        tree5.loadXML("<?php echo($ruta_db_superior); ?>pantallas/versiones/test_versiones.php?iddoc=<?php echo($iddocumento); ?>");
        }
      }
    }
  });	
  function cargar_cantidades_documento(iddocumento){
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
      data: "librerias=pantallas/documento/librerias.php&funcion=contar_cantidad&parametros="+iddocumento+";<?php echo(usuario_actual("funcionario_codigo"));?>;todos&rand=<?php echo(rand());?>",
      success: function(html){                
        if(html){          
          var objeto=jQuery.parseJSON(html);                 
          $("#cantidad_anexos").html(objeto.adjuntos_documento);                       
          $("#cantidad_paginas").html(objeto.ordenar_pag);                                         
          $("#cantidad_notas").html(objeto.ver_notas);
          $("#cantidad_tareas").html(objeto.ver_tareas);
          $("#cantidad_versiones").html(objeto.ver_versiones);
          var cantidad_relacionados=parseInt(objeto.documentos_relacionados)+parseInt(<?php echo($origen["numcampos"]); ?>);
          $("#cantidad_documentos_relacionados").html(cantidad_relacionados);                       
        }
      }
    });           
    //iniciar_tooltip();
  } 
  $(".eliminar_pagina").removeClass('abrir_highslide');
  $(".eliminar_adjunto_menu").removeClass('abrir_highslide');
  $(".eliminar_adjunto_menu").attr('id',"adjuntos_documento");
  $(".adicionar_anexos").attr('id',"adjuntos_documento");
  var browserType;
  if (document.layers) {browserType = "nn4";}
  if (document.all) {browserType = "ie";}
  if (window.navigator.userAgent.toLowerCase().match("gecko")) {
     browserType= "gecko";
  }                 
  no_seleccionar=<?php echo((@$_REQUEST["no_seleccionar"]?"1":"0")); ?>;
  tree2=new dhtmlXTreeObject("tree_box","100%","<?php echo($alto_inicial);?>",0);      
  tree2.enableAutoTooltips(1);
  tree2.enableTreeImages("false");
  tree2.enableTreeLines("true");
  tree2.enableTextSigns("true");
  tree2.setOnLoadingStart(cargando);
  tree2.setOnLoadingEnd(fin_cargando);
  tree2.setOnClickHandler(onNodeSelect);
  tree2.loadXML("<?php echo($ruta_db_superior);?>formatos/arboles/test_formatos_documento2.php?id=<?php echo($iddoc2);?>");
  function redireccion_ruta(iframe_destino,ruta_enlace){
    if(iframe_destino==''){
      window.location=ruta_enlace;
    }
    else if(window.parent.frames[iframe_destino]!=undefined){
      window.parent.frames[iframe_destino].location=ruta_enlace;
    }
    else if(window.frames[iframe_destino]!=undefined){
      window.frames[iframe_destino].location=ruta_enlace;
    }
    else{
      window.location=ruta_enlace;
    }
  }    
  function onNodeSelect(nodeId){
  	var llave=0;
    llave=tree2.getParentId(nodeId);
    var datos=nodeId.split("-");
    if(datos[2][0]=="r"){
    	seleccion_accion('adicionar');
    }
    else{
    	cargar_cantidades_documento(datos[3]);
	    conexion="<?php echo($ruta_db_superior); ?>formatos/arboles/parsear_accion_arbol.php?id="+nodeId+"&accion=mostrar&llave="+llave+"&enlace_adicionar_formato=1";
	    redireccion_detalles(conexion);
    }
	}
	function seleccion_accion(accion,id){
    var nodeId=0;
    var llave=0;
    nodeId=tree2.getSelectedItemId();
    if(!nodeId){
      alert("Por Favor seleccione un documento del arbol");
      return;
    }
    llave=tree2.getParentId(nodeId);

    tree2.closeAllItems(tree2.getParentId(nodeId))
    tree2.openItem(nodeId);
    tree2.openItem(tree2.getParentId(nodeId));
    conexion="<?php echo($ruta_db_superior); ?>formatos/arboles/parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
    redireccion_detalles(conexion);
    }
    function redireccion_detalles(conexion){
        console.log(no_seleccionar);
        if(!no_seleccionar){
            window.parent.open(conexion,"detalles");    
        }
        else{
            no_seleccionar=0;
        }
    }
    function fin_cargando(){
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_arbol")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_arbol")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_arbol"]');
        document.poppedLayer.style.visibility = "hidden";
        tree2.selectItem(item,true,false);
        tree2.openAllItems(0); //esta linea permite que los arboles carguen abiertos totalmente
        
      }
    function cargando() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando_arbol")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando_arbol")');
      else
         document.poppedLayer =
             eval('document.layers["esperando_arbol"]');
      document.poppedLayer.style.visibility = "visible";

    }
    function actualizar_papa(nodeId){
        var papa=tree2.getParentId(nodeId);
        tree2.closeItem(papa);
        tree2.deleteItem(nodeId,true);
        //tree2.refreshItem(nodeId);
        tree2.findItem(papa);
      }
    $(".pagina_documento").live("click",function(){
      $(".alert-info").removeClass("alert-info");
      $(this).parent().addClass("alert-info");
      //parent.detalles.src="<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina="+$(this).attr("idpagina")+"&iddocumento="+$(this).attr("iddocumento");
      window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina="+$(this).attr("idpagina")+"&iddocumento="+$(this).attr("iddocumento"),"detalles");
    });
    $("#boton_documentos_relacionados").live("click",function(){
      window.open("<?php echo($ruta_db_superior);?>"+$(this).attr("enlace"),"detalles");
    });
    $(".ordenar_paginas").sortable({
      revert: true,
      update: function( event, ui ){
        var iddocumento=ui.item.find(".pagina_documento").attr("iddocumento");
        var lpaginas = new Array();
        $('.div_pagina').each(function(index,valor){
        	lpaginas.push($(this).attr('pagina'));        	
        });                      
        $.ajax({
            type:'POST',
            url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
            data: "librerias=pantallas/pagina/librerias.php&funcion=ordenar_paginas_documento&parametros="+iddocumento+";"+lpaginas,
            success: function(html){            	                
            	var numero = 1;
       			$('.div_pagina').each(function(index,valor){
        			//$(this).children('.npagina').html('P&aacute;gina '+numero);
        			$(this).children('.npagina').html('P&aacute;gina '+numero);
        			numero ++;
        		});  	
            }
        });                 
      }
    });
    $(".eliminar_pagina").live("click",function(){
        var valor=new Array();
        var enlace = '';        
        var iddocumento= $('.pagina_documento').attr('iddocumento');        
        $(".cb_pagina").each(function(){        	
            if($(this).attr("checked"))
                valor.push($(this).val());
        });        
        enlace = "pantallas/pagina/eliminar_pagina.php?iddocumento="+iddocumento+"&paginas="+valor;        
        if(valor.length !==0){
        	//iniciar_tooltip();
        	parent.hs.htmlExpand( this, {
						src: enlace,					
						objectType: 'iframe', 
						outlineType: 'rounded-white', 
						wrapperClassName: 'highslide-wrapper drag-header', 
						preserveContent: false,				
						width: 498,
						height: 215								 
					});
    		}
    });
    $(".eliminar_adjunto_menu").live("click",function(){    	
        var valor=new Array();
        if(!$("#listado_anexos").find(".cb_anexos:checked").length){
        	notificacion_saia("Por favor seleccione por lo menos un adjunto a ser eliminado","warning","",3000);
        }
        else{
	        var enlace = $(this).attr("enlace")+"&"+$("#listado_anexos").serialize();
	        //iniciar_tooltip();
	      	parent.hs.htmlExpand( this, {
						src: enlace,					
						objectType: 'iframe', 
						outlineType: 'rounded-white', 
						wrapperClassName: 'highslide-wrapper drag-header', 
						preserveContent: false,				
						width: 498,
						height: 215								 
					});  
				}  		   
    });
    $('.abrir_highslide').live("click",function(){
    		//iniciar_tooltip();
    		var enlace = $(this).attr('enlace');    		
				parent.hs.htmlExpand( this, {
					src: enlace,					
					objectType: 'iframe', 
					outlineType: 'rounded-white', 
					wrapperClassName: 'highslide-wrapper drag-header', 
					preserveContent: false,				
					width: 498,
					height: 215						 
				});				
		});
		
		$('.vinculado_respuesta').live('click',function(){
			<?php
			$formato_respuesta=busca_filtro_tabla("ruta_pantalla,nombre","pantalla A","A.nombre='responder_documento'","",$conn);
			?>
			window.open("<?php echo($ruta_db_superior.$formato_respuesta[0]["ruta_pantalla"]);?>/<?php echo($formato_respuesta[0]["nombre"]); ?>/adicionar_<?php echo($formato_respuesta[0]["nombre"]); ?>.php?iddocumento="+$(this).attr("iddocumento"),"detalles");
		});
		$(".tarea").live("click",function(){
			window.open("<?php echo($ruta_db_superior);?>"+$(this).attr("enlace"),"detalles");
		});
    <?php
	if(@$_REQUEST['click_clase']){
	?>
		$("#<?php echo($_REQUEST['click_clase']);?>").click();
	<?php			
	}
	?>
	
	tree5=new dhtmlXTreeObject("treeboxbox_tree5","","",0);
	tree5.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
	tree5.enableIEImageFix(true);
  
  tree5.setOnLoadingStart(cargando_version);
  tree5.setOnLoadingEnd(fin_cargando_version);
  tree5.enableSmartXMLParsing(true);
  tree5.setOnClickHandler(onNodeSelect_version);
    
  function fin_cargando_version() {
    if (browserType == "gecko" )
      document.poppedLayer = eval('document.getElementById("esperando_version")');
    else if (browserType == "ie")
      document.poppedLayer = eval('document.getElementById("esperando_version")');
    else
      document.poppedLayer = eval('document.layers["esperando_version"]');
    document.poppedLayer.style.display = "none";
    //tree5.openAllItems(0);
  }
  function cargando_version() {
    if (browserType == "gecko" )
      document.poppedLayer = eval('document.getElementById("esperando_version")');
    else if (browserType == "ie")
      document.poppedLayer = eval('document.getElementById("esperando_version")');
    else
      document.poppedLayer = eval('document.layers["esperando_version"]');
    document.poppedLayer.style.display = "";
  }
  function onNodeSelect_version(nodeId){
      var llave=0;
      llave=nodeId;
      var datos=llave.split("-");
      if(datos[1]){
          var conexion="<?php echo($ruta_db_superior); ?>pantallas/versiones/abrir_anexo.php?id="+llave;
          window.open(conexion,"detalles");
      }
  }
});
</script>