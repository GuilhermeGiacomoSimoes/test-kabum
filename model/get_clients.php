<?php

$getClients = new GetClients();
$getClients->setData();

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

		$query = "select *from client";

		if (isset($data['client_id'])){
			$query += " where client_id = " + $data['client_id'];
		}

		$result = mysqli_query($connection, $query);
		$row 	= mysqli_num_rows($result);
		$array 	= array();
	
		$result->bind_result($client_id, $client_name, $client_date_of_birth, $client_cpf, $client_rg, $client_phone, $client_address);

		if ($row > 0) {
			while($result->fetch()) {
				$array[] = [
					'client_id' 			=> $client_id,
					'client_name' 			=> $client_name, 
					'client_date_of_birth' 	=> $client_date_of_birth, 
					'client_cpf' 			=> $client_cpf, 
					'client_rg' 			=> $client_rg, 
					'client_phone' 			=> $client_phone, 
					'client_address' 		=> $client_address
				];
			}
		}

		echo $array;
		return;
	}
}
