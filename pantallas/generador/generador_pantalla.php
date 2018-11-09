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
include_once($ruta_db_superior."pantallas/generador/librerias_pantalla.php");
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
if($_REQUEST["idformato"]){
  $idpantalla=$_REQUEST["idformato"];
  $datos_formato=busca_filtro_tabla("","formato","idformato=".$idpantalla,"",$conn);
}
?>
<html>
<head>
<title>Generador Pantallas SAIA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
echo (estilo_bootstrap());
echo (librerias_jquery("1.8.3"));
echo(librerias_html5());

$es_movil = ($_SESSION["tipo_dispositivo"]) == "movil";

$campos = busca_filtro_tabla("", "pantalla_componente B", "1=1", "", $conn);
$librerias_js = array();
for ($i = 0; $i < $campos["numcampos"]; $i++) {
    $librerias = explode(",", $campos[$i]["librerias"]);
    foreach ($librerias as $key => $libreria) {
        $extension = explode(".", $libreria);
        $cant = count($extension);
        if ($extension[$cant - 1] !== '') {
            switch ($extension[($cant - 1)]) {
                case "php":
                    include_once ($ruta_db_superior . $libreria);
                    break;
                case "js":
                    array_push($librerias_js, $libreria);
                    break;
                case "js@h":
                    $header = explode("@", $libreria);
                    echo ('<script type="text/javascript" src="' . $ruta_db_superior . $header[0] . '"></script>');
                    break;
                case "css":
                    $texto = '<link rel="stylesheet" type="text/css" href="' . $ruta_db_superior . $libreria . '"/>';
                    break;
                default:
                    $texto = ""; // retorna un vacio si no existe el tipo
                    break;
            }
            echo ($texto);
        }
    }
}

?>
		<link href="<?php echo($ruta_db_superior);?>pantallas/generador/css/generador_pantalla.css" rel="stylesheet"><style>
    .well{ margin-bottom: 3px; min-height: 11px; padding: 4px;}
    .progress{margin-bottom: 0px;}
    #tabs_formulario, #tabs_opciones{margin-bottom: 0px;}
    .tab-content {padding-top:0px;}
    </style>
    <script src="<?php echo $ruta_db_superior;?>js/jquery-migrate-1.4.1.js"></script>

	</head>
	<body>

			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span9">
						<div class="tabbable">
							<ul class="nav nav-tabs" id="tabs_formulario">
								<li>
									<a href="#datos_formulario-tab" data-toggle="tab">1-Datos</a>
								</li>
								<li id="generar_formulario_pantalla"  class="active">
									<a href="#formulario-tab" data-toggle="tab">2-Formularios</a>
								</li>
                				<li>
                				<a href="#librerias_formulario-tab" data-toggle="tab">3-Librerias</a>
								</li>
                				<li>
                				<a href="#pantalla_mostrar-tab" data-toggle="tab">4-Mostrar</a>
								</li>
                                <!-- li>
									<a href="#pantalla_listar-tab" data-toggle="tab">5-listar</a>
								</li -->
								<li>
									<a href="#encabezado_pie-tab" data-toggle="tab">5-Encabezado pie</a>
								</li>
								<!--li>
									<a href="#asignar_funciones-tab" data-toggle="tab">6-Asignar funciones</a>
								</li-->
								<li>
									<a href="#generar_formulario-tab" data-toggle="tab">7-Generar</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="formulario-tab">
									<form id="contenedor_saia" class="form-horizontal">
										<?php
echo(load_pantalla($idpantalla));
										?>
									</form>
								</div>
								<div class="tab-pane " id="datos_formulario-tab">
									<?php
