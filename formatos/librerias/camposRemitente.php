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

include_once ($ruta_db_superior ."db.php");
include_once ($ruta_db_superior . "assets/librerias.php");
/*echo jquery();
echo bootstrap();
echo jqueryUi();
echo icons();*/

if($_REQUEST["tipoEjecutor"] == 2){
    echo campoJuridica();
}

if($_REQUEST["tipoEjecutor"] == 1){
    echo campoNatural();
}

function campoNatural(){

    $html = '<div class="row" id="contenido_remitente">';

    //Nombres
    $html .= '<div class="col-md-6">
                 <div class="form-group form-group-default">
                    <label for="nombre_ejecutor">NOMBRES Y APELLIDOS</label>
                    <input type="text" class="form-control"  id="nombre_ejecutor" name="nombre">
                </div>
              </div>';

    //Titulo
    $html .= tituloEjecutorI('titulo');

    //Identificación
    $html .= '<div class="col-md-6 pl-s-1 pl-md-0">
                <div class="form-group form-group-default">
                    <label for="identificacion_ejecutor">IDENTIFICACI&Oacute;N</label>
                    <input type="text" class="form-control" id="identificacion_ejecutor" name="identificacion">
                </div>
              </div>';

    //cargo
    $html .= '<div class="col-md-6">
                <div class="form-group form-group-default">
                    <label id="label_cargo">Cargo</label>
                    <input type="text" placeholder="Cargo" class="form-control" id="cargo_ejecutor" name="cargo_ejecutor" value="">
                </div>
              </div>';

    $html .= '<div class="col-md-6 pl-s-1 pl-md-0">
                <div class="form-group form-group-default">
                    <label id="label_direccion">Dirección</label>
                    <input type="text" placeholder="Dirección" class="form-control" id="direccion_ejecutor" name="direccion_ejecutor" value="">
                </div>
              </div>';       

    $html .= '<div class="col-md-6">
                <div class="form-group form-group-default">
                    <label id="label_telefono">Teléfono</label>
                    <input type="text" placeholder="Teléfono" class="form-control" id="telefono_ejecutor" name="telefono_ejecutor" value="">
                </div>
            </div>';

    $html .= '<div class="col-md-6 pl-s-1 pl-md-0 pr-md-2 pr-sm-3">
                <div class="form-group form-group-default">
                    <label id="label_email">Email</label>
                    <input type="text" placeholder="Email" class="form-control" id="email_ejecutor" name="email_ejecutor" value="">
                </div>
            </div>';

    $html .= '</div>';
    return $html;
}

function campoJuridica(){
        
        $campos = '<div class="row" id="contenido_remitente">
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="nombre_ejecutor">Entidad</label>
                    <input type="text" class="form-control"  id="nombre_ejecutor" name="nombre">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label for="identificacion_ejecutor">IDENTIFICACI&Oacute;N</label>
                    <input type="text" class="form-control" id="identificacion_ejecutor" name="identificacion">
                </div>
            </div>
            <div class="col-md-6 pl-s-1 pl-md-0">
                <div class="form-group form-group-default">
                    <label id="label_cargo">Cargo</label>
                    <input type="text" placeholder="Cargo" class="form-control" id="cargo_ejecutor" name="cargo_ejecutor" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group form-group-default">
                    <label id="label_direccion">Dirección</label>
                    <input type="text" placeholder="Dirección" class="form-control" id="direccion_ejecutor" name="direccion_ejecutor" value="">
                </div>
            </div>
            <div class="col-md-6 pl-s-1 pl-md-0">
                <div class="form-group form-group-default">
                    <label id="label_telefono">Teléfono</label>
                    <input type="text" placeholder="Teléfono" class="form-control" id="telefono_ejecutor" name="telefono_ejecutor" value="">
                </div>
            </div><div class="col-md-6">
            <div class="form-group form-group-default">
                <label id="label_telefono">Contacto</label>
                <input type="text" placeholder="Contacto" class="form-control" id="contacto_ejecutor" name="contacto_ejecutor" value="">
            </div>
            </div>
            <div class="col-md-6 pl-s-1 pl-md-0 pr-md-2 pr-sm-3">
                <div class="form-group form-group-default">
                    <label id="label_email">Email</label>
                    <input type="text" placeholder="Email" class="form-control" id="email_ejecutor" name="email_ejecutor" value="">
                </div>
            </div>
        </div>';

        return $campos;
    }

    function tituloEjecutorI($nombre){
        
        $texto ='<div class="col-md-6" id="div_titulo_ejecutor" >
                <div class="form-group form-group-default form-group-default-select2 pb-md-0 pt-md-0 pl-md-0 pl-sm-1" id="div_select_titulo_ejecutor">
                    <label class="pl-sm-2" id="label_' . $nombre . '">Titulo</label>
                    <select class="full-width" name="titulo_ejecutor" id="titulo_ejecutor">
                    <option value="" selected>Seleccione Título</option>';
                    
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
                            $("#div_select_titulo_ejecutor").append(' . "'" . '<label id="label_' . $nombre . '">' . $nombre .':</label><input class="form-control" type="text"  name="titulo_ejecutor" id="titulo_ejecutor" value="">' . "'" . ');
                    });	
                    </script>
            </div>';
        return ($texto);
    }