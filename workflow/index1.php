<?
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
if (!isset($_SESSION)) {
    session_start();
    $_SESSION["userId"]=3;
}
require_once($ruta_db_superior.'workflow/common/delegate.php');
require_once($ruta_db_superior.'workflow/common/rememberme.php');


$delegate = new Delegate();

$loggedUser = $delegate->userGetById(3);

//start diagram guardian
if(is_numeric($_REQUEST['diagramId'])){
    if(is_object($loggedUser)){
        $userdiagram = $delegate->userdiagramGetByIds($loggedUser->id, $_REQUEST['diagramId']);
        if(!is_object($userdiagram)){
            
            print "Not allocated to this diagram";
            exit();
        }
    }
    else{
        print "Not allowed to see this diagram";
        exit();

    }    
}
//end diagram guardian
?>
<!DOCTYPE html>
<html>
    <!--Copyright 2010 Scriptoid s.r.l-->
    <head>
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo($ruta_db_superior."workflow/");?>assets/css/style.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo($ruta_db_superior."workflow/");?>assets/css/minimap.css" />

        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/canvasprops.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/style.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/primitives.js?<?php  echo time()?>"></script>
		<script type="text/javascript" src="./lib/ImageFrame.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/matrix.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/util.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/key.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/groups.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/stack.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/connections.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/connectionManagers.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/handles.js?<?php  echo time()?>"></script>
        
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/builder.js?<?php  echo time()?>"></script>        
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/text.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/log.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/text.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/sets/basic.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/sets/secondary.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/sets/experimental.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/browserReady.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/main.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/minimap.js?<?php  echo time()?>"></script>

        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/History.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/CanvasResizeCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/ConnectCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/ConnectorHandleCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/CreateCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/DeleteCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/GroupCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/MatrixCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/PropertyCommand.js?<?php  echo time()?>"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>lib/commands/ZOrderCommand.js?<?php  echo time()?>"></script>

        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>assets/javascript/json2.js"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>assets/javascript/jquery-1.4.2.min.js"></script>
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>assets/javascript/jquery.simplemodal-1.3.5.min.js"></script>

        
        <script type="text/javascript" src="<?php echo($ruta_db_superior."workflow/");?>assets/javascript/colorPicker_new.js"></script>
        <link rel="stylesheet" media="screen" type="text/css" href="<?php echo($ruta_db_superior."workflow/");?>assets/css/colorPicker_new.css" />        
         <script src="<?php echo($ruta_db_superior."workflow/");?>assets/javascript/excanvas.js"></script>


        
        <script type="text/javascript">	
			var veces = 0;
			var contador = 0;
			var idfigura;
			<?php 
        if($_REQUEST['diagramId'] != 0){  
          $_SESSION['id_diagramaxxx'] = $_REQUEST['diagramId'];
        }
      ?>			
/*
<Clase>
<Nombre>generarfigura
<Parametros>
<Responsabilidades> Esta funcion es la que se utiliza para que cuando cargue el body llame a dos ellipses como lo vemos abajo
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/			
			function generarfigura()
			{
				//function SimularClick(idObjete){
				//javascript:createFigure(figure_SimpleImage);
				/*
				var nouEvent = document.createEvent("MouseEvents");
				nouEvent.initMouseEvent("click", true, true, window,300, 400, 0, 0, 0, false, false, false, false, 0, null);
				
				
				var objecte = document.getElementById(idObjete);
				var canceled = !objecte.dispatchEvent(nouEvent);
				}*/

				//onMouseDown();
				//javascript:createFigure(figure_Rectangle);
				
