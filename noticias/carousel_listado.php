<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="../css/kaiten.min.css" />
        <script type="text/javascript" src="../js/jquery-1.7.min.js"></script>
        <script type="text/javascript" src="../js/jquery-ui-1.8.17.min.js"></script>
        <script type="text/javascript" src="../js/kaiten.js"></script>
        <script type="text/javascript" src="../js/jquery.ba-resize.min.js"></script>
    </head>
    <body>
        <div id="container"></div>
        <script type="text/javascript">
        (function($){
            $K = $('#container');
            $K.kaiten({ 
                columnWidth : '200px',
                startup : function(dataFromURL){
                    this.kaiten('load', { kConnector:'html.page', url:'carousel_principal.php', 'kTitle':'Listado de funcionarios' });
                    this.kaiten('load', { kConnector:'html.page', url:'carousel_list.php', 'kTitle':'Resultado', 'kWidth':'250px'});
                }           
            });
        })(jQuery);
        </script>                      
    </body>
</html>