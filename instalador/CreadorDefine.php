<?php
namespace Saia\Composer;

// require_once '../vendor/autoload.php';
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Process\Process;

class ConfigGenCommand extends Command {

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
        $output->writeln('<info>Creando archivo define.php</info>');
        if ($this->generateDefine($output) && $this->renameInstallationDirectory($output)) {
                $output->writeln('');
                $output->writeln('<info>INSTALACION TERMINADA</info>');
                $output->writeln('');
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
        $this->install_dir = $this->install_dir . DIRECTORY_SEPARATOR . $dialog->ask($output, '<question>Por favor especifique un directorio que no exista para empezar la instalacion: </question>');

        if (!is_dir($this->install_dir)) {

            $output->writeln(sprintf("<info>Se va a crear el directorio %s </info>", $this->install_dir));
            $mkdir = new Process(sprintf("mkdir -p %s", $this->install_dir));
            $mkdir->run();

            if ($mkdir->isSuccessful()) {
                $output->writeln(sprintf("<info>Directorio %s creado con exito</info>", $this->install_dir));

                return true;
            }
        }

        $this->failingProcess = $mkdir;
        return false;
    }

    protected function renameInstallationDirectory(OutputInterface $output) {
        $mkdir = new Process(sprintf("mv %s %s", $this->install_dir, "saia"));
        if (is_dir($this->install_dir) && !is_dir("saia")) {

            $output->writeln(sprintf("<info>Renombrando el directorio %s </info>", $this->install_dir));
            $mkdir->run();

            if ($mkdir->isSuccessful()) {
                $output->writeln(sprintf("<info>Directorio %s renombrado con exito</info>", $this->install_dir));
                return true;
            }
        } else {
            $output->writeln(sprintf("<error>No existe el directorio %s</error>", $this->install_dir));
        }

        $this->failingProcess = $mkdir;
        return false;
    }

    protected function install(OutputInterface $output) {
        // $install = new Process(sprintf('cd %s && php composer.phar install', $this->install_dir));
        $output->writeln('<info>' . __DIR__ .'</info>');
        $install = new Process(sprintf('cd %s && touch hola.txt', $this->install_dir));
        $install->run();

        if ($install->isSuccessful()) {
            $output->writeln('<info>Configuracion realizada con exito</info>');

            return true;
        }

        $this->failingProcess = $install;
        return false;
    }

    protected function generateDefine(OutputInterface $output) {
        //TODO: se puede usar $this->install_dir. Sino __DIR__ es el directorios saia/instalador (de momento)

        if(empty($this->configuracion->get_valores()) ) {
            $output->writeln('<info>Primero debe ejecutar la tarea "configurar"</info>');
            return false;
        }

        $skeleton = file_get_contents(__DIR__ . "/../_define.php");
        //$dependencies = implode(',', $this->dependenciesContainer->getDependencies());

        foreach ($this->configuracion->get_valores() as $key => $value) {
            $skeleton = str_replace('{{' . $key . '}}', $value, $skeleton);
        }

        $ruta_saia = basename(basename($this->install_dir));
        if(empty($ruta_saia)) {
            $ruta_saia = basename($this->install_dir);
        }
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
