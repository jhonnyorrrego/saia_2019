<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}
require_once $ruta_db_superior.'workflow/common/delegate.php';

session_start();
################################################################################
###   REQUEST   ################################################################
// Collect the data (from POST or GET)
$action = $_REQUEST['action'];


switch ($action) {

    case 'info':
        info();
        break;

    case 'registerExe':
        registerExe();
        break;

    case 'logoutExe':
        logoutExe();
        break;

    case 'loginExe':
        loginExe();
        break;

    case 'forgotPasswordExe':
        forgotPasswordExe();
        break;

    case 'resetPassword':
        resetPassword();
        break;

    case 'resetPasswordExe':
        resetPasswordExe();
        break;

    case 'saveSettingsExe':
        saveSettingsExe();
        break;


    case 'save':
        save();
        break;

    case 'saveAs':
        saveAs();
        break;

    case 'saveSvg':
        saveSvg();
        break;

    case 'newDiagramExe':
        newDiagramExe();
        break;

    case 'editDiagramExe':
        editDiagramExe();
        break;

    case 'firstSaveExe':
        firstSaveExe();
        break;

    case 'load':
        load();
        break;

    case 'deleteDiagramExe':
        deleteDiagramExe();
        break;
    /*************************** */
    /*********COLABORATORS****** */
    /*************************** */
    case 'inviteByEmailColaborator':
        inviteByEmailColaborator();
        break;

    case 'removeColaborator':
        removeColaborator();
        break;
    
    case 'acceptInvitationExe':
        acceptInvitationExe();
        break;

    case 'deleteInvitation':
        deleteInvitation();
        break;

    case 'resendInvitation':
        resendInvitation();
        break;

    case 'rejectInvitation':
        rejectInvitation();
        break;

    case 'removeMeFromDiagram':
        removeMeFromDiagram();
        break;
}

/**Register a new user*/
function registerExe() {
    $account = trim($_POST['account']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);



    // Validate data
    if (validateString($account, 'Empty account')) {
        #print "Wrong account";
    }
    
    // Validate data
    if (validateEmail($email, 'Empty email or bad email syntax')) {
        #print "Wrong email";
    }
    if (validateString($password, 'Empty password')) {
        #print "Wrong password";
    }

    if ($password != $password2) {
        addError("Passwords don't match");
    }


    if (errors ()) {
        #print "Errors"; exit(0);
        redirect("../../register.php");
        exit(0);
    }

    $delegate = new Delegate();
    $userSameEmail = $delegate->userGetByEmail($email);
    $userSameAccount = $delegate->userGetByAccount($account);
    if (is_object($userSameEmail) || is_object($userSameAccount)) {
        addError("Email or account already present in the system");
        redirect("register.php");
        exit(0);
    } else {
        //ok so this email+account is free

        $nUser = new User();
        $nUser->account = $account;
        $nUser->email = $email;
        $nUser->password = md5($password);
        $nUser->timezoneOffset = $offset;
        $nUser->createdDate = now();
        $nUser->lastLoginDate = now();
        $nUser->lastLoginIp = $_SERVER['REMOTE_ADDR'];
        $nUser->lastBrowserType = $_SERVER['HTTP_USER_AGENT'];


        $id = $delegate->userCreate($nUser);
        if (is_numeric($id)) {
            $_SESSION['userId'] = $id;

            //automatically we assume that she will like to "stay signed" all the time
            $userCookie = packer(array('email' => $email, 'password' => md5($password)), PACKER_PACK);
            setcookie('biscuit', $userCookie, time() + ((60 * 60 * 24) * 5), '/');


            if (isset($_SESSION['tempDiagram'])) { //Do we have a temporary diagram in session?
                #print("Temp diagram present");
                #exit();
                #redirect('./controller.php?action=firstSaveExe');
                redirect('../saveDiagram.php');
            }
            else{
                #print("Temp diagram NOT present");
                #exit();
                if(isset($_SESSION['tempInvitationToken'])){ //Do we have a temporary invitation in session?
                    /*TODO: If we have an invitation for an email and the registered
                     * email is different that invitation's email will remain orphan. This might be a (minor) problem*/
                    $_SESSION['tempInvitationToken'] = null;
                    unset ($_SESSION['tempInvitationToken']);

                    redirect('../myDiagrams.php');
                }
                else {
                    redirect("../index.php");
                }
            }
        } else {
            addError("User could not be created. Id: " . $id);
            redirect("../register.php");
            exit(0);
        }


        redirect("../../register.php");
        exit(0);
    }
}
/*
<Clase>
<Nombre>loginExe
<Parametros>
<Responsabilidades>En esta funcion es donde redireccion desde que abrimos en el navegador localhost/diagramo, entra por aca dice que $email = "usuario", aqui era donde se realizaba el antiguo login.
<Notas>
<Excepciones>
<Salida>
<Pre-condiciones>
<Post-condiciones>
*/

