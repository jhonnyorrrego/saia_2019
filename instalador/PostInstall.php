<?php
namespace Saia\Composer;

require 'Installer.php';

use Composer\Script\Event;

use Symfony\Component\Console\Shell;
use Symfony\Component\Console\Application;

class PostInstall {

    public static function localConf(Event $event) {
        $event->getIO()->write("Mostrar despues del comando INSTALL/UPDATE");
        require_once $event->getComposer()
            ->getConfig()
            ->get('vendor-dir') . '/autoload.php';

            $application            = new Application('Installer', '1.0.0-alpha');
            //$application->add($dependencyContainer);
            $application->add(new Install());
            $shell = new Shell($application);

            $shell->run();

    }
}
