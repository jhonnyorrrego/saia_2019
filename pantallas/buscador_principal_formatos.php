<html>

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



		<title>Procesos </title>
		
		<style>
			body {
				padding: 0px;
			}
			#k-breadcrumb ul, ol {
				margin: 0 0 0 0
			}
			.k-panel .block-nav .items span {
				line-height: 30px;
				text-shadow: 0 -1px 0 transparent;
			}
			.k-panel .block-nav .items .label {
				color: #000000;
				line-height: 30px;
				text-shadow: 0 -1px 0 transparent;
				background-color: rgba(153, 153, 153, 0)
			}
		</style>		
		
		
	</head>
	<body>







		<div id="contenedor_busqueda" style="position: relative; height: 100%;">
			<iframe id="iframe-download" class="hidden" src=""></iframe>
			<div id="k-window">
				<div id="k-topbar">
					<div id="mask" class="mask-20"></div>
					<div id="k-breadcrumb">
						<ul>
							<li id="crumb-kp1" class="last visible home">
								<a href="#" accesskey="h" title="Búsqueda "></a>
							</li>
						</ul>
					</div><div id="menu-border"></div>
					<div id="menu-container">

					</div>
					<div id="options-dlg" class="box-shadow">
						<div id="columns-controls" class="line">
							<strong id="columns-count">1 columna(s)</strong><button id="columns-inc" accesskey="p" title="+"></button><button id="columns-dec" accesskey="m" title="-" disabled="disabled" class="disabled"></button>
						</div>
						<div class="line footer">
							<!--p>Kaiten v1.2 (2012-03-17)</p><p>© 2004-2011 Nectil S.A. all rights reserved.</p-->
						</div>
					</div>
				</div>
				<div id="k-slider" >
					<div class="k-panel k-focus html html-page" id="kp1" style="left: 0px; width: 100%; display: block; overflow-y: hidden;">
						<div class="titlebar">
							<table>
								<tbody>
									<tr>
										<td class="left"><button class="tool nav-prev disabled" title="Panel anterior"></button><button class="tool reload" title="Recargar"></button></td><td class="center">
										<div class="title">
											Procesos
										</div></td><td class="right"><button class="tool maximize" title="Cambiar Tama&amp;ntilde;o" style="display: none;"></button><button class="tool nav-next disabled" title="Next panel"></button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="panel-options" style="display: none;">
							<div class="block-nav"></div>
						</div>
						<div class="panel-body" >
							<div class="block-nav">
								
								
								<?php
								$consulta=busca_filtro_tabla('','categoria_formato','cod_padre=2 and estado=1','',$conn);
								$cadena='';
								for($i=0;$i<$consulta['numcampos'];$i++){
											
									$nombre=$consulta[$i]['nombre'];
									$nombre=strtolower($nombre);
									$nombre=ucwords($nombre);
													
									$cadena.='
									
										<div title="'.$nombre.'" class="items navigable" tabindex="-1" conector="div_proceso" valor="'.$consulta[$i]['idcategoria_formato'].'">
											<div class="head"></div>
											<div class="label">
												'.$nombre.'
											</div>
											<div class="tail"></div>
										</div>	
									';			
								}
								
								echo($cadena);
								?>
								
							</div>
						</div>
						<div class="mask" style="display: none;">
							<div class="loader"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>
<script>
	$(document).ready(function(){
		
		$('[conector="div_proceso"]').click(function(){
			//alert( $(this).attr('valor') );
			
			
			window.location="<?php echo($ruta_db_superior); ?>pantallas/buscador_principal.php?idbusqueda=60&parametros_adicionales_buscador=idcategoria_formato@"+$(this).attr('valor');
			
			
		});
		
		
	});
</script>