function loginExe() {
    $email = "usuario";
    $password = "usuario";


    $delegate = new Delegate();
    $user = $delegate->userGetByEmailAndPassword($email, $password);

    if (is_object($user)) {
        $_SESSION['userId'] = $user->id;

        //remember me option
        if ($_REQUEST['rememberMe'] === 'true') {
            $userCookie = packer(array('email' => $email, 'password' => $password), PACKER_PACK);
            setcookie('biscuit', $userCookie, time() + ((60 * 60 * 24) * 5), '/');
        }

        $user->lastLoginDate = now();
        $user->lastLoginIp = $_SERVER['REMOTE_ADDR'];
        $user->lastBrowserType = $_SERVER['HTTP_USER_AGENT'];
        $delegate->userUpdate($user);
        if (isset($_SESSION['tempInvitationToken'])) { //accept invitation

            $token = $_SESSION['tempInvitationToken'];
            $delegate = new Delegate();
            $invitation = $delegate->invitationGetByToken($token);
            
            if($invitation->email == $user->email){ //check again if the user has the right to use this invitation
				
                //add user to diagram
                $userdiagram = new Userdiagram();
                $userdiagram->invitedDate = $invitation->createdOn;
                $userdiagram->acceptedDate = now();
                $userdiagram->nivel = Userdiagram::LEVEL_EDITOR;
                $userdiagram->diagramId = $invitation->diagramId;
                $userdiagram->userId = $user->id;
                $userdiagram->status = Userdiagram::STATUS_ACCEPTED;
                $delegate->userdiagramCreate($userdiagram);

                //delete invitation
                $delegate->invitationsDeleteByToken($invitation->token);

                //add meessage
                $diagram = $delegate->diagramGetById($userdiagram->diagramId);
                addMessage("Invitation for diagram " . $diagram->title .  " accepted");

                //destroy $_SESSION invitation
                $_SESSION['tempInvitationToken'] = null;
                unset($_SESSION['tempInvitationToken']);
            }
            else {
                addError("No rights to use that invitation");
            }

            //redirect to diagrams
            redirect("../myDiagrams.php");
            exit(0);
        } else {
			/*echo "si";
			die();*/
//-------------------------------------------------En esta linea se puede definir que cuando cargue diagramo cargue un diagrama en especifico
//Por ejemplo redirect("../index.php?diagramId=119"); donde diagramId=119 es el diagrama.
            redirect("../saveDiagram.php");
            exit(0);
        }

        
    } else {
        addError("Authetication failed");
        //outer site
        redirect("../../login.php");
        exit(0);
    }
}

/**
 * Logout
 */
function logoutExe() {
    if (is_numeric($_SESSION['userId'])) {
        unset($_SESSION['userId']);

        // Clear the user cookie
        setcookie('biscuit', null, time() - ((60 * 60 * 24) * 5), '/');


        session_destroy();
    }

    addMessage("You were logged out!");

    //up to the outer site
    redirect("../../index.php");
}

/**
 */
function forgotPasswordExe() {    
    $email = trim($_POST['email']);


    // Validate data
    if (!validateString($email, 'Empty email or bad email syntax')) {
        print "Wrong email: " . $email;
        exit();
    }


    if (errors ()) {
//        print "Errors"; exit(0);
        redirect("../../forgot-password.php");
        exit(0);
    }

    $delegate = new Delegate();
    $user = $delegate->userGetByEmail($email);
    if (is_object($user)) {
        $url = 'http://' . WEBADDRESS . '/editor/common/controller.php?action=resetPassword&k=' . $user->password . '&i=' . $user->id;
        $body =
                "<html>
                <head>
                <title>Reset your password</title>
                </head>
             <body>
                Hello, <p/>
                Here is your request to reset your password. Please click the link to reset your password.
                <a href=\"${url}\">${url}</a>
             </body>
             </html>";
        if (sendEmail($user->email, 'no-reply@' . WEBADDRESS, "Password reset", $body)) {
            addMessage("Reset email sent!");
        } else {
            addMessage("Reset email NOT sent!");
        }

        #outer site
        redirect("../../forgot-password.php");
        exit(0);
    } else {
        addError("Email not present in DB");
        redirect("../../forgot-password.php");
        exit(0);
    }
}

/* * Resets a password */

