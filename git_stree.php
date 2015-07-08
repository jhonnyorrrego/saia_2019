<?php
/**! /bin/bash
 *
 * Git STree -- A better Git subtree helper command.
 *
 * http://tdd.github.io/git-stree
 * http://https://medium.com/@porteneuve/mastering-git-subtrees-943d29a798ec
 *
 * Copyright (c) 2014 Christophe Porteneuve <christophe@delicious-insights.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining
 * a copy of this software and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including
 * without limitation the rights to use, copy, modify, merge, publish,
 * distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to
 * the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
// [ -n "$STREE_DEBUG" ] && set -x

// Env/context-related flags so we know what extra commands can be called upon.
// { [ "cygwin" = "$TERM" ] || { tty -s <&1 && [[ "$TERM"=~"color" ]]; }; } && is_tty=true || is_tty=false
$has_iconv = true;
$has_tr = true;

$CYAN=36;
$GRAY=37;
$GREEN=32;
$RED=31;
$YELLOW=33;
// Symbols
$CHECK = "OK";
$CROSS = "KO";

// Grabbing CLI arguments and the main subcommand
$args = $argv;
$subcmd = $args[1];

if (!empty($subcmd) && "--help" == $args[1]) {
	$args[0] = "help";
	$args[1] = $subcmd;
	$subcmd = $args[0];
}

function fake_git($comando, $resto) {
	// ejecutar comando git
	echo "git $comando $resto\n";
	return true;
}

/**
 * Command: `git stree add name -P prefix url [branch]`
 *
 * Defines a subtree and performs the initial injection in the working directory.
 * Does not create a commit out of it. Some configuration is added to retain
 * subtree information (e.g. prefix, url, branch and latest sync'd commit).
 */
//function add_subtree($name, $prefix, $url, $branch) {
function add_subtree($params) {
	$name = require_arg(2, 'Missing subtree name');
	var_dump($name);
	if (empty($name)) {
		return 'Missing subtree name';
	}
	require_arg(3, 'Missing -P parameter', '-P');
	$prefix = require_arg(4, 'Missing prefix');
	$prefix = normalize_prefix("$prefix");
	$url = require_arg(5, 'Missing URL');
	$branch = optional_arg(6, 'master');
	
	$root_key = get_root_key("$name");
	$remote_name = get_remote_name("$name");
	//FIXME: fake_git siempre devuelve true
	if (!fake_git("config", "--local --get remote.$remote_name.url")) {
		error(false, "A remote already exists for '$name' ($remote_name). Subtree already defined?");
	}
	
	check_conflicting_strees($prefix);
	
	ensure_attached_head();
	ensure_no_stage();
	
	$status = fake_git("remote", "add -t $branch $remote_name $url") && fake_git("fetch", "--quiet $remote_name");
	$status = $status && fake_git("config", "--local stree.$root_key.prefix $prefix");
	$status = $status && fake_git("config", "--local stree.$root_key.branch $branch");
	$status = $status && fake_git("read-tree", "--prefix=$prefix -u $remote_name/$branch");
	$status = $status && fake_git("commit", "-m '[STree] Added stree \'$root_key\' in $prefix'");
	$status = $status && fake_git("config", "--local stree.$root_key.latest-sync") . fake_git("rev-parse", "--short HEAD)");
	$status && yay("STree '$root_key' configured, 1st injection committed.");
	if (!$status) {
		$status = fake_git("remote", "rm $remote_name") && fake_git("config", "--local --remove-section stree.$root_key");
		$status = $status && error(false, "STree '$root_key' could not be configured.");
	}
}

// Helper: determines whether a branch exists
function branch_exists($rama) {
	// mira si existe la rama $rama en la configuracion
	// [ "refs/heads/$1" == "$(git rev-parse --symbolic-full-name --verify --quiet "$1")" ]
	return ("refs/heads/$rama" == fake_git("rev-parse", "--symbolic-full-name --verify --quiet '$rama'"));
}

// Helper: maintains detected stree conflict state in a file, to work across subshell boundaries.
function has_conflicts($opc = "otro") {
	$sentinel = fake_git("rev-parse", "--git-dir") . "/STREE_CONFLICTS";
	switch ($opc) {
		case "yes" :
			file_put_contents($sentinel, 'yes');
			break;
		case "reset" :
			if(file_exists($sentinel)) {
			    unlink($sentinel);
			    //return false;
			}
			break;
		
		default :
			if (file_exists($sentinel)) {
				$contenido = file_get_contents($sentinel);
				return "yes" == $contenido;
			}
			return false;
	}
}

