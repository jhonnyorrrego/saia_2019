<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");

function validar_contrato_otrosi($idformato,$iddoc){
    
    $datos_papa=busca_filtro_tabla("valor_iva,valor_contrato,valor_contrato_moned","ft_identifica_contrato","documento_iddocumento=".$_REQUEST['anterior'],"");
    $naturaleza=busca_filtro_tabla("naturaleza_contrato,".fecha_db_obtener("fecha_subscripcion","Y-m-d")." AS fecha_subscripcion,".fecha_db_obtener("fecha_final_contrato","Y-m-d")." AS fecha_final_contrato,".fecha_db_obtener("fecha_acta","Y-m-d")." AS fecha_acta","ft_identifica_contrato","documento_iddocumento=".$_REQUEST['anterior'],"");
    
    ?>
    <script>
    	$(document).ready(function() {
    		var proroga =0;
    		var adicion =0;
    		var modificacion=0;
    		cambia_tipo();
    		actualiza_arbol_etapa();
    		
    		$("#tr_valor_total").hide();
    		$("#tr_valor_adicionado").hide();
    		$("#tr_valor_disminuido").hide();
    		$("#tr_valor_iva").hide();
    		$("#tr_valor_valor_total_otrosi").hide();
    		$("#tr_valor_iva_contr").hide();
    		$("#tr_valor_total_otrosi").hide();
    		$("#tr_nuevo_valor_contrato").hide();
    		$("#valor_total_moneda").val('<?php echo($datos_papa[0]['valor_contrato_moned']); ?>').attr('readonly',true);
    		$("#valor_total").val('<?php echo($datos_papa[0]['valor_contrato']); ?>');
           	$("#valor_total_otrosi_m").attr('readonly',true);
           	$("#valor_iva_contr_mone").attr('readonly',true);
           	$("#fecha_inicio_contrat").attr('readonly',true).val("<?php echo($naturaleza[0]['fecha_acta']); ?>");
           	$("#fecha_fin_contrato").attr('readonly',true).val("<?php echo($naturaleza[0]['fecha_final_contrato']); ?>");

           	
           	
           	
    		$('[name="tipo"]').click(function() {
        		    cambia_tipo();
    		});
    		function cambia_tipo(){
        		var valor=$('input[name=tipo]:checked').val();
    			if(valor==1) {
            		$("#fecha_inicio").addClass("required").parent().parent().parent().show();
            		$("#fecha_fin").addClass("required").parent().parent().parent().show();
            		$("#fecha_inicio_contrat").removeClass("required").parent().parent().show();
                   	$("#fecha_fin_contrato").removeClass("required").parent().parent().show();
            		$("#fecha_inicio_contrat").val("<?php echo($naturaleza[0]['fecha_acta']); ?>");
                   	$("#fecha_fin_contrato").val("<?php echo($naturaleza[0]['fecha_final_contrato']); ?>");
                   	
            		
            		$("#valor_total").val("");
            		$("#valor_total_moneda").removeClass("required").val("").parent().parent().hide();
            		$("#valor_adicionado").val("");
            		$("#valor_adicionado_mon").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva").val("");
            		$("#valor_iva_moneda").removeClass("required").val("").parent().parent().hide();
            		$("#valor_total_otrosi").val("");
            		$("#valor_total_otrosi_m").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva_contr").val("");
            		$("#valor_iva_contr_mone").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva_contr").val("");
            		$("#nuevo_valor_contra_m").removeClass("required").val("").parent().parent().hide();
	          		$("#nuevo_valor_contrato").val("");
            		$("#valor_adicionado_mon").val("").parent().parent().hide();
            		$("#valor_disminuido_mon").val("").parent().parent().hide();
            		$("#objeto_modificacion").removeClass("required").parent().parent().hide();
            		$("#actividad_inicial").removeClass("required").parent().parent().hide();
    		    } else if(valor==2) {
            		$("#valor_total_moneda").addClass("required").val("").parent().parent().show();
            		$("#valor_adicionado_mon").addClass("required").val("").parent().parent().show();
            		$("#valor_adicionado_mon").addClass("required").val("").parent().parent().show();
            		$("#valor_iva_moneda").addClass("required").val("").parent().parent().show();
            		$("#valor_total_otrosi_m").addClass("required").val("").parent().parent().show();
            		$("#valor_iva_contr_mone").addClass("required").val("").parent().parent().show();
            		$("#nuevo_valor_contra_m").addClass("required").val("").parent().parent().show();
            		$("#valor_adicionado_mon").val("").parent().parent().show();
            		$("#valor_disminuido_mon").val("").parent().parent().show();
            		
            		$("#objeto_modificacion").removeClass("required").parent().parent().hide();
            		$("#actividad_inicial").removeClass("required").parent().parent().hide();
            		$("#fecha_inicio").removeClass("required").parent().parent().parent().hide();
            		$("#fecha_inicio").val("");
            		$("#fecha_fin").removeClass("required").parent().parent().parent().hide();
            		$("#fecha_fin").val("");
            		$("#valor_total_moneda").val('<?php echo($datos_papa[0]['valor_contrato_moned']); ?>').attr('readonly',true);
            		$("#valor_total").val('<?php echo($datos_papa[0]['valor_contrato']); ?>');
            		$("#fecha_inicio_contrat").removeClass("required").parent().parent().hide();
            		$("#fecha_inicio_contrat").val("");
                   	$("#fecha_fin_contrato").removeClass("required").parent().parent().hide();
                   	$("#fecha_fin_contrato").val("");
    		    }else {
    		    	actualiza_arbol_etapa();
            		$("#objeto_modificacion").addClass("required").parent().parent().show();
            		$("#actividad_inicial").addClass("required").parent().parent().show();
            		
            		$("#valor_total").val("");
            		$("#valor_total_moneda").removeClass("required").val("").parent().parent().hide();
            		$("#valor_adicionado").val("");
            		$("#valor_adicionado_mon").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva").val("");
            		$("#valor_iva_moneda").removeClass("required").val("").parent().parent().hide();
            		$("#valor_total_otrosi").val("");
            		$("#valor_total_otrosi_m").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva_contr").val("");
            		$("#valor_iva_contr_mone").removeClass("required").val("").parent().parent().hide();
            		$("#valor_iva_contr").val("");
            		$("#nuevo_valor_contra_m").removeClass("required").val("").parent().parent().hide();
	          		$("#nuevo_valor_contrato").val("");
            		$("#valor_adicionado_mon").val("").parent().parent().hide();
            		$("#valor_disminuido_mon").val("").parent().parent().hide();
            		$("#fecha_inicio").removeClass("required dateISO").parent().parent().parent().hide();
            		$("#fecha_fin").removeClass("required dateISO").parent().parent().parent().hide();
            		$("#fecha_inicio_contrat").removeClass("required").parent().parent().hide();
            		$("#fecha_inicio_contrat").val("");
                   	$("#fecha_fin_contrato").removeClass("required").parent().parent().hide();
                   	$("#fecha_fin_contrato").val("");
    		    }
    		}  		
    	});
    
       	$("#valor_adicionado_mon").keyup(function() {
       		 this.value = (this.value + '').replace(/[^0-9]/g, '');
       		 $("#valor_adicionado").val(this.value);
       		 Moneda($("#valor_adicionado_mon").attr('id'));
       		$("#valor_adicionado_mon").addClass('required');
       		$("#valor_disminuido_mon").removeClass('required');
       		$("#valor_disminuido_mon").val("");
       		$("#valor_disminuido").val("");
       		calcula_valor_total_otro_si();
       		calcula_valor_nuev_contrato();
       	});
    
       	$("#valor_adicionado_mon").blur(function() {
       		 Moneda($("#valor_adicionado_mon").attr('id'));
       		$("#valor_adicionado_mon").addClass('required');
       		$("#valor_disminuido_mon").removeClass('required');
       		$("#valor_disminuido_mon").val("");
       		$("#valor_disminuido").val("");
       		calcula_valor_total_otro_si();
       		calcula_valor_nuev_contrato();
       	});
       	$("#valor_iva_moneda").keyup(function() {
      		 this.value = (this.value + '').replace(/[^0-9]/g, '');
      		 $("#valor_iva").val(this.value);
      		 Moneda($("#valor_iva_moneda").attr('id'));
      		calcula_valor_iva();
      		calcula_valor_nuev_contrato();
      	});
   
      	$("#valor_iva_moneda").blur(function() {
      		 Moneda($("#valor_iva_moneda").attr('id'));
      		calcula_valor_total_otro_si();
      		calcula_valor_nuev_contrato();
      	});
      	$("#valor_disminuido_mon").keyup(function() {
     		 this.value = (this.value + '').replace(/[^0-9]/g, '');
     		 $("#valor_disminuido").val(this.value);
     		 Moneda($("#valor_disminuido_mon").attr('id'));
     		$("#valor_disminuido_mon").addClass('required');
       		$("#valor_adicionado_mon").removeClass('required');
       		$("#valor_adicionado_mon").val("");
       		$("#valor_adicionado").val("");
       		calcula_valor_total_otro_si();
       		calcula_valor_nuev_contrato();
     	});
  
     	$("#valor_disminuido_mon").blur(function() {
     		 Moneda($("#valor_disminuido_mon").attr('id'));
     		$("#valor_disminuido_mon").addClass('required');
       		$("#valor_adicionado_mon").removeClass('required');
       		$("#valor_adicionado_mon").val("");
       		$("#valor_adicionado").val("");
       		calcula_valor_total_otro_si();
       		calcula_valor_nuev_contrato();
     	});
       	
       	function calcula_valor_total_otro_si(){
           	var valor_iva=0;
           	var valor_adicionado=0;
           	var valor_disminuido=0;
           	if(parseInt($("#valor_iva").val())){
               	valor_iva=parseInt($("#valor_iva").val());
           	}
           	if(parseInt($("#valor_adicionado").val())){
           		valor_adicionado=parseInt($("#valor_adicionado").val());
           	}
           	if(parseInt($("#valor_disminuido").val())){
           		valor_disminuido=parseInt($("#valor_disminuido").val());
           	}
           	var valor=valor_iva+valor_adicionado-valor_disminuido;
           	$("#valor_total_otrosi").val(valor);
           	$("#valor_total_otrosi_m").val(valor);
           	Moneda($("#valor_total_otrosi_m").attr('id'));
       	}
       	function calcula_valor_iva(){
           	var valor_iva=0;
           	if(parseInt($("#valor_iva").val())){
               	valor_iva=parseInt($("#valor_iva").val());
           	}
           	var valor=valor_iva+parseInt(<?php echo($datos_papa[0]['valor_iva']); ?>);
           	$("#valor_iva_contr").val(valor);
           	$("#valor_iva_contr_mone").val(valor);
           	Moneda($("#valor_iva_contr_mone").attr('id'));
       	}
       	function calcula_valor_nuev_contrato(){
           	var valor_total_contrato=0;
           	var valor_total_otrosi=0;
           	if(parseInt($("#valor_total").val())){
           		valor_total_contrato=parseInt($("#valor_total").val());
           	}
           	if(parseInt($("#valor_total_otrosi").val())){
           		valor_total_otrosi=parseInt($("#valor_total_otrosi").val());
           	}
           	console.log(valor_total_otrosi);
           	var valor=valor_total_contrato+valor_total_otrosi;
           	$("#nuevo_valor_contra").val(valor);
           	$("#nuevo_valor_contra_m").val(valor);
           	Moneda($("#nuevo_valor_contra_m").attr('id'));
       	}
    	function Moneda(input) {
   		 var num = $("#" + input).val().replace(/\./g, '');
   		 if (!isNaN(num)) {
   			 num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
   			 num = num.split('').reverse().join('').replace(/^[\.]/, '');
   		 	$("#" + input).val(num);
   		 } else {
   		 	$("#" + input).val(input.value.replace(/[^\d\.]*/g, ''));
   		 }
   	}
    	function actualiza_arbol_etapa(){
        	console.log("<?php echo($naturaleza[0]['naturaleza_contrato']); ?>");
            tree_actividad_inicial.deleteChildItems(0);
            tree_actividad_inicial.loadXML("../../test_serie.php?sin_padre=1&tabla=cf_etapa_actividad&id=<?php echo($naturaleza[0]['naturaleza_contrato']); ?>");
            
        }
    	$('#formulario_formatos').validate({
    		submitHandler : function(form) {
    			var fecha_subs_contrato = '<?php echo($naturaleza[0]['fecha_subscripcion']); ?>';
        		var fecha_firma=$("#fecha_firma").val().split("-");
       		 	var fecha_subs_contrat=fecha_subs_contrato.split("-");
       		 	var valor=$('input[name=tipo]:checked').val();

           		 var fecha2=new Date(fecha_subs_contrat[0],fecha_subs_contrat[1]-1,fecha_subs_contrat[2]);
        		 fecha2=fecha2.setHours(0,0,0,0);
        
        		 var fecha1=new Date(fecha_firma[0],fecha_firma[1]-1,fecha_firma[2]);
        		 fecha1=fecha1.setHours(0,0,0,0);

    			if(fecha1 < fecha2)
    			{
    				$("#alerta_fecha_firma").remove();
    				$("#fecha_firma").after("<font color='red' id='alerta_fecha_firma'>La fecha firma otro si debe ser mayor a la fecha subscripcion del contrato</font>");
    				$("#fecha_firma").focus();
    				$('#continuar').css('display', 'inherit');
    				$('#continuar').next('input').hide();
    				return false;
    			}
    			if(valor==2){
        			if($("#valor_disminuido").val() && $("#valor_adicionado").val()){
            			alert("Solo se puede diligenciar el campo VALOR NETO ADICIONADO(SIN IVA) o VALOR NETO DISMINUIDO(SIN IVA)");
            			$('#continuar').css('display', 'inherit');
        				$('#continuar').next('input').hide();
        				return false;
        			}
    			}
    			form.submit();
    		}
    	});
    </script>
    <?php 
}
function mostrar_otrosi_contrato($idformato,$iddoc){
    
    $actividad=busca_filtro_tabla("tipo,".fecha_db_obtener("fecha_firma","Y-m-d")." AS fecha_firma,".fecha_db_obtener("fecha_inicio","Y-m-d")." AS fecha_inicio,".fecha_db_obtener("fecha_fin","Y-m-d")." AS fecha_fin,valor_total_moneda,valor_adicionado_mon,valor_iva,valor_total_otrosi_m,valor_iva_contr_mone,nuevo_valor_contra_m,objeto_modificacion,actividad_inicial","ft_otrosi_contrato","documento_iddocumento=".$iddoc,"");
    $tabla='<table class="table table-bordered">';
    $tipo="";
    
    if($actividad[0]['tipo']==1){
        $tipo="Pr&oacute;rroga";
    }elseif($actividad[0]['tipo']==2){
        $tipo="Adici&oacute;n/Disminuci&oacute;n";
    }else{
        $tipo="Modificaci&oacute;n";
    }
    switch ($actividad[0]['tipo']) {
        case 1:
            $tabla.='<tr>
                        <td><strong>Tipo de Otro si&nbsp;</strong></td>
                        <td>'.$tipo.'</td>
                        <td><strong>Fecha firma Otro Si&nbsp;</strong></td>
                        <td>'.$actividad[0]['fecha_firma'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Fecha inicio</strong></td>
                        <td>'.$actividad[0]['fecha_inicio'].'</td>
                        <td><strong>Fecha fin</strong></td>
                        <td>'.$actividad[0]['fecha_fin'].'</td>
                    </tr>';
            break;
        case 2:
            $tabla.='<tr>
                        <td><strong>Tipo de Otro si&nbsp;</strong></td>
                        <td>'.$tipo.'</td>
                        <td><strong>Fecha firma Otro Si&nbsp;</strong></td>
                        <td>'.$actividad[0]['fecha_firma'].'</td>

                    </tr>
                    <tr>
                        <td><strong><strong>Valor total del contrato</strong></strong></td>
                        <td>'.$actividad[0]['valor_total_moneda'].'</td>
                        <td><strong>Valor neto adicionado/disminuido (SIN IVA)</strong></td>
                        <td>'.$actividad[0]['valor_adicionado_mon'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Valor IVA otro si</strong></td>
                        <td>'.$actividad[0]['valor_iva'].'</td>
                        <td><strong>Valor total del otro si</strong></td>
                        <td>'.$actividad[0]['valor_total_otrosi_m'].'</td>
                    </tr>
                    <tr>
                        <td><strong>Valor IVA(SOBRE VALOR TOTAL DEL CONTRATO)</strong></td>
                        <td>'.$actividad[0]['valor_iva_contr_mone'].'</td>
                        <td><strong>Nuevo valor del contrato</strong></td>
                        <td>'.$actividad[0]['nuevo_valor_contra_m'].'</td>
                    </tr>';
            break;
        case 3:
            $actividad_inicial=busca_filtro_tabla("nombre","cf_etapa_actividad","idcf_etapa_actividad=".$actividad[0]['actividad_inicial'],"");
            $tabla.='<tr>
                        <td><strong>Tipo de Otro si&nbsp;</strong></td>
                        <td>'.$tipo.'</td>
                        <td><strong>Fecha firma Otro Si&nbsp;</strong></td>
                        <td>'.$actividad[0]['fecha_firma'].'</td>
                    </tr>
                    <tr>
                        <td><strong><strong>Actividad Inicial</strong></strong></td>
                        <td colspan="3">'.$actividad_inicial[0]['nombre'].'</td>
                    </tr>
                    <tr>
                        <td><strong><strong>Objeto del contrato</strong></strong></td>
                        <td colspan="3">'.$actividad[0]['objeto_modificacion'].'</td>
                    </tr>';
            break;

    }
    $tabla.='</table>';
    echo($tabla);
}
?>