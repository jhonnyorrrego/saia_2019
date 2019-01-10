<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/buscar_patron_archivo.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/generador/librerias.php");
include_once ($ruta_db_superior . "pantallas/generador/librerias_formato.php");
include_once ($ruta_db_superior . "pantallas/generador/librerias_bpmni.php");
include_once ($ruta_db_superior . "pantallas/modulo/librerias.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones.php");
include_once ($ruta_db_superior . "anexosdigitales/funciones_archivo.php");

if($_REQUEST['funciones_nucleo']){
	funciones_nucleo($_REQUEST["pantalla_idpantalla"],1);
}

function funciones_nucleo($pantalla_idpantalla, $tipo) {
    global $conn;
    $consulta_funciones = busca_filtro_tabla("","funciones_nucleo","","",$conn);

    $texto = '<div class="accordion" id="acordion_componentes" style="margin-bottom: 5px;">
     <div class="accordion-group">
     <div class="accordion-heading">
     <a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_componentes" href="#categoria_1">Funciones de nucleo</a></div>';
    if ($consulta_funciones["numcampos"]) {
        for ($i = 0; $i < $consulta_funciones["numcampos"]; $i++) {        	
            $texto_temp = lista_funciones_vincular($consulta_funciones[$i]["ruta"], $consulta_funciones[$i]["idfunciones_nucleo"],$consulta_funciones[$i]["nombre_funcion"],$consulta_funciones[$i]["etiqueta"],$consulta_funciones[$i]["imagen"]);
         
            if ($texto_temp != '') {               
                $texto .= $texto_temp;
                $texto_temp = '';
            }
        }		
    }
	
	$consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);
    $campos_excluir = array(
        "dependencia",
        "documento_iddocumento",
        "estado_documento",
        "firma",
        "serie_idserie",
        "encabezado"
    );
	if ($consulta_campos_lectura['numcampos']) {
        $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
        $campos_lectura = implode(",", $campos_lectura);
        $campos_lectura = str_replace(",", "','", $campos_lectura);
        $busca_idft = strpos($campos_lectura, "idft_");
        if ($busca_idft !== false) {
            $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $pantalla_idpantalla, "", $conn);
            $campos_lectura = str_replace("idft_", "id" . $consulta_ft[0]['nombre_tabla'], $campos_lectura);
            $campos_excluir[] =  $campos_lectura;
        }
    }

    $condicion_adicional = " and A.nombre not in('" . implode("', '", $campos_excluir) . "')"; 
	$campos = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $pantalla_idpantalla . " and etiqueta_html<>'campo_heredado' ".$condicion_adicional."", "A.orden", $conn);
	
    if ($campos["numcampos"]) {
    $texto.= '<div class="accordion" id="acordion_componentes" style="margin-bottom: 5px;">
     <div class="accordion-group">
     	
    		<a class="accordion-toggle" data-toggle="collapse" data-parent="#acordion_componentes" href="#categoria_1">Elementos del formato</a></div>';
		        for ($i = 0; $i < $campos["numcampos"]; $i++) {
		        	 $etiqueta = htmlentities(html_entity_decode(utf8_encode($campos[$i]["etiqueta"])));			
					$texto .= '
					<div id="categoria_' . $campos[$i]["nombre"] . '" class="accordion-body">
						<div class="accordion" style="margin-bottom: 5px;">
							<div  style="cursor:pointer;" id="camposPropios" name="{*'.$campos[$i]["nombre"] .'*}" idcamposFormato="' . $campos[$i]["idcampos_formato"] . '_campo">
						<span class="fa-fw fa '.$imagen.'"></span>&nbsp;' . $etiqueta . '</div>
		            	</div>
		            </div>';
		
		        }
		$texto.='
		</div>
     </div>';
    }
	 $retorno["codigo_html"] = $texto;
	 echo (json_encode($retorno));
}

function lista_funciones_vincular($ruta_libreria, $idlibreria,$nombre_funcion,$etiqueta,$imagen) {
    global $conn;

    $listado_funciones = buscar_funciones_archivo($ruta_libreria, "function", $nombre_funcion,0);
    
	$retorno=array();	
    $texto = '<div class="accordion" id="acordion_componentes" style="margin-bottom: 5px;">';
    foreach ($listado_funciones["resultado"] as $key => $valor) {
        $cant_funciones = '';
        $pos1 = strpos($valor, "(");
        $pos2 = strpos($valor, ")");
        $nombre = trim(substr($valor, 8, ($pos1 - 8)));
        $dato = trim(substr($valor, 8));
        $texto_param = $dato;		
        // strpos($texto_param,'$idformato,$iddoc') valida que la funcion sea valida como funcion de saia para los formatos
        if ($nombre != '' && preg_match('/\$idformato[\s]*,[\s]*\$\w*doc/',$texto_param)) {
            $texto .= '
            <div id="categoria_' . $nombre . '" class="accordion-body">
            	<div class="accordion" style="margin-bottom: 5px;">
            		<div style="cursor:pointer;"  id="funcionesPropias"  name="{*'.$nombre .'*}" idfuncionFormato="' . $idlibreria . '_func">
            			<span class="fa '.$imagen.' ' . $nombre . ' fa-fw"></span>&nbsp;' . $etiqueta . '</div>
            		</div>
            	</div>';
        }
    }
	$texto .= '</div>';
	return $texto;


}

?>