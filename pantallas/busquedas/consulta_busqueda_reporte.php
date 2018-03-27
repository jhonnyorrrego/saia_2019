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
include_once($ruta_db_superior."pantallas/lib/librerias_xml.php");
$datos_componente=$_REQUEST["idbusqueda_componente"];
$columnas=array();
$columnas["etiquetas"]=array();
$columnas["modelo"]=array();
$datos_busqueda=busca_filtro_tabla("","busqueda A,busqueda_componente B","A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=".$datos_componente,"",$conn);

if($datos_busqueda[0]["ruta_libreria"]){
  $librerias=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria"]));
  array_walk($librerias,"incluir_librerias_busqueda");
}

if($datos_busqueda[0]["ruta_libreria_pantalla"]){
  $librerias_pantalla=array_unique(explode(",",$datos_busqueda[0]["ruta_libreria_pantalla"]));
  array_walk($librerias_pantalla,"incluir_librerias_pantalla");
}


$info=stripslashes($datos_busqueda[0]["info"]);
$grupos=explode("|-|",$info);
$cant=count($grupos);
$campos=$datos_busqueda[0]["campos"].",".$datos_busqueda[0]["campos_adicionales"];
$campos_limpios=array();
$lcampos=explode(",",$campos);
foreach($lcampos AS $key=>$valor){
    if(trim($valor)){
        $val=explode(".",$valor);
        if(count($val)==1){
            array_push($campos_limpios,$val[0]);    
        }
        else{
            array_push($campos_limpios,$val[1]);
        }

    }
}
for($i=0;$i<$cant;$i++){
    $sortable="false";
	$datos=explode("|",$grupos[$i]);
	array_push($columnas["etiquetas"],@$datos[0]);
	$datos[1]=str_replace("{*","",str_replace("*}","",$datos[1]));
	$datos2=explode("@",$datos[1]);
	$width="";
    if($datos[3]){
        $width=',"width":'.$datos[3];
    }
    if(in_array($datos[1],$campos_limpios)){
         $sortable="true";
    }
	array_push($columnas["modelo"],'{"encabezado":"'.$datos[0].'","sortable":'.$sortable.',"name":"'.$datos2[0].'","align":"'.$datos[2].'"'.$width.'}');
}
$encabezado=stripslashes($datos_busqueda[0]["encabezado_grillas"]);
$grupos=explode("|-|",$encabezado);
$cant=count($grupos);
$titulos=array();
for($i=0;$i<$cant;$i++){
	$datos=explode("|",$grupos[$i]);
	$titulos[]="{startColumnName: '".$datos[1]."', numberOfColumns: ".$datos[2].", titleText: '<em>".$datos[0]."</em>'}";
}


$encabezado_pie=busca_filtro_tabla("","busqueda_encabezado a","a.fk_idbusqueda_componente=".$datos_componente,"",$conn);
if($encabezado_pie["numcampos"]){
	$resultado=json_decode($encabezado_pie[0]["pie"],true);
	$cant_f=count($resultado);
}

echo(estilo_jqgrid());
echo(estilo_redmond());
echo(estilo_bootstrap());
?>
<style>
.ui-jqgrid, .ui-jqgrid, tr.jqgrow td, .ui-pg-table td, .ui-jqgrid-labels th{font-size:0.6em}
.ui-pg-table .ui-pg-input{height:23px; width:25px;}
.ui-pg-table .ui-pg-selbox{height:23px; width:55px;}
.ui-jqgrid-title{width:100%}

#barra_exportar_ppal{ margin-right:50px;}
.progress{margin-bottom: 0px;}
</Style>
<div style="container" align="center" id="contenedor">
<table id="datos_busqueda"></table>
<div id="nav_busqueda"></div>
</div>
<input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']);?>" name="busqueda_total_registros" id="busqueda_registros">
<input type="hidden" value="1" name="busqueda_pagina" id="busqueda_pagina">
<input type="hidden" value="1" name="busqueda_total_paginas" id="busqueda_total_paginas">
<input type="hidden" value="<?php echo($datos_componente);?>" name="iddatos_componente" id="iddatos_componente">
<input type="hidden" value="0" name="fila_actual" id="fila_actual">
<input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]);?>" name="variable_busqueda" id="variable_busqueda">
<input type="hidden" value="1" name="complementos_busqueda" id="complementos_busqueda">
<?php

