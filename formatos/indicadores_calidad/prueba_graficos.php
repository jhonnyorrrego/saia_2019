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
        



function generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico='',$titulox='',$tituloy=''){
       // $nombres=json_encode($nombres['nombres']);
       $valores=json_encode($valores);

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
 		    var myChart = echarts.init(document.getElementById('<?php echo($idcontenedor); ?>'));

            var option = {
                renderAsImage:true,
                title: {text: '<?php echo($titulo_grafico); ?>', x:'center'},
                color: ['<?php echo($color); ?>'],
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
                        data:<?php echo($data_nombres); ?>,
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
             img.id = "prueba_id";
          
            document.getElementById('imagen_grafico').appendChild(img);
            $('#main').remove();
            
            
        </script>
    <?php
}

function guardar_grafico($contenedores,$iddoc){


?>
<script>
$(document).load(function(){
    alert( $('#prueba_id').attr('src') );
    
});    
</script>
<?php
die();
echo('
    <script>
        $(document).load(function(){
            $.ajax({
                type:"POST",
                dataType: "html",
                url: "guardar grafico.php",
                data: {
                    img:$("#IMG"+$("#'.$contenedores[0].'").attr("_echarts_instance_")).attr("src"),
                    iddoc:'.$iddoc.',
                    img2:$("#IMG"+$("#'.$contenedores[1].'").attr("_echarts_instance_")).attr("src")
                    
                },
				success: function(respuesta){
					if(respuesta==1){
						console.log("Imagen guardada...");
					}else{
						console.log("Error al guardar las imagenes...");
					}
				}
           });
           
        });   
    </script>

');
    
    
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

	    generar_grafico_barra($color,$idcontenedor,$nombres,$valores,$titulo_grafico,$titulox,$tituloy);
	    guardar_grafico('','');
	
?>



