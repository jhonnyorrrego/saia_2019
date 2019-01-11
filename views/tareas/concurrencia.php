<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida --;
}
$fecha_inicial=date("Y-m-d");
if(@$_REQUEST["fecha_inicial"]){
    $fecha_inicial=$_REQUEST["fecha_inicial"];
}
$option='';
for($i=1;$i<31;$i++){
    $option.='<option value="'.$i.'">'.$i.'</option>';
}
$desde_formato=$_REQUEST['desde_formato'];
if($desde_formato!=1){
    $desde_formato=0;
}
?>
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen">
<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css" media="screen">
<script src='<?php echo($ruta_db_superior);?>js/moment.min.js'></script>
<script src='<?php echo($ruta_db_superior);?>js/moment-es.js'></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
<script>
$(document).ready(function() {
    $('.select2').select2();
});
</script>
<div class="form-group">
    <label class="my-0" for="recurrencia">Se repite<span class="text-danger">*</span></label>
    <select class="full-width select2" id="recurrencia" name="recurrencia" data-init-plugin="select2">
    	<option value="1" etiqueta="Dia(s)" momento="day">Cada d&iacute;a</option>
		<option value="3" etiqueta="Semana(s)" momento="week">Cada semana</option>
		<option value="4" etiqueta="Mes(es)" momento="month" selected="selected" >Cada mes</option>
		<option value="5" etiqueta="Año(s)" momento="year">Cada a&ntilde;o</option>
	</select>
</div>
<div class="form-group" id="tr_repetir_cada">
	<label class="my-0" for="repetir_cada">Repetir cada</label>
    <select class="full-width select2" id="repetir_cada" name="repetir_cada">
    	<?php
        	for($i=1;$i<31;$i++){
        	    echo '<option value="'.$i.'">'.$i.'</option>';
        	}
    	?>
    </select>&nbsp;<span id="etiqueta_repite_cada">Mes(es)</span>
</div>
<div class="form-group" id="tr_repetir_mes">
    <label class="my-0" for="date_ranger">Repetir cada</label>
    <div class="radio radio-success">
      <input type="radio" value="1" name="repetir_mes" checked="checked" id="dia_mes">
      <label for="dia_mes">Dia del Mes</label>
      <input type="radio" value="2" name="repetir_mes" id="dia_semana">
      <label for="dia_semana">Dia de la Semana</label>
    </div>
</div>
<div class="form-group" id="tr_dias_semana" style="display: none;">
    <label class="my-0" for="date_ranger">Repetir cada</label>
    <div class="checkbox check-success">
    	<input type="checkbox" name="dias_semana" value="0" id="do" />
    	<label for="do"> Do </label>
    	<input type="checkbox" name="dias_semana" value="1" id="lu" />
    	<label for="lu"> Lu </label>
    	<input type="checkbox" name="dias_semana" value="2" id="ma" />
    	<label for="ma"> Ma </label>
    	<input type="checkbox" name="dias_semana" value="3" id="mi" />
    	<label for="mi"> Mi </label>
    	<input type="checkbox" name="dias_semana" value="4" id="ju" />
    	<label for="ju"> Ju </label>
    	<input type="checkbox" name="dias_semana" value="5" id="vi" />
    	<label for="vi"> Vi </label>
    	<input type="checkbox" name="dias_semana" value="6" id="sa" />
    	<label for="sa"> Sa </label>
    </div>
</div>
<div class="form-group">
    <label class="my-0" for="description">Empieza el</label>
    <input class="form-control"type="text" value="<?php echo(date('Y-m-d'));?>" readonly="true" id="empieza_el" name="empieza_el">
