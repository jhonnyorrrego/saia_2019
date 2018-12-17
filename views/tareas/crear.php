<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

foreach($_REQUEST as $key => $value){
    $$key = $value;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
    <ul class="nav nav-tabs" id="taskTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#information" role="tab" aria-controls="information" aria-selected="true">Tarea</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#comments" role="tab" aria-controls="comments" aria-selected="false">Comentarios</a>
        </li>
    </ul>
    <div class="tab-content" id="taskTabContent">
        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
            <form>
                <div class="form-group form-group-default required">
                    <label for="name">Nombre</label>
                    <input type="email" class="form-control" id="name" placeholder="Crear documento x.">
                </div>
                <div class="form-group form-group-default required">
                    <label for="initial_date">Fecha inicio</label>
                    <input type="date" class="form-control" id="initial_date">
                </div>
                <div class="form-group form-group-default required">
                    <label for="final_date">Fecha vencimiento</label>
                    <input type="date" class="form-control" id="final_date">
                </div>
                <div class="form-group form-group-default required invisible">
                    <label for="description">Descripción</label>
                    <textarea class="form-control" id="description" rows="3"></textarea>
                </div>
                <div class="form-group form-group-default required invisible">
                    <label for="manager">Responsable</label>
                    <input type="email" class="form-control" id="manager" placeholder="crear autocompletar unico">
                </div>
                <div class="form-group form-group-default required invisible">
                    <label for="co_manager">Co-participantes</label>
                    <input type="email" class="form-control" id="co_manager" placeholder="crear autocompletar multiple">
                </div>
                <div class="form-group form-group-default required invisible">
                    <label for="follower">Seguidor</label>
                    <input type="email" class="form-control" id="follower" placeholder="crear autocompletar multiple">
                </div>
                <div class="form-group form-group-default required invisible">
                    <label for="checker">Evaluador</label>
                    <input type="email" class="form-control" id="checker" placeholder="Crear documento x.">
                </div>                
                <div class="form-group form-group-default required invisible">
                    <label for="priority">Prioridad</label>
                    <select class="form-control" id="priority">
                        <option value=''>Seleccione..</option>
                        <option value='1'>Alta</option>
                        <option value='2'>Media</option>
                        <option value='3'>Baja</option>
                    </select>
                </div>
                <div class="form-group">
                    concurrencia
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="comments" role="tabpanel" aria-labelledby="comments-tab">
            listado de comentarios    
        </div>
    </div>
</body>
</html>