include_once($ruta_db_superior.'pantallas/generador/datos_pantalla.php');?>
								</div>
                <div class="tab-pane" id="pantalla_mostrar-tab">
                  <form name="formulario_editor_mostrar" id="formulario_editor_mostrar" action="">
                  <textarea name="editor_mostrar" id="editor_mostrar" class="editor_tiny">
                  <?php
                    echo($datos_formato[0]["cuerpo"]);
                  ?>
                  </textarea>
                  </form>
				</div>
                <div class="tab-pane" id="pantalla_listar-tab">
                  <form name="formulario_editor_listar" id="formulario_editor_listar" action="">    <br />
                    <div id="tipo_listar">
                      Por favor seleccione un tipo de visualizaci&oacute;n:
									<select name="tipo_pantalla_busqueda"
										id="tipo_pantalla_busqueda">
										<option value="0">Por favor seleccione</option>
                      <?php
                    $tipo_listado = busca_filtro_tabla("", "pantalla_busqueda a", "estado=1", "etiqueta asc", $conn);
                    for ($i = 0; $i < $tipo_listado["numcampos"]; $i++) {
                        echo ('<option value="' . $tipo_listado[$i]["idpantalla_busqueda"] . '" nombre="' . $tipo_listado[$i]["nombre"] . '">' . $tipo_listado[$i]["etiqueta"].'</option>');
							}
					  ?>
                    </select>
									<?php if($tipo_listado["numcampos"]){ ?>
                      <div width="100%" id="frame_tipo_listado"></div>
                      <?php } ?>
                    </div>
                  </form>
				</div>
				<div class="tab-pane" id="librerias_formulario-tab">
					<div id="configurar_libreria_pantalla"></div>
					<div id="librerias_en_uso"></div>
				</div>

				<div class="tab-pane" id="encabezado_pie-tab">
					<br>
					<legend>Encabezado</legend><br>
					<select name="sel_encabezado" id="sel_encabezado">
						<option value="0">Por favor Seleccione</option>
						<?php
							$encabezados=busca_filtro_tabla("","encabezado_formato","1=1","etiqueta",$conn);
							$contenido_enc = array();
							$etiqueta_enc = array();
							$idencabezado = 0;
							$etiqueta_encabezado = "";
							for($i=0;$i<$encabezados["numcampos"];$i++) {
							    $contenido_enc[$encabezados[$i]["idencabezado_formato"]] = $encabezados[$i]["contenido"];
							    $etiqueta_enc[$encabezados[$i]["idencabezado_formato"]] = $encabezados[$i]["etiqueta"];
							    echo("<option value='".$encabezados[$i]["idencabezado_formato"]."'");
								if($encabezados[$i]["idencabezado_formato"] == $datos_formato[0]["encabezado"]) {
								    $idencabezado = $encabezados[$i]["idencabezado_formato"];
								    $etiqueta_encabezado = $encabezados[$i]["etiqueta"];
									echo(' selected="selected" ');
								}
								echo(">".$encabezados[$i]["etiqueta"]."</option>");
							}
						?>
					</select>
					<div class="btn btn-mini" id="limpiar_encabezado" title="Limpiar"><i class="icon-refresh"></i></div>
					<button type="button" class="btn btn-mini btn-primary guardar_encabezado" id="adicionar_encabezado">Adicionar</button>
					<button type="button" class="btn btn-mini btn-success guardar_encabezado" id="modificar_encabezado" disabled>Modificar</button>
					<button type="button" class="btn btn-mini btn-danger" <?php echo ($idencabezado ? "" : "disabled"); ?> id="eliminar_encabezado">Eliminar</button>

                  <form name="formulario_editor_encabezado" id="formulario_editor_encabezado" action="">
                  <input type="hidden" name="idencabezado" id="idencabezado" value="<?php echo $idencabezado;?>"></input>
                  <input type="hidden" name="accion_encab" id="accion_encabezado" value="1"></input>
                  <div id="div_etiqueta_encabezado">
                    <label for="etiqueta_encabezado">Etiqueta:
                  		<input type="text" id="etiqueta_encabezado" name="etiqueta_encabezado" value="<?php echo $etiqueta_encabezado;?>"></input>
					</label>
                  </div>
                  <textarea name="editor_encabezado" id="editor_encabezado" class="editor_tiny"> <?php
                  if($idencabezado) {
                    echo $contenido_enc[$idencabezado];
                  }
                  ?>
                  </textarea>
                  </form>
					<legend>Pie</legend><br>
					<select name="sel_pie_pagina" id="sel_pie_pagina">
						<option value="0">Por favor Seleccione</option>
						<?php
						    $idpie = 0;
						    $etiqueta_pie = "";
						    $pie_pagina=$encabezados; // No volver a consultar
							for($i=0; $i<$pie_pagina["numcampos"]; $i++) {
								echo("<option value='" . $pie_pagina[$i]["idencabezado_formato"] . "'");
								if($pie_pagina[$i]["idencabezado_formato"]==$datos_formato[0]["pie_pagina"]) {
								    $idpie = $pie_pagina[$i]["idencabezado_formato"];
								    $etiqueta_pie = $pie_pagina[$i]["etiqueta"];
								    echo(' selected="selected" ');
								}
								echo(">".$pie_pagina[$i]["etiqueta"]."</option>");
							}
						?>
					</select>

					<div class="btn btn-mini" id="limpiar_pie" title="Limpiar"><i class="icon-refresh"></i></div>
					<button type="button" class="btn btn-mini btn-primary guardar_pie disabled" id="adicionar_pie" disabled>Adicionar</button>
					<button type="button" class="btn btn-mini btn-success guardar_pie disabled" id="modificar_pie" disabled>Modificar</button>
					<button type="button" class="btn btn-mini btn-danger <?php echo ($idpie ? "" : "disabled"); ?>" id="eliminar_pie">Eliminar</button>

                  <form name="formulario_editor_pie" id="formulario_editor_pie" action="">
                  <input type="hidden" name="idpie" id="idpie" value="<?php echo $idpie;?>"></input>

                  <div id="div_etiqueta_pie">
                    <label for="etiqueta_pie">Etiqueta: </label>
                  	<input type="text" id="etiqueta_pie" name="etiqueta_pie" value="<?php echo $etiqueta_pie;?>"></input>
                  </div>
                  <textarea name="editor_pie" id="editor_pie" class="editor_tiny"> <?php
                  if($idpie) {
                      echo $contenido_enc[$idpie];
                  }
                  ?>
                  </textarea>
                  </form>
                  <script type="text/javascript">
					var encabezados = <?php echo json_encode($contenido_enc); ?>;
					var idencabezado = <?php echo $idencabezado;?>;
					var etiquetas = <?php echo json_encode($etiqueta_enc);?>;
                  </script>

				</div>


				<div class="tab-pane" id="asignar_funciones-tab">
					<?php include_once "asignar_funciones.php";?>
				</div>


				<div class="tab-pane" id="generar_formulario-tab">
					<div class="accordion" id="acordion_generar">
								  	<!-- div class="accordion-group">
									    <div class="accordion-heading">
                        <input type="checkbox" checked="true"class="pull-left check_genera" value="version">
									      <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_version_pantalla">
									      	Crear versi&oacute;n archivos
									      </a>
									    </div>
									    <div id="generar_version_pantalla" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div-->
										<!-- div class="accordion-group">
									    <div class="accordion-heading">
                        <input type="checkbox" checked="true"class="pull-left check_genera"  value="clase">
									      <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_clase">
									      	Crear /actualizar Clase
									      </a>
									    </div>
									    <div id="generar_clase" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div-->
										<div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="tabla">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_tabla">
									      	Crear /actualizar tablas
									      </a>
									    </div>
									    <div id="generar_tabla" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div>
										<!-- div class="accordion-group">
									    <div class="accordion-heading">
                        <input type="checkbox" checked="true"class="pull-left check_genera" value="librerias">
									      <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_pantalla_libreria">
									      	Crear /actualizar librerias
									      </a>
									    </div>
									    <div id="generar_pantalla_libreria" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div-->
										<div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="adicionar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_adicionar">
									      	Crear archivo adicionar
									      </a>
									    </div>
									    <div id="generar_adicionar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">
									      </div>
									    </div>
										</div>
										<div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="editar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_editar">
									      	Crear archivo editar
									      </a>
									    </div>
									    <div id="generar_editar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div>
										<!--  div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="eliminar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_eliminar">
									      	Crear archivo eliminar
									      </a>
									    </div>
									    <div id="generar_eliminar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div-->
										<div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="mostrar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_mostrar">
									      	Crear archivo mostrar
									      </a>
									    </div>
									    <div id="generar_mostrar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div>
										<div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="buscar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_buscar">
									      	Crear archivo buscar
									      </a>
									    </div>
									    <div id="generar_buscar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div>
										<!-- div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="listar">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_listar">
									      	Crear archivo listar
									      </a>
									    </div>
									    <div id="generar_listar" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">

									      </div>
									    </div>
										</div -->
                    					<!-- div class="accordion-group">
									    <div class="accordion-heading">
									      <input type="checkbox" checked="true"class="pull-left check_genera" value="modulo">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_generar" href="#generar_modulo">
									      	Generar m&oacute;dulo
									      </a>
									    </div>
									    <div id="generar_modulo" class="accordion-body collapse generador_pantalla">
									      <div class="accordion-inner">
									        Generar el m&oacute;dulo vinculado con la pantalla que direcciona a la b&uacute;squeda
									      </div>
									    </div>
										</div-->
								  </div>
                  <div >
                    <button id="generar_pantalla" class="btn btn-primary">Generar<span id="cargando_generar_pantalla"></span></button>
                  </div>
								</div>
							</div>
						</div>
					</div>
					<div class="span3">
						<div class="tabbable">
							<ul class="nav nav-tabs" id="tabs_opciones">
								<li class="active">
									<a href="#componentes-tab" data-toggle="tab">I</a>
								</li>
								<li>
									<a href="#archivos-tab" data-toggle="tab">F</a>
								</li>
                <!--li>
									<a href="#includes-tab" data-toggle="tab">S</a>
								</li-->
								<li>
									<a href="#acciones-tab" data-toggle="tab">A</a>
								</li>
							</ul>
							<div class="tab-content" id="contenidos_componentes">
								<div class="tab-pane active" id="componentes-tab"  style="overflow:auto;">
								</div>
								<div class="tab-pane" id="archivos-tab">
                  <input type="hidden" name="ruta_archivo_actual" id="ruta_archivo_actual" value="">
									<!--div class="form-actions" id="acciones_archivo-tab">

								    <button type="button" name="guardar_archivo_actual" class="btn btn-primary btn-mini" id="guardar_archivo_actual" value="">Guardar</button-->
								    <!--button type="button" name="nuevo_archivo" class="btn btn-mini" id="nuevo_archivo" value="">Nuevo</button>
                    <button type="button" name="seleccionar_archivo" class="btn btn-mini" id="seleccionar_archivo" value="">Seleccionar</button>
								    <div class="pull-right" id="cargando_guardar_archivo"></div>
									</div-->
									<div id="esperando_archivo">
    								<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
    							</div>
    							<div id="treeboxbox_tree3" class="arbol_saia"></div>
								</div>
								<div class="tab-pane" id="librerias-tab">
								</div>
                <!--div class="tab-pane" id="includes-tab"  style="overflow:auto;">
								</div-->
								<div class="tab-pane" id="acciones-tab">
								    <input type="hidden" name="idpantalla_funcion_exe" id="idpantalla_funcion_exe">
								    <input type="hidden" name="nombre_funcion_insertar" id="nombre_funcion_insertar">
                  <div id="esperando_acciones">
    								<img src="<?php echo($ruta_db_superior);?>imagenes/cargando.gif">
    							</div>
                  <div id="actualizar_cuerpo_formato" class="btn btn-mini btn-success">Actualizar</div>
                  <div id="treeboxbox_tree4" style="height:90%;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

	</body>
