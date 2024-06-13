<?php
session_start();
include_once '../db.php';
include_once '../models/Book.php';

$response = array('success' => false, 'successMessage'  => '', 'error' => '');

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /login");
    exit();
}

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();
    $book = new Book($db);

    $book->name = $_POST['name'];
    $book->isbn = str_replace(' ', '', trim($_POST['isbn']));
    $book->description = $_POST['description'];
    $book->user_id = $_SESSION['user_id'];

	// Проверка дали ISBN-а има поне 10 цифри
    if (strlen($_POST['isbn']) < 10) {
        $response['error'] = 'Please provide valid ISBN.';
        echo json_encode($response);
        exit();
    }

    // Проверка дали книгата вече съществува
    if ($book->bookExists()) {
        $response['error'] = 'Book already exists.';
        echo json_encode($response);
        exit();
    }
	
    if($book->create()) {
        $response['success'] = true;
        $response['successMessage'] = 'This book was added successfully. You will be redirected in 3 second.';
    } else {
		$response['error'] = 'Unable to create book.';
    }
	echo json_encode($response);
}
?>
