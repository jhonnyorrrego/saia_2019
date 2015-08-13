<!DOCTYPE >
    <head>
     <title>prueba</title>
     <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.9.1.custom.min.css" />
  <link rel="stylesheet" type="text/css" href="css/ui.jqgrid.css" />
     <script src="../js/jquery-1.7.min.js" type="text/javascript"></script>
     <script src="js/i18n/grid.locale-es.js" type="text/javascript"></script>
     <script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#list").jqGrid({
     url:'../pantallas/busquedas/servidor_busqueda.php?idbusqueda_componente=3',
     //url:'prueba.php', 
     datatype: "json",
     height: 250,
     colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
     colModel:[
      {name:'idfuncionario',index:'idfuncionario'},
      {name:'nombres',index:'nombres'},
      {name:'apellidos',index:'apellidos'},
      {name:'login',index:'login', align:"right"},
      {name:'clave',index:'clave', align:"right"},
      {name:'nombres',index:'nombres',align:"right"},
      {name:'apellidos',index:'apellidos', sortable:false}
      ],
     rowNum:10, 
     rowList:[10,20,30], 
     pager: '#pager2', 
     sortname: 'idfuncionario', 
     viewrecords: true, 
     sortorder: "desc", 
     caption:"JSON Example",
     altRows: true
    });
    jQuery("#list").jqGrid('navGrid','#pager2',{edit:false,add:false,del:false});
  });
  </script>
    </head>
    <body>
     <table id='list' width="100%"></table>
     <div id="pager2" align="center"></div>
 </body>
</html>