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

include_once $ruta_db_superior . 'librerias_saia.php';

echo estilo_tabla_bootstrap("1.13");

echo librerias_tabla_bootstrap("1.13", false, false);
?>
<div>
<p>Permite la configuración y personalización del envío de notificaciones en tiempo real a usuario del Sistema o usuarios externos notificando el cambio de estado y/o enviando documentación que se haya creado.
</p>
</div>
<div>
<button type="button" class="btn btn-primary btn-sm">Crear notificaci&oacute;n</button>
</div>
<table data-toggle="table">
  <thead>
    <tr>
      <th class="etiqueta_campo">Acci&oacute;n para la notificaci&oacute;n</th>
      <th class="etiqueta_campo">Asunto</th>
      <th class="etiqueta_campo">Destinatario</th>
      <th class="etiqueta_campo"></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>Item 1</td>
      <td>$1</td>
    </tr>
    <tr>
      <td>2</td>
      <td>Item 2</td>
      <td>$2</td>
    </tr>
  </tbody>
</table>
