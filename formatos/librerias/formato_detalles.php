<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<?php
include_once("../../db.php");
include_once("estilo_formulario.php");
include_once("funciones_generales.php");
$config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","");
$idformato=@$_REQUEST["idformato"];
$iddoc=@$_REQUEST["iddoc"];
$texto="";
?>
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/interface.js"></script>
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
    if($idformato){
      $datos=busca_filtro_tabla("A.*,B.nombre AS nombre_formato","campos_formato A, formato B","A.formato_idformato=B.idformato AND A.etiqueta_html LIKE 'detalle' AND A.valor=".$idformato,"A.etiqueta");
      $formato0=busca_filtro_tabla("*","formato","idformato=".$idformato,"");
      $permiso=new PERMISO();
      $ok=$permiso->permiso_usuario($formato0[0]["nombre"],"");
      if($formato0["numcampos"] && $ok){
          $_SESSION["pagina_actual"]='formatos/'.$formato0[0]["nombre"].'/detalles_'.$formato0[0]["ruta_mostrar"].'?idformato='.$idformato.'&iddoc='.$iddoc;

          if($formato0[0]["etiqueta"]<>""){
            echo('<dt class="someClass">'.$formato0[0]["etiqueta"].' </dt><dd>');
              echo('<!--br><a href="../'.$formato0[0]["nombre"]."/".$formato0[0]["ruta_editar"].'?iddoc='.$iddoc.'" target="detalles">Editar</a-->');
              echo('<a href="../../ordenar.php?iddoc='.$iddoc.'" target="centro">Detalles</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
              echo('<a href="../'.$formato0[0]["nombre"]."/".$formato0[0]["ruta_mostrar"].'?iddoc='.$iddoc.'&idformato='.$formato0[0]["idformato"].'" target="detalles">Mostrar</a><br /><br />');
              $texto=datos_base_formato($formato0);
              echo($texto);
            echo('</dd>');
          }
        }
        else if(!$ok){
          alerta("Usted no posee permisos para visualizar el Formato");
          $datos["numcampos"]=0;
        }
        else{
          alerta("no se encuentra el formato");
          $datos["numcampos"]=0;
        }
    }
    else {
      alerta("no se encuentra el formato");
      $datos["numcampos"]=0;
    }

    for($i=0;$i<$datos["numcampos"];$i++){
      if($datos[$i]["etiqueta"]<>"" && $datos[$i]["valor"]&&$formato0["numcampos"] && $permiso->permiso_usuario($datos[$i]["nombre_formato"],"")){
        echo('<dt class="someClass">'.$datos[$i]["etiqueta"].'</dt><dd>');
          $texto=buscar_listado_formato($formato0[0]["nombre_tabla"],$datos[$i]["formato_idformato"]);
          echo($texto);
        echo('</dd>');
      }
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
  </body>
</html>