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
include_once($ruta_db_superior."calendario/calendario.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(librerias_arboles());
echo(estilo_bootstrap()); 


function arbol($campo,$nombre_arbol,$url,$cargar_todos=0,$padresehijos=false,$quitar_padres=false,$adicionales=false,$tipo_etiqueta='check',$agreg_depen=false,$tipo_funcionario='rol'){
	global $ruta_db_superior;
	$entidad=$nombre_arbol;
	?>
	<input type="text" id="stext<?php echo $entidad; ?>" width="200px" size="25" placeholder="Buscar">
<a href="javascript:void(0)" onclick="stext<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/anterior.png" alt="Buscar Anterior" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value),0,1)">
<img src="<?php echo $ruta_db_superior; ?>botones/general/buscar.png" alt="Buscar" border="0px"></a>
<a href="javascript:void(0)" onclick="tree<?php echo $entidad; ?>.findItem(htmlentities(document.getElementById('stext<?php echo $entidad; ?>').value))">
<img src="<?php echo $ruta_db_superior; ?>botones/general/siguiente.png" alt="Buscar Siguiente" border="0px"></a>
</span>

<!--a href="javascript:seleccionar_todos<?php echo $entidad; ?>(1)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconCheckAll.gif" alt="Seleccionar todos" title="Seleccionar todos"></a>
	<a href="javascript:seleccionar_todos<?php echo $entidad; ?>(0)"><img src="<?php echo $ruta_db_superior; ?>imgs/iconUncheckAll.gif" alt="Quitar todos" title="Quitar todos"></a><br-->
