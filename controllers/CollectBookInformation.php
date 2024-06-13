<?php
session_start();
include_once '../db.php';
include_once '../models/Book.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
	exit();
}

if ($_POST) {
	// Проверка дали ISBN-а има поне 10 цифри преди да се направи call към API-то
    if (strlen($_POST['isbn']) < 10) {
        $response['error'] = 'Please provide valid ISBN.';
        echo json_encode($response);
        exit();
    }

	$apiUrl = "https://openlibrary.org/api/books";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $apiUrl . '?bibkeys=ISBN:' . str_replace(' ', '', trim($_POST['isbn'])) . '&jscmd=details&format=json',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);
	
	$json_response = json_decode($response);
	if($json_response && !empty($json_response)) {
		$json_response_reset = reset($json_response);
		if(isset($json_response_reset->details)) {
			echo json_encode($json_response_reset->details);
		} else {
			$resp['error'] = 'This book could not be found.';
			echo json_encode($resp);
			exit();
		}
	} else {
		$resp['error'] = 'This book could not be found.';
		echo json_encode($resp);
		exit();
	}
}
?>
