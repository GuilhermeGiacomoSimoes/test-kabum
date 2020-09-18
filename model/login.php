<?php 
session_start();
include('../model/connection.php');

class Login {

	private $data;

	public function setData($data){
		$this->$data = $data;
	}

	private function getData(){
		return $this->$data;
	}

	public function POST() {
		$connection = new Connection();
		list($stmt, $conn) = $connection->access();
		$data = $_POST;

		$query = $this->getQuery();	
		$response = array();

		$user = $data['user'];
		$pass = $data['pass'];

		if (isset($user) && isset($pass)) {
			if($stmt->prepare($query)) {
				$stmt->bind_param("ss", $user, $pass);
				$stmt->execute();
				$stmt->store_result();
				$nresults = $stmt->num_rows();

				
				if ($nresults >= 1){
					$_SESSION['user'] = $user;
					header('Location: /view/painel.php');
					exit();
				}
				else {
					$_SESSION['not_authenticated'] = true;
					header('Location: /index.php');
					exit();
				}
			}
		}
		else {
			$_SESSION['not_authenticated'] = true;
			header('Location: /index.php');
			exit();
		}
	}

	public function PUT() {
		$url_components = parse_url($_SERVER['REQUEST_URI']);
		parse_str($url_components['query'], $data);

		$connection = new Connection();

		list($stmt, $conn) = $connection->access();

		$query = $this->getQueryCAD();	

		var_dump($data);

		$user = $data['user'];
		$pass = $data['pass'];

		if (isset($user) && isset($pass)) {
			if($stmt->prepare($query)) {
				$stmt->bind_param("ss", $user, $pass);
				$stmt->execute();
				
				$_SESSION['user'] = $user;
				header('Location: /view/painel.php');
				exit();
			}
		}
		else {
			$_SESSION['not_authenticated'] = true;
			header('Location: /model/login.php');
			exit();
		}
	}

	private function getQuery() : string {
		return "select *from user where user_name = ? and password = md5(?)";
	}
	
	private function getQueryCAD() : string {
		return "insert into user (user_name, password) values (?, md5(?))";
	}
}

$login = new Login();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$login->setData($_POST);	
	$login->POST();
}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
	$url_components = parse_url($_SERVER['REQUEST_URI']);
	parse_str($url_components['query'], $data);
	var_dump($data);
	$login->PUT();
}