<div id="esperando<?php echo $entidad; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
<div id="treeboxbox<?php echo $entidad; ?>"></div>
<input type="hidden" class="required" name="<?php echo $campo; ?>" id="<?php echo $entidad; ?>">
<script type="text/javascript">
	$("document").ready(function(){
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree<?php echo $entidad; ?>=new dhtmlXTreeObject("treeboxbox<?php echo $entidad; ?>","","",0);
			tree<?php echo $entidad; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
		  tree<?php echo $entidad; ?>.enableIEImageFix(true);
			tree<?php echo $entidad; ?>.setOnLoadingStart(cargando<?php echo $entidad; ?>);
      tree<?php echo $entidad; ?>.setOnLoadingEnd(fin_cargando<?php echo $entidad; ?>);
      <?php if($tipo_etiqueta=='check'){?>
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php }else if($tipo_etiqueta=='radio'){?>
      tree<?php echo $entidad; ?>.enableRadioButtons(true);
      tree<?php echo $entidad; ?>.enableCheckBoxes(1);
      <?php }
      if($entidad!='plantilla'&&$entidad!='serie'){ ?>
      tree<?php echo $entidad; ?>.enableSmartXMLParsing(true);
      <?php } 
      if($padresehijos){?>
      tree<?php echo $entidad; ?>.enableThreeStateCheckboxes(true);
      <?php }?>
      
			tree<?php echo $entidad; ?>.loadXML("<?php echo $ruta_db_superior.$url; ?>");
      tree<?php echo $entidad; ?>.setOnCheckHandler(onNodeSelect<?php echo $entidad; ?>);
    
			function onNodeSelect<?php echo $entidad; ?>(nodeId){
				var adicional_dep="";
				var valores=tree<?php echo $entidad; ?>.getAllChecked();
				<?php if($quitar_padres){?>
					var nuevos_valores=valores.split(",");
					var cantidad=nuevos_valores.length;
					var funcionarios=new Array();
					var indice=0;
					for(var i=0;i<cantidad;i++){
						if(nuevos_valores[i].indexOf("#")=='-1'){
							if(nuevos_valores[i]!=""){
								funcionarios[indice]=nuevos_valores[i];
								indice++;
							}
						}
					}
					var valores=funcionarios.join(",");
				<?php }
				if(is_array($adicionales)){?>
					if(valores!=''){
						if($("#bksaiacondicion_<?php echo $adicionales[0];?>").val()=="" && $("#bqsaia_<?php echo $adicionales[0];?>").val()==""){
							$("#bksaiacondicion_<?php echo $adicionales[0];?>").val("<?php echo $adicionales[1];?>");
							$("#bqsaia_<?php echo $adicionales[0];?>").val("<?php echo $adicionales[2];?>");
						}
					}
					else{
						$("#bksaiacondicion_<?php echo $adicionales[0];?>").val("");
						$("#bqsaia_<?php echo $adicionales[0];?>").val("");
					}
				<?php } 
				if($tipo_etiqueta=='radio'){ ?>
					valor_destino=document.getElementById("<?php echo $entidad; ?>");
					if(tree<?php echo $entidad; ?>.isItemChecked(nodeId)){
						if(valor_destino.value!==""){
							tree<?php echo $entidad; ?>.setCheck(valor_destino.value,false);
						}
						if(nodeId.indexOf("_")!=-1){
							nodeId=nodeId.substr(0,nodeId.length);
						}
						valor_destino.value=nodeId;
					}else{
						valor_destino.value="";
					}               
				<?php } 				
				if($agreg_depen){
					?>
					$.ajax({
						type:'POST',
						url: "dependencias_padres.php",
						async: false,
						data: {funcionario:valores,tipo_funcionario:'<?php echo $tipo_funcionario;?>'} ,
						success: function(retorno){
							if(retorno!=""){
								adicional_dep=","+retorno;
							}
						}  
					});
					<?php
				}
				if($tipo_etiqueta!='radio' || $quitar_padres){
				?>
					document.getElementById("<?php echo $entidad; ?>").value=valores+adicional_dep;
				<?php	
				}
				?>
      }
      function fin_cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
         eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
            eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "none";
      document.getElementById('<?php echo $entidad; ?>').value=tree<?php echo $entidad; ?>.getAllChecked();
      <?php
      if($cargar_todos==1){
      	echo "seleccionar_todos".$entidad."(1);";
      }
      ?>
    }
    function cargando<?php echo $entidad; ?>() {
      if (browserType == "gecko" )
         document.poppedLayer =
             eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else if (browserType == "ie")
         document.poppedLayer =
            eval('document.getElementById("esperando<?php echo $entidad; ?>")');
      else
         document.poppedLayer =
             eval('document.layers["esperando<?php echo $entidad; ?>"]');
      document.poppedLayer.style.display = "";
    }
    
   });
   function seleccionar_todos<?php echo $entidad; ?>(tipo)
    {lista=tree<?php echo $entidad; ?>.getAllChildless();
     vector=lista.split(",");
     for(i=0;i<vector.length;i++)
      {tree<?php echo $entidad; ?>.setCheck(vector[i],tipo);
      }
     document.getElementById("<?php echo $entidad; ?>").value=tree<?php echo $entidad; ?>.getAllChecked(); 
    }
--></script><br>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/codificacion_funciones.js"></script>
	<?php
	}




?>    




