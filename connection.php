<?php
define('HOST', '127.0.0.1');
define('USER', 'root');
define('PASS', 'root');
define('DB', 'administrative_area');

$connection = mysqli_connect(HOST, USER, PASS, DB)  or die ('Não foi possível conectar');
