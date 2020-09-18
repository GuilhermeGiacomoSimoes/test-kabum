<?php
session_start();
include('verify_login.php');
?>

<div style="background-color: #dcdcdc; height: 100%; width: 100%">
	<span> Olá, <?php echo $_SESSION['user']; ?> </span>

	<div class="container" style="margin: 10%">
			Nome: <input id="name" placeholder="João batista" style="margin-bottom: 1%;"></input> <br/>
			Nascimento: <input class="inputDate" id="date_of_birth" type="date" placeholder="15/06/1974" style="margin-bottom: 1%;"></input> <br/>
			CPF: <input id="cpf" placeholder="396.987.958-89" style="margin-bottom: 1%;"></input> <br/>
			RG: <input id="rg" placeholder="46.563.631-7" style="margin-bottom: 1%;"></input> <br/>
			Telefone: <input id="telephone" type="tel" placeholder="(11)96625544" style="margin-bottom: 1%;"></input> <br/>
			Endereço: <input id="address" placeholder="R. Palestra Itália, 1920" style="margin-bottom: 1%;"></input> <br/>

			<button id="add" onclick="addNewClient()" class="new"> Adicionar </button>
	</div>
</div>

<script>
		
		let urlToSave = `http://localhost:8080/model/get_clients.php?`;

		verifyEdit();
		function verifyEdit() {
			const url = window.location.href;
			if (url.indexOf('?') != -1){
				const client_id = url.split('?')[1];
				getClient(client_id);
			}
		}

		function getClient(client_id) {
			const url = `http://localhost:8080/model/get_clients.php?client_id=${client_id}`;

			var xhttp = new XMLHttpRequest();
			xhttp.open('GET', url, false);
			xhttp.onreadystatechange = function() {
				if (xhttp.status == 200) {
					document.addEventListener( 'DOMContentLoaded', fillInputs(JSON.parse(xhttp.responseText)));
				}
				else {
					showAlert('Erro ao buscar dados', false);	
				}
			}
			xhttp.send();	
		}

		function fillInputs( client ) {
			document.getElementById('name').value = client[0]['client_name'];	
			document.getElementById('date_of_birth').value = client[0]['client_date_of_birth'];;	
			document.getElementById('cpf').value = client[0]['client_cpf'];	
			document.getElementById('rg').value = client[0]['client_rg'];	
			document.getElementById('telephone').value = client[0]['client_phone'];	
			document.getElementById('address').value = client[0]['client_address'];

			urlToSave += `client_id=${client[0]['client_id']}&`;
		}

		function addNewClient()  {
			const name = document.getElementById('name').value;	
			const date_of_birth = document.getElementById('date_of_birth').value;	
			const cpf = document.getElementById('cpf').value;	
			const rg = document.getElementById('rg').value;	
			const telephone = document.getElementById('telephone').value;	
			const address = document.getElementById('address').value;	

			urlToSave += `client_name=${name}&client_date_of_birth=${date_of_birth}&client_cpf=${cpf}&client_rg=${rg}&client_phone=${telephone}&client_address=${address}`;

			console.log(urlToSave);

			var xhttp = new XMLHttpRequest();
			xhttp.open('POST', urlToSave, false);
			xhttp.onreadystatechange = function() {
				if (xhttp.status == 200) {
					document.addEventListener( 'DOMContentLoaded', showAlert('sucesso ao cadastrar', true) );
				}
				else {
					showAlert('Erro ao cadastrar', false);	
				}
			}
			xhttp.send();
			
		}


		function showAlert(message, back) {
			alert(message);

			if (back) {
				window.location.href = "../view/painel.php";
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

	.inputDate {
		padding: 1%; 
	}

</style>

