<?php

namespace Saia\Composer;
//require_once '../vendor/autoload.php';

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class Install extends Command {

    protected $installDir;

    protected $failingProcess;

    protected function execute(InputInterface $input, OutputInterface $output) {
        if ($this->createInstallationDirectory($output) && $this->install($output)) {
            $output->writeln('<info>MISION CUMPLIDA</info>');
        } else {
            $output->writeln('<error>Nasty error happened :\'-(</error>');

            if ($this->failingProcess instanceof Process) {
                $output->writeln('<error>%s</error>', $this->failingProcess->getErrorOutput());
            }
        }
    }

    protected function configure() {
        $this->setName('install');
    }

    protected function createInstallationDirectory(OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $this->installDir = $dialog->ask($output, '<question>Por favor especifique un directorio que no exista para empezar la instalacion</question>');

        if (!is_dir($this->installDir)) {
            $mkdir = new Process(sprintf('mkdir -p %s', $this->installDir));
            $mkdir->run();

            if ($mkdir->isSuccessful()) {
                $output->writeln(sprintf('<info>Directorio %s creado con exito</info>', $this->installDir));

                return true;
            }
        }

        $this->failingProcess = $mkdir;
        return false;
    }

    protected function install(OutputInterface $output) {
        //$install = new Process(sprintf('cd %s && php composer.phar install', $this->installDir));
        $install = new Process(sprintf('cd %s && touch hola.txt', $this->installDir));
        $install->run();

        if ($install->isSuccessful()) {
            $output->writeln('<info>Paquetes instalados con exito</info>');

            return true;
        }

        $this->failingProcess = $install;
        return false;
    }
}