function resetPassword() {
    $id = trim($_GET['i']); //get user Id
    $key = trim($_GET['k']); //get user's encrypted password :D


    // Validate data
    if (validateString($id, 'Wrong i param')) {
        #print "Wrong email";
    }

    if (validateString($key, 'Wrong k param')) {
        #print "Wrong email";
    }


    if (errors ()) {
        #print "Errors"; exit(0);
        redirect("../../forgotPassword.php");
        exit(0);
    }

    $delegate = new Delegate();
    $user = $delegate->userGetByIdAndEncryptedPassword($id, $key);
    #print_r($user);
    #exit();
    if (is_object($user)) {
        $_SESSION['userId'] = $user->id;

        redirect("../../resetPassword.php");
        exit(0);
    } else {
        addError("User/Email not present in DB");
        redirect("../../forgotPassword.php");
        exit(0);
    }
}

/* * Resets a password */

function resetPasswordExe() {

    if (!is_numeric($_SESSION['userId'])) {
        addError("Not permited");
        redirect("../index.php");
        exit(0);
    }

    $password = trim($_POST['password']);

    // Validate data
    if (validateString($password, 'Password should have at least 4 characters', 4)) {
        #print "Wrong email";
    }



    if (errors ()) {
        #print "Errors"; exit(0);
        redirect("../../resetPassword.php");
        exit(0);
    }

    $delegate = new Delegate();
    $user = $delegate->userGetById($_SESSION['userId']);
    $user->password = md5($password);
    #print_r($user);
    #exit();
    if ($delegate->userUpdate($user)) {
        //we will skip this message
        //addMessage("Password changed!");

        redirect("../index.php");
        exit(0);
    } else {
        addError("Password not changed");
        redirect("../../resetPassword.php");
        exit(0);
    }
}

/* * Resets a password */

function saveSettingsExe() {

    if (!is_numeric($_SESSION['userId'])) {
        addError("Not permited");
        redirect("../index.php");
        exit(0);
    }

    $delegate = new Delegate();
    $user = $delegate->userGetById($_SESSION['userId']);
//    print_r($user);
//    exit();

//    $name = trim($_POST['name']);
    $currentPassword = trim($_POST['currentPassword']);
    $newPassword = trim($_POST['newPassword']);

//    if (strlen($name) >= 2) {
//        $user->name = $name;
//    }

    if (strlen($currentPassword) > 0) { //we want to change the password
        if (!strlen($newPassword) >= 4) {
            addError("New password too short or empty");
        }

        if (md5($currentPassword) != $user->password) {
            addError("Current password is wrong");
        } else {
            $user->password = md5($newPassword);
        }
    }



    if (errors ()) {
        #print "Errors"; exit(0);
        redirect("../settings.php");
        exit(0);
    }


    if ($delegate->userUpdate($user)) {
        addMessage("Settings saved!");

        redirect("../settings.php");
        exit(0);
    } else {
        addError("Settings not saved (or nothing to save)");
        redirect("../settings.php");
        exit(0);
    }
}

/* * Save currently edited diagram
 * We have 3 cases:
 * 1. there is no account present  (once time)
 * 2. account is present but this is the first save (seldomly)
 * 3. account is pressent and this is not the first save (the most common)
 */

function save() {
//print_r($_SESSION);
    if (!is_numeric($_SESSION['userId'])) { //no user logged
        $_SESSION['tempDiagram'] = $_POST['diagram'];
        $_SESSION['tempSVG'] = $_POST['svg'];
		$_SESSION['imagen'] = $_SESSION['tempSVG'];
        print "noaccount";
        exit();
    } else { //user is logged
        if (is_numeric($_REQUEST['diagramId'])) { //we have a current working diagram
            //print($_POST['svg']);

            $delegate = new Delegate();
            
            //see if we have rights to save it
            $userdiagram = $delegate->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
            if(!is_object($userdiagram)){
                print 'Not allocated to this diagram';
                exit();
            }
            //end check rights


            $currentDiagramId = $_REQUEST['diagramId'];
			
            $nowIsNow = now();

            //update the Dia file
            $diaData = $delegate->diagramdataGetByDiagramIdAndType($currentDiagramId, Diagramdata::TYPE_DIA);

            $fh = fopen( getStorageFolder().'/'. $currentDiagramId . '.dia', 'w');
            
            
//            $diaFile = dirname(__FILE__) . '/../diagrams/' . $_REQUEST['diagramId'] . '.dia';
			//print_r(stripslashes($_POST['svg']));
			//die();
			$_SESSION['imagen'] = stripslashes($_POST['svg']);
            $diaSize = fwrite($fh, stripslashes($_POST['diagram']));
            fclose($fh);
			

            $diaData->fileSize = $diaSize;
            $diaData->lastUpdate = $nowIsNow;
            $delegate->diagramdataUpdate($diaData);
            //end update Dia file
            //update the SVG file
			
			//echo "<script>alert('".stripslashes($_POST['svg'])."')</script>";
            $svgData = $delegate->diagramdataGetByDiagramIdAndType($currentDiagramId, Diagramdata::TYPE_SVG);

            $fh = fopen(getStorageFolder() . '/' . $currentDiagramId . '.svg', 'w');
            $svgSize = fwrite($fh, stripslashes($_POST['svg']));
            fclose($fh);

            $svgData->fileSize = $svgSize;
            $svgData->lastUpdate = $nowIsNow;
            $delegate->diagramdataUpdate($svgData);
            //end update the SVG file
            //update the Diagram
            $diagram = $delegate->diagramGetById($currentDiagramId);
            $diagram->tamano = $diaSize;
            $diagram->lastUpdate = $nowIsNow;
			
		

            if ($delegate->diagramUpdate($diagram)) {
                print "Guardado!!";
            } else {
                print 'Datos del diagrama no han sido guardados';
            }
            exit();
        } else { //no current working diagram
            $_SESSION['tempDiagram'] = stripslashes($_POST['diagram']);
            $_SESSION['tempSVG'] = stripslashes($_POST['svg']);
            print "firstSave";
            exit();
        }
    }
}

