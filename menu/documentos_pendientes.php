<?php if(!isset($_SESSION))
  session_start();	
?>
<html>
	<head>		
	  <link type="image/x-icon" rel="shortcut icon" href="images/favicon.ico">
		<link type="text/css" rel="stylesheet" href="css/main.css" media="screen" />
		<link type="text/css" rel="stylesheet" href="css/jDrawer.css" media="screen" />
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.jDrawer.js"></script>		
<?php
  if(@$_SESSION["LOGIN".LLAVE_SAIA]){
  include_once("../db.php");
  $usuario_actual=usuario_actual("idfuncionario");
  $modulo["numcampos"]=0;
  if(isset($_GET["modulo"])&&$_GET["modulo"]){
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
    } 
  }  
  ?>
	<script type="text/javascript">
		jQuery(document).ready(function($)
		{
			$("#jDrawer-1").jDrawer({direction: "left"});
		});
	</script>  
  <?php
  } 
?> 		
	</head>
	<body align="center">
<?php						
      if($tablas["numcampos"]){ ?>
		  <div class="wrapper" align="center">
			 <div class="module-drawer">			      
					<ul id="jDrawer-1" style="display: none">
      <?php                  
        for($j=0;$j<$tablas["numcampos"];$j++)
          { ?>
          <?php          
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
            if($j==0){
            ?>            
						<li class="jDrawer-active">      
            <?php }
            else {?>
            <li>
            <?php }?>  		
	            <div style="float: left; padding-left: 10px">
								<h3><?php echo($tablas[$j]["etiqueta"]);?></h3>
								<div class="jDrawer-divider"></div>
							</div>
							<div class="jDrawer-handle">
								<a href="<?php echo("../".$tablas[$j]["enlace"]);?>" target="centro">
									<img class="png" title="<?php echo($tablas[$j]["etiqueta"]);?>" alt="<?php echo($tablas[$j]["etiqueta"]);?>" src="<?php echo("../".$tablas[$j]["imagen"]);?>" width="30px" height="30px"/>
								</a>
							</div>     
            </li>                     
            <?php 
          } ?>
      		</ul>
				</div>
			</div>
<?php    
      }    ?>            
	</body>
</html>
