<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
    } $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_cripto.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_componentes.php");
include_once($ruta_db_superior."librerias_saia.php");

function mostrar_seleccionados_caja($id,$campo="nombre",$tabla){
    global $conn;
    $dato=busca_filtro_tabla($campo,$tabla,"id".$tabla."='".$id."'","",$conn);
    $etiquetas=extrae_campo($dato,$campo,"m");
    return(ucwords(implode(", ",$etiquetas)));
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>css/bootstrap/saia/css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>css/bootstrap/saia/css/bootstrap-responsive.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>pantallas/lib/librerias_css.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>css/bootstrap/saia/css/bootstrap_reescribir.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior); ?>css/bootstrap/saia/css/bootstrap-datetimepicker.min.css"/>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery-1.7.min.js"></script>
<?php 
echo(librerias_arboles());
?>
<form name="formulario_caja" id="formulario_caja" method="post">
    <input type="hidden" name="obtener_idbusqueda_filtro_temp" value="1"/>
    <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?=$_REQUEST["idbusqueda_componente"];?>"/>

    <legend>
        Crear caja
    </legend>
    <div class="control-group element">
        <label class="control-label" for="ubicacion">Ubicaci&oacute;n </label>
        <div class="controls">
            <select name="ubicacion" id="ubicacion">
                <option value="">Por favor seleccione...</option>
                <option value="1" <?=($datos[0]["ubicacion"] == 1) ? "selected" : ""; ?>>Central</option>
                <option value="2" <?=($datos[0]["ubicacion"] == 2) ? "selected" : ""; ?>>Gesti&oacute;n</option>
                <option value="3" <?=($datos[0]["ubicacion"] == 3) ? "selected" : ""; ?>>Historico</option>
            </select>
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="codigo">Codigo * </label>
        <div class="controls">
            <input type="text"  id="cod_consecutivo" required="required" name="no_consecutivo" value="" style="width:30%;">
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="fondo">Fondo </label>
        <div class="controls">
            <input type="text" name="fondo" id="fondo" value="">
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="seccion">Seccion </label>
        <div class="controls">
            <input type="text" name="seccion" id="seccion" value="">
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="subseccion">Subseccion </label>
        <div class="controls">
            <input type="text" name="subseccion" id="subseccion" value="">
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="division">Ubicaci&oacute;n exacta </label>
        <div class="controls">
            <input type="text" name="division" id="division" value="">
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="modulo">Estanter&iacute;a </label>
        <div class="controls">
            <input type="text" name="modulo" id="modulo" value="">
        </div>
    </div>
    <div class="control-group element">
        <label class="control-label" for="panel">Entrepa&ntilde;o </label>
        <div class="controls">
            <input type="text" name="panel" id="panel" value="">
        </div>
    </div>
    <div class="control-group element">
        <label class="control-label" for="nivel">Nivel </label>
        <div class="controls">
            <input type="text" name="nivel" id="nivel" value="">
        </div>
    </div>
    <div class="control-group element">
        <label class="control-label" for="material">Material </label>
        <div class="controls">
            <select name="material" id="material">
                <option value="">Seleccione.</option>
            </select>
        </div>
    </div>

    <div class="control-group element">
        <label class="control-label" for="seguridad">Seguridad </label>
        <div class="controls">
            <select name="seguridad" id="seguridad">
                <option value="">Por favor seleccione...</option>
                <option value="1" <?=($datos[0]["seguridad"] == 1) ? "selected" : ""; ?>>Confidencial</option>
                <option value="2" <?=($datos[0]["seguridad"] == 2) ? "selected" : ""; ?>>Publica</option>
                <option value="3" <?=($datos[0]["seguridad"] == 3) ? "selected" : ""; ?>>Rutinario</option>
                <option value="4" <?=($datos[0]["seguridad"] == 4) ? "selected" : ""; ?>>Restringido al cargo asignado</option>
            </select>
        </div>
    </div>

    <input type="hidden" name="funcionario_idfuncionario" id="funcionario_idfuncionario" value="<?php echo(usuario_actual('idfuncionario')); ?>">

    <input type="hidden" name="key_formulario_saia" value="<?=generar_llave_md5_saia(); ?>">
    <input type="hidden"  name="ejecutar_caja" value="set_caja"/>
    <input type="hidden"  name="tipo_retorno" value="1"/>
    <div>
        <button class="btn btn-primary btn-mini" id="submit_formulario_caja">
            Aceptar
        </button>
        <button class="btn btn-mini" id="cancel_formulario_caja">
            Cancelar
        </button>

        <div id="cargando_enviar" class="pull-right"></div>
    </div>
