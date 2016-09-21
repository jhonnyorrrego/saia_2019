<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Clasificacion de la solicitud</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_clas"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_clas_x" id="bksaiacondicion_g@fecha_clas_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_clas_x" id="fecha_clas_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_clas_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_clas_y" id="bksaiacondicion_g@fecha_clas_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_clas_y" id="fecha_clas_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_clas_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_clas',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_clas',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_clas" id="bqsaiaenlace_fecha_clas" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_clas"><b>Tipo<input type="hidden" name="bksaiacondicion_g@tipo_clas" id="bksaiacondicion_g@tipo_clas" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(337,3933,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_clasif_solicitud g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_clas_x,g@fecha_clas_y">