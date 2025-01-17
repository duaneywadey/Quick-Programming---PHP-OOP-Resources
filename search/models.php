<?php  

require_once 'dbConfig.php';

function getAllUsers($pdo) {
	$sql = "SELECT * FROM mock_data";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function searchForAUser($pdo, $searchQuery) {
	$sql = "SELECT * FROM mock_data WHERE 
			CONCAT(first_name,last_name,email,gender,ip_address,quote) 
			LIKE ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute(["%".$searchQuery."%"]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


?>