</html>
<?php
echo(librerias_highslide());
echo(librerias_UI());
echo(librerias_bootstrap());
echo(librerias_notificaciones());
echo(librerias_validar_formulario());
echo(librerias_arboles());
echo(librerias_tooltips());
//echo(librerias_tiny());
$cant_js=count($librerias_js);
for($i=0;$i<$cant_js;$i++){
	if($librerias_js[$i])
		echo('<script type="text/javascript" src="'.$ruta_db_superior.$librerias_js[$i].'"></script>');
}
?>
<!--script src="<?php echo($ruta_db_superior)?>pantallas/generador/editor/ace.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo($ruta_db_superior)?>pantallas/generador/editor/ext-language_tools.js"></script-->
<script type="text/javascript">
$(document).ready(function() {
    campo_id_foco="";
    var alto=$(window).height();
    var ancho=$(window).width();
    if(ancho < 600) {
    	top.noty({text: 'Por favor rote el dispositivo',type: 'warning',layout: 'topCenter',timeout:8000});
    }
    var browserType;
    var tab_acciones=false;
    iniciar_tooltip();
    if (document.layers) {browserType = "nn4"}
    if (document.all) {browserType = "ie"}
    if (window.navigator.userAgent.toLowerCase().match("gecko")) {
       browserType= "gecko"
    }
    $(".nav li").click(function(){
      if ($(this).hasClass('disabled')){
        return false;
      }
    });

	var formulario_encabezado = $("#formulario_editor_encabezado");
	formulario_encabezado.validate({
        rules: {
          "etiqueta_encabezado": {
              required: true,
              minlength:1
          },
          "editor_encabezado": {
              required: true,
              minlength:1
          }
        }
	});
	var formulario_pie = $("#formulario_editor_pie");
	formulario_pie.validate({
        rules: {
          "etiqueta_pie": {
              required: true,
              minlength:1
          },
          "editor_pie": {
              required: true,
              minlength:1
          }
        }
  });

$(document).on("change","#sel_encabezado",function(){
  	var seleccionado = this.value;
  	var editor = tinymce.get('editor_encabezado');

  	$("#idencabezado").val(seleccionado);
  	if(seleccionado > 0) {
        $("#eliminar_encabezado").removeClass('disabled');
        $("#eliminar_encabezado").prop('disabled', false);
      	editor.setContent(encabezados[seleccionado]);
      	$("#etiqueta_encabezado").val(etiquetas[seleccionado]);
  	} else {
        $("#eliminar_encabezado").addClass('disabled');
        $("#eliminar_encabezado").prop('disabled', true);
      	editor.setContent("");
      	$("#etiqueta_encabezado").val("");
  	}

	 $.ajax({
         type:'POST',
         url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
         data: "librerias=pantallas/generador/librerias_formato.php&funcion=actualizar_encabezado_pie&parametros="+$("#idformato").val()+";encabezado;"+seleccionado+";1&rand="+Math.round(Math.random()*100000),
         success: function(html){
           if(html){
             var objeto=jQuery.parseJSON(html);
             if(objeto.exito){
            	 notificacion_saia("Encabezado actualizado","success","",3000);
             }
         	}
         }
     	});

});

$(document).on("change","#sel_pie_pagina",function() {
  	var seleccionado = this.value;
  	var editor = tinymce.get('editor_pie');

  	if(seleccionado > 0) {
        $("#eliminar_pie").removeClass('disabled');
        $("#eliminar_pie").prop('disabled', false);
      	editor.setContent(encabezados[seleccionado]);
      	$("#etiqueta_pie").val(etiquetas[seleccionado]);
  	} else {
        $("#eliminar_pie").addClass('disabled');
        $("#eliminar_pie").prop('disabled', true);
      	editor.setContent("");
      	$("#etiqueta_pie").val(etiquetas[seleccionado]);
  	}

	 $.ajax({
        type:'POST',
        url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
        data: "librerias=pantallas/generador/librerias_formato.php&funcion=actualizar_encabezado_pie&parametros="+$("#idformato").val()+";pie;"+seleccionado+";1&rand="+Math.round(Math.random()*100000),
        success: function(html) {
        	if(html) {
            	var objeto=jQuery.parseJSON(html);
            	if(objeto.exito) {
            		notificacion_saia("Pie pagina actualizado","success","",3000);
            	}
        	}
        }
    });
});

$(document).on("click", ".guardar_encabezado", function(e) {		
	if(formulario_encabezado.valid()){

	  	var editor = tinymce.get('editor_encabezado');
		var etiqueta = $("#etiqueta_encabezado").val();
		var contenido = editor.getContent();
		var id = $("#idencabezado").val();

		var datos = {
			ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
			idencabezado : id,
			rand: Math.round(Math.random()*100000),
			etiqueta : etiqueta,
			contenido : contenido,
			tipo_retorno : 1
		};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
            		$("#sel_encabezado").empty();
            		encabezados = [];
            		$("#sel_encabezado").append('<option value="0">Por favor seleccione</option>');
            	    $.each(data.datos, function() {
            	    	encabezados[this.idencabezado] = this.contenido;
            	    	etiquetas[this.idencabezado] = this.etiqueta;
            	        $("#sel_encabezado").append('<option value="'+ this.idencabezado +'">'+ this.etiqueta +'</option>');
            	    });
            	    $("#adicionar_encabezado").addClass("disabled");
                    $("#adicionar_encabezado").prop('disabled', true);
            	    $("#modificar_encabezado").addClass("disabled");
                    $("#modificar_encabezado").prop('disabled', true);
            		notificacion_saia("Encabezado pagina guardado","success","",3000);
            	}
            }
        });
	}
});

