<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Configuracion extends Command {

    protected $dependencies = array();

    private $parametros = array(
        "dbengine" => "Motor",
        "dbuser" => "Usuario bdd",
        "dbpass" => "Clave bdd",
        "dbname" => "Instancia bdd", // INSTANCIA
        "dbschema" => "Esquema (o bdd si es MySql", // ESQUEMA
        "tablespace" => "Tablespace (o bdd si es MySql", // TABLESPACE
        "dbport" => "Puerto"
    );

    private $valores = array();

    public function getDependencies() {
        return $this->dependencies;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $output->writeln('<info>Por favor ingrese los valores solicitados</info>');
        foreach ($parametros as $key => $pregunta) {
            $un_valor = $dialog->ask($output, '<question>' . $pregunta . ': </question>');
            $this->valores[$key] = $dialog->ask($output, '<question>' . $pregunta . ': </question>');
            if ($un_valor) {
                $this->valores[$key] = $un_valor;
                // $output->writeln(sprintf('<info>Package %s was succesfully registered</info>', $package));
            } else {
                $output->writeln(sprintf('<error>Debe ingresar un valor para </error>', $pregunta));
            }
        }
    }

    protected function configure() {
        $this->setName('configurar');
        ;
    }

    public function get_valores() {
        return $this->valores;
    }
}
