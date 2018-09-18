<?php

include_once ("db.php");

if (@$_REQUEST['asignar_quitar_permiso_serie']) { // asigno o quito el permiso crear
    $idpermiso_serie = $_REQUEST['idpermiso_serie'];

    $sqlc = "UPDATE permiso_serie SET estado = 0 WHERE idpermiso_serie=$idpermiso_serie";
    phpmkr_query($sqlc) or die($sqlc);
    echo (1);
    die();
}
?>
<html>
<body>
<head>
<meta http-equiv="Content-Type" content="text/html; charset= UTF-8 ">
<?php
  include_once("class.funcionarios.php");
  include_once("librerias_saia.php");

  $config = busca_filtro_tabla("valor","configuracion","nombre='color_encabezado'","",$conn);

  echo librerias_jquery();

  ?>
	<script type="text/javascript" src="js/interface.js"></script>
	<style type="text/css" media="all">
* {
	margin: 0;
	padding: 0;
}
body {
	background: #ffffff;
	height: 100%;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
#myAccordion {
	width: 400px;
	border: 1px solid #F5F5F5;
	position: absolute;
	left: 10px;
	top: 25px;
	background-color:#F5F5F5;
}
#myAccordion dt {
	line-height: 20px;
	background-color: <?php echo($config[0]["valor"]); ?>;
	border-top: 2px solid #ffffff;
	border-bottom: 2px solid #000000;
	padding: 0 10px;
	font-weight: bold;
	color: #ffffff;
}
#myAccordion dd {
	overflow: auto;
}
#myAccordion p {
	margin: 16px 10px;
}
#myAccordion dt.myAccordionHover {
	background-color: #000077;
}
#myAccordion dt.myAccordionActive {
	background-color: <?php echo($config[0]["valor"]); ?>;
	border-top: 2px solid #ffffff;
	border-bottom: 2px solid #000000;
}
</style>
</head>
<body>
<dl id="myAccordion" width="400">
<?php
$datos = busca_datos_administrativos_funcionario(@$_REQUEST['key']);
echo (estilo());
for ($i = 0; isset($datos[$i]); $i++) {
    $dato = "";
    $index0 = $datos[$i][0];
    $index1 = $datos[$i][1];
    $index2 = $datos[$i][2];
	if(!$index2){
		$style='style="display: none;';
	}
		
    echo ('<dt class="someClass" '.$style.'>' . $index2 . '</dt><dd>');
	//}
    // for($j=0;isset($datos[$index0][$j]);$j++){
    switch ($index0) {
        case "informacion":
            echo ('<br />
              	<a class="enlace_detalles_funcionario" enlace="funcionarioedit.php?key=' . $datos[$index0][0] . '" target="detalles">Modificar Funcionario</a>&nbsp;&nbsp;
              	<a class="enlace_detalles_funcionario" enlace="compartir_documentos.php?accion=mover_documentos_adicionar&idfun=' . $datos[$index0][0] . '" target="detalles">Compartir Documentos</a>&nbsp;&nbsp;
              	<a class="enlace_detalles_funcionario" enlace="funcionariodelete.php?key=' . $datos[$index0][0] . '" target="detalles">Estados Funcionario</a><br /><br />
              ');
            $dato = mostrar_informacion_funcionario($datos[$index0][0], "");
            break;
        case "roles":
            echo ('<br />
              	<a class="enlace_detalles_funcionario"  enlace="dependencia_cargoadd.php?func=' . $datos["informacion"][0] . '" target="detalles">Adicionar Rol al Funcionario</a>&nbsp;&nbsp;
              	<a class="enlace_detalles_funcionario"  enlace="dependencia_cargoedit.php?func=' . $datos["informacion"][0] . '" target="detalles">Editar Roles del Funcionario</a><br /><br />');
            $dato = mostrar_informacion_roles($datos["roles"], array(
                "ver",
                "eliminar",
                "editar"
            ));
            break;
        case "series_funcionario":
            //$enlace_permiso = "pantallas/serie/asignarserie_entidad.php?llave_entidad=" . @$_REQUEST['key'] . "&tipo_entidad=1&pantalla=funcionario";
            $enlace_permiso = "pantallas/serie/permiso_serie.php?identidad={$_REQUEST['key']}&tipo_entidad=1";
            echo ('<br />
              	<a class="enlace_detalles_funcionario" enlace="' . $enlace_permiso . '" target="detalles">Asignar Serie al Funcionario</a><br /><br />');
            $dato = mostrar_informacion_serie($_REQUEST['key']);
            break;
        case "perfil":
            $perfil = busca_filtro_tabla("perfil", "funcionario", "idfuncionario=" . $_REQUEST['key'], "", $conn);
            // echo('<br /><a href="permiso_perfiladd.php?key='.$perfil[0][0].'&pantalla=funcionario" target="detalles">Adicionar/Quitar Permiso al Perfil</a><br /><br />');
            $dato = mostrar_informacion_permisos($datos["informacion"][0], "", array(
                "ver"
            ));
            break;
        case "permisos":
            echo ('<br /><a class="enlace_detalles_funcionario"  enlace="permisoadd.php?func=' . $datos["informacion"][0] . '" target="detalles">Adicionar/Quitar Permiso al Funcionario</a><br /><br />');
            $dato = mostrar_informacion_permisos($datos["informacion"][0], "permiso", array(
                "ver",
                "eliminar",
                "editar"
            ));
            // $dato=busca_filtro_tabla("*","modulo","idmodulo=".$datos[$index0][$j],"",$conn);
            break;
        default:
            // print_r($datos[$index0]);
            $dato = "No se puede Encontrar una Asignacion para este item";
            break;
    }
    // $dato= busca_filtro_tabla($index3,$index1,"id".$index1."=".$datos[$index0][$j],"",$conn);
    // echo($sql);
    // }
    echo ($dato);
    echo ('</dd>');
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

		$('.enlace_detalles_funcionario').click(function() {
			var enlace=$(this).attr('enlace');
			window.parent.frames["detalles"].location=enlace;
		});

		$(".btnBorrarPermisoSerie").click(function () {
			var eliminar = false;
            $.ajax({
                type:"POST",
                dataType: "html",
                async: false,
                url: "funcionario_detalles.php",
                data: {
                	asignar_quitar_permiso_serie: 1,
                	idpermiso_serie: $(this).attr("data-idpermiso")
                },
                success: function(exito){
                    var mensaje="Error";
                    if(exito == 1){
                    	eliminar = true;
                        mensaje="eliminado";
                        top.noty({text: "<b>ATENCI&Oacute;N</b><br>Permiso "+mensaje+" con exito!",type: "success",layout: "topCenter",timeout:2500});
                        //parent.hs.close();
                    }
                }
            });

            if(eliminar) {
    			$(this).closest('tr').remove();
		    	return true;
            }
		});
	});
</script>
<style>
	.enlace_detalles_funcionario{
		color: -webkit-link;
    	cursor: auto;
    	text-decoration: underline;
    	cursor:pointer;
	}
</style>

  </body>
</html>

<?php

function mostrar_informacion_serie($key) {
    global $conn;
    $cadena = '';

    $dato_f = busca_filtro_tabla("pse.*", "vpermiso_serie_entidad pse", "pse.idfuncionario = $key", "", $conn);
    if (@$dato_f["numcampos"]) {
        $cadena = '<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
   <tr>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">TIPO</span></td>
  <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ACCION</span></td>';
        $cadena .= '</tr>';
        if (@$dato_f) {
            $cadena .= muestra_serie($dato_f);
        }
        $cadena .= '</table>';
    }
    return ($cadena);
}

function muestra_serie($dato) {
    $cadena = '';

    for ($i = 0; $i < $dato["numcampos"]; $i++) {
        //var_dump($dato[$i]["idserie"]);
        $cadena .= '<tr id="' . $dato[$i]["idpermiso_serie"] . '">
	<td bgcolor="#F5F5F5"><span class="phpmaker">' . $dato[$i]["nombre_serie"] . '</span></td>
	<td bgcolor="#F5F5F5" align="center"><span class="phpmaker">';
        $cadena .= $dato[$i]["tipo_entidad"];
        $cadena .= '</span></td>';

        //$url = 'pantallas/serie/permiso_serie.php?idserie=' . $dato[$i]["idserie"];
        //$url .= "&idserie_padre=" . $dato[$i]["cod_padre"] . "&tipo_entidad=" . $dato[$i]["entidad_identidad"] . "&identidad=" . $dato[$i]["idfuncionario"];
        $cadena .= '<td bgcolor="#F5F5F5" align="center"><span class="phpmaker"><a href="#" class="btnBorrarPermisoSerie" data-idpermiso="' . $dato[$i]["idpermiso_serie"] . '">';
        $cadena .= '<img src="botones/general/borrar.png" alt="Eliminar" border="0"></a></span></td>';

        $cadena .= '</tr>';
        /*     $idserie = $_REQUEST["idserie"];
    $idserie_padre = $_REQUEST["idserie_padre"];
    $tipo_entidad = $_REQUEST["tipo_entidad"];
    */
    }
    return ($cadena);
}

