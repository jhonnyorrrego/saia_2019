<?php
namespace Saia\Composer;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Configuracion extends Command {

    protected $dependencies = array();

    private $parametros = array(
        "dbengine" => "Motor (MySql, Oracle, SqlServer, MSSql, Postgres)",
        "dbuser" => "Usuario bdd",
        "dbpass" => "Clave bdd",
        "dbhost" => "Servidor",
        "dbname" => "Instancia bdd", // INSTANCIA
        "dbschema" => "Esquema (o bdd si es MySql)", // ESQUEMA
        "tablespace" => "Tablespace (o bdd si es MySql)", // TABLESPACE
        "dbport" => "Puerto"
    );

    /**
     * Relacion con los drivers de doctrine
     * pdo_mysql: A MySQL driver that uses the pdo_mysql PDO extension.
     * pdo_pgsql: A PostgreSQL driver that uses the pdo_pgsql PDO extension.
     * pdo_oci: An Oracle driver that uses the pdo_oci PDO extension. Note that this driver caused problems in our tests. Prefer the oci8 driver if possible.
     * pdo_sqlsrv: A Microsoft SQL Server driver that uses pdo_sqlsrv PDO Note that this driver caused problems in our tests. Prefer the sqlsrv driver if possible.
     */
    protected $motores = array(
        "MySql"     => "pdo_mysql",
        "Oracle"    => "pdo_oci",
        "SqlServer" => "pdo_sqlsrv",
        "MSSql"     => "pdo_sqlsrv",
        "Postgres"  => "pdo_pgsql"
    );

    private $valores = array();

    protected function execute(InputInterface $input, OutputInterface $output) {
        $dialog = $this->getHelperSet()->get('dialog');
        $output->writeln('<info>Por favor ingrese los valores solicitados</info>');
        $motor = "";
        foreach ($this->parametros as $key => $pregunta) {
            if($motor == "MySql" && in_array($key, array("dbschema","tablespace"))) {
                $this->valores[$key] = $this->valores["dbname"];
                continue;
            }
            $un_valor = $dialog->ask($output, '<question>' . $pregunta . ': </question>');

            if($key == "dbengine") {
                if(in_array($un_valor, array_keys($this->motores))) {
                    $this->valores[$key] = $this->motores[$un_valor];
                    $motor = $un_valor;
                } else {
                    $output->writeln(sprintf('<error>El valor para Motor debe ser: %s</error>', $pregunta, implode(", ", array_keys($this->motores))));
                    return 1;
                }
            } else if ($un_valor) {
                $this->valores[$key] = $un_valor;
                // $output->writeln(sprintf('<info>Package %s was succesfully registered</info>', $package));
            } else {
                $output->writeln(sprintf('<error>Debe ingresar un valor para </error>', $pregunta));
            }
        }
    }

    protected function configure() {
        $this->setName('configurar');
    }

    public function get_valores() {
        return $this->valores;
    }
}
