<?php
session_start();
?>

<div style="background-color: #dcdcdc; height: 100%; width: 100%">
	<span> Olá, <?php echo $_SESSION['user']; ?> </span>

	<div class="container" style="margin: 10%">
		Nome de usuário: <input id="user" placeholder="mario.png" style="margin-bottom: 1%;"></input> <br/>
		Senha: <input id="pass" type="password" placeholder="sua senha" style="margin-bottom: 1%;"></input> <br/>
		<button onclick="cadUser()" class="new"> Cadastrar </button>
	</div>
</div>

<script>

	function cadUser() {
		const user = document.getElementById('user').value;
		const pass = document.getElementById('pass').value; 

		const url = `http://localhost:8080/model/login.php?user=${user}&pass=${pass}`;

		var xhttp = new XMLHttpRequest();
		xhttp.open('PUT', url, false);
		xhttp.onreadystatechange = function() {
			if (xhttp.status == 200) {
				document.addEventListener( 'DOMContentLoaded', showMessage('Cadastrado com sucesso'));
			}
			else {
				showMessage('Erro ao cadastrar');	
			}
		}
		xhttp.send();
	}

	function showMessage(message) {
		alert(message);
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