</div>
<div class="form-group">
    <label class="my-0" for="description">Finaliza el</label>
    <div class="radio radio-success">
        <input type="radio" name="finaliza_el" value="1" checked="true" id="nunca">
        <label for="nunca"> Nunca</label><br/>
        <input type="radio" name="finaliza_el" value="2" id="al_cabo_de">
        <label for="al_cabo_de">Al cabo de</label>
        <input type="text" style="width:30px" id="finaliza_el_repeticiones" name="finaliza_el_repeticiones" maxlength="2"> Repeticiones<br/>
    	
		<div class="input-group ">
    		<div class="pull-left">
        	  <input type="radio" name="finaliza_el" value="3" id="finaliza_el">
        	  <label for="finaliza_el">El </label>
        	</div>
        	<input  type="text" class="form-control"  id="finaliza_el_fecha" name="finaliza_el_fecha">
    		<span class="input-group-text"><i class="fa fa-calendar"></i></span>
    
    <script type="text/javascript">
                $(function () {
                    var configuracion={"format":"L","locale":"es","useCurrent":true};
                    $("#finaliza_el_fecha").datetimepicker(configuracion);
                });
            </script>
            </div>
  	</div>
</div>
<div class="form-group">
	<input type="hidden" id="ejecuta_proxima" name="ejecuta_proxima" value="">
    <div id="resumen_recurrencia1"></div><span id="resumen_recurrencia3"></span>
    <div id="resumen_recurrencia2"></div>
    <div id="validar_recurrencia"></div>
</div>
<div class="form-group">
    <input type="hidden" id="ejecuta_proxima" name="ejecuta_proxima" value="">
    <div id="resumen_recurrencia1"></div><span id="resumen_recurrencia3"></span>
    <div id="resumen_recurrencia2"></div>
    <div id="validar_recurrencia"></div>
</div>
<div class="form-group text-right">
    <button class="btn btn-complete" id="save">Guardar</button>
</div>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.min.js"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/i18n/es.js"></script>
<script src="<?= $ruta_db_superior ?>views/tareas/js/informacion.js"></script>
<script type="text/javascript">
function semana_dia(fecha_calcular) {
  var date = moment(fecha_calcular);
  var cardinalidad = (0 | date.date() / 7);
  if(cardinalidad==3){
    var cardinalidad_temp=(0 | date.add(1,'week').date()/7);
    if(cardinalidad_temp == 0)
      cardinalidad=-1; 
  }
  if(cardinalidad==4){
    cardinalidad=-1;
  }
  return cardinalidad;
}
function info_finaliza(ejecuta_proxima){
  var cad_proxima='';
  switch($("[name='finaliza_el']:checked").val()){
    case "1":
      var temp_proxima=ejecuta_proxima.toISOString().split("T");
      cad_proxima="Pr&#243;xima ejecuci&#243;n:"+temp_proxima[0];
      $("#ejecuta_proxima").val(temp_proxima[0]);
    break;
    case "3":
      var fecha_finaliza=moment($("#finaliza_el_fecha").val());
      var temp_proxima=ejecuta_proxima.toISOString().split("T");
      if(ejecuta_proxima<=fecha_finaliza){
        cad_proxima="Pr&#243;xima ejecuci&#243;n:"+temp_proxima[0];
        $("#ejecuta_proxima").val(temp_proxima[0]);
      }  
      else{
        temp_proxima=fecha_finaliza.toISOString().split("T");
        cad_proxima="No existen m&#225;s repeticiones al "+temp_proxima[0];
        $("#ejecuta_proxima").val('');
      }
    break;
  }
  return(cad_proxima);
}
function info_resumen(){
  var days = new Array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
  var prefixes =new Array('Primer', 'Segundo', 'Tercer','Cuarto');
  var dia=moment($("#empieza_el").val());
  var ejecuta_proxima=moment($("#empieza_el").val()).add(parseInt($("#repetir_cada").val()),$("#recurrencia option:selected").attr("momento"));
  var ejecuta_hasta='';
  $("#resumen_recurrencia1").html("<b>Repite:</b><br>Cada "+$("#repetir_cada").val()+" "+$("#recurrencia option:selected").attr("etiqueta")+", desde "+$("#empieza_el").val());
  var cad_proxima=info_finaliza(ejecuta_proxima);
  $("#resumen_recurrencia3").html("");
  switch($("#recurrencia").val()){
    case "3":
      var selected = [];
      var dias = [];
      var dia_day=dia.day();
      var dia_select='';
      $("[name='dias_semana']").each(function() {
        if($(this).prop("checked")==true){
          selected.push(days[$(this).val()]);
          dias.push($(this).val());
        }
      });
      if(selected.length){
        $("#resumen_recurrencia3").html(selected.join(", "));  
      }
      for(var i=0;i<dias.length;i++){
        if(dias[i]>=dia_day && dia_select===''){
          dia_select=dias[i];
        }
      }
      if(dia_select===''){
        for(var i=0;i<dias.length;i++){
          if((dias[i]+7)>=dia_day && dia_select==''){
            dia_select=dias[i];
          }
        }
      }
      var nuevo_dia=null;
      if((dia_select-dia_day)<0){
        nuevo_dia=dia.add((dia_select-dia_day),'days').add($("#repetir_cada").val(),"week").format("YYYY-MM-DD");
      }
      else{
        nuevo_dia=dia.add((dia_select-dia_day),'days').add($("#repetir_cada").val(),"week").format("YYYY-MM-DD");
      }
      cad_proxima=info_finaliza(moment(nuevo_dia));
    break;
    case "4":
      if($("[name='repetir_mes']:checked").val()==2){
        var texto_dia_mes='';
        var semana_dia_mes=semana_dia($("#empieza_el").val());
        var nuevo_dia=null;
        if(semana_dia_mes==-1){
          texto_dia_mes='Ultimo';
          var fin_mes=moment($("#empieza_el").val()).add($("#repetir_cada").val(), 'months').endOf('month').format("YYYY-MM-DD");
          cant_dias=(moment(fin_mes).day()-dia.day());
          nuevo_dia=moment(fin_mes).subtract(cant_dias, 'days').format("YYYY-MM-DD");
          if(cant_dias<0){
            nuevo_dia=moment(nuevo_dia).subtract(1, 'week').format("YYYY-MM-DD");
          }
        }
        else{
          texto_dia_mes=prefixes[semana_dia_mes];
          nuevo_dia=moment($("#empieza_el").val()).add($("#repetir_cada").val(), 'month').startOf('month');
          temp_dia=dia.day()-nuevo_dia.day();
          if(temp_dia<0){
            temp_dia+=7;
          }
          nuevo_dia.add(temp_dia,'days').add(semana_dia_mes,"week").format("YYYY-MM-DD");
          
        }
        texto_dia_mes=texto_dia_mes+" "+days[dia.isoWeekday()];
        $("#resumen_recurrencia1").html("<b>Repite:</b><br> "+texto_dia_mes+" del mes, desde "+$("#empieza_el").val());
        cad_proxima=info_finaliza(moment(nuevo_dia));
      }
    break;
  }
  $("#resumen_recurrencia2").html(cad_proxima);
}

