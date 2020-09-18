<?php
session_start();
include('verify_login.php');
?>

<div style="background-color: #dcdcdc; height: 100%; width: 100%">
	<link rel="stylesheet" href="css/bulma.min.css" />
	<h2> Olá, <?php echo $_SESSION['user']; ?> </h2>
	<h2> <a href="logout.php">sair</a></h2>

	<br/>

	<div class="container" id="container_clients">
		<span class="title has-text-grey" style="margin-left: 10%; font-size: 30px">nome</span>
		<span class="title has-text-grey" style="margin-left: 20%; font-size: 30px">telefone</span>
		<span class="title has-text-grey" style="margin-left: 20%; font-size: 30px">cpf</span>
		<a href="new_user.php" style="margin-left: 12%">
			<button class="new" >Novo</button>
		</a>
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
				document.addEventListener( 'DOMContentLoaded', buildTable( JSON.parse(xhttp.responseText) ) );
			}
			else {
				alert('error');
			}
		}
		xhttp.send();
	}

	function buildTable( clients ){
		for (let client of clients){
			const html = `<span style="margin-left: 10%"> ${client['client_name']}</span>
						<span style="margin-left: 20%"> ${client['client_phone']} </span>
						<span style="margin-left: 20%"> ${client['client_cpf']} </span>
						<button class="danger" style="margin-left: 8%" onclick="deleteClient(${client['client_id']})">Excluir</button>
						<button class="positive"  onclick="openDetail(${client['client_id']})">Detalhes</button>
						<hr style="margin-left: 10%; margin-right: 10%">`;

			document.getElementById('container_clients').innerHTML += html;
		}
	}

	function deleteClient(client_id) {
		const url = `http://localhost:8080/model/get_clients.php?client_id=${client_id}`;
		console.log(url);
		var xhttp = new XMLHttpRequest();
		xhttp.open('DELETE', url, false);
		xhttp.onreadystatechange = function() {
			if (xhttp.status == 200) {
				document.addEventListener( 'DOMContentLoaded', showMessage( 'Excluído com sucesso' ) );
				window.location.reload();
			}
			else {
				showMessage('Erro ao excluir');
			}
		}
		xhttp.send();	
	}

	function showMessage(message) {
		alert(message);
	} 

	function openDetail(client_id) {

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

	.danger {
		background-image: linear-gradient(to top, #FF0000, #FF6347 ) ; 
		color: white; 
		padding: 1%;
		font-size: 15px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;
		 cursor: pointer;	
	}

	.positive {
		background-image: linear-gradient(to top, #4169E1, #6495ED) ; 
		color: white; 
		padding: 1%;
		font-size: 15px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;	
		 cursor: pointer;	
	}

	.new {
		background-image: linear-gradient(to top, #2E8B57, #3CB371) ; 
		color: white; 
		padding: 1%;
		font-size: 15px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;	
		 cursor: pointer;	
	}

</style>

