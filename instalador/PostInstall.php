<?php
namespace Saia\Composer;

require 'Installer.php';

use Composer\Script\Event;

use Symfony\Component\Console\Shell;
use Symfony\Component\Console\Application;

class MyHook {

    public static function localConf(Event $event) {
        $event->getIO()->write("Show me after INSTALL/UPDATE command");
        require_once $event->getComposer()
            ->getConfig()
            ->get('vendor-dir') . '/autoload.php';

            $application            = new Application('Installer', '1.0.0-alpha');
            $application->add($dependencyContainer);
            $application->add(new Install($dependencyContainer));
            $shell = new Shell($application);

            $shell->run();

    }
}