info_resumen();
$(document).ready(function (){
    	var desde_formato=<?php echo($desde_formato); ?>;
  $("[name=repetir_mes]").change(function(){
    info_resumen(); 
  });
  $("[name='finaliza_el']").change(function(){
    if($(this).val()==1){
      $("#finaliza_el_fecha").val('');
    }
    if($(this).val()==3 && $("#finaliza_el_fecha").val()==''){
    	$("#finaliza_el_fecha").datetimepicker('setValue',"<?php echo(date('Y-m-d'));?>");
    }
    info_resumen();
  });
  $(".highslide-move", window.parent.document).hide();
    	  
	$("#boton_guardar").click(function (){
    		if(desde_formato!=1){
		event.preventDefault();
		var info_recurrencia=JSON.stringify($("#formulario_recurrencia").serializeArray());
		window.parent.info_recurrencia.value=info_recurrencia;
		window.parent.hs.close();
    		}
	});
	
	$("#boton_cancelar").click(function (){
    		if(desde_formato!=1){
		event.preventDefault();
		var info_recurrencia=JSON.stringify($("#formulario_recurrencia").serializeArray());
		window.parent.info_recurrencia.value="";
		window.location.reload();
		window.parent.hs.close();
    		}
	});
	
  $("#finaliza_el_repeticiones").keyup(function (){
    this.value = (this.value + '').replace(/[^0-9]/g, '');
  });

  $("#recurrencia").change(function (){
		valor=$(this).val();
		var etiqueta=$("#recurrencia option:selected").attr("etiqueta");
		$("#etiqueta_repite_cada").empty().html(etiqueta);
		if(valor==1 || valor==5){
			$("#tr_repetir_cada").show();
			$("#tr_repetir_mes,#tr_dias_semana").hide();
		}else	if(valor==2){
			$("#tr_repetir_cada,#tr_repetir_mes,#tr_dias_semana").hide();
			$("#repetir_cada").val("1");
		}else if(valor==3){
		  var selected = [];
    $("[name='dias_semana']").each(function() {
      if($(this).prop("checked")==true)
        selected.push($(this).val());
    });
    if(selected.length==0){
      $("[name='dias_semana'][value='"+moment($("#empieza_el").val()).day()+"']").prop("checked",true);
    }
			$("#tr_repetir_cada,#tr_dias_semana").show();
			$("#tr_repetir_mes").hide();
		}else if(valor==4){
			$("#tr_repetir_cada,#tr_repetir_mes").show();
			$("#tr_dias_semana").hide();
		}
		info_resumen();
	});
	$("[name='dias_semana']").click(function(){
	  info_resumen();
	});
	$("#repetir_cada").change(function(){
	  info_resumen();
	});
});	
</script>