// Helper: checks that the passed path doesn't conflict with existing stree
// definitions. If it does, lists them, and asks for confirmation. Refusal
// stops the script.
function check_conflicting_strees($path) {
	// $path="$1"
	$list = get_subtree_list();
	has_conflicts('reset');
	
	foreach ($list as $value ) {
		$tupla = preg_split("/[\s]+/", $value); // deben ser 3
		$tree = $tupla[0];
		$remoting = $tupla[1];
		$prefix = $tupla[2];
		if ($prefix != $path) {
			continue;
		}
		if (!has_conflicts()) {
			message($YELLOW, "Existing strees use that prefix already:");
		}
		message($YELLOW, "  $stree ($remoting)");
		has_conflicts('yes');
	}
	if (!has_conflicts()) {
		return;
	}
	has_conflicts('reset');
	
	// confirm('N', "Do you want to proceed and setup another stree with that same prefix?");
}

// Command: `git stree clear`
function clear_subtrees() {
	if (func_num_args() > 0) {
		$argumento = func_get_arg(0);
		$texto = <<<EOT
           This is not the command you are looking for.
           git stree clear removes all subtrees defined for this repository.  You
           specified a specific subtree ($argumento) on the command line, so you probably
           want:
           git stree rm $argumento
EOT;
		error(false, $texto);
	}
	
	if ($subcmd == "forget") {
		message($CYAN, "git stree forget has been deprecated: use git stree clear instead.");
	}
	
	foreach ( get_subtree_list("simple") as $name ) {
		rm_subtree($name) && discreet("Removed subtree '$name'");
	}
	yay('Successfully cleared all subtree definitions.');
}

// Helper: confirms with a Y/N question and repeat until a proper answer is given.
// Arguments: color, default (Y or N), message
function confirm() {
	// preguntar si/no
	return true;
}

// Helper: discreet info message. This will show up in gray on STDOUT.
function discreet($texto) {
	message($GRAY, "$@");
}

// Helper: makes sure we're not on a detached HEAD
function ensure_attached_head() {
	$resp_git = fake_git("rev-parse", "--abbrev-ref --symbolic HEAD");
	//FIXME: debe devolver algo como 'master'
	$resp_git='master';
	if ('HEAD' != $resp_git) {
		return true;
	}
	error(false, "You are apparently on a detached HEAD.  This is not a good point to commit from.  Checkout a branch.");
}

// Helper: makes sure we're in a Git repo. Piggy-backs on `git config --local`
// to determine that, instead of traversing the filesystem upwards looking for `.git`.
function ensure_git_repo() {
	$cmd = fake_git("rev-parse", "--is-inside-work-tree");
	echo "\n$cmd\n";
	//FIXME: Arreglar. En php true=1. Git devuelve "true"
	//("true" == "$cmd") or error(false, "You do not appear to be in a Git repository");
	("1" == "$cmd") or error(false, "You do not appear to be in a Git repository");
}

// Helper: makes sure there is nothing in the stage.
function ensure_no_stage() {
	fake_git("diff", "--cached --quiet") or error(false, "You have staged changes already.  This should not get conflated with an upcoming STree commit.  Finalize your commit first or unstage your stuff.");
}

// Helper: checks that the stree seems defined already.
function ensure_stree_defined($name) {
	// $name="$1";
	$remote_name = get_remote_name($name);
	$root_key = get_root_key($name);
	$lista = array (
			"remote.$remote_name.url",
			"stree.$root_key.prefix",
			"stree.$root_key.branch" 
	);
	foreach ( $lista as $key ) {
		fake_git("config", "--local --get $key") || error(false, "STree '$root_key' does not seem (fully) defined: missing '$key' configuration.");
	}
}

// Helper: error message. This will show up in red on STDERR, followed by usage info,
// then exit the script with exit code 1.
function error($show_usage, $mensaje) {
	global $show_usage, $RED;
	// show_usage=$1;
	// shift;
	message($RED, '', $mensaje);
	$show_usage && usage();
	// kill -s ABRT $$
	die("\nKAPUT\n");
}

// Helper: computes a backport branch name based on the passed CLI name.
function get_branch_name($nombre) {
	$bp_nombre = get_root_key($nombre);
	return "stree-backports-$bp_nombre";
}