$(document).on("click", "#eliminar_encabezado", function(e) {
	var id = $("#idencabezado").val();
	if(id && id > 0){

	  	var editor = tinymce.get('editor_encabezado');
		var etiqueta = "";
		var contenido = "";

		var datos = {
			ejecutar_libreria_encabezado: "eliminar_contenido_encabezado",
			idencabezado : id,
			rand: Math.round(Math.random()*100000),
			etiqueta : etiqueta,
			contenido : contenido,
			tipo_retorno : 1
		};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
            		$("#sel_encabezado").empty();
            		encabezados = [];
            		$("#sel_encabezado").append('<option value="0">Por favor seleccione</option>');
            	    $.each(data.datos, function() {
            	    	encabezados[this.idencabezado] = this.contenido;
            	    	etiquetas[this.idencabezado] = this.etiqueta;
            	        $("#sel_encabezado").append('<option value="'+ this.idencabezado +'">'+ this.etiqueta +'</option>');
            	    });
            	    $("#adicionar_encabezado").addClass("disabled");
                    $("#adicionar_encabezado").prop('disabled', true);
            	    $("#modificar_encabezado").addClass("disabled");
                    $("#modificar_encabezado").prop('disabled', true);
            		notificacion_saia("Encabezado pagina eliminado","success","",3000);

            		editor.setContent("");
            		$("#etiqueta_encabezado").val("");
            		$("#idencabezado").val("0");
            	}
            }
        });
	}
});



$(document).on("click", "#limpiar_encabezado", function(e) {
	//$("#div_etiqueta_encabezado").show();
	$("#sel_encabezado option[selected]").removeAttr("selected");
    $("#idencabezado").val("0");
    $("#eliminar_encabezado").addClass('disabled');
    $("#eliminar_encabezado").prop('disabled', true);
    $("#etiqueta_encabezado").val("");

  	var editor = tinymce.get('editor_encabezado');
  	editor.setContent("");

});

$(document).on("click", ".guardar_pie", function(e) {
	if(formulario_pie.valid()){

	  	var editor = tinymce.get('editor_pie');
		var etiqueta = $("#etiqueta_pie").val();
		var contenido = editor.getContent();
		var id = $("#idpie").val();

		var datos = {
			ejecutar_libreria_encabezado: "actualizar_contenido_encabezado",
			idencabezado : id,
			rand: Math.round(Math.random()*100000),
			etiqueta : etiqueta,
			contenido : contenido,
			tipo_retorno : 1
		};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
            		$("#sel_pie_pagina").empty();
            		encabezados = [];
            		$("#sel_pie_pagina").append('<option value="0">Por favor seleccione</option>');
            	    $.each(data.datos, function() {
            	    	encabezados[this.idencabezado] = this.contenido;
            	    	etiquetas[this.idencabezado] = this.etiqueta;
            	        $("#sel_pie_pagina").append('<option value="'+ this.idencabezado +'">'+ this.etiqueta +'</option>');
            	    });
            	    $("#adicionar_pie").addClass("disabled");
            	    $("#adicionar_pie").prop('disabled', true);
            	    $("#modificar_pie").addClass("disabled");
            	    $("#modificar_pie").prop('disabled', true);
            		notificacion_saia("Pie pagina guardado","success","",3000);
            	}
            }
        });
	}
});

