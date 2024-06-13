<?php
session_start();
include_once '../db.php';
include_once '../models/User.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

$response = array('success' => false, 'error' => '');

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->id = $_SESSION['user_id'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
	
    // Проверка дали името и фамилията съдържат поне по 3 букви
    if (strlen($_POST['first_name']) < 3 || strlen($_POST['last_name']) < 3) {
        $response['error'] = 'The first name and last name should be atleast 3 symbols.';
        echo json_encode($response);
        exit();
    }
	
    if (!empty($_POST['password'])) { // Проверка за парола
		// Проверка дали паролата е поне 8 знака
		if (strlen($_POST['password']) < 8) {
			$response['error'] = 'Passwords should be atleast 8 symbols.';
			echo json_encode($response);
			exit();
		}
		
		// Проверка дали паролите съвпадат
		if ($_POST['password'] !== $_POST['confirm_password']) {
			$response['error'] = 'Passwords do not match.';
			echo json_encode($response);
			exit();
		}
		
        $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    }

	if ($user->update()) {
        $response['success'] = true;
        $response['successMessage'] = 'Your profile is saved successfully.';
    } else {
		$response['error'] = "Unable to update profile.";
    }
	echo json_encode($response);
}
?>
