<?php
$connection = ssh2_connect('laboratorio.netsaia.com', 22);
ssh2_auth_password($connection, 'digitalizacion_saia', 'cerok_saia421_5');

$sftp = ssh2_sftp($connection);
$remote_file="/var/www/html/saia_release1";
//bug desde la version 5.6.28 hasta la 7. Todas las operaciones tienen que llevar intval($sftp) al concatenar.
// No sirve $fd = intval($sftp)
$stream = fopen("ssh2.sftp://" . intval($sftp) . $remote_file, 'r');

if (! $stream)
	throw new Exception("Could not open file: $remote_file");
$tempArray = array();
$handle = opendir($stream);
// List all the files
while (false !== ($file = readdir($handle))) {
	if(is_dir($file)){
		$tempArray[]=$file;
	}

}
closedir($handle);
print_r($tempArray);
