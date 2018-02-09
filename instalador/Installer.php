<?php
namespace Saia\Composer;

// require_once '../vendor/autoload.php';
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class Install extends Command {

    protected $installDir;

    protected $originDir;

    protected $configuracion;

    protected $failingProcess;

    public function __construct($originDir, $config) {
        parent::__construct();

        $this->originDir = $originDir;
        $this->configuracion = $config;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        if ($this->createInstallationDirectory($output) && $this->generateDefine($output)) {
            $output->writeln('<info>MISION CUMPLIDA</info>');
        } else {
            $output->writeln('<error>Nasty error happened :\'-(</error>');

            if ($this->failingProcess instanceof Process) {
                $output->writeln('<error>%s</error>', $this->failingProcess->getErrorOutput());
            }
        }
    }

    protected function configure() {
        $this->setName('instalar');
    }

    protected function createInstallationDirectory(OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $this->installDir = $this->originDir . DIRECTORY_SEPARATOR . $dialog->ask($output, '<question>Por favor especifique un directorio que no exista para empezar la instalacion: </question>');

        if (!is_dir($this->installDir)) {

            $output->writeln(sprintf("<info>Se va a crear el directorio %s </info>", $this->installDir));
            $mkdir = new Process(sprintf("mkdir -p %s", $this->installDir));
            $mkdir->run();

            if ($mkdir->isSuccessful()) {
                $output->writeln(sprintf("<info>Directorio %s creado con exito</info>", $this->installDir));

                return true;
            }
        }

        $this->failingProcess = $mkdir;
        return false;
    }

    protected function install(OutputInterface $output) {
        // $install = new Process(sprintf('cd %s && php composer.phar install', $this->installDir));
        $output->writeln('<info>' . __DIR__ .'</info>');
        $install = new Process(sprintf('cd %s && touch hola.txt', $this->installDir));
        $install->run();

        if ($install->isSuccessful()) {
            $output->writeln('<info>Configuracion realizada con exito</info>');

            return true;
        }

        $this->failingProcess = $install;
        return false;
    }

    protected function generateDefine(OutputInterface $output) {
        //TODO: se puede usar $this->installDir. Sino __DIR__ es el directorios saia/instalador (de momento)
        $skeleton = file_get_contents(__DIR__ . "/../_define.php");
        //$dependencies = implode(',', $this->dependenciesContainer->getDependencies());

        foreach ($configuracion->get_valores() as $key => $value) {
            $skeleton = str_replace("{{$key}}", $value, $skeleton);
        }
        $skeleton = str_replace('{{dbhost}}', "", $skeleton);
        $skeleton = str_replace('{{dbname}}', "", $skeleton);
        $skeleton = str_replace('{{dbuser}}', "", $skeleton);

        if (file_put_contents(__DIR__ . "/../define.php", $skeleton)) {
            $output->writeln('<info>define.php ha sido generado</info>');

            return true;
        }

        return false;
    }
}
