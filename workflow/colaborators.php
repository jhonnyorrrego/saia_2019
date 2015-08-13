<?php
/**Colaborators are per diagram*/

require_once dirname(__FILE__) . '/common/delegate.php';

if (!isset($_SESSION)) {
    session_start();
}

require_once dirname(__FILE__) . '/common/rememberme.php';

if (!isset($_SESSION['userId']) || !is_numeric($_SESSION['userId'])) {
    addError("Access denied");
    redirect('./index.php');
}

if(!is_numeric($_REQUEST['diagramId'])){
    print('Wrong Diagram Id');
    exit();
}



$delegate = new Delegate();

$loggedUser = $delegate->userGetById($_SESSION['userId']);
$diagram = $delegate->diagramGetById($_REQUEST['diagramId']);
$userdiagram = $delegate->userdiagramGetByIds($loggedUser->id, $diagram->id);
$invitations = $delegate->invitationsGetByDiagram($diagram->id);
$collaborators = $delegate->usersGetAsCollaboratorNative($diagram->id);

/*All the collaborators this author knows in the system
 * as a dictionary (email, user_object)
 */
$buddies =  array();

$collaboratorsEmails = array();
foreach($collaborators as $collaborator){
    $collaboratorsEmails[] = $collaborator->email;
}

$knownDiagrams = $delegate->diagramsForUserNative($loggedUser->id);
foreach($knownDiagrams as $knownDiagram){
    $knownCollaborators = $delegate->usersGetAsCollaboratorNative($knownDiagram->id);

    foreach($knownCollaborators as $knownCollaborator){
        //skip current user
        if($knownCollaborator->id == $loggedUser->id){ 
            continue;
        }

        //skipe already present collaborators
        if(in_array($knownCollaborator->email, $collaboratorsEmails)){
            continue;
        }

        //add buddy if not present
        if(!array_key_exists($knownCollaborator->email, $buddies)){
            $buddies[$knownCollaborator->email] = $knownCollaborator;
        }
    }
}
//end buddies

//print_r($invitations);
//exit();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <!--Copyright 2010 Scriptoid s.r.l-->
    <head>
        <title>Colaborators - Diagramo</title>
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

        <div id="content" style="text-align: left; /*border: solid 1px red;*/ padding-left: 100px;">
            <? require_once dirname(__FILE__) . '/common/messages.php'; ?>
            <br/>

            <!--Collaborators-->
            <?if(count($collaborators) > 0 ){?>
            <div class="form"  style="width: 600px;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="400"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Collaborators for diagram: <?=$diagram->title?></span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>

                <table>
                    <tr>
                        <td align="center"><span class="formLabel">Level</span></td>
                        <td><span class="formLabel">Account</span></td>
                        <td><span class="formLabel">Email</span></td>
                        <td align="center"><span class="formLabel">Remove collaborator</span></td>
                    </tr>
                    <?foreach($collaborators as $collaborator){
                        $colabDiagram = $delegate->userdiagramGetByIds($collaborator->id, $diagram->id);
                    ?>
                    <tr>
                        <td align="center">
                            <img src="./assets/images/<?=$colabDiagram->level==Userdiagram::LEVEL_AUTHOR?'author.gif':'editor.gif'?>"/>
                        </td>
                        <td><?=$collaborator->account?></td>
                        <td><?=$collaborator->email?></td>
                        <td align="center">
                            <?if($userdiagram->level == Userdiagram::LEVEL_AUTHOR && $collaborator->id != $_SESSION['userId']){?>
                            <a onclick="return confirmation('Are you sure you want to remove the collaborator?');" href="./common/controller.php?action=removeColaborator&diagramId=<?=$diagram->id?>&userId=<?=$collaborator->id?>"><img style="vertical-align:middle; margin-right: 3px;" src="./assets/images/remove.gif" border="0" width="24" height="24"/></a>
                            <?}else{?>
                            N/A
                            <?}?>
                        </td>
                    </tr>
                    <?}?>
                </table>
            </div>            
            <?}?>
            <!--End collaborators-->

            <p/>
            
            <!--Invitations-->
            <?if($userdiagram->level == Userdiagram::LEVEL_AUTHOR && count($invitations) > 0 ){?>
            <div class="form"  style="width: 600px;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="400"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Invitations for diagram: <?=$diagram->title?></span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>                
                <ul>
                    <?foreach($invitations as $invitation){?>
                    <li><?=$invitation->email?> &nbsp;  <a onclick="return confirmation('Are you sure you want to resend this invitation?');" href="./common/controller.php?action=resendInvitation&token=<?=$invitation->token?>">resend</a> | <a onclick="return confirmation('Are you sure you want to delete the invitation?');" href="./common/controller.php?action=deleteInvitation&token=<?=$invitation->token?>">delete</a></li>
                    <?}?>
                </ul>
            </div>
            <?}?>
            <!--End Invitations-->
            
            <p/>

            <!--Invite buddy-->
            <?if($userdiagram->level == Userdiagram::LEVEL_AUTHOR && count($buddies) > 0){?>
            <div class="form"  style="width: 600px;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="400"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Invite known collaborator</span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                
                <form action="./common/controller.php" method="POST">
                    <!-- <input type="hidden" name="action" value="inviteExistingColaborator"/> -->
                    <input type="hidden" name="action" value="inviteByEmailColaborator"/>
                    <input type="hidden" name="diagramId" value="<?=$diagram->id?>"/>
                    <label for="email">Name</label>
                    <select name="email" id="email">
                        <?foreach($buddies as $email => $buddy){?>
                        <option value="<?=$buddy->email?>"><?=$buddy->email?></option>
                        <?}?>
                    </select>
                    <input type="submit" value="Invite"/>
                </form>
            </div>
            <?}?>
            <!--End Invite buddy-->
            
            <p/>

            <!--Invite by email-->
            <?if($userdiagram->level == Userdiagram::LEVEL_AUTHOR){?>
            <p/>
            <div class="form"  style="width: 600px;">
                <div class="formTitle" >
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="400"><span class="formLabel" style="font-size: 14px; font-family: Arial; color: #6E6E6E;">Invite collaborator by email</span></td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </div>
                
                <script type="text/javascript">
                    function checkEmail(){
                        var newEmail = document.getElementById("newEmail");
                        if(newEmail.value.length == 0 ){
                            alert('Email is empty');
                            return false;
                        }
                        return true;
                    }
                </script>
                <form action="./common/controller.php" method="POST" onsubmit="return checkEmail()">
                    <input type="hidden" name="action" value="inviteByEmailColaborator"/>
                    <input type="hidden" name="diagramId" value="<?=$diagram->id?>"/>
                    <label for="">Email</label>
                    <input type="text" name="email" id="newEmail"/>
                    <input type="submit" value="Invite"/>
                </form>
            </div>
            <?}?>
            <!--End Invite by email-->

            <p/>
            <div class="form"  style="width: 600px;">
                <a href="./index.php?diagramId=<?=$_REQUEST['diagramId']?>">back to diagram</a>
            </div>
        </div>
        

         <?require_once dirname(__FILE__) . '/common/analytics.php';?>
    </body>
</html>