/* * Save currently edited diagram. We always have an user logged
 * We have 2 cases:
 * 1. there is no account present  (do nothing)
 * 2. account is present so store diagram in session and redirect (from JavaScript) to save Diabram form
 */

function saveAs() {
    
    if (!is_numeric($_SESSION['userId'])) { //no user logged
        $_SESSION['tempDiagram'] = stripslashes($_POST['diagram']);
        $_SESSION['tempSVG'] = stripslashes($_POST['svg']);
        print "noaccount";
        exit();
    } else { //user is logged
        $_SESSION['tempDiagram'] = stripslashes($_POST['diagram']);
        $_SESSION['tempSVG'] = stripslashes($_POST['svg']);
		//exporter/exporter.php?diagrama=
        print "step1Ok";
        exit();
    }
}

/* * Save currently SVG-ed diagram
 */

function saveSvg() {

    if (!empty($_POST['svg'])) { //no user logged
        $_SESSION['svg'] = stripslashes($_POST['svg']);
        print "svg_ok";
        exit();
    } else { //user is not logged
        print "svg_failed";
        exit();
    }
}

function newDiagramExe() {
//    if(!is_numeric($_SESSION['userId'])) { //no user logged
//        print "wrong turn";
//        exit();
//    }
    //reset ay temporary diagram
    $_SESSION['tempDiagram'] = null;
    unset($_SESSION['tempDiagram']);
    //unset($_SESSION['id_diagrama']);

    redirect('../index.php');
}

function editDiagramExe() {
    if (!is_numeric($_SESSION['userId'])) { //no user logged
        print "Not allowed";
        exit();
    }

    if (!is_numeric($_REQUEST['diagramId'])) { //no diagram specified
        print "No diagram";
        exit();
    }

    $d = new Delegate();
    $userdiagram = $d->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
    if (is_object($userdiagram) && is_numeric($userdiagram->userId)) { //see if we are "attached" to this diagram
        $diagram = $d->diagramGetById($_REQUEST['diagramId']);

        $diagram->title = trim($_REQUEST['title']);
        $diagram->description = trim($_REQUEST['description']);
        $diagram->publico = ($_REQUEST['publico'] == true) ? 1 : 2;
        $diagram->lastUpdate = now();

        if ($d->diagramUpdate($diagram)) {
            addMessage("Diagram updated");
        } else {
            addError("Diagram not updated");
        }
    } else {
        print "No rights over that diagram";
        exit();
    }

    redirect('../myDiagrams.php');
}

