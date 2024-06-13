<?php
session_start();
include_once '../db.php';
include_once '../models/User.php';

$response = array('success' => false, 'error' => '');

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /login");
    exit();
}

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);

    $user->id = $_POST['user_id'];

    if ($user->activateUser()) {
        $response['success'] = true;
        $response['successMessage'] = '';
    } else {
		$response['error'] = "Unable to activate user.";
    }
	echo json_encode($response);
}
?>
