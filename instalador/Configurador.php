<?php
namespace Saia\Composer;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Helper\Table;

class ConfigCaptureCommand extends Command {

    protected $dependencies = array();

    private $parametros;

    /**
     * Relacion con los drivers de doctrine
     * pdo_mysql: A MySQL driver that uses the pdo_mysql PDO extension.
     * pdo_pgsql: A PostgreSQL driver that uses the pdo_pgsql PDO extension.
     * pdo_oci: An Oracle driver that uses the pdo_oci PDO extension. Note that this driver caused problems in our tests. Prefer the oci8 driver if possible.
     * pdo_sqlsrv: A Microsoft SQL Server driver that uses pdo_sqlsrv PDO Note that this driver caused problems in our tests. Prefer the sqlsrv driver if possible.
     */
    protected $motores = array(
        "MySql" => "pdo_mysql",
        "Oracle" => "pdo_oci",
        "SqlServer" => "pdo_sqlsrv",
        "MSSql" => "pdo_sqlsrv",
        "Postgres" => "pdo_pgsql"
    );

    private $valores = array();

    protected function execute(InputInterface $input, OutputInterface $output) {
        $helper = $this->getHelperSet()->get('question');
        $output->writeln('<info>Por favor ingrese los valores solicitados</info>');
        $motor = "";
        foreach ($this->parametros as $key => $pregunta) {
            if ($motor == "MySql" && in_array($key, array(
                "dbschema",
                "tablespace"
            ))) {
                $this->valores[$key] = $this->valores["dbname"];
                continue;
            }
            $un_valor = $helper->ask($input, $output, $pregunta);

            if ($un_valor) {
                if ($key == "dbengine") {
                    $motor = $un_valor;
                    // $this->valores[$key] = $this->motores[$un_valor];
                    $this->valores["driver"] = $this->motores[$un_valor];
                }
                $this->valores[$key] = $un_valor;
            } else {
                $output->writeln(sprintf('<error>Debe ingresar un valor: %s</error>', $pregunta->getQuestion()));
            }
        }
        $datos = $this->valores;
        $datos["dbpass"] = "******";
        $table = new Table($output);
        $table ->setHeaders(array_keys($datos))
        ->setRows(array(array_values($datos)));
        $table->render();
        $question = new ConfirmationQuestion('Por favor indique si los valores son correctos. De lo contrario vuelva a ejecutar el comando "configurar" (y/N)? ', false);

        if (!$helper->ask($input, $output, $question)) {
            throw new \Exception('Configuración rechazada');
        }
    }

    protected function configure() {
        $this->setName('configurar')->setDescription("Obtener parámetros de configuración");
        $this->parametros = array();
        $preguntaMotor = new ChoiceQuestion('Seleccione el Motor (Por defecto MySql)', array(
            "MySql",
            "Oracle",
            "SqlServer",
            "MSSql",
            "Postgres"
        ), 0);

        $validar_vacio = function ($value) {
            if (trim($value) == '') {
                throw new \Exception('El valor no puede ser vacio');
            }

            return $value;
        };
        $validar_url = function ($value) {
            if (trim($value) == '') {
                throw new \Exception('El valor no puede ser vacio');
            }
            $url = $value;
            if(substr($value, 0, strlen("http")) !== "http") {
                $url = "http://" . $value;
            }

            if (filter_var($url, FILTER_VALIDATE_URL) === false) {
                throw new \Exception('Url incorrecta: ' . $url);
            }
            return $value;
        };
        $normalizer = function ($value) {
            return trim($value);
        };
        $preguntaMotor->setErrorMessage('El motor de base de datos %s no es válido.');
        $preguntaUsuario = new Question("Usuario bdd: ");
        $preguntaPw = new Question('Clave bdd: ');
        $preguntaPw->setHidden(true);
        // $preguntaPw->setValidator($validar_vacio);
        $preguntaServidorBdd = new Question("Servidor bdd: ");
        $preguntaServidorWeb = new Question("Dominio/IP instalación: ");
        $preguntaBdd = new Question("Instancia bdd: ");
        $preguntaEsquema = new Question("Esquema (o bdd si es MySql): ");
        $preguntaTableSpace = new Question("Tablespace (o bdd si es MySql): ");
        $preguntaPuerto = new Question("Puerto bdd: ");
        // $preguntaPw->setHiddenFallback(false);
        $this->parametros["dbengine"] = $preguntaMotor;
        $this->parametros["dbuser"] = $preguntaUsuario;
        $this->parametros["dbpass"] = $preguntaPw;
        $this->parametros["dbhost"] = $preguntaServidorBdd;
        $this->parametros["dbname"] = $preguntaBdd; // INSTANCIA
        $this->parametros["dbschema"] = $preguntaEsquema; // ESQUEMA
        $this->parametros["tablespace"] = $preguntaTableSpace; // TABLESPACE
        $this->parametros["dbport"] = $preguntaPuerto;
        // Establecer los validadores
        foreach ($this->parametros as $key => $pregunta) {
            if ($pregunta instanceof ChoiceQuestion) {
                continue;
            }
            $pregunta->setValidator($validar_vacio);
            $pregunta->setNormalizer($normalizer);
            $pregunta->setMaxAttempts(3);
        }

        $preguntaServidorWeb->setValidator($validar_url);
        $preguntaServidorWeb->setNormalizer($normalizer);
        $preguntaServidorWeb->setMaxAttempts(3);
        $this->parametros["urlsaia"] = $preguntaServidorWeb;
    }

    public function get_valores() {
        return $this->valores;
    }
}
