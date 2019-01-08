<?php

$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = '';
while ($max_salida > 0) {
    if (is_file($ruta.'db.php')) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= '../';
    --$max_salida;
}
include_once $ruta_db_superior.'db.php';
include_once $ruta_db_superior.'librerias_saia.php';
if(usuario_actual("login")!='cerok'){
  echo("<span style='font: red;'>Permiso Denegado</span>");
  die();
}
echo (estilo_bootstrap());
echo(librerias_jquery());
if($_POST['adicionar']==1){
  formulario();
  if($_POST['tipo_consulta']==1){ //solo consultas tipo SELECT
    $consulta=busca_filtro_tabla($_POST['campos'],$_POST['tablas'],$_POST['condicion'],$_POST['groupby'].$_POST['orderby'],$conn);
    echo("<b>CONSULTA:</b><br>");
    print_r($consulta['sql']);
    echo("<br><b>CANTIDAD REGISTROS:".$consulta['numcampos']."</b><br>");
    echo("<hr>");
    if($consulta['numcampos']){
      $campos=array();

      $tabla="<table border='1' style='border-collapse:collapse'><tr>";
      $cont=count($consulta[0]);

      for($i=1;$i<$cont;$i=$i+2){
        next($consulta[0]);
        array_push($campos,key($consulta[0]));
        $tabla.= "<th><b>".key($consulta[0])."</b></th>";
        next($consulta[0]);
      }
      for ($i=0; $i < $consulta['numcampos']; $i++) {
        $tabla.="<tr>";
        //Se le resta 2 a $cont debido a que esto quita el campo numcampos y el sql de la consulta, de esta forma queda el total de resultados consultados
        for ($j=0; $j < $cont; $j=$j+1) {
          $tabla.="<td>".$consulta[$i][$j]."</td>";
        }
        $tabla.="</tr>";
      }
      $tabla.="</tr>";
      $tabla.="</table>";
      echo($tabla);
    }
  }elseif ($_POST['tipo_consulta']==2) { //solo acciones INSERT, UPDATE, DELETE
    phpmkr_query($_POST['consulta']) or die("error en la consulta: ".$_POST['consulta']);
  }
}else{
  $_POST['adicionar']=1;
  formulario();
}
function formulario(){
?>
  <html>
  <head>
    <!-- Latest compiled and minified CSS -->
  </head>
  <body>
    <div class="container">
        <form class="form-horizontal" method="post">
          <fieldset>
            <!-- Form Name -->
            <legend><h2>CONSULTA BASE DE DATOS</h2></legend>
            <!-- Multiple Radios (inline) -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="tipo_consulta">Tipo de consulta</label>
              <div class="col-md-4">
                <label class="radio-inline" for="tipo_consulta-0">
                  <input type="radio" name="tipo_consulta" id="tipo_consulta-0" value="1">
                  Consulta
                </label>
                <label class="radio-inline" for="tipo_consulta-1">
                  <input type="radio" name="tipo_consulta" id="tipo_consulta-1" value="2">
                  Accion
                </label>
              </div>
            </div>
            <!-- Textarea -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="consulta">Consulta</label>
              <div class="col-md-4">
                <textarea class="form-control" id="consulta" name="consulta"><?php echo($_POST['consulta']); ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="campos">Campos</label>
              <div class="col-md-4">
                <textarea class="form-control" id="campos" name="campos"><?php echo($_POST['campos']); ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="tablas">Tablas</label>
              <div class="col-md-4">
                <textarea class="form-control" id="tablas" name="tablas"><?php echo($_POST['tablas']); ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="condicion">Condicion</label>
              <div class="col-md-4">
                <textarea class="form-control" id="condicion" name="condicion"><?php echo($_POST['condicion']); ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="groupby">Agrupado Por</label>
              <div class="col-md-4">
                <textarea class="form-control" id="groupby" name="groupby"><?php echo($_POST['groupby']); ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="orderby">Ordenado por</label>
              <div class="col-md-4">
                <textarea class="form-control" id="orderby" name="orderby"><?php echo($_POST['orderby']); ?></textarea>
              </div>
            </div>
            <!-- Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="enviar"></label>
              <div class="col-md-4">
                <input type="hidden" name="adicionar" value="<?php echo($_POST['adicionar']); ?>">
                <button id="enviar" name="enviar" class="btn btn-primary">ENVIAR</button>
              </div>
            </div>
          </fieldset>
        </form>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        validacion_campos($("input[name=tipo_consulta]").val());
        $("input[name=tipo_consulta]").change(function () {
          validacion_campos($(this).val());
        });
        function validacion_campos(campo){
          if(campo==1){
            $("#consulta").parent().parent().hide();
            $("#campos").parent().parent().show();
            $("#tablas").parent().parent().show();
            $("#condicion").parent().parent().show();
            $("#groupby").parent().parent().show();
            $("#orderby").parent().parent().show();
          }else{
            $("#consulta").parent().parent().show();
            $("#campos").parent().parent().hide();
            $("#tablas").parent().parent().hide();
            $("#condicion").parent().parent().hide();
            $("#groupby").parent().parent().hide();
            $("#orderby").parent().parent().hide();
          }
        }
      });
    </script>
  </body>
  </html>
  <?php
}
?>
