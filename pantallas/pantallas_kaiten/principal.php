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
<?php
$adicional="";
$request=array();
foreach(@$_REQUEST as $id => $value){
  $request[]=$id."=".$value;
}
if(count($request)){
  $adicional="?".implode("&",$request);
}

$idmodulo=@$_REQUEST['idmodulo'];
if(!$idmodulo){
    echo('<br><center><div class="alert alert-warning"><b>ATENCI&Oacute;N</b><br>No se recibieron los parametros suficientes para generar la barra de navegaci&oacute;n</div></center>');
    die();
}
$modulo=busca_filtro_tabla("etiqueta,enlace","modulo","idmodulo in(".$idmodulo.")","",$conn);
$url=$ruta_db_superior.$modulo[0]['enlace'];
$etiqueta=codifica_encabezado(html_entity_decode($modulo[0]['etiqueta']));
$etiqueta_titulo=$etiqueta;
if(@$_REQUEST['etiqueta'] && @$_REQUEST['etiqueta']!=''){
    $etiqueta_titulo=codifica_encabezado(html_entity_decode($_REQUEST['etiqueta']));
}
?>
<script type="text/javascript">   
        $('#contenedor_busqueda').kaiten({ 
          columnWidth : '100%',
          startup : function(dataFromURL){          
            this.kaiten('load', { kConnector:'html.page', url:'listador.php<?php echo($adicional); ?>', 'kTitle':'<?php echo($etiqueta_titulo); ?>'});
            this.kaiten('load', { kConnector:'iframe', url:'<?php echo($url); ?>', 'kTitle':'<?php echo($etiqueta); ?>'});
          }
        });
        function crear_pantalla_busqueda(datos,elimina){
          $panel=$('#contenedor_busqueda').kaiten("getPanel",1);
          if(elimina){
            if(typeof($panel)!='undefined'){
              $('#contenedor_busqueda').kaiten("removeChildren",$panel);
            }
          }
          datos["url"]=datos["url"];
          $('#contenedor_busqueda').kaiten("load",datos);                                                  
        }         
</script>
</body>  