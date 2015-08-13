<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
echo("INICIO <hr>");
$tablas=$conn->lista_tabla();
$tablespace="SAIA_INDEX01";
for($i=0;$i<$tablas["numcampos"];$i++){
	//echo("-------".$tablas[$i]["nombre"]."--------<br />");
	//TODO: Cambiar esto por una funcion de la clase SQL que saque el listado de los indices para los diferentes motores.
	$indices=ejecuta_filtro_tabla("SELECT user_tables.table_name, user_indexes.index_name, user_indexes.tablespace_name, user_ind_columns.column_name FROM user_tables JOIN user_indexes on user_indexes.table_name = user_tables.table_name JOIN user_ind_columns ON user_indexes.index_name = user_ind_columns.index_name  WHERE user_tables.table_name='".$tablas[$i]["nombre"]."' ORDER BY user_tables.table_name,user_indexes.index_name",$conn);
	$exito=0;
	$exito_documento=0;
	for($j=0;$j<$indices["numcampos"];$j++){
		if($indices[$j]["tablespace_name"]!=$tablespace){
			echo("ALTER INDEX ".$indices[$j]["index_name"]." REBUILD TABLESPACE ".$tablespace.";<br>");
		}
		//echo($indices[$j]["index_name"]."-->".strtoupper($indices[$j]["column_name"])."<br />");
		if(strtoupper($indices[$j]["column_name"])=="ID".strtoupper($tablas[$i]["nombre"])|| strtoupper($indices[$j]["column_name"])=="IDTRANSFERENCIA"){
			$exito=1;
			if(strtoupper($indices[$j]["index_name"])!=strtoupper($tablas[$i]["nombre"]."_PK")){
				//echo("-------Cambiar nombre de indice llave--------------<br />");				
				echo("ALTER INDEX ".strtoupper($indices[$j]["index_name"])." RENAME TO ".strtoupper($tablas[$i]["nombre"])."_PK; <br />");
				
			}
		}	
		if(strtoupper($indices[$j]["column_name"])=="DOCUMENTO_IDDOCUMENTO"){
			$exito_documento=1;
			if(strtoupper($indices[$j]["index_name"])!=strtoupper($tablas[$i]["nombre"]."_DOC")){
				//echo("-------Cambiar nombre de indice enlace documento--------------<br />");
				echo("ALTER INDEX ".strtoupper($indices[$j]["index_name"])." RENAME TO ".strtoupper($tablas[$i]["nombre"])."_DOC; <br />");
				
			}
		}		
	}
	if($exito){
		//echo("----------------0k------------------------");
	}
	else{
		//echo("----------------ERROR-------------------<br>");
		echo("CREATE INDEX ".$tablas[$i]["nombre"]."_PK  on ".$tablas[$i]["nombre"]." (ID".$tablas[$i]["nombre"]."); <br />");
	}
	if(!$exito_documento){	
		$campos=$conn->Busca_tabla($tablas[$i]["nombre"],"DOCUMENTO_IDDOCUMENTO");
		if($campos["numcampos"]){
			//echo("----------------VALIDAR DOCUMENTO-------------------<br>");
			echo("CREATE INDEX ".$tablas[$i]["nombre"]."_DOC  on ".$tablas[$i]["nombre"]." (DOCUMENTO_IDDOCUMENTO); <br />");
		}
	}
	//echo("<hr>");	
}
echo("FIN2 <hr>");
///CREATE UNIQUE INDEX "SAIA"."BUSQUEDA" ON "SAIA"."BUSQUEDA" ("IDBUSQUEDA") PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS STORAGE(INITIAL 81920 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645 PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT) TABLESPACE "SAIA_INDEX01" ;
//LISTAR TODAS LAS TABLAS y VERIFICAR SI EXISTE INDICE PARA ESA TABLA CON EL CAMPO ID DE LA TABLA 
?>