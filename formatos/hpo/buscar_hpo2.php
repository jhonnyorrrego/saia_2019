<?php include_once("../../formatos/librerias/funciones_generales.php"); ?><?php include_once("../../calendario/calendario.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato detalle ordenes de compra y requisiciones</legend><br /><br /><?php include_once("../../formatos/librerias/funciones_generales.php"); ?><div class="control-group"><b>cantidad ordenada<input type="hidden" name="bksaiacondicion_g@pqord" id="bksaiacondicion_g@pqord" value="="></b><div class="controls"><input type="text" id="pqord" name="bqsaia_g@pqord"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@pqord',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@pqord',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@pqord" id="bqsaiaenlace_g@pqord" value="y" />
		</div></div></div><div class="control-group">
                  <label class="string control-label" for="pddte"><b>Fecha Vencimiento</b></label>
                  <input type="hidden" name="bksaiacondicion_g@pddte_x" id="bksaiacondicion_g@pddte_x" value=">=">
                  <div class="controls">
                  Entre <input type="text"  name="bqsaia_g@pddte_x" id="pddte_x" tipo="fecha" value="" style="width:100px" placeholder="Inicio"><?php selector_fecha("pddte_x","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?> y 
                  <input type="hidden" name="bksaiacondicion_g@pddte_y" id="bksaiacondicion_g@pddte_y" value="<=">
                  <input type="text"  name="bqsaia_g@pddte_y" id="pddte_y" tipo="fecha" value="" style="width:100px" placeholder="Fin"><?php selector_fecha("pddte_y","kformulario_saia","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_hpo g @ AND  g.documento_iddocumento=iddocumento "><input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?>"><input type="hidden" name="formato" value="hpo"></body><input type="hidden" name="bqtipodato_plantilla" id="bqtipodato_plantilla" value="date|g@pddte_x,g@pddte_y"><input type="hidden" name="idbusqueda_componente" value="">