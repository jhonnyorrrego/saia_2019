<?php
namespace Saia\Composer;

require 'CreadorDefine.php';
require 'Configurador.php';
require 'InstaladorBdd.php';

use Composer\Script\Event;
use Symfony\Component\Console\Shell;
use Symfony\Component\Console\Application;

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
        require_once $event->getComposer()
            ->getConfig()
            ->get('vendor-dir') . '/autoload.php';

        $application = new Application('Instalador SAIA', '1.0.0-beta');

        //echo "Ruta: $installPath" . PHP_EOL;
        $configurador    = new ConfigCaptureCommand();
        $instalador = new ConfigGenCommand($installPath, $configurador);
        $generadordb = new ImportDbCommand($installPath, $configurador);
        $application->add($configurador);
        $application->add($instalador);
        $application->add($generadordb);
        $application->setDefaultCommand($configurador->getName());

        //$application->run();
        $shell = new Shell($application);

        $shell->run();
    }
}
