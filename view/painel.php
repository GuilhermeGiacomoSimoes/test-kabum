<?php
session_start();
include('verify_login.php');
?>

<div style="background-color: #dcdcdc; height: 100%; width: 100%">
	<link rel="stylesheet" href="css/bulma.min.css" />
	<h2> Olá, <?php echo $_SESSION['user']; ?> </h2>
	<h2> <a href="logout.php">sair</a></h2>
	<h2> <a href="new_user.php">cadastrar novo usuário</a></h2>

	<br/>

	<div class="container" id="container_clients">
		<span class="title has-text-grey" style="margin-left: 10%; font-size: 30px">nome</span>
		<span class="title has-text-grey" style="margin-left: 20%; font-size: 30px">telefone</span>
		<span class="title has-text-grey" style="margin-left: 20%; font-size: 30px">cpf</span>

		<br/>

		<hr style="margin-left: 10%; margin-right: 10% ">
		
	</div>
</div>

<script>
	getClients();

	function getClients() {
		const url = "http://localhost:8080/model/get_clients.php";

		var xhttp = new XMLHttpRequest();
		xhttp.open('GET', url, false);
		xhttp.onreadystatechange = function() {
			if (xhttp.status == 200) {
				document.addEventListener( 'DOMContentLoaded', buildTable( xhttp.responseText ) );
			}
			else {
				alert('error');
			}
		}
		xhttp.send();
	}

	function buildTable( clients ){
		for (let client of clients){
			const html = `<span style="margin-left: 10%"> ${client['client_id']}</span>
						<span style="margin-left: 20%"> ${client['client_phone']} </span>
						<span style="margin-left: 20%"> ${client['client_cpf']} </span>
						<hr style="margin-left: 10%; margin-right: 10% ">`;

			document.getElementById('container_clients').innerHTML = html;
		}
	}

</script>

<style>
	.container {
		padding: 5%;
		background-color: #fff;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px
	}
</style>

