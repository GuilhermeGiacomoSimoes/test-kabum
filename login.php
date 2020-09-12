<?php 
session_start();
include('connection.php');

if (empty($_POST['user']) || empty($_POST['pass'])){
	header('Location: index.php');
	exit();
}

$user = mysqli_real_escape_string($connection, $_POST['user']);
$pass = mysqli_real_escape_string($connection, $_POST['pass']);

$query = "select user_name from user where user_name='{$user}' and password=md5('{$pass}')";

$result = mysqli_query($connection, $query);

$row = mysqli_num_rows($result);

if ($row == 1){
	$_SESSION['user'] = $user;
	header('Location: painel.php');
	exit();
}
else {
	$_SESSION['not_authenticated'] = true;
	header('Location: login.php');
	exit();
}
