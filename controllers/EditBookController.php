<?php
session_start();
include_once '../db.php';
include_once '../models/Book.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /login");
    exit();
}

$response = array('success' => false, 'error' => '');

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $book = new Book($db);

    $book->id = $_POST['id'];
    $book->name = $_POST['name'];
    $book->isbn = $_POST['isbn'];
    $book->description = $_POST['description'];

    // Проверка дали книгата вече съществува
    if ($book->bookExists()) {
        $response['error'] = 'Book already exists.';
        echo json_encode($response);
        exit();
    }

	if ($book->update()) {
        $response['success'] = true;
        $response['successMessage'] = 'This book is updated successfully.';
    } else {
		$response['error'] = "Unable to update book.";
    }
	echo json_encode($response);
}
?>