/* * We already have the temporary diagram saved in session */
function firstSaveExe() {
    if (!is_numeric($_SESSION['userId'])) {
        alerta("Sesion finalizada por favor ingrese de nuevo");
        exit();
    }

    //store current time
    $nowIsNow = now();

    //save Diagram
    $diagram = new Diagram();
    $diagram->title = trim($_REQUEST['title']);
    $diagram->description = trim($_REQUEST['description']);
    $diagram->publico = ($_REQUEST['publico'] == true) ? 1 : 2;
    $diagram->createdDate = $nowIsNow;
    $diagram->lastUpdate = $nowIsNow;
    $diagram->tamano = strlen($_SESSION['tempDiagram']); //TODO: it might be not very accurate

    $delegate = new Delegate();

    $token = '';
    do {
        $token = generateRandom(6);
    } while ($delegate->diagramCountByHash($token) > 0);

    $diagram->hash = $token;
    $diagramId = $delegate->diagramCreate($diagram);
    
    include_once("../../db.php");
    
    $ultimoid = busca_filtro_tabla("id","diagram","","id desc",$conn);
    $diagramId = $ultimoid[0]["id"];
     
    //end save Diagram
    //create Dia file
    $diagramdata = new Diagramdata();
    $diagramdata->diagramId = $diagramId;
    $diagramdata->type = Diagramdata::TYPE_DIA;

    $diagramdata->fileName = $diagramId . '.dia';
	
    $fh = fopen(getStorageFolder() . '/' . $diagramId . '.dia', 'w');
    $size = fwrite($fh, $_SESSION['tempDiagram']);
    fclose($fh);

    $diagramdata->fileSize = $size;
    $diagramdata->lastUpdate = $nowIsNow;

    $delegate->diagramdataCreate($diagramdata);
    //end Dia file
    //create SVG file
    $diagramdata = new Diagramdata();
    $diagramdata->diagramId = $diagramId;
    $diagramdata->type = Diagramdata::TYPE_SVG;
    $diagramdata->fileName = $diagramId . '.svg';
	

    $fh = fopen(getStorageFolder() . '/' . $diagramId . '.svg', 'w');
    $size = fwrite($fh, $_SESSION['tempSVG']);
    fclose($fh);
	
	$_SESSION['imagen'] = $_SESSION['tempSVG'];
	/*$fhj = fopen(getStorageFolder() . '/' . $diagramId . '.cvs', 'w');
    $sizej = fwrite($fhj, $_SESSION['tempSVG']);
    fclose($fhj);*/

    $diagramdata->fileSize = $size;
    $diagramdata->lastUpdate = $nowIsNow;
    $delegate->diagramdataCreate($diagramdata);
    //end SVG file
	
	//Creando sesion para guardar el id del diagrama actual
	//$_SESSION['id_diagrama'] = $diagramId;

    //clean temporary diagram
    unset($_SESSION['tempDiagram']);
    unset($_SESSION['tempSVG']);

    //attach it to an user
    $userdiagram = new Userdiagram();
    $userdiagram->diagramId = $diagramId;
    $userdiagram->userId = $_SESSION['userId'];
    $userdiagram->invitedDate = now();
    $userdiagram->acceptedDate = now();
    $userdiagram->nivel = Userdiagram::LEVEL_AUTHOR;
    $userdiagram->status = Userdiagram::STATUS_ACCEPTED;

    $delegate->userdiagramCreate($userdiagram);

    redirecciona("../../flujolist.php");
}


/**Loads a diagram*/
function load() {

    if (!is_numeric($_REQUEST['diagramId'])) {
        print "Wrong diagram id : " . $_REQUEST['diagramId'];
        exit();
    }

    $d = new Delegate();
    $diagram = $d->diagramGetById($_REQUEST['diagramId']);

    $allow = false;
    if($diagram->publico){
        $allow = true;
    }
    else{ //no publico so only logged users can see it
        if (!is_numeric($_SESSION['userId'])) {
            print "Wrong user id";
            exit();
        }

        $userdiagram = $d->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
        if (is_object($userdiagram) && is_numeric($userdiagram->userId)) {
            $allow = true;
        }
        else{
            print 'Error: no right over that diagram';
            exit();
        }
    }

    if($allow){
        $diagramdata = $d->diagramdataGetByDiagramIdAndType($_REQUEST['diagramId'], Diagramdata::TYPE_DIA);

        $diaFile = getStorageFolder() . '/' . $_REQUEST['diagramId'] . '.dia';

        /**When switching from Linux to Windows some files might get corrupt so we will use file_get_contents*/
//        $fh = fopen($diaFile, 'r');
//        $data = fread($fh, $diagramdata->fileSize);
//        fclose($fh);
        $data = file_get_contents($diaFile);

        print $data;
    }        
}



function deleteDiagramExe() {
    if (!is_numeric($_SESSION['userId'])) {
        print "Wrong way";
        exit();
    }

    if (!is_numeric($_REQUEST['diagramId'])) {
        print "Wrong diagram id : " . $_REQUEST['diagramId'];
        exit();
    }

    //TODO: usually ONLY the author can delete the diagram
    $d = new Delegate();


    $userdiagram = $d->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
    if (is_object($userdiagram) && is_numeric($userdiagram->userId)) {
        
        //delete diagramdata
        $diagramDatas = $d->diagramdataGetByDiagramId($userdiagram->diagramId);
        $storageFolder = getStorageFolder();
        foreach($diagramDatas as $diagramData){
            //TODO: we can make more tests here
            unlink($storageFolder . '/' . $diagramData->fileName);
            $d->diagramdataDeleteByDiagramIdAndType($diagramData->diagramId, $diagramData->type);
        }


        //delete all users linked to this diagram
        $userdiagrams = $d->userdiagramGetByDiagramId($userdiagram->diagramId);
        foreach($userdiagrams as $userdiagram){
            $d->userdiagramDelete($userdiagram->userId, $userdiagram->diagramId);
        }
        
        
        //delete diagram
        if ($d->diagramDelete($userdiagram->diagramId)) {
            addMessage("Diagram deleted");
        } else {
            addError("Diagram could not be deleted from database");
        }
		$sel1 = mysql_query("DELETE FROM paso WHERE diagram_id_diagram='".$userdiagram->diagramId."'");
        redirect('../myDiagrams.php');
    } else {
        print 'Error: no right over that diagram';
    }
}


