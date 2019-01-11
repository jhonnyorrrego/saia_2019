<?php include_once("../librerias/funciones_generales.php"); ?><?php include_once("../librerias/header_formato.php"); ?><legend id="label_formato" class="legend">B&uacute;squeda en formato Peticiones Quejas Reclamos Solicitudes Felicitaciones</legend><br /><br /><?php include_once("../librerias/funciones_generales.php"); ?><div class="control-group"><b>Nombre Completos<input type="hidden" name="bksaiacondicion_g@nombre" id="bksaiacondicion_g@nombre" value="like_total"></b><div class="controls"><input type="text" id="nombre" name="bqsaia_g@nombre"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@nombre',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@nombre" id="bqsaiaenlace_g@nombre" value="y" />
		</div></div></div><div class="control-group"><b>Documento<input type="hidden" name="bksaiacondicion_g@documento" id="bksaiacondicion_g@documento" value="like_total"></b><div class="controls"><input type="text" id="documento" name="bqsaia_g@documento"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@documento',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@documento',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@documento" id="bqsaiaenlace_g@documento" value="y" />
		</div></div></div><div class="control-group"><b>Email<input type="hidden" name="bksaiacondicion_g@email" id="bksaiacondicion_g@email" value="like_total"></b><div class="controls"><input type="text" id="email" name="bqsaia_g@email"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@email',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@email" id="bqsaiaenlace_g@email" value="y" />
		</div></div></div><div class="control-group"><b>Telefono o Celular<input type="hidden" name="bksaiacondicion_g@telefono" id="bksaiacondicion_g@telefono" value="like_total"></b><div class="controls"><input type="text" id="telefono" name="bqsaia_g@telefono"><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@telefono',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@telefono',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@telefono" id="bqsaiaenlace_g@telefono" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="rol_institucion"><b>Rol en la Institucion<input type="hidden" name="bksaiacondicion_g@rol_institucion" id="bksaiacondicion_g@rol_institucion" value="="></b></label><div class="controls"><?php genera_campo_listados_editar(305,3573,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_rol_institucion',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_rol_institucion',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_rol_institucion" id="bqsaiaenlace_rol_institucion" value="y" />
		</div></div></div><div class="control-group"><label class="string control-label" style="font-size:9pt" for="tipo"><b>Tipo Comentario<input type="hidden" name="bksaiacondicion_g@tipo" id="bksaiacondicion_g@tipo" value="like_total"></b></label><div class="controls"><?php genera_campo_listados_editar(305,3575,'',1,'buscar');?><div class="btn-group" data-toggle="buttons-radio" >
		  <!--button type="button" class="btn btn-mini" data-toggle="button" id="y" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    Y
		  </button>
		  <button type="button" class="btn btn-mini" data-toggle="button" id="o" onclick="llenar_valor('bqsaiaenlace_g@tipo',this.id)">
		    O
		  </button-->
		  <input type="hidden" name="bqsaiaenlace_g@tipo" id="bqsaiaenlace_g@tipo" value="y" />
		</div></div></div><div class="control-group"><b>Comentarios<input type="hidden" name="bksaiacondicion_g@comentarios" id="bksaiacondicion_g@comentarios" value="like_total"></b><div class="controls"><textarea    id="comentarios" name="bqsaia_g@comentarios"  style="width:500px;height:100px"></textarea></div></div><input type="hidden" name="filtro_adicional" id="filtro_adicional" value=" ft_pqrsf g @ AND  g.documento_iddocumento=iddocumento "></body>