<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8">

     <style type="text/css">
     <!--INPUT, TEXTAREA, SELECT, body {
        font-family: Tahoma; 
        font-size: 10px; 
       } 
       .phpmaker {
       font-family: Verdana; 
       font-size: 9px; 
       } 
       .encabezado {
       background-color:#57B0DE; 
       color:white ; 
       padding:10px; 
       text-align: left;	
       } 
       .encabezado_list { 
       background-color:#57B0DE; 
       color:white ; 
       vertical-align:middle;
       text-align: center;
       font-weight: bold;	
       }
       table thead td {
		    font-weight:bold;
    		cursor:pointer;
    		background-color:#57B0DE;
    		text-align: center;
        font-family: Verdana; 
        font-size: 9px;
        text-transform:Uppercase;
        vertical-align:middle;    
    	 }
    	 table tbody td {	
    		font-family: Verdana; 
        font-size: 9px;
    	 }
    	 .ac_results {
				padding: 0px;
				border: 0px solid black;
				background-color: white;
				overflow: hidden;
				z-index: 99999;
			}
    	 
			.ac_results ul {
				width: 100%;
				list-style-position: outside;
				list-style: none;
				padding: 0;
				margin: 0;
			}
			.ac_results li:hover {
			background-color: A9E2F3;
			}
			
			.ac_results li {
				margin: 0px;
				padding: 2px 5px;
				cursor: default;
				display: block;
				font: menu;
				font-size: 10px;
				line-height:10px;
				overflow: hidden;
			}
       -->
       </style><style type="text/css" media="screen">
	@import "../../css/title2note.css";
	html, body {
   height: 99%;
   width:99%;
   overflow: hidden;
}
#div_contenido {
   height: 100%;
   overflow: auto; 
   width:100%;
   position: relative;
   z-index: 2;
}
</style>
</head>
<body>
<div id="div_contenido">
<script src="../../js/jquery-1.7.min.js" type="text/javascript"></script><link rel="stylesheet" type="text/css" href="../../css/bootstrap.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap-responsive.css"><link rel="stylesheet" type="text/css" href="../../css/jasny-bootstrap.min.css"><link rel="stylesheet" type="text/css" href="../../css/jasny-bootstrap-responsive.min.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap_reescribir.css"><link rel="stylesheet" type="text/css" href="../../pantallas/lib/librerias_css.css"><link rel="stylesheet" type="text/css" href="../../css/bootstrap_iconos_segundarios.css"><style type="text/css">
			.btn-primary{
				  background-color: #0044cc;
				  background-image: linear-gradient(to top, #0088cc,#0044cc);
			}
			.btn-primary:hover {
			  background-color: #0044cc;
			  background-image: linear-gradient(to bottom, #0088cc,#0044cc);
			}
			.encabezado_list { 
			    background-color: #57B0DE;
			}
			textarea, input[type="text"], input[type="password"], input[type="datetime"], 
			input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], 
			input[type="week"], input[type="number"], input[type="email"], input[type="url"], 
			input[type="search"], input[type="tel"], input[type="color"], .uneditable-input { 
			  border-color: #cccccc;
			  box-shadow: inset 0 1px 1px #cccccc, 0 0 8px #cccccc;
			}
			textarea:focus, input[type="text"]:focus, input[type="password"]:focus, input[type="datetime"]:focus, 
			input[type="datetime-local"]:focus, input[type="date"]:focus, input[type="month"]:focus, 
			input[type="time"]:focus, input[type="week"]:focus, input[type="number"]:focus, input[type="email"]:focus, 
			input[type="url"]:focus, input[type="search"]:focus, input[type="tel"]:focus, input[type="color"]:focus,
			 .uneditable-input:focus {
			  border-color: #cccccc;
			  box-shadow: inset 0 1px 1px #cccccc, 0 0 8px #cccccc;
			}
			.label-info, .badge-info {
			    background-color: #0B7BB6;
			}
			</style>
			<form method="POST" action="../../colilla.php"><br/><br />
                <table style="font-size:10pt;border-collapse:collapse; width:40%;" border="1" align="center">
                    <tr>
                        <td style="font-size:8pt;" class="encabezado_list" colspan="2" align="center">Seleccione el formato a radicar</td>
                    </tr>
                    <tr>
                        <td colspan="2"><?php 
	        echo arbol("radicacion","tipo_radicacion","formatos/radicacion_entrada/text_radicacion_rapida.php?idcategoria_formato=1","","","","","check"); 
	        ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="Radicar" id="enviar" name="enviar"/></td>
                    </tr>
                </table>
            </form>
    <script>
	$(document).ready(function(){
		$("#enviar").click(function(){
			var ingreso=confirm("Esta seguro de generar un nuevo radicado?");
			if(ingreso){
				form.submit();
			}else{
				return false;
			}
		});
	});
</script>