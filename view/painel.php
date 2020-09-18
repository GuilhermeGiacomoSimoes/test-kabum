<?php
session_start();
include('verify_login.php');
?>

<div style="background-color: #dcdcdc; height: 100%; width: 100%">
	<div style="padding: 1%">
		 Olá, <?php echo $_SESSION['user']; ?> 
		<br>
		<a href="logout.php">sair</a>
	</div>

	<div class="container" id="container_clients">
		<span class="title" style="margin-left: 10%; font-size: 18px; width: 4%">Nome</span>
		<span class="title" style="margin-left: 11%; font-size: 18px; width: 6%">Telefone</span>
		<span class="title" style="margin-left: 7%; font-size: 18px; width: 7%">Nascimento</span>
		<span class="title" style="margin-left: 8%; font-size: 18px; width: 3%">CPF</span>
		<span class="title" style="margin-left: 8%; font-size: 18px; width: 2%">RG</span>
		<a href="new_user.php" style="margin-left: 10%">
			<button class="new" >Novo</button>
		</a>
		<br/>

		<hr style="margin-left: 10%; margin-right: 10%;  opacity: 0.5">
		
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
			const html = `<span class="description"style="margin-left: 10%; width: 12%"> ${client['client_name']}</span>
						<span class="description" style="margin-left: 4%; width: 5%"> ${client['client_phone']} </span>
						<span class="description"style="margin-left: 8%; width: 6%"> ${client['client_date_of_birth']} </span>
						<span class="description"style="margin-left: 8%; width: 5%"> ${client['client_cpf']} </span>
						<span class="description"style="margin-left: 6%; width: 4%"> ${client['client_rg']} </span>
						<button class="danger" style="margin-left: 8%;" onclick="deleteClient(${client['client_id']})">Excluir</button>
						<button class="positive" style="margin-left: 1%" onclick="editClient(${client['client_id']})">Editar</button>
						<hr style="margin-left: 10%; margin-right: 10%; opacity: 0.5">`;

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

	function editClient(client_id) {
		window.location.href = `../view/new_user.php?${client_id}`;
	}

	function showMessage(message) {
		alert(message);
	} 

</script>

<style>
	span {
		display: inline-block;
	}

	.container {
		padding: 5%;
		background-color: #fff;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;
		margin: 5%
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

	.title {
		color: #808080;
		font-weight: bold;
	}

	.description {
		color: #808080;
	}
</style>

