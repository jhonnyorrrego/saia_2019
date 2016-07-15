    <script src="echarts.min.js"></script>
        <center>
    <div id="main" style="width: 1000px;height:400px;"></div>
<?php
        



function generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
        $nombres=json_encode($nombres);
        $valores=json_encode($valores);
        
       // echo($titulos);die();
    ?>
        <script type="text/javascript">
 		    var myChart = echarts.init(document.getElementById('<?php echo($idcontenedor); ?>'));

            var option = {
                
                title: {text: '<?php echo($titulo_grafico); ?>', x:'center'},
                color: ['<?php echo($color); ?>'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {            // 坐标轴指示器，坐标轴触发有效
                        type : 'shadow'        // 默认为直线，可选为：'line' | 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        name:'hola mundo',
                        type : 'category',
                        data: <?php echo($nombres); ?>,
                       
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        name:'hola mundo',
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'<?php echo($titulo_grafico); ?>',
                        type:'bar',
                        barWidth: '50%',
                        data:<?php echo($valores); ?>
                    }
                ]
            };
            
            myChart.setOption(option);

        </script>
    <?php
}


        
        
       $dato=array(5,10,15,20,25,30);
	   $dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	   $titulo_grafico='Mi Grafico';
	   $idcontenedor='main';
	   $tipo_grafico='barras';
	   $color='#00FF51';
	    switch($tipo_grafico){
			case 'barras':
			    $valores=$dato;
			    $nombres=$dato3;       
			    break;
		}
	    generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico);
	
	
?>