</form>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.validate_v1.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/idiomas/jquery.validates.es.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/jquery.noty.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/layouts/topCenter.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/noty/themes/default.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_notificaciones.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/librerias_codificacion.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bootstrap/saia/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    
    function llenar_campos_codigo(iddependencia, idserie) {
        $.ajax({
            type : "GET",
            url : "<?php echo $ruta_db_superior."pantallas/caja/consulta_codigos.php"?>",
            data : {
                idserie : idserie,
                iddependencia : iddependencia
            },
            success : function(response) {
                var response = $.parseJSON(response);
                $("#cod_serie").val(response.codigo_serie);
                $("#cod_dependencia").val(response.codigo_dependencia);
                $("#fondo").val(response.nombre_dependencia);
            },
            error : function() {
                alert("error consultando los codigos");
            }
        });
    }


	$("#cod_consecutivo").change(function() {
    	var consecutivo = $(this).val();
    	$.ajax({
            type: "POST",
            url: '<?php echo($ruta_db_superior); ?>pantallas/caja/verificar_consecutivo.php',
            data:{consecutivo:consecutivo},
            success: function(respuesta){
            	if(respuesta==0){
        			notificacion_saia("El consecutivo ya existe, por favor digitar uno diferente","error","",4000);
        			$("#cod_consecutivo").val(" ");
        		}
            }
		});
	});
	consultar_materiales_caja();
	
    function consultar_materiales_caja() {
        $.ajax({
            type : "GET",
            url : "<?php echo $ruta_db_superior."pantallas/caja/consulta_materiales_caja.php"?>",
            success : function(response) {
                response = $.parseJSON(response);
                $.each(response, function(index, value) {
                    $("#material").append(new Option(value.nombre, value.valor));
                });
            },
            error : function() {
                alert("error consultando los materiales");
            }
        });
    }
    
    $('#fecha_extrema_i').datetimepicker({
        language : 'es',
        pick12HourFormat : true,
        pickTime : false
    });
    $('#fecha_extrema_f').datetimepicker({
        language : 'es',
        pick12HourFormat : true,
        pickTime : false
    });
	
    var formulario_caja = $("#formulario_caja");
    formulario_caja.validate({
        "rules" : {
            "numero" : {
                "required" : true
            }
        },
        submitHandler : function(form) {
        }
    });
  
  $("#submit_formulario_caja").click(function() {
        if (formulario_caja.valid()) {
            $('#cargando_enviar').html("<div id='icon-cargando'></div>Procesando");
            $(this).attr('disabled', 'disabled');
            <?php encriptar_sqli("formulario_caja",0,"form_info",$ruta_db_superior,false,false); ?>

            $.ajax({
                type : 'POST',
                async : false,
                url: "<?php echo($ruta_db_superior);?>pantallas/caja/ejecutar_acciones.php",
                data : "rand=" + Math.round(Math.random() * 100000) + "&" + formulario_caja.serialize(),
                dataType : 'json',
                success : function(objeto) {
                    if (objeto.exito) {
                        let idcomponente='<?=$_REQUEST["idbusqueda_componente"];?>';
                        $.ajax({
                            type : 'POST',
                            async : false,
                            url: "<?php echo($ruta_db_superior);?>pantallas/busquedas/servidor_busqueda_exp.php",
                            data: {
                               idbusqueda_componente:idcomponente,
                                page : 1,
                                rows : 1,
                                actual_row : 0,
                                cantidad_total : 1,
                                idbusqueda_filtro_temp : objeto.idbusqueda_filtro_temp,
                            },
                            dataType:"json",
                            success : function(objeto2) {
                                if (objeto2.exito) {
                                    $("#<?php echo($_REQUEST['div_actualiza']);?>", parent.document).prepend(objeto2.rows[0].info);
                                }
                            }
                        });
                        $('#cargando_enviar').html("Terminado ...");
                        notificacion_saia(objeto.mensaje, "success", "", 2500);
                        window.open("detalles_caja.php?idcaja="+objeto.idcaja+"&idbusqueda_componente="+idcomponente+"&rand="+Math.round(Math.random()*100000),"_self");
                    } else{
                        $('#cargando_enviar').html("Terminado ...");
                        notificacion_saia(objeto.mensaje, "error", "", 8500);
                    }
                }
            });
            
        } else {
            notificacion_saia("Formulario con errores", "error", "", 8500);
        }
   });
    

});
</script>