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
include_once($ruta_db_superior."librerias_saia.php");
echo( librerias_jquery('1.7') );
//echo( json_encode($data_nombres) );

//die();
?> 


    <script src="echarts.min.js"></script>
        <center>
    <div id="main" style="width: 600px;height:400px; "></div>
    <br>
    <div id="imagen_grafico"></div>
<?php
        
function generar_grafico_barra($color_grafico,$contenedores,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
    global $conn;
        $valores=json_encode($valores);
        
        if($color_grafico==''){
            $color_saia=busca_filtro_tabla("","configuracion","nombre='color_encabezado_list'","",$conn);  
            $color_grafico=$color_saia[0]['valor'];
        }
        
       $data_nombres=array();
       for($i=0;$i<count($nombres['nombres']);$i++){
            $data_nombres[$i]['value']=$nombres['nombres'][$i];
            $data_nombres[$i]['textStyle']['color']=$nombres['colores'][$i];
            $data_nombres[$i]['textStyle']['fontWeight']='bold';           
       }        
        $data_nombres=json_encode($data_nombres);
       // echo($titulos);die();
    ?>
        <script type="text/javascript">
 		    var myChart = echarts.init(document.getElementById('<?php echo($contenedores[0]); ?>'));

            var option = {
                renderAsImage:true,
                title: {text: '<?php echo($titulo_grafico); ?>', x:'center'},
                color: ['<?php echo($color_grafico); ?>'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                   // left: '3%',
                   // right: '4%',
                    //bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:21,                        
                        name:'<?php echo($titulox); ?>',
                        type : 'category',
                        data: <?php echo($data_nombres); ?>,
                       
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        nameTextStyle:{
                          color: '#000000',
                          fontWeight:'bold'
                        },
                        nameLocation:'middle',
                        nameGap:30,
                        name:'<?php echo($tituloy); ?>', //
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Valor',
                        type:'bar',
                        barWidth: '50%',
                        data:<?php echo($valores); ?>
                        
                    }
                ]
            };
            
            myChart.setOption(option);
            
            var img = new Image();
            img.src = myChart.getDataURL({
                pixelRatio: 2,
                backgroundColor: '#fff'
            });
            img.id = "img_<?php echo($contenedores[1]); ?>";
            document.getElementById('<?php echo($contenedores[1]); ?>').appendChild(img);
            $('<?php echo($contenedores[0]); ?>').remove();



            
            
        </script>
    <?php
}


        
        
       $dato=array(5,10,15,20,25,30);
	   $dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	   $colores=array('#00FF51','#D923D0','#00FF51','#D923D0','#00FF51','#D923D0');
	   $titulo_grafico='Mi Grafico';
	   $idcontenedor='main';
	   $tipo_grafico='barras';
	   $color='#00FF51';
	   $titulox='Titulo Eje X';
	   $tituloy='Titulo Eje Y';
	    switch($tipo_grafico){
			case 'barras':
			    $valores=$dato;
			    $nombres['nombres']=$dato3;  
			    $nombres['colores']=$colores;
			    break;
		}

	   // generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
	   generar_grafico_torta($color,$idcontenedor,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
	
?>



