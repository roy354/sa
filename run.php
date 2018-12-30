<?php
require 'class.php';

$file = file_get_contents('1.txt');
$ex = explode(",", $file);
foreach ($ex as $key) {
	$x = explode("|", $key);
	$id = $x['0'];
	$jenis = $x['1'];
	$bot = new bot();
	$bot->lihat($id, $jenis);
}

?>