// Helper: computes a remote name based on the passed CLI name.
function get_remote_name($nombre) {
	$stree_nombre = get_root_key($nombre);
	return "stree-$stree_nombre";
}

// Helper: computes a root config key based on the passed CLI name.
function get_root_key($nombre) {
	global $has_iconv, $has_tr;
	$result = $nombre;
	$has_iconv && $result = iconv("UTF-8", 'ASCII//TRANSLIT//IGNORE', $result);
	$has_tr && $result = strtr($result, "A-Z", "a-z");
	// $result=$(echo "$result" | sed 's/[^a-z0-9_ -]\+//g' | sed -e 's/^ \+\| \+$//g' -e 's/ \+/-/g')
	$result = preg_replace("/[^a-z0-9_ -]\+/", "//", $result);
	if (empty($result)) {
		error(false, "STree name '$nombre' does not yield a usable remote name.  Try using ASCII letters/numbers in it.");
	}
	return $result;
}

// Helper: returns a list of 3-tuples, one for each defined stree. Tuples are
// three quoted strings: the stree’s name, its remoting (remote-name/remote-branch),
// and its WD prefix subdirectory.
function get_subtree_list($par="") {
	//FIXME: Debe devolverse un array
	//$git_cfg = git_fake("config", "--local --get-regexp 'remote\.stree.*\.url'");
	$git_cfg = array("remote.stree-formatos_0k.url http://laboratorio.netsaia.com:82/giovanni.montes/formatos_0K.git");
	asort($git_cfg);
	$resp = array ();
	foreach ( $git_cfg as $value ) {
		list ( $key, $url ) = explode(' ', $value);
		//quitar el prefijo "remote.setree-" y el sufijo ".url" y dejar solo el nombre
		// $name="$(sed 's/remote\.stree-\|\.url//g' <<< "$key")"
		$pattern = "remote\.stree-\|\.url";
		$name = preg_replace("/" . $pattern . "/", "", $key);
		if ('simple' == $par) {
			array_push($resp, $name);
		} else {
			$branch = fake_git("config", "--local stree.$name.branch");
			$prefix = fake_git("config", "--local stree.$name.prefix");
			$tupla = sprintf("%s %s %s\n", $name, "$url@$branch", $prefix);
			array_push($resp, $tupla);
		}
	}
	return $resp;
}

// Command: `git stree list [-v]`
function list_subtrees() {
	$list = get_subtree_list();
	$verbose = false;
	// [ "-v" == "${args[1]}" ] && verbose=true
	
	foreach ( $list as $valor ) { // | while read stree remoting prefix; do
		$tupla = preg_split("/[\s]+/", $valor); // deben ser 3
		$stree = $tupla[0];
		$remoting = $tupla[1];
		$sprefix = $tupla[2];
		if (empty($stree)) {
			continue;
		}
		$branch_name = get_branch_name($stree);
		$backports = false;
		$backporting = '';
		if (branch_exists($branch_name)) {
			$backports = true;
		}
		$backports && $backporting = " (backports through $branch_name)";
		
		echo "* $stree [$prefix] <=> $remoting$backporting";
		if ($verbose) {
			$latest_sha = fake_git("config --local stree.$stree.latest-sync");
			$infix = '';
			$backports && $infix = '    ';
			echo '';
			fake_git("show", "-s --pretty=format:\"  %C(auto)Latest sync:$infix %h - %ad - %s (%an)%n\" $latest_sha");
			
			if ($backports) {
				fake_git("show", "-s --pretty=format:'  %C(auto)Latest backport: %h - %ad - %s (%an)%n' $branch_name");
			}
			echo '';
		}
	}
}

// Helper: info/success message. This will show up in cyan on STDOUT.
function meh($mensaje) {
	message($CYAN, '', $mensaje);
}

// Helper: message. Takes a color code as first arg, then the message as remaining
// args. Only injects VT100 ANSI codes if we're on a color-supporting TTY output
// (which is detected using STDOUT, by the way, so YMMV when redirecting to STDERR).
function message($color, $simbolo, $mensaje) {
	// shift
	
	echo "$color $simbolo $mensaje";
}

// Helper: normalizes a cwd-relative prefix so it starts from the root of the working directory.
function normalize_prefix($nombre) {
	$root = dirname(fake_git("rev-parse", "--git-dir"));
	
	if ('.' == "$root") {
		return $nombre;
	}
	/*
	 * $path=getcwd() . $nombre;
	 * $path="${path//\/.\//\/}";
	 * while ( "$path"=~"([^/][^/]*\/\.\./)" ) do
	 * $path="${path/${BASH_REMATCH[0]}/}";
	 * }
	 * sed "s@$root/@@" <<< "$path";
	 */
}