$(document).on("click", "#eliminar_pie", function(e) {
	var id = $("#idpie").val();

	if(id && id > 0) {

	  	var editor = tinymce.get('editor_pie');
		var etiqueta = "";
		var contenido = "";

		var datos = {
			ejecutar_libreria_encabezado: "eliminar_contenido_encabezado",
			idencabezado : id,
			rand: Math.round(Math.random()*100000),
			etiqueta : etiqueta,
			contenido : contenido,
			tipo_retorno : 1
		};
		$.ajax({
            type:'POST',
            dataType: "json",
            url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
            data: datos,
            success: function(data) {
                //console.log(data);
            	if(data.exito == 1) {
            		$("#sel_pie_pagina").empty();
            		encabezados = [];
            		$("#sel_pie_pagina").append('<option value="0">Por favor seleccione</option>');
            	    $.each(data.datos, function() {
            	    	encabezados[this.idencabezado] = this.contenido;
            	    	etiquetas[this.idencabezado] = this.etiqueta;
            	        $("#sel_pie_pagina").append('<option value="'+ this.idencabezado +'">'+ this.etiqueta +'</option>');
            	    });
            	    $("#adicionar_pie").addClass("disabled");
            	    $("#adicionar_pie").prop('disabled', true);
            	    $("#modificar_pie").addClass("disabled");
            	    $("#modificar_pie").prop('disabled', true);
            		notificacion_saia("Pie pagina eliminado","success","",3000);

            		$("#etiqueta_pie").val("");
            		editor.setContent("");
            		$("#idpie").val("0");

            	}
            }
        });
	}
});


$(document).on("click", "#limpiar_pie", function(e) {
	//$("#div_etiqueta_pie").show();
	$("#sel_pie_pagina option[selected]").removeAttr("selected");
    $("#idpie").val("0");
    $("#etiqueta_pie").val("");
    $("#eliminar_pie").addClass('disabled');
    $("#eliminar_pie").prop('disabled', true);

  	var editor = tinymce.get('editor_pie');
  	editor.setContent("");

});

$("#frame_tipo_listado").height(alto-125);
$(".tab-pane").height(alto-50);
$(".tab-content").height(alto-40);
$(".tab-content").css("padding-top",0);
tinymce.init({
 	selector:'.editor_tiny',
 	language:'es',
 	height:(alto-($(".mce-toolbar-grp").height()+$(".mce-menubar").height()+150)),
 	statusbar : false,
 	browser_spellcheck : true ,
 	plugins : 'advlist autolink lists charmap print preview pagebreak table code contextmenu responsivefilemanager image link',
 	toolbar:'bold italic underline strikethrough alignleft aligncenter alignright alignjustify | cut copy paste bullist numlist outdent indent blockquote undo redo | removeformat subscript superscript code jbimages responsivefilemanager image link ',
 	external_filemanager_path:"<?php echo(PROTOCOLO_CONEXION.RUTA_PDF);?>/tinymce/filemanager/",
  filemanager_title:"Administrador Imagenes" ,
  external_plugins: {
  		"filemanager" : "<?php echo(PROTOCOLO_CONEXION.RUTA_PDF);?>/tinymce/filemanager/plugin.min.js"
  },
  content_css : "<?php echo($ruta_db_superior);?>css/bootstrap/saia/css/bootstrap.css",
  extended_valid_elements :"div[*]",
  setup: function (ed) {
      ed.on('keyup', function (e) {
          cambios_editor(ed);
      });
      ed.on('change', function(e) {
          cambios_editor(ed);
      });
  }
});
$.ajax({
  type:'POST',
  url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
  async:false,
  data: "librerias=pantallas/generador/librerias_pantalla.php&funcion=load_componentes&parametros=1&idpantalla="+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000),
  success: function(html){
    if(html){
      var objeto=jQuery.parseJSON(html);
      if(objeto.exito){
        $("#componentes-tab").append(objeto.codigo_html);
      }
  	}
  }
});

