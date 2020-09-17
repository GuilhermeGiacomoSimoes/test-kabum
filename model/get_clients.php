<?php
include('connection.php');

class GetClients {

	private $data;

	public function setData($data) {
		$this->$data = $data;
	}

	private function getData() {
		return $this->$data;
	}

	public function GET() {

		$connection = new Connection();
		list($stmt, $conn) = $connection->access();
		$data = $this->getData();

		$query = $this->getQuery($data['client_id']);	
		$response = array();

		if($stmt->prepare($query)) {
			if (isset($data['client_id'])) {
				$stmt->bind_param("i", $data['client_id']);
			}	

			$stmt->execute();
			$stmt->store_result();
			$nresults = $stmt->num_rows();

			if ($nresults > 0) {
				$stmt->bind_result($client_id, $client_name, $client_date_of_birth, $client_cpf, $client_rg, $client_phone, $lient_address );
				while($stmt->fetch()){
					$response[] = [
						'client_id' => $client_id, 
						'client_name' => $client_name, 
						'client_date_of_birth' => $client_date_of_birth, 
						'client_cpf' => $client_cpf, 
						'client_rg' => $client_rg, 
						'client_phone' => $client_phone, 
						'lient_address' => $lient_address
					];
				}
			}
		}

		echo json_encode($response);
		return;
	}

	private function getQuery($clientId) {
		$query = "select *from client;";

		if (isset($clientId)){
			$query += " where client_id = " + $data['client_id'];
		}

		return $query;
	}
}

$getClients = new GetClients();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$getClients->setData($_GET);	
	$getClients->GET();
}

