<?php
/* This page is used for both logged users and outsiders to */
require_once dirname(__FILE__) . '/common/delegate.php';



if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['userId'])) {
    echo "Sic";
    exit();
}

if (!isset($_REQUEST['diagramId'])) {
    echo "No diagram selected";
    exit();
}

$d = new Delegate();
$userdiagram = $d->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
if (!is_object($userdiagram) || !is_numeric($userdiagram->userId)) {
    echo "No rights to edit that diagram";
    exit();
}

$diagram = $d->diagramGetById($_REQUEST['diagramId']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Diagramo - Edit diagram</title>
        <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
        <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon" />
        <link href="./assets/css/style.css" type="text/css" rel="stylesheet"/>
    </head>
    <body>
        <div id="page">
            <? require_once dirname(__FILE__) . '/common/header.php'; ?>


            <div id="content">
                <? require_once dirname(__FILE__) . '/common/messages.php'; ?>
                <br/>
                <div class="form" style="width: 400px;">
                    <div class="formTitle" >
                        <span class="menuText" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Edit</span>
                    </div>
                    
                    <form  style="position: relative; height: 270px;" action="./common/controller.php" method="post">
                        <input type="hidden" name="action" value="editDiagramExe"/>
                        <input type="hidden" name="diagramId" value="<?=$diagram->id ?>"/>
                        <div style="position: absolute; top: 10px; left: 20px; right: 20px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><span class="formLabel">Title</span></td>
                                    <td width="100%">&nbsp;</td>
                                    <td> <input class="formField" style="margin-right: 0;" type="text" name="title" size="40" value="<?=$diagram->title?>"/></td>
                                </tr>
                            </table>
                        </div>

                        <div style="position: absolute; top: 50px; left: 20px;">
                             <span class="formLabel">Description(optional)</span>
                        </div>

                        <div style="position: absolute; top: 70px; left: 20px; right: 20px; text-align: right;">
                            <textarea name="description" style="left: 0; right: 0; width: 100%; height: 75px;"><?=$diagram->description ?></textarea>
                        </div>

                        <div style="position: absolute; top: 160px; left: 20px;">
                            <input type="checkbox" name="public" value="true" <?=$diagram->public ? 'checked' : '' ?>/><span class="formLabel">Public</span>
                        </div>
                        
                        <div style="position: absolute; top: 180px; left: 20px; color: gray; text-align: left;">
                            A <b>public</b> diagram will have direct links (<a href="http://en.wikipedia.org/wiki/Permalink" target="new">permalinks</a>) to anyone
                            but only the author (and collaborators) can edit it.
                        </div>
                        
                        <div style="position: absolute; top: 230px; left: 20px; right: 20px;">
                            <input type="image" src="./assets/images/save.gif" style="display: block; margin-left: auto; margin-right: 0;" value="Save"/>
                        </div>
                    </form>
                </div>
            </div>

            <p/>

            <div class="copyright">&copy; <?=date('Y') ?> Diagramo</div>
        </div>

        <?require_once dirname(__FILE__) . '/common/analytics.php';?>
    </body>
</html>