$("#seleccionar_archivo").click(function(){
	ruta_archivo=$("#ruta_archivo_actual").val();
	if(ruta_archivo!=''){
    $.ajax({
      type:'POST',
      url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=incluir_librerias_pantalla',
      data:'ruta='+ruta_archivo+"&idpantalla_campos="+$("#idformato").val()+"&tipo_retorno=1&tipo_libreria=1",
      success: function(html){
        if(html){
        	var objeto=jQuery.parseJSON(html);
          if(objeto.exito){
          	notificacion_saia(objeto.mensaje,"success","",3000);
          }
          else{
            notificacion_saia(objeto.mensaje,"error","",3000);
          }
      	}
      }
  	});
  }
});
hs.graphicsDir = '<?php echo($ruta_db_superior);?>images/highslide/';
hs.dimmingOpacity = 0.75;
var form_builder = {
    el: null,
    method: "POST",
    action: "",
    delimeter: '=',
    setElement: function(el) {
        this.el = el;
    },
    getElement: function() {
        return this.el;
    },
    addComponent: function(component) {
        $.ajax({
          type:'POST',
          url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
          data: "librerias=pantallas/generador/librerias.php&funcion=adicionar_pantalla_campos&parametros="+$("#idformato").val()+";"+component.attr("idpantalla_componente")+";1&rand="+Math.round(Math.random()*100000),
          success: function(html){
            if(html){
              var objeto=jQuery.parseJSON(html);
              if(objeto.exito){
                $("#contenedor_saia").append(objeto.codigo_html);
              }
          	}
          }
      	});
    }
};
$(document).on('click', '.element > .close', function(e) {
    e.stopPropagation();
    hs.htmlExpand( null, {
      src: "eliminar_pantalla_campo.php?idpantalla_campos="+$(this).attr("idpantalla_campos"),
      objectType: 'iframe',
      outlineType: 'rounded-white',
      wrapperClassName: 'highslide-wrapper drag-header',
      preserveContent: false,
      width: 590,
      height: 300
    });
});
$(document).on('click', '.element', function() {
	hs.htmlExpand( null, {
    src: "<?php echo($ruta_db_superior);?>pantallas/generador/"+$(this).attr("nombre")+"/editar_componente.php?idpantalla_componente="+$(this).attr("idpantalla_componente")+"&idpantalla_campos="+$(this).attr("idpantalla_campo"),
    objectType: 'iframe',
    outlineType: 'rounded-white',
    wrapperClassName: 'highslide-wrapper drag-header',
    preserveContent: false,
    width: 590,
    height: 300
  });
});
$(document).on('click', '.element > input, .element > textarea, .element > label', function(e) {
    e.preventDefault();
});
$("#contenedor_saia").droppable({
    accept: '.component',
    hoverClass: 'content-hover',
    drop: function(e, ui) {
        form_builder.addComponent(ui.draggable);
    }
})
.sortable({
  placeholder: "element-placeholder",
  update: function(e, ui) {
    var orden=$("#contenedor_saia").sortable("toArray");
    $.ajax({
      type:'POST',
      url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
      data: "librerias=pantallas/generador/librerias_pantalla.php&funcion=ordenar_pantalla_campos&parametros="+orden+"&rand="+Math.round(Math.random()*100000),
      success: function(html){
        if(html){
      	}
      }
  	});
  }
})
.disableSelection();
//$("#configurar_pantalla_libreria").height(alto-$(".nav-tabs").height()-50);
$(".component").draggable({
	helper: function(e) {
    return $(this).clone().addClass('component-drag');
 	}
}).click(function(e){
	form_builder.addComponent($(this));
});
//ace.require("ace/ext/language_tools");
/*var editor = ace.edit("editor");
editor.setTheme("ace/theme/chrome");
editor.getSession().setMode("ace/mode/php");
editor.setOptions({
    enableBasicAutocompletion: true,
    enableLiveAutoComplete: true,
    enableSnippets: true
});
var snippetManager = ace.require("ace/snippets").snippetManager;
var config = ace.require("ace/config");
ace.config.loadModule("ace/snippets/php", function(m) {
if (m) {
  snippetManager.files.php = m;
  m.snippets = snippetManager.parseSnippetFile(m.snippetText);

  // or do this if you already have them parsed
  m.snippets.push({
    content: "buscar_filtro_tabla(${1:''},${2:''},${3:''},${4:''},${6:conn});",
    name: "busca_filtro_tabla",
    tabTrigger: "bft"
  });
  snippetManager.register(m.snippets, m.scope);
  }
});*/
tree3=new dhtmlXTreeObject("treeboxbox_tree3","100%",(alto-65),0);
tree3.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
tree3.enableTreeImages(false);
tree3.enableTextSigns(true);
tree3.setOnLoadingStart(cargando_serie);
tree3.setOnLoadingEnd(fin_cargando_serie);
tree3.setOnClickHandler(cargar_editor);
tree3.enableThreeStateCheckboxes(true);
/*function cargar_archivo(ruta_archivo){
	if(ruta_archivo!=''){
		$.ajax({
      type:'POST',
      url: '<?php echo($ruta_db_superior);?>pantallas/lib/convertir_archivo_a_texto.php',
      data:'ruta='+ruta_archivo+"&accion=cargar",
      success: function(html){
        if(html){
        	var objeto=jQuery.parseJSON(html);
          if(objeto.exito){
            var re = /(?:\.([^.]+))?$/;
            var extension=re.exec(ruta_archivo)[1];
            if(extension=='undefined'){
              extension='php';
            }
            else if(extension=="js"){
              extension="javascript";
            }
            editor.getSession().setMode("ace/mode/"+extension);
          	editor.setValue(objeto.codigo_html);
          	$("#acciones_archivo-tab").show();
          	$("#ruta_archivo_actual").val(ruta_archivo);
          	notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);

          }
      	}
      }
  	});
  }
} */
function cargar_editor(nodeId){
    var ruta_archivo=tree3.getUserData(nodeId,"myurl");
    if(ruta_archivo!=''){
    $("#configurar_libreria_pantalla").html("cargando...");
    $.ajax({
      type:'POST',
      url: 'configurar_pantalla_libreria.php',
      data:'ruta='+ruta_archivo+'&idformato='+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000),
      success: function(html){
        if(html){
          $("#ruta_archivo_actual").val(ruta_archivo);
          $("#configurar_libreria_pantalla").html(html);
          notificacion_saia("Archivo "+ruta_archivo+" cargado de forma exitosa","success","",3000);
      	}
      }
  	});
  }
  else{
  	tree3.openItem(nodeId);
  }
}
function fin_cargando_serie() {
  if (browserType == "gecko" )
     document.poppedLayer =
         eval('document.getElementById("esperando_archivo")');
  else if (browserType == "ie")
     document.poppedLayer =
        eval('document.getElementById("esperando_archivo")');
  else
     document.poppedLayer =
        eval('document.layers["esperando_archivo"]');
  document.poppedLayer.style.visibility = "hidden";
}
function cargando_serie() {
  if (browserType == "gecko" )
     document.poppedLayer =
         eval('document.getElementById("esperando_archivo")');
  else if (browserType == "ie")
     document.poppedLayer =
        eval('document.getElementById("esperando_archivo")');
  else
     document.poppedLayer =
         eval('document.layers["esperando_archivo"]');
  document.poppedLayer.style.visibility = "visible";
}
$('a[data-toggle="tab"]').on('show', function (e) {
	var id=e.target.toString().split("#");
  switch(id[1]){
  	case 'formulario-tab':
  	$.ajax({
      type:'POST',
      url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php?ejecutar_libreria_pantalla=echo_load_pantalla',
      data:'idformato='+$("#idformato").val(),
      success: function(html){
				//alert(html);
        if(html){
          $('#contenedor_saia').html(html);
          //iniciar_tooltip();
      	}
      }
    });
  	break;
  }
});
$('a[data-toggle="tab"]').on('shown', function (e) {
	var id=e.target.toString().split("#");
  switch(id[1]){
    case 'archivos-tab':
      $('#tabs_formulario a[href="#librerias_formulario-tab"]').tab('show');
    	tree3.deleteChildItems(0);
        tree3.loadXML("<?php echo($ruta_db_superior);?>pantallas/lib/test_archivos_carpetas.php?carpeta_inicial=formatos&extensiones_permitidas=php");
    break;
    case 'acciones-tab':
      if(tab_acciones==false){
        $('#tabs_formulario a[href="#pantalla_mostrar-tab"]').tab('show');
    	}
      tree4.deleteChildItems(0);
      tree4.enableSmartXMLParsing(true);
	    tree4.loadXML("<?php echo($ruta_db_superior);?>pantallas/generador/arbol_funciones_campos.php?pantalla_idpantalla="+$("#idformato").val()+"&extensiones_permitidas=php");
    break;
    case 'pantalla_mostrar-tab':
      tab_acciones=true;
      $('#tabs_opciones a[href="#acciones-tab"]').tab('show');
    break;
    case 'pantalla_listar-tab':
      tab_acciones=true;
      $('#tabs_opciones a[href="#acciones-tab"]').tab('show');
      tree4.deleteChildItems(0);
	    tree4.enableSmartXMLParsing(true);
	    tree4.loadXML("<?php echo($ruta_db_superior);?>pantallas/generador/arbol_funciones_campos.php?pantalla_idpantalla="+$("#idformato").val()+"&extensiones_permitidas=php");
	    <?php
	    $listado_busqueda=busca_filtro_tabla("","busqueda a","lower(nombre) like 'pantalla_".strtolower($pantalla_temp[0]["nombre"])."'","",$conn);
			if($listado_busqueda["numcampos"]){?>
				$("#tipo_pantalla_busqueda option[value=<?php echo($listado_busqueda[0]["tipo_busqueda"]);?>]").attr("selected",true);
				$("#tipo_pantalla_busqueda").change();
			<?php }
	    ?>
    break;
    case 'componentes-tab':
      tab_acciones=false;
      $('#tabs_formulario a[href="#formulario-tab"]').tab('show');
    break;
    case 'formulario-tab':
      tab_acciones=false;
      $('#tabs_opciones a[href="#componentes-tab"]').tab('show');
    break;
    case 'librerias_formulario-tab':
		//alert("librerias tab");
      tab_acciones=false;
      if(!$('#tabs_opciones a[href="#includes-tab"]').parent().hasClass("active")){
        $('#tabs_opciones a[href="#archivos-tab"]').tab('show');

				//cargar el listado en librerias_en_uso
				$.ajax({
	        type:'POST',
	        url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
	        data:'idformato='+$("#idformato").val(),
	        success: function(html){
	          if(html){
	          	var objeto=jQuery.parseJSON(html);
	            if(objeto.exito){
	              $('#librerias_en_uso').html(objeto.codigo_html);
	              //iniciar_tooltip();
	            }
	        	}
	        }
	    	});

      }
    break;
    case 'includes-tab':
		alert('includes tab');
      //$('#tabs_formulario a[href="#librerias_formulario-tab"]').tab('show');
      /*$.ajax({
        type:'POST',
        url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=listado_archivos_incluidos',
        data:'idpantalla_campos='+$("#idformato").val(),
        success: function(html){
          if(html){
          	var objeto=jQuery.parseJSON(html);
            if(objeto.exito){
              $('#includes-tab').html(objeto.codigo_html);
              iniciar_tooltip();
            }
        	}
        }
    	});*/
    break;
  }
});
$(".eliminar_libreria").live("click",function(){
  var include=$(this).attr("idformato_libreria");
  $(this).addClass("cargando");
  $(this).removeClass(".eliminar_libreria");
  /*$(this).removeClass(".eliminar_adjunto_menu");
  $('[rel=tooltip]').hide();*/
  $.ajax({
    type:'POST',
    url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias.php?ejecutar_pantalla_campo=eliminar_archivo_incluido',
    data:'idformato='+include+"&tipo_retorno=1",
    success: function(html){
      if(html){
      	var objeto=jQuery.parseJSON(html);
        if(objeto.exito){
          $("#libreria"+objeto.idformato).remove();
          notificacion_saia(objeto.mensaje,"success","",3000);

          if(objeto.exito_funciones){
               notificacion_saia(objeto.mensaje_funciones,"success","",4000);
          }

        }
        else{
          notificacion_saia(objeto.mensaje,"error","",3000);
        }
    	}
    }
	});
});
$(".configurar_libreria").live("click",function(){
  hs.htmlExpand( null, {
    src: "configurar_pantalla_libreria.php?idpantalla_libreria="+$(this).attr("idpantalla_libreria"),
    objectType: 'iframe',
    outlineType: 'rounded-white',
    wrapperClassName: 'highslide-wrapper drag-header',
    preserveContent: true,
    width: 497,
    height: 300
});
});

