<?php
include_once '../db.php';
include_once '../models/User.php';

$response = array('success' => false, 'successMessage'  => '', 'error' => '');

if ($_POST) {
	$database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    // Проверка дали името и фамилията съдържат поне по 3 букви
    if (strlen($_POST['first_name']) < 3 || strlen($_POST['last_name']) < 3) {
        $response['error'] = 'The first name and last name should be atleast 3 symbols.';
        echo json_encode($response);
        exit();
    }

    // Проверка дали имейлът вече съществува
    if ($user->emailExists()) {
        $response['error'] = 'Email already exists.';
        echo json_encode($response);
        exit();
    }
	
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

    if ($user->create()) {
        $response['success'] = true;
        $response['successMessage'] = 'Your registration was created successfully BUT should be validated by Admin. You will be redirected in 3 second.';
    } else {
        $response['error'] = 'Unable to create user.';
    }
    echo json_encode($response);
}
?>
