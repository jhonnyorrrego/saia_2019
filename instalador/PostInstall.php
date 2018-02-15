<?php
namespace Saia\Composer;

require 'CreadorDefine.php';
require 'Configurador.php';
require 'InstaladorBdd.php';

use Composer\Script\Event;
use Symfony\Component\Console\Shell;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class PostInstall {

    public static function localConf(Event $event) {
        //$event->getIO()->write("Mostrar despues del comando INSTALL/UPDATE");

        $composer_config = $event->getComposer()->getConfig();

        $installationManager = $event->getComposer()->getInstallationManager();
        $packages = $event->getComposer()
            ->getRepositoryManager()
            ->getLocalRepository()
            ->getPackages();

        $installPath = null;
        foreach ($packages as $package) {
            $installPath = $installationManager->getInstallPath($package);
            if (strpos($installPath, "editor_codigo") !== false) {
                //$installPath = null;
                continue;
            } else {
                break;
            }
        }

        if(is_file($installPath . "/define.php")) {
            $event->getIO()->write("La configuración ya fue realizada con anterioridad");
            return 1;
        }

        require_once $event->getComposer()
            ->getConfig()
            ->get('vendor-dir') . '/autoload.php';

        //$application = new Application('Instalador SAIA', '1.0.0-beta');

        //echo "Ruta: $installPath" . PHP_EOL;
        $configurador    = new ConfigCaptureCommand();
        $instalador = new ConfigGenCommand($installPath, $configurador);
        $generadordb = new ImportDbCommand($installPath, $configurador);
        //$application->add($configurador);
        //$application->add($instalador);
        //$application->add($generadordb);
        //$application->setDefaultCommand($configurador->getName());

        $salida = self::ejecutar_comando($configurador);
        if($salida) {
            $event->getIO()->write("Error en la ejecución de " . $configurador->getName());
            return;
        }
        $salida = self::ejecutar_comando($instalador);
        if($salida) {
            $event->getIO()->write("Error en la ejecución de " . $instalador->getName());
            return;
        }
        $salida = self::ejecutar_comando($generadordb);

        return $salida;

        //si se va a usar una especie de shell interactivo. Se meten todos los comandos en la app y se llama:
        //$shell = new Shell($application);
        //$shell->run();
    }

    private static function ejecutar_comando(Command $comando) {
        $orig_name = $comando->getName();
        $application = new Application('Instalador SAIA', '1.0.0-beta');
        $application->setAutoExit(false);
        $comando->setName("install");
        $application->add($comando);
        $ret = $application->run();
        $comando->setName($orig_name);
        return $ret;
    }
}
