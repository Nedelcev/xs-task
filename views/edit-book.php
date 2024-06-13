<?php
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header("Location: /login");
    exit();
}

$database = new Database();
$db = $database->getConnection();
$book = new Book($db);

if (isset($_GET['id'])) {
    $book->id = $_GET['id'];
    if (!$book->getBookById()) {
        header("Location: /home");
		exit();
    }
} else {
    echo "No book ID provided.";
    exit();
}

?>

<div class="container">
	<div class="form-container">
		<h2>Edit Book</h2>
		<form id="edit-book-form" method="post">
			<input type="hidden" name="id" value="<?php echo $book->id; ?>">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($book->name); ?>" required>
			</div>
			<div class="form-group">
				<label for="isbn">ISBN</label>
				<input type="text" class="form-control" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book->isbn); ?>" required>
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($book->description); ?></textarea>
			</div>
			<button type="submit" id="edit-book-button" class="btn btn-primary btn-block">Save Changes</button>
		</form>
	</div>
</div>
