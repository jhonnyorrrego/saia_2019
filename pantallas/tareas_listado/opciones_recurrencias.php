<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
echo(librerias_datepicker_bootstrap());
if($_POST['desde_formato']){
    $recurrencia=array("fk_tareas_listado"=>$_POST['idtareas_listado']);
    foreach ($_POST as $key => $value) {
        if($key!='desde_formato' && $key!='idtareas_listado'){
            if(@isset($recurrencia[$key])){
                $recurrencia[$key].=",".$value;
            }
            else{
                if($value!==''){
                    $recurrencia[$key]=$value;
                }
            }
        }
    }
    if($recurrencia["finaliza_el_fecha"]!=''){
        $recurrencia["finaliza_el_fecha"]=fecha_db_almacenar($recurrencia["finaliza_el_fecha"],"Y-m-d");
    }
    $recurrencia["ejecuta_proxima"]=fecha_db_almacenar($recurrencia["ejecuta_proxima"],"Y-m-d");
    $recurrencia["empieza_el"]=fecha_db_almacenar($recurrencia["empieza_el"],"Y-m-d");
    $excluidos=array("finaliza_el_fecha","ejecuta_proxima","empieza_el");
    foreach ($recurrencia as $key => $value) {
        if(!in_array($key, $excluidos)){
            $recurrencia[$key]="'".$value."'";
        }
    }
    $sql_insert_recur="INSERT INTO tareas_listado_recur(".implode(", ", array_keys($recurrencia)).") VALUES(".implode(", ", array_values($recurrencia)).")";
    phpmkr_query($sql_insert_recur);
    ?>
    <script>
    	$(document).ready(function (){
    		window.parent.hs.close();
    	});
    </script>
    <?php 
}else{
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
<script src='<?php echo($ruta_db_superior);?>js/moment.min.js'></script>
<script src='<?php echo($ruta_db_superior);?>js/moment-es.js'></script>
<style type="text/css">
  .table th, .table td { border-top: 0; padding:1px 8px 8px 0px;}
</style>
<body>
	<div class="container">
		<form id="formulario_recurrencia" name="formulario_recurrencia" method="post">
		<table class="table">
			<tr>
				<td>Se repite:</td>
				<td>
					<select style="width:150px" id="recurrencia" name="recurrencia">
						<option value="1" etiqueta="Dia(s)" momento="day">Cada día</option>
						<!--option value="2" etiqueta="Laboral(es)" momento="day2">Todos los días laborables (de lunes a viernes)</option-->
						<option value="3" etiqueta="Semana(s)" momento="week">Cada semana</option>
						<option value="4" etiqueta="Mes(es)" momento="month" selected="selected" >Cada mes</option>
						<option value="5" etiqueta="Año(s)" momento="year">Cada año</option>
					</select>
				</td>
			</tr>
			<tr id="tr_repetir_cada">
				<td>Repetir Cada</td>
				<td>
					<select style="width:100px" id="repetir_cada" name="repetir_cada">
						<?php echo($option);?>
					</select>&nbsp;<span id="etiqueta_repite_cada">Mes(es)</span>
				</td>
			</tr>
			<tr id="tr_repetir_mes">
				<td>Repetir Cada</td>
				<td>
					<input type="radio" name="repetir_mes" value="1" checked="checked"/>Dia del Mes
					<input type="radio" name="repetir_mes" value="2"/>Dia de la Semana
				</td>
			</tr>
			<tr id="tr_dias_semana" style="display: none;">
				<td>Repetir el</td>
				<td>
					<input type="checkbox" name="dias_semana" value="0" /> Do &nbsp;
					<input type="checkbox" name="dias_semana" value="1" /> Lu &nbsp;
					<input type="checkbox" name="dias_semana" value="2" /> Ma &nbsp;
					<input type="checkbox" name="dias_semana" value="3" /> Mi &nbsp;
					<br>
					<input type="checkbox" name="dias_semana" value="4" /> Ju &nbsp;
					<input type="checkbox" name="dias_semana" value="5" /> Vi &nbsp;
					<input type="checkbox" name="dias_semana" value="6" /> Sa &nbsp;
				</td>
			</tr>
			<tr>
				<td>Empieza el</td>
				<td><input type="text" value="<?php echo($fecha_inicial);?>" readonly="true" style="width:100px" id="empieza_el" name="empieza_el"></td>
			</tr>
			<tr>
				<td>Finaliza el</td>
				<td>
					<input type="radio" name="finaliza_el" value="1" checked="true"> Nunca<br/>
					<input type="radio" name="finaliza_el" value="2"> Al cabo de <input type="text" style="width:30px" id="finaliza_el_repeticiones" name="finaliza_el_repeticiones" maxlength="2"> Repeticiones<br/>
					<div class="pull-left">
					  <input type="radio" name="finaliza_el" value="3"> El &nbsp;&nbsp;
					</div>
					<div id="datetimepicker1" class="input-append pull-left"><input type="text" style="width:100px" id="finaliza_el_fecha" name="finaliza_el_fecha" data-format="yyyy-MM-dd">
						<span class="add-on"><i data-time-icon="icon-time" data-date-icon="icon-calendar"></i></span>
  				</div><br/>
				</td>
			</tr>
			<tr>
			  <td id="resumen_recurrencia" colspan="2">
			    <input type="hidden" id="ejecuta_proxima" name="ejecuta_proxima" value="">
			    <div id="resumen_recurrencia1"></div><span id="resumen_recurrencia3"></span>
			    <div id="resumen_recurrencia2"></div>
			    <div id="validar_recurrencia"></div>
			  </td>
			</tr>
			<tr>
				<td style="text-align: center;" colspan="2">
    				  <input type="hidden" name="desde_formato" id="desde_formato" value="<?php echo($_REQUEST['desde_formato']); ?>">
    				  <input type="hidden" name="idtareas_listado" id="idtareas_listado" value="<?php echo($_REQUEST['idtareas_listado']); ?>">
				  <button id="boton_guardar" class="btn btn-mini btn-primary">Guardar</button> 
				  <button id="boton_cancelar" class="btn btn-mini">Cancelar</button> 
			  </td>
			</tr>
		</table>
		</form>
	</div>
</body>

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
      $("#datetimepicker1").datetimepicker('setValue',"<?php echo(date('Y-m-')."13");?>");
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
	$('#datetimepicker1').datetimepicker({
		language: 'es',
		pick12HourFormat: true,
		pickTime: false
	}).on('changeDate', function(e){
	  $("[name='finaliza_el'][value='3']").prop("checked",true);
		$(this).datetimepicker('hide');
		info_resumen();
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
					
					setTimeout(function(){$("#datetimepicker1").datetimepicker('setValue',"<?php echo($datos_recurrencia[0]['finaliza_el_fecha']);?>"); }, 110);
				}
					
			});
		</script>
	<?php
	}
}
}
?>
