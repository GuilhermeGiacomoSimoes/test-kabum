<?php
session_start();
include('verify_login.php');
?>

<h2> Olá, <?php echo $_SESSION['user']; ?> </h2>
<h2> <a href="logout.php"/>sair</h2>

