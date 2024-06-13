<?php
session_start();
include_once '../db.php';

$response = array('success' => false, 'error' => '');

if (!isset($_SESSION['user_id'])) {
    header("Location: /login");
    exit();
}

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "INSERT INTO user_books (user_id, book_id) VALUES (:user_id, :book_id)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->bindParam(':book_id', $_POST['book_id']);

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['successMessage'] = '';
    } else {
		$response['error'] = "Unable to add book to collection.";
    }
	echo json_encode($response);
}
?>
