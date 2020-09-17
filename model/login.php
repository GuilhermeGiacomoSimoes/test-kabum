<?php 
session_start();
include('../model/connection.php');

if (empty($_POST['user']) || empty($_POST['pass'])){
	header('Location: /index.php');
	exit();
}

class Login {

	private $data;

	public function setData($data){
		$this->$data = $data;
	}

	private function getData(){
		return $this->$data;
	}

	public function POST() {

		$data = $this->getData();

		$connection = new Connection();

		list($stmt, $conn) = $connection->access();
		$data = $this->getData();

		string $query = $this->getQuery();	
		$response = array();

		$user = $data['user'];
		$pass = $data['pass'];

		if (isset($user) && isset($pass)) {
			if($stmt->prepare($query)) {
				$stmt->bind_param("ss", );
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
					header('Location: /model/login.php');
					exit();
				}
			}
		}
		else {
			$_SESSION['not_authenticated'] = true;
			header('Location: /model/login.php');
			exit();
		}
	}

	private function getQuery() : string {
		return "select *from user where user_name = ? and password = md5(?)"
	}
}

$login = new Login();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
	$login->setData($_POST);	
	$login->POST();
}