$boton_buscar="";
if($datos_busqueda[0]['busqueda_avanzada']!=""){
	$boton_buscar='<button class=\"btn btn-mini btn-primary kenlace_saia pull-left\" titulo=\"B&uacute;squeda '.$datos_busqueda[0]["etiqueta"].'\" title=\"B&uacute;squeda '.$datos_busqueda[0]["etiqueta"].'\" conector=\"iframe\" enlace=\"'.$datos_busqueda[0]['busqueda_avanzada'].'\">B&uacute;squeda &nbsp;</button>';
}
$boton_adicionar="";
if($datos_busqueda[0]['enlace_adicionar']!=""){
	$boton_adicionar='<button class=\"btn btn-mini btn-primary kenlace_saia pull-left\" titulo=\"Adicionar '.$datos_busqueda[0]["etiqueta"].'\" title=\"Adicionar '.$datos_busqueda[0]["etiqueta"].'\" conector=\"iframe\" enlace=\"'.$datos_busqueda[0]['enlace_adicionar'].'\">Adicionar</button>';
}

$acciones_selecionados='';		
if($datos_busqueda[0]["acciones_seleccionados"]!=''){		
	$datos_reporte=array();		
	$datos_reporte['idbusqueda_componente']=$datos_busqueda[0]["idbusqueda_componente"];		
	$datos_reporte['variable_busqueda']=@$_REQUEST["variable_busqueda"]; 		
     $acciones=explode(",",$datos_busqueda[0]["acciones_seleccionados"]);		
     $cantidad=count($acciones);		
     for($i=0;$i<$cantidad;$i++){		
	     $acciones_selecionados.=($acciones[$i]($datos_reporte));
     }              		
}  

$cantidad_mostrar=20;
if($datos_busqueda[0]['cantidad_registros']>0){
	$cantidad_mostrar=$datos_busqueda[0]['cantidad_registros'];
}
$cmf1=$cantidad_mostrar;
$cmf2=$cantidad_mostrar+10;
$cmf3=$cantidad_mostrar+20;
$cantidad_mostrar_filtrar=$cmf1.','.$cmf2.','.$cmf3;

