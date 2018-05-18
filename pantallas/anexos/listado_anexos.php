<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}    
include_once($ruta_db_superior."db.php"); 
die("---------");
include_once($ruta_db_superior."librerias_saia.php");
$datos_componente=$_REQUEST["idbusqueda_componente"];
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);
?>    
<link rel="stylesheet" type="text/css" media="screen" href="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_css.css" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width">

<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="css/jquery.fileupload-ui.css">
<?php 
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap()); 
if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
  array_walk($librerias,"incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}
?>      
<style>
.well{ margin-bottom: 3px; min-height: 11px; padding: 10px;}.alert{ margin-bottom: 3px; padding: 10px;}  body{ font-size:12px; line-height:100%; margin-top:50px}.navbar-fixed-top, .navbar-fixed-bottom{ position: fixed;} .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top{margin-right: 0px; margin-left: 0px;}
.texto-azul{ color:#3176c8}
</style>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">                           
    <ul class="nav pull-left">                                         
      <li>          
      <div class="btn-group">            
        <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Seleccionados &nbsp;
          <span class="caret">
          </span>&nbsp;
        </button>            
        <ul class="dropdown-menu" id='listado_seleccionados'>              
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
        <button type="button" class="btn btn-mini " id="loadmoreajaxloader" >M&aacute;s Resultados
        </button>                 
      </div>
      <!-- /btn-group -->                   
      </li>
      <!--li>
        <button class="btn btn-mini tooltip_saia" titulo="Guardar" data-toggle="modal" href="#guarda_consulta" ><i class="icon-camera"></i></button>
      </li-->       
    </ul>      
  </div>
</div>
<br>
<div class="container">
    <!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="controlador_upload.php" method="POST" enctype="multipart/form-data">
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="span7">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="icon-plus icon-white"></i>
                    <span>Add files...</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start upload</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel upload</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>        
</div>
<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
<script src="js/jquery.ui.widget.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="js/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="js/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="js/jquery.fileupload-ui.js"></script>
<!-- The localization script -->
<script src="js/locale.js"></script>
<!-- The main application script -->
<script src="js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->
<br>
<div class="panel-body" style="margin-top:0px" id="panel-body">      
  <div id="resultado_busqueda_principal<?php echo($datos_componente);?>">  
    <div id="resultado_busqueda<?php echo($datos_componente);?>">  
    </div>                                                         
    <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">  
    <input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">  
    <input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">  
    <input type="hidden" value="0" name="fila_actual" id="fila_actual">
    <input type="hidden" value="" name="variable_busqueda" id="variable_busqueda">    
    <input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">  
<script>  
  <!--               
  var alto_inicial=$(window).height(); 
  var carga_final=false;
  var contador=1;
  var forma_cargar=<?php echo($datos_busqueda[0]["cargar"]);?>;
  $(window).scroll(function(){
    if($(window).scrollTop() == $(document).height() - $(window).height()){
      cargar_datos_scroll();
    }
  });
  while(($(".panel-body").height()<alto_inicial) && !carga_final){
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
      url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda.php",
      data: "idbusqueda_componente=<?php echo($datos_componente);?>&page="+$("#busqueda_pagina").val()+"&rows="+$("#busqueda_registros").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&documento_seleccionado=271",
      success: function(html){
        if(html){
          var objeto=jQuery.parseJSON(html); 
          $("#busqueda_pagina").val(objeto.page);
          $("#busqueda_total_paginas").val(objeto.total);
          //$("#busqueda_sql").html(objeto.sql);
          $("#fila_actual").val(objeto.actual_row);          
          $.each(objeto.rows,function(i,item){    
            if(forma_cargar==1)         
              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").prepend(item.info);
            else{
              $("#resultado_busqueda_principal<?php echo($datos_componente);?>").append(item.info);   
            }  
          });
          iniciar_tooltip();                         
          if(objeto.actual_row>=objeto.records){
            finalizar_carga_datos();
          }
          else{
            $('#loadmoreajaxloader').html("M&aacute;s Resultados ("+objeto.actual_row+" de "+objeto.records+")");
            
          }
          if($(".panel-body").height()<alto_inicial){
            cargar_datos_scroll();
          }                
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
    -->
  </script>  
  </div>  
</div>                  
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
