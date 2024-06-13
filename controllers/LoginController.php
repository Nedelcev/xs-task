<?php
session_start();
include_once '../db.php';
include_once '../models/User.php';

$response = array('success' => false, 'error' => '');

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    if ($user->getUserByEmail()) {
        if (password_verify($_POST['password'], $user->password)) {
			if ($user->active) {
				$_SESSION['user_id'] = $user->id;
				$_SESSION['is_admin'] = $user->is_admin;
				$response['success'] = true;
			} else {
				$response['error'] = 'Your account is not activated.';
			}
        } else {
            $response['error'] = 'Incorrect password.';
        }
    } else {
        $response['error'] = 'Email not found.';
    }
    echo json_encode($response);
}
?>
