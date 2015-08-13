<?php
require_once dirname(__FILE__) . '/common/delegate.php';

if (!isset($_SESSION)) {
    session_start();
}

require_once dirname(__FILE__) . '/common/rememberme.php';

if (!isset($_SESSION['userId']) || !is_numeric($_SESSION['userId'])) {
    addError("Access denied");
    redirect('./index.php');
}

$delegate = new Delegate();

$loggedUser = $delegate->userGetById($_SESSION['userId']);

$myDiagrams = $delegate->diagramsForUserNative($loggedUser->id, Userdiagram::LEVEL_AUTHOR);
$otherDiagrams = $delegate->diagramsForUserNative($loggedUser->id, Userdiagram::LEVEL_EDITOR);

$invitations = $delegate->invitationsByEmail($loggedUser->email);

/**Exctracts the name of an email address*/
function firstName($email){
    $rez = strpos($email, '@');
    if($rez){
        return substr($email, 0, $rez);
    }
    else{
        return substr($email, 0, 5);
    }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--Copyright 2010 Scriptoid s.r.l-->
    <head>
        <title>Mis diagramas - Diagramo</title>
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
        <? require_once dirname(__FILE__) . '/common/header.php'; ?>
        
        <div id="content" style="text-align: center; margin-left: auto; margin-right: auto;">
            <? require_once dirname(__FILE__) . '/common/messages.php'; ?>
            <br/>

            <!-- Invitations -->
            <?if(count($invitations) > 0){?>
            <div class="form"  style="width: 600px; margin-left: auto; margin-right: auto;">
                
                
                <div class="formTitle" >                    
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="200"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Invitaciones</span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                <table style="position:relative; background-color:#F6F6F6; top: 0px; width: 596px;" border="0" cellspacing="0">
                    <tr style="background-color:#EBEBEB;"  >
                        <td><span class="formLabel">Diagrama</span></td>
                        <td><span class="formLabel">Invitar</span></td>
                        <td><span class="formLabel">Fecha</span></td>
                        <td><span class="formLabel">Accion</span></td>
                    </tr>
                    <?foreach($invitations as $invitation){
                        $iDiagram = $delegate->diagramGetById($invitation->diagramId);
                        $iUser = $delegate->userGetById($invitation->userId);
                    ?>
                    <tr>
                        <td><?=$iDiagram->title?></td>
                        <td><?=$iUser->account?></td>
                        <td><?=$invitation->createdOn?></td>
                        <td><a href="./common/controller.php?action=acceptInvitationExe&token=<?=$invitation->token?>">Aceptar</a> | <a href="./common/controller.php?action=rejectInvitation&token=<?=$invitation->token?>">Rechazar</a></td>
                    </tr>
                    <?}?>
                </table>                                
            </div>
            <p/>
            <?}?>

            <!--My diagrams-->
            <div style="width: 600px; margin-left: auto; margin-right: auto;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="200"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Mis diagramas</span></td>
                            <td>&nbsp;</td>
                            <td width="200" align="right"><a style="text-decoration: none;" href="./common/controller.php?action=newDiagramExe"><img style="vertical-align:middle; margin-right: 3px; margin-top: -5px;" src="./assets/images/newdiagram.png" border="0" width="91" height="27"/></a></td>
                        </tr>
                    </table>
                </div>
                
                <table style="position:relative; background-color:#F6F6F6; top: 0px; width: 596px;"  border="0" align="center" cellpadding="5" cellspacing="0" width="100%">
                    <tr style="background-color:#EBEBEB;" >
                        <td align="left" ><span class="formLabel">Ultima edicion</span></td>
                        <td align="left" ><span class="formLabel">Nombre</span></td>
                        <td><span class="formLabel">Publico</span></td>
                        <td><span class="formLabel">Configuracion</span></td>
                        <td><span class="formLabel">Eliminar</span></td>
                    </tr>                    
                    <? foreach ($myDiagrams as $myDiagram) {?>
                        <tr>
                            <td style="border-bottom: 1px solid white;" align="left" ><span class="formLabel"><?=strtolower(date('F', strtotime($myDiagram->lastUpdate))) . date(',d Y', strtotime($myDiagram->lastUpdate)) ?></span></td>
                            <td style="border-bottom: 1px solid white;" align="left" ><a href="./index.php?diagramId=<?=$myDiagram->id ?>"><span class="formLabel"><?=$myDiagram->title ?></span></a></td>
                            <td style="border-bottom: 1px solid white;" align="center" ><span class="formLabel"><?=$myDiagram->public ? 'public' : 'private' ?></span></td>
                            <td style="border-bottom: 1px solid white;" align="center"><a href="./editDiagram.php?diagramId=<?=$myDiagram->id ?>"><img style="vertical-align:middle; margin-right: 3px;" src="./assets/images/editdiagram.png" border="0" width="22" height="22"/></a></td>
                            <td style="border-bottom: 1px solid white;" align="center" ><a onclick="javascript: return confirmation('Do you really want to delete diagram?');" href="./common/controller.php?diagramId=<?=$myDiagram->id ?>&action=deleteDiagramExe"><img style="vertical-align:middle; margin-right: 3px;" src="./assets/images/deletediagram.png" border="0" width="22" height="22"/></a></td>
                        </tr>
                        <tr>
                            <td colspan="2">&nbsp;</td>
                            <td colspan="3" align="left">
                                <?
                                $collaborators = $delegate->usersGetAsCollaboratorNative($myDiagram->id);
                                foreach($collaborators as $collaborator){
                                    //print substr($collaborator->email, 0, strpos($collaborator->email, '@')) . '-';
                                    ?>
                                    <!--<img src="./assets/images/collaborator.gif" style="vertical-align: bottom;" />-->
                                    <?
                                   // print firstName($collaborator->email);
                                }
                                ?>
                                <!--(<a style="font-size: small" href="./colaborators.php?diagramId=<?//=$myDiagram->id?>">Gestion</a>)-->
                            </td>
                        </tr>
                    <? } ?>
                </table>
            </div>

            <p/>
            &nbsp;
            <p/>

            <!--Others' diagrams-->
            <?if(count($otherDiagrams) > 0 ){?>
            <div class="form"  style="width: 600px;">
                
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="200"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Otros diagramas</span></td>
                            <td>&nbsp;</td>
                            <td width="200" align="right">&nbsp;</td>
                        </tr>
                    </table>
                </div>

                <table style="position:relative; background-color:#F6F6F6; top: 0px; width: 596px;"  border="0" align="center" cellpadding="5" cellspacing="0" width="100%">
                    <tr style="background-color:#EBEBEB;" >
                        <!-- <th><span class="menuText">Id</span></th> -->
                        <td align="left" ><span class="formLabel">Ultima edicion</span></td>
                        <td align="left" ><span class="formLabel">Nombre</span></td>
                        <td align="center"><span class="formLabel">Publico</span></td>
                        <td align="center"><span class="formLabel">Eliminar</span></td>
                    </tr>
                    <? foreach ($otherDiagrams as $otherDiagram) {?>
                        <tr>
                            <!-- <td align="right"><?=$otherDiagram->id ?></td> -->
                            <td style="border-bottom: 1px solid white;" align="left" ><span class="formLabel"><?=strtolower(date('F', strtotime($otherDiagram->lastUpdate))) . date(',d Y', strtotime($otherDiagram->lastUpdate)) ?></span></td>
                            <td style="border-bottom: 1px solid white;" align="left" ><a href="./index.php?diagramId=<?=$otherDiagram->id ?>"><span class="formLabel"><?=$otherDiagram->title ?></span></a></td>
                            <td style="border-bottom: 1px solid white;" align="center" ><span class="formLabel"><?=$otherDiagram->public ? 'public' : 'private' ?></span></td>
                            <td style="border-bottom: 1px solid white;" align="center" ><a onclick="javascript: return confirmation('Do you really want to remove yourself from this diagram?');" href="./common/controller.php?diagramId=<?=$otherDiagram->id?>&action=removeMeFromDiagram"><img style="vertical-align:middle; margin-right: 3px;" src="./assets/images/remove.gif" border="0" width="24" height="24"/></a></td>
                        </tr>
                    <? } ?>
                </table>


            </div>
            <?}?>
            
        </div>

         <?require_once dirname(__FILE__) . '/common/analytics.php';?>
    </body>
</html>