<?php
if(@$_REQUEST['fk_tareas_listado'] || @$_REQUEST['idtareas_listado_recur']){
	
	if(@$_REQUEST['fk_tareas_listado']){
		$datos_recurrencia=busca_filtro_tabla("","tareas_listado_recur","fk_tareas_listado=".$_REQUEST['fk_tareas_listado'],"",$conn);
	
	}else{
		$datos_recurrencia=busca_filtro_tabla("","tareas_listado_recur","idtareas_listado_recur=".$_REQUEST['idtareas_listado_recur'],"",$conn);
	
	}
	
	
	if($datos_recurrencia['numcampos']){
	?>
		<script>
			$(document).ready(function(){
				$('#recurrencia option[value="<?php echo($datos_recurrencia[0]['recurrencia']); ?>"]').attr('selected','selected');
				setTimeout(function(){ $('#recurrencia').trigger('change'); }, 100);
				$('#repetir_cada option[value="<?php echo($datos_recurrencia[0]['repetir_cada']); ?>"]').attr('selected','selected');
				setTimeout(function(){$('#repetir_cada').trigger('change'); }, 100);
				$('[name="repetir_mes"]').attr('checked',false);
				$('[name="repetir_mes"][value="<?php echo($datos_recurrencia[0]['repetir_mes']); ?>"]').attr('checked','checked');
				setTimeout(function(){$('[name="repetir_mes"]').trigger('change'); }, 100);
				
				
				
					
				var dias_semana='<?php echo($datos_recurrencia[0]['dias_semana']); ?>';
				var vector_dias_semana = dias_semana.split(",");
				
				for(i=0;i<vector_dias_semana.length;i++){
					$('[name="dias_semana"][value="'+vector_dias_semana[i]+'"]').attr('checked','checked');
				}
				setTimeout(function(){$('[name="dias_semana"]').trigger('click'); }, 100);
				
				
				$('[name="finaliza_el"]').attr('checked',false);
				$('[name="finaliza_el"][value="<?php echo($datos_recurrencia[0]['finaliza_el']); ?>"]').attr('checked','checked');
				setTimeout(function(){$('[name="finaliza_el"]').trigger('change'); }, 100);
	
				var finaliza_el='<?php echo($datos_recurrencia[0]['finaliza_el']); ?>';
				if(finaliza_el==2){	
					$('[name="finaliza_el_repeticiones"]').val('<?php echo($datos_recurrencia[0]['finaliza_el_repeticiones']); ?>');
					setTimeout(function(){$('[name="finaliza_el_repeticiones"]').trigger('keyup'); }, 100);
				}
				if(finaliza_el==3){
					
					setTimeout(function(){$("#finaliza_el_fecha").datetimepicker('setValue',"<?php echo($datos_recurrencia[0]['finaliza_el_fecha']);?>"); }, 110);
				}
					
			});
		</script>
	<?php
	}
}
?>