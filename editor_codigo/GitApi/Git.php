<?php

/*
 * Git.php
 *
 * A PHP git library
 *
 * @package    Git.php
 * @version    0.1.4
 * @author     James Brumond
 * @copyright  Copyright 2013 James Brumond
 * @repo       http://github.com/kbjr/Git.php
 */

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) die('Bad load order');

/**
* Esto es necesario para ejecutar comandos git en ambientes windows
*/
require_once('Command.php');
use mikehaertl\shellcommand\Command;

// ------------------------------------------------------------------------

/**
 * Git Interface Class
 *
 * This class enables the creating, reading, and manipulation
 * of git repositories.
 *
 * @class  Git
 */
class Git {

	/**
	 * Git executable location
	 *
	 * @var string
	 */
	protected static $bin = '/usr/bin/git';

	/**
	 * Sets git executable path
	 *
	 * @param string $path executable location
	 */
	public static function set_bin($path) {
		self::$bin = $path;
	}

	/**
	 * Gets git executable path
	 */
	public static function get_bin() {
		return self::$bin;
	}

	/**
	 * Sets up library for use in a default Windows environment
	 */
	public static function windows_mode() {
		self::set_bin('git');
	}

	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @return  GitRepo
	 */
	public static function &create($repo_path, $source = null) {
		return GitRepo::create_new($repo_path, $source);
	}

	/**
	 * Open an existing git repository
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @return  GitRepo
	 */
	public static function open($repo_path) {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
           self::windows_mode();
        }       
		return new GitRepo($repo_path);
	}

	/**
	 * Clones a remote repo into a directory and then returns a GitRepo object
	 * for the newly created local repo
	 *
	 * Accepts a creation path and a remote to clone from
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  remote source
	 * @param   string  reference path
	 * @return  GitRepo
	 **/
	public static function &clone_remote($repo_path, $remote, $reference = null) {
		return GitRepo::create_new($repo_path, $remote, true, $reference);
	}

	/**
	 * Checks if a variable is an instance of GitRepo
	 *
	 * Accepts a variable
	 *
	 * @access  public
	 * @param   mixed   variable
	 * @return  bool
	 */
	public static function is_repo($var) {
		return (get_class($var) == 'GitRepo');
	}

}

// ------------------------------------------------------------------------

/**
 * Git Repository Interface Class
 *
 * This class enables the creating, reading, and manipulation
 * of a git repository
 *
 * @class  GitRepo
 */
class GitRepo {

	protected $repo_path = null;
	protected $bare = false;
	protected $envopts = array();

	/**
	 * Formatos predefinidos por git para imprimir el log
	 * @var unknown
	 */
	protected $log_pretty_formats = array ('oneline',
			'short',
			'medium',
			'full',
			'fuller',
			'email',
			'raw'
	);
	
	/**
	 * Devuelve true si la ruta especificada o el directorio de trabajo pertenecen a un repositorio Git
	 * @param string $path
	 * @return boolean
	 */
	public static function is_inside_git_repo($path="") {
	    
	    if($path) {
	       chdir($path);
	    }
	    
        //$status = exec(Git::get_bin()." " . "rev-parse --is-inside-work-tree");
        $status = self::strun_command("rev-parse --is-inside-work-tree");
	    return trim($status) == "true" ? true : false;
	}
	
	public static function st_repo_git_dir() {
	    //$status = self::strun_command("rev-parse --git-dir");
		$status = self::strun_command("rev-parse --show-toplevel");
	    return trim($status, "\n\r");
	}
	
	public static function get_root_dir() {

		$status = self::strun_command("rev-parse --show-toplevel");
		
	    if($status) {
	        $status = trim($status);
	    }
	    return $status;
	}
	
	/**
	 * Devuelve la ruta del directorio del repositorio. El que contiene la carpeta .git
	 */
	public function get_repo_root_dir() {
		$status = $this->run("rev-parse --show-toplevel");
		
	    if($status) {
	        $status = trim($status);
	    }
	    return $status;
	}
	
