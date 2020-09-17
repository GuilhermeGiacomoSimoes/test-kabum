<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'administrative_area');

class Connection {
	function access() {
		$conn = new mysqli(HOST, USER, PASS, DB)  or die ('Não foi possível conectar');

		mysqli_set_charset($connection,"utf8");

		$stmt = $conn->stmt_init();
		return array($stmt, $conn);
	}
}
