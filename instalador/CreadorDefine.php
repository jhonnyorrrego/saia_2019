<?php
namespace Saia\Composer;

// require_once '../vendor/autoload.php';
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class ConfigGenCommand extends Command {

    protected $installDir;

    protected $install_dir;

    protected $configuracion;

    protected $failingProcess;

    public function __construct($originDir, $config) {
        parent::__construct();

        $this->install_dir = $originDir;
        $this->configuracion = $config;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        //if ($this->createInstallationDirectory($output) && $this->generateDefine($output)) {
        if ($this->generateDefine($output)) {
                $output->writeln('<info>FINALIZADO</info>');
        } else {
            $output->writeln('<error>Ocurrió un error :\'-(</error>');

            if ($this->failingProcess instanceof Process) {
                $output->writeln('<error>%s</error>', $this->failingProcess->getErrorOutput());
            }
        }
    }

    protected function configure() {
        $this->setName('define')->setDescription("Construir define.php");
    }

    protected function createInstallationDirectory(OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $this->installDir = $this->install_dir . DIRECTORY_SEPARATOR . $dialog->ask($output, '<question>Por favor especifique un directorio que no exista para empezar la instalacion: </question>');

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

        if(empty($this->configuracion->get_valores()) ) {
            $output->writeln('<info>Primero debe ejecutar la tarea "configurar"</info>');
            return false;
        }

        $skeleton = file_get_contents(__DIR__ . "/../_define.php");
        //$dependencies = implode(',', $this->dependenciesContainer->getDependencies());

        foreach ($this->configuracion->get_valores() as $key => $value) {
            $skeleton = str_replace('{{' . $key . '}}', $value, $skeleton);
        }

        $ruta_saia = basename($this->install_dir);
        if(empty($ruta_saia)) {
            $ruta_saia = $this->install_dir;
        }

        $skeleton = str_replace('{{carpetasaia}}', $ruta_saia, $skeleton);

        if (file_put_contents(__DIR__ . "/../define.php", $skeleton)) {
            $output->writeln('<info>define.php ha sido generado</info>');

            return true;
        }

        return false;
    }
}