	/**
	 * Create a new git repository
	 *
	 * Accepts a creation path, and, optionally, a source path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   string  directory to source
	 * @param   string  reference path
	 * @return  GitRepo
	 */
	public static function &create_new($repo_path, $source = null, $remote_source = false, $reference = null) {
		if (is_dir($repo_path) && file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
			throw new Exception('"'.$repo_path.'" is already a git repository');
		} else {
			$repo = new self($repo_path, true, false);
			if (is_string($source)) {
				if ($remote_source) {
					if (!is_dir($reference) || !is_dir($reference.'/.git')) {
						throw new Exception('"'.$reference.'" is not a git repository. Cannot use as reference.');
					} else if (strlen($reference)) {
						$reference = realpath($reference);
						$reference = "--reference $reference";
					}
					$repo->clone_remote($source, $reference);
				} else {
					$repo->clone_from($source);
				}
			} else {
				$repo->run('init');
			}
			return $repo;
		}
	}

	/**
	 * Constructor
	 *
	 * Accepts a repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @return  void
	 */
	public function __construct($repo_path = null, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			$this->set_repo_path($repo_path, $create_new, $_init);
		}
	}

	/**
	 * Set the repository's path
	 *
	 * Accepts the repository path
	 *
	 * @access  public
	 * @param   string  repository path
	 * @param   bool    create if not exists?
	 * @param   bool    initialize new Git repo if not exists?
	 * @return  void
	 */
	public function set_repo_path($repo_path, $create_new = false, $_init = true) {
		if (is_string($repo_path)) {
			if ($new_path = realpath($repo_path)) {
				$repo_path = $new_path;
				if (is_dir($repo_path)) {
					// Is this a work tree?
					if (file_exists($repo_path."/.git") && is_dir($repo_path."/.git")) {
						$this->repo_path = $repo_path;
						$this->bare = false;
					// Is this a bare repo?
					} else if (is_file($repo_path."/config")) {
					  $parse_ini = parse_ini_file($repo_path."/config");
						if ($parse_ini['bare']) {
							$this->repo_path = $repo_path;
							$this->bare = true;
						}
					} else {
						if ($create_new) {
							$this->repo_path = $repo_path;
							if ($_init) {
								$this->run('init');
							}
						} else {
							throw new Exception('"'.$repo_path.'" is not a git repository');
						}
					}
				} else {
					throw new Exception('"'.$repo_path.'" is not a directory');
				}
			} else {
				if ($create_new) {
					if ($parent = realpath(dirname($repo_path))) {
						mkdir($repo_path);
						$this->repo_path = $repo_path;
						if ($_init) $this->run('init');
					} else {
						throw new Exception('cannot create repository in non-existent directory');
					}
				} else {
					throw new Exception('"'.$repo_path.'" does not exist');
				}
			}
		}
	}
	
	/**
	 * Get the path to the git repo directory (eg. the ".git" directory)
	 * 
	 * @access public
	 * @return string
	 */
	public function git_directory_path() {
		return ($this->bare) ? $this->repo_path : $this->repo_path."/.git";
	}

	/**
	 * Tests if git is installed
	 *
	 * @access  public
	 * @return  bool
	 */
	public function test_git() {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		$resource = proc_open(Git::get_bin(), $descriptorspec, $pipes);

		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}

		$status = trim(proc_close($resource));
		return ($status != 127);
	}

	/**
	 * Run a command in the git repository
	 *
	 * Accepts a shell command to run
	 *
	 * @access  protected
	 * @param   string  command to run
	 * @return  string
	 */
	protected function run_command($command) {
		$descriptorspec = array(
			1 => array('pipe', 'w'),
			2 => array('pipe', 'w'),
		);
		$pipes = array();
		/* Depending on the value of variables_order, $_ENV may be empty.
		 * In that case, we have to explicitly set the new variables with
		 * putenv, and call proc_open with env=null to inherit the reset
		 * of the system.
		 *
		 * This is kind of crappy because we cannot easily restore just those
		 * variables afterwards.
		 *
		 * If $_ENV is not empty, then we can just copy it and be done with it.
		 */
		if(count($_ENV) === 0 && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
		   $ruta = getenv("PATH");
           if(!empty($ruta)) {
               $_ENV["PATH"] = $ruta; 
           }
        }       
            
		if(count($_ENV) === 0) {
			$env = NULL;
			foreach($this->envopts as $k => $v) {
				putenv(sprintf("%s=%s",$k,$v));
			}
		} else {
			$env = array_merge($_ENV, $this->envopts);
		}
		$cwd = $this->repo_path;
		$resource = proc_open($command, $descriptorspec, $pipes, $cwd, $env);

		$stdout = stream_get_contents($pipes[1]);
		$stderr = stream_get_contents($pipes[2]);
		foreach ($pipes as $pipe) {
			fclose($pipe);
		}

		$status = trim(proc_close($resource));
		if ($status) {
		    //echo "Error: $status <br>";
		    throw new Exception($stderr);
		}
		    //echo "Exito: $status <br>";
		return $stdout;
	}

