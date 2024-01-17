<?php
	define('db_host', 'localhost');
	define('db_username', 'magazin');
	define('db_password', 'passion100');
	define('db_name', 'magazin_hardware');
	function db_connect() { return new mysqli(db_host, db_username, db_password, db_name); }
	function salted($a, $b) { return $a . md5(strrev($b)); }
?>