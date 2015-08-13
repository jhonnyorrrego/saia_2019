<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>jqGrid Demos</title>
<style>
html, body {
	margin: 0;			/* Remove body margin/padding */
	padding: 0;
	overflow: hidden;	/* Remove scroll bars on browser window */
	font: 12px "Lucida Grande", "Lucida Sans Unicode", Tahoma, Verdana;
	width: 100%;
	height: 100%
}
</style>
<link rel="stylesheet" type="text/css" media="screen" title="basic" href="../css/grid.css" />
<link rel="stylesheet" type="text/css" media="screen" href="../css/jqModal.css" />
<script src="../js/jquery.js" type="text/javascript"></script>
<script src="../js/jquery.splitter.js" type="text/javascript"></script>
<script src="../js/jquery.jqGrid.js" type="text/javascript"></script>
<script src="../js/jqModal.js" type="text/javascript"></script>
<script src="../js/jqDnR.js" type="text/javascript"></script>
<script type="text/javascript" src="../js/highslide-with-html.js"></script>
<script type="text/javascript">
    hs.graphicsDir = '../images/';
    hs.outlineType = 'rounded-white';
    hs.outlineWhileAnimating = true;
</script>
<style type="text/css">
* {
    font-family: Verdana, Helvetica;
    font-size: 10pt;
}
.highslide-html {
    background-color: white;
}
.highslide-html-blur {
}
.highslide-html-content {
	position: absolute;
    display: none;
}
.highslide-loading {
    display: block;
	color: black;
	font-size: 8pt;
	font-family: sans-serif;
	font-weight: bold;
    text-decoration: none;
	padding: 2px;
	border: 1px solid black;
    background-color: white;

    padding-left: 22px;
    background-image: url(../images/loader.white.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
}
a.highslide-credits,
a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}


/* Styles for the popup */
.highslide-wrapper {
	background-color: white;
}
.highslide-wrapper .highslide-html-content {
    width: 400px;
    padding: 5px;
}
.highslide-wrapper .highslide-header div {
}
.highslide-wrapper .highslide-header ul {
	margin: 0;
	padding: 0;
	text-align: right;
}
.highslide-wrapper .highslide-header ul li {
	display: inline;
	padding-left: 1em;
}
.highslide-wrapper .highslide-header ul li.highslide-previous, .highslide-wrapper .highslide-header ul li.highslide-next {
	display: none;
}
.highslide-wrapper .highslide-header a {
	font-weight: bold;
	color: gray;
	text-transform: uppercase;
	text-decoration: none;
}
.highslide-wrapper .highslide-header a:hover {
	color: black;
}
.highslide-wrapper .highslide-header .highslide-move a {
	cursor: move;
}
.highslide-wrapper .highslide-footer {
	height: 11px;
}
.highslide-wrapper .highslide-footer .highslide-resize {
	float: right;
	height: 11px;
	width: 11px;
	background: url(../images/resize.gif);
}
.highslide-wrapper .highslide-body {
}
.highslide-move {
    cursor: move;
}
.highslide-resize {
    cursor: nw-resize;
}
.highslide-display-block {
    display: block;
}
.highslide-display-none {
    display: none;
}
</style>
<?php
/*$columnas=array();
array_push($columnas,array("etiqueta"=>'Inv No',"name"=>'id',"index"=>'id',"align"=>"right","sortable"=>false));
print_r($columnas);*/
?>
<script type="text/javascript" >
var gridimgpath = '../images';
jQuery(document).ready(function(){

jQuery("#list10").jqGrid({
    height:200,
   	url:'maestro.php',
	datatype: "json",
   	colNames:['Fecha Inicio','Fecha Vencimiento', 'Estado', 'Reprograma','Terminar'],
    colModel:[
   		{name:'fecha_inicial',index:'fecha_inicial'},
   		{name:'fecha_final',index:'fecha_final'},
   		{name:'estado',index:'estado', align:"right"},
   		{name:'reprograma',index:'reprograma',  align:"right"},
   		{name:'terminar',index:'terminar',  align:"center"}
   		
   	],
   	rowNum:10,
   	rowList:[10,20,30],
   	imgpath: gridimgpath,
   	pager: jQuery('#pager10'),
   	sortname: 'idasignacion',
    viewrecords: true,
    sortorder: "desc",
	  multiselect: false,
	  caption: "ASignacion",
	  toolbar: [true,"top"],
	  onSelectRow: function(ids) {
		if(ids == null) {
			ids=0;
			if(jQuery("#list10_d").getGridParam('records') >0 )
			{
				jQuery("#list10_d").setGridParam({url:"detalle.php?id="+ids,page:1})
				.setCaption("Control Asignacion1: "+ids)
				.trigger('reloadGrid');
			}
		} else {
			jQuery("#list10_d").setGridParam({url:"detalle.php?id="+ids,page:1})
			.setCaption("Control Asignacion: "+ids)
			.trigger('reloadGrid');
		}
	}
}).navGrid('#pager10',{add:false,edit:false,del:false,search:false});

jQuery("#list10_d").jqGrid({
 height: 45,
   	url:'detalle.php?id=0',
	datatype: "json",
   	colNames:['Accion','Periodicidad', 'Anticipacion','Ultima Ejecucion', 'Ejecutar'],
   	colModel:[
   		{name:'accion',index:'accion'},
   		{name:'periocidad',index:'periocidad'},
   		{name:'anticipacion',index:'anticipacion', align:"right"},
   		{name:'ejecutar_hasta',index:'ejecutar_hasta', align:"right"},
   		{name:'ejecutar',index:'ejecutar', sortable:false, search:false}
   	],
   	rowNum:2,
   	rowList:[5,10,20],
   	imgpath: gridimgpath,
   	pager: jQuery('#pager10_d'),
   	sortname: 'accion',
    viewrecords: true,
    sortorder: "asc",
	  multiselect: false,
	  caption:"Control Asignacion"
}).navGrid('#pager10_d',{add:false,edit:false,del:false,search:false});
jQuery("#ms1").click( function() {
	var s;
	s = jQuery("#list10").getMultiRow();
	alert(s);
});
});
//$("#t_toolbar1").append("<a href=\"include-short.htm\" onclick=\"return hs.htmlExpand(this, { objectType: 'iframe' } )\" target=\"centro\">PP</a>");
</script>

</head>
<body>
<table id="list10" class="scroll" cellpadding="0" cellspacing="0"></table>
<div id="pager10" class="scroll" style="text-align:center;"></div>
<br />
<table id="list10_d" class="scroll" cellpadding="0" cellspacing="0"></table>
<div id="pager10_d" class="scroll" style="text-align:center;"></div>
</body
</html>
