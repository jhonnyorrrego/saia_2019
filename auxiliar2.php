<?php
include_once("db.php");
/*
<Clase>
<Nombre>auxiliar2
<Parametros>
<Responsabilidades>Generar el codigo para dibujar cada uno de los botones del menú según los permisos que tenga el usuario
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/
?>
<script type="text/javascript" src="js/interface.js"></script> 
<link href="css/style.css" rel="stylesheet" type="text/css" />
<!--[if lt IE 7]>
 <style type="text/css">
 .dock img { behavior: url(js/iepngfix.htc) }
 </style>
<![endif]-->
<!--top dock -->
  <div class="dock" id="dock<?php echo @$_REQUEST["modulo"] ?>" >
  <div class="dock-container"  >
  <?php
  $ancho=46;
  $proximidad=40;
  $maxwidth=11;
  include("cargando.php");

  if(@$_SESSION["LOGIN".LLAVE_SAIA]){
  $usuario_actual=usuario_actual("idfuncionario");
  $modulo["numcampos"]=0;
  if(@$_GET["modulo"]){
    $modulo=busca_filtro_tabla("*","modulo A","A.idmodulo=".$_GET["modulo"],"",$conn);
   if($modulo["numcampos"]){
    $condicion="A.modulo_idmodulo=B.idmodulo AND B.cod_padre=".$modulo[0]["idmodulo"]." AND A.funcionario_idfuncionario=".$usuario_actual;
    $adicionados=busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND A.accion=1","",$conn);
    $suprimidos= busca_filtro_tabla("B.idmodulo","permiso A, modulo B",$condicion." AND (A.accion=0 OR A.accion IS NULL)","",$conn);
    $permisos_perfil=busca_filtro_tabla("C.idmodulo","permiso_perfil A,funcionario B,modulo C","A.perfil_idperfil=B.perfil AND A.modulo_idmodulo=C.idmodulo AND C.cod_padre=".$modulo[0]["idmodulo"]." AND B.idfuncionario=".$usuario_actual,"",$conn);
    $adicionales=extrae_campo($adicionados,"idmodulo","U");
    $suprimir=extrae_campo($suprimidos,"idmodulo","U");
    $permisos=extrae_campo($permisos_perfil,"idmodulo","U");
    $finales=array_diff(array_merge((array)$permisos,(array)$adicionales),$suprimir);
    if(count($finales))
     $tablas=busca_filtro_tabla("modulo.nombre,modulo.etiqueta,modulo.imagen,modulo.enlace,modulo.destino,modulo.ayuda,modulo.parametros","modulo","idmodulo IN(".implode(",",$finales).")","modulo.orden ASC",$conn);
    else
      $tablas["numcampos"]=0;
      if($tablas["numcampos"]){
        for($j=0;$j<$tablas["numcampos"];$j++)
          {
            $ayuda_submenu=$tablas[$j]["ayuda"];
            $arreglo=explode(",",$tablas[$j]["parametros"]);
            for($h=0;$h<count($arreglo)-1;$h++){
              if(array_search($arreglo[$h],$_REQUEST)!==FALSE && $_REQUEST[$arreglo[$h]]){
                if(!strpos($tablas[$j]["enlace"],"?"))
                 $tablas[$j]["enlace"].="?".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
                else  $tablas[$j]["enlace"].="&".$arreglo[$h]."=".$_REQUEST[$arreglo[$h]];
              }
            }
            if(isset($_REQUEST["key"]) && $_REQUEST["key"]<>"")
                {$tablas[$j]["enlace"]=str_replace("@key@",$_REQUEST["key"],$tablas[$j]["enlace"]);
                }
            echo("<a class=\"dock-item\" href=\"".$tablas[$j]["enlace"]);
            if(!strpos($tablas[$j]["enlace"],"?"))
              echo("?cmd=resetall\"");
            else echo("&cmd=resetall\"");
            echo(" target=\"".$tablas[$j]["destino"]."\"><img src=\"".$tablas[$j]["imagen"]."\"");
            echo (" ><span><pre style=\" ");
            if(isset($_REQUEST["color"]) && $_REQUEST["color"]<>"")
               {echo " color:".$_REQUEST["color"]."; font-size:9px;";
                $ancho=30;
                $proximidad=32;
                $maxwidth=12;
               }
            else
               {echo " font-size:11px; ";
                $ancho=46;
                $proximidad=40;
                $maxwidth=11;
               }
            echo (" font-family:verdana\">".$tablas[$j]["etiqueta"]."</pre></span></a>");
          }
      }
    }
  }
 }
?>
  </div>
</div>
<!--dock menu JS options -->
<script type="text/javascript">
<!--
	$(document).ready(
		function()
		{
			$('#dock<?php echo $_REQUEST["modulo"] ?>').Fisheye(
				{
					maxWidth: <?php echo $maxwidth; ?>,
					items: 'a',
					itemsText: 'span',
					container: '.dock-container',
					itemWidth: <?php echo $ancho; ?>,
					proximity: <?php echo $proximidad; ?>,
					alignment : 'center',
					valign: 'top',
					color: '#ffffff',
					halign : 'left'
				}
			)
		}
	);       
-->
</script>
<?php include("fin_cargando.php"); ?>