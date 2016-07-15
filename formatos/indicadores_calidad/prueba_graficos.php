<?php
        
        
        
       $dato=array(5,10,15,20,25,30);
	   $datos3=array('titulo 5','titulo 10','titulo 15','titulo 20','titulo 25','titulo 30');
	
	    switch(trim(@$tipo_grafico[0]["tipo_grafico"])){
			case 'barras':
			    $valores=$dato;
			    $titulos=$dato3;       
			    break;
		}
	
	
	
	
?>

    <center>
    <div id="main" style="width: 600px;height:400px;"></div>
    <script src="echarts.min.js"></script>
    <script type="text/javascript">
 		var myChart = echarts.init(document.getElementById('main'));
        
//app.title = '坐标轴刻度与标签对齐';

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
            data : ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
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
            data:[10, 52, 200, 334, 390, 330, 220]
        }
    ]
};
        // Load data into the ECharts instance 
        myChart.setOption(option);

    </script>