/**Invite a collaborator by email*/
function inviteByEmailColaborator() {

    if (!is_numeric($_SESSION['userId'])) {
        print "Wrong way";
        exit();
    }

    if (empty($_REQUEST['email'])) {
        print "Email is empty";
        exit();
    }

    $d = new Delegate();
    $user = $d->userGetById($_SESSION['userId']);
    $diagram = $d->diagramGetById($_REQUEST['diagramId']);

    //see if he has the right to invite collaborators
    $userdiagram = $d->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
    if (!is_object($userdiagram)) {
        addError("You have no rights to invite users.");
        redirect('../colaborators.php?diagramId=' . $diagram->id);
        exit();
    }

    if ($userdiagram->nivel != Userdiagram::LEVEL_AUTHOR) {
        addError("No rights to invite people");
        redirect('../colaborators.php?diagramId=' . $diagram->id);
        exit();
    }

    $email = trim($_REQUEST['email']);

    /* Alreay a collaborator?
     * See if email belongs to an existing colaborator (so we can skip)*/
    $collaborators = $d->usersGetAsCollaboratorNative($diagram->id);
    foreach($collaborators as $collaborator){
        if($collaborator->email == $email){
            addError("This email belongs to an already present collaborator");
            redirect('../colaborators.php?diagramId=' . $diagram->id);
        }
    }
    
    /* Duplicate invitation?
     * See if another invitation for (diagramId & email) combination already in place*/
     $invitations = $d->invitationsGetByDiagram($diagram->id);
     foreach($invitations as $invitation){
         if($invitation->email == $email){
            addError("An invitation for this email already present in the system");
            redirect('../colaborators.php?diagramId=' . $diagram->id);
         }
     }



    //create invitation
    $invitation = new Invitation();
    $invitation->createdOn = now();
    $invitation->email = $email;
    $invitation->diagramId = $_REQUEST['diagramId'];
    $invitation->userId = $_SESSION['userId'];

    
    //iterate until we have a unique token in the DB
    $token = generateRandom(6, 'abchefghjkmnpqrstuvwxyz0123456789');
    while ($d->invitationCountByToken($token) > 0) {
        $token = generatePassword(6, 'abchefghjkmnpqrstuvwxyz0123456789');
    }
    $invitation->token = $token;

    
    //store it in DB
    if($d->invitationCreate($invitation)){
        addMessage("Invitation created");
        $emailBody = "Hi, <br>"
        . "You were invited by " . $user->account . ' (' . $user->email . ')' 
        . " to edit the diagram " . $diagram->title . "<br>"
         . "Please click this "
        #. '<a href="http://' . WEBADDRESS . '/t=' . $invitation->token . '">link</a>'
        . '<a href="http://' . WEBADDRESS . '/editor/common/controller.php?action=acceptInvitationExe&token=' . $invitation->token . '">link</a>'
        . " to accept it";
        sendEmail($invitation->email, "do-not-reply@diagramo.com", "Invitation to edit diagram " . $diagram->title,  $emailBody);
        addMessage("Invitation email sent.");
    }
    else{
        addError("Invitation not created");
    }

    
    //send email to email
    redirect('../colaborators.php?diagramId=' . $_REQUEST['diagramId']);
}

/**
 * Ex: http://diagramo.test/editor/common/controller.php?action=acceptInvitationExe
 */