// Helper: gets an argument from the CLI, if present, otherwise uses the default
// passed as $2
function optional_arg($pos, $default) {
	global $args;
	if(count($args) <= $pos) {
		return $default;
	}
	
	$result = $args[$pos];
	if (!empty($result)) {
		return "$result";
	}
	return $default;
}

// Command: `git stree pull name`
//
// Pulls remote updates for a properly-configured subtree, and squash-merges them
// as a single commit in the current branch. This requires a non-detached HEAD and
// an empty stage, so we don't conflate our work with ongoing commit construction.
function pull_subtree($name, $log_size) {
	$name = require_name();
	
	ensure_attached_head();
	ensure_no_stage();
	ensure_stree_defined($name);
	
	$root_key = get_root_key($name);
	$remote = get_remote_name($name);
	$branch = fake_git("config", "--local stree.$root_key.branch");
	// $log_size=$(echo "${args[@]}" | sed -n 's/^.*--log=\([0-9]\+\).*$/\1/p')
	if (empty($log_size)) {
		$log_size = 20;
	}
	fake_git("fetch", "--quiet $remote") && $status = fake_git("merge", "--quiet -s subtree --squash --log=$log_size $remote/$branch");
	
	echo '';
	
	if (fake_git("diff", "--cached --quiet")) {
		meh("STree '$root_key' pulled, but no updates found.");
	} else {
		$latest_sync = fake_git("config", "--local stree.$root_key.latest-sync");
		if (empty($latest_sync)) {
			$latest_sync = '(use all)';
		}
		// buscar el archivo SQUASH_MSG en el .git dir
		$msg_file = fake_git("rev-parse", "--git-dir") . "/SQUASH_MSG";
		// buscar el ultimo mensaje en el archivo que coincida con el ultimo squash
		// $msg="[STree] Pulled stree '$root_key'"$'\n\n'"$(sed "/^commit $latest_sync/,100000d" "$msg_file")"
		echo "$msg" > "$msg_file";
		// $commits=$(grep --count '^commit ' "$msg_file");
		$commits = 3; // buscar el numero de commits
		fake_git("commit", "-F $msg_file") && fake_git("config", "--local stree.$root_key.latest-sync") . fake_git("rev-parse", "--short HEAD");
		yay("STree '$root_key' pulled, $commits update(s) committed.");
	}
}

// Command: `git stree push name [commits...]`
//
// Pushes $commits for a properly-configured subtree on its upstream.
// This can either take a series of specific commits, or will auto-determine
// a list of commits to be used since the last sync. These commits are
// cherry-picked on a special integration branch that first rebase-pulls
// from upstream, then the new set is pushed back.
function push_subtree() {
	$name = require_name();
	$numargs = func_num_args();
	echo "Number of arguments: $numargs \n";
	if ($numargs >= 2) {
		echo "Second argument is: " . func_get_arg(1) . "\n";
	}
	ensure_no_stage();
	ensure_stree_defined($name);
	
	$root_key = get_root_key($name);
	$prefix = fake_git("config", "--local stree.$root_key.prefix");
	
	$commits = array ();
	// $commits=(${args[@]:2})
	$commits = func_get_arg(2);
	if ($commits == 0) {
		$latest = fake_git("config", "--local stree.$root_key.latest-sync");
		if (empty($latest)) {
			error(false, "Cannot find the most recent sync point for this subtree :-(");
		}
		
		$latest = fake_git("rev-parse", "--short $latest");
		$root_dir = dirname(fake_git("rev-parse", "--git-dir"));
		chdir($root_dir);
		$commits = fake_git("rev-list", "--reverse --abbrev-commit \"$latest\".. -- $prefix");
		// cd - > /dev/null
		chdir("..");
		if ($commits == 0) {
			meh("No local commits found for subtree '$name' since latest sync ($latest)");
			return;
		}
	} else {
		$parsed_ref = '';
		for($i = 0; i < $commits; ++$i) {
			$parsed_ref = fake_git("rev-parse", "--short " . $commits[$i]);
			// si no falla la ejecuion de rev-parse
			if ($parsed) {
				$commits[$i] = $parsed_ref;
			} else {
				error(false, "Cannot resolve commit: " . $commits[$i]);
			}
		}
	}
	
	$latest_head = fake_git("rev-parse", "--symbolic --abbrev-ref HEAD");
	
	$remote_name = get_remote_name($name);
	$branch = fake_git("config", "--local stree.$root_key.branch");
	$branch_name = get_branch_name($name);
	
	if (branch_exists($branch_name)) {
		fake_git("checkout", "--quiet --merge $branch_name") && fake_git("fetch", "$remote_name") && fake_git("rebase", "--preserve-merges --autostash --quiet $remote_name/$branch");
	} else {
		fake_git("checkout", "--quiet --track -b $branch_name $remote_name/$branch");
	}
	
	foreach ( $commits as $commit ) {
		$status = fake_git("cherry-pick", "-x -X subtree=$prefix $commit") && fake_git("config", "--local stree.$root_key.latest-sync $commit") && discreet("* " . fake_git("show", "-s --oneline $commit"));
		if (!$status) {
			error(false, "Could not cherry-pick ") . fake_git("show", "-s --oneline $commit");
		}
	}
	
	fake_git("push", "--quiet $remote_name $branch_name:$branch") && fake_git("checkout", "--quiet --merge $latest_head") && yay("STree '$name' successfully backported $changes to its remote");
}

