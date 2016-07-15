<?php
	$valores="'pregunta1','pregunta2'";
	$valor='30,40';
	$total=70;
	$funcionario='Ruben Pulgarin';
	
	
	    switch(trim($tipo_grafico[0]["tipo_grafico"])){
			case 'barras':
			       
			    break;
		}
	
	
	
	
?>

    <center>
    <div id="main" style="width: 600px;height:400px;"></div>
    <script src="echarts.min.js"></script>
    <script type="text/javascript">
 		var myChart = echarts.init(document.getElementById('main'));
        
       var option = {
    title : {
        text: '某站点用户访问来源',
        subtext: '纯属虚构',
        x:'center'
    },
    tooltip : {
        trigger: 'item',
        formatter: "{a} <br/>{b} : {c} ({d}%)"
    },
    legend: {
        orient: 'vertical',
        left: 'left',
        data: ['直接访问','邮件营销','联盟广告','视频广告','搜索引擎']
    },
    series : [
        {
            name: '访问来源',
            type: 'pie',
            radius : '55%',
            center: ['50%', '60%'],
            data:[
                {value:335, name:'直接访问'},
                {value:310, name:'邮件营销'},
                {value:234, name:'联盟广告'},
                {value:135, name:'视频广告'},
                {value:1548, name:'搜索引擎'}
            ],
            itemStyle: {
                emphasis: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }
    ]
};
        // Load data into the ECharts instance 
        myChart.setOption(option);

    </script>
