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

require_once $ruta_db_superior . "controllers/autoload.php";

$idexpediente = $_REQUEST['codPadre'];
if (!$idexpediente) {
    return;
}

$params = $_REQUEST;
$params['baseUrl'] = $ruta_db_superior;

$ExpCodPadre = new Expediente($idexpediente);
$Dep = $ExpCodPadre->getRelationFk('Dependencia');
$Serie = $ExpCodPadre->getRelationFk('Serie');

include_once $ruta_db_superior . 'assets/librerias.php';
echo validate();
?>

<div class="card card-default">
    <div class="card-body">

        <form role="form" method="post" name="formularioExp" id="formularioExp">
            <div class="form-group required">
                <label>Tipo *</label>
                <div class="radio radio-info">
                    <input type="radio" checked="checked" value="0" name="agrupador" id="AgExp">
                    <label for="AgExp">Expediente</label>
                    <input type="radio" value="3" name="agrupador" id="AgAgr">
                    <label for="AgAgr">Separador</label>
                </div>
            </div>

            <div class="form-group">
                <label>Nombre *</label>
                <input type="text" class="form-control" name="nombre" id="nombre">
            </div>

            <div class="form-group ocultar">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>

            <div class="form-group ocultar">
                <label>Indice uno </label>
                <input type="text" class="form-control" name="indice_uno" id="indice_uno">
            </div>

            <div class="form-group ocultar">
                <label>Indice dos </label>
                <input type="text" class="form-control" name="indice_dos" id="indice_dos">
            </div>

            <div class="form-group ocultar">
                <label>Indice tres </label>
                <input type="text" class="form-control" name="indice_tres" id="indice_tres">
            </div>


            <div class="form-group ocultar">
                <label>Caja</label>
                <select class="form-control" name="fk_caja" id="fk_caja">
                    <option value="">por favor seleccione</option>
                    <?= Expediente::getHtmlCaja($ExpCodPadre) ?>
                </select>
                <input type="hidden" name="cajaAnt" id="cajaAnt" value="<?= $ExpCodPadre->fk_caja ?>">
            </div>

            <div class="form-group ocultar">
                <i id="iconInfAdicional" class="fa fa-minus-square"></i> Información Adicional
            </div>

            <div id="informacionAdicional">
                <div class="form-group ocultar">
                    <label>Codigo numero</label>
                    <span class="help">e.j. "Código Dependencia - Código Serie - Numero"</span>
                    <input type="text" class="form-control" name="codDependencia" id="codDependencia" value="<?= $Dep->codigo; ?>" disabled="">
                    <input type="text" class="form-control" name="CodSerie" id="CodSerie" value="<?= $Serie->codigo ?>" disabled="">
                    <input type="text" class="form-control" name="codigo_numero" id="codigo_numero">
                </div>

                <div class="form-group ocultar">
                    <label>Fondo</label>
                    <input type="text" class="form-control" name="fondo" id="fondo" value="<?= $Dep->nombre; ?>">
                </div>

                <div class="form-group ocultar">
                    <label>Proceso</label>
                    <input type="text" class="form-control" name="proceso" id="proceso">
                </div>

                <div class="form-group ocultar">
                    <label>Fecha extrema inicial</label>
                    <input type="date" class="form-control" id="fecha_extrema_i" name="fecha_extrema_i">
                </div>

                <div class="form-group ocultar">
                    <label>Fecha extrema final</label>
                    <input type="date" class="form-control" id="fecha_extrema_f" name="fecha_extrema_f">
                </div>

                <div class="form-group ocultar">
                    <label>Consecutivo inicial</label>
                    <input type="text" class="form-control" name="consecutivo_inicial" id="consecutivo_inicial">
                </div>

                <div class="form-group ocultar">
                    <label>Consecutivo final</label>
                    <input type="text" class="form-control" name="consecutivo_final" id="consecutivo_final">
                </div>

                <div class="form-group ocultar">
                    <label>Unidad de conservación</label>
                    <input type="text" class="form-control" name="no_unidad_conservacion" id="no_unidad_conservacion">
                </div>


                <div class="form-group ocultar">
                    <label>No de folios</label>
                    <input type="text" class="form-control" name="no_folios" id="no_folios">
                </div>

                <div class="form-group ocultar">
                    <label>No de carpeta</label>
                    <input type="text" class="form-control" name="no_carpeta" id="no_carpeta">
                </div>

                <div class="form-group ocultar">
                    <label>Soporte</label>
                    <select class="form-control" name="soporte" id="soporte">
                        <option value="">por favor seleccione</option>
                        <?= Expediente::getHtmlField('soporte', 'select') ?>
                    </select>
                </div>

                <div class="form-group ocultar">
                    <label>Frecuencia</label>
                    <select class="form-control" name="frecuencia_consulta" id="frecuencia_consulta">
                        <option value="">por favor seleccione</option>
                        <?= Expediente::getHtmlField('frecuencia_consulta', 'select') ?>
                    </select>
                </div>

                <div class="form-group ocultar">
                    <label>Notas de transferencia</label>
                    <textarea class="form-control" name="notas_transf" id="notas_transf"></textarea>
                </div>

            </div>

            <div class="form-group">
                <input type="hidden" name="methodInstance" value="createExpedienteCont">
                <input type="hidden" name="nameInstance" value="ExpedienteController">
                <input type="hidden" name="generarFiltro" value="1">
                <input type="hidden" id="cod_padre" name="cod_padre" value="<?= $idexpediente ?>">
                <input type="hidden" id="idbusqueda_componente" name="idbusqueda_componente" value="<?= $_REQUEST['idbusqueda_componente'] ?>">
                <button id="cancelExp" type="button" class="btn btn-danger">
                    Cancelar
                </button>
                <button id="guardarExp" type="submit" class="btn btn-complete">
                    Adicionar
                </button>
            </div>

        </form>
    </div>
</div>
<script id="scriptAddExp" src="<?= $ruta_db_superior ?>views/expediente/js/adicionar_expediente.js" data-params='<?= json_encode($params) ?>'> 