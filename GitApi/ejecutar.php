<<<<<<< Updated upstream
<?php
require_once('Command.php');
use mikehaertl\shellcommand\Command;

// Basic example
ini_set('display_errors', '1');
echo "Servidor: " . PHP_OS ."<br>";

$resp = run_command("git status -b --porcelain");
echo "Estado <br>$resp <br>";
try {
$cfg = run_command("git config remote.hola_mundo.prefix");	
} catch (Exception $e) {
	
}
echo "$cfg <br>";

$salida = run_command("git fetch --all");	
echo "Fetch: <br>$salida<br>";

function run_command($cmd) {
     $ruta = getenv("PATH");
//echo "Path: " . $ruta ."<br>";
$command = new Command(array(
    'command' => $cmd,

    // Will be passed as environment variables to the command
    /*'procEnv' => array(
        'PATH' => $ruta
    ),*/

    // Will be passed as options to proc_open()
    'procOptions' => array(
        'bypass_shell' => true,
    ),
    ));	
	if ($command->execute()) {
		return $command->getOutput();
	} else {
		return $command->getError();
		$exitCode = $command->getExitCode();
	}
	return shell_exec($cmd);
}

function run_command2($command) {
    $descriptorspec = array(
        1 => array('pipe', 'w'), //stdout
        2 => array('pipe', 'w'), //stderr
    );
	$envopts = array();
    $pipes = array();
    /* Depending on the value of variables_order, $_ENV may be empty.
     * In that case, we have to explicitly set the new variables with
     * putenv, and call proc_open with env=null to inherit the reset
     * of the system.
     *
     * This is kind of crappy because we cannot easily restore just those
     * variables afterwards.
     *
     * If $_ENV is not empty, then we can just copy it and be done with it.
    */
    $es_windows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    if(count($_ENV) === 0 && $es_windows) {
        $ruta = getenv("PATH");
        if(!empty($ruta)) {
            $_ENV["PATH"] = $ruta;
        }
    }

    if(count($_ENV) === 0) {
        $env = NULL;
        foreach($envopts as $k => $v) {
            putenv(sprintf("%s=%s",$k,$v));
        }
    } else {
        $env = array_merge($_ENV, $envopts);
    }
    $cwd = getcwd();
    if($es_windows) {
        $resource = proc_open($command, $descriptorspec, $pipes, $cwd, $env,  array('bypass_shell'=>TRUE));
    } else {
        $resource = proc_open($command, $descriptorspec, $pipes, $cwd, $env);
    }
    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    foreach ($pipes as $pipe) {
        fclose($pipe);
    }

    $status = trim(proc_close($resource));
    if ($status) {
        //echo "Error: $status <br>";
        throw new Exception($stderr);
    }
    //echo "Exito: $status <br>";
    return $stdout;
}
