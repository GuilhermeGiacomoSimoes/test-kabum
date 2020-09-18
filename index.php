<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Sistema de Login</title>
	</head>

	<span> Área administrativa </span>
	<body style="background-color: #dcdcdc; height: 100%; width: 100%">
		<section>
			<center>
				<div class="hero-body">
					<div class="container">
						<div class="column is-4 is-offset-4">
							<h3 class="title has-text-grey">Login</h3>
							<?php
								if (isset($_SESSION['not_authenticated'])):
							?>
							<div class="danger">
							  <p>Usuário ou senha inválidos.</p>
							</div>
							<?php
								endif;
								unset($_SESSION['not_authenticated']);
							?>
							<form action="/model/login.php" method="POST">
								<input class="input" name="user" placeholder="Seu usuário" autofocus="" style="margin-bottom: 1%">
								<br>
								<input class="input" name="pass" type="password" placeholder="Sua senha"style="margin-bottom: 1%">
								<br>
								<button type="submit" class="positive">Entrar</button>
							</form>
							<a href="./view/new_cad.php">Cadastrar</a>
						</div>
					</div>
				</div>
			<center>	
		</section>
	</body>

</html>

<style>
	.input {
		width: 40%;	
	}

	.container {
		padding: 5%;
		background-color: #fff;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;
		width: 30%;	
		height: 30%;	
	}

	.danger {
		background-image: linear-gradient(to top, #FF0000, #FF6347 ) ; 
		color: white; 
		padding: 3%;
		font-size: 15px;
		-moz-border-radius:7px;
		-webkit-border-radius:7px;
		 border-radius:7px;
		 width: 38%;
		 margin-bottom: 1% 
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
		 width: 43%;
		 padding: 3%
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
