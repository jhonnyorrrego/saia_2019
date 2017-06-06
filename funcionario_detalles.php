<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<?php 
  include_once("class.funcionarios.php");
  $config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn); ?>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/interface.js"></script>
	<style type="text/css" media="all">
*
{
	margin: 0;
	padding: 0;
}
body
{
	background: #ffffff;
	height: 100%;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#myAccordion{
	width: 400px;
	border: 1px solid #F5F5F5;
	position: absolute;
	left: 10px;
	top: 25px;
	background-color:#F5F5F5;
}
#myAccordion dt{
	line-height: 20px;
	background-color: <?php echo($config[0]["valor"]); ?>;
	border-top: 2px solid #ffffff;
	border-bottom: 2px solid #000000;
	padding: 0 10px;
	font-weight: bold;
	color: #ffffff;
}
#myAccordion dd{
	overflow: auto;
}
#myAccordion p{
	margin: 16px 10px;
}
#myAccordion dt.myAccordionHover
{
	background-color: #000077;
}
#myAccordion dt.myAccordionActive
{
	background-color: <?php echo($config[0]["valor"]); ?>;
	border-top: 2px solid #ffffff;
	border-bottom: 2px solid #000000;
}
</style>
</head>
<body>
<dl id="myAccordion" width="400">
  <?php
    global $sql;
    $datos=busca_datos_administrativos_funcionario(@$_REQUEST['key']);  
    echo(estilo());
    for($i=0;isset($datos[$i]);$i++){
      $dato="";
      $index0=$datos[$i][0];
      $index1=$datos[$i][1];
      $index2=$datos[$i][2];
      echo('<dt class="someClass">'.$index2.'</dt><dd>');
       //for($j=0;isset($datos[$index0][$j]);$j++){
          switch($index0){
            case "informacion": 
              echo('<br /><a href="funcionarioedit.php?key='.$datos[$index0][0].'" target="detalles">Modificar Funcionario</a>&nbsp;&nbsp;<a href="compartir_documentos.php?accion=mover_documentos_adicionar&idfun='.$datos[$index0][0].'" target="detalles">Compartir Documentos</a>&nbsp;&nbsp;<a href="funcionariodelete.php?key='.$datos[$index0][0].'" target="detalles">Estados Funcionario</a><br /><br />');
              $dato=mostrar_informacion_funcionario($datos[$index0][0],"");
            break;
            case "roles": 
              echo('<br /><a href="dependencia_cargoadd.php?func='.$datos["informacion"][0].'" target="detalles">Adicionar Rol al Funcionario</a>&nbsp;&nbsp;<a href="dependencia_cargoedit.php?func='.$datos["informacion"][0].'" target="detalles">Editar Roles del Funcionario</a><br /><br />');
              $dato=mostrar_informacion_roles($datos["roles"],array("ver","eliminar","editar"));
            break;
            case "series_funcionario":
              echo('<br /><a href="asignarserie_entidad.php?llave_entidad='.@$_REQUEST['key'].'&tipo_entidad=1&pantalla=funcionario" target="detalles">Asignar Serie al Funcionario</a><br /><br />');              
              $series=array();
              array_push($series,$datos["series_funcionario"]);
              array_push($series,$datos["series_cargo"]);
              array_push($series,$datos["series_dependencia"]);              
              $dato=mostrar_informacion_serie($series,@$_REQUEST['key']); 
            break;
            case "perfil":
            $perfil=busca_filtro_tabla("perfil","funcionario","idfuncionario=".$_REQUEST['key'],"",$conn);
              //echo('<br /><a href="permiso_perfiladd.php?key='.$perfil[0][0].'&pantalla=funcionario" target="detalles">Adicionar/Quitar Permiso al Perfil</a><br /><br />');            
              $dato=mostrar_informacion_permisos($datos["informacion"][0],"",array("ver")); 
            break;
            case "permisos":
              echo('<br /><a href="permisoadd.php?func='.$datos["informacion"][0].'" target="detalles">Adicionar/Quitar Permiso al Funcionario</a><br /><br />');            
              $dato=mostrar_informacion_permisos($datos["informacion"][0],"permiso",array("ver","eliminar","editar")); 
              //$dato=busca_filtro_tabla("*","modulo","idmodulo=".$datos[$index0][$j],"",$conn);
            break;
            default:
               //print_r($datos[$index0]);
               $dato="No se puede Encontrar una Asignacion para este item";
            break;  
          }
          //$dato= busca_filtro_tabla($index3,$index1,"id".$index1."=".$datos[$index0][$j],"",$conn);
          //echo($sql);
       //}   
       echo($dato);
      echo('</dd>');    
     } ?>
</dl>
<script type="text/javascript">
	
	$(document).ready(
		function()
		{
			$('#myAccordion').Accordion(
				{
					headerSelector	: 'dt',
					panelSelector	: 'dd',
					activeClass		: 'myAccordionActive',
					hoverClass		: 'myAccordionHover',
					panelHeight		: 230,
					speed			: 300
				}
			);
		}
	);
</script>


<script>
	$(document).ready(function(){
		window.parent.frames["detalles"].location='funcionario_detalles_start.php?key=<?php echo(@$_REQUEST['key']); ?>';
	});
</script>


  </body>
</html>