tree4=new dhtmlXTreeObject("treeboxbox_tree4","100%",(alto-50),0);
tree4.setImagePath("<?php echo($ruta_db_superior);?>imgs/");
tree4.enableTreeImages(false);
tree4.enableTextSigns(true);
tree4.enableAutoTooltips(true);
tree4.setOnLoadingStart(cargando_mostrar);
tree4.setOnLoadingEnd(fin_cargando_mostrar);
tree4.setOnClickHandler(insertar_mostrar);
tree4.enableThreeStateCheckboxes(true);
function fin_cargando_mostrar() {


  if (browserType == "gecko" )
     document.poppedLayer =
         eval('document.getElementById("esperando_acciones")');
  else if (browserType == "ie")
     document.poppedLayer =
        eval('document.getElementById("esperando_acciones")');
  else
     document.poppedLayer =
        eval('document.layers["esperando_acciones"]');
  document.poppedLayer.style.visibility = "hidden";
}
function cargando_mostrar() {
  if (browserType == "gecko" )
     document.poppedLayer =
         eval('document.getElementById("esperando_acciones")');
  else if (browserType == "ie")
     document.poppedLayer =
        eval('document.getElementById("esperando_acciones")');
  else
     document.poppedLayer =
         eval('document.layers["esperando_acciones"]');
  document.poppedLayer.style.visibility = "visible";
}
function insertar_mostrar(nodeId){
  var tipo=nodeId.split("_");

  if(tipo[0]==="func"){
	    tinymce.activeEditor.execCommand('mceInsertContent', false, tree4.getUserData(nodeId,"myfunc"));
	    $.ajax({
	    	  type:'POST',
	    	  url: "<?php echo($ruta_db_superior);?>pantallas/lib/llamado_ajax.php",
	    	  data: "librerias=pantallas/generador/librerias_formato.php&funcion=vincular_funciones_formato&parametros="+tree4.getUserData(nodeId,"mylib_id")+";"+tree4.getUserData(nodeId,"myfunc")+"&idformato="+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000),
	    	  success: function(html){
	    	    if(html){
	    	      var objeto=jQuery.parseJSON(html);
	    	      if(objeto.exito){
	    	    	  notificacion_saia(objeto.mensaje,"success","",3500);
	    	      }
	    	      else{
	    	    	  notificacion_saia(objeto.mensaje,"error","",3500);
	    	  	  }
	    	  	}
	    	  }
	    	});
  }
  else if(tipo[0]==="campo"){
    	tinymce.activeEditor.execCommand('mceInsertContent', false, tree4.getUserData(nodeId,"mycampo"));
  }
  else if(tipo[0]==="esquema"){
		notificacion_saia("Cargando","alert","",3000);
		$.ajax({
			type:'POST',
			url: '<?php echo($ruta_db_superior);?>'+tree4.getUserData(nodeId,"myesquema"),
			success: function(html){
				if(html){
					cerrar_notificaciones_saia();
					tinymce.activeEditor.execCommand('mceInsertContent', false, html);
				}
			}
		});
  }
  else{
    tree4.openItem(nodeId);
  }
  //alert(texto):
}

