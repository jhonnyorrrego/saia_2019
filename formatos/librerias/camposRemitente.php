<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "assets/librerias.php";
unset($_REQUEST["campos"]);
$_REQUEST["campos"] = array("titulo","cargo","direccion","telefono","email");

$contador = 1;
$cantidadCampos = count($_REQUEST["campos"]);
if($_REQUEST["tipoEjecutor"] == 2){
    echo campoJuridica($_REQUEST["campos"]);
}

if($_REQUEST["tipoEjecutor"] == 1){
    echo campoNatural($_REQUEST["campos"]);
}


function agregarResponsive(){
    global $contador, $cantidadCampos;
    if($contador % 2 == 0 && $contador == $cantidadCampos){
        $estilo = "col-md-6 pl-s-1 pr-md-2 pr-sm-3";
        $contador++;
    }else if($contador % 2 == 0 && $contador != $cantidadCampos){
        $estilo = "col-md-6 ";
        $contador++;
    }else if($contador % 2 != 0 && $contador != $cantidadCampos){
        $estilo = "col-md-6 pl-s-1 pl-md-0 ";
        $contador++;
    }else if($contador % 2 != 0 && $contador == $cantidadCampos){
        $estilo = "col-md-6 pr-md-2 pl-md-0";
        $contador++;
    }
    return $estilo;
}

function campoNatural($campos){

    $html = '<div class="row" id="contenido_remitente">';

    //Nombres
    $html .= '<div class="col-md-6">
                 <div class="form-group ">
                    <label class="mb-0" for="nombre_ejecutor">NOMBRES Y APELLIDOS</label>
                    <input type="text" class="form-control"  id="nombre_ejecutor" name="nombre">
                </div>
              </div>';

    //Identificación
    $html .= '<div class="col-md-6 pl-s-1">
                <div class="form-group ">
                    <label class="mb-0" for="identificacion_ejecutor">IDENTIFICACI&Oacute;N</label>
                    <input type="text" class="form-control pt-mb-0" id="identificacion_ejecutor" name="identificacion">
                </div>
            </div>';

    //Titulo
    if(in_array("titulo", $campos)){
        $html .= tituloEjecutorI('titulo');
    }
 
    if(in_array("cargo", $campos)){
        $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo_ejecutor" name="cargo_ejecutor" value="">
                    </div>
                </div>';
    }
    
    if(in_array("direccion", $campos)){
        $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion_ejecutor" name="direccion_ejecutor" value="">
                    </div>
                </div>';
    }

    if(in_array("telefono", $campos)){
        $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_ejecutor" name="telefono_ejecutor" value="">
                    </div>
                </div>';
    }

    if(in_array("email", $campos)){
        $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_email">Email</label>
                        <input type="text" class="form-control" id="email_ejecutor" name="email_ejecutor" value="">
                    </div>
                </div>';
    }

    $html .= '</div>';
    return $html;
}

function campoJuridica($campos){
    
        $html = '<div class="row" id="contenido_remitente">
            <div class="col-md-6">
                <div class="form-group ">
                    <label class="mb-0" for="nombre_ejecutor">Entidad</label>
                    <input type="text" class="form-control"  id="nombre_ejecutor" name="nombre">
                </div>
            </div>';

        $html .= '<div class="col-md-6">
                <div class="form-group ">
                    <label class="mb-0" for="identificacion_ejecutor">IDENTIFICACI&Oacute;N</label>
                    <input type="text" class="form-control" id="identificacion_ejecutor" name="identificacion">
                </div>
            </div>';

        if(in_array("cargo", $campos)){
            $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_cargo">Cargo</label>
                        <input type="text" class="form-control" id="cargo_ejecutor" name="cargo_ejecutor" value="">
                    </div>
                </div>';
        }
        
        if(in_array("direccion", $campos)){
            $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_direccion">Dirección</label>
                        <input type="text" class="form-control" id="direccion_ejecutor" name="direccion_ejecutor" value="">
                    </div>
                </div>';
        }
        
        if(in_array("telefono", $campos)){
            $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono_ejecutor" name="telefono_ejecutor" value="">
                    </div>
                </div>';
        }
        
        if(in_array("empresa", $campos)){
            $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_telefono">Contacto</label>
                        <input type="text" class="form-control" id="contacto_ejecutor" name="contacto_ejecutor" value="">
                    </div>
                </div>';
        }

        if(in_array("email", $campos)){
            $html .= '<div class="' . agregarResponsive() . '">
                    <div class="form-group ">
                        <label class="mb-0" id="label_email">Email</label>
                        <input type="text" class="form-control" id="email_ejecutor" name="email_ejecutor" value="">
                    </div>
                </div>';
        }

        $html .= '</div>';

        return $html;
    }

    function tituloEjecutorI($nombre){
        
        $texto ='<div class="' . agregarResponsive() . '" id="div_titulo_ejecutor" >
                <div class="form-group form-group-default-select2 pb-md-0 pt-md-0" id="div_select_titulo_ejecutor">
                    <label class="mb-0" id="label_' . $nombre . '">Titulo</label>
                    <select class="full-width" name="titulo_ejecutor" id="titulo_ejecutor">
                    <option value="" >Seleccione...</option>';
                    
                    $titulos = array('Doctor', 'Doctora', 'Ingeniero', 'Ingeniera', "Se&ntilde;or", "Se&ntilde;ora");
                    for ($i = 0; $i < count($titulos); $i++) {
                            $texto .= '<option value="' . $titulos[$i] . '"';
                            $texto .= '>' . $titulos[$i] . '</option>';
                    }
    
        $texto .= '</select>	
                    <!--span class="label label-success" id="otro_titulo_ejecutor" style="cursor:pointer">Otro</span-->
          </div>
          <script type="text/javascript">
                            $("#titulo_ejecutor").select2();
                            $("#otro_titulo_ejecutor").click(function() {
                            $("#div_select_titulo_ejecutor").empty();
                            $("#div_select_titulo_ejecutor").append(' . "'" . '<label class="pb-0" id="label_' . $nombre . '">' . $nombre .':</label><input class="form-control" type="text"  name="titulo_ejecutor" id="titulo_ejecutor" value="">' . "'" . ');
                    });	
                    </script>
            </div>';
        return ($texto);
    }