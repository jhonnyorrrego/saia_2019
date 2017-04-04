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

$idconfiguracion=@$_REQUEST['idconfiguracion'];
$idmodulo=@$_REQUEST['idmodulo'];

if(!$idconfiguracion || !$idmodulo){
    echo('<br><center><div class="alert alert-warning"><b>ATENCI&Oacute;N</b><br>No se recibieron los parametros suficientes para generar la pantalla kaiten</div></center>');
    die();
}
$etiqueta_modulo=busca_filtro_tabla("etiqueta","modulo","idmodulo=".$idmodulo,"",$conn);
$etiqueta=codifica_encabezado(html_entity_decode($etiqueta_modulo[0]['etiqueta']));

$configuracion_url=busca_filtro_tabla("valor","configuracion","idconfiguracion=".$idconfiguracion,"",$conn);
$url=$ruta_db_superior.$configuracion_url[0]['valor'];

?>
<script type="text/javascript">   
        $('#contenedor_busqueda').kaiten({ 
          columnWidth : '100%',
          startup : function(dataFromURL){          
            this.kaiten('load', { kConnector:'html.page', url:'listador.php<?php echo($adicional); ?>', 'kTitle':'<?php echo($etiqueta); ?>'});
            this.kaiten('load', { kConnector:'html.page', url:'<?php echo($url); ?>', 'kTitle':'<?php echo($etiqueta); ?>'});
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