function run_command_win($cmd) {
     $ruta = getenv("PATH");
     $command = new Command(array(
    'command' => $cmd,

    // Will be passed as environment variables to the command
    /*'procEnv' => array(
        'PATH' => $ruta
    ),*/

    // Will be passed as options to proc_open()
    'procOptions' => array(
        'bypass_shell' => true,
    ),
    ));	
	if ($command->execute()) {
		return $command->getOutput();
	} else {
		$stderr = $command->getError();
		$exitCode = $command->getExitCode();
	    throw new Exception($stderr);
	}
}
	
	/**
	 * Run a command in the git repository
	 *
	 * Accepts a shell command to run
	 *
	 * @access  protected
	 * @param   string  command to run
	 * @return  string
	 */
	protected static function strun_command($command, $cwd="") {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
           Git::windows_mode();
        }       
        $command = Git::get_bin()." " .	$command;
	    $descriptorspec = array(
	        1 => array('pipe', 'w'),
	        2 => array('pipe', 'w'),
	    );
	    $pipes = array();
	    /* Depending on the value of variables_order, $_ENV may be empty.
	     * In that case, we have to explicitly set the new variables with
	     * putenv, and call proc_open with env=null to inherit the reset
	     * of the system.
	     *
	     * This is kind of crappy because we cannot easily restore just those
	     * variables afterwards.
	     *
	     * If $_ENV is not empty, then we can just copy it and be done with it.
	    */
	
        if(count($_ENV) === 0 && strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
           $ruta = getenv("PATH");
           if(!empty($ruta)) {
               $_ENV["PATH"] = $ruta; 
           }
        }       

        if(empty($cwd)) {
	       $cwd = getcwd();
        }
	    $resource = proc_open($command, $descriptorspec, $pipes, $cwd, $_ENV);

	    $stdout = stream_get_contents($pipes[1]);
	    $stderr = stream_get_contents($pipes[2]);
	    foreach ($pipes as $pipe) {
	        fclose($pipe);
	    }
	
	    $status = trim(proc_close($resource));
	    if ($status) {
	        throw new Exception($stderr);
	    }
	    //echo "Exito: $status <br>";
	    return $stdout;
	}
	
	/**
	 * Run a git command in the git repository
	 *
	 * Accepts a git command to run
	 *
	 * @access  public
	 * @param   string  command to run
	 * @return  string
	 */
	public function run($command) {
	    //echo "Ejecutando comando: $command <br>";
		return $this->run_command(Git::get_bin()." ".$command);
	}

	/**
	 * Runs a 'git status' call
	 *
	 * Accept a convert to HTML bool
	 *
	 * @access public
	 * @param bool  return string with <br />
	 * @return string
	 */
	public function status($html = false) {
		$msg = $this->run("status");
		if ($html == true) {
			$msg = str_replace("\n", "<br />", $msg);
		}
		return $msg;
	}

	/**
	 * Runs a 'git status' call
	 *
	 * Accept a convert to HTML bool
	 *
	 * @access public
	 * @param bool  return string with <br />
	 * @return string
	 */
	public function parsed_status_porcelain() {
		$msg = $this->run("status -b --porcelain");
		return $this->parse_status_output($msg);
	}

	
	/**
	 * Parses the output of git-status into an array. Assumes the "porcelain"
	 * option was used to generate the output.
	 *
	 * @param string $output
	 *   // output from a git-status call to parse
	 */
	protected function parse_status_output( $output ){
	
		$changed_items = array();
		if( preg_match_all( '/^.+?\\s(.*)$/m', $output, $changes, PREG_SET_ORDER ) ){
	
			foreach( $changes  as $changed_item ){
				$changed_items[] = $changed_item[1];
			}
	
		}
	
		return $changed_items;
	}


	/**
	 * Devuelve una lista de cambios
	 * @return multitype:unknown
	 */
	public function status_porcelain() {
	    $output = $this->run("status -b --porcelain");
		$changed_items = array();
		//$pattern = "/([A-Z ]{2}) ([A-Za-z_\-\.\/]+)/";
		if( preg_match_all( '/^.+?\\s(.*)$/m', $output, $changes, PREG_SET_ORDER ) ){
		
			foreach( $changes  as $changed_item ){
				$changed_items[] = $changed_item[0];
			}
	
		}
	
		return $changed_items;
	}

	/**
	 * Devuelve una lista de cambios
	 * @return multitype:unknown
	 */
	public function status_short() {
	    $output = $this->run("status -b --short");
	    $changed_items = array();
	    //$pattern = "/([A-Z ]{2}) ([A-Za-z_\-\.\/]+)/";
	    if( preg_match_all( '/^.+?\\s(.*)$/m', $output, $changes, PREG_SET_ORDER ) ){
	
	        foreach( $changes  as $changed_item ){
	            $changed_items[] = $changed_item[0];
	        }
	
	    }
	
	    return $changed_items;
	}
	
	/**
	 * Runs a `git add` call
	 *
	 * Accepts a list of files to add
	 *
	 * @access  public
	 * @param   mixed   files to add
	 * @return  string
	 */
	public function add($files = "*") {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("add $files -v");
	}

	/**
	 * Runs a `git rm` call
	 *
	 * Accepts a list of files to remove
	 *
	 * @access  public
	 * @param   mixed    files to remove
	 * @param   Boolean  use the --cached flag?
	 * @return  string
	 */
	public function rm($files = "*", $cached = false) {
		if (is_array($files)) {
			$files = '"'.implode('" "', $files).'"';
		}
		return $this->run("rm ".($cached ? '--cached ' : '').$files);
	}


	/**
	 * Runs a `git commit` call
	 *
	 * Accepts a commit message string
	 *
	 * @access  public
	 * @param   string  commit message
	 * @param   boolean  should all files be committed automatically (-a flag)
	 * @return  string
	 */
	public function commit($message = "", $commit_all = true) {
		$flags = $commit_all ? '-av' : '-v';
		return $this->run("commit ".$flags." -m ".escapeshellarg($message));
	}

	/**
	 * Runs a `git commit` call
	 *
	 * Accepts a commit message string
	 *
	 * @access  public
	 * @param   string  commit message
	 * @param   boolean  should all files be committed automatically (-a flag)
	 * @return  string
	 */
	public function commit_simple($message = "") {
		return $this->run("commit -m ".escapeshellarg($message));
	}

	public function commit_author($message, $user, $email) {
		//git commit --author="scor <scor@52142.no-reply.drupal.org>"
		$autor = "$user <$email>";
		$mensaje = escapeshellarg($message);
		$cmd = "commit -m $mensaje";
		$cmd .= ' --author="' . $autor . '"';
		return $this->run($cmd);
	}

	/**
	 * Runs a `git clone` call to clone the current repository
	 * into a different directory
	 *
	 * Accepts a target directory
	 *
	 * @access  public
	 * @param   string  target directory
	 * @return  string
	 */
	public function clone_to($target) {
		return $this->run("clone --local ".$this->repo_path." $target");
	}

	/**
	 * Runs a `git clone` call to clone a different repository
	 * into the current repository
	 *
	 * Accepts a source directory
	 *
	 * @access  public
	 * @param   string  source directory
	 * @return  string
	 */
	public function clone_from($source) {
		return $this->run("clone --local $source ".$this->repo_path);
	}

	/**
	 * Runs a `git clone` call to clone a remote repository
	 * into the current repository
	 *
	 * Accepts a source url
	 *
	 * @access  public
	 * @param   string  source url
	 * @param   string  reference path
	 * @return  string
	 */
	public function clone_remote($source, $reference) {
		return $this->run("clone $reference $source ".$this->repo_path);
	}

	/**
	 * Runs a `git clean` call
	 *
	 * Accepts a remove directories flag
	 *
	 * @access  public
	 * @param   bool    delete directories?
	 * @param   bool    force clean?
	 * @return  string
	 */
	public function clean($dirs = false, $force = false) {
		return $this->run("clean".(($force) ? " -f" : "").(($dirs) ? " -d" : ""));
	}

	/**
	 * Runs a `git branch` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function create_branch($branch) {
		return $this->run("branch $branch");
	}

	/**
	 * Runs a `git branch -[d|D]` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function delete_branch($branch, $force = false) {
		return $this->run("branch ".(($force) ? '-D' : '-d')." $branch");
	}

	/**
	 * Runs a `git branch` call
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on active branch
	 * @return  array
	 */
	public function list_branches($keep_asterisk = false) {
		$branchArray = explode("\n", $this->run("branch"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if (! $keep_asterisk) {
				$branch = str_replace("* ", "", $branch);
			}
			if ($branch == "") {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}

	/**
	 * Lists remote branches (using `git branch -r`).
	 *
	 * Also strips out the HEAD reference (e.g. "origin/HEAD -> origin/master").
	 *
	 * @access  public
	 * @return  array
	 */
	public function list_remote_branches() {
		$branchArray = explode("\n", $this->run("branch -r"));
		foreach($branchArray as $i => &$branch) {
			$branch = trim($branch);
			if ($branch == "" || strpos($branch, 'HEAD -> ') !== false) {
				unset($branchArray[$i]);
			}
		}
		return $branchArray;
	}

	/**
	 * Returns name of active branch
	 *
	 * @access  public
	 * @param   bool    keep asterisk mark on branch name
	 * @return  string
	 */
	public function active_branch($keep_asterisk = false) {
		$branchArray = $this->list_branches(true);
		$active_branch = preg_grep("/^\*/", $branchArray);
		reset($active_branch);
		if ($keep_asterisk) {
			return current($active_branch);
		} else {
			return str_replace("* ", "", current($active_branch));
		}
	}

	/**
	 * Runs a `git checkout` call
	 *
	 * Accepts a name for the branch
	 *
	 * @access  public
	 * @param   string  branch name
	 * @return  string
	 */
	public function checkout($branch) {
		return $this->run("checkout $branch");
	}


	/**
	 * Runs a `git merge` call
	 *
	 * Accepts a name for the branch to be merged
	 *
	 * @access  public
	 * @param   string $branch
	 * @return  string
	 */
	public function merge($branch) {
		return $this->run("merge $branch --no-ff");
	}


	/**
	 * Runs a git fetch on the current branch
	 *
	 * @access  public
	 * @return  string
	 */
	public function fetch($total = false) {
	    $cmd = "fetch ";
	    if($total) {
	        $cmd .= "--all";
	    }
		if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return $this->run_command_win(Git::get_bin()." ".$cmd);
		}
		return $this->run($cmd);
	}

	/**
	 * Runs a git fetch on the current branch
	 * Esta funcion solo se ejecuta en ambiente windows
	 * @access  public
	 * @return  string
	 */
	public function fetch_simple($remote, $ref="master") {
	    $cmd = "fetch $remote $ref";
		//echo "$$" . $cmd . "$$";
		return $this->run_command_win(Git::get_bin()." ".$cmd);
	    //return $this->run($cmd);
	}
	
	/**
	 * Runs a git fetch on the remote repository
	 *
	 * @access  public
	 * @return  string
	 */
	public function subtree_fetch($repository, $branch="") {
	    $cmd = "fetch $repository ";
	    if(!empty($branch)) {
	        $cmd .= $branch;
	    }
	    return $this->run($cmd);
	}
	
	/**
	 * Add a new tag on the current position
	 *
	 * Accepts the name for the tag and the message
	 *
	 * @param string $tag
	 * @param string $message
	 * @return string
	 */
	public function add_tag($tag, $message = null) {
		if ($message === null) {
			$message = $tag;
		}
		return $this->run("tag -a $tag -m " . escapeshellarg($message));
	}

	/**
	 * List all the available repository tags.
	 *
	 * Optionally, accept a shell wildcard pattern and return only tags matching it.
	 *
	 * @access	public
	 * @param	string	$pattern	Shell wildcard pattern to match tags against.
	 * @return	array				Available repository tags.
	 */
	public function list_tags($pattern = null) {
		$tagArray = explode("\n", $this->run("tag -l $pattern"));
		foreach ($tagArray as $i => &$tag) {
			$tag = trim($tag);
			if ($tag == '') {
				unset($tagArray[$i]);
			}
		}

		return $tagArray;
	}

	/**
	 * Push specific branch to a remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function push($remote, $branch) {
		$cmd = "push --tags $remote $branch";
		if(strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			return $this->run_command_win(Git::get_bin()." ".$cmd);
		}
		return $this->run($cmd);
	}
	
	public function subtree_push($prefix, $remote, $branch) {
	    $cmd = "subtree push --prefix $prefix $remote $branch";
	    return $this->run($cmd);
	}
	
	public function push_with_credentials($remote, $branch, $user, $pass, $url) {
		//FIXME: Se puede hacer pasando la url completa en el comando
	    $push_url = $this->get_remote_url_credentials($user, $pass, $url);
	    //FIXME: No funciono con las credenciales directas
	    $this->set_remote_credentials($remote, $push_url);
	    return $this->push($remote, $branch);
		//return $this->run("push $push_url $branch");
		//return $this->run("push --tags $push_url");
	}
	
	public function set_remote_credentials($remote, $url) {
	    //para no exponer las credenciales: 1. borrar el remoto 2. crear uno nuevo con la nueva url.
	    //Esto implica tener acceso rw sobre .git/config
	    //$this->run("remote rm $remote");
	    //return $this->run("remote add $remote $url");
	    //Mientras se soluciona devolver la url
	    
	    //Este comando tambien necesita permisos de escritura sobre .git/config, pero no devuelve exception
	    $this->run("remote set-url $remote $url");
	}
	
	/**
	 * change the credential for remote repository (origin)
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $user
	 * @param string $pass
	 * @param string $remote_url
	 * @return string
	 */
	public function get_remote_url_credentials($user, $pass, $remote_url) {
		//remote set-url origin http://laboratorio.netsaia.com:82/usuario/saia_base.git
	    $url_data = parse_url($remote_url);
	    //si url = http://usuario:clave@laboratorio.netsaia.com:82/giovanni.montes/saia_cerok.git
	    //Array ( [scheme] => http [host] => laboratorio.netsaia.com [port] => 82 [user] => usuario [pass] => clave [path] => /giovanni.montes/saia_cerok.git )
	    if($url_data["user"] !== $user) {
	        $url_data["user"] = $user;
	    }
	    $url_data["pass"] = $pass;
	    //$repo_name = explode("/", $url_data['path'])[2]; //debe ser el propieatio del repo y no el que hace el push
	    $repo_name = $url_data['path'];
	    //$nueva_url= sprintf("%s://%s:%s@%s:%s%s",$url_data['scheme'],$url_data['user'],$url_data['pass'],$url_data['host'],$url_data['port'],$repo_name);
	    $nueva_url="";
	    $nueva_url .= $url_data['scheme'] . "://" . $url_data['user'] . ":" . $url_data['pass'] . "@" . $url_data['host'];
	    if($url_data['port']) {
	    	$nueva_url .= ":" . $url_data['port'];
	    }
	    $nueva_url .= $repo_name;
	    return $nueva_url;
	}

	public function list_remotes() {
		//puede ser windows \r\n
		return preg_split("/[\n\r]+/", $this->run("remote -v"));
	}

	protected function parse_remote_info($info) {
		//origin  http://laboratorio.netsaia.com:82/giovanni.montes/saia_base.git (push)
		return explode("\n",$info);
	}
	
	/**
	 * Pull specific branch from remote
	 *
	 * Accepts the name of the remote and local branch
	 *
	 * @param string $remote
	 * @param string $branch
	 * @return string
	 */
	public function pull($remote, $branch, $normal=true) {
		//usar la opcion --no-edit porque intenta abrir un editor y falla
		if($normal) {
		    return $this->run("pull $remote $branch");
		}
	    return $this->run("pull --no-edit $remote $branch");
	}

	public function subtree_pull($prefix, $remote, $branch, $mensaje="", $aplastar=false) {
	    $cmd = "subtree pull --prefix $prefix $remote ";
	    if(!empty($mensaje)) {
                $msg = escapeshellarg($mensaje);
	        $cmd .= " -m $msg ";
	    }
	    $cmd .= "$branch ";
	    if($aplastar) {
	        $cmd .= " --squash";
	    }
        return $this->run($cmd);
	}
	
	public function pull_ff_only($remote, $branch) {
		return $this->run("pull --ff-only $remote $branch");
	}
	
	/**
	 * List log entries.
	 *
	 * @param string $format: Puede ser enviada por el usuario o una de las predefinidas
	 * @return string
	 */
	public function log($format = null) {
		if ($format === null)
			return $this->run('log');
		elseif (in_array($format, $this->log_pretty_formats)) {
			return $this->run('log --pretty="' . $format . '"');
		} else {
			return $this->run('log --pretty=format:"' . $format . '"');
		}
		
	}

	/**
	 * Sets the project description.
	 *
	 * @param string $new
	 */
	public function set_description($new) {
		$path = $this->git_directory_path();
		file_put_contents($path."/description", $new);
	}

	/**
	 * Gets the project description.
	 *
	 * @return string
	 */
	public function get_description() {
		$path = $this->git_directory_path();
		return file_get_contents($path."/description");
	}

	public function set_config($key, $value, $global=false) {
	    $cmd = "config "; 
	    if ($global) {
	        $cmd .= "--global ";
	    } else {
	        $cmd .= "--local ";
	    }
	        //git config --local stree.git-api.prefix editor_codigo
	    return $this->run($cmd . "$key $value");
	}

	public function get_config($key, $global=false) {
	    $cmd = "config ";
	    if ($global) {
	        $cmd .= "--global ";
	    } else {
	        $cmd .= "--local ";
	    }
	     
	    //git config --local stree.git-api.prefix editor_codigo
	    $cmd .= $key;
	    return $this->run($cmd);
	}
	
	/**
	 * Sets custom environment options for calling Git
	 *
	 * @param string key
	 * @param string value
	 */
	public function setenv($key, $value) {
		$this->envopts[$key] = $value;
	}
	
	/**
	 * Devuelve la lista de subarboles usados en el repositorio
	 */
	public function get_subtree_list() {
	    
	    $git_cfg = $this->run("log --pretty=oneline --grep 'git-subtree-dir'");
	    //$git_cfg .= "285b6b87dd2d8463e2bc6dc802e5058e2ac8740d Squashed 'editor_codigo/GitApi2/' content from commit 6f4d128";
	    //FIXME: La lista 
	    $lineas = preg_split("/[\n\r]+/", $git_cfg);
	    $resp = array ();
	    $pattern_stree = "/([A-Fa-f0-9]+) ([A-Za-z ]+) ('[^']+') (.*)/";
	    if(is_array($lineas)) {
	        foreach ($lineas as $linea) {
	            $output_array = array();
                if(preg_match($pattern_stree, $linea, $output_array)){
                    $prefix = str_replace("'", "", $output_array[3]);
                    if(file_exists($prefix)) {
                        $resp[] = $prefix;
                    }
	            }
	        }
	    }
	    return array_unique($resp);
	}
	
	public function sobreescribir_archivo_local($remote, $branch, $file) {
	        //$git_cfg = $this->run("git checkout origin/master <filepath>");
	        $git_cfg = $this->run("git checkout $remote/$branch $file");
	}
	

}

/* End of file */
