<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Procedimiento</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group">
                  <label class="string control-label" for="fecha_nomina"><b>Fecha vigencia</b></label>
                  <input type="hidden" name="bksaiacondicion_g@fecha_nomina_x" id="bksaiacondicion_g@fecha_nomina_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@fecha_nomina_x" id="fecha_nomina_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("fecha_nomina_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@fecha_nomina_y" id="bksaiacondicion_g@fecha_nomina_y" value="<=">
                  <input type="text"  name="bqsaia_g@fecha_nomina_y" id="fecha_nomina_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("fecha_nomina_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_fecha_nomina',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_fecha_nomina',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_fecha_nomina" id="bqsaiaenlace_fecha_nomina" value="y" />
		</div></div></div><div class="control-group"><b>Nombre<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="estado"><b>Estado<input type="hidden" name="bksaiacondicion_g@estado" id="bksaiacondicion_g@estado" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(496,6305,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@estado',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@estado',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@estado" id="bqsaiaenlace_g@estado" value="y" />
		</div></div></div><div class="control-group"><b>Objetivo<input type="hidden" name="bksaiacondicion_g@objetivo" id="bksaiacondicion_g@objetivo" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="objetivo" name="bqsaia_g@objetivo"  style="width:500px;height:100px"></textarea><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@objetivo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@objetivo" id="bqsaiaenlace_g@objetivo" value="y" />
		</div></div></div><div class="control-group"><b>Alcance<input type="hidden" name="bksaiacondicion_g@alcance" id="bksaiacondicion_g@alcance" value="like_total"></b><div class="controls"><textarea  maxlength="4000"   id="alcance" name="bqsaia_g@alcance"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_procedimiento g @ AND  g.documento_iddocumento=iddocumento "></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@fecha_nomina_x,g@fecha_nomina_y">