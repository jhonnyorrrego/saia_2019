<?php
require_once('common/delegate.php');

if (!isset($_SESSION)) {
    session_start();
}

require_once('common/rememberme.php');

if (!isset($_SESSION['userId']) || !is_numeric($_SESSION['userId'])) {
    addError("Access denied");
    redirect('./index.php');
}
if(!is_numeric($_REQUEST['diagramId'])){
    print("Wrond Diagram");
    exit();
}

$delegate = new Delegate();

$loggedUser = $delegate->userGetById($_SESSION['userId']);
$diagram = $delegate->diagramGetById($_REQUEST['diagramId']);

/*print_r($diagram);
die();
*/

$svgLink = 'exporter/exporter.php?diagrama=' . $diagram->hash . '&tipo=pdf&cerrar=no';
$pngLink = 'exporter/exporter.php?diagrama=' . $diagram->hash . '&tipo=png&cerrar=no';
$jpgLink = 'exporter/exporter.php?diagrama=' . $diagram->hash . '&tipo=jpg&cerrar=no';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--Copyright 2010 Scriptoid s.r.l-->
    <head>
        <title>Exportar Diagrama - Diagramo</title>
        <link rel="stylesheet" media="screen" type="text/css" href="assets/css/style.css" />
        <script type="text/javascript">
            function confirmation(message){
                var answer = confirm(message);
                if(answer){
                    return true;
                }

                return false;
            }
        </script>
    </head>
    <body>
        <? require_once('common/header.php'); ?>

        <div id="content" style="text-align: left; /*border: solid 1px red;*/ padding-left: 100px;">
            <? require_once('common/messages.php'); ?>

            <br/>
            <div class="form"  style="width: 600px;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="400"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Exportar diagrama: <?=$diagram->title?></span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                
                <h3>Como SVG</h3>
                <input type="text" value="<?=$svgLink?>"  style="width: 400px;"/> <br/>
                <a href="<?=$svgLink?>" target="_blank"><?=$svgLink?></a>
                <p/>

                <h3>Como PNG</h3>
                <input type="text" value="<?=$pngLink?>" style="width: 400px;"/><br/>
                <a href="<?=$pngLink?>" target="_blank"><?=$pngLink?></a>
                <p/>

                <h3>Como JPG</h3>
                <input type="text" value="<?=$jpgLink?>" style="width: 400px;"/><br/>
                <a href="<?=$jpgLink?>" target="_blank"><?=$jpgLink?></a>
                <p/>

                <a href="./index.php?diagramId=<?=$diagram->id?>">Volver a editar el diagrama</a>
            </div>
        </div>

         <?require_once('common/analytics.php');?>
    </body>
</html>