//Cuando se realiza este llamado el va a   lib/main.js function createFigure(a) y alli hace el resto de cosas las cuales estan
//explicadas.
				javascript:createFigure(figure_Ellipse);
				javascript:createFigure(figure_Ellipse);
			}
			function guardar_figura(){
			   <?php if($_REQUEST['diagramId'] == ""){ ?>
			       alert("Por favor, guardar el diagrama actual");
			       return false;
         <?php } ?>
      }
			function formulario_paso(id_figura,evento)
			{
				idfigura = id_figura;
				contador++;
				if(contador == 1)
				{
					$("#formulario_figura").css("left",evento.pageX - 200);
					$("#formulario_figura").css("top",evento.pageY + 20);
					//$("#formulario_figura").css("display","block");
					
					$("#formulario_figura").show("fast");
				}
				if(contador == 2)
				{
					$("#formulario_figura").hide("fast");
					contador = 0;
				}
				
			}
			
			/*
<Clase>
<Nombre>validar_1
<Parametros>
<Responsabilidades>Validacion de que el diagrama si se halla guardado y del formulario de cada figura.
En esta funcion se valida el formulario de cada figura, algo importante de aqui es que tambien se valida que el diagrama se halla guardado.
si el diagrama no ha sido guardado no se puede enviar el formulario.
Otra cosa importante de aqui es que en esa misma funcion se envian los datos a funcion.php para que alli se procesen y se inserten o se actualicen
sea cualquiera de los dos casos. 
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>

*/
			
			function validar_1()
			{
				var id_diagrama = "";
				 <? if( is_numeric($_REQUEST['diagramId'])){?>
                id_diagrama = <?php  echo $_REQUEST['diagramId']?>;
                <? }?>
				if(id_diagrama == ""){
					alert('Debe guardar primero el diagrama');
					return false;
				}
				<? $_SESSION['id_diagrama'] = $_REQUEST['diagramId']; ?>
				var formulario = document.formulario1;
				//aqui capturo la informacion que hay en cada campo
				var descripcion = formulario.descripcion.value;
				var responsable = formulario.responsable.value;
				var paso = formulario.paso.value;
				var idfigura = formulario.figura.value;
				//aqui dice que si alguno de los campos no se ha llenado que muestre un aviso diciendo que llene los campos
				if(descripcion.length == 0 || responsable.length == 0 || paso.length == 0)
				{
					$("#mostrario").html("<center><font color='red'>Llene los campos obligatorios</font></center>");
					return false;
				}
				//de aqui para abajo es simplemente mostrar una imagen de cargando y enviar los dos por metodo post.
				$("#formulario_figura").css("display","none");
				$("#cargando").css("display","inline");
				$("#mostrario").html("");
				$.post("funcion.php",{des : descripcion , res : responsable , pas : paso , figura : idfigura},function(){
					$("#cargando").css("display","none");
					$("#formulario_figura").show("fast");
				});
				//document.getElementById("form1").reset();
				//});
			}
			/*function contando_veces()
			{
				veces++;
				if(veces == 1)
				{
					var elemento = document.getElementById("a");
					elemento.removeAttribute('onmouseover');
				}
			}*/
            /**Export the Canvas as SVG*/
            function toSVG(){
                var canvas = getCanvas();
                var v2 = '<svg width="' + canvas.width +'" height="' + canvas.height + '" xmlns="http://www.w3.org/2000/svg" version="1.1">';
                v2 += stack.toSVG();
                v2 += CONNECTOR_MANAGER.toSVG();
                v2 += '</svg>';
                
                /*$.post("guardar_pasos.php",{datos : stack.toSVG()},function(dato){
                  alert(dato);
                });*/
                return v2;
                
            }

             /** Save current diagram
             *See:
             *http://www.itnewb.com/v/Introduction-to-JSON-and-PHP/page3
             *http://www.onegeek.com.au/articles/programming/javascript-serialization.php
             **/
            function save(){
                //alert("save triggered!");
                Log.info('Save pressed');

                    
                var diagram = { c: canvasProps, s:stack, m:CONNECTOR_MANAGER };
                var serializedDiagram = JSON.stringify(diagram);
                var svgDiagram = toSVG();
				
				
				//alert(svgDiagram);

//                alert(serializedDiagram);
//                alert(svgDiagram);

                //see: http://api.jquery.com/jQuery.post/
                $.post('<?php echo($ruta_db_superior."workflow/");?>common/controller.php',
                    {action: 'save', diagram: serializedDiagram, svg: svgDiagram, diagramId: '<?php  echo $_REQUEST['diagramId']?>'},
					
                    function(data){
						var id_diagramax = "";
						<? if($_REQUEST['diagramId']){ ?>
						id_diagramax = <?php  echo $_REQUEST['diagramId']?>;
						<?}?>
						
                        
                        if(data == 'noaccount'){
                            Log.info('No account...so we will redirect');
                            window.location = '<?php echo($ruta_db_superior);?>register.php';
                        }
                        else if(data == 'firstSave'){
                            Log.info('firstSave!');
                            window.location = 'saveDiagram.php';
                        }
                        else if(data == 'saved'){
                        window.open('<?php echo($ruta_db_superior."workflow/");?>exporter/exporter.php?diagrama='+id_diagramax+"&tipo=jpg");
                            //Log.info('saved!');
                            alert('Guardado!');
                        }
                        else{
                            if(data == 'Guardado!!'){
                                window.open('<?php echo($ruta_db_superior."workflow/");?>exporter/exporter.php?diagrama='+id_diagramax+"&tipo=jpg");
                                alert('Guardado!');
                            }
                            else
                              alert(data);
                        }
                    }
                );


            }

            /**Loads a saved diagram
             *@param {Number} diagramId - the id of the diagram you want to load
             **/
            function load(diagramId){
                //alert("load diagram [" + diagramId + ']');

                $.post('<?php echo($ruta_db_superior."workflow/");?>common/controller.php', {action: 'load', diagramId: diagramId},
                    function(data){
//                        alert(data);
                        var obj  = eval('(' + data + ')');
                        stack = Stack.load(obj['s']);
                        canvasProps = CanvasProps.load(obj['c']);
                        canvasProps.sync();
                        setUpEditPanel(canvasProps);

                        CONNECTOR_MANAGER = ConnectorManager.load(obj['m']);
                        draw();

                        //alert("loaded");
                    }
                );

            }


            /**Saves a diagram. Actually send the serialized version of diagram
             *for saving
             **/
            function saveAs(){
                var canvas = getCanvas();
//                var $diagram = {c:canvas.save(), s:stack, m:CONNECTOR_MANAGER};
                var $diagram = {c:canvasProps, s:stack, m:CONNECTOR_MANAGER};
                $serializedDiagram = JSON.stringify($diagram);
                var svgDiagram = toSVG();

                //alert($serializedDiagram);

                //see: http://api.jquery.com/jQuery.post/
                $.post('<?php echo($ruta_db_superior."workflow/");?>common/controller.php', {action: 'saveAs', diagram: $serializedDiagram, svg: svgDiagram},
                    function(data){
                        if(data == 'noaccount'){
                            Log.info('You must have an account to use that feature');
                            //window.location = '../register.php';
                        }
                        else if(data == 'step1Ok'){
                            Log.info('Save as...');
                            window.location = '<?php echo($ruta_db_superior."workflow/");?>saveDiagram.php';
                        }
                    }
                );
            }


            /**Exports current canvas as SVG*/
            function exportCanvas(){
                //export canvas as SVG
		var v = '<svg width="300" height="200" xmlns="http://www.w3.org/2000/svg" version="1.1">\
			<rect x="0" y="0" height="200" width="300" style="stroke:#000000; fill: #FFFFFF"/>\
				<path d="M100,100 C200,200 100,50 300,100" style="stroke:#FFAAFF;fill:none;stroke-width:3;"  />\
				<rect x="50" y="50" height="50" width="50"\
				  style="stroke:#ff0000; fill: #ccccdf" />\
			</svg>';



                //get svg
                var canvas = getCanvas();

                var v2 = '<svg width="' + canvas.width +'" height="' + canvas.height + '" xmlns="http://www.w3.org/2000/svg" version="1.1">';
                v2 += stack.toSVG();
                v2 += CONNECTOR_MANAGER.toSVG();
                v2 += '</svg>';
                //alert(v2);

                //save SVG into session
                //see: http://api.jquery.com/jQuery.post/
                $.post("../common/controller.php", {action: 'saveSvg', svg: escape(v2)},
                    function(data){
                        if(data == 'svg_ok'){
                            //alert('SVG was save into session');
                        }
                        else if(data == 'svg_failed'){
                            Log.info('SVG was NOT save into session');
                        }
                    }
                );

                //open a new window that will display the SVG
                window.open('./svg.php', 'SVG', 'left=20,top=20,width=500,height=500,toolbar=1,resizable=0');
            }

            /**Minimap section*/
            var minimap; //stores a refence to minimap object (see minimap.js)
            
            $(document).mouseup(
                function(){
                    minimap.selected = false;
                }
            );
            
            window.onresize = function(){
                minimap.initMinimap()
            };
            
            
            /**Initialize the page*/
            function init(){
                var canvas = getCanvas();
                
                minimap = new Minimap(canvas, document.getElementById("minimap"), 115);
                minimap.updateMinimap();


                //Canvas properties (width and height)
                if(canvasProps == null){//only create a new one if we have not already loaded one
                       canvasProps = new CanvasProps(CanvasProps.DEFAULT_WIDTH, CanvasProps.DEFAULT_HEIGHT);
                }
                //lets make sure that our canvas is set to the correct values
                canvasProps.setWidth(canvasProps.getWidth());
                canvasProps.setHeight(canvasProps.getHeight());


                //Grid
                grid = document.getElementById("grid");
                if(document.getElementById("gridCheckbox").checked){
                    showGrid();
                }
                else{
                    document.getElementById("gridCheckbox").checked=false;
                }

                if(document.getElementById("snapCheckbox").checked){
                    snapToGrid();
                }
                else{
                    document.getElementById("snapCheckbox").checked=false;
                }


                //Browser support and warnings
                if(isBrowserReady() == 0){ //no support at all
                    modal();
                }
                
                //Edit panel
                setUpEditPanel(canvasProps);

                //Load current diagram
                <? if( is_numeric($_REQUEST['diagramId']) ){?>
                load(<?php  echo $_REQUEST['diagramId']?>);
                <? }?>
                    
                //add event handlers for document
                document.onkeypress = onKeyPress;                
                document.onkeydown = onKeyDown;
                document.onkeyup = onKeyUp;
            }
        </script>
        <script src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" /> 
		<script>                                       
		hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
		</script>
        <!--[if IE]>
        <script type="text/javascript">
            var IE=true;
        </script>
        <![endif]-->



    </head>
    <body onload="init();generarfigura()" id="body">
		
        <? require_once('common/header.php'); ?>
        <div id="menu">
            <table border="0" cellpadding="3" cellspacing="0">
                <tr>
                    <td width="10">
                        &nbsp;
                    </td>
                    <td valign="middle">
                        <a style="text-decoration: none;" href="<?php echo($ruta_db_superior."workflow/");?>common/controller.php?action=newDiagramExe"><img style="vertical-align:middle; margin-right: 3px;" src="assets/images/icon_new.jpg" border="0" width="20" height="21"/><span class="menuText">Nuevo</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <td valign="middle">
                        <a style="text-decoration: none;" href="<?php echo($ruta_db_superior."workflow/");?>myDiagrams.php"><img style="vertical-align:middle; margin-right: 3px;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_open.jpg" border="0" width="20" height="21"/><span class="menuText">Abrir</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src=<?php echo($ruta_db_superior."workflow/");?>"assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <td valign="middle">
                        <a style="text-decoration: none;" href="javascript:save();"><img style="vertical-align:middle; margin-right: 3px;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_save.jpg" border="0" width="22" height="22"/><span class="menuText">Guardar</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <td valign="middle">
                        <a style="text-decoration: none;" href="javascript:saveAs();"><img style="vertical-align:middle; margin-right: 3px;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_save_as.jpg" border="0" width="22" height="22"/><span class="menuText">Guardar como</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
					<!--<td align='center'>
						<a style="text-decoration: none;" href="./common/controller.php?action=logoutExe"><img style="vertical-align:middle; margin-right: 5px;" src="../editor/assets/images/icon_logout.gif" border="0" width="16" height="16"/><span class="menuText">Cerrar sesion &nbsp;&nbsp;(<?php  echo $loggedUser->email?>)</span></a>
					</td>-->
                    <?if(is_numeric($_REQUEST['diagramId']) ){//option available ony when the diagram was saved?>
                    <td valign="middle">
                        <a style="text-decoration: none;" href="<?php echo($ruta_db_superior."workflow/");?>exportDiagram.php?diagramId=<?php  echo $_REQUEST['diagramId']?>"><img style="vertical-align:middle; margin-right: 3px;" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_export.jpg" border="0" width="22" height="22"/><span class="menuText">Exportar</span></a>
                    </td>
					
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <?}?>

                    <!--
                    <td valign="middle">
                        <a style="text-decoration: none;" href="javascript:exportCanvas();"><img style="vertical-align:middle; margin-right: 3px;" src="../assets/images/icon_export.jpg" border="0" width="22" height="22"/><span class="menuText">Debug Export</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="../assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    -->

                    <?if(is_numeric($_REQUEST['diagramId']) ){ //these options should appear ONLY if we have a saved diagram
                        $diagram = $delegate->diagramGetById($_REQUEST['diagramId']);
                    ?>
                    <!--<td valign="middle">
                        <a style="text-decoration: none;" href="./colaborators.php?diagramId=<?php  echo $_REQUEST['diagramId']?>"><img style="vertical-align:middle; margin-right: 3px;" src="assets/images/collaborators.gif" border="0" width="22" height="22"/><span class="menuText">Colaboradores</span></a>
                    </td>
                    <td width="20" align="center">
                        <img style="vertical-align:middle;" src="assets/images/upper_bar_separator.jpg" border="0" width="2" height="16"/>
                    </td>
                    <td>
                        <span class="menuText">Enlace directo : </span> <input style="font-size: 10px;" type="text" class="text" size="40" value="diagrams/<?php  echo $diagram->hash?>"/>
                    </td>-->
                    <?}?>

                    <script type="text/javascript">
                        switch(isBrowserReady()){
                            /*case 0: //not supported at all
                                document.write("<td bgcolor=\"red\">");
                                document.write("No support for HTML5. More <a href=\"http://<?php  echo WEBADDRESS?>/htm5-support.php\">here</a></a>");
                                document.write("</td>");
                                break;
                            /*case 1: //IE - partially supported
                                document.write("<td bgcolor=\"yellow\">");
                                document.write("Poor HTML5 support. More <a href=\"http://<?php  echo WEBADDRESS?>/htm5-support.php\">here</a></a>");
                                document.write("</td>");
                                break;*/
                        }
                    </script>

                </tr>
            </table>
        </div>


        <div id="actions">
			<a href="javascript: var conf = guardar_figura(); if(conf != false) createFigure(figure_Rectangle);" id='rectan'><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/figures/basic/rectangle.png" border="0" height="22px" /></a>
			<!--<img class="separator" src="assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
			<a href="javascript:createFigure(figure_Ellipse);"><img src="assets/images/figures/basic/ellipse.png" border="0" height="22px" /></a>-->
			<img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <input type="checkbox" onclick="showGrid();" id="gridCheckbox" /> <span class="toolbarText">Mostrar cuadricula</span>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <input type="checkbox" onclick="snapToGrid();" id="snapCheckbox" /> <span class="toolbarText">Ajustar a la cuadricula</span>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <!--
            <a class="button" href="javascript:action('up');">up</a>
            <a class="button" href="javascript:action('down');">down</a>
            <a class="button" href="javascript:action('left');">left</a>
            <a class="button" href="javascript:action('right');">right</a>
            <a class="button" href="javascript:action('grow');">grow</a>
            <a class="button" href="javascript:action('shrink');">shrink</a>
            <a class="button" href="javascript:action('rotate90');">rotate 5<sup>o</sup> CW</a>
            <a class="button" href="javascript:action('rotate90A');">rotate 5<sup>o</sup> ACW</a>
            <a style="border: 1px solid red; background-color: red; color: white;" href="javascript:stack.reset(); CONNECTOR_MANAGER.reset(); draw();">Reset Canvas</a><br />
            -->
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('front');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_front.gif" border="0"/></a>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('back');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_back.gif" border="0"/></a>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('moveforward');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_forward.gif" border="0"/></a>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('moveback');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_backward.gif" border="0"/></a>

            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('connector-straight');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_connector_straight.gif" border="0"/></a>

            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('connector-jagged');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/icon_connector_jagged.gif" border="0"/></a>

            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('group');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/group.gif" border="0"/></a>
            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('ungroup');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/ungroup.gif" border="0"/></a>

            <img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) createFigure(figure_Text);"><img  src="<?php echo($ruta_db_superior."workflow/");?>assets/images/text.gif" border="0" height ="16"/></a>
			<img class="separator" src="<?php echo($ruta_db_superior."workflow/");?>assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
			<!--<a href="javascript:createFigure(figure_SimpleImage);">Imagen</a>

            <img class="separator" src="assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>-->

            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('undo');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/arrow_undo.png" border="0"/></a>
            <a href="javascript: var conf = guardar_figura(); if(conf != false) action('redo');"><img src="<?php echo($ruta_db_superior."workflow/");?>assets/images/arrow_redo.png" border="0"/></a>
            <!--
            <input type="text" id="output" />                
            <img style="vertical-align:middle;" src="../assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript:action('duplicate');">Copy</a>
            <img style="vertical-align:middle;" src="../assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript:action('group');">Group</a>
            <img style="vertical-align:middle;" src="../assets/images/toolbar_separator.gif" border="0" width="1" height="16"/>
            <a href="javascript:action('ungroup');">Ungroup</a>
            -->
        </div>
        
        
        <div id="editor">
            <!--<div id="figures">
                <select style="width: 120px;" onchange="setFigureSet(this.options[this.selectedIndex].value)">
                    <option value="basic" selected>Basico</option>
                    <option value="secondary">Secundario</option>
                    <option value="experimental">Experimental</option>
                    <option value="more">Mas</option>
                </select>

                <!--<div id="basic">-->
                    <table border="0" cellpadding="0" cellspacing="0" width="120">
                        <tr>
                            <!--<td><a href="javascript:createFigure(figure_RoundedRectangle);"><img src="assets/images/figures/basic/rounded_rectangle.png" border="0" alt="SQR" /></a></td>
                            <td><a href="javascript:createFigure(figure_Rectangle);" id='rectan'><img src="assets/images/figures/basic/rectangle.png" border="0" /></a></td>
                            <!--<td><a href="javascript:createFigure(figure_Square);"><img src="assets/images/figures/basic/square.png" border="0" alt="square" /></a></td>-->
                        </tr>
                        <!--<tr>
                            <td><a href="javascript:createFigure(figure_Circle);"><img src="assets/images/figures/basic/circle.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Diamond);"><img src="assets/images/figures/basic/diamond.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Parallelogram);"><img src="assets/images/figures/basic/parallelogram.png" border="0" alt="SQR" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="javascript:createFigure(figure_Ellipse);"><img src="assets/images/figures/basic/ellipse.png" border="0" /></a></td><!--
                            <td><a href="javascript:createFigure(figure_RightTriangle);"><img src="assets/images/figures/basic/right_triangle.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Pentagon);"><img src="assets/images/figures/basic/pentagon.png" border="0" alt="SQR" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="javascript:createFigure(figure_Hexagon);"><img src="assets/images/figures/basic/hexagon.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Octogon);"><img src="assets/images/figures/basic/octogon.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Text);"><img src="assets/images/figures/basic/text.png" border="0" /></a></td>
                        </tr>-->

                    </table>
                <!--</div>

                <div style="display:none;" id="secondary">
                    <table border="0" cellpadding="0" cellspacing="0" width="120">
                        <tr>
                            <td><a href="javascript:createFigure(figure_Page);"><img src="assets/images/figures/secondary/page.png" border="0" alt="SQR" /></a></td>
                            <td><a href="javascript:createFigure(figure_PageUpperCornerFolded);"><img src="assets/images/figures/secondary/page_upper_corner_folded.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_PageLowerCornerFolded);"><img src="assets/images/figures/secondary/page_lower_corner_folded.png" border="0" /></a></td>
                        </tr>
                        <tr>
                            <td><a href="javascript:createFigure(figure_SemiCircleUp);"><img src="assets/images/figures/secondary/semi_circle_up.png" border="0" alt="semi circle" /></a></td>
                            <td><a href="javascript:createFigure(figure_SemiCircleDown);"><img src="assets/images/figures/secondary/semi_circle_down.png" border="0" /></a></td>
                            <td><a href="javascript:createFigure(figure_Triangle);"><img src="assets/images/figures/secondary/triangle.png" border="0" alt="triangle"/></a></td>
                        </tr>
                    </table>
                </div>
                
                <div style="display:none;" id="experimental">
                    <table border="0" cellpadding="0" cellspacing="0" width="120">
                        <tr>
                            <td><a href="javascript:createFigure(figure_Stop);"><img src="assets/images/figures/na.png" border="0" alt="figure_Stop" /></a></td>

                        </tr>
                    </table>
                </div>
                <div style="display:none;" id="more">
                    Mas series de cifras <a href="http://diagramo.com/figures.php" target="_new">Aqui</a>
                </div>->
            </div>
            
            <!--THE canvas-->
            <div style="width: 100%">
                <div  id="container" style="position:absolute;left:0px;top:-55px;width:80%">
                    <canvas id="a" name='canvas1' width="1000" height="700" 
                            onmousemove="onMouseMove(event)"
                            onmousedown="onMouseDown(event)"
                            onmouseup="onMouseUp(event)"
							
                            ontouchstart="touchStart(event);"
                            ontouchmove="touchMove(event);"
                            ontouchend="touchEnd(event);"
                            ontouchcancel="touchCancel(event);" 
							
							
							>
                        
                    </canvas>
                    <script type="text/javascript">
                        //$("#a").ontouchstart(onTouchStart);
                        //$("#a").mousemove(onMouseMove);
                        //$("#a").mousedown(onMouseDown);
                        //$("#a").mouseup(onMouseUp);
                        //$("#a").click(onClick);
                    </script>
                </div>
            </div>
            
            <!--Right panel-->
            <div id="right" style="position:absolute;left:80%;top:-50px;width:19%">
                <center>
                    <div id="minimap">
                    </div>
                </center>
                <div id="edit" style="position:absolute;width:100%">
                </div>
            </div>
            
        </div>




        <script type="text/javascript">

            function loadFill(check){
                if(check.checked == true){
                    if($('#colorpickerHolder3').css('display')=='none'){
                        $('#colorSelector3').click();
                    }
                }
                else{
                    if($('#colorpickerHolder3').css('display')=='block'){
                        $('#colorSelector3').click();
                    }
                }
            }
            
            

        </script>
        <br/>
         <? require_once($ruta_db_superior.'workflow/common/analytics.php');?>
		<div id='mostrar_informacion' style='position:absolute;'></div>
    </body>
</html>