echo(librerias_jquery("1.7"));
echo(librerias_UI());
echo(librerias_jqgrid());
echo(librerias_tooltips());
echo(librerias_notificaciones());
echo(librerias_acciones_kaiten());
echo(librerias_bootstrap());
?>          
<script type="text/javascript">
var isOpera="";
var isFirefox="";
var isSafari ="";
var isChrome="";
var isIE="";
$(document).ready(function(){
	window.parent.$(".block-iframe").attr("style","margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");

	var alto_document=($(document).height()-130);
    var emptyMsgDiv = $("<div class='alert alert-warning' style='font-size:24px;'><center>No se encontraron resultados</center></div>");
	var $grid = $("#datos_busqueda");
    $grid.jqGrid({
    height:alto_document,
    type:'POST',
   	url: "servidor_busqueda.php?idbusqueda_componente=<?php echo($datos_componente);?>&idbusqueda_grafico=<?php echo(@$_REQUEST['idbusqueda_grafico']); ?>&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>&actual_row="+$("#fila_actual").val()+"&variable_busqueda="+$("#variable_busqueda").val()+"&reporte=1",
	  datatype: "json",
   	colNames:[<?php echo('"'.implode('","',$columnas["etiquetas"]).'"');?>],
   	colModel:[
      <?php
        $cant_columnas=count($columnas["modelo"]);
        for($i=0;$i<$cant_columnas;$i++){
          echo($columnas["modelo"][$i].",");
        }
      ?>
   	],
   	rowNum:<?php echo($cantidad_mostrar); ?>,
    rownumbers: true,
	rownumWidth: 40,
    rowList : [<?php echo($cantidad_mostrar_filtrar); ?>],
    jsonReader: {
	  page: function (obj) { if(obj.exito){$("#busqueda_pagina").val(obj.page); return(obj.page);}else{ $("#busqueda_pagina").val(0); return(0); } },
	    total: function (obj) {$("#busqueda_total_paginas").val(obj.total); return(obj.total);  }	   
		},
        loadComplete: function () {
            var ts = this;
            if (ts.p.reccount === 0) {
                $(this).hide();
                emptyMsgDiv.show();
            } else {
                $(this).show();
                emptyMsgDiv.hide();
            }
        },
			<?php if($encabezado_pie["numcampos"]){ ?>
		footerrow:true,
		userDataOnFooter:true,
		gridComplete:function(){
    	var $self = $(this);
    	<?php
	    	for ($i=0; $i <$cant_f; $i++) {
	    		if($resultado[$i]["sumar"]==1){
	    			?>
							var colSum = $self.jqGrid('getCol', '<?php echo($resultado[$i]["nombre_columna"]); ?>', false, 'sum');
							$self.jqGrid('footerData', 'set', { '<?php echo($resultado[$i]["nombre_columna"]); ?>': colSum });
	    			<?php
	    		}else{
						if($resultado[$i]["tipo"]=="js"){
							?>
							$self.jqGrid("footerData","set",{"<?php echo($resultado[$i]["nombre_columna"]); ?>":<?php echo $resultado[$i]["nombre_funcion"];?>()});
							<?php
						}else{
							?>
								$self.jqGrid("footerData","set",{"<?php echo($resultado[$i]["nombre_columna"]); ?>":"<?php echo($resultado[$i]["nombre_funcion"]()); ?>"});
						<?php
						}
					}
				}
			?>
   	},
        loadComplete: function () {
            var ts = this;
            if (ts.p.reccount === 0) {
                $(this).hide();
                emptyMsgDiv.show();
            } else {
                $(this).show();
                emptyMsgDiv.hide();
            }
        },   	
   	<?php } ?>
   	pager: '#nav_busqueda',
    caption:"<?php echo $boton_buscar;?><button class=\"btn btn-mini btn-primary exportar_reporte_saia pull-left\" title=\"Exportar reporte <?php echo($datos_busqueda[0]['etiqueta']);?>\" enlace=\"<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>\">Exportar &nbsp;</button><?php echo($boton_adicionar); ?>  <?php echo $acciones_selecionados;?><div class=\"pull-left\" style=\"text-align:center; width:60%;\"><?php echo($datos_busqueda[0]['etiqueta']);?></div><div id=\"barra_exportar_ppal\"><iframe name='iframe_exportar_saia' height='25px' width='150px' frameborder=0 scrolling='no'></iframe></div></div>"
});
$grid.jqGrid('navGrid','#nav_busqueda',{edit:false,add:false,del:false,search:false});
	emptyMsgDiv.insertAfter($grid.parent());
	emptyMsgDiv.hide();
var cm = jQuery("#datos_busqueda")[0].p.colModel;
    $.each(jQuery("#datos_busqueda")[0].grid.headers, function(index, value) {
        var cmi = cm[index], colName = cmi.name;
        if(!cmi.sortable && colName!=='rn' && colName!=='cb' && colName!=='subgrid') {
            $('div.ui-jqgrid-sortable',value.el).css({cursor:"default"});
        }
    });

<?php
 if($datos_busqueda[0]["encabezado_grillas"]){ ?>
jQuery("#datos_busqueda").jqGrid('setGroupHeaders', {useColSpanStyle: false, groupHeaders:[
  <?php
  echo(implode(",",$titulos));
  ?>
  ]
});
<?php } ?>

$(".exportar_reporte_saia").click(function(obj){
	isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
    // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
	isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
	isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
	    // At least Safari 3+: "[object HTMLElementConstructor]"
	isChrome = !!window.chrome && !isOpera;              // Chrome 1+
	isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6
	if(isChrome||isIE){
		var busqueda_total=$("#busqueda_total_paginas").val();
		if(parseInt(busqueda_total)!=0){
			notificacion_saia('Espere un momento por favor, hasta que se habilite el enlace de descarga','success','',9500);
		}
	}
  exportar_funcion_excel_reporte();
});

$(window).bind('resize', function() {
    jQuery("#datos_busqueda").setGridWidth(($("#contenedor").width()-20), false);
}).trigger('resize');
});
function exportar_funcion_excel_reporte(){
	var busqueda_total=$("#busqueda_total_paginas").val();
	if(parseInt(busqueda_total)!=0){
	<?php
	$configuracion_temporal=busca_filtro_tabla("valor","configuracion","nombre='ruta_temporal' AND tipo='ruta'","",$conn);
  if($configuracion_temporal['numcampos']){
    $cont_ruta=$configuracion_temporal[0]['valor'];
    $cont_ruta .= '_'.usuario_actual("login");
    $ruta_temporal=$cont_ruta;
    crear_destino($ruta_db_superior . $cont_ruta);
  }
	?>
		
var ruta_file="<?php echo($ruta_temporal);?>/reporte_<?php echo($datos_busqueda[0]["nombre"].'_'.date('Ymd').'.xls'); ?>";
	var url="exportar_saia.php?tipo_reporte=1&idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>&page=1&exportar_saia=excel&ruta_exportar_saia="+ruta_file+"&rows="+$("#busqueda_registros").val()*4+"&actual_row=0&variable_busqueda="+$("#variable_busqueda").val()+"&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']);?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']);?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']);?>";
	window.open(url,"iframe_exportar_saia");
	}else{
		notificacion_saia('<b>ATENCI&Oacute;N</b><br>No hay registros para exportar','warning','',2000);
	}
}


</script>
<?php

function incluir_librerias_busqueda($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}

function incluir_librerias_pantalla($elemento,$indice){
  global $ruta_db_superior;
  include_once($ruta_db_superior.$elemento);
}

?>