$('#idpantalla_funcion_exe').live("change",function(){
    var idpantalla_funcion_exe=$('#idpantalla_funcion_exe').val();
    var nombre_funcion_insertar=$('#nombre_funcion_insertar').val();
    nombre_funcion_insertar='{*'+nombre_funcion_insertar+'@'+idpantalla_funcion_exe+'*}';


  	if($('#pantalla_listar-tab').hasClass("active")){
  		if($("#tipo_pantalla_busqueda").val()==1){
  			tinymce.activeEditor.execCommand('mceInsertContent', false, nombre_funcion_insertar);
  		}
  		else if($("#tipo_pantalla_busqueda").val()==2){
  			valor=nombre_funcion_insertar;
  			var campo_interno_reporte=$("#"+campo_id_foco).val($("#"+campo_id_foco).val()+valor);
  			$("#"+campo_id_foco).focus();
  		}
  	}
  	else{
   		tinymce.activeEditor.execCommand('mceInsertContent', false, nombre_funcion_insertar);
   	}



});


$("#generar_pantalla").live("click",function(){
  $(".generador_pantalla").find(".accordion-inner").html("");
  $(".generador_pantalla").removeClass("alert-success");
  $(".generador_pantalla").removeClass("alert-error");
  //generar_archivos_ignorados();
  $(".generador_pantalla").each(function(index,val){
    if($(this).prev().children(":checkbox").is(':checked')){
      generar_pantalla(this.id);
    }
  });
});
$(".eliminar_campos_tabla_pantalla").live("click",function(){
	alert($(this).attr("tabla")+"--"+$(this).attr("idpantalla"));
});
$("#tipo_pantalla_busqueda").change(function(){
	$("#frame_tipo_listado").html("<img src='<?php echo($ruta_db_superior); ?>imagenes/cargando.gif'>");
	if($(this).val()!=0){
  	$("#frame_tipo_listado").load("<?php echo($ruta_db_superior); ?>pantallas/generador/esquemas_busqueda_saia/"+$("#tipo_pantalla_busqueda option:selected").attr("nombre")+".php","tipo_busqueda="+$(this).val()+"&idpantalla=<?php echo($_REQUEST['idformato']);?>");
 	}
 	else{
 		$("#frame_tipo_listado").html("");
 	}
});

function cambios_editor(editor){
	//console.log(editor);
	if(editor.id == "editor_encabezado") {
		var modo = $("#idencabezado").val();
		if(modo == "" || modo == "0") {
    		$("#adicionar_encabezado").removeClass("disabled");
    	    $("#adicionar_encabezado").prop('disabled', false);
		} else {
    		$("#modificar_encabezado").removeClass("disabled");
    	    $("#modificar_encabezado").prop('disabled', false);
		}
	} else if(editor.id == "editor_pie") {
		var modo = $("#idpie").val();
		if(modo == "" || modo == "0") {
    		$("#adicionar_pie").removeClass("disabled");
    	    $("#adicionar_pie").prop('disabled', false);
		} else {
    		$("#modificar_pie").removeClass("disabled");
    	    $("#modificar_pie").prop('disabled', false);
		}
	} else {
    	$("#actualizar_cuerpo_formato").removeClass("btn-success");
    	$("#actualizar_cuerpo_formato").addClass("btn-info");
	}
}

$(document).on("click","#actualizar_cuerpo_formato",function(){
	 $.ajax({
   	  type:'POST',
   	  url: "<?php echo($ruta_db_superior);?>pantallas/generador/librerias_formato.php",
   	  data: "ejecutar_libreria_formato=actualizar_cuerpo_formato&contenido="+tinyMCE.editors["editor_mostrar"].getContent()+"&idformato="+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000),
   	  success: function(html){
   	   	  console.log(html);
   	    if(html){
   	      var objeto=jQuery.parseJSON(html);
   	      if(objeto.exito){
   	    	  notificacion_saia(objeto.mensaje,"success","",3500);
   	      }
   	      else{
   	    	  notificacion_saia(objeto.mensaje,"error","",3500);
   	  	  }
   	  	}
   	  }
   	});
});
function generar_pantalla(nombre_accion){
	$("#cargando_generar_pantalla").html("<img src='<?php echo($ruta_db_superior); ?>imagenes/cargando.gif' class='pull-left'>");
	var ruta_generar='formatos/generar_formato.php';
	accion=nombre_accion.replace("generar_","");
	  $.ajax({
	    type:'POST',
	    url: '<?php echo($ruta_db_superior);?>'+ruta_generar,
	    data:'idformato='+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000)+'&crea='+accion+"&llamado_ajax=1",
	    success: function(html){
	      if(html){
	      	var objeto=jQuery.parseJSON(html);
	        if(objeto.exito==1){
	          $("#"+nombre_accion).prev().removeClass("alert-error");
	          $("#"+nombre_accion).prev().addClass("alert-success");
	          $("#"+nombre_accion).html("");
	          notificacion_saia(objeto.mensaje,"success","",3500);
	          if(typeof(objeto.descripcion_error)!=="undefined"){
	        		$("#"+nombre_accion).html(objeto.descripcion_error);
	        		$("#"+nombre_accion).collapse('show');
	        	}
	        }
	        else{
	        	$("#"+nombre_accion).prev().addClass("alert-error");
	        	notificacion_saia(objeto.mensaje,"error","",9500);
	        	if(typeof(objeto.descripcion_error)!=="undefined"){
	        		$("#"+nombre_accion).html(objeto.descripcion_error);
	        		$("#"+nombre_accion).collapse('show');
	        	}
	        }
	    	}
	    	$("#cargando_generar_pantalla").html("");
	    }
		});
	}
});//Fin Document ready
/*
function generar_archivos_ignorados(){
  $.ajax({
    type:'POST',
    url: '<?php echo($ruta_db_superior);?>pantallas/generador/librerias_pantalla.php',
    data:'ejecutar_libreria_pantalla=generar_archivos_ignorados&idpantalla='+$("#idformato").val()+"&rand="+Math.round(Math.random()*100000)
	});
}*/

</script>
