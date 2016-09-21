<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Solucion de soporte</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_soluc"><b>Fecha</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_soluc_x" id="bksaiacondicion_g@fecha_soluc_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_soluc_x" id="fecha_soluc_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_soluc_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_soluc_y" id="bksaiacondicion_g@fecha_soluc_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_soluc_y" id="fecha_soluc_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_soluc_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_soluc',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_soluc',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_soluc" id="bqsaiaenlace_fecha_soluc" value="y" />
		</div></div></div><div class="control-group"><b>solucion<input type="hidden" name="bksaiacondicion_g@solucion" id="bksaiacondicion_g@solucion" value="like_total"></b><div class="controls"><textarea    id="solucion" name="bqsaia_g@solucion"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@solucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@solucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@solucion" id="bqsaiaenlace_g@solucion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo_causa"><b>Causa<input type="hidden" name="bksaiacondicion_g@tipo_causa" id="bksaiacondicion_g@tipo_causa" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(340,3964,'',1,'buscar');?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_solu_soporte g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_soluc_x,g@fecha_soluc_y">