function acceptInvitationExe(){

    #print_r($_REQUEST);
    #die();


    $token = $_REQUEST['token'];

    $delegate = new Delegate();

    $invitation = $delegate->invitationGetByToken($token);
    if(!is_object($invitation)){
        print("Sorry, there is no invitation for you here.");
        exit();
    }
    else{
        //check if that user exists in the system
        $user = $delegate->userGetByEmail($invitation->email);
//        print_r($_REQUEST);
//        print_r($user);
//        exit();

        /* There are 3 cases when receiving an invitation
         * 1. The user is present in the system but not logged in.
         *      We will accept invitation and then redirect him to login page.
         *      We do not want to login based on an invitation.
         *      Other option migh be to only inform him about an invitation and ask him to login first.
         * 2. The user is present in the system and is logged in.
         *      The most easy...and most rare :D
         * 3. The user is not present in the system.
         *      So we will redirect him to make and account first.
        */
        if(is_object($user)){ //user already present in the system
            
            if(is_numeric($_SESSION['userId']) && $user->id == $_SESSION['userId']){//(case 2) user logged in
                
                //TODO: maybe user already collaborator

                //add user to diagram
                $userdiagram = new Userdiagram();
                $userdiagram->invitedDate = $invitation->createdOn;
                $userdiagram->acceptedDate = now();
                $userdiagram->nivel = Userdiagram::LEVEL_EDITOR;
                $userdiagram->diagramId = $invitation->diagramId;
                $userdiagram->userId = $user->id;
                $userdiagram->status = Userdiagram::STATUS_ACCEPTED;
                $delegate->userdiagramCreate($userdiagram);

                //delete invitation
                $delegate->invitationsDeleteByToken($invitation->token);

                //add meessage
                addMessage("Invitation accepted");
                
                //redirect to diagrams
                redirect("../myDiagrams.php");
            }
            else{ //(case 1) user not logged
                $_SESSION['tempInvitationToken'] = $_REQUEST['token'];
                redirect("../../login.php");
            }

        }
        else{ //(case 3) user not present in the system. One more step. Create the user (offer to set up the password first)
            $_SESSION['tempInvitationToken'] = $_REQUEST['token'];
            redirect("../../register.php");
        }
    }
}


/**
 * Remove a colaborator
 */
function removeColaborator(){

    if (!is_numeric($_SESSION['userId'])) {
        print("Wrong way");
        exit();
    }
    
    if(!is_numeric($_REQUEST['diagramId'])){
        print("Wrong diagram");
        exit();
    }

    if(!is_numeric($_REQUEST['userId'])){
        print("Wrong user");
        exit();
    }

    $delegate = new Delegate();
    $userdiagram = $delegate->userdiagramGetByIds($_SESSION['userId'], $_REQUEST['diagramId']);
    if(is_object($userdiagram) && $userdiagram->nivel = Userdiagram::LEVEL_AUTHOR){
        if($_SESSION['userId'] == $_REQUEST['userId']){ /*Author should not delete itself :D*/
            addError("You should NOT delete yourself from the diagram. If you got bored just delete the diagram.");
        }
        else{
            if( $delegate->userdiagramDelete($_REQUEST['userId'], $_REQUEST['diagramId']) ){
                addMessage("Collaborator removed");
            }
            else{
                addError("Collaborator not removed");
            }
        }

        redirect('../colaborators.php?diagramId=' . $userdiagram->diagramId);
    }
    
}


/**
 * Remove an invitation
 */
function deleteInvitation(){

    if (!is_numeric($_SESSION['userId'])) {
        print("Wrong way");
        exit();
    }

    if(empty($_REQUEST['token'])){
        print("No token");
        exit();
    }


    $delegate = new Delegate();
    $invitation = $delegate->invitationGetByToken($_REQUEST['token']);

    $userdiagram = $delegate->userdiagramGetByIds($_SESSION['userId'], $invitation->diagramId); //logged user rights over the diagram
    if(is_object($userdiagram) && $userdiagram->nivel = Userdiagram::LEVEL_AUTHOR){
        if($delegate->invitationsDeleteByToken($_REQUEST['token'])){
            addMessage("Invitation deleted");
        }
        else{
            addError("Invitation not deleted");
        }

        redirect('../colaborators.php?diagramId=' . $userdiagram->diagramId);
    }
    else{
        addError("Invitation no (longer?) present in the system");
        redirect('../myDiagrams.php');
    }

}


/**
 * Resend an invitation
 */
