<?php
include('connection.php');

class Clients {

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

		$query = $this->getQueryGET($data['client_id']);	
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
						'client_address' => $lient_address
					];
				}
			}
		}

		echo json_encode($response);
		return;
	}

	public function PUT() {
		$connection = new Connection();
		list($stmt, $conn) = $connection->access();

		$url_components = parse_url($_SERVER['REQUEST_URI']);
		parse_str($url_components['query'], $data);

		$query = $this->getQueryPUT($data['client_id']);	
		$response = array();
		
		try {
			if($stmt->prepare($query)) {
				$stmt->bind_param("issssssissssss", $data['client_id'], $data['client_name'], $data['client_date_of_birth'], $data['client_cpf'], $data['client_rg'], $data['client_phone'], $data['client_address'], $data['client_id'], $data['client_name'], $data['client_date_of_birth'], $data['client_cpf'], $data['client_rg'], $data['client_phone'], $data['client_address']);

				$stmt->execute();
				$inserts[] = $stmt->insert_id;
				
				$response['error'] = 0;
				$response['message'] = '';
				$response['inserts'] = sizeof($inserts);
				$response['idinserts'] = ($inserts);
			}
		}
		catch(Exception $e) {
			$response['error'] = 1;
			$response['message'] = $e->getMessage();
		}
		
		echo json_encode($response);
		return;
	}

	public function DEL() {
		$connection = new Connection();
		list($stmt, $conn) = $connection->access();

		$url_components = parse_url($_SERVER['REQUEST_URI']);
		parse_str($url_components['query'], $data);

		var_dump($data);

		if (isset($data['client_id'])) {
			var_dump("ta aqui");
			$query = $this->getQueryDELETE();	
			$response = array();

			try {
				if($stmt->prepare($query)) {
					$stmt->bind_param("i", $data['client_id']);

					$stmt->execute();
					$inserts[] = $stmt->insert_id;
					
					$response['error'] = 0;
					$response['message'] = '';
					$response['inserts'] = sizeof($inserts);
					$response['idinserts'] = ($inserts);
				}
			}
			catch(Exception $e) {
				$response['error'] = 1;
				$response['message'] = $e->getMessage();
			}
			
			echo json_encode($response);
			return;
		}
		else {
			$response = array();
			$response['error'] = 1;
			$response['message'] = $e->getMessage();

			echo json_encode($response);
			return;	
		} 
	}

	private function getQueryDELETE() : string {
		return "delete from client where client_id = ?";
	}

	private function getQueryPUT() : string {
		return "insert into client (client_id, client_name, client_date_of_birth, client_cpf, client_rg, client_phone, client_address ) values (?, ?, ?, ?, ?, ?, ?) on duplicate key update client_id=?, client_name=?, client_date_of_birth=?, client_cpf=?, client_rg=?, client_phone=?, client_address=?";
	}

	private function getQueryGET($clientId) : string {
		$query = "select *from client;";

		if (isset($clientId)){
			$query += " where client_id = " + $data['client_id'];
		}

		return $query;
	}
}

$clients = new Clients();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
	$clients->setData($_GET);	
	$clients->GET();
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$url_components = parse_url($_SERVER['REQUEST_URI']);
	parse_str($url_components['query'], $params);

	$clients->setData($params);
	$clients->PUT();
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
	$url_components = parse_url($_SERVER['REQUEST_URI']);
	parse_str($url_components['query'], $params);

	$clients->setData($params);
	$clients->DEL();
}


