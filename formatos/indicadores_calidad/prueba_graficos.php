    <script src="echarts.min.js"></script>
<?php
        



function generar_grafico_barra($idcontenedor,$titulos,$valores){
        $titulos=json_encode($titulos);
    ?>
        <script type="text/javascript">
 		    var myChart = echarts.init(document.getElementById('main'));

            var option = {
                color: ['#3398DB'],
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
                        type : 'category',
                        data : <?php echo($titulos); ?>,
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'直接访问',
                        type:'bar',
                        barWidth: '60%',
                        data:[5, 10, 15, 20, 25,30]
                    }
                ]
            };
            
            myChart.setOption(option);

        </script>
    <?php
}


        
        
       $dato=array(5,10,15,20,25,30);
	   $dato3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	   $idcontenedor='main';
	    $tipo_grafico='barras';
	    switch($tipo_grafico){
			case 'barras':
			    $valores=$dato;
			    $titulos=$dato3;       
			    break;
		}
		
		
		echo(json_encode($titulos));
		die();
	
	    generar_grafico_barra($idcontenedor,$titulos,$valores);
	
	
?>

    <center>
    <div id="main" style="width: 600px;height:400px;"></div>

