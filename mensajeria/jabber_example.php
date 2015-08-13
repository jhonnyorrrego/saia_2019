<?php
include_once("class.jabber.envio.php");
// connect to the Jabber server
if (!$jab->connect(JABBER_SERVER)) {
	die("Could not connect to the Jabber server!\n");
}


// now, tell the Jabber class to begin its execution loop
$jab->execute(CBK_FREQ,RUN_TIME);
$jab->login(JABBER_USERNAME,JABBER_PASSWORD);
echo "ENVIANDO";
$jab->message("ok@mensajero.risaralda.gov.co","chat",NULL,"Prueba");
echo "ENVIADO";
//echo "ENVIANDO";
//$jab->message("cero.k@cetus.aguas","chat",NULL,"Jabber Funcionando");
//echo "ENVIADO";
// Note that we will not reach this point (and the execute() method will not
// return) until $jab->terminated is set to TRUE.  The execute() method simply
// loops, processing data from (and to) the Jabber server, and firing events
// (which are handled by our TestMessenger class) until we tell it to terminate.
//
// This event-based model will be familiar to programmers who have worked on
// desktop applications, particularly in Win32 environments.

// disconnect from the Jabber server
print_r($jab);
$jab->disconnect();

?>