// Helper: require that an argument still be available in the list provided on the CLI
// and consume it, possibly verifying it is a given fixed string (then passed as $2).
//
// An error message *must* be provided as $1 should the argument be missing or incorrect.
// In such a case, it's passed to `error`, thereby stopping the script.
function require_arg($pos, $mensaje, $resto="") {
	global $args;
	if(count($args) <= $pos) {
		error(true, "falta el parametro $pos");
	}
	$result=$args[$pos];
	//var_dump($result);
	if( $resto && $resto != $result ) {
		$result='';
	}
	if ( $result ) {
	 return $result;
	 }
	 
	 error(true, $mensaje);
	 
	// bullshit
	return false;
}

// Helper: just a comfort wrapper over `require_arg` for the most common use case.
function require_name() {
	require_arg(1, 'Missing subtree name');
}

// Command: `git stree rm name`
//
// Removes all definitions (configuration entries) and backport branch for the given
// subtree, but leaves the subdirectory contents in place.
function rm_subtree($name) {
	// $name="$1"
	(empty($name)) && $name = require_name();
	$root_key = get_root_key($name);
	$remote_name = get_remote_name($name);
	$branch_name = get_branch_name($name);
	
	fake_git("config", "--local --remove-section stree.$root_key");
	fake_git("remote", "rm $remote_name");
	fake_git("branch", "-D $branch_name");
	(empty($name)) && yay("All settings removed for STree '$root_key'.");
	return true;
}

// Command: `git stree split name -P path url [branch]`
//
// Creates a proper subtree branch from a subdirectory's contents and history.
// Then the subtree's backport branch is configured and pushed (to either `master`
// or the specified branch).
function split_subtree() {
	$name = require_name();
	require_arg(2, 'Missing -P parameter', '-P');
	$prefix = require_arg(3, 'Missing prefix');
	$prefix = normalize_prefix("$prefix");
	$url = require_arg(4, 'Missing URL');
	$branch = optional_arg(5, 'master');
	
	$root_key = get_root_key($name);
	$remote_name = get_remote_name($name);
	if (fake_git("config", "--local --get remote.$remote_name.url")) {
		error(false, "A remote already exists for '$name' ($remote_name). Subtree already defined?");
	}
	
	ensure_attached_head();
	ensure_no_stage();
	
	$latest_head = fake_git("rev-parse", "--symbolic --abbrev-ref HEAD");
	$branch_name = get_branch_name($name);
	
	if (branch_exists($branch_name)) {
		error(false, "A subtree backport branch already exists for '$name' ($branch_name).  Subtree already defined/split?");
	}
	
	fake_git("remote", "add -t $branch $remote_name $url") && fake_git("config", "--local stree.$root_key.prefix $prefix") && fake_git("config", "--local stree.$root_key.branch $branch") && fake_git("checkout", "-b $branch_name --quiet") && fake_git("filter-branch", "-f --subdirectory-filter $prefix") && fake_git("push", "--quiet -u $remote_name $branch_name:$branch") && fake_git("config", "--local stree.$root_key.latest-sync") . fake_git("rev-parse", "HEAD") && fake_git("checkout", "--quiet --merge $latest_head") && yay("STree '$root_key' configured, split and pushed.");
}

