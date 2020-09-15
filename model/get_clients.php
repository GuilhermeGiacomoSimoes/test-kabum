<?php
include('connection.php');

$getClients = new GetClients();
//$getClients->setData();

switch($_SERVER["REQUEST_METHOD"]){
	case'GET':
		$getClients->GET();
		break;
}

class GetClients {

	private $data;

	public function setData($data) {
		$this->$data = $data;
	}

	private function getData() {
		return $this->$data;
	}

	public function GET() {

		$query = "select *from client;";

		if (isset($data['client_id'])){
			$query += " where client_id = " + $data['client_id'];
		}

		$result = mysqli_query($connection, $query);
		$array  = array();
		if(mysqli_num_rows($result) > o){
			$array = mysqli_fetch_array($result, MYSQLI_NUM);
		}	

		echo $array;
		return;
	}
}