function resendInvitation(){

    if (!is_numeric($_SESSION['userId'])) {
        print("Wrong way");
        exit();
    }

    if(empty($_REQUEST['token'])){
        print("No token");
        exit();
    }


    $delegate = new Delegate();
    $invitation = $delegate->invitationGetByToken($_REQUEST['token']);
    if(is_object($invitation) && is_numeric($invitation->diagramId)){

        $userdiagram = $delegate->userdiagramGetByIds($_SESSION['userId'], $invitation->diagramId); //logged user rights over the diagram
        if(is_object($userdiagram) && $userdiagram->nivel = Userdiagram::LEVEL_AUTHOR){
            //store it in DB
            $user = $delegate->userGetById($invitation->userId);
            $diagram = $delegate->diagramGetById($invitation->diagramId);

            $emailBody = "Hi, <br>"
            . "You were invited by " . $user->account . ' (' . $user->email . ')'
            . " to edit the diagram " . $diagram->title . "<br>"
             . "Please click this "
            #. '<a href="http://' . WEBADDRESS . '/t=' . $invitation->token . '">link</a>'
            . '<a href="http://' . WEBADDRESS . '/editor/common/controller.php?action=acceptInvitationExe&token=' . $invitation->token . '">link</a>'
            . " to accept it";
            sendEmail($invitation->email, "do-not-reply@diagramo.com", "Invitation to edit diagram " . $diagram->title,  $emailBody);
            addMessage("Invitation email resent.");

            redirect('../colaborators.php?diagramId=' . $userdiagram->diagramId);
        }
    }
    else{
        addError("Invitation no (longer?) present in the system");
        redirect('../myDiagrams.php');
    }

    
}


/**
 * Reject an invitation
 */
function rejectInvitation(){

    if (!is_numeric($_SESSION['userId'])) {
        print("Wrong way");
        exit();
    }

    if(empty($_REQUEST['token'])){
        print("No token");
        exit();
    }


    $delegate = new Delegate();
    $loggedUser = $delegate->userGetById($_SESSION['userId']);
    $invitation = $delegate->invitationGetByToken($_REQUEST['token']);
    //print_r($invitation);
    
    if ($loggedUser->email == $invitation->email) {
        if ($delegate->invitationsDeleteByToken($_REQUEST['token'])) {
            addMessage("Invitation rejected and deleted");
            
            //find the inviter/author of the diagram
            $authorUserdiagram = $delegate->userdiagramGetByAuthor($invitation->diagramId);
            $author = $delegate->userGetById($authorUserdiagram->userId);
            
            //notify inviter
            $diagram = $delegate->diagramGetById($invitation->diagramId);
            $emailBody = "Hi, <br>"
                    . "Your invitation for email " . $invitation->email
                    . " to edit the diagram " . $diagram->title . "<br>"
                    . " was rejected. Sorry.";
            sendEmail($author->email, "do-not-reply@diagramo.com", "Reject to edit diagram " . $diagram->title, $emailBody);
            //end notify inviter
            
        } else {
            addError("Invitation not deleted");
        }

        redirect('../myDiagrams.php');
    }
    else{
        print('No rights to reject invitation');
        exit();
    }


//    if(is_object($user)){ //user already present in the system
//        if(is_numeric($_SESSION['userId']) && $user->id == $_SESSION['userId']){
//
//        }
//    }
//    if(is_object($userdiagram) && $userdiagram->nivel = Userdiagram::LEVEL_AUTHOR){
//        //store it in DB
//        $user = $delegate->userGetById($invitation->userId);
//        $diagram = $delegate->diagramGetById($invitation->diagramId);
//
//        $emailBody = "Hi, <br>"
//        . "You were invited by " . $user->account . ' (' . $user->email . ')'
//        . " to edit the diagram " . $diagram->title . "<br>"
//         . "Please click this "
//        . '<a href="http://' . WEBADDRESS . '/t=' . $invitation->token . '">link</a>'
//        . " to accept it";
//        sendEmail($invitation->email, "do-not-reply@diagramo.com", "Invitation to edit diagram " . $diagram->title,  $emailBody);
//        addMessage("Invitation email resent.");
//
//
//        redirect('../colaborators.php?diagramId=' . $userdiagram->diagramId);
//    }

}


/**
 * The collaborator remove itself from diagram
 */
function removeMeFromDiagram(){

    if (!is_numeric($_SESSION['userId'])) {
        print("Wrong way");
        exit();
    }

    if(!is_numeric($_REQUEST['diagramId'])){
        print("No diagram");
        exit();
    }


    $delegate = new Delegate();
    $loggedUser = $delegate->userGetById($_SESSION['userId']);
    
    $userdiagram = $delegate->userdiagramGetByIds($loggedUser->id, $_REQUEST['diagramId']);

    if ($userdiagram) {
        /**author can not remove itself. he has to delete the diagram*/
        if($userdiagram->nivel == Userdiagram::LEVEL_AUTHOR){
            addError("Author can not remove itself from a diagram");
            redirect('../myDiagrams.php');
            exit();
        }
        
        if ($delegate->userdiagramDelete($loggedUser->id, $_REQUEST['diagramId'])) {
            addMessage("Removed from diagram");
            //TODO:  notify author ?             
        } else {
            addError("You were not removed from diagram");
        }

        redirect('../myDiagrams.php');
    }
    else{
        print('No rights');
        exit();
    }
}


function info() {
    phpinfo();
}

?>