// Helper: usage display on STDERR. Used when an error occurs or when the CLI
// args don't start with a valid command.
function usage($subcmd, $otros) {
	$cmd = $subcmd;
	
	if ("help" == $cmd && func_) {
		$cmd = $otros; // "${args[1]}";
	} elseif ("help" == "$cmd") {
		$cmd = "";
	}
	
	$comandos = array (
			'add',
			'clear',
			'forget',
			'help',
			'list',
			'pull',
			'push',
			'rm',
			'split' 
	);
	
	if (!in_array($cmd, $comandos)) {
		$cmd = "";
	}
	
	if (empty($cmd)) {
		$msg = <<<EOT
  Usage: $0 sub-command [options...]
  Sub-commands:
EOT;
	} else {
		$msg = <<<EOT
  Usage: stree $cmd [options…]
EOT;
	}
	
	if (empty($cmd) || "add" == $cmd) {
		$msg = <<<EOT
    add name -P prefix url [branch]
      Defines a new subtree and performs its initial fetch and prefixed
      (subdirectory) checkout.  You can specify a custom branch to track,
      otherwise it will use \`master\`.  This creates a few local configuration
      entries that will be needed later.
EOT;
	}
	if (empty($cmd) || "forget" == $cmd || "clear" == $cmd) {
		$msg = <<<EOT
    clear (formerly "forget")
      "Forgets" all subtrees if no identifiers are passed.  This essentially
      does \`git stree rm\` over each subtree in turn.
EOT;
	}
	if (empty($cmd) || "list" == $cmd) {
		$msg = <<<EOT
    list [-v]
      Lists all defined subtrees.  If the \`-v\` option is set, displays their
      latest sync (central -> subtree) commit and latest backport (subtree -> central)
      with their timestamps.
EOT;
	}
	if (empty($cmd) || "pull" == $cmd) {
		$msg = <<<EOT
    pull name [--log=20]
      Attempts to pull remote updates for a subtree you already defined.
      This is a no-rebase, squash-commit update that will not create any
      extra line in your history graph, but result in a single update commit
      on your current branch.
      If you wish to change the maximum number of merged commits info in the
      resulting squash commit, use the --log= option.  Defaults to 20.
EOT;
	}
	if (empty("$cmd") || "push" == "$cmd") {
		$msg = <<<EOT
    push name [commits...]
      Pushes your local work on the subtree to its defined remote.  If you
      specify commits, only these will be cherry-picked. Otherwise, it will
      cherry-pick all commits related to the subtree that occurred since the
      latest \`add\`/\`pull\`.  This creates/maintains a subtree-specific
      backport branch that you should not manually touch.
EOT;
	}
	if (empty("$cmd") || "rm" == "$cmd") {
		$msg = <<<EOT
    rm name
      Removes all definitions for the given subtree (but leaves the subdirectory
      contents in place).
EOT;
	}
	if (empty("$cmd") || "split" == "$cmd") {
		$msg = <<<EOT
    stree split name -P path url [branch]
      Creates a proper subtree branch from a subdirectory's contents and history.
      Then the subtree's backport branch is configured and pushed (to either \`master\`
      or the specified branch).
EOT;
	}
	if (empty("$cmd") || "help" == "$cmd") {
		$msg = <<<EOT
  help [command]
  Displays this usage information, or the command’s usage information.
EOT;
	}
	echo $msg;
}

// Helper: success message. This will show up in green on STDOUT.
function yay($mensaje) {
	global $GREEN, $CHECK;
	message($GREEN, $CHECK, $mensaje);
}

// Allow subshells (such as functions called within a `$(…)` subshell)
// to exit the parent script (the main `git-stree` script) by sending it
// an ABRT (6) signal. See `error` for the trigger side of this.
function exit1() {
	die(1);
}
// trap exit1 ABRT

// // MAIN ENTRY POINT ////

if ($subcmd != "help") {
	ensure_git_repo();
}

switch ($subcmd) {
	case "add" :
		add_subtree($args);
		break;
	case "clear" :
	case "forget" :
		clear_subtrees();
		break;
	case "list" :
		list_subtrees();
		break;
	case "pull" :
		pull_subtree($args, 20);
		break;
	case "push" :
		push_subtree();
		break;
	case "rm" :
		rm_subtree();
		break;
	case "split" :
		split_subtree();
		break;
	default :
		usage($subcmd, $args);
}
  
 