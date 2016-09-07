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
usuario_actual("login");
?>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<?php
echo(estilo_bootstrap());

    echo(librerias_html5());
    echo(librerias_jquery("1.7"));
    echo(librerias_UI());
    echo(librerias_kaiten());   
    echo(librerias_acciones_kaiten());      
	
	
	$click='';
	if(@$_REQUEST['click']){
		$click="&click=".$_REQUEST['click'];
		
	}
	$rol_tareas='';
	if(@$_REQUEST['rol_tareas']){
		$rol_tareas="&rol_tareas=".$_REQUEST['rol_tareas'];
	}
	$idtareas_listado_unico='';
	if(@$_REQUEST['idtareas_listado_unico']){
		$idtareas_listado_unico="&idtareas_listado_unico=".$_REQUEST['idtareas_listado_unico'];
	}	 
	 
    ?>         
</head>
<body>                      
<style>
  body{padding: 0px;}  
  #k-breadcrumb ul, ol{ margin: 0 0 0 0 }
  .k-panel .block-nav .items span{line-height:30px; text-shadow:0 -1px 0 transparent;}
  .k-panel .block-nav .items .label{color:#000000; line-height:30px; text-shadow:0 -1px 0 transparent; background-color:rgba(153, 153, 153, 0)}
</style>   
  <div id="contenedor_busqueda">
  </div>      
<script type="text/javascript">   
        $('#contenedor_busqueda').kaiten({ 
          columnWidth : '100%',
          startup : function(dataFromURL){          
            this.kaiten('load', { kConnector:'html.page', url:'listar_procesos.php?1=1<?php echo($click.$rol_tareas.$idtareas_listado_unico); ?>', 'kTitle':'Mis Tareas '});

          }
        });
        function crear_pantalla_busqueda(datos,elimina){
          $panel=$('#contenedor_busqueda').kaiten("getPanel",1);
          if(elimina){
            if(typeof($panel)!='undefined'){
              $('#contenedor_busqueda').kaiten("removeChildren",$panel);
            }
          }  
          datos["url"]="<?php echo($ruta_db_superior);?>"+datos["url"];
          $('#contenedor_busqueda').kaiten("load",datos);                                                  
        }         
           
